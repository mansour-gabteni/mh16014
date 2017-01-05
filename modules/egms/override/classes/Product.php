<?php

require_once(_PS_MODULE_DIR_.'egms/classes/egms_shop.php');



class Product extends ProductCore

{

	public static function checkAccessStatic($id_product, $id_customer)
	{
		if(!egms_shop::getEgmsAccess($id_product))

			return false;

		return parent::checkAccessStatic($id_product, $id_customer);
	}	
}







