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
	
}

?>
