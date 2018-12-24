<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TestimonialsModel extends MY_Model {
    protected $tableName = 'testimonials';

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
		'subject' => array(
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
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'quote' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'address' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'email' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'display' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'content' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getTestimonials($display='1',$limit,$offset='') {
		//public function getListTours_t($name,$types,$themes,$depature,$sell_price,$destination,$start_date,$end_date,$language,$limit, $offset) {
        $this->db->select('testimonials.*,tours.name as tour_name,tours.alias as tour_alias');
        $this->db->join('tours', 'testimonials.tour_id = tours.id', 'left');
		$this->db->where('testimonials.display',$display);
		$this->db->order_by('id','DESC');
        if ($limit != "") {
            $query = $this->db->get('testimonials', $limit, $offset);
        }else{
            $query = $this->db->get('testimonials');
        }
        if ($query->num_rows > 0) return $query->result();
        return false;
	}
	
	function random_rows($limit=3) {
		$this->db->order_by('id', 'RANDOM');
		//or
		//$this->db->order_by('rand()');
		$this->db->limit($limit);
		$query = $this->db->get('testimonials');
		return $query->result_array();
	}
}