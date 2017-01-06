<?php
/**
 * Enter description here ...
 * 
 */
if (!defined('_PS_VERSION_'))
  exit;
  
  class egms extends Module
  {
    const INSTALL_SQL_FILE = 'install.sql';
    const INSTALL_SQL_BD3NAME = 'egms_city';
    const INSTALL_SQL_BD1NAME = 'egms_city_url';
	const INSTALL_SQL_BD4NAME = 'egms_delivery';    

    protected $tabs = array(
    		array('name' => 'Multishop config', 'class_name' => 'AdminEGMSShops'),
    		array('name' => 'Shops by Citys', 'class_name' => 'AdminEGMSShops'),
    		array('name' => 'Delivery by Manufacturer', 'class_name' => 'AdminEGMSDelivery'),
    		array('name' => 'Citys', 'class_name' => 'AdminEGMSCitys'),
    );  	
  	
    public function __construct()
    {
	    $this->name = 'egms';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
		 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Super multishop module');
	    $this->description = $this->l('Super multishop module.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
  	}
  	

  	
	public function hookHeader($params)
	{		
		//$this->context->controller->addCSS($this->_path.'views/css/egmultishop.css', 'all');
	}
		  	
  	public function hookDisplayTop($params)
	{
		//return $this->display(__FILE__, 'mess.tpl', $this->getCacheId());
	}

  	public function hookDisplayFooter($params)
	{
		
		//return $this->display(__FILE__, 'popup.tpl', $this->getCacheId());
		
		//return false;
	}

  	public function installAdminTab()
	{
		$retval = true;
		$id_parent = 0;
		foreach ($this->tabs as $key => $ctab)
		{
			$tab = new Tab();
			$tab->active = 1;
			$languages = Language::getLanguages(true);
			if (is_array($languages))
				foreach ($languages as $language)
					$tab->name[$language['id_lang']] = $ctab['name'];
			$tab->class_name = $ctab['class_name'];
			$tab->module = $this->name;
			$tab->id_parent = $id_parent;
			$retval = (bool)$tab->add();
			if ($key==0)
				$id_parent = $tab->id;
		}
		return $retval;
	}  
		
	public static function uninstallAdminTab()
	{
		$retval = true;
		$tabs = new egms();
		foreach ($tabs->tabs as $ctab)
		{
			$idTab = Tab::getIdFromClassName($ctab['class_name']);
			if ($idTab != 0)
			{
				$tab = new Tab($idTab);
				$tab->delete();
				$retval = true;
			}
		}
		return $retval;
	}			

	public function install($keep = true)
	{
	   if ($keep) {
            if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
                return false;
            } elseif (!$sql = Tools::file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE)) {
                return false;
            }
            $sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB1NAME'),
                array(_DB_PREFIX_, _MYSQL_ENGINE_, self::INSTALL_SQL_BD1NAME), $sql);
            $sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB2NAME'),
                array(_DB_PREFIX_, _MYSQL_ENGINE_, self::INSTALL_SQL_BD2NAME), $sql);
            $sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB3NAME'),
                array(_DB_PREFIX_, _MYSQL_ENGINE_, self::INSTALL_SQL_BD3NAME), $sql);  
			$sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB4NAME'),
                array(_DB_PREFIX_, _MYSQL_ENGINE_, self::INSTALL_SQL_BD4NAME), $sql);                                               
            $sql = preg_split("/;\s*[\r\n]+/", trim($sql));

            foreach ($sql as $query) {
                if (!Db::getInstance()->execute(trim($query))) {
                    return false;
                }
            }

        }		
			
	  if (!parent::install()|| 
		//!Configuration::updateValue('EGAMERICA_', 0)||
		//!$this->registerHook('displayBackOfficeHeader')||
		//!$this->registerHook('displayTop')||
		!$this->installAdminTab()||
		!$this->registerHook('displayFooter')
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
    	$sql = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.self::INSTALL_SQL_BD1NAME.'`;';
    	$sql .= 'DROP TABLE IF EXISTS `'._DB_PREFIX_.self::INSTALL_SQL_BD2NAME.'`;';
    	$sql .= 'DROP TABLE IF EXISTS `'._DB_PREFIX_.self::INSTALL_SQL_BD3NAME.'`;';
    	$sql .= 'DROP TABLE IF EXISTS `'._DB_PREFIX_.self::INSTALL_SQL_BD4NAME.'`;';
    	
        //return Db::getInstance()->execute($sql);
    }
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || 
	  		//!Configuration::deleteByName('EGAMERICA_') ||
	  		//!$this->unregisterHook('displayFooter')||
	  		!$this->uninstallAdminTab()||
	  		($keep && !$this->deleteTables())
			)
	    return false;
	  return true;
	}		
	
  }
  
  