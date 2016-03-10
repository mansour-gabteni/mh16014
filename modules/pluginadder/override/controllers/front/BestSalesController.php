<?php



class BestSalesController extends BestSalesControllerCore

{



	public function initContent()

	{

		if (Configuration::get('PS_DISPLAY_BEST_SELLERS'))

		{

			parent::initContent();

			

			$this->productSort();

			$nb_products = (int)ProductSale::getNbSales();

			$this->pagination($nb_products);



			if (!Tools::getValue('orderby'))

				$this->orderBy = 'sales';

			

			$products = ProductSale::getBestSales($this->context->language->id, $this->p - 1, $this->n, $this->orderBy, $this->orderWay);

			$this->addColorsToProductList($products);



			/************************* /Images Array ******************************/

					if(method_exists('Product','getProductsImgs'))

		{

			$image_array=array();

			for($i=0;$i<$nb_products;$i++)

			{	

				if(isset($products[$i]['id_product']))

					$image_array[$products[$i]['id_product']]= Product::getProductsImgs($products[$i]['id_product']);

			}

			$this->context->smarty->assign('productimg',(isset($image_array) AND $image_array) ? $image_array : NULL);

			}

			/************************* /Images Array ******************************/

			

			$this->context->smarty->assign(array(

				'products' => $products,

				'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),

				'nbProducts' => $nb_products,

				'homeSize' => Image::getSize(ImageType::getFormatedName('home')),

				'comparator_max_item' => Configuration::get('PS_COMPARATOR_MAX_ITEM')

				));

			

			$this->setTemplate(_PS_THEME_DIR_.'best-sales.tpl');

		}

		else

			Tools::redirect('index.php?controller=404');

	}







}



