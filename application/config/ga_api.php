<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['profile_id']	= ' '; // GA profile id
$config['email']		= ' '; // GA Account mail
$config['password']		= ''; // GA Account password

$config['cache_data']	= false; // request will be cached
$config['cache_folder']	= FCPATH.'/files/ga_files/'; // read/write
$config['clear_cache']	= array('date', '1 day ago'); // keep files 1 day
	
$config['debug']		= false; // print request url if true