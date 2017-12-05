INSERT INTO `cow_auth_rule_class` VALUES('142','游戏：管理员','0','admin','0','','Game');
INSERT INTO `cow_auth_rule_class` VALUES('143','游戏：管理员','0','admin','0','','Game');
INSERT INTO `cow_auth_rule_class` VALUES('144','游戏：管理员','0','admin','0','','Game');
INSERT INTO `cow_auth_rule_class` VALUES('145','游戏：管理员','0','admin','0','','Game');
INSERT INTO `cow_auth_rule_class` VALUES('153','微信:管理员','0','admin','0','','Wechat');
INSERT INTO `cow_auth_rule_class` VALUES('154','站内短信：管理员','0','admin','0','','Message');
INSERT INTO `cow_auth_rule_class` VALUES('160','游戏：管理员','0','admin','0','','Games');
INSERT INTO `cow_auth_rule_class` VALUES('161','游戏公告系统','0','admin','0','70','');
INSERT INTO `cow_auth_rule_class` VALUES('162','明花麻将系统','0','admin','0','71','');
INSERT INTO `cow_auth_rule_class` VALUES('163','单一信息系统','0','admin','0','72','');
--
-- 表的结构cow_cart
--

DROP TABLE IF EXISTS `cow_cart`;
CREATE TABLE `cow_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `goods_num` int(11) DEFAULT '0' COMMENT '商品数量',
  `model_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `air` int(11) unsigned DEFAULT '1' COMMENT '是否虚拟 1 虚拟  2实体',
  `is_shop_card` tinyint(1) unsigned DEFAULT '0' COMMENT '1表示从店铺刷卡，0从网页直接购买',
  `other` varchar(255) DEFAULT NULL COMMENT '其他字段，如属性等',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_cart
--

--
-- 表的结构cow_chat_article
--

DROP TABLE IF EXISTS `cow_chat_article`;
CREATE TABLE `cow_chat_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` int(11) NOT NULL DEFAULT '0' COMMENT '  ',
  `show_property` varchar(255) DEFAULT '0' COMMENT '显示属性',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_article
--

INSERT INTO `cow_chat_article` VALUES('6','皇子玩瞎子吧电脑烧坏？','198','皇子玩瞎子吧电脑烧坏？','<p>皇子玩瞎子吧电脑烧坏？</p>\r\n','1479364738','','1','admin','0.00','99','2,4,5,3,1');
INSERT INTO `cow_chat_article` VALUES('7','皇子的皇子不行了？','191','皇子的皇子不行了？','<p>皇子的皇子不行了？</p>\r\n','1479365628','','1','admin','0.00','99','2');
INSERT INTO `cow_chat_article` VALUES('9','皇子','198','皇子','<p>皇子</p>\r\n','1479454524','','1','admin','0.00','99','');
--
-- 表的结构cow_chat_class
--

DROP TABLE IF EXISTS `cow_chat_class`;
CREATE TABLE `cow_chat_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(100) DEFAULT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '上级目录id',
  `sort` int(10) unsigned DEFAULT NULL COMMENT '分类的排序',
  `status` tinyint(11) unsigned DEFAULT NULL COMMENT '是否开启，1开启 0关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_class
--

INSERT INTO `cow_chat_class` VALUES('23','娱乐','0','0','1');
INSERT INTO `cow_chat_class` VALUES('24','游戏','0','0','1');
INSERT INTO `cow_chat_class` VALUES('25','脱口秀','0','0','1');
INSERT INTO `cow_chat_class` VALUES('26','舞蹈','0','0','1');
INSERT INTO `cow_chat_class` VALUES('27','交友','23','0','1');
INSERT INTO `cow_chat_class` VALUES('28','游戏','23','0','1');
INSERT INTO `cow_chat_class` VALUES('29','美食','23','0','1');
INSERT INTO `cow_chat_class` VALUES('30','川菜','29','0','1');
INSERT INTO `cow_chat_class` VALUES('31','稀饭','30','0','1');
--
-- 表的结构cow_chat_concern
--

DROP TABLE IF EXISTS `cow_chat_concern`;
CREATE TABLE `cow_chat_concern` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '关注id',
  `from_userid` int(11) unsigned DEFAULT '0' COMMENT '关注人的用户ID',
  `to_userid` int(11) unsigned DEFAULT '0' COMMENT '被关注用户ID',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '关注时间',
  `property` tinyint(1) unsigned DEFAULT '0' COMMENT '关注属性，0普通，1置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_concern
--

--
-- 表的结构cow_chat_face
--

DROP TABLE IF EXISTS `cow_chat_face`;
CREATE TABLE `cow_chat_face` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'biaoqing类别id',
  `title` varchar(255) DEFAULT NULL COMMENT '表情类别名称',
  `path` varchar(255) DEFAULT NULL COMMENT '标签路径',
  `allow_group` varchar(255) DEFAULT NULL COMMENT '允许会员组,多个会员组用,隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_face
--

--
-- 表的结构cow_chat_gift
--

DROP TABLE IF EXISTS `cow_chat_gift`;
CREATE TABLE `cow_chat_gift` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '礼物id',
  `title` varchar(100) DEFAULT NULL COMMENT '礼物名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '礼物状态 0关闭 1开启',
  `describe` text COMMENT '礼物描述',
  `price` int(11) unsigned DEFAULT '0' COMMENT '礼物点数',
  `ico` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `show_type` tinyint(1) unsigned DEFAULT '1' COMMENT '显示样式 1在当前房间显示 2在所以房间显示',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '礼物排序',
  `show_interval` int(11) unsigned DEFAULT '0' COMMENT '礼包展示时长',
  `special` tinyint(2) unsigned DEFAULT '0' COMMENT '展示特性类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_gift
--

INSERT INTO `cow_chat_gift` VALUES('21','111','1','111','10','/upload/user/1/1478157550_364907904.jpg','2','0','0','0');
--
-- 表的结构cow_chat_gift_record
--

DROP TABLE IF EXISTS `cow_chat_gift_record`;
CREATE TABLE `cow_chat_gift_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录d',
  `gift_id` int(11) DEFAULT NULL COMMENT '礼物id',
  `from_user_id` int(11) unsigned DEFAULT '0' COMMENT '送礼用户id',
  `to_user_id` int(11) DEFAULT NULL COMMENT '接受礼物用户id',
  `num` int(11) unsigned DEFAULT '0' COMMENT '礼物数量',
  `room_id` int(11) unsigned DEFAULT '0' COMMENT '房间ID',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '添加日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1249 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_gift_record
