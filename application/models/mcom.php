<?php
 
class Mcom extends MY_Model{
    protected $table = "tkwp_com";
    public function __construct(){
        parent::__construct();
    }
    public function dropdown($active = '')
    {
        $html = '';
        $data = $this->getArray('com_com,com_name',array('com_parent'=>0,'com_status'=>1));
        if(!empty($data))
        {
            foreach ($data as $key => $value) {
                $selected = $active == $value['com_com'] ? 'selected' : '';
                $html .= '<option '.$selected.' value="'.$value['com_com'].'">'.$value['com_name'].'</option>';
            }
        }
        return $html;
    }
    public function getView($com,$active='')
    {
        $html = '<option value="0">-- --</option>';
        $data = $this->getArray('com_name,com_type',array('com_parent !='=>0,'com_com'=>$com));
        if(!empty($data))
        {
            foreach ($data as $key => $value) {
                $selected = $active == $value['com_type'] ? 'selected' : '';
                $html .= '<option '.$selected.' value="'.$value['com_type'].'">'.$value['com_name'].'</option>';
            }
        }
        return $html;
    }
}