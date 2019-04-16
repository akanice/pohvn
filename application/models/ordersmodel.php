<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ordersModel extends MY_Model {
    protected $tableName = 'orders';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'code' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'customer_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'sale_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'birth_expect' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'note' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'affiliate_transaction_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
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
		'create_time' => array(
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

    public function getListorders($customer,$phone,$status,$limit, $offset) {
        $this->db->select('orders.*,customers.email as customer_email,
							customers.name as customer_name,
							customers.phone as customer_phone, 
							customers.address as customer_address,
							affiliate_transactions.user_id as user_id,
							affiliate_transactions.amount as commission,
							users.name as user_name,
							users.id as user_id,
						');
        $this->db->join('customers', 'orders.customer_id = customers.id', 'left');
        $this->db->join('affiliate_transactions', 'orders.affiliate_transaction_id = affiliate_transactions.id', 'left');
        $this->db->join('users', 'affiliate_transactions.user_id = users.id', 'left');
		$this->db->order_by('orders.create_time', 'DESC');
        if($customer){
            $this->db->like('customers.name', $customer);
        }
		if($phone){
            $this->db->like('customers.phone', $phone);
        }
		if($status){
            $this->db->like('orders.status', $status);
        }
        if ($limit != "") {
            $query = $this->db->get('orders', $limit, $offset);

        }else{
            $query = $this->db->get('orders');
        }
        return $query ? $query->result() : false;
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
							users.name as user_name,
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
		
	public function getOrderlastNdays($days="1") {
		$time = (new \DateTime())->modify('-'.$days.' day');
		$rs = $time->format('Y-m-d H:i:s');
		$rs = strtotime($rs);

		$this->db->select('orders.*,customers.email as customer_email,
							customers.name as customer_name,
							customers.phone as customer_phone, 
						');
		$this->db->join('customers', 'orders.customer_id = customers.id', 'left');
		$this->db->order_by('orders.create_time', 'DESC');
		$this->db->where('orders.status', 'pending');
		$this->db->where('orders.create_time >=',$rs);
        $query = $this->db->get('orders');
        return $query ? $query->result() : false;
	}
	
	public function getLastNdays($days=10) {
		for ($i = $days-1; $i >= 0; $i--) {
			$date_array[] = ( date('d/m',strtotime(date('d-m-Y').' -'.$i.' days'))." "); 
		}
		return json_encode($date_array);
	}
	// $firstDate = $firstDateTimeObj->format('Y-m-d');
	// $secondDate = $secondDateTimeObj->format('Y-m-d');
	public function getRevenue($days=10) {
		for ($i = $days-1; $i >= 0; $i--) {
			$early = strtotime(date('d-m-Y 0:0:0').' -'.$i.' days');
			$late = strtotime(date('d-m-Y 24:0:0').' -'.($i).' days');
			
			$this->db->select_sum('orders.total_price');
			$this->db->where('orders.create_time >=',$early);
			$this->db->where('orders.create_time <',$late);
			$query = $this->db->get('orders');
			if ($query->row_array()['total_price'] == null) {
				$rs[] = 0;
			} else {
				$rs[] = $query->row_array()['total_price'];
			}
		}
		return json_encode($rs);
	}
	
	public function getOrdersNumber($days=10) {
		for ($i = $days-1; $i >= 0; $i--) {
			$early = strtotime(date('d-m-Y 0:0:0').' -'.$i.' days');
			$late = strtotime(date('d-m-Y 24:0:0').' -'.($i).' days');
			
			$this->db->select('orders.*');
			$this->db->where('orders.create_time >=',$early);
			$this->db->where('orders.create_time <',$late);
			$query = $this->db->get('orders');    
			$rs[] = $query->num_rows();
		}
		return json_encode($rs);
	}
	
	public function getOrdersToExport($from, $to) {
		$this->db->select('orders.*,customers.email as customer_email,
							customers.name as customer_name,
							customers.phone as customer_phone, 
							customers.address as customer_address, 
						');
		$this->db->join('customers', 'orders.customer_id = customers.id', 'left');
		$this->db->order_by('orders.create_time', 'DESC');
        if($from && $to){
            $this->db->where('orders.create_time >=', strtotime($from));
            $this->db->where('orders.create_time <=', strtotime($to . "+1 days"));
        }
		
		// date('Y-m-d',strtotime("-1 days"));
		$query = $this->db->get('orders');
        return $query ? $query->result_array() : false;
	}
}
