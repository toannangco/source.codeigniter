<?php
 

class mlanguage extends MY_Model{
    public $table = "tkwp_languages";

    public function __construct(){
        parent::__construct();
    }
    public function show()
    {
        $this->db->select('language_name as name, language_name_short as lang, language_picture as picture, language_alias as alias');
        $this->db->where(array('language_status'=>1));
        $query = $this->db->get($this->table);
        return $query->result_object();
    }
}