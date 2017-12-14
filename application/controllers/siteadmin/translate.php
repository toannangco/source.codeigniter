<?php
 
class translate extends MY_Admin_Controller{
    public function __construct(){  
        parent::__construct();        
        $this->load->Model("mlanguage");        
    }
    public function index(){
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
       // $this->muser->permision("translate","index");
        
        
        $this->_data['title'] = "Dịch thuật";
        $and_lang = "language_status = 1";
        $this->_data["language"] = $this->mlanguage->getArray('',$and_lang,'language_position ASC');
        /**begint them mo data*/
        $this->_data['translate']="";
        if(isset($_POST['submit'])){
            /** get data*/
            $this->_data["translate"]["translate_name"] = (isset($_POST['translate_name']) && $_POST['translate_name'])?$_POST['translate_name']:'';
            $this->_data["translate"]["translate_alias"] = (isset($_POST['translate_alias']) && $_POST['translate_alias'])?$_POST['translate_alias']:'';
            $this->_data["translate"]["translate_create_date"] = time();
            $this->_data["translate"]["user"] = $s_info["s_user_id"];
            if($this->_data['translate']){
                $check = $this->mtranslate->countQuery("","translate_alias='".$this->_data["translate"]["translate_alias"]."'");
                if($check==0){
                    $insert = $this->mtranslate->addData($this->_data['translate']);
                    if($insert){
                        if($this->_data["language"]){
                            foreach($this->_data["language"] as $item){
                                $this->_data['translate_lang'] = "";
                                $this->_data['translate_lang']["translate_id"] = $insert;
                                $this->_data['translate_lang']["translate_lang"] = $item['language_name_short'];
                                $this->_data['translate_lang']["translate_name"] = $_POST[$item['language_alias']];
                                if($this->_data['translate_lang']){
                                    $this->mtranslate_lang->addData($this->_data["translate_lang"]);
                                }
                            }
                        }
                    }
                }
            }
            /**end get data*/
        }
        /**end them moi data*/

        /**begin danh sach translate*/

        $this->_data["list"] = $this->mtranslate->getQuery($object="",$join="",$and="","id desc",$limit="0,30");
        /**begin danh sach translate*/
        $this->my_layout->view("backend/translate/translate_list_view",$this->_data);
    }


