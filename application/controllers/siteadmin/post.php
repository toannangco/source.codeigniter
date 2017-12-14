 <?php
 
 
 
class Post extends MY_Admin_Controller{  
    protected $_file_path = "";
    protected $_file_url = "";
    public function __construct(){
        parent::__construct(); 
        $this->load->Model("mpost"); //echo 3333; exit ;
        $this->_file_url = base_file.'post/';
        $this->_file_path = dir_root. '/public/frontend/uploads/files/post';
    }

    /**begin danh sach*/
    public function index(){
		// echo 333444 ; exit ;
        $this->_data['title'] = danh_sach;
        $and = " nl.post_lang = '".$this->_data['lang']."'";
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
        $this->_data['post_parent'] = isset($_REQUEST['post_parent']) ? $_REQUEST['post_parent']:0;
        $this->_data['thot'] = isset($_REQUEST['thot']) ? $_REQUEST['thot']:0;
        $this->_data['tstatus'] = isset($_REQUEST['tstatus']) ? $_REQUEST['tstatus']:1;
        $this->_data['fkeyword'] = isset($_REQUEST['fkeyword']) ? $_REQUEST['fkeyword']:'';

        if($this->_data['post_parent'] != 0){
            $and .= " and post_parent =  ".$this->_data['post_parent'];
        }
        if($this->_data['thot'] != 0){
            $and .= " and post_hot =  ".$this->_data['thot'];
        }
        $and .= " and post_status =  ".$this->_data['tstatus'];
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (nl.post_lang_name like '%".$fkeyword."%'";
            $and .= " or nl.post_lang_alias like '%".$fkeyword."%'";
            
           
        }
        $orderby = " n.id DESC";
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $object = "n.id , n.user , n.post_picture , n.post_update_date, n.post_parent ";
        $object .= ",nl.*";
        $this->_data["list"] = $this->mpost->getPost($object,$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record"] =  $this->mpost->countData($and);
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'post/?fkeyword='.$this->_data['fkeyword'].'&post_parent='.$this->_data['post_parent'].'&thot='.$this->_data['thot'].'&tstatus='.$this->_data['tstatus'].'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $this->my_layout->view("backend/post/list_view",$this->_data);
    }
     
    public function status($id,$status){
       
        $this->_data = array(
            "post_status"=>$status
        );
        $this->mpost->updateData($id,$this->_data);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."post/index/");
    }
     
