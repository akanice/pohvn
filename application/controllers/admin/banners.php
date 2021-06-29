<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Banners extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('bannersmodel');
	}
    public function index(){
        $this->data['title']    = 'Quản lý Banners';
		//$test = $this->bannersmodel->getListbanners($this->input->get('name'),$this->input->get('category'),"","");
		
		$total = count($this->bannersmodel->getListBanners($this->input->get('title'),"",""));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/banners/';
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
		
        if($this->data['title'] != ""){
            $this->data['list'] = $this->bannersmodel->getListBanners($this->input->get('title'),$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->bannersmodel->getListBanners("",$config['per_page'],$start);
        }
		
        $this->data['base'] = site_url('admin/banners/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/banners/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        $this->data['ckeditor'] = array(
            'id'        =>  'ckeditor',
            'path'      =>  'assets/ckeditor',
            'config'    =>  array(
                'width' =>  '700px',
                'height'=>  '300px',
                'toolbar'   =>  'full',
            ),
        );
		if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/banners/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
			
			//Create image thumb
			if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/banners/';
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
					$thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$thumb = '/assets/img/sample_thumb.png';
			}
			
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"description" => $this->input->post("description"),
				"url" => $this->input->post("url"),
                "image" => $image,
                "thumb" => $thumb,
				"create_time" => time(),
			);
			$this->bannersmodel->create($data);
			redirect(base_url() . "admin/banners");
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/banners/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['banners'] = $this->bannersmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/banners/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = $this->data['banners']->image;
            }
			//Create image thumb
			if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/banners/';
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
					$thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$thumb = '/assets/img/sample_thumb.png';
			}
			
            $data = array(
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"description" => $this->input->post("description"),
				"url" => $this->input->post("url"),
                "image" => $image,
                "thumb" => $thumb,
				"create_time" => time(),
            );
            $this->bannersmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/banners");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/banners/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->bannersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/banners");
            exit();
        }
    }

}