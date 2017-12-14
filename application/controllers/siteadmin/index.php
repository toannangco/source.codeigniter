<?php
/**
* 
*/
class Index extends CI_Controller
{
    public function __construct()
    { 
        parent::__construct();
        $this->load->library(array("form_validation","session"));
        $this->load->helper(array("url","language","my_helper","form"));
        $this->load->Model("backend/muser");
    
        $this->load->Model("backend/mhistory_login");
		 
        $this->load->file('application/helpers/my_helper.php');
         
   
 
    }
    public function index(){
		
        if(isset($_SESSION['unsuccess']) && $_SESSION['unsuccess'] >= 5)
        {
            redirect(base_url());
        }
        $s_info = $this->session->userdata('userInfo');
        if($s_info){
            redirect(admin_url."home/index/");
        }
        $data["title"] = "Login";
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        /**begin check du lieu*/
        $data["set_login"]=NULL;
        $this->form_validation->set_rules('username','User','required|trim');
        if($this->form_validation->run()==TRUE){
            $username_login = $this->security->sanitize_filename($this->input->post("username"));
            $password_login = $this->security->sanitize_filename($this->input->post("password"));
            $data["set_login"] = array(
                "username"=>$username_login,
                "password"=>$password_login
            );
            $check_login = $this->muser->getOnceAnd(array("user_username"=>$username_login,"user_password"=>md5($password_login),"user_status"=>1));                    
                if($check_login){
                    /**begin luu lich su*/
                    $session_id = $this->session->userdata('session_id');
                    $ip_address = $this->session->userdata('ip_address');
                     $user_agent = $this->session->userdata('user_agent'); //lay tat car  thong tin trinh duyet*/
                    $user_agent = $this->input->post("hd_brower");
                    $last_activity = $this->session->userdata('last_activity');
                    $data["mhistory_login"]=array(
                        "history_username"=>$check_login["user_username"],
                        "history_level"=>$check_login["user_level"],
                        "history_ip"=>$ip_address,
                        "history_time"=>$last_activity,
                        "history_user_agent"=>$user_agent,
                        "history_session_id"=>$session_id
                    );
                    $_SESSION['master'] = 0;
                    $this->mhistory_login->add($data["mhistory_login"]);
                    /**end luu lich xu dang nhap*/

                    $groupper = '';
                    if(   $check_login['user_level'] != 1 ){
                        redirect(base_url());
                    }
                    $tmp_groupper = $groupper ? rtrim($groupper,","):'';
                    // echo $tmp_groupper;
                    /**begin gan session*/
                    $userInfo = array(
                        "s_user_id"=>$check_login["id"],
                        "s_user_username"=>$check_login["user_username"],
                        "s_user_password"=>$check_login["user_password"],
                        "s_user_first_name"=>$check_login["user_first_name"],
                        "s_user_last_name"=>$check_login["user_last_name"],
                        "s_user_level"=>$check_login["user_level"],
                        "s_user_group"=>$tmp_groupper,
                        "s_user_gender"=>$check_login["user_gender"],
                        "s_user_birthday"=>$check_login["user_birthday"],
                        "s_user_address"=>$check_login["user_address"],
                        "s_user_city"=>$check_login["user_city"],
                        "s_user_fax"=>$check_login["user_fax"],
                        "s_user_phone"=>$check_login["user_phone"],
                        "s_user_hotline"=>$check_login["user_hotline"],
                        "s_user_email"=>$check_login["user_email"],
                        "s_user_yahoo"=>$check_login["user_yahoo"],
                        "s_user_skype"=>$check_login["user_skype"],
                        "s_user_intro"=>$check_login["user_intro"],
                        "s_user_website"=>$check_login["user_website"],
                        
                        "s_logged_in"=>true
                    );
                    /**end gan session*/
                    $this->session->set_userdata('userInfo',$userInfo);
                    $s_info = $this->session->userdata('userInfo');
                    if($s_info){
                        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                            redirect(base64_decode($_REQUEST['redirect']));
                        else
                            redirect(admin_url."home/index/");
                    }
                }
                else{
                    if(!isset($_SESSION['unsuccess'])){
                        $_SESSION['unsuccess'] = 1;
                    }else{
                        $_SESSION['unsuccess'] = $_SESSION['unsuccess'] + 1;
                        if($_SESSION['unsuccess'] >= 5)
                        {
                            redirect(base_url());
                        }
                    }
                }
            
        }
        $this->load->view("backend/login/login_view",$data);
    }
    public function forgot(){
        $data["title"] = "Forgot-password";
        $s_info = $this->session->userdata('userInfo');
        $check_login = $this->muser->getOnceAnd(array("user_email"=>$this->input->post("txt_email"),"user_status"=>1));
        if($check_login){
            /**begin send mail va luu vao csdl*/
            /**config website*/
            $this->load->Model("backend/mconfig");
            $this->load->Model("backend/mcompany");
            $config_web = $this->mconfig->getOnceAnd();
            if($config_web){
                /**title web*/
                if(!defined("config_title")){
                    define("config_title", $config_web["config_title"]);
                }
                /**config_mail_type*/
                if(!defined("config_mail_type")){
                    define("config_mail_type", $config_web["config_mail_type"]);
                }
                /**config_mail_user_gmail*/
                if(!defined("config_mail_user_gmail")){
                    define("config_mail_user_gmail", $config_web["config_mail_user_gmail"]);
                }
                /**config_mail_smtp_gmail*/
                if(!defined("config_mail_smtp_gmail")){
                    define("config_mail_smtp_gmail", $config_web["config_mail_smtp_gmail"]);
                }
                /**config_mail_pass_gmail*/
                if(!defined("config_mail_pass_gmail")){
                    define("config_mail_pass_gmail", $config_web["config_mail_pass_gmail"]);
                }
                /**config_mail_user_server*/
                if(!defined("config_mail_user_server")){
                    define("config_mail_user_server", $config_web["config_mail_user_server"]);
                }
                /**config_mail_pass_server*/
                if(!defined("config_mail_pass_server")){
                    define("config_mail_pass_server", $config_web["config_mail_pass_server"]);
                }
                /**config_mail_port_server*/
                if(!defined("config_mail_port_server")){
                    define("config_mail_port_server", $config_web["config_mail_port_server"]);
                }
                /**config_mail_smtp_server*/
                if(!defined("config_mail_smtp_server")){
                    define("config_mail_smtp_server", $config_web["config_mail_smtp_server"]);
                }
            }
            $company = $this->mcompany->getOnceAnd(array("company_lang"=>$this->uri->segment(1)));
            if($company){
                /**ten cong ty*/
                if ( ! defined('company')){
                    define('company',$company["company_name"]);
                }
            }
            /**end config web*/

            $this->form_validation->set_error_delimiters('<div class="error">','</div>');
            $this->form_validation->CI =& $this;
            $this->form_validation->set_rules('txt_email','Email','required');
            $data["success"] = NULL;
            if($this->form_validation->run()==TRUE){
                if(config_mail_type=="gmail"){
                    /**gmail*/
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => config_mail_smtp_gmail,
                        'smtp_port' => "465",
                        'smtp_user' => config_mail_user_gmail,
                        'smtp_pass' => config_mail_pass_gmail
                    );
                }else{
                    /**server*/
                    $config = array(
                        'protocol' => 'sendmail', //mail, sendmail, or smtp
                        'smtp_host' => config_mail_smtp_server,
                        'smtp_port' => config_mail_port_server,
                        'smtp_user' => config_mail_user_server,
                        'smtp_pass' => config_mail_pass_server
                    );
                }
                /**end cau hinh mail*/

                /**beign tao mat khau moi*/
                $pass_news = rand(100000,999999);
                $update_pass = array(
                    "user_password"=>md5($pass_news)
                );
                $this->muser->updateUser($check_login["id"], $update_pass);
                /**end tao mat khau moi*/
                    /**begin gui*/
                    $config['wordwrap'] = FALSE;
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $this->load->library('email',$config);
                    $content = "";
                    /**gui mail*/
                    $content = '<h1>Xin chào bạn: '.$check_login["user_last_name"].' '.$check_login["user_first_name"].' </h1><Br />';
                    $content .= "<b>Mật khẩu đăng nhập của bạn là:</b> ".$pass_news."</br>";
                    $this->email->set_newline("\r\n");
                    $this->email->from($config["smtp_user"], "Administrator ".company);
                    $this->email->subject("Quên mật khẩu");
                    $this->email->message($content);
                    $this->email->to($check_login["user_email"]);
                    if($this->email->send()){
                        $data["success"][] =  'Đã gửi '.$check_login["user_email"].'<br />';
                    }else{
                        show_error($this->email->print_debugger());
                    }
            }
            /**end send mail va luu vao csdl*/
        }
        $this->load->view("backend/login/forgot_view",$data);
    }
    /**begin logout*/
    public function logout(){
        session_destroy();
        $this->session->unset_userdata("userInfo");
        redirect(admin_url."index/");
    }
    /**end logout*/
}
?>