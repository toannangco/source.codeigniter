<?php
 
class muser extends CI_Model{
    private $table = "tkwp_user";
    public function __construct(){
        parent::__construct();
        $this->load->database();
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
    public function getAnd($objects="",$and="",$orderby=""){
        if($objects){
            $this->db->select($objects);
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

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($objects="",$and=""){
        if($objects){
            $this->db->select($objects);
        }
        if($and){
            $this->db->where($and);
        }
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/


    /**them moi user*/
    public function addUser($data){
        $this->db->insert($this->table,$data);
		 $insert_id = $this->db->insert_id();

   return  $insert_id;
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
    /**end xoa user*/
}