SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cow_goods_inventory
-- ----------------------------
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

-- ----------------------------
-- Records of cow_goods_inventory
-- ----------------------------
INSERT INTO `cow_goods_inventory` VALUES ('4', '3', '17', '100', '1480303548', 'admin', 'admin', '0');
INSERT INTO `cow_goods_inventory` VALUES ('5', '3', '17', '100', '1480303594', 'admin', 'admin', '0');
INSERT INTO `cow_goods_inventory` VALUES ('6', '3', '17', '50', '1480314242', 'admin', 'admin', '67');
INSERT INTO `cow_goods_inventory` VALUES ('7', '3', '17', '-1', '1480317168', 'admin', 'admin', '0');
INSERT INTO `cow_goods_inventory` VALUES ('8', '3', '17', '10', '1480317295', 'admin', 'admin', '0');

-- ----------------------------
-- Table structure for cow_goods_property
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cow_goods_property
-- ----------------------------
INSERT INTO `cow_goods_property` VALUES ('1', '3', '17', '0.00', '15', '55', '0');
INSERT INTO `cow_goods_property` VALUES ('5', '3', '17', '20.00', '0', '67', '0');

-- ----------------------------
-- Table structure for cow_inventory_shop
-- ----------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cow_inventory_shop
-- ----------------------------
INSERT INTO `cow_inventory_shop` VALUES (null, '17', '55', '3', '15', '5', '1476781905', '店铺名称【生鲜水果(17)】INPUT_INVENTORY', null);
INSERT INTO `cow_inventory_shop` VALUES (null, '17', '67', '3', '249', '-1', '1480317168', '店铺名称【生鲜水果(17)】录入库存', null);
INSERT INTO `cow_inventory_shop` VALUES (null, '17', '67', '3', '259', '10', '1480317296', '店铺名称【生鲜水果(17)】录入库存', null);

-- ----------------------------
-- Table structure for cow_shop
-- ----------------------------
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

-- ----------------------------
-- Records of cow_shop
-- ----------------------------
INSERT INTO `cow_shop` VALUES ('17', '1', '生鲜水果1', '时令鲜果，低价直达  ', '/upload/admin/1/1466046868_1634678226.jpg', 'style6', '0', '22', '1466154185', null, '112.555703', '37.778487', '平阳路', '', '3', '', '今天休息', '0');
INSERT INTO `cow_shop` VALUES ('22', '70', '龙城超市', '生鲜水果，零食特产', '/upload/user/46/1467455355_1126335379.png', 'style2', '0', '23', '1467455414', null, '0', '0', '平阳路', '15135144441', '5', null, null, '0');
INSERT INTO `cow_shop` VALUES ('38', null, '我的店123', '我的店321', '', 'style1', '0', '22', '1477465104', '0', '112.553216', '37.851719', null, null, '0', null, null, '0');
INSERT INTO `cow_shop` VALUES ('27', '137', '大乐送山西太原娄烦店', '1', '', 'style1', '0', '0', null, null, '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cow_shop` VALUES ('28', '165', '河南通许免费体验中心', '0元车险+超市', '/upload/user/133/1470392263_1296981243.jpg', 'style6', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cow_shop` VALUES ('30', '259', '大乐送山西涧河店', '加盟商', '/upload/admin/1/1472032455_1150283326.jpg', 'style7', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cow_shop` VALUES ('36', '313', '大乐送河南周口店', '河南周口店', '/upload/user/277/1472451835_1659463789.jpg', 'style1', '0', '0', '1472532561', null, '112.553216', '37.851719', null, null, '10', null, null, '0');

-- ----------------------------
-- Table structure for cow_shop_category
-- ----------------------------
DROP TABLE IF EXISTS `cow_shop_category`;
CREATE TABLE `cow_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '上级id',
  `is_show` int(11) DEFAULT '0' COMMENT '否是显示 0显示 1不显示',
  `orders` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cow_shop_category
-- ----------------------------
INSERT INTO `cow_shop_category` VALUES ('22', '家居用品', '0', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('21', '花卉植物', '0', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('20', '零食特产', '0', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('23', '同城超市', '0', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('24', '超市', '23', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('25', '超市', '24', '1', '0');
INSERT INTO `cow_shop_category` VALUES ('26', '其他', '0', '1', '1000');
INSERT INTO `cow_shop_category` VALUES ('18', '生鲜水果', '0', '1', '0');
