<?php
include_once( dirname(__FILE__) . '/simple_html_dom.php') ;
class Feed
{	
	public static $items = array();
		
	public function __construct(){        		
        /**begin nap cac helper*/      
    }


	static function feed_data($cmd){
		if($cmd=='insert_database'){
			$dir = dir_root.'/application/cache/temp_data.cache.php';
			if(file_exists($dir)){
				require $dir;
				if(isset($items) and $items){
					foreach($items as $key=>$value){						
						/*Feed::debug($value);*/
						$table=$value['table'];						
						if(!DB::fetch('select id from '.$table.' where tieude_vi="'.str_replace('"','\"',$value['tieude_vi']).'"')){
							unset($value['table']);
							DB::insert($table,$value);
						}
					}
					@unlink($dir);
				}
			}
			
			header('Location:'.$_SERVER['REQUEST_URI']);
		}else
		if($cmd=='feed' and $temps=$_REQUEST['temps']){
			/*/ Lấy tin*/
			$temps = implode(',',$temps);						
			if($sites = Feed::get_site('site.id in ('.$temps.')'))
			{
				/*/Feed::debug($sites);*/
				foreach($sites as $key=>$value)
				{
					$check_page = strpos($value['url'],'*');
					if($check_page===false){
						Feed::get_data($value,Feed::get_pattern($key));
					}else{
						if($page_num = $value['page_num']){
							$check_page_num = strpos($page_num,'-');
							if($check_page_num===false){
								$value['url'] = str_replace('*',$page_num,$value['url']);
								Feed::get_data($value,Feed::get_pattern($key));
							}else{
								$arr_page = explode('-',$page_num);
								for($i=$arr_page[1];$i>=$arr_page[0];$i--){
									$site = $value;
									$site['url'] = str_replace('*',$i,$value['url']);
									Feed::get_data($site,Feed::get_pattern($key));
								}
							}
						}else{
							$value['url'] = str_replace('*','1',$value['url']);
							Feed::get_data($value,Feed::get_pattern($key));
						}
					}
				}
				/*/ Lưu tin đã lấy vào file cache				*/
				$path = dir_root.'/application/cache/temp_data.cache.php';
				$content = '<?php $items = '.var_export(Feed::$items,true).';?>';
				$handler = fopen($path,'w+');
				fwrite($handler,$content);
				fclose($handler);
			}
			header('Location:'.$_SERVER['REQUEST_URI']);
		}
	}


	function get_items(){
		$data='';
		$dir = dir_root.'/application/cache/temp_data.cache.php';
		if(file_exists($dir)){
			require $dir;
			if(isset($items) and $items){
				foreach($items as $key=>$value){
					$data .= '<li>'.$value['news_lang_name'].'</li>';
				}
			}
		}
		return $data;
	}	
	function get_site($cond = 1)
	{		
		$get = $this->mgetauto_site->getList($cond,"id DESC");
		return $get;
	}
	function get_pattern($site_id)
	{
		$get = $this->mgetauto_site_structure->getList($cond,"id DESC");
		return $get;	
	}
	function format_link($source,$format=false)
	{
		if($format)
		{
			$source = str_replace(' ','%20',$source);	
		}
		else
		{
			if(strrpos($source,'?')===true)
			{
				$source = substr($source,0,strrpos($source,'?'));
			}
			$source = str_replace(' ','',$source);	
		}
		return $source;
	}
	function save($sour,$dest)
	{
		$sour = $this->format_link($sour,true);
		if(!file_put_contents($dest, file_get_contents($sour))){
			$dest = '';
		}
	}
	function parse_row($link,$pattern,$site)
	{
		$html=$this->html_no_comment($link);
		if($html){
			$html = str_get_html($html);
			$item = array();
			$check = false;
			if(isset($site['news_picture']) and $site['news_picture'])
			{
				$item['news_picture'] = $site['news_picture'];
			}
			if($pattern)
			{
				foreach($pattern as $key=>$value)
				{
					$element_delete = $value['element_delete'];
					if($detail_pattern = $value['extra']){
						foreach($html->find($detail_pattern) as $element)
						{
							if($element_delete){
								$arr = explode(',',$element_delete);
								for($i=0;$i<count($arr);$i++){
									foreach($element->find($arr[$i]) as $e){
										$e->outertext='';
									}
								}
							}
							if($value['field_name']=='tieude_vi' or $value['field_name']=='brief'){
								$item[$value['field_name']] = trim($element->plaintext);
							}else{
								$item[$value['field_name']] = $element->innertext;
							}
							break;
						}
					}
				}
				if(isset($item['news_lang_name']))
				{
					foreach($this->$items as $key=>$value){
						if($value['news_lang_name']==$item['news_lang_name']) $check=true;
					}
					if(!$check){
						/* Viết lại đường dẫn ảnh trong nội dung*/
						if(isset($item['news_lang_detail']) and $item['news_lang_detail']){
							$item['news_lang_detail']=str_replace($site['image_content_left'],$site['image_content_right'],$item['news_lang_detail']);
						}
						$item+= array(
							'news_parent'=>$site['category_id'],
							'news_create_date'=>time(),
							"user"=>0,
							"news_type"=>3,
							"news_status"=>1,
							"news_lang_search"=>$this->convert($item['news_lang_name']),
							"news_lang_alias"=>$this->convert_alias($item['news_lang_name']),
							"news_lang"=>$this->uri->segment(1),
							"news_lang_status"=>1,
							"news_lang_create_date"=>time(),
							'table'=>$site['table_name']
						);
						$items[] = $item;
					}
				}
			}
			$html->clear();
			unset($html);
		}
	}


