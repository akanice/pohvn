<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of MY_Controller
 *
 * @author drkdra
 */
class MY_Controller extends MX_Controller {
	protected $pageTitle = '';
	protected $pageName = '';
	protected $pageIcon = 'home';
	protected $admin = '';

	public function __construct() {
		parent::__construct();
		
		$this->_checkAdmin();
	}
	public function optionData() {
		$this->load->model('optionsmodel');
		$options = array_swap_index($this->optionsmodel->read(), 'name');
        $this->data['options'] = $options;
		$this->data['home_logo']					= @$options['home_logo']->value;
        $this->data['tour_banner'] 					= @$options['tour_banner']->value;
        $this->data['home_hotline']					= @$options['home_hotline']->value;
        $this->data['home_short_introduction'] 		= @$options['home_short_introduction']->value;
        $this->data['link_facebook'] 				= @$options['link_facebook']->value;
        $this->data['link_twitter'] 				= @$options['link_twitter']->value;
        $this->data['link_gplus'] 					= @$options['link_gplus']->value;
        $this->data['link_instagram'] 				= @$options['link_instagram']->value;
        $this->data['tour_banner'] 					= @$options['tour_banner']->value;
	}
	
	private function _checkAdmin(){
		$uri = $this->uri->uri_string();
		if ((strpos($uri,'admin') === 0) && ($uri != 'admin/login')){
			$this->load->model('adminsmodel','AdminModel');
			
			$admin = $this->AdminModel->getAdmin();

			if (!$admin){
				redirect(site_url('admin/login'));
			}else{
				$this->admin = $admin;
			}
		}
	}
	
	public function adminLoadHeader($data=array()){
		$data['pageTitle'] = $this->pageTitle;
		$data['pageName'] = $this->pageName;
		$data['pageIcon'] = $this->pageIcon;
		$data['admin'] = $this->admin;
		
		$this->load->view('admin/header',$data);
	}
	
	public function adminLoadLeftBar($alert=''){
		$data = array();
		$data['admin'] = $this->admin;
		if ($alert){
			$data['alert'] = $alert;
		}
		
		$this->load->view('admin/leftbar',$data);
	}
	
	public function adminLoadFooter(){
		$data = array();
		
		$this->load->view('admin/footer',$data);
	}
	
	public function homeLoadHeader($data=array()){
		$data['pageTitle'] = $this->pageTitle;
		$data['pageName'] = $this->pageName;
		$data['keywords'] = $this->keywords;
		$data['description'] = $this->description;
		$data['options'] = $this->options;
		
		$this->load->view('header',$data);
	}
	
	public function homeLoadFooter(){
		$data = array();
		$this->load->view('footer',$data);
	}
	
	public function checkCookies() {
		$email = $_COOKIE['siteAuth_username'];
		$pass = $_COOKIE['siteAuth_password'];
		$this->load->model('adminsmodel','AdminModel');
		$admin = $this->AdminModel->read(array('email'=>$email),array(),true);
		if($admin){
			if($pass === $admin->password){
				$this->auth->login($admin);
			}
		}
	}
	
	public function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/embed\/|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<div class='embed-responsive embed-responsive-16by9'><iframe  class='embed-responsive-item'  src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe></div>",
			$string
		);
	}
}

?>
