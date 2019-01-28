<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
    private $data;

    function __construct() {
        parent::__construct();

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

    }

    public function index() {
        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
        $this->load->model('configsmodel');

        // load config data
        $configs = array();
        $this->data['cat_available'] = $configs['cat_available'] = $this->configsmodel->read(array('name' => 'cat_available'), array(), true)->value;

        //meta data
        $this->data['title'] = @$options['home_meta_title']->value;
        $this->data['meta_title'] = @$options['home_meta_title']->value;
        $this->data['meta_description'] = @$options['home_meta_description']->value;
        $this->data['meta_keywords'] = @$options['home_meta_keywords']->value;

        $this->load->view('home/common/header', $this->data);

        // Slider data
        $this->data['section_sliders'] = array();
        for ($i = 1; $i <= 5; $i++) {
            $item_id = $this->configsmodel->read(array(
                'term'    => 'home',
                'name'    => 'slider_block',
                'term_id' => $i), array(), true)->value;
            $item = $this->newsmodel->read(array('id' => $item_id), array(), true);
            if ($item) $this->data['section_sliders'][] = $item;
        }

        $this->load->view('home/template/home_slider', $this->data);
        //sections data
        $this->data['section_news'][] = new \stdClass;
        foreach (json_decode($configs['cat_available']) as $item) {
            $this->data['section_news']['parent_cat'] = $this->newscategorymodel->read(array('id' => $item), array(), true);
            $this->data['section_news']['child_cat'] = $this->newscategorymodel->read(array('parent_id' => $item), array(), false);

            $featured_new = $this->configsmodel->read(array(
                'term'    => 'category',
                'name'    => 'featured_new',
                'term_id' => $item), array(), true)->value;
            if ($featured_new) {
                $array = json_decode($featured_new);
                $this->data['section_news']['news_featured'] = $this->newsmodel->read(array("id" => $array), array(), false, false);
            }
            $this->data['section_news']['news_item'] = $this->newsmodel->get_random_news_single($item, 2);
            $this->data['section_news']['slogan'] = $this->configsmodel->read(array(
                "term"    => "category",
                "name"    => "slogan",
                "term_id" => $item), array(), true);
            $this->data['section_news_content'] = $this->load->view('home/template/section_news', $this->data);
        }


        //print_r($this->data['section_news']['news_featured']);
        // print_r($this->data['section_news'][1]['news_item']);
        // die();

        $this->load->view('home/common/footer');
    }

    public function tourSearch() {
        $this->load->model('toursmodel');
        $this->load->model('testimonialsmodel');
        $this->load->model('widgetmodel');

        //sections data
        $this->data['w_data_featured_tour'] = array_swap_index($this->widgetmodel->read(array('section_name' => "featured_tour")), 'position');
        $biggest_tour_id = $this->data['biggest_tour_id'] = $this->data['w_data_featured_tour']['biggest']->value;
        $this->data['biggest_tour'] = $this->toursmodel->read(array('id' => $biggest_tour_id), array(), true);

        $this->data['name'] = $this->input->get('s_keyword');
        $total = $this->toursmodel->getCountTours($this->data['name'], "", "", 1, $this->data['language']);
        if ($this->data['name'] != "") {
            $config['suffix'] = '?keyword=' . urlencode($this->data['name']);
        }
        //Pagination
        $this->load->library('pagination2');
        $config['base_url'] = base_url() . 'search/page/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 8;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<li class='first'>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<li class='last'>";
        $config["last_tag_close"] = "</li>";
        $config["next_link"] = "Next → ";
        $config["next_tag_open"] = "<li class='next'>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "← Prev";
        $config["prev_tag_open"] = "<li class='prev'>";
        $config["prev_tag_close"] = "</li>";
        $config['first_url'] = '1';
        $this->pagination2->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination2->create_links();

        $this->data['tours'] = $this->toursmodel->getListTours(($this->data['name']), "", "", "1", $this->data['language'], $config['per_page'], $start);
        $this->data['testimonials'] = $this->testimonialsmodel->random_rows();
        $this->data['title'] = 'Tìm kiếm';

        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/tour_list');
        $this->load->view('home/common/footer');
    }

    public function tourAll() {
        $this->load->model('toursmodel');
        $this->load->model('tourscategorymodel');
        $this->load->model('tagmodel');
        $this->load->model('testimonialsmodel');
        $total = $this->toursmodel->readCount();
        //Pagination
        $this->load->library('pagination2');
        $config['base_url'] = base_url() . 'tour-du-lich/page';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 4;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = '1';

        $this->pagination2->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination2->create_links();
        $this->data['tours'] = $this->toursmodel->read(array('show' => 1), array(), false, $config['per_page'], $start);
        $biggest_id = $this->widgetmodel->read(array(
            "section_name" => "featured_tour",
            "position"     => "biggest"), array(), true);
        $this->data['biggest_tour'] = $this->toursmodel->read(array("id" => $biggest_id->value), array(), true);

        $this->data['testimonials'] = $this->testimonialsmodel->random_rows();
        $this->data['title'] = 'Tour du lịch - Mai Châu Tourist';
        // $this->data['meta_title'] 				= $tours->meta_title;
        // $this->data['meta_description'] 		= $tours->meta_description;
        // $this->data['meta_keywords'] 			= $tours->meta_keywords;

        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/tour_list');
        $this->load->view('home/common/footer');
    }

    public function tourList($alias) {
        if (!isset($alias) || $alias == '') {
            redirect(base_url('tour-du-lich/'));
        }
        $this->load->model('toursmodel');
        $this->load->model('tourscategorymodel');
        $this->load->model('testimonialsmodel');
        $this->load->model('tagmodel');
        $this->load->model('widgetmodel');

        $tourcategory = $this->data['tourcategory'] = $this->tourscategorymodel->read(array('alias' => $alias), array(), true);
        $total = $this->toursmodel->readCount(array('tour_cat_id' => $tourcategory->id));
        $this->load->library('pagination2');
        $config['base_url'] = base_url() . 'tour-du-lich/' . $alias;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        //$config['first_url'] = '1';

        $this->pagination2->initialize($config);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination2->create_links();

        $this->data['tours'] = $this->toursmodel->getListTours_ByCategory($tourcategory->id, $config['per_page'], $start);
        //$this->data['tours'] = $this->toursmodel->read(array('tour_cat_id'=>$tourcategory->id,'show'=>1),array(),false,$config['per_page'],$start);
        $this->data['testimonials'] = $this->testimonialsmodel->random_rows();

        $biggest_id = $this->widgetmodel->read(array(
            "section_name" => "featured_tour",
            "position"     => "biggest"), array(), true);
        $this->data['biggest_tour'] = $this->toursmodel->read(array("id" => $biggest_id->value), array(), true);

        $this->data['title'] = 'Tour du lịch ' . $tourcategory->name . ' - Mai Châu Tourist';
        $this->data['meta_title'] = $tourcategory->meta_title;
        $this->data['meta_description'] = $tourcategory->meta_description;
        $this->data['meta_keywords'] = $tourcategory->meta_keywords;
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/tour_list');
        $this->load->view('home/common/footer');
    }

    public function tourDetail($alias = null) {
        $this->load->model('toursmodel');
        $this->load->model('tourscategorymodel');
        $this->load->model('testimonialsmodel');
        if (isset($alias) && $alias != '') {
            $tour = $this->toursmodel->read(array('alias' => $alias), array(), true);
            if (!$tour) redirect(base_url());
            $this->data['tour'] = $tour;
            $tour_cat_id = $tour->tour_cat_id;
            $tour_id = $tour->id;

            $this->data['tourcategory'] = $this->tourscategorymodel->read(array('id' => $tour_cat_id), array(), true);
            $this->data['tour_related'] = $this->toursmodel->getRelatedTours($alias, 4);
            $testimonials = $this->data['testimonials'] = $this->testimonialsmodel->read(array('tour_id' => $tour_id), array(), false, 5);
        } else {
            redirect(base_url());
        }
        $this->data['title'] = $tour->name;
        $this->data['meta_title'] = $tour->meta_title;
        $this->data['meta_description'] = $tour->meta_description;
        $this->data['meta_keywords'] = $tour->meta_keywords;
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/tour_detail');
        $this->load->view('home/common/footer');
    }

    public function tagsSearch($alias) {
        $this->load->model('tagmodel');
        $this->data['tags'] = $this->tagmodel->read(array(), array(), false, 25);

        $current_tag = $this->data['current_tag'] = $this->tagmodel->read(array('alias' => $alias), array(), true);
        $this->data['tours_by_tag'] = $this->tagmodel->getToursByTag($current_tag->name, 8);
        $this->data['blogs_by_tag'] = $this->tagmodel->getBlogsByTag($current_tag->name, 8);

        $this->data['title'] = $this->data['current_tag']->name;
        $this->data['meta_title'] = $this->data['current_tag']->name;
        $this->data['meta_description'] = '';
        $this->data['meta_keywords'] = '';
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/tags_search');
        $this->load->view('home/common/footer');
    }

    public function pages($alias) {
        $this->load->model('pagesmodel');
        $this->data['page_data'] = $this->pagesmodel->read(array('alias' => $alias), array(), true);
        $this->data['title'] = $this->data['page_data']->title;
        $this->data['meta_title'] = $this->data['page_data']->title;
        $this->data['meta_description'] = $this->data['page_data']->meta_description;
        $this->data['meta_keywords'] = $this->data['page_data']->meta_keywords;

        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/pages');
        $this->load->view('home/common/footer');
    }

    public function affiliateUserInfo() {
        $this->auth = new auth();
        $this->auth->check();
        $this->data['title'] = 'Dashboard';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        $this->data['meta_keywords'] = '';
        $this->data['affiliate_user'] = $this->auth->getUser();
		print_r($this->data['affiliate_user']);die();
        //-------------page link
        $total = 100;
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/affiliate/';
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = 10;
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
        $page_number = $this->uri->segment(4);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $config['per_page'];
        $this->data['page_links'] = $this->pagination->create_links();
        $this->load->model('affiliatesmodel');
        $this->data['listAffiliates'] = $this->affiliatesmodel->getListAffiliateTransactionOfUser($this->data['affiliate_user'], $start, $config['per_page']);
        $this->data['statisticAffiliate'] = $this->affiliatesmodel->getStatisticAffiliateStatistic($this->data['affiliate_user']);
        $this->load->view('home/common/header', $this->data);
        $this->load->view('home/affiliate_user_dashboard');
        $this->load->view('home/common/footer');
    }
}
