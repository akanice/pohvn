<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data = array();
    }
	
	public function payAffiliate() {
		$result = new stdClass();
        $result->ok = false;
        $result->msg = '';
		
		$order_id 					= $_POST['order_id'];
		$trans_id 					= $_POST['trans_id'];
		$order_note 				= $_POST['note'];
		$order_value 				= $_POST['order_value'];
		$order_commission	= $_POST['order_commission'];
		$order_affiliate_id		= $_POST['order_affiliate_id'];
		$user_approve			= $this->session->userdata('adminid');
		$this->load->model('affiliatesmodel');
		$this->load->model('ordersmodel');
		
		$data = array(
			"status"				=> 'confirmed',
			'modify_time'		=> time(),
			'description'			=> $order_note,
			'user_approve'	=> $user_approve,
		);
		$transaction_id = $this->affiliatesmodel->update($data,array('id'=>$trans_id));
		$data2 = array(
			'status'		=> 'closed',
			'sale_id'		=> $user_approve,
		);
		$this->ordersmodel->update($data2,array('id'=>$order_id));
		
		$this->affiliatesmodel->approveCommissionForAffiliate($order_affiliate_id,$order_commission);
		
		$result->ok = true;
		$result->msg = 'Chuyển tiền thành công!';
        echo json_encode($result);
        die();
	}
	
    public function loadUrl() {
        if ($_POST['dataString']) {
            $type_url = $_POST['dataString'];
            switch ($type_url) {
                case "t_landing":
                    $this->load->model('newsmodel');
                    $data = $this->newsmodel->read(array("type" => 'landing'));
                    break;
                case "t_cat":
                    $this->load->model('newscategorymodel');
                    $data = $this->newscategorymodel->read(array());
                    break;
                case "t_page":
                    $this->load->model('pagesmodel');
                    $data = $this->pagesmodel->read(array());
                    break;
				case "t_link":
                    $data = null;
                    break;
                default:
                    $data = '';
            }
            if ($data && $data != '') {
                echo '<select name="slug" class="form-control">';
				foreach ($data as $item) {
                    $title = $item->title;
                    $id = $item->id;
                    echo '<option value="' . $id . '">' . $title . '</option>';
                }
				echo '</select>';
			} elseif ($data === null) {
				echo '<input type="text" class="form-control" value="" name="slug">';	
            } else {
				echo '<select name="slug" class="form-control">';
				echo '<option value="">--- Chọn ---</option>';
				echo '</select>';
            }
        }
    }

    public function searchUser() {
        $userName = $_POST['username'];
        $this->load->model('affiliatesmodel');
        $result = $this->affiliatesmodel->getListUserAvailForAffi($userName);
        echo json_encode($result);
    }

    public function addAffiUser() {
        $userId = $_POST['id'];
        $this->load->model('affiliatesmodel');
        $result = $this->affiliatesmodel->createNewAffiliateUser($userId);
        echo json_encode($result);
    }
}
