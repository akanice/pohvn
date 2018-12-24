<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Widget extends MY_Controller{
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
        $this->load->model('widgetmodel');
	}
    public function index(){
		$this->load->model('toursmodel');
        $this->data['title']    = 'Tùy chỉnh widget';
		$w_featured_tour = $this->widgetmodel->read(array('section_name'=>"featured_tour"));
		$w_places = $this->widgetmodel->read(array('section_name'=>"places"));
		$w_blogs = $this->widgetmodel->read(array('section_name'=>"blogs"));
		$w_testimonials = $this->widgetmodel->read(array('section_name'=>"testimonials"));
		$w_footeruser1 = $this->widgetmodel->read(array('section_name'=>"footeruser1"));
		$w_footeruser2 = $this->widgetmodel->read(array('section_name'=>"footeruser2"));
		
		$this->data['w_data_featured_tour'] = array_swap_index($w_featured_tour, "position");
		$this->data['featured_tours'] = $this->toursmodel->read(array('featured'=>1));
		
		$this->data['w_places'] = array_swap_index($w_places, "position");
		$this->data['w_blogs'] = array_swap_index($w_blogs, "position");
		$this->data['w_testimonials'] = array_swap_index($w_testimonials, "position");
		$this->data['w_footeruser1'] = array_swap_index($w_footeruser1, "position");
		$this->data['w_footeruser2'] = array_swap_index($w_footeruser2, "position");
		
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/widget/list');
        $this->load->view('admin/common/footer');
    }

    public function edit($id)
    {
        $option = $this->widgetmodel->read(array('id' => $id),array(),true);
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
            $this->widgetmodel->update($data, array('id' => $id));
            redirect(base_url() . "admin/widget");
            exit();
        }

        $this->data['option'] = $option;

        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/widget/edit');
        $this->load->view('admin/common/footer');
    }
}