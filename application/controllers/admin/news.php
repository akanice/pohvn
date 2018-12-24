<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News extends MY_Controller{
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
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
		//$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý tin tức';
		//$test = $this->newsmodel->getListNews($this->input->get('name'),$this->input->get('category'),"","");
		
		$total = count($this->newsmodel->getListNews($this->input->get('name'),$this->input->get('category'),"",""));
        $this->data['name'] = $this->input->get('name');
        $this->data['category'] = $this->input->get('category');
        if($this->data['name'] != "" || $this->data['category'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']).'&category='.urlencode($this->data['category']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/news/';
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
        if($this->data['name'] != "" || $this->data['category'] != ""){
            $this->data['list'] = $this->newsmodel->getListNews($this->input->get('name'),$this->input->get('category'),$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->newsmodel->getListNews("","",$config['per_page'],$start);
        }
		
        $this->data['base'] = site_url('admin/news/');
        $this->data['newscategory'] = $this->newscategorymodel->read(array(),array(),false);
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/news/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        // $this->data['newscategory'] = $this->newscategorymodel->read(array(),array(),false);
        // $this->data['ckeditor'] = array(
            // 'id'        =>  'ckeditor',
            // 'path'      =>  'assets/ckeditor',
            // 'config'    =>  array(
                // 'width' =>  '700px',
                // 'height'=>  '300px',
                // 'toolbar'   =>  'full',
            // ),
        // );
		if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => $this->input->post("category"),
				"content" => $this->input->post("content"),
                "image" => $image,
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				//"language" => $this->input->post("language"),
				"type" => $this->input->post("type"),
				"create_time" => time(),
			);
			$this->newsmodel->create($data);
			redirect(base_url() . "admin/news");
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/news/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['newscategory'] = $this->newscategorymodel->read(array(),array(),false);
        $this->data['news'] = $this->newsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = $this->data['news']->image;
            }
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => make_alias($this->input->post("title")),
                "categoryid" => $this->input->post("category"),
                "content" => $this->input->post("content"),
                "image" => $image,
                "description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				// "language" => $this->input->post("language"),
				"type" => $this->input->post("type"),
            );
            $this->newsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/news");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/news/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/news");
            exit();
        }
    }

}