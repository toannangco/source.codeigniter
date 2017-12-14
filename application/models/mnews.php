<?php
 

class mnews extends MY_Model{
    protected $table = "tkwp_news";
    protected $table_lang = "tkwp_news_lang";
    public function __construct(){
        parent::__construct();
        $this->load->Model("mnews_lang");
    }

     public function getNews($object = '', $condition = '', $order_by = 'n.id desc', $limit = '')
    {
        if($object){
            $sql = 'select '.$object.' ';
        }else{
            $sql = 'select * ';
        }

        $sql .= 'from '.$this->table.' n ';
        $sql .= 'inner join '.$this->table_lang.' nl on n.id = nl.news_id';
        
        
        if($condition){
            $sql .= ' where '.$condition;
        }
        $sql .= ' GROUP BY n.id ';

        if($order_by){
            $sql .= ' order by '.$order_by;
        }

        if($limit){
            $sql .= ' limit '.$limit;
        }
		 
        $query = $this->db->query($sql);
        if(!empty($limit) && $limit=="1")
        {
            return $query->row_object();
        }
        else
        {
            return $query->result_object();
        }
    }
    public function countData($condition)
    {
        $data = $this->getNews('n.id',$condition);
        return count($data);
    }

    public function getNone($condition='', $order_by = 'n.id desc', $limit = '5')
    {
        $object_news = 'n.id,n.news_parent';
        $object_news .= ',nl.news_lang_name,n.news_picture,nl.news_lang_alias,nl.news_lang_summary,n.news_begin_date';

        $sql = 'select '.$object_news.' ';
        $sql .= 'from '.$this->table.' n ';
        $sql .= 'inner join '.$this->table_lang.' nl on n.id = nl.news_id';
        
        $sql .= ' where n.news_status = 1';
        if($condition){
            $sql .= ' and '.$condition;
        }
        $sql .= ' GROUP BY nl.news_id ';
        if($order_by){
            $sql .= ' order by '.$order_by;
        }
        if($limit){
            $sql .= ' limit '.$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_object();
    }
    public function getHot($condition='', $order_by = 'n.id desc', $limit = '5')
    {
        $object_news = 'n.id,n.news_parent';
        $object_news .= ',nl.news_lang_name,n.news_picture,nl.news_lang_alias,nl.news_lang_summary,n.news_begin_date';

        $sql = 'select '.$object_news.' ';
        $sql .= 'from '.$this->table.' n ';
        $sql .= 'inner join '.$this->table_lang.' nl on n.id = nl.news_id';
        
        $sql .= ' where n.news_status = 1 and news_hot = 1';
        if($condition){
            $sql .= ' and '.$condition;
        }
        $sql .= ' GROUP BY nl.news_id ';
        if($order_by){
            $sql .= ' order by '.$order_by;
        }
        if($limit){
            $sql .= ' limit '.$limit;
        }
        $query = $this->db->query($sql);
        return $query->result_object();
    }

    public function removeFileMul($name,$news_id='')
    {
        if($news_id)
        {
            $myNews = $this->getData('',array('id'=>$news_id));
            $picture_more = !empty($myNews) && $myNews['news_picture_more'] ? unserialize($myNews['news_picture_more']):'';
            if(!empty($picture_more))
            {
                if(($key = array_search($name, $picture_more)) !== false) {
                    unset($picture_more[$key]);
                }
                $set_picture_mote = !empty($picture_more) ? serialize($picture_more) :'';
                $this->updateData($myNews['id'],array('news_picture_more'=>$set_picture_mote));
                $url = dir_root. '/public/frontend/uploads/files/news/';
                if(file_exists($url.$name)){
                    unlink($url.$name);
                }
            }
        }
    }
}
