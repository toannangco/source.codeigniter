<?php
class home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->Model('mbanner') ;
		$this->load->Model('mvideo')  ; 
		$this->load->Model('mpost')  ;  
		$this->load->Model('mmodel')  ;
    }
    public function index() {
		$data['title'] = 'Ngoại ngữ Ielts Đa Minh';
	 
		$condition_slider 				= '  position_id = 1   ';   
		$condition_banner_register 		= '   position_id = 2   ';   
		$condition_home					= '  menu_home = 1  ';		 
		
	 	$this->_data['slider'] 			=  $this->mbanner->getBanner("",$condition_slider,"","","") ;
		$this->_data['banner_register'] =  $this->mbanner->getBanner("",$condition_banner_register,"","","") ;
		$this->_data['video'] 			=  $this->mvideo->getQuerySql() ;
		$this->_data['home'] =   $this->mmenu->getHome() ;
		$root = $this->_data['home'][0]['id'] ; 
		$this->_data['list_online'] = $this->mmenu->getMenu( $root , $lang='vn',$orderby = "menu_orderby asc" ) ;
		
		$object_news = ' n.id,n.news_picture,n.news_parent ';
        $object_news .= ',nl.news_lang_name,nl.news_lang_summary,nl.news_lang_alias,nl.news_lang_detail'; 
		
		if(!empty($this->_data['list_online'])){
			foreach($this->_data['list_online'] as $k=>$v){
				$condition_news = '   n.news_parent in (' . $v['id'] . ')';
				 $this->_data['list_online'][$k]['posts'] = $this->mnews->getNews($object_news, $condition_news, '' , 0 , 8);
			}
		}
		$post = $this->mpost->getPost() ;
		if(!empty($post)){
			foreach( $post as $k=>$v ) {
				$myMenu  = $this->mmenu->getInfoID( $v->post_parent , 'vn');
				$link    = base_url . $myMenu['menu_alias'] . '/' . $v->post_lang_alias.'/';
				$v->post_lang_alias = $link ;
				if($v->post_parent ==36 ){
					$this->_data['list_tintuc'][$k] = $v ; 
				 } 
			}
		}
		// Get tỉnh thành
		$this->_data['allCity'] = $this->mmodel->getCity() ;
		
		// đăng ký mail 
		if(isset($_POST['fmail'])){
			$post = array(
				'mailto_fullname'=>''
				,'mailto_phone'=>''
				,'mailto_email'=>''
				,'mailto_city'=>''
				,'mailto_ward'=>''
				,'mailto_work'=>''
				,'mailto_content'=>''
				,'mailto_create_date'=>date('d-m-Y h:i:s')
			);
			foreach($_POST as $k=>$v){
				if(isset($post[$k])){
					$post[$k] = trim($this->input->post($k));
				}
			}
			$addMail = $this->mmodel->add($post);
			if($addMail){
				echo '<script>alert("Nhận đăng ký tư vấn thành công")</script>';
			}else{
				echo '<script>alert("Gửi chưa thành công ! vui lòng thử lại sau ")</script>';
			}
		}
		
		$this->load->view("frontend/home/home_view", $this->_data);
    }
	
	 
	
	
	
	
	
}
