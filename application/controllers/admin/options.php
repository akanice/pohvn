<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Options extends MY_Controller{
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
        $this->load->model('optionsmodel');
	}
    public function index(){
        $this->data['title']    = 'Quản lý tùy chỉnh';
        $total = $this->optionsmodel->readCount(array('name'=>'%'.$this->input->get('name')));
        $this->data['name'] = $this->input->get('name');
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/options/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 15;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        if($this->data['name'] != ""){
            $this->data['list'] = $this->optionsmodel->read(array('name'=>'%'.$this->data['name'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->optionsmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/options/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/options/list');
        $this->load->view('admin/common/footer');
    }

    public function edit($id)
    {
        $option = $this->optionsmodel->read(array('id' => $id),array(),true);
        $value = $option->value;
        if ($option->type == 'advertise'){
            $option->value = json_decode($option->value);
        }

        if ($this->input->post('submit') != null) {
            $uploaddir = 'assets/uploads/';
            if ($option->type == 'file'){
                if (count($_FILES) != 0) {
                    $this->load->library("upload");
                    if (move_uploaded_file($_FILES['value']['tmp_name'], $uploaddir . basename($_FILES['value']['name']))) {
                        $value = $uploaddir . $_FILES['value']['name'];
                    }
                }else{
                    $value = $option->value;
                }
            }elseif($option->type == "advertise"){
                if (count($_FILES) != 0) {
                    $this->load->library("upload");
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir . basename($_FILES['file']['name']))) {
                        $file = $uploaddir . $_FILES['file']['name'];
                    }
                }else{
                    $file = $option->value->file;
                }
                $link = $this->input->post('link');
                $value = json_encode(array('link'=>$link,'file'=>$file));
            }else {
                $value = $this->input->post('value');
            }
            $data = array(
                 'value' => $value,
            );
            $this->optionsmodel->update($data, array('id' => $id));
            redirect(base_url() . "admin/options");
            exit();
        }

        $this->data['option'] = $option;

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/options/edit');
        $this->load->view('admin/common/footer');
    }
}