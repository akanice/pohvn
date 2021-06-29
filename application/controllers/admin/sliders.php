<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliders extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
		$this->checkCookies();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('slidersmodel');
    }
    public function index(){
        $this->data['title']    = 'Quản lý Slider';
        $total = $this->slidersmodel->readCount(array('name'=>'%'.$this->input->get('name').'%'));
        $this->data['name'] = $this->input->get('name');
        if($this->data['name'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/sliders/';
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
        if($this->data['name'] != ""){
            $this->data['list'] = $this->slidersmodel->read(array('name'=>'%'.$this->data['name'].'%'),array(),false,$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->slidersmodel->read(array(),array(),false,$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/sliders/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/sliders/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/slider/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
			if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/slider/';
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
					//echo $thumb;
					//die('---');
				}
			} else {
                $thumb = 'assets/img/blog_cover2.jpg';
			}
            $data = array(
                "name" 	=> $this->input->post("name"),
                "show" 	=> $this->input->post("show"),
				"link" 	=> $this->input->post("link"),
                "image" => $image,
				"thumb" => $thumb,
            );
            $this->slidersmodel->create($data);
            redirect(base_url() . "admin/sliders");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/sliders/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['slider'] = $this->slidersmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/slider/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = $this->data['slider']->image;
            }
			//Create cover thumb
            if ($image != $this->data['slider']->image) {
                $dir_thumb = 'assets/uploads/thumb/slider/';
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
                $thumb = $this->data['slider']->thumb;
            }
			
            $data = array(
                "name" => $this->input->post("name"),
                "show" => $this->input->post("show"),
                "link" => $this->input->post("link"),
                "image" => $image,
				"thumb" => $thumb,
            );
            $this->slidersmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/sliders");
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/sliders/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->slidersmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/sliders");
            exit();
        }
    }

}