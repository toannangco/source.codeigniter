<?php
 

class mproject extends CI_Model{
    protected $table = "tkwp_project";
    public function __construct(){
        parent::__construct();
        //Lấy đường dẫn url của thư mục chứa hình ảnh được upload
        $this->_file_url = base_url()."public/frontend/uploads/files/project/";
        //Lấy đường dẫn vật lý của thư mục chứa hình ảnh đươc upload
        $this->_file_path = realpath(dir_root. "/public/frontend/uploads/files/project");
    }

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
    /**end lay 1 dong co dieu kien*/

    /**them moi data*/
    public function addData($data){
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id(); /**lay ra insert_id*/
        return $id;
    }
    /**end them moi data*/

    /**begin cap nhat*/
    public function updateData($id,$data){
        $this->db->where("id",$id);
        $this->db->update($this->table,$data);
    }
    /**end cap nhat*/

    /**begin xoa data*/
    function deleteData($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }
    /**end xoa data*/

    /**begin danh sach tour*/
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table;
        if($and){
            $sql .= ' where '.$and;
        }

        if($orderby){
            $sql .= ' order by '.$orderby;
        }

        if($limit){
            $sql .= ' limit '.$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_array();

    }
    /**end danh sach tour*/

    /**begin dem theo query sql*/
    public function countQuery($and=""){
        $sql = 'select * from '.$this->table;
        $sql .= ' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/

    public function do_upload(){
        $path = $this->_file_path;
        if(!is_dir($path))
        {
            mkdir($path,0777);
            chmod($path, 0777);
        } 
            
        $config = array('upload_path'   => $path,
                        'allowed_types' => 'gif|jpg|png|swf',
                        'max_size'      => '2000');
        $this->load->library("upload",$config);
        if(!$this->upload->do_upload("pro_picture")){
            $error = array($this->upload->display_errors());
        }else{
            $image_data = $this->upload->data();  
            copy($this->_file_path.'/'.$image_data["file_name"],$this->_file_path.'/thumbnail/'.$image_data["file_name"]);
            return $image_data; 
        }
    }
    public function removeFile($name)
    {
        $url = $this->_file_path.'/';
        if(file_exists($url.$name)){
            unlink($url.$name);
        }
    }
}
