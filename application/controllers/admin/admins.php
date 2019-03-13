<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admins extends MY_Controller{
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
        $this->load->library('form_validation');
        $this->load->model('adminsmodel');
	}
    public function index(){
        $this->data['title']    = 'Admins';
        $total = $this->adminsmodel->readCount(array('email'=>'%'.$this->input->get('email').'%','group'=>'%'.$this->input->get('group').'%'));
        $this->data['email'] = $this->input->get('email');
        $this->data['group'] = $this->input->get('group');
        if($this->data['email'] != "" || $this->data['group'] != ""){
            $config['suffix'] = '?email='.urlencode($this->data['email']).'&group='.urlencode($this->data['group']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/admins/';
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
        if($this->data['email'] != "" || $this->data['group'] != ""){
            $this->data['list'] = $this->adminsmodel->read(array('email'=>'%'.$this->data['email'].'%','group'=>'%'.$this->data['group'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->adminsmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/admins/');
        $this->data['admin_id'] = $this->session->userdata('adminid');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/admins/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'trim|required|matches[password]|md5');
            $this->form_validation->set_message('required', 'Không được bỏ trống');
            $this->form_validation->set_message('matches', 'Mật khẩu nhập lại không khớp');
            if ($this->form_validation->run() == FALSE) {
                $this->data['email'] = $this->input->post("email");
                $this->data['password'] = $this->input->post("password");
                $this->data['repassword'] = $this->input->post("repassword");
                $this->load->view('admin/common/header',$this->data);
                $this->load->view('admin/admins/add');
                $this->load->view('admin/common/footer');
            } else {
                $password = $this->input->post("password");
                for($i = 0; $i < 50; $i++){
                    $password = md5($password);
                }
                $data = array(
                    "email" => $this->input->post("email"),
                    "group" => $this->input->post("group"),
                    "password" => $password,
                    "create_time" => time(),
                );
                $checkEmail = $this->adminsmodel->read(array('email'=>$this->input->post("email")));
                if (count($checkEmail)>0){
                    $this->data['error_email'] = "Địa chỉ email đã tồn tại";
                    $this->load->view('admin/common/header',$this->data);
                    $this->load->view('admin/admins/add');
                    $this->load->view('admin/common/footer');
                } else {
                    $this->adminsmodel->create($data);
                    redirect(base_url() . "admin/admins");
                    exit();
                }
            }
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/admins/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id)
    {
        $this->data['admin'] = $this->adminsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'trim|required|matches[password]|md5');
            $this->form_validation->set_message('required', 'Không được bỏ trống');
            $this->form_validation->set_message('matches', 'Mật khẩu nhập lại không khớp');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/common/header',$this->data);
                $this->load->view('admin/admins/edit');
                $this->load->view('admin/common/footer');
            } else {
                $password = $this->input->post("password");
                for($i = 0; $i < 50; $i++){
                    $password = md5($password);
                }
                $data = array(
                    "email" => $this->input->post("email"),
                    "group" => $this->input->post("group"),
                    "password" => $password,
                );
                $this->adminsmodel->update($data,array('id'=>$id));
                redirect(base_url() . "admin/admins");
                exit();
            }
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/admins/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->adminsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/admins");
            exit();
        }
    }

}