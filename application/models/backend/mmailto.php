<?php
/**
 *
 */
class mmailto extends CI_Model
{
    private $table = "tkwp_mailto";
    public function __construct()
    {
        # code...
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

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/


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

    /**begin update status*/
    public function update($id,$data){
        $this->db->where(array("id"=>$id));
        $this->db->update($this->table,$data);
    }
    /**end update status*/

    /**begin thong ke mail chua doc tren menu top*/
    public function countMailTop(){
        $this->db->where(array("mailto_status"=>0));
        $query = $this->db->get($this->table);
        $count = $query->num_rows();
        echo  $count;
    }
    /**end thong ke mail chua doc tren menu top*/

    /**begin xoa thu lien he*/
    public function delete($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }
    /**xoa thu lien he*/

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
?>