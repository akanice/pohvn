<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class override_404 extends MY_Controller{
    private $data;
    function __construct() {
        parent::__construct();
        //Get Menu 
        $this->load->model('menusmodel');
        $this->load->model('menustermmodel');
        $this->load->model('configsmodel');
        //Set up mega menu
        $nav_menus = $this->menusmodel->read(array('menu_id'=>1));
        $this->data['nav_menus'] = $nav_menus;
		
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
		//widget
		$this->load->model('widgetmodel');
		$this->data['w_footeruser1'] = array_swap_index($this->widgetmodel->read(array('section_name'=>"footeruser1")),'position');
		$this->data['w_footeruser2'] = array_swap_index($this->widgetmodel->read(array('section_name'=>"footeruser2")),'position');
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
