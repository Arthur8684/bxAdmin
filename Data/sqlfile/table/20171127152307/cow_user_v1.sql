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
-- 表的结构cow_user
--

DROP TABLE IF EXISTS `cow_user`;
CREATE TABLE `cow_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL COMMENT '管理员账号',
  `pass` varchar(100) NOT NULL COMMENT '管理员密码',
  `pass_pre` varchar(50) DEFAULT NULL COMMENT '密码前缀',
  `status` tinyint(2) DEFAULT '0' COMMENT '管理员是否开启 1开启 0关闭',
  `addtime` int(11) DEFAULT NULL COMMENT '添加日期',
  `group_id` int(11) unsigned DEFAULT '0' COMMENT '会员组id',
  `site_id` int(11) unsigned DEFAULT '0' COMMENT '所属网站id',
  `email` varchar(255) DEFAULT '0' COMMENT '请输入邮箱',
  `recommend` bigint(20) DEFAULT '0' COMMENT '请输入推荐人ID',
  `openid` varchar(255) DEFAULT '0' COMMENT '微信OPENID',
  `nickname` varchar(255) DEFAULT '0' COMMENT '昵称',
  `pay_pass` varchar(100) DEFAULT '0' COMMENT '支付密码',
  `headpath` varchar(255) DEFAULT '0' COMMENT '0',
  `sex` int(11) DEFAULT '0' COMMENT '性别',
  `qrcode_open` bigint(20) DEFAULT '0' COMMENT '是否开通二维码自动，0表示开通，1表示未开通',
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
  `day_recommend` bigint(20) DEFAULT '0' COMMENT '日推荐人数',
  `month_recommend` bigint(20) DEFAULT '0' COMMENT '月推荐人数',
  `year_recommend` bigint(20) DEFAULT '0' COMMENT '年推荐人数',
  `total_recommend` bigint(20) DEFAULT '0' COMMENT '0',
  `time_recommend` int(10) unsigned DEFAULT '0' COMMENT '推荐更新时间',
  `login_time` int(11) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `real_name_authentication` varchar(255) DEFAULT '0' COMMENT '实名认证信息 格式 姓名,身份证号,身份证图片',
  `mobile` varchar(255) DEFAULT '0' COMMENT '绑定手机号码 11位数字',
  `bank_authentication` varchar(255) DEFAULT '0' COMMENT '绑定银行卡信息 格式 卡号,地区id,银行名称,开户行',
  `is_real_name` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1通过',
  `is_bank_auth` tinyint(2) unsigned DEFAULT '0' COMMENT '0未通过，1已通过',
  `card` varchar(255) DEFAULT '0' COMMENT '会员卡',
  `money` float(15,2) unsigned DEFAULT '0.00' COMMENT '人民币',
  `amount` float(15,2) unsigned DEFAULT '0.00' COMMENT '点数',
  `point` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分',
  `point1` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分1',
  `point2` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分2',
  `point3` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分3',
  `point4` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分4',
  `point5` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分5',
  `point6` float(15,2) unsigned DEFAULT '0.00' COMMENT '积分6',
  `birthday` int(11) DEFAULT '0' COMMENT '会员生日',
  `shengshi` varchar(255) DEFAULT '0' COMMENT '0',
  `loginip` varchar(255) DEFAULT '0' COMMENT '用户登录IP',
  `name` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT '0' COMMENT '位置x',
  `lon` varchar(255) DEFAULT '0' COMMENT '位置Y',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `user` (`user`),
  KEY `card` (`card`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_user
--

INSERT INTO `cow_user` VALUES('73','发过火','1a3555b936a16a5c9a02d2d230dd0ee8','ushpFe','0','1490690786','8','0','0111@qq.COM','0','0','大飞哥','0','','1','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1490976000','0','0','','0','0');
INSERT INTO `cow_user` VALUES('74','发过火人 q','06181819f6f6ea7695770ec09c1598ad','LCwMxa','0','1490691560','0','0','0','0','0','大飞哥','0','','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('75','发过火人是','c8a1acdc542b468be3168f6c39448477','NMuFkS','0','1490692093','0','0','0','0','0','大飞哥','0','upload/games/58da27fb7c4c5.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('76','发过火人是山西','1e2a879815ac585e7bd7c0d83e6b02c2','JMAcEn','0','1490692580','0','0','0','0','0','大飞哥','0','upload/games/58da29e397004.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('77','发过火人是山西是','e836aed76dbe99b978e98694c844498d','xidBeC','0','1490692644','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('78','发过火人是山西是111','2a2a87d9b6d76e3169679dc74585e504','ewrFpq','0','1490692679','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('79','发过火二','099c34e82bded334e232240791f897fe','AkIKts','0','1490692814','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('80','发过433453','8e111fa8e9f989cb8b48d3bede2e7da2','mNfUDq','0','1490692893','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('81','发过5666666','b21e79c1b84260afd5458a6fafebb9b6','Gyuqez','0','1490693147','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('82','66666','2d2ff37d944796e55faf7965283aea94','RVLdhk','1','1508562779','1','0','0111@qq.COM','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','1','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','1509335440','0','0','0','0','0','12333','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','1490976000','0','0','','0','0');
INSERT INTO `cow_user` VALUES('83','666661111','20aea92f9a0e1626a84ff8a3d02053b2','wquPWk','0','1490693801','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('84','666661111222','7ca510f24efd041087c07cf36baee4c8','YtRdnM','0','1490693875','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('85','4444444','8d1306d5504c07fa21f48bfa8678f618','zhQvbe','0','1490694067','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('86','44444443333','eb9ff350a8476081a0869ee3db9d0e80','azYdTl','0','1490694166','0','0','0','0','0','大飞哥','0','upload/games/58da2a23932fb.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('87','大飞哥哦','3d65f61cf309f485ee8de92d7136fe65','cMGfWj','0','1490694278','0','0','0','0','0','大飞哥','0','upload/games/58da3084dbaa6.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
INSERT INTO `cow_user` VALUES('88','大飞个个','f5dee9f41da93b53441cc3b20a71c9c9','dyzfur','0','1490694370','0','0','0','0','0','大飞哥','0','upload/games/58da30e21cee4.jpg','0','0','0','0.00','0.00','0.00','0.00','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0','0','0','','0','0');
