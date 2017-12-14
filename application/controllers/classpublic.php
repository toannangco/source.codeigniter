<?php
class classpublic extends  MY_Controller{
    public function __construct(){
        parent::__construct();
    }
    function _remap(){
        $this->index();
    }
    /**begin trang chu*/
    public function index(){
        $this->_data['title'] = 'Trang lớp học cộng đồng';
       $rs = $this->db->query("select * from tkwp_classpublic") ; 
	   $this->_data['class'] = $rs->row_array();  
	   if(isset($_POST['lopcongdong'])){
		  if(count($_POST['type'])){
			  $type = $this->input->post("type");
			  if(count($type)){
				 $type = implode(' / ',$type) ;
				 $url=base_url.'thanh-vien/form-dang-ky/?class=4&type='.$type.'&redirect='.base64_encode(base_url.'thanh-vien/form-dang-ky/?class=4&type='.$type) ;
				 redirect($url);
			  }else{
				  echo '<script>alert("Vui lòng chọn lớp học")</script>';
			  }
		  }
	   }
	   
	   
       $this->my_layout->view("frontend/publicclass",$this->_data);
    }
   
}
/*
Array
(
    [type] => Array
        (
            [0] => Lớp anh văn giao tiếp 
            [1] =>  Lớp anh văn nâng cao
            [2] => Lớp học miễn phí
        )

    [lopcongdong] => 
)*/