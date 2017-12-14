<?php
 

class mcontact extends CI_Model{
    private $table = "tkwp_contact";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**begin them moi thu lien he*/
    public function add($data){
        $this->db->insert($this->table,$data);
    }
    /**end them moi thu lien he*/

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
        echo $sql;
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/
}