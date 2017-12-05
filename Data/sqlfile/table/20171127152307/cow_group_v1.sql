--
-- MySQL database dump
-- Created by DBManage class, Power By yanue. 
-- http://yanue.net 
--
-- 主机: localhost
-- 生成日期: 2017年11月27日15:23:07
-- MySQL版本: 5.5.19
-- PHP 版本: 5.3.28

--
-- 数据库: `minghua`
--

-- -------------------------------------------------------

--
-- 表的结构cow_group
--

DROP TABLE IF EXISTS `cow_group`;
CREATE TABLE `cow_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员组id',
  `name` varchar(50) DEFAULT NULL COMMENT '组名称',
  `setting` text COMMENT '会员组配置字符串',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '是否开启改会员组1开启0关闭',
  `is_reg` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许会员注册1允许0不允许',
  `is_verify` tinyint(2) unsigned DEFAULT '0' COMMENT '是否需要审核',
  `is_login` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许会员登陆1允许0不允许',
  `is_promote` smallint(2) unsigned DEFAULT '0' COMMENT '改会员组是否可升级',
  `coin_type` varchar(20) DEFAULT '0' COMMENT '购买会员组的币种',
  `price` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '升级会员组的价格',
  `sort_num` smallint(5) DEFAULT '0' COMMENT '会员组排序，数字越小越在前边',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `auth` text COMMENT '会员组权限设置',
  `level` tinyint(3) unsigned DEFAULT '0' COMMENT '会员组级别',
  `condition` text COMMENT '会员组升级条件',
  `price_limit` int(11) unsigned DEFAULT '0' COMMENT '限制会员组购买单价产品',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_group
--

INSERT INTO `cow_group` VALUES('1','普通会员','','1','1','0','1','1','point','0.00','1','0','','0','[is_real_name]  < 1','0');
INSERT INTO `cow_group` VALUES('2','合格会员','','1','1','1','1','1','money','0.00','0','0','','1','[is_real_name]  == 1','0');
INSERT INTO `cow_group` VALUES('3','入门会员','','1','1','1','1','1','money','0.00','0','0','','2','[is_real_name]  == 1 &&  [*1|2]  > 5','0');
INSERT INTO `cow_group` VALUES('4','一星会员','','1','1','1','1','1','money','0.00','0','0','','3','[is_real_name]  == 1 &&  [*1|3]  >= 5','0');
INSERT INTO `cow_group` VALUES('5','二星会员','','1','1','1','1','1','money','0.00','0','0','','4','[is_real_name] ==1 &&  [*1|4]  >=  5','3000');
INSERT INTO `cow_group` VALUES('6','三星会员','','1','1','1','1','1','money','0.00','0','0','','5','[is_real_name] ==1  &&  [*1|5]  >= 5','6000');
INSERT INTO `cow_group` VALUES('7','四星会员','','1','1','1','1','1','money','0.00','0','0','','6','[is_real_name]  == 1 &&  [*1|6]  >= 5','20000');
INSERT INTO `cow_group` VALUES('8','五星会员','','1','1','1','1','1','promote_point','0.00','0','0','','7','[is_real_name] ==1 &&  [*1|7]  >=  5','50000');
