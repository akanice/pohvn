<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tag extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        if($this->session->userdata('admingroup') == "mod"){
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->load->model('tagmodel');
        $this->load->library('auth');
    }
    public function index(){
        $this->data['title']    = 'Quản lý tag';
        $total = $this->tagmodel->readCount(array('name'=>'%'.$this->input->get('name').'%','language'=>'%'.$this->input->get('language').'%'));
        $this->data['name'] = $this->input->get('name');
        $this->data['language'] = $this->input->get('language');
        if($this->data['name'] != "" || $this->data['language'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']).'&language='.urlencode($this->data['language']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/tag/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 20;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        if($this->data['name'] != "" || $this->data['language'] != ""){
            $this->data['list'] = $this->tagmodel->read(array('name'=>'%'.$this->data['name'].'%','language'=>'%'.$this->data['language'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->tagmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/tag/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/tag/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $data = array(
                "name" 			=> $this->input->post("name"),
                "alias" 		=> make_alias($this->input->post("name")),
				"language" 		=> $this->input->post("language"),
            );
            $this->tagmodel->create($data);
            redirect(base_url() . "admin/tag");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/tag/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['tag'] = $this->tagmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $data = array(
                "name" => $this->input->post("name"),
                "alias" => make_alias($this->input->post("name")),
				"language" => $this->input->post("language"),
            );
            $this->tagmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/tag");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/tag/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id) {
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->tagmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/tag");
            exit();
        }
    }

}