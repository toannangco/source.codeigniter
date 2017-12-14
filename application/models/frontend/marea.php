<?php
 


class MArea extends CI_Model{
    private $table = "tkwp_area";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /**begin query sql*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table .' where 1 and area_status = 1 ';

        if($and){
            $sql .= ' and '.$and;
        }

        if($orderby){
            $sql .= ' order by '.$orderby;
        }else{
            $sql .= ' order by area_orderby asc ';
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
        $sql = 'select * from '.$this->table .' where 1 and area_status = 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/


    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/

    public function dropdown($active='',$area_parent = 0,$caret ='',$show=0)
    {
        $html   = '';
        $data = $this->getQuerySql("id,area_name",$and="area_parent = ".$area_parent,$orderby="area_orderby asc",$limit="");
        if($data){
            foreach ($data as $key => $value) {
                $select = $active == $value['id'] ? 'selected':'';
                echo '<option '.$select.' value = "'.$value['id'].'">'.$caret.' '.$value['area_name'].'</option>';
                if($show == 1){
                    $this->dropdown($active, $value['id'],$caret.'-- ',$show);
                }
            }
        }
    }

    public function getInfoArea($area_id)
    {
        $html = '';
        $info = $this->getOnceAnd(array('id'=>$area_id));
        if(!empty($info))
        {
            $html .= $info['area_name'];
            if($info['area_parent']>0)
            {
                $infoP = $this->getOnceAnd(array('id'=>$info['area_parent']));
                if(!empty($infoP))
                {
                    $html .= ' - '.$infoP['area_name'];
                }
            }
        }
        return $html;
    }

}