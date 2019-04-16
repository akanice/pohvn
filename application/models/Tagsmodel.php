<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TagsModel extends MY_Model {
    protected $tableName = 'tags';

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