<?php
 

class mmailto_sendmail extends CI_Model{
    protected $table = "tkwp_mailto_send";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**them moi menu*/
    public function addMail($data){
        $this->db->insert($this->table,$data);
    }
    /**end them moi menu*/

    /**begin update status*/
    public function update($id,$data){
        $this->db->where(array("id"=>$id));
        $this->db->update($this->table,$data);
    }
    /**end update status*/

    /**begin danh sach tour*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.'  ';
        $sql .= ' where 1 ';
        if($and){
            $sql .= ' and '.$and;
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
        $sql = 'select * from '.$this->table.' ' ;
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