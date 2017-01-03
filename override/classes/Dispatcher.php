<?php
/**
* Module is prohibited to sales! Violation of this condition leads to the deprivation of the license!
*
* @category  Front Office Features
* @package   Yandex Payment Solution
* @author    Yandex.Money <cms@yamoney.ru>
* @copyright © 2015 NBCO Yandex.Money LLC
* @license   https:*/

class Dispatcher extends DispatcherCore
{
    /*
	* module: yamodule
	* date: 2016-12-09 05:18:38
	* version: 1.3.9
	*/
	protected function setRequestUri()
    {
        parent::setRequestUri();
        if (Module::isInstalled('yamodule') && strpos($this->request_uri, 'module/yamodule/')) {
            $this->request_uri = iconv('windows-1251', 'UTF-8', $this->request_uri);
        }
    }
}
