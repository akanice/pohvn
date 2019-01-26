<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function updateLanguage() {
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $language = $this->input->post('language');
        if ($language) {
            $this->session->set_userdata(array('language' => $language));
            $result->ok = true;
            $result->msg = 'Ok';
        }
        echo json_encode($result);
        die();
    }

    public function contact() {
        $result = new stdClass();
        $result->ok = false;
        $result->msg = '';

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $content = $this->input->post('content');

        if (!$name) {
            $result->msg = 'Bạn chưa điền tên!';
            echo json_encode($result);
            die();
        }
        if (!$email) {
            $result->msg = 'Bạn chưa điền email!';
            echo json_encode($result);
            die();
        }
        if (!$content) {
            $result->msg = 'Bạn chưa điền nội dung!';
            echo json_encode($result);
            die();
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
        $datamail = array(
            'name'    => $name,
            'email'   => $email,
            'content' => $content);
        $list = array(
            'admin@nhatminhdev.com',
            'sales@nhatminhdev.com');
        $this->email->to($list);
        $this->email->subject($this->config->item('email_contact_subject', 'a4r_mail'));
        $message = $this->load->view($this->config->item('email_templates', 'a4r_mail') . $this->config->item('email_contact', 'a4r_mail'), $datamail, true);
        $this->email->message($message);
        if ($this->email->send()) {
            $result->ok = true;
        } else {
            echo $this->email->print_debugger();
            $result->msg = 'Không gửi được mail!';
        };


        echo json_encode($result);
        die();
    }

    public function booking() {
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
        $booking['alias'] = make_alias($gender . '-' . $name);
        $booking['customer_phone'] = $phone;
        $booking['customer_name'] = $name;
        $booking['customer_email'] = $email;
        $booking['customer_note'] = $note;
        $booking['customer_promocode'] = $promocode;
        $booking['tour_id'] = $tour_id;
        $booking['create_time'] = time();

        $r = $this->ordertourmodel->create($booking);
        if (!$r) {
            $result->msg = 'Có lỗi xảy ra';
            echo json_encode($result);
            die();
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
        echo json_encode($result);
        die();
    }

    public function subscribe() {
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
        if (!$r) {
            $result->msg = 'Có lỗi xảy ra';
            echo json_encode($result);
            die();
        }

        $result->ok = true;
        echo json_encode($result);
        die();
    }

    public function createOrder() {
        $this->load->model('ordersmodel');
        $this->load->model('customersmodel');
        $this->load->model('affiliatesmodel');
        $affiliateUserId = isset($_COOKIE['affiliate_user_id']) ? intval($_COOKIE['affiliate_user_id']) : null;
        $landingpageId = $_COOKIE['landing_page_id'];
        $orderData = (array)$_POST['order'];
        $customerData = (array)$_POST['customer'];
        $customer = $this->customersmodel->createNewCustomer($customerData);
        if (!$customer) die(json_encode(array(
            'success' => false,
            'code'    => 'customer_fail',
            'message' => 'Error when create customer'
        )));
        $affiliateTransaction = null;
        if ($affiliateUserId) {
            $affiliateTransaction = $this->affiliatesmodel->createAffiliateTransaction($landingpageId, $affiliateUserId, $orderData['total_price']);
            $this->affiliatesmodel->updateAffiliatestatistic($affiliateUserId, 'order');
            if (!$affiliateTransaction) die(json_encode(array(
                'success' => false,
                'code'    => 'affiliate_transaction_fail',
                'message' => 'Error when create affiliate transaction'
            )));
        }

        $orderData['sale_id'] = null;
        $orderData['customer_id'] = $customer['id'];
        $orderData['affiliate_transaction_id'] = $affiliateTransaction ? $affiliateTransaction['id'] : null;
        $order = $this->ordersmodel->createNewOrder($orderData);
        if (!$order) die(json_encode(array(
            'success' => false,
            'code'    => 'order_fail',
            'message' => 'Error when create order'
        )));
        die(json_encode(array(
            'success' => true,
            'code'    => '',
            'message' => 'Order created'
        )));
    }

    public function calculate_date() {
        $first_date = $_POST['first_date'];
        $id = $_POST['id'];
        $today = time();
        $current_date = date('d/m/Y');

        $date1 = date_create_from_format("d/m/Y", $first_date);
        $first_date = date_format($date1, "Y-m-d");
        $first_date = strtotime($first_date);
        $date2 = date_create_from_format("d/m/Y", $current_date);
        $second_date = date_format($date2, "Y-m-d");
        $second_date = strtotime($second_date);

        $datediff = abs($first_date - $second_date);

        // calculate remain days by weaks and days
        $weaks = floor($datediff / (7 * 60 * 60 * 24));
        $days = floor(($datediff - $weaks * 7 * 60 * 60 * 24) / (60 * 60 * 24));
        $remain_days = floor($datediff / (60 * 60 * 24));
        $duration_days = 280 - $remain_days;

        $weaks_2 = floor($duration_days / 7);
        $days_2 = floor($duration_days - $weaks_2 * 7);

        $response['first_date'] = $first_date;
        $response['second_date'] = $current_date;

        // update pricing
        $this->load->model('landingpagemodel');
        $pricingPackage = $this->landingpagemodel->read(array('news_id' => $id), array(), true)->step_price;
        $pricingPackage = json_decode($pricingPackage);
        if (is_array($pricingPackage) && count($pricingPackage) > 0) {
            $counter = 0;
            foreach ($pricingPackage as $pricingPackageItem => $pricingPackageValue) {
                $counter++;
                if (in_array($duration_days, range($pricingPackageValue['packitemfrom'], $pricingPackageValue['packitemto']))) {
                    $response['package_1'] = $pricingPackageValue['packdetails'];
                    $response['package_2'] = $pricingPackageValue['packdetails'];
                }
            }
        }

        // print result
        if ($weaks_2 == 0) {
            $response['print_text'] = $days_2 . ' ngày ';
        } else {
            $response['print_text'] = $weaks_2 . ' tuần ' . $days_2 . ' ngày ';
        }
        $response['first_date'] = $_POST['first_date'];
        $response['remain_days'] = $remain_days;
        $response['duration_days'] = $duration_days;

        exit(json_encode($response));
    }
}
