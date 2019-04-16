<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('customersmodel');
        $this->load->model('ordersmodel');
	}
    public function index(){
        $this->data['title'] 				= 'Quản lý đơn hàng';

        $this->data['name'] 			= $this->input->get('name');
        $this->data['phone'] 			= $this->input->get('phone');
        $this->data['status'] 			= $this->input->get('status');
        $total = $this->ordersmodel->getTotalOrders($this->data['name'],$this->data['phone'],$this->data['status']);
		if (($this->data['name'] != "") or ($this->data['phone'] != "" ) or ($this->data['status'] != '')) {
            $config['suffix'] = '?name='.urlencode($this->data['name']).'&phone='.urlencode($this->data['phone']).'&phone='.urlencode($this->data['status']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/orders/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 30;
        $config['num_links'] = 5;
		$config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<p class='paginationLink'>";
        $config["num_tag_close"] = '</p>';
        $config["cur_tag_open"] = "<p class='currentLink'>";
        $config["cur_tag_close"] = '</p>';
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<p class='paginationLink'>";
        $config["first_tag_close"] = '</p>';
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<p class='paginationLink'>";
        $config["last_tag_close"] = '</p>';
        $config["next_link"] = "Next";
        $config["next_tag_open"] = "<p class='paginationLink'>";
        $config["next_tag_close"] = '</p>';
        $config["prev_link"] = "Back";
        $config["prev_tag_open"] = "<p class='paginationLink'>";
        $config["prev_tag_close"] = '</p>';
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['base'] = site_url('admin/orders/');
        
        $this->data['list'] = $this->ordersmodel->getListOrders($this->data['name'], $this->data['phone'], $this->data['status'], $config['per_page'],$start);
		
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/orders/list');
        $this->load->view('admin/common/footer');
    }

    public function edit($id) {
		$this->data['admin_id'] = $this->session->userdata('adminid');
		$this->data['id'] = $id;
        $this->data['order'] = $this->ordersmodel->read(array('id' => $id), array(), true);
		if ($this->data['order']->status !== 'closed') {
			$this->data['title'] = 'Cập nhật trạng thái đơn hàng';
			if($this->input->post('submit') != null) {	
				$data = array(
					"sale_id" => $this->data['admin_id'],
					"status" => $this->input->post("status"),
				);
				
				$this->ordersmodel->update($data, array('id' => $id));
				redirect(base_url() . "admin/orders");
				exit();
			} else {
				$this->load->view('admin/common/header',$this->data);
				$this->load->view('admin/orders/edit');
				$this->load->view('admin/common/footer');
			}
		} else {
			$this->data['title'] = 'Đơn hàng đã được đóng lại';
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/orders/closed');
			$this->load->view('admin/common/footer');
		}
    }
	
	public function view($id) {
		$this->data['order'] = $order = $this->ordersmodel->read(array("id"=>$id),array(),true);
		$this->data['customer'] = $this->customersmodel->read(array("id"=>$order->customer_id),array(),true);
		$this->data['staff'] = $this->usersmodel->read(array("id"=>$order->staff_technique_id),array(),true);
		
		$this->data['product_array'] = json_decode($order->product_array);
		if ($this->data['product_array']){
			foreach ($this->data['product_array'] as $item) {
				$row = $this->productsmodel->read(array('id'=>$item->pro_id),array(),true);
				$item->product_name = $row->name;
				$item->sku = $row->sku;
				$item->sell_price = $row->sell_price;
				$item->longevity = $row->longevity;
				$data[] = $item; 
			}
			$this->data['product_array'] = $data;
		}
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/orders/view');
        $this->load->view('admin/common/footer');
	}
		
	public function updatesale($id) {
        $this->data['order'] = $order = $this->ordersmodel->read(array("id"=>$id),array(),true);
		$this->data['customer'] = $this->customersmodel->read(array('id_order'=>$id),array(),true);
		if(isset($_POST['submit'])){
            $implement_date = $_POST['implement_date'];
			$implement_date = str_replace('/', '-', $implement_date);
            $note = $_POST['note'];
			$sale_number = $this->input->post('sale_number');
			$sale_type = $this->input->post('sale_type');
			if ($sale_type == 0) {
				$sale_percent = $sale_number;
				$sale_amount = 0;
			} else {
				$sale_percent = 0;
				$sale_amount = $sale_number;
			}
			
            $data = array('implement_date' => strtotime($implement_date),
						  'sale_percent' => $sale_percent,
						  'sale_amount' => $sale_amount,
                          'note' => $note
                         );
            $id_order = $this->ordersmodel->update($data,array('id'=>$id));
			
			if($id_order){
				//history (log)
				$this->load->model('usershistorymodel');
				if($id_order){
					$data2 = array(
						'id_user' => $this->session->userdata('adminid'),
						'id_order' => $id,
						'action' => 'modify',
						'datetime' => time(),
						'type' => '',
					);
					$this->usershistorymodel->create($data2);
				}

                redirect(base_url() . "admin/orders");
            }else{
                redirect(base_url() . "admin/customers");
            }
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/orders/updatesale');
            $this->load->view('admin/common/footer');
        }
    }
	
    public function payAffiliate($id) {
		
	}
	
	public function createXLS() {
		$submitForm = $this->input->post('submitForm');
		if ($submitForm == 'submitDay') {
			$from_day = $this->input->post('from');
			$to_day =$this->input->post('to');
			$from_day = date_format(date_create_from_format('d/m/Y', $from_day), 'm/d/Y');
			$to_day = date_format(date_create_from_format('d/m/Y', $to_day), 'm/d/Y');
			// print_r($results);die();
		}
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');
		$results = $this->ordersmodel->getOrdersToExport($from_day,$to_day);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Tên');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Điện thoại');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Địa chỉ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Ghi chú');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Ngày tạo');       
        // set Row
        $rowCount = 2;
        foreach ($results as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['customer_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['customer_phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['customer_email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['customer_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['birth_expect']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['note']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d/m/Y H:i:s',$element['create_time']));
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(HTTP_UPLOAD_IMPORT_PATH.$fileName);        
    }
	
	public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->ordersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/orders");
            exit();
        }
    }
}
