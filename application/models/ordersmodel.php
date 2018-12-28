<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrdersModel extends MY_Model {
    protected $tableName = 'order';

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
        'staff_create_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'product_array' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'id_device' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'create_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'implement_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'complete_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'close_date' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'staff_technique_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'order_code' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'total_price' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'sale_percent' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'sale_amount' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'status' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'id_warehouse' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'note' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getTotalOrders($customer){
        $userid = $this->session->userdata('adminid');
        $groupid = $this->session->userdata('admingroup');
        $this->db->select('order.*,customers.email as customer_email,users.email as user_email');
        $this->db->join('customers', 'order.customer_id = customers.id', 'left');
        $this->db->join('users', 'order.staff_technique_id = users.id', 'left');

        if($customer){
            $this->db->like('customers.firstname', $customer);
            $this->db->or_like('customers.lastname', $customer);
        }
        if($groupid != 1 && $groupid != 5){
             $this->db->where('order.staff_create_id', $userid);
        }
        $query = $this->db->count_all_results('order');
        return $query;
    }

    public function getListOrders($customer,$limit, $offset) {
        $userid = $this->session->userdata('adminid');
        $groupid = $this->session->userdata('admingroup');
        $this->db->select('order.*,customers.email as customer_email,
							customers.firstname as customer_first_name,
							customers.lastname as customer_last_name, 
							users.email as user_email,
							users.firstname as user_firstname,
							users.lastname as user_lastname,
						');
        $this->db->join('customers', 'order.customer_id = customers.id', 'left');
        $this->db->join('users', 'order.staff_technique_id = users.id', 'left');
		$this->db->order_by('order.create_date', 'DESC');
        if($customer){
            $this->db->like('customers.firstname', $customer);
            $this->db->or_like('customers.lastname', $customer);
        }
        if($groupid != 1 && $groupid != 5){
            $this->db->where('order.staff_create_id', $userid);
        }
        if ($limit != "") {
            $query = $this->db->get('order', $limit, $offset);

        }else{
            $query = $this->db->get('order');
        }
        if ($query->num_rows > 0) return $query->result();
        return false;
    }
	
	public function getOrdersToday() {
		$curdate = date("Y-m-d",time());
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('status !=', 'closed');
        $query = $this->db->get();
        $rows = $query->result();
		$data = array();
		foreach ($rows as $row) {
			if ((date("Y-m-d",$row->create_date) == $curdate)) {
				$data[] = $row;
			}
		}
		if ($query->num_rows > 0) return $data;
		return false;
	}
	
	public function getOrdersByDate($customer,$suffix) {
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
		$this->db->from('order');
        $this->db->select('customers.email as customer_email,
							customers.firstname as customer_first_name,
							customers.lastname as customer_last_name, 
							users.email as user_email,
							users.firstname as user_firstname,
							users.lastname as user_lastname,
						');
        $this->db->join('customers', 'order.customer_id = customers.id', 'left');
        $this->db->join('users', 'order.staff_technique_id = users.id', 'left');
		$this->db->order_by('order.create_date', 'DESC');
        if($customer){
            $this->db->like('customers.firstname', $customer);
            $this->db->or_like('customers.lastname', $customer);
        }
        if($groupid != 1 && $groupid != 5){
            $this->db->where('order.staff_create_id', $userid);
        }
		
        $query = $this->db->get();
        $rows = $query->result();
		$data = array();
		foreach ($rows as $row) {
			if ((date("Y-m-d",$row->create_date) == $pickdate)) {
				$data[] = $row;
			}
		}
		if ($query->num_rows > 0) return $data;
		return false;
	}
	
	public function getOrderToSubmit($id_user,$status='confirm') {
		$userid = $this->session->userdata('adminid');
		$this->db->select('order.*,customers.firstname as customer_first_name,customers.lastname as customer_last_name,customers.phone as customer_phone');
		$this->db->join('customers', 'order.customer_id = customers.id', 'left');
		$this->db->order_by('order.implement_date', 'DESC');
		if($id_user){
            $this->db->like('order.staff_technique_id', $id_user);
        }
		if($status){
            $this->db->like('order.status', $status);
        }
		$query = $this->db->get('order');
		if ($query->num_rows > 0) return $query->result();
		return false;
	}
}
