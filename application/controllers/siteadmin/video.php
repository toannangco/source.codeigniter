<?php
/****
/* Thuận 12.1 
****/
class Video extends MY_Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model("mvideo");
    }
	public function index(){
        $this->_data['title'] = 'Danh sách Video';  
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
        $this->_data['fkeyword'] = isset($_REQUEST['fkeyword']) ? $_REQUEST['fkeyword']:'';
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and video_name like '%".$fkeyword."%'";
		}
        $orderby = " id DESC";
        $config['per_page']         =   20;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);   
        $object = ""; 
        $this->_data["list"] = $this->mvideo->getQuerySql($object,$and,$orderby,$config['uri_segment'].','.$config['per_page']);    
        $this->_data["record"] =  $this->mvideo->countQuery($and);
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;  
        $config['base_url']         =   admin_url.'video/?fkeyword='.$this->_data['fkeyword'].'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $this->my_layout->view("backend/video/list_view",$this->_data);
	}
	public function add(){
        $this->_data["title"] = 'Thêm mới Video';
        $post  =   array(
			'video_name'      =>'',
			'video_link'      =>'',
			'video_order' 	  =>'',
			'video_dateadd' => date('d-m-Y'),
			'user_id'     	  => $this->_data['s_info']['s_user_id']
		);
		 
		if(isset($_POST['fsubmit'])) {
            foreach( $post as $k=>$v)   {
				if(isset($_POST[$k])){
					$post[$k] = $this->input->post($k);							 
				}
			}
            $this->mvideo->addData($post);
			if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
			else
                redirect(admin_url."video/index/");
        }
        $this->my_layout->view("backend/video/post_view",$this->_data);
    }
	public function update($pro_id){
       
        $this->_data["title"] = 'Cập nhật Video';
        $myvideo = $this->mvideo->getOnceAnd(array('id'=>$pro_id));
        $post  =   array(
			'video_name'      =>$myvideo['video_name'],
			'video_link'      =>$myvideo['video_link'],
			'video_order' 	  =>$myvideo['video_order']
		);
		$this->_data['formData'] = $post ;
        if(isset($_POST['fsubmit']))
        {
            foreach( $post as $k=>$v)   {
				if(isset($_POST[$k])){
					$post[$k] = $this->input->post($k);							 
				}
			}
            $this->mvideo->updateData($pro_id, $post);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."video/index/");
        }
        $this->my_layout->view("backend/video/post_view",$this->_data);
    }
}