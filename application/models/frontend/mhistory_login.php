<?php
 

class mhistory_login extends CI_Model{
    protected $table = "tkwp_history_login";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**being load du lieu co phan trang*/
    public function listAllLimit($and="",$orderby="",$record,$start){
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

    /**begin lay danh sach */
    public function getList($and="",$orderby=""){
        if($and){
            $this->db->where($and);
        }
        if($orderby){
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    /**end lay danh sach */

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
    public function getOnceAnd($and=""){
        if($and){
            $this->db->where($and);
        }        
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/

    /**them moi*/
    public function add($data){
        $this->db->insert($this->table,$data);        
    }
    /**end them moi*/

}
