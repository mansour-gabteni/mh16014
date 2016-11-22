<?php


class AdminEGMSShopController extends ModuleAdminControllerCore
{

	protected $position_identifier = 'id_shop_url';
	
	public function __construct()
	{
		parent::__construct();
		$this->bootstrap = true;
		$this->table = 'shop_url';
		$this->list_id = 'id_shop_url';
		$this->identifier = 'id_shop_url';	
		//$this->className = 'Citys';	
		$this->meta_title = $this->l('Citys by Shops');
		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?'), 'icon' => 'icon-trash'));
		$this->fields_list = array(
			'id_'.$this->table => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'class' => 'fixed-width-xs'
			),
			'name' => array('title' => $this->l('Shopname'), 'filter_key' => 's!shop'),	
			'cityname1' => array('title' => $this->l('Cityname'), 'filter_key' => 'cu!cityname1'),
			'domain' => array('title' => $this->l('domain'), 'filter_key' => 'domain'),
			'manufacturer' => array('title' => $this->l('manufact'), 'orderby' => false),
			'phone' => array('title' => $this->l('Phone'), 'filter_key' => 'cu!phone'),
			'active' => array('title' => $this->l('Displayed'), 'filter_key' => 'cu!active', 'align' => 'center', 'active' => 'status', 'class' => 'fixed-width-sm', 'type' => 'bool', 'orderby' => false)
		);	
		
		$this->_select .= 'cu.id_egms_city_url, s.name, c.cityname1, cu.phone, cu.active,  count(cm.id_manufacturer) manufacturer';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'egms_city_url cu ON a.id_shop_url = cu.id_shop_url ';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'egms_city c ON c.id_egms_city = cu.id_city ';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'shop s ON a.id_shop = s.id_shop ';
		$this->_join .= ' LEFT JOIN '._DB_PREFIX_.'egms_city_manuf cm ON cm.id_egms_city = cu.id_egms_city_url ';
		if (Shop::getContext() == Shop::CONTEXT_SHOP)
			$this->_where .= ' and s.id_shop in ('.(int)Context::getContext()->shop->id.')';
		$this->_group = ' GROUP BY (cu.id_egms_city_url) ';
		$this->_orderBy = 'c.cityname1';
	
		$this->_theme_dir = Context::getContext()->shop->getTheme();
	}
	
	public function renderList()
	{
		$this->initToolbar();
		$this->addRowAction('edit');
		$this->addRowAction('delete');
		return parent::renderList();
	}
	
	public function renderForm()
	{
		if (!$this->loadObject(true))
			return;
		if (Validate::isLoadedObject($this->object))
			$this->display = 'edit';
		else
			$this->display = 'add';
		$this->initToolbar();
		$this->context->controller->addJqueryUI('ui.sortable');
		//return $this->_showWidgetsSetting();
	}	
/*******************************************************************/
	public function ajaxProcessInsertProductInfo()
	{
		$this->ormprod = new egormprod();

		$id_page = Tools::getValue('id_page');		
		$attrgroup = Tools::getValue('attrgroup');
		$url_page = Tools::getValue('url_page');
		
		$this->ormprod->insertProductInfo($id_page, $attrgroup, $url_page);
		
	}
		

	public function ajaxProcessUpdateProductInfo()
	{
		$this->ormprod = new egormprod();
		
		$t_tmp = Tools::getValue('uc');
		if ($t_tmp == 'true')
			$action = "load,update";
		else
			$action = "update";
		
		$type = array();	
		if (Tools::getValue('up')=='true')
			$type[] = "price";
		if (Tools::getValue('comment')=='true')
			$type[] = "comment";
		if (Tools::getValue('upname')=='true')
			$type[] = "upname";
		
		$id_page = Tools::getValue('id_page');
		
		$this->ormprod->updateProductInfo($type, $id_page,$action);
		
	}
	
	public function ajaxProcessGetTable()
	{
		
		$this->ormprod = new egormprod();
		
		$list = $this->ormprod->getProductList(0,false,false);
		
		$link = new Link();

		$output = "";		
		foreach($list as $row)
		{

			$output .= "<tr><td>-</td>";
			$output .= "<td>".$row['id_product']."</td>";
			$output .= "<td><span>".$row['product_sname']."</span><br><span style='font-size: 8px;'><a href='".$row['product_url']."'>".$row['product_url']."</a></span></td>";
			$output .= "<td><span>".$row['name']."</span><br><span style='font-size: 8px;'><a href='".$link->getProductLink($row['id_product'])."'>".$link->getProductLink($row['id_product'])."</a></span></td>";
			$output .= "<td>".$row['product_attrgroup']."</td>";
			$output .= "<td>".$row['price_discount']."</td>";
			$output .= "<td>".$row['dname']."</td>";			
			$output .= "<td><a href='#' onclick='UpdateRow(this);return(false);'>R</a>";
			$output .= " <a href='".Context::getContext()->link->getAdminLink('AdminProducts')."&updateproduct&id_product=".(int)$row['id_product']."' target='new'>E</a>";
			$output .= " <a href='#' onclick='InsertRow(this);return(false);'>I</a></td>";
			$output.="</tr>";

		}
		
		die ($output);
	}
	
}
