<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller {
    private $data;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->auth = new Auth();
        if ($this->auth->isUserLogin()) {
            $this->data['affiliate_user'] = $this->auth->getUser();
            $this->load->model('usersmodel');
            $this->data['user_profile'] = $this->usersmodel->read(array('id' => $this->data['affiliate_user']['id']), array(), true);
        }
        //Get Menu
        $this->load->model('menusmodel');

        $nav_data = $this->menusmodel->read(array('menu_id' => '1'));
        $this->data['navmenu'] = json_decode(json_encode($nav_data), true);
        $this->data['footermenu'] = $this->menusmodel->read(array('menu_id' => 2));
        $this->data['config_navmenu'] = $this->menusmodel->setup_navmenu();
        $this->data['config_mobilemenu'] = $this->menusmodel->setup_mobilemenu();

        //print_r($this->data['config_navmenu']);die();
        $this->load->model('menustermmodel');
        $this->load->model('configsmodel');

        //Options
        $this->load->model('optionsmodel');
        $options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
        $this->data['home_logo'] = @$options['home_logo']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
        $this->data['home_hotline'] = @$options['home_hotline']->value;
        $this->data['home_short_introduction'] = @$options['home_short_introduction']->value;
        $this->data['link_facebook'] = @$options['link_facebook']->value;
        $this->data['link_twitter'] = @$options['link_twitter']->value;
        $this->data['link_gplus'] = @$options['link_gplus']->value;
        $this->data['link_instagram'] = @$options['link_instagram']->value;
        $this->data['tour_banner'] = @$options['tour_banner']->value;
		$this->data['global_header_code'] = @$options['global_header_code']->value;
        $this->data['global_footer_code'] = @$options['global_footer_code']->value;

        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
		
		$this->load->model('landingpagemodel');
		$this->data['cookies_expires'] = $this->configsmodel->read(array(
				'term' => 'affiliate',
				'name' => 'cookie_time'), array(), true)->value / (24 * 60 * 60);
    }

    public function index($alias) {

        $arrShortCode = array(
            '[banner_top_display]' => 'banner_top',
            '[banner_bottom_display]' => 'banner_bottom'
        );

        $this->add_count($alias);
        // load data
        $this->data['new'] = $this->newsmodel->read(array('alias' => $alias), array(), true);
		if (!isset($this->data['new']) || $this->data['new']== null) {
			redirect(base_url());
		}
		$post_id = $this->data['new']->id;
        $content = $this->data['new']->content;
		$this->data['new']->content = $this->convertYoutube($content);
        //TODO - do short code here
        foreach($arrShortCode as $shortCodeStr => $funcName) {
            $shortCodePos = strrpos($content, $shortCodeStr);
            if($shortCodePos !== false) {
                do {
                    $contentBefore = substr($content, 0, $shortCodePos);
                    $contentShortCode = $this->$funcName($post_id);
                    $contentAfter = substr($content, $shortCodePos + strlen($shortCodeStr));
                    $content = $contentBefore.$contentShortCode.$contentAfter;
                    $shortCodePos = strrpos($content, $shortCodeStr);
                } while ($shortCodePos !== false);
            }
        }
        
        if (isset($this->data['new']) && ($this->data['new'] != '')) {
            $new_id = $this->data['new']->id;

            if ($this->data['new']->type == 'default') {
                $this->data['title'] = $this->data['new']->title;
				$this->data['meta_image'] = base_url($this->data['new']->image);
                $categoryid = json_decode($this->data['new']->categoryid);

                foreach ($categoryid as $n => $value) {
                    $this->data['category'][$n] = $cat_data = $this->newscategorymodel->read(array('id' => $value), array(), true);
                    if ($cat_data->parent_id == null or $cat_data->parent_id == 0) {
                        $cat_chosen = $value;
                    }
                }
                $this->load->model('adminsmodel');
                $author_id = $this->data['new']->author_id;
                $this->data['author'] = $this->adminsmodel->read(array('id' => $author_id), array(), true);
                $this->data['most_viewed'] = $this->newsmodel->read(array(), array('count_view' => false), false, 5);
                $this->data['related_news'] = $this->newsmodel->getRelatedNews($cat_chosen, 5);
                $this->load->view('home/common/header', $this->data);
                $this->load->view('home/news_detail');
                $this->load->view('home/common/footer');
            } else {
                $this->data['title'] = $this->data['new']->title;
                $this->data['landing_data'] = $this->landingpagemodel->read(array('news_id' => $new_id), array(), true);
                $this->load->view('home/common/header_landing', $this->data);
                $this->load->view('home/template/landing_page');
                $this->load->view('home/common/footer_landing');
            }
        } else {
            redirect('404_override');
        }
    }

    function add_count($alias) {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has alias name
        $check_visitor = $this->input->cookie(urldecode($alias), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used alias for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"   => urldecode($alias),
                "value"  => "$ip",
                "expire" => time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->newsmodel->update_counter(urldecode($alias));
        }
    }

    public function category($alias) {
        $this->data['news_category'] = $news_category = $this->newscategorymodel->read(array('alias' => $alias), array(), true);
		$this->load->model('newsordermodel');
		$news_array = $this->newsordermodel->read(array('categoryid'=>$this->data['news_category']->id),array(),true)->news_array;
		$news_array = json_decode($news_array);
        $total = $this->newsmodel->readCountNew($news_category->id);
        $per_page = 12;
        $this->configPagination($slug = 'category', $per_page, $alias, $total);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['news'] = $this->newsmodel->getListNews('', $news_array, $news_category->id, $per_page, $start);
        if (empty($news_category->title)) {
            $this->data['title'] = 'Chuyên mục';
        } else {
            $this->data['title'] = 'Chuyên mục- ' . $news_category->title;
        }

        $this->data['most_viewed'] = $this->newsmodel->read(array('type'=>'normal'), array('count_view' => false), false, 5);

        $this->data['meta_keywords'] = $news_category->meta_keywords;
        $this->data['meta_description'] = $news_category->meta_description;

        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/news_list');
        $this->load->view('home/common/footer');
    }

    private function configPagination($slug, $per_page = 9, $alias, $total) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . $slug . '/' . $alias;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = $per_page;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active page-item'><a href='#' class='page-link'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["first_link"] = "Đầu";
        $config["first_tag_open"] = "<li class='first'>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "Cuối";
        $config["last_tag_open"] = "<li class='last'>";
        $config["last_tag_close"] = "</li>";
        $config["next_link"] = "Tiếp → ";
        $config["next_tag_open"] = "<li class='next'>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "← Trước";
        $config["prev_tag_open"] = "<li class='prev'>";
        $config["prev_tag_close"] = "</li>";
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
    }

    public function news_search() {
        //$this->data['prod_cat'] = $this->productcategorymodel->read();
        $this->data['name'] = $this->input->get('s_keyword');
        $total = $this->newsmodel->getCountNew($this->data['name'], '', '', '');
        $per_page = 6;
        if ($this->data['name'] != "") {
            $config['suffix'] = '?keyword=' . urlencode($this->data['name']);
        }
        //Pagination
        $this->configPagination($slug = 'search', $per_page, $alias = 'page', $total);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['result'] = $this->newsmodel->getNewsSearch($this->data['name'], '', $per_page, $start);
        //print_r($this->data['result']);die();
        $this->data['title'] = 'Search: ' . $this->input->get('s_keyword');

        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/news_search');
        $this->load->view('home/common/footer');
    }

    private function banner_bottom($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_bottom_display;
		return $html;
    }
    private function banner_top($post_id) {
        $cat_id = json_decode($this->newsmodel->read(array('id'=>$post_id),array(),true)->categoryid);
		$k = array_rand($cat_id);
		$category_id = $cat_id[$k];
		$html = $this->newscategorymodel->read(array('id'=>$category_id),array(),true)->banner_top_display;
		return $html;
    }
	
}
