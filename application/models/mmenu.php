<?php
 

class mmenu extends MY_Model{
    protected $table = "tkwp_menu";
    protected $table_lang = "tkwp_menu_lang";
    public function __construct(){
        parent::__construct();
        $this->load->Model("mmenu_lang");
    }
      public function getMenus($object = '', $condition = '', $order_by = 'n.id desc', $limit = '')
    {
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
        $sql .= 'inner join '.$this->table_lang.' nl on n.id = nl.menu_id';
        
        $sql .= ' where   1 ';
        if($condition){
            $sql .= ' and '.$condition;
        }
        $sql .= ' GROUP BY n.id ';

        if($order_by){
            $sql .= ' order by '.$order_by;
        }

        if($limit){
            $sql .= ' limit '.$limit;
        }
 
        $query = $this->db->query($sql);
        if(!empty($limit) && $limit=="1")
        {
            return $query->row_object();
        }
        else
        {
            return $query->result_object();
        }
    }
    public function countData($condition='')
    {
        $data = $this->getMenus('n.id',$condition);
        return count($data);
    }
    public function getList($object="",$and="",$orderby="menu_orderby asc"){
        if($object){
            $this->db->select($object);
        }
        if($and){
            $this->db->where($and);
        }
        if($orderby){
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($object="",$and=""){
        if($object){
            $this->db->select($object);
        }
        if($and){
            $this->db->where($and);
        }
        $this->db->order_by("id","desc");
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/

     /**begin danh sach*/
    public function getOnceSql($object="",$join="",$and=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' m ';
        if($join){
            $sql .= $join;
        }
        if($and){
            $sql .= ' where  1 '.$and;
        }
    
        $sql .= ' order by m.id desc';  
           
        $query = $this->db->query($sql);
        return $query->row_array();

    }
    /**end danh sach*/

    /**begin getInfoAlias*/
    public function getInfoAlias($menu_alias,$lang='vn')
    {        
        $data = array();
        if($menu_alias)
        {
            $object = 'm.id,m.menu_parent,m.menu_com,m.menu_view,m. menu_picture,ml.menu_lang_name as menu_name,ml.menu_lang_alias as menu_alias,ml.menu_lang_detail as menu_detail';
            $object .= ",ml.menu_lang_title as menu_title, ml.menu_lang_keyword as menu_keyword, ml.menu_lang_description as menu_description";
            $join = ' inner join tkwp_menu_lang ml on ml.menu_id = m.id ';
            $and = 'and menu_lang="'.$lang.'" and menu_lang_alias="'.$menu_alias.'"';
            $data = $this->getOnceSql($object,$join,$and);
        }
        // my_lib::printArr($data);
        return $data;
    }
    /**end getInfoAlias*/

    /**begin getInfoAlias*/
    public function getInfoID($id,$lang='vn')
    {        
        $data = array();
        if($id)
        {
            $object = 'm.id,m.menu_parent,m.menu_com,m.menu_view,m. menu_picture,ml.menu_lang_name as menu_name,ml.menu_lang_alias as menu_alias,ml.menu_lang_detail as menu_detail,m.menu_hdid';
            $object .= ",ml.menu_lang_title as menu_title, ml.menu_lang_keyword as menu_keyword, ml.menu_lang_description as menu_description";

            $join = ' inner join tkwp_menu_lang ml on ml.menu_id = m.id ';
            $and = 'and menu_lang="'.$lang.'" and m.id="'.$id.'"';
            $data = $this->getOnceSql($object,$join,$and);
        }
         
        return $data;
    }
    /**end getInfoAlias*/

    /**lay menu alias
    @ khi count=="TRUE" lay tat ca menu id cap con    
    */
    public function getIdParent($menu_alias='',$lang='vn')
    {        
        $menu_parent = '';
        if($menu_alias)
        {
            $object_m="m.menu_parent";
            $join_m="inner join tkwp_menu_lang ml on m.id = ml.menu_id";
            $and_m=" and ml.menu_lang_alias = '".$menu_alias."' and menu_lang='".$lang."'";
            $tmpList = $this->getOnceSql($object_m,$join_m,$and_m);
            if($tmpList){
                $menu_parent = $tmpList['menu_parent'];
            }

        }
        return $menu_parent;
    }
    /**lay menu alias
    @ khi count=="TRUE" lay tat ca menu id cap con
    @ khi count = FALSE lay id theo alias bai viet
    */
    public function getIDAnd($menu_alias='',$count=true,$lang='vn')
    {        
        $id = '';
        if($menu_alias)
        {            
            $tmpList = $this->mmenu_lang->getData("menu_id as id",array("menu_lang"=>$lang,"menu_lang_alias"=>$menu_alias),"id desc");            
            if($tmpList)
            {
                $id = $tmpList['id'].',';
                if($count==true)
                {
                    $object_menu = 'm.id';
                    $join_menu = '';
                    $and_menu = 'menu_parent='.$tmpList['id'];
                    $orderby_menu = 'm.id desc';
                    $limit_menu = '';
                    $getViewMenu = $this->getQuerySql($object_menu,$join_menu,$and_menu,$orderby_menu,$limit_menu);
                    if($getViewMenu)
                    {
                        foreach ($getViewMenu as $key => $value) {
                            $id .= $value['id'].',';
                        }
                    }
                }
                $id = rtrim($id,",");
            }

        }
        return $id;
    }

    /**begin danh sach tour*/
    public function getQuerySql($object="",$join="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' m ';
        if($join){
            $sql .= $join;
        }
        if($and){
            $sql .= ' where '.$and;
        }

        if($orderby){
            $sql .= ' order by '.$orderby;
        }

        if($limit){
            $sql .= ' limit '.$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    /**end danh sach tour*/

    /**begin dem theo query sql*/
    public function countQuery($join="",$and=""){
        $sql = 'select * from '.$this->table.' m' ;
        if($join){
            $sql .= $join;
        }
        $sql .= ' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/


    /**begin check com*/
    public function checkView($menu_alias,$lang='vn')
    {        
        $view = '';        
        $object_menu = 'm.menu_view';
        $join_menu = 'inner join tkwp_menu_lang ml on ml.menu_id = m.id';
        $and_menu = 'ml.menu_lang="'.$lang.'" and menu_lang_alias="'.$menu_alias.'"';
        $orderby_menu = 'm.id desc';
        $limit_menu = '0,1';
        $getViewMenu = $this->getQuerySql($object_menu,$join_menu,$and_menu,$orderby_menu,$limit_menu);
        $view = isset($getViewMenu[0]['menu_view']) && $getViewMenu[0]['menu_view'] ? $getViewMenu[0]['menu_view']:'';
        return $view; 
    }
    /**end check com*/

    /**begin menu top*/
    public function  getMenu($menu_parent="", $menu_home='', $lang='vn',$orderby = "menu_orderby asc"){ 
        $menu_parent = $menu_parent > 0 ? $menu_parent:1;      
        $and = array("menu_parent"=>$menu_parent,"menu_status"=>1);
        $list = $this->getList("id,menu_com,menu_hdid,menu_view",$and,$orderby);
        $data = array();
        if($list){
            foreach($list as $key => $item){
                $getLang = $this->mmenu_lang->getData(array("menu_lang_alias","menu_lang_name","menu_lang_detail"),array("menu_lang"=>'vn',"menu_id"=>$item["id"]));
				$data[$key]["sub"] = $this->getList('',array("menu_parent"=>$item["id"],"menu_status"=>1));
				$data[$key]["id"] = $item["id"];
                $data[$key]["menu_com"] = $item["menu_com"];
                $data[$key]["menu_view"] = $item["menu_view"];
                $data[$key]["menu_hdid"] = $item["menu_hdid"];
                if($getLang){
                    $data[$key]["menu_detail"] = strip_tags($getLang["menu_lang_detail"]);
                    $data[$key]["menu_name"] = $getLang["menu_lang_name"];
                    $data[$key]["menu_alias"] = $getLang["menu_lang_alias"];
					if(count($data[$key]["sub"])){
						foreach($data[$key]["sub"] as $k=>$v){
							$getLang2 = $this->mmenu_lang->getData(array("menu_lang_alias","menu_lang_name","menu_lang_detail"),array("menu_lang"=>'vn',"menu_id"=>$data[$key]["sub"][$k]['id']));
							$data[$key]["sub"][$k]['menu_name'] = $getLang2["menu_lang_name"];
							$data[$key]["sub"][$k]["menu_alias"] = $getLang2["menu_lang_alias"];
							// level 3
							$data[$key]["sub"][$k]['sub2'] = $this->getList('',array("menu_parent"=>$v["id"],"menu_status"=>1));
							if(count($data[$key]["sub"][$k]['sub2'])){ //p($data[$key]["sub"][$k]['sub2']) ;
								foreach($data[$key]["sub"][$k]['sub2'] as $kk=>$vv){
									$getLang3 = $this->mmenu_lang->getData(array("menu_lang_alias","menu_lang_name","menu_lang_detail"),array("menu_lang"=>'vn',"menu_id"=>$vv['id']));
									 $data[$key]["sub"][$k]['sub2'][$kk]['menu_name'] = $getLang3["menu_lang_name"];
									 $data[$key]["sub"][$k]['sub2'][$kk]["menu_alias"] = $getLang3["menu_lang_alias"];
								 //	p($getLang3 ) ;
								} 
							}
							// end
						}
					}
                }else{
                    $data[$key]["menu_name"] = "";
                }
            }
        }
        return $data;
		 
    }
    /**end menu top*/

    /**begin menu home*/
    public function  getHome($menu_parent='', $lang='vn'){
        $and = array("menu_home"=>1,"menu_status"=>1);
        if(!empty($menu_parent))
        {
            $and = array("menu_home"=>1,"menu_status"=>1,'menu_parent'=>$menu_parent);
        }
        $orderby = "menu_orderby asc";
        $list = $this->getList("",$and,$orderby);
        $data = array();
        if($list){
            foreach($list as $key => $item){
                $getLang = $this->mmenu_lang->getData(array("menu_lang_alias","menu_lang_name","menu_lang_detail"),array("menu_lang"=>$lang,"menu_id"=>$item["id"]));
                $data[$key]["id"] = $item["id"];                
                $data[$key]["menu_com"] = $item["menu_com"];
                $data[$key]["menu_picture"] = $item["menu_picture"];
                if($getLang){
                    $data[$key]["menu_detail"] = strip_tags($getLang["menu_lang_detail"]);
                    $data[$key]["menu_name"] = $getLang["menu_lang_name"];
                    $data[$key]["menu_alias"] = $getLang["menu_lang_alias"];
                }else{
                    $data[$key]["menu_name"] = "";
                }
            }
        }
        return $data;
    }
    /**end menu home*/

    /**begin menu hot*/
    public function  getHot($menu_parent='', $lang='vn'){
        $and = array("menu_hot"=>1,"menu_status"=>1);
        if(!empty($menu_parent))
        {
            $and = array("menu_hot"=>1,"menu_status"=>1,'menu_parent'=>$menu_parent);
        }
        $orderby = "menu_orderby asc";
        $list = $this->getList("",$and,$orderby);
        $data = array();
        if($list){
            foreach($list as $key => $item){
                $getLang = $this->mmenu_lang->getData(array("menu_lang_alias","menu_lang_name","menu_lang_detail"),array("menu_lang"=>$lang,"menu_id"=>$item["id"]));
                $data[$key]["id"] = $item["id"];                
                $data[$key]["menu_com"] = $item["menu_com"];
                $data[$key]["menu_picture"] = $item["menu_picture"];
                if($getLang){
                    $data[$key]["menu_detail"] = strip_tags($getLang["menu_lang_detail"]);
                    $data[$key]["menu_name"] = $getLang["menu_lang_name"];
                    $data[$key]["menu_alias"] = $getLang["menu_lang_alias"];
                }else{
                    $data[$key]["menu_name"] = "";
                }
            }
        }
        return $data;
    }
    /**end menu hot*/

    public function getAllID($menu_id, &$arr = array())
    {
        if(empty($arr)){
            array_push($arr, $menu_id);
        }
        if(!empty($menu_id))
        {
            $data = $this->getList('id',array('menu_parent'=>$menu_id));
            if(!empty($data))
            {
                foreach ($data as $key => $value) {
                    array_push($arr, $value['id']);
                    $this->getAllID($value['id'],$arr);
                }
            }
        }
        return $arr;
    }
    public function getAllParent($menu_id, &$arr = array())
    {
        if(empty($arr)){
            array_push($arr, $menu_id);
        }
        if(!empty($menu_id))
        {
            $data = $this->getList('menu_parent',array('id'=>$menu_id));
            if(!empty($data))
            {
                foreach ($data as $key => $value) {
                    array_push($arr, $value['menu_parent']);
                    $this->getAllParent($value['menu_parent'],$arr);
                }
            }
        }
        return $arr;
    }


    /**begin trinh bay danh muc menu*/
    public function dropDownMenu( $active='' , $com='', $menu_parent = 0, $lang='vn',$caret = ''){
        /**begin trinh bay danh sach menu cap 1*/
        $and = array("menu_parent"=>$menu_parent);
        $data = $this->getList('',$and);
        if($data){
            foreach($data as $item){
                $myLangCate = $this->mmenu_lang->getData('menu_lang_name',array("menu_lang"=>$lang,"menu_id"=>$item["id"]));
                $seleted = $item["id"]==$active?"selected":"";
                if($com == 'all'){
                    $disable = '';
                }
                else
                {
                    $disable = 'disabled';
                    if(!empty($com) && $item['menu_com'] == $com)
                    {
                        $disable = '';
                    }
                }
                echo '<option '.$disable.' '.$seleted.' value="'.$item["id"].'">'.$caret.$myLangCate["menu_lang_name"].'</option>';
                $this->dropDownMenu($active,$com,$item['id'],$lang='vn',$caret.'-- ');
            }
        }
        /**end trinh bay danh sach menu cap 1*/
    }
    /**end trinh bay danh muc menu*/

    /**begin trinh bay danh muc menu*/
    public function showMenu($menu_parent = 0, $lang='vn',$caret = ''){
        /**begin trinh bay danh sach menu cap 1*/
        $and = array("menu_parent"=>$menu_parent);
		$i=0;
		$cl = 'level'.$i ;
        $data = $this->getList('',$and);
        if($data){
            foreach($data as $item){
                $myLangCate = $this->mmenu_lang->getData('menu_lang_name,menu_lang_alias',array("menu_lang"=>$lang,"menu_id"=>$item["id"]));
                
                $status_change = $item["menu_status"] == 1 ? 0 : 1;
                $opacity = $item["menu_status"] == 1?"":"opcity02";
                $menu_com = $item["menu_com"];
                $menu_view = $item["menu_view"]  ? '<code>'.$item["menu_view"].'</code>':'';
                echo '<tr class="'.$opacity.  $cl.$i. '  ">';
                    echo '<td>'.$item['id'].'</td>';
                    echo '<td class="cate-c1">';
                        echo '<a class="title_sum">';
                            echo '<span>'.$caret.strip_tags($myLangCate["menu_lang_name"]).'</span>';
                        echo '</a>';
                    echo '</td>';
                    echo '<td>';
                        echo '<span>'.$menu_com.' '.$menu_view.'</span>';
                       // echo '<code>'.$myLangCate["menu_lang_alias"].'</code>';
                    echo '</td>';
                    
					 
					
                    echo '<td class="text-center" width="200px">';
                        if($item['menu_parent'] != 0) { 
                        echo '<span>';
                            echo '<a href="'.admin_url.'menu/update/'.$item["id"].'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> ';
                            echo '<a href="'.admin_url.'menu/trash/'.$item["id"].'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-danger" onclick="return Delete();"><i class="fa fa-trash-o"></i></a> ';
                            echo '<a href="'.admin_url.'menu/update_status/'.$item["id"].'/'.$status_change.'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a> ';
                        echo '</span>';
                        }
                    echo '</td>';
                echo '</tr>';
                $this->showMenu($item['id'],$lang='vn',$caret.'<i class="fa fa-angle-double-right"></i> ');
            $i++ ;
			}
        }
        /**end trinh bay danh sach menu cap 1*/
    }
    /**end trinh bay danh muc menu*/

   

    public function getTitle($id,$lang)
    {
        $data = $this->mmenu_lang->getData('menu_lang_name',array('menu_lang'=>$lang,'menu_id'=>$id));
        if(!empty($data))
            return $data['menu_lang_name'];
        return NULL;
    }
    public function getInfoAliasTmp($menu_alias)
    {        
        $data = '';
        if($menu_alias)
        {
            $sql = 'select m.id';
            $sql .= ' from '.$this->table.' m ';
            $sql .= ' inner join tkwp_menu_lang ml on ml.menu_id = m.id ';
            $sql .= ' and menu_lang_alias="'.$menu_alias.'"';
            $query = $this->db->query($sql);
            $rs = $query->result_array();
            if(!empty($rs))
            {
                $data = $rs[0]['id'];
            }
        }
        return $data;
    }
	
	//////// get menu child
	 public function dropChild(  $com='', $menu_parent = 1, $lang='vn' ){
        $html = ''; $i=0;
		$arraycolor = array("#00A8AB","#E40071","#80009B","#FF8500","#CD2228","#000") ;
        $and = array("menu_parent"=>$menu_parent);
        $data = $this->getList('',$and);
        if($data){
		 
            foreach($data as $item){
				 $myLangCate = $this->mmenu_lang->getData('menu_lang_name,menu_lang_alias',array("menu_lang"=>'vn',"menu_id"=>$item['id']));
				 
				$html .= '<li class="blue'.$i.' " style="background:'.$arraycolor[$i].'" >
								<a title="" href="'.base_url.$myLangCate["menu_lang_alias"].'/ "><i class="fa fa-angle-double-right"></i> '.$myLangCate["menu_lang_name"].'</a>
							</li>';
				$this->dropChild( $com,$item['id'],$lang='vn' );
            $i++;
			}
        }
		echo $html ;
        
    }
	
	 public function leftNews(  $com='', $menu_parent = 1, $lang='vn' ){
        $html = ''; $i=0; $string = ''; 
		$arraycolor = array("#2c9c46","#f24040","#1752a2","#ffe610","#FF8500","#CD2228","#000","#2c9c46","#f24040","#1752a2","#ffe610","#FF8500","#CD2228","#000") ;
        $and = array("menu_parent"=>$menu_parent);
        $data = $this->getList('',$and);
        if($data){
			$temp='';
			foreach($data as $item){ 
				$myLangCate = $this->mmenu_lang->getData('menu_lang_name,menu_lang_alias',array("menu_lang"=>'vn',"menu_id"=>$item['id']));
				$sub1 = $this->sub2($item['id'],$lang='vn' );
				if($sub1!='') $temp = '<span class="glyphicon glyphicon-chevron-right"></span> '; else $temp='';
				$string .= '
				<li style="background:'.$arraycolor[$i].'" class="sub1" > 
					<a href="'.base_url.$myLangCate['menu_lang_alias'].'/">  '.$myLangCate['menu_lang_name'].'  </a>'.$temp.'  
					<ul class="list-unstyled sub-cate  " style="display: none;">
					'.$sub1.'
					</ul>
				</li>
			';
			$i++; $temp='';
			}
			
        }
		 return $string ;
        
    }
	public function sub2( $menu_parent = 1, $lang='vn'){
		$html = '';
		$and = array("menu_parent"=>$menu_parent);
        $data = $this->getList('',$and);
        if($data){
			foreach($data as $item){
				$myLangCate = $this->mmenu_lang->getData('menu_lang_name,menu_lang_alias',array("menu_lang"=>'vn',"menu_id"=>$item['id']));
				$html .= '<li class="sub2"><a href=" '.base_url.$myLangCate['menu_lang_alias'].'/"  >  '.$myLangCate['menu_lang_name'].'</a> </li>';
			}
		}
		 
		return $html ;
	}
	
	 
	
}