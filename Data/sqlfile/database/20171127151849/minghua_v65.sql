INSERT INTO `cow_model` VALUES('43','notice','站内公告','','0','Article','content','notice');
INSERT INTO `cow_model` VALUES('57','chat_article','直播新闻系统','','0','Article','content','chat_article');
INSERT INTO `cow_model` VALUES('60','ceshi','ceshi','array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'start_time\\\' => 1479362820,\n  \\\'end_time\\\' => 1482905220,\n  \\\'id\\\' => \\\'60\\\',\n)','0','','form','');
INSERT INTO `cow_model` VALUES('66','goods','商城','','0','Goods','content','goods');
INSERT INTO `cow_model` VALUES('69','good_buy','团购','','0','Article','content','good_buy');
INSERT INTO `cow_model` VALUES('70','games_notice','游戏公告','','0','Article','content','games_notice');
INSERT INTO `cow_model` VALUES('71','mahjong_flower','明花麻将','','0','Article','content','mahjong_flower');
INSERT INTO `cow_model` VALUES('72','single_information','单一信息','','0','Article','content','single_information');
--
-- 表的结构cow_notice
--

DROP TABLE IF EXISTS `cow_notice`;
CREATE TABLE `cow_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_notice
--

--
-- 表的结构cow_order
--

DROP TABLE IF EXISTS `cow_order`;
CREATE TABLE `cow_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `addtime` int(11) DEFAULT '0' COMMENT '添加时间',
  `order_amount` float DEFAULT NULL COMMENT '订单金额',
  `goods_amount` float DEFAULT NULL COMMENT '商品总价',
  `discount` float DEFAULT NULL COMMENT '折扣',
  `order_status` int(11) DEFAULT '0' COMMENT '订单状态',
  `pay_status` int(11) DEFAULT '0' COMMENT '支付状态',
  `ship_status` int(11) DEFAULT '0' COMMENT '配送状态',
  `pay_time` int(11) DEFAULT '0' COMMENT '支付时间',
  `finish_time` int(11) DEFAULT '0' COMMENT '完成时间',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  `consignee_id` int(11) DEFAULT '0' COMMENT '收货地址id',
  `remark` varchar(1000) DEFAULT NULL COMMENT '备注',
  `ship_time` int(11) DEFAULT '0' COMMENT '发货时间',
  `shop_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `pay_type` varchar(30) DEFAULT NULL,
  `is_expense` int(11) DEFAULT '0' COMMENT '是否报销',
  `order_come` int(11) DEFAULT '0' COMMENT '订单来源',
  `coin_type` varchar(30) DEFAULT 'money' COMMENT '币种',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order
--

INSERT INTO `cow_order` VALUES('1','f46111487228507_','1487228507','10','10','1','0','0','0','0','0','','','','0','0','1','','0','1','');
INSERT INTO `cow_order` VALUES('2','8b3d91487228985_','1487228985','2','2','1','0','0','0','0','0','','','','0','0','1','','0','1','');
INSERT INTO `cow_order` VALUES('3','0d3701487229057_','1487229057','2','2','1','0','0','0','0','0','','','','0','0','1','','0','1','');
--
-- 表的结构cow_order_conversion_key
--

DROP TABLE IF EXISTS `cow_order_conversion_key`;
CREATE TABLE `cow_order_conversion_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) DEFAULT '0' COMMENT '订单详情ID',
  `conversion_key` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `valid_time` int(11) DEFAULT '0' COMMENT '到期时间',
  `usering` int(11) DEFAULT '0' COMMENT '是否使用',
  `oprater_shop_shop` int(11) DEFAULT '0' COMMENT '销码店铺 0为本店铺销码 其他为别的店铺销码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order_conversion_key
--

--
-- 表的结构cow_order_info
--

