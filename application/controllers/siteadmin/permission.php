<?php
    /**
    
    class permission extends MY_Admin_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
        $this->muser->permision("permission","index");
            $this->_data["title"] = "Permission";
            $and = '';
            $orderby = 'id desc';
            $this->_data['group'] = $this->mgroup->getQuery("id,group_name",$join_g="",'','group_order asc',"");
            $this->_data['groupaction'] = $this->mgroupaction->getQuery("id,gc_name,gc_value",$join_g="",'gc_status=1','gc_value asc',"");
            $this->_data['list'] = $this->mpermission->getQuery($object="",$join="",$and,$orderby,$limit="");
            $this->my_layout->view("backend/permission/permission_list_view",$this->_data);
        }

        
        public function grouplevel()
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","grouplevel");
            $this->_data["title"] = "Group level";
            $and = '';
            $this->_data['orderby']=$orderby = 'group_order asc';
            $this->_data['list'] = $this->mgroup->getQuery($object="",$join="",$and,$orderby,$limit="");
            $this->my_layout->view("backend/permission/permission_level_view",$this->_data);
        }
       
        public function grouplevel_add()
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","grouplevel_add");
            
            $this->_data["title"]  = 'Add';
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data["title"]  = 'Add Level';
            $this->_data['formData']    = array(
                "group_name"=>"",
                "group_note"=>"",
                "group_order"=>0,
                "group_create"=>date("Y-m-d H:i:s"),
                "user"=>"",
            );

            if(isset($_POST['fsubmit'])){
                $this->_data['formData']    = array(
                    "group_name"=>isset($_POST['group_name']) && $_POST['group_name'] ? $_POST['group_name']:'',
                    "group_note"=>isset($_POST['group_note']) && $_POST['group_note'] ? $_POST['group_note']:'',
                    "group_order"=>isset($_POST['group_order']) ? $_POST['group_order']:0,
                    "group_create"=>date("Y-m-d H:i:s"),
                    "user"=>"",
                );
                if($this->_data['formData']['group_name']){
                    $insert = $this->mgroup->add($this->_data['formData']);
                    if(is_numeric($insert)>0){
                        $this->_data['success'][] = "Add success";
                        $this->_data['formData'] = NULL;
                        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                            redirect(base64_decode($_REQUEST['redirect']));
                        }else{
                            redirect(admin_url."permission/grouplevel");
                        }
                    }else{
                        $this->_data['error'][] = "Add Not Success";
                    }
                }else{
                    $this->_data['error'][] = "Bạn chưa nhập tên";
                }
            }
            $this->my_layout->view("backend/permission/permission_level_add_view",$this->_data);
        }
     
        public function grouplevel_edit($id)
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","grouplevel_edit");
            
            $myGroup = '';
            if(is_numeric($id)){
                $myGroup = $this->mgroup->getData(array("id"=>$id));
                if($myGroup['id']<=0){
                    redirect(admin_url.'error/notfound');
                }
            }else{
                redirect(admin_url.'error/notfound');
            }
            $this->_data["title"]  = 'Update';
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data['info'] = "";
            if(isset($_REQUEST['info']) && $_REQUEST['info']=="add")
            {
                $this->_data['info'][] = 'Edit success';
            }
            $this->_data["title"]  = 'Edit menu';
            $this->_data['formData']    = array(
                "group_name"=>isset($myGroup['group_name']) ? $myGroup['group_name']:'',
                "group_note"=>isset($myGroup['group_note']) ? $myGroup['group_note']:'',
                "group_order"=>isset($myGroup['group_order']) ? $myGroup['group_order']:0,
                "group_create"=>date("Y-m-d H:i:s"),
                "user"=>"",
            );

            if(isset($_POST['fsubmit'])){
                $this->_data['formData']    = array(
                    "group_name"=>isset($_POST['group_name']) && $_POST['group_name'] ? $_POST['group_name']:'',
                    "group_note"=>isset($_POST['group_note']) && $_POST['group_note'] ? $_POST['group_note']:'',
                    "group_order"=>isset($_POST['group_order']) && $_POST['group_order'] ? $_POST['group_order']:'',
                );
                if($this->_data['formData']['group_name']){
                    if($this->mgroup->edit($id,$this->_data['formData'])){
                        $this->_data['success'][] = "Edit success";
                        $this->_data['formData'] = NULL;
                        if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                            redirect(base64_decode($_REQUEST['redirect']));
                        }else{
                            redirect(admin_url."permission/grouplevel/");
                        }
                    }else{
                        $this->_data['error'][] = "Edit Not Success";
                    }
                }else{
                    $this->_data['error'][] = "Bạn chưa nhập tên";
                }
            }   
            $this->my_layout->view("backend/permission/permission_level_edit_view",$this->_data);
        }
      
        public function grouplevel_delete($id)
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","grouplevel_delete");
            
            $myGroup = '';
            $this->_data['title'] = "Delete";
            if(is_numeric($id)){
                $myGroup = $this->mgroup->getData(array("id"=>$id));
                if($myGroup['id']<=0){
                    redirect(admin_url.'error/notfound');
                }else{                  
                    $this->mgroup->delete($id);
                    if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                        redirect(base64_decode($_REQUEST['redirect']));
                    }else{
                        redirect(admin_url."permission/grouplevel/");
                    }
                }
            }else{
                redirect(admin_url.'error/notfound');
            }
        }
      
        public function groupaction()
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","groupaction");
            $this->_data['fkey'] = isset($_REQUEST['fkey']) ? $_REQUEST['fkey'] : '';
            if(isset($_POST['ck_status_all']) || isset($_POST['ck_status'])){
                $fstatus = $this->input->post('fstatus');
                $ck_status = $this->input->post('ck_status');
                if($ck_status)
                {
                    $this->mgroupaction->editArr($ck_status,array("gc_status"=>$fstatus));
                }else{
                    $this->_data['error'] = 'Bạn chưa chọn item';
                }
            }
            $this->_data["title"]  = 'Danh sách';
            $and = 'gc_status = 1';
            if($this->_data['fkey']){
                $and = 'gc_name like "%'.$this->_data["fkey"].'%" or gc_value like "%'.$this->_data["fkey"].'%"';
            }
            $this->_data['orderby']=$orderby = 'gc_value asc';
            $this->_data['list'] = $this->mgroupaction->getQuery($object="",$join="",$and,$orderby,$limit="");
            $this->my_layout->view("backend/permission/permission_action_view",$this->_data);

        }
       
        public function groupaction_add()
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","groupaction_add");
            $this->_data["title"]  = 'Add';
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data["title"]  = 'Add Group Action';
            $this->_data['formData']    = array(
                "gc_name"=>"",
                "gc_value"=>"",
                "gc_order"=>0,
                "gc_create"=>date("Y-m-d H:i:s"),
                "user"=>"",
            );

            if(isset($_POST['fsubmit'])){
                $this->_data['formData']    = array(
                    "gc_name"=>isset($_POST['gc_name']) && $_POST['gc_name'] ? $_POST['gc_name']:'',
                    "gc_value"=>isset($_POST['gc_value']) && $_POST['gc_value'] ? $_POST['gc_value']:'',
                    "gc_order"=>isset($_POST['gc_order']) ? $_POST['gc_order']:0,
                    "gc_create"=>date("Y-m-d H:i:s"),
                    "user"=>"",
                );
                if($this->_data['formData']['gc_name']){
                    $myGroupActionCheck = $this->mgroupaction->getData(array("gc_value"=>$this->_data['formData']['gc_value']));
                    if($myGroupActionCheck['id'] > 0){
                        $this->_data['error'][] = "Value is exist";
                        $this->_data['formData']['gc_value'] = "";
                    }
                    else
                    {
                        $insert = $this->mgroupaction->add($this->_data['formData']);
                        if(is_numeric($insert)>0){
                            $this->_data['success'][] = "Add success";
                            $this->_data['formData'] = NULL;
                            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                                redirect(base64_decode($_REQUEST['redirect']));
                            }else{
                                redirect(admin_url."permission/groupaction/");
                            }
                        }else{
                            $this->_data['error'][] = "Add Not Success";
                        }
                    }
                }else{
                    $this->_data['error'][] = "Bạn chưa nhập tên";
                }
            }       
            $this->my_layout->view("backend/permission/permission_action_edit_view",$this->_data);
        }
      
        public function groupaction_edit($id)
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","groupaction_edit");
            $myGroupAction = '';
            if(is_numeric($id)){
                $myGroupAction = $this->mgroupaction->getData(array("id"=>$id));
                if($myGroupAction['id']<=0){
                    redirect(admin_url.'error/notfound');
                }
            }else{
                redirect(admin_url.'error/notfound');
            }
                        
            $this->_data["title"]  = 'Update';
            $this->_data['error'] = "";
            $this->_data['success'] = "";
            $this->_data['info'] = "";
            if(isset($_REQUEST['info']) && $_REQUEST['info']=="add")
            {
                $this->_data['info'][] = 'Add success';
            }
            $this->_data["title"]  = 'Edit menu';
            $this->_data['formData']    = array(
                "gc_name"=>isset($myGroupAction['gc_name']) ? $myGroupAction['gc_name']:'',
                "gc_value"=>isset($myGroupAction['gc_value']) ? $myGroupAction['gc_value']:'',
                "gc_order"=>isset($myGroupAction['gc_order']) ? $myGroupAction['gc_order']:0,
                "gc_create"=>date("Y-m-d H:i:s"),
                "user"=>"",
            );

            if(isset($_POST['fsubmit'])){
                $this->_data['formData']    = array(
                    "gc_name"=>isset($_POST['gc_name']) && $_POST['gc_name'] ? $_POST['gc_name']:'',
                    "gc_value"=>isset($_POST['gc_value']) && $_POST['gc_value'] ? $_POST['gc_value']:'',
                    "gc_order"=>isset($_POST['gc_order']) && $_POST['gc_order'] ? $_POST['gc_order']:'',
                    "gc_create"=>date("Y-m-d H:i:s"),   
                );
                if($this->_data['formData']['gc_name']){
                    $myGroupActionCheck = $this->mgroupaction->getData(array("id !="=>$id,"gc_value"=>$this->_data['formData']['gc_value']));
                    if($myGroupActionCheck['id'] > 0){
                        $this->_data['error'][] = "Value is exist";
                        $this->_data['formData']['gc_value'] = "";
                    }
                    else
                    {
                        if($this->mgroupaction->edit($id,$this->_data['formData'])){
                            $this->_data['success'][] = "Edit success";
                            $this->_data['formData'] = NULL;
                            if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                                redirect(base64_decode($_REQUEST['redirect']));
                            }else{
                                redirect(admin_url."permission/groupaction/");
                            }
                        }else{
                            $this->_data['error'][] = "Edit Not Success";
                        }
                    }
                }else{
                    $this->_data['error'][] = "Bạn chưa nhập tên";
                }
            }
            $this->my_layout->view("backend/permission/permission_action_edit_view",$this->_data);
        }
       
        public function groupaction_delete($id)
        {           
            
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","groupaction_delete");
                    
            $myGroupAction = '';
            $this->_data['title'] = "Delete";
            if(is_numeric($id)){
                $myGroupAction = $this->mgroupaction->getData(array("id"=>$id));
                if($myGroupAction['id']<=0){
                    redirect(admin_url.'error/notfound');
                }else{
                    $this->mgroupaction->delete($id);
                    if(isset($_REQUEST['redirect']) && $_REQUEST['redirect']){
                        redirect(base64_decode($_REQUEST['redirect']));
                    }else{
                        redirect(admin_url."permission/groupaction/");
                    }
                }
            }else{
                redirect(admin_url.'error/notfound');
            }   

        }
       
        public function aj_proccess()
        {
            $this->_data['s_info']=$s_info = $this->session->userdata('userInfo');
            $this->muser->permision("permission","aj_proccess");
            $html = "";
            $val = isset($_REQUEST['val']) && $_REQUEST['val'] ? $_REQUEST['val']:'';
            if($val)
            {               
                $tmpVal = explode("-", $val);
                $group_id = (int) $tmpVal[1];
                $gc_id = (int) $tmpVal[0];
                if(is_numeric($group_id)>0 && is_numeric($gc_id)>0)
                {
                    $myPermission = $this->mpermission->getData(array("gc_id"=>$gc_id,"group_id"=>$group_id));
                    if($myPermission==NULL)
                    {
                     
                        $this->_data['formData'] = array(
                            "gc_id"=>$gc_id,
                            "group_id"=>$group_id,
                            "per_create"=>date("Y-m-d H:i:s"),
                            "user"=>""
                        );
                        if($this->_data['formData']['gc_id'] && $this->_data['formData']['group_id'])
                        {
                            $insert = $this->mpermission->add($this->_data['formData']);
                            if(is_numeric($insert)>0)
                            {
                                $html =  "Gán quyền thành công";
                            }
                            else
                            {
                                $html =  "Gán quyền không thành công";
                            }
                        }
                    }
                    else
                    {
                    
                        if(is_numeric($myPermission['id'])>0)
                        {
                            $this->mpermission->delete($myPermission['id']);
                            $html = "Loại bỏ quyền thành công";
                        }
                        else
                        {
                            $html = "Loại bỏ quyền không thành công";
                        }
                    }
                }
                echo $html;
            }
        }   
    }
 
****/