	function get_data($site,$pattern)
	{
		$html=$this->html_no_comment($site['url']);
		if($html){
			/*Feed::debug($html);*/
			$hd = $site['begin'];
			$ft = $site['end'];
			
			if(!$hd or !($bg = strpos($html,$hd))) $bg = 0;
			if(!$ft or !($end = strpos($html,$ft))) $end = strlen($html);
			
			$html = substr($html,$bg+strlen($hd),$end-$bg-strlen($hd));
			
			$html = str_get_html($html);
			
			$host = $site['host'];
			$pattern_bound = $site['pattern_bound'];
			$pattern_link = $site['extra'];
			$pattern_img = $site['image_pattern'];
			
			$folder=$site['image_dir']; /* Thư mục chứa ảnh*/
			if(!is_dir($folder)) @mkdir($folder,0755,true);
			$num=0;
			$maxitem=1000;
			foreach($html->find($pattern_bound) as $item)
			{
				if($num>=$maxitem) break;
				$num++;
				foreach($item->find($pattern_link) as $link){
					$link = $this->check_link($link->getAttribute('href'),$host);
				}
				if($this->check_url($link)){
					$items = $item->find($pattern_img);
					if($items and count($items)){
						foreach($items as $img){
							$image_url=$img->src;
						}
						$source = $this->check_link($image_url,$site['host']);
						$basename = basename($source);
						/**duong dan ao*/
						$aliad_img = "lay_tin_tu_dong";
						if(file_exists($folder.'/'.$basename)){							
							$dest = date("d_m_Y_",time()).$aliad_img.'_'.$basename;
						}else{
							$dest = date("d_m_Y_",time()).$aliad_img.'_'.$basename;
						}
						$this->save($source,$dest);
						$site['news_picture'] = $dest;
					}else{
						$site['news_picture'] = '';
					}
					/*Feed::debug($site);*/
					$this->parse_row($link,$pattern,$site);
				}
			}
		}
		$html->clear();
		unset($html);
	}
	function check_link($url,$host='')
	{
		if((strpos($url,'http://')===false) and (preg_match_all('/http:\/\/(.*)\.([a-z]+)\//',$host,$matches,PREG_SET_ORDER)))
		{
			while ($url{0}=='/'){
				$url=substr($url,1);
			}
			if($matches[0][0]{strlen($matches[0][0])-1}!='/'){
				$matches[0][0]=$matches[0][0].'/';
			}
			$url = $matches[0][0].$url;
		}
		return $url;
	}
	function check_url($url=NULL){
		if($url == NULL) return false;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);/*lay code tra ve cua http*/
		curl_close($ch);
		return ($httpcode>=200 && $httpcode<300);
	}
	function _isCurl(){
		return function_exists('curl_version');
	}
	function _urlencode($url){
		$output="";
		for($i = 0; $i < strlen($url); $i++) 
		$output .= strpos("/:@&%=?.#", $url[$i]) === false ? urlencode($url[$i]) : $url[$i]; 
		return $output;
	}
	function file_get_contents_curl($url) {		
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	
		$data = curl_exec($ch);
		curl_close($ch);
	
		return $data;
	}
	function html_no_comment($url) {
		/* create HTML DOM*/
		$check_curl=$this->_isCurl();
		if(!$html=file_get_html($url)){
			if(!$html=str_get_html($this->file_get_contents_curl($url)) or !$check_curl){
				return false;
			}
		}
		/* remove all comment elements*/
		foreach($html->find('comment') as $e)
		
			$e->outertext = '';
	
		$ret = $html->save();
		
		/* clean up memory*/
		$html->clear();
		unset($html);
		return $ret;
	}
	static function debug($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
		exit();
	}

}
?>