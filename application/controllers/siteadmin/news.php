<?php
 
class News extends MY_Admin_Controller{
    protected $_file_path = "";
    protected $_file_url = "";
    public function __construct(){
        parent::__construct();
        $this->load->Model("mnews");
        $this->_file_url = base_file.'news/';
        $this->_file_path = dir_root. '/public/frontend/uploads/files/news';
    }

    /**begin danh sach*/
    public function index(){
       
        $this->_data['title'] = danh_sach;
        $and = " nl.news_lang = '".$this->_data['lang']."'";
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
        $this->_data['news_parent'] = isset($_REQUEST['news_parent']) ? $_REQUEST['news_parent']:0;
        $this->_data['thot'] = isset($_REQUEST['thot']) ? $_REQUEST['thot']:0;
        $this->_data['tstatus'] = isset($_REQUEST['tstatus']) ? $_REQUEST['tstatus']:1;
        $this->_data['fkeyword'] = isset($_REQUEST['fkeyword']) ? $_REQUEST['fkeyword']:'';

        if($this->_data['news_parent'] != 0){
            $and .= " and news_parent =  ".$this->_data['news_parent'];
        }
        if($this->_data['thot'] != 0){
            $and .= " and news_hot =  ".$this->_data['thot'];
        }
        $and .= " and news_status =  ".$this->_data['tstatus'];
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (nl.news_lang_name like '%".$fkeyword."%'";
            $and .= " or nl.news_lang_alias like '%".$fkeyword."%'";
            $and .= " or nl.news_lang_search like '%".$fkeyword."%'";
            $and .= " or nl.news_lang_summary like '%".$fkeyword."%')";
        }
        $orderby = " n.id DESC";
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $object = "n.id,n.user,n.news_status,n.news_parent,n.news_update_date,n.news_picture,n.news_view";
        $object .= ",nl.news_lang_name,nl.news_lang_alias";
        $this->_data["list"] = $this->mnews->getNews($object,$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record"] =  $this->mnews->countData($and);
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'news/?fkeyword='.$this->_data['fkeyword'].'&news_parent='.$this->_data['news_parent'].'&thot='.$this->_data['thot'].'&tstatus='.$this->_data['tstatus'].'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $this->my_layout->view("backend/news/news_list_view",$this->_data);
    }
    /**end danh sach*/

    /**begin cap nhat trang thai*/
    public function status($id,$status){
       // $this->muser->permision("news","status");
        $this->_data = array(
            "news_status"=>$status
        );
        $this->mnews->updateData($id,$this->_data);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."news/index/");
    }
    /**end cap nhat trang thai*/

