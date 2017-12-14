<?php
class MY_Admin_Controller extends CI_Controller
{

    protected $_data;
    public function __construct()
    {   
        parent::__construct();
        /**begin nap thu vien*/
		
        $this->load->library(array("my_layout", "pagination", "my_xml", "paging"));
        $this->my_layout->setLayout("template/backend/template"); /**load file layout chinh*/
        /**end nap thu vien*/

        /**begin nap cac helper*/
        $this->load->helper(array("language", "my_helper"));
        $this->lang->load("set");
        /**end nap cac helper*/
		$this->load->Model("backend/muser");
		$this->load->Model("backend/mgroup");
		$this->load->Model("backend/mpermission");
        $this->load->Model("mmenu");
		$this->load->Model("backend/mtranslate");
        $this->load->Model("mlanguage");
        //$this->load->Model("mconfig");
         $this->_data["lang"] =  isset($_SESSION['lang']) ? $_SESSION['lang']:'vn';
        $this->_data["lang"] = 'vn';
       // $this->mconfig->defined_helper($this->_data['lang']);
		 $this->_data['language'] = $this->mlanguage->show();
        $this->_data['s_info']   = $this->session->userdata('userInfo');
        $this->_data['title']    = '';

        $this->muser->check_login();
     $this->mtranslate->showTranslate();
    }

    public function Msendmail($name, $from, $to, $cc = '', $bcc = '', $title, $content, $file = '')
    {
        $this->load->library('email');
        $this->load->library('parser');
        $config['useragent']      = 'CodeIgniter';
        $config['protocol']       = 'smtp';
        $config['mailpath']       = '/usr/sbin/sendmail';
        $config['smtp_host']      = "ssl://smtp.googlemail.com";
        $config['smtp_user']      = config_mail_user_gmail;
        $config['smtp_pass']      = config_mail_pass_gmail;
        $config['smtp_port']      = 465;
        $config['smtp_timeout']   = 7;
        $config['wordwrap']       = false;
        $config['wrapchars']      = 76;
        $config['mailtype']       = 'html';
        $config['charset']        = 'utf-8';
        $config['validate']       = false;
        $config['priority']       = 3;
        $config['crlf']           = "\r\n";
        $config['newline']        = "\r\n";
        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;

        $this->email->initialize($config);
        $this->email->from($from, $name);
        $this->email->to($to);
        if ($cc) {
            $this->email->cc($cc);
        }
        if ($bcc) {
            $this->email->bcc($bcc);
        }

        $this->email->subject($title);
        $this->email->message($content);
        if ($file) {
            $this->email->attach($file);
        }
        if ($name && $from && $to && $title && $content) {
            $this->email->send();
        }
        // return $html;
    }

}
