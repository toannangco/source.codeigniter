<?php
 


class MArea extends CI_Model{
    private $table = "tkwp_area";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    /**begin danh sach tour*/
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
            $sql .= ' order by id asc ';
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
        $sql = 'select * from '.$this->table .' where 1 ';
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
    
    /**begin dropdown*/
    public function dropdown($active = "",$area_parent = 0,$caret=''){
        $data = $this->getQuerySql($object=""," area_parent =  ".$area_parent,$orderby="",$limit="");
        if($data){
            foreach($data as $item){
                $selected = $active==$item["id"]?"selected":"";
                echo '<option '.$selected.' value="'.$item["id"].'">'.$caret.' '.$item["area_name"].'</div>';
                $this->dropdown($active, $item['id'],$caret.'-- ');
            }
        }
    }
    /**end dropdown*/

    /**them moi data*/
    public function addData($data){
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id(); /**lay ra insert_id*/
        return $id;
    }
    /**end them moi data*/

    /**begin cap nhat*/
    public function updateData($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
    }
    /**end cap nhat*/

    /**begin xoa data*/
    public function deleteData($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }
    /**end xoa data*/

    /**begin lay danh sach area co dieu kien and*/
    public function getListAreaAnd($and){
        $this->db->where($and);
        $this->db->order_by("area_orderby","asc");
        $rs = $this->db->get($this->table);
        return $rs->result_array();
    }
    /**end lay danh sach area co dieu kien end*/

    public function showData($area_parent = 0,$status = 1, $caret = ''){
        /**begin trinh bay danh sach area cap 1*/
        $and = array("area_parent"=>$area_parent,'area_status'=>$status);
        $data = $this->getListAreaAnd($and);
        if(!empty($data)){
            foreach ($data as $key => $value) {
                $status_change = $value["area_status"] == 1 ? 0 : 1;
                $opacity = $value["area_status"] == 1?"":"opcity02";
                echo '<tr class="'.$opacity.'">';
                    echo '<td>'.$value['area_orderby'].'</td>';
                    echo '<td class="cate-c1">';
                        echo $caret.$value["area_name"];
                    echo '</td>';
                    echo '<td class="text-center">'.date('d/m/Y',$value['area_cerate_date']).'</td>';
                    
                    echo '<td class="text-center">';
                        echo '<span>';
                            echo '<a href="'.admin_url.'area/update/'.$value["id"].'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> ';
                            // echo '<a href="'.admin_url.'area/status/'.$value["id"].'/'.$status_change.'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-warning"><i class="fa fa-eye"></i></a> ';
                            echo '<a href="'.admin_url.'area/delete/'.$value["id"].'/?redirect='.base64_encode(curPageURL()).'" class="btn btn-xs btn-danger" onclick="return Delete();"><i class="fa fa-trash-o"></i></a> ';
                        echo '</span>';
                    echo '</td>';
                echo '</tr>';
                $this->showData($value['id'],$status,$caret.'<i class="fa fa-angle-double-right"></i> ');
            }
        }
        /**end trinh bay danh sach area cap 1*/
    }
}