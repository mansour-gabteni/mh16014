<?php

class egmultishopshipselfModuleFrontController extends ModuleFrontController
{

	public function initContent()
	{
		parent::initContent();

				$egmultishop = new egmultishop();
		
		$context = Context::getContext();
		
		$id_url = egmultishop::getUrlId($context->shop->id);
 
		$this->context->smarty->assign(array(
			'page' => $egmultishop->getMultishopPage('shipself')
		));	
		
		$this->setTemplate('shipself.tpl');
		
		/*
		$egmultishop = new egmultishop();
		
		$egmultishop->getMultishopDateById();
 
		$this->context->smarty->assign(array(
			'selfout' => (string)$egmultishop->getRow(0,'selfout'),
			'city_name' => (string)$egmultishop->getRow(0,'city_name')
		));	
		
		$this->setTemplate('shipself.tpl');
		*/
	}


}

?>