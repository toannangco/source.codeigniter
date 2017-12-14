<?php
 
class Category extends MY_Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model("mcategory");
    }

    /**danh sach*/
    public function index(){
        $this->_data["title"] = "Danh sách Menu Admin";
        $and = array("category_parent"=>0);
        $this->_data["list"] = $this->mcategory->getArray('',$and,"category_orderby");
        $this->_data["record"] = $this->mcategory->countAnd($and);
        $this->my_layout->view("backend/category/category_list_view",$this->_data);
    }
    /**end danh sach*/

    /**them moi*/
    public function add(){
        $this->_data["title"] = "Thêm mới menu Admin";
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_rules('category_lang_name','Tên danh mục không được rỗng','required');
        if($this->form_validation->run()==TRUE){
            $this->_data["set_value"] = array(
                "category_parent"=>$this->input->post("category_parent"),
                "category_component"=>$this->input->post("category_component"),
                "category_action"=>$this->input->post("category_action"),
                "category_orderby"=>$this->input->post("category_orderby"),
                "category_status"=>1,
                "category_icon"=>$this->input->post("category_icon"),
                "category_create_date"=>time(),
            );
            $insert = $this->mcategory->addData($this->_data["set_value"]);
            if($insert){
                $this->_data["set_value_lang"] = array(
                    "category_id"=>$insert,
                    "category_lang"=>$this->_data['lang'],
                    "category_lang_name"=>$this->input->post("category_lang_name"),
                );
                $this->mcategory_lang->addData($this->_data["set_value_lang"]);
            }
            redirect(admin_url.'category/index/');
        }
        $this->my_layout->view("backend/category/category_add_view",$this->_data);
    }
    /**end them moi*/

    /**begin cap nhat*/
    public function update($id){
        $this->_data["title"] = "Cập nhật menu Admin";
        $this->_data["info"]  = $this->mcategory->getData('',array("id"=>$id));
        $this->_data["info_lang"]  = $this->mcategory_lang->getData('',array("category_id"=>$id,"category_lang"=>$this->_data['lang']));
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_rules('category_lang_name','Tên danh mục không được rỗng','required');
        if($this->form_validation->run()==TRUE){
            $this->_data["set_value"] = array(
                "category_parent"=>$this->input->post("category_parent"),
                "category_component"=>$this->input->post("category_component"),
                "category_action"=>$this->input->post("category_action"),
                "category_orderby"=>$this->input->post("category_orderby"),
                "category_status"=>1,
                "category_icon"=>$this->input->post("category_icon"),
                "category_update_date"=>time(),
            );
            $this->mcategory->updateData($id,$this->_data["set_value"]);
            $this->_data["set_value_lang"] = array(
                "category_id"=>$id,
                "category_lang"=>$this->_data['lang'],
                "category_lang_name"=>$this->input->post("category_lang_name"),
            );
            /**kiem tra ngon ngu ton tai chua*/
            $check = $this->mcategory_lang->countAnd(array("category_id"=>$id,"category_lang"=>$this->_data['lang']));            
            if($check > 0){
                /**da ton tai cap nhat*/
                $this->mcategory_lang->updateAnd(array('category_lang'=>$this->_data['lang'],'category_id'=>$id),$this->_data["set_value_lang"]);
            }else{
                /**khong ton tai*/
                $this->mcategory_lang->addData($this->_data["set_value_lang"]);
            }
            redirect(admin_url.'category/index/');
        }


        $this->my_layout->view("backend/category/category_edit_view",$this->_data);
    }
    /**end cap nhat*/

    /**begin cap nhat trang thai*/
    public function update_status($id,$status){
        $this->_data = array(
            "category_status"=>$status
        );
        $this->mcategory->updateData($id,$this->_data);
        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
            redirect(base64_decode($_REQUEST['redirect']));
        else
            redirect(admin_url."category/index/");
    }
    /**end cap nhat trang thai*/

    /**beign xoa*/
    public function delete($id){
        if(is_numeric($id)){
            $this->mcategory->deleteData($id);
            $this->mcategory_lang->deleteAnd(array('category_id'=>$id));
            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect'])
                redirect(base64_decode($_REQUEST['redirect']));
            else
                redirect(admin_url."category/index/");
        }else{
            redirect(admin_url."category/index/");
        }
    }
    /**end xoa*/
}