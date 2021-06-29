<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        // if($this->session->userdata('admingroup') == "mod"){
            // show_404();
        // }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('tagsmodel');
        $this->load->library('auth');
    }
    public function index(){
        $this->data['title']    = 'Quản lý tags';
        $total = $this->tagsmodel->readCount(array('name'=>'%'.$this->input->get('name').'%'));
        $this->data['name'] = $this->input->get('name');
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/tags/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 20;
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
        if($this->data['name'] != ""){
            $this->data['list'] = $this->tagsmodel->read(array('name'=>'%'.$this->data['name'].'%'),array('id'=>false),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->tagsmodel->read(array(),array('id'=>false),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/tags/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/tags/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $alias = make_alias($this->input->post("name"));
			$data = array(
                "name"	=> $this->input->post("name"),
                "alias"	=> $alias,
            );
            $id = $this->tagsmodel->create($data);
			$this->tagsmodel->update(array('alias'=>make_alias($alias.'-'.$id)),array('id'=>$id));
            redirect(base_url() . "admin/tags");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/tags/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['tags'] = $this->tagsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $alias = make_alias($this->input->post("name"));
			$data = array(
                "name" => $this->input->post("name"),
				"alias"	=> $alias,
            );
			$this->tagsmodel->update(($data),array('id'=>$id));
			$this->tagsmodel->update(array('alias'=>make_alias($alias.'-'.$id)),array('id'=>$id));
            redirect(base_url() . "admin/tags");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/tags/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id) {
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->tagsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/tags");
            exit();
        }
    }

}