<?php
/**
 * Thuan 12.1   
 * 
 */
class config extends MY_Admin_Controller
{	 protected $_file_path = "";
    public function __construct()
    {
        parent::__construct();
		$this->_file_path = dir_root. '/public/frontend/uploads/files/logo';
        $this->load->Model("mconfig");
		
    }
    public function setting()
    {    
	
	     $dir ='public/config/';
		 $namefile ='config.php';
		 $this->_data['title'] = 'Cấu hình website';
		 
		 
		$this->_data['data']['website_logo'] ='';
		$this->_data['data']['website_name'] ='';
		$this->_data['data']['website_email'] ='';
		$this->_data['data']['website_description'] ='';
		$this->_data['data']['website_address'] ='';
		$this->_data['data']['website_phone'] ='';
		$this->_data['data']['website_fax'] ='';
		$this->_data['data']['website_map'] ='';
		$this->_data['data']['website_page'] ='';
		$this->_data['data']['website_left'] ='';
		$this->_data['data']['website_left_link'] ='';
		$this->_data['data']['website_right'] ='';
		$this->_data['data']['website_right_link'] ='';
		$this->_data['data']['website_footer_left'] ='';
		$this->_data['data']['website_banner'] ='';
		$this->_data['data']['website_background'] ='';
		$this->_data['data']['website_banner_detail'] ='';
		$this->_data['data']['website_banner_link'] ='';
		$this->_data['data']['website_banner_advertise'] ='';
		
	
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = unserialize(file_get_contents($dir.$namefile));
			if(!empty($temp)){
			foreach($temp as $k=>$v){
				if(isset($this->_data['data'][$k])){
					$this->_data['data'][$k] = $v;
					}
				}
			}
		}
	
		//echo "<pre>";
		//print_r($this->_data['data']);exit;
		
		 if(isset($_POST['fsubmit']))
        {
			foreach($this->_data['data'] as $k=>$v){
				if($k != 'website_logo' && $k != 'website_left' && $k != 'website_right' && $k != 'website_background' ){
					$this->_data['data'][$k] = $this->input->post($k);
				}
				
			}
			
			 $removepicture = $this->input->post('removepicture');
			 if($removepicture==1){
				 $this->mconfig->removeFile($this->_file_path,$temp['website_logo']);
				$this->_data['data']['website_logo'] = '';
			 }
			 $removepicture2 = $this->input->post('removepicture2');
			 if($removepicture2==1){
				 $this->mconfig->removeFile($this->_file_path,$temp['website_background']);
				$this->_data['data']['website_background'] = '';
			 }
			 $removepicture1 = $this->input->post('removepictureleft');
			 if($removepicture1==1){
				$this->mconfig->removeFile($this->_file_path,$temp['website_left']);
				$this->_data['data']['website_left'] = '';
			 }
			  $removepicture2 = $this->input->post('removepictureright');
			 if($removepicture2==1){
				$this->mconfig->removeFile($this->_file_path,$temp['website_right']);
				$this->_data['data']['website_right'] = '';
			 }
			
			
			//hình logo
			$picture                =   $this->mconfig->upload($this->_file_path, 'website_logo');
            $logo           =   !empty($picture) ? $picture['file_name'] : '';
			if(strlen($logo) > 5 ){
				$this->mconfig->removeFile($this->_file_path,$temp['website_logo']);
				$this->_data['data']['website_logo'] = $logo ;
			}
			// hinh banner
			$a                =   $this->mconfig->upload($this->_file_path, 'website_background');
            $background           =   !empty($a) ? $a['file_name'] : '';
			if(strlen($background) > 5 ){
				$this->mconfig->removeFile($this->_file_path,$temp['website_background']);
				$this->_data['data']['website_background'] = $background;
			}
			/////////////////////////
			//hình thanh quản cáo trái
			$picture1                =   $this->mconfig->upload($this->_file_path, 'website_left');
            $news_picture1           =   !empty($picture1) ? $picture1['file_name'] : '';
			if(strlen($news_picture1) > 5 ){
				$this->mconfig->removeFile($this->_file_path,$temp['website_left']);
				$this->_data['data']['website_left'] = $news_picture1;
			}
			
			
			//hình thanh quản cáo phải
			$picture2                =   $this->mconfig->upload($this->_file_path, 'website_right');
            $news_picture2          =   !empty($picture2) ? $picture2['file_name'] : '';
			if(strlen($news_picture2) > 5 ){
				$this->mconfig->removeFile($this->_file_path,$temp['website_right']);
				$this->_data['data']['website_right'] = $news_picture2;
			}
			
			file_put_contents($dir.'config.php',serialize($this->_data['data']));
		   
		}

