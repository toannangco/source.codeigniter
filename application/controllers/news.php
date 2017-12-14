<?php
/**
 *
 */
class news extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index($menu_alias)
    {       
        $menuTmp                 = $this->mmenu->getInfoAliasTmp($menu_alias);
        $this->_data['menuInfo'] = $this->mmenu->getInfoID($menuTmp, $this->_data['lang']);
        $menu_id                 = $this->mmenu->getIDAnd($this->_data['menuInfo']['menu_alias'], true, $this->_data['lang']); 
	 
        if (empty($this->_data['menuInfo']) && !isset($_REQUEST['fkey'])) {
            redirect(base_url());
        }
        $this->_data["title"]     = $this->_data['menuInfo']["menu_name"];
        
		
         
        if ($this->_data['menuInfo']['menu_title']) {
            $this->_data["title"] = $this->_data['menuInfo']["menu_title"];
        }
        if ($this->_data['menuInfo']['menu_keyword']) {
            $this->_data["keywords"] = $this->_data['menuInfo']["menu_keyword"];
        }
        if ($this->_data['menuInfo']['menu_description']) {
            $this->_data["description"] = $this->_data['menuInfo']["menu_description"];
        }

        $condition_news = 'news_status = 1  and nl.news_lang="' . $this->_data['lang'] . '"';
        $url_search     = '';
        if (isset($_REQUEST['fkey'])) {
            $this->_data['fkey'] = $this->security->sanitize_filename($_REQUEST['fkey']);
            $condition_news .= " and (nl.news_lang_name like '%" . $this->_data['fkey'] . "%'";
            $condition_news .= " or nl.news_lang_alias like '%" . $this->_data['fkey'] . "%'";
            
            $condition_news .= " or nl.news_lang_summary like '%" . $this->_data['fkey'] . "%')";
            $this->_data['banner_page'] = $this->_data['menuChild'] = null;

            $url_search = 'fkey=' . $this->_data['fkey'] . '&';
        } else {
            $condition_news .= ' and n.news_parent in (' . $menu_id . ')';
        }

        $orderby               = "n.news_orderby ASC, n.id DESC";
        $this->_data['page']   = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $config['per_page']    = 12;
        $config['uri_segment'] = (($this->_data['page'] - 1) * $config['per_page']);

        $object_news = 'n.id,n.news_picture,n.news_parent,n.news_create_date';
        $object_news .= ',nl.news_lang_name,nl.news_lang_summary,nl.news_lang_alias,nl.news_lang_summary,nl.news_lang_detail';
        $this->_data['list']       = $this->mnews->getNews($object_news, $condition_news, $orderby, $config['uri_segment'] . ',' . $config['per_page']);
      
	   $this->_data["record"]     = $this->mnews->countData($condition_news);
        $config['total_rows']      = $this->_data["record"];
        $config['num_links']       = 5;
        $config['base_url']        = base_url() . $this->uri->segment(1) . '/?' . $url_search . 'page=';
        $this->_data["pagination"] = $this->paging->paging_url($this->_data["record"], $this->_data['page'], $config['per_page'], $config['num_links'], $config['base_url']);
        $this->_data["title"]= !empty($this->_data['menuInfo']) ? strip_tags($this->_data['menuInfo']["menu_name"]) : tim_kiem.':  <mark>'.$this->_data['fkey'].'</mark> ';
        if (count($this->_data["list"]) == 1 && !isset($_REQUEST['page'])) {
            $this->_data['info'] = $this->_data["list"][0];
            
            $this->_data['same'] = null;
            $id                  = $this->_data['info']->id;
            if (!empty($id)) {
                $condition_news      = "  n.id=" . $id;
                $this->_data['info'] = $this->mnews->getNews($object_news, $condition_news, 'n.id desc', '1');
                if (!empty($this->_data['info'])) {
                    $condition_news_same = ' news_status = 1 and  nl.news_lang = "' . $this->_data['lang'] . '" and n.id != ' . $id . ' and news_parent = ' . $this->_data['info']->news_parent;
                    $this->_data['same'] = $this->mnews->getNews($object_news, $condition_news_same, 'n.news_create_date DESC,n.news_orderby ASC, n.id desc', '0,20');
                    $arr_up              = array(
                        "news_view" => ($this->_data['info']->news_view + 1),
                    );
                    $this->mnews->updateData($id, $arr_up);
                  $this->_data["title"] = strip_tags($this->_data['info']->news_lang_name);
                   if($this->_data['info']->news_lang_seo_title){
                    $this->_data["title"] = $this->_data['info']->news_lang_seo_title;
                   }
                  if($this->_data['info']->news_lang_seo_keyword){
                    $this->_data["keywords"] = $this->_data['info']->news_lang_seo_keyword;
                  }
                 if($this->_data['info']->news_lang_seo_description){
                      $this->_data["description"] = $this->_data['info']->news_lang_seo_description;
                    }
                }
                $this->_data['mulImg'] = !empty($this->_data['info']) && $this->_data['info']->news_picture_more ? unserialize($this->_data['info']->news_picture_more) : '';
            }
            $this->my_layout->view("frontend/news/detail_view", $this->_data);
            return;
        }

        $this->my_layout->view("frontend/news/list_view", $this->_data);
    }
    /**end trinh bay danh sach*/

    /**begin trinh bay chi tiet*/
    public function detail($menu_alias, $alias)
    {  
        $menuTmp                 = $this->mmenu->getInfoAliasTmp($menu_alias);
        $this->_data['menuInfo'] = $this->mmenu->getInfoID($menuTmp, $this->_data['lang']);
        if (empty($this->_data['menuInfo'])) {
            redirect(base_url());
        }
      
        $object_news = 'n.id,n.news_parent,n.news_picture,n.news_create_date,n.news_update_date';
        $object_news .= ',nl.news_lang_name,nl.news_lang_alias,nl.news_lang_summary, nl.news_lang_detail';
        $object_news .= ',nl.news_lang_seo_title,nl.news_lang_seo_keyword,nl.news_lang_seo_description';
	
        $this->_data['same'] = null;
        if (!empty($alias)) {
            $condition_news      = " nl.news_lang = '" . $this->_data['lang'] . "' and news_status = 1 and  nl.news_lang_alias='".$alias."' ";
            $this->_data['info'] = $this->mnews->getNews($object_news, $condition_news, 'n.id desc', '1');
            if (!empty($this->_data['info'])) {
                $this->_data['mulImg'] = !empty($this->_data['info']) && $this->_data['info']->news_picture_more ? unserialize($this->_data['info']->news_picture_more) : '';
                $condition_news_same   = ' news_status = 1 and  nl.news_lang = "' . $this->_data['lang'] . '" and nl.news_lang_alias != "' . $alias . '" and news_parent = ' . $this->_data['info']->news_parent;
                $this->_data['same']   = $this->mnews->getNews($object_news, $condition_news_same, 'n.news_orderby ASC, n.id desc', '0,20');
                $arr_up                = array(
                    "news_view" => ($this->_data['info']->news_view + 1),
                );
                $this->mnews->updateData($alias, $arr_up);
                $this->_data["title"] = strip_tags($this->_data['info']->news_lang_name);
                /*get bai viet next prev*/
                $condition_com           = " nl.news_lang = '" . $this->_data['lang'] . "' and news_status = 1 and n.news_parent = " . $this->_data['menuInfo']['id'];
           //  p($this->_data['info']);
                 
            }
        }
		 
        $this->my_layout->view("frontend/news/detail_view", $this->_data);
    }
	
	 public function search()
    {       
        
        $this->_data["title"]     = 'Tìm kiếm';
         if ($this->_data['menuInfo']['menu_title']) {
            $this->_data["title"] = 'Tìm kiếm';
        }
		  $condition_news = 'news_status = 1  and nl.news_lang="' . $this->_data['lang'] . '"';
        $url_search     = '';
        if (isset($_REQUEST['fkey'])) {  //echo $_REQUEST['fkey'] ; exit ;
            $this->_data['fkey'] = $this->security->sanitize_filename($_REQUEST['fkey']);
            $condition_news .= " and (nl.news_lang_name like '%" . $this->_data['fkey'] . "%'";
            $condition_news .= " or nl.news_lang_alias like '%" . $this->_data['fkey'] . "%'";
            
            $condition_news .= " or nl.news_lang_summary like '%" . $this->_data['fkey'] . "%')";
            $this->_data['banner_page'] = $this->_data['menuChild'] = null;

            $url_search = 'fkey=' . $this->_data['fkey'] . '&';
        } else {
            $condition_news .= ' and n.news_parent in (' . $menu_id . ')';
        }

        $orderby               = "n.news_orderby ASC, n.id DESC";
        $this->_data['page']   = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $config['per_page']    = 12;
        $config['uri_segment'] = (($this->_data['page'] - 1) * $config['per_page']);

        $object_news = 'n.id,n.news_picture,n.news_parent,n.news_create_date';
        $object_news .= ',nl.news_lang_name,nl.news_lang_summary,nl.news_lang_alias,nl.news_lang_summary,nl.news_lang_detail';
        $this->_data['list']       = $this->mnews->getNews($object_news, $condition_news, $orderby, $config['uri_segment'] . ',' . $config['per_page']);
      
	   $this->_data["record"]     = $this->mnews->countData($condition_news);
        $config['total_rows']      = $this->_data["record"];
        $config['num_links']       = 5;
        $config['base_url']        = base_url() . $this->uri->segment(1) . '/?' . $url_search . 'page=';
        $this->_data["pagination"] = $this->paging->paging_url($this->_data["record"], $this->_data['page'], $config['per_page'], $config['num_links'], $config['base_url']);
        $this->_data["title"]= !empty($this->_data['menuInfo']) ? strip_tags($this->_data['menuInfo']["menu_name"]) : tim_kiem.':  <mark>'.$this->_data['fkey'].'</mark> ';
        if (count($this->_data["list"]) == 1 && !isset($_REQUEST['page'])) {
            $this->_data['info'] = $this->_data["list"][0];
            
            $this->_data['same'] = null;
            $id                  = $this->_data['info']->id;
            if (!empty($id)) {
                $condition_news      = "  n.id=" . $id;
                $this->_data['info'] = $this->mnews->getNews($object_news, $condition_news, 'n.id desc', '1');
                if (!empty($this->_data['info'])) {
                    $condition_news_same = ' news_status = 1 and  nl.news_lang = "' . $this->_data['lang'] . '" and n.id != ' . $id . ' and news_parent = ' . $this->_data['info']->news_parent;
                    $this->_data['same'] = $this->mnews->getNews($object_news, $condition_news_same, 'n.news_create_date DESC,n.news_orderby ASC, n.id desc', '0,20');
                    $arr_up              = array(
                        "news_view" => ($this->_data['info']->news_view + 1),
                    );
                    $this->mnews->updateData($id, $arr_up);
                  $this->_data["title"] = strip_tags($this->_data['info']->news_lang_name);
                   if($this->_data['info']->news_lang_seo_title){
                    $this->_data["title"] = $this->_data['info']->news_lang_seo_title;
                   }
                  if($this->_data['info']->news_lang_seo_keyword){
                    $this->_data["keywords"] = $this->_data['info']->news_lang_seo_keyword;
                  }
                 if($this->_data['info']->news_lang_seo_description){
                      $this->_data["description"] = $this->_data['info']->news_lang_seo_description;
                    }
                }
                $this->_data['mulImg'] = !empty($this->_data['info']) && $this->_data['info']->news_picture_more ? unserialize($this->_data['info']->news_picture_more) : '';
            }
            $this->my_layout->view("frontend/news/detail_view", $this->_data);
            return;
        }

        $this->my_layout->view("frontend/news/list_view", $this->_data);
    }
     
}
