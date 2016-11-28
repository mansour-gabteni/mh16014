<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class ShopUrl extends ShopUrlCore
{

	public static function cacheMainDomainForShop($id_shop)
	{
		if (!isset(self::$main_domain_ssl[(int)$id_shop]) || !isset(self::$main_domain[(int)$id_shop]))
		{
			$host = Tools::getHttpHost();
			$row = Db::getInstance()->getRow('
			SELECT domain, domain_ssl
			FROM '._DB_PREFIX_.'shop_url
			WHERE domain = "'.$host.'"
			AND id_shop = '.($id_shop !== null ? (int)$id_shop : (int)Context::getContext()->shop->id));
			self::$main_domain[(int)$id_shop] = $row['domain'];
			self::$main_domain_ssl[(int)$id_shop] = $row['domain_ssl'];
		}
	}

}