    /**begin delete data*/
    public function delete($id){
        $url = $_REQUEST['redirect'];
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
  //      $this->muser->permision("translate","delete");
        
        if(is_numeric($id) && $id>0){
            $this->mtranslate->delete($id);
            $this->mtranslate_lang->delete(array("translate_id"=>$id));
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($url));
            redirect(admin_url."/translate/index/");
        }else{
            redirect(admin_url."/translate/index/");
        }
        
    }
    /**end delete data*/

    /**begin ajax*/
    public function aj_translate_alias(){
        if(isset($_REQUEST['translate_name']) && $_REQUEST['translate_name']){
            $string = $_REQUEST["translate_name"];
            $alias =  mb_strtolower(url_title(convert_alias($string)));
            $alias = str_replace("-","_",$alias);
            $check = $this->mtranslate->getOnceAnd(array("translate_alias"=>$alias));
            if($check){
                $alias = $alias.'_1';
            }else{
                $alias = $alias;
            }
            echo $alias;
        }
    }
    /***end ajax*/

    /***cap nhat bang ajax*/
    public function aj_update(){
        if((isset($_REQUEST['translate_name']) && $_REQUEST['translate_name']) && (isset($_REQUEST['translate_lang']) && $_REQUEST['translate_lang']) && (isset($_REQUEST['translate_id']) && $_REQUEST['translate_id'])){
            $translate_name = $_REQUEST['translate_name'];
            $translate_lang = $_REQUEST['translate_lang'];
            $translate_id = $_REQUEST['translate_id'];
            $check = $this->mtranslate_lang->getOnceAnd(array("translate_lang"=>$translate_lang,"translate_id"=>$translate_id));
            $html = 0;
            if($check){
                /**begin cap nhat*/
                $this->_data['update'] = array(
                    "translate_name"=>$translate_name
                );
                if($this->_data['update']){
                    $this->mtranslate_lang->updateAnd(array("translate_lang"=>$translate_lang,"translate_id"=>$translate_id),$this->_data["update"]);
                    $html = 1;
                }
                /**end cap nhat*/
            }else{
                /**begin them moi*/
                $this->_data['add'] = array(
                    "translate_lang"=>$translate_lang,
                    "translate_id"=>$translate_id,
                    "translate_name"=>$translate_name
                );
                if($this->_data['add']){
                    $this->mtranslate_lang->addData($this->_data["add"]);
                    $html = 1;
                }
                /**end them moi*/
            }
            echo $html;
        }
    }
    /**end cap nhat bang ajax*/

    /**begin ajax seach*/
    public function aj_search(){
        $html = '';
        if(isset($_REQUEST['translate_name']) && $_REQUEST['translate_name']){
            $keyword = $_REQUEST['translate_name'];
            $join = " join tkwp_translate_lang nl on n.id=nl.translate_id";
            $and = " (nl.translate_name like '%".$keyword."%' or nl.translate_lang like '%".$keyword."%' or n.translate_alias like '%".$keyword."%' or n.translate_name like '%".$keyword."%')";
        }else{
            $join = "";
            $and = "";
        }

            $object="distinct n.id as id,n.translate_name,n.translate_alias"; //bang rong se lay tat ca
            $and_lang = "language_status = 1";
            $language = $this->mlanguage->getArray('',$and_lang,'language_position ASC');
            $this->_data = $this->mtranslate->getQuery($object,$join,$and,"id desc","0,30");
            if($this->_data){
                foreach($this->_data as $item_k){
                    $html .= '<tr>';
                        $html .= '<td>'.$item_k["translate_name"].'</td>';
                        $html .= '<td><code>'.$item_k["translate_alias"].'</code></td>';
                        if($language){
                            foreach($language as $item){
                                if(isset($item['language_name']) && $item['language_name']){
                                    $img =(isset($item['language_picture']) && $item['language_picture'])?base_file.'/language/thumbnail/'.$item['language_picture']:'';
                                    /**begin lay ten cho tung ngon ngu*/
                                    $translateName = $this->mtranslate_lang->getOnceAnd(array("translate_id"=>$item_k["id"],"translate_lang"=>$item['language_name_short']));
                                    /**end lay ten cho tung ngon ngu*/
                                        $html .='<td>';
                                        $html .='<div class="sub_translate_name">';
                                            if(isset($translateName["translate_name"]) && $translateName["translate_name"]){
                                                $html .= '<div class="input-group" style="max-width: 212px;">';
                                                $html .= '<input type="text" class="form-control input-sm" disabled placeholder="'.$translateName["translate_name"].'">';
                                                $html .= '<span class="input-group-btn">
                                                                <button class="btn btn-success btn-flat btn-sm pointer edit_translate_name" type="button" data-id="'.$translateName["translate_id"].'" data-lang="'.$item['language_name_short'].'" data-name="'.$translateName["translate_name"].'" title="'.sua.'">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                          </span>';
                                                $html .= '</div>';
                                            }else{
                                                $html .= '<div class="input-group" style="max-width: 212px;">';
                                                $html .= '<input type="text" class="form-control input-sm fr_translate_name">';
                                                $html .= '<span class="input-group-btn">
                                                                <button class="btn btn-primary btn-flat btn-sm pointer save_translate_name" type="button" data-id="'.$item_k["id"].'" data-lang="'.$item['language_name_short'].'" data-name="" title="'.luu.'">
                                                                    <i class="fa fa-save"></i>
                                                                </button>
                                                          </span>';
                                                $html .= '</div>';
                                            }

                                            $html .= '</div>';
                                        $html .='</td>';
                                }
                            }
                        }
                    $html .= '<td>';
                        $html .= '<a href="'.admin_url.'translate/delete/'.$item_k["id"].'/?redirect='.base64_encode(current_url()).'" onclick="return Delete();" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }else{
                $html .= "";
            }
        echo $html;
    }
    /**end ajax seach*/

}