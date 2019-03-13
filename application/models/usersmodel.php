<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UsersModel extends MY_Model {
    protected $tableName = 'users';

    protected $table = array(
        'id'          => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'email'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'name'        => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'password'    => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'phone'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'city'        => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'address'     => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
		'role'        => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
		'user_code'     => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'create_time' => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function login($email = '', $password = '') {
        if (!$email) {
            return false;
        }
        $user = $this->read(array('email' => $email), array(), true);
        if (!$user) {
            return false;
        }
        $encryptedPass = $this->_password_encrypt($email, $password);
        //die($encryptedPass);
        if ($user->password != $encryptedPass) {
            return false;
        }
        $this->_session_set($user);

        return $user;
    }

    private function _password_encrypt($email = '', $password = '') {
        $str = $password;
        for ($i = 0; $i < (100 + strlen($email)); $i++) {
            $str = md5($email . '|' . $str);
        }
        return $str;
    }

    private function _session_set($user = '') {
        if (!$user || !isset($user->email)) {
            return false;
        }
        //$this->session->sess_destroy();
        $this->session->set_userdata('user_id', $user->id);
        $this->session->set_userdata('user_email', $user->email);

        return true;
    }

    public function checkLogin() {
        $userid = $this->session->userdata('user_id');
        if (!$userid) return false;

        $user = $this->read(array('id' => $userid), array(), true);
        if (!$user) {
            $this->logout();
            return false;
        }

        return $user;
    }

    public function logout() {
        $this->session->sess_destroy();
        return true;
    }

    public function register($user = array()) {
        if (!is_array($user) || !$user) {
            return false;
        }

        // Check email exists
        $u = $this->read(array('email' => $user['email']), array(), true);
        if ($u) {
            return false;
        }

        $user['password'] = $this->_password_encrypt($user['email'], $user['password']);
        $user['create_time'] = time();

        $r = $this->create($user);
        if (!$r) {
            return false;
        }

        $u = $this->read(array('id' => $r), array(), true);

        return $u;
    }

    public function isLogin() {
        $userid = $this->session->userdata('user_id');
        if (!$userid) return false;
        return true;
    }

    public function isAffiliateLogin() {
        $userid = $this->session->userdata('user_id');
        $this->load->model('affiliatesmodel');
        $affiUser = $this->affiliatesmodel->getAffiliateUser($userid);
        if (!is_array($affiUser)) return false;
        return sizeof($affiUser) > 0 ? array('user' => '', 'affi_data' => $affiUser[0]) : false;
    }
}
