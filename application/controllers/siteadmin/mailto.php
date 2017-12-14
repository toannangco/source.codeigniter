<?php

/**
 *
 */

class mailto extends MY_Admin_Controller
{
    public function __construct()
    {        
        parent::__construct();
     

        $this->load->Model("backend/mmailto");
        $this->load->Model("backend/mmailto_sendmail"); 
    }

    /**begin danh sach */

    public function index(){        
        
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
      //  $this->muser->permision("mailto","index");
         

        $this->_data["title"] = "Danh sách thư liên hệ";
        $join = "";
        $and = " 1 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'";
        /**begin sort tour*/
        $page = (isset($_REQUEST['page']) && $_REQUEST['page'])?$_REQUEST['page']:'1';
        if(isset($_POST['fsearchtour']) || isset($_POST['fkeyword'])){
            $fkeyword  = trim($_POST['fkeyword']);
            redirect(admin_url.'mailto/index/?fkeyword='.$fkeyword.'&page='.$page);
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (mailto_fullname like '%".$fkeyword."%'";
            $and .= " or mailto_email like '%".$fkeyword."%'";
            $and .= " or mailto_address like '%".$fkeyword."%'";
            $and .= " or mailto_title like '%".$fkeyword."%'";
            $and .= " or mailto_content like '%".$fkeyword."%'";
           
            $and .= " or mailto_phone like '%".$fkeyword."%')";
        }
        $orderby = " id DESC";
        /**end sort tour*/

        /**lay du lieu*/
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $this->_data["list"] = $this->mmailto->getQuerySql($object="",$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record"] =  $this->mmailto->countQuery($and);

        /**beign status email
        * mail chua doc mail_read = 0
        * mail da doc mail_read = 1
        * mail hop thu den mail_status = 1
        * mail thung rac mail_status = -1
        */
        $this->_data["record_read"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'");
        $this->_data["record_trash"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status = -1");

        /**begin cau ihnh phan trang*/
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'mailto/index/?fkeyword='.$fkeyword.'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $offset                     =   $page; # Lấy offset
        /**end cau hinh phan trang*/

        /**begin Xóa mục chọn*/
        if(isset($_POST['deleteCheckAll']) || isset($_POST['check_all'])){
            $check_all = isset($_POST["check_all"])?$_POST["check_all"]:'';
            if($check_all){
                foreach($check_all as $item){
                    $this->_data = array(
                        "mailto_status"=>"-1"
                    );
                    $this->mmailto->update($item,$this->_data);
                }
                redirect(admin_url."mailto/index/");
            }
        }
        /**end Xóa mục chọn*/
        $this->my_layout->view("backend/mailto/mailto_list_view",$this->_data);

    }

    /**end danh sach*/

    /**begin khach hang dang ky nhan mail*/
    public function customer(){
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
    //    $this->muser->permision("mailto","customer");
         
        
        $this->_data["title"] = "Danh sách thư liên hệ";
        $join = "";
        $and = " 1 and mailto_status != -1 and mailto_title ='Khách hàng đăng ký nhận mail'";
        /**begin sort tour*/
        $page = (isset($_REQUEST['page']) && $_REQUEST['page'])?$_REQUEST['page']:'1';
        if(isset($_POST['fsearchtour']) || isset($_POST['fkeyword'])){
            $fkeyword  = trim($_POST['fkeyword']);
            redirect(admin_url.'mailto/index/?fkeyword='.$fkeyword.'&page='.$page);
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (mailto_fullname like '%".$fkeyword."%'";
            $and .= " or mailto_email like '%".$fkeyword."%'";
            $and .= " or mailto_address like '%".$fkeyword."%'";
            $and .= " or mailto_title like '%".$fkeyword."%'";
            $and .= " or mailto_content like '%".$fkeyword."%'";
           
            $and .= " or mailto_phone like '%".$fkeyword."%')";
        }
        $orderby = " id DESC";
        /**end sort tour*/

        /**lay du lieu*/
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $this->_data["list"] = $this->mmailto->getQuerySql($object="",$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record"] =  $this->mmailto->countQuery($and);

        /**beign status email
        * mail chua doc mail_read = 0
        * mail da doc mail_read = 1
        * mail hop thu den mail_status = 1
        * mail thung rac mail_status = -1
        */
        $this->_data["record_read"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'");
        $this->_data["record_trash"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status = -1");

        /**begin cau ihnh phan trang*/
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'mailto/index/?fkeyword='.$fkeyword.'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $offset                     =   $page; # Lấy offset
        /**end cau hinh phan trang*/

        /**begin Xóa mục chọn*/
        if(isset($_POST['deleteCheckAll']) || isset($_POST['check_all'])){
            $check_all = isset($_POST["check_all"])?$_POST["check_all"]:'';
            if($check_all){
                foreach($check_all as $item){
                    $this->_data = array(
                        "mailto_status"=>"-1"
                    );
                    $this->mmailto->update($item,$this->_data);
                }
                redirect(admin_url."mailto/index/");
            }
        }
        /**end Xóa mục chọn*/
        $this->my_layout->view("backend/mailto/mailto_cus_view",$this->_data);

    }

    /**end danh sach*/



    /**begin danh sach */

    public function trash(){
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
   //     $this->muser->permision("mailto","trash");
         

        $this->_data["title"] = "Thùng rác thư liên hệ";        
        $this->_data["title"] = "Danh sách thư liên hệ";
        $join = "";
        $and = " 1 and mailto_status = -1 ";
        /**begin sort tour*/
        $page = (isset($_REQUEST['page']) && $_REQUEST['page'])?$_REQUEST['page']:'1';
        if(isset($_POST['fsearchtour']) || isset($_POST['fkeyword'])){
            $fkeyword  = trim($_POST['fkeyword']);
            redirect(admin_url.'mailto/trash/?fkeyword='.$fkeyword.'&page='.$page);
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (mailto_fullname like '%".$fkeyword."%'";
            $and .= " or mailto_email like '%".$fkeyword."%'";
            $and .= " or mailto_address like '%".$fkeyword."%'";
            $and .= " or mailto_title like '%".$fkeyword."%'";
            $and .= " or mailto_content like '%".$fkeyword."%'";
           
            $and .= " or mailto_phone like '%".$fkeyword."%')";
        }
        $orderby = " id DESC";
        /**end sort tour*/

        /**lay du lieu*/
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $this->_data["list"] = $this->mmailto->getQuerySql($object="",$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record"] =  $this->mmailto->countQuery($and);

        $this->_data["record_read"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'");
        $this->_data["record_trash"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status = -1");

        /**begin cau ihnh phan trang*/
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'mailto/trash/?fkeyword='.$fkeyword.'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $offset                     =   $page; # Lấy offset
        /**end cau hinh phan trang*/

        /**begin Xóa mục chọn*/
        if(isset($_POST['deleteCheckAll'])){
            $check_all = isset($_POST["check_all"])?$_POST["check_all"]:'';
            if($check_all){
                foreach($check_all as $item){
                    if(is_numeric($item) && $item>0){
                        $this->mmailto->delete($item);
                    }
                }
                redirect(current_url());
            }
        }
        /**end Xóa mục chọn*/


        /**begin Xóa mục chọn*/
        if(isset($_POST['refreshCheckAll'])){
            $check_all = isset($_POST["check_all"])?$_POST["check_all"]:'';
            if($check_all){
                foreach($check_all as $item){
                    $this->_data = array(
                        "mailto_status"=>"1"
                    );
                    $this->mmailto->update($item,$this->_data);
                }
                redirect(current_url());
            }
        }
        /**end Xóa mục chọn*/

        $this->my_layout->view("backend/mailto/mailto_trash_view",$this->_data);
    }
    /**end danh sach*/

    /**begin chi tiet mail*/
    public function info($id){
         
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
     //   $this->muser->permision("mailto","info");
         

        if(is_numeric($id) && $id>0){            
            $this->_data['title'] = "Chi tiet";
            $this->_data['info'] = NULL;
            $this->_data["record_read"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'");
            $this->_data["record_trash"] =  $this->mmailto->countQuery("mailto_read = 0 and mailto_status = -1");    
            $this->_data['info'] = $this->mmailto->getOnceAnd(array("id"=>$id));
            if($this->_data['info']){
                /**begin cap nhat trang thai*/
                $this->_data['update_status'] = array(
                    "mailto_read"=>1
                );
                $this->mmailto->update($id,$this->_data['update_status']);
                /**end cap nhat trang thai*/
            }
            $this->my_layout->view("backend/mailto/mailto_info_view",$this->_data);
        }
    }
    /**end chi tiet mail*/

    /**begin gui mail khach hang dang ky nhan mail*/
    public function customer_send()
    {
        # code...        
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
     //   $this->muser->permision("mailto","customer_send");
         

        $this->_data['title'] = 'Chương trình khuyến mãi';
        if(isset($_POST['sendmail']) && $_POST['sendmail']){
            $mailto_title = isset($_POST['mailto_title']) ? $_POST['mailto_title']:'';
            $mailto_content = isset($_POST['mailto_content']) ? $_POST['mailto_content']:'';
            if($mailto_title && $mailto_content){                
                $and = " 1 and mailto_status != -1 and mailto_title ='Khách hàng đăng ký nhận mail'";
                $listdata = $this->mmailto->getQuerySql("",$and,"id asc","");
                if($listdata){
                    foreach ($listdata as $key => $value) {                        
                        if($value['mailto_email']){
                            sendmail(company,company_email_1,$value['mailto_email'],$mailto_title,$mailto_content);
                        }
                    }                    
                }                
            }
        }
        $this->my_layout->view("backend/mailto/mailto_customer_send_view",$this->_data);
    }
    /**end gui mail khach hang dang ky nhan mail*/

    /**begin danh sach thu da gui*/
    public function send(){               
        
        
        $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');                 
    //    $this->muser->permision("mailto","send");
         
        
        $this->_data["title"] = "Danh sách thư liên hệ";
        $and = " 1 and mailto_send_status != -1 and controller = 'mailto' and user= ".$s_info['s_user_id'];
        /**begin sort tour*/
        $page = (isset($_REQUEST['page']) && $_REQUEST['page'])?$_REQUEST['page']:'1';
        if(isset($_POST['fsearchtour']) || isset($_POST['fkeyword'])){
            $fkeyword  = trim($_POST['fkeyword']);
            redirect(admin_url.'mailto/send/?fkeyword='.$fkeyword.'&page='.$page);
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (mailto_send_title like '%".$fkeyword."%'";
            $and .= " or mailto_send_content like '%".$fkeyword."%'";
            $and .= " or mailto_send_attach_file like '%".$fkeyword."%'";
            $and .= " or mailto_send_list_user like '%".$fkeyword."%'";
            $and .= " or mailto_send_create_date like '%".$fkeyword."%')";
        }
        $orderby = " id DESC";
        /**end sort tour*/

        /**lay du lieu*/
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $this->_data["list"] = $this->mmailto_sendmail->getQuerySql($object="",$and,$orderby,$config['uri_segment'].','.$config['per_page']);
        $this->_data["record_send"] =  $this->mmailto_sendmail->countQuery($and);
        $this->_data["record_inbox"] =  $this->mmailto->countQuery("mailto_status != -1");
        $this->_data["record_trash"] =  $this->mmailto->countQuery("mailto_status=-1");

        /**begin cau ihnh phan trang*/
        $config['total_rows']       =   $this->_data["record_send"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'mailto/send/?fkeyword='.$fkeyword.'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record_send"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        /**end cau hinh phan trang*/

        /**begin Xóa mục chọn*/
        if(isset($_POST['deleteCheckAll']) || isset($_POST['check_all'])){
            $check_all = isset($_POST["check_all"])?$_POST["check_all"]:'';
            if($check_all){
                foreach($check_all as $item){
                    $this->_data = array(
                        "mailto_send_status"=>"-1"
                    );
                    $this->mmailto_sendmail->update($item,$this->_data);
                }
                redirect(admin_url."mailto/index/");
            }
        }
        /**end Xóa mục chọn*/
        $this->my_layout->view("backend/mailto/mailto_send_view",$this->_data);
    }
    
    public static function mailhead(){
        include_once dir_root . '/application/models/backend/mmailto.php';
            $mmailto = new mmailto();

            $and = " mailto_read = 0 and mailto_status != -1 and mailto_title !='Khách hàng đăng ký nhận mail'";
            $orderby = " id DESC";
            /**end sort tour*/

            /**lay du lieu*/
            $data = $mmailto->getQuerySql($object="",$and,$orderby,"0,5");
            $record =  $mmailto->countQuery($and);
            if($record>0 && $data){
            echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="'.$record.' mail chưa đọc">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-success">'.$record.'</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have '.$record.' messages</li>';
                            $i=1;
                            foreach($data as $item){
                                $name = $item['mailto_fullname']?$item['mailto_fullname']:'';
                                $title = $item['mailto_title']?$item['mailto_title']:'';
                                $date = $item['mailto_create_date']?date("d/m/Y h:i:s",$item['mailto_create_date']):'';                                
                                echo '<li>
                                    <ul class="menu">
                                        <li>
                                            <a>
                                                <h4>
                                                    '.$name.'
                                                    
                                                </h4>
                                                <p>'.$title.'</p>
                                                <p><small><i class="fa fa-clock-o"></i> '.$date.'</small></p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>';                                
                            }
                        echo '<li class="footer"><a href="'.admin_url.'mailto/index/">More</a></li>';
                    echo '</ul>';
        }
    }
    /**end danh sach mail tren head*/



    /**begin ajax send mail trong danh sach thu lien he*/
    public function ajSendmail(){
        $s_info = $this->session->userdata('userInfo');
        $email_to = isset($_REQUEST['email_to']) && $_REQUEST['email_to']?$_REQUEST['email_to']:'';
        $email_cc = isset($_REQUEST['email_cc']) && $_REQUEST['email_cc']?$_REQUEST['email_cc']:'';
        $email_bcc = isset($_REQUEST['email_bcc']) && $_REQUEST['email_bcc']?$_REQUEST['email_bcc']:'';
        $email_title = isset($_REQUEST['email_title']) && $_REQUEST['email_title']?$_REQUEST['email_title']:'';
        $email_message = isset($_REQUEST['email_message']) && $_REQUEST['email_message']?$_REQUEST['email_message']:'';
        $html = 0;
        if($email_to && $email_title){
            /**goi thu vien gui mail*/
            include_once dir_root.'/public/backend/library/mail/send_mail.php';
            $mail = new BGMail();
            $list_user = array();
            $list_user[] = $email_to;
            if($email_cc)
                $list_user[] = $email_cc;
            if($email_bcc)
                $list_user[] = $email_bcc;
            $this->_data["set_value"] = array(
                "mailto_send_title" => $email_title,
                "mailto_send_content" => $email_message,
                "mailto_send_attach_file" => "",
                "mailto_send_list_user" => json_encode($list_user),
                "mailto_send_create_date" => time(),
                "controller"=>"mailto",
                "user" => $s_info["s_user_id"],
            );
            /**luu vao co so du lieu*/
            if($this->_data['set_value']){
                $this->mmailto_sendmail->addMail($this->_data["set_value"]);
                $mail->SendMail($email_title,$email_message,$file="",company,$email_to,company_email_1,config_mail_user_gmail,config_mail_pass_gmail);
                if($email_cc)
                    $mail->SendMail($email_title,$email_message,$file="",company,$email_cc,company_email_1,config_mail_user_gmail,config_mail_pass_gmail);
                if($email_bcc)
                    $mail->SendMail($email_title,$email_message,$file="",company,$email_bcc,company_email_1,config_mail_user_gmail,config_mail_pass_gmail);
                $html = 1;
            }
        }
        echo $html;
    }
    /**end ajax send mail trong danh sach thu lien he*/
}

