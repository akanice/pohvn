<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class override_404 extends MY_Controller{
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
        //Set up mega menu
        $nav_menus = $this->menusmodel->read(array('menu_id'=>1));
        $this->data['nav_menus'] = $nav_menus;
		$this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
		$this->load->model('optionsmodel');
		$options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
		$this->data['home_logo']					= $options['home_logo']->value;
        $this->data['tour_banner'] 					= $options['tour_banner']->value;
        $this->data['home_hotline']					= $options['home_hotline']->value;
        $this->data['home_short_introduction'] 		= $options['home_short_introduction']->value;
        $this->data['link_facebook'] 				= $options['link_facebook']->value;
        $this->data['link_twitter'] 				= $options['link_twitter']->value;
        $this->data['link_gplus'] 					= $options['link_gplus']->value;
        $this->data['link_instagram'] 				= $options['link_instagram']->value;
		$this->data['global_header_code'] = @$options['global_header_code']->value;
        $this->data['global_footer_code'] = @$options['global_footer_code']->value;

        $this->load->model('newsmodel');
        $this->load->model('newscategorymodel');
		
		$this->load->model('landingpagemodel');
		$this->data['cookies_expires'] = $this->configsmodel->read(array(
				'term' => 'affiliate',
				'name' => 'cookie_time'), array(), true)->value / (24 * 60 * 60);
    }
    
	public function index() {
		$this->data['title'] = 'Page not found';
		$this->data['pagetitle']    = 'Page not found';
		$this->output->set_status_header('404'); 
		
		$this->load->view('home/common/header',$this->data);
        $this->load->view('home/404_page');
        $this->load->view('home/common/footer');
	}
}
