<?php
 


class MDocument extends CI_Model{
    private $table = "tkwp_document";
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
     
	 public function countData($condition)
    {
        $data = $this->getQuerySql('id',$condition);
        return count($data);
    }
	
    public function getQuerySql($object="",$and="",$orderby="",$limit=""){
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table .' where 1 ';

        if($and){
            $sql .= ' and '.$and;
        }

        if($orderby){
            $sql .= ' order by '.$orderby;
        }else{
            $sql .= ' order by id asc ';
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
        $sql = 'select * from '.$this->table .' where 1 ';
        if($and){
            $sql .= ' and '.$and;
        }
		 
        $query = $this->db->query($sql);
        $count = $query->num_rows();
        return $count;
    }
    /**end dem theo query sql*/
 public function getData($object='',$and=''){
        if($object){
            $this->db->select($object);
        }
        if($and){
            $this->db->where($and);
        }
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }

    /**begin lay 1 dong co dieu kien*/
    public function getOnceAnd($and){
        $this->db->where($and);
        $rs = $this->db->get($this->table);
        return $rs->row_array();
    }
     
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
    public function deleteData($id){
        if(is_numeric($id)){
            $this->db->where('id',$id);
        }elseif(is_array($id)){
            $this->db->where_in('id',$id);
        }
        return $this->db->delete($this->table);
    }
	public function dropdown($active = "",$document_parent = 0,$caret=''){
        $data = $this->getQuerySql($object=""," document_parent =  ".$document_parent,$orderby="",$limit="");
        if($data){
            foreach($data as $item){
                $selected = $active==$item["id"]?"selected":"";
                echo '<option '.$selected.' value="'.$item["id"].'">'.$caret.' '.$item["document_name"].'</div>';
                $this->dropdown($active, $item['id'],$caret.'-- ');
            }
        }
    }
	 public function uploadfile($path,$name){
        if(!is_dir($path)){
            mkdir($path,0777, true);
            chmod($path, 0777);
        }
        $config = array('upload_path'   => $path,
                        'allowed_types' => 'doc|pdf|docx|xlsx|xls|gif|jpg|png|txt|zip|rar',
                        'max_size'      => '50000');
        $this->load->library("upload",$config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload($name)){
            $error = array($this->upload->display_errors());
            return 0;
        }else{
            $image_data = $this->upload->data();
            return $image_data; 
        }
    }
    /**end upload file*/
  public function countAnd($and){
        if($and){
            $this->db->where($and);
        }
        $query = $this->db->get($this->table);
        $count = $query->num_rows();
        return $count;
    }
    public function removeFile($path,$name)
    {
        if(file_exists($path.'/'.$name)){
            unlink($path.'/'.$name);
        }
    }
	  public function upload($path,$name,$size='',$watermark=true){
        if(!is_dir($path)){
            mkdir($path,0777, true);
            chmod($path, 0777);
        }
        $config = array('upload_path'   => $path,
                        'allowed_types' => 'gif|jpg|png',
                        'max_size'      => '50000');
        $this->load->library("upload",$config);
        if(!$this->upload->do_upload($name)){
            $error = array($this->upload->display_errors());
            return 0;
        }else{
            $image_data = $this->upload->data();
            $this->load->library("image_lib");
            // /*resize*/
            $config['image_library'] = 'gd2';
            $config['source_image'] = $path.'/'.$image_data['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            if($size != 'full'){
                $config['width']        = '1245'; 
                $config['height']       = '700'; // ti le 16:9
            }

            $this->image_lib->initialize($config);
            $this->image_lib->resize(); // resize
            $this->image_lib->clear();
            unset($config);
            /*watemark*/
            // if(file_exists(dir_root.'/public/frontend/images/logo.png') && $watermark==true){
            //     $config['source_image'] = $path.'/'.$image_data['file_name'];
            //     $config['create_thumb'] = FALSE;
            //     $config['wm_type'] = 'overlay';
            //     $config['wm_overlay_path'] = dir_root.'/public/frontend/images/logo.png';
            //     $config['wm_vrt_alignment'] = 'bottom';
            //     $config['wm_hor_alignment'] = 'right';
            //     $config['wm_padding'] = '0';
            //     $config['wm_opacity'] = '50';
            //     $this->image_lib->initialize($config);
            //     $this->image_lib->watermark(); //watemark
            // }
            return $image_data; 
        }
    }
	 
	
}