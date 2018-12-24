<?php

if (!function_exists('modelCheckAdd')){
	/**
	 * Check data for table
	 *
	 * Check data for table before insert to database
	 * 
	 * @param array $tableDef Definition of table
	 * @param array $data Data to insert
	 */
	function modelCheckAdd($tableDef,$data){
		if (!isset($tableDef) || ! isset($data) || !is_array($tableDef) || !is_array($data)){
			return false;
		}
		
		$newdata = array();
		
		foreach ($tableDef as $name => $val){
			if ($val){
				if (!isset($data[$name]) || (strlen($data[$name])<1)){
					return false;
				}

				if ($val == 'number'){
					if (!is_numeric($data[$name])){
						return false;
					}
				}else{

				}
			}else{
				if (!isset($data[$name])){
					continue;
				}
			}
			
			$newdata[$name] = $data[$name];
		}
		
		if (!count($newdata)){
			return false;
		}
		
		return $newdata;
	}
}

if (!function_exists('modelCheckEdit')){
	/**
	 * Check data for edit
	 *
	 * Check data for table before edit to database
	 * 
	 * @param array $tableDef Definition of table
	 * @param array $data Data to edit
	 * @param array $origindata Origin data
	 */
	function modelCheckEdit($tableDef,$data,$origindata){
		if (!isset($tableDef) || ! isset($data) || !is_array($tableDef) || !is_array($data)){
			return false;
		}
		
		$newdata = array();
		foreach ($tableDef as $name => $val){
			if (!isset($data[$name]) || ($origindata->$name == $data[$name]) || 
					($data[$name]=='')){
				continue;
			}

			if ($val == 'number'){
				if (!is_numeric($data[$name])){
					continue;
				}
			}else{

			}
			
			$newdata[$name] = $data[$name];
		}
		
		if (!count($newdata)){
			return false;
		}
		
		return $newdata;
	}
}

if (!function_exists('generateSalt')){
	function generateSalt($length=8){
		$salt = random_string('alnum',$length);
		
		return $salt;
	}
}


if (!function_exists('encryptPassword')){
	function encryptPassword($password,$salt){
		if (strlen($password) < 8){
			return 'Error: Password must longer than 8 character';
		}
		
		$newpassword = $password;
		$num = 0;
		for($i=0;$i<strlen($salt);$i++){
			$num+= ord($salt[$i]);
		}
		
		$num = round($num/8.8,0);
		
		for($i=0;$i<$num;$i++){
			if ($i%2>0){
				$newpassword = md5($newpassword.$salt);
			}else{
				$newpassword = substr(sha1($newpassword.$salt),0,32);
			}
		}
		
		return $newpassword;
	}
}

