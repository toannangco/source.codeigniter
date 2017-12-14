<?php
/**
* 
*/
class language extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $lang = $this->input->get('lang');
        $redirect = $this->input->get('redirect');
        if(!empty($redirect))
        {
            $_SESSION['lang'] = $lang ? $lang:'vn';
            if(base64_decode($redirect) == base_url){
                redirect(base64_decode($redirect));
            }else{
                redirect(base64_decode($redirect));
            }
        }else{
            $_SESSION['lang'] = $lang ? $lang:'vn';
            redirect(base_url);
        }
    }
}
?>