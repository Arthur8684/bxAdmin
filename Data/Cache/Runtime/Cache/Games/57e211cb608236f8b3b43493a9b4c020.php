<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'/>
	<title>游戏</title>
	<meta name='viewport' content='width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no'/>
	<meta name='apple-mobile-web-app-capable' content='yes' />
	<meta name='full-screen' content='true' />
	<meta name='screen-orientation' content='portrait' />
	<meta name='x5-fullscreen' content='true' />
	<meta name='360-fullscreen' content='true' />
	<meta http-equiv='expires' content='0' />
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/jquery.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.core.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.webgl.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.ani.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.filter.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.html.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.particle.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.tiledmap.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.device.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="/cowcms/Public/css_js_font_img/global/plugins/layabox/js/laya.ui.min.js" type="text/javascript"></SCRIPT>
    <script src="/cowcms/Public/css_js_font_img/games/games/App.js?<?php echo ($randDate); ?>"></script>
    <script src="/cowcms/Public/css_js_font_img/games/games/function.js?<?php echo ($randDate); ?>"></script>
</head>
<body>

<script>
GC.MJT = 'mb1';
GC.SoundClick ="m_DaoJiShi.mp3";//点击事件
GC.SoundClickNum ="m_clickNum.mp3";//点击数组
GC.SoundMusic ="m_BeiJingYinYue2.mp3";//背景音乐
GC.SoundQipai ="m_QiPai.mp3";//摸牌
GC.SoundDapai ="m_QiPai.mp3";//摸牌
GC.SoundLiangpai ="m_LiangPai.mp3";//亮牌
GC.SoundFapai ="m_FaPai.mp3";//亮牌
GC.SoundChatPath = GC.ResPath+'games/'+GC.Tindex+'/sound/chat/'
var MjImg = GC.ResPath+'games/'+GC.Tindex+'/img/';
$(document).ready(function() { 
	init();
	Laya.loader.load([
		{url: MjImg+"mjload/mjload.json",type: Loader.ATLAS},
		{url: MjImg+"public/public.json",type: Loader.ATLAS},
		{url: MjImg+"public/mjlogo.png",type: Loader.IMAGE},
	], Handler.create(this, function(){
		MJload = new MJLoad();
		MJload.init();
		Laya.stage.addChild(MJload);
		var loadRoom = [{url:  MjImg+"mjindex/mjindex.json",type: Loader.ATLAS},
		//{url: MjImg+"mjindex/mjrink.json",type:  Loader.ATLAS},
		{url: MjImg+"gameload/gameload.json",type:  Loader.ATLAS},
		{url: MjImg+"mjindex/mjjoinroom.json",type:  Loader.ATLAS},
		{url: MjImg+"mjindex/mjcreatroom.json",type:  Loader.ATLAS},
		{url: MjImg+"mjindex/mjactivity.json",type:  Loader.ATLAS},
		{url: MjImg+"mjIndex/mjshare.json",type: Loader.ATLAS},
		{url: MjImg+"bg/shop.jpg",type: Loader.IMAGE},
		{url: MjImg+"bg/littleDbg.png",type: Loader.IMAGE},
		{url: MjImg+"bg/bigDbg.png",type: Loader.IMAGE},
		{url: MjImg+"bg/activitybg.png",type: Loader.IMAGE},
		{url: MjImg+"bg/title_bg_1.png",type: Loader.IMAGE},
		{url: MjImg+"bg/title_bg_2.png",type: Loader.IMAGE},
		{url: GC.MjImg+"bg/roominfobg.png",type: Loader.IMAGE},
//		{url: MjImg+"mjindex/mjgains.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/mjchat.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/mjface.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/1.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/2.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/3.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/4.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/5.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/6.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/7.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/8.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/9.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/10.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/11.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/12.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/13.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/14.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/15.json",type:  Loader.ATLAS},
		{url: MjImg+"chat/face/16.json",type:  Loader.ATLAS},
		{url: MjImg+"bg/index_bg.png",type: Loader.IMAGE},
		{url: GC.MjImg+"bg/tablebg.png",type: Loader.IMAGE},//麻将游戏房间开始
		{url: GC.MjImg+"room/room.json",type: Loader.ATLAS},
		{url: GC.MjImg+"room/mjipshow.json",type: Loader.ATLAS},
		{url: GC.ResPath+"majiang/majiang.json",type: Loader.ATLAS},
		{url: GC.ResPath+"majiang/bg/majiangbg.json",type: Loader.ATLAS},
		{url: GC.MjImg+"room/mjcurrentgains.json",type: Loader.ATLAS},
		//{url: GC.MjImg+"room/public.json",type: Loader.ATLAS},
		{url: GC.MjImg+"room/mjgains.json",type: Loader.ATLAS},
		{url: GC.MjImg+"bg/littleDbg.png",type: Loader.IMAGE},//麻将游戏房间开始
		{url: GC.MjImg+"bg/bigDbg.png",type: Loader.IMAGE},//麻将游戏房间开始
		{url: GC.MjImg+"room/mjroomset.json",type: Loader.ATLAS},
		{url: GC.MjImg+"room/mjdissolve.json",type: Loader.ATLAS},
		{url: GC.MjImg+"room/mjtotlerecord.json",type: Loader.ATLAS},//麻将游戏房间结束
		{url: MjImg+"mjIndex/mjrink.json",type: Loader.ATLAS},
		];		
	Laya.loader.load(loadRoom, Handler.create(this, function(){
			MJload.progressNum.removeSelf();
			MJload.txtPreNum.removeSelf();
			MJload.addChild(MJload.butWchat);
			GC.Sound.musicMuted=LocalStorage.getItem("musicMuted")!="0"?1:0;
			GC.Sound.soundMuted=LocalStorage.getItem("soundMuted")!="0"?1:0;
			SoundManager.musicMuted=GC.Sound.musicMuted?false:true;
			SoundManager.soundMuted=GC.Sound.soundMuted?false:true;
			soundPlay(GC.SoundMusic,1);
		}, null, false), Handler.create(this, function(progress){
			MJload.progressNum.value = progress;
			MJload.txtPreNum.text = Math.round(progress*100)+'%';
			MJload.addChild(MJload.progressNum);
		}, null, false), Loader.TEXT); 
	}), null, Loader.ATLAS); 
	 
});
</script>
<script src="/cowcms/Public/css_js_font_img/games/games/mb2/js/GamesUI.js?<?php echo ($randDate); ?>"></script>
<script src="/cowcms/Public/css_js_font_img/games/games/mb2/js/Games.js?<?php echo ($randDate); ?>"></script> 
<script src="/cowcms/Public/css_js_font_img/games/linfen_4_mj/mb1/js/MjUI.js?<?php echo ($randDate); ?>"></script>  
<script src="/cowcms/Public/css_js_font_img/games/linfen_4_mj/mb1/js/Mj.js?<?php echo ($randDate); ?>"></script> 
</body>
</html>