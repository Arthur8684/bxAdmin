/*
Navicat MySQL Data Transfer

Source Server         : cowcms
Source Server Version : 50161
Source Host           : 122.114.50.168:3306
Source Database       : cowcms

Target Server Type    : MYSQL
Target Server Version : 50161
File Encoding         : 65001

Date: 2016-10-12 18:01:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cc_accounts_record
-- ----------------------------
DROP TABLE IF EXISTS `cc_accounts_record`;
CREATE TABLE `cc_accounts_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `money` float(11,2) DEFAULT '0.00' COMMENT '人民币',
  `amount` float(11,2) DEFAULT '0.00' COMMENT '点数',
  `point` float(11,2) DEFAULT '0.00' COMMENT '积分',
  `promote_point` int(11) DEFAULT '0' COMMENT '升级点数',
  `operation_type` int(11) unsigned DEFAULT NULL COMMENT '操作类型，如转账，消费等',
  `business_type` int(11) unsigned DEFAULT NULL COMMENT '交易类型,比如现金，支付宝',
  `msg` text COMMENT '币交友的备注信息',
  `user` varchar(50) DEFAULT NULL COMMENT '记录所属用户的用户名',
  `userid` int(11) unsigned DEFAULT NULL COMMENT '记录所属用户id',
  `operation_user` varchar(50) DEFAULT NULL COMMENT '操作用户的用户名称',
  `addtime` int(11) unsigned DEFAULT NULL COMMENT '添加日期',
  `balance` varchar(255) DEFAULT NULL COMMENT '余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_accounts_record
-- ----------------------------

-- ----------------------------
-- Table structure for cc_admin
-- ----------------------------
DROP TABLE IF EXISTS `cc_admin`;
CREATE TABLE `cc_admin` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_admin
-- ----------------------------

-- ----------------------------
-- Table structure for cc_advert
-- ----------------------------
DROP TABLE IF EXISTS `cc_advert`;
CREATE TABLE `cc_advert` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned DEFAULT '0' COMMENT '广告位id',
  `img_url` varchar(255) DEFAULT NULL COMMENT '广告图片链接',
  `title` varchar(255) DEFAULT NULL COMMENT '文本内容',
  `a_url` varchar(255) DEFAULT NULL COMMENT '超链接',
  `start_time` int(11) unsigned DEFAULT '0' COMMENT '广告开始时间',
  `end_time` int(11) unsigned DEFAULT '0' COMMENT '结束时间',
  `add_time` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `remarks` text COMMENT '广告备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_advert
-- ----------------------------

-- ----------------------------
-- Table structure for cc_advert_type
-- ----------------------------
DROP TABLE IF EXISTS `cc_advert_type`;
CREATE TABLE `cc_advert_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL COMMENT '广告位名称',
  `overdue_show` text COMMENT '过期显示内容',
  `overdue_show_type` tinyint(1) unsigned DEFAULT NULL COMMENT '广告过期是否显示信息，1显示0不显示，显示overdue_show自动内容',
  `setting` text COMMENT '广告位设置',
  `status` tinyint(2) unsigned DEFAULT NULL COMMENT '开启关闭',
  `default_img` varchar(255) DEFAULT NULL COMMENT '默认图片',
  `advert_type` varchar(20) DEFAULT NULL COMMENT '广告类型',
  `remarks` text COMMENT '广告备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_advert_type
-- ----------------------------

-- ----------------------------
-- Table structure for cc_agent
-- ----------------------------
DROP TABLE IF EXISTS `cc_agent`;
CREATE TABLE `cc_agent` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `agentName` varchar(255) NOT NULL,
  `area_id` int(100) unsigned NOT NULL DEFAULT '0' COMMENT '区域id',
  `user_id` int(100) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_agent
-- ----------------------------

-- ----------------------------
-- Table structure for cc_article
-- ----------------------------
DROP TABLE IF EXISTS `cc_article`;
CREATE TABLE `cc_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_article
-- ----------------------------

-- ----------------------------
-- Table structure for cc_assurance
-- ----------------------------
DROP TABLE IF EXISTS `cc_assurance`;
CREATE TABLE `cc_assurance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `name` varchar(255) NOT NULL DEFAULT '0' COMMENT '0',
  `shenfenzheng` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `xinghao` varchar(255) NOT NULL DEFAULT '0' COMMENT '车辆类型',
  `chepaihao` varchar(255) NOT NULL DEFAULT '0' COMMENT '车牌号',
  `daima` varchar(255) NOT NULL DEFAULT '0' COMMENT '车辆识别代码',
  `price` float(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '车险价格',
  `jiaoqiangxian` float(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '交强险',
  `chechuanshui` float(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '车船税',
  `shangyexian` float(15,2) DEFAULT '0.00' COMMENT '商业险',
  `user` varchar(255) DEFAULT '0' COMMENT '买保险用户名',
  `dianhua` varchar(255) NOT NULL DEFAULT '0' COMMENT '代理电话',
  `bao_xian` varchar(255) NOT NULL DEFAULT '0' COMMENT '保险公司名称',
  `tuijian_user` varchar(255) DEFAULT '0' COMMENT '推荐人用户名',
  `fadongjihao` varchar(255) NOT NULL DEFAULT '0' COMMENT '发动机号',
  `baodantupian` varchar(255) DEFAULT '0' COMMENT '保单图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_assurance
-- ----------------------------

-- ----------------------------
-- Table structure for cc_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `cc_auth_rule`;
CREATE TABLE `cc_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `condition_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '为1表示解析condition字段信息',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL COMMENT '属于哪个种类的验证规则',
  `auth_m` varchar(50) DEFAULT NULL COMMENT '模型名称',
  `auth_c` varchar(50) DEFAULT NULL COMMENT '控制器名称',
  `auth_a` varchar(50) DEFAULT NULL COMMENT '方法名称',
  `auth_p` varchar(255) DEFAULT NULL COMMENT '链接参数',
  `is_del` tinyint(1) unsigned DEFAULT '0' COMMENT '是否允许删除，1 不允许删除',
  `class_id` int(11) DEFAULT '0' COMMENT '类分ID',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=419 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_auth_rule
-- ----------------------------
INSERT INTO `cc_auth_rule` VALUES ('23', 'Wechat/Setting/base_setting', '基本设置', '0', '1', '', null, 'Wechat', 'Setting', 'base_setting', '', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('24', 'Wechat/Setting/menu_setting', '菜单设置', '0', '1', '', null, 'Wechat', 'Setting', 'menu_setting', '', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('25', 'Wechat/Setting/user_setting', '会员设置', '0', '1', '', null, 'Wechat', 'Setting', 'user_setting', '', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('26', 'Sys_model/Class/class_list?modelid=21', '关键字分类', '0', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=21', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('28', 'Admin/Site/Site_list', '网站设置', '0', '1', '', null, 'Admin', 'Site', 'Site_list', '', '0', '4', '4');
INSERT INTO `cc_auth_rule` VALUES ('30', 'Admin/Setting/Setting', '基本设置', '0', '1', '', null, 'Admin', 'Setting', 'Setting', '', '0', '4', '89');
INSERT INTO `cc_auth_rule` VALUES ('31', 'Linkage/Admin/linkage_list', '联动设置', '1', '1', '', null, 'Linkage', 'Admin', 'linkage_list', '', '0', '4', '56');
INSERT INTO `cc_auth_rule` VALUES ('32', 'Admin/Menu/Menu_list?type=user', '会员中心', '0', '1', '', null, 'Admin', 'Menu', 'Menu_list', 'type=user', '0', '4', '0');
INSERT INTO `cc_auth_rule` VALUES ('33', 'Admin/Menu/Menu_list?type=sell', '卖家中心', '0', '1', '', null, 'Admin', 'Menu', 'Menu_list', 'type=sell', '0', '4', '8');
INSERT INTO `cc_auth_rule` VALUES ('34', 'Admin/Menu/Menu_list?type=index_show', '首页菜单', '0', '1', '', null, 'Admin', 'Menu', 'Menu_list', 'type=index_show', '0', '4', '12');
INSERT INTO `cc_auth_rule` VALUES ('35', 'admin/menu/menu_list?type=admin', '后台菜单', '1', '1', '', null, 'admin', 'menu', 'menu_list', 'type=admin', '0', '4', '50');
INSERT INTO `cc_auth_rule` VALUES ('36', 'Admin/Auth/auth_class_list', '权限分类', '0', '1', '', null, 'Admin', 'Auth', 'auth_class_list', '', '0', '4', '30');
INSERT INTO `cc_auth_rule` VALUES ('37', 'Admin/Auth/auth_list', '权限规则', '1', '1', '', null, 'Admin', 'Auth', 'auth_list', '', '0', '4', '34');
INSERT INTO `cc_auth_rule` VALUES ('38', 'Admin/Admin/Admin_Role_list', '角色管理', '0', '1', '', null, 'Admin', 'Admin', 'Admin_Role_list', '', '0', '6', '23');
INSERT INTO `cc_auth_rule` VALUES ('39', 'Admin/Admin/admin_list', '管理列表', '0', '1', '', null, 'Admin', 'Admin', 'admin_list', '', '0', '6', '20');
INSERT INTO `cc_auth_rule` VALUES ('40', 'Admin/install/install_list', '模块列表', '0', '1', '', null, 'Admin', 'install', 'install_list', '', '0', '5', '0');
INSERT INTO `cc_auth_rule` VALUES ('41', 'sys_model/Index/model_list', '模型列表', '0', '1', '', null, 'sys_model', 'Index', 'model_list', '', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('50', 'Field/Field/field_list?modelid=21', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=21', '0', '6', '80');
INSERT INTO `cc_auth_rule` VALUES ('53', 'Admin/Menu/Menu_agent', '会员代理', '1', '1', '', null, 'Admin', 'Menu', 'Menu_agent', '', '0', '14', '54');
INSERT INTO `cc_auth_rule` VALUES ('54', 'Field/Field/field_list?modelid=2', '会员字段', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=2', '0', '14', '79');
INSERT INTO `cc_auth_rule` VALUES ('55', 'Admin/User/User_group_list', '会员组', '1', '1', '', null, 'Admin', 'User', 'User_group_list', '', '0', '14', '10');
INSERT INTO `cc_auth_rule` VALUES ('56', 'Admin/User/user_list', '会员列表', '1', '1', '', null, 'Admin', 'User', 'user_list', '', '0', '14', '6');
INSERT INTO `cc_auth_rule` VALUES ('58', 'Shop/admin/shop_list', '店铺列表', '1', '1', '', null, 'Shop', 'admin', 'shop_list', '', '0', '14', '78');
INSERT INTO `cc_auth_rule` VALUES ('59', 'Shop/Admin/shop_category_list', '分类管理', '1', '1', '', null, 'Shop', 'Admin', 'shop_category_list', '', '0', '14', '77');
INSERT INTO `cc_auth_rule` VALUES ('62', 'Accounts/Setting/setting', '基本配置', '1', '1', '', null, 'Accounts', 'Setting', 'setting', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('63', 'Accounts/Setting/pay_setting', '支付配置', '1', '1', '', null, 'Accounts', 'Setting', 'pay_setting', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('64', 'Accounts/index/withdraw_list', '查看列表', '1', '1', '', null, 'Accounts', 'index', 'withdraw_list', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('65', 'Accounts/index/accounts_del', '清理数据', '1', '1', '', null, 'Accounts', 'index', 'accounts_del', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('66', 'Accounts/index/accounts_alter', '增减资金', '1', '1', '', null, 'Accounts', 'index', 'accounts_alter', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('67', 'Accounts/index/Accounts_list', '流水列表', '1', '1', '', null, 'Accounts', 'index', 'Accounts_list', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('68', 'Order/Admin/cart_list', '测试购物车', '1', '1', '', null, 'Order', 'Admin', 'cart_list', '', '0', '15', '0');
INSERT INTO `cc_auth_rule` VALUES ('69', 'Order/Admin/order_list', '订单列表', '1', '1', '', null, 'Order', 'Admin', 'order_list', '', '0', '15', '0');
INSERT INTO `cc_auth_rule` VALUES ('70', 'Order/Admin/verification_key_admin', '核销兑换码', '1', '1', '', null, 'Order', 'Admin', 'verification_key_admin', '', '0', '15', '0');
INSERT INTO `cc_auth_rule` VALUES ('71', 'Admin/Menu/menu_add?type=admin', '后台菜单:添加菜单', '0', '1', '', null, 'Admin', 'Menu', 'menu_add', 'type=admin', '0', '4', '51');
INSERT INTO `cc_auth_rule` VALUES ('72', 'Sys_model/Class/class_add?modelid=21', '关键字分类:添加分类', '0', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=21', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('73', 'Sys_model/Class/class_edit?modelid=21', '关键字分类:编辑分类', '0', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=21', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('74', 'Sys_model/Class/class_del?modelid=21', '关键字分类:删除分类', '0', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=21', '0', '13', '0');
INSERT INTO `cc_auth_rule` VALUES ('78', 'Admin/Site/site_add', '网站设置:添加网站', '1', '1', '', null, 'Admin', 'Site', 'site_add', '', '0', '4', '5');
INSERT INTO `cc_auth_rule` VALUES ('79', 'Admin/Site/site_edit', '网站设置:编辑网站', '1', '1', '', null, 'Admin', 'Site', 'site_edit', '', '0', '4', '6');
INSERT INTO `cc_auth_rule` VALUES ('80', 'Admin/Site/site_del', '网站设置:删除网站', '0', '1', '', null, 'Admin', 'Site', 'site_del', '', '0', '4', '7');
INSERT INTO `cc_auth_rule` VALUES ('81', 'Linkage/Admin/add_link', '联动设置:联动添加', '1', '1', '', null, 'Linkage', 'Admin', 'add_link', '', '0', '4', '57');
INSERT INTO `cc_auth_rule` VALUES ('84', 'Admin/Menu/menu_add?type=user', '会员中心:添加菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_add', 'type=user', '0', '4', '1');
INSERT INTO `cc_auth_rule` VALUES ('85', 'Admin/Menu/menu_edit?type=user', '会员中心:编辑菜单', '0', '1', '', null, 'Admin', 'Menu', 'menu_edit', 'type=user', '0', '4', '2');
INSERT INTO `cc_auth_rule` VALUES ('86', 'Admin/Menu/Menu_del?type=user', '会员中心:删除菜单', '1', '1', '', null, 'Admin', 'Menu', 'Menu_del', 'type=user', '0', '4', '3');
INSERT INTO `cc_auth_rule` VALUES ('87', 'Admin/Menu/menu_add?type=sell', '卖家菜单:添加菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_add', 'type=sell', '0', '4', '9');
INSERT INTO `cc_auth_rule` VALUES ('88', 'Admin/Menu/menu_edit?type=sell', '卖家菜单:编辑菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_edit', 'type=sell', '0', '4', '10');
INSERT INTO `cc_auth_rule` VALUES ('89', 'Admin/Menu/Menu_del?type=sell', '卖家菜单:删除菜单', '1', '1', '', null, 'Admin', 'Menu', 'Menu_del', 'type=sell', '0', '4', '11');
INSERT INTO `cc_auth_rule` VALUES ('90', 'Admin/Menu/menu_add?type=index_show', '首页菜单:添加菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_add', 'type=index_show', '0', '4', '13');
INSERT INTO `cc_auth_rule` VALUES ('91', 'Admin/Menu/menu_edit?type=index_show', '首页菜单:编辑菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_edit', 'type=index_show', '0', '4', '14');
INSERT INTO `cc_auth_rule` VALUES ('92', 'Admin/Menu/Menu_del?type=index_show', '首页菜单:删除菜单', '1', '1', '', null, 'Admin', 'Menu', 'Menu_del', 'type=index_show', '0', '4', '15');
INSERT INTO `cc_auth_rule` VALUES ('95', 'Admin/Menu/menu_edit?type=admin', '后台菜单:编辑菜单', '1', '1', '', null, 'Admin', 'Menu', 'menu_edit', 'type=admin', '0', '4', '52');
INSERT INTO `cc_auth_rule` VALUES ('96', 'Admin/Menu/Menu_del?type=admin', '后台菜单:删除菜单', '1', '1', '', null, 'Admin', 'Menu', 'Menu_del', 'type=admin', '0', '4', '53');
INSERT INTO `cc_auth_rule` VALUES ('97', 'Admin/Auth/auth_class_add', '权限分类:添加分类', '1', '1', '', null, 'Admin', 'Auth', 'auth_class_add', '', '0', '4', '31');
INSERT INTO `cc_auth_rule` VALUES ('98', 'Admin/Auth/auth_class_edit', '权限分类:编辑分类', '1', '1', '', null, 'Admin', 'Auth', 'auth_class_edit', '', '0', '4', '32');
INSERT INTO `cc_auth_rule` VALUES ('99', 'Admin/Auth/auth_class_del', '权限分类:删除分类', '1', '1', '', null, 'Admin', 'Auth', 'auth_class_del', '', '0', '4', '33');
INSERT INTO `cc_auth_rule` VALUES ('100', 'Admin/Auth/auth_add', '权限管理:添加规则', '1', '1', '', null, 'Admin', 'Auth', 'auth_add', '', '0', '4', '35');
INSERT INTO `cc_auth_rule` VALUES ('101', 'Admin/Auth/auth_edit', '权限管理:编辑规则', '1', '1', '', null, 'Admin', 'Auth', 'auth_edit', '', '0', '4', '36');
INSERT INTO `cc_auth_rule` VALUES ('102', 'Admin/Auth/auth_del', '权限管理:删除规则', '1', '1', '', null, 'Admin', 'Auth', 'auth_del', '', '0', '4', '37');
INSERT INTO `cc_auth_rule` VALUES ('103', 'Admin/Admin/admin_role_add', '角色管理:添加角色', '1', '1', '', null, 'Admin', 'Admin', 'admin_role_add', '', '0', '4', '24');
INSERT INTO `cc_auth_rule` VALUES ('104', 'Admin/Admin/admin_role_edit', '角色管理:编辑角色', '1', '1', '', null, 'Admin', 'Admin', 'admin_role_edit', '', '0', '4', '25');
INSERT INTO `cc_auth_rule` VALUES ('105', 'Admin/Admin/admin_role_del', '角色管理:删除角色', '1', '1', '', null, 'Admin', 'Admin', 'admin_role_del', '', '0', '4', '26');
INSERT INTO `cc_auth_rule` VALUES ('106', 'Admin/Admin/admin_add', '管理列表:添加管理员', '1', '1', '', null, 'Admin', 'Admin', 'admin_add', '', '0', '4', '21');
INSERT INTO `cc_auth_rule` VALUES ('107', 'Admin/Admin/admin_edit', '管理列表:编辑管理员', '1', '1', '', null, 'Admin', 'Admin', 'admin_edit', '', '0', '4', '22');
INSERT INTO `cc_auth_rule` VALUES ('108', 'Admin/Admin/admin_del', '管理列表:删除管理员', '1', '1', '', null, 'Admin', 'Admin', 'admin_del', '', '0', '4', '22');
INSERT INTO `cc_auth_rule` VALUES ('109', 'Sys_model/Index/model_add', '模型列表:模型添加', '1', '1', '', null, 'Sys_model', 'Index', 'model_add', '', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('110', 'Sys_model/Index/model_edit', '模型列表:编辑模型', '1', '1', '', null, 'Sys_model', 'Index', 'model_edit', '', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('111', 'Sys_model/Index/model_del', '模型列表:删除模型', '1', '1', '', null, 'Sys_model', 'Index', 'model_del', '', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('131', 'Field/Field/field_add?modelid=21', '字段管理:添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=21', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('132', 'Field/Field/field_edit?modelid=21', '字段管理:编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=21', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('133', 'Field/Field/field_del?modelid=21', '字段管理:删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=21', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('134', 'Field/Field/field_update_cache?modelid=21', '更新关键字缓存', '1', '1', '', null, 'Field', 'Field', 'field_update_cache', 'modelid=21', '0', '6', '0');
INSERT INTO `cc_auth_rule` VALUES ('138', 'Field/Field/field_add?modelid=2', '会员字段:添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=2', '0', '14', '0');
INSERT INTO `cc_auth_rule` VALUES ('141', 'Admin/User/User_group_add', '会员组:添加会员组', '1', '1', '', null, 'Admin', 'User', 'User_group_add', '', '0', '14', '11');
INSERT INTO `cc_auth_rule` VALUES ('142', 'Admin/User/User_group_edit', '会员组:编辑会员组', '1', '1', '', null, 'Admin', 'User', 'User_group_edit', '', '0', '14', '12');
INSERT INTO `cc_auth_rule` VALUES ('143', 'Admin/User/User_group_del', '会员组:删除会员组', '1', '1', '', null, 'Admin', 'User', 'User_group_del', '', '0', '14', '13');
INSERT INTO `cc_auth_rule` VALUES ('144', 'Admin/User/user_add', '会员列表:添加会员', '1', '1', '', null, 'Admin', 'User', 'user_add', '', '0', '14', '7');
INSERT INTO `cc_auth_rule` VALUES ('145', 'Admin/User/user_edit', '会员列表:编辑会员', '1', '1', '', null, 'Admin', 'User', 'user_edit', '', '0', '14', '8');
INSERT INTO `cc_auth_rule` VALUES ('146', 'Admin/User/user_del', '会员列表:删除会员', '1', '1', '', null, 'Admin', 'User', 'user_del', '', '0', '14', '9');
INSERT INTO `cc_auth_rule` VALUES ('256', 'User/Agentadmin/agent_add', '会员代理:添加代理人', '1', '1', '', null, 'User', 'Agentadmin', 'agent_add', '', '0', '14', '1');
INSERT INTO `cc_auth_rule` VALUES ('257', 'User/Agentadmin/agent_edit', '会员代理:编辑代理人', '1', '1', '', null, 'User', 'Agentadmin', 'agent_edit', '', '0', '14', '2');
INSERT INTO `cc_auth_rule` VALUES ('258', 'User/Agentadmin/agent_delete', '会员代理:删除代理人', '1', '1', '', null, 'User', 'Agentadmin', 'agent_delete', '', '0', '14', '3');
INSERT INTO `cc_auth_rule` VALUES ('259', 'User/Agentadmin/agent_list', '代理人列表', '1', '1', '', null, 'User', 'Agentadmin', 'agent_list', '', '0', '14', '4');
INSERT INTO `cc_auth_rule` VALUES ('260', 'User/Agentadmin/setting_list', '代理设置', '1', '1', '', null, 'User', 'Agentadmin', 'setting_list', '', '0', '14', '0');
INSERT INTO `cc_auth_rule` VALUES ('288', 'article/aticle/article_list?modelid=43', '内容管理', '1', '1', '', null, 'article', 'aticle', 'article_list', 'modelid=43', '0', '30', '0');
INSERT INTO `cc_auth_rule` VALUES ('289', 'article/aticle/article_add?modelid=43', '添加信息', '1', '1', '', null, 'article', 'aticle', 'article_add', 'modelid=43', '0', '30', '1');
INSERT INTO `cc_auth_rule` VALUES ('290', 'article/aticle/article_del?modelid=43', '删除信息', '1', '1', '', null, 'article', 'aticle', 'article_del', 'modelid=43', '0', '30', '2');
INSERT INTO `cc_auth_rule` VALUES ('291', 'article/aticle/article_edit?modelid=43', '编辑信息', '1', '1', '', null, 'article', 'aticle', 'article_edit', 'modelid=43', '0', '30', '3');
INSERT INTO `cc_auth_rule` VALUES ('292', 'Sys_model/Index/verify?modelid=43', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=43', '0', '30', '3');
INSERT INTO `cc_auth_rule` VALUES ('293', 'Sys_model/Class/class_list?modelid=43', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=43', '0', '30', '4');
INSERT INTO `cc_auth_rule` VALUES ('294', 'Sys_model/Class/class_add?modelid=43', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=43', '0', '30', '5');
INSERT INTO `cc_auth_rule` VALUES ('295', 'Sys_model/Class/class_del?modelid=43', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=43', '0', '30', '6');
INSERT INTO `cc_auth_rule` VALUES ('296', 'Sys_model/Class/class_edit?modelid=43', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=43', '0', '30', '7');
INSERT INTO `cc_auth_rule` VALUES ('297', 'Field/Field/field_list?modelid=43', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=43', '0', '30', '8');
INSERT INTO `cc_auth_rule` VALUES ('298', 'Field/Field/field_add?modelid=43', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=43', '0', '30', '9');
INSERT INTO `cc_auth_rule` VALUES ('299', 'Field/Field/field_del?modelid=43', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=43', '0', '30', '10');
INSERT INTO `cc_auth_rule` VALUES ('300', 'Field/Field/field_edit?modelid=43', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=43', '0', '30', '11');
INSERT INTO `cc_auth_rule` VALUES ('301', 'article/aticle/article_list?modelid=44', '内容管理', '1', '1', '', null, 'article', 'aticle', 'article_list', 'modelid=44', '0', '31', '0');
INSERT INTO `cc_auth_rule` VALUES ('302', 'article/aticle/article_add?modelid=44', '添加信息', '1', '1', '', null, 'article', 'aticle', 'article_add', 'modelid=44', '0', '31', '1');
INSERT INTO `cc_auth_rule` VALUES ('303', 'article/aticle/article_del?modelid=44', '删除信息', '1', '1', '', null, 'article', 'aticle', 'article_del', 'modelid=44', '0', '31', '2');
INSERT INTO `cc_auth_rule` VALUES ('304', 'article/aticle/article_edit?modelid=44', '编辑信息', '1', '1', '', null, 'article', 'aticle', 'article_edit', 'modelid=44', '0', '31', '3');
INSERT INTO `cc_auth_rule` VALUES ('305', 'Sys_model/Index/verify?modelid=44', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=44', '0', '31', '3');
INSERT INTO `cc_auth_rule` VALUES ('306', 'Sys_model/Class/class_list?modelid=44', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=44', '0', '31', '4');
INSERT INTO `cc_auth_rule` VALUES ('307', 'Sys_model/Class/class_add?modelid=44', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=44', '0', '31', '5');
INSERT INTO `cc_auth_rule` VALUES ('308', 'Sys_model/Class/class_del?modelid=44', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=44', '0', '31', '6');
INSERT INTO `cc_auth_rule` VALUES ('309', 'Sys_model/Class/class_edit?modelid=44', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=44', '0', '31', '7');
INSERT INTO `cc_auth_rule` VALUES ('310', 'Field/Field/field_list?modelid=44', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=44', '0', '31', '8');
INSERT INTO `cc_auth_rule` VALUES ('311', 'Field/Field/field_add?modelid=44', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=44', '0', '31', '9');
INSERT INTO `cc_auth_rule` VALUES ('312', 'Field/Field/field_del?modelid=44', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=44', '0', '31', '10');
INSERT INTO `cc_auth_rule` VALUES ('313', 'Field/Field/field_edit?modelid=44', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=44', '0', '31', '11');
INSERT INTO `cc_auth_rule` VALUES ('314', 'article/aticle/article_list?modelid=45', '内容管理', '1', '1', '', null, 'article', 'aticle', 'article_list', 'modelid=45', '0', '32', '0');
INSERT INTO `cc_auth_rule` VALUES ('315', 'article/aticle/article_add?modelid=45', '添加信息', '1', '1', '', null, 'article', 'aticle', 'article_add', 'modelid=45', '0', '32', '1');
INSERT INTO `cc_auth_rule` VALUES ('316', 'article/aticle/article_del?modelid=45', '删除信息', '1', '1', '', null, 'article', 'aticle', 'article_del', 'modelid=45', '0', '32', '2');
INSERT INTO `cc_auth_rule` VALUES ('317', 'article/aticle/article_edit?modelid=45', '编辑信息', '1', '1', '', null, 'article', 'aticle', 'article_edit', 'modelid=45', '0', '32', '3');
INSERT INTO `cc_auth_rule` VALUES ('318', 'Sys_model/Index/verify?modelid=45', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=45', '0', '32', '3');
INSERT INTO `cc_auth_rule` VALUES ('319', 'Sys_model/Class/class_list?modelid=45', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=45', '0', '32', '4');
INSERT INTO `cc_auth_rule` VALUES ('320', 'Sys_model/Class/class_add?modelid=45', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=45', '0', '32', '5');
INSERT INTO `cc_auth_rule` VALUES ('321', 'Sys_model/Class/class_del?modelid=45', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=45', '0', '32', '6');
INSERT INTO `cc_auth_rule` VALUES ('322', 'Sys_model/Class/class_edit?modelid=45', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=45', '0', '32', '7');
INSERT INTO `cc_auth_rule` VALUES ('323', 'Field/Field/field_list?modelid=45', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=45', '0', '32', '8');
INSERT INTO `cc_auth_rule` VALUES ('324', 'Field/Field/field_add?modelid=45', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=45', '0', '32', '9');
INSERT INTO `cc_auth_rule` VALUES ('325', 'Field/Field/field_del?modelid=45', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=45', '0', '32', '10');
INSERT INTO `cc_auth_rule` VALUES ('326', 'Field/Field/field_edit?modelid=45', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=45', '0', '32', '11');
INSERT INTO `cc_auth_rule` VALUES ('366', 'Group_buy/Groupbuy/group_buy_list?modelid=49', '内容管理', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_list', 'modelid=49', '0', '36', '0');
INSERT INTO `cc_auth_rule` VALUES ('367', 'Group_buy/Groupbuy/group_buy_add?modelid=49', '添加信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_add', 'modelid=49', '0', '36', '1');
INSERT INTO `cc_auth_rule` VALUES ('368', 'Group_buy/Groupbuy/group_buy_del?modelid=49', '删除信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_del', 'modelid=49', '0', '36', '2');
INSERT INTO `cc_auth_rule` VALUES ('369', 'Group_buy/Groupbuy/group_buy_edit?modelid=49', '编辑信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_edit', 'modelid=49', '0', '36', '3');
INSERT INTO `cc_auth_rule` VALUES ('370', 'Sys_model/Index/verify?modelid=49', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=49', '0', '36', '3');
INSERT INTO `cc_auth_rule` VALUES ('371', 'Sys_model/Class/class_list?modelid=49', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=49', '0', '36', '4');
INSERT INTO `cc_auth_rule` VALUES ('372', 'Sys_model/Class/class_add?modelid=49', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=49', '0', '36', '5');
INSERT INTO `cc_auth_rule` VALUES ('373', 'Sys_model/Class/class_del?modelid=49', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=49', '0', '36', '6');
INSERT INTO `cc_auth_rule` VALUES ('374', 'Sys_model/Class/class_edit?modelid=49', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=49', '0', '36', '7');
INSERT INTO `cc_auth_rule` VALUES ('375', 'Field/Field/field_list?modelid=49', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=49', '0', '36', '8');
INSERT INTO `cc_auth_rule` VALUES ('376', 'Field/Field/field_add?modelid=49', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=49', '0', '36', '9');
INSERT INTO `cc_auth_rule` VALUES ('377', 'Field/Field/field_del?modelid=49', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=49', '0', '36', '10');
INSERT INTO `cc_auth_rule` VALUES ('378', 'Field/Field/field_edit?modelid=49', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=49', '0', '36', '11');
INSERT INTO `cc_auth_rule` VALUES ('379', 'Group_buy/Groupbuy/group_buy_list?modelid=50', '内容管理', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_list', 'modelid=50', '0', '37', '0');
INSERT INTO `cc_auth_rule` VALUES ('380', 'Group_buy/Groupbuy/group_buy_add?modelid=50', '添加信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_add', 'modelid=50', '0', '37', '1');
INSERT INTO `cc_auth_rule` VALUES ('381', 'Group_buy/Groupbuy/group_buy_del?modelid=50', '删除信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_del', 'modelid=50', '0', '37', '2');
INSERT INTO `cc_auth_rule` VALUES ('382', 'Group_buy/Groupbuy/group_buy_edit?modelid=50', '编辑信息', '1', '1', '', null, 'Group_buy', 'Groupbuy', 'group_buy_edit', 'modelid=50', '0', '37', '3');
INSERT INTO `cc_auth_rule` VALUES ('383', 'Sys_model/Index/verify?modelid=50', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=50', '0', '37', '3');
INSERT INTO `cc_auth_rule` VALUES ('384', 'Sys_model/Class/class_list?modelid=50', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=50', '0', '37', '4');
INSERT INTO `cc_auth_rule` VALUES ('385', 'Sys_model/Class/class_add?modelid=50', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=50', '0', '37', '5');
INSERT INTO `cc_auth_rule` VALUES ('386', 'Sys_model/Class/class_del?modelid=50', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=50', '0', '37', '6');
INSERT INTO `cc_auth_rule` VALUES ('387', 'Sys_model/Class/class_edit?modelid=50', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=50', '0', '37', '7');
INSERT INTO `cc_auth_rule` VALUES ('388', 'Field/Field/field_list?modelid=50', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=50', '0', '37', '8');
INSERT INTO `cc_auth_rule` VALUES ('389', 'Field/Field/field_add?modelid=50', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=50', '0', '37', '9');
INSERT INTO `cc_auth_rule` VALUES ('390', 'Field/Field/field_del?modelid=50', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=50', '0', '37', '10');
INSERT INTO `cc_auth_rule` VALUES ('391', 'Field/Field/field_edit?modelid=50', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=50', '0', '37', '11');
INSERT INTO `cc_auth_rule` VALUES ('392', 'Packets/Admin/packets_list', '红包', '1', '1', '', null, 'Packets', 'Admin', 'packets_list', '', '0', '38', '0');
INSERT INTO `cc_auth_rule` VALUES ('406', 'article/aticle/article_list?modelid=54', '内容管理', '1', '1', '', null, 'article', 'aticle', 'article_list', 'modelid=54', '0', '40', '0');
INSERT INTO `cc_auth_rule` VALUES ('407', 'article/aticle/article_add?modelid=54', '添加信息', '1', '1', '', null, 'article', 'aticle', 'article_add', 'modelid=54', '0', '40', '1');
INSERT INTO `cc_auth_rule` VALUES ('408', 'article/aticle/article_del?modelid=54', '删除信息', '1', '1', '', null, 'article', 'aticle', 'article_del', 'modelid=54', '0', '40', '2');
INSERT INTO `cc_auth_rule` VALUES ('409', 'article/aticle/article_edit?modelid=54', '编辑信息', '1', '1', '', null, 'article', 'aticle', 'article_edit', 'modelid=54', '0', '40', '3');
INSERT INTO `cc_auth_rule` VALUES ('410', 'Sys_model/Index/verify?modelid=54', '信息审核', '1', '1', '', null, 'Sys_model', 'Index', 'verify', 'modelid=54', '0', '40', '3');
INSERT INTO `cc_auth_rule` VALUES ('411', 'Sys_model/Class/class_list?modelid=54', '管理分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_list', 'modelid=54', '0', '40', '4');
INSERT INTO `cc_auth_rule` VALUES ('412', 'Sys_model/Class/class_add?modelid=54', '添加分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_add', 'modelid=54', '0', '40', '5');
INSERT INTO `cc_auth_rule` VALUES ('413', 'Sys_model/Class/class_del?modelid=54', '删除分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_del', 'modelid=54', '0', '40', '6');
INSERT INTO `cc_auth_rule` VALUES ('414', 'Sys_model/Class/class_edit?modelid=54', '编辑分类', '1', '1', '', null, 'Sys_model', 'Class', 'class_edit', 'modelid=54', '0', '40', '7');
INSERT INTO `cc_auth_rule` VALUES ('415', 'Field/Field/field_list?modelid=54', '字段管理', '1', '1', '', null, 'Field', 'Field', 'field_list', 'modelid=54', '0', '40', '8');
INSERT INTO `cc_auth_rule` VALUES ('416', 'Field/Field/field_add?modelid=54', '添加字段', '1', '1', '', null, 'Field', 'Field', 'field_add', 'modelid=54', '0', '40', '9');
INSERT INTO `cc_auth_rule` VALUES ('417', 'Field/Field/field_del?modelid=54', '删除字段', '1', '1', '', null, 'Field', 'Field', 'field_del', 'modelid=54', '0', '40', '10');
INSERT INTO `cc_auth_rule` VALUES ('418', 'Field/Field/field_edit?modelid=54', '编辑字段', '1', '1', '', null, 'Field', 'Field', 'field_edit', 'modelid=54', '0', '40', '11');

-- ----------------------------
-- Table structure for cc_auth_rule_class
-- ----------------------------
DROP TABLE IF EXISTS `cc_auth_rule_class`;
CREATE TABLE `cc_auth_rule_class` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(20) NOT NULL DEFAULT '',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(50) DEFAULT NULL COMMENT '分类类型，显示区分',
  `sort_num` int(10) unsigned DEFAULT '0' COMMENT '类分排序',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '所在模型的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_auth_rule_class
-- ----------------------------
INSERT INTO `cc_auth_rule_class` VALUES ('4', '设置', '0', 'admin', '1', null);
INSERT INTO `cc_auth_rule_class` VALUES ('5', '模块', '0', 'admin', '2', null);
INSERT INTO `cc_auth_rule_class` VALUES ('6', '内容', '0', 'admin', '3', null);
INSERT INTO `cc_auth_rule_class` VALUES ('13', '微信', '0', 'admin', '0', null);
INSERT INTO `cc_auth_rule_class` VALUES ('14', '会员', '0', 'admin', '4', null);
INSERT INTO `cc_auth_rule_class` VALUES ('15', '订单', '0', 'admin', '7', null);
INSERT INTO `cc_auth_rule_class` VALUES ('30', '站内公告系统', '0', 'admin', '0', '43');
INSERT INTO `cc_auth_rule_class` VALUES ('31', '提交正能量系统', '0', 'admin', '0', '44');
INSERT INTO `cc_auth_rule_class` VALUES ('32', '图片系统', '0', 'admin', '0', '45');
INSERT INTO `cc_auth_rule_class` VALUES ('36', '产品系统', '0', 'admin', '0', '49');
INSERT INTO `cc_auth_rule_class` VALUES ('37', '积分系统', '0', 'admin', '0', '50');
INSERT INTO `cc_auth_rule_class` VALUES ('38', '资金', '0', 'admin', '0', null);
INSERT INTO `cc_auth_rule_class` VALUES ('40', '文章系统', '0', 'admin', '0', '54');

-- ----------------------------
-- Table structure for cc_cart
-- ----------------------------
DROP TABLE IF EXISTS `cc_cart`;
CREATE TABLE `cc_cart` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_cart
-- ----------------------------

-- ----------------------------
-- Table structure for cc_coin_get
-- ----------------------------
DROP TABLE IF EXISTS `cc_coin_get`;
CREATE TABLE `cc_coin_get` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_coin_get
-- ----------------------------

-- ----------------------------
-- Table structure for cc_coin_get_pic
-- ----------------------------
DROP TABLE IF EXISTS `cc_coin_get_pic`;
CREATE TABLE `cc_coin_get_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_coin_get_pic
-- ----------------------------

-- ----------------------------
-- Table structure for cc_comment
-- ----------------------------
DROP TABLE IF EXISTS `cc_comment`;
CREATE TABLE `cc_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `model_id` int(11) DEFAULT NULL COMMENT '模型id',
  `goods_id` int(11) DEFAULT NULL COMMENT '文章或产品id',
  `content` varchar(500) DEFAULT NULL COMMENT '评论内容',
  `star` int(11) DEFAULT NULL COMMENT '星级',
  `img_array` varchar(8000) DEFAULT NULL COMMENT '图集',
  `is_audit` int(11) DEFAULT '0' COMMENT '是否审核',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_comment
-- ----------------------------

-- ----------------------------
-- Table structure for cc_consignee
-- ----------------------------
DROP TABLE IF EXISTS `cc_consignee`;
CREATE TABLE `cc_consignee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `consignee` varchar(255) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_consignee
-- ----------------------------

-- ----------------------------
-- Table structure for cc_expense_record
-- ----------------------------
DROP TABLE IF EXISTS `cc_expense_record`;
CREATE TABLE `cc_expense_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `expense_money` float DEFAULT NULL,
  `expense_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_expense_record
-- ----------------------------

-- ----------------------------
-- Table structure for cc_goods_inventory
-- ----------------------------
DROP TABLE IF EXISTS `cc_goods_inventory`;
CREATE TABLE `cc_goods_inventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '产品ID',
  `shop_id` int(11) unsigned DEFAULT '0' COMMENT '店铺ID',
  `inventory` int(11) DEFAULT '0' COMMENT '入库数量',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `operation_user` varchar(50) DEFAULT NULL COMMENT '操作用户',
  `operation_admin` varchar(50) DEFAULT NULL COMMENT '操作会员店角色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_goods_inventory
-- ----------------------------

-- ----------------------------
-- Table structure for cc_goods_property
-- ----------------------------
DROP TABLE IF EXISTS `cc_goods_property`;
CREATE TABLE `cc_goods_property` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '产品ID',
  `shop_id` int(11) unsigned DEFAULT '0' COMMENT '店铺ID',
  `price` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '产品价格',
  `inventory` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `model_id` int(11) unsigned DEFAULT '0' COMMENT '模型ID',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '产品排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_goods_property
-- ----------------------------

-- ----------------------------
-- Table structure for cc_group
-- ----------------------------
DROP TABLE IF EXISTS `cc_group`;
CREATE TABLE `cc_group` (
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_group
-- ----------------------------
INSERT INTO `cc_group` VALUES ('1', '普通会员', null, '1', '1', '0', '1', '1', 'point', '0.00', '1', '0', null, '0', '[is_real_name]  < 1', '0');
INSERT INTO `cc_group` VALUES ('2', '合格会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '1', '[is_real_name]  == 1', '0');
INSERT INTO `cc_group` VALUES ('3', '入门会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '2', '[is_real_name]  == 1 &&  [*1|2]  > 5', '0');
INSERT INTO `cc_group` VALUES ('4', '一星会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '3', '[is_real_name]  == 1 &&  [*1|3]  >= 5', '0');
INSERT INTO `cc_group` VALUES ('5', '二星会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '4', '[is_real_name] ==1 &&  [*1|4]  >=  5', '3000');
INSERT INTO `cc_group` VALUES ('6', '三星会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '5', '[is_real_name] ==1  &&  [*1|5]  >= 5', '6000');
INSERT INTO `cc_group` VALUES ('7', '四星会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '6', '[is_real_name]  == 1 &&  [*1|6]  >= 5', '20000');
INSERT INTO `cc_group` VALUES ('8', '五星会员', null, '1', '1', '1', '1', '1', 'money', '0.00', '0', '0', null, '7', '[is_real_name] ==1 &&  [*1|7]  >=  5', '50000');

-- ----------------------------
-- Table structure for cc_install
-- ----------------------------
DROP TABLE IF EXISTS `cc_install`;
CREATE TABLE `cc_install` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `sign` varchar(50) DEFAULT NULL COMMENT '模块标识',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_install
-- ----------------------------

-- ----------------------------
-- Table structure for cc_linkage
-- ----------------------------
DROP TABLE IF EXISTS `cc_linkage`;
CREATE TABLE `cc_linkage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '' COMMENT '名称',
  `parent_id` int(11) DEFAULT NULL COMMENT '父id',
  `is_show` int(11) DEFAULT '1' COMMENT '否是显示',
  `orders` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_linkage
-- ----------------------------
INSERT INTO `cc_linkage` VALUES ('1', '中国', '0', '1', '0');
INSERT INTO `cc_linkage` VALUES ('20', '重庆市', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('17', '北京市', '1', '1', '1');
INSERT INTO `cc_linkage` VALUES ('18', '天津市', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('19', '上海市', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('21', '河北省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('22', '山西省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('24', '辽宁省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('25', '吉林省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('26', '黑龙江省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('27', '江苏省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('28', '浙江省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('29', '安徽省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('30', '福建省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('31', '江西省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('32', '山东省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('33', '河南省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('34', '湖北省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('35', '湖南省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('36', '广东省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('37', '海南省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('38', '四川省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('39', '贵州省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('40', '云南省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('41', '陕西省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('42', '甘肃省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('43', '青海省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('44', '台湾省', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('45', '广西壮族自治区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('46', '内蒙古自治区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('47', '西藏自治区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('48', '宁夏回族自治区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('49', '新疆维吾尔自治区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('50', '香港特别行政区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('52', '太原市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('53', '大同市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('54', '朔州市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('55', '阳泉市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('56', '长治市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('57', '忻州市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('58', '吕梁市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('59', '晋中市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('60', '临汾市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('61', '运城市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('62', '晋城市', '22', '1', '0');
INSERT INTO `cc_linkage` VALUES ('63', '万柏林区', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('64', '杏花岭区', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('65', '小店区', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('66', '尖草坪区', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('67', '晋源区', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('68', '清徐县', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('69', '阳曲县', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('70', '古交市', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('71', '娄烦县', '52', '1', '0');
INSERT INTO `cc_linkage` VALUES ('72', '盐湖区', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('73', '绛县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('74', '夏县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('75', '新绛县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('76', '稷山县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('77', '芮城县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('78', '临猗县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('79', '万荣县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('80', '闻喜县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('81', '垣曲县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('82', '平陆县', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('83', '永济市', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('84', '河津市', '61', '1', '0');
INSERT INTO `cc_linkage` VALUES ('85', '尧都区　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('86', '侯马市　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('87', '霍州市　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('88', '曲沃县　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('89', '翼城县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('90', '襄汾县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('91', '洪洞县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('92', '古　县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('93', '安泽县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('94', '浮山县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('95', '吉　县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('96', '乡宁县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('97', '蒲　县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('98', '大宁县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('99', '永和县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('100', '隰　县　　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('101', '汾西县　　', '60', '1', '0');
INSERT INTO `cc_linkage` VALUES ('102', '榆次区', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('103', '介休市', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('104', '榆社县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('105', '左权县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('106', '和顺县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('107', '昔阳县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('108', '寿阳县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('109', '太谷县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('110', '祁 县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('111', '平遥县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('112', '灵石县', '59', '1', '0');
INSERT INTO `cc_linkage` VALUES ('113', '离石区', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('114', '孝义市', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('115', '汾阳市', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('116', '文水县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('117', '中阳县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('118', '兴　县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('119', '临　县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('120', '方山县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('121', '柳林县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('122', '岚　县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('123', '交口县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('124', '交城县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('125', '石楼县', '58', '1', '0');
INSERT INTO `cc_linkage` VALUES ('126', '忻府区', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('127', '原平市', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('128', '定襄县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('129', '五台县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('130', '代 县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('131', '繁峙县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('132', '宁武县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('133', '静乐县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('134', '神池县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('135', '五寨县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('136', '岢岚县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('137', '河曲县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('138', '保德县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('139', '偏关县', '57', '1', '0');
INSERT INTO `cc_linkage` VALUES ('140', '城区', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('141', '郊区', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('142', '潞城市', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('143', '长治县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('144', '襄垣县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('145', '屯留县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('146', '平顺县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('147', '黎城县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('148', '壶关县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('149', '长子县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('150', '武乡县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('151', '沁县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('152', '沁源县', '56', '1', '0');
INSERT INTO `cc_linkage` VALUES ('153', '城　区', '55', '1', '0');
INSERT INTO `cc_linkage` VALUES ('154', '矿　区', '55', '1', '0');
INSERT INTO `cc_linkage` VALUES ('155', '郊　区', '55', '1', '0');
INSERT INTO `cc_linkage` VALUES ('156', '平定县', '55', '1', '0');
INSERT INTO `cc_linkage` VALUES ('157', '盂　县', '55', '1', '0');
INSERT INTO `cc_linkage` VALUES ('158', '朔城区', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('159', '平鲁区', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('160', '山阴县', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('161', '应县', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('162', '右玉县', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('163', '怀仁县', '54', '1', '0');
INSERT INTO `cc_linkage` VALUES ('164', '大同县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('165', '阳高县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('166', '左云县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('167', '浑源县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('168', '天镇县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('169', '灵丘县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('170', '广灵县', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('171', '新荣区', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('172', '矿区', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('173', '南郊区', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('174', '城区', '53', '1', '0');
INSERT INTO `cc_linkage` VALUES ('175', '渝中区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('176', '大渡口区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('177', '江北区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('178', '沙坪坝区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('179', '九龙坡区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('180', '南岸区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('181', '北碚区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('182', '万盛区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('183', '双桥区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('184', '渝北区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('185', '巴南区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('186', '万州区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('187', '涪陵区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('188', '黔江区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('189', '长寿区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('190', '江津区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('191', '合川区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('192', '永川区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('193', '南川区', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('194', '綦江县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('195', '潼南县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('196', '铜梁县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('197', '大足县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('198', '荣昌县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('199', '璧山县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('200', '垫江县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('201', '武隆县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('202', '丰都县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('203', '城口县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('204', '梁平县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('205', '开县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('206', '巫溪县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('207', '巫山县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('208', '奉节县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('209', '云阳县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('210', '忠县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('211', '石柱土家族自治县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('212', '彭水苗族土家族自治县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('213', '酉阳土家族苗族自治县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('214', '秀山土家族苗族自治县', '20', '1', '0');
INSERT INTO `cc_linkage` VALUES ('215', '和平区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('216', '河西区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('217', '河东区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('218', '红桥区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('219', '南开区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('220', '河北区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('221', '西青区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('222', '津南区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('223', '北辰区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('224', '东丽区', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('225', '汉沽县', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('226', '宝坻县', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('227', '静海县', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('228', '宁河县', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('229', '武清县', '18', '1', '0');
INSERT INTO `cc_linkage` VALUES ('230', '黄浦区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('231', '卢湾区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('232', '徐汇区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('233', '长宁区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('234', '静安区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('235', '普陀区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('236', '闸北区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('237', '虹口区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('238', '杨浦区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('239', '宝山区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('240', '闵行区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('241', '嘉定区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('242', '浦东新区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('243', '松江区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('244', '金山区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('245', '青浦区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('246', '南汇区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('247', '奉贤区', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('248', '崇明县', '19', '1', '0');
INSERT INTO `cc_linkage` VALUES ('249', '东城区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('250', '西城区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('251', '崇文区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('252', '宣武区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('253', '朝阳区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('254', '海淀区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('255', '丰台区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('256', '石景山区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('257', '通州区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('258', '平谷区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('259', '顺义区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('260', '怀柔区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('261', '昌平区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('262', '门头沟区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('263', '房山区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('264', '大兴区', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('265', '密云县', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('266', '延庆县', '17', '1', '0');
INSERT INTO `cc_linkage` VALUES ('299', '湾仔区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('298', '屯门区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('297', '深水埗区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('296', '沙田区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('295', '荃湾区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('294', '南区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('293', '离岛区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('292', '葵青区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('291', '九龙城区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('290', '黄大仙区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('289', '观塘区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('288', '东区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('287', '大埔区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('286', '北区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('285', '澳门特别行政区', '1', '1', '0');
INSERT INTO `cc_linkage` VALUES ('300', '西贡区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('301', '油尖旺区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('302', '元朗区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('303', '中西区', '50', '1', '0');
INSERT INTO `cc_linkage` VALUES ('304', '澳门半岛区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('305', '花地玛堂区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('306', '圣安多尼堂区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('307', '大堂区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('308', '望德堂区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('309', '风顺堂区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('310', '澳门离岛区', '285', '1', '0');
INSERT INTO `cc_linkage` VALUES ('311', '代理1', '63', '1', '0');
INSERT INTO `cc_linkage` VALUES ('312', '代理2', '63', '1', '0');
INSERT INTO `cc_linkage` VALUES ('313', '长风东街', '65', '1', '0');
INSERT INTO `cc_linkage` VALUES ('314', '万科紫台', '313', '1', '0');
INSERT INTO `cc_linkage` VALUES ('315', '龙城大街南，滨河东路东，坞城路西，康宁街北', '65', '1', '0');
INSERT INTO `cc_linkage` VALUES ('316', '', '315', '1', '0');

-- ----------------------------
-- Table structure for cc_menu
-- ----------------------------
DROP TABLE IF EXISTS `cc_menu`;
CREATE TABLE `cc_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序数值',
  `url` varchar(255) DEFAULT NULL COMMENT '菜单链接',
  `url_m` varchar(50) DEFAULT NULL COMMENT '站内链接模块名',
  `url_c` varchar(50) DEFAULT NULL COMMENT '站内链接控制器',
  `url_a` varchar(50) DEFAULT NULL COMMENT '站内链接操作名',
  `url_p` varchar(255) DEFAULT NULL COMMENT '链接的其他参数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '菜单开关',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '模型ID',
  `type` varchar(50) DEFAULT NULL COMMENT '菜单类型 admin为后台菜单，user为会员中心菜单',
  `ico` varchar(255) DEFAULT NULL COMMENT '菜单图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_menu
-- ----------------------------
INSERT INTO `cc_menu` VALUES ('4', '模块', '0', '1', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('5', '模块管理', '4', '10', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('6', '模块列表', '5', '10', '', 'Admin', 'install', 'install_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('7', '设置', '0', '0', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('8', '菜单设置', '7', '1', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('9', '后台菜单', '8', '10', '', 'admin', 'menu', 'menu_list', 'type=admin', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('10', '管理员', '7', '2', '', 'Admin', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('11', '管理列表', '10', '3', '', 'Admin', 'Admin', 'admin_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('12', '基本设置', '7', '0', '', 'Admin', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('13', '基本设置', '12', '0', '', 'Admin', 'Setting', 'Setting', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('14', '会员', '0', '3', '', 'Admin', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('15', '会员管理', '14', '0', '', 'Admin', 'Menu', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('16', '会员列表', '15', '0', '', 'Admin', 'User', 'user_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('17', '网站设置', '12', '0', '', 'Admin', 'Site', 'Site_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('18', '会员组', '15', '0', '', 'Admin', 'User', 'User_group_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('19', '角色管理', '10', '2', '', 'Admin', 'Admin', 'Admin_Role_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('22', '会员字段', '15', '0', '', 'Field', 'Field', 'field_list', 'modelid=2', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('23', '分销', '0', '4', '', 'Fenxiao', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('24', '参数设置', '23', '0', '', 'Fenxiao', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('25', '基本设置', '24', '0', '', 'Fenxiao', 'Setting', 'setting', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('28', '资金', '0', '5', '', 'Accounts', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('30', '资金流水', '28', '0', '', 'Admin', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('31', '流水列表', '30', '0', '', 'Accounts', 'index', 'Accounts_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('32', '提现列表', '28', '0', '', 'Accounts', '', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('33', '查看列表', '32', '0', '', 'Accounts', 'index', 'withdraw_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('34', '增减资金', '30', '0', '', 'Accounts', 'index', 'accounts_alter', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('35', '清理数据', '30', '0', '', 'Accounts', 'index', 'accounts_del', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('36', '内容', '0', '2', '', 'Content', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('40', '内容模型', '36', '0', '', 'sys_model', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('41', '模型列表', '40', '0', '', 'sys_model', 'Index', 'model_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('65', '订单', '0', '7', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('66', '订单管理', '65', '0', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('67', '订单列表', '66', '0', '', 'Order', 'Admin', 'order_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('76', '联动设置', '12', '3', '', 'Linkage', 'Admin', 'linkage_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('78', '店铺管理', '14', '2', '', '', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('79', '店铺列表', '78', '0', '', 'Shop', 'admin', 'shop_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('88', '分类管理', '78', '1', '', 'Shop', 'Admin', 'shop_category_list', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('89', '微信', '0', '0', '', 'Wechat', '', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('90', '微信设置', '89', '0', '', 'Wechat', 'Setting', '', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('91', '基本设置', '90', '0', '', 'Wechat', 'Setting', 'base_setting', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('92', '菜单设置', '90', '1', '', 'Wechat', 'Setting', 'menu_setting', '', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('93', '会员中心', '8', '0', '', 'Admin', 'Menu', 'Menu_list', 'type=user', '1', '0', null, 'admin', null);
INSERT INTO `cc_menu` VALUES ('97', '个人账户', '0', '0', '', 'User', 'index', 'user_info', '', '1', '0', null, 'user', 'glyphicon glyphicon-home');
INSERT INTO `cc_menu` VALUES ('98', '辛勤劳动', '0', '1', '', 'User', 'index', 'work', '', '1', '0', null, 'user', 'glyphicon glyphicon-list-alt');
INSERT INTO `cc_menu` VALUES ('99', '个人审核', '0', '2', '', 'User', 'index', 'auth', '', '1', '0', null, 'user', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('100', '个人资料', '0', '3', '', 'User', 'index', 'data', '', '1', '0', null, 'user', 'glyphicon glyphicon-gift');
INSERT INTO `cc_menu` VALUES ('102', '手机绑定', '0', '7', '', 'User', 'index', 'bundling_info', 'type=mobile', '1', '0', null, 'user', 'glyphicon glyphicon-shopping-cart');
INSERT INTO `cc_menu` VALUES ('103', '修改密码', '0', '6', '', 'User', 'index', 'alter_password', '', '1', '0', null, 'user', 'glyphicon glyphicon-calendar');
INSERT INTO `cc_menu` VALUES ('104', '银行卡绑定', '0', '8', '', 'User', 'index', 'bundling_info', 'type=bank', '1', '0', null, 'user', 'glyphicon glyphicon-headphones');
INSERT INTO `cc_menu` VALUES ('105', '推荐会员', '0', '5', '', 'User', 'index', 'team_list', '', '1', '0', null, 'user', 'glyphicon glyphicon-yen');
INSERT INTO `cc_menu` VALUES ('106', '会员设置', '90', '2', '', 'Wechat', 'Setting', 'user_setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('127', '关键字', '89', '1', '', 'Article', 'Article', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('132', '关键字管理', '127', '0', '', 'Article', 'Article', 'article_list', 'modelid=21', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('141', '关键字系统', '36', '2', null, 'Article', null, null, null, '1', '0', '21', 'admin', null);
INSERT INTO `cc_menu` VALUES ('142', '字段管理', '141', '0', null, 'Field', 'Field', 'field_list', 'modelid=21', '1', '0', '21', 'admin', null);
INSERT INTO `cc_menu` VALUES ('143', '关键字分类', '141', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=21', '1', '0', '21', 'admin', null);
INSERT INTO `cc_menu` VALUES ('144', '内容管理', '141', '2', null, 'Article', 'Article', 'article_list', 'modelid=21', '1', '0', '21', 'admin', null);
INSERT INTO `cc_menu` VALUES ('145', '关键字分类', '127', '0', '', 'Sys_model', 'Class', 'class_list', 'modelid=21', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('146', '核销兑换码', '66', '3', '', 'Order', 'Admin', 'verification_key_admin', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('147', '卖家中心', '8', '3', '', 'Admin', 'Menu', 'Menu_list', 'type=sell', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('148', '店铺信息', '0', '0', '', 'Shop', 'sell', 'shop_info', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('151', '订单管理', '0', '3', '', '', '', '', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('153', '修改店铺信息', '148', '0', '', 'Shop', 'sell', 'alter_shop_info', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('154', '店铺颜色选择', '148', '0', '', 'Shop', 'sell', 'select_color', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('158', '收到的订单', '151', '0', '', 'Shop', 'sell', 'order_list', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('163', '资金设置', '28', '0', '', 'Accounts', 'Setting', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('164', '基本配置', '163', '0', '', 'Accounts', 'Setting', 'setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('165', '支付配置', '163', '1', '', 'Accounts', 'Setting', 'pay_setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('166', '首页菜单', '8', '4', '', 'Admin', 'Menu', 'Menu_list', 'type=index_show', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('167', '全部分类', '0', '0', '', 'Goods', 'index', 'goods_cate_all', '', '1', '0', null, 'index_show', 'glyphicon glyphicon-th');
INSERT INTO `cc_menu` VALUES ('168', '个人中心', '0', '1', '', 'User', 'index', 'index', '', '1', '0', null, 'index_show', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('187', '首页轮播图', '183', '6', '', 'Home', 'index', 'carousel_pic', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('188', '权限分类', '10', '0', '', 'Admin', 'Auth', 'auth_class_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('189', '权限规则', '10', '1', '', 'Admin', 'Auth', 'auth_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('215', '会员代理', '15', '0', '', 'User', 'Agentadmin', 'agent_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('217', '代理设置', '15', '0', '', 'User', 'Agentadmin', 'setting_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('218', '实名认证', '0', '9', '', 'User', 'index', 'bundling_info', 'type=real', '1', '0', null, 'user', 'glyphicon glyphicon-check');
INSERT INTO `cc_menu` VALUES ('220', '现金管理', '0', '11', '', 'User', 'index', 'money', 'model_id=43', '1', '0', null, 'user', 'glyphicon glyphicon-question-sign');
INSERT INTO `cc_menu` VALUES ('222', '首页轮播图', '12', '4', '', 'Home', 'index', 'carousel_pic', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('227', '虚拟产品', '210', '0', '', 'Admin', 'Menu', 'Menu_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('261', '收货地址', '66', '9', '', 'Order', 'Admin', 'shipaddress_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('278', '站内公告系统', '36', '2', null, 'Article', null, null, null, '1', '0', '43', 'admin', null);
INSERT INTO `cc_menu` VALUES ('279', '字段管理', '278', '0', null, 'Field', 'Field', 'field_list', 'modelid=43', '1', '0', '43', 'admin', null);
INSERT INTO `cc_menu` VALUES ('280', '站内公告分类', '278', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=43', '1', '0', '43', 'admin', null);
INSERT INTO `cc_menu` VALUES ('281', '内容管理', '278', '2', null, 'Article', 'Article', 'article_list', 'modelid=43', '1', '0', '43', 'admin', null);
INSERT INTO `cc_menu` VALUES ('282', '清理订单', '66', '4', '', 'Order', 'Admin', 'clear_order', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('284', '提交正能量系统', '36', '2', null, 'Article', null, null, null, '1', '0', '44', 'admin', null);
INSERT INTO `cc_menu` VALUES ('285', '字段管理', '284', '0', null, 'Field', 'Field', 'field_list', 'modelid=44', '1', '0', '44', 'admin', null);
INSERT INTO `cc_menu` VALUES ('286', '提交正能量分类', '284', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=44', '1', '0', '44', 'admin', null);
INSERT INTO `cc_menu` VALUES ('287', '内容管理', '284', '2', null, 'Article', 'Article', 'article_list', 'modelid=44', '1', '0', '44', 'admin', null);
INSERT INTO `cc_menu` VALUES ('288', '图片系统', '36', '2', null, 'Article', null, null, null, '1', '0', '45', 'admin', null);
INSERT INTO `cc_menu` VALUES ('289', '字段管理', '288', '0', null, 'Field', 'Field', 'field_list', 'modelid=45', '1', '0', '45', 'admin', null);
INSERT INTO `cc_menu` VALUES ('290', '图片分类', '288', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=45', '1', '0', '45', 'admin', null);
INSERT INTO `cc_menu` VALUES ('291', '内容管理', '288', '2', null, 'Article', 'Article', 'article_list', 'modelid=45', '1', '0', '45', 'admin', null);
INSERT INTO `cc_menu` VALUES ('300', '红包', '0', '9', '', 'Packets', '', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('301', '活动红包', '300', '0', '', 'Packets', 'Admin', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('302', '管理红包', '301', '0', '', 'Packets', 'Admin', 'packets_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('307', '产品系统', '36', '2', null, 'Group_buy', null, null, null, '1', '0', '49', 'admin', null);
INSERT INTO `cc_menu` VALUES ('308', '字段管理', '307', '0', null, 'Field', 'Field', 'field_list', 'modelid=49', '1', '0', '49', 'admin', null);
INSERT INTO `cc_menu` VALUES ('309', '产品分类', '307', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=49', '1', '0', '49', 'admin', null);
INSERT INTO `cc_menu` VALUES ('310', '内容管理', '307', '2', '', 'Goods', 'Goods', 'goods_list', 'modelid=49', '1', '0', '49', 'admin', '');
INSERT INTO `cc_menu` VALUES ('311', '积分系统', '36', '2', null, 'Group_buy', null, null, null, '1', '0', '50', 'admin', null);
INSERT INTO `cc_menu` VALUES ('312', '字段管理', '311', '0', null, 'Field', 'Field', 'field_list', 'modelid=50', '1', '0', '50', 'admin', null);
INSERT INTO `cc_menu` VALUES ('313', '积分分类', '311', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=50', '1', '0', '50', 'admin', null);
INSERT INTO `cc_menu` VALUES ('314', '内容管理', '311', '2', '', 'Goods', 'Goods', 'goods_list', 'modelid=50', '1', '0', '50', 'admin', '');
INSERT INTO `cc_menu` VALUES ('315', '出售产品', '0', '0', '', 'Shop', '', '', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('316', '出售产品', '315', '0', '', 'Shop', 'Consume', 'index', '', '1', '0', null, 'sell', '');
INSERT INTO `cc_menu` VALUES ('317', '报销设置', '24', '0', '', 'Fenxiao', 'Setting', 'reimbursement_setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('318', '订单报销', '24', '0', '', 'Fenxiao', 'Setting', 'Setting_state', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('320', '手机会员菜单', '8', '6', '', 'Admin', 'Menu', 'Menu_list', 'type=mobile', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('321', '商城首页', '0', '0', '', 'Mobile', 'index', 'index', '', '0', '0', null, 'mobile', 'glyphicon glyphicon-home');
INSERT INTO `cc_menu` VALUES ('322', '我的订单', '0', '1', '', 'mobile', 'order', 'order_list', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-list-alt');
INSERT INTO `cc_menu` VALUES ('323', '我的资料', '0', '2', '', 'Mobile', 'User', 'alter_infomation', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('324', '提现申请', '0', '3', '', 'Mobile', 'User', 'withdraw_list', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-gift');
INSERT INTO `cc_menu` VALUES ('325', '分销中心', '0', '4', '', 'Mobile', 'User', 'team_list', '', '0', '0', null, 'mobile', 'glyphicon glyphicon-sort-by-attributes-alt');
INSERT INTO `cc_menu` VALUES ('326', '购物车', '0', '7', '', 'mobile', 'order', 'my_cart', '', '0', '0', null, 'mobile', 'glyphicon glyphicon-shopping-cart');
INSERT INTO `cc_menu` VALUES ('328', '站内公告', '0', '6', '', 'mobile', 'Article', 'index_list', 'model_id=43', '0', '0', null, 'mobile', 'glyphicon glyphicon-calendar');
INSERT INTO `cc_menu` VALUES ('329', '资金管理', '0', '5', '', 'Mobile', 'Accounts', 'index_list', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-yen');
INSERT INTO `cc_menu` VALUES ('330', '手机首页菜单', '8', '9', '', 'Admin', 'Menu', 'Menu_list', 'type=mobile_index', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('331', '全部分类', '0', '0', '', 'Mobile', 'index', 'cate_all', '', '1', '0', null, 'mobile_index', 'glyphicon glyphicon-th');
INSERT INTO `cc_menu` VALUES ('332', '个人中心', '0', '1', '', 'Mobile', 'user', 'index', '', '1', '0', null, 'mobile_index', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('334', '联系我们', '0', '3', '', 'Article', 'index', 'index_show', 'model_id=54&id=3', '1', '0', null, 'mobile_index', 'glyphicon glyphicon-phone');
INSERT INTO `cc_menu` VALUES ('335', '表单设置', '7', '10', '', 'Form', 'Admin', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('336', '表单管理', '335', '0', '', 'Form', 'Admin', 'form_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('337', '信息提交', '0', '20', '', 'Form', 'User', 'form_list', '', '1', '0', null, 'user', '');
INSERT INTO `cc_menu` VALUES ('342', '查看兑换信息', '66', '8', '', 'Order', 'Admin', 'order_conversion_key', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('343', '会员设置', '15', '0', '', 'User', 'Setting', 'setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('344', '辛勤劳动', '0', '0', '', 'Mobile', 'User', 'work', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-list-alt');
INSERT INTO `cc_menu` VALUES ('345', '详细信息', '0', '10', '', 'Mobile', 'User', 'user_info', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('346', '绑定手机', '0', '11', '', 'Mobile', 'User', 'bundling_info', 'type=mobile', '1', '0', null, 'mobile', 'glyphicon glyphicon-hand-up');
INSERT INTO `cc_menu` VALUES ('347', '实名认证', '0', '12', '', 'Mobile', 'User', 'bundling_info', 'type=real', '1', '0', null, 'mobile', 'glyphicon glyphicon-ok');
INSERT INTO `cc_menu` VALUES ('348', '绑定银行卡', '0', '13', '', 'Mobile', 'User', 'bundling_info', 'type=bank', '1', '0', null, 'mobile', 'glyphicon glyphicon-check');
INSERT INTO `cc_menu` VALUES ('349', '文章系统', '36', '2', null, 'Article', null, null, null, '1', '0', '54', 'admin', null);
INSERT INTO `cc_menu` VALUES ('350', '字段管理', '349', '0', null, 'Field', 'Field', 'field_list', 'modelid=54', '1', '0', '54', 'admin', null);
INSERT INTO `cc_menu` VALUES ('351', '文章分类', '349', '1', null, 'Sys_model', 'Class', 'class_list', 'modelid=54', '1', '0', '54', 'admin', null);
INSERT INTO `cc_menu` VALUES ('352', '内容管理', '349', '2', null, 'Article', 'Article', 'article_list', 'modelid=54', '1', '0', '54', 'admin', null);
INSERT INTO `cc_menu` VALUES ('353', '商城公告', '0', '0', 'http://www.zgdalesong.com/index.php/Article/Index/index_show/model_id/54/id/4.php', '', '', '', '', '0', '0', null, 'index_show', '');
INSERT INTO `cc_menu` VALUES ('354', '审核列表', '0', '14', '', 'Mobile', 'User', 'auth', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-random');
INSERT INTO `cc_menu` VALUES ('355', '我的支付', '0', '0', '', 'Accounts', 'pay', 'ceshi', '', '1', '0', null, 'mobile_index', 'glyphicon glyphicon-user');
INSERT INTO `cc_menu` VALUES ('356', '信息', '0', '10', '', '', '', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('357', '站内信息', '0', '10', '', 'Message', 'User', 'message_list', '', '1', '0', null, 'user', '');
INSERT INTO `cc_menu` VALUES ('358', '基本设置', '356', '0', '', '', '', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('359', '信息设置', '358', '0', '', 'Message', 'Setting', 'setting_integral', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('360', '信息列表', '358', '0', '', 'Admin', 'admin', 'message_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('361', '修改密码', '0', '15', '', 'Mobile', 'User', 'alter_password', '', '1', '0', null, 'mobile', 'glyphicon glyphicon-lock');
INSERT INTO `cc_menu` VALUES ('362', '评论', '0', '11', '', '', '', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('363', '基本设置', '362', '0', '', 'Comment', 'admin', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('364', '评论设置', '363', '0', '', 'Comment', 'admin', 'setting', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('365', '评论列表', '363', '1', '', 'Comment', 'Admin', 'comment_list', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('366', '测试评论', '363', '3', '', 'Comment', 'Admin', 'ceshi', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('367', '广告管理', '7', '0', '', 'Advert', 'Admin', '', '', '1', '0', null, 'admin', '');
INSERT INTO `cc_menu` VALUES ('368', '广告管理', '367', '0', '', 'Advert', 'Admin', 'advert_type_list', '', '1', '0', null, 'admin', '');

-- ----------------------------
-- Table structure for cc_message
-- ----------------------------
DROP TABLE IF EXISTS `cc_message`;
CREATE TABLE `cc_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `send_userid` int(11) unsigned DEFAULT '0' COMMENT '发送信息用户ID',
  `receive_userid` int(11) unsigned DEFAULT '0' COMMENT '接受用户ID',
  `send_status` tinyint(1) unsigned DEFAULT '0' COMMENT '发送信息的状态0表示用户接受方未读，1已读，2删除',
  `receive_status` tinyint(1) unsigned DEFAULT '0' COMMENT '接受信息的状态0未读，1已读，2删除',
  `addtime` int(11) unsigned DEFAULT '0' COMMENT '添加日期',
  `title` varchar(100) DEFAULT NULL COMMENT '短信标题',
  `content` text COMMENT '短信内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_message
-- ----------------------------

-- ----------------------------
-- Table structure for cc_model
-- ----------------------------
DROP TABLE IF EXISTS `cc_model`;
CREATE TABLE `cc_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `table` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '模型的名称',
  `setting` text COMMENT '模型的设置信息',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `type` varchar(50) DEFAULT NULL COMMENT '模型类型 ',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '模型状态 0关闭 1开启',
  `model_class` varchar(50) DEFAULT NULL COMMENT '系统模型类bie content:内容模型，form:表单模型',
  `sign` varchar(50) DEFAULT NULL COMMENT '模型唯一标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_model
-- ----------------------------
INSERT INTO `cc_model` VALUES ('1', 'article', '文章', '', null, null, null, null, null);
INSERT INTO `cc_model` VALUES ('2', 'user', '会员', null, '0', null, null, null, null);
INSERT INTO `cc_model` VALUES ('21', 'wechat', '关键字', 'array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'point_type\\\' => \\\'money\\\',\n  \\\'charg_open\\\' => \\\'1\\\',\n  \\\'verify\\\' => \\\'1\\\',\n  \\\'id\\\' => \\\'21\\\',\n)', '0', 'Article', '1', 'content', 'wechat');
INSERT INTO `cc_model` VALUES ('43', 'notice', '站内公告', null, '0', 'Article', '1', 'content', 'notice');
INSERT INTO `cc_model` VALUES ('44', 'coin_get', '正能量', 'array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'point_type\\\' => \\\'money\\\',\n  \\\'charg_open\\\' => \\\'0\\\',\n  \\\'verify\\\' => \\\'0\\\',\n  \\\'recommend_day\\\' => \\\'\\\',\n  \\\'verify_money\\\' => \\\'\\\',\n  \\\'verify_amount\\\' => \\\'0.5\\\',\n  \\\'verify_point\\\' => \\\'\\\',\n  \\\'verify_promote_point\\\' => \\\'\\\',\n  \\\'release\\\' => \\\'1\\\',\n  \\\'release_money\\\' => \\\'\\\',\n  \\\'release_amount\\\' => \\\'0.5\\\',\n  \\\'release_point\\\' => \\\'\\\',\n  \\\'release_promote_point\\\' => \\\'\\\',\n  \\\'release_8\\\' => \\\'1\\\',\n  \\\'release_7\\\' => \\\'1\\\',\n  \\\'release_6\\\' => \\\'1\\\',\n  \\\'release_5\\\' => \\\'1\\\',\n  \\\'release_4\\\' => \\\'1\\\',\n  \\\'release_3\\\' => \\\'1\\\',\n  \\\'release_2\\\' => \\\'1\\\',\n  \\\'release_1\\\' => \\\'1\\\',\n  \\\'id\\\' => \\\'44\\\',\n)', '0', 'Article', '1', 'content', 'coin_get');
INSERT INTO `cc_model` VALUES ('45', 'coin_get_pic', '图片', 'array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'charg_open\\\' => \\\'0\\\',\n  \\\'verify\\\' => \\\'0\\\',\n  \\\'recommend_day\\\' => \\\'3\\\',\n  \\\'verify_money\\\' => \\\'\\\',\n  \\\'verify_amount\\\' => \\\'0.5\\\',\n  \\\'verify_point\\\' => \\\'\\\',\n  \\\'verify_promote_point\\\' => \\\'\\\',\n  \\\'release\\\' => \\\'1\\\',\n  \\\'release_money\\\' => \\\'\\\',\n  \\\'release_amount\\\' => \\\'0.5\\\',\n  \\\'release_point\\\' => \\\'\\\',\n  \\\'release_promote_point\\\' => \\\'\\\',\n  \\\'release_8\\\' => \\\'1\\\',\n  \\\'release_7\\\' => \\\'1\\\',\n  \\\'release_6\\\' => \\\'1\\\',\n  \\\'release_5\\\' => \\\'1\\\',\n  \\\'release_4\\\' => \\\'1\\\',\n  \\\'release_3\\\' => \\\'1\\\',\n  \\\'release_2\\\' => \\\'1\\\',\n  \\\'release_1\\\' => \\\'1\\\',\n  \\\'id\\\' => \\\'45\\\',\n)', '0', 'Article', '1', 'content', 'coin_get_pic');
INSERT INTO `cc_model` VALUES ('49', 'product', '产品', 'array (\n  \\\'open\\\' => \\\'0\\\',\n  \\\'point_type\\\' => \\\'point\\\',\n  \\\'goods_type\\\' => \\\'0\\\',\n  \\\'verify\\\' => \\\'0\\\',\n  \\\'recommend_day\\\' => \\\'\\\',\n  \\\'verify_money\\\' => \\\'\\\',\n  \\\'verify_amount\\\' => \\\'\\\',\n  \\\'verify_point\\\' => \\\'\\\',\n  \\\'verify_promote_point\\\' => \\\'\\\',\n  \\\'release\\\' => \\\'0\\\',\n  \\\'release_money\\\' => \\\'\\\',\n  \\\'release_amount\\\' => \\\'\\\',\n  \\\'release_point\\\' => \\\'\\\',\n  \\\'release_promote_point\\\' => \\\'\\\',\n  \\\'id\\\' => \\\'49\\\',\n)', '0', 'Goods', '1', 'content', 'product');
INSERT INTO `cc_model` VALUES ('50', 'point', '积分', 'array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'point_type\\\' => \\\'point\\\',\n  \\\'goods_type\\\' => \\\'0\\\',\n  \\\'verify\\\' => \\\'1\\\',\n  \\\'recommend_day\\\' => \\\'\\\',\n  \\\'verify_money\\\' => \\\'\\\',\n  \\\'verify_amount\\\' => \\\'\\\',\n  \\\'verify_point\\\' => \\\'\\\',\n  \\\'verify_promote_point\\\' => \\\'\\\',\n  \\\'release\\\' => \\\'0\\\',\n  \\\'release_money\\\' => \\\'\\\',\n  \\\'release_amount\\\' => \\\'\\\',\n  \\\'release_point\\\' => \\\'\\\',\n  \\\'release_promote_point\\\' => \\\'\\\',\n  \\\'release_8\\\' => \\\'\\\',\n  \\\'release_7\\\' => \\\'\\\',\n  \\\'release_6\\\' => \\\'\\\',\n  \\\'release_5\\\' => \\\'\\\',\n  \\\'release_4\\\' => \\\'\\\',\n  \\\'release_3\\\' => \\\'\\\',\n  \\\'release_2\\\' => \\\'\\\',\n  \\\'release_1\\\' => \\\'\\\',\n  \\\'id\\\' => \\\'50\\\',\n)', '0', 'Goods', '1', 'content', 'point');
INSERT INTO `cc_model` VALUES ('51', 'assurance', '保险送积分', 'array (\n  \\\'open\\\' => \\\'1\\\',\n  \\\'start_time\\\' => \\\'\\\',\n  \\\'end_time\\\' => \\\'\\\',\n  \\\'id\\\' => \\\'51\\\',\n)', '0', null, null, 'form', null);
INSERT INTO `cc_model` VALUES ('54', 'article', '文章', null, '0', 'Article', '1', 'content', 'article');

-- ----------------------------
-- Table structure for cc_notice
-- ----------------------------
DROP TABLE IF EXISTS `cc_notice`;
CREATE TABLE `cc_notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT '请输入内容',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `price` float(15,2) DEFAULT '0.00' COMMENT '浏览价格',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_notice
-- ----------------------------

-- ----------------------------
-- Table structure for cc_order
-- ----------------------------
DROP TABLE IF EXISTS `cc_order`;
CREATE TABLE `cc_order` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_order
-- ----------------------------

-- ----------------------------
-- Table structure for cc_order_conversion_key
-- ----------------------------
DROP TABLE IF EXISTS `cc_order_conversion_key`;
CREATE TABLE `cc_order_conversion_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_id` int(11) DEFAULT '0' COMMENT '订单详情ID',
  `conversion_key` varchar(255) DEFAULT NULL COMMENT '兑换码',
  `valid_time` int(11) DEFAULT '0' COMMENT '到期时间',
  `usering` int(11) DEFAULT '0' COMMENT '是否使用',
  `oprater_shop_shop` int(11) DEFAULT '0' COMMENT '销码店铺 0为本店铺销码 其他为别的店铺销码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_order_conversion_key
-- ----------------------------

-- ----------------------------
-- Table structure for cc_order_info
-- ----------------------------
DROP TABLE IF EXISTS `cc_order_info`;
CREATE TABLE `cc_order_info` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_order_info
-- ----------------------------

-- ----------------------------
-- Table structure for cc_packets
-- ----------------------------
DROP TABLE IF EXISTS `cc_packets`;
CREATE TABLE `cc_packets` (
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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_packets
-- ----------------------------

-- ----------------------------
-- Table structure for cc_point
-- ----------------------------
DROP TABLE IF EXISTS `cc_point`;
CREATE TABLE `cc_point` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '名称',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
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
  `bar_code` varchar(255) DEFAULT '0' COMMENT '条形码',
  `money` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '会员资金',
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员点数，可以是小数',
  `point` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员积分',
  `inventory` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`),
  KEY `bar_code` (`bar_code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_point
-- ----------------------------

-- ----------------------------
-- Table structure for cc_product
-- ----------------------------
DROP TABLE IF EXISTS `cc_product`;
CREATE TABLE `cc_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '名称',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `price` float(15,2) DEFAULT '0.00' COMMENT '请输入商品价格\r\n',
  `market_price` float(15,2) unsigned DEFAULT '0.00' COMMENT '市场售价',
  `separate_num` float(15,2) DEFAULT '0.00' COMMENT '产品固定分成金额，如果按照产品价格分成，请输入0',
  `promote_point` bigint(20) DEFAULT '0' COMMENT '会员升级时候需要的经验点数，-1表示赠送等值商品价格的点数，0表示不赠送，此点数不可以消费，只能用来升级',
  `separate_scale` varchar(255) DEFAULT '0' COMMENT '为空，表示按照全局设置的比例分成,A(10)-&gt;B(20)-&gt;C(30)-&gt;购买者（0）,比例格式为：0,30,20,10',
  `pictures` text COMMENT '产品图集',
  `content` text NOT NULL COMMENT '商品介绍',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT '缩略图',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布人ID',
  `autho_admin` varchar(255) NOT NULL DEFAULT '0' COMMENT '用户类型',
  `verify` tinyint(11) unsigned DEFAULT '0' COMMENT '审核',
  `bar_code` varchar(255) DEFAULT '0' COMMENT '条形码',
  `money` float(15,2) DEFAULT '0.00' COMMENT '-1表示赠送等值商品价格的积分，0表示不赠送',
  `amount` float(15,2) DEFAULT '0.00' COMMENT '-1表示赠送等值商品价格的积分，0表示不赠送',
  `point` float(15,2) DEFAULT '0.00' COMMENT '-1表示赠送等值商品价格的积分，0表示不赠送',
  `inventory` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`),
  KEY `bar_code` (`bar_code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_product
-- ----------------------------

-- ----------------------------
-- Table structure for cc_role
-- ----------------------------
DROP TABLE IF EXISTS `cc_role`;
CREATE TABLE `cc_role` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_role
-- ----------------------------
INSERT INTO `cc_role` VALUES ('1', '超级管理', null, '1', '1', '0', null, '0', '1');
INSERT INTO `cc_role` VALUES ('9', '网站管理员', null, '1', '1', '0', null, '0', '0');
INSERT INTO `cc_role` VALUES ('10', '网站编辑', null, '1', '1', '0', '24,32,28,36,100,35,31,56,146,69', '0', '0');
INSERT INTO `cc_role` VALUES ('11', '市级代理', null, '1', '1', '0', '275,276,277,279,278', '0', '0');
INSERT INTO `cc_role` VALUES ('12', '财务', null, '1', '1', '0', '392,67,66,65,64,63,62', '0', '0');
INSERT INTO `cc_role` VALUES ('13', '上传图片', null, '1', '1', '0', '366,367,368,370,369', '0', '0');

-- ----------------------------
-- Table structure for cc_ship_address
-- ----------------------------
DROP TABLE IF EXISTS `cc_ship_address`;
CREATE TABLE `cc_ship_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_ship_address
-- ----------------------------

-- ----------------------------
-- Table structure for cc_shop
-- ----------------------------
DROP TABLE IF EXISTS `cc_shop`;
CREATE TABLE `cc_shop` (
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_shop
-- ----------------------------
INSERT INTO `cc_shop` VALUES ('17', '46', '生鲜水果', '时令鲜果，低价直达  ', '/upload/admin/1/1466046868_1634678226.jpg', 'style6', '0', '18', '1466154185', '315', '112.555703', '37.778487', '平阳路', '', '3', '', '今天休息', '0');
INSERT INTO `cc_shop` VALUES ('22', '70', '龙城超市', '生鲜水果，零食特产', '/upload/user/46/1467455355_1126335379.png', 'style2', '0', '23', '1467455414', null, '0', '0', '平阳路', '15135144441', '5', null, null, '0');
INSERT INTO `cc_shop` VALUES ('24', '97', '测试', '11111', '', 'style1', '0', '0', null, null, '112.553216', '37.851719', null, null, '0', null, null, '0');
INSERT INTO `cc_shop` VALUES ('25', '128', '毛笔', '毛笔', '/upload/admin/1/1470303033_1742136247.jpg', 'style1', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cc_shop` VALUES ('26', '134', 'xiaoyan', 'asas', '/upload/user/133/1470392263_1296981243.jpg', 'style1', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cc_shop` VALUES ('27', '137', '大乐送山西太原娄烦店', '1', '', 'style1', '0', '0', null, null, '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cc_shop` VALUES ('28', '165', '河南通许免费体验中心', '0元车险+超市', '/upload/user/133/1470392263_1296981243.jpg', 'style6', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cc_shop` VALUES ('30', '259', '大乐送山西涧河店', '加盟商', '/upload/admin/1/1472032455_1150283326.jpg', 'style7', '0', null, null, '0', '112.553216', '37.851719', null, null, '10', null, null, '0');
INSERT INTO `cc_shop` VALUES ('36', '313', '大乐送河南周口店', '河南周口店', '/upload/user/277/1472451835_1659463789.jpg', 'style1', '0', '0', '1472532561', null, '112.553216', '37.851719', null, null, '10', null, null, '0');

-- ----------------------------
-- Table structure for cc_shop_category
-- ----------------------------
DROP TABLE IF EXISTS `cc_shop_category`;
CREATE TABLE `cc_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '上级id',
  `is_show` int(11) DEFAULT '0' COMMENT '否是显示 0显示 1不显示',
  `orders` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_shop_category
-- ----------------------------
INSERT INTO `cc_shop_category` VALUES ('22', '家居用品', '0', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('21', '花卉植物', '0', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('20', '零食特产', '0', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('23', '同城超市', '0', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('24', '超市', '23', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('25', '超市', '24', '1', '0');
INSERT INTO `cc_shop_category` VALUES ('26', '其他', '0', '1', '1000');
INSERT INTO `cc_shop_category` VALUES ('18', '生鲜水果', '0', '1', '0');

-- ----------------------------
-- Table structure for cc_site
-- ----------------------------
DROP TABLE IF EXISTS `cc_site`;
CREATE TABLE `cc_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `domain` varchar(255) NOT NULL COMMENT '网站域名',
  `setting` text COMMENT '网站设置',
  `status` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_site
-- ----------------------------
INSERT INTO `cc_site` VALUES ('2', '大乐送商城', 'www.zgdalesong.com', null, '1');

-- ----------------------------
-- Table structure for cc_system_accounts
-- ----------------------------
DROP TABLE IF EXISTS `cc_system_accounts`;
CREATE TABLE `cc_system_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `amount` float(11,2) DEFAULT NULL COMMENT '金额',
  `order_sn` varchar(255) DEFAULT NULL COMMENT '订单号',
  `percentage` int(11) DEFAULT NULL COMMENT '抽取比例',
  `shop_id` int(11) DEFAULT NULL COMMENT '店铺id',
  `pay_type` int(11) DEFAULT '0' COMMENT '支付类型',
  `coin_type` varchar(255) DEFAULT NULL COMMENT '币种',
  `c_type` int(11) DEFAULT '0' COMMENT '操作类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_system_accounts
-- ----------------------------
INSERT INTO `cc_system_accounts` VALUES ('45', '1467896628', '0.01', '41%7C1467797633|用户充值1467896628', '100', '0', '4', 'money', '1');
INSERT INTO `cc_system_accounts` VALUES ('46', '1467912051', '0.01', '41%7C1467797633|用户充值1467912051', '100', '0', '4', 'money', '1');

-- ----------------------------
-- Table structure for cc_sys_model
-- ----------------------------
DROP TABLE IF EXISTS `cc_sys_model`;
CREATE TABLE `cc_sys_model` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '系统模型名称',
  `type` varchar(50) DEFAULT NULL COMMENT '系统模型类型 article:文章  groupbuy:团购',
  `setting` text COMMENT '系统模型的设置',
  `status` tinyint(3) unsigned DEFAULT NULL COMMENT '是否开启，0关闭，1开启',
  `model_class` varchar(50) DEFAULT NULL COMMENT '系统模型类别  content:内容模型，form:表单模型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_sys_model
-- ----------------------------
INSERT INTO `cc_sys_model` VALUES ('1', '文章', 'Article', null, '1', null);
INSERT INTO `cc_sys_model` VALUES ('2', '团购', 'Group_buy', null, '1', null);
INSERT INTO `cc_sys_model` VALUES ('3', '商城', 'Goods', null, '1', null);

-- ----------------------------
-- Table structure for cc_sys_model_class
-- ----------------------------
DROP TABLE IF EXISTS `cc_sys_model_class`;
CREATE TABLE `cc_sys_model_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '模型分类',
  `sort` int(10) unsigned DEFAULT NULL COMMENT '分类的排序',
  `parent_id` int(11) unsigned DEFAULT NULL COMMENT '父分类的id',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '所属模型的模型ID',
  `status` tinyint(11) unsigned DEFAULT NULL COMMENT '是否开启，1开启 0关闭',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_sys_model_class
-- ----------------------------
INSERT INTO `cc_sys_model_class` VALUES ('3', '测试分类', '0', '0', '21', '1');
INSERT INTO `cc_sys_model_class` VALUES ('28', '洗护用品', '0', '27', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('27', '日用品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('23', '提交正能量', '0', '0', '44', '1');
INSERT INTO `cc_sys_model_class` VALUES ('24', '提交图片', '1', '0', '44', '1');
INSERT INTO `cc_sys_model_class` VALUES ('29', '厨房用品', '0', '29', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('30', '汽车用品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('47', '生活用品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('32', '户外用品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('33', '行车记录仪', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('34', '车载电源', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('35', '车载净化器', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('36', '车载吸尘器', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('37', '洗车液', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('38', '擦车巾', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('39', '通用车套', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('40', '汽车蜡', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('41', '精美挂件', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('42', '海绵', '0', '30', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('43', '汽艇', '0', '32', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('44', '帐篷', '0', '32', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('45', '山地自行车', '0', '32', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('46', '户外水壶', '0', '32', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('48', '厨房用品', '0', '47', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('49', '家居家纺', '0', '47', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('50', '电热锅', '0', '48', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('51', '厨房刀具', '0', '48', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('52', '生态被', '0', '49', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('53', '羊毛被', '0', '49', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('54', '蚕丝被', '0', '49', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('55', '加湿器', '0', '49', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('56', '按摩器', '0', '49', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('57', '洗护化妆', '0', '47', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('58', '洗发露', '0', '57', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('59', '数码电器', '0', '47', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('60', '迷你音响', '0', '59', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('61', '箱包', '0', '47', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('62', '工艺礼品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('63', '火机烟具', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('64', '瑞士军刀', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('65', '精品工艺', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('66', '精品手串', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('67', '收藏品', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('68', '创意礼品', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('69', '陶瓷刀', '0', '62', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('70', '儿童玩具/小吃零食', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('71', '遥控车', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('72', '遥控飞机', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('73', '毛绒玩偶', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('74', '抱枕', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('75', '拖拉机玩具', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('76', '汽车用品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('77', '行车记录仪', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('78', '车载电源', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('79', '车载净化器', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('80', '车载吸尘器', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('81', '洗车液', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('82', '擦车巾', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('83', '通用车套', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('84', '汽车蜡', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('85', '精品挂件', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('86', '海绵', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('87', '户外用品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('88', '汽艇', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('89', '帐篷', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('90', '山地自行车', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('91', '户外运动水壶', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('92', '工艺礼品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('93', '火机烟具', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('94', '瑞士军刀', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('95', '精品工艺', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('96', '精品手串', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('97', '收藏品', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('98', '创意礼品', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('99', '陶瓷刀', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('100', '酒水', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('101', '啤酒', '0', '100', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('102', '白酒', '0', '100', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('103', '洋酒', '0', '100', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('104', '葡萄酒', '0', '100', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('105', '生活用品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('106', '厨房用品', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('107', '家居家纺', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('108', '洗护化妆', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('109', '数码电器', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('110', '电热锅', '0', '106', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('111', '厨房刀具', '0', '106', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('112', '生态被', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('113', '羊毛被', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('114', '加湿器', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('115', '按摩器', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('116', '蚕丝被', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('117', '洗发露', '0', '108', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('118', '迷你音响', '0', '109', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('119', '玩具', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('120', '遥控车', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('121', '遥控飞机', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('122', '毛绒玩偶', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('123', '抱枕', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('124', '拖拉机玩具', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('125', '洁面仪', '0', '108', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('126', '日常用品', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('127', '遮阳挡 ', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('128', '乐器', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('129', '脚踏板', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('130', '衣柜', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('131', '榨汁机', '0', '106', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('132', '床单', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('133', '渔具/鱼饵', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('134', '箱包', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('135', '洗车器', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('136', '护外包', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('137', '手表', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('138', '车载冰箱', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('139', '汽车电热毯', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('140', '电热毯', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('141', '一次性物品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('142', '儿童用品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('143', '水杯', '0', '126', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('144', '服装', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('145', '服装/饰品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('146', '男装', '0', '145', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('147', '女装', '0', '145', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('148', '特产', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('149', '保健酒', '0', '100', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('150', '户外运动衣', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('151', '剃须刀', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('152', '按摩器', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('153', '充电宝', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('154', '食品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('155', '茶/茶具', '0', '92', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('158', '头盔', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('157', '水杯', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('159', '车模', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('160', '积木', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('161', '变形玩具', '0', '70', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('162', '食品', '0', '0', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('163', '饮料', '0', '162', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('164', '固体食品', '0', '162', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('165', '牙膏', '0', '57', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('166', '洗洁精', '0', '57', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('167', '洗衣粉', '0', '57', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('168', '卫生纸', '0', '27', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('169', '卫生巾', '0', '27', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('170', '副食品', '0', '162', '49', '1');
INSERT INTO `cc_sys_model_class` VALUES ('171', '帮助', '0', '0', '54', '1');
INSERT INTO `cc_sys_model_class` VALUES ('172', '关于我们', '0', '0', '43', '1');
INSERT INTO `cc_sys_model_class` VALUES ('173', '奶', '0', '154', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('174', '电子玩具', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('175', '其他玩具', '0', '119', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('176', '饼干', '0', '154', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('177', '饮料', '0', '154', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('178', '小吃', '0', '154', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('179', '其他', '0', '107', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('180', '首饰', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('181', '其他', '0', '87', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('182', '其他', '0', '105', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('183', '其他', '0', '180', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('184', '其他', '0', '76', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('185', '办公用品', '0', '0', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('186', '笔', '0', '185', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('187', '本', '0', '185', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('188', '其他', '0', '185', '50', '1');
INSERT INTO `cc_sys_model_class` VALUES ('189', '其他', '0', '0', '49', '1');

-- ----------------------------
-- Table structure for cc_table_field
-- ----------------------------
DROP TABLE IF EXISTS `cc_table_field`;
CREATE TABLE `cc_table_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '数据表字段id',
  `field` varchar(50) DEFAULT '' COMMENT '数据表字段名称',
  `title` varchar(50) DEFAULT NULL COMMENT '数据表字段别名',
  `group` varchar(50) DEFAULT NULL COMMENT '字段所在的分组',
  `table` varchar(50) DEFAULT NULL COMMENT '字段所在的表的名称',
  `remarks` text COMMENT '字段备注信息',
  `setting` text COMMENT '字段设置配置的参数',
  `form_type` varchar(50) DEFAULT NULL COMMENT '字段表单类型',
  `sort` int(10) unsigned DEFAULT '0' COMMENT '排序数值',
  `is_user_submit` text COMMENT '前台提交',
  `is_user_show` text COMMENT '前台显示',
  `is_user_edit` text COMMENT '是否允许会员进行编辑',
  `is_admin_submit` text COMMENT '后台角色提交',
  `is_admin_show` text COMMENT '后台是否显示',
  `is_admin_edit` text COMMENT '后台角色是否编辑',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '否开启 1开启 0关闭',
  `is_del` tinyint(2) unsigned DEFAULT '0' COMMENT '是否不可删除，1表示不可删除',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `show_tem` text COMMENT '前台显示模板内容',
  `tem_c` text COMMENT '表单模板内容',
  `template_type` varchar(100) DEFAULT NULL COMMENT '模板文件名称',
  `tem_mobile_c` text NOT NULL COMMENT '手机模板内容',
  `template_mobile_type` varchar(100) NOT NULL COMMENT '手机模板文件',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=547 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_table_field
-- ----------------------------
INSERT INTO `cc_table_field` VALUES ('1', 'email', '邮箱', '0', 'user', '请输入邮箱', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'^\\\\\\\\\\\\\\\\w+((-\\\\\\\\\\\\\\\\w+)|(\\\\\\\\\\\\\\\\.\\\\\\\\\\\\\\\\w+))*\\\\\\\\\\\\\\\\@[A-Za-z0-9]+((\\\\\\\\\\\\\\\\.|-)[A-Za-z0-9]+)*\\\\\\\\\\\\\\\\.[A-Za-z0-9]+$\\\',\n  \\\'reg_exp_pro\\\' => \\\'格式不正确\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '10', null, '', '', null, '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', '');
INSERT INTO `cc_table_field` VALUES ('2', 'recommend', '推荐人ID', '0', 'user', '请输入推荐人ID', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'data1\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$_GET[recommend]]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '-1', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"form-group\">\r\n<label class=\"col-sm-2 control-label\" for=\"formGroupInputSmall\"><span class=\"glyphicon glyphicon-pencil\"></span> [title]</label>\r\n   <div class=\"col-sm-10\">\r\n   <input name=\"[field]\" type=\"text\" class=\"form-control\"  id=\"[field]\" value=\"[default_]\"  [property] placeholder=\"请输入确认密码\">\r\n   <div id=\"[title]Tip\" class=\"alert\"></div>\r\n   </div>\r\n</div>', 'text_3.html');
INSERT INTO `cc_table_field` VALUES ('103', 'openid', '微信OPENID', '0', 'user', '微信OPENID', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('104', 'nickname', '昵称', '0', 'user', '昵称', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('173', 'title', '文章标题', '0', 'wechat', '请输入文字标题', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '10,9', '10,9', '10,9', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('174', 'description', '简介', '0', 'wechat', '内容简短说明', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'46\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'html\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'textarea', '1', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html', '', 'textarea_1.html');
INSERT INTO `cc_table_field` VALUES ('175', 'content', '内容', '0', 'wechat', ' ', 'array (\n  \\\'width\\\' => \\\'100%\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'editor_link\\\' => \\\'0\\\',\n  \\\'editor_link_num\\\' => \\\'0\\\',\n  \\\'editor_link_type\\\' => \\\'1\\\',\n  \\\'editor_save\\\' => \\\'1\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)', 'editor', '2', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n</div>', 'editor_simplify .html', '', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('177', 'thumb', '缩略图', '0', 'wechat', ' ', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'width\\\' => \\\'100\\\',\n  \\\'height\\\' => \\\'100\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n)', 'image', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve]/> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-1 font_color_4\" ><button type=\"button\" class=\"btn btn-success btn-sm\" [onvev] >上传</button></div>\r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('178', 'autho_id', '发布人ID', '0', 'wechat', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('179', 'autho_admin', '用户类型', '0', 'wechat', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '6', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('180', 'addtime', '添加日期', '0', 'wechat', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('181', 'type', '回复类型', '0', 'wechat', ' ', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'box_list\\\' => \\\'文本=1\r\n图文=2\\\',\n  \\\'default_\\\' => \\\'1\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'format\\\' => \\\'1\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'box', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n<div class=\"col-md-4 padding_7\">\r\n	<div class=\"col-md-2 left padding_5 sizefont_12\">[title]</div> \r\n<div class=\"col-md-10\">[loop]<label class=\"radio-inline\" ><input name=\"[field]\"   type=\"radio\" id=\"[field]\" value=\"[value]\" data-switch-no-init>[text]</label>\r\n[/loop]</div>\r\n</div>\r\n</div>', 'radio_1.html', '', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('182', 'keyword', '关键字', '0', 'wechat', '请输入关键字，多个关键字用逗号隔开', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('271', 'birthday', '生日', '0', 'user', '生日', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('350', 'qrcode_open', '开通二维码', null, 'user', '是否开通二维码自动，0表示开通，1表示未开通', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'5\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('387', 'verify', '审核', '1', 'notice', '  ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '0', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('388', 'title', '文章标题', '0', 'notice', '请输入文字标题', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '10,9', '10,9', '10,9', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('389', 'description', '简介', '0', 'notice', '内容简短说明', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'46\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'html\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'textarea', '1', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html', '', 'textarea_1.html');
INSERT INTO `cc_table_field` VALUES ('390', 'content', '内容', '0', 'notice', '请输入内容', 'array (\n  \\\'width\\\' => \\\'0\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'editor_link\\\' => \\\'0\\\',\n  \\\'editor_link_num\\\' => \\\'0\\\',\n  \\\'editor_link_type\\\' => \\\'1\\\',\n  \\\'editor_save\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)', 'editor', '2', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('391', 'price', '浏览价格', '0', 'notice', '浏览价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('392', 'thumb', '缩略图', '0', 'notice', '缩略图', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'image', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('393', 'autho_id', '发布人ID', '0', 'notice', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('394', 'autho_admin', '用户类型', '0', 'notice', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '6', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('395', 'addtime', '添加日期', '0', 'notice', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('396', 'promote_point', '升级点数', null, 'user', '升级点数', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('397', 'year_consumption', '年消费', '3', 'user', '年消费', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '88', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('398', 'month_consumption', '月消费', '3', 'user', '月消费', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '89', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('399', 'day_consumption', '日消费', '3', 'user', '日消费', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '90', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('400', 'total_consumption', '累计消费', '3', 'user', '累计消费', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '91', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('401', 'year_order', '年订单', '3', 'user', '年订单', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '90', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('402', 'month_order', '月订单', '3', 'user', '月订单', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '91', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('403', 'day_order', '日订单', '3', 'user', '日订单', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '92', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('404', 'total_order', '总订单', '3', 'user', '总订单', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '93', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('405', 'time_consumption', '更新消费时间', '3', 'user', '更新消费时间', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '94', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('406', 'time_order', '订单更新时间', '3', 'user', '订单更新时间', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '95', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('407', 'day_recommend', '日推荐人数', '3', 'user', '日推荐人数', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '96', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('408', 'month_recommend', '月推荐人数', '3', 'user', '月推荐人数', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '97', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('409', 'year_recommend', '年推荐人数', '3', 'user', '年推荐人数', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '98', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('410', 'time_recommend', '推荐更新时间', '3', 'user', '推荐更新时间', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '99', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('412', 'verify', '审核', '1', 'coin_get', '  ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '0', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('413', 'title', '文章标题', '0', 'coin_get', '请输入文字标题', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '10,9', '10,9', '10,9', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('414', 'description', '简介', '0', 'coin_get', '内容简短说明', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'46\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'html\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'textarea', '1', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html', '', 'textarea_1.html');
INSERT INTO `cc_table_field` VALUES ('415', 'content', '内容', '0', 'coin_get', '请输入内容', 'array (\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'200\\\',\r\n  \\\'editor_link\\\' => \\\'0\\\',\r\n  \\\'editor_link_num\\\' => \\\'0\\\',\r\n  \\\'editor_link_type\\\' => \\\'1\\\',\r\n  \\\'editor_save\\\' => \\\'1\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'editor', '2', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('416', 'price', '浏览价格', '0', 'coin_get', '浏览价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('417', 'thumb', '缩略图', '0', 'coin_get', '缩略图', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'image', '4', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('418', 'autho_id', '发布人ID', '0', 'coin_get', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('419', 'autho_admin', '用户类型', '0', 'coin_get', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '6', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('420', 'addtime', '添加日期', '0', 'coin_get', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('421', 'verify', '审核', '1', 'coin_get_pic', '  ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '0', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('422', 'title', '文章标题', '0', 'coin_get_pic', '请输入文字标题', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '10,9', '10,9', '10,9', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('423', 'description', '简介', '0', 'coin_get_pic', '内容简短说明', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'46\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'html\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'textarea', '1', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html', '', 'textarea_1.html');
INSERT INTO `cc_table_field` VALUES ('424', 'content', '内容', '0', 'coin_get_pic', '请输入内容', 'array (\r\n  \\\'width\\\' => \\\'100%\\\',\r\n  \\\'height\\\' => \\\'200\\\',\r\n  \\\'editor_link\\\' => \\\'0\\\',\r\n  \\\'editor_link_num\\\' => \\\'0\\\',\r\n  \\\'editor_link_type\\\' => \\\'1\\\',\r\n  \\\'editor_save\\\' => \\\'1\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'editor', '2', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('425', 'price', '浏览价格', '0', 'coin_get_pic', '浏览价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('426', 'thumb', '缩略图', '0', 'coin_get_pic', '缩略图', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'image', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('427', 'autho_id', '发布人ID', '0', 'coin_get_pic', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('428', 'autho_admin', '用户类型', '0', 'coin_get_pic', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '6', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('429', 'addtime', '添加日期', '0', 'coin_get_pic', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('448', 'real_name_authentication', '实名认证信息', '', 'user', '实名认证信息 格式 姓名,身份证号,身份证图片', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('449', 'mobile', '手机绑定', '', 'user', '绑定手机号码 11位数字', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'11\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/\\\',\n  \\\'reg_exp_pro\\\' => \\\'不正确的手机号码\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('450', 'bank_authentication', '绑定银行卡', '', 'user', '绑定银行卡信息 格式 卡号,地区id,银行名称,开户行', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('451', 'is_real_name', '是否通过实名认证', '', 'user', '0未通过，1通过', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('452', 'is_bank_auth', '是否绑定银行卡', '', 'user', '0未通过，1已通过', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('467', 'verify', '审核', '1', 'product', ' ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '99', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('468', 'title', '商品名称', '1', 'product', '名称', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('469', 'price', '本店售价', '1', 'product', '请输入商品价格\r\n', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '2', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('470', 'market_price', '市场售价', '1', 'product', '请输入市场价格，不价格不是商品的交易价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('471', 'separate_num', '分成金额', '3', 'product', '产品固定分成金额，如果按照产品价格分成，请输入0', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('472', 'promote_point', '升级点数', '3', 'product', '会员升级时候需要的经验点数，-1表示赠送等值商品价格的点数，0表示不赠送，此点数不可以消费，只能用来升级', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'-1\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '-1', '-1', '-1', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('473', 'content', '商品介绍', '2', 'product', '产品介绍', 'array (\r\n  \\\'width\\\' => \\\'0\\\',\r\n  \\\'height\\\' => \\\'300\\\',\r\n  \\\'editor_link\\\' => \\\'0\\\',\r\n  \\\'editor_link_num\\\' => \\\'0\\\',\r\n  \\\'editor_link_type\\\' => \\\'1\\\',\r\n  \\\'editor_save\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'editor', '5', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('474', 'separate_scale', '分成比例', '3', 'product', '为空，表示按照全局设置的比例分成,A(10)-&gt;B(20)-&gt;C(30)-&gt;购买者（0）,比例格式为：0,30,20,10', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '5', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('475', 'pictures', '商品图集', '2', 'product', '产品图集', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'size\\\' => \\\'300\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'10\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'1\\\',\n  \\\'property\\\' => \\\'\\\',\n)', 'images', '6', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('476', 'addtime', '添加日期', '3', 'product', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\" id=\"[field]\">\r\n	<div class=\"col-md-3\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]_start\" type=\"text\" class=\"[css]\" id=\"[field]_start\" value=\"[default_start]\"  [property]>\r\n		 </div> \r\n	</div>\r\n</div>', 'datetime_4.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('477', 'autho_id', '发布人ID', '3', 'product', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '8', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('478', 'autho_admin', '用户类型', '3', 'product', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '9', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('479', 'thumb', '缩略图', '1', 'product', '缩略图', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'width\\\' => \\\'100\\\',\n  \\\'height\\\' => \\\'100\\\',\n  \\\'size\\\' => \\\'500\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n)', 'image', '10', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-1 font_color_4\" ><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve] >上传</button></div>\r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('480', 'verify', '审核', '1', 'point', ' ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '0', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('481', 'title', '商品名称', '1', 'point', '名称', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('482', 'price', '本店售价', '1', 'point', '请输入商品价格\r\n', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '2', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('483', 'market_price', '市场售价', '1', 'point', '请输入市场价格，不价格不是商品的交易价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('484', 'separate_num', '分成金额', '1', 'point', '产品固定分成金额，如果按照分成比例分成，请输入0', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('485', 'promote_point', '升级点数', '3', 'point', '会员升级时候需要的经验点数，-1表示赠送等值商品价格的点数，0表示不赠送，次点数不可以消费，只能用来升级', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'-1\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('486', 'content', '商品介绍', '2', 'point', '产品介绍', 'array (\r\n  \\\'width\\\' => \\\'0\\\',\r\n  \\\'height\\\' => \\\'300\\\',\r\n  \\\'editor_link\\\' => \\\'0\\\',\r\n  \\\'editor_link_num\\\' => \\\'0\\\',\r\n  \\\'editor_link_type\\\' => \\\'1\\\',\r\n  \\\'editor_save\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n)', 'editor', '5', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('487', 'separate_scale', '分成比例', '3', 'point', '为空，表示按照全局设置的比例分成', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('488', 'pictures', '商品图集', '2', 'point', '产品图集', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'10\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'images', '6', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('489', 'addtime', '添加日期', '3', 'point', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\" id=\"[field]\">\r\n	<div class=\"col-md-3\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]_start\" type=\"text\" class=\"[css]\" id=\"[field]_start\" value=\"[default_start]\"  [property]>\r\n		 </div> \r\n	</div>\r\n</div>', 'datetime_4.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('490', 'autho_id', '发布人ID', '3', 'point', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '8', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('491', 'autho_admin', '用户类型', '3', 'point', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '9', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('492', 'thumb', '缩略图', '1', 'point', '缩略图', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'image', '10', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-1 font_color_4\" ><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve] >上传</button></div>\r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('493', 'card', '会员卡', '0', 'user', '会员卡', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'1\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '99', '-1', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('494', 'bar_code', '条形码', '1', 'product', '条形码', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'1\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '10', '-1', '-1', '-1', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('495', 'bar_code', '条形码', '1', 'point', '条形码', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'1\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '10', '-1', '-1', '-1', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('496', 'money', '人民币', '3', 'product', '-1表示赠送等值商品价格的积分，0表示不赠送', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '-1', '-1', '-1', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('497', 'amount', '点数', '3', 'product', '-1表示赠送等值商品价格的积分，0表示不赠送', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '-1', '-1', '-1', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('498', 'point', '积分', '3', 'product', '-1表示赠送等值商品价格的积分，0表示不赠送', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'0\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '-1', '-1', '-1', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('501', 'name', '用户名', '1', 'message', '111111', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'kkkkk\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'1\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', 'array (\n  \\\'K_0\\\' => \\\'[title]:[default_]<BR>\\\',\n)', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('502', 'age', '年龄', '', 'message', '11111', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'11\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'10\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('503', 'sxe', '性别', '', 'message', '2222', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'box_list\\\' => \\\'男=1\r\n女=2\\\',\n  \\\'default_\\\' => \\\'2\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'format\\\' => \\\'1\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'box', '4', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n						<select name=\"[field]\" id=\"[field]\" class=\"[css]\" [property] [other]>\r\n						  [loop]\r\n						  <option value=\"[value]\">[text]</option>\r\n						  [/loop]\r\n						</select>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'select_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('504', 'imgs', '图片集合', '', 'message', '111', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'10\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'1\\\',\n  \\\'property\\\' => \\\'\\\',\n)', 'images', '3', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-12 padding_7\">\r\n				<div class=\"col-md-1 left padding_5 sizefont_12\">[title]</div> \r\n				<div class=\"col-md-11\">\r\n						<div class=\"panel panel-default\">\r\n						  <div class=\"panel-heading\"><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve]>批量上传</button></div>\r\n							  <div class=\"panel-body\" id=\"[field]_images\">\r\n								\r\n							  </div>\r\n						</div>\r\n				</div>	\r\n	</div> \r\n\r\n</div>', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('505', 'times', '时间', '', 'message', '111', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'datetime_type\\\' => \\\'1\\\',\n  \\\'datetime_time\\\' => \\\'1\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\n  \\\'prev_week\\\' => \\\'week\\\',\n  \\\'next_days\\\' => \\\'3,5,7\\\',\n  \\\'next_week\\\' => \\\'week\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'datetime', '5', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('515', 'name', '车主姓名', '0', 'assurance', '0', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('516', 'shenfenzheng', '身份证号', '1', 'assurance', '身份证号', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '2', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('518', 'xinghao', '车辆类型', '1', 'assurance', '车辆类型', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '4', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('520', 'chepaihao', '车牌号', '1', 'assurance', '车牌号', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '6', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('522', 'daima', '车辆识别代码', '1', 'assurance', '车辆识别代码', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '8', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('525', 'price', '车险价格', '1', 'assurance', '车险价格', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('526', 'jiaoqiangxian', '交强险', '1', 'assurance', '交强险', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('527', 'chechuanshui', '车船税', '1', 'assurance', '车船税', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('528', 'shangyexian', '商业险', '1', 'assurance', '商业险', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '1', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('530', 'user', '买保险用户名', '', 'assurance', '买保险用户名', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('531', 'dianhua', '代理电话', '1', 'assurance', '代理电话', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('532', 'bao_xian', '保险公司名称', '1', 'assurance', '保险公司名称', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('533', 'tuijian_user', '推荐人用户名', '1', 'assurance', '推荐人用户名', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('534', 'verify', '审核', '1', 'article', '  ', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'box_list\\\' => \\\'未审核=0\r\n已审核=1\\\',\r\n  \\\'default_\\\' => \\\'0\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'format\\\' => \\\'1\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'box', '0', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html', '<div class=\"row padding_8\">\r\n     [loop]<label class=\"checkbox-inline\" ><input name=\"[field][]\" type=\"checkbox\"  id=\"[field]\" value=\"[value]\"  data-switch-no-init> [text]</label>[/loop]\r\n</div>', 'checkbox_1.html');
INSERT INTO `cc_table_field` VALUES ('535', 'title', '文章标题', '0', 'article', '请输入文字标题', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '0', '', '', '', '10,9', '10,9', '10,9', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('536', 'description', '简介', '0', 'article', '内容简短说明', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'width\\\' => \\\'0\\\',\n  \\\'height\\\' => \\\'46\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'html\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)', 'textarea', '1', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-8\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-10 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'textarea_1.html');
INSERT INTO `cc_table_field` VALUES ('537', 'content', '内容', '0', 'article', '请输入内容', 'array (\n  \\\'width\\\' => \\\'0\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'editor_link\\\' => \\\'0\\\',\n  \\\'editor_link_num\\\' => \\\'0\\\',\n  \\\'editor_link_type\\\' => \\\'1\\\',\n  \\\'editor_save\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)', 'editor', '2', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_standard.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'editor_simplify .html');
INSERT INTO `cc_table_field` VALUES ('538', 'price', '浏览价格', '0', 'article', '浏览价格', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data0\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'2\\\',\r\n  \\\'num_min\\\' => \\\'0\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '3', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('539', 'thumb', '缩略图', '0', 'article', '缩略图', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\r\n  \\\'width\\\' => \\\'100\\\',\r\n  \\\'height\\\' => \\\'100\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'checks\\\' => \\\'1\\\',\r\n  \\\'water\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n)', 'image', '4', '', '', '', '', '', '', '1', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '', 'image_1.html');
INSERT INTO `cc_table_field` VALUES ('540', 'autho_id', '发布人ID', '0', 'article', '发布人ID', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'1\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '5', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('541', 'autho_admin', '用户类型', '0', 'article', '用户类型', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'default_\\\' => \\\'\\\',\r\n  \\\'data1\\\' => \\\'1\\\',\r\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\r\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\r\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\r\n  \\\'type_num\\\' => \\\'0\\\',\r\n  \\\'decimal\\\' => \\\'0\\\',\r\n  \\\'num_min\\\' => \\\'1\\\',\r\n  \\\'num_max\\\' => \\\'0\\\',\r\n  \\\'len_min\\\' => \\\'1\\\',\r\n  \\\'len_max\\\' => \\\'0\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'reg_exp\\\' => \\\'\\\',\r\n  \\\'reg_exp_pro\\\' => \\\'\\\',\r\n  \\\'only\\\' => \\\'0\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'text', '6', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('542', 'addtime', '添加日期', '0', 'article', '添加日期', 'array (\r\n  \\\'css\\\' => \\\'form-control input-sm\\\',\r\n  \\\'datetime_type\\\' => \\\'1\\\',\r\n  \\\'datetime_time\\\' => \\\'1\\\',\r\n  \\\'close_type\\\' => \\\'1\\\',\r\n  \\\'len_min\\\' => \\\'0\\\',\r\n  \\\'prev_days\\\' => \\\'3,5,7\\\',\r\n  \\\'prev_week\\\' => \\\'week\\\',\r\n  \\\'prev_month\\\' => \\\'month\\\',\r\n  \\\'prev_year\\\' => \\\'year\\\',\r\n  \\\'next_days\\\' => \\\'3,5,7\\\',\r\n  \\\'next_week\\\' => \\\'week\\\',\r\n  \\\'next_month\\\' => \\\'month\\\',\r\n  \\\'next_year\\\' => \\\'year\\\',\r\n  \\\'property\\\' => \\\'\\\',\r\n  \\\'search\\\' => \\\'0\\\',\r\n)', 'datetime', '7', '', '', '', '', '', '', '0', '1', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'datetime_1.html', '', 'datetime_1.html');
INSERT INTO `cc_table_field` VALUES ('543', 'fadongjihao', '发动机号', '', 'assurance', '发动机号', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('544', 'baodantupian', '保单图片', '', 'assurance', '保单图片', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'width\\\' => \\\'100\\\',\n  \\\'height\\\' => \\\'100\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n)', 'image', '0', '', '', '', '', '', '', '1', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve]/> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>', 'image_2.html');
INSERT INTO `cc_table_field` VALUES ('545', 'inventory', '库存', '3', 'point', '库存', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');
INSERT INTO `cc_table_field` VALUES ('546', 'inventory', '库存', '3', 'product', '库存', 'array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)', 'text', '0', '', '', '', '', '', '', '0', '0', '0', '', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html', '<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>', 'text_1.html');

-- ----------------------------
-- Table structure for cc_user
-- ----------------------------
DROP TABLE IF EXISTS `cc_user`;
CREATE TABLE `cc_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL COMMENT '管理员账号',
  `pass` varchar(100) NOT NULL COMMENT '管理员密码',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '密码前缀',
  `money` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '会员资金',
  `amount` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员点数，可以是小数',
  `point` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '会员积分',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '管理员是否开启 1开启 0关闭',
  `addtime` int(11) NOT NULL COMMENT '添加日期',
  `group_id` int(11) unsigned DEFAULT '0' COMMENT '会员组id',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `email` varchar(255) DEFAULT '0' COMMENT '请输入邮箱',
  `recommend` bigint(20) DEFAULT '0' COMMENT '请输入推荐人ID',
  `openid` varchar(255) DEFAULT '0' COMMENT '微信OPENID',
  `nickname` varchar(255) DEFAULT '0' COMMENT '昵称',
  `pay_pass` varchar(100) DEFAULT '0' COMMENT '支付密码',
  `birthday` varchar(255) NOT NULL DEFAULT '0' COMMENT '生日',
  `qrcode_open` bigint(20) NOT NULL DEFAULT '0' COMMENT '是否开通二维码自动，0表示开通，1表示未开通',
  `promote_point` bigint(20) unsigned DEFAULT '0' COMMENT '升级点数',
  `year_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '年消费',
  `month_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '月消费',
  `day_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '日消费',
  `total_consumption` float(15,2) unsigned DEFAULT '0.00' COMMENT '累计消费',
  `year_order` bigint(20) unsigned DEFAULT '0' COMMENT '年订单',
  `month_order` bigint(20) unsigned DEFAULT '0' COMMENT '月订单',
  `day_order` bigint(20) unsigned DEFAULT '0' COMMENT '日订单',
  `total_order` bigint(20) unsigned DEFAULT '0' COMMENT '总订单',
  `time_consumption` bigint(20) unsigned DEFAULT '0' COMMENT '更新消费时间',
  `time_order` bigint(20) unsigned DEFAULT '0' COMMENT '订单更新时间',
  `day_recommend` bigint(20) NOT NULL DEFAULT '0' COMMENT '日推荐人数',
  `month_recommend` bigint(20) DEFAULT '0' COMMENT '月推荐人数',
  `year_recommend` bigint(20) DEFAULT '0' COMMENT '年推荐人数',
  `time_recommend` int(10) unsigned DEFAULT '0' COMMENT '推荐更新时间',
  `login_time` int(11) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `real_name_authentication` varchar(255) DEFAULT '0' COMMENT '实名认证信息 格式 姓名,身份证号,身份证图片',
  `mobile` varchar(255) DEFAULT '0' COMMENT '绑定手机号码 11位数字',
  `bank_authentication` varchar(255) DEFAULT '0' COMMENT '绑定银行卡信息 格式 卡号,地区id,银行名称,开户行',
  `is_real_name` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1通过',
  `is_bank_auth` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1已通过',
  `card` varchar(255) DEFAULT '0' COMMENT '会员卡',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `card` (`card`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_user
-- ----------------------------

-- ----------------------------
-- Table structure for cc_wechat
-- ----------------------------
DROP TABLE IF EXISTS `cc_wechat`;
CREATE TABLE `cc_wechat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入文字标题',
  `class_id` int(10) unsigned DEFAULT '0' COMMENT '分类',
  `description` text NOT NULL COMMENT '内容简短说明',
  `content` text COMMENT ' ',
  `addtime` int(11) DEFAULT '0' COMMENT '添加日期',
  `thumb` varchar(255) DEFAULT '0' COMMENT ' ',
  `autho_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `autho_admin` varchar(255) DEFAULT '0' COMMENT '发布者身份',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT ' ',
  `keyword` varchar(255) NOT NULL DEFAULT '0' COMMENT '请输入关键字，多个关键字用逗号隔开',
  `verify` tinyint(11) unsigned NOT NULL DEFAULT '0' COMMENT '  ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_wechat
-- ----------------------------

-- ----------------------------
-- Table structure for cc_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `cc_wechat_user`;
CREATE TABLE `cc_wechat_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `sex` tinyint(1) unsigned DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `subscribe_time` int(11) unsigned DEFAULT NULL,
  `groupid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_wechat_user
-- ----------------------------

-- ----------------------------
-- Table structure for cc_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `cc_withdraw`;
CREATE TABLE `cc_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `userid` int(11) DEFAULT '0' COMMENT '提现用户',
  `addtime` int(11) DEFAULT NULL COMMENT '提现时间',
  `status` int(11) DEFAULT '0' COMMENT '提现状态，0未处理，1处理中，2已处理，3处理失败',
  `amount` float(11,2) DEFAULT '0.00' COMMENT '提现金额',
  `operator` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '0' COMMENT '操作人员',
  `cause` varchar(255) DEFAULT NULL COMMENT '操作原因',
  `way` int(11) DEFAULT '0' COMMENT '提现方式',
  `account_id` varchar(255) DEFAULT NULL,
  `msg` text COMMENT '后台操作说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_withdraw
-- ----------------------------

-- ----------------------------
-- Table structure for cc_withdraw_way
-- ----------------------------
DROP TABLE IF EXISTS `cc_withdraw_way`;
CREATE TABLE `cc_withdraw_way` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '提现方式名称',
  `information` varchar(500) DEFAULT NULL COMMENT '现提方式介绍',
  `isshow` int(11) DEFAULT '0' COMMENT '是否显示 0显示，1不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cc_withdraw_way
-- ----------------------------
