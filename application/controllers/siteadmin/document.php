<?php
/**
Thuận 9.10
**/
class Document extends MY_Admin_Controller{
	protected $_file_path = "";
    protected $_file_url = "";
    public function __construct(){
        parent::__construct();
        $this->load->Model("backend/mdocument");
        $this->_file_url = base_file.'document/';
        $this->_file_path = dir_root. '/public/frontend/uploads/files/document';
    }
    
    public function index(){
		$this->_data['title'] = 'Danh sách tài liệu';
		   
		$and = '';  
		$page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
		$orderby = " id DESC";
		 if(isset($_REQUEST['parent'])) 
		  {
			  $this->_data['document_parent'] = $_REQUEST['parent'];
			  $and .= '    document_parent = '.$this->_data['document_parent'].'  ';
		  }	
		
        $config['per_page']         =   20;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $object = "";
		$this->_data["record"] =  $this->mdocument->countQuery($and);
   
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   50;
        $config['base_url']         =   admin_url.'document/?parent='.$this->_data['document_parent'].'&page=';
		
		 $this->_data["list"] = $this->mdocument->getQuerySql($object,$and,$orderby,$config['uri_segment'].','.$config['per_page']); 
         $this->_data["pagination"] =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        
		
		$this->my_layout->view("backend/document/document_list_view",$this->_data);
	}
	
