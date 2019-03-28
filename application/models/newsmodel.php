<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NewsModel extends MY_Model {
    protected $tableName = 'news';

    protected $table = array(
        'id'               => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'order'            => array(
            'isIndex'  => true,
            'nullable' => true,
            'type'     => 'integer'
        ),
        'categoryid'       => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'title'            => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'alias'            => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'description'      => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'content'          => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'image'            => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'thumb'            => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'meta_title'       => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'meta_keywords'    => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'meta_description' => array(
            'isIndex'  => false,
            'nullable' => true,
            'type'     => 'string'
        ),
        'create_time'      => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'count_view'       => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'type'             => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'string'
        ),
        'author_id'        => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'menu_id'          => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
        'original_date'    => array(
            'isIndex'  => false,
            'nullable' => false,
            'type'     => 'integer'
        ),
    );

    public function __construct() {
        parent::__construct();
        $this->checkTableDefine();
    }

    public function getNewestItem($limit, $language) {
        $this->db->select('news.*, news_category.name as cat_name, news_category.alias as cat_alias');
        $this->db->join('news_category', 'news.categoryid= news_category.id', 'left');
        $this->db->where('news.language', $language);
        if ($limit != "") {
            $query = $this->db->get('news', $limit);
            if ($query->num_rows() > 0) return $query->result();
            return false;
        }
    }

    public function getAllNews($limit, $offset, $language) {
        $this->db->select('news.*, news_category.name as cat_name, news_category.alias as cat_alias');
        $this->db->join('news_category', 'news.categoryid= news_category.id', 'left');
        $this->db->where('news.language', $language);
        $this->db->order_by("id", "DESC");
        if ($limit != "") {
            $query = $this->db->get('news', $limit, $offset);
            if ($query->num_rows > 0) return $query->result();
            return false;
        }
    }

    public function getNewsByCategoryId($cat_id, $limit, $offset) {
        $this->db->select('news.title,news.id');
        $this->db->join('news_category', 'news.categoryid= news_category.id', 'left');
        $this->db->like('news.categoryid', $cat_id);
        $this->db->order_by('id', 'DESC');
        if ($limit != "") {
            $query = $this->db->get('news', $limit, $offset);
        } else {
            $query = $this->db->get('news');
        }
        if ($query->num_rows() > 0) return $query->result();
        return false;
    }

    public function getRelatedNews($cat_id, $limit = 5) {
        $this->db->select("news.title,news.alias,news.thumb");
        $this->db->like('news.categoryid', $cat_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('news', $limit);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getListNews($title, $news_array='', $category, $limit = 10, $offset) {
		if ($news_array) {
			$news_array_sql = '(' . implode(',', $news_array) .')';
			$news_array_pure = implode(',', $news_array);

			if ($category) {
				$query = $this->db->query("
					(select news.*, admins.name as author_name, 0 as Priority
					from news
					left join news_category on news.categoryid= news_category.id
					left join admins on news.author_id = admins.id
					where news.type = 'default' and news.id in " . $news_array_sql . " and news.categoryid like '%"  . $category . "%')
				union
					(select news.*, admins.name as author_name, 1 as Priority
					from news
					left join news_category on news.categoryid= news_category.id
					left join admins on news.author_id = admins.id
					where news.type = 'default' and news.id not in ". $news_array_sql . " and news.categoryid like '%"  . $category . "%')
					ORDER BY Priority,FIELD( id," . $news_array_pure . ")
				limit " . $limit . " offset " . $offset);
			} else {
				$query = $this->db->query("
					(select news.*, admins.name as author_name, 0 as Priority
					from news
					left join news_category on news.categoryid= news_category.id
					left join admins on news.author_id = admins.id
					where news.type = 'default' and news.id in " . $news_array_sql . ")
				union
					(select news.*, admins.name as author_name, 1 as Priority
					from news
					left join news_category on news.categoryid= news_category.id
					left join admins on news.author_id = admins.id
					where news.type = 'default' and news.id not in ". $news_array_sql . ")
					ORDER BY Priority,FIELD( id," . $news_array_pure . ")
				limit " . $limit . " offset " . $offset);
			}
		} else {
			$this->db->select('news.*');
			$this->db->join('news_category', 'news.categoryid= news_category.id', 'left');
			$this->db->where('news.type', 'default');
			$this->db->like('news.title', $title);
			$this->db->order_by("news.id", "desc");
			if ($category != "") {
				$this->db->like('news.categoryid', $category);
			}
			$query = $this->db->get('news', $limit, $offset);
		}
        // Method 2
		// $query = $this->db->query("
				// (select news.*, admins.name as author_name, 0 as Priority
				// from news
				// left join news_category on news.categoryid= news_category.id
				// left join admins on news.author_id = admins.id
				// where news.type = 'default' and news.id in " . $news_array_sql . " and news.categoryid like '%"  . $category . "%')
			// union
				// (select news.*, admins.name as author_name, 1 as Priority
				// from news
				// left join news_category on news.categoryid= news_category.id
				// left join admins on news.author_id = admins.id
				// where news.type = 'default' and news.id not in ". $news_array_sql . " and news.categoryid like '%"  . $category . "%')
				// ORDER BY Priority,FIELD( id," . $news_array_pure . ")
			// limit " . $limit . " offset " . $offset);
			
			// print_r($this->db->last_query());  
			
		$result[] = array();
		$rs_array = $query->result();	
		if ($rs_array) {
            foreach ($rs_array as $n => $value) {
                $cat_array = array();
                $result[$n] = $value;
                $cat_array = json_decode($value->categoryid);
                $v = array();
                foreach ($cat_array as $key => $value2) {
                    $this->db->select('news_category.id,news_category.title,news_category.alias');
                    $this->db->where('news_category.id', $value2);
                    $query3 = $this->db->get('news_category')->row();

                    $x[$key]['id'] = $query3->id;
                    $x[$key]['title'] = $query3->title;
                    $x[$key]['alias'] = $query3->alias;

                    $v[] = $x[$key];
                }
                $result[$n]->categoryid = ($v);
            }
            return $result;
        } else {
            return false;
        }

    }

    public function getCountNew($name, $category, $limit, $offset) {
        $this->db->select('news.*');
        $this->db->from($this->tableName);
        $this->db->like('news.title', $name);
        if ($category != "") {
            $this->db->where('news.categoryid', $category);
        }
        return $this->db->count_all_results();
    }

    public function readCountNew($category_id) {
        $this->db->select('news.*');
        $this->db->from($this->tableName);
        $this->db->like('news.categoryid', $category_id);
        return $this->db->count_all_results();
    }

    public function getNewsSearch($keyword, $category, $limit = "", $offset) {
        /*        $this->db->select('news.*,admins.name as author_name');
                $this->db->join('admins', 'news.author_id = admins.id', 'left');
                $this->db->where('news.type', 'default');

                if ($keyword != "") {
                    $this->db->like('news.title', $keyword);
                    $this->db->or_like('news.content', $keyword);
                }
                if ($limit != "") $this->db->limit($limit, $offset);
                $query = $this->db->get('news');*/

        $query = $this->db->query(" select * from (
				select * , 1 as rank from news where title like '%" . $keyword . "%'
				union
				select * , 2 as rank from news where content like '%" . $keyword . "%'
            ) as data
			group by id
			order by rank,count_view DESC limit " . $limit . " offset " . $offset);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            /*$resultTitle = array();
            $resultContent = array();
            foreach ($result as $record) {
                if (strrpos($record->title, $keyword) !== false) $resultTitle[] = $record;
                else $resultContent[] = $record;
            }
            $result = $resultTitle + $resultContent;*/
            return $result;
        }
        return false;
        //return $res ? $res->result() : false;
    }

    public function get_random_news_array($cat_array = array(), $limit = 2) {
        $v = array();
        foreach ($cat_array as $n => $value) {
            // echo $n;
            $this->db->select('news.id');
            $this->db->like('categoryid', $value);
            $query_news = $this->db->get('news');
            if ($query_news->num_rows() > 0) {
                $temp = $query_news->result_array();
                if ($temp) {
                    foreach ($temp as $m) {
                        $array_temp[] = $m['id'];
                    }
                }
            }
        }
        $random_array = array_rand($array_temp, $limit);
        for ($i = 0; $i < $limit; $i++) {
            $temp[$i] = $array_temp[$random_array[$i]];
        }
        //print_r($temp);

        foreach ($temp as $id) {
            $this->db->select('news.*');
            $this->db->where('news.id', $id);
            $query = $this->db->get('news');
            if ($query->num_rows() > 0) {
                $result[] = $query->result();
            }
        }
        return $result;
    }

    public function get_random_news_single($item, $limit = 2) {
        // echo $n;
        $this->db->select('news.id');
        $this->db->like('categoryid', $item);
        $query_news = $this->db->get('news');
        if ($query_news->num_rows() > 0) {
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
        for ($i = 0; $i < $limit; $i++) {
            $temp[$i] = $array_temp[$random_array[$i]];
        }
        foreach ($temp as $id) {
            $this->db->select('news.*');
            $this->db->where('news.id', $id);
            $query = $this->db->get('news');
            if ($query->num_rows() > 0) {
                $result[] = $query->result();
            }
        }
        return $result;
    }

    // landing page
    public function getListLandingpage($name, $limit = 15, $offset) {
        $this->db->select('news.*,landing_page.total_price as total_price');
        $this->db->join('landing_page', 'news.id= landing_page.news_id', 'left');
        $this->db->where('news.type', 'landing');
        $this->db->like('news.title', $name);
        $this->db->order_by('news.id', "desc");

        //$this->db->db_debug = true;
        if ($limit != '') {
            $query = $this->db->get('news', $limit, $offset);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        } else {
            $query = $this->db->get('news');
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
    }
	
    function update_counter($alias) {
        // return current article views
        $this->db->where('news.alias', urldecode($alias));
        $this->db->select('news.count_view');
        $count = $this->db->get('news')->row();
        // then increase by one
        $this->db->where('news.alias', urldecode($alias));
        $this->db->set('news.count_view', ($count->count_view + 1));
        $this->db->update('news');
    }

}
