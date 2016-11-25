CREATE TABLE IF NOT EXISTS `PREFIX_DB1NAME` (
	`id_egms_cu` int(11) NOT NULL AUTO_INCREMENT,
	`id_city` int(11) NOT NULL,
	`id_shop_url` int(11) NOT NULL,
	`veryf_yandex` varchar(20) NOT NULL,
	`veryf_google` varchar(50) NOT NULL,
	`veryf_mail` varchar(40) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`active` tinyint(1) NOT NULL,
	PRIMARY KEY (`id_egms_cu`),
	UNIQUE KEY `id_shop_url` (`id_shop_url`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


CREATE TABLE IF NOT EXISTS `PREFIX_DB2NAME` (
	`id_egms_city` int(11) NOT NULL,
	`id_manufacturer` int(1) NOT NULL,
	UNIQUE KEY `id_egms_city` (`id_egms_city`,`id_manufacturer`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `PREFIX_DB3NAME` (
	`id_egms_city` int(11) NOT NULL AUTO_INCREMENT,
	`cityname1` varchar(30) NOT NULL,
	`cityname2` varchar(30) NOT NULL,
	`cityname3` varchar(30) NOT NULL,
	`psyname` varchar(30) NOT NULL,
	`alias` varchar(20) NOT NULL,
	PRIMARY KEY (`id_egms_city`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 