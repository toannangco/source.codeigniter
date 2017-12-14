<?php
 
class Customer extends MY_Admin_Controller
{
    protected $_file_path = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->Model("backend/mclass");
		$this->load->Model("backend/muser");
        $this->_file_path = dir_root. '/public/frontend/uploads/files/user';
		$this->data['class'] = $_GET['class'] ;
		$this->_class = array(
			1=>'Thi xếp lớp'
			,2=>'Thi thử với Ielts đề thật'
			,3=>'Đăng ký thi thật'
			,4=>'Lớp học cho cộng đồng'
		);
		
		
    }

    /**begin danh sach*/
    public function index($start = "")
    {  
		 
		 
        $this->_data["title"] = "Danh sách học viên ". $this->_class[$this->data['class']]  ;
        $join = "";
        $page = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $this->data['class'] = isset($_REQUEST['class']) ? $_REQUEST['class'] : '1';
		
		
		$and = '   class_type='.$this->data['class'].'  ';
		
      
        $fkeyword = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] != "") ? $_REQUEST['fkeyword'] : '';
        
        $orderby = " user_id ASC";
        $config['per_page'] = 40;
        $config['uri_segment'] = (($page - 1) * $config['per_page']);
		 
        $this->_data["list"] = $this->mclass->getQuerySql($object = "", $and, $orderby, $config['uri_segment'] . ',' . $config['per_page']);
   
		$this->_data["record"] = $this->mclass->countQuery($and);
        $config['total_rows'] = $this->_data["record"];
        $config['num_links'] = 40;
        $config['base_url'] = admin_url.'customer/index/?fkeyword=' . $fkeyword . '&class='. $this->data['class'].'&page='  ;
        $this->_data["pagination"] = $this->paging->paging_donturl($this->_data["record"], $page, $config['per_page'], $config['num_links'], $config['base_url']);
        $this->my_layout->view("backend/customer/customer_list_view", $this->_data);
    }
    
    public function add()
    {
       
    }
   
    public function update($id)
    {
          
    }
    /**end them moi danh sach*/

    /**begin cap nhat trang thai*/
    public function update_status($id, $status, $path='')
    {
       // $this->mclass->permision("user","update_status");
        if (isset($id) && is_numeric($id)) {
            $this->_data["set_value"] = array(
                "user_status" => $status
            );
            $this->mclass->updateUser($id, $this->_data["set_value"]);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            } else {
                redirect(admin_url.'user/index/');
            }
        } else {
            $this->_data["title"] = "Không thể cập nhập";
            $this->_data["message"] = "Vui lòng kiểm tra lại đường dẫn!!";
            $this->my_layout->view("backend/404/404_view", $this->_data);
        }
    }
    /**end cap nhat trang thai*/

    /**begin xoa user*/
    public function delete($id, $path = "")
    {
        //$this->mclass->permision("user","delete");
        if (isset($id) && is_numeric($id)) {
            $info = $this->mclass->getOnceAnd(array("id" => $id));
            if ($info) {
                if (file_exists($this->_file_path.'/'.$info["user_logo"])) {
                    unlink($this->_file_path.'/'.$info["user_logo"]);
                }
                /**end hinh anh*/
            }
            $this->mclass->deleteUser($id);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            } else {
                redirect(admin_url.'customer/index/');
            }
        } else {
            $this->_data["title"] = "Không tìm thấy thông tin cập nhập";
            $this->_data["message"] = "Vui lòng kiểm tra lại đường dẩn!!";
            $this->my_layout->view("backend/404/404_view", $this->_data);
        }
    }
    /**end xoa user*/
    public function profile()
    {
       
        $this->_data['title'] = 'Cập nhập thông tin';
        $s_info = $this->session->userdata('userInfo');
        if(empty($s_info))
        {
            redirect(admin_url.'user/');
        }
        $myUser = $this->mclass->getOnceAnd(array('id'=>$s_info['s_user_id']));
        if(empty($myUser))
        {
            redirect(admin_url.'user/');
        }
        $this->_data['disabled'] = 'disabled';
        $this->_data["formData"]["user_username"]         =  $myUser['user_username'];
        $this->_data["formData"]["user_password"]         =  $myUser['user_password'];
        $this->_data["formData"]["user_first_name"]       =  $myUser['user_first_name'];
        $this->_data["formData"]["user_last_name"]        =  $myUser['user_last_name'];
        $this->_data["formData"]["user_birthday"]         =  $myUser['user_birthday'];
        $this->_data["formData"]["user_address"]          =  $myUser['user_address'];
        $this->_data["formData"]["user_city"]             =  $myUser['user_city'];
        $this->_data["formData"]["user_fax"]              =  $myUser['user_fax'];
        $this->_data["formData"]["user_phone"]            =  $myUser['user_phone'];
        $this->_data["formData"]["user_hotline"]          =  $myUser['user_hotline'];
        $this->_data["formData"]["user_email"]            =  $myUser['user_email'];
        $this->_data["formData"]["user_yahoo"]            =  $myUser['user_yahoo'];
        $this->_data["formData"]["user_skype"]            =  $myUser['user_skype'];
        $this->_data["formData"]["user_twitter"]          =  $myUser['user_twitter'];
        $this->_data["formData"]["user_facebook"]         =  $myUser['user_facebook'];
        $this->_data["formData"]["user_google"]           =  $myUser['user_google'];
        $this->_data["formData"]["user_intro"]            =  $myUser['user_intro'];
        $this->_data["formData"]["user_website"]          =  $myUser['user_website'];
        $this->_data["formData"]["user_logo"]             =  $myUser['user_logo'];
        $this->_data["formData"]["user_updatedate"]       =   time();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="padding:5px;margin:0;border:0;border-radius:0">', '</div>');
        $this->form_validation->set_rules('user_password', 'Mật khẩu', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('user_first_name', 'Tên', 'required|trim');
        $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == TRUE) {
            $user_birthday = $this->input->post("user_birthday");
            if(!empty($user_birthday))
            {
                $user_birthday = date('Y-m-d',strtotime($user_birthday));
            }
            else{
                $user_birthday = '0000-00-00';
            }
            $user_password = $this->input->post("user_password");
            if(!empty($user_password))
            {
                if($myUser['user_password'] != $user_password)
                {
                    $user_password = md5($user_password);
                }
            }
            /*anh dai dien*/
            $removepicture = $this->input->post('removepicture');
            if($removepicture==1)
            {
                $name_picture       =   '';
                $this->mclass->removeFile($this->_file_path,$this->_data['formData']["user_logo"]);
            }
            else{
                $name_picture           =   $this->_data['formData']['user_logo'];
            }

            $picture                =   $this->mclass->upload($this->_file_path, 'user_logo');
            $user_logo           =   !empty($picture) ? $picture['file_name'] : '';
            if($user_logo && !empty($myUser))
            {
                $name_picture       =   $user_logo;
                $this->mclass->removeFile($this->_file_path,$myUser["user_logo"]);
            }
            $this->_data["formData"]["user_username"]         =   $myUser['user_username'];
            $this->_data["formData"]["user_password"]         =   $user_password;
            $this->_data["formData"]["user_first_name"]       =   $this->input->post("user_first_name");
            $this->_data["formData"]["user_last_name"]        =   $this->input->post("user_last_name");
            $this->_data["formData"]["user_birthday"]         =   $user_birthday;
            $this->_data["formData"]["user_address"]          =   $this->input->post("user_address");
            $this->_data["formData"]["user_city"]             =   $this->input->post("user_city");
            $this->_data["formData"]["user_fax"]              =   $this->input->post("user_fax");
            $this->_data["formData"]["user_phone"]            =   $this->input->post("user_phone");
            $this->_data["formData"]["user_hotline"]          =   $this->input->post("user_hotline");
            $this->_data["formData"]["user_email"]            =   $this->input->post("user_email");
            $this->_data["formData"]["user_yahoo"]            =   $this->input->post("user_yahoo");
            $this->_data["formData"]["user_skype"]            =   $this->input->post("user_skype");
            $this->_data["formData"]["user_twitter"]          =   $this->input->post("user_twitter");
            $this->_data["formData"]["user_facebook"]         =   $this->input->post("user_facebook");
            $this->_data["formData"]["user_google"]           =   $this->input->post("user_google");
            $this->_data["formData"]["user_intro"]            =   $this->input->post("user_intro");
            $this->_data["formData"]["user_logo"]             =   $name_picture;
            $this->_data["formData"]["user_website"]          =   $this->input->post("user_website");
            $this->mclass->updateUser($s_info['s_user_id'],$this->_data["formData"]);
            redirect(admin_url.'home/');
        }
        $this->my_layout->view("backend/customer/customer_profile_view", $this->_data);
    }
    /***begin khoa mang hinh che do cho*/
    public function lockscreen(){
        $s_info = $this->session->userdata('userInfo');
        if(!$s_info){
            redirect(admin_url.'index/logout/');
        }
        $this->_data['s_info'] = $s_info;
        if(isset($_POST['password']) || isset($_POST['sf_form'])){
            $username_login = $s_info['s_user_username'];
            $password_login = md5(trim($_POST['password']));
            $check_login = $this->mclass->getOnceAnd(array("user_username"=>$username_login,"user_password"=>$password_login,"user_status"=>1));
            if($check_login){
                if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                    redirect(base64_decode($_REQUEST['redirect']));
                }else{
                    redirect(admin_url);
                }
            }
        }
        $this->load->view("backend/user/user_lockscreen_view", $this->_data);
    }
    /***end khoa mang hinh che do cho*/

    /**begi sinh nhat thanh vien*/
    public function birthday()
    {
        $and_list = '';
        $count_u = 0;
        $list = $this->mclass->getAnd(array("user_status" => 1), "");
        $li_tmp = "";
        if ($list) {
            foreach ($list as $item) {
                $old = "";
                $birth_day = date("Y-m-d", $item["user_birthday"]);
                $tmp_bd = explode("-", $birth_day);
                $date = $tmp_bd[2];
                $month = $tmp_bd[1];
                if ($date == date("d") && $month == date("m")) {
                    $old = date("Y") - date("Y", $item["user_birthday"]) . ' tu?i';
                    $avatar = (isset($item['user_logo']) && $item['user_logo']) ? base_url.'public/frontend/uploads/files/user/'.$item["user_logo"]:admin_img.'no_image.png';
                    $li_tmp .= '<li>
                            <a href="#">
                                <div class="pull-left">
                                    <img src="'.$avatar.'" class="img-circle" alt="'.$item["user_last_name"].' '.$item["user_first_name"].'"/>
                                </div>
                                <h4>
                                    '.$item["user_last_name"].' '.$item["user_first_name"].'
                                    <small><i class="fa fa-gift"></i> '.$old.'</small>
                                </h4>
                                <p>User login: '.$item["user_username"].'</p>
                            </a>
                        </li>';
                    $count_u++;
                }
            }
        }
        if ($count_u) {
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-gift"></i>
                    <span class="label label-success">' . $count_u . '</span>
                </a>';
            echo '<ul class="dropdown-menu">
                <li class="header">You have ' . $count_u . ' messages</li>
                <li>
                    <ul class="menu">
                        '.$li_tmp.'
                        </ul>
                    </li>
                </ul>';
        }
    }
}