<?php
 
class mbanner extends MY_Model{
    public $table = "tkwp_banner";
    public $table_lang = "tkwp_banner_lang";
    public function __construct(){
        parent::__construct();
    }

    public function getBanner($object = '', $condition = '', $order_by = 'n.banner_orderby asc', $limit = '',$status = 'all')
    {
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
        if($status=='all')
        {
            $sql .= ' where n.banner_status = 1 ';
        }
        else{
            $sql .= ' where 1 ';
        }
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

     /**begin get position*/
    public function getPosition($object = "",$position=""){
        $table_pos = "tkwp_position";
        if($object){
            $this->db->select($object);
        }
        if($position){
            $this->db->where(array("position_code"=>$position));
        }
        $rs = $this->db->get($table_pos);
        return $rs->row_array();
    }
    /**end get position*/

    /**banner trang chu*/
    public function banner($position, $menu_id = '',$orderby='banner_orderby asc, id desc'){
        $position = $this->getPosition("id",$position);
        $data = "";
        if($position){
            $and = 'position_id = '.$position["id"].' and banner_status = 1';
            if(!empty($menu_id)){
                $and .= ' and menu_id = '.$menu_id;
            }
            $object = 'id,banner_title,banner_link,banner_picture';
            $data  = $this->getBanner($object,$and,$orderby);
        }
        return $data;
    }
    /**end banner trang chu*/

}