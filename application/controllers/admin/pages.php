<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('pagesmodel');
        $this->load->model('newsmodel');
    }
    public function index(){
        $this->data['title']    = 'Quản lý trang tĩnh';
        $total = $this->newsmodel->readCount(array('title'=>'%'.$this->input->get('title')));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/pages/';
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
        if($this->data['title'] != ""){
            $this->data['list'] = $this->newsmodel->read(array('type'=>'page','title'=>'%'.$this->data['title'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->newsmodel->read(array('type'=>'page'),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/pages/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/pages/list');
        $this->load->view('admin/common/footer');
    }

    public function add()
    {
        if($this->input->post('submit') != null){
            if($this->input->post("alias") != ""){
                $alias = $this->input->post("alias");
            }else{
                $alias = make_alias($this->input->post("title"));
            }
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => $alias,
                "content" => $this->input->post("content"),
                "meta_description" => $this->input->post("meta_description"),
                "meta_keywords" => $this->input->post("meta_keywords"),
                "create_time" => time(),
				"language" => $this->input->post("language"),
            );
            $this->pagesmodel->create($data);
            redirect(base_url() . "admin/pages");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/pages/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id)
    {
        $this->data['page'] = $this->pagesmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            if($this->input->post("alias") != ""){
                $alias = $this->input->post("alias");
            }else{
                $alias = $this->input->post("title");
            }
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => $alias,
                "content" => $this->input->post("content"),
                "meta_description" => $this->input->post("meta_description"),
                "meta_keywords" => $this->input->post("meta_keywords"),
                "create_time" => time(),
				"language" => $this->input->post("language"),
            );
            $this->pagesmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/pages");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/pages/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->pagesmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/pages");
            exit();
        }
    }
}