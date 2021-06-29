<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends MY_Controller{
    function __construct() {
		parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		// $this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('adminsmodel');
		$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Dashboard';
		$this->load->model('newsmodel');
		$this->data['news'] = $this->newsmodel->read(array(),array('id'=>false),false,10); //get lastest news
		$this->load->model('newscategorymodel');
		$this->data['categories'] = $this->newscategorymodel->read(array(),array(),false,10); //get categories
		$this->load->model('ordersmodel');
		$this->data['newest_order24'] = $this->ordersmodel->getOrderlastNdays(2); //get lastest orders in 24hours
		$this->data['newest_order'] = $this->ordersmodel->getListorders('','','pending',10,''); //get lastest orders
		
		// Chart data
		$this->data['data_label'] = $this->ordersmodel->getLastNdays(10);
		$this->data['data_revenue'] = $this->ordersmodel->getRevenue(10);
		$this->data['data_orders'] = $this->ordersmodel->getOrdersNumber(10);
		// print_r($this->data['data_revenue']);
		// die();
		
        $this->load->view('admin/common/header',  $this->data);
        $this->load->view('admin/index');
        $this->load->view('admin/common/footer');
    }
}