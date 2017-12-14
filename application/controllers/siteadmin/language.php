<?php
 
class Language extends MY_Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->Model("mlanguage");
        
    }
    /**begin danh sach ngon ngu*/
    public function index(){
        $this->_data["title"] = "Danh sách ngôn ngữ";
        $s_info = $this->session->userdata('userInfo');

        $and = "";
        $orderby  = "language_position ASC";
        $this->_data["list"] = $this->mlanguage->getArray('',$and,$orderby);
        $this->_data["record"]  = $this->mlanguage->countAnd($and);

        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        /**begin check du lieu*/
        $this->form_validation->set_rules('language_name','Tên ngôn ngữ','required|trim');

        if($this->form_validation->run()==TRUE){
            $picture = $this->input->post("language_picture");
            if($picture){
                $language_picture = $picture;
            }else{
                $language_picture = "";
            }
            $this->_data["set_value"] = array(
                "language_name"=>$this->input->post("language_name"),
                "language_name_short"=>$this->input->post("language_name_short"),
                "language_picture"=>$language_picture,
                "language_alias"=>mb_strtolower(url_title(convert_alias($this->input->post("language_name")))),
                "language_status"=>$this->input->post("language_status"),
                "language_position"=>$this->input->post("language_position"),
                "language_create_date"=>time(),
                "user"=>$s_info["s_user_id"]
            );
            $this->mlanguage->addData($this->_data["set_value"]);
            redirect(current_url());
        }


        $this->my_layout->view("backend/language/language_list_view",$this->_data);
    }
    /**end danh sach ngon ngu*/

    /**begin them moi ngon ngu*/
    public function add(){
        $s_info = $this->session->userdata('userInfo');  
        $this->_data["title"] = "Thêm mới ngôn ngữ";
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        /**begin check du lieu*/
        $this->form_validation->set_rules('language_name','Tên ngôn ngữ','required|trim');
        $this->my_layout->view("backend/language/language_add_view",$this->_data);
        if($this->form_validation->run()==TRUE){
            $picture = $this->input->post("language_picture");
            if($picture){
                $language_picture = $picture;
            }else{
                $language_picture = "";
            }
            $this->_data["set_value"] = array(
                "language_name"=>$this->input->post("language_name"),
                "language_name_short"=>$this->input->post("language_name_short"),
                "language_picture"=>$language_picture,
                "language_alias"=>mb_strtolower(url_title(convert_alias($this->input->post("language_name")))),
                "language_status"=>$this->input->post("language_status"),
                "language_position"=>$this->input->post("language_position"),
                "language_create_date"=>time(),
                "user"=>$s_info["s_user_id"]
            );
            $this->mlanguage->addData($this->_data["set_value"]);
            redirect(admin_url.'language/index');
        }
    }
    /**end them moi ngon ngu*/

    /**begin cap nhat ngon ngu*/
    public function update($id){
        $s_info = $this->session->userdata('userInfo');
        $this->_data["title"]  = "Cập nhật ngôn ngữ";
        $this->_data["info"] = $this->mlanguage->getData('',array("id"=>$id));
        $this->_data['id'] = $id;
        /**begin danh sach*/
        $and = "";
        $orderby  = "language_position ASC";
        $this->_data["list"] = $this->mlanguage->getArray('',$and,$orderby);
        $this->_data["record"]  = $this->mlanguage->countAnd($and);
        /**end danh sach*/

        /**begin cap nhat*/
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
        $this->form_validation->CI =& $this;
        /**begin check du lieu*/
        $this->form_validation->set_rules('language_name','Tên ngôn ngữ','required|trim');
        if($this->form_validation->run()==TRUE){
            $picture = $this->input->post("language_picture");
            if($picture){
                $language_picture = $picture;
            }else{
                $language_picture = "";
            }

            $this->_data["set_value"] = array(
                "language_name"=>$this->input->post("language_name"),
                "language_name_short"=>$this->input->post("language_name_short"),
                "language_picture"=>$language_picture,
                "language_alias"=>mb_strtolower(url_title(convert_alias($this->input->post("language_name")))),
                "language_status"=>$this->input->post("language_status"),
                "language_position"=>$this->input->post("language_position"),
                "language_update_date"=>time(),
                "user"=>$s_info["s_user_id"]
            );
            $this->mlanguage->updateData($id,$this->_data["set_value"]);
            redirect(admin_url.'language/index');
        }
        /**end cap nhat*/

        $this->my_layout->view("backend/language/language_edit_view",$this->_data);
    }
    /**end cap nhat ngon ngu*/

    /**begin xoa ngon ngu*/
    public function delete($id){
        $url = "public/frontend/uploads/files/".$this->uri->segment(3)."/";
        if(isset($id) && is_numeric($id)){
            $this->_data= $this->mlanguage->getData('',array("id"=>$id));
            if($this->_data){
                if(file_exists($url.$this->_data["language_picture"])){
                    unlink($url.$this->_data["language_picture"]);
                }
                if(file_exists($url.'thumbnail/'.$this->_data["language_picture"])){
                    unlink($url.'thumbnail/'.$this->_data["language_picture"]);
                }
            }
            $this->mlanguage->deleteData($id);
            redirect(admin_url.'language/index');
        }else{
            redirect(admin_url.'language/index');
        }
    }
    /**end xoa ngon ngu*/

    /**begin cap nhat trang thai*/
    public function update_status($id,$status){
        if(isset($id) && is_numeric($id)){
            $this->_data = array(
                "language_status"=>$status
            );
            $this->mlanguage->updateData($id,$this->_data);
            redirect(admin_url.'language/index');
        }else{
            redirect(admin_url.'language/index');
        }
    }
    /**end cap nhat trang thai*/

    /**beign load danh sach ngon ngu tren head*/
    public function ajLang(){
       
        $and = "language_status = 1";
        $list_language =$this->mlanguage->getArray('',$and,$orderby="");
        $languageView = "";
        $countAll = count($list_language);
        if($list_language){
            foreach ($list_language as $key => $value) {
                if($value['language_name']) {
                     
                    $picture = $value["language_picture"]!=""?base_file.'language/'.$value["language_picture"]:admin_img.'no_image.png';
                   
                    $width = $this->uri->segment(1)==$value['language_name_short'] ? '40px':'25px';
                    $height = $this->uri->segment(1)==$value['language_name_short'] ? '30px':'15px';
                    $languageView .= '<li class="dropdown messages-menu">';
                        $languageView .= '<img src="'.$picture .'" style="margin-left:10px;margin-top:15px;width:'.$width.'; height:'.$height.'" />';
                    $languageView .= '</li>';
                }
            }
        }
        if($countAll>0){
            echo $languageView;
        }
    }
    
}