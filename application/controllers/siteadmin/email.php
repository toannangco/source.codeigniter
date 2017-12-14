<?php

 
class email extends CI_Controller
{
    public function __construct()
    {
        # code...
        /**begin nap thu vien*/
        parent::__construct();
        $this->load->library(array("my_layout","pagination","form_validation","session","paging"));
        $this->my_layout->setLayout("template/backend/template");/**load file layout chinh*/
        /**end nap thu vien*/

        /**begin nap cac helper*/
        $this->load->helper(array("url","language","my_helper","form"));
        $this->lang->load("set");
        /**end nap cac helper*/

        /**begin check_login*/
        $this->load->file(dir_root.'/application/controllers/'.admin_name.'/check_login.php');
        /**end check login*/

        /**begin load models*/
        $this->load->Model("backend/memail");
        $this->load->Model("backend/muser");
        include_once dir_root . '/application/helpers/translate.php';
    }



    /**begin danh sach */

    public function index(){
        
        
        $s_info = $this->session->userdata('userInfo');         
        //$c_permision = new check_permision();
        //$c_permision->check($s_info["s_user_level"],"email","list");
        
        $data = array();
        $data["title"] = "Danh sách email";
        $and = "";
        $data['lang']= $lang = $this->uri->segment(1)==""?"vn":$this->uri->segment(1);       
        $data["list"] =$list= $this->memail->getQuerySql($object="",$and,"id desc","");
        $data["record"] =  $this->memail->countQuery($and);    

        /**begin them moi data*/
        if(isset($_POST['btnSave'])){
            $data['info']['email_group'] = isset($_POST['email_group']) ? $_POST['email_group']:'';
            $data['info']['email_name'] = isset($_POST['email_name']) ? $_POST['email_name']:'';
            if($data['info']){
                $this->memail->addData($data['info']);
                redirect(admin_url."email/");
            }
        }
        /**end them moi data*/

        $this->my_layout->view("backend/email/email_list_view",$data);

    }
    /**end danh sach*/

    public function update($id){
        
        if(is_numeric($id)){                
            
            $s_info = $this->session->userdata('userInfo');         
            //$c_permision = new check_permision();
            //$c_permision->check($s_info["s_user_level"],"email","list");
            
            $data = array();
            $data["title"] = "Danh sách email";
            $data["id"] = $id;
            $and = "";
            $data['lang']= $lang = $this->uri->segment(1)==""?"vn":$this->uri->segment(1);       
            $data["list"] =$list= $this->memail->getQuerySql($object="",$and,"id desc","");
            $data["record"] =  $this->memail->countQuery($and);    
            $data['info'] = $this->memail->getOnceAnd(array("id"=>$id));
            /**begin them moi data*/
            if(isset($_POST['btnSave'])){
                $data['info']['email_group'] = isset($_POST['email_group']) ? $_POST['email_group']:'';
                $data['info']['email_name'] = isset($_POST['email_name']) ? $_POST['email_name']:'';
                if($data['info']){
                    $this->memail->updateData($id,$data['info']);
                    redirect(admin_url."email/");
                }
            }
            /**end them moi data*/

            $this->my_layout->view("backend/email/email_list_view",$data);
        }else{
            redirect(admin_url);
        }

    }
    /**end danh sach*/


        /**begin xoa data*/
        public function delete($id)
        {
            # code...            
            if(isset($id) && is_numeric($id)){
                $this->memail->deleteData($id);                
                if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                    redirect(base64_decode($_REQUEST['redirect']));
                }else{
                    redirect(admin_url.'ticket/index/');
                }
            }else{
                $data["title"]="Không tìm thấy thông tin để xóa";
                $data["message"] = "Vui lòng kiểm tra lại đường dẫn !!";
                $this->my_layout->view("backend/404/404_view",$data);
            }

        }
        /**end xoa data*/



}