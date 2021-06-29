<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Configs extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->checkCookies();
        if ($this->session->userdata('admingroup') == "mod") {
            show_404();
        }
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('configsmodel');
        $this->load->library('auth');
    }

    public function index() {
        $this->load->model('newscategorymodel');
        $this->data['title'] = 'Cài đặt hiển thị website';
        $total = $this->configsmodel->readCount(array('name' => '%' . $this->input->get('name') . '%'));
        $this->data['name'] = $this->input->get('name');
        $cat_array_id = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true)->value;
        if ($cat_array_id) {
            $array = json_decode($cat_array_id);
            $this->data['cat_display'] = $this->newscategorymodel->read(array("id" => $array), array(), false, false);
        }
        $this->data['cookie_time'] = $this->configsmodel->read(array(
            'term' => 'affiliate',
            'name' => 'cookie_time'), array(), true);
		
		$this->data['box_content'] = $this->configsmodel->read(array(
            'term' => 'new_footer'), array(), false);

        $this->data['base'] = site_url('admin/configs/');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/configs/list');
        $this->load->view('admin/common/footer');
    }

    public function add() {
        if ($this->input->post('submit') != null) {
            $uploaddir = 'assets/uploads/slider/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            } else {
                $image = '';
            }
            if ($image != '') {
                $dir_thumb = 'assets/uploads/thumb/slider/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb, 0777, true);
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
                if (!$this->image_lib->resize()) {
                    print $this->image_lib->display_errors();
                } else {
                    $thumb = $dir_thumb . basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    //echo $thumb;
                    //die('---');
                }
            } else {
                $thumb = 'assets/img/blog_cover2.jpg';
            }
            $data = array(
                "name"  => $this->input->post("name"),
                "show"  => $this->input->post("show"),
                "link"  => $this->input->post("link"),
                "image" => $image,
                "thumb" => $thumb,
            );
            $this->configsmodel->create($data);
            redirect(base_url() . "admin/sliders");
            exit();
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/sliders/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id) {
        $this->data['slider'] = $this->configsmodel->read(array('id' => $id), array(), true);
        if ($this->input->post('submit') != null) {
            $uploaddir = 'assets/uploads/slider/';
            $this->load->library("upload");
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            } else {
                $image = $this->data['slider']->image;
            }
            //Create cover thumb
            if ($image != $this->data['slider']->image) {
                $dir_thumb = 'assets/uploads/thumb/slider/';
                if (!file_exists($dir_thumb) || !is_dir($dir_thumb)) mkdir($dir_thumb, 0777, true);
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
                if (!$this->image_lib->resize()) {
                    print $this->image_lib->display_errors();
                } else {
                    $thumb = $dir_thumb . basename($_FILES['image']['name'], '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)) . '_thumb.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                }
            } else {
                $thumb = $this->data['slider']->thumb;
            }

            $data = array(
                "name"  => $this->input->post("name"),
                "show"  => $this->input->post("show"),
                "link"  => $this->input->post("link"),
                "image" => $image,
                "thumb" => $thumb,
            );
            $this->configsmodel->update($data, array('id' => $id));
            redirect(base_url() . "admin/sliders");
            exit();
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/sliders/edit');
            $this->load->view('admin/common/footer');
        }
    }

    public function editHomeSlider() {
        $this->load->model('newsmodel');
        $this->data['news'] = $this->newsmodel->read(array('type' => 'default'), array('id' => false), false);
        $this->data['slider_block_new'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'slider_block'));
        if ($this->input->post('submit') != null) {
            for ($i = 1; $i <= 5; $i++) {
                if ($this->input->post('slider_block_' . $i)) {
                    $data = array('value' => $this->input->post('slider_block_' . $i));
                    //print_r($data);
                    $this->configsmodel->update($data, array(
                        'term'    => 'home',
                        'name'    => 'slider_block',
                        'term_id' => $i));
                }
            }

            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            $this->data['news'] = $this->newsmodel->read(array('type' => 'default'), array('id' => false), false);
            $this->data['slider_block_new'] = $this->configsmodel->read(array(
                'term' => 'home',
                'name' => 'slider_block'));

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editHomeSlider');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editHomeSlider');
            $this->load->view('admin/common/footer');
        }
    }

    public function editCatHome() {
        $this->load->model('newscategorymodel');
        $this->data['home_cat_available'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true);
        $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);
        $this->data['categories'] = $this->newscategorymodel->read(array());
        if ($this->input->post('submit') != null) {
            $cat_available = $this->input->post("cat_available");

            $data = array(
                'value' => json_encode($cat_available),
            );
            $this->configsmodel->update($data, array(
                'term' => 'home',
                'name' => 'cat_available'));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            $this->data['home_cat_available'] = $this->configsmodel->read(array(
                'term' => 'home',
                'name' => 'cat_available'), array(), true);
            $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editCatHome');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editCatHome');
            $this->load->view('admin/common/footer');
        }
    }

    public function editFeaturedNews() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->data['home_cat_available'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true);
        $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);
        //$this->data['news'][] = new \stdClass;
        foreach ($this->data['home_cat_available'] as $key => $cat_id) {
            $current_featured_news = json_decode($this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'featured_new',
                'term_id' => $cat_id), array(), true)->value);
            $this->data['news'][$key]['current_news_id'] = $current_featured_news;
            $this->data['news'][$key]['content'] = $this->newsmodel->getNewsByCategoryId($cat_id, '', '');
            $this->data['news'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
            $this->data['news'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
        }

        $this->data['categories'] = $this->newscategorymodel->read(array());
        if ($this->input->post('submit') != null) {
            foreach ($this->data['news'] as $cid) {
                if ($this->input->post('cat_' . $cid['cat_id'])) {
                    $value = $this->input->post('cat_' . $cid['cat_id']);
                    $data[$cid['cat_id']] = array(
                        'value' => json_encode($value),
                    );
                    $this->configsmodel->update($data[$cid['cat_id']], array(
                        'term'    => 'category',
                        'name'    => 'featured_new',
                        'term_id' => $cid['cat_id']));
                }
            }

            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            foreach ($this->data['home_cat_available'] as $key => $cat_id) {
                $current_featured_news = json_decode($this->configsmodel->read(array(
                    'term'    => 'category',
                    'name'    => 'featured_new',
                    'term_id' => $cat_id), array(), true)->value);
                $this->data['news'][$key]['current_news_id'] = $current_featured_news;
                $this->data['news'][$key]['content'] = $this->newsmodel->getNewsByCategoryId($cat_id, '', '');
                $this->data['news'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
                $this->data['news'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
            }

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editfeaturednews');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editfeaturednews');
            $this->load->view('admin/common/footer');
        }
    }

    public function editCookieTime() {
        $this->data['cookie_time'] = $this->configsmodel->read(array(
            'term' => 'affiliate',
            'name' => 'cookie_time'), array(), true);
        $this->data['cookie_time'] = (int)$this->data['cookie_time']->value / (24 * 60 * 60);
        if ($this->input->post('submit') != null) {
            $cookie_time = $this->input->post("cookie_time") * (24 * 60 * 60);
            //print_r($cookie_time);die();
            $data = array(
                'value' => (string)$cookie_time,
            );
            //var_dump($data);die();
            $this->configsmodel->update($data, array(
                'term' => 'affiliate',
                'name' => 'cookie_time'));

            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            $this->data['cookie_time'] = $this->configsmodel->read(array(
                'term' => 'affiliate',
                'name' => 'cookie_time'), array(), true);
            $this->data['cookie_time'] = $this->data['cookie_time']->value / (24 * 60 * 60);

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editcookietime');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editcookietime');
            $this->load->view('admin/common/footer');
        }
    }

    public function editSloganCategory() {
        $this->data['title'] = 'Chỉnh sửa slogan tại mỗi category hiển thị tại trang chủ';
		$this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->data['home_cat_available'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true);
        $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);
        foreach ($this->data['home_cat_available'] as $key => $cat_id) {
            $this->data['slogans'][$key]['current_slogan'] = $this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'slogan',
                'term_id' => $cat_id), array(), true)->value;
            $this->data['slogans'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
            $this->data['slogans'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
        }

        if ($this->input->post('submit') != null) {
            foreach ($this->data['slogans'] as $cid) {
                if ($this->input->post('slogan_' . $cid['cat_id'])) {
                    $value = $this->input->post('slogan_' . $cid['cat_id']);
                    $data[$cid['cat_id']] = array(
                        'value' => $value,
                    );
                    if ( $this->configsmodel->read(array('term'=> 'category','name'=> 'slogan','term_id' => $cid['cat_id'])) == null) {
						$data1 = array(
							'term'    => 'category',
							'name'    => 'slogan',
							'term_id' => $cid['cat_id'],
							"value" => $image,
						);
						$this->configsmodel->create($data1);
					} else {
						$this->configsmodel->update($data[$cid['cat_id']], array(
							'term'    => 'category',
							'name'    => 'slogan',
							'term_id' => $cid['cat_id']
						));
					}
                }
            }
            // Update new data
            $this->data['notice'] = 'Cập nhật thành cmn công!';
            foreach ($this->data['home_cat_available'] as $key => $cat_id) {
                $this->data['slogans'][$key]['current_slogan'] = $this->configsmodel->read(array(
                    'term'    => 'category',
                    'name'    => 'slogan',
                    'term_id' => $cat_id), array(), true)->value;
                $this->data['slogans'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
                $this->data['slogans'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
            }

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editSloganCategory');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editSloganCategory');
            $this->load->view('admin/common/footer');
        }
    }

    public function editBannerCategory() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->data['home_cat_available'] = $this->configsmodel->read(array(
            'term' => 'home',
            'name' => 'cat_available'), array(), true);
        $this->data['home_cat_available'] = json_decode($this->data['home_cat_available']->value, true);
        foreach ($this->data['home_cat_available'] as $key => $cat_id) {
            $currentBanner = $this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'banner',
                'term_id' => $cat_id), array(), true);
            $this->data['banner'][$key]['current_banner'] = $currentBanner ? $currentBanner->value : '';
            $catTitle = $this->newscategorymodel->read(array('id' => $cat_id), array(), true);
            $this->data['banner'][$key]['cat_title'] = $catTitle ? $catTitle->title : '';
            $catId = $this->newscategorymodel->read(array('id' => $cat_id), array(), true);
            $this->data['banner'][$key]['cat_id'] = $catId ? $catId->id : '';
        }

        if ($this->input->post('submit') != null) {
            foreach ($this->data['banner'] as $cid) {
                if (isset($_FILES['banner_' . $cid['cat_id']]) && $_FILES['banner_' . $cid['cat_id']]['size'] > 0) {
                    $uploaddir = '/assets/uploads/images/banners';
                    if (!file_exists($uploaddir) || !is_dir($uploaddir)) mkdir($uploaddir, 0777, true);
                    $this->load->library("upload");
                    $from = $_FILES['banner_' . $cid['cat_id']]['tmp_name'];
                    $to = $_SERVER['DOCUMENT_ROOT'] . $uploaddir . '/' . basename($_FILES['banner_' . $cid['cat_id']]['name']);
                    if (move_uploaded_file($from, $to)) {
                        $image = $uploaddir . '/' . $_FILES['banner_' . $cid['cat_id']]['name'];
                        $data[$cid['cat_id']] = array(
                            "value" => $image,
                        );
						if ( $this->configsmodel->read(array('term'=> 'category','name'=> 'banner','term_id' => $cid['cat_id'])) == null) {
							$data1 = array(
								'term'    => 'category',
								'name'    => 'banner',
								'term_id' => $cid['cat_id'],
								"value" => $image,
							);
							$this->configsmodel->create($data1);
						} else {
							$this->configsmodel->update($data[$cid['cat_id']], array(
								'term'    => 'category',
								'name'    => 'banner',
								'term_id' => $cid['cat_id'],
							));
						}
                    }
                }
            }

            $this->data['notice'] = 'Cập nhật thành cmn công!';
            foreach ($this->data['home_cat_available'] as $key => $cat_id) {
                $this->data['banner'][$key]['current_banner'] = $this->configsmodel->read(array(
                    'term'    => 'category',
                    'name'    => 'banner',
                    'term_id' => $cat_id), array(), true)->value;
                $this->data['banner'][$key]['cat_title'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->title;
                $this->data['banner'][$key]['cat_id'] = $this->newscategorymodel->read(array('id' => $cat_id), array(), true)->id;
            }

            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBannerCategory');
            $this->load->view('admin/common/footer');
        } else {
            $this->load->view('admin/common/header', $this->data);
            $this->load->view('admin/configs/editBannerCategory');
            $this->load->view('admin/common/footer');
        }
    }
	
	public function editbox($id='') {
		if ($id && $id != '') { // Edit
			$this->data['box_data'] = $this->configsmodel->read(array(
            'id'=>$id,'term' => 'new_footer',), array(), true);
			if($this->data['box_data']) {
				if ($this->input->post('submit') != null) {
					$data = array('name'=>$this->input->post('name'),'value'=>$this->input->post('content'));
					$this->configsmodel->update($data, array(
						'term'    => 'new_footer',
						'id' => $id,
					));
					
					$this->session->set_flashdata('message', 'Cập nhật thành công');
					
					redirect($_SERVER['REQUEST_URI'], 'refresh'); 
				} else {
					$this->load->view('admin/common/header', $this->data);
					$this->load->view('admin/configs/editBox');
					$this->load->view('admin/common/footer');
				}
			} else {
				show_404();
			}
		} else { // Add new
			if ($this->input->post('submit') != null) {
				$data = array('term'=>'new_footer','name'=>$this->input->post('name'),'value'=>$this->input->post('content'),'term_id'=>'1');
				$n_id = $this->configsmodel->create($data);
				$this->session->set_flashdata('message', 'Cập nhật thành công');
					
				redirect(base_url('admin/configs/editbox/'.$n_id)); 
			}
			$this->load->view('admin/common/header', $this->data);
			$this->load->view('admin/configs/editBox');
			$this->load->view('admin/common/footer');
		}
	}
	
    public function delete($id) {
        if (isset($id) && ($id > 0) && is_numeric($id)) {
            $this->configsmodel->delete(array('id' => $id));
            redirect(base_url() . "admin/sliders");
            exit();
        }
    }

}
