<?php
class welcome extends  MY_Controller{
    public function __construct(){
        parent::__construct();
    }
    function _remap(){
        $this->index();
    }
    /**begin trang chu*/
    public function index(){
        $this->_data['title'] = config_title;
        $this->_data['welcome'] = $this->mbanner->banner('welcome');
        $this->load->view("frontend/welcome/welcome_view",$this->_data);
    }
    /**end trang chu*/
}
