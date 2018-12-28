<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->load->model('customersmodel');
        $this->load->model('ordersmodel');
        $this->load->model('productsmodel');
        $this->load->model('devicemodel');
        $this->load->model('usersmodel');
	}
    public function index(){
		$this->load->model('usershistorymodel');
        $this->data['title']    = 'Lọc nước CRM - Quản lý đơn hàng';
        $this->data['customer'] = $this->input->get('customer');
        $total = $this->ordersmodel->getTotalOrders($this->data['customer']);
        if($this->data['customer'] != ""){
            $config['suffix'] = '?customer='.urlencode($this->data['customer']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/orders/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 30;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['base'] = site_url('admin/orders/');
        $this->load->model('usersmodel');
        $this->data['staff_techniques'] = $this->usersmodel->read(array('group_id' => 5));
        $this->data['list'] = $this->ordersmodel->getListOrders($this->data['customer'], $config['per_page'],$start);
		
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/orders/list');
        $this->load->view('admin/common/footer');
    }

    public function add($customer_id) {
        $id_device = $this->customersmodel->read(array('id'=>$customer_id),array(),true)->id_device;
		if(isset($_POST['submit'])){
            $staff_create_id = $this->session->userdata('adminid');
            $create_date = time();
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
			
            $data = array('customer_id' => $customer_id,
						  'id_device' => $id_device,
                          'staff_create_id' => $staff_create_id,
                          'create_date' => $create_date,
                          'implement_date' => strtotime($implement_date),
						  'sale_percent' => $sale_percent,
						  'sale_amount' => $sale_amount,
                          'note' => $note
                         );
            $id_order = $this->ordersmodel->create($data);
			if($id_order){
				//history (log)
				$this->load->model('usershistorymodel');
				if($id_order){
					$data2 = array(
						'id_user' => $staff_create_id,
						'id_order' => $id_order,
						'action' => 'create',
						'datetime' => $create_date,
						'type' => '',
					);
					$this->usershistorymodel->create($data2);
				}

                //Add notifications
                $this->load->model('usersmodel');
                $this->load->model('notificationmodel');
                $users = $this->usersmodel->getUserReceiveNotifications();
                $notifications = array();
                if(is_array($users)){
                    foreach ($users as $key => $value) {
                        $notifications[] = array('id_user_from' => $this->session->userdata('adminid'),
                                                  'id_user_to'  => $value->id,
                                                  'status' => 'new',
                                                  'content'  => 'tạo đơn hàng mới.',
                                                  'order_id' => $id_order
                                                );
                    }
                    $this->notificationmodel->create($notifications, true);
                }
                redirect(base_url() . "admin/orders");
            }else{
                redirect(base_url() . "admin/customers");
            }
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/orders/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['id'] = $id;
		$this->data['devices'] = $this->devicemodel->read();
        $this->data['order'] = $this->ordersmodel->read(array('id' => $id), array(), true);
        $this->data['products'] = json_decode($this->data['order']->product_array);
		if ($this->data['products']){
			foreach ($this->data['products'] as $item) {
				$row = $this->productsmodel->read(array('id'=>$item->pro_id),array(),true);
				$item->name = $row->name;
				$item->sku = $row->sku;
				$item->sell_price = $row->sell_price;
				$item->longevity = $row->longevity;
				$data[] = $item; 
			}
			$this->data['products'] = $data;
		}
		
		
		$this->data['device_id'] = $this->input->post('device_id');
		$customer_id = $this->data['order']->customer_id;
		
		$submitForm = $this->input->post('submitForm');
		if ($submitForm == 'submitDevice') {
			$this->data['products'] = null;
			$this->data['products'] = $this->productsmodel->getProductByDeviceId($this->data['device_id']);
			$this->session->set_userdata('customer_device_id',$this->data['device_id']);
		} elseif (($submitForm == 'submitAll')) {
			$products = array();
			$product_id = $this->input->post('product_id');
			$id_device = $this->input->post('device_id'); 
			// $data_post = $this->input->post();
			// array_shift($data_post);
			$i = 0;
			$total = 0;
			foreach ($product_id as $key=>$value) {
				$price = $this->productsmodel->read(array('id'=>$key),array(),true)->sell_price;
                $total += ($price * $value);
				$products[] = array('pro_id'=>$key,'quantity'=>$value,'id'=>$i);
				$i++;
			}
			$total = $total - $total*$this->data['order']->sale_percent/100 - $this->data['order']->sale_amount;
			//update order
            $data = array(
				'product_array'	=> json_encode($products),
				'total_price'	=> $total,
				'id_device'		=> $this->session->userdata('customer_device_id'),
			);
			$this->ordersmodel->update($data, array('id' => $id));
			//update device_id to customer data
			$data2 = array(
				'id_device' => $this->session->userdata('customer_device_id'),
			);
			$this->customersmodel->update($data2, array('id'=>$customer_id));
			
            $this->ordersmodel->update($data, array('id' => $id));
            redirect(base_url() . "admin/orders");
            exit();
		} else {
			
		}
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/orders/edit');
		$this->load->view('admin/common/footer');
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
	
	public function confirm($id) {
		if(isset($id)&&($id>0)&&is_numeric($id)){
			//update order's status
			$data = array(
				"status" => 'confirm',
				"complete_date" => time(),
			);
            $this->ordersmodel->update($data, array('id'=>$id));
			
			//update user_cart
			$this->load->model('userscartmodel');
			$this->load->model('userscarthistorymodel');
			$this->load->model('usershistorymodel');
			$this->data['order'] = $this->ordersmodel->read(array('id' => $id),array(),true);
			$this->data['product_array'] = json_decode($this->data['order']->product_array);
			$id_user = $this->session->userdata('adminid');
			foreach ($this->data['product_array'] as $item) {
                //update user_cart
				$row = $this->userscartmodel->read(array('id_user'=>$id_user,'id_product'=>$item->pro_id),array(),true);
				$current_number = $row->product_number - $item->quantity;
				$data = array(
					'product_number' => $current_number,
				);
				$this->userscartmodel->update($data, array('id_user'=>$id_user,'id_product'=>$item->pro_id));
				
				//update user_cart_history
				$data2 = array(
					'id_user' => $id_user,
					'id_order' => $id,
					'id_product' => $item->pro_id,
					'action' => 'decrease',
					'datetime' => time(),
				);
				$this->userscarthistorymodel->create($data2);				
            }
			//update user_history
			$data3 = array(
				'id_user' => $id_user,
				'id_order' => $id,
				'id_user_to' => $this->data['order']->staff_create_id,
				'action' => 'complete',
				'datetime' => time(),
			);
			$this->usershistorymodel->create($data3);
				
			//Add notifications
			$this->load->model('usersmodel');
			$this->load->model('notificationmodel');
			$users = $this->usersmodel->getUserReceiveNotifications();
			$notifications = array();
			if(is_array($users)){
				foreach ($users as $key => $value) {
					$notifications[] = array('id_user_from' => $this->session->userdata('adminid'),
											  'id_user_to'  => $value->id,
											  'status' => 'new',
											  'content'  => 'tạo đơn hàng mới.',
											  'order_id' => $id,
											);
				}
				$this->notificationmodel->create($notifications, true);
			}
			
            redirect(base_url() . "admin/orders");
            exit();
        }
	}
	
	public function delayed($id) {
		if(isset($id)&&($id>0)&&is_numeric($id)){
			//update order's status
			$data = array(
				"status" => 'new',
				"complete_date" => 0,
				"staff_technique_id" => 0,
			);
            $this->ordersmodel->update($data, array('id'=>$id));
			
			$this->load->model('usershistorymodel');
			$this->data['order'] = $this->ordersmodel->read(array('id' => $id),array(),true);
			$id_user = $this->session->userdata('adminid');
			
			//update user_history
				$data3 = array(
					'id_user' => $id_user,
					'id_order' => $id,
					'id_user_to' => $this->data['order']->staff_create_id,
					'action' => 'delayed',
					'datetime' => time(),
				);
				$this->usershistorymodel->create($data3);
				
            redirect(base_url() . "admin/orders");
            exit();
        }
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

                //Add notifications
                // $this->load->model('usersmodel');
                // $this->load->model('notificationmodel');
                // $users = $this->usersmodel->getUserReceiveNotifications();
                // $notifications = array();
                // if(is_array($users)){
                    // foreach ($users as $key => $value) {
                        // $notifications[] = array('id_user_from' => $this->session->userdata('adminid'),
                                                  // 'id_user_to'  => $value->id,
                                                  // 'status' => 'new',
                                                  // 'content'  => 'tạo đơn hàng mới.',
                                                  // 'order_id' => $id_order
                                                // );
                    // }
                    // $this->notificationmodel->create($notifications, true);
                // }

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
	
	public function show($suffix='') {
		$this->load->model('usershistorymodel');
		$this->data['title']    = 'Lọc nước CRM - Quản lý đơn hàng';
		$this->load->model('usersmodel');
		$this->data['staff_techniques'] = $this->usersmodel->read(array('group_id' => 5));
		$this->data['customer'] = $this->input->get('customer');
		$total = $this->ordersmodel->getTotalOrders($this->data['customer']);
		if($this->data['customer'] != ""){
			$config['suffix'] = '?customer='.urlencode($this->data['customer']);
		}
			
		if (($suffix == '') or ($suffix == 'all')) {
			redirect(base_url() . "admin/orders");
		} elseif (($suffix == 'today') || ($suffix == 'yesterday') || ($suffix == 'tomorrow')) {
			$this->data['list'] = $this->ordersmodel->getOrdersByDate($this->data['customer'],$suffix);
		} else {
			show_404();
		}
		
		$this->load->view('admin/common/header',$this->data);
		$this->load->view('admin/orders/list');
		$this->load->view('admin/common/footer');
	} 
	
    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->ordersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/orders");
            exit();
        }
    }
}
