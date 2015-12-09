
CREATE TABLE IF NOT EXISTS `PREFIX_DB1NAME` (
  `product_url` varchar(250) NOT NULL,
  `content` longtext,
  `product_name` varchar(100) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `shop_product_name` varchar(100) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_url`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8;
