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
DROP DATABASE IF EXISTS `shop`;
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shop`;


-- 导出  表 shop.menu 结构
DROP TABLE IF EXISTS `menu`;
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

-- 正在导出表  shop.menu 的数据：~11 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `icon`) VALUES
	(1, '中国2', 0, 0, 'www.china.com', 1, 'nihao'),
	(2, 'Guangdong', 1, 0, '', 0, ''),
	(4, 'Shanghai', 0, 1, '', 0, ''),
	(5, 'Shenzhen', 2, 0, '', 0, ''),
	(6, '珠海', 2, 0, 'zhuhai.com', 0, ''),
	(7, 'US', 1, 1, '', 0, ''),
	(8, 'CA', 7, 0, '', 0, ''),
	(10, '韩国6', 1, 2, 'asdfad6', 0, ''),
	(11, '英国2', 0, 2, 'en.com', 0, ''),
	(19, '新加坡', 10, 1, 'ss。com', 0, ''),
	(20, '新加坡2', 10, 0, 'ss。com2', 1, '');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
