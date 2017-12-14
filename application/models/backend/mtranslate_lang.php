<?php
 
class mtranslate_lang extends CI_Model{
    protected $table = "tkwp_translate_lang";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**begin danh sach tour*/
    public function getQuery($object="",$join="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
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
        $sql = 'select * from '.$this->table.' n' ;
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

    /**begin delete data*/
    function delete($and){
        if($and){
            $this->db->where($and);
            return $this->db->delete($this->table);
        }
    }
    /**end delete data*/

    /**begin them moi data*/
    public function addData($data){
        $this->db->insert($this->table,$data);
    }
    /**end them moi data*/

    /**cap nhat data*/
    public function updateData($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
        return true;
    }
    /**cap nhat data*/
    public function updateAnd($and,$data){
        if($and){
            $this->db->where($and);
            $this->db->update($this->table,$data);
            return true;
        }
    }
    /**end cap nhat data*/

    /**begin lay 1 record*/
    public function getOnceAnd($and=""){
        if($and){
            $this->db->where($and);
        }
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 record*/
}