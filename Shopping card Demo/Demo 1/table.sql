--
-- Table structure for table `internet_shop`
--

CREATE TABLE IF NOT EXISTS `internet_shop` (
  `id` int(6) NOT NULL auto_increment,
  `img` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `name` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `description` text collate utf8_unicode_ci NOT NULL,
  `price` double NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `img` (`img`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `internet_shop`
--

INSERT INTO `internet_shop` VALUES(1, 'iPod.png', 'iPod', 'The original and popular iPod.', 200);
INSERT INTO `internet_shop` VALUES(2, 'iMac.png', 'iMac', 'The iMac computer.', 1200);
INSERT INTO `internet_shop` VALUES(3, 'iPhone.png', 'iPhone', 'This is the new iPhone.', 400);
INSERT INTO `internet_shop` VALUES(4, 'iPod-Shuffle.png', 'iPod Shuffle', 'The new iPod shuffle.', 49);
INSERT INTO `internet_shop` VALUES(5, 'iPod-Nano.png', 'iPod Nano', 'The new iPod Nano.', 99);
INSERT INTO `internet_shop` VALUES(6, 'Apple-TV.png', 'Apple TV', 'The new Apple TV. Buy it now!', 300);
