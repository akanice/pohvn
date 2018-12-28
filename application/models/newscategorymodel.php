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
        )
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
	
	public function get_categories() {
		$this->db->where('news_category.parent_id',0);
		$query = $this->db->get('news_category');
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

    public function getSortedCategories() {
        $this->_nForLoop($this->db->get('news_category')->result_array());
        return $this->_sortedCategories;
    }
		
}