	public function add(){
		$this->_data['title'] = 'Thêm tài liệu';
		$this->_data['formData']['document']['document_file'] = '';
		$this->_data['formData']['document']['document_name'] = '';
		$this->_data['formData']['document']['document_dateadd'] = date('d-m-Y h:i:s');
		$this->_data['formData']['document']['document_oderby'] = 0;
		$this->_data['formData']['document']['document_summary'] = '';
		$this->_data['formData']['document']['document_parent'] = '';
		$this->_data['formData']['document']['user_id'] = $this->_data['s_info']['s_user_id'];
		$this->_data['formData']['document']['document_file']          =    '';
		$this->_data['formData']['document']['document_picture']          =    '';
		$this->_data['formData']['document']['document_detail']          =    '';
		$this->_data['formData']['document']['document_name_alias']          =    '';
		
		if(isset($_POST['fsubmit'])) {
		foreach( $this->_data['formData']['document']  as $k=>$v){
			if(isset($_POST[$k])){
				$this->_data['formData']['document'][$k] = $this->input->post($k);					 
			}
		}
		 $removepicture = $this->input->post('removepicture');
            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mdocument->removeFile($this->_file_path,$this->_data['formData']['document']["document_picture"]);
            }else{
                $name_picture           =   $this->_data['formData']['document']['document_picture'];
            }
            $picture                =   $this->mdocument->upload($this->_file_path, 'document_picture');
            $document_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($document_picture)
            {
                $name_picture       =   $document_picture;
                if($this->_data['formData']['news']["document_picture"]){
                    $this->mdocument->removeFile($this->_file_path,$this->_data['formData']['document']["document_picture"]);
                }
            }
		//end picture
		// upload  file
		if($removefile==1)
		{
			$name_file       =   '';
			if($this->_data['formData']['document']["document_file"]){
				$this->mdocument->removeFile($this->_file_path,$this->_data['formData']['document']["document_file"]);
			}
		}else{
			$name_file           =   $this->_data['formData']['document']['document_file'];
		}
		$file                =   $this->mdocument->uploadfile($this->_file_path, 'document_file');
		$document_file           =   !empty($file) ? $file['file_name'] : '';
		if($document_file)
		{
			$name_file       =   $document_file;
			if($this->_data['formData']['document']["document_file"]){
				$this->mdocument->removeFile($this->_file_path,$this->_data['formData']['document']["document_file"]);
			}
		}
		$this->_data['formData']['document']['document_file']          =    $name_file;
		$this->_data['formData']['document']['document_picture']          =    $document_picture ;
		$this->_data['formData']['document_name_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData']['document_name'])));
		 
		// post
		 $add = $this->mdocument->addData($this->_data['formData']['document']);
		if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."document/index/");
		}
	 	 
		 
		
		//p($this->_data['formData']) ;
		$this->my_layout->view("backend/document/document_post_view",$this->_data);
	} 
	public function update($id_update){
		$this->_data['title'] = 'Cập nhập tài liệu';
		$myDocument = $this->mdocument->getData('',array('id'=>$id_update));
		 
		$this->_data['formData']['document_name']    =   $myDocument['document_name'];
		$this->_data['formData']['document_parent']    =   $myDocument['document_parent'];
		$this->_data['formData']['document_summary']    =   $myDocument['document_summary'];
		$this->_data['formData']['document_file']    =   $myDocument['document_file'];
		$this->_data['formData']['document_picture']    =   $myDocument['document_picture'];
		$this->_data['formData']['document_detail']    =   $myDocument['document_detail'];
		$this->_data['formData']['document_name_alias']    =   $myDocument['document_name_alias'];
		 if(isset($_POST['fsubmit']))
        {
		/*upload file*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_file   =   '';
                $this->mdocument->removeFile($this->_file_path,$this->_data['formData']["document_file"]);
            }else{
                $name_file    =   $this->_data['formData']['document_file'];
            }
            $file   =   $this->mdocument->uploadfile($this->_file_path, 'document_file');
            $document_file           =   !empty($file) ? $file['file_name'] : '';
            if($document_file)
            {
                $name_file       =   $document_file;
                if($myDocument["document_file"]){
                    $this->mdocument->removeFile($this->_file_path,$this->_data['form']["document_file"]);
                }
            }
			// picture
			$removepicture = $this->input->post('removepicture');

            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mdocument->removeFile($this->_file_path,$this->_data['formData']["document_picture"]);
            }
            else{
                $name_picture           =   $this->_data['formData']['document_picture'];
            }

            $picture                =   $this->mdocument->upload($this->_file_path, 'document_picture');
            $document_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($document_picture && !empty($myDocument))
            {
                $name_picture       =   $document_picture;
                if($myDocument["document_picture"]){
                    $this->mdocument->removeFile($this->_file_path,$myDocument["document_picture"]);
                }
            }
			
			//endpic
			$this->_data['formData']['document_file']          = $name_file;
			$this->_data['formData']['document_picture']          = $name_picture;
            $this->_data['formData']['document_name']          = $this->input->post('document_name');
			$this->_data['formData']['document_parent']          = $this->input->post('document_parent');
			$this->_data['formData']['document_name_alias']    =   mb_strtolower(url_title(convert_alias($this->_data['formData']['document_name'])));
			$this->_data['formData']['document_summary']          = $this->input->post('document_summary');
			$this->_data['formData']['document_detail']          = $this->input->post('document_detail');
			$this->_data['formData']['document_dateupdate']          = date('d-m-Y h:i:s');
			
			$this->mdocument->updateData($id_update,$this->_data['formData']);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."area/index/");
		
		}
		$this->my_layout->view("backend/document/document_post_view",$this->_data);
	}
	 public function delete($id){
     
        $myDocument = $this->mdocument->getData('',array("id"=>$id));
        if(empty($myDocument) || empty($id))
        {
            redirect(admin_url."document/");
        }
        if(file_exists($this->_file_path.'/'.$myDocument["document_file"])){
            unlink($this->_file_path.'/'.$myDocument["document_file"]);
        }
		if(file_exists($this->_file_path.'/'.$myDocument["document_picture"])){
            unlink($this->_file_path.'/'.$myDocument["document_picture"]);
        }
        $this->mdocument->deleteData($id);
       
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."document/");
    }
	 public function summernote() {   
		$name = 'file' ;
		$url_image = base_file.'document/summernote/' ;
        $temp = $this->mdocument->upload($this->_file_path.'/summernote', $name , '' , '');
		 
		echo  $url_image.$temp['file_name'] ; exit ;
    }
	
	
}