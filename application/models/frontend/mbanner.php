<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tinh
 * Date: 11/29/13
 * Time: 11:04 AM
 * To change this template use File | Settings | File Templates.
 */


class mbanner extends CI_Model{
    private $table = "tkwp_banner";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    
    }

    /**begin lay danh sach theo dieu kien end*/
    public function getBanner($and="",$orderby="",$record="",$start=""){
        if($and){
            $this->db->where($and);
        }
        if($orderby){
            $this->db->order_by($orderby);
        }else{
            $this->db->order_by("banner_orderby","asc");
        }
        if($record && $start){
            $this->db->limit($record,$start);
        }        
        return $this->db->get($this->table)->result_array();

    }
    /**end lay danh sach theo dieu kien and*/

    /**dem theo dieu kien*/
    public function countAnd($and=""){
        if($and!=""){
            $this->db->where($and);
        }
        $query = $this->db->get($this->table);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo dieu kien*/

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
    public function banner($position, $menu_id = ''){
        $position = $this->getPosition("id",$position);
        $data = "";
        if($position){
            if(!empty($menu_id)){
                $and_page = array("position_id"=>$position["id"],"banner_status"=>1,'menu_id'=>$menu_id);
            }else{
                $and_page = array("position_id"=>$position["id"],"banner_status"=>1);
            }
            $record="";
            $start="";
            $orderby = "";
            $data  = $this->getBanner($and_page,$orderby,$record,$start);
        }
        return $data;        
    }
    /**end banner trang chu*/

}