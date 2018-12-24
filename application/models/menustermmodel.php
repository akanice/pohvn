<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MenustermModel extends MY_Model {
    protected $tableName = 'menus_term';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'menu_id' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'name' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'position' => array(
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
        $this->db->select('news.*,news_category.name as cat_name');
        $this->db->join('news_category','news.categoryid= news_category.id','left');
        $this->db->like('news.title', $name);
        if($category != "") {
            $this->db->where('news.categoryid', $category);
        }
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
}