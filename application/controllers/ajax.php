<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->data = array();
    }

    public function updateLanguage(){
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $language = $this->input->post('language');
        if($language){
            $this->session->set_userdata(array('language' => $language));
            $result->ok = true;
            $result->msg = 'Ok';
        }
        echo json_encode($result);die();
    }

    public function contact(){
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $content = $this->input->post('content');

        if (!$name){
            $result->msg = 'Bạn chưa điền tên!';
            echo json_encode($result);die();
        }
        if (!$email){
            $result->msg = 'Bạn chưa điền email!';
            echo json_encode($result);die();
        }
        if (!$content){
            $result->msg = 'Bạn chưa điền nội dung!';
            echo json_encode($result);die();
        }

        //Send mail

        $this->load->config('a4r_mail', TRUE);
        $this->load->library('email');
        $config['protocol'] = $this->config->item('protocol', 'a4r_mail');
        $config['smtp_host'] = $this->config->item('smtp_host', 'a4r_mail');
        $config['smtp_port'] = $this->config->item('smtp_port', 'a4r_mail');
        $config['smtp_user'] = $this->config->item('smtp_user', 'a4r_mail');
        $config['smtp_pass'] = $this->config->item('smtp_pass', 'a4r_mail');
        $config['mailtype'] = $this->config->item('mailtype', 'a4r_mail');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->config->item('admin_email', 'a4r_mail'), $this->config->item('site_title', 'a4r_mail'));
        $datamail = array('name'=>$name,'email'=>$email,'content'=>$content);
        $list = array('admin@nhatminhdev.com', 'sales@nhatminhdev.com');
        $this->email->to($list);
        $this->email->subject($this->config->item('email_contact_subject', 'a4r_mail'));
        $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item('email_contact', 'a4r_mail'), $datamail, true);
        $this->email->message($message);
        if($this->email->send()){
            $result->ok = true;
        }else{
            echo $this->email->print_debugger();
            $result->msg = 'Không gửi được mail!';
        };


        echo json_encode($result);die();
    }
    public function booking(){
        $this->load->helper('url');
		$result = new stdClass();
        $result->ok = false;
        $result->msg = '';
		
		$gender = $this->input->post('gender');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $note = $this->input->post('note');
        $tour_name = $this->input->post('tour_name');
        $tour_id = $this->input->post('tour_id');
		$promocode = 'none';

		$this->load->model('ordertourmodel');
		$booking = array();
		$booking['name'] = $name;
		$booking['alias'] = make_alias($gender.'-'.$name);
		$booking['customer_phone'] = $phone;
		$booking['customer_name'] = $name;
		$booking['customer_email'] = $email;
		$booking['customer_note'] = $note;
		$booking['customer_promocode'] = $promocode;
		$booking['tour_id'] = $tour_id;
		$booking['create_time'] = time();

		$r = $this->ordertourmodel->create($booking);
		if (!$r){
			$result->msg = 'Có lỗi xảy ra';
			echo json_encode($result);die();
		}
		// $order_id = $r;
		// $this->load->config('a4r_mail', TRUE);
        // $this->load->library('email');
        // $config['protocol'] = $this->config->item('protocol', 'a4r_mail');
        // $config['smtp_host'] = $this->config->item('smtp_host', 'a4r_mail');
        // $config['smtp_port'] = $this->config->item('smtp_port', 'a4r_mail');
        // $config['smtp_user'] = $this->config->item('smtp_user', 'a4r_mail');
        // $config['smtp_pass'] = $this->config->item('smtp_pass', 'a4r_mail');
        // $config['mailtype'] = $this->config->item('mailtype', 'a4r_mail');
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");
        // $this->email->from($this->config->item('admin_email', 'a4r_mail'), $this->config->item('site_title', 'a4r_mail'));
		// $site_url = site_url();
        // $datamail = array('name'=>$name,'email'=>$email,'gender'=>$gender,'phone'=>$phone,'note'=>$note,'order_id'=>$order_id,'site_url'=>$site_url,'tour_name'=>$tour_name);
        // $list = array('hoangviet11088@gmail.com');
        // $this->email->to($list);
        // $this->email->subject($this->config->item('email_order_subject', 'a4r_mail'));
        // $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item('email_order', 'a4r_mail'), $datamail, true);
        // $this->email->message($message);
        // if($this->email->send()){
            // $result->ok = true;
            // $result->msg = 'Gửi được mail!';
        // }else{
            // echo $this->email->print_debugger();
            // $result->msg = 'Không gửi được mail!';
        // };
		$result->ok = true;
		echo json_encode($result);die();
    }
	
	public function subscribe(){
        $this->load->helper('url');
		$result = new stdClass();
        $result->ok = false;
        $result->msg = '';
		
		$email = $this->input->post('email');

		$this->load->model('subscribermodel');
		$subscribe = array();
		$subscribe['email'] = $email;
		$subscribe['active'] = 1;
		$subscribe['create_time'] = time();

		$r = $this->subscribermodel->create($subscribe);
		if (!$r){
			$result->msg = 'Có lỗi xảy ra';
			echo json_encode($result);die();
		}

		$result->ok = true;
		echo json_encode($result);die();
    }

}