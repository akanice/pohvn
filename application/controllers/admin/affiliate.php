<?php
/**
 * Created by IntelliJ IDEA.
 * User: nghiennet89
 * Date: 12/28/2018
 * Time: 4:39 PM
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Affiliate extends MY_Controller {
	private $data;

	function __construct() {
		parent::__construct();
		$this->auth = new Auth();
		$this->auth->check();
		$this->checkCookies();

		if ($this->session->userdata('admingroup') == "mod") {
			show_404();
		}
		$this->data['email_header'] = $this->session->userdata('adminemail');
		$this->data['all_user_data'] = $this->session->all_userdata();
		$this->load->model('configsmodel');
		$this->load->model('affiliatesmodel');
		$this->load->library('auth');
	}

	public function statistic() {
		$this->data['title'] = 'Affiliate';
		//Pagination
		//$total = count($this->newsmodel->getListLandingpage($this->input->get('title'),"",""));
		$total = count($this->affiliatesmodel->read());
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'admin/affiliate/statistic/';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
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
		$this->data['listAffiliates'] = $this->affiliatesmodel->getListAffiliateTransaction($start, $config['per_page']);
		$this->load->view('admin/common/header', $this->data);
		$this->load->view('admin/affiliate/statistic');
		$this->load->view('admin/common/footer');
	}

    public function users() {
        $this->data['title'] = 'Affiliate';
        //Pagination
        //$total = count($this->newsmodel->getListLandingpage($this->input->get('title'),"",""));
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
        $this->data['users'] = $this->affiliatesmodel->getListAffiliateUsers($start, $config['per_page']);
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/affiliate/users');
        $this->load->view('admin/common/footer');
    }

    public function userAdd() {
	    if(isset($_POST['user_data'])) {
	        return $this->users();
        }
        $this->data['title'] = 'Affiliate';
        $this->data['listUser'] = $this->affiliatesmodel->getListUserAvailForAffi();
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/affiliate/userAdd');
        $this->load->view('admin/common/footer');
    }


}
