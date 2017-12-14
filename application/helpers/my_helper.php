<?php
 
 
if ( ! defined('menu_lang_default')){
    define('menu_lang_default','vn');
}
/**begin duong dan upload*/
if ( ! defined('base_url')){
    define('base_url','http://'.$_SERVER['SERVER_NAME'].'/');
}
/**begin duong dan thu muc public*/
if(!defined('base_public')){
    define('base_public', base_url.'public/');
}
/**end duong dan thu muc public*/

if(!defined("admin_url")){
    define('admin_url', base_url.admin_name.'/');
}
/**begin duong dan css frontend*/
if ( ! defined('base_css')){
    define('base_css',base_public.'frontend/css/');
}
/**end duong dan css frontend*/
/**begin duong dan css admin*/
if ( ! defined('admin_css')){
    define('admin_css',base_public.'backend/css/');
}
/**end duong dan css admin*/

/**begin duong dan css frontend*/
if ( ! defined('base_css_no')){
    define('base_css_no',base_public.'frontend/css/nochange/');
}
/**end duong dan css frontend*/

/**begin duong dan css frontend*/
if ( ! defined('admin_css_no')){
    define('admin_css_no',base_public.'backend/css/nochange/');
}
/**end duong dan css frontend*/
if ( ! defined('base_images')){
    define('base_images',base_public.'frontend/images/');
}
/**begin duong dan js frontend*/
if ( ! defined('base_js')){
    define('base_js',base_public.'frontend/js/');
}
/**end duong dan js frontend*/

/**begin duong dan js backend*/
if ( ! defined('admin_js')){
    define('admin_js',base_public.'backend/js/');
}
/**end duong dan js backend*/

/**begin duong dan js frontend*/
if ( ! defined('base_js_no')){
    define('base_js_no',base_public.'frontend/js/nochange/');
}
/**end duong dan js frontend*/

/**begin duong dan js backend*/
if ( ! defined('admin_js_no')){
    define('admin_js_no',base_public.'backend/js/nochange/');
}
/**end duong dan js backend*/

/**begin duong dan image frontend*/
if ( ! defined('base_img')){
    define('base_img',base_public.'frontend/images/');
}
/**end duong dan image frontend*/

/**begin duong dan image backend*/
if ( ! defined('admin_img')){
    define('admin_img',base_public.'backend/images/');
}
/**end duong dan image backend*/

/**begin duong dan file frontend*/
if ( ! defined('base_file')){
    define('base_file',base_public.'frontend/uploads/files/');
}
/**end duong dan file frontend*/


/**begin kiem tra mang*/
if(! function_exists("p")){
    function p($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}
/**end kiem tra mang*/

/**begin ham chuyen doi ky tu co dau thanh khong dau*/
if(!function_exists("convert")){

    function convert($str)
    {
        $string=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
        ,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
        ,"ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
        ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
        ,"Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ","ê","ù","à");
        $convert=array("a","a","a","a","a","a","a","a","a","a","a"
        ,"a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o"
        ,"o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A"
        ,"A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O"
        ,"O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D","e","u","a");
        return str_replace($string,$convert,$str);
    }
}
/**end ham chuyen doi ky tu co dau thanh khong dau*/

/**begin ham chuyen doi ky tu co dau thanh khong dau*/
if(!function_exists("convert_alias")){
    function convert_alias($str)
    {
        $str = convert($str);
        return str_replace(' ','-',$str);
    }
}
/**end ham chuyen doi ky tu co dau thanh khong dau*/

