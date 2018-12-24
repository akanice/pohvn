<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of MY_Controller
 *
 * @author drkdra
 */
class MY_Model extends CI_Model {
	protected $table = array();
	protected $tableName = '';


	private $columnType = array('integer','string','double');

	public function __construct() {
		parent::__construct();
	}

	public function create($data,$multi=false){
		$result = false;
		if ($multi){
			foreach ($data as &$d){
				$d = $this->checkData($d);
			}

			$result = $this->db->insert_batch($this->tableName,$data);
		}else{
            $data = $this->checkData($data);
            $result = $this->db->insert($this->tableName,$data);
		}
		if ($result){
			return $this->db->insert_id();
		}
		return $result;
	}

	public function read($where=array(),$order=array(),$getFirst=false,$limit=0,$limit2=0,$returnResult=true){
		$this->db->from($this->tableName);

		$this->checkWhere($where);

		foreach ($order as $field => $val){
			if (!isset($this->table[$field])){
				$this->error();
			}

			if ($val){
				$this->db->order_by($this->tableName.'.'.$field,'asc');
			}else{
				$this->db->order_by($this->tableName.'.'.$field,'desc');
			}
		}

		if ($limit){
			if ($limit2){
				$this->db->limit($limit,$limit2);
			}else{
				$this->db->limit($limit);
			}
		}

        if ($returnResult){
            if ($getFirst){
                return $this->db->get()->first_row();
            }else{
                return $this->db->get()->result();
            }
        }else{
            return $this->db->get();
        }
	}

	public function readCount($where=array()){
		$this->db->from($this->tableName);

		$this->checkWhere($where);

		return $this->db->count_all_results();
	}

	public function update($data=array(),$where=array()){
		$this->checkWhere($where);

		$data = $this->checkData($data);
		$result = $this->db->update($this->tableName,$data);

		return $result;
	}

	public function delete($where = array()){
		$this->checkWhere($where);

		$this->db->delete($this->tableName);

		return true;
	}
	
	function uploadFile($name,$dir='./assets/uploads/'){
        if (!file_exists($dir) || !is_dir($dir)) mkdir($dir,0777,true);

        $config = array();
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '204800';
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        $return = array('ok'=>false);
        if (!$this->upload->do_upload($name)){
            $return = array('ok'=>false,'msg'=>$this->upload->display_errors());
        }else{
            $return = array('ok' => true, 'msg' => 'Ok', 'data' => $this->upload->data());
        }

        return $return;
    }

	protected function checkTableDefine(){
		if (!$this->tableName){
			$this->error();
		}

		if (!is_array($this->table)){
			$this->error();
		}

		foreach ($this->table as $field => $detail){
			if (!$field){
				$this->error();
			}

			if (!is_array($detail)){
				$this->error();
			}

			if (!isset($detail['isIndex']) || !isset($detail['nullable']) ||!isset($detail['type'])){
				$this->error();
			}

			if (!in_array($detail['type'],$this->columnType)){
				$this->error();
			}
		}

		return true;
	}

	private function checkData($data){
		foreach ($data as $field => &$val){
			if (!isset($this->table[$field])){
				$this->error('Trường không tồn tại : '.$field);
			}

			if (!$this->checkType($val, $this->table[$field]['type'])){
				$this->error('Sai kiểu: '.$field);
			}

			if (!$this->table[$field]['nullable'] && (is_null($val))){
				$this->error("Trường không được trống: $field");
			}

			if ($this->table[$field]['type'] != 'string'){
			}else{
			}
		}
		return $data;
	}

	private function checkWhere($where=array()){
		if (!is_array($where)){
			return false;
		}
		foreach ($where as $field => $val){
            $this->checkField($field,$val);
		}
	}

    private function checkField($field,$val){
        $field = trim($field);
        $operator = $this->hasOperator($field);
        if ($operator){
            $field = trim(str_replace($operator,'',$field));
        }else{
            $operator = '';
        }
        if (!isset($this->table[$field])){
            $this->error("Trường không tồn tại $field");
        }

        if (!$this->checkType($val, $this->table[$field]['type'])){
            $this->error("Sai kiểu $field (".$this->table[$field]['type'].") $val");
        }

        if ($this->table[$field]['type'] != 'string'){
        }else{
        }
        $like = 0;
        if (is_array($val)){
            $inVals = array();
            $notInVals = array();
            foreach ($val as $v){
                if (strstr($v,'%')){
                    $this->checkField($field,$v);
                }elseif ($v[0] == '!'){
                    $notInVals[] = substr($v,1);
                }else{
                    $inVals[] = $v;
                }
            }
            if ($inVals) $this->db->where_in($this->tableName.'.'.$field,$inVals);
            if ($notInVals) $this->db->where_not_in($this->tableName.'.'.$field,$notInVals);
        }else if (strstr($val, '%')) {
            if ($val[0] == '!'){
                $not = true;
                $val = substr($val,1);
            }else{
                $not = false;
            }
            $like = 'none';
            if (($val[0] == '%') && ($val[strlen($val) - 1] == '%')) {
                $like = 'both';
                $val = substr($val, 1, strlen($val) - 2);
            } else if ($val[0] == '%') {
                $like = 'before';
                $val = substr($val, 1, strlen($val) - 1);
            } else if ($val[strlen($val) - 1] == '%') {
                $like = 'after';
                $val = substr($val, 0, strlen($val) - 1);
            }
            if ($not) $this->db->not_like($this->tableName . '.' . $field, $val, $like);
            else $this->db->like($this->tableName . '.' . $field, $val, $like);
        }else{
            $this->db->where($field.' '.$operator, $val);
        }
    }

    private function hasOperator($str){
        $str = trim($str);
        $matches = array();
        if (preg_match("/(\s|<>|<=|>=|!=|<|>|!|=|is null|is not null)/i", $str, $matches)){
            return $matches[0];
        }
        return false;
    }

	private function checkType($val,$type){
		if (!in_array($type,$this->columnType)){
			return false;
		}
		if (is_array($val)){
			//$flag = true;
			foreach ($val as $v){
				if(!$this->checkType($v,$type)) return false;
			}
			return true;
		}
		if ($type == 'integer'){
			return is_int((int)$val);
		}else if ($type == 'double'){
			return is_double($val);
		}else if ($type == 'string'){
			return is_string($val);
		}else{
			return false;
		}

		return true;
	}

	private function error($msg=''){
		if ($msg == ''){
			show_error('Định nghĩa bảng không đúng ('.get_class($this).')', 500);
		}else{
			show_error($msg.' ('.get_class($this).')', 500);
		}
	}
}

?>
