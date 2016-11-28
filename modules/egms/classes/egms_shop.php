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
	//public $manufacturer_1;
	
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