<?php
/**

 */


class egms_shop extends ObjectModel
{
	/** @var string Name */
	public $id_egms_cu;
	public $id_city;
	public $id_shop_url;
	public $veryf_yandex;
	public $veryf_google;
	public $veryf_mail;
	public $phone;
	public $active;
	public $manufacturer = array();
	
	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'egms_city_url',
		'primary' => 'id_egms_cu',
		'fields' => array(
			'id_egms_cu' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_city' => array('type' => self::TYPE_INT),
			'id_shop_url' => array('type' => self::TYPE_INT),
			'veryf_yandex' => array('type' => self::TYPE_STRING),
			'veryf_google' => array('type' => self::TYPE_STRING),
			'veryf_mail' => array('type' => self::TYPE_STRING),
			'phone' => array('type' => self::TYPE_STRING),
			'active' => array('type' => self::TYPE_BOOL),
		),
	);
	
	public static function getEgmsAccess($id_product)
	{	
		$product = new Product($id_product, true);
		$host = Tools::getHttpHost();
		$sql = 'SELECT * FROM '._DB_PREFIX_.'shop_url su
				INNER JOIN '._DB_PREFIX_.'egms_city_url c ON c.id_shop_url = su.id_shop_url
				INNER JOIN '._DB_PREFIX_.'egms_delivery d ON d.id_egms_cu = c.id_egms_cu
				WHERE su.domain=\''.$host.'\'
				AND d.id_manufacturer = '.$product->id_manufacturer.' 
				AND su.active = 1
				AND c.active = 1
				AND d.active = 1
				';
		$row = Db::getInstance()->getRow($sql);
			
		//return isset($row['id_shop_url']);
		return true;
	}
	
  	public static function getManufacturerByShop()
	{
		/*
		$sql = 'SELECT * FROM '._DB_PREFIX_.'shop_url';
		if ($id_shop != null)
			$sql.= ' WHERE id_shop='.(int)$id_shop;
			
		$sql.= ' order by id_shop';
			
		return (Db::getInstance()->executeS($sql));		
		*/
		return array(1, 2,7);
	}  		
	
	public function update($null_values = false)
	{
		
		$this->getFieldsValues();
		$this->updateShopManuf();
		return parent::update($null_values);	
	}
	
	public function add($autodate = true, $null_values = false)
	{
		$this->getFieldsValues();
		$result = parent::add($autodate, $null_values);
		$this->updateShopManuf();
		$this->addDeliveryConditions();
		return $result;
	}
	
	public function addDeliveryConditions()
	{
		$items = ManufacturerCore::getManufacturers();
		
		foreach ($items as $item)
		{
			//if (Tools::getValue('manufacturer_'.(int)$item['id_manufacturer']))
			//	$this->manufacturer[] = $item['id_manufacturer'];
		}		
	}
	
	public function getFieldsValues()
	{
		$items = ManufacturerCore::getManufacturers();
		
		foreach ($items as $item)
		{
			if (Tools::getValue('manufacturer_'.(int)$item['id_manufacturer']))
				$this->manufacturer[] = $item['id_manufacturer'];
		}
	}
	
	private function updateShopManuf()
	{	
		$sql = 'DELETE FROM `'._DB_PREFIX_.'egms_city_manuf` WHERE `id_egms_city`='.(int)$this->id;
		$res = Db::getInstance()->execute($sql);
		
		foreach($this->manufacturer as $manufacturer)
		{
			$sql = 'INSERT INTO `'._DB_PREFIX_.'egms_city_manuf` (`id_egms_city`, `id_manufacturer`)
                            VALUES('.(int)$this->id.', '.(int)$manufacturer.')';
			$res = Db::getInstance()->execute($sql);
		}
	}
	public static function getShopUrls($id_shop=null)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'shop_url';
		if ($id_shop != null)
			$sql.= ' WHERE id_shop='.(int)$id_shop;
			
		$sql.= ' order by id_shop';
			
		return (Db::getInstance()->executeS($sql));		
		
	}
		
}