<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends MY_Controller{
    private $data;
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
	}
    public function index(){
		$this->load->model('newsmodel');
		$this->load->model('newscategorymodel');
		$this->load->model('newsordermodel');
		$this->load->model('configsmodel');
		$news_data = $this->newsmodel->read(array(),array(),false);
		$cats_data = $this->newscategorymodel->read(array(),array(),false);
		// Chỉ được chạy 1 lần duy nhất
		// foreach ($news_data as $item) {
			// $thumb = $item->image;
			// $this->newsmodel->update(array('thumb'=>$thumb),array('id'=>$item->id));
			// echo $item->id.'---';
		// }
		
		// foreach ($news_data as $item) {
			// $cat_id = $item->categoryid;
			// $new_cat_id = explode(',', $cat_id);
			// $new_cat_id = json_encode($new_cat_id);
			// $this->newsmodel->update(array('categoryid'=>$new_cat_id),array('id'=>$item->id));
			// echo $item->id.'---';
		// }
		
		// foreach ($cats_data as $item) {
			// $data_array = array(
				// array(
					// "term" => 'category',
					// "name" => 'slogan',
					// "term_id" => $item->id,
					// "value" => '&nbsp;',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'banner',
					// "term_id" => $item->id,
					// "value" => '/assets/uploads/images/banners/3.jpg',
				// ),
				// array(
					// "term" => 'category',
					// "name" => 'featured_new',
					// "term_id" => $item->id,
					// "value" => '["0"]',
				// ),
			// );
            // $this->configsmodel->create($data_array,true);
			// echo $item->id.'---';
		// }
		
		//Re-order for table: news
		// $i=1;
		// foreach ($news_data as $item) {
			// $this->newsmodel->update(array('order'=>$i),array('id'=>$item->id));
			// $i++;
			// echo $item->id.'---';
		// }
		
		//phpinfo();
		// foreach ($cats_data as $item) {
			// $data = array(
				// 'categoryid' => $item->id,
				// 'news_array' => '["0"]',
			// );
			// $this->newsordermodel->create($data);
		// }

		echo '<br>';
		echo 'Hiện giờ là: '.date('Y-m-d H:i:s', time());
		echo '<hr>';
		
        $this->load->view('admin/cronjob/index');
    }
	
	public function showImage() {
		$this->load->view('admin/cronjob/showImage');
	}
    public function add() {
		$this->data['title']    = 'Thêm mới bài viết';
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
		$this->data['title']    = 'Sửa bài viết';
		$this->data['newscategory'] = $this->newscategorymodel->getSortedCategories();
        $this->data['news'] = $this->newsmodel->read(array('id'=>$id),array(),true);
		$this->data['news']->categoryid = json_decode($this->data['news']->categoryid);
        if($this->input->post('submit') != null){
			$uploaddir = '/assets/uploads/images/articles/';
			if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir,0777,true);
			$this->load->library("upload");
			if(isset($_FILES['image']) && count($_FILES['image']) > 0 && $_FILES['image']['name'] != "") {
				if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
					$image = $uploaddir . $_FILES['image']['name'];
				} else{
					$image = $this->data['news']->image;
					$image_thumb = $this->data['news']->thumb;
				}
				
                //Create thumb
                $dir_thumb = 'assets/uploads/thumb/';
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
                $image = $this->data['news']->image;
                $image_thumb = $this->data['news']->thumb;
            }
			$categories = $this->input->post("category");
            $data = array(
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