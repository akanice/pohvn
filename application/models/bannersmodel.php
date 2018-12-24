<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BannersModel extends MY_Model {
    protected $tableName = 'banners';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'title' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'image' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'url' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'total_clicked' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
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
	
	public function getListBanners($title,$limit=10,$offset){
        $this->db->select('banners.*');
        $this->db->like('banners.title', $title);
        if($limit != ''){
            $query= $this->db->get('banners',$limit,$offset);
            if($query->num_rows()>0) {
				return $query->result();
			} else {
				return false;
			}
        } else {
            $query = $this->db->get('banners');
			if($query->num_rows()>0) {
				return $query->result();
			}
        }
    }
}