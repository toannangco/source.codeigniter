<?php
 
class translate{
    public function show(){
        $this->load->Model("backend/mtranslate");
        $this->load->Model("backend/mtranslate_lang");
        $data = $this->mtranslate->getQuery($object="",$join="",$and="",$orderby="",$limit="");
        $lang = $this->uri->segment(1)==""?"vn":$this->uri->segment(1);

        if($data){
            foreach($data as $item){
                if(isset($item) && $item["translate_alias"]){
                    /**lay ra chi tiet cua ngon ngu dich thuat*/
                    $data_lang = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>$lang,"translate_id"=>$item["id"]));
                    /**
                     * kiem tra neu ma data_lang kg co gia tri thi lay gia tri mat dinh cua ngon ngu tieng viet
                    */
                    if($data_lang){
                        $de_name = $data_lang['translate_name'];
                    }else{
                        $de_name = $item['translate_name'];
                    }
                    /**lay ra chi tiet cua ngon ngu dich thuat*/
                    if ( ! defined($item["translate_alias"])){
                        define($item["translate_alias"],$de_name);
                    }
                }
            }
        }
        /**end khai bao hang*/
    }
}
