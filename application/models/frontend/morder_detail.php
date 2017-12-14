<?php
 
class morder_detail extends CI_Model{
    private $table = "tkwp_order_detail";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
   
    /**begin them moi*/
    public function addData($data){
        $this->db->insert($this->table,$data);       
    }
    /**end them moi*/
   
}