<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class NewsCategory extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('newscategorymodel');
        $this->load->model('configsmodel');
		$this->load->library('auth');
	}
    public function index(){
        $this->data['title']    = 'Quản lý danh mục tin tức';
        $total = $this->newscategorymodel->readCountNewsCategories();
        $this->data['title'] = $this->input->get('title');
        if($this->data['title'] != ""){
            $config['suffix'] = '?title='.urlencode($this->data['title']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/newscategory/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 4;
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
            $this->data['list'] = $this->newscategorymodel->read(array('title'=>'%'.$this->data['title'].'%'),array('id'=>true),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->newscategorymodel->read(array(),array('id'=>true),false,$config['per_page'],$start);
        }
		
		$this->data['result'] = $this->newscategorymodel->get_categories($config['per_page'],$start);
		
        $this->data['base'] = site_url('admin/newscategory/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/newscategory/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
		$this->data['title'] = 'Thêm mới chuyên mục bài viết';
		$this->data['categories'] = $this->newscategorymodel->get_categories('','');
		if($this->input->post('submit') != null){
            $data = array(
                "title" => $this->input->post("title"),
                "alias" => make_alias($this->input->post("title")),
                "parent_id" => $this->input->post("parent_id"),
                "banner_top_display" => $this->input->post("banner_top_display"),
                "banner_bottom_display" => $this->input->post("banner_bottom_display"),
			);
            $id = $this->newscategorymodel->create($data);
			$data_array = array(
				array(
					"term" => 'category',
					"name" => 'slogan',
					"term_id" => $id,
					"value" => '&nbsp;',
				),
				array(
					"term" => 'category',
					"name" => 'banner',
					"term_id" => $id,
					"value" => '/assets/uploads/images/banners/3.jpg',
				),
				array(
					"term" => 'category',
					"name" => 'featured_new',
					"term_id" => $id,
					"value" => '["0"]',
				),
			);
            $this->configsmodel->create($data_array,true);
            redirect(base_url() . "admin/newscategory");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/newscategory/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
		$this->data['title'] = 'Sửa chuyên mục bài viết';
		$this->data['categories'] = $this->newscategorymodel->get_categories('','');
		$this->data['newscategory'] = $this->newscategorymodel->read(array('id'=>$id),array(),true);
		
        if($this->input->post('submit') != null){
            $data = array(
                "title" => $this->input->post("title"),
                "parent_id" => $this->input->post("parent_id"),
                "alias" => make_alias($this->input->post("title")),
				"banner_top_display" => $this->input->post("banner_top_display"),
                "banner_bottom_display" => $this->input->post("banner_bottom_display"),
			);
            $this->newscategorymodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/newscategory");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/newscategory/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->newscategorymodel->delete(array('id'=>$id));
			// $data_array = array(
				// array(
					// "term" => 'category',
					// "name" => 'slogan',
					// "term_id" => $id,
					// "value" => '&nbsp;',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'banner',
					// "term_id" => $id,
					// "value" => '/assets/uploads/images/banners/3.jpg',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'featured_new',
					// "term_id" => $id,
					// "value" => '["0"]',
				// ),
			// );
			// $this->newscategorymodel->delete(array('term_id'=>$id,'term'=>'category));
            redirect(base_url() . "admin/newscategory");
            exit();
        }
    }

}
