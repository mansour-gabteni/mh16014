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
	
	public function delete()
	{
		Tools::generateHtaccess();
		return false;
	}	
	
	public static function getEgmsAccess($id_manufacturer = null)
	{	
		$host = Tools::getHttpHost();
		$sql = 'SELECT * FROM '._DB_PREFIX_.'shop_url su
				INNER JOIN '._DB_PREFIX_.'egms_city_url c ON c.id_shop_url = su.id_shop_url
				INNER JOIN '._DB_PREFIX_.'egms_delivery d ON d.id_egms_cu = c.id_egms_cu
				WHERE su.domain=\''.$host.'\'
				AND d.deleted = 0  
				AND su.active = 1
				AND c.active = 1
				AND d.active = 1';
		if ($id_manufacturer!=null)
			$sql.=' AND d.id_manufacturer = '.(int)$id_manufacturer;
			
		return(Db::getInstance()->executeS($sql));
			
		//return isset($row['id_shop_url']);
	}
	
  	public static function getManufacturerByShop($type_result='array')
	{
		$result = egms_shop::getEgmsAccess();
		foreach ($rows as $row)
		{
			$result[] = $row['id_manufacturer'];
		}
		
		if ($type_result == 'in')
			if (count($result))
				return ' IN ('.implode(', ', $result).')';
			else 
				return '';
		
		return $result;				
		//return array(1, 2,7);//for testing
	}  		
	
	public function update($null_values = false)
	{
		
		$this->getFieldsValues();
		$this->updateShopManuf();
		Tools::generateHtaccess();
		return parent::update($null_values);	
	}
	
	public function add($autodate = true, $null_values = false)
	{
		$this->getFieldsValues();
		$result = parent::add($autodate, $null_values);
		$this->updateShopManuf();
		Tools::generateHtaccess();
		return $result;
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
		$sql = 'UPDATE '._DB_PREFIX_.'egms_delivery
				SET
				deleted = 1
				WHERE id_egms_cu='.(int)$this->id;
		$res = Db::getInstance()->execute($sql);
		
		foreach($this->manufacturer as $manufacturer)
		{
			$sql = '';
			if(!$this->deliveryExist($this->id, $manufacturer)){
				$sql = 'INSERT INTO `'._DB_PREFIX_.'egms_delivery` (`id_egms_cu`, `id_manufacturer`,active)
                            VALUES('.(int)$this->id.', '.(int)$manufacturer.', 0)';
			} else {	
				
					$sql='	UPDATE '._DB_PREFIX_.'egms_delivery
							SET
							deleted = 0
							WHERE id_egms_cu='.(int)$this->id.'
							AND id_manufacturer='.(int)$manufacturer;
			}
			$res = Db::getInstance()->execute($sql);
		}
	}
	
	private function deliveryExist($id_egms_cu, $id_manufacturer)
	{
		$sql ='SELECT id_egms_delivery, active, deleted FROM '._DB_PREFIX_.'egms_delivery d 
				WHERE d.id_egms_cu='.(int)$id_egms_cu.'
				AND id_manufacturer='.(int)$id_manufacturer;
		
		return(Db::getInstance()->getRow($sql));
	}
	
	public static function getShopUrls($id_shop=null)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'shop_url';
		if ($id_shop != null)
			$sql.= ' WHERE id_shop='.(int)$id_shop;
			
		$sql.= ' order by id_shop, domain';
			
		return (Db::getInstance()->executeS($sql));		
		
	}
		
}