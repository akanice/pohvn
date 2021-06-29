<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiles extends MY_Controller{
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
        $this->load->model('adminsmodel');
        $this->load->model('usersmodel');
		$this->load->library('auth');
		$this->load->model('optionsmodel');
		$this->data['logo_img'] = $this->optionsmodel->getOptionsItem(2);			//load Logo
    }
    public function index(){
        $this->data['title']    = 'Thông tin cá nhân';
		
		$this->data['profiles'] = $this->adminsmodel->read(array('id'=>$this->session->userdata('adminid')),array(),true);
		
		if($this->input->post('submit') != null){
			if ($this->input->post("password") && $this->input->post("password") != '') {
				$password = $this->_password_encrypt('',$this->input->post("password"));
			} else {
				$password = $this->data['profiles']->password;
			}
			$data = array(
				"name" => $this->input->post("name"),
				"email" => $this->input->post("email"),
				"group" => $this->data['profiles']->group,
				"password" => $password,
			);
			$this->adminsmodel->update($data,array('id'=>$this->session->userdata('adminid')));
			redirect('/admin/profiles/', 'refresh');
		}
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/profiles/index');
        $this->load->view('admin/common/footer');
    }

    public function view($id) {
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