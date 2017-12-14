<?php
class MY_Controller extends CI_Controller{
   // protected $_data;
    public function __construct(){
        parent::__construct();
		/**  get config  **/
		$data=unserialize(file_get_contents('public/config/config.php'));
		foreach($data as $k=>$v){
			$this->_data['web'][$k] = $data[$k];
		}
		/**  end get config  **/
        $this->load->library(array("my_layout","pagination","session","paging","cart"));
        $this->load->helper(array("url","my_helper"));
        $this->my_layout->setLayout("template/frontend/template"); 
        $this->load->Model("mmenu");
        $this->load->Model("mnews");
		$this->load->Model("mpost");
        $this->load->Model("frontend/mmailto");
        $this->_data['title'] = '';
        $this->_data['s_member'] = $this->session->userdata('s_member'); 
        if(!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'vn';
        }
        $this->_data["lang"] =  isset($_SESSION['lang']) ? $_SESSION['lang']:'vn';
		
	
		$this->_data['menuTop'] = $this->mmenu->getMenu(1,$this->_data["lang"]);
		 
		$this->_data['title'] = 'Ngoại ngữ Ielts Đa Minh';
          
        if(isset($_POST['sfMail']))
        {
            $fsemail = $this->input->post('mailto_email');
            $faddress = '';
            $ffullname = 'Khách hàng đăng ký nhận mail';
            if($fsemail)
            {
                $this->registerEmail($fsemail,$ffullname,$faddress);
            }
        }
        $this->_data['contactInfo'] = 'Thông tin liên hệ';
        /**end submit dang ky nhan mail*/
       // $this->_data['picture'] = base_img.'logo.png';
       // $this->_data['title'] = config_title;
      //  $this->_data['description'] = config_description;
       // $this->_data['keywords'] = config_keyword;
	  
    }
	 


    /**begin dang ky nhat mail*/
    public function registerEmail($email,$ffullname,$faddress){
        $error  = "";
        if($email){
            $checkemail = $this->checkemail($email);
            // 0=> khong ton tai, 1=> ton tai
            if($checkemail==0){
                $phone = "";
                $title = $email;
                $content = '';
                $file="";
                $data["set_value"] = array(
                    "mailto_fullname"=>$ffullname,
                    "mailto_email"=>$email,
                    "mailto_address"=>$faddress,
                    "mailto_phone"=>$phone,
                    "mailto_title"=>$title,
                    "mailto_content"=>$content,
                    "mailto_file"=>$file,
                    "mailto_create_date"=>time(),
                    "mailto_status"=>0
                );
                if($data['set_value']){
                    $this->mmailto->insert($data["set_value"]);
                    echo '<script>';
                        echo 'alert("Cám ơn bạn đã đăng ký nhận email từ '.base_url.'");';
                        echo 'window.location.href="'.current_url().'"';
                    echo '</script>';
                    $error = $email = "";
                }else{
                    $error = "Vui lòng kiểm tra email";
                }
            }else{
                echo '<script>';
                echo 'alert("Email đã tồn tại !");';
                echo 'window.location.href="'.base_url().'#registeremail";';
                echo '</script>';
            }
        }
    }
    /**end dang ky nhan mail*/

    /**begin check email*/
    public function checkemail($email){
        if($email){
            $check = $this->mmailto->countQuery('  mailto_email = "'.$email.'" ');
            if($check > 0 ){
                return 1; // da ton tai
            }else{
                return 0; // khong ton tai
            }
        }else{
            return 0; // khong ton tai
        }
    }
    /***end check email*/

    public function Msendmail($name,$from,$to,$cc='',$bcc='',$title,$content,$file='')
    {
        $this->load->library('email');
        $this->load->library('parser');
        $config['useragent']        = 'CodeIgniter';
        $config['protocol']         = 'mail';
        $config['mailpath']         = '/usr/sbin/sendmail';
        $config['wordwrap']         = TRUE;
        // $config['wrapchars']        = 76;
        $config['mailtype']         = 'html';
        $config['charset']          = 'utf-8';
        $config['validate']         = FALSE;
        $config['priority']         = 3;
        $config['crlf']             = "\r\n";
        $config['newline']          = "\r\n";
        $config['bcc_batch_mode']   = FALSE;
        $config['bcc_batch_size']   = 200;

        $this->email->initialize($config);
        $this->email->from($from, $name);
        $this->email->to($to); 
        if($cc){
            $this->email->cc($cc);
        }
        if($bcc){
            $this->email->bcc($bcc);
        }

        $this->email->subject($title);
        $this->email->message($content); 
        if($file){
            $this->email->attach($file); 
        }
        if($name && $from && $to && $title && $content){
            $this->email->send();
        }
    }
	 
	
}
?>