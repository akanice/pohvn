<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsCategoryModel extends MY_Model {
    protected $tableName = 'news_category';
    protected $_sortedCategories = array();
	
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
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
		'parent_id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
		'description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_title' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_description' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'meta_keywords' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'language' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'banner_top_display' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
		'banner_bottom_display' => array(
            'isIndex'   => false,
            'nullable'  => true,
            'type'      => 'string'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	public function getNewsByCategory($cat_alias='') {
		if (isset($cat_alias)) {
			$this->db->select("news.*,news_category.title as cat_name, news_category.alias as cat_alias");
			$this->db->join('news_category','news.categoryid = news_category.id','left');
			$this->db->where('news_category.alias', $cat_alias);
			$query = $this->db->get('news');
			if($query->num_rows()>0) return $query->result();
			else return false;
		}
	}
	
	public function get_categories($title,$limit,$offset) {
		if ($title) {
			$this->db->select('*');
			$this->db->like('news_category.title',$title);
			$query = $this->db->get('news_category',$limit,$offset);
			if($query->num_rows()>0) return $query->result();
			else return false;
		}
		
		$this->db->where('news_category.parent_id',0);
		$this->db->order_by('id','desc');
		$query = $this->db->get('news_category',$limit,$offset);
		$return = array();

		foreach ($query->result() as $category) {
			$return[$category->id] = $category;
			$return[$category->id]->sub_cat = $this->get_sub_categories($category->id); // Get the categories sub categories
		}
		return $return;
	}


	public function get_sub_categories($category_id) {
		$this->db->where('news_category.parent_id', $category_id);
		$query = $this->db->get('news_category');
		return $query->result();
	}
	
	protected function _nForLoop($data, $parent = "0", $level = 1) {
        foreach ($data as $key => $value) {
            if ($value["parent_id"] == $parent) {
                $this->_sortedCategories[] = array("id" => $value["id"], "title" => $value["title"], "alias" => $value["alias"], "parent_id" => $value["parent_id"], "level" => $level);
                // next loop
                $this->_nForLoop($data, $value["id"], $level + 1);
            }
        }
    }

    public function getSortedCategories($title='') {
        if ($title) {
			$this->db->select('*');
			$this->db->like('news_category.title',$title);
			$this->db->or_like('news_category.alias',$title);
			$this->db->order_by('news_category.id','desc');
			foreach ($this->db->get('news_category')->result_array() as $key => $value) {
				$this->_sortedCategories[] = array("id" => $value["id"], "title" => $value["title"], "alias" => $value["alias"], "level" => 1);
			}
			return $this->_sortedCategories;
		}
		$this->_nForLoop($this->db->get('news_category')->result_array());
        return $this->_sortedCategories;
    }

    public function readCountNewsCategories() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('news_category.parent_id', 0);
        return $this->db->count_all_results();
    }
	
	public function getNewsOrderedInCat() {
		$this->db->select('news_category.id, news_categorytitle, news_order.news_array');
		$this->db->join('news_order', 'news_order.categoryid = news_category.id', 'left');
		$query = $this->db->get('news_category');
		if ($query->num_rows() > 0) {
			$cat_array = $query->result();
			foreach ($cat_array as $n => $value) {
				echo $n;
				// $this->db->select('news.title');
				// $this->db->where('news.id', $value);
				// $query_news = $this->db->get('news');
				// if ($query_news->num_rows() > 0) {
					// $temp = $query_news->result_array();
					// if ($temp) {
						// foreach ($temp as $m) {
							// $array_temp[] = $m['id'];
						// }
					// }
				// }
			}
			die();
		}
	}		
}
