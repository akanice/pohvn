<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol']							= 'smtp';
$config['charset'] 							= 'utf-8';
$config['wordwrap']						= TRUE;

$config['smtp_host']						= "pro48.emailserver.vn";
$config['smtp_port']						= 465;
$config['smtp_user']						= 'admin@poh.vn';
$config['smtp_pass']						= 'adminpoh12345';
$config['crlf'] = '\r\n';
$config['newline'] = '\r\n';

$config['mailtype'] = 'html';
$config['site_title'] = "POH - Thai giáo 280 ngày";
$config['admin_email'] = "admin@poh.vn";
$config['default_group'] = 'members';
$config['admin_group'] = 'admin';
$config['identity'] = 'email';
$config['min_password_length']				= 8;
$config['max_password_length']			= 20;
$config['need_activation']						= FALSE;
$config['email_activation']						= FALSE;
$config['manual_activation']					= FALSE;
$config['remember_users']						= FALSE;
$config['user_expire']								= 86500;
$config['user_extend_on_login']			= FALSE;
$config['track_login_attempts']				= FALSE;
$config['track_login_ip_address']			= FALSE; 
$config['maximum_login_attempts']		= 3;                  
$config['lockout_time']								= 600;                 
$config['forgot_password_expiration']	= 0;                  


$config['email_register_subject']			= "Khách hàng đăng ký khóa học";
$config['email_subject_order']				= "Khách hàng đăng ký khóa học";
/*
 | -------------------------------------------------------------------------
 | Cookie options.
 | -------------------------------------------------------------------------
 | remember_cookie_name Default: remember_code
 | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 | 	  'file' = Use the default CI config or use from a config file
 | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = FALSE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
	'mailtype' => 'html',
);

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_register_course'] = 'contact.tpl.php';
$config['email_temp_order'] = 'order.tpl.php';
$config['email_temp_contact'] = 'contact.tpl.php';
/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 22
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</p>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<p>';		// Error message start delimiter
$config['error_end_delimiter']     = '</p>';	// Error message end delimiter