/**begin lay duong dan hien tai cua website*/
if(!function_exists("curPageURL")){
    function curPageURL() {
        $pageURL = 'http';
        /*if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}*/
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}
/**end lay duong dan hien tai cua website*/

/**begin convert duong dan chuyen alias
 * ex: https://thietkewebpro247.com==>https:--thietkewebpro247.com
 */
if(!function_exists("url_convert_on")){
    function url_convert_on($url){
        return str_replace("/","-",$url);
    }
}
/**end convert duong dan chuyen alias*/

/**begin convert duong dan chuyen alias
 * ex: https://thietkewebpro247.com==>https:++thietkewebpro247.com
 */
if(!function_exists("url_convert_on_f")){
    function url_convert_on_f($url){
        return str_replace("/","+",$url);
    }
}
/**end convert duong dan chuyen alias*/

/**begin convert bo duong dan alias
 * ex: https:--thietkewebpro247.com==>https://thietkewebpro247.com
 */
if(!function_exists("url_convert_off_f")){
    function url_convert_off_f($url){
        return str_replace("+","/",$url);
    }
}
/**end convertbo duong dan alias*/

/**begin convert bo duong dan alias
 * ex: https://thietkewebpro247.com==>https:--thietkewebpro247.com
 */
if(!function_exists("url_convert_off")){
    function url_convert_off($url){
        return str_replace("-","/",$url);
    }
}
/**end convertbo duong dan alias*/

/**begin kiem tra tra thai active cua menu*/
if(!function_exists("check_active_menu")){
    function check_active_menu($url_request,$url_com,$css_active){
        if($url_request==$url_com){
            echo $css_active;
        }else{
            echo "";
        }
    }
}
/**end kiem tra tra thai active cua menu*/

/**begin ham cat chuoi*/
if(!function_exists("substring")){
    function substring($data,$limit)
    {
        if (strlen($data) > $limit)
        {
            $data =  substr($data,0, $limit);
            $s = $data;
            $len = strlen($data) - 1;
            for ($i = $len; $i > 0; $i--)
            {
                if ($s[$i] == " ")
                {
                    $data = substr($data,0,$i);
                    break;
                }
            }
        }
        return $data.'...';
    }
}
/**end ham cat chuoi*/

/***chuyen trang bang script*/
if(!function_exists("location_time")){
    function location_time($url){
        if($url){
            echo '<script>top.window.location.href="'+$url+'"</script>';
        }
    }
}
/***chuyen trang bang script*/

/**begin diem khoi hanh*/
if(!function_exists("area_arr")){
    function area_arr($key=""){
        $arr = array(
            "1"=>"Hồ Chí Minh",
            "2"=>"Bình Dương",
            "3"=>"Đồng Nai"
        );
        if($key){
            return$arr[$key];
        }else{
            return $arr;
        }

    }
}

if(!function_exists("area_veh")){
    function area_veh($key=""){
        $arr = array(
            1 => 'Ô tô',
            2 => 'Máy bay',
            3 => 'Tàu thủy',
            4 => 'Tàu hỏa',
        );
        if($key){
            return$arr[$key];
        }else{
            return $arr;
        }

    }
}
if(!function_exists("dropdownVehicle")){
    function dropdownVehicle($active = '')
    {
       $arr =  area_veh();
        $html = '';
        foreach ($arr as $key => $value) {
            $selected = $active == $key ? 'selected' : '';
            echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
        }
    }
}
if(!function_exists("area_begin_tour")){
    function area_begin_tour($active=""){
        $arr =  area_arr();
        if($arr){
            foreach($arr as $k => $v){
                $selected = $active==$k?"selected":"";
                echo '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
            }
        }
    }
}
/**end diem khoi hanh*/
if(!function_exists("getFileExt")){
    function getFileExt($fileName)
    {
        return strtolower(substr(strrchr($fileName, '.'), 1));
    }
}

if(!function_exists("sendmail")){
    function sendmail($name,$from,$to,$subject,$message){
        $mess =$message;
        $headers = "From: ".$name." <".$from.">\n";
        $headers .= "Reply-To: ".$name." <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
        return @mail( $to, $subject, $mess, $headers );
    }
}
if(!function_exists("send")){
    function send($to,$subject,$message,$contact_name,$contact_email){
        $contact_name = "=?UTF-8?B?".base64_encode($contact_name).'?=';
        $headers = "From: ".$contact_name." <".$contact_email.">\n";
        $headers .= "Reply-To: ".$contact_name." <".$contact_email.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";
        return @mail( $to, "=?UTF-8?B?".base64_encode($subject).'?=', $message, $headers );
    }
}
if(!function_exists("send_cart")){
    function send_cart($to,$subject,$message){
        $CI = get_instance();
        $mess =$message;
        $contact_name = "=?UTF-8?B?".base64_encode($CI->config->item('contact_name')).'?=';
        $headers = "From: ".$contact_name." <".$CI->config->item('contact_email').">\n";
        $headers .= "Reply-To: ".$contact_name." <".$CI->config->item('contact_email').">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";
        return @mail( $to, "=?UTF-8?B?".base64_encode($subject).'?=', $mess, $headers );
    }
}
if(!function_exists("send_mail_templates")){
    function send_mail_templates($to,$subject,$message){
        $CI = get_instance();
        $mess =$message;
        $contact_name = "=?UTF-8?B?".base64_encode('TÊN NGƯỜI GỬI').'?=';
        $headers = "From: ".$contact_name." <hotro@xxx.vn>\n";
        $headers .= "Reply-To: ".$contact_name." <hotro@xxx.vn>\n";
        $headers .= "MCDN-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";
        return @mail( $to, "=?UTF-8?B?".base64_encode($subject).'?=', $mess, $headers );
    }
}
if(!function_exists("send_mail_to_friend")){
    function send_mail_to_friend($nguoigui,$emailnguoigui,$emailnguoinhan,$subject,$message){
        $nguoigui1 = "=?UTF-8?B?".base64_encode($nguoigui).'?=';
        $headers = "From: ".$nguoigui1." <".$emailnguoigui.">\n";
        $headers .= "Reply-To: ".$nguoigui1." <".$emailnguoigui.">\n";
        $headers .= "MCDN-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\n";
        if(@mail( $emailnguoinhan, "=?UTF-8?B?".base64_encode($subject).'?=', $message, $headers )){
            return true;
        }else{
            return false;
        }
    }
}


/**end doc chu so*/
if(!function_exists("convert_number_to_words")){
    function convert_number_to_words($number) {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'Không',
            1                   => 'Một',
            2                   => 'Hai',
            3                   => 'Ba',
            4                   => 'Bốn',
            5                   => 'Năm',
            6                   => 'Sáu',
            7                   => 'Bảy',
            8                   => 'Tám',
            9                   => 'Chín',
            10                  => 'Mười',
            11                  => 'Mười một',
            12                  => 'Mười hai',
            13                  => 'Mười ba',
            14                  => 'Mười bốn',
            15                  => 'Mười năm',
            16                  => 'Mười sáu',
            17                  => 'Mười bảy',
            18                  => 'Mười tám',
            19                  => 'Mười chín',
            20                  => 'Hai mươi',
            30                  => 'Ba mươi',
            40                  => 'Bốn mươi',
            50                  => 'Năm mươi',
            60                  => 'Sáu mươi',
            70                  => 'Bảy mươi',
            80                  => 'Tám mươi',
            90                  => 'Chín mươi',
            100                 => 'trăm',
            1000                => 'ngàn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
/**begin doc chu so*/
if(!function_exists("sizeFilter")){
    function sizeFilter( $bytes )
    {
        $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $label[$i] );
    }
}
 