<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Faqs extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        if($this->session->userdata('admingroup') == "mod"){
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->load->model('faqsmodel');
        $this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý faqs';
        $total = $this->faqsmodel->readCount(array('question'=>'%'.$this->input->get('question').'%','language'=>'%'.$this->input->get('language').'%'));
        $this->data['question'] = $this->input->get('question');
        $this->data['language'] = $this->input->get('language');
        if($this->data['question'] != "" || $this->data['language'] != ""){
            $config['suffix'] = '?question='.urlencode($this->data['question']).'&language='.urlencode($this->data['language']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/faqs/';
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
        if($this->data['question'] != "" || $this->data['language'] != ""){
            $this->data['list'] = $this->faqsmodel->read(array('question'=>'%'.$this->data['question'].'%','language'=>'%'.$this->data['language'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->faqsmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/faqs/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/faqs/list');
        $this->load->view('admin/common/footer');
    }

    public function add()
    {
        if($this->input->post('submit') != null){
            $data = array(
                "question" => $this->input->post("question"),
                "alias" => make_alias($this->input->post("name")),
				"language" => $this->input->post("language"),
                "answer" => $this->input->post("answer"),
            );
            $this->faqsmodel->create($data);
            redirect(base_url() . "admin/faqs");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/faqs/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id)
    {
        $this->data['faqs'] = $this->faqsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $data = array(
                "question" => $this->input->post("question"),
                "alias" => make_alias($this->input->post("name")),
                "language" => $this->input->post("language"),
                "answer" => $this->input->post("answer"),
			);
            $this->faqsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/faqs");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/faqs/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->faqsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/faqs");
            exit();
        }
    }

}