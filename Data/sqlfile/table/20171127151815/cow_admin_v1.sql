--
-- MySQL database dump
-- Created by DBManage class, Power By yanue. 
-- http://yanue.net 
--
-- 主机: localhost
-- 生成日期: 2017年11月27日15:18:15
-- MySQL版本: 5.5.19
-- PHP 版本: 5.3.28

--
-- 数据库: `minghua`
--

-- -------------------------------------------------------

--
-- 表的结构cow_admin
--

DROP TABLE IF EXISTS `cow_admin`;
CREATE TABLE `cow_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL COMMENT '管理员账号',
  `pass` varchar(100) NOT NULL COMMENT '管理员密码',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '密码前缀',
  `email` varchar(100) DEFAULT '' COMMENT 'email',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员所属的角色ID',
  `role` int(11) unsigned DEFAULT '0' COMMENT '管理员角色类型，1为超级管理',
  `power_id` int(11) unsigned DEFAULT '0' COMMENT '权限ID',
  `status` tinyint(2) unsigned NOT NULL COMMENT '管理员是否开启 1开启 0关闭',
  `addtime` int(11) NOT NULL COMMENT '添加日期',
  `is_del` tinyint(2) unsigned DEFAULT '0' COMMENT '是否不可删除，1表示不可删除',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  PRIMARY KEY (`id`),
  KEY `user_2` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_admin
--

INSERT INTO `cow_admin` VALUES('1','admin','95ec0a51ddedb62e98c9f412455eca00','AnvOCB','','1','0','0','1','1476348327','1','0');
