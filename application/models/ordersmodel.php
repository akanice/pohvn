<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ordersModel extends MY_Model {
    protected $tableName = 'orders';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'customer_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'sale_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'birth_expect' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'note' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'affiliate_transaction_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'landingpage_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'total_price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'status' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getTotalorders($customer,$phone){
        $this->db->select('orders.*,customers.name as customer_name, customers.id as customer_id');
		$this->db->from('orders');
        $this->db->join('customers', 'orders.customer_id = customers.id', 'left');
        if($customer){
            $this->db->like('customers.name', $customer);
        }
		if($phone){
            $this->db->like('customers.phone', $phone);
        }
		
        return $this->db->count_all_results();
        // return $query;
    }

    public function getListorders($customer,$phone,$limit, $offset) {
        $this->db->select('orders.*,customers.email as customer_email,
							customers.name as customer_name,
							customers.phone as customer_phone, 
							customers.address as customers_address,
						');
        $this->db->join('customers', 'orders.customer_id = customers.id', 'left');
		$this->db->order_by('orders.create_time', 'DESC');
        if($customer){
            $this->db->like('customers.name', $customer);
        }
		if($phone){
            $this->db->like('customers.phone', $phone);
        }
        if ($limit != "") {
            $query = $this->db->get('orders', $limit, $offset);

        }else{
            $query = $this->db->get('orders');
        }
        return $query->result();
        // return false;
    }
	
	public function getordersToday() {
		$curdate = date("Y-m-d",time());
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('status !=', 'closed');
        $query = $this->db->get();
        $rows = $query->result();
		$data = array();
		foreach ($rows as $row) {
			if ((date("Y-m-d",$row->create_date) == $curdate)) {
				$data[] = $row;
			}
		}
		if ($query->num_rows() > 0) return $data;
		return false;
	}
	
	public function getordersByDate($customer,$suffix) {
		$userid = $this->session->userdata('adminid');
        $groupid = $this->session->userdata('admingroup');
		
		if ($suffix == 'today') {
			$pickdate = date('Y-m-d',time());
		} elseif ($suffix == 'yesterday') {
			$pickdate = date('Y-m-d',strtotime("-1 days"));
		} elseif ($suffix == 'tomorrow') {
			$pickdate = date('Y-m-d',strtotime("+1 days"));
		} else {
			$pickdate = date('Y-m-d',time());
		}
		$this->db->select('*');
		$this->db->from('orders');
        $this->db->select('customers.email as customer_email,
							customers.firstname as customer_first_name,
							customers.lastname as customer_last_name, 
							users.email as user_email,
							users.firstname as user_firstname,
							users.lastname as user_lastname,
						');
        $this->db->join('customers', 'orders.customer_id = customers.id', 'left');
        $this->db->join('users', 'orders.staff_technique_id = users.id', 'left');
		$this->db->order_by('orders.create_date', 'DESC');
        if($customer){
            $this->db->like('customers.firstname', $customer);
            $this->db->or_like('customers.lastname', $customer);
        }
        if($groupid != 1 && $groupid != 5){
            $this->db->where('orders.staff_create_id', $userid);
        }
		
        $query = $this->db->get();
        $rows = $query->result();
		$data = array();
		foreach ($rows as $row) {
			if ((date("Y-m-d",$row->create_date) == $pickdate)) {
				$data[] = $row;
			}
		}
		if ($query->num_rows() > 0) return $data;
		return false;
	}
	
	public function getordersToSubmit($id_user,$status='confirm') {
		$userid = $this->session->userdata('adminid');
		$this->db->select('orders.*,customers.firstname as customer_first_name,customers.lastname as customer_last_name,customers.phone as customer_phone');
		$this->db->join('customers', 'orders.customer_id = customers.id', 'left');
		$this->db->order_by('orders.implement_date', 'DESC');
		if($id_user){
            $this->db->like('orders.staff_technique_id', $id_user);
        }
		if($status){
            $this->db->like('orders.status', $status);
        }
		$query = $this->db->get('orders');
		if ($query->num_rows() > 0) return $query->result();
		return false;
	}
}
