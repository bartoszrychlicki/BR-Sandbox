# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.59)
# Database: sandbox
# Generation Time: 2012-03-05 00:04:08 +0100
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table aclprivilege
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aclprivilege`;

CREATE TABLE `aclprivilege` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `aclprivilege` WRITE;
/*!40000 ALTER TABLE `aclprivilege` DISABLE KEYS */;

INSERT INTO `aclprivilege` (`id`, `role_id`, `module`, `controller`, `action`)
VALUES
	(2,2,'%','%','%');

/*!40000 ALTER TABLE `aclprivilege` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table aclrole
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aclrole`;

CREATE TABLE `aclrole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `aclrole` WRITE;
/*!40000 ALTER TABLE `aclrole` DISABLE KEYS */;

INSERT INTO `aclrole` (`id`, `name`)
VALUES
	(1,'guest'),
	(2,'marketer2'),
	(3,'admin'),
	(4,'Tomasze2'),
	(5,'Jakubki');

/*!40000 ALTER TABLE `aclrole` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table acluser
# ------------------------------------------------------------

DROP TABLE IF EXISTS `acluser`;

CREATE TABLE `acluser` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `salt` varchar(50) DEFAULT NULL,
  `aclrole_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `acluser` WRITE;
/*!40000 ALTER TABLE `acluser` DISABLE KEYS */;

INSERT INTO `acluser` (`id`, `name`, `email`, `password`, `salt`, `aclrole_id`)
VALUES
	(1,'Bartosz','b@br-design.pl','d80bd37b42514cb37926b63193e0a6ffa43663a4','pepper',2),
	(2,'Piotr','p@br-design.pl','302130c6ba22c50ef670a2e08c7ba940164e6140','paprika',2);

/*!40000 ALTER TABLE `acluser` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
