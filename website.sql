-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.28-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for website
DROP DATABASE IF EXISTS `website`;
CREATE DATABASE IF NOT EXISTS `website` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `website`;


-- Dumping structure for table website.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(50) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `permission` tinyint(4) DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `image` varchar(50) NOT NULL DEFAULT 'default',
  `vote_points` int(11) DEFAULT '0',
  `donate_points` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table website.account: 5 rows
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`username`, `id`, `permission`, `email`, `image`, `vote_points`, `donate_points`) VALUES
	('brannik', 1, 3, '0', 'default', 50, 1270),
	('player', 2, 0, '0', 'default', 0, 0),
	('developer', 19, 2, '0', 'default', 0, 0),
	('player2', 20, 0, '0', 'default', 0, 0),
	('gamemaster', 18, 1, '0', 'default', 0, 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table website.announce
DROP TABLE IF EXISTS `announce`;
CREATE TABLE IF NOT EXISTS `announce` (
  `id` int(11) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table website.announce: 1 rows
DELETE FROM `announce`;
/*!40000 ALTER TABLE `announce` DISABLE KEYS */;
INSERT INTO `announce` (`id`, `text`) VALUES
	(1, 'Animated announce');
/*!40000 ALTER TABLE `announce` ENABLE KEYS */;


-- Dumping structure for table website.forum
DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `description` varchar(500) NOT NULL DEFAULT '0',
  `autor` varchar(50) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posts` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(500) NOT NULL DEFAULT 'http://t01.deviantart.net/KYCH_0fy8jh6PuyInd9RGFZoPoE=/300x200/filters:fixed_height(100,100):origin()/pre15/0d81/th/pre/i/2010/238/b/3/frostmourne_stirs____by_anallise.jpg',
  `is_locked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table website.forum: 3 rows
DELETE FROM `forum`;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
INSERT INTO `forum` (`id`, `title`, `description`, `autor`, `date`, `posts`, `image_url`, `is_locked`) VALUES
	(1, 'Test', 'This is a test forum', 'player', '2015-12-28 22:22:28', 8, 'http://t01.deviantart.net/KYCH_0fy8jh6PuyInd9RGFZoPoE=/300x200/filters:fixed_height(100,100):origin()/pre15/0d81/th/pre/i/2010/238/b/3/frostmourne_stirs____by_anallise.jpg', 0),
	(2, 'Test 2', 'This is second test forum.', 'brannik', '2015-12-20 12:13:56', 1, 'http://t01.deviantart.net/KYCH_0fy8jh6PuyInd9RGFZoPoE=/300x200/filters:fixed_height(100,100):origin()/pre15/0d81/th/pre/i/2010/238/b/3/frostmourne_stirs____by_anallise.jpg', 0),
	(3, 'Test 3', 'This is third test forum', 'brannik', '2015-12-20 12:33:19', 0, 'https://media2.giphy.com/media/kfB0pyggeZvY4/200_s.gif', 0);
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;


-- Dumping structure for table website.forum_posts
DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL DEFAULT '0',
  `autor` varchar(50) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '0',
  `text` varchar(2000) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table website.forum_posts: 9 rows
DELETE FROM `forum_posts`;
/*!40000 ALTER TABLE `forum_posts` DISABLE KEYS */;
INSERT INTO `forum_posts` (`id`, `forum_id`, `autor`, `title`, `text`, `date`) VALUES
	(1, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(2, 2, 'brannik', 'SECOND TEST', 'this is second test post n forums', '2015-12-28 03:45:52'),
	(3, 1, 'player', 'players post', 'this is second post in 1-st forum', '2015-12-28 04:43:01'),
	(4, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(5, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(6, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(7, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(8, 1, 'brannik', 'test post ', 'this is test post in forum', '2015-12-28 03:45:22'),
	(9, 1, 'brannik', 'test post ', 'Shall be on second page', '2015-12-28 03:45:22');
/*!40000 ALTER TABLE `forum_posts` ENABLE KEYS */;


-- Dumping structure for table website.mail
DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `autor_id` int(11) DEFAULT NULL,
  `reciever_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `readen` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table website.mail: 2 rows
DELETE FROM `mail`;
/*!40000 ALTER TABLE `mail` DISABLE KEYS */;
INSERT INTO `mail` (`autor_id`, `reciever_id`, `title`, `text`, `date`, `readen`) VALUES
	(1, 1, 'Hello', 'Test message', '2015-12-17 21:00:12', 1),
	(1, 1, 'Hello', 'Test message two', '2015-12-20 12:28:27', 0);
/*!40000 ALTER TABLE `mail` ENABLE KEYS */;


-- Dumping structure for table website.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `text` varchar(50) DEFAULT NULL,
  `permission` tinyint(4) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table website.menu: 8 rows
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`text`, `permission`, `link`, `target`) VALUES
	('Home', -1, 'core/core.php', 'MainFrame'),
	('Forum', -1, 'core/forum.php', 'MainFrame'),
	('Armory', 0, 'core/armory/index.php', 'MainFrame'),
	('Bugtracker', 0, 'core/bugtracker.php', 'MainFrame'),
	('ACP', 3, 'core/admin/panel.php', 'MainFrame'),
	('Support', 0, 'core/support.php', 'MainFrame'),
	('Realms', 0, 'core/information.php', 'MainFrame'),
	('Who', 0, 'core/who.php', 'MainFrame');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table website.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `text` varchar(1000) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `autor` varchar(40) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table website.news: 5 rows
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `text`, `date`, `autor`) VALUES
	(2, 'Teleporter', 'Teleporter NPC is placed in each major sity.', '2015-12-17 02:53:02', 'Brannik'),
	(3, 'Transmog', 'Transmogification NPC is now ready for test and releace.', '2015-12-17 02:44:48', 'Brannik'),
	(4, 'Frostmourne', 'Frostmourne will be releaced soon.Can be optained <a href="../core/shop/shop_index.html" target="MainFrame" >On SHOP PAGE</a>', '2015-12-20 12:43:56', 'Brannik'),
	(5, 'Arena solo queue', 'Arena solo queue is done. After test period will be releaced.', '2015-12-17 02:46:39', 'Brannik'),
	(17, 'Forum', 'Forums are now open <a href="../core/forum.php" target="MainFrame">Forums</a>', '2015-12-28 22:33:33', 'Brannik');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for table website.shop
DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price_vp` int(11) DEFAULT NULL,
  `price_dp` int(11) DEFAULT NULL,
  `cost_type` int(11) DEFAULT '0',
  `type` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table website.shop: 5 rows
DELETE FROM `shop`;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;
INSERT INTO `shop` (`item_id`, `name`, `quality`, `price_vp`, `price_dp`, `cost_type`, `type`) VALUES
	(49623, 'Shadowmourne', 5, 0, 150, 2, '2haxe'),
	(46017, 'Valanyr', 5, 0, 130, 2, '1hmace'),
	(50730, 'Glorenz', 4, 0, 23, 2, '2hsword'),
	(21176, 'Black quraji tank', 5, 0, 0, 0, 'mount'),
	(46051, 'Meteorite Crystal', 3, 55, 0, 1, 'trinket');
/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
