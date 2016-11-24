<?php

require_once(_PS_MODULE_DIR_.'egms/classes/egms_shop.php');

class AdminEGMSShopsController extends ModuleAdminControllerCore
{

	protected $position_identifier = 'id_egms_cu';
	
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
			'manufacturer' => array('title' => $this->l('manufact'), 'orderby' => false),
			'phone' => array('title' => $this->l('Phone'), 'filter_key' => 'a!phone'),
			'active' => array('title' => $this->l('Displayed'), 'filter_key' => 'su!active', 'align' => 'center', 'active' => 'status', 'class' => 'fixed-width-sm', 'type' => 'bool', 'orderby' => false)
		);	
		
		$this->_select .= 'a.id_egms_cu, s.name, c.cityname1, a.phone, su.domain, su.active, count(cm.id_manufacturer) manufacturer';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'shop_url su ON a.id_shop_url = su.id_shop_url ';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'egms_city c ON a.id_city = c.id_egms_city';
		$this->_join .= ' INNER JOIN '._DB_PREFIX_.'shop s ON su.id_shop = s.id_shop ';
		$this->_join .= ' LEFT JOIN '._DB_PREFIX_.'egms_city_manuf cm ON cm.id_egms_city = a.id_egms_cu ';
		if (Shop::getContext() == Shop::CONTEXT_SHOP)
			$this->_where .= ' and s.id_shop in ('.(int)Context::getContext()->shop->id.')';
		$this->_group = ' GROUP BY (id_egms_cu) ';
		$this->_orderBy = 'c.cityname1';
	
		$this->_theme_dir = Context::getContext()->shop->getTheme();
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
					'type' => 'text',
					'label' => $this->l('id_city'),
					'name' => 'id_city',
					'required' => true,
					'hint' => $this->l('id_city')
				),
				array(
					'type' => 'text',
					'label' => $this->l('id_shop_url'),
					'name' => 'id_shop_url',
					'required' => true,
					'hint' => $this->l('id_shop_url')
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
    	$row = $this->getCityUrl(Tools::getValue('id_egms_cu'));
        return array(
            'id_egms_cu' => Tools::getValue('id_egms_cu'),
        	'id_city' => $row[0]['id_city'],
        	'id_shop_url' => $row[0]['id_shop_url'],
			'veryf_yandex' => $row[0]['veryf_yandex'],
        	'veryf_google' => $row[0]['veryf_google'],
        	'veryf_mail' => $row[0]['veryf_mail'],
        	'phone' => $row[0]['phone'],
        	'active' => $row[0]['active']
        );
    }
	public function getCityUrl($id_city_url)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'egms_city_url WHERE id_egms_cu='.(int)$id_city_url;
		return (Db::getInstance()->executeS($sql));
	}
		
}
