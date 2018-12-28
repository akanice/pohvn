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
		$this->data['newscategory'] = $this->newscategorymodel->read();
		
		$total = count($this->newsmodel->getListNews($this->input->get('title'),$this->input->get('category'),"",""));
        $this->data['title'] = $this->input->get('title');
        $this->data['category'] = $this->input->get('category');
        if($this->data['title'] != "" || $this->data['category'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']).'&category='.urlencode($this->data['category']);
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
        if($this->data['title'] != "" || $this->data['category'] != ""){
            $this->data['list'] = $this->newsmodel->getListNews($this->input->get('title'),$this->input->get('category'),$config['per_page'],$start);
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
		$this->data['list_cat_id'] = $this->newscategorymodel->getSortedCategories();
		if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/images/articles/';
            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
			//Create thumb
			if ($image != '') {
				$dir_thumb = 'assets/uploads/images/thumb/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 300;
				$config2['height'] = 300;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$image = 'assets/uploads/sample_thumb.png';
				$image_thumb = 'assets/uploads/sample_thumb.png';
			}
			$categories = $this->input->post("category");
            $data = array(
				"order" => 1,
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => json_encode($categories),
				"content" => $this->input->post("content"),
                "image" => $image,
				"thumb" => $image_thumb,
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => $this->input->post("type"),
				"create_time" => time(),
			);
			//print_r($data);die();
			$news_id = $this->newsmodel->create($data);
			$this->newsmodel->update(array('order'=>$news_id),array('id'=>$news_id));
			
			redirect(base_url() . "admin/news");
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/news/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['newscategory'] = $this->newscategorymodel->getSortedCategories();
        $this->data['news'] = $this->newsmodel->read(array('id'=>$id),array(),true);
		$this->data['news']->categoryid = json_decode($this->data['news']->categoryid);
        if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/images/articles/';
            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            } else{
                $image = $this->data['news']->image;
            }
			//Create thumb
			if ($image != '') {
                $dir_thumb = 'assets/uploads/images/thumb/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
                $this->load->library('image_lib');
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $image;
                $config2['new_image'] = $dir_thumb;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 300;
                $config2['height'] = 300;
                $this->image_lib->clear();
                $this->image_lib->initialize($config2);
                if(!$this->image_lib->resize()){
                    print $this->image_lib->display_errors();
                }else{
                    $image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                }
            }else{
                $image = $this->data['news']->image;
                $image_thumb = $this->data['news']->thumb;
            }
			
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => make_alias($this->input->post("title")),
                "categoryid" => $this->input->post("category"),
                "content" => $this->input->post("content"),
                "image" => $image,
				"thumb" => $image_thumb,
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