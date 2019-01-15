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
        $this->db->select('orders.*,affiliate_transactions.*');
        $this->db->join('affiliate_transactions', 'orders.affiliate_transaction_id = affiliate_transactions.id', 'INNER');
        $query = $this->db->get('orders', $perPage, $start);
        return $query ? $query->result() : $query;
    }

    public function getListAffiliateUsers($start, $perPage) {
        $this->db->select('users.*,affiliate_user_info.*');
        $this->db->join('affiliate_user_info', 'users.id = affiliate_user_info.user_id', 'LEFT');
        $query = $this->db->get('users', $start, $perPage);
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
            'user_id'      => $userId,
            'active'       => 'active',
            'total_visite' => 0,
            'total_click'  => 0,
            'total_order'  => 0,
            'total_money'  => 0,
            'balance'      => 0,
            'withdraw'     => 0,
        );
        $result = $this->db->insert('affiliate_user_info', $data);
        return $result ? $this->db->insert_id() : false;
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
        return $this->db->update($transaction, array(
            'id' => $transactionId
        ));
    }

    private function getTransaction($id) {
        $this->db->where('id', $id);
        $res = $this->db->get();
        $result = $res ? $res->result() : array();
        return sizeof($result) > 0 ? $result[0] : null;
    }
}
