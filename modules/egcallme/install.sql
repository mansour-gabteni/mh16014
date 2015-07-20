
CREATE TABLE IF NOT EXISTS `PREFIX_DB1NAME` (
  `id_call` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(30) NOT NULL,
  `date_call` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` varchar(15) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL,
  `processed` tinyint(1) NOT NULL,  
  PRIMARY KEY (`id_call`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
