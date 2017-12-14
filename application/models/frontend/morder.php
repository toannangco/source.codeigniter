<?php
 
class morder extends CI_Model{
    private $table = "tkwp_order";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
   
    /**begin them moi*/
    public function addData($data){
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id(); /**lay ra insert_id*/
        return $id;
    }
    /**end them moi*/
   
}