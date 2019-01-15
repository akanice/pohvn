<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LandingpageModel extends MY_Model {
    const AFFI_TYPE_VALUE   = 0;
    const AFFI_TYPE_PERCENT = 1;
    protected $tableName = 'landing_page';
    protected $table = array(
        'id'               => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'news_id'          => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'integer'
        ),
		'menu_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'code_header' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'code_footer'      => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'total_price'      => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'step_price'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'affiliate_type'   => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'affiliate_amount' => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getLandingpage($id) {
        $this->db->where('id', $id);
        $res = $this->db->get();
        return $res ? ($res->result())[0] : null;
    }

}
