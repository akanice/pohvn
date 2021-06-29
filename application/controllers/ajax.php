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
                if (in_array($duration_days, range($pricingPackageValue->packitemfrom, $pricingPackageValue->packitemto))) {
                    $response['package_1'] = $pricingPackageValue->packdetails;
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
	
	public function register_course() {
		$result = new stdClass();
		$result->ok = false;
		
		$name = @$_POST['name'];
		$phone = @$_POST['phone'];
		$email = @$_POST['email'];
		$pre_birth = @$_POST['pre_birth'];
		$address = @$_POST['address'];
		$message = @$_POST['message'];
		$poh_affiliate = @$_POST['poh_affiliate'];
		$package_price_value = @$_POST['package_price_value'];
		$id = @$_POST['id'];
        
		$this->load->model('ordersmodel');
		$this->load->model('customersmodel');
		$this->load->model('affiliatesmodel');
		$this->load->model('usersmodel');
		$this->load->model('landingpagemodel');
		$this->load->model('afflandingconfigmodel');
		
		$data1 = array (
			"name"				=> $name,
			"alias"				=> make_alias($name),
			"phone"			=> $phone,
			"birthday"		=> $pre_birth,
			"address"			=> $address,
			"email"				=> $email,
			"create_time"	=> time(),
		);
		$customer_id = $this->customersmodel->create($data1);
		if ($poh_affiliate && ($poh_affiliate !== 'null') && ($poh_affiliate !== 0)) {
			$user_data = $this->usersmodel->read(array('user_code'=>$poh_affiliate),array(),true);
			$user_id = $user_data->id;
		} else {
			$user_id = 0;
		}
		
		$landing_page_data = $this->landingpagemodel->read(array('news_id'=>$id),array(),true);
		if ($poh_affiliate && $poh_affiliate !== 'null' && $poh_affiliate !== 0) {
			$landing_page_config = $this->afflandingconfigmodel->read(array('landingpage_id'=>$landing_page_data->id),array(),true);
			if ($landing_page_config->type === 'percent') {
				$amount = ($package_price_value*($landing_page_config->amount))/100;
			} elseif ($landing_page_config->type === 'percent') {
				$amount = $landing_page_config->amount;
			} else {
				$amount = 0;
			}
			$data2 = array(
				"user_id"			=> $user_id,
				"amount"			=> $amount,
				"status"			=> 'pending',
				"create_time"	=> time(),
			);
			$transaction_id = $this->affiliatesmodel->create($data2);
		} else {
			$transaction_id = null;
		}
		$data3 = array(
			"code"									=> generateUserCode($length=10),
			"customer_id"						=> $customer_id,
			"birth_expect"						=> $pre_birth,
			"note"										=> $message,
			"affiliate_transaction_id"	=> $transaction_id,
			"landingpage_id"					=> $landing_page_data->id,
			"sale_id"								=> null,
			"total_price"						=> $package_price_value,
			"status"									=> 'pending',
			"create_time"						=> time(),
		);
		$order_id = $this->ordersmodel->create($data3);
		//$this->sendmail($name,$phone,$email,$pre_birth,$address,$message,$user_data->name,$package_price_value);
		
		$result->ok = true;
        die();
	}
	
	public function reg_course() {
		$result = new stdClass();
        $result->ok = false;
        $result->msg = '';
		
		$this->load->model('ordersmodel');
		$this->load->model('customersmodel');
		$this->load->model('affiliatesmodel');
		$this->load->model('usersmodel');
		$this->load->model('landingpagemodel');
		$this->load->model('afflandingconfigmodel');
		
		// Create customer info
		$data1 = array (
			"name"				=> $this->input->post('name'),
			"alias"					=> make_alias($this->input->post('name')),
			"phone"				=> $this->input->post('phone'),
			"birthday"			=> '',
			"address"			=> '',
			"email"				=> $this->input->post('email'),
			"create_time"	=> time(),
		);
		$customer_id = $this->customersmodel->create($data1);
		
		// Get Affiliate ID from affi_code
		if (@$this->input->post('poh_affiliate') && (@$this->input->post('poh_affiliate') !== '') && ($this->input->post('poh_affiliate') !== 0)) {
			$user_data = $this->usersmodel->read(array('user_code'=>$this->input->post('poh_affiliate')),array(),true);
			if (@$user_data && $user_data != '') {$affi_id = $user_data->id;}else{$affi_id = 0;}
			
			// Calculate commission
			$ld_config = $this->afflandingconfigmodel->read(array('landingpage_id'=>$this->input->post('page_id')),array(),true);
			if ($ld_config->type === 'percent') {
				$amount = ($this->input->post('course_price')*($ld_config->amount))/100;
			} elseif ($ld_config->type === 'fixed') {
				$amount = $ld_config->amount;
			} else {
				$amount = 0;
			}
			$data2 = array(
				"user_id"			=> $affi_id,
				"amount"			=> $amount,
				"status"				=> 'pending',
				"create_time"	=> time(),
			);
			$transaction_id = $this->affiliatesmodel->create($data2);
		} else {
			$transaction_id = null;
		}
		
		// Create Order
		$data3 = array(
			"code"									=> generateUserCode($length=10),
			"customer_id"						=> $customer_id,
			"birth_expect"						=> '',
			"note"										=> $this->input->post('course_name'),
			"affiliate_transaction_id"	=> $transaction_id,
			"landingpage_id"					=> $this->input->post('page_id'),
			"sale_id"								=> null,
			"total_price"						=> $this->input->post('course_price'),
			"status"									=> 'pending',
			"create_time"						=> time(),
		);
		$order_id = $this->ordersmodel->create($data3);
		
		$params= array(
           "name"			=> $this->input->post('name'),
           "phone"			=> $this->input->post('phone'),
           "message"		=> '',
           "products"		=> $this->input->post('course_name'),
           "quantity"		=> 1,
        );
		$url = @$this->input->post('api');
		$r = $this->postCURL($url, $params);
		
		// Sendmail
		// $datamail = $data3;
		// $datamail['affi_info']	 			= $user_data->name.' - '.$user_data->user_code.' - '.$user_data->phone;
		// $datamail['course_name']	= $this->input->post('course_name');
		// $datamail['course_price']		= $this->input->post('course_price');
		// $datamail['user_email'] 		= @$this->input->post('email');
		// $datamail['user_name'] 		= $this->input->post('name');
		// $datamail['user_phone'] 		= $this->input->post('phone');
		// $r = $this->sendmail($datamail,'','email_temp_order','email_subject_order');
		
		if($r) {
			$result->params = $params;
			$result->ok = true;
			echo json_encode($result);die();
		} else {
			$result->ok = false;
		}
	}
	
	public function postCURL($_url, $_param){
        $postData = '';
        foreach($_param as $k => $v) { 
          $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count(@$postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }
}
