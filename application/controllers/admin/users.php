<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        if($this->session->userdata('admingroup') == "mod"){
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->library('form_validation');
        $this->load->model('usersmodel');
		$this->load->library('auth');
		$this->load->model('optionsmodel');
		$this->data['logo_img'] = $this->optionsmodel->getOptionsItem(2);			//load Logo
    }
    public function index(){
        $this->data['title']    = 'Quản lý người dùng';
        $total = $this->usersmodel->readCount(array('email'=>'%'.$this->input->get('email').'%','name'=>'%'.$this->input->get('name').'%','address'=>'%'.$this->input->get('address').'%'));
        $this->data['email'] = $this->input->get('email');
        $this->data['name'] = $this->input->get('name');
        $this->data['address'] = $this->input->get('address');

        if($this->data['email'] != "" || $this->input->get('name') != "" || $this->input->get('address') != ""){
            $config['suffix'] = '?email='.urlencode($this->data['email']).'&name='.urlencode($this->data['name']).'&address='.urlencode($this->data['address']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/users/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
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
        if($this->data['email'] != "" || $this->input->get('name') != "" || $this->input->get('address') != ""){
            $this->data['list'] = $this->usersmodel->read(array('email'=>'%'.$this->input->get('email').'%','name'=>'%'.$this->input->get('name').'%','address'=>'%'.$this->input->get('address').'%','role'=>'normal'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->usersmodel->read(array('role'=>'normal'),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/users/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/users/list');
        $this->load->view('admin/common/footer');
    }

    public function view($id)
    {
        $this->data['user'] = $this->usersmodel->read(array('id'=>$id),array(),true);
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/users/edit');
        $this->load->view('admin/common/footer');
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->usersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/users");
            exit();
        }
    }
    
	public function updatePassword($id='', $password='', $email=''){
        $raw_password 	= $this->input->post('password');
		$email			= $this->input->post('email');
		$password		= $this->_password_encrypt($email, $raw_password);
        $id 			= $this->input->post('id');
		
        if(isset($id)&&($id>0)&&is_numeric($id)&&isset($password)){
            $this->usersmodel->update(array(
                    'password' => $password,
                ),
                array('id'=>$id)
            );
            redirect(site_url('admin/users/view/'.$id));
        }
    }
	
	private function _password_encrypt($email='',$password=''){
        $str = $password;
        // for ($i=0;$i<(100+strlen($email));$i++){
            // $str = md5($email.'|'.$str);
        // }
		for($i = 0; $i < 50; $i++){
			$str = md5($str);
		}
        return $str;
    }
}