if (!function_exists('make_alias')){
	function make_alias($str){
		$cleaner = array(
			'â'		=> 'a', 'Â'		=> 'A',
			'ă'		=> 'a', 'Ă'		=> 'A',
			'ạ'		=> 'a', 'Ạ'		=> 'A',
			'á'		=> 'a', 'Á'		=> 'A',
			'à'		=> 'a', 'À'		=> 'A',
			'ả'		=> 'a', 'Ả'		=> 'A',
			'ã'		=> 'a',	'Ã'		=> 'A',
			'ậ'		=> 'a', 'Ậ'		=> 'A',
			'ấ'		=> 'a', 'Ấ'		=> 'A',
			'ầ'		=> 'a', 'Ầ'		=> 'A',
			'ẩ'		=> 'a', 'Ẩ'		=> 'A',
			'ẫ'		=> 'a',	'Ẫ'		=> 'A',
			'ặ'		=> 'a', 'Ặ'		=> 'A',
			'ắ'		=> 'a', 'Ắ'		=> 'A',
			'ằ'		=> 'a', 'Ằ'		=> 'A',
			'ẳ'		=> 'a', 'Ẳ'		=> 'A',
			'ẵ'		=> 'a',	'Ẵ'		=> 'A',
			
			'đ'		=> 'd', 'Đ'		=> 'D',
			
			'ê'		=> 'e',	'Ê'		=> 'E',
			'é'		=> 'e',	'É'		=> 'E',
			'è'		=> 'e',	'È'		=> 'E',
			'ẹ'		=> 'e',	'Ẹ'		=> 'E',
			'ẻ'		=> 'e',	'Ẻ'		=> 'E',
			'ẽ'		=> 'e',	'Ẽ'		=> 'E',
			'ế'		=> 'e',	'Ế'		=> 'E',
			'ề'		=> 'e',	'Ề'		=> 'E',
			'ệ'		=> 'e',	'Ệ'		=> 'E',
			'ể'		=> 'e',	'Ể'		=> 'E',
			'ễ'		=> 'e',	'Ễ'		=> 'E',
			
			'í'		=> 'i', 'Í'		=> 'I',
			'ì'		=> 'i', 'Ì'		=> 'I',
			'ị'		=> 'i', 'Ị'		=> 'I',
			'ỉ'		=> 'i', 'Ỉ'		=> 'I',
			'ĩ'		=> 'i', 'Ĩ'		=> 'I',
			
			'ô'		=> 'o',	'Ô'		=> 'O',
			'ơ'		=> 'o',	'Ơ'		=> 'O',
			'ó'		=> 'o',	'Ó'		=> 'O',
			'ò'		=> 'o',	'Ò'		=> 'O',
			'ọ'		=> 'o',	'Ọ'		=> 'O',
			'ỏ'		=> 'o',	'Ỏ'		=> 'O',
			'õ'		=> 'o',	'Õ'		=> 'O',
			'ố'		=> 'o',	'Ố'		=> 'O',
			'ồ'		=> 'o',	'Ồ'		=> 'O',
			'ộ'		=> 'o',	'Ộ'		=> 'O',
			'ổ'		=> 'o',	'Ổ'		=> 'O',
			'ỗ'		=> 'o',	'Ỗ'		=> 'O',
			'ớ'		=> 'o',	'Ớ'		=> 'O',
			'ờ'		=> 'o',	'Ờ'		=> 'O',
			'ợ'		=> 'o',	'Ợ'		=> 'O',
			'ở'		=> 'o',	'Ở'		=> 'O',
			'ỡ'		=> 'o',	'Ỡ'		=> 'O',
			
			'ư'		=> 'u',	'Ư'		=> 'U',
			'ú'		=> 'u',	'Ú'		=> 'U',
			'ù'		=> 'u',	'Ù'		=> 'U',
			'ụ'		=> 'u',	'Ụ'		=> 'U',
			'ủ'		=> 'u',	'Ủ'		=> 'U',
			'ũ'		=> 'u',	'Ũ'		=> 'U',
			'ứ'		=> 'u',	'Ứ'		=> 'U',
			'ừ'		=> 'u',	'Ừ'		=> 'U',
			'ự'		=> 'u',	'Ự'		=> 'U',
			'ử'		=> 'u',	'Ử'		=> 'U',
			'ữ'		=> 'u',	'Ữ'		=> 'U',
			
			'ý'		=> 'y',	'Ý'		=> 'Y',
			'ỳ'		=> 'y',	'Ỳ'		=> 'Y',
			'ỵ'		=> 'y',	'Ỵ'		=> 'Y',
			'ỷ'		=> 'y',	'Ỷ'		=> 'Y',
			'ỹ'		=> 'y',	'Ỹ'		=> 'Y'
		);
		
		$result = $str;
		
		foreach ($cleaner as $a => $v){
			$result = str_replace($a, $v, $result);
		}
		
		$result = iconv('UTF-8','ASCII//TRANSLIT',$result);
		
		$result = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $result);
		$result = strtolower(trim($result, '-'));
		$result = preg_replace("/[\/_| -]+/", '-', $result);
		while (strstr($result,'--')){
			$result = str_replace('--','-',$result);
		}
		$result = trim($result,'-');
		
		return $result;
	}
}

if (!function_exists('array_swap_index')){
	function array_swap_index($array,$key='id',$objectIsArray=false){
		$result = array();
		foreach ($array as $item){
			if ($objectIsArray){
				$result[$item[$key]] = $item;
			}else{
				$result[$item->$key] = $item;
			}
		}
		return $result;
	}
}

if (!function_exists('getLocationFromIP')){
	function getLocationFromIP(){
		$location = array('country'=>'VN','city'=>'Hanoi');

		$ip = $_SERVER['REMOTE_ADDR'];
		if ($ip!='127.0.0.1'){
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			if (isset($details->city)) $location = array('country'=>$details->country,'city'=>$details->city);
		}

		return $location;
	}
}