<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminsModel extends MY_Model {
    protected $tableName = 'admins';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'email' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'password' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'group' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
        'last_login' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
    public function getAdmin(){
        $id = $this->session->userdata('adminid');
        if (!$id){
            return false;
        }
        $admin = array();
        $admin['id'] = $this->session->userdata('adminid');
        $admin['email'] = $this->session->userdata('adminemail');
        return $admin;
    }

    public function checkLogin($email='',$password=''){
        if (!$email || !$password){
            return false;
        }

        $admin = $this->read(array('email'=>$email),array(),true);

        if (!$admin){
            return false;
        }
        $hash = $password;
        for ($i=0;$i<50;$i++){
            $hash = md5($hash);
        }
        if ($hash != $admin->password){
            return false;
        }
        $this->session->set_userdata('adminid',$admin->id);
        $this->session->set_userdata('adminemail',$admin->email);
        $this->session->set_userdata('admingroup',$admin->group);
        return $admin;
    }
}