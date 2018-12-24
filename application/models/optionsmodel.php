<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OptionsModel extends MY_Model {
    protected $tableName = 'options';
    
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
        'description' => array(
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
	public function getOptionsItem($id) {
		$this->db->where('options.id', $id);
		$query = $this->db->get('options');
		return $query->row_array();
	}
}