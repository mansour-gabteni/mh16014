<?php



class CategoryController extends CategoryControllerCore

{



/*
	* module: pluginadder
	* date: 2016-03-10 01:11:53
	* version: 1
	*/
	public function initContent()

	{

		parent::initContent();

		

		if(method_exists('Product','getProductsImgs'))
		{
		$image_array=array();
		for($i=0;$i<count($this->cat_products);$i++)
		{
			if(isset($this->cat_products[$i]['id_product']))
				$image_array[$this->cat_products[$i]['id_product']]= Product::getProductsImgs($this->cat_products[$i]['id_product']);
		}
		$this->context->smarty->assign('productimg',(isset($image_array) AND $image_array) ? $image_array : NULL);
		}
		

		

	}





}