DROP TABLE IF EXISTS `cow_order_info`;
CREATE TABLE `cow_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `amount` float DEFAULT NULL COMMENT '商品金额',
  `order_num` int(11) DEFAULT '1' COMMENT '商品数量',
  `order_pro` varchar(255) DEFAULT '' COMMENT '商品属性',
  `model_id` int(11) DEFAULT NULL COMMENT '模型ID',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `other` varchar(255) DEFAULT NULL COMMENT '杂项',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_order_info
--

INSERT INTO `cow_order_info` VALUES('1','f46111487228507_','3','10','10','','66','0','');
INSERT INTO `cow_order_info` VALUES('2','8b3d91487228985_','3','2','2','','66','0','');
INSERT INTO `cow_order_info` VALUES('3','0d3701487229057_','3','2','2','','66','0','');
--
-- 表的结构cow_packets
--

DROP TABLE IF EXISTS `cow_packets`;
CREATE TABLE `cow_packets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '红包id',
  `name` varchar(50) DEFAULT NULL COMMENT '红包名称',
  `form_type` varchar(50) DEFAULT NULL COMMENT '红包类型',
  `intervals` int(11) unsigned DEFAULT '0' COMMENT '红包领取的时间间隔，0表示任何适合可以领取',
  `intervals_type` varchar(20) DEFAULT NULL COMMENT '间隔类型 day：日 year：年 等',
  `times` int(11) unsigned DEFAULT NULL COMMENT '红包最多被同一个人领取多少次，0表示不限次数',
  `condition` text COMMENT '领取红包的条件',
  `money` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送人民币',
  `amount` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送的点数',
  `point` float(11,2) unsigned DEFAULT '0.00' COMMENT '红包赠送积分',
  `promote_point` int(11) unsigned DEFAULT '0' COMMENT '红包赠送升级点数',
  `qrcode_open` tinyint(1) unsigned DEFAULT '0' COMMENT '红包赠送获取二维码权限',
  `group_id` int(11) unsigned DEFAULT '0' COMMENT '红包赠送会员等级',
  `groups` varchar(255) DEFAULT NULL COMMENT '红包允许领取的会员等级',
  `holiday` varchar(50) DEFAULT '0' COMMENT '领取节日礼包的日期',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '红包是否开启1为开启 0为关闭',
  `remarks` varchar(255) DEFAULT NULL COMMENT '红包描述',
  `users` varchar(255) DEFAULT NULL COMMENT '领取会员，只允许此处填写的会员ID领取',
  `start_time` varchar(20) DEFAULT NULL COMMENT '红包开始领取日期',
  `end_time` varchar(20) DEFAULT NULL COMMENT '红包结束领取时间',
  `period_type` varchar(20) DEFAULT NULL COMMENT '红包周期',
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '分步红包下一步红包id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_packets
--

--
-- 表的结构cow_role
--

DROP TABLE IF EXISTS `cow_role`;
CREATE TABLE `cow_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `name` varchar(50) DEFAULT NULL COMMENT '角色名称',
  `setting` text COMMENT '角色几把设置参数',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '角色状态',
  `is_login` tinyint(2) unsigned DEFAULT '0' COMMENT '是否允许登陆1允许0不允许',
  `sort_num` smallint(5) DEFAULT '0' COMMENT '会员组排序，数字越小越在前边',
  `auth` text COMMENT '角色权限设置',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `is_del` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_role
--

INSERT INTO `cow_role` VALUES('1','超级管理','','1','1','0','','0','1');
INSERT INTO `cow_role` VALUES('9','网站管理员','','1','1','0','','0','0');
INSERT INTO `cow_role` VALUES('10','网站编辑','','1','1','0','24,32,28,36,100,35,31,56,146,69','0','0');
INSERT INTO `cow_role` VALUES('11','市级代理','','1','1','0','275,276,277,279,278','0','0');
INSERT INTO `cow_role` VALUES('12','财务','','1','1','0','392,67,66,65,64,63,62','0','0');
INSERT INTO `cow_role` VALUES('13','上传图片','','1','1','0','366,367,368,370,369','0','0');
--
-- 表的结构cow_ship_address
--

DROP TABLE IF EXISTS `cow_ship_address`;
CREATE TABLE `cow_ship_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_ship_address
--

--
-- 表的结构cow_shop
--

DROP TABLE IF EXISTS `cow_shop`;
CREATE TABLE `cow_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT '属所用户',
  `name` varchar(255) DEFAULT NULL COMMENT '铺店名称',
  `description` varchar(255) DEFAULT NULL COMMENT '铺店介绍',
  `logo` varchar(255) DEFAULT NULL COMMENT '招店',
  `style` varchar(255) DEFAULT NULL COMMENT '铺店风格',
  `is_open` int(11) DEFAULT '1' COMMENT '是否开启',
  `category_id` int(11) DEFAULT NULL COMMENT '分类id',
  `addtimes` int(11) DEFAULT NULL COMMENT '店铺创建时间',
  `area_id` int(11) DEFAULT '0' COMMENT '地区',
  `x` varchar(255) DEFAULT '112.553216' COMMENT '坐标x',
  `y` varchar(255) DEFAULT '37.851719' COMMENT '标坐Y',
  `address` varchar(1000) DEFAULT NULL COMMENT '详细地址',
  `mobile` varchar(15) DEFAULT NULL COMMENT '联系电话',
  `proportion` int(11) DEFAULT NULL COMMENT '每件商品的分成比例',
  `attention` varchar(255) DEFAULT NULL COMMENT '联系人',
  `close_reason` varchar(1000) DEFAULT NULL COMMENT '闭店原因',
  `is_air` int(1) DEFAULT '0' COMMENT '是否虚拟实体商 0实体 1虚拟',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_shop
--

INSERT INTO `cow_shop` VALUES('17','1','生鲜水果1','时令鲜果，低价直达  ','/upload/admin/1/1466046868_1634678226.jpg','style6','0','22','1466154185','','112.555703','37.778487','平阳路','','3','','今天休息','0');
