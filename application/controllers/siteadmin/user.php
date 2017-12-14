<?php
 
class User extends MY_Admin_Controller
{
    protected $_file_path = "";
    public function __construct()
    {
        parent::__construct();
       
        $this->_file_path = dir_root. '/public/frontend/uploads/files/user';
    }

    /**begin danh sach*/
    public function index($start = "")
    {
       
        $this->_data["title"] = "Danh sách  ";
        $join = "";
        $page = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : 'all';
		 $user_level = isset($_REQUEST['level']) ? $_REQUEST['level'] : '';
		// is admin
		if($user_level){
			 $and = "   user_level = ".$user_level." ";
		}else {
			 $and = "   user_level = 1 ";
		}
		
        if (is_numeric($status)) {
            $and .= " and user_status =  " . $status;
        }else{
            $and .= ' and user_status = 1';
        }
		 	
        $level = (isset($_REQUEST['level']) && $_REQUEST['level'] != 0 ) ? $_REQUEST['level'] : 'all';
        //if (is_numeric($level)) {
           // $and = " and user_level = 1 "; // . $level;
       //}
        $fkeyword = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword'] != "") ? $_REQUEST['fkeyword'] : '';
        if ($fkeyword) {
            $and .= " and (user_username like '%" . $fkeyword . "%'";
            $and .= " or user_first_name like '%" . $fkeyword . "%'";
            $and .= " or user_last_name like '%" . $fkeyword . "%'";
            $and .= " or user_address like '%" . $fkeyword . "%'";
            $and .= " or user_fax like '%" . $fkeyword . "%'";
            $and .= " or user_phone like '%" . $fkeyword . "%'";
            $and .= " or user_hotline like '%" . $fkeyword . "%'";
            $and .= " or user_yahoo like '%" . $fkeyword . "%'";
            $and .= " or user_skype like '%" . $fkeyword . "%'";
            $and .= " or user_intro like '%" . $fkeyword . "%'";
            $and .= " or user_website like '%" . $fkeyword . "%'";
            $and .= " or user_logo like '%" . $fkeyword . "%'";
            $and .= " or user_google like '%" . $fkeyword . "%'";
            $and .= " or user_facebook like '%" . $fkeyword . "%'";
            $and .= " or user_twitter like '%" . $fkeyword . "%'";
            $and .= " or user_email like '%" . $fkeyword . "%')";
        }
        $orderby = "  user_level asc, id desc";
        $config['per_page'] = 15;
        $config['uri_segment'] = (($page - 1) * $config['per_page']); 
        $this->_data["list"] = $this->muser->getQuerySql($object = "", $and, $orderby, $config['uri_segment'] . ',' . $config['per_page']);
        $this->_data["record"] = $this->muser->countQuery($and);
        $config['total_rows'] = $this->_data["record"];
        $config['num_links'] = 5;
        $config['base_url'] = admin_url.'user/index/?fkeyword=' . $fkeyword . '&level=' . $level . '&status=' . $status . '&page=';
        $this->_data["pagination"] = $this->paging->paging_donturl($this->_data["record"], $page, $config['per_page'], $config['num_links'], $config['base_url']);
        $this->my_layout->view("backend/user/user_list_view", $this->_data);
    }
    /**end danh sach*/

