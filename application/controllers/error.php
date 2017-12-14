<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class error extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->_data['title'] = '404';
        $this->my_layout->view("frontend/404/404_view",$this->_data);
    }
}
