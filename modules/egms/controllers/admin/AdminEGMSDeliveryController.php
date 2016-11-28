<?php

require_once(_PS_MODULE_DIR_.'egms/classes/delivery.php');

class AdminEGMSDeliveryController extends ModuleAdminController
{

	protected $position_identifier = 'id_egms_delivery';
	protected $manufacturers;
	protected $shops;
	
	public function __construct()
	{
		parent::__construct();
		$this->bootstrap = true;
		$this->table = 'egms_delivery';
		$this->list_id = $this->position_identifier;
		$this->identifier = $this->position_identifier;	
		$this->className = 'delivery';	
		$this->meta_title = $this->l('Delivery by manyfacturer');
		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?'), 'icon' => 'icon-trash'));
		$this->fields_list = array(
			'id_'.$this->table => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'class' => 'fixed-width-xs'
			),
			'id_egms_delivery' => array('title' => $this->l('id'), 'filter_key' => 'id_egms_delivery'),	
			//'cityname1' => array('title' => $this->l('Cityname'), 'filter_key' => 'cityname1'),
			//'cityname2' => array('title' => $this->l('Cityname'), 'filter_key' => 'cityname2'),
			//'cityname3' => array('title' => $this->l('Cityname'), 'filter_key' => 'cityname3'),
			//'alias' => array('title' => $this->l('alias'), 'filter_key' => 'a!alias'),
		);	
		
		$this->_orderBy = 'a.id_egms_delivery';
	
		$this->_theme_dir = Context::getContext()->shop->getTheme();
		$this->getManufacturers();
		$this->getShops();
	}
	
	private function getManufacturers()
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

	private function getShops()
	{
		$shops = delivery::getShops();
		foreach ($shops as $shop)
		{
			$this->shops[] = array('id' => $shop['id_egms_cu'], 'name' => $shop['name'].' - '.$shop['cityname1'].' - '.$shop['domain']);
		}		
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
		
		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend' => array(
				'title' => $this->l('Delivery by manufacturer'),
				'icon' => 'icon-folder-close'
			),
			'input' => array(
				array(
					'type' => 'hidden',
					'label' => $this->l('id'),
					'name' => 'id_egms_delivery',
				),
				array(
					'type' => 'select',
					'label' => $this->l('Shop'),
					'name' => 'id_egms_cu',
					'required' => true,  
					'options' => array('query' => $this->shops,
						'id' => 'id',
						'name' => 'name')
				),
				array(
					'type' => 'select',
					'label' => $this->l('Manufacturer'),
					'name' => 'id_manufacturer',
					'required' => true,  
					'options' => array('query' => $this->manufacturers,
						'id' => 'id',
						'name' => 'name')
				),	
				array(
					'type' => 'text',
					'label' => $this->l('dlex'),
					'name' => 'dlex',
					'hint' => $this->l('dlex')
				),															
				array(
					'type' => 'text',
					'label' => $this->l('carriers'),
					'name' => 'carriers',
					'hint' => $this->l('carriers')
				),		
				array(
					'type' => 'text',
					'label' => $this->l('payments'),
					'name' => 'payments',
					'hint' => $this->l('payments')
				),	
				array(
					'type' => 'text',
					'label' => $this->l('address'),
					'name' => 'address',
					'hint' => $this->l('address')
				),	
				array(
					'type' => 'text',
					'label' => $this->l('chema'),
					'name' => 'chema',
					'hint' => $this->l('chema')
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
    	/*
    	$id_egms_city = Tools::getValue('id_egms_city');
    	if ($id_egms_city!=false)
    		$row = city::getCity($id_egms_city);
        return array(
            'id_egms_city' => $id_egms_city,
        	'cityname1' => $row[0]['cityname1'],
        	'cityname2' => $row[0]['cityname2'],
			'cityname3' => $row[0]['cityname3'],
        	'psyname' => $row[0]['psyname'],
        	'alias' => $row[0]['alias']
        );
        */
    }
 	
	
}
