<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Affiliatesmodel extends MY_Model {
    protected $tableName = 'affiliate_transactions';

    protected $table = array(
        'id'           => array(
            'isIndex'  => true,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'user_id'      => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'create_time'  => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'modify_time'  => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'approve_time' => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'amount'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'description'  => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'status'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'user_approve' => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getListAffiliateTransaction($start, $perPage) {
        $this->db->select('orders.*,affiliate_transactions.*,users.*,orders.id as order_id,orders.create_time as create_time');
        $this->db->join('affiliate_transactions', 'orders.affiliate_transaction_id = affiliate_transactions.id', 'INNER');
        $this->db->join('users', 'users.id = affiliate_transactions.user_id', 'left');
        $this->db->order_by('affiliate_transactions.id','desc');
        $query = $this->db->get('orders', $perPage, $start);
        return $query ? $query->result() : $query;
    }

    public function getListAffiliateTransactionOfUser($user, $start, $perPage) {
        if (!$user || !isset($user['id'])) return array();
        $this->db->select('orders.*,affiliate_transactions.*');
        $this->db->join('affiliate_transactions', 'orders.affiliate_transaction_id = affiliate_transactions.id', 'INNER');
        $this->db->where('affiliate_transactions.user_id', $user['id']);
		$this->db->order_by('affiliate_transactions.id','desc');
        $query = $this->db->get('orders', $perPage, $start);
        return $query ? $query->result() : $query;
    }

    public function getStatisticAffiliateStatistic($user) {
        $res = array(
            'total'      => array(
                'balance'  => 0,
                'withdraw' => 0
            ),
            'today'      => array(
                'impression'   => 0,
                'visitor'      => 0,
                'closed_trans' => 0,
                'revenue'      => 0
            ),
            'this_month' => array(
                'impression'   => 0,
                'visitor'      => 0,
                'closed_trans' => 0,
                'revenue'      => 0
            )
        );
        if (!$user || !isset($user['id'])) return $res;
        $affiUser = $this->getAffiliateUser($user['id']);
        if (!is_array($affiUser)) return false;
        $affiUser = sizeof($affiUser) > 0 ? $affiUser[0] : false;
		//print_r($affiUser);die();
        if ($affiUser) {
            $res['total']['balance'] = $affiUser->balance;
            $res['total']['withdraw'] = $affiUser->withdraw;
            $res['today']['impression'] = $affiUser->today_click;
            $res['today']['visitor'] = $affiUser->today_visite;
            $res['today']['closed_trans'] = $affiUser->today_order;
            $res['today']['revenue'] = 0;
            $res['this_month']['impression'] = $affiUser->this_month_click;
            $res['this_month']['visitor'] = $affiUser->this_month_visite;
            $res['this_month']['closed_trans'] = $affiUser->this_month_order;
            $res['this_month']['revenue'] = 0;
        }
        return $res;
    }

    public function getAffiliateUser($id) {
        $this->db->where('user_id', $id);
        $res = $this->db->get('affiliate_user_info');
        return $res ? $res->result() : false;
    }

    public function getListAffiliateUsers($start, $perPage) {
        $this->db->select('users.*,affiliate_user_info.*');
        $this->db->join('affiliate_user_info', 'users.id = affiliate_user_info.user_id', 'LEFT');
		// $this->db->where('users.role','affiliate');
		// $this->db->where('users.role','normal');
        $this->db->order_by('create_time','desc');
        $query = $this->db->get('users', $perPage,$start);
        return $query ? $query->result() : $query;
    }

    public function getListUserAvailForAffi($userName = '') {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->join('affiliate_user_info', 'users.id = affiliate_user_info.user_id', 'LEFT');
        $this->db->where('affiliate_user_info.id', null);
        if ($userName !== '') $this->db->like('users.name', $userName);
        $query = $this->db->get();
        return $query ? $query->result() : $query;
    }

    public function createNewAffiliateUser($userId) {
        $data = array(
            'user_id'           => $userId,
            'active'            => 'pending',
            'total_visite'      => 0,
            'total_click'       => 0,
            'total_order'       => 0,
            'total_money'       => 0,
            'balance'           => 0,
            'withdraw'          => 0,
            'today_visite'      => 0,
            'today_click'       => 0,
            'today_order'       => 0,
            'today_date'        => strtotime(date('Y-m-d 00:00:01')),
            'this_month_visite' => 0,
            'this_month_click'  => 0,
            'this_month_order'  => 0,
            'this_month_date'   => strtotime(date('Y-m-01 00:00:01')),
        );
        $result = $this->db->insert('affiliate_user_info', $data);
        return $result ? $this->db->insert_id() : false;
    }

    public function updateAffiliatestatistic($userId, $type = 'visit') {
        $this->db->select('affiliate_user_info.*');
        $this->db->where('user_id', $userId);
        $res = $this->db->get();
        $result = $res ? $res->result() : array();
        $record = sizeof($result) > 0 ? $result[0] : null;
        if ($record) {
            $todayDate = date('Y-m-d 00:00:01', intval($record['today_date']));
            $thisMonthDate = date('Y-m-01 00:00:01', intval($record['this_month_date']));
            if (date('Y-m-d 00:00:01') === $todayDate) {
                $record['today_visite'] += 1;
                $record['today_click'] += 1;
                if ($type === 'order') $record['today_order'] += 1;
            } else {
                $record['today_date'] = date('Y-m-d 00:00:01');
                $record['today_visite'] = 1;
                $record['today_click'] = 1;
                $record['today_order'] = 0;
            }

            if (date('Y-m-01 00:00:01') === $thisMonthDate) {
                $record['this_month_visite'] += 1;
                $record['this_month_click'] += 1;
                if ($type === 'order') $record['this_month_click'] += 1;
            } else {
                $record['this_month_date'] = date('Y-m-01 00:00:01');
                $record['this_month_visite'] = 1;
                $record['this_month_click'] = 1;
                $record['this_month_order'] = 0;
            }
        }
    }

    public function deleteAffiliateUser($id) {
        $this->db->checkWhere(array(
            'id' => $id
        ));
        $this->db->delete('affiliate_user_info');
    }

    public function createAffiliateTransaction($landingPageId, $userId, $totalPrice, $orderId = null) {
        $this->load->model('landingpagemodel');
        $landingPage = $this->landingpagemodel->getLandingpage($landingPageId);
        if (!$landingPage) return false;
        $affiliateType = $landingPage->affiliate_type;
        $affiliateAmount = $landingPage->affiliate_amount;
        $money = 0;
        if ($affiliateType === LandingpageModel::AFFI_TYPE_VALUE) {
            $money = intval($affiliateAmount);
        }
        if ($affiliateType === LandingpageModel::AFFI_TYPE_VALUE) {
            $money = intval($affiliateAmount * $totalPrice);
        }
        $data = array(
            'user_id'     => $userId,
            'create_time' => date_timestamp_get(date_create()),
            'amount'      => $money,
            'description' => $orderId ? 'order ' . $orderId : '',
            'status'      => 'pending'
        );
        $result = $this->db->insert('affiliate_transactions', $data);
        return $result ? $this->db->insert_id() : false;
    }

    public function approveAffiliateTransaction($transactionId, $userApprove, $approveStatus) {
        $transaction = $this->getTransaction($transactionId);
        if (!$transaction) return false;
        $transaction = (array)$transaction;
        $transaction['user_approve'] = $userApprove;
        $transaction['approve_time'] = date_timestamp_get(date_create());
        $transaction['status'] = $approveStatus === 'confirmed' ? 'confirmed' : 'cancelled';
        //+ tiền cho user
        $user = $this->getAffiliateUser($transaction['user_id']);
        if (!$user) return false;
        $amount = intval($transaction['amount']);
        $user['total_money'] = intval($user['total_money']) + $amount;
        $user['balance'] = intval($user['balance']) + $amount;
        $this->db->where('id', $user['id']);
		$this->db->update('affiliate_user_info', $user);
        return $this->update($transaction, array(
            'id' => $transactionId
        ));
    }
	
	public function approveCommissionForAffiliate($affiliate_id,$commission) {
		$query = $this->db->get('affiliate_user_info')->row();
		$data = $this->getAffiliateUser($affiliate_id);
		
		$total_money = intval($data[0]->total_money) + $commission;
        $balance = intval($data[0]->balance) + $commission;
		$this->db->where('user_id', $affiliate_id);
        $this->db->update('affiliate_user_info', array(
			'total_money' => $total_money,
			'balance' => $balance,
		));
	}

    private function getTransaction($id) {
        $this->db->where('id', $id);
        $res = $this->db->get('affiliate_transactions');
        $result = $res ? $res->result() : array();
        return sizeof($result) > 0 ? $result[0] : null;
    }

    public function getAffiliateTrans($userId, $limit) {
        // $from = strtotime(date('Y-m-d 00:00:01'));
        // $to = strtotime(date('Y-m-d 23:59:59'));
        // if ($type === 'this_month') {
            // $from = strtotime(date('Y-m-01 00:00:01'));
            // $to = strtotime(date('Y-m-t 23:59:59'));
        // }
        $this->db->select('affiliate_transactions.*');
        // $this->db->where('create_time >=', $from);
        // $this->db->where('create_time <=', $to);
        $this->db->where('user_id', $userId);
        $this->db->where('status', 'confirmed');
        $res = $this->db->get('affiliate_transactions',$limit);
        $result = $res ? $res->result() : array();
        return sizeof($result) > 0 ? $result : array();
    }
}
