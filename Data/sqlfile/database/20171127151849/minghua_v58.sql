INSERT INTO `cow_chat_gift_record` VALUES('1192','21','1','1','30','24','1483685463');
INSERT INTO `cow_chat_gift_record` VALUES('1193','21','1','1','520','24','1483685468');
INSERT INTO `cow_chat_gift_record` VALUES('1194','21','1','1','10','24','1483685488');
INSERT INTO `cow_chat_gift_record` VALUES('1195','21','1','1','520','24','1483685491');
INSERT INTO `cow_chat_gift_record` VALUES('1196','21','1','1','10','24','1483685562');
INSERT INTO `cow_chat_gift_record` VALUES('1197','21','1','1','520','24','1483685565');
INSERT INTO `cow_chat_gift_record` VALUES('1198','21','1','1','520','24','1483685609');
INSERT INTO `cow_chat_gift_record` VALUES('1199','21','1','1','30','24','1483685659');
INSERT INTO `cow_chat_gift_record` VALUES('1200','21','1','1','520','24','1483685664');
INSERT INTO `cow_chat_gift_record` VALUES('1201','21','1','1','1','24','1483685700');
INSERT INTO `cow_chat_gift_record` VALUES('1202','21','1','1','520','24','1483685702');
INSERT INTO `cow_chat_gift_record` VALUES('1203','21','1','1','520','24','1483685730');
INSERT INTO `cow_chat_gift_record` VALUES('1204','21','1','1','520','24','1483685765');
INSERT INTO `cow_chat_gift_record` VALUES('1205','21','1','1','1314','24','1483685767');
INSERT INTO `cow_chat_gift_record` VALUES('1206','21','1','1','520','24','1483686997');
INSERT INTO `cow_chat_gift_record` VALUES('1207','21','1','1','10','24','1483687002');
INSERT INTO `cow_chat_gift_record` VALUES('1208','21','1','1','1','24','1483687024');
INSERT INTO `cow_chat_gift_record` VALUES('1209','21','1','1','10','24','1483687047');
INSERT INTO `cow_chat_gift_record` VALUES('1210','21','1','1','520','24','1483687051');
INSERT INTO `cow_chat_gift_record` VALUES('1211','21','1','1','66','24','1483687054');
INSERT INTO `cow_chat_gift_record` VALUES('1212','21','1','1','66','24','1483687054');
INSERT INTO `cow_chat_gift_record` VALUES('1213','21','1','1','66','24','1483687055');
INSERT INTO `cow_chat_gift_record` VALUES('1214','21','1','1','66','24','1483687055');
INSERT INTO `cow_chat_gift_record` VALUES('1215','21','1','1','66','24','1483687055');
INSERT INTO `cow_chat_gift_record` VALUES('1216','21','1','1','1314','24','1483687082');
INSERT INTO `cow_chat_gift_record` VALUES('1217','21','1','1','520','24','1483687084');
INSERT INTO `cow_chat_gift_record` VALUES('1218','21','1','1','10','24','1483687086');
INSERT INTO `cow_chat_gift_record` VALUES('1219','21','1','1','520','24','1483687088');
INSERT INTO `cow_chat_gift_record` VALUES('1220','21','1','1','520','24','1483687088');
INSERT INTO `cow_chat_gift_record` VALUES('1221','21','1','1','520','24','1483687088');
INSERT INTO `cow_chat_gift_record` VALUES('1222','21','1','1','520','24','1483687088');
INSERT INTO `cow_chat_gift_record` VALUES('1223','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1224','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1225','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1226','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1227','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1228','21','1','1','520','24','1483687089');
INSERT INTO `cow_chat_gift_record` VALUES('1229','21','1','1','520','24','1483687090');
INSERT INTO `cow_chat_gift_record` VALUES('1230','21','1','1','520','24','1483687090');
INSERT INTO `cow_chat_gift_record` VALUES('1231','21','1','1','520','24','1483687090');
INSERT INTO `cow_chat_gift_record` VALUES('1232','21','1','1','520','24','1483687090');
INSERT INTO `cow_chat_gift_record` VALUES('1233','21','1','1','520','24','1483687090');
INSERT INTO `cow_chat_gift_record` VALUES('1234','21','1','1','520','24','1483687091');
INSERT INTO `cow_chat_gift_record` VALUES('1235','21','1','1','520','24','1483687091');
INSERT INTO `cow_chat_gift_record` VALUES('1236','21','1','1','520','24','1483687091');
INSERT INTO `cow_chat_gift_record` VALUES('1237','21','1','1','520','24','1483687091');
INSERT INTO `cow_chat_gift_record` VALUES('1238','21','17','1','1','24','1484902760');
INSERT INTO `cow_chat_gift_record` VALUES('1239','21','1','1','30','24','1487733352');
INSERT INTO `cow_chat_gift_record` VALUES('1240','21','1','1','520','24','1487733398');
INSERT INTO `cow_chat_gift_record` VALUES('1241','21','1','1','520','24','1487734875');
INSERT INTO `cow_chat_gift_record` VALUES('1242','21','1','1','1','24','1488889293');
INSERT INTO `cow_chat_gift_record` VALUES('1243','21','1','1','1','24','1488889399');
INSERT INTO `cow_chat_gift_record` VALUES('1244','21','1','1','1','24','1488889421');
INSERT INTO `cow_chat_gift_record` VALUES('1245','21','1','1','1','24','1488889818');
INSERT INTO `cow_chat_gift_record` VALUES('1246','21','1','1','1','24','1488890492');
INSERT INTO `cow_chat_gift_record` VALUES('1247','21','1','1','1','24','1488959282');
INSERT INTO `cow_chat_gift_record` VALUES('1248','21','171','171','10','49','1496384390');
--
-- 表的结构cow_chat_peoples
--

