<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller{
    private $data;
    public function __construct() {
        parent::__construct();
        $this->load->model('adminsmodel','AdminModel');
		$this->load->library('auth');
    }
    public function index(){
        $this->load->view('admin/login');
    }
    public function error404(){
        $this->load->view('admin/error404');
    }

    public function loginAdmin(){
        $data = array();
        $data['error'] = '';
        if($this->input->post('email') && $this->input->post('pass')){
            $email = $this->input->post('email');
            $email = $this->db->escape_str($email);
            $pass = $this->input->post('pass');
            $admin = $this->AdminModel->read(array('email'=>$email),array(),true);
            if($admin){
                for($i = 0; $i < 50; $i++){
                    $pass = md5($pass);
                }
                if($pass === $admin->password){
                    $this->auth->login($admin);
					
					$this->load->helper('cookie');
					$cookie_time	=	3600*24*30; // 30 days.
							
				    $this->input->set_cookie('siteAuth_username',$admin->email,$cookie_time);
				    $this->input->set_cookie('siteAuth_password',$admin->password,$cookie_time);
					
                    redirect(site_url('admin'));
                }
            }
            $this->data['error'] = "Tên đăng nhập hoặc mật khẩu không đúng";
        }
        $this->load->view('admin/login',$this->data);
    }
    public function logoutAdmin(){
        $this->auth->logoutAdmin();
        redirect(site_url('admin'));
    }
}
