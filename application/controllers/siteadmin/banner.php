<?php
 

class Banner extends MY_Admin_Controller
{
    public $_file_path = "";
    public $_file_url = "";
    public function __construct()
    {
        parent::__construct();
        $this->load->Model("mposition");
        $this->load->Model("mbanner");
        $this->_file_url = base_file.'banner/';
        $this->_file_path = dir_root. '/public/frontend/uploads/files/banner';
    }
    /**begin danh sach banner*/
    public function index()
    {
		 $this->_data['tpos'] = isset($_REQUEST['tpos']) ? $_REQUEST['tpos']:0;
		 if($this->_data['tpos']==1){
			 $this->_data['title'] = 'Danh sách slider';
		 }else{
			  $this->_data['title'] = 'Danh sách hình đăng ký';
		 }
        $this->_data['title'] = danh_sach;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
        $this->_data['menu_id'] = isset($_REQUEST['menu_id']) ? $_REQUEST['menu_id']:0;
       
        $this->_data['tstatus'] = isset($_REQUEST['tstatus']) ? $_REQUEST['tstatus']:1;
        $this->_data['fkeyword'] = isset($_REQUEST['fkeyword']) ? $_REQUEST['fkeyword']:'';

        $and = " banner_status =  ".$this->_data['tstatus'];
        if($this->_data['tpos'] != 0){
            $and .= " and position_id =  ".$this->_data['tpos'];
        }
        if($this->_data['menu_id'] != 0){
            $and .= " and menu_id =  ".$this->_data['menu_id'];
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (n.banner_title like '%".$fkeyword."%'";
            $and .= " or n.banner_picture like '%".$fkeyword."%')";
        }

        $orderby = " n.id DESC";
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $object = "";
        $this->_data["list"] = $this->mbanner->getBanner($object,$and,$orderby,$config['uri_segment'].','.$config['per_page'],'statuskhongmacdinh');
        $this->_data["record"] =  $this->mbanner->countQuery($and);
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'banner/?fkeyword='.$this->_data['fkeyword'].'&tpos='.$this->_data['tpos'].'&tstatus='.$this->_data['tstatus'].'&menu_id='.$this->_data['menu_id'].'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $this->my_layout->view("backend/banner/banner_list_view", $this->_data);
    }

    public function add_banner()
    {
        $this->_data['title'] = 'Thêm mới banner';
        $myBanner = '';
        $this->_data['formData']['banner_id']    =   '';
        $this->_data['formData']['banner']['menu_id']                        =      '';
        $this->_data['formData']['banner']['position_id']                    =      '';
        $this->_data['formData']['banner']['banner_title']                   =      '';
        $this->_data['formData']['banner']['banner_link']                    =      '';
        $this->_data['formData']['banner']['banner_detail']                  =      '';
        $this->_data['formData']['banner']['banner_picture']                 =      '';
        $this->_data['formData']['banner']['banner_orderby']                 =      '';
        $this->_data['formData']['banner']['banner_status']                  =      '1';
        $this->_data['formData']['banner']['banner_create_date']             =      time();
        $this->_data['formData']['banner']['banner_update_date']             =      time();
        $this->_data['formData']['banner']['user']                           =      $this->_data['s_info']['s_user_id'];;
        if(isset($_POST['fsubmit']))
        {
            /*anh dai dien*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_picture       =   '';
                if($this->_data['formData']['banner']["banner_picture"]){
                    $this->mbanner->removeFile($this->_file_path,$this->_data['formData']['banner']["banner_picture"]);
                }
            }else{
                $name_picture           =   $this->_data['formData']['banner']['banner_picture'];
            }
            $picture                =   $this->mbanner->upload($this->_file_path, 'banner_picture','full',0);
            $banner_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($banner_picture)
            {
                $name_picture       =   $banner_picture;
                if($this->_data['formData']['banner']["banner_picture"]){
                    $this->mbanner->removeFile($this->_file_path,$this->_data['formData']['banner']["banner_picture"]);
                }
            }
            $this->_data['formData']['banner']['banner_picture']                 =      $name_picture;
            $this->_data['formData']['banner']['menu_id']                        =      $this->input->post('menu_id');
            $this->_data['formData']['banner']['position_id']                    =      $this->input->post('position_id');
            $this->_data['formData']['banner']['banner_title']                   =      $this->input->post('banner_title');
            $this->_data['formData']['banner']['banner_link']                    =      $this->input->post('banner_link');
            $this->_data['formData']['banner']['banner_detail']                  =      $this->input->post('banner_detail');
            $this->_data['formData']['banner']['banner_orderby']                 =      $this->input->post('banner_orderby');
            $this->_data['formData']['banner']['banner_status']                  =      $this->input->post('banner_status');
            $banner_id = $this->mbanner->addData($this->_data['formData']['banner']);
            $this->_data['formData']['banner_id'] = $banner_id;
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."banner/index/?tpos=1");
        }
        $this->my_layout->view("backend/banner/banner_post_view", $this->_data);
    }
    
    public function update_banner($banner_id)
    {
        $this->_data['title'] = 'Thêm mới banner';
        $myBanner = $this->mbanner->getData('',array('id'=>$banner_id));
        if(empty($myBanner))
        {
            redirect(admin_url.'banner/');
        }
        $this->_data['formData']['banner_id']    =   $banner_id;
        $this->_data['formData']['banner']['menu_id']                        =      $myBanner['menu_id'];
        $this->_data['formData']['banner']['position_id']                    =      $myBanner['position_id'];
        $this->_data['formData']['banner']['banner_title']                   =      $myBanner['banner_title'];
        $this->_data['formData']['banner']['banner_link']                    =      $myBanner['banner_link'];
        $this->_data['formData']['banner']['banner_detail']                  =      $myBanner['banner_detail'];
        $this->_data['formData']['banner']['banner_picture']                 =      $myBanner['banner_picture'];
        $this->_data['formData']['banner']['banner_orderby']                 =      $myBanner['banner_orderby'];
        $this->_data['formData']['banner']['banner_status']                  =      $myBanner['banner_status'];
        $this->_data['formData']['banner']['banner_create_date']             =      time();
        $this->_data['formData']['banner']['banner_update_date']             =      time();
        $this->_data['formData']['banner']['user']                           =      $this->_data['s_info']['s_user_id'];;
        if(isset($_POST['fsubmit']))
        {
            /*anh dai dien*/
            $removefile = $this->input->post('removefile');
            if($removefile==1)
            {
                $name_picture       =   '';
                if($this->_data['formData']['banner']["banner_picture"]){
                    $this->mbanner->removeFile($this->_file_path,$this->_data['formData']['banner']["banner_picture"]);
                }
            }else{
                $name_picture           =   $this->_data['formData']['banner']['banner_picture'];
            }
            $picture                =   $this->mbanner->upload($this->_file_path, 'banner_picture','full',0);
            $banner_picture           =   !empty($picture) ? $picture['file_name'] : '';
            if($banner_picture && !empty($myBanner))
            {
                $name_picture       =   $banner_picture;
                if($this->_data['formData']['banner']["banner_picture"]){
                    $this->mbanner->removeFile($this->_file_path,$this->_data['formData']['banner']["banner_picture"]);
                }
            }
            $this->_data['formData']['banner']['banner_picture']                 =      $name_picture;
            $this->_data['formData']['banner']['menu_id']                        =      $this->input->post('menu_id');
            $this->_data['formData']['banner']['position_id']                    =      $this->input->post('position_id');
            $this->_data['formData']['banner']['banner_title']                   =      $this->input->post('banner_title');
            $this->_data['formData']['banner']['banner_link']                    =      $this->input->post('banner_link');
            $this->_data['formData']['banner']['banner_detail']                  =      $this->input->post('banner_detail');
            $this->_data['formData']['banner']['banner_orderby']                 =      $this->input->post('banner_orderby');
            $this->_data['formData']['banner']['banner_status']                  =      $this->input->post('banner_status');
            $banner_id = $this->mbanner->updateData($banner_id,$this->_data['formData']['banner']);
            $this->_data['formData']['banner_id'] = $banner_id;
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."banner/index/");
        }
        $this->my_layout->view("backend/banner/banner_post_view", $this->_data);
    }
    
