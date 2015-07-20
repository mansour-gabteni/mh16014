<?php

class egmultishopdeliveryModuleFrontController extends ModuleFrontController
{

	public function initContent()
	{
		parent::initContent();

		$egmultishop = new egmultishop();
		
		$context = Context::getContext();
		
		$id_url = egmultishop::getUrlId($context->shop->id);
 
		$this->context->smarty->assign(array(
			'page' => $egmultishop->getMultishopPage('deliverycondition',$id_url)
		));	
		
		$this->setTemplate('delivery.tpl');
				
		/*
		$egmultishop = new egmultishop();
		
		$egmultishop->getMultishopDateById();
 
		$this->context->smarty->assign(array(
			'delivery' => (string)$egmultishop->getRow(0,'delivery'),
			'city_name' => (string)$egmultishop->getRow(0,'city_name')
		));	
		
		$this->setTemplate('delivery.tpl');
		*/
	}


}


?>