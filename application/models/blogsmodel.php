<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BlogsModel extends MY_Model {
    protected $tableName = 'blog';
    
    protected $table = array(
        'id' =>  array(
            'isIndex'   => true,
            'nullable'  => true,
            'type'      => 'integer'
        ),
        'categoryid' => array(
            'isIndex'   => false,
            'nullable'  => false,
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
        'short_des' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
		'description' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'content' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'image' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'thumb' => array(
            'isIndex'   => false,
            'nullable'  => false,
            'type'      => 'string'
        ),
        'tag' => array(
            'isIndex'   => false,
            'nullable'  => false,
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
        'meta_title' => array(
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
        )
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }
	
	public function getListBlogs($name,$category,$language,$limit,$offset){
        $this->db->select('blog.*,blog_category.name as cat_name');
        $this->db->join('blog_category','blog.categoryid= blog_category.id','left');
        $this->db->like('blog.title', $name);
		$this->db->order_by('id','DESC');
        if($category != "") {
            $this->db->where('blog.categoryid', $category);
        }
        if($language != "") {
            $this->db->where('blog.language', $language);
        }
        if($limit != ""){
            $query= $this->db->get('blog',$limit,$offset);
            if($query->num_rows>0) return $query->result();
            return false;
        }
        else {
            $query = $this->db->get('blog');
        }
        if($query->num_rows>0) return $query->result();
        return false;
    }
	
	public function getAllBlog($limit,$offset,$language) {
		$this->db->select('blog.*, blog_category.name as cat_name, blog_category.alias as cat_alias');
		$this->db->join('blog_category','blog.categoryid= blog_category.id','left');
		$this->db->where('blog.language',$language);
		$this->db->order_by("id", "DESC");
		if($limit != ""){
            $query= $this->db->get('blog',$limit,$offset);
            if($query->num_rows>0) return $query->result();
            return false;
        }
	}
    public function search($tags,$category,$language,$limit="",$offset){
        $this->db->select('blog.*,blog_category.name as cat_name');
        $this->db->join('blog_category','blog.categoryid= blog_category.id','left');
        //$this->db->like('blog.title', $name);
        if($category != "") {
            $this->db->where('blog_category.alias', $category);
        }
        if($tags != "") {
            $this->db->like('blog.tag', $tags);
        }
        if($language != "") {
            $this->db->where('blog.language', $language);
        }
        if($limit != "") $this->db->limit($limit,$offset);
            $query = $this->db->get('blog');
      
        if($query->num_rows>0) return $query->result();
        return false;
    }
    public function countSearch($tags,$category,$language){
        $this->db->select('blog.*,blog_category.name as cat_name');
        $this->db->join('blog_category','blog.categoryid= blog_category.id','left');
        //$this->db->like('blog.title', $name);
        if($category != "") {
            $this->db->where('blog_category.alias', $category);
        }
         if($tags != "") {
            $this->db->like('blog.tag', $tags);
        }
        if($language != "") {
            $this->db->where('blog.language', $language);
        }
       
            return  $this->db->count_all_results('blog');
      
    }

    public function getRelatedTour($alias,$limit){
        if (isset($alias)) {
            $this->db->where('alias',$alias);
            $query = $this->db->get('blog');
            if($query->num_rows==0) return false;
            else {
                $r = $query->first_row();
                if($r->tag){
                    $r->tag = explode(',',$r->tag);
                    foreach (($r->tag) as $t) {
                        $this->db->or_like("tours_listing.tag", $t);
                    }
                    $query2 = $this->db->get("tours_listing",$limit);
                    if ($query2->num_rows()>0) return $query2->result();
                }
                return false;
            }
        }
    }
}