    /**begin them moi*/
    public function add(){
      //  $this->muser->permision("news","add");
        $this->_data["title"] = them_moi.' '.bai_viet;
        $this->_data['formData']['news_id']    =   '';
        $this->_data['news_picture_more']    =   '';
        $this->_data['formData']['news']['news_picture']                        = '';
        $this->_data['formData']['news']['news_picture_more']                        = '';
        $this->_data['formData']['news']['news_file']                        = '';
        $this->_data['formData']['news']['news_file2']                        = '';
        $this->_data['formData']['news']['news_video']                        = '';
        $this->_data['formData']['news']['news_parent']                        = isset($_REQUEST['news_parent']) ? $_REQUEST['news_parent']:0;
        $this->_data['formData']['news']['news_orderby']                        = '';
        $this->_data['formData']['news']['news_status']                        = 1;
        $this->_data['formData']['news']['news_home']                        = 0;
        $this->_data['formData']['news']['news_view']                        = 0;
        $this->_data['formData']['news']['news_hot']                        = 0;
        $this->_data['formData']['news']['news_comment']                        =1;
        $this->_data['formData']['news']['news_begin_date']                        = date('Y-m-d H:i:s');
        $this->_data['formData']['news']['news_end_date']                        = date('Y-m-d H:i:s');
        $this->_data['formData']['news']['news_create_date']                        = date('Y-m-d');
        $this->_data['formData']['news']['news_update_date']                        = date('Y-m-d');
        $this->_data['formData']['news']['user']                        = $this->_data['s_info']['s_user_id'];;
        if(!empty($this->_data['language']))
        {
            foreach ($this->_data['language'] as $key => $value) {
                $this->_data['formData'][$value->lang]['news_id']            = '';
                $this->_data['formData'][$value->lang]['news_lang']            = $value->lang;
                $this->_data['formData'][$value->lang]['news_lang_name']            = '';
                $this->_data['formData'][$value->lang]['news_lang_alias']            = '';
                $this->_data['formData'][$value->lang]['news_lang_search']            = '';
                $this->_data['formData'][$value->lang]['news_lang_summary']            = '';
                $this->_data['formData'][$value->lang]['news_lang_detail']            = '';
                $this->_data['formData'][$value->lang]['news_lang_seo_title']            = '';
                $this->_data['formData'][$value->lang]['news_lang_seo_keyword']            = '';
                $this->_data['formData'][$value->lang]['news_lang_seo_description']            = '';
            }
        }
        if(isset($_POST['fsubmit']))
        {
            $news_picture_more = $this->uploadFileMul();
            $news_picture_more = $news_picture_more ? serialize($news_picture_more):'';
            $this->_data['formData']['news']["news_picture_more"]  =     $news_picture_more;

            /*anh dai dien*/
            $removepicture = $this->input->post('removepicture');
            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_picture"]);
            }else{
                $name_picture           =   $this->_data['formData']['news']['news_picture'];
            }
            $picture                =   $this->mnews->upload($this->_file_path, 'news_picture');
            $news_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($news_picture)
            {
                $name_picture       =   $news_picture;
                if($this->_data['formData']['news']["news_picture"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_picture"]);
                }
            }
            /*upload file*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_file       =   '';
                if($this->_data['formData']['news']["news_file"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file"]);
                }
            }else{
                $name_file           =   $this->_data['formData']['news']['news_file'];
            }
            $file                =   $this->mnews->uploadfile($this->_file_path, 'news_file');
            $news_file           =   !empty($file) ? $file['file_name'] : '';
            if($news_file)
            {
                $name_file       =   $news_file;
                if($this->_data['formData']['news']["news_file"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file"]);
                }
            }
            
            $removefile2 = $this->input->post('removefile2');
            if($removefile2==1)
            {
                $name_file2       =   '';
                if($this->_data['formData']['news']["news_file2"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file2"]);
                }
            }else{
                $name_file2           =   $this->_data['formData']['news']['news_file2'];
            }
            $file2                =   $this->mnews->uploadfile($this->_file_path, 'news_file2');
            $news_file2           =   !empty($file2) ? $file2['file_name'] : '';
            if($news_file2)
            {
                $name_file2       =   $news_file2;
                if($this->_data['formData']['news']["news_file2"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file2"]);
                }
            }
            
            $this->_data['formData']['news']['news_picture']       =    $name_picture;
            $this->_data['formData']['news']['news_file']          =    $name_file;
            $this->_data['formData']['news']['news_file2']          =    $name_file2;
            $this->_data['formData']['news']['news_video']         =    $this->input->post('news_video');
            $this->_data['formData']['news']['news_parent']        =    $this->input->post('news_parent');
            $this->_data['formData']['news']['news_parent']        =    $this->input->post('news_parent');
            $this->_data['formData']['news']['news_orderby']       =    $this->input->post('news_orderby');
            $this->_data['formData']['news']['news_status']        =    $this->input->post('news_status');
            $this->_data['formData']['news']['news_home']          =    $this->input->post('news_home');
            $this->_data['formData']['news']['news_comment']       =    $this->input->post('news_comment');
            $this->_data['formData']['news']['news_view']          =    $this->input->post('news_view');
            $this->_data['formData']['news']['news_hot']           =    $this->input->post('news_hot');
            $this->_data['formData']['news']['news_create_date']   =    $this->input->post('news_create_date');
            $news_id = $this->mnews->addData($this->_data['formData']['news']);
            $this->_data['formData']['news_id'] = $news_id;
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $this->_data['formData'][$value->lang]['news_id']            = $news_id;
                    $this->_data['formData'][$value->lang]['news_lang']            = $value->lang;
                    $this->_data['formData'][$value->lang]['news_lang_name'] =   $this->input->post('news_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData'][$value->lang]['news_lang_name'])));
                    $this->_data['formData'][$value->lang]['news_lang_search']   =   $this->input->post('news_lang_search_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_summary']   =   $this->input->post('news_lang_summary_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_detail']   =   $this->input->post('news_lang_detail_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_title']    =   $this->input->post('news_lang_seo_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_keyword']  =   $this->input->post('news_lang_seo_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_description']  =   $this->input->post('news_lang_seo_description_'.$value->lang);
                    $check = $this->mnews_lang->getData('',array('news_id'=>$news_id,'news_lang'=>$value->lang));
                    if(!empty($check)){
                        $this->mnews_lang->updateAnd(array('news_id'=>$news_id,'news_lang'=>$value->lang),$this->_data['formData'][$value->lang]);
                    }else{
                        $this->mnews_lang->addData($this->_data['formData'][$value->lang]);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."news/index/");
        }
        $this->my_layout->view("backend/news/news_post_view",$this->_data);
    }
    /**end them moi*/

    /**begin update*/
    public function update($news_id){
      //  $this->muser->permision("news","update");
        $this->_data["title"] = 'Cập nhật';
        $myNews = $this->mnews->getData('',array('id'=>$news_id));
        $this->_data['news_picture_more']              =     $myNews['news_picture_more'] ? unserialize($myNews['news_picture_more']):'';
        $this->_data['formData']['news_id']    =   $news_id;
        $this->_data['formData']['news']['news_picture']    =   $myNews['news_picture'];
        $this->_data['formData']['news']['news_picture_more']    =   $myNews['news_picture_more'];
        $this->_data['formData']['news']['news_video']      =   $myNews['news_video'];
        $this->_data['formData']['news']['news_file']       =   $myNews['news_file'];
        $this->_data['formData']['news']['news_file2']      =   $myNews['news_file2'];
        $this->_data['formData']['news']['news_parent']     =   $myNews['news_parent'];
        $this->_data['formData']['news']['news_orderby']    =   $myNews['news_orderby'];
        $this->_data['formData']['news']['news_status']     =   $myNews['news_status'];
        $this->_data['formData']['news']['news_home']       =   $myNews['news_home'];
        $this->_data['formData']['news']['news_comment']    =   $myNews['news_comment'];
        $this->_data['formData']['news']['news_view']       =   $myNews['news_view'];
        $this->_data['formData']['news']['news_hot']        =   $myNews['news_hot'];
        $this->_data['formData']['news']['news_create_date']                =   $myNews['news_create_date'];
        $this->_data['formData']['news']['news_end_date']                   = date('Y-m-d H:i:s');
        $this->_data['formData']['news']['news_update_date']                = date('Y-m-d');
        $this->_data['formData']['news']['user']                        = $this->_data['s_info']['s_user_id'];;
        if(!empty($this->_data['language']))
        {
            foreach ($this->_data['language'] as $key => $value) {
                $myNewsLang = $this->mnews_lang->getData('',array('news_id'=>$news_id,'news_lang'=>$value->lang));
                $this->_data['formData'][$value->lang]['news_id']            = $news_id;
                $this->_data['formData'][$value->lang]['news_lang']            = $value->lang;
                $this->_data['formData'][$value->lang]['news_lang_name']                =   !empty($myNewsLang) ? $myNewsLang['news_lang_name'] : '';
                $this->_data['formData'][$value->lang]['news_lang_alias']               =   !empty($myNewsLang) ? $myNewsLang['news_lang_alias'] : '';
                $this->_data['formData'][$value->lang]['news_lang_search']              =   !empty($myNewsLang) ? $myNewsLang['news_lang_search'] : '';
                $this->_data['formData'][$value->lang]['news_lang_summary']              =   !empty($myNewsLang) ? $myNewsLang['news_lang_summary'] : '';
                $this->_data['formData'][$value->lang]['news_lang_detail']              =   !empty($myNewsLang) ? $myNewsLang['news_lang_detail'] : '';
                $this->_data['formData'][$value->lang]['news_lang_seo_title']               =   !empty($myNewsLang) ? $myNewsLang['news_lang_seo_title'] : '';
                $this->_data['formData'][$value->lang]['news_lang_seo_keyword']             =   !empty($myNewsLang) ? $myNewsLang['news_lang_seo_keyword'] : '';
                $this->_data['formData'][$value->lang]['news_lang_seo_description']             =   !empty($myNewsLang) ? $myNewsLang['news_lang_seo_description'] : '';
            }
        }
        if(isset($_POST['fsubmit']))
        {
            /*mut hinh anh */
            $get_picture_more_old = array();
            $news_picture_more_old = $this->input->post('news_picture_more_old');
            if(!empty($news_picture_more_old))
            {
                foreach ($news_picture_more_old as $key => $value) {
                    if($value){
                        $get_picture_more_old[] = $value;
                    }
                }
            }
            $news_picture_more = $this->uploadFileMul();
            $news_picture_more = $get_picture_more_old ? array_merge((array)$get_picture_more_old,(array)$news_picture_more) : $news_picture_more;
            $news_picture_more = $news_picture_more ? serialize($news_picture_more):'';
            $this->_data['formData']['news']["news_picture_more"]  =     $news_picture_more;

            /*anh dai dien*/
            $removepicture = $this->input->post('removepicture');

            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_picture"]);
            }
            else{
                $name_picture           =   $this->_data['formData']['news']['news_picture'];
            }

            $picture                =   $this->mnews->upload($this->_file_path, 'news_picture');
            $news_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($news_picture && !empty($myNews))
            {
                $name_picture       =   $news_picture;
                if($myNews["news_picture"]){
                    $this->mnews->removeFile($this->_file_path,$myNews["news_picture"]);
                }
            }
            /*upload file*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_file       =   '';
                $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file"]);
            }else{
                $name_file           =   $this->_data['formData']['news']['news_file'];
            }
            $file                =   $this->mnews->uploadfile($this->_file_path, 'news_file');
            $news_file           =   !empty($file) ? $file['file_name'] : '';
            if($news_file)
            {
                $name_file       =   $news_file;
                if($myNews["news_file"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file"]);
                }
            }

            $removefile2 = $this->input->post('removefile2');
            if($removefile2==1)
            {
                $name_file2       =   '';
                $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file2"]);
            }else{
                $name_file2           =   $this->_data['formData']['news']['news_file2'];
            }
            $file2                =   $this->mnews->uploadfile($this->_file_path, 'news_file2');
            $news_file2           =   !empty($file2) ? $file2['file_name'] : '';
            if($news_file2)
            {
                $name_file2       =   $news_file2;
                if($this->_data['formData']['news']["news_file2"]){
                    $this->mnews->removeFile($this->_file_path,$this->_data['formData']['news']["news_file2"]);
                }
            }

            $this->_data['formData']['news']['news_picture']        = $name_picture;
            $this->_data['formData']['news']['news_file']           = $name_file;
            $this->_data['formData']['news']['news_file2']          = $name_file2;
            $this->_data['formData']['news']['news_video']          = $this->input->post('news_video');
            $this->_data['formData']['news']['news_parent']         = $this->input->post('news_parent');
            $this->_data['formData']['news']['news_parent']         = $this->input->post('news_parent');
            $this->_data['formData']['news']['news_orderby']        = $this->input->post('news_orderby');
            $this->_data['formData']['news']['news_status']         = $this->input->post('news_status');
            $this->_data['formData']['news']['news_home']           = $this->input->post('news_home');
            $this->_data['formData']['news']['news_comment']        = $this->input->post('news_comment');
            $this->_data['formData']['news']['news_view']           = $this->input->post('news_view');
            $this->_data['formData']['news']['news_hot']            = $this->input->post('news_hot');
            $this->_data['formData']['news']['news_create_date']    =    $this->input->post('news_create_date');
            $this->mnews->updateData($news_id,$this->_data['formData']['news']);
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $check = '';
                    $this->_data['formData'][$value->lang]['news_id']            = $news_id;
                    $this->_data['formData'][$value->lang]['news_lang']            = $value->lang;
                    $this->_data['formData'][$value->lang]['news_lang_name'] =   $this->input->post('news_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData'][$value->lang]['news_lang_name'])));
                    $this->_data['formData'][$value->lang]['news_lang_search']   =   $this->input->post('news_lang_search_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_summary']   =   $this->input->post('news_lang_summary_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_detail']   =   $this->input->post('news_lang_detail_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_title']    =   $this->input->post('news_lang_seo_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_keyword']  =   $this->input->post('news_lang_seo_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['news_lang_seo_description']  =   $this->input->post('news_lang_seo_description_'.$value->lang);
                    $check = $this->mnews_lang->getData('',array('news_id'=>$news_id,'news_lang'=>$value->lang));
                    if(!empty($check)){
                        $this->mnews_lang->updateAnd(array('news_id'=>$news_id,'news_lang'=>$value->lang),$this->_data['formData'][$value->lang]);
                    }else{
                        $this->mnews_lang->addData($this->_data['formData'][$value->lang]);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."news/index/");
        }
        $this->my_layout->view("backend/news/news_post_view",$this->_data);
    }
    /**end update*/

    /**begin xoa bai viet*/
    public function delete($id){
     //   $this->muser->permision("news","delete");
        $myNews = $this->mnews->getData('',array("id"=>$id));
        if(empty($myNews) || empty($id))
        {
            redirect(admin_url."news/");
        }
        if(file_exists($this->_file_path.'/'.$myNews["news_picture"])){
            unlink($this->_file_path.'/'.$myNews["news_picture"]);
        }
        if(file_exists($this->_file_path.'/'.$myNews["news_file"])){
            unlink($this->_file_path.'/'.$myNews["news_file"]);
        }
        if(!empty($tmp['news_picture_more']))
        {
            $list_pic = unserialize($tmp['news_picture_more']);
            foreach ($list_pic as $key => $value) {
                if(file_exists($this->_file_path.'/'.$value)){
                    unlink($this->_file_path.'/'.$value);
                }
            }
        }
        $this->mnews->deleteData($id);
        $this->mnews_lang->deleteAnd(array('news_id'=>$id));
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."news/");
    }
    /**end xoa bai viet*/


    public function delete_picture()
    {
        $id = $this->input->post('id');
        $name_file = $this->input->post('name_file');
        if($id && $name_file)
        {
            if(file_exists($this->_file_path.'/'.$name_file)){
                unlink($this->_file_path.'/'.$name_file);
            }
        }
        $this->mnews->updateData($id,array('news_picture'=>''));
        echo 1;
    }

    public function uploadFileMul()
    {
        $arr = array();
        if(isset($_POST['fsubmit']) && isset($_FILES['news_picture_more']))
        {
            $boxfile = $_FILES['news_picture_more'];
            if($boxfile)
            {
                $count = count($boxfile['name']);
                for ($i=0; $i < $count ; $i++) {
                    if($boxfile['name'][$i]) {
                        $_FILES['upfile']['name'] = $boxfile['name'][$i];
                        $_FILES['upfile']['type'] = $boxfile['type'][$i];
                        $_FILES['upfile']['tmp_name'] = $boxfile['tmp_name'][$i];
                        $_FILES['upfile']['error'] = $boxfile['error'][$i];
                        // $_FILES['upfile']['size'] = $boxfile['size'][$i];
                        $info = $this->mnews->upload($this->_file_path,'upfile');
                        array_push($arr, $info['file_name']);
                    }
                }
                $this->_data['success'] = 'Upload thành công';
            }
        }
        return $arr;
    }
   
    public function removeFile()
    {
        $file_name = $this->input->post('filename');
        $news_id = $this->input->post('id');
        $this->mnews->removeFileMul($file_name,$news_id);
    }
	// upload in summernote
	 public function summernote() {   
		$name = 'file' ;
		$url_image = base_file.'news/summernote/' ;
        $temp = $this->mnews->upload($this->_file_path.'/summernote', $name , '' , '');
		 
		echo  $url_image.$temp['file_name'] ; exit ;
    }
}