        $this->my_layout->view("backend/config/config_config_view", $this->_data);
    }
	
	public function support(){
		
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Hỗ trợ mua xe trả góp';
		 $function = 'support';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		 
		
		if(file_exists($dir.$namefile)){
			$temp = unserialize(file_get_contents($dir.$namefile));
			if(!empty($temp)){
			foreach($temp as $k=>$v){
				if(isset($this->_data['data'][$k])){
					$this->_data['data'][$k] = $v;
					}
				}
			}
		}
		 
	
		if(isset($_POST['fsubmit'])){
			$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function driving(){
		
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Đăng ký lái thử';
		
		 $function = 'driving';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = file_get_contents($dir.$namefile);
			$this->_data['data'][ $name ] = $temp;
		}
	
		if(isset($_POST['fsubmit'])){
			$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function intro(){
		
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Trang giới thiệu';
		
		 $function = 'intro';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = file_get_contents($dir.$namefile);
			$this->_data['data'][ $name ] = $temp;
		}
	
		if(isset($_POST['fsubmit'])){
			$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function contact(){
	
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Trang liên hệ';
		
		 $function = 'contact';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = file_get_contents($dir.$namefile);
			$this->_data['data'][ $name ] = $temp;
		}
	
		if(isset($_POST['fsubmit'])){
		$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		 
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function service(){
		
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Trang dịch vụ';
		
		 $function = 'service';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = file_get_contents($dir.$namefile);
			$this->_data['data'][ $name ] = $temp;
		}
	
		if(isset($_POST['fsubmit'])){
			$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function promotion(){
		
		 ///////////////////////////////////////
		 $this->_data['title'] = 'Trang khuyến mại';
		
		 $function = 'promotion';
		//////////////////////////////////////
		 $name ='website_'.$function.'_detail'; 
		$dir ='public/config/';
		 $namefile = $function.'.php';
		$this->_data['file'] = $name;
		$this->_data['data'][ $name ] ='';
		if(!file_exists($dir)){
			mkdir($dir);
		}
		if(file_exists($dir.$namefile)){
			$temp = file_get_contents($dir.$namefile);
			$this->_data['data'][ $name ] = $temp;
		}
	
		if(isset($_POST['fsubmit'])){
			$this->_data['data'][$name] = $this->input->post($name);
			file_put_contents($dir.$namefile,$this->_data['data'][$name ]);
		   
		}
		$this->my_layout->view("backend/config/view", $this->_data);
		
	}
	public function congdong(){
		$this->_data['title'] = 'Trang lớp học cộng đồng';
		$rs = $this->db->query("select * from tkwp_classpublic") ; $rs = $rs->row_array();  
		$this->_data['data']['website_congdong_detail'] = $rs['classpublic_detail']  ;
		$this->_data['data']['website_congdong_class'] = $rs['classpublic_class']  ;
		 
	 
		if(isset($_POST['fsubmit'])){
			 
			$this->_data['post']['classpublic_detail'] = trim($this->input->post('website_congdong_detail'));
			$this->_data['post']['classpublic_class']  =  implode("---",$this->input->post('website_congdong_class'));
		 
				$this->db->query(
				 'UPDATE tkwp_classpublic  SET classpublic_detail="'.$this->_data['post']['classpublic_detail'].'",  
				 classpublic_class= "'.$this->_data['post']['classpublic_class'].'"
				  '  );
		}
	
		$this->my_layout->view("backend/config/config_congdong", $this->_data);
	}
	
	 
   
   
}
