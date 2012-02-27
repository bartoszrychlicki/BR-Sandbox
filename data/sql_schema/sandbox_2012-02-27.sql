# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.1.59)
# Database: sandbox
# Generation Time: 2012-02-27 11:53:10 +0100
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table aclrole
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aclrole`;

CREATE TABLE `aclrole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `aclrole` WRITE;
/*!40000 ALTER TABLE `aclrole` DISABLE KEYS */;

INSERT INTO `aclrole` (`id`, `name`)
VALUES
	(1,'guest'),
	(2,'marketer'),
	(3,'admin');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `acluser` WRITE;
/*!40000 ALTER TABLE `acluser` DISABLE KEYS */;

INSERT INTO `acluser` (`id`, `name`, `email`, `password`)
VALUES
	(1,'Bartosz','b@br-design.pl','brdesign'),
	(2,'Piotr','p@br-design.pl','brdesign');

/*!40000 ALTER TABLE `acluser` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `aclprivilege` WRITE;
/*!40000 ALTER TABLE `aclprivilege` DISABLE KEYS */;

INSERT INTO `aclprivilege` (`id`, `role_id`, `module`, `controller`, `action`)
VALUES
	(1,1,'%','%','%'),
	(2,2,'%','%','%');

/*!40000 ALTER TABLE `aclprivilege` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table acluser_aclrole
# ------------------------------------------------------------

DROP TABLE IF EXISTS `acluser_aclrole`;

CREATE TABLE `acluser_aclrole` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `acluser_aclrole` WRITE;
/*!40000 ALTER TABLE `acluser_aclrole` DISABLE KEYS */;

INSERT INTO `acluser_aclrole` (`id`, `user_id`, `role_id`)
VALUES
	(1,1,3),
	(2,1,2),
	(3,2,2);

/*!40000 ALTER TABLE `acluser_aclrole` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
