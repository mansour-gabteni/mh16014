<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egcallme extends Module
  {
	const INSTALL_SQL_FILE = 'install.sql';
	const INSTALL_SQL_BD1NAME = 'egcallme';
	
    public function __construct()
    {
	    $this->name = 'egcallme';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
	 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Call me addon');
	    $this->description = $this->l('Addon for callback.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	
  	public function getContent()
	{
		
		//$this->unregisterHook('displayNav');
		$output = null;
		/*
		 * ƒоделать
		 * 		 * интерфейс настроек
		 * 		 * валидаци€ и настройка формы
		 * 		 * нераспознаетс€ текст в смс(кодировка)
		 * 
		 */
		//Configuration::get('EGCALLME_HEAD_PHONE')
		//Configuration::get('EGCALLME_SMS_NOYIFY')
		//Configuration::get('EGCALLME_SMS_REQUEST')
		//"http://lk.open-sms.ru/multi.php?login=matras_house1&password=sms23Atdhfkz&message=Ёто тестовое сообщение&phones=79601652555&originator=DomMatrasov"
		//Configuration::get('EGCALLME_EMAIL_NOTIFY')
		
		return $output = "configuration";
	}
	
  	public function hookHeader($params)
	{
		$this->context->controller->addJS($this->_path.'views/js/jquery.maskedinput.js', 'all');
		$this->context->controller->addJS($this->_path.'views/js/callme.js', 'all');
		$this->context->controller->addCSS($this->_path.'views/css/callme.css', 'all');
	}
	
	public function hookDisplayNav($params)
	{
		if (!Configuration::get('BLOCK_EGMULTSOP_CITY'))
		{
			$phone = Configuration::get('EGCALLME_HEAD_PHONE');
			
		}
		else 
		{
			$sql = 'SELECT mu.`phone`
				FROM `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				WHERE su.`domain` = \''.Tools::getHttpHost().'\'';

			if (!$row = Db::getInstance()->executeS($sql))
				$phone = Configuration::get('EGCALLME_HEAD_PHONE');
			else 
				$phone = $row[0]['phone'];
		}		
		
 		$this->smarty->assign(array(
			'phone' => $phone,
			'ajaxcontroller' => $this->context->link->getModuleLink('egcallme', 'ajax')
		));
	
		return $this->display(__FILE__, 'callme_nav.tpl');	
	}
	public function hookDisplayTop($params)
	{
		if (!Configuration::get('BLOCK_EGMULTSOP_CITY'))
		{
			$phone = Configuration::get('EGCALLME_HEAD_PHONE');
			
		}
		else 
		{
			$sql = 'SELECT mu.`phone`
				FROM `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				WHERE su.`domain` = \''.Tools::getHttpHost().'\'';

			if (!$row = Db::getInstance()->executeS($sql))
				$phone = Configuration::get('EGCALLME_HEAD_PHONE');
			else 
				$phone = $row[0]['phone'];
		}

 		$this->smarty->assign(array(
			'phone' => $phone,
			'ajaxcontroller' => $this->context->link->getModuleLink('egcallme', 'ajax')
		));
	
		return $this->display(__FILE__, 'callme.tpl');		
	}
	
  	public function hookDisplayLeftColumn($params)
	{		
		
		return $this->hookDisplayTop($params);	
	}

	public function hookDisplayRightColumn($params)
	{
		
		return $this->hookDisplayTop($params);	
	}	

	public function install($keep = true)
	{
		if ($keep)
			{
				if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
					return false;
				else if (!$sql = file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
					return false;
				$sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB1NAME'), array(_DB_PREFIX_, _MYSQL_ENGINE_, INSTALL_SQL_BD1NAME), $sql);
				$sql = preg_split("/;\s*[\r\n]+/", trim($sql));
	
				foreach ($sql as $query)
					if (!Db::getInstance()->execute(trim($query)))
						return false;
	
			}
			
	  if (!parent::install() ||
	  	!$this->registerHook('displayTop') ||
	  	!$this->registerHook('displayNav') ||
		!$this->registerHook('header') ||
		!Configuration::updateValue('EGCALLME_SMS_NOYIFY', 0)||
		!Configuration::updateValue('EGCALLME_HEAD_PHONE', '')||
		!Configuration::updateValue('EGCALLME_EMAIL_NOTIFY', '')||
		!Configuration::updateValue('EGCALLME_SMS_REQUEST', '')||
		!Configuration::updateValue('EGCALLME_FIELD_FNAME', '')||
		!Configuration::updateValue('EGCALLME_FIELD_LNAME', '')
		)
	    return false;
	  return true;
	}  	
	
  	public function reset()
	{
		if (!$this->uninstall(false))
			return false;
		if (!$this->install(false))
			return false;
		return true;
	}	
	
	public function deleteTables()
	{
		return Db::getInstance()->execute('
			DROP TABLE IF EXISTS
			`'._DB_PREFIX_.INSTALL_SQL_BD1NAME.'`');
	}	
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || ($keep && !$this->deleteTables()) ||
			!Configuration::deleteByName('EGCALLME_SMS_NOYIFY') ||
			!Configuration::deleteByName('EGCALLME_HEAD_PHONE') ||
			!Configuration::deleteByName('EGCALLME_EMAIL_NOTIFY')||
			!Configuration::deleteByName('EGCALLME_SMS_REQUEST')||
			!Configuration::deleteByName('EGCALLME_FIELD_FNAME')||			
			!Configuration::deleteByName('EGCALLME_FIELD_LNAME') ||
			!$this->unregisterHook('displayTop') ||
			!$this->unregisterHook('displayNav') ||
			!$this->unregisterHook('header'))
	    return false;
	  return true;
	}		
  	
  }