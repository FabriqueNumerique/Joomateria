CREATE TABLE IF NOT EXISTS `#__nemateria_contient` (
  `id_collection` int(11) NOT NULL,
  `id_notice` int(11) NOT NULL,
  PRIMARY KEY (`id_collection`,`id_notice`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__nemateria_notices` (
  `id_notice` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(3000) DEFAULT NULL,
  `creator` varchar(500) DEFAULT NULL,
  `subject` varchar(3000) DEFAULT NULL,
  `description` mediumtext,
  `publisher` varchar(500) DEFAULT NULL,
  `contributor` varchar(1000) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `identifier` mediumtext,
  `source` varchar(750) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `relation` mediumtext,
  `coverage` varchar(255) DEFAULT NULL,
  `rights` varchar(500) DEFAULT NULL,
  `champs` mediumtext,
  `datestamp` date DEFAULT NULL,
  `id_header` varchar(255) DEFAULT NULL,
  `locked` tinyint(1) DEFAULT '0',
  `record_langage` varchar(10) DEFAULT NULL,
  `metadata` varchar(255) DEFAULT NULL,
  `unique_identifier` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '1',
  `local_link` mediumtext,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id_notice`),
  UNIQUE KEY `ALIAS` (`unique_identifier`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__nemateria_collections` (
  `id_collection` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrepot` int(11) NOT NULL,
  `spec` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `creator` varchar(100) DEFAULT NULL,
  `other_langage` varchar(3000) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_collection`),
  UNIQUE KEY `SPEC` (`spec`)
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__nemateria_entrepots` (
  `id_entrepot` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `granularity` varchar(10) DEFAULT NULL,
  `earliestDatestamp` date DEFAULT NULL,
  `description` varchar(3000) DEFAULT NULL,
  `identifier` varchar(255) NOT NULL,
  `config` varchar(50) NOT NULL,
  PRIMARY KEY (`id_entrepot`)
) ENGINE=MyISAM;

