<?php

class egmultishopshipselfModuleFrontController extends ModuleFrontController
{

	public function initContent()
	{
		parent::initContent();

				$egmultishop = new egmultishop();
		
		$context = Context::getContext();
		
		$id_url = egmultishop::getUrlId($context->shop->id);
		
		$page = $egmultishop->getMultishopPage('shipself',$id_url);
		if ($page =="")
		{
			$page = $egmultishop->getMultishopPage('shipself_df');
		}	

		$page = $egmultishop->replaceCeoContact($page);
		
		$add2 = $egmultishop->replaceCeoContact('%chema');
 
		$this->context->smarty->assign(array(
			'page' => $page,
			'addr2' => $add2
		));	
		
		$this->setTemplate('shipself.tpl');
		

	}


}

?>