<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends MY_Controller{
    private $data;
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
        $this->load->model('adminsmodel');
		$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Dashboard';
		$this->load->model('newsmodel');
		$this->data['news'] = $this->newsmodel->read(array(),array(),false,10);
		$this->load->model('newscategorymodel');
		$this->data['categories'] = $this->newscategorymodel->read(array(),array(),false,10);
        $this->load->view('admin/common/header',  $this->data);
        $this->load->view('admin/index');
        $this->load->view('admin/common/footer');
    }
}