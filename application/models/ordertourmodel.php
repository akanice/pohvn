<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderTourModel extends MY_Model {
    protected $tableName = 'tours_orders';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'tour_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'customer_name' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'customer_email' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'customer_phone' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'customer_note' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'customer_promocode' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'status' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'staff_id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'staff_comment' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getAPIdata($start=0,$step=0){
        $this->db->where('tours_orders.create_time >',$start);
        $this->db->where('tours_orders.create_time <=',$start+$step);
        $this->db->from('tours_orders');
        return $this->db->count_all_results();
    }

    public function getOrderById($id){
        $this->db->select('tours_orders.*,admins.email as admin,tours.name as tour');
        $this->db->join('admins','tours_orders.staff_id= admins.id','left');
        $this->db->join('tours','tours_orders.tour_id= tours.id','left');
        $this->db->where('tours_orders.id', $id);
        return $this->db->get('tours_orders')->row_array();
    }
    public function getListOrders($name,$customer_name,$status,$limit,$offset)
    {
        $this->db->select('tours_orders.*,tours.name as tour');
        $this->db->join('tours', 'tours_orders.tour_id = tours.id', 'left');
        $this->db->like('tours.name', $name);
        $this->db->like('tours_orders.customer_name', $customer_name);
        $this->db->like('tours_orders.status', $status);
        if ($limit != "") {
            $query = $this->db->get('tours_orders', $limit, $offset);

        }else{
            $query = $this->db->get('tours_orders');
        }
        if ($query->num_rows > 0) return $query->result();
        return false;
    }
}