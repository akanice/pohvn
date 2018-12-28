<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
		
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
		
        $this->load->model('customersmodel');
        $this->load->model('adminsmodel');
	}
	
    public function index(){
		$user_group = $this->adminsmodel->read(array('id'=>$this->session->userdata('adminid')),array(),true)->group;
        if ($user_group == 'admin') {
			$this->data['title']    = 'POH - Quản lý data khách hàng';

			$whereArray = array('phone'=>'%'.$this->input->get('phone').'%',
									'name'=>'%'.$this->input->get('name').'%',
									'address'=>'%'.$this->input->get('address').'%',
								   );
			$total = $this->customersmodel->readCount($whereArray);
			$this->data['phone'] = $this->input->get('phone');
			$this->data['name'] = $this->input->get('name');
			$this->data['address'] = $this->input->get('address');

			if($this->input->get('phone') != "" || $this->input->get('name') != ""  || $this->input->get('address') != "" ){
				$config['suffix'] = '?phone='.urlencode($this->data['phone']).'&name='.urlencode($this->data['name']).'&address='.urlencode($this->data['address']);
			}
			//Pagination
			$this->load->library('pagination');
			$config['base_url'] = base_url() . 'admin/customers/';
			$config['total_rows'] = $total;
			$config['uri_segment'] = 3;
			$config['per_page'] = 10;
			$config['num_links'] = 5;
			$config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			$page_number = $this->uri->segment(3);
			if (empty($page_number)) $page_number = 1;
			$start = ($page_number - 1) * $config['per_page'];
			$this->data['page_links'] = $this->pagination->create_links();
			if($this->input->get('phone') != "" || $this->input->get('name') != ""  || $this->input->get('address') != "" ){
				$this->data['list'] = $this->customersmodel->read(array(
																		'phone'=>'%'.$this->input->get('phone').'%',
																		'name'=>'%'.$this->input->get('name').'%',
																		'address'=>'%'.$this->input->get('address').'%',
																	   ),array(),false,$config['per_page'],$start);
			}else{
				$this->data['list'] = $this->customersmodel->read(array(),array('id'=>false),false,$config['per_page'],$start);
			}
			
			$this->load->view('admin/common/header',$this->data);
			$this->load->view('admin/customers/list');
			$this->load->view('admin/common/footer');
		} else {
			redirect(base_url()."admin/access_denied");
		}
    }

    public function add() {
        $this->db->select('name,id');
        $this->db->from('device');
        $this->data['names'] = $this->db->get()->result();
		$user_id = $this->session->userdata('adminid');
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/customers/';
            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");

            //Upload cover image
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaddir . basename($_FILES['avatar']['name']))) {
                $avatar = $uploaddir . $_FILES['avatar']['name'];
            }
            else{
                $avatar = '';
            }
            //Create avatar thumb
            if ($avatar != '') {
                $dir_thumb = 'assets/uploads/thumb/customers/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
                $this->load->library('image_lib');
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $avatar;
                $config2['new_image'] = $dir_thumb;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 300;
                $config2['height'] = 300;
                $this->image_lib->clear();
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()){
                    print $this->image_lib->display_errors();
                }
            }
            $birthday = $this->input->post("birthday");
            $date = DateTime::createFromFormat('d/m/Y', $birthday);
            $birthday = $date->format('Y-m-d');
            $data = array(
                "name" 		=> $this->input->post("name"),
                "lastname" 			=> $this->input->post("lastname"),
                "avatar" 	    	=> $avatar,
                "phone" 			=> $this->input->post("phone"),
                "address" 			=> $this->input->post("address"),
                "address2" 			=> $this->input->post("address2"),
                "email" 		    => $this->input->post("email"),
                "sex" 		        => $this->input->post("sex"),
                "birthday" 		    => strtotime($birthday),
                "type" 		        => $this->input->post("type"),
                "id_device" 		=> implode($this->input->post("id_device"),','),
				"staff_create_id"	=> $this->session->userdata('adminid'),
                "time_call" 		=> time(),
                "qrcode" 		    => $this->input->post("qrcode"),
            );
            $id = $this->customersmodel->create($data);
            for($i = 1; $i <= 50; $i++){
                $code = md5($id);
            }
            $this->customersmodel->update(array('customer_code' => $code),array('id'=>$id));
            redirect(base_url() . "admin/customers");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/customers/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->db->select('name,id');
        $this->db->from('device');
		$user_id = $this->session->userdata('adminid');
        $this->data['names'] = $this->db->get()->result();
        $this->data['customer'] = $customer = $this->customersmodel->read(array('id'=>$id),array(),true);
        $this->data['id_devices'] = explode(',', $this->data['customer']->id_device);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/customers/';
            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");

            //Upload cover image
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaddir . basename($_FILES['avatar']['name']))) {
                $avatar = $uploaddir . $_FILES['avatar']['name'];
            }
            else{
                $avatar = '';
            }

            //Create avatar thumb
            if ($avatar != '') {
                $dir_thumb = 'assets/uploads/thumb/customers/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
                $this->load->library('image_lib');
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $avatar;
                $config2['new_image'] = $dir_thumb;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 300;
                $config2['height'] = 300;
                $this->image_lib->clear();
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()){
                    print $this->image_lib->display_errors();
                }
            }
            if($avatar == '') $avatar = $customer->avatar;
            for($i = 1; $i <= 50; $i++){
                $code = md5($id);
            }
            $birthday = $this->input->post("birthday");
            $date = DateTime::createFromFormat('d/m/Y', $birthday);
            $birthday = $date->format('Y-m-d');
            $data = array(
                "name" 		=> $this->input->post("name"),
                "lastname" 			=> $this->input->post("lastname"),
                "avatar" 	    	=> $avatar,
                "phone" 			=> $this->input->post("phone"),
                "address" 			=> $this->input->post("address"),
                "address2" 			=> $this->input->post("address2"),
                "email" 		    => $this->input->post("email"),
                "sex" 		        => $this->input->post("sex"),
                "birthday" 		    => strtotime($birthday),
                "type" 		        => $this->input->post("type"),
                "id_device" 		=> implode($this->input->post("id_device"), ','),
                //"id_order" 		    => $this->input->post("id_order"),
                "id_order" 		    => "",
				"staff_create_id"	=> $this->session->userdata('adminid'),
                "time_call" 		=> time(),
                "qrcode" 		    => $this->input->post("qrcode"),
                'customer_code'     => $code,
                //"userid"            => $this->session->userdata('adminid')
            );
            $this->customersmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/customers");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/customers/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->customersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/customers");
            exit();
        }
    }
}
