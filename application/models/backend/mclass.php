<?php
 
class mclass extends MY_Model{
    public $table = "tkwp_class";
    public function __construct(){
        parent::__construct();
   
    }

    /**being load du lieu co phan trang*/
    public function listAll($and="",$orderby="",$record,$start){
        if($and){
            $this->db->where($and);
        }
        if($orderby){
            $this->db->order_by($orderby);
        }else{
            $this->db->order_by("id","desc");
        }
        $this->db->limit($record,$start);
        return $this->db->get($this->table)->result_array();

    }
    /**end load du lieu co phan trang*/

    /**begin lay danh sach bài viết*/
    public function getAnd($and="",$orderby=""){
        if($and){
            $this->db->where($and);
        }
        if($orderby){
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    /**end lay danh sach bài viết*/

    /**begin dem theo dieu kien end*/
    public function countAnd($and=""){
        if($and!=""){
            $this->db->where($and);
        }
        $query = $this->db->get($this->table);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo dieu kien end*/

    /**begin danh sach tour*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table .' where 1  ';

        if($and){
            $sql .= ' and '.$and;
        }

        if($orderby){
            $sql .= ' order by '.$orderby;
        }else{
            $sql .= ' order by id desc ';
        }

        if($limit){
            $sql .= ' limit '.$limit;
        }        
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    /**end danh sach tour*/

    /**begin dem theo query sql*/
    public function countQuery($and=""){
        $sql = 'select * from '.$this->table .' where 1  ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/


    /**them moi user*/
    public function addUser($data){
        $this->db->insert($this->table,$data);
    }
    /**end them moi user*/

    /**cap nhat user*/
    public function updateUser($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
    }
    /**end cap nhat user*/

    /***begin xoa user*/
    public function deleteUser($id){
        if(is_numeric($id)){
            $this->db->where("id",$id);
        }elseif(is_array($id)){
            $this->db->where_in($id);
        }
        $this->db->delete($this->table);
    }
	
}