DROP TABLE IF EXISTS `cow_chat_peoples`;
CREATE TABLE `cow_chat_peoples` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` varchar(100) DEFAULT NULL COMMENT '第三方源id',
  `url` text COMMENT '第三方源链接',
  `room_id` int(11) unsigned DEFAULT '0' COMMENT '直播视频id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `peoples_type` tinyint(1) unsigned DEFAULT '0' COMMENT '1为永久 0为临时',
  `add_time` int(11) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_peoples
--

--
-- 表的结构cow_chat_room
--

DROP TABLE IF EXISTS `cow_chat_room`;
CREATE TABLE `cow_chat_room` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '直播房间id',
  `title` varchar(100) DEFAULT NULL COMMENT '房间名称',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '房间状态 0审核中，1通过审核，2关闭',
  `describe` text COMMENT '提示信息',
  `cid` text COMMENT '直播室对应通道ID',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `class_id` int(11) unsigned DEFAULT '0' COMMENT '房间分类',
  `open_peoples` tinyint(1) unsigned DEFAULT '0' COMMENT '是否开启多人视频',
  `get_type` tinyint(1) unsigned DEFAULT '0' COMMENT '获麦方式0为自由获取1为申请获麦',
  `anchor_cover` varchar(255) DEFAULT NULL COMMENT '主播封面',
  `live_time` int(11) unsigned DEFAULT '0' COMMENT '直播时间',
  `add_time` int(11) unsigned DEFAULT '0' COMMENT '开通房间时间',
  `url` text COMMENT '存放直播链接',
  `show_type` tinyint(1) unsigned DEFAULT '1' COMMENT '手机横竖屏显示 0竖屏，1横屏 ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 cow_chat_room
--

INSERT INTO `cow_chat_room` VALUES('45','无所不及的鳕熊','0','无所不及的鳕熊','','30','25','0','0','/upload/user/30/1489646254_1392160342.jpg','0','1489646265','','1');
INSERT INTO `cow_chat_room` VALUES('46','搞笑二人转三丫','0','搞笑二人转三丫','','31','25','0','0','/upload/user/31/1489646283_694626752.jpg','0','1489646294','','1');
INSERT INTO `cow_chat_room` VALUES('44','搞笑唠嗑地主白','0','搞笑唠嗑地主白','','29','25','0','0','/upload/user/29/1489646227_44831436.jpg','0','1489646237','','1');
INSERT INTO `cow_chat_room` VALUES('42','妹妹教你怎么5杀','0','妹妹教你怎么5杀','','27','24','0','0','/upload/user/27/1489646026_61449510.jpg','0','1489646056','','1');
INSERT INTO `cow_chat_room` VALUES('27','农夫山泉有点悬','1','LOL第一坑','a:1:{i:1;s:16:\"A201612190000055\";}','1','30','1','0','/upload/user/10/1482117396_928033635.jpg','0','1482117524','','1');
INSERT INTO `cow_chat_room` VALUES('43','一起歌唱','0','一起歌唱','','28','23','0','0','/upload/user/28/1489646086_763205508.jpg','0','1489646103','','1');
INSERT INTO `cow_chat_room` VALUES('29','吹箫','1','阿克江都','a:1:{i:1;s:16:\"A201612190000059\";}','11','27','0','0','/upload/user/11/1482117519_578280907.jpg','0','1482117601','','1');
INSERT INTO `cow_chat_room` VALUES('33','因我今晚添了妆','1','因我今晚添了妆','','18','26','0','0','/upload/user/18/1489475333_632275655.jpg','0','1489475377','','1');
INSERT INTO `cow_chat_room` VALUES('34','汗水散发我身上','0','汗水散发我身上','','19','26','0','0','/upload/user/19/1489645482_211288442.jpg','0','1489645513','','1');
INSERT INTO `cow_chat_room` VALUES('35','也不须去抵挡','0','也不须去抵挡','','20','26','0','0','/upload/user/20/1489645535_1969061469.jpg','0','1489645563','','1');
INSERT INTO `cow_chat_room` VALUES('36','但现实混淆视野','0','但现实混淆视野','','21','26','0','0','/upload/user/21/1489645579_1036720961.jpg','0','1489645593','','1');
INSERT INTO `cow_chat_room` VALUES('37','lol在线','0','lol在线','','22','24','0','0','/upload/user/22/1489645664_1655959954.jpg','0','1489645687','','1');
INSERT INTO `cow_chat_room` VALUES('38','妹妹上单','0','妹妹上单','','23','24','0','0','/upload/user/23/1489645703_1294626175.jpg','0','1489645720','','1');
INSERT INTO `cow_chat_room` VALUES('39','开黑','0','开黑','','24','24','0','0','/upload/user/24/1489645737_745611501.jpg','0','1489645750','','1');
INSERT INTO `cow_chat_room` VALUES('40','我的笑怎么突然是雨后的阳光','0','我的笑怎么突然是雨后的阳光','','25','0','0','0','/upload/user/25/1489645873_331748643.png','0','1489645877','','1');
INSERT INTO `cow_chat_room` VALUES('41','竟让太多奢望像羽毛一样轻','0','竟让太多奢望像羽毛一样轻','','26','23','0','0','/upload/user/26/1489645890_865745459.jpg','0','1489645903','','1');
INSERT INTO `cow_chat_room` VALUES('47','情感主播小不点','0','情感主播小不点','a:1:{i:1;s:2:\"47\";}','32','25','0','0','/upload/user/32/1489646316_1176147645.jpg','0','1489646329','','1');
INSERT INTO `cow_chat_room` VALUES('48','qwe','1','qweqwe','','138','26','0','0','/upload/user/138/1491639677_1425135640.jpg','0','1491639693','','1');
INSERT INTO `cow_chat_room` VALUES('49','电饭锅','1','个人嘎','a:1:{i:1;s:2:\"49\";}','171','23','0','0','/upload/user/171/1495447616_234700110.gif','0','1495447636','','1');
