<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egcachemake extends Module
  {

	
    public function __construct()
    {
	    $this->name = 'egcachemake';
	    $this->tab = 'administration';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
	 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Cache maker');
	    $this->description = $this->l('Cache maker addons.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	
  	public function getContent()
	{
		$output = null;
		
		$output.=$this->renderList();
		
		
		return $output;
	}
	
  	public function renderList()
	{
					
		$fields_list = array(
			'id' => array(
				'title' => $this->l('Link ID'),
				'type' => 'text',
			),
			'shop_name' => array(
				'title' => $this->l('Shop'),
				'type' => 'text',
			),			
			'city_name' => array(
				'title' => $this->l('City'),
				'type' => 'text',
			),
			'domain' => array(
				'title' => $this->l('URL'),
				'type' => 'text',
			),	
			'processed' => array(
				'title' => $this->l('processed'),
				'type' => 'bool',
			),							
		);
		
		$helper = new HelperList();
		$helper->shopLinkType = '';
		$helper->simple_header = true;
		$helper->identifier = 'id';
		//$helper->actions = array('edit', 'delete');
		$helper->show_toolbar = false;

		$helper->title = $this->l('Link list');
		$helper->table = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$links = $this->getLinks();
		if (is_array($links) && count($links))
			return $helper->generateList($links,  $fields_list);
		else
			return false;
	}	

	public function getLinks()
	{

		$sql = 'SELECT su.`id_shop_url` as id, su.`domain`, 
				mu.`city_name`, s.`name` as shop_name,
				0 as processed
				FROM `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'shop` s ON
					s.`id_shop`=su.`id_shop`
				LEFT JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				WHERE su.id_shop IN ('.implode(', ', Shop::getContextListShopID()).') ';
		
		if (!$links = Db::getInstance()->executeS($sql))
			return false;
			/*		
			foreach ($links as $link)
			{
				$http = "http://".$link['domain'];
				file_get_contents($http);
			}
			*/
		return $links;
	}		
  	
  }