<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TagstermModel extends MY_Model {
    protected $tableName = 'news_tags';

    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'new_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'tag_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getTags() {
		$this->db->select('tags.*');
        $this->db->join('news_tags', 'news_tags.tag_id = tags.id', 'left');
        return $query ? $query->result() : false;
	}

}