<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ConfigsModel extends MY_Model {
    protected $tableName = 'configs';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'term' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'term_id' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'value' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	public function getConfigsItem($id) {
		$this->db->where('configs.id', $id);
		$query = $this->db->get('configs');
		return $query->row_array();
	}
}