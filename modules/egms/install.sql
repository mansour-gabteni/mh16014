﻿CREATE TABLE IF NOT EXISTS `PREFIX_DB1NAME` (
	`id_egms_cu` int(11) NOT NULL AUTO_INCREMENT,
	`id_city` int(11) NOT NULL,
	`id_shop_url` int(11) NOT NULL,
	`veryf_yandex` varchar(20) NOT NULL,
	`veryf_google` varchar(50) NOT NULL,
	`veryf_mail` varchar(40) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`page_index` int(11) DEFAULT NULL,
	`page_contact` int(11) DEFAULT NULL,
	`page_delivery` int(11) DEFAULT NULL,
	`page_shipself` int(11) DEFAULT NULL,
	`active` tinyint(1) NOT NULL,
	PRIMARY KEY (`id_egms_cu`),
	UNIQUE KEY `id_shop_url` (`id_shop_url`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;




CREATE TABLE IF NOT EXISTS `PREFIX_DB3NAME` (
	`id_egms_city` int(11) NOT NULL AUTO_INCREMENT,
	`cityname1` varchar(30) NOT NULL,
	`cityname2` varchar(30) NOT NULL,
	`cityname3` varchar(30) NOT NULL,
	`psyname` varchar(30) NOT NULL,
	`alias` varchar(20) NOT NULL,
	PRIMARY KEY (`id_egms_city`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `PREFIX_DB5NAME` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(20) NOT NULL,
  `page_type` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `meta` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id_page`),
  KEY `page_type` (`page_type`)
) ENGINE=ENGINE_TYPE  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `PREFIX_DB4NAME` (
  `id_egms_delivery` int(11) NOT NULL AUTO_INCREMENT,
  `id_egms_cu` int(11) NOT NULL,
  `id_manufacturer` int(11) NOT NULL,
  `del_pay` int(11) NOT NULL,
  `free_pay` int(11) NOT NULL,
  `dlex` varchar(80) NOT NULL,
  `carriers` varchar(15) NOT NULL,
  `payments` varchar(15) NOT NULL,
  `address` varchar(20) NOT NULL,
  `chema` varchar(500) NOT NULL,
  `shipselfinfo` varchar(120) NOT NULL,
  `comment` varchar(80) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_egms_delivery`),
  UNIQUE KEY `id_egms_cu` (`id_egms_cu`,`id_manufacturer`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `PREFIX_DB3NAME` (`cityname1`, `cityname2`, `cityname3`, `psyname`, `alias`) VALUES
('Нижний Новгород', 'Нижнем Новгороде', 'Нижнего Новгорода', '', ''),
('Москва', 'Москве', 'Москвы', '', ''),
('Санкт-Петербург', 'Санкт-Петербурге', 'Санкт-Петербурга', '', ''),
('Казань', 'Казане', 'Казани', '', ''),
('Воронеж', 'Воронеже', 'Воронежа', '', ''),
('Йошкар-Ола', 'Йошкар-Оле', 'Йошкар-Олы', '', ''),
('Чебоксары', 'Чебоксарах', 'Чебоксаров', '', ''),
('Екатеринбург', 'Екатеринбурге', 'Екатеринбурга', '', ''),
('Арзамас', 'Арзамасе', 'Арзамаса', '', ''),
('Самара', 'Самаре', 'Самары', '', ''),
('Саранск', 'Саранске', 'Саранска', '', ''),
('Саратов', 'Саратове', 'Саратова', '', ''),
('Новосибирск', 'Новосибирске', 'Новосибирска', '', ''),
('Омск', 'Омске', 'Омска', '', ''),
('Уфа', 'Уфе', 'Уфы', '', ''),
('Томск', 'Томске', 'Томска', '', ''),
('Челябинск', 'Челябинске', 'Челябинска', '', ''),
('Ростов-на-Дону', 'Ростове-на-Дону', 'Ростова-на-Дону', '', ''),
('Красноярск', 'Красноярске', 'Красноярска', '', ''),
('Пермь', 'Перми', 'Перми', '', ''),
('Волгоград', 'Волгограде', 'Волгограда', '', ''),
('Краснодар', 'Краснодаре', 'Краснодара', '', ''),
('Тюмень', 'Тюмене', 'Тюмени', '', ''),
('Ижевск', 'Ижевске', 'Ижевска', '', ''),
('Альметьевск', 'Альметьевске', 'Альметьевска', '', ''),
('Ангарск', 'Ангарске', 'Ангарска', '', ''),
('Анжеро-Судженск', 'Анжеро-Судженске', 'Анжеро-Судженска', '', ''),
('Артем', 'Артеме', 'Артема', '', ''),
('Архангельск', 'Архангельске', 'Архангельска', '', ''),
('Асбест', 'Асбесте', 'Асбеста', '', ''),
('Астрахань', 'Астрахане', 'Астрахани', '', ''),
('Балаково', 'Балаково', 'Балаково', '', ''),
('Барнаул', 'Барнауле', 'Барнаула', '', ''),
('Белгород', 'Белгороде', 'Белгорода', '', ''),
('Белоярский', 'в городе Белоярский', 'города Белоярский', '', ''),
('Березники', 'в городе Березники', 'города Березники', '', ''),
('Бийск', 'Бийске', 'Бийска', '', ''),
('Благовещенск', 'Благовещенске', 'Благовещенска', '', ''),
('Богданович', 'в городе Богданович', 'города Богданович', '', ''),
('Борисоглебск', 'Борисоглебске', 'Борисоглебска', '', ''),
('Братск', 'Братске', 'Братска', '', ''),
('Брянск', 'Брянске', 'Брянска', '', ''),
('Буденновск', 'Буденновске', 'Буденновска', '', ''),
('Великий Новгород', 'Великом Новгороде', 'города Великий Новгород', '', ''),
('Волжский', 'городе Волжский', 'города Волжский', '', ''),
('Вологда', 'Вологде', 'Вологды', '', ''),
('Вольск', 'городе Вольск', 'города Вольск', '', ''),
('Грозный', 'городе Грозный', 'города Грозный', '', ''),
('Дзержинск', 'Дзержинске', 'Дзержинска', '', ''),
('Заречный', 'городе Заречный', 'города Заречный', '', ''),
('Иваново', 'городе Иваново', 'города Иваново', '', ''),
('Иркутск', 'Иркутске', 'Иркутска', '', ''),
('Калуга', 'Калуге', 'Калуги', '', ''),
('Каменск-Уральский', 'городе Каменск-Уральский', 'города Каменск-Уральский', '', ''),
('Качканар', 'городе Качканар', 'города Качканар', '', ''),
('Кемерово', 'городе Кемерово', 'города Кемерово', '', ''),
('Киров', 'Кирове', 'Кирова', '', ''),
('Кировград', 'Кировграде', 'Кировграда', '', ''),
('Кострома', 'Костроме', 'Костромаы', '', ''),
('Красноуральск', 'Красноуральске', 'Красноуральска', '', ''),
('Кстово', 'городе Кстово', 'города Кстово', '', ''),
('Курган', 'городе Курган', 'города Курган', '', ''),
('Курск', 'городе Курск', 'города Курск', '', ''),
('Ленинск-Кузнецкий', 'городе Ленинск-Кузнецкий', 'города Ленинск-Кузнецкий', '', ''),
('Липецк', 'Липецке', 'Липецка', '', ''),
('Магнитогорск', 'Магнитогорске', 'Магнитогорска', '', ''),
('Миасс', 'городе Миасс', 'города Миасс', '', ''),
('Мурманск', 'Мурманске', 'Мурманска', '', ''),
('Набережные Челны', 'городе Набережные Челны', 'города Набережные Челны', '', ''),
('Нальчик', 'Нальчике', 'Нальчика', '', ''),
('Невинномысск', 'Невинномысске', 'Невинномысска', '', ''),
('Невьянск', 'Невьянске', 'Невьянска', '', ''),
('Нефтекамск', 'Нефтекамске', 'Нефтекамска', '', ''),
('Нижневартовск', 'Нижневартовске', 'Нижневартовска', '', ''),
('Нижнекамск', 'Нижнекамске', 'Нижнекамска', '', ''),
('Нижний Тагил', 'городе Нижний Тагил', 'города Нижний Тагил', '', ''),
('Нижняя Тура', 'городе Нижняя Тура', 'города Нижняя Тура', '', ''),
('Новокузнецк', 'Новокузнецке', 'Новокузнецка', '', ''),
('Новороссийск', 'Новороссийске', 'Новороссийска', '', ''),
('Новочебоксарск', 'Новочебоксарске', 'Новочебоксарска', '', ''),
('Обнинск', 'Обнинске', 'Обнинска', '', ''),
('Орел', 'городе Орел', 'города Орел', '', ''),
('Оренбург', 'Оренбурге', 'Оренбурга', '', ''),
('Орск', 'Орске', 'Орска', '', ''),
('Пенза', 'Пензе', 'Пензы', '', ''),
('Петрозаводск', 'Петрозаводске', 'Петрозаводска', '', ''),
('Прокопьевск', 'городе Прокопьевск', 'города Прокопьевск', '', ''),
('Пятигорск', 'Пятигорске', 'Пятигорска', '', ''),
('Ревда', 'городе Ревда', 'города Ревда', '', ''),
('Россошь', 'городе Россошь', 'города Россошь', '', ''),
('Рыбинск', 'Рыбинске', 'Рыбинска', '', ''),
('Салават', 'городе Салават', 'города Салават', '', ''),
('Северодвинск', 'Северодвинске', 'Северодвинска', '', ''),
('Северск', 'городе Северск', 'города Северск', '', ''),
('Смоленск', 'Смоленске', 'Смоленска', '', ''),
('Сочи', 'городе Сочи', 'города Сочи', '', ''),
('Ставрополь', 'Ставрополе', 'Ставрополя', '', ''),
('Старый Оскол', 'городе Старый Оскол', 'города Старый Оскол', '', ''),
('Стерлитамак', 'городе Стерлитамак', 'города Стерлитамак', '', ''),
('Сургут', 'Сургуте', 'Сургута', '', ''),
('Сухой Лог', 'городе Сухой Лог', 'города Сухой Лог', '', ''),
('Сызрань', 'городе Сызрань', 'города Сызрань', '', ''),
('Сыктывкар', 'Сыктывкаре', 'Сыктывкара', '', ''),
('Таганрог', 'Таганроге', 'Таганрога', '', ''),
('Тамбов', 'Тамбове', 'Тамбова', '', ''),
('Тверь', 'Твери', 'Твери', '', ''),
('Тобольск', 'Тобольске', 'Тобольска', '', ''),
('Туапсе', 'городе Туапсе', 'города Туапсе', '', ''),
('Тула', 'Туле', 'Тулы', '', ''),
('Улан-Удэ', 'Улан-Удэ', 'Улан-Удэ', '', ''),
('Ульяновск', 'Ульяновске', 'Ульяновска', '', ''),
('Череповец', 'Череповце', 'Череповца', '', ''),
('Чита', 'Чите', 'Читы', '', ''),
('Шахты', 'Шахты', 'Шахты', '', ''),
('Энгельс', 'Энгельсе', 'Энгельса', '', ''),
('Ярославль', 'Ярославле', 'Ярославля', '', ''),
('Владимир', 'Владимире', 'Владимира', '', ''),
('Саров', 'Сарове', 'Сарва', '', ''); 