<?php


class egmultishopcitysModuleFrontController extends ModuleFrontController
{

	public function initContent()
	{
	
		parent::initContent();

		$this->ajax = true;	
		
		$sql = 'SELECT su.`id_shop_url` as id, su.`domain`, 
				mu.`city_name`, s.`name` as shop_name
				FROM `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'shop` s ON
					s.`id_shop`=su.`id_shop`
				INNER JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				WHERE su.id_shop IN ('.implode(', ', Shop::getContextListShopID()).') 
				and su.`main`= 0
				and su.`active` = 1
				order by 3';

		if (!$citys = Db::getInstance()->executeS($sql))
			return false;
		
		$this->context->smarty->assign(array(
					'citys' => $citys,
					'host'	=> Tools::getHttpHost()
				));
		
		$this->smartyOutputContent($this->getTemplatePath('citys.tpl'));

	}


}


?>