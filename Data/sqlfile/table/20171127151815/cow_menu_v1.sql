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
-- 表的结构cow_menu
--

DROP TABLE IF EXISTS `cow_menu`;
CREATE TABLE `cow_menu` (
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
) ENGINE=MyISAM AUTO_INCREMENT=862 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_menu
--

INSERT INTO `cow_menu` VALUES('1','设置','0','0','','','','','','1','0','','admin','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('2','插件','0','1','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('3','内容','0','2','','Content','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('4','会员','0','3','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('5','资金','0','5','','Accounts','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('6','相关','0','6','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('7','功能','6','0','','Admin','Plug','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('8','菜单设置','1','1','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('9','后台菜单','8','10','','admin','menu','menu_list','type=admin','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('10','管理员','1','2','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('11','管理列表','10','3','','Admin','Admin','admin_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('12','基本设置','1','0','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('13','基本设置','12','0','','Admin','Setting','Setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('15','会员管理','4','0','','Admin','Menu','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('16','会员列表','15','0','','Admin','User','user_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('17','网站设置','12','0','','Admin','Site','Site_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('18','会员组','15','0','','Admin','User','User_group_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('19','角色管理','10','2','','Admin','Admin','Admin_Role_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('22','会员字段','15','0','','Field','Field','field_list','modelid=2','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('23','分销','0','4','','Fenxiao','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('24','参数设置','23','0','','Fenxiao','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('25','基本设置','24','0','','Fenxiao','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('30','资金流水','5','0','','Admin','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('31','流水列表','30','0','','Accounts','index','Accounts_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('32','提现列表','5','0','','Accounts','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('33','查看列表','32','0','','Accounts','index','withdraw_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('34','增减资金','30','0','','Accounts','index','accounts_alter','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('35','清理数据','30','0','','Accounts','index','accounts_del','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('40','内容模型','3','0','','sys_model','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('41','模型列表','40','0','','sys_model','Index','model_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('65','订单','0','7','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('66','订单管理','65','0','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('67','订单列表','66','0','','Order','Admin','order_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('93','会员中心','8','0','','Admin','Menu','Menu_list','type=user','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('97','个人账户','0','0','','User','index','user_info','','1','0','','user','icon-folder-close');
INSERT INTO `cow_menu` VALUES('99','个人审核','0','2','','User','index','auth','','1','0','','user','icon-ok');
INSERT INTO `cow_menu` VALUES('102','手机绑定','0','7','','User','index','bundling_info','type=mobile','1','0','','user','icon-random');
INSERT INTO `cow_menu` VALUES('103','修改密码','0','6','','User','index','alter_password','','1','0','','user','icon-magic');
INSERT INTO `cow_menu` VALUES('104','银行卡绑定','0','8','','User','index','bundling_info','type=bank','1','0','','user','icon-money');
INSERT INTO `cow_menu` VALUES('105','推荐会员','0','5','','User','index','team_list','','1','0','','user','icon-user');
INSERT INTO `cow_menu` VALUES('146','核销兑换码','66','3','','Order','Admin','verification_key_admin','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('147','卖家中心','8','3','','Admin','Menu','Menu_list','type=sell','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('151','订单管理','0','3','','','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('163','资金设置','5','0','','Accounts','Setting','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('164','基本配置','163','0','','Accounts','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('165','支付配置','163','1','','Accounts','Setting','pay_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('166','首页菜单','8','4','','Admin','Menu','Menu_list','type=index_show','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('168','个人中心','0','1','','User','index','index','','1','0','','index_show','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('187','首页轮播图','183','6','','Home','index','carousel_pic','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('188','权限分类','10','0','','Admin','Auth','auth_class_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('189','权限规则','10','1','','Admin','Auth','auth_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('215','会员代理','15','0','','User','Agentadmin','agent_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('217','代理设置','15','0','','User','Agentadmin','setting_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('218','实名认证','0','9','','User','index','bundling_info','type=real','1','0','','user','icon-ok-circle');
INSERT INTO `cow_menu` VALUES('220','现金管理','0','11','','User','index','money','model_id=43','1','0','','user','icon-yen');
INSERT INTO `cow_menu` VALUES('222','首页轮播图','12','4','','Home','index','carousel_pic','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('227','虚拟产品','210','0','','Admin','Menu','Menu_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('261','收货地址','66','9','','Order','Admin','shipaddress_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('278','站内公告系统','3','2','','Article','','','','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('279','字段管理','278','0','','Field','Field','field_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('280','站内公告分类','278','1','','Sys_model','Class','class_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('281','内容管理','278','2','','Article','Article','article_list','modelid=43','1','0','43','admin','');
INSERT INTO `cow_menu` VALUES('282','清理订单','66','4','','Order','Admin','clear_order','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('320','手机会员菜单','8','6','','Admin','Menu','Menu_list','type=mobile','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('321','商城首页','0','0','','Mobile','index','index','','0','0','','mobile','glyphicon glyphicon-home');
INSERT INTO `cow_menu` VALUES('322','我的订单','0','1','','mobile','order','order_list','','1','0','','mobile','glyphicon glyphicon-list-alt');
INSERT INTO `cow_menu` VALUES('323','我的资料','0','2','','Mobile','User','alter_infomation','','1','0','','mobile','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('324','提现申请','0','3','','Mobile','User','withdraw_list','','1','0','','mobile','glyphicon glyphicon-gift');
INSERT INTO `cow_menu` VALUES('325','分销中心','0','4','','Mobile','User','team_list','','0','0','','mobile','glyphicon glyphicon-sort-by-attributes-alt');
INSERT INTO `cow_menu` VALUES('326','购物车','0','7','','mobile','order','my_cart','','0','0','','mobile','glyphicon glyphicon-shopping-cart');
INSERT INTO `cow_menu` VALUES('328','站内公告','0','6','','mobile','Article','index_list','model_id=43','0','0','','mobile','glyphicon glyphicon-calendar');
INSERT INTO `cow_menu` VALUES('329','资金管理','0','5','','Mobile','Accounts','index_list','','1','0','','mobile','glyphicon glyphicon-yen');
INSERT INTO `cow_menu` VALUES('330','手机首页菜单','8','9','','Admin','Menu','Menu_list','type=mobile_index','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('331','全部分类','0','0','','Mobile','index','cate_all','','1','0','','mobile_index','glyphicon glyphicon-th');
INSERT INTO `cow_menu` VALUES('332','个人中心','0','1','','Mobile','user','index','','1','0','','mobile_index','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('334','联系我们','0','3','','Article','index','index_show','model_id=54&id=3','1','0','','mobile_index','glyphicon glyphicon-phone');
INSERT INTO `cow_menu` VALUES('342','查看兑换信息','66','8','','Order','Admin','order_conversion_key','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('343','会员设置','15','0','','User','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('344','辛勤劳动','0','0','','Mobile','User','work','','1','0','','mobile','glyphicon glyphicon-list-alt');
INSERT INTO `cow_menu` VALUES('345','详细信息','0','10','','Mobile','User','user_info','','1','0','','mobile','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('346','绑定手机','0','11','','Mobile','User','bundling_info','type=mobile','1','0','','mobile','glyphicon glyphicon-hand-up');
INSERT INTO `cow_menu` VALUES('347','实名认证','0','12','','Mobile','User','bundling_info','type=real','1','0','','mobile','glyphicon glyphicon-ok');
INSERT INTO `cow_menu` VALUES('348','绑定银行卡','0','13','','Mobile','User','bundling_info','type=bank','1','0','','mobile','glyphicon glyphicon-check');
INSERT INTO `cow_menu` VALUES('353','商城公告','0','0','http://www.zgdalesong.com/index.php/Article/Index/index_show/model_id/54/id/4.php','','','','','0','0','','index_show','');
INSERT INTO `cow_menu` VALUES('354','审核列表','0','14','','Mobile','User','auth','','1','0','','mobile','glyphicon glyphicon-random');
INSERT INTO `cow_menu` VALUES('355','我的支付','0','0','','Accounts','pay','ceshi','','1','0','','mobile_index','glyphicon glyphicon-user');
INSERT INTO `cow_menu` VALUES('361','修改密码','0','15','','Mobile','User','alter_password','','1','0','','mobile','glyphicon glyphicon-lock');
INSERT INTO `cow_menu` VALUES('362','评论','0','11','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('388','直播新闻系统系统','3','2','','Article','','','','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('389','字段管理','388','0','','Field','Field','field_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('390','直播新闻系统分类','388','1','','Sys_model','Class','class_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('391','内容管理','388','2','','Article','Article','article_list','modelid=57','1','0','57','admin','');
INSERT INTO `cow_menu` VALUES('395','插件管理','2','0','','Admin','Install','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('396','插件安装','395','0','','Admin','Install','install_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('625','联动菜单','7','3','','Linkage','Admin','linkage_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('646','商家管理','4','2','','Shop','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('647','店铺分类','646','0','','Shop','Admin','shop_category_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('648','店铺管理','646','1','','Shop','Admin','shop_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('649','出售产品','0','0','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('650','出售产品','649','0','','Shop','Consume\"','index','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('651','店铺管理','0','1','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('652','修改店铺','651','1','','Shop','Sell\"','alter_shop_info','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('653','店铺模板','651','0','','Shop','Sell\"','select_color','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('654','订单管理','0','2','','Shop','','','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('655','我的订单','654','0','','Shop','Sell\"','order_list','','1','0','','sell','');
INSERT INTO `cow_menu` VALUES('697','直播','0','8','','Chat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('698','直播设置','697','8','','Chat','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('699','基本设置','698','0','','Chat','Setting','website_settings','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('700','账户配置','698','1','','Chat','Setting','Setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('701','直播管理','697','8','','Chat','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('702','表情管理','701','0','','Chat','Admin','face_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('703','礼物管理','701','1','','Chat','Admin','gift_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('704','房间分类','701','2','','Chat','Admin','menu_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('705','房间管理','701','3','','Chat','Admin','chat_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('706','直播管理','0','9','','Chat','User','direct_live','','1','0','','user','icon-facetime-video');
INSERT INTO `cow_menu` VALUES('728','商城系统','3','2','','Goods','','','','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('729','字段管理','728','0','','Field','Field','field_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('730','商城分类','728','1','','Sys_model','Class','class_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('731','内容管理','728','2','','Goods','Goods','goods_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('732','库存管理','728','3','','Goods','Goods','all_inventory_list','modelid=66','1','0','66','admin','');
INSERT INTO `cow_menu` VALUES('741','团购系统','3','2','','Article','','','','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('742','字段管理','741','0','','Field','Field','field_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('743','团购分类','741','1','','Sys_model','Class','class_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('744','内容管理','741','2','','Article','Article','article_list','modelid=69','1','0','69','admin','');
INSERT INTO `cow_menu` VALUES('745','直播','0','0','','Chat','Index','Index','','1','0','','index_show','');
INSERT INTO `cow_menu` VALUES('746','红包管理','7','4','','Packets','Admin','packets_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('747','活动红包','0','4','','Packets','user','packets_list','','1','0','','user','icon-briefcase');
INSERT INTO `cow_menu` VALUES('756','采集器','6','4','','Collector','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('757','采集项目','756','0','','Collector','Project','project_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('758','配置项目','756','1','','Collector','Setting','project_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('759','广告','7','0','','Advert','Admin','advert_type_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('802','微信','0','9','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('803','微信设置','802','8','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('804','基本设置','803','0','','Wechat','Setting','base_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('805','菜单设置','803','1','','Wechat','Setting','menu_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('806','会员设置','803','2','','Wechat','Setting','user_setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('807','关键字','802','8','','Wechat','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('808','关键字分类','807','0','','Sys_model','Class','class_list','modelid=70','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('809','关键字管理','807','1','','Article','Article','article_list','modelid=70','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('810','站内短信','6','4','','Message','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('811','短信管理','810','0','','Message','Admin','message_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('812','短信设置','810','1','','Message','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('838','游戏','0','9','','Games','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('839','游戏管理','838','0','','Games','Admin','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('840','游戏设置','839','0','','Games','Setting','setting','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('841','游戏列表','839','1','','Games','Admin','games_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('842','游戏分类','839','2','','Games','Class','class_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('843','游戏公告系统','3','2','','Article','','','','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('844','字段管理','843','0','','Field','Field','field_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('845','游戏公告分类','843','1','','Sys_model','Class','class_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('846','内容管理','843','2','','Article','Article','article_list','modelid=70','1','0','70','admin','');
INSERT INTO `cow_menu` VALUES('847','明花麻将系统','3','2','','Article','','','','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('848','字段管理','847','0','','Field','Field','field_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('849','明花麻将分类','847','1','','Sys_model','Class','class_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('850','内容管理','847','2','','Article','Article','article_list','modelid=71','1','0','71','admin','');
INSERT INTO `cow_menu` VALUES('851','单一信息系统','3','2','','Article','','','','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('852','字段管理','851','0','','Field','Field','field_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('853','单一信息分类','851','1','','Sys_model','Class','class_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('854','内容管理','851','2','','Article','Article','article_list','modelid=72','1','0','72','admin','');
INSERT INTO `cow_menu` VALUES('855','物流管理','65','1','','','','','','1','0','','admin','icon-barcode');
INSERT INTO `cow_menu` VALUES('856','快递公司','855','0','','Express','Admin','express_company','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('857','物流接口','855','0','','Express','Ammin','api_list','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('858','数据库','0','8','','','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('859','备份还原','858','0','','Db','','','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('860','备份数据库','859','0','','Db','Databases','export','','1','0','','admin','');
INSERT INTO `cow_menu` VALUES('861','还原数据库','859','1','','Db','Databases','import','','1','0','','admin','');
