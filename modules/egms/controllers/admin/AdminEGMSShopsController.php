<?php

require_once(_PS_MODULE_DIR_.'egms/classes/egms_shop.php');
require_once(_PS_MODULE_DIR_.'egms/classes/city.php');

class AdminEGMSShopsController extends ModuleAdminControllerCore
{

	protected $position_identifier = 'id_egms_cu';
	protected $manufacturers;
	protected $citys;
	protected $urls;
	
	public function __construct()
	{

		$this->bootstrap = true;
		$this->list_id = 'id_egms_cu';
		$this->identifier = 'id_egms_cu';
		$this->table = 'egms_city_url';	
		$this->className = 'egms_shop';	
		$this->meta_title = $this->l('Citys by Shops');
		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?'), 'icon' => 'icon-trash'));
		$this->fields_list = array(
			'id_egms_cu' => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'class' => 'fixed-width-xs'
			),
			'name' => array('title' => $this->l('Shopname'), 'filter_key' => 's!name'),	
			'cityname1' => array('title' => $this->l('Cityname'), 'filter_key' => 'c!cityname1'),
			'domain' => array('title' => $this->l('domain'), 'filter_key' => 'su!domain'),
			'activeurl' => array('title' => $this->l('Displayed url'), 'filter_key' => 'su!activeurl', 'align' => 'center', 'active' => 'status', 'class' => 'fixed-width-sm', 'type' => 'bool'),
			'manufacturer' => array('title' => $this->l('manufact'), 'orderby' => false),
			'phone' => array('title' => $this->l('Phone'), 'filter_key' => 'a!phone'),
			'active' => array('title' => $this->l('Displayed shop'), 'filter_key' => 'a!active', 'align' => 'center', 'active' => 'status', 'class' => 'fixed-width-sm', 'type' => 'bool')
		);	
		
		$this->_select .= 'a.id_egms_cu, s.name, c.cityname1, a.phone, su.domain, a.active, su.active activeurl, count(cm.id_manufacturer) manufacturer';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'shop_url su ON a.id_shop_url = su.id_shop_url ';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'egms_city c ON a.id_city = c.id_egms_city';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'shop s ON su.id_shop = s.id_shop ';
		$this->_join .= ' LEFT JOIN '._DB_PREFIX_.'egms_city_manuf cm ON cm.id_egms_city = a.id_egms_cu ';
		//if (Shop::getContext() == Shop::CONTEXT_SHOP)
		//	$this->_where .= ' and s.id_shop in ('.(int)Context::getContext()->shop->id.')';
		$this->_where .= ' and su.id_shop IN ('.implode(', ', Shop::getContextListShopID()).')';
		$this->_group = ' GROUP BY (id_egms_cu) ';
		$this->_orderBy = 'c.cityname1';
	
		$this->_theme_dir = Context::getContext()->shop->getTheme();
		$s = Shop::getContextListShopID();
		$this->getAllManufacturers();
		$this->getCitys();
		$this->getUrls();
		
