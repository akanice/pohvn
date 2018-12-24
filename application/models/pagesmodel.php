<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PagesModel extends MY_Model {
    protected $tableName = 'pages';

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
        'content' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'meta_description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'meta_keywords' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'language' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	public function getRelatedPages($alias,$language) {
		if (isset($alias)) {
			$this->db->where('pages.alias !=', $alias);
			$this->db->where('language', $language);
			$query = $this->db->get('pages');
			if($query->num_rows()>0) return $query->result();
			else return false;
		}
	}
}