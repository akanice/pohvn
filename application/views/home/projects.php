<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Projects extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->load->model('projectsmodel');
	}
    public function index(){
        $this->data['title']    = 'Quản lý các dự án';
		$this->data['name'] = $this->input->get('name');
        $this->data['display'] = $this->input->get('display');
        $total = $this->projectsmodel->getCountProjects($this->input->get('name'),$this->input->get('display'));
        if($this->data['name'] != "" || $this->data['display'] != ""){
            $config['suffix'] = '?name='.urlencode($this->data['name']).'&display='.urlencode($this->data['display']);
        }
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/projects/';
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
            $this->data['list'] = $this->projectsmodel->getListProjects($this->input->get('name'),$this->input->get('display'),$config['per_page'],$start);
        }else{
            $this->data['list'] = $this->projectsmodel->getListProjects("","",$config['per_page'],$start);
        }
        $this->data['base'] = site_url('admin/projects/');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/projects/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/projects/';
            $this->load->library("upload");

            //Upload cover image
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = '';
            }
            //Create cover thumb
            if ($image != '') {
				$dir_thumb = 'assets/uploads/thumb/projects/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 450;
				$config2['height'] = 450;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$cover_image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
                $cover_image_thumb = 'assets/img/sample_thumb.png';
			}
            $gallery = array();
            foreach($_FILES['gallery']['name'] as $n => $name) {
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$n], $uploaddir . basename($_FILES['gallery']['name'][$n])))
                {
                    $gallery[] = $uploaddir . $_FILES['gallery']['name'][$n];
                }
            }
            $data = array(
                "name" 				=> $this->input->post("name"),
				"alias" 			=> make_alias($this->input->post("name")),
                "image" 	   		=> $image,
                "thumb" 			=> $cover_image_thumb,
                "short_des" 		=> $this->input->post("short_des"),
                "description" 		=> $this->input->post("description"),
                "gallery" 		    => json_encode($gallery),
                "meta_title"		=> $this->input->post("meta_title"),
                "meta_description"	=> $this->input->post("meta_description"),
                "meta_keywords"		=> $this->input->post("meta_keywords"),
                "display"			=> $this->input->post("display"),
                "create_time"       => time(),
            );
            $this->projectsmodel->create($data);
            redirect(base_url() . "admin/projects");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/projects/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['projects'] = $service = $this->projectsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/projects/';
            $this->load->library("upload");
			
            //Upload cover image
			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
				$image = $uploaddir . $_FILES['image']['name'];
			} else {
				$image = $service->image;
			}
			//Create cover thumb
			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name'])) || $image == $uploaddir . $_FILES['image']['name']) {
				$dir_thumb = 'assets/uploads/thumb/projects/';
				if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb,0777,true);
				$this->load->library('image_lib');
				$config2 = array();
				$config2['image_library'] = 'gd2';
				$config2['source_image'] = $image;
				$config2['new_image'] = $dir_thumb;
				$config2['create_thumb'] = TRUE;
				$config2['maintain_ratio'] = TRUE;
				$config2['width'] = 450;
				$config2['height'] = 450;
				$this->image_lib->clear();
				$this->image_lib->initialize($config2);
				if(!$this->image_lib->resize()){
					print $this->image_lib->display_errors();
				}else{
					$cover_image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$cover_image_thumb = $service->thumb;
			}

            $service->gallery = @json_decode($service->gallery);
            if (!$service->gallery) $service->gallery = array();
            $deletePic = $this->input->post('deletePic');
            if (!$deletePic) $deletePic = array();
            $tmp = array();
            foreach ($service->gallery as $i => $img){
                if (!in_array($i,$deletePic)){
                    $tmp[] = $img;
                }
            }

            $gallery = array();
            foreach($_FILES['gallery']['name'] as $n => $name) {
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$n], $uploaddir . basename($_FILES['gallery']['name'][$n])))
                {
                    $gallery[] = $uploaddir . $_FILES['gallery']['name'][$n];
                }
            }
            $gallery = array_merge($tmp,$gallery);
			$tag_input = $this->input->post("tag");
			if (($tag_input != "") && ($tag_input != null)) {
				$tags = implode(",",$this->input->post("tag"));
			} else {
				$tags = '';
			}
            $data = array(
                "name" 				=> $this->input->post("name"),
				"alias" 			=> make_alias($this->input->post("name")),
                //"tour_cat_id" 		=> implode(",",$this->input->post("tour_cat_id")),
                "image" 	    	=> $image,
                "thumb" 			=> $cover_image_thumb,
                "short_des" 		=> $this->input->post("short_des"),
                "description" 			=> $this->input->post("description"),
                "gallery" 		    => json_encode($gallery),
                "meta_title"		=> $this->input->post("meta_title"),
                "meta_title"		=> $this->input->post("meta_title"),
                "meta_description"	=> $this->input->post("meta_description"),
                "meta_keywords"		=> $this->input->post("meta_keywords"),
                "display"			=> $this->input->post("display"),
                "create_time"       => time(),
            );
            $this->projectsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/projects");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/projects/edit');
            $this->load->view('admin/common/footer');
        }
    }
	
	public function copytour($id) {
        $this->data['servicescategory'] = $this->servicescategorymodel->read();
		$this->data['tags'] = $this->tagmodel->read();
        $this->data['projects'] = $service = $this->projectsmodel->read(array('id'=>$id),array(),true);
		$this->data['tour_tag'] = explode(',', $this->data['projects']->tag);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/projects/';
            $this->load->library("upload");
			
            //Upload cover image
			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
				$image = $uploaddir . $_FILES['image']['name'];
			} else {
				$image = $service->image;
			}
			//Create cover thumb
			if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name'])) || $image == $uploaddir . $_FILES['image']['name']) {
				$dir_thumb = 'assets/uploads/thumb/projects/';
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
					$cover_image_thumb = $dir_thumb.basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				}
			} else {
				$cover_image_thumb = $service->thumb;
			}

            $service->gallery = @json_decode($service->gallery);
            if (!$service->gallery) $service->gallery = array();
            $deletePic = $this->input->post('deletePic');
            if (!$deletePic) $deletePic = array();
            $tmp = array();
            foreach ($service->gallery as $i => $img){
                if (!in_array($i,$deletePic)){
                    $tmp[] = $img;
                }
            }

            $gallery = array();
            foreach($_FILES['gallery']['name'] as $n => $name) {
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$n], $uploaddir . basename($_FILES['gallery']['name'][$n])))
                {
                    $gallery[] = $uploaddir . $_FILES['gallery']['name'][$n];
                }
            }
            $gallery = array_merge($tmp,$gallery);
			$tag_input = $this->input->post("tag");
			if (($tag_input != "") && ($tag_input != null)) {
				$tags = implode(",",$this->input->post("tag"));
			} else {
				$tags = '';
			}
		
            $data = array(
                "name" 				=> $this->input->post("name"),
				"alias" 			=> $this->input->post("alias"),
                "tour_cat_id" 		=> $this->input->post("tour_cat_id"),
                "image" 	    => $image,
                "thumb" 			=> $cover_image_thumb,
                "tour_sku" 			=> $this->input->post("tour_sku"),
                "rating" 			=> $this->input->post("rating"),
                "short_des" 		=> $this->input->post("short_des"),
                "description" 			=> $this->input->post("description"),
                "itinerary" 		=> $this->input->post("itinerary"),
                "gallery" 		    => json_encode($gallery),
                "depature" 			=> $this->input->post("depature"),
                "destination" 		=> $this->input->post("destination"),
                "regular_price" 	=> $this->input->post("regular_price"),
                "promo_price" 		=> $this->input->post("promo_price"),
                "meta_title"		=> $this->input->post("meta_title"),
                "meta_title"		=> $this->input->post("meta_title"),
                "meta_description"	=> $this->input->post("meta_description"),
                "meta_keywords"		=> $this->input->post("meta_keywords"),
				"featured"			=> $this->input->post("featured"),
                "display"				=> $this->input->post("display"),
				"tag" 		        => $tags,
                "create_time"       => time(),
                "language"          => $this->input->post("language")
            );
            $this->projectsmodel->create($data);
            redirect(base_url() . "admin/projects");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/projects/edit');
            $this->load->view('admin/common/footer');
        }
    }

	
    public function delete($id){
        if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->projectsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/projects");
            exit();
        }
    }

}