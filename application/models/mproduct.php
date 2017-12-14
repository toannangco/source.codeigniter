<?php
 

class mproduct extends MY_Model{
    protected $table = "tkwp_product";
    protected $table_lang = "tkwp_product_lang";
    public function __construct(){
        parent::__construct();
        $this->load->Model("mproduct_lang");
    }

    public function getProduct($object = '', $condition = '', $order_by = 'n.id desc', $limit = '')
    {
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
        $sql .= 'inner join '.$this->table_lang.' nl on n.id = nl.product_id';
        
        
        if($condition){
            $sql .= ' where '.$condition;
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
    public function countData($condition)
    {
        $data = $this->getProduct('n.id',$condition);
        return count($data);
    }
}
