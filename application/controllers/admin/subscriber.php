<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriber extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        if($this->session->userdata('admingroup') == "mod"){
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['adminid'] = $this->session->userdata('adminid');
        $this->load->model('subscribermodel');
        $this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý email subscribe';
        $total = $this->subscribermodel->readCount(array('email'=>'%'.$this->input->get('email').'%','active'=>'%'.$this->input->get('active').'%'));
        $this->data['email'] = $this->input->get('email');
        $this->data['active'] = $this->input->get('active');
        if($this->data['email'] != "" || $this->data['active'] != ""){
            $config['suffix'] = '?email='.urlencode($this->data['email']).'&active='.urlencode($this->data['active']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/subscriber/';
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
        if($this->data['email'] != "" || $this->data['active'] != ""){
            $this->data['list'] = $this->subscribermodel->read(array('email'=>'%'.$this->data['email'].'%','active'=>'%'.$this->data['active'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->subscribermodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/subscriber/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/subscriber/list');
        $this->load->view('admin/common/footer');
    }


    public function edit($id) {
        $this->data['subscriber'] = $this->subscribermodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $data = array(
                "email" => $this->input->post("email"),
				"active" => $this->input->post("active"),
            );
            $this->subscribermodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/subscriber");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/subscriber/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id) {
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->subscribermodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/subscriber");
            exit();
        }
    }
}