    /**begin them moi danh sach*/
    public function add()
    {
       
        $this->_data["title"] = "Thêm mới User";
        $this->_data['disabled'] = '';
        $this->_data["formData"]["user_username"]         =   '';
        $this->_data["formData"]["user_password"]         =   '';
        $this->_data["formData"]["user_first_name"]       =   '';
        $this->_data["formData"]["user_last_name"]        =   '';
        $this->_data["formData"]["user_level"]            =   '';
        $this->_data["formData"]["user_gender"]           =   '1';
        $this->_data["formData"]["user_birthday"]         =   '';
        $this->_data["formData"]["user_address"]          =   '';
        $this->_data["formData"]["user_city"]             =   '';
        $this->_data["formData"]["user_fax"]              =   '';
        $this->_data["formData"]["user_phone"]            =   '';
        $this->_data["formData"]["user_hotline"]          =   '';
        $this->_data["formData"]["user_email"]            =   '';
        $this->_data["formData"]["user_yahoo"]            =   '';
        $this->_data["formData"]["user_skype"]            =   '';
        $this->_data["formData"]["user_twitter"]          =   '';
        $this->_data["formData"]["user_facebook"]         =   '';
        $this->_data["formData"]["user_google"]           =   '';
        $this->_data["formData"]["user_intro"]            =   '';
        $this->_data["formData"]["user_website"]          =   '';
        $this->_data["formData"]["user_status"]           =   '1';
        $this->_data["formData"]["user_alias"]            =   '';
        $this->_data["formData"]["user_createdate"]       =   time();
        $this->_data["formData"]["user_updatedate"]       =   time();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="padding:5px;margin:0;border:0;border-radius:0">', '</div>');
        $this->form_validation->set_rules('user_username', 'Tài khoản', 'required|trim|min_length[5]|max_length[32]');
        $this->form_validation->set_rules('user_password', 'Mật khẩu', 'required|trim|min_length[8]|max_length[32]');
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
            $this->_data["formData"]["user_username"]         =   $this->input->post("user_username");
            $this->_data["formData"]["user_password"]         =   md5($this->input->post("user_password"));
            $this->_data["formData"]["user_first_name"]       =   $this->input->post("user_first_name");
            $this->_data["formData"]["user_last_name"]        =   $this->input->post("user_last_name");
            $this->_data["formData"]["user_level"]            =   $this->input->post("user_level");
            $this->_data["formData"]["user_gender"]           =   $this->input->post("user_gender");
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
            $this->_data["formData"]["user_website"]          =   $this->input->post("user_website");
            $this->_data["formData"]["user_status"]           =   $this->input->post("user_status");
            /**begin kiem tra va xu ly luu*/
            $this->muser->addUser($this->_data["formData"]);
            redirect(admin_url.'user/index/');
            /*}*/
            /**end kiem tra va xu ly*/
        }
        $this->my_layout->view("backend/user/user_post_view", $this->_data);
    }
    /**end them moi danh sach*/
    /**begin them moi danh sach*/
    public function update($id)
    {
      // form open bi false
        $this->_data["title"] = "Thêm mới User";
        $myUser = $this->muser->getOnceAnd(array('id'=>$id));
        if(empty($myUser))
        {
            redirect(admin_url.'user/');
        }
        $this->_data['disabled'] = 'disabled';
        $this->_data["formData"]["user_username"]         =  $myUser['user_username'];
        $this->_data["formData"]["user_password"]         =  $myUser['user_password'];
        $this->_data["formData"]["user_first_name"]       =  $myUser['user_first_name'];
        $this->_data["formData"]["user_last_name"]        =  $myUser['user_last_name'];
        $this->_data["formData"]["user_level"]            =  $myUser['user_level'];
        $this->_data["formData"]["user_gender"]           =  $myUser['user_gender'];
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
        $this->_data["formData"]["user_status"]           =  $myUser['user_status'];
        $this->_data["formData"]["user_alias"]            =  $myUser['user_alias'];
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
            $this->_data["formData"]["user_username"]         =   $myUser['user_username'];
            $this->_data["formData"]["user_password"]         =   $user_password;
            $this->_data["formData"]["user_first_name"]       =   $this->input->post("user_first_name");
            $this->_data["formData"]["user_last_name"]        =   $this->input->post("user_last_name");
            $this->_data["formData"]["user_level"]            =   $this->input->post("user_level");
            $this->_data["formData"]["user_gender"]           =   $this->input->post("user_gender");
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
            $this->_data["formData"]["user_website"]          =   $this->input->post("user_website");
            $this->_data["formData"]["user_status"]           =   $this->input->post("user_status");
            $this->muser->updateUser($id,$this->_data["formData"]);
            redirect(admin_url.'user/index/');
        }
        $this->my_layout->view("backend/user/user_post_view", $this->_data);
    }
    /**end them moi danh sach*/

    /**begin cap nhat trang thai*/
    public function update_status($id, $status, $path='')
    {
      //  $this->muser->permision("user","update_status");
        if (isset($id) && is_numeric($id)) {
            $this->_data["set_value"] = array(
                "user_status" => $status
            );
            $this->muser->updateUser($id, $this->_data["set_value"]);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            } else {
                redirect(admin_url.'user/index/');
            }
        } else {
            $this->_data["title"] = "Không tìm thấy thông tin cập nhật";
            $this->_data["message"] = "Vui lòng kiểm tra lại đường dẫn !!";
            $this->my_layout->view("backend/404/404_view", $this->_data);
        }
    }
    /**end cap nhat trang thai*/

    /**begin xoa user*/
    public function delete($id, $path = "")
    {
       // $this->muser->permision("user","delete");
        if (isset($id) && is_numeric($id)) {
            $info = $this->muser->getOnceAnd(array("id" => $id));
            if ($info) {
                if (file_exists($this->_file_path.'/'.$info["user_logo"])) {
                    unlink($this->_file_path.'/'.$info["user_logo"]);
                }
                /**end hinh anh*/
            }
            $this->muser->deleteUser($id);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            } else {
                redirect(admin_url.'user/index/');
            }
        } else {
            $this->_data["title"] = "Không tìm thấy thông tin cập nhật";
            $this->_data["message"] = "Vui lòng kiểm tra lại đường dẫn !!";
            $this->my_layout->view("backend/404/404_view", $this->_data);
        }
    }
    /**end xoa user*/
    public function profile()
    {
      //  $this->muser->permision("user","profile");
        $this->_data['title'] = 'Cập nhật thông tin';
        $s_info = $this->session->userdata('userInfo');
        if(empty($s_info))
        {
            redirect(admin_url.'user/');
        }
        $myUser = $this->muser->getOnceAnd(array('id'=>$s_info['s_user_id']));
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
                $this->muser->removeFile($this->_file_path,$this->_data['formData']["user_logo"]);
            }
            else{
                $name_picture           =   $this->_data['formData']['user_logo'];
            }

            $picture                =   $this->muser->upload($this->_file_path, 'user_logo');
            $user_logo           =   !empty($picture) ? $picture['file_name'] : '';
            if($user_logo && !empty($myUser))
            {
                $name_picture       =   $user_logo;
                $this->muser->removeFile($this->_file_path,$myUser["user_logo"]);
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
            $this->muser->updateUser($s_info['s_user_id'],$this->_data["formData"]);
            redirect(admin_url.'home/');
        }
        $this->my_layout->view("backend/user/user_profile_view", $this->_data);
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
            $check_login = $this->muser->getOnceAnd(array("user_username"=>$username_login,"user_password"=>$password_login,"user_status"=>1));
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
        $list = $this->muser->getAnd(array("user_status" => 1), "");
        $li_tmp = "";
        if ($list) {
            foreach ($list as $item) {
                $old = "";
                $birth_day = date("Y-m-d", $item["user_birthday"]);
                $tmp_bd = explode("-", $birth_day);
                $date = $tmp_bd[2];
                $month = $tmp_bd[1];
                if ($date == date("d") && $month == date("m")) {
                    $old = date("Y") - date("Y", $item["user_birthday"]) . ' tuổi';
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