<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menus extends MY_Controller{
    private $data;
    protected $types = array('');
    function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        $this->auth->check();
        $this->data['email_header'] = $this->session->userdata('adminemail');
        $this->data['all_user_data'] = $this->session->all_userdata();
        $this->load->model('menusmodel');
        $this->load->model('menustermmodel');
        $this->load->library('auth');
	}
    public function index(){
        //Load List menu that show on vertical menu list
        $this->data['title']    = 'Quản lý các loại menu';
        $this->data['list'] = $this->menustermmodel->read(array(),array());
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/menus/list');
        $this->load->view('admin/common/footer');
    }
    public function addItem($id='') {
        $this->data['menu'] = $this->menustermmodel->read(array('id'=>$id),array(),true);
        $this->data['menus'] = $this->menustermmodel->read(array(),array());
		$this->data['childs'] = $this->menusmodel->read(array("menu_id"=>$id));

		$results = $this->data['results'] = json_decode(json_encode($this->data['childs']), true);
		
		if ($this->input->post("parent") == 0 || $this->input->post("parent") == '') {
			$parent = null;
		} else {
			$parent = $this->input->post("parent");
		} 
		$type_url = $this->input->post('type_url');
		if ($this->input->post('slug')) $slug = $this->input->post('slug');
		switch ($type_url) {
			case "t_landing":
				$this->load->model('newsmodel');
				$alias = $this->newsmodel->read(array('id'=>$slug),array(),true)->alias;
				$slug = '/'.$alias;
				break;
			case "t_cat":
				$this->load->model('newscategorymodel');
				$cat_data = $this->newscategorymodel->read(array('id'=>$slug),array(),true);
				// if ($cat_data->parent != 0) {$cat_alias = $cat_data->alias;} else {
					//$cat_parent_data = $this->newscategorymodel->read(array('id'=>$cat_data->parent_id),array(),true);
					//$cat_alias = $cat_parent_data->alias.'/'.$cat_data->alias;
				// }
				$cat_alias = $cat_data->alias;
				$slug = '/category/'.$cat_alias;
				break;
			case "t_page":
				$this->load->model('pagesmodel');
				$cat_alias = $this->pagesmodel->read(array('id'=>$slug),array(),true)->alias;
				$slug = '/page/'.$cat_alias;
				break;
			case "t_link":
				$slug = $slug;
				break;
			default:
				$slug = '/#';
		}		
		
        if($this->input->post('submit') != null){
            $data = array(
                "menu_id" => $id,
                "parent" => $parent,
                "icon" => '',
                "display_name" => $this->input->post("display_name"),
                "slug" => $slug,
            );
            $this->menusmodel->create($data);
            redirect(base_url() . "admin/menus");
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/add');
            $this->load->view('admin/common/footer');
        }
    }

    public function editMenu($id){
        //Show List  Item on of menu that has type "List"
        $menu= $this->menusmodel->read(array('id'=>$id),array(),true);
        if(!isset($menu) && !$menu){
            redirect(base_url() . "admin/menus");
            exit();
        }
        if($menu->type==="mega"){
            $this->data['list']= $this->menuitemsmodel->read(array('menu_id'=>$id,'type'=>'root'));
            $this->data['base'] = site_url('admin/menus/');
            $this->data['current'] = $menu;
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/edit_mega');
            $this->load->view('admin/common/footer');
        }
        if($menu->type ==="list"){
            $this->data['menus']= $this->menuitemsmodel->read(array('menu_id'=>$id));
            $this->data['base'] = site_url('admin/menus/');
            $this->data['current'] = $menu;
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/edit_list');
            $this->load->view('admin/common/footer');
        } 
    }
    public function addMenuList($menu_id)
    {
        $menu= $this->menusmodel->read(array('id'=>$menu_id),array(),true);
         if(!isset($menu) && !$menu){
            redirect(base_url() . "admin/menus");
            exit();
        }
        $this->data['menus'] = $this->menusmodel->read();
        if($this->input->post('submit') != null){
            $data = array(
                "link" => $this->input->post("link"),
                "title" => $this->input->post("title"),
                //"language" => $menu->language,
                "menu_id"=>$menu_id,
            );
            $this->menuitemsmodel->create($data);
            redirect(base_url() . "admin/menus/editMenu/".$menu->id);
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/add_list_item');
            $this->load->view('admin/common/footer');
        }
    }
    public function editMenuList($id)
    {
        $menu= $this->menuitemsmodel->read(array('id'=>$id),array(),true);
         if(!isset($menu) && !$menu){
            redirect(base_url() . "admin/menus");
            exit();
        }
        $this->data['menu'] = $menu;
        if($this->input->post('submit') != null){
            $data = array(
                "link" => $this->input->post("link"),
                "title" => $this->input->post("title"),
            );
            $this->menuitemsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/menus/editMenu/".$menu->menu_id);
            exit();
        }
        else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/edit_list_item');
            $this->load->view('admin/common/footer');
        }
    }
    public function deleteMenuList($id){
         if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->menuitemsmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/menus");
            exit();
        }
    }
    public function deleteMenu($id){
         if(isset($id)&&($id>0)&&is_numeric($id)){
            $this->menusmodel->delete(array('id'=>$id));
            redirect(base_url() . "admin/menus");
            exit();
        }
    }
    //Start for edit mega
    // public function editMega($mega_id){
    //     $menu_root = $this->menusmodel->read(array('type'=>'root'),array());
    //     $menu_col = $this->menusmodel->readCount(array('type'=>'root'));
    //     $this->data['menus'] = $menu_root;
    //     $this->data['base'] = site_url('admin/menus/');
    //     $this->load->view('admin/common/header',$this->data);
    //     $this->load->view('admin/menus/index');
    //     $this->load->view('admin/common/footer');
    // }
    public function addRoot($menu_id){
        $menu_col = $this->menuitemsmodel->readCount(array('type'=>'root','menu_id'=>$menu_id));
        $content_type = $this->input->post("content_type");
        $title = $this->input->post("title");
        if($menu_col>3){
            redirect(base_url('admin/menus'));
            exit();
        }
        $this->menuitemsmodel->create(array('type'=>'root','title'=>$title,'content_type'=>$content_type,'menu_id'=>$menu_id));
        redirect(base_url('admin/menus/editMenu/'.$menu_id));
        exit();
    }
    public function deleteRoot($root_id){
        if(isset($root_id) && is_numeric($root_id) && $root_id>0)
        $root = $this->menuitemsmodel->read(array('id'=>$root_id),array(),true);
        $this->menuitemsmodel->delete(array('id'=>$root_id));
        if(!$root){
            redirect(base_url('admin/menus'));
            exit();
        }
        else{
            redirect(base_url('admin/menus/editMenu/'.$root->menu_id));
            exit();   
        }
    }
    public function editRoot($id){
        $root = $this->menuitemsmodel->read(array('id'=>$id,'type'=>'root'),array(),true);
        //print_r($root);die();
        if(!isset($root)){
            redirect(base_url('admin/menus'));
            exit();   
        }
        $title = $this->input->post("title");

        if($title && isset($title) && $title!==$root->title){
            $this->menuitemsmodel->update(array('title'=>$title),array('id'=>$id,'type'=>'root'));
            redirect(base_url('admin/menus/editMenu/'.$root->menu_id));
        }
        $this->data['menu'] = $root;
        $this->data['base'] = site_url('admin/menus/');
        switch ($root->content_type) {
            case 'text':
                $content = $this->input->post('content');
                if($content && isset($content) ){
                    $this->menuitemsmodel->update(array('content'=>$content),array('id'=>$id,'type'=>'root'));    
                    redirect(base_url('admin/menus/editMenu/'.$root->menu_id));
                }
                $this->load->view('admin/common/header',$this->data);
                $this->load->view('admin/menus/editMegaText');
                $this->load->view('admin/common/footer');
                break;
            case 'custom':
                $this->data['type']  = "custom";
				$content = $this->input->post('content');
				$link = $this->input->post('menu_link');
                if($content && isset($content) ){
                    $this->menuitemsmodel->update(array('content'=>$content,'link'=>$link),array('id'=>$id,'type'=>'root'));    
                    redirect(base_url('admin/menus/editMenu/'.$root->menu_id));
                }
                $this->load->view('admin/common/header',$this->data);
                $this->load->view('admin/menus/editMegaCustom');
                $this->load->view('admin/common/footer');
                break;
            case 'gallery':
                $this->data['type']  ="gallery";
                $this->data['list'] = $this->menuitemsmodel->read(array('type'=>'item','parent_id'=>$id));
                $this->load->view('admin/common/header',$this->data);
                $this->load->view('admin/menus/editMegaItem');
                $this->load->view('admin/common/footer');
                break;
            default:
                # code...
                break;
        }
    }
    public function addMegaColItem($id){
        $this->data['type']  ="list";
        $this->data['current'] = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $data = array(
                "title"              => $this->input->post("title"),
                "parent_id"           => $id,
                "link"         => $this->input->post("link"),
            );
            $this->menuitemsmodel->create($data);
            redirect(base_url() . "admin/menus/editRoot/".$id);
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/addMegaColItem');
            $this->load->view('admin/common/footer');
        }
    }
     public function editMegaColItem($id){
         $this->data['edit'] ="false";
        $this->data['type']  ="list";
        $this->data['item'] = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $data = array(
                "title"              => $this->input->post("title"),
                "link"         => $this->input->post("link"),
            );
            $this->menuitemsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/menus/editRoot/". $this->data['current']->parent_id);
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/addMegaColItem');
            $this->load->view('admin/common/footer');
        }
    }
    public function addMegaColItemGallery($id){
         $this->data['edit'] ="false";
        $this->data['type']  ="gallery";
        $this->data['current'] = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/menus/';
            $this->load->library("upload");

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = 'assets/img/square4.jpg';
            }
            $data = array(
                "parent_id"           => $id,
                "thumbs"             => $image,
                "link"         => $this->input->post("link"),
            );
            $this->menuitemsmodel->create($data);
            redirect(base_url() . "admin/menus/editRoot/".$id);
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/addMegaColItemGallery');
            $this->load->view('admin/common/footer');
        }
    }
     public function editMegaColItemGallery($id){
        $this->data['type']  ="list";
        $this->data['edit'] ="true";
        $this->data['item'] = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        if($this->input->post('submit') != null){
            $uploaddir = 'assets/uploads/menus/';
            $this->load->library("upload");

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaddir . basename($_FILES['image']['name']))) {
                $image = $uploaddir . $_FILES['image']['name'];
            }
            else{
                $image = 'assets/img/square4.jpg';
            }
            $data = array(
                "thumbs"             => $image,
                "link"         => $this->input->post("link"),
            );
            $this->menuitemsmodel->update($data,array('id'=>$id));
            redirect(base_url() . "admin/menus/editRoot/". $this->data['item']->parent_id);
            exit();
        } else {
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/addMegaColItemGallery');
            $this->load->view('admin/common/footer');
        }
    }
    public function deleteMegaItem($id){
        if(isset($id) && is_numeric($id) && $id>0)
        $root = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        $this->menuitemsmodel->delete(array('id'=>$id));
        if(!$root){
            redirect(base_url('admin/menus'));
            exit();
        }
        else{
            redirect(base_url('admin/menus/editRoot/'.$root->parent_id));
            exit();   
        }
    }
    public function changeMenuTitle($id){
        $title= $this->input->post('title');
        $this->menusmodel->update(array('title'=>$title),array('id'=>$id));
    }
    public function footer(){
        $this->data['title']    = 'Quản lý footer menu';

        $menu_root = $this->menusmodel->read($filter,array());
        $menu_col = $this->menusmodel->readCount(array());
        $this->data['menus'] = $menu_root;
        $this->data['base'] = site_url('admin/menus/footer');
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/menus/footer');
        $this->load->view('admin/common/footer');
    }
    public function addFooterCol(){
        $menu_col = $this->menusmodel->readCount(array('nav'=>'0'));
        if(isset($_POST['submit'])){
            $title = $this->input->post("title");
            $language = $this->input->post("language");
            if($menu_col>3){
                redirect(base_url('admin/menus'));
                exit();
            }
            $this->menusmodel->create(array('nav'=>'0','title'=>$title));
            redirect(base_url('admin/menus/footer/'));
            exit();     
        }else{
            $this->load->view('admin/common/header',$this->data);
            $this->load->view('admin/menus/add_footer_col');
            $this->load->view('admin/common/footer');
        }
       
    }
    public function editFooterCol($id){
        $this->data['title']    = 'Quản lý footer menu';
        $this->data['nav'] =false;
        $filter = array('menu_id'=>$id);
        $title = $this->input->get("title");
        $link = $this->input->get("link");
        if($title!=null && $title !="")
            $filter['title'] = $title;
        if($link!=null && $link !="")
            $filter['link'] = $link;   
        $menu_root = $this->menuitemsmodel->read($filter,array());
        $this->data['menus'] = $menu_root;
        $this->data['base'] = site_url('admin/menus/editFooterCol');
        if(isset($_POST['submit'])){
            $data = array('menu_id'=>$id);
            $title = $this->input->post("title");
            $link = $this->input->post("link");
            if($title!=null && $title !="")
                $data['title'] = $title;
            if($link!=null && $link !="")
                $data['link'] = $link;
            $this->menuitemsmodel->create($data);
            redirect(base_url('admin/menus/editFooterCol/'.$id));
            exit();  
        }
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/menus/edit_footer_col');
        $this->load->view('admin/common/footer');
    }
    public function editFooterColItem($id){
        $this->data['title']    = 'Quản lý footer menu';
        $this->data['nav'] =false;
        $menu = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        $parent = $this->menusmodel->read(array('id'=>$menu->menu_id),array(),true);
        $this->data['menu'] = $menu;
        $this->data['parent'] = $parent;
        if(isset($_POST['submit'])){
            $title = $this->input->post("title");
            $link = $this->input->post("link");
            if($title!=null && $title !="")
                $data['title'] = $title;
            if($link!=null && $link !="")
                $data['link'] = $link;
            $this->menuitemsmodel->update($data,array('id'=>$id));
            redirect(base_url('admin/menus/editFooterCol/'.$menu->menu_id));
            exit();  
        }
        $this->load->view('admin/common/header',$this->data);
        $this->load->view('admin/menus/edit_footer_col_item');
        $this->load->view('admin/common/footer');
    }
    public function deleteFooterColItem($id){
        $root = $this->menuitemsmodel->read(array('id'=>$id),array(),true);
        $this->menuitemsmodel->delete(array('id'=>$id));
        redirect(base_url('admin/menus/editFooterCol/'.$root->menu_id));
        exit();   
    }

    public function deleteFooterCol($id){
        $this->menusmodel->delete(array('id'=>$id));
        redirect(base_url('admin/menus/footer/'.$menu_id));
        exit();   
    }
   


}