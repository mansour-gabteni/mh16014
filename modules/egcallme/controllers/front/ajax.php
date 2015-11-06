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
				$this->newMessage();
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
		
	}

	public function newMessage()
	{
		$phone = Tools::getValue('phone', '-');
		$message = Tools::getValue('message', '-');
		$fname = Tools::getValue('fname', '-');
		$lname = Tools::getValue('lname', '-');
		$host = Tools::getHttpHost();
		// insert to DB
		$query = "insert into "._DB_PREFIX_.egcallme::INSTALL_SQL_BD1NAME." 
		(`host`, `phone`, `fname`, `lname`, `message`, `processed`) 
		values ('".$host."', '".$phone."',
			'".$fname."', '".$lname."', '".$message."', 'false')";
		Db::getInstance()->execute(trim($query));
		
		// notify by email
		
		$email_param = Configuration::get('EGCALLME_EMAIL_NOTIFY');
		if (trim($email_param)!="")
		{
			$context = Context::getContext();
			
			$param = array(
				'{phone}'	=> $phone,
			 	'{message}'	=> $message,
				'{fname}'	=> $fname,
				'{lname}'	=> $lname,
				'{shop_url}'	=> $host
			);
			
			$emails = explode(';', $email_param);
			
			foreach ($emails as $email)
			{
				Mail::Send(
					(int)$context->language->id,
					'smscallme_notify',
					Mail::l('call back', " ".$phone." ".$host),
					$param,
					$email,
					$fname.' '.$lname,
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
		// notify by sms
		
		$sms = Configuration::get('EGCALLME_SMS_REQUEST');
		
		
		if(trim($sms)!="" && (bool)Configuration::get('EGCALLME_SMS_NOYIFY') )
		{		
			$sms = Meta::sprintf2($sms, array(
					'host' => $host,
					'phone' => $phone,
					'message' => substr($message, 0, 20)
					));

			if ($_SERVER['DOCUMENT_ROOT']!='T:/home/matras-house.ru/www')
				$result = file_get_contents($sms);
		}
		
	}

}


?>