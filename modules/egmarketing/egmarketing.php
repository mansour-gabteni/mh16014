<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egmarketing extends Module
  {
  	const INSTALL_SQL_BD1NAME = 'egcallme';	
    public function __construct()
    {
	    $this->name = 'egmarketing';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
	 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Marketing module');
	    $this->description = $this->l('Module for marketing.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	
  	public function getContent()
	{
		//$this->registerHook('displayTop');
	    //$this->registerHook('displayTopColumn');
	  	//$this->registerHook('displayProductButtons');
	  	
		//$this->registerHook('displayNav');
		//$this->registerHook('displayFooter');
	}

	public function hookDisplayProductButtons($params) 
	{
		$prod = $params['product'];
		
		$context = Context::getContext();
		$cur = Currency::getCurrencyInstance($default_country->id_currency ? (int)$default_country->id_currency : Configuration::get('PS_CURRENCY_DEFAULT'));
		
		return '<script>
	
		window.dataLayer.push({
	    "ecommerce": {
	    	"currencyCode": "'.$cur->iso_code.'",
	        "detail": {
	            "actionField": {
	                "affiliation": "'.$_SERVER['SERVER_NAME'].'"
	            },
	            "products": [{
			                    "id": "'.$prod->id.'",
			                    "name": "'.$prod->name.'",
			                    "price": "'.round($prod->price, 0, PHP_ROUND_HALF_DOWN).'",
			                    "brand": "'.$prod->manufacturer_name.'",
			                    "category": "'.$prod->category.'"/*,
			                    "variant": "размер 90-200"*/
			                }]
			        }
			    }
		});
		</script>';
	}
	
    public function hookDisplayNav($params)
    {
  		$this->smarty->assign(array(
			'ajaxcontroller' => $this->context->link->getModuleLink($this->name, 'ajax')
		));	
		
		return $this->display(__FILE__, 'top.tpl');  	
    }	
    
	public function hookDisplayTop($params)
	{
		//$this->context->controller->addCSS($this->_path.'views/css/egmultishop.css', 'all');
		$this->context->controller->addJS($this->_path.'views/js/egmarketing.js', 'all');
	}
  
	public function install($keep = true)
	{
	  if (!parent::install() ||
	    !$this->registerHook('displayNav') ||
	    !$this->registerHook('displayTop') ||
	    !$this->registerHook('displayFooter') ||
	    !$this->registerHook('displayTopColumn') ||
	  	!$this->registerHook('displayProductButtons') // ||
		//!Configuration::updateValue('EGCALLME_FIELD_LNAME', '')
		)
	    return false;
	  return true;
	}  	
	
  	public function hookDisplayTopColumn($params)
	{
		$mshop = new egmultishop();
		
		$npage = "npage"; //page for all
		
		if(egmarketing::isMarketingSite()>0)
		{
			$npage = "mpage"; //page for main cities		
		}
		
		$page = $mshop->getMultishopPage($npage);			
		
		$page = $mshop->replaceCeoWords($page);
			
		$this->smarty->assign(array(
			'page' => 	$page
		));	
		
		return $this->display(__FILE__, 'page.tpl');
	}
	
  	public function hookDisplayFooter($params)
	{
		
		$utm = Tools::getValue('utm_source');
		/*
		if (egmultishop::isMarketingSite()
			&& !$this->context->cookie->__isset('special')
			//&& !$this->context->__get('special')==""
			)
			*/
		
		if(egmultishop::isMarketingSite()
		 )
		{
			$this->context->cookie->__set('special', 'shown');
	 		$this->smarty->assign(array(
				'ajaxcontroller' => $this->context->link->getModuleLink($this->name, 'ajax')
			));
		
			return $this->display(__FILE__, 'special.tpl');
		}
				
	}	
	
  	public static function isMarketingSite()
	{
		$context = Context::getContext();
		$id_shop = $context->shop->id;
		
		$sql = 'select mu.actual
				from `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				where su.domain =\''.Tools::getHttpHost().'\'
				and su.id_shop='.(int)$id_shop;
		
		if (!$row = Db::getInstance()->executeS($sql))
			return "";
		 
		return $row[0]['actual'];
		
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
	
	}	
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || ($keep && !$this->deleteTables()) ||
	  		!$this->unregisterHook('displayNav') ||
	  		!$this->unregisterHook('displayTop') ||
	  		!$this->unregisterHook('displayFooter') ||
	  		!$this->unregisterHook('displayTopColumn') ||
			//!Configuration::deleteByName('EGCALLME_SMS_NOYIFY') ||
			!$this->unregisterHook('displayProductButtons'))
	    return false;
	  return true;
	}	
  }