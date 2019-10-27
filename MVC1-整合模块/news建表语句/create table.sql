CREATE TABLE `news` (
  `nid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(35) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `author` varchar(20) DEFAULT NULL,
  `source` varchar(20) DEFAULT NULL,
  `keywords` varchar(120) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `orderby` tinyint(2) NOT NULL DEFAULT '50',
  `content` text,
  `hits` smallint(7) NOT NULL DEFAULT '0',
  `addate` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;