--

INSERT INTO `cow_chat_gift_record` VALUES('1158','21','1','9','1','25','1482746318');
INSERT INTO `cow_chat_gift_record` VALUES('1159','21','1','9','1','25','1482746340');
INSERT INTO `cow_chat_gift_record` VALUES('1160','21','1','9','10','25','1482746400');
INSERT INTO `cow_chat_gift_record` VALUES('1161','21','1','9','10','25','1482746488');
INSERT INTO `cow_chat_gift_record` VALUES('1162','21','1','9','10','25','1482746497');
INSERT INTO `cow_chat_gift_record` VALUES('1163','21','1','9','10','25','1482746511');
INSERT INTO `cow_chat_gift_record` VALUES('1164','21','1','9','10','25','1482746520');
INSERT INTO `cow_chat_gift_record` VALUES('1165','21','1','9','10','25','1482746566');
INSERT INTO `cow_chat_gift_record` VALUES('1166','21','1','9','10','25','1482746629');
INSERT INTO `cow_chat_gift_record` VALUES('1167','21','1','1','1','24','1483002458');
INSERT INTO `cow_chat_gift_record` VALUES('1168','21','1','1','1','24','1483064342');
INSERT INTO `cow_chat_gift_record` VALUES('1169','21','1','1','30','24','1483064346');
INSERT INTO `cow_chat_gift_record` VALUES('1170','21','1','1','10','24','1483675739');
INSERT INTO `cow_chat_gift_record` VALUES('1171','21','1','1','30','24','1483675744');
INSERT INTO `cow_chat_gift_record` VALUES('1172','21','1','1','520','24','1483675746');
INSERT INTO `cow_chat_gift_record` VALUES('1173','21','1','1','66','24','1483675750');
INSERT INTO `cow_chat_gift_record` VALUES('1174','21','1','1','10','24','1483675765');
INSERT INTO `cow_chat_gift_record` VALUES('1175','21','1','1','66','24','1483675771');
INSERT INTO `cow_chat_gift_record` VALUES('1176','21','1','1','520','24','1483675824');
INSERT INTO `cow_chat_gift_record` VALUES('1177','21','1','1','66','24','1483675826');
INSERT INTO `cow_chat_gift_record` VALUES('1178','21','1','1','1','24','1483675834');
INSERT INTO `cow_chat_gift_record` VALUES('1179','21','1','1','10','24','1483675969');
INSERT INTO `cow_chat_gift_record` VALUES('1180','21','1','1','66','24','1483675972');
INSERT INTO `cow_chat_gift_record` VALUES('1181','21','1','1','66','24','1483675977');
INSERT INTO `cow_chat_gift_record` VALUES('1182','21','1','1','66','24','1483675986');
INSERT INTO `cow_chat_gift_record` VALUES('1183','21','1','1','520','24','1483676030');
INSERT INTO `cow_chat_gift_record` VALUES('1184','21','1','1','520','24','1483676076');
INSERT INTO `cow_chat_gift_record` VALUES('1185','21','1','1','30','24','1483676329');
INSERT INTO `cow_chat_gift_record` VALUES('1186','21','1','1','66','24','1483676332');
INSERT INTO `cow_chat_gift_record` VALUES('1187','21','1','1','520','24','1483676336');
INSERT INTO `cow_chat_gift_record` VALUES('1188','21','1','1','1314','24','1483676338');
INSERT INTO `cow_chat_gift_record` VALUES('1189','21','1','1','30','24','1483680990');
INSERT INTO `cow_chat_gift_record` VALUES('1190','21','1','1','10','24','1483685237');
INSERT INTO `cow_chat_gift_record` VALUES('1191','21','1','1','520','24','1483685239');
