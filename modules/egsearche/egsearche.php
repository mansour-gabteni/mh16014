<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egsearche extends Module
  {
  	
    public function __construct()
    {
	    $this->name = 'egsearche';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
		 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Get content products of ormatek');
	    $this->description = $this->l('Addon for copy ormatek product information.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	public function hookDisplayTop($params)
	{
		
	}
	
	public function hookDisplayFooter($params)
	{
		
		return $this->display(__FILE__, 'iqitpopup.tpl', $this->getCacheId());
		
		//return false;
	}
	

	public function install($keep = true)
	{
			
	  if (!parent::install()|| 
		!Configuration::updateValue('EGORMATEKPROD_MANUF', 0)||
		!$this->registerHook('displayBackOfficeHeader')
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
	
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || 
	  		!Configuration::deleteByName('EGORMATEKPROD_MANUF') ||
	  		($keep && !$this->deleteTables())
			)
	    return false;
	  return true;
	}		
	
  }
  
  