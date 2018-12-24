<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CR Active Record Class
 * Allow to use statement group class to dynamic create SQL query with bracket
 *
 * Creator: Drkdra of CR Team
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		Drkra
 */

// Require group statement class
require_once APPPATH."core/db_group_statement.php";

class MY_DB_active_record extends CI_DB_active_record {
	// create a new statement group
	public function statement_group($type='AND'){
		$sGroup = new groupStatement($type);

		return $sGroup;
	}

	// insert the statement group into the query
	public function where_group($group){
		if (!is_a($group,'groupStatement')){
			return $this;
		}

		// Make a copy of like and where array to restore later
		$ar_like = $this->ar_like;
		$ar_where = $this->ar_where;

		// Process group statements
		foreach ($group->ar_group as $groupItem){
			$this->where_group($groupItem);
		}

		// Process like statements
		foreach ($group->ar_like as $likeItem){
			$key = $likeItem['key'];
			$value = $likeItem['value'];
			$not = $likeItem['not'];
			$side = $likeItem['side'];

			$this->_like($key,$value,$group->getType(),$side,$not);
		}

		// Process where statements
		foreach ($group->ar_where as $whereItem){
			$key = $whereItem['key'];
			$value = $whereItem['value'];
			$whereIn = isset($whereItem['whereIn'])?$whereItem['whereIn']:false;

			if ($whereIn){
				$not = $whereItem['not'];
				$this->_where_in($key,$value,$not,$group->getType());
			}else{
				$escape = $whereItem['escape'];
				$this->_where($key,$value,$group->getType(),$escape);
			}
		}

		// Get the new item of this group statement
		$new_where = array_diff($this->ar_where,$ar_where);
		$new_like = array_diff($this->ar_like,$ar_like);

		// Make statement
		$state = "(";
		foreach ($new_where as $w){
			if (strpos($w,'AND') === 0) $w = substr($w,3);
			if (strpos($w,'OR') === 0) $w = substr($w,2);
			if ($state == '(') 	$state.= "$w";
			else $state.= " ".$group->getType()." $w";
		}
		foreach ($new_like as $l){
			$l = trim(str_replace($group->getType(),'',$l));
			if ($state == '(') 	$state.= "$l";
			else $state.= " ".$group->getType()." $l";
		}
		$state.= ")";

		// Restore the origin like/where array
		$this->ar_like = $ar_like;
		$this->ar_where = $ar_where;

		// Insert state into query
		$this->_where($state);

		return $this;
	}
}