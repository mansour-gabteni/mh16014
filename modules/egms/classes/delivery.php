<?php
/**

 */



class delivery extends ObjectModel
{
	/** @var string Name */
	public $id_egms_delivery;
	public $id_egms_cu;
	public $id_manufacturer;
	public $del_pay;
	public $free_pay;
	public $dlex;
	public $carriers;
	public $payments;
	public $address;
	public $chema;	
	
	/**
	 * @see ObjectModel::$definition
	 */
	//TODO: add check fot length of fields
	public static $definition = array(
		'table' => 'egms_delivery',
		'primary' => 'id_egms_delivery',
		'fields' => array(
			'id_egms_delivery' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_egms_cu' => array('type' => self::TYPE_INT, 'required' => true),
			'id_manufacturer' => array('type' => self::TYPE_INT, 'required' => true),
			'del_pay' => array('type' => self::TYPE_INT),
			'free_pay' => array('type' => self::TYPE_INT),
			'dlex' => array('type' => self::TYPE_STRING),
			'carriers' => array('type' => self::TYPE_STRING),
			'payments' => array('type' => self::TYPE_STRING),	
			'address' => array('type' => self::TYPE_STRING),
			'chema' => array('type' => self::TYPE_STRING),
		),
	);

	public static function getShops()
	{
		$sql = 'SELECT id_egms_cu, c.cityname1, su.domain, s.name FROM '._DB_PREFIX_.'egms_city_url cu
				INNER JOIN '._DB_PREFIX_.'egms_city c on c.id_egms_city = cu.id_city
				INNER JOIN '._DB_PREFIX_.'shop_url su ON cu.id_shop_url = su.id_shop_url
				INNER JOIN '._DB_PREFIX_.'shop s ON su.id_shop = s.id_shop ';
		$sql.= ' ';
			
		return (Db::getInstance()->executeS($sql));
	}	
	
}