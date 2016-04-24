-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.40 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 shopdb 的数据库结构
CREATE DATABASE IF NOT EXISTS `shopdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shopdb`;


-- 导出  表 shopdb.menu 结构
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT '',
  `url` mediumtext NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- 正在导出表  shopdb.menu 的数据：~9 rows (大约)
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `parent_id`, `title`, `label`, `url`, `order`, `created_at`, `updated_at`) VALUES
	(1, 0, '中国2', 'China', 'www.china.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 1, 'Guangdong', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, 1, 'Beijing阿', '啊', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, 1, 'Shanghai', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 2, 'Shenzhen', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 2, '珠海', 'zhuhai', 'zhuhai.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, 0, 'US', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, 7, 'CA', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 0, '韩国', 'Hangguo', 'asdfad', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, 0, '英国2', 'en', 'en.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, 0, '日本', 'Japanese', 'www.j.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, 0, '俄国2', 'eguo2', 'www.eguo.com2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
