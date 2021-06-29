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
	public $data = array();

	public function __construct() {
		parent::__construct();
		$this->checkUrlRedirect();
		$this->redirect_url_without_slash();
		$this->optionData();
		$this->get_poh_affiliate();
		$this->_checkAdmin();
	}
	public function optionData() {
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
		
		$this->data['top_banner_desktop'] = @$options['top_banner_desktop']->value;
		$this->data['top_banner_mobile'] = @$options['top_banner_mobile']->value;
	}
	
	private function get_poh_affiliate() {
		$this->data['poh_affi'] = $this->input->get('poh');
		if (@$this->data['poh_affi'] && @$this->data['poh_affi'] != '') {
			return $this->data['poh_affi'];
		} else {
			return false;
		}
		
	}
	
	private function checkUrlRedirect() {
		$this->load->model('urlsmodel');
		$current_url = $this->gen_url();
		
		$check_url = $this->urlsmodel->read(array('old_url'=>$current_url),array(),true);
		if ($check_url && $check_url->new_url != '') {
			redirect($check_url->new_url, 'location', $check_url->type);
		}
		return false;
	}
	
	private function gen_url() {
		if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
			$request_url = 'https';
		} else {
			$request_url = 'http';
		}
		$request_url.= '://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		return $request_url;
	}
	
	public function redirect_url_without_slash() {
		$url = $this->gen_url();
		if ($url == site_url()) {
			return false;
		}
		if(strrev($url)[0]==='/') {
			$url = rtrim( $url, '/' );
			redirect($url, 'location', 301);
		}
		return false;
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
	
	// Sendmail function
	public function sendmail($datamail,$attach_file_path,$template,$subject) {
		$this->load->library('email');
		$this->load->config('a4r_mail', TRUE);
		
        $config['protocol'] = $this->config->item('protocol', 'a4r_mail');
		$config['smtp_host'] = $this->config->item('smtp_host', 'a4r_mail');
        $config['smtp_port'] = $this->config->item('smtp_port', 'a4r_mail');
        $config['smtp_user'] = $this->config->item('smtp_user', 'a4r_mail');
        $config['smtp_pass'] = $this->config->item('smtp_pass', 'a4r_mail');
		$config['mailtype'] = $this->config->item('mailtype', 'a4r_mail');
        $this->email->initialize($config);
		
        $this->email->from($this->config->item('admin_email', 'a4r_mail'), $this->config->item('site_title', 'a4r_mail'));
        $list = array('hoangviet11088@gmail.com','phucvu@poh.vn');
        $this->email->to($list);
        if (@$subject != '') {$this->email->subject($this->config->item($subject, 'a4r_mail'));}
        $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item($template, 'a4r_mail'), $datamail, true);
        $this->email->message($message);
		if (@$attach_file_path != '') {$this->email->attach($attach_file_path); }
        if ($this->email->send()) {
            return true;
        } else {
			echo $this->email->print_debugger();
			return false;
		}
	}
}

?>
