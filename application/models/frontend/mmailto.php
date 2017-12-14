<?php
 

class mmailto extends CI_Model{
    private $table = "tkwp_mailto";
    public function __construct(){
        parent::__construct();
        $this->load->database();        
    }

    public function insert($data){
        $this->db->insert($this->table,$data);
    }
    /**begin query sql*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table .' where 1 ';

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
    /**end query sql*/

    /**begin dem theo query sql*/
    public function countQuery($and=""){
        $sql = 'select * from '.$this->table .' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/
}