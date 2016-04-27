-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.40 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win64
-- HeidiSQL 版本:                  9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 shop 的数据库结构
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shop`;


-- 导出  表 shop.menu 结构
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(50) NOT NULL DEFAULT '',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL DEFAULT '',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `icon` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- 正在导出表  shop.menu 的数据：~14 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `icon`) VALUES
	(4, 'Shanghai', 57, 1, '', 0, 'sh'),
	(5, 'Shenzhen', 57, 2, '', 1, 'sz'),
	(6, 'America', 0, 1, '', 0, 'us'),
	(19, 'Washington', 6, 0, '', 0, 'wa'),
	(20, 'New York', 6, 1, '', 0, 'ny'),
	(53, 'Finland', 0, 4, '', 0, 'fl'),
	(54, 'Russia', 0, 2, '', 0, 'rs'),
	(55, 'Japnese', 0, 3, '', 0, 'jp'),
	(56, 'China', 57, 0, '', 0, 'cn'),
	(57, 'Beijing', 0, 0, '', 0, 'bj'),
	(58, 'Tokyo', 55, 0, '', 0, 'tk'),
	(59, 'Hokkaido', 55, 1, '', 0, 'hkk'),
	(60, 'Moxico', 54, 0, '', 0, 'mx'),
	(61, ' Siberia', 54, 1, '', 1, 'sib');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
