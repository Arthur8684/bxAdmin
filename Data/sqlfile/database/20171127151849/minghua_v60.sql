--
-- 表的结构cow_goods
--

DROP TABLE IF EXISTS `cow_goods`;
CREATE TABLE `cow_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '名称',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `show_property` varchar(255) DEFAULT '0' COMMENT '显示属性',
  `price` float(15,2) DEFAULT '0.00' COMMENT '请输入商品价格',
  `market_price` float(15,2) unsigned DEFAULT '0.00' COMMENT '市场售价',
  `separate_num` float(15,2) unsigned DEFAULT '0.00' COMMENT '分成金额',
  `promote_point` int(10) unsigned DEFAULT '0' COMMENT '升级积分',
  `separate_scale` varchar(255) DEFAULT '' COMMENT '分成比例',
  `pictures` text COMMENT '商品图集',
  `content` text NOT NULL COMMENT '商品介绍',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  `inventory` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_goods
--

INSERT INTO `cow_goods` VALUES('3','我的','201','2,3,6','1.00','0.00','0.00','0','','','','1482227904','/upload/user/1/1478079026_1936085351.png','1','admin','99','0');
INSERT INTO `cow_goods` VALUES('4','123','201','1,2,3','0.10','0.00','0.00','0','','','','1484098920','/upload/admin/1/1479353424_177122.jpg','1','admin','99','0');
--
-- 表的结构cow_goods_inventory
--

DROP TABLE IF EXISTS `cow_goods_inventory`;
CREATE TABLE `cow_goods_inventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '产品ID',
  `shop_id` int(11) unsigned DEFAULT '0' COMMENT '店铺ID',
  `inventory` int(11) DEFAULT '0' COMMENT '入库数量',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `operation_user` varchar(50) DEFAULT NULL COMMENT '操作用户',
  `operation_admin` varchar(50) DEFAULT NULL COMMENT '操作会员店角色',
  `model_id` int(11) unsigned DEFAULT '0' COMMENT '产品模型ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_goods_inventory
--

INSERT INTO `cow_goods_inventory` VALUES('4','3','17','100','1480303548','admin','admin','0');
INSERT INTO `cow_goods_inventory` VALUES('5','3','17','100','1480303594','admin','admin','0');
INSERT INTO `cow_goods_inventory` VALUES('6','3','17','50','1480314242','admin','admin','67');
INSERT INTO `cow_goods_inventory` VALUES('7','3','17','-1','1480317168','admin','admin','0');
INSERT INTO `cow_goods_inventory` VALUES('8','3','17','10','1480317295','admin','admin','0');
--
-- 表的结构cow_goods_property
--

DROP TABLE IF EXISTS `cow_goods_property`;
CREATE TABLE `cow_goods_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '产品ID',
  `shop_id` int(11) unsigned DEFAULT '0' COMMENT '店铺ID',
  `price` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '产品价格',
  `inventory` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `model_id` int(11) unsigned DEFAULT '0' COMMENT '模型ID',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '产品排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_goods_property
--

INSERT INTO `cow_goods_property` VALUES('1','3','17','0.00','15','55','0');
INSERT INTO `cow_goods_property` VALUES('5','3','17','20.00','0','67','0');
INSERT INTO `cow_goods_property` VALUES('6','3','38','0.00','0','66','0');
INSERT INTO `cow_goods_property` VALUES('7','4','38','0.00','0','66','0');
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
--
-- 表的结构cow_inventory_info
--

DROP TABLE IF EXISTS `cow_inventory_info`;
CREATE TABLE `cow_inventory_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) DEFAULT NULL COMMENT '模型id',
  `goods_id` int(11) DEFAULT NULL COMMENT '商品id',
  `quantity` int(11) DEFAULT NULL COMMENT '当前库存',
  `inventory` int(11) DEFAULT NULL COMMENT '入库量',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `msg` varchar(1000) DEFAULT NULL COMMENT '备注',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_inventory_info
--

--
-- 表的结构cow_inventory_shop
--

DROP TABLE IF EXISTS `cow_inventory_shop`;
CREATE TABLE `cow_inventory_shop` (
  `id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT '0' COMMENT '店铺id',
  `model_id` int(11) DEFAULT '0' COMMENT '模型id',
  `goods_id` int(11) DEFAULT '0' COMMENT '产品id',
  `quantity` int(11) DEFAULT '0' COMMENT '当前库存',
  `inventory` tinyint(4) DEFAULT '0' COMMENT '进出库量 正数入库 负数出库',
  `addtime` int(11) DEFAULT '0' COMMENT '添加时间',
  `msg` varchar(255) DEFAULT NULL COMMENT '备注',
  `operator` varchar(255) DEFAULT NULL COMMENT '操作员'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_inventory_shop
--

INSERT INTO `cow_inventory_shop` VALUES('','17','55','3','15','5','1476781905','店铺名称【生鲜水果(17)】INPUT_INVENTORY','');
INSERT INTO `cow_inventory_shop` VALUES('','17','67','3','249','-1','1480317168','店铺名称【生鲜水果(17)】录入库存','');
INSERT INTO `cow_inventory_shop` VALUES('','17','67','3','259','10','1480317296','店铺名称【生鲜水果(17)】录入库存','');
--
-- 表的结构cow_linkage
--

DROP TABLE IF EXISTS `cow_linkage`;
CREATE TABLE `cow_linkage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '' COMMENT '名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `is_show` int(11) DEFAULT '1' COMMENT '否是显示',
  `orders` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_linkage
--

INSERT INTO `cow_linkage` VALUES('1','中国','0','1','0');
INSERT INTO `cow_linkage` VALUES('20','重庆市','1','1','0');
INSERT INTO `cow_linkage` VALUES('17','北京市','1','1','1');
INSERT INTO `cow_linkage` VALUES('18','天津市','1','1','0');
INSERT INTO `cow_linkage` VALUES('19','上海市','1','1','0');
INSERT INTO `cow_linkage` VALUES('21','河北省','1','1','0');
INSERT INTO `cow_linkage` VALUES('22','山西省','1','1','0');
INSERT INTO `cow_linkage` VALUES('24','辽宁省','1','1','0');
INSERT INTO `cow_linkage` VALUES('25','吉林省','1','1','0');
INSERT INTO `cow_linkage` VALUES('26','黑龙江省','1','1','0');
INSERT INTO `cow_linkage` VALUES('27','江苏省','1','1','0');
INSERT INTO `cow_linkage` VALUES('28','浙江省','1','1','0');
INSERT INTO `cow_linkage` VALUES('29','安徽省','1','1','0');
INSERT INTO `cow_linkage` VALUES('30','福建省','1','1','0');
INSERT INTO `cow_linkage` VALUES('31','江西省','1','1','0');
INSERT INTO `cow_linkage` VALUES('32','山东省','1','1','0');
INSERT INTO `cow_linkage` VALUES('33','河南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('34','湖北省','1','1','0');
INSERT INTO `cow_linkage` VALUES('35','湖南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('36','广东省','1','1','0');
INSERT INTO `cow_linkage` VALUES('37','海南省','1','1','0');
INSERT INTO `cow_linkage` VALUES('38','四川省','1','1','0');
INSERT INTO `cow_linkage` VALUES('39','贵州省','1','1','0');
INSERT INTO `cow_linkage` VALUES('40','云南省','1','1','0');
