<?php
 
class mtranslate extends CI_Model{
    protected $table = "tkwp_translate";
    public function __construct(){
        parent::__construct();
        $this->load->Model("backend/mtranslate_lang");
    }
    /**begin danh sach tour*/
    public function getQuery($object="",$join="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
        if($join){
            $sql .= $join;
        }
        if($and){
            $sql .= ' where '.$and;
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
    public function countQuery($join="",$and=""){
        $sql = 'select * from '.$this->table.' n' ;
        if($join){
            $sql .= $join;
        }
        $sql .= ' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/

    /**begin delete data*/
    function delete($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }
    /**end delete data*/

    /**begin them moi data*/
    public function addData($data){
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id(); /**lay ra insert_id*/
        return $id;
    }
    /**end them moi data*/

    /**cap nhat data*/
    public function updateData($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
        return true;
    }
    /**end cap nhat data*/

    /**begin lay 1 record*/
    public function getOnceAnd($and=""){
        if($and){
            $this->db->where($and);
        }
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 record*/


    /*dich thuat*/
    public function showTranslate($lang='vn')
    {
        $myTranslate = $this->getQuery('id,translate_alias',$join="",$and="",$orderby="",$limit="");
        if($myTranslate){
            foreach($myTranslate as $item){
                if($item["translate_alias"]){
                    $myTranslateLang = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>$lang,"translate_id"=>$item["id"]));
                    if($lang != 'vn' && empty($myTranslateLang))
                    {
                        $myTranslateLang = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>'vn',"translate_id"=>$item["id"]));
                    }
                    if ( ! defined($item["translate_alias"])){
                        define($item["translate_alias"],$myTranslateLang['translate_name']);
                    }
                }
            }
        }
    }

    public function defined_helper($lang)
    {
        $myTranslate = $this->mtranslate->getQuery('id,translate_alias');
        if($myTranslate){
            foreach($myTranslate as $item){
                if($item["translate_alias"]){
                    $myTranslateLang = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>$lang,"translate_id"=>$item["id"]));
                    if(empty($myTranslateLang))
                        $myTranslateLang = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>'vn',"translate_id"=>$item["id"]));
                    if ( ! defined($item["translate_alias"]) && !empty($myTranslateLang)){
                        define($item["translate_alias"],$myTranslateLang['translate_name']);
                    }
                }
            }
        }
    }
}