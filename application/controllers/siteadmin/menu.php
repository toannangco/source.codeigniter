<?php
 
class Menu extends MY_Admin_Controller
{
    public $_file_path = "";
    public $_file_url = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->Model("Mcom");
        $this->load->Model("mlanguage");
        $this->_file_url = base_file.'menu/';
        $this->_file_path = dir_root. '/public/frontend/uploads/files/menu';
    }
    /**begin danh sach*/
    public function index()
    {
      
        $this->_data["title"] = danh_sach;
        $this->_data['record'] = $this->mmenu->countData();
        $this->my_layout->view("backend/menu/menu_list_view", $this->_data);
    }
    /**end danh sach*/

    /**begin cap nhat trang thai menu*/
    public function update_status($id, $status)
    {
       
        $this->_data = array(
            "menu_status" => $status
        );
        $this->mmenu->updateData($id, $this->_data);
        if(isset($_REQUEST['redirect']))
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url.'menu/index/');
    }
    /**end cap nhat trang thai menu*/

    /**begin them moi*/
    public function add()
    {
       
        $this->_data['formData']['menu_id'] = '';
        $this->_data['formData']['menu']['menu_parent']                        = 0;
        $this->_data['formData']['menu']['menu_com']                        = '';
        $this->_data['formData']['menu']['menu_view']                        = '';
        $this->_data['formData']['menu']['menu_orderby']                        = '';
        $this->_data['formData']['menu']['menu_home']                        = '';
        $this->_data['formData']['menu']['menu_hot']                        = '';
        $this->_data['formData']['menu']['menu_status']                        = '';
        $this->_data['formData']['menu']['menu_picture']                        = '';
        $this->_data['formData']['menu']['menu_create_date']                        = time();
        $this->_data['formData']['menu']['menu_update_date']                        = time();
        $this->_data['formData']['menu']['userid']                        = $this->_data['s_info']['s_user_id'];
        if(!empty($this->_data['language']))
        {
            foreach ($this->_data['language'] as $key => $value) {
                $this->_data['formData'][$value->lang]['menu_id']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_name']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_alias']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_detail']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_title']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_keyword']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_description']            = '';
                $this->_data['formData'][$value->lang]['menu_lang_create_date']            = time();
                $this->_data['formData'][$value->lang]['menu_lang_update_date']            = time();
                $this->_data['formData'][$value->lang]['userid']            = $this->_data['s_info']['s_user_id'];
            }
        }
        if(isset($_POST['fsubmit']))
        {
            /*anh dai dien*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_picture       =   '';
                $this->mmenu->removeFile($this->_file_path,$this->_data['formData']['menu']["menu_picture"]);
            }else{
                $name_picture           =   $this->_data['formData']['menu']['menu_picture'];
            }
            $picture                =   $this->mmenu->upload($this->_file_path, 'menu_picture');
            $menu_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($menu_picture)
            {
                $name_picture       =   $menu_picture;
                $this->mmenu->removeFile($this->_file_path,$this->_data['formData']['menu']["menu_picture"]);
            }
            $this->_data['formData']['menu']['menu_picture']       =    $name_picture;
            $this->_data['formData']['menu']['menu_parent']               =     $this->input->post('menu_parent');
            $this->_data['formData']['menu']['menu_com']               =     $this->input->post('menu_com');
            $this->_data['formData']['menu']['menu_view']               =     $this->input->post('menu_view');
            $this->_data['formData']['menu']['menu_orderby']               =     $this->input->post('menu_orderby');
            $this->_data['formData']['menu']['menu_home']               =     $this->input->post('menu_home');
            $this->_data['formData']['menu']['menu_hot']               =     $this->input->post('menu_hot');
            $this->_data['formData']['menu']['menu_status']               =     $this->input->post('menu_status');
            
            
            $menu_id = $this->mmenu->addData($this->_data['formData']['menu']);
            $this->_data['formData']['menu_id'] = $menu_id;
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $menu_lang_alias = mb_strtolower(url_title(convert_alias($this->input->post('menu_lang_name_'.$value->lang))));
                    $checkMenu = $this->mmenu_lang->getData('id',array('menu_lang_alias'=>$menu_lang_alias,'menu_lang'=>$value->lang));
                    if($checkMenu)
                    {
                        $menu_lang_alias = $menu_lang_alias.date('His');
                    }
                    $menu_lang_alias = $menu_lang_alias ? $menu_lang_alias : time();

                    $this->_data['formData'][$value->lang]['menu_id']                     =   $menu_id;
                    $this->_data['formData'][$value->lang]['menu_lang']                   =   $value->lang;
                    $this->_data['formData'][$value->lang]['menu_lang_name']              =   $this->input->post('menu_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_alias']             =   $menu_lang_alias;
                    $this->_data['formData'][$value->lang]['menu_lang_detail']              =   $this->input->post('menu_lang_detail_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_title']              =   $this->input->post('menu_lang_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_keyword']              =   $this->input->post('menu_lang_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_description']              =   $this->input->post('menu_lang_description_'.$value->lang);
                    $check = $this->mmenu_lang->countAnd(array('menu_id'=>$menu_id,'menu_lang'=>$value->lang));
                    if(empty($check)){
                        $this->mmenu_lang->addData($this->_data['formData'][$value->lang]);
                    }else{
                        $this->mmenu_lang->updateAnd(array('menu_id'=>$menu_id,'menu_lang'=>$value->lang),$this->_data['formData'][$value->lang],$value->lang);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            }else{
                redirect(admin_url.'menu/index/');
            }
        }
        $this->_data['title'] = 'Thêm mới menu';
        $this->_data['menu_view'] = $this->Mcom->getView($this->_data['formData']['menu']['menu_com'],$this->_data['formData']['menu']['menu_view']);
        $this->my_layout->view("backend/menu/menu_post_view", $this->_data);
    }
    /**end them moi*/

    /**begin update*/
    public function update($menu_id)
    {
        
        $this->_data['formData']['menu_id'] = $menu_id;
        $myMenu = $this->mmenu->getData('',array('id'=>$menu_id));
        $this->_data['formData']['menu']['menu_parent']                        = $myMenu['menu_parent'];
        $this->_data['formData']['menu']['menu_com']                        = $myMenu['menu_com'];
        $this->_data['formData']['menu']['menu_view']                        = $myMenu['menu_view'];
        $this->_data['formData']['menu']['menu_orderby']                        = $myMenu['menu_orderby'];
        $this->_data['formData']['menu']['menu_home']                        = $myMenu['menu_home'];
        $this->_data['formData']['menu']['menu_hot']                        = $myMenu['menu_hot'];
        $this->_data['formData']['menu']['menu_status']                        = $myMenu['menu_status'];
        $this->_data['formData']['menu']['menu_picture']                        = $myMenu['menu_picture'];
        $this->_data['formData']['menu']['menu_update_date']                        = time();
        if(!empty($this->_data['language']))
        {
            foreach ($this->_data['language'] as $key => $value) {
                $myMenuLang = $this->mmenu_lang->getData('',array('menu_id'=>$menu_id,'menu_lang'=>$value->lang));
                $this->_data['formData'][$value->lang]['menu_id']            = $menu_id;
                $this->_data['formData'][$value->lang]['menu_lang_name']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_name'] : '';
                $this->_data['formData'][$value->lang]['menu_lang_alias']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_alias'] : '';
                $this->_data['formData'][$value->lang]['menu_lang_detail']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_detail'] : '';
                $this->_data['formData'][$value->lang]['menu_lang_title']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_title'] : '';
                $this->_data['formData'][$value->lang]['menu_lang_keyword']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_keyword'] : '';
                $this->_data['formData'][$value->lang]['menu_lang_description']            = !empty($myMenuLang) ? $myMenuLang['menu_lang_description'] : '';                
                $this->_data['formData'][$value->lang]['menu_lang_update_date']            = time();
            }
        }
        if(isset($_POST['fsubmit']))
        {
            /*anh dai dien*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_picture       =   '';
                $this->mmenu->removeFile($this->_file_path,$this->_data['formData']['menu']["menu_picture"]);
            }else{
                $name_picture           =   $this->_data['formData']['menu']['menu_picture'];
            }
            $picture                =   $this->mmenu->upload($this->_file_path, 'menu_picture');
            $menu_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($menu_picture && !empty($myMenu))
            {
                $name_picture       =   $menu_picture;
                $this->mmenu->removeFile($this->_file_path,$this->_data['formData']['menu']["menu_picture"]);
            }
            $this->_data['formData']['menu']['menu_picture']       =    $name_picture;
            $this->_data['formData']['menu']['menu_parent']               =     $this->input->post('menu_parent');
            $this->_data['formData']['menu']['menu_com']               =     $this->input->post('menu_com');
            $this->_data['formData']['menu']['menu_view']               =     $this->input->post('menu_view');
            $this->_data['formData']['menu']['menu_orderby']               =     $this->input->post('menu_orderby');
            $this->_data['formData']['menu']['menu_home']               =     $this->input->post('menu_home');
            $this->_data['formData']['menu']['menu_hot']               =     $this->input->post('menu_hot');
            $this->_data['formData']['menu']['menu_status']               =     $this->input->post('menu_status');
            
            $this->mmenu->updateData($menu_id,$this->_data['formData']['menu']);
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $menu_lang_alias = mb_strtolower(url_title(convert_alias($this->input->post('menu_lang_name_'.$value->lang))));
                    $checkMenu = $this->mmenu_lang->getData('id',array('menu_id !=' =>$menu_id, 'menu_lang_alias'=>$menu_lang_alias,'menu_lang'=>$value->lang));
                    if($checkMenu)
                    {
                        $menu_lang_alias = $menu_lang_alias.date('His');
                    }
                    $menu_lang_alias = $menu_lang_alias ? $menu_lang_alias : time();
                    
                    $this->_data['formData'][$value->lang]['menu_id']                     =   $menu_id;
                    $this->_data['formData'][$value->lang]['menu_lang']                   =   $value->lang;
                    $this->_data['formData'][$value->lang]['menu_lang_name']              =   $this->input->post('menu_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_alias']             =   $menu_lang_alias;
                    $this->_data['formData'][$value->lang]['menu_lang_detail']              =   $this->input->post('menu_lang_detail_'.$value->lang);

                    $this->_data['formData'][$value->lang]['menu_lang_title']              =   $this->input->post('menu_lang_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_keyword']              =   $this->input->post('menu_lang_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['menu_lang_description']              =   $this->input->post('menu_lang_description_'.$value->lang);
                    $check = $this->mmenu_lang->countAnd(array('menu_id'=>$menu_id,'menu_lang'=>$value->lang));
                    if(empty($check)){
                        $this->mmenu_lang->addData($this->_data['formData'][$value->lang]);
                    }else{
                        $this->mmenu_lang->updateAnd(array('menu_id'=>$menu_id,'menu_lang'=>$value->lang),$this->_data['formData'][$value->lang],$value->lang);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            }else{
                redirect(admin_url.'menu/index/');
            }
        }
        $this->_data['menu_view'] = $this->Mcom->getView($this->_data['formData']['menu']['menu_com'],$this->_data['formData']['menu']['menu_view']);
        $this->_data['title'] = 'Cập nhật menu';
        $this->my_layout->view("backend/menu/menu_post_view", $this->_data);
    }
    /**end them moi*/

    /**begin xoa bai viet*/
    public function trash($id){
        
        $myNews = $this->mmenu->getData('',array("id"=>$id));
        $this->mmenu->deleteData($id);
        $this->mmenu_lang->deleteAnd(array('menu_id'=>$id));
        redirect(admin_url."menu/");
    }
    /**end xoa bai viet*/
    public function getView($com_id,$active='')
    {
        $html = $this->Mcom->getView($com_id,$active);
        echo $html;
    }
}