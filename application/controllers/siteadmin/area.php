<?php
 
class Area extends MY_Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model("backend/marea");
    }
    /**begin danh sach*/
    public function index(){
      //  $this->muser->permision("area","index");
        $this->_data['title'] = danh_sach;
        $page = isset($_REQUEST['page']) ? $_REQUEST['page']:1;
        $this->_data['tparent'] = isset($_REQUEST['tparent']) ? $_REQUEST['tparent']:0;
        $this->_data['tstatus'] = isset($_REQUEST['tstatus']) ? $_REQUEST['tstatus']:1;
        $this->_data['fkeyword'] = isset($_REQUEST['fkeyword']) ? $_REQUEST['fkeyword']:'';

        $and = " area_status =  ".$this->_data['tstatus'];
        if($this->_data['tparent'] != 0){
            $and .= " and area_parent =  ".$this->_data['tparent'];
        }
        $fkeyword  = (isset($_REQUEST['fkeyword']) && $_REQUEST['fkeyword']!="")?$_REQUEST['fkeyword']:'';
        if($fkeyword){
            $and .= " and (area_name like '%".$fkeyword."%'";
            $and .= " or area_alias like '%".$fkeyword."%')";
        }
        $orderby = " id DESC";
        $config['per_page']         =   15;
        $config['uri_segment']      =   (($page-1)   * $config['per_page']);
        $object = "";
        $this->_data["list"] = $this->marea->getQuerySql($object,$and,$orderby,$config['uri_segment'].','.$config['per_page']);    
        $this->_data["record"] =  $this->marea->countQuery($and);
        $config['total_rows']       =   $this->_data["record"];
        $config['num_links']        =   5;
        $config['base_url']         =   admin_url.'area/?fkeyword='.$this->_data['fkeyword'].'&tparent='.$this->_data['tparent'].'&tstatus='.$this->_data['tstatus'].'&page=';
        $this->_data["pagination"]                 =   $this->paging->paging_donturl($this->_data["record"],$page,$config['per_page'],$config['num_links'],$config['base_url']);
        $this->my_layout->view("backend/area/area_list_view",$this->_data);
    }
    /**end danh sach*/

    /**begin cap nhat trang thai*/
    public function status($id,$status){
      //  $this->muser->permision("area","status");
        $this->_data = array(
            "area_status"=>$status
        );
        $this->marea->updateData($id,$this->_data);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."area/index/");
    }
    /**end cap nhat trang thai*/

    /**begin them moi*/
    public function add(){
     //   $this->muser->permision("area","add");
        $this->_data["title"] = them_moi;
        $this->_data['formData']['area_name']    =   '';
        $this->_data['formData']['area_alias']    =   '';
        $this->_data['formData']['area_parent']    =   '';
        $this->_data['formData']['area_status']    =   1;
        $this->_data['formData']['area_orderby']    =   1;
        $this->_data['formData']['area_cerate_date']                        = time();
        $this->_data['formData']['user']                        = $this->_data['s_info']['s_user_id'];

        if(isset($_POST['fsubmit']))
        {
            $this->_data['formData']['area_name']            = $this->input->post('area_name');
            $this->_data['formData']['area_alias']           = mb_strtolower(url_title(convert_alias($this->_data['formData']['area_name'])));
            $this->_data['formData']['area_parent']          = $this->input->post('area_parent');
            $this->_data['formData']['area_orderby']        = $this->input->post('area_orderby');
            $this->marea->addData($this->_data['formData']);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."area/index/");
        }
        $this->my_layout->view("backend/area/area_post_view",$this->_data);
    }
    /**end them moi*/

    /**begin update*/
    public function update($pro_id){
    //    $this->muser->permision("area","update");
        $this->_data["title"] = 'Cập nhật';
        $myArea = $this->marea->getOnceAnd(array('id'=>$pro_id));
        $this->_data['formData']['area_name']    =   $myArea['area_name'];
        $this->_data['formData']['area_alias']    =   $myArea['area_alias'];
        $this->_data['formData']['area_parent']    =   $myArea['area_parent'];
        $this->_data['formData']['area_status']    =  $myArea['area_status'];
        $this->_data['formData']['area_orderby']    =  $myArea['area_orderby'];
        if(isset($_POST['fsubmit']))
        {
            $this->_data['formData']['area_name']            = $this->input->post('area_name');
            $this->_data['formData']['area_alias']           = mb_strtolower(url_title(convert_alias($this->_data['formData']['area_name'])));
            $this->_data['formData']['area_parent']          = $this->input->post('area_parent');
            $this->_data['formData']['area_orderby']        = $this->input->post('area_orderby');

            $this->marea->updateData($pro_id,$this->_data['formData']);
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."area/index/");
        }
        $this->my_layout->view("backend/area/area_post_view",$this->_data);
    }
    /**end update*/

    /**begin xoa*/
    public function delete($id){
    //    $this->muser->permision("area","delete");
        if(isset($id) && is_numeric($id)){
            $myArea = $this->marea->getOnceAnd(array("id"=>$id));
            if(!empty($myArea)){
                $this->marea->deleteData($id);
            }
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."area/index/");
        }else{
            $this->_data["title"]="Không tìm thấy thông tin để xóa";
            $this->_data["message"] = "Vui lòng kiểm tra lại đường dẫn !!";
            $this->my_layout->view("backend/404/404_view",$this->_data);
        }
    }
    /**end xoa*/
}