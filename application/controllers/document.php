<?php
class document extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->Model("backend/mdocument");
    }
	public function index($menu_alias){
		$data->_data['title'] = 'Danh sách tài liệu';
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
		$condition = '   document_parent in (' . $menu_id . ')';
		$orderby               = "  id DESC";
        $this->_data['page']   = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $config['per_page']    = 20 ;
		$object= '';
        $config['uri_segment'] = (($this->_data['page'] - 1) * $config['per_page']);
		$this->_data['list']       = $this->mdocument->getQuerySql($object, $condition, $orderby, $config['uri_segment'] . ',' . $config['per_page']);
        $this->_data["record"]     = $this->mdocument->countData($condition);
        $config['total_rows']      = $this->_data["record"];
        $config['num_links']       = 5;
        $config['base_url']        = base_url() . $this->uri->segment(1) . '/?' . $url_search . 'page=';
        $this->_data["pagination"] = $this->paging->paging_url($this->_data["record"], $this->_data['page'], $config['per_page'], $config['num_links'], $config['base_url']);
		
		 
		 
		$this->my_layout->view("frontend/document/document_list", $this->_data);
	}
	
	 public function detail($menu_alias, $alias)
    {  
        $menuTmp                 = $this->mmenu->getInfoAliasTmp($menu_alias);
        $this->_data['menuInfo'] = $this->mmenu->getInfoID($menuTmp, $this->_data['lang']);
        if (empty($this->_data['menuInfo'])) {
            redirect(base_url());
        }
      
        $object = '*';
		$con = "  document_name_alias = '" .$alias. "'  " ;
        $this->_data['same'] = null;
        if (!empty($alias)) {
			$this->_data['view'] = $this->mdocument->getQuerySql($object, $con , '', '') ;
        }
		$this->_data['view'] = $this->_data['view'][0] ;
        $this->my_layout->view("frontend/document/document_view", $this->_data);
    }
	
	public function countDownload(){
		$id = $this->input->post('id_document') ;
		$con = "  id = '" .$id. "'  " ; $object = ' document_count ';
		$view = $this->mdocument->getQuerySql($object , $con , '', '') ;
			  $count = array(
				"document_count" => ($view[0]['document_count'] + 1),
			  );
		$this->mdocument->updateData($id,$count) ;
	}
	
	
	
}