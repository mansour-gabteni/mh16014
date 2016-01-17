<?php
if (!defined('_PS_VERSION_'))
  exit;
  
  class egmarketing extends Module
  {
  	const INSTALL_SQL_BD1NAME = 'egcallme';
  	public $host;	
    public function __construct()
    {
	    $this->name = 'egmarketing';
	    $this->tab = 'front_office_features';
	    $this->version = '0.1.1';
	    $this->author = 'Evgeny Grishin';
	    $this->need_instance = 0;
	    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 
	    $this->bootstrap = true;
	    $this->host = Tools::getHttpHost();
	 
	    parent::__construct();
	 
	    $this->displayName = $this->l('Marketing module');
	    $this->description = $this->l('Module for marketing.');
	 
	    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	 
  	}	
  	
  	public function getContent()
	{
		//$this->registerHook('displayTop');
	    //$this->registerHook('displayTopColumn');
	  	//$this->registerHook('displayProductButtons');
	  	
		//$this->registerHook('displayNav');
		//$this->registerHook('displayFooter');
		//$this->registerHook('header');
	}
	
	public  function hookOrderConfirmation($params)
	{
		$context = Context::getContext();
		$id_card = $context->cart->id;
		$id_order = Order::getOrderByCartId(intval($id_cart));		
		$order = $params['objOrder'];
   		$products = $order->getProducts();
   		$dl = '<script>
   		$(window).load(function() {
	window.dataLayer.push({
	    "ecommerce": {
	        "purchase": {
	            "actionField": {
	                "id" : "'.$order->id.'",
	            },
	            "products": [';
	            foreach ($products as $product)
	            {
	            	//id_manufacturer
	            	//id_category_default
	            	//product_attribute_id
	            	$price = $product['total_price'];
	            	$revenue = $price/100*20;
	            	$brand = ManufacturerCore::getNameById($product['id_manufacturer']);
	            	$name = ProductCore::getProductName($product['product_id']);
	            	$category = CategoryCore::getUrlRewriteInformations($product['id_category_default']);
	            	
	            	$variant = $this->getAttributeName($product['product_attribute_id']);
	
	               $dl.='{
	                    "id": "'.$product['product_id'].'",
	                    "name": "'.$name.'",
	                    "price": '.$price.',
	                    "brand": "'.$brand.'",
	                    "category": "'.$category[0]['link_rewrite'].'",
	                    "variant": "'.$variant.'",
	                    "revenue": '.$revenue.',
	                    "shipping": '.$order->total_shipping.'
	                }';
	            }
	            $dl.=']
	        }
	    }
	});   		
   		}); 
   		</script>';
   		
   		return $dl;
	}
	private function getAttributeName($id_product_attribute)
	{
		$id_lang = Context::getContext()->language->id;
		
		$sql = 'SELECT al.name as name
				FROM `'._DB_PREFIX_.'product_attribute_combination` pac 
				LEFT JOIN `'._DB_PREFIX_.'attribute_lang` al ON al.`id_attribute` = pac.`id_attribute`
				WHERE pac.id_product_attribute = '.$id_product_attribute.'
				and al.`id_lang` = '.(int)$id_lang.'';

		$res = Db::getInstance()->executeS($sql);
		
		return $res[0]['name'];
	}
	
	public function hookHeader()
	{
		return '';
	}
	
	public function hookDisplayProductButtons($params) 
	{
		$prod = $params['product'];
		
		$context = Context::getContext();

		$cur = Currency::getCurrencyInstance($default_country->id_currency ? (int)$default_country->id_currency : Configuration::get('PS_CURRENCY_DEFAULT'));
		
		return "<script>
	$(document).ready(function() { 
			$(window).load(function() {
				dataDisplay('".$cur->iso_code."','".$_SERVER['SERVER_NAME']."','".$prod->id."','".$prod->name."', priceWithDiscountsDisplay,'".$prod->manufacturer_name."','".$prod->category."');
			});
			$(document).on('change', '.attribute_select', function(e){
				dataDisplay('".$cur->iso_code."','".$_SERVER['SERVER_NAME']."','".$prod->id."','".$prod->name."', priceWithDiscountsDisplay,'".$prod->manufacturer_name."','".$prod->category."');
			});
			$(document).on('click', '#add_to_cart button', function(e){
				dataAdd('".$prod->id."','".$prod->name."', priceWithDiscountsDisplay,'".$prod->manufacturer_name."','".$prod->category."',1);
			});
	});
		$(document).on('click', '#oorder', function(e){
		e.preventDefault();
		var phone;
		var product;
		phone = $('#ophone').val();
		pname = $('#oname').val();
		product = $('h1[itemprop=\"name\"]').text()+\" \"+$(\"#group_1 option:selected\").text()+\" \"+$(\"#our_price_display\").text();
		
		if (pname==''||phone.length<3)
		{
			alert('������� ���� ���!');
			return false;
		}
		
		if (phone==''||phone.length<18)
		{
			alert('������� ����� ��������!');
			return false;
		}

		$('#oprod').val(product);
		
			dataAdd();
			dataPurchaseFast('F".date('YmdHi')."', '".$prod->id."', '".$prod->name."', priceWithDiscountsDisplay, '".$prod->manufacturer_name."', '".$prod->category."');
		    $.ajax({
		         type: 'POST',
		         url: egmarketing_ajaxcontroller,
		         data: $('#buy_block').serialize(),
		         success: function(data) {
		        	 $('#wdata').html(data);
		         }
		    });	
		
	});
	
		</script>";
	}
	
	public function getMainDomain()
	{
    	list($x1,$x2)=array_reverse(explode('.',$this->host));	
		return $xdomain=$x2.'.'.$x1;
	}
	
    public function hookDisplayNav($params)
    {    
		$xdomain=$this->getMainDomain();
		
		if ($xdomain == $this->host){
			if (Tools::getValue('utm_medium')=='cpr') {
				if ($this->context->cookie->__isset('rurl')) {
					$url = $this->context->cookie->__get('rurl');
					$this->context->cookie->__unset('rurl');
					Tools::redirect("http://".$url);
				}else{
					$city_q = 'show';
				}
			}
		}

		$this->context->cookie->__set('rurl', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); //
		$url = $this->context->cookie->__get('rurl');
		
    	if ($xdomain == $this->host && Tools::getValue('utm_source')=='rsy') {
    			$url = egmultishop::getCityURL($this->context->cookie->__get('yandex_region'));
    			if (!$url) {
    				$city_q = 'show';
    			}else {
    				Tools::redirect("http://".$url['url'].$_SERVER['REQUEST_URI']);
    			}
    	}
    		
  		$this->smarty->assign(array(
			'ajaxcontroller' => $this->context->link->getModuleLink($this->name, 'ajax'),
  			'city' => $city_q 
		));	
		
		return $this->display(__FILE__, 'top.tpl');  	
    }	
    
	public function hookDisplayTop($params)
	{
		//$this->context->controller->addCSS($this->_path.'views/css/egmultishop.css', 'all');
		$this->context->controller->addJS($this->_path.'views/js/egmarketing.js', 'all');
		

	}
  
	public function install($keep = true)
	{
	  if (!parent::install() ||
	    !$this->registerHook('displayNav') ||
	    !$this->registerHook('displayTop') ||
	    !$this->registerHook('displayFooter') ||
	    !$this->registerHook('displayTopColumn') ||
	  	!$this->registerHook('displayProductButtons') // ||
		//!Configuration::updateValue('EGCALLME_FIELD_LNAME', '')
		)
	    return false;
	  return true;
	}  	
	
  	public function hookDisplayTopColumn($params)
	{
		
		$mshop = new egmultishop();
		
		$npage = "npage"; //page for all
		
		if(egmarketing::isMarketingSite()>0)
		{
			$npage = "mpage"; //page for main cities		
		}
		
		$page = $mshop->getMultishopPage($npage);			
		
		$page = $mshop->replaceCeoWords($page);
			
		$this->smarty->assign(array(
			'page' => 	$page
		));	
		
		return $this->display(__FILE__, 'page.tpl');
		
	}
	
  	public function hookDisplayFooter($params)
	{
		/*
		$utm = Tools::getValue('utm_source');
		
		if (egmultishop::isMarketingSite()
			&& !$this->context->cookie->__isset('special')
			//&& !$this->context->__get('special')==""
			)
			
		
		if(egmultishop::isMarketingSite()
		 )
		{
			$this->context->cookie->__set('special', 'shown');
	 		$this->smarty->assign(array(
				'ajaxcontroller' => $this->context->link->getModuleLink($this->name, 'ajax')
			));
		
			return $this->display(__FILE__, 'special.tpl');
		}
			*/	
	}	
	
  	public static function isMarketingSite()
	{
		$context = Context::getContext();
		$id_shop = $context->shop->id;
		
		$sql = 'select mu.actual
				from `'._DB_PREFIX_.'shop_url` su
				INNER JOIN `'._DB_PREFIX_.'egmultishop_url` mu ON
					mu.`id_url`=su.`id_shop_url`
				where su.domain =\''.Tools::getHttpHost().'\'
				and su.id_shop='.(int)$id_shop;
		
		if (!$row = Db::getInstance()->executeS($sql))
			return "";
		 
		return $row[0]['actual'];
		
	}
	
  	public function reset()
	{
		if (!$this->uninstall(false))
			return false;
		if (!$this->install(false))
			return false;
		return true;
	}	
	
	public function deleteTables()
	{
	
	}	
	
	public function uninstall($keep = true)
	{
	  if (!parent::uninstall() || ($keep && !$this->deleteTables()) ||
	  		!$this->unregisterHook('displayNav') ||
	  		!$this->unregisterHook('displayTop') ||
	  		!$this->unregisterHook('displayFooter') ||
	  		!$this->unregisterHook('displayTopColumn') ||
			//!Configuration::deleteByName('EGCALLME_SMS_NOYIFY') ||
			!$this->unregisterHook('displayProductButtons'))
	    return false;
	  return true;
	}	
  }