    public function update_status_banner($id,$status)
    {
        $this->_data = array(
            "banner_status"=>$status
        );
        $this->mbanner->updateData($id,$this->_data);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."banner/index/");
    }

    /**danh sach vi tri*/
    public function position()
    {
        $this->_data["title"] = "Danh sách vị trí";
        $and = '';
        $this->_data["list"] = $this->mposition->getArray('',$and, 'id desc');
        $this->_data["record"] = $this->mposition->countAnd($and);
        $this->my_layout->view("backend/banner/position_list_view", $this->_data);
    }
    /**end danh sach vi tri*/

    public function add_position()
    {
        $this->_data["title"] = "Thêm mới vị trí";
        $this->_data['formData']['position_name']           =       '';
        $this->_data['formData']['position_code']           =       '';
        $this->_data['formData']['position_create_date']    =       time();
        $this->_data['formData']['position_update_date']    =       time();
        $this->_data['formData']['user']                    =       $this->_data['s_info']['s_user_id'];
        if(isset($_POST['fsubmit']))
        {
            $this->_data['formData']['position_name']           =       $this->input->post('position_name');
            $this->_data['formData']['position_code']           =       $this->input->post('position_code');
            $this->mposition->addData($this->_data['formData']);
            redirect(admin_url.'banner/position/');
        }
        $this->my_layout->view("backend/banner/position_post_view", $this->_data);
    }

    public function update_position($position_id)
    {
        $myPosition = $this->mposition->getData('',array('id'=>$position_id));
        if(empty($myPosition))
        {
            redirect(admin_url.'banner/position/');
        }
        $this->_data["title"] = "Cập nhật vị trí";
        $this->_data['formData']['position_name']           =       $myPosition['position_name'];
        $this->_data['formData']['position_code']           =       $myPosition['position_code'];
        $this->_data['formData']['position_update_date']    =       time();
        $this->_data['formData']['user']                    =       $this->_data['s_info']['s_user_id'];
        if(isset($_POST['fsubmit']))
        {
            $this->_data['formData']['position_name']           =       $this->input->post('position_name');
            $this->_data['formData']['position_code']           =       $this->input->post('position_code');
            $this->mposition->updateData($position_id,$this->_data['formData']);
            redirect(admin_url.'banner/position/');
        }
        $this->my_layout->view("backend/banner/position_post_view", $this->_data);
    }

    /**begin xoa vi tri*/
    public function delete_position($id)
    {
        if (is_numeric($id) && isset($id)) {
            $this->mposition->deleteData($id);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                redirect(base64_decode($_REQUEST['redirect']));
            }else{
                redirect(admin_url.'banner/position/');
            }
        } else {
            redirect(admin_url.'banner/position/');
        }
    }

    /**begin xoa banner*/
    public function delete_banner($id)
    {
        $getBanner = $this->mbanner->getData('',array("id" => $id));
        if(empty($getBanner))
        {
            redirect(admin_url.'banner/');
        }
        if (file_exists($this->_file_path.'/' . $getBanner["banner_picture"])) {
            unlink($this->_file_path.'/' . $getBanner["banner_picture"]);
        }

        $this->mbanner->deleteData($id);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
            redirect(base64_decode($_REQUEST['redirect']));
        }else{
            redirect(admin_url.'banner/index/');
        }
    }
    /**end xoa banner*/
}