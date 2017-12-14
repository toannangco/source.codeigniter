<?php
 
class mconfig extends MY_Model{
    public $table = "tkwp_config";
    public function __construct(){
        parent::__construct();
        $this->load->Model("mcompany");
        $this->load->Model("mcompany_contact");
        $this->load->Model("mcompany_support");
		 
    }
    public function defined_helper($lang)
    {
        
        $company = $this->mcompany->getData("", array("company_lang" => $lang));
        if (!defined('company')) {
            define('company', !empty($company) ? $company["company_name"]:'');
        }
        if (!defined('company_short')) {
            define('company_short', !empty($company) ? $company["company_name_short"]:'');
        }
        
        $company_contact = $this->mcompany_contact->getArray("", array("company_contact_lang" => $lang));
        if ($company_contact) {
            $i = 1;
            foreach ($company_contact as $item) {
                if (!defined('company_address_' . $i)) {
                    define('company_address_' . $i, $item["company_contact_address"]);
                }
                if (!defined('company_maps_' . $i)) {
                    define('company_maps_' . $i, $item["company_contact_maps"]);
                }
                if (!defined('company_phone_' . $i)) {
                    define('company_phone_' . $i, $item["company_contact_phone"]);
                }
                if (!defined('company_hotline_' . $i)) {
                    define('company_hotline_' . $i, $item["company_contact_hotline"]);
                }
                if (!defined('company_fax_' . $i)) {
                    define('company_fax_' . $i, $item["company_contact_fax"]);
                }
                if (!defined('company_email_' . $i)) {
                    define('company_email_' . $i, $item["company_contact_email"]);
                }
                if (!defined('company_website_' . $i)) {
                    define('company_website_' . $i, $item["company_contact_website"]);
                }
                if (!defined('company_facebook_' . $i)) {
                    define('company_facebook_' . $i, $item["company_contact_facebook"]);
                }
                
                if (!defined('company_google_' . $i)) {
                    define('company_google_' . $i, $item["company_contact_google"]);
                }
                if (!defined('company_twitter_' . $i)) {
                    define('company_twitter_' . $i, $item["company_contact_twitter"]);
                }
                if (!defined('company_youtube_' . $i)) {
                    define('company_youtube_' . $i, $item["company_contact_youtube"]);
                }
                $i++;
            }
        }

        $config_web = $this->mconfig->getData('',array('id'=>1));
        if (!defined("config_title")) {
            define("config_title", !empty($config_web) ? $config_web["config_title"]:'');
        }
        if (!defined("config_keyword")) {
            define("config_keyword", !empty($config_web) ? $config_web["config_keyword"]:'');
        }
        if (!defined("config_description")) {
            define("config_description", !empty($config_web) ? $config_web["config_description"]:'');
        }
        if (!defined("config_footer")) {
            define("config_footer", !empty($config_web) ? $config_web["config_footer"]:'');
        }
        if (!defined("config_right")) {
            define("config_right", !empty($config_web) ? $config_web["config_right"]:'');
        }
    }
}
 