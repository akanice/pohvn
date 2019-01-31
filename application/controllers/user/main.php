<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
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

    public function affiliateUserInfo() {
		$this->load->library('auth');
		$this->auth = new Auth();
        $this->auth->checkUserLogin();
		$this->data['affiliate_user'] = $this->auth->getUser();
        $this->data['title'] = 'Dashboard';
        $this->data['meta_title'] = '';
        $this->data['meta_description'] = '';
        $this->data['meta_keywords'] = '';
		
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
        $this->load->view('user/common/header', $this->data);
        $this->load->view('user/affiliate_user_dashboard');
        $this->load->view('user/common/footer');
    }
	
	public function loginUser() {
		$this->data['title'] = @$options['home_meta_title']->value;
		
		$data = array();
        $data['error'] = '';
        if($this->input->post('email') && $this->input->post('pass')){
            $email = $this->input->post('email');
            $email = $this->db->escape_str($email);
            $pass = $this->input->post('pass');
            $this->load->model('usersmodel');
            $userdata = $this->usersmodel->read(array('email'=>$email),array(),true);
            if($userdata){
                for($i = 0; $i < 50; $i++){
                    $pass = md5($pass);
                }
                if($pass === $userdata->password){
                    $this->auth->loginUser($userdata);
					
					$this->load->helper('cookie');
					$cookie_time	=	3600*24*30; // 30 days.
							
				    $this->input->set_cookie('siteAuth_username',$userdata->email,$cookie_time);
				    $this->input->set_cookie('siteAuth_password',$userdata->password,$cookie_time);
					
                    redirect(site_url('affiliate-user'));
                }
            }
            $this->data['error'] = "Tên đăng nhập hoặc mật khẩu không đúng";
        }
        $this->load->view('user/common/header',$this->data);
        $this->load->view('user/login');
        $this->load->view('user/common/footer');
	}
	public function logoutUser() {
		$this->auth->logoutUser();
        redirect(site_url('/'));
	}
}
