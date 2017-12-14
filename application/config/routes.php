<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();  
$route['default_controller'] = '/home';
$route['404_override'] = 'error';
$route[admin_name.'/(:any)'] = admin_name.'/$1';
$route[admin_name] = admin_name.'/index';
$route['tim-kiem'] = 'search/index/';

$route['login'] 			= 'user/index/';
$route['dang-ky-thanh-vien']= '/user/register';
$route['thanh-vien'] 		= 'user/index/';
$route['dang-nhap']			= 'user/login/';
$route['thanh-vien/form-dang-ky'] 		= 'user/registerclass/';
$route['lop-hoc-cong-dong'] 			= 'classpublic/index/';


if(!empty($_SERVER['REQUEST_URI'])){
    $menu_alias = $_SERVER['REQUEST_URI'];
    $menu_alias = ltrim($menu_alias,'/');
    $menu_alias = explode('/',$menu_alias);
    $menu_alias = str_replace('.html', '',$menu_alias[0]);
	 
    require_once( BASEPATH .'database/DB'. EXT );
    $db =& DB();
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'vn';
    $tmp = $db->select('menu_id as id')->where(array('menu_lang_alias'=>$menu_alias))->get( PREFIX.'menu_lang' );
    $tmp_rs = $tmp->result();
    if(!empty($tmp_rs)){
        $query = $db->select('menu_com as com,menu_view as view')->where(array('id'=>$tmp_rs[0]->id))->get( PREFIX.'menu' );
        $result = $query->result();
        foreach( $result as $row )
        {
            $route['(:any)/(:any)'] = $row->com.'/detail/$1/$2';
            $route['(:any)'] = $row->com.'/index/$1';
        }
        
    }
    else{
        $query = $db->select('com_com as com')->where(array('com_parent'=>0,'com_status'=>1))->get( PREFIX.'com' );
        $rs = $query->result();
        if(!empty($rs))
        {
            foreach ($rs as $key => $value) {
                $route[$value->com.'/(:any)'] = $value->com.'/$1';
                $route[$value->com] = $value->com.'/index';
            }
        }
    }
}
