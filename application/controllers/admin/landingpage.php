<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Landingpage extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('newsmodel');
        $this->load->model('landingpagemodel');
		//$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý Landing page';
		//$test = $this->newsmodel->getListlandingpage($this->input->get('title'),$this->input->get('category'),"","");
		
		$total = count($this->newsmodel->getListLandingpage($this->input->get('title'),"",""));
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/landingpage/';
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
            $this->data['list'] = $this->newsmodel->getListLandingpage($this->input->get('title'),$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->newsmodel->getListLandingpage("","",$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/landingpage/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/landingpage/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->load->model('menustermmodel');
		$this->load->model('afflandingconfigmodel');
		$this->data['menus'] = $this->menustermmodel->read(array(),array(),false);
		$this->data['title'] = 'Quản lý Landing Page';
		if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/images/articles/';
            if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
            $this->load->library("upload");

			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
            $data = array(
				"order" => 1,
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => '["0"]',
				"content" => $this->input->post("content"),
                "image" => $image,
                "thumb" => $image,
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => 'landing',
				"count_view" => 0,
				"create_time" => time(),
				"original_date" => time(),
				"author_id" => $this->session->userdata('adminid'),
			);
			//print_r($data);
			$news_id = $this->newsmodel->create($data);
			// die($news_id);
			$this->newsmodel->update(array('order'=>$news_id),array('id'=>$news_id));
			
			$pricingPackage = $this->input->post("pricingPackage");
			$pricingPackage = json_encode($pricingPackage);
			$data2 = array(
				"news_id" => $news_id,
				"total_price" => $this->input->post("total_price"),
				"step_price" => $pricingPackage,
				"code_header" => $this->input->post("code_header"),
				"code_footer" => $this->input->post("code_footer"),
			);
			$landingpage_id = $this->landingpagemodel->create($data2);
			$data3 = array(
				"landingpage_id" => $landingpage_id,
				"type" => $this->input->post("commission_type"),
				"amount" => $this->input->post("commission_value"),
			);
			$this->afflandingconfigmodel->create($data3);
			redirect(base_url() . "admin/landingpage");
			exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/landingpage/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->load->model('menustermmodel');
		$this->load->model('afflandingconfigmodel');
		$this->data['title'] = 'Sửa Landing Page';
		$this->data['menus'] = $this->menustermmodel->read(array(),array(),false);
        $this->data['landingpage'] = $this->newsmodel->read(array('id'=>$id),array(),true);
		$this->data['landingpage_data'] = $this->landingpagemodel->read(array('news_id'=>$this->data['landingpage']->id),array(),true);
		$this->data['landingpage_commission'] = $this->afflandingconfigmodel->read(array('landingpage_id'=>$this->data['landingpage_data']->id),array(),true);
		$this->data['pricingPackage'] = json_decode($this->data['landingpage_data']->step_price);
        if($this->input->post('submit') != null){
            $uploaddir = '/assets/uploads/images/articles/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_title'], $uploaddir . basetitle($_FILES['image']['title']))) {
                $image = $uploaddir . $_FILES['image']['title'];
            }
            else{
                $image = $this->data['landingpage']->image;
            }
            $data = array(
				"order" => 1,
				"title" => $this->input->post("title"),
				"alias" => make_alias($this->input->post("title")),
				"categoryid" => '["0"]',
				"content" => $this->input->post("content"),
                "image" => $image,
                "thumb" => $image,
				"description" => $this->input->post("description"),
				"meta_title" => $this->input->post("meta_title"),
				"meta_description" => $this->input->post("meta_description"),
				"meta_keywords" => $this->input->post("meta_keywords"),
				"type" => 'landing',
				"count_view" => 0,
				"create_time" => time(),
				"original_date" => time(),
				"author_id" => $this->session->userdata('adminid'),
			);
            $this->newsmodel->update($data,array('id'=>$id));
			
			$pricingPackage = $this->input->post("pricingPackage");
			$pricingPackage = json_encode($pricingPackage);
			$data2 = array(
				"total_price" => $this->input->post("total_price"),
				"step_price" => $pricingPackage,
				"code_header" => $this->input->post("code_header"),
				"code_footer" => $this->input->post("code_footer"),
			);
			$this->landingpagemodel->update($data2,array('id'=>$this->data['landingpage_data']->id));
			$data3 = array(
				"type" => $this->input->post("commission_type"),
				"amount" => $this->input->post("commission_value"),
			);
			$this->afflandingconfigmodel->update($data3,array('landingpage_id'=>$this->data['landingpage_data']->id));
			
            redirect(base_url() . "admin/landingpage");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/landingpage/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newsmodel->delete(array('id'=>$id));
            $this->landingpagemodel->delete(array('news_id'=>$id));
            redirect(base_url() . "admin/landingpage");
            exit();
        }
    }

}