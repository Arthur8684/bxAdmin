--
-- MySQL database dump
-- Created by DBManage class, Power By yanue. 
-- http://yanue.net 
--
-- 主机: localhost
-- 生成日期: 2017年11月27日15:18:49
-- MySQL版本: 5.5.19
-- PHP 版本: 5.3.28

--
-- 数据库: `minghua`
--

-- -------------------------------------------------------

--
-- 表的结构cow_accounts_record
--

DROP TABLE IF EXISTS `cow_accounts_record`;
CREATE TABLE `cow_accounts_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `money` float(11,2) DEFAULT '0.00' COMMENT '人民币',
  `amount` float(11,2) DEFAULT '0.00' COMMENT '点数',
  `point` float(11,2) DEFAULT '0.00' COMMENT '积分',
  `promote_point` float(11,0) DEFAULT '0' COMMENT '升级点数',
  `point1` float(11,0) DEFAULT '0',
  `point2` float(1,0) DEFAULT '0',
  `point3` float(11,0) DEFAULT '0',
  `point4` float(11,0) DEFAULT '0',
  `point5` float(11,0) DEFAULT '0',
  `point6` float(11,0) DEFAULT '0',
  `operation_type` int(11) unsigned DEFAULT NULL COMMENT '操作类型，如转账，消费等',
  `business_type` int(11) unsigned DEFAULT NULL COMMENT '交易类型,比如现金，支付宝',
  `msg` text COMMENT '币交友的备注信息',
  `user` varchar(50) DEFAULT NULL COMMENT '记录所属用户的用户名',
  `userid` int(11) unsigned DEFAULT NULL COMMENT '记录所属用户id',
  `operation_user` varchar(50) DEFAULT NULL COMMENT '操作用户的用户名称',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '添加日期',
  `balance` varchar(255) DEFAULT NULL COMMENT '余额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2726 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_accounts_record
--

INSERT INTO `cow_accounts_record` VALUES('1','111.00','112.00','114.00','113','0','0','0','0','0','0','9','6','','王建华','2','系统','1478163674','a:7:{s:5:\"money\";d:111;s:6:\"amount\";d:112;s:13:\"promote_point\";i:113;s:5:\"point\";d:114;s:6:\"point1\";d:115;s:6:\"point2\";d:116;s:6:\"point3\";d:117;}');
INSERT INTO `cow_accounts_record` VALUES('2','30.00','30.00','30.00','30','0','0','0','0','0','0','4','6','注册分销','ceshi','1','系统','1478163674','a:7:{s:5:\"money\";d:30;s:6:\"amount\";d:30;s:13:\"promote_point\";i:30;s:5:\"point\";d:30;s:6:\"point1\";d:30;s:6:\"point2\";d:30;s:6:\"point3\";d:30;}');
INSERT INTO `cow_accounts_record` VALUES('3','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594363','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('4','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594363','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('5','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594510','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('6','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594510','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('7','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594538','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('8','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594538','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('9','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594720','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('10','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594720','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('11','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594986','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('12','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478594986','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('13','0.00','0.00','0.00','0','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478595059','a:1:{s:13:\"promote_point\";i:280;}');
INSERT INTO `cow_accounts_record` VALUES('14','0.00','0.00','0.00','20','0','0','0','0','0','0','6','14','房间直播','ceshi','1','系统','1478595059','a:1:{s:13:\"promote_point\";i:300;}');
INSERT INTO `cow_accounts_record` VALUES('15','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','王建华','2','系统','1478596602','a:1:{s:13:\"promote_point\";i:93;}');
INSERT INTO `cow_accounts_record` VALUES('16','0.00','0.00','0.00','20','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478596602','a:1:{s:13:\"promote_point\";i:320;}');
INSERT INTO `cow_accounts_record` VALUES('17','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600453','a:1:{s:13:\"promote_point\";i:100;}');
INSERT INTO `cow_accounts_record` VALUES('18','0.00','0.00','0.00','220','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600453','a:1:{s:13:\"promote_point\";i:320;}');
INSERT INTO `cow_accounts_record` VALUES('19','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600679','a:1:{s:13:\"promote_point\";i:99800;}');
INSERT INTO `cow_accounts_record` VALUES('20','0.00','0.00','0.00','200','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600679','a:1:{s:13:\"promote_point\";i:100000;}');
INSERT INTO `cow_accounts_record` VALUES('21','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600820','a:1:{s:5:\"money\";d:9800;}');
INSERT INTO `cow_accounts_record` VALUES('22','200.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478600820','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('23','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655161','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('24','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655161','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('25','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655765','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('26','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655766','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('27','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655852','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('28','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655852','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('29','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655853','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('30','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655853','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('31','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655854','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('32','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655854','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('33','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655967','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('34','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655967','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('35','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('36','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('37','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('38','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('39','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('40','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655969','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('41','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655970','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('42','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655970','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('43','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655970','a:1:{s:5:\"money\";d:9980;}');
INSERT INTO `cow_accounts_record` VALUES('44','20.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655970','a:1:{s:5:\"money\";d:10000;}');
INSERT INTO `cow_accounts_record` VALUES('45','0.00','0.00','0.00','0','0','0','0','0','0','0','9','5','房间直播','ceshi','1','系统','1478655970','a:1:{s:5:\"money\";d:9980;}');
