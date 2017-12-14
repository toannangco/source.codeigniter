<?php
    /**
    * Thuân
    */
    class user extends MY_Controller
    {
        
        function __construct()
        {
            parent::__construct();
            $this->load->Model("frontend/muser");
			$this->_data['url'] =  base64_decode($_REQUEST["redirect"]) ;
			 // $this->session->unset_userdata("s_member"); unset($_SESSION['facebook']) ; unset($_SESSION['google']) ;
        }
        
        public function index()
        {   
			 
            $this->_data['user_username'] = '';
            $this->_data['user_password'] = '';
            $this->_data['user_email'] = '';
            $this->_data['user_phone'] = '';
            $this->_data['s_member'] = $s_member = $this->session->userdata('s_member'); 
            $this->_data['title'] = 'Đăng nhập';
		// p(  $this->session->userdata('s_member') ) ;
            if($s_member)
            {
                $this->my_layout->view("frontend/user/welcome",$this->_data);
            }
            else
            {
                $this->login();
                return;
            }
        }
        
        public function login()
        {
			if(count($_POST['flogin'])) {
		     
			$this->_data['user_username'] = '';
            $this->_data['user_password'] = '';
            $this->_data['user_email'] = ''; 
            $this->_data['user_phone'] = '';
			$this->_data['user_address'] = '';
            $s_member = $this->session->userdata('s_member');  
			 
            $this->_data['title'] = 'Thành viên Đăng nhập';
            if($s_member)
            {
                redirect(base_url().'login/');
            }
            $username = isset($_POST['username']) && $_POST['username'] ? trim($_POST['username']):'';
            $password = isset($_POST['password']) &&  $_POST['password'] ? md5(trim($_POST['password'])):'';
            if($username && $password)
            {
                $check_login = $this->muser->getOnceAnd("",array("user_username"=>$username,"user_password"=>$password));
				 
                if($check_login)
                {   
                    if($check_login['user_status']!=1)
                    {
                        $this->_data['error'][] = 'Username is blocked !';
                    }
                    else
                    {
                        /**begin gan session*/
                        $s_member = array(
                            "s_user_id"=>$check_login["id"],
                            "s_user_fullname"=>$check_login["user_last_name"].' ' .$check_login["user_first_name"],
                            "s_user_username"=>$check_login["user_username"],
                            "s_user_password"=>$check_login["user_password"],
                            "s_user_phone"=>$check_login["user_phone"],
                            "s_user_email"=>$check_login["user_email"],
							"s_user_address"=>$check_login["user_address"],
							"s_user_gender"=>$check_login["user_gender"],
							"s_user_birthday"=>$check_login["user_birthday"],
							"s_user_work"=>$check_login["user_work"],
							"s_user_tinhthanh"=>$check_login["user_tinhthanh"],
							"s_user_quan"=>$check_login["user_quan"],
                        );
                        /**end gan session*/
                        $this->session->set_userdata('s_member',$s_member);
                        $s_member = $this->session->userdata('s_member');  
                        if($s_member)
                        {
                            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                            {  
                                redirect(base64_decode($_REQUEST["redirect"]));
                            }
                            else
                            {    
                                redirect(base_url.'thanh-vien/');
                            }
                        }
                    }
                }else{  
                    $this->_data['error'][] = 'Username or password incorrect.';
                }
            }
            else
            {
                $this->_data['error'][] = 'Please check data';
            }
		 }
            //$this->load->view("frontend/user/login_view",$this->_data);
			$this->my_layout->view("frontend/user/login_view", $this->_data);
       
		}
		 
		public function login_facebook(){
			$_SESSION['facebook'] = $_POST ; 
			$facebook = $_SESSION['facebook'] ;
			 
				// Lấy thông tin
				if(count($facebook )){
					$this->_data['user_username']	 = $facebook['email'];
					$this->_data['user_email']  	 = $facebook['email'];
					$this->_data['user_first_name']  = $facebook['first_name']. ' '. $facebook['last_name'];
					$this->_data['user_phone'] 	     = $facebook['phone'];
					$this->_data['user_facebook']    = $facebook['id'];
					$this->_data["user_level"]	=	10 ;
					$this->_data["user_status"]	=	1 ;
				}
			
			$check_login = $this->muser->getOnceAnd("",array("user_username"=>$this->_data['user_username'] ));
			if($check_login){  
				
				// Nếu đã tồn tại  -> login gán session
				$s_member = array(
								"s_user_id"=>$check_login["id"],
								"s_user_facebook"=>$check_login["user_facebook"],
                                "s_user_fullname"=>$check_login["user_first_name"],
                                "s_user_username"=>$check_login["user_username"],
                                "s_user_phone"=>$check_login["user_phone"],
								"s_user_address"=>$check_login['user_address'],
                                "s_user_email"=>$check_login["user_email"],
								 "s_user_birthday"=>$check_login["user_birthday"],
                            );
                            $this->session->set_userdata('s_member',$s_member);
                            $s_member = $this->session->userdata('s_member');  
                            if($s_member)
                            {   echo 1 ;
                                //redirect(base_url().'user');
                            }
			 }else{  echo 2;   }
		 }
		 
		public function logingoogle(){
			$_SESSION['google'] = $_POST ; 
			$google = $_SESSION['google'] ;
			// Lấy thông tin
			if(count($google)){
				$this->_data['user_username']	 = $google['email'];
				$this->_data['user_email']  	 = $google['email'];
				$this->_data['user_first_name']  = $google['name'];
				$this->_data['user_google']    = $google['id'];
				$this->_data["user_level"]	=	10 ;
				$this->_data["user_status"]	=	1 ;
			}
			$check_login = $this->muser->getOnceAnd("",array("user_username"=>$this->_data['user_username'] ));
			if($check_login){  
				
				// Nếu đã tồn tại  -> login gán session
					$s_member = array(
								"s_user_id"=>$check_login["id"],
								"s_user_google"=>$check_login["user_google"],
                                "s_user_fullname"=>$check_login["user_first_name"],
                                "s_user_username"=>$check_login["user_username"],
                                "s_user_phone"=>$check_login["user_phone"],
								"s_user_address"=>$check_login['user_address'],
                                "s_user_email"=>$check_login["user_email"],
								 "s_user_birthday"=>$check_login["user_birthday"],
                            );
                            $this->session->set_userdata('s_member',$s_member);
                            $s_member = $this->session->userdata('s_member');  
                            if($s_member)
                            {   
                                echo 1 ; exit ;
                            }
				}else{  echo 2 ;  exit ; }
		}
	 
		public function register()
        {   
		   
			
            $this->_data['title'] = 'Đăng ký thành viên';
            $this->_data['error_re'] = NULL;
            $s_member = $this->session->userdata('s_member'); 
			 
			 
            if($s_member)
            {
                redirect(base_url().'login/');
            }
            else
            { 
				if(count($_POST)){
                $this->_data['user_username'] = isset($_POST['user_username']) && $_POST['user_username'] ? trim($_POST['user_username']):'';
                $this->_data['user_password'] = isset($_POST['user_password']) && $_POST['user_password'] ? md5(trim($_POST['user_password'])):'';
				$this->_data['re_user_password'] = isset($_POST['re_user_password']) && $_POST['re_user_password'] ? md5(trim($_POST['re_user_password'])):'';
                $this->_data['user_email'] = isset($_POST['user_email']) && $_POST['user_email'] ? $_POST['user_email']:'';
                $this->_data['user_phone'] = isset($_POST['user_phone']) && $_POST['user_phone'] ? $_POST['user_phone']:'';
                $this->_data['user_first_name'] = isset($_POST['user_first_name']) && $_POST['user_first_name'] ? $_POST['user_first_name']:'';
                $this->_data['user_address'] = isset($_POST['user_address']) && $_POST['user_address'] ? $_POST['user_address']:'';
				$this->_data['user_facebook'] = isset($_POST['user_facebook']) && $_POST['user_facebook'] ? $_POST['user_facebook']:'';
				
				if($this->_data['re_user_password'] != $this->_data['user_password']){ 
						$this->_data['error_re'][] = 'Mật khẩu nhập lại không khớp';
						echo '<script>alert("Mật khẩu nhập không chính xác.")</script>';
						 
				}else{
					
				
                if($this->_data['user_username'] && $this->_data['user_password'] && $this->_data['user_email'] && $this->_data['user_phone'] && $this->_data['re_user_password'])
                {
					
                    $userAdd = array(
                        "user_username"=>$this->_data['user_username'],
                        "user_password"=>$this->_data['user_password'],
                        "user_email"=>$this->_data['user_email'],
                        "user_phone"=>$this->_data['user_phone'],
                        "user_first_name"=>$this->_data['user_first_name'],
                        "user_address"=>$this->_data['user_address'],
                        "user_level"=>10,
						 "user_facebook"=>$this->_data['user_facebook'],
                        "user_status"=>1
                    );
                    if($userAdd)
                    {
                        $check_login = $this->muser->getOnceAnd("",array(
							"user_username"=>$this->_data['user_username'] ));
                        if($check_login==NULL)
                        {
                           $id_add = $this->muser->addUser($userAdd); 
						   
                            /**end gan session*/
                            $s_member = array(
							 "s_user_id"=>$id_add,
                                "s_user_fullname"=>$this->_data["user_first_name"],
                                "s_user_username"=>$this->_data["user_username"],
                                "s_user_password"=>$this->_data["user_password"],
                                "s_user_phone"=>$this->_data["user_phone"],
								"s_user_address"=>$this->_data['user_address'],
                                "s_user_email"=>$this->_data["user_email"],
								 "s_user_birthday"=>$this->_data["user_birthday"],
                            );
                            $this->session->set_userdata('s_member',$s_member);
                            $s_member = $this->session->userdata('s_member');  
                            if($s_member)
                            {   
								$this->_data['s_member'] = $s_member ;
                                redirect(base_url().'user');
                            }
                        }
                        else
                        {  
                            $this->_data['error'][] = 'Thành viên đã tồn tại';
                            $this->_data['user_username'] ='';
                            $this->_data['user_password'] ='';
                        }
					}
                 } 
                }
			} 
				$this->my_layout->view("frontend/user/register", $this->_data);
            }
        }
        public function logout()
        {
            $this->session->unset_userdata("s_member"); unset($_SESSION['facebook']) ; unset($_SESSION['google']) ;
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            {
                redirect(base64_decode($_REQUEST["redirect"]));
            }
            else
            {
                redirect(base_url());
            }
        }

        public function forgot()
        {
            $s_member = $this->session->userdata('s_member');
            if($s_member)
            {
                redirect(base_url().'/user/');
            }
            $this->my_layout->view("frontend/user/forgot",$this->_data);
        }
        public function loadfull()
        {
           
		   $this->my_layout->view("frontend/user/loadfull", $this->_data);
        }
		public function registerclass(){
		 
			// class tra ve form khi dang nhap thanh cong
			$this->_data['class'] = $_REQUEST['class'];
			$this->_data['type'] = $_REQUEST['type'];
			//echo $this->_data['type'] ;
			if($this->_data['class']==1){
				$this->_data['title'] = 'Đăng ký xếp lớp' ;
			}else if($this->_data['class']==2){
				$this->_data['title'] = 'Đăng ký thi thử' ;
			}else if($this->_data['class']==3){
				$this->_data['title'] = 'Đăng ký thi thật' ;
			}else{
				$this->_data['title'] = 'Lớp học cộng đồng' ;
			}
			// end dang ky
			$s_member = $this->session->userdata('s_member'); 
			$query = $this->db->query("  select * from tkwp_quanhuyen  where parent = '".$s_member['s_user_tinhthanh']."'  order by sort asc  ");
			$this->_data['getWardall'] = $query->result_array();
			$query = $this->db->query("  select * from tkwp_quanhuyen_category  order by sort asc  ");
			$this->_data['city'] = $query->result_array();
			
			 
			
			$this->_data['s_member'] = $s_member ;
			if(isset($_POST['fclass'])){
				$add = $this->addClass() ;
				if($add){
					 
					$this->_data['success']['addclass'] = 'Bạn đã đăng ký lớp thành công , Chúng tôi sẻ liên lạc với bạn trong thời gian sớm nhất' ;
				} 
			}
			 
			if($s_member) {
				// nếu đã đăng ký đăng nhập
				
				$this->_data['class_type'] = array(
					'0'=> 'Vui lòng chọn'
					,'1'=>'Thi xếp lớp'
					,'2'=>'Thi thử'
					,'3'=>'Thi thật'
					,'4'=>'Lớp học cộng đồng'
				);
				
				
				$this->my_layout->view("frontend/user/register_xeplop", $this->_data);
			}else{
				 // Nếu chưa đăng nhập 
				//$this->_data['redirect'] = base_url.'user/thixeplop/';
				 
				$this->my_layout->view("frontend/user/login_view", $this->_data); 
			}
		}
		 
		public function getWard(){
			$id = $this->input->post('id_city');
			$query = $this->db->query("  select * from tkwp_quanhuyen  where parent = '".$id."'  order by sort asc  ");
			$data = $query->result_array();
			$html = '';
			if(!empty($data)){
				foreach( $data as $k => $v ) {
					$html .= '
						<option value='.$v['id'].' >   '.$v['name'].'   </option>
					';
				}
			}
			echo $html ; exit ;
		}
		 
		
		/***********************************Dang ky xep lop *************************************************************************/ 
		public function addClass(){
			$s_member = $this->session->userdata('s_member'); 
			$post1  = array(
				'user_tinhthanh' => ''
				,'user_quan' => ''
				,'user_work' => ''
				,'user_gender' => ''
				,"user_birthday" => ''
			);
			$post2 = array(
				"user_id"=>$s_member['s_user_id']
				,"class_type"=> ''
				,"class_type_orther"=> ''
				,"date_add"=>date("d-m-Y H:i:s")
			);
			foreach($_POST as $k=>$v){
				if(isset($post1[$k])){
					$post1[$k] = trim($v);
				}
			}
			$post2['class_type'] = $this->input->post('class_type') ;
			$post2['class_type_orther'] =  $this->input->post('class_type_orther') ;
		 	$updateUser =  $this->muser->updateUser($s_member['s_user_id'],$post1);
			$addClass   =  $this->db->insert('tkwp_class',$post2);
			if($addClass)
				return 1 ;
			else return 0 ;
				
			 
			 
		}
		/***********************************End Dang ky xep lop *************************************************************************/  
		/**************login facebook*****************/
		// ajax login
		public function checkfacebook(){
			
			 
			
			
				
		}
		/**********************************************/
		
    }
 