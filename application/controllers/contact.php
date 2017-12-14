<?php
require_once dir_root."/public/backend/library/contact/class.phpmailer.php"; 
require_once dir_root."/public/backend/library/contact/PHPMailerAutoload.php"; 

class contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		 $this->load->library(array("my_layout","pagination","session","paging","cart"));
    }
    public function index()
    {	
		 $this->_data['title'] = 'Liên hệ'; 
	 

		$error ='';
		$post['name']='';
		$post['email']='';
		$post['phone']='';
		$post['adress']='';
		$post['titlecontact']='';
		$post['content']='';
		
		if($id>0){
		 }
         if(isset($_POST['fsubmit'])){
			foreach($_POST as $k=>$v){
				if(isset($post[$k])){
					$post[$k] = $v;
				}
			}
			
			if(!$post['name'] || !$post['adress'] || !$post['phone'] || !$post['content']  ){
				$error = 'Nhập thông tin còn thiếu';
			}
			if(!filter_var($post['email'],FILTER_VALIDATE_EMAIL)){
				$error = 'Email không hợp lệ';
			}
            if(strlen($error) < 5){
				
				$mail = new PHPMailer;
				$mail->CharSet = 'UTF-8';
				$mail->SMTPDebug = 2;                               // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host =  "ssl://smtp.gmail.com";   // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'thuan.toannang@gmail.com';                 // SMTP username
				$mail->Password = 'thuan1234';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587; 
				$mail->From = $post['email'];
				$mail->FromName = 'Hệ thống liên hệ'; //Title 
				 
				$mail->addAddress('duthuan2609@gmail.com', 'duthuan2609@gmail.com');
				$mail->isHTML(true); 
                $mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
				if(!$mail->send()) {
					
					$error='Gửi mail không được , bạn vui lòng xem lại !';
				} else {
					
					$sucess ='giử mail thàng công !';
				}
			}

			
		 }
		  
		 if(strlen($sucess) > 5){
			  $post ='';
			  $post['sucess'] = $sucess;
		 }
		 $post['error']=$error ;
		 $this->_data['err'] = $post;
		 
		 
		 $this->_data['website_contact_detail'] = file_get_contents('public/config/contact.php');
		 $this->_data['title']  = 'Liên hệ ';
        $this->_data['breadcrumb'] =' <ol class="breadcrumb">
									<li><a href="'.base_url.'">Trang chủ</a></li>
    
									<li class="active">'.$this->_data['title'].'</li>        
								  </ol>';
	  
      $this->_data['map'] = $this->_data['web']['website_map']	 ;
		
        $this->my_layout->view("frontend/contact/contact_view", $this->_data);
    }
}
