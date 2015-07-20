<?php

if (!defined('_PS_VERSION_'))
  exit;
  
class egfrontsearch extends Module
{

  public function __construct()
  {
    $this->name = 'egfrontsearch';
    $this->tab = 'front_office_features';
    $this->version = '0.1.1';
    $this->author = 'Evgeny Grishin';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
    $this->bootstrap = true;

    //$this->registerHook('header');
    
    parent::__construct();
 
    $this->displayName = $this->l('Front search');
    $this->description = $this->l('Search on a home page.');
 
    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
  }

	public function hookDisplayTopColumn($params)
	{
		return $this->display(__FILE__, 'egfrontsearch_home.tpl');
	}
	

}
?>