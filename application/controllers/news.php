<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
		// $this->optionData();
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
		
		$this->load->view('home/common/header',  $this->data);
        $this->load->view('home/news_detail');
        $this->load->view('home/common/footer');
    }

}