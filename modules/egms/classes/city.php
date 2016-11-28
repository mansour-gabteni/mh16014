<?php
/**

 */



class city extends ObjectModel
{
	/** @var string Name */
	public $id_egms_city;
	public $cityname1;
	public $cityname2;
	public $cityname3;
	public $psyname;
	public $alias;
	
	/**
	 * @see ObjectModel::$definition
	 */
	//TODO: add check fot length of fields
	public static $definition = array(
		'table' => 'egms_city',
		'primary' => 'id_egms_city',
		'fields' => array(
			'id_egms_city' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'cityname1' => array('type' => self::TYPE_STRING, 'required' => true),
			'cityname2' => array('type' => self::TYPE_STRING, 'required' => true),
			'cityname3' => array('type' => self::TYPE_STRING, 'required' => true),
			'psyname' => array('type' => self::TYPE_STRING),
			'alias' => array('type' => self::TYPE_STRING),
		),
	);
/*
	public function add($autodate = true, $null_values = false)
	{

		return parent::add($autodate, $null_values);
	}
*/
	public function delete()
	{
		//TODO: add restriction deletting if  city linked in any
		//return false;
	}
	
	public static function getCity($id_city=null)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'egms_city';
		if ($id_city != null)
			$sql.= ' WHERE id_egms_city='.(int)$id_city;
			
		return (Db::getInstance()->executeS($sql));
	}    	
	
}