<?php
class product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model("mproduct");
        $this->load->Model("mproduct_picture");
    }
    /**begin trinh bay danh sach*/
    public function index($menu_alias)
    {
        $menu_id                 = $this->mmenu->getIDAnd($menu_alias, true, $this->_data['lang']);
        $this->_data['menuInfo'] = $this->mmenu->getInfoAlias($menu_alias, $this->_data['lang']);
        if (empty($this->_data['menuInfo']) && !isset($_REQUEST['fkey'])) {
            redirect(base_url());
        }

        $condition_product = 'nl.product_lang="' . $this->_data['lang'] . '"';
        if (isset($_REQUEST['fkey'])) {
            $this->_data['fkey'] = $this->security->sanitize_filename($_REQUEST['fkey']);
            $condition_product .= " and (nl.product_lang_name like '%" . $this->_data['fkey'] . "%'";
            $condition_product .= " or nl.product_lang_alias like '%" . $this->_data['fkey'] . "%'";
            $condition_product .= " or nl.product_lang_seo_keyword like '%" . $this->_data['fkey'] . "%'";
            $condition_product .= " or nl.product_lang_search like '%" . $this->_data['fkey'] . "%')";
        } else {
            $condition_product .= ' and n.product_parent in (' . $menu_id . ')';

        }
        $orderby               = " id DESC";
        $page                  = (isset($_REQUEST['page']) && $_REQUEST['page']) ? $_REQUEST['page'] : '1';
        $config['per_page']    = 6;
        $config['uri_segment'] = (($page - 1) * $config['per_page']);

        $object_product = 'n.id,n.product_picture,n.product_parent,n.product_create_date';
        $object_product .= ',nl.product_lang_name,nl.product_lang_alias,nl.product_lang_price,nl.product_lang_promotion';
        $this->_data['list']   = $this->mproduct->getProduct($object_product, $condition_product, 'n.id desc', $config['uri_segment'] . ',' . $config['per_page']);
        $this->_data["record"] = $this->mproduct->countData($condition_product);

        $this->_data['menuChild']  = $this->mmenu->getMenu(5, $this->_data['lang']);
        $config['total_rows']      = $this->_data["record"];
        $config['num_links']       = 5;
        $config['base_url']        = base_url() . $this->uri->segment(1) . '/?page=';
        $this->_data["pagination"] = $this->paging->paging_url($this->_data["record"], $page, $config['per_page'], $config['num_links'], $config['base_url']);
        $this->_data["title"]      = !empty($this->_data['menuInfo']) ? $this->_data['menuInfo']["menu_name"] : tim_kiem . ':  <mark>' . $this->_data['fkey'] . '</mark> ';
        $this->my_layout->view("frontend/product/list_view", $this->_data);
    }
    /**end trinh bay danh sach*/

    /**begin trinh bay chi tiet*/
    public function detail($menu_alias, $id)
    {
        $this->_data['menuInfo'] = $this->mmenu->getInfoAlias($menu_alias, $this->_data['lang']);
        if (empty($this->_data['menuInfo'])) {
            redirect(base_url());
        }
        $object_product = 'n.id,n.product_parent,n.product_view,n.product_picture';
        $object_product .= ',nl.product_code,nl.product_lang_name,nl.product_lang_alias, nl.product_lang_detail,nl.product_lang_price,nl.product_lang_quality,nl.product_lang_promotion,nl.product_lang_more';
        $object_product .= ', nl.product_lang_seo_title, nl.product_lang_seo_keyword,nl.product_lang_seo_description';
        $this->_data['same'] = null;
        if (!empty($id)) {
            $condition_product   = "  n.id=" . $id;
            $this->_data['info'] = $this->mproduct->getProduct($object_product, $condition_product, 'n.id desc', '1');
            $this->_data['infoPicture'] = $this->mproduct_picture->getArray('product_picture_name',array('product_id'=>$id));
            if (!empty($this->_data['info'])) {
                $condition_product_same = '  nl.product_lang = "' . $this->_data['lang'] . '" and n.id != ' . $id . ' and product_parent = ' . $this->_data['info']->product_parent;
                $this->_data['same']    = $this->mproduct->getProduct($object_product, $condition_product_same, 'n.id desc', '0,20');
                $arr_up                 = array(
                    "product_view" => ($this->_data['info']->product_view + 1),
                );
                $this->mproduct->updateData($id, $arr_up);
                $this->_data["title"] = $this->_data['info']->product_lang_name;
                if ($this->_data['info']->product_lang_seo_title) {
                    $this->_data["title"] = $this->_data['info']->product_lang_seo_title;
                }
                if ($this->_data['info']->product_lang_seo_keyword) {
                    $this->_data["keywords"] = $this->_data['info']->product_lang_seo_keyword;
                }
                if ($this->_data['info']->product_lang_seo_description) {
                    $this->_data["description"] = $this->_data['info']->product_lang_seo_description;
                }
            }
        }
        $this->my_layout->view("frontend/product/detail_view", $this->_data);
    }
    /**end trinh bay chi tiet*/
}
