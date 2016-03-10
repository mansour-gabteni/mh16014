<?php

class Product extends ProductCore
{
	/*
	* module: pluginadder
	* date: 2016-03-10 01:11:53
	* version: 1
	*/
	public static function getProductsImgs($product_id)
    {
	$sql = '
		(SELECT * from `'._DB_PREFIX_.'image` 
		WHERE id_product="'.$product_id.'" and cover=1)
		 union
				 (SELECT * from `'._DB_PREFIX_.'image` 
		WHERE id_product="'.$product_id.'" and (cover = 0 or cover IS NULL) ORDER BY `position` LIMIT 0,1 )
		LIMIT 0,2
		';
        $result = Db::getInstance()->ExecuteS($sql);
	return $result;
    }
}



