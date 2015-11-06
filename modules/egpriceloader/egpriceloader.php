<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egpriceloader extends Module
  {
	
  	const INSTALL_SQL_FILE = 'install.sql';
	const INSTALL_SQL_BD2NAME = 'egormprod_data2';
	const INSTALL_SQL_BDNAME = 'gb_load';
	const OPRICE = "http://ormatek.com/sitemap_iblock_21.xml";
  	
    public function __construct()
    {
	    $this->name = 'egpriceloader';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
	 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Load price from site');
	    $this->description = $this->l('Addon for copy ormatek product information.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	
  	public function getContent()
	{
		$output = null;

			
		
		$output = '<div class="row">
		<div class="panel panel-default">
		  <div class="panel-heading">'.$this->l('panel price update').'</div>
		  <div class="panel-body">
		    <button type="button" id="update" class="btn btn-primary">'.$this->l('proccess').'</button>
			<div class="checkbox">
			  <label><input type="checkbox" id="uc">'.$this->l('load new content').'</label>
			</div>
			<div class="checkbox">
			  <label><input type="checkbox" id="up">'.$this->l('update price').'</label>
			</div>	
			<div class="checkbox">
			  <label><input type="checkbox" id="comment">'.$this->l('update comment').'</label>
			</div>	
			<div class="checkbox">
			  <label><input type="checkbox" id="upname">'.$this->l('update product name').'</label>
			</div>			
		  </div>
		</div>
		</div>
		  <div class="row">
		<table class="table table-striped table-hover table-bordered" id="main_table">
		<thead>
		 <tr>
		 <th>-</th>
		 <th>ID</th>
		 <th>URL</th>
		 <th>product name db</th>
		 <th>product_attrgroup</th>
		 <th>price_discount</th>
		 <th>discount db</th>
		 <th>actions</th>
		 </tr>
		 </thead>
		 <tbody></tbody>
		</table>
		</div>';
		
		return $output;		
	}
	
    public function hookDisplayBackOfficeHeader()
	{
		if (Tools::getValue('configure') != $this->name)
			return;
			
		$this->context->controller->addJS($this->_path.'/views/js/admin.js');
		return '<script>
				var admin_priceloader_ajax_url = \''.$this->context->link->getAdminLink("AdminAjaxPriceloader").'\';
			</script>';
	}
		
   	public function createAjaxController()
	{
		$tab = new Tab();
		$tab->active = 1;
		$languages = Language::getLanguages(false);
		if (is_array($languages))
			foreach ($languages as $language)
				$tab->name[$language['id_lang']] = 'ajax controller';
		$tab->class_name = 'AdminAjaxPriceloader';
		$tab->module = $this->name;
		$tab->id_parent = - 1;
		return (bool)$tab->add();
	}
	
	public function install($keep = true)
	{
		if ($keep)
		{
			if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
				return false;
			else if (!$sql = file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
				return false;
			$sql = str_replace(array('PREFIX_', 'ENGINE_TYPE', 'DB1NAME'), array(_DB_PREFIX_, _MYSQL_ENGINE_, self::INSTALL_SQL_BD2NAME), $sql);
			$sql = preg_split("/;\s*[\r\n]+/", trim($sql));
	
			foreach ($sql as $query)
				if (!Db::getInstance()->execute(trim($query)))
					return false;
	
		}		
		
		if (!parent::install()|| 
		!$this->createAjaxController()||
		!$this->registerHook('displayBackOfficeHeader')
		)
	    return false;
	  return true;
	}
	
	public function deleteTables()
	{
		return Db::getInstance()->execute('
			DROP TABLE IF EXISTS
			`'._DB_PREFIX_.self::INSTALL_SQL_BD2NAME.'`');
	}		
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || 
	  		($keep && !$this->deleteTables())
			)
	    return false;
	  return true;
	}		
  }

  ?>