    public function add(){
 		
		$this->_data["title"] = 'Thêm mới tin tức';
		$this->_data['formData']['post_id']    =   '';
		$this->_data['formData']['post']['post_picture']   = '';
		$this->_data['formData']['post']['post_parent']      = isset($_REQUEST['post_parent']) ? $_REQUEST['post_parent']:0;
		$this->_data['formData']['post']['post_status']     = 1;
		$this->_data['formData']['post']['post_hot']       = 0;
		$this->_data['formData']['post']['post_create_date']   = date('Y-m-d');
		$this->_data['formData']['post']['post_update_date']    = date('Y-m-d');
		$this->_data['formData']['post']['user']     = $this->_data['s_info']['s_user_id'];
		$this->_data['formData']['post']['post_type']  = '';
        $this->my_layout->view("backend/post/post_view",$this->_data);
		if(isset($_POST['fsubmit']))
        { 
			$removepicture = $this->input->post('removepicture');
            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mpost->removeFile($this->_file_path,$this->_data['formData']['post']["post_picture"]);
            }else{
                $name_picture           =   $this->_data['formData']['post']['post_picture'];
            }
            $picture                =   $this->mpost->upload($this->_file_path, 'post_picture');
            $post_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($post_picture)
            {
                $name_picture       =   $post_picture;
                if($this->_data['formData']['post']["post_picture"]){
                    $this->mpost->removeFile($this->_file_path,$this->_data['formData']['post']["post_picture"]);
                }
            }
            $this->_data['formData']['post']['post_picture']       =    $name_picture;
            $this->_data['formData']['post']['post_parent']        =    $this->input->post('post_parent');
            $this->_data['formData']['post']['post_orderby']       =    $this->input->post('post_orderby');
            $this->_data['formData']['post']['post_status']        =    $this->input->post('post_status');
            $this->_data['formData']['post']['post_hot']           =    $this->input->post('post_hot');
            $this->_data['formData']['post']['post_create_date']   =    $this->input->post('post_create_date');
            $post_id = $this->mpost->addData($this->_data['formData']['post']);
            $this->_data['formData']['post_id'] = $post_id;
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $this->_data['formData'][$value->lang]['post_id']            = $post_id;
                    $this->_data['formData'][$value->lang]['post_lang']            = $value->lang;
                    $this->_data['formData'][$value->lang]['post_lang_name'] =   $this->input->post('post_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData'][$value->lang]['post_lang_name'])));
                   
                    $this->_data['formData'][$value->lang]['post_lang_summary']   =   $this->input->post('post_lang_summary_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_detail']   =   $this->input->post('post_lang_detail_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_title']    =   $this->input->post('post_lang_seo_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_keyword']  =   $this->input->post('post_lang_seo_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_description']  =   $this->input->post('post_lang_seo_description_'.$value->lang);
                    $check = $this->mpost_lang->getData('',array('post_id'=>$post_id,'post_lang'=>$value->lang));
                    if(!empty($check)){
                        $this->mpost_lang->updateAnd(array('post_id'=>$post_id,'post_lang'=>$value->lang),$this->_data['formData'][$value->lang]);
                    }else{
                        $this->mpost_lang->addData($this->_data['formData'][$value->lang]);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."post/index/");
			 
        }
		 
    }
 

   
    public function update($post_id){
		 $this->_data["title"] = 'Cập nhật';
        $myPost = $this->mpost->getData('',array('id'=>$post_id));
       
        $this->_data['formData']['post_id']    =   $post_id;
        $this->_data['formData']['post']['post_picture']    =   $myPost['post_picture'];
        $this->_data['formData']['post']['post_parent']     =   $myPost['post_parent'];
        $this->_data['formData']['post']['post_orderby']    =   $myPost['post_orderby'];
        $this->_data['formData']['post']['post_status']     =   $myPost['post_status'];
        $this->_data['formData']['post']['post_hot']        =   $myPost['post_hot'];
        $this->_data['formData']['post']['post_update_date']                = date('Y-m-d');
        $this->_data['formData']['post']['user']                        = $this->_data['s_info']['s_user_id'];;
        if(!empty($this->_data['language']))
        {
            foreach ($this->_data['language'] as $key => $value) {
                $myPostLang = $this->mpost_lang->getData('',array('post_id'=>$post_id,'post_lang'=>$value->lang));
                $this->_data['formData'][$value->lang]['post_id']            = $post_id;
                $this->_data['formData'][$value->lang]['post_lang']            = $value->lang;
                $this->_data['formData'][$value->lang]['post_lang_name']      =   !empty($myPostLang) ? $myPostLang['post_lang_name'] : '';
                $this->_data['formData'][$value->lang]['post_lang_alias']     =   !empty($myPostLang) ? $myPostLang['post_lang_alias'] : '';
                $this->_data['formData'][$value->lang]['post_lang_summary']    =   !empty($myPostLang) ? $myPostLang['post_lang_summary'] : '';
                $this->_data['formData'][$value->lang]['post_lang_detail']     =   !empty($myPostLang) ? $myPostLang['post_lang_detail'] : '';
                $this->_data['formData'][$value->lang]['post_lang_seo_title']  =   !empty($myPostLang) ? $myPostLang['post_lang_seo_title'] : '';
                $this->_data['formData'][$value->lang]['post_lang_seo_keyword']   =   !empty($myPostLang) ? $myPostLang['post_lang_seo_keyword'] : '';
                $this->_data['formData'][$value->lang]['post_lang_seo_description']  =   !empty($myPostLang) ? $myPostLang['post_lang_seo_description'] : '';
            }
        }
        if(isset($_POST['fsubmit']))
        {
             

            /*anh dai dien*/
            $removepicture = $this->input->post('removepicture');

            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mpost->removeFile($this->_file_path,$this->_data['formData']['post']["post_picture"]);
            }
            else{
                $name_picture           =   $this->_data['formData']['post']['post_picture'];
            }

            $picture                =   $this->mpost->upload($this->_file_path, 'post_picture');
            $post_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($post_picture && !empty($myPost))
            {
                $name_picture       =   $post_picture;
                if($myPost["post_picture"]){
                    $this->mpost->removeFile($this->_file_path,$myPost["post_picture"]);
                }
            }
             

            $this->_data['formData']['post']['post_picture']        = $name_picture;
            $this->_data['formData']['post']['post_parent']         = $this->input->post('post_parent');
            $this->_data['formData']['post']['post_orderby']        = $this->input->post('post_orderby');
            $this->_data['formData']['post']['post_status']         = $this->input->post('post_status');
            $this->_data['formData']['post']['post_hot']            = $this->input->post('post_hot');
            $this->mpost->updateData($post_id,$this->_data['formData']['post']);
            if(!empty($this->_data['language']))
            {
                foreach ($this->_data['language'] as $key => $value) {
                    $check = '';
                    $this->_data['formData'][$value->lang]['post_id']            = $post_id;
                    $this->_data['formData'][$value->lang]['post_lang']            = $value->lang;
                    $this->_data['formData'][$value->lang]['post_lang_name'] =   $this->input->post('post_lang_name_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData'][$value->lang]['post_lang_name'])));
                    $this->_data['formData'][$value->lang]['post_lang_summary']   =   $this->input->post('post_lang_summary_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_detail']   =   $this->input->post('post_lang_detail_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_title']    =   $this->input->post('post_lang_seo_title_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_keyword']  =   $this->input->post('post_lang_seo_keyword_'.$value->lang);
                    $this->_data['formData'][$value->lang]['post_lang_seo_description']  =   $this->input->post('post_lang_seo_description_'.$value->lang);
                    $check = $this->mpost_lang->getData('',array('post_id'=>$post_id,'post_lang'=>$value->lang));
                    if(!empty($check)){
                        $this->mpost_lang->updateAnd(array('post_id'=>$post_id,'post_lang'=>$value->lang),$this->_data['formData'][$value->lang]);
                    }else{
                        $this->mpost_lang->addData($this->_data['formData'][$value->lang]);
                    }
                }
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."post/index/");
        }
        $this->my_layout->view("backend/post/post_view",$this->_data);
    }
  

   
    public function delete($id){
      
    }
    


    public function delete_picture()
    {
        
    }

    
	 public function summernote() {   
		$name = 'file' ;
		$url_image = base_file.'post/summernote/' ;
        $temp = $this->mpost->upload($this->_file_path.'/summernote', $name , '' , '');
		echo  $url_image.$temp['file_name'] ; exit ;
    }
}