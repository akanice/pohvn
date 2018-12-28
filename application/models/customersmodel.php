<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CustomersModel extends MY_Model {
    protected $tableName = 'customers';

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
        'email' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'avatar' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'phone' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'address' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'birthday' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'type' => array(
            'isIndex'   => false,
            'nullable'  => false,
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
}
