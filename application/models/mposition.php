<?php
 
class mposition extends MY_Model{
    public $table = "tkwp_position";
    public function __construct(){
        parent::__construct();
    }

   /**begin trinh bay dropdown*/
    public function dropDown($active='' ,$caret = ''){
        $and = '';
        $object = array('id','position_name');
        $data = $this->getArray($object,$and);
        p($data);
        if($data){
            foreach($data as $item){
                $seleted = $item["id"]==$active?"selected":"";
                echo '<option '.$seleted.' value="'.$item["id"].'">'.$item["position_name"].'</option>';
            }
        }
        /**end trinh bay danh sach menu cap 1*/
    }
    /**end trinh bay dropdown*/

}