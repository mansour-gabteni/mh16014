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
	
	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'egms_city_url',
		'primary' => 'id_egms_cu',
		'fields' => array(
			'id_egms_cu' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'id_city' => array('type' => self::TYPE_INT, 'required' => true),
			'id_shop_url' => array('type' => self::TYPE_INT, 'required' => true),
			'veryf_yandex' => array('type' => self::TYPE_STRING),
			'veryf_google' => array('type' => self::TYPE_STRING),
			'veryf_mail' => array('type' => self::TYPE_STRING),
			'phone' => array('type' => self::TYPE_STRING),
			'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
		),
	);
/*	
	public function add($autodate = true, $null_values = false)
	{

		return parent::add($autodate, $null_values);
	}
	*/	
}