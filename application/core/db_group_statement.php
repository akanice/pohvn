<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Group statement for Active Record Class
 *
 * Creator: Drkdra of CR Team
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		Drkra
 */

class groupStatement {
	// Type of the group
	protected $_statementType;
	public $ar_where = array();
	public $ar_like = array();
	public $ar_group = array();

	// Set type of the group
	public function __construct($type='AND'){
		$this->_statementType = $type;
	}

	/**
	 * GetType
	 *
	 * Get type of the group
	 *
	 * @return	string
	 */
	public function getType(){
		return $this->_statementType;
	}

	/**
	 * Where
	 *
	 * Generates the WHERE portion of the query.
	 *
	 * @param	mixed
	 * @param	mixed
	 * @return	object
	 */
	public function where($key,$value='',$escape=true){
		if (is_a($key,'groupStatement')){
			// Prevent insert self to the group
			if ($this === $key){
				return $this;
			}
			$this->ar_group[] = $key;
			return $this;
		}
		$newData = array(
			'key' => $key,
			'value' => $value,
			'not' => '',
			'whereIn' => false,
			'escape' => $escape
		);
		$this->ar_where[] = $newData;

		return $this;
	}

	public function where_in($key,$value){
		$newData = array(
			'key' => $key,
			'value' => $value,
			'not' => '',
			'whereIn' => true
		);
		$this->ar_where[] = $newData;

		return $this;
	}

	public function where_not_in($key,$value){
		$newData = array(
			'key' => $key,
			'value' => $value,
			'not' => 'NOT',
			'whereIn' => true
		);
		$this->ar_where[] = $newData;

		return $this;
	}

	public function like($key,$value='',$side='both'){
		$newData = array(
			'key' => $key,
			'value' => $value,
			'not' => '',
			'side' => $side
		);
		$this->ar_like[] = $newData;

		return $this;
	}

	public function not_like($key,$value='',$side='boot'){
		$newData = array(
			'key' => $key,
			'value' => $value,
			'not' => 'NOT',
			'side' => $side
		);
		$this->ar_like[] = $newData;

		return $this;
	}
}