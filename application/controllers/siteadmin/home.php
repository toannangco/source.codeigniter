<?php
 
class Home extends MY_Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model("mnews");
		$this->load->Model("mpost");
		$this->load->Model("backend/mdocument");
        $this->load->Model("backend/mhistory_login");
        $this->load->Model("backend/mmailto");
		$this->load->Model("mvideo");
    }
    public function index(){ 
      
        $this->_data["title"]= 'Welcome admin CMS Admin';
     
        $and_album = array("album_status !="=>-1);
        $this->_data["list_album"] = '';
        $this->_data["record_album"] = '';
        
        $and_login  = "";
        $this->_data["list_history_login"] = $this->mhistory_login->listAllLimit($and_login,$orderby="id DESC",10,0);
        $this->_data["record_history_login"] = $this->mhistory_login->countAnd($and_login);
        
       
        
$this->_data["sum_aritce"] = $this->mnews->countAnd(array("news_status"=>1));
$this->_data["sum_user"] = $this->muser->countAnd(array("user_status"=>1));
$this->_data["sum_post"] = $this->mpost->countAnd(array("post_status"=>1));
 $this->_data["sum_document"] = $this->mdocument->countAnd();  
$this->_data["sum_mailto"] = $this->mmailto->countAnd();
  $this->_data["sum_video"] = $this->mvideo->countAnd();  
        $this->_data["sum_album"] = '';
        $this->_data["sum_product"] = '';
   

        $this->my_layout->view("backend/home/home_view",$this->_data);
    }
}