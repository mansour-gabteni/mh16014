<?php


class egcallmeajaxModuleFrontController extends ModuleFrontController
{

	public function initContent()
	{
	
		parent::initContent();

		$action = Tools::getValue('action');
		
		if (!$action)
			$view = 'form';
		else 
		{	
			if ($action == "oneworder")
			{
				$this->oorder();
				$view = 'thanks';
			}
			if ($action == "new")
			{
				$this->callBack();
				$view = 'mess';
			}
		}
		
		
		$this->context->smarty->assign(array(
					'host'	=> Tools::getHttpHost(),
					'ajaxcontroller' => $this->context->link->getModuleLink('egcallme', 'ajax'),
					'view' =>	$view
				)); 

		$this->smartyOutputContent($this->getTemplatePath('ajax.tpl'));
		
	}
	
	public function oorder()
	{
		$phone = Tools::getValue('ophone', '-');
		$name = Tools::getValue('oname', '-');
		$message = Tools::getValue('oprod', 'NaN');
		
		$this->newMessage("FastOrder", $phone, $name, $message, "smscallme_order");
		// если города основные
		if(egmultishop::isMarketingSite())
		{
		// посылаем смс мпаибо за заказ

	    $sms_message = "Заказ %message принят! ожидайте звонка. %host";
		$sms_message = Meta::sprintf2($sms_message, array(
				'host' => $host,
				'type' => $type,
				'phone' => $phone,
				'cname' => $cname,
				'message' => $message
				));		
		
		$this->sendSMS($sms_message,$phone);
		
		}
	}
	
	public function callBack()
	{
		$phone = Tools::getValue('phone', '-');
		$message = Tools::getValue('message', '-');
				
		$this->newMessage("CallBack", $phone, "", $message, "smscallme_notify");
		
		// если города основные
		if(egmultishop::isMarketingSite())
		{
		// посылаем смс мпаибо за заказ
		$host = Tools::getHttpHost();
	    $sms_message = "Обращение принято! Ожидайте звонка.";//Узнайте о предложениях %host/alcii";
		$sms_message = Meta::sprintf2($sms_message, array(
				'host' => $host,
				'type' => $type,
				'phone' => $phone,
				'cname' => $cname,
				'message' => $message
				));		
		
		$this->sendSMS($sms_message,$phone);
		
		}
	}

	private function newMessage($type, $phone, $cname, $message,$email_theme)
	{

		$host = Tools::getHttpHost();
		$phone = "+".preg_replace('#\D+#', '', $phone);
		// insert to DB
		$query = "insert into "._DB_PREFIX_.egcallme::INSTALL_SQL_BD1NAME." 
		(`type`,`host`, `phone`, `cname`, `message`, `processed`) 
		values ('".$type."','".$host."', '".$phone."',
			'".$cname."', '".$message."', 'false')";
		Db::getInstance()->execute(trim($query));
		
		// notify by email
		$email_param = Configuration::get('EGCALLME_EMAIL_NOTIFY');
		if (trim($email_param)!="")
		{
			$context = Context::getContext();
			
			$param = array(
				'{phone}'	=> $phone,
			 	'{message}'	=> $message,
				'{fname}'	=> $cname,
				'{shop_url}'	=> $host
			);
			
			$emails = explode(';', $email_param);
			
			foreach ($emails as $email)
			{
				Mail::Send(
					(int)$context->language->id,
					$email_theme,
					Mail::l($type, " ".$phone." ".$host),
					$param,
					$email,
					$cname,
					null,
					null,
					null,
					null,
					_PS_MAIL_DIR_,
					false,
					(int)$context->shop->id
				);
			}
		}

		// sms notification
		
		
		$sms_message = "%type %host %phone %cname %message";
		$sms_message = Meta::sprintf2($sms_message, array(
				'host' => $host,
				'type' => $type,
				'phone' => $phone,
				'cname' => $cname,
				'message' => $message
				));		
		
		$this->sendSMS($sms_message,"79601652555");

	}
	
	private function sendSMS($message, $phone)
	{
		$sms = Configuration::get('EGCALLME_SMS_REQUEST');
		$phone = preg_replace('#\D+#', '', $phone);
		$sms = Meta::sprintf2($sms, array(
					'sendto' => $phone,
					'message' => substr($message, 0, 70)
				));
					
		if(trim($sms)!="" && (bool)Configuration::get('EGCALLME_SMS_NOYIFY') )
		{		
			if (!substr_count($_SERVER['DOCUMENT_ROOT'], "home/matras-house.ru/www"))
			{			
				$result = file_get_contents($sms);
			}
		}
	}
}


?>