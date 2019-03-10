<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Afflandingconfigmodel extends MY_Model {
    protected $tableName = 'affiliate_landingpage_config';

    protected $table = array(
        'id'           => array(
            'isIndex'  => true,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'landingpage_id'      => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'type'  => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'amount' => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

}
