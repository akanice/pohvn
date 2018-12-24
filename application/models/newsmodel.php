<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsModel extends MY_Model {
    protected $tableName = 'news';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'categoryid' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'title' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'alias' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'content' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'image' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'thumb' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_title' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_keywords' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
        'create_time' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'language' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'count_view' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'integer'
        ),
		'type' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getNewestItem($limit,$language) {
		$this->db->select('news.*, news_category.name as cat_name, news_category.alias as cat_alias');
		$this->db->join('news_category','news.categoryid= news_category.id','left');
		$this->db->where('news.language',$language);
		if($limit != ""){
            $query= $this->db->get('news',$limit);
            if($query->num_rows()>0) return $query->result();
            return false;
        }
	}
	
	public function getAllNews($limit,$offset,$language) {
		$this->db->select('news.*, news_category.name as cat_name, news_category.alias as cat_alias');
		$this->db->join('news_category','news.categoryid= news_category.id','left');
		$this->db->where('news.language',$language);
		$this->db->order_by("id", "DESC");
		if($limit != ""){
            $query= $this->db->get('news',$limit,$offset);
            if($query->num_rows>0) return $query->result();
            return false;
        }
	}
	
	public function getNewByCategory($alias,$limit,$offset,$language) {
		$this->db->select('news.*, news_category.name as cat_name, news_category.alias as cat_alias');
		$this->db->join('news_category','news.categoryid= news_category.id','left');
		$this->db->where('news_category.alias', $alias);
		$this->db->where('news.language',$language);
		$this->db->order_by('id', 'DESC');
		if($limit != ""){
			$query = $this->db->get('news',$limit,$offset);
        } else {
			$query = $this->db->get('news');
		}
		if($query->num_rows>0) return $query->result();
		return false;
	}
	public function getRelatedNew($cat_alias,$new_alias,$language){
		$this->db->select("news.*,news_category.name as cat_name,news_category.alias as cat_alias");
		$this->db->join('news_category','news.categoryid = news_category.id','left');
		$this->db->where('news_category.alias',$cat_alias);
		$this->db->where("news.alias != ",$new_alias);
		$this->db->where('news.language',$language);
		$this->db->order_by('id', 'DESC');
		$query  =   $this->db->get('news',4);
		if($query->num_rows()>0) return $query->result();
		else return false;
	}
    public function getListNews($name,$category,$limit=10,$offset){
        $this->db->select('news.*,news_category.title as cat_name');
        $this->db->join('news_category','news.categoryid= news_category.id','left');
        $this->db->like('news.title', $name);
        if($category != "") {
            $this->db->where('news.categoryid', $category);
        }
		//$this->db->db_debug = true;    
        if($limit != ''){
            $query= $this->db->get('news',$limit,$offset);
            if($query->num_rows()>0) {
				return $query->result();
			} else {
				return false;
			}
        } else {
            $query = $this->db->get('news');
			if($query->num_rows()>0) {
				return $query->result();
			}
        }
    }

	public function getCountNew($name,$category,$limit,$offset){
        $this->db->select('news.*');
        $this->db->from($this->tableName);
        $this->db->like('news.name', $name);
        if($category != "") {
            $this->db->where('news.categoryid', $category);
        }
        return $this->db->count_all_results();
    }
	public function readCountNew($category_id){
        $this->db->select('news.*');
        $this->db->from($this->tableName);
        $this->db->like('news.categoryid', $category_id);
        return $this->db->count_all_results();
    }
	
	public function get_random_news_array($cat_array=array(),$limit=2) {
		$v = array();
		foreach ($cat_array as $n=>$value) {
			// echo $n;
			$this->db->select('news.id');
			$this->db->like('categoryid',$value);
			$query_news = $this->db->get('news');
			if($query_news->num_rows()>0) {
				$temp = $query_news->result_array();
				if ($temp) {
					foreach ($temp as $m) {
						$array_temp[] = $m['id'];
					}
				}
			}
		}
		$random_array = array_rand($array_temp, $limit);
		for ($i=0;$i<$limit;$i++) {
			$temp[$i] = $array_temp[$random_array[$i]];
		}
		//print_r($temp);

		foreach ($temp as $id) {
			$this->db->select('news.*');
			$this->db->where('news.id',$id);
			$query = $this->db->get('news');
			if($query->num_rows()>0) {
				$result[] = $query->result();
			}
		}
		return $result;
	}
	
	public function get_random_news_single($item,$limit=2) {
		// echo $n;
		$this->db->select('news.id');
		$this->db->like('categoryid',$item);
		$query_news = $this->db->get('news');
		if($query_news->num_rows()>0) {
			$temp = $query_news->result_array();
			if ($temp) {
				foreach ($temp as $m) {
					$array_temp[] = $m['id'];
				}
			}
		}
		$random_array = array_rand($array_temp, $limit);
		
		// echo $array_temp[$random_array[0]];
		// echo $array_temp[$random_array[1]];
		$temp = array();
		for ($i=0;$i<$limit;$i++) {
			$temp[$i] = $array_temp[$random_array[$i]];
		}
		foreach ($temp as $id) {
			$this->db->select('news.*');
			$this->db->where('news.id',$id);
			$query = $this->db->get('news');
			if($query->num_rows()>0) {
				$result[] = $query->result();
			}
		}
		return $result;
	}
}