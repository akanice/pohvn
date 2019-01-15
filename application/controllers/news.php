<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        
		//Get Menu 
        $this->load->model('menusmodel');
		
		$nav_data = $this->menusmodel->read(array('menu_id'=>'1'));
		$this->data['navmenu'] = json_decode(json_encode($nav_data), true);
		$this->data['footermenu'] = $this->menusmodel->read(array('menu_id'=>2));
		$this->data['config_navmenu'] = $this->menusmodel->setup_navmenu();
		$this->data['config_mobilemenu'] = $this->menusmodel->setup_mobilemenu();
		
		//print_r($this->data['config_navmenu']);die();
        $this->load->model('menustermmodel');
        $this->load->model('configsmodel');
        
        //Options
		$this->load->model('optionsmodel');
		$options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
		$this->data['home_logo']								= @$options['home_logo']->value;
        $this->data['tour_banner'] 								= @$options['tour_banner']->value;
        $this->data['home_hotline']							= @$options['home_hotline']->value;
        $this->data['home_short_introduction'] 		= @$options['home_short_introduction']->value;
        $this->data['link_facebook'] 							= @$options['link_facebook']->value;
        $this->data['link_twitter'] 								= @$options['link_twitter']->value;
        $this->data['link_gplus'] 									= @$options['link_gplus']->value;
        $this->data['link_instagram'] 							= @$options['link_instagram']->value;
        $this->data['tour_banner'] 								= @$options['tour_banner']->value;
		
		$this->load->model('newsmodel');
		$this->load->model('newscategorymodel');
    }
    public function index($alias){
		// load data
		$this->data['new'] = $this->newsmodel->read(array('alias'=>$alias),array(),true);
		$this->data['title'] = $this->data['new']->title;
		$categoryid = json_decode($this->data['new']->categoryid);
		
		foreach ($categoryid as $n=>$value) {
			$this->data['category'][$n] = $cat_data = $this->newscategorymodel->read(array('id'=>$value),array(),true); 
			if ($cat_data->parent_id==null or $cat_data->parent_id==0)  {$cat_chosen  = $value;}
		}
		$this->load->model('usersmodel');
		$author_id = $this->data['new']->author_id;
		$this->data['author'] = $this->usersmodel->read(array('id'=>$author_id),array(),true);
		$this->data['most_viewed'] = $this->newsmodel->read(array(),array('count_view'=>false),false,5);
		$this->data['related_news'] = $this->newsmodel->getRelatedNews($cat_chosen,5);
		
		
		if ($this->data['new']->type == 'default') {
			$this->load->view('home/common/header',  $this->data);
			$this->load->view('home/news_detail');
			$this->load->view('home/common/footer');
		} else {
			$this->load->view('home/template/landing_page', $this->data);
		}
    }
	
	public function category($alias) {
        $news_category = $this->newscategorymodel->read(array('alias'=>$alias),array(),true);

		$total = $this->newsmodel->readCountNew($news_category->id);
		// print_r($total);die();
		$per_page = 6;
		$this->configPagination($slug='category',$per_page,$alias,$total);
        $page_number = $this->uri->segment(3);
        if (empty($page_number)) $page_number = 1;
        $start = ($page_number - 1) * $per_page;
        $this->data['page_links'] = $this->pagination->create_links();

        $this->data['news'] = $this->newsmodel->read(array('categoryid'=>$news_category->id),array(),false,$per_page,$start);
	
        if (empty($this->data['products'])) {
			$this->data['title'] = 'Sản phẩm'	;
		} else {
			$this->data['title'] = 'Sản phẩm | '.$this->data['current_category']->name;
		}
		
		$this->data['meta_keywords']    = $news_category->meta_keywords;
		$this->data['meta_description']	= $news_category->meta_description;
		
		$this->load->view('home/common/header',$this->data);
        $this->load->view('home/news_list');
        $this->load->view('home/common/footer');
	}

	private function configPagination($slug,$per_page=9,$alias,$total) {
        $this->load->library('pagination');
        $config['base_url'] = base_url().$slug.'/'.$alias;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $config['per_page'] = $per_page;
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
        $this->pagination->initialize($config);
	}
}