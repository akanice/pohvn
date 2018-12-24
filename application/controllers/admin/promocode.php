<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class PromoCode extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->load->model('promocodemodel');
	}
    public function index(){
        $this->data['title']    = 'Quản lý mã giảm giá';
        $this->data['name'] = $this->input->get('name');
        $this->data['code'] = $this->input->get('code');
        if($this->input->get('start_date')){
            $this->data['start_date'] = strtotime(date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('start_date')))));
        }else{
            $this->data['start_date'] = "";
        };
        if($this->input->get('end_date')){
            $this->data['end_date'] = strtotime(date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('end_date')))));
        }else{
            $this->data['end_date'] = "";
        };
        $total = count($this->promocodemodel->getListCodes($this->data['name'],$this->data['code'],$this->data['start_date'],$this->data['end_date'],"",""));
        if($this->data['name'] != "" || $this->data['code'] != "" || $this->data['start_date'] != "" || $this->data['end_date'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']).'&code='.urlencode($this->data['code']).'&start_date='.urlencode($this->data['start_date']).'&end_date='.urlencode($this->data['end_date']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/promocode/';
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
        if($this->data['name'] != "" || $this->data['code'] != "" || $this->data['start_date'] != "" || $this->data['end_date'] != ""){
            $this->data['list'] = $this->promocodemodel->getListCodes($this->data['name'],$this->data['code'],$this->data['start_date'],$this->data['end_date'],$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->promocodemodel->getListCodes("","","","",$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/promocode/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/promocode/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $start_date_format = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('start_date'))));
            $end_date_format = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('end_date'))));
            $data = array(
                "name" 				=> $this->input->post("name"),
				"alias" 			=> make_alias($this->input->post("name")),
                "start_date" 	    => strtotime($start_date_format),
                "end_date" 	        => strtotime($end_date_format),
                "code" 		        => $this->input->post("code"),
                "promo_type" 		=> $this->input->post("promo_type"),
                "number" 		    => $this->input->post("number"),
            );
            $this->promocodemodel->create($data);
            redirect(base_url() . "admin/promocode");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/promocode/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['promocode'] = $this->promocodemodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $start_date_format = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('start_date'))));
            $end_date_format = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('end_date'))));
            $data = array(
                "name" 				=> $this->input->post("name"),
                "alias" 			=> make_alias($this->input->post("name")),
                "start_date" 	    => strtotime($start_date_format),
                "end_date" 	        => strtotime($end_date_format),
                "code" 		        => $this->input->post("code"),
                "promo_type" 		=> $this->input->post("promo_type"),
                "number" 		    => $this->input->post("number"),
            );
            $this->promocodemodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/promocode");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/promocode/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->promocodemodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/promocode");
            exit();
        }
    }
}