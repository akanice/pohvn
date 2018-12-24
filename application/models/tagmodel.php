<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TagModel extends MY_Model {
    protected $tableName = 'tag';

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
		'language' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getToursByTag($tags,$limit=3) {
		if (isset($tags)) {
			$tags = explode(',',$tags);
			foreach ($tags as $t) {
				//print_r($t);
				$this->db->or_like("tours.tag", $t);
			}
			$query = $this->db->get("tours",$limit);
			if ($query->num_rows()>0) return $query->result();
			return false;
		}
	}
	
		public function getBlogsByTag($tags,$limit=3) {
		if (isset($tags)) {
			$tags = explode(',',$tags);
			foreach ($tags as $t) {
				//print_r($t);
				$this->db->or_like("blog.tag", $t);
			}
			$query = $this->db->get("blog",$limit);
			if ($query->num_rows()>0) return $query->result();
			return false;
		}
	}

}