		parent::__construct();
	}
	
	public function renderList()
	{
		$this->initToolbar();
		$this->addRowAction('edit');
		$this->addRowAction('delete');
		return parent::renderList();
	}

	public function postProcess()
	{
		parent::postProcess(true);
	}
	
	public function getAllManufacturers()
	{
		$manufacturers = ManufacturerCore::getManufacturers();
		$items = array();
		foreach ($manufacturers as $manufacturer)
		{
			$items[]= array(
						'id' => $manufacturer['id_manufacturer'], 
						'name' => $manufacturer['name'], 
			);
		}
		
         $this->manufacturers = $items;
	}
	
	public function getCitys()
	{
		$citys = city::getCity(Tools::getValue());
		foreach ($citys as $city)
		{
			$this->citys[] = array('id' => $city['id_egms_city'], 'name' => $city['cityname1']);
		}
	}
	
	public function getUrls()
	{
		$id_shop = null;
		//if (Shop::getContext() == Shop::CONTEXT_SHOP)
		//	$id_shop = $this->context->shop->id;//Context::getContext()->shop->id;
			
		$shops = egms_shop::getShopUrls($id_shop);
		foreach ($shops as $shop)
		{
			$this->urls[] = array(
	                'id' => $shop['id_shop_url'], 
	                'name' => $shop['domain']      
	        );
		}		
	}

	public function renderForm()
	{
		
		if (!$this->loadObject(true))
			if (Validate::isLoadedObject($this->object))
				$this->display = 'edit';
			else
				$this->display = 'add';

		$this->initToolbar();
		$this->initPageHeaderToolbar();

		$this->multiple_fieldsets = true;

		$soption = array(
			array(
				'id' => 'active_on',
				'value' => 1,
				'label' => $this->l('Enabled')
			),
			array(
				'id' => 'active_off',
				'value' => 0,
				'label' => $this->l('Disabled')
			)
		);
		
		
		
		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend' => array(
				'title' => $this->l('Shops by Citys'),
				'icon' => 'icon-folder-close'
			),
			'input' => array(
				array(
					'type' => 'hidden',
					'label' => $this->l('id'),
					'name' => 'id_egms_cu',
				),			
				array(
					'type' => 'select',
					'label' => $this->l('Citys'),
					'name' => 'id_city',
					'required' => true,  
					'options' => array('query' => $this->citys,
						'id' => 'id',
						'name' => 'name')
				),
				array(
					'type' => 'select',
					'label' => $this->l('Shop URL'),
					'name' => 'id_shop_url',
					'required' => true,  
					'options' => array('query' => $this->urls,
						'id' => 'id',
						'name' => 'name'),
				),				
				array(
					'type' => 'text',
					'label' => $this->l('veryf_yandex'),
					'name' => 'veryf_yandex',
					'hint' => $this->l('veryf_yandex')
				),				
				array(
					'type' => 'text',
					'label' => $this->l('veryf_google'),
					'name' => 'veryf_google',
					'hint' => $this->l('veryf_google')
				),	
				array(
					'type' => 'text',
					'label' => $this->l('veryf_mail'),
					'name' => 'veryf_mail',
					'hint' => $this->l('veryf_mail')
				),
				array(
					'type' => 'text',
					'label' => $this->l('phone'),
					'name' => 'phone',
					'hint' => $this->l('phone')
				),		
				array(
					'type' => 'switch',
					'label' => $this->l('Is Active'),
					'name' => 'active',
					'values' => $soption,
					'default' => '1',
				),				
                array(
                    'type' => 'checkbox',
                    'label' => $this->l('Manufacturers'),
                	'multiple' => true,
                    'name' => 'manufacturer',
                	'hint' => $this->l('Manufacturers hint'),
                    'desc' => $this->l('Manufacturers'),
                    'values' => array(
		                            'query' => $this->manufacturers,
		                    		'id' => 'id',
		                    		'name' => 'name'
                					),
             		 ),																				
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'btn btn-default pull-right'
			)
		);	
		
		
       $this->tpl_form_vars = array(
            'fields_value' => $this->getFieldsValues()
       );	
		
		return parent::renderForm();
	}	
	
    public function getFieldsValues()
    {
    	$id_egms_cu = Tools::getValue('id_egms_cu');
    	$row = $this->getCityUrl(Tools::getValue('id_egms_cu'));
        $vals = array(
            'id_egms_cu' => $id_egms_cu,
        	'id_city' => $row[0]['id_city'],
        	'id_shop_url' => $row[0]['id_shop_url'],
			'veryf_yandex' => $row[0]['veryf_yandex'],
        	'veryf_google' => $row[0]['veryf_google'],
        	'veryf_mail' => $row[0]['veryf_mail'],
        	'phone' => $row[0]['phone'],
        	'active' => $row[0]['active']
        );
  
        foreach ($this->manufacturers as $i => $manufacturer)
        {
        	$vals['manufacturer_'.$manufacturer['id']]+= $this->getManufacturerByShop($id_egms_cu, $manufacturer['id']);
        }
        
        return $vals;
    }
    
    public function getManufacturerByShop($id_shop, $id_manufacturer)
    {
    	$sql = 'SELECT * FROM '._DB_PREFIX_.'egms_city_manuf WHERE id_egms_city='.(int)$id_shop.' AND id_manufacturer='.$id_manufacturer;
    	if (Db::getInstance()->getRow($sql))
    		return true;
    	else
    		return false;
    }
    
	public function getCityUrl($id_city_url)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'egms_city_url WHERE id_egms_cu='.(int)$id_city_url;
		return (Db::getInstance()->executeS($sql));
	}
		
}
