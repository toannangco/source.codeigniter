<?php
 
class mproject_picture extends CI_Model{
    protected $table = "tkwp_project_picture";
    public function __construct(){
        parent::__construct();
    }

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/

    /**them moi*/
    public function addData($data){
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id(); /**lay ra insert_id*/
        return $id;
    }
    /**end them moi*/

    /**begin cap nhat*/
    public function updateData($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
    }
    /**end cap nhat*/

    /**begin xoa*/
    public function deleteData($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }

    /**begin xoa*/
    public function deleteAnd($and){
        if(!empty($and)){
            $this->db->where($and);
            return $this->db->delete($this->table);
        }
    }
    /**end xoa*/

    /**begin danh sach tour*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table;
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
    public function countQuery($and=""){
        $sql = 'select * from '.$this->table;
        $sql .= ' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/

}
