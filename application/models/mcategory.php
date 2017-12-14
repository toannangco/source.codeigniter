<?php
 
class mcategory extends MY_Model{
    public $table = "tkwp_category";

    public function __construct(){
        parent::__construct();
        $this->load->Model("mcategory_lang");
    }
    /**begin trinh bay danh muc*/
    public function dropDown($active="",$lang='vn'){
        /**begin trinh bay danh sach menu cap 1*/
        $and_c1 = array("category_parent"=>0);
        $object = 'id';
        $data_c1 = $this->getArray('',$and_c1,"category_orderby");
        if($data_c1){
            foreach($data_c1 as $item_c1){
                /**lay ten menu theo id va ngon ngu*/
                $myCategoryLang = $this->mcategory_lang->getData('category_lang_name',array("category_lang"=>$lang,"category_id"=>$item_c1["id"]));
                $seleted = $item_c1["id"]==$active?"selected":"";
                echo '<option '.$seleted.' value="'.$item_c1["id"].'">'.$myCategoryLang["category_lang_name"].'</option>';

                /**begin trinh bay danh muc menu cap 2*/
                $and_c2 = array("category_parent"=>$item_c1["id"]);
                $data_c2 = $this->getArray('',$and_c2);
                if($data_c2){
                    foreach($data_c2 as $item_c2){
                        $myCategoryLangC2 = $this->mcategory_lang->getData('category_lang_name',array("category_lang"=>$lang,"category_id"=>$item_c2["id"]));
                        $seleted = $item_c2["id"]==$active?"selected":"";
                        echo '<option '.$seleted.' value="'.$item_c2["id"].'">--'.$myCategoryLangC2["category_lang_name"].'</option>';
                    }
                }
            }
        }
    }
}