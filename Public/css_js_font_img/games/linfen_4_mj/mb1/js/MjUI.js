// JavaScript Document
var CLASS$=Laya.class;
var STATICATTR$=Laya.static;
var View=laya.ui.View;
var Dialog=laya.ui.Dialog;

var MJRoomUI=(function(_super){
		function MJRoomUI(){
			
		    this.imgDesktop=null;
		    this.butRoomShow=null;
		    this.butPosition=null;
		    this.imgShow=null;
		    this.txtRoomSn=null;
		    this.butRoomSet=null;
		    this.butBack=null;
		    this.butMessage=null;
		    this.selectDirection=null;
		    this.userHead_3=null;
		    this.imgReady_3=null;
		    this.butRequestFriend=null;
		    this.butReady=null;
		    this.userHead_0=null;
		    this.imgReady_0=null;
		    this.userHead_1=null;
		    this.imgReady_1=null;
		    this.userHead_2=null;
		    this.imgReady_2=null;
		    this.cardsLeftSprite=null;
		    this.cardsTopSprite=null;
		    this.cardsRightSprite=null;
		    this.discardDownSprite=null;
		    this.discardLeftSprite=null;
		    this.discardRightSprite=null;
		    this.discardTopSprite=null;
		    this.cardsDownSprite=null;
		    this.butButtons=null;

			MJRoomUI.__super.call(this);
		}

		CLASS$(MJRoomUI,'ui.MJRoomUI',_super);
		var __proto__=MJRoomUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRoomUI.uiView);
		}

		STATICATTR$(MJRoomUI,
		['uiView',function(){return this.uiView={"type":"View","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":0,"x":0,"var":"imgDesktop","skin":GC.MjImg+"bg/tablebg.png"}},{"type":"Image","props":{"y":30,"x":49,"var":"butRoomShow","skin":"room/roomrule.png"}},{"type":"Image","props":{"y":30,"x":129,"var":"butPosition","skin":"room/location.png"}},{"type":"Sprite","props":{"y":128,"x":59,"width":64,"var":"imgShow","height":87},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/front_show_big.png"}}]},{"type":"Text","props":{"y":7,"x":595,"width":175,"var":"txtRoomSn","valign":"middle","text":"号:123456","height":37,"fontSize":30,"font":"SimHei","color":"#e7df28","align":"center"}},{"type":"Image","props":{"y":30,"x":1164,"var":"butRoomSet","skin":"room/dt_play_setting_btn0.png"}},{"type":"Image","props":{"y":30,"x":1252,"var":"butBack","skin":"room/dt_play_likai_btn0.png"}},{"type":"Image","props":{"y":670,"x":1281,"var":"butMessage","skin":"room/dt_play_liaotian_btn0.png"}},{"type":"Sprite","props":{"y":386,"x":691,"width":133,"var":"selectDirection","pivotY":64,"pivotX":66,"height":133},"child":[{"type":"Image","props":{"y":63,"x":70,"width":149,"skin":"room/zhuan.png","pivotY":63,"pivotX":70,"height":149}},{"type":"Image","props":{"y":13,"x":109,"skin":"room/east.png","name":"w_2"}},{"type":"Image","props":{"y":103,"x":17,"skin":"room/north.png","name":"w_1"}},{"type":"Image","props":{"y":11,"x":16,"skin":"room/south.png","name":"w_3"}},{"type":"Image","props":{"y":13,"x":12,"skin":"room/west.png","name":"w_0"}},{"type":"Clip","props":{"y":50,"x":47,"skin":"room/num.png","name":"num0","index":0,"clipX":10}},{"type":"Clip","props":{"y":50,"x":74,"skin":"room/num.png","name":"num1","index":0,"clipX":10}},{"type":"Text","props":{"y":22,"x":73,"width":18,"text":"北","strokeColor":"#fbf8f8","stroke":2,"rotation":180,"pivotY":8.68263473053895,"pivotX":8.982035928143773,"name":"f_3","height":18,"fontSize":18,"font":"SimHei","color":"#fb0303","bold":true}},{"type":"Text","props":{"y":110,"x":66,"text":"南","strokeColor":"#f9f6f6","stroke":2,"name":"f_1","fontSize":18,"font":"SimHei","color":"#061aff","bold":true}},{"type":"Text","props":{"y":70,"x":26,"width":18,"text":"西","strokeColor":"#033efb","stroke":3,"rotation":90,"pivotY":9.183673469387713,"pivotX":9.693877551020478,"name":"f_0","height":18,"fontSize":18,"font":"SimHei","color":"#fff403","bold":true}},{"type":"Text","props":{"y":70,"x":122,"width":18,"text":"东","strokeColor":"#0841f6","stroke":3,"rotation":270,"pivotY":8.163265306122412,"pivotX":9.693877551020364,"name":"f_2","height":18,"fontSize":18,"font":"SimHei","color":"#f8f6f6","bold":true}},{"type":"Text","props":{"y":-25,"x":33,"width":80,"strokeColor":"#fb0303","stroke":2,"name":"game_num_font","height":22,"fontSize":20,"color":"#fde905","align":"center"}},{"type":"Text","props":{"y":151,"x":-23,"width":197,"strokeColor":"#f80303","stroke":3,"name":"surplus_font","height":25,"fontSize":20,"color":"#f8e403","align":"center"}}]},{"type":"Sprite","props":{"y":193,"x":654,"width":84,"var":"userHead_3","height":84},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","name":"img_head_bg"}},{"type":"Image","props":{"y":0,"x":0,"width":80,"name":"img_head","height":80},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","renderType":"mask"}}]},{"type":"Image","props":{"y":115,"x":-17,"skin":"room/winorlosebg.png","name":"txt_point_bg","alpha":0}},{"type":"Text","props":{"y":81,"x":-22,"width":123,"valign":"middle","name":"txt_name","height":31,"fontSize":25,"color":"#f6f3f3","alpha":0,"align":"center"}},{"type":"Text","props":{"y":116,"x":-14,"width":105,"valign":"middle","name":"txt_point","height":20,"fontSize":18,"color":"#ffffff","alpha":0,"align":"center"}},{"type":"Image","props":{"y":8,"x":82,"skin":"room/zhuang.png","name":"img_zhuang"}},{"type":"Image","props":{"y":50,"x":17,"skin":"room/fangzhutip.png","name":"img_room"}},{"type":"Image","props":{"y":8,"x":5,"var":"imgReady_3","skin":"room/p_ready.png"}}]},{"type":"Image","props":{"y":338,"x":539,"var":"butRequestFriend","skin":"room/invitewchat.png"}},{"type":"Image","props":{"y":637,"x":573,"var":"butReady","skin":"room/ready.png"}},{"type":"Sprite","props":{"y":339,"x":408,"width":84,"var":"userHead_0","height":84},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","name":"img_head_bg"}},{"type":"Image","props":{"y":0,"x":0,"width":80,"name":"img_head","height":80},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","renderType":"mask"}}]},{"type":"Image","props":{"y":115,"x":-17,"skin":"room/winorlosebg.png","name":"txt_point_bg","alpha":0}},{"type":"Text","props":{"y":81,"x":-22,"width":123,"valign":"middle","name":"txt_name","height":33,"fontSize":25,"color":"#f6f3f3","alpha":0,"align":"center"}},{"type":"Text","props":{"y":116,"x":-14,"width":105,"valign":"middle","name":"txt_point","height":20,"fontSize":18,"color":"#ffffff","alpha":0,"align":"center"}},{"type":"Image","props":{"y":8,"x":82,"skin":"room/zhuang.png","name":"img_zhuang"}},{"type":"Image","props":{"y":50,"x":17,"skin":"room/fangzhutip.png","name":"img_room"}},{"type":"Image","props":{"y":10,"x":6,"var":"imgReady_0","skin":"room/p_ready.png"}}]},{"type":"Sprite","props":{"y":487,"x":654,"width":84,"var":"userHead_1","height":84},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","name":"img_head_bg"}},{"type":"Image","props":{"y":0,"x":0,"width":80,"name":"img_head","height":80},"child":[{"type":"Image","props":{"y":0,"x":0,"width":80,"skin":"room/headpathbg.png","renderType":"mask","height":80}}]},{"type":"Image","props":{"y":115,"x":-17,"skin":"room/winorlosebg.png","name":"txt_point_bg","alpha":0}},{"type":"Text","props":{"y":79,"x":-22,"width":123,"valign":"middle","name":"txt_name","height":33,"fontSize":25,"color":"#f6f3f3","alpha":0,"align":"center"}},{"type":"Text","props":{"y":116,"x":-14,"width":105,"valign":"middle","name":"txt_point","height":20,"fontSize":18,"color":"#ffffff","alpha":0,"align":"center"}},{"type":"Image","props":{"y":8,"x":82,"skin":"room/zhuang.png","name":"img_zhuang"}},{"type":"Image","props":{"y":50,"x":17,"skin":"room/fangzhutip.png","name":"img_room"}},{"type":"Image","props":{"y":11,"x":5,"var":"imgReady_1","skin":"room/p_ready.png"}}]},{"type":"Sprite","props":{"y":339,"x":939,"width":84,"var":"userHead_2","height":84},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","name":"img_head_bg"}},{"type":"Image","props":{"y":0,"x":0,"width":80,"name":"img_head","height":80},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/headpathbg.png","renderType":"mask"}}]},{"type":"Image","props":{"y":115,"x":-17,"skin":"room/winorlosebg.png","name":"txt_point_bg","alpha":0}},{"type":"Text","props":{"y":80,"x":-22,"width":123,"valign":"middle","name":"txt_name","height":33,"fontSize":25,"color":"#f6f3f3","alpha":0,"align":"center"}},{"type":"Text","props":{"y":116,"x":-14,"width":105,"valign":"middle","name":"txt_point","height":20,"fontSize":18,"color":"#ffffff","alpha":0,"align":"center"}},{"type":"Image","props":{"y":12,"x":-58,"skin":"room/zhuang.png","name":"img_zhuang"}},{"type":"Image","props":{"y":50,"x":17,"skin":"room/fangzhutip.png","name":"img_room"}},{"type":"Image","props":{"y":7,"x":6,"var":"imgReady_2","skin":"room/p_ready.png"}}]},{"type":"Sprite","props":{"y":42,"x":203,"width":69,"var":"cardsLeftSprite","height":518}},{"type":"Sprite","props":{"y":87,"x":386,"width":536,"var":"cardsTopSprite","height":64}},{"type":"Sprite","props":{"y":36,"x":1092,"width":68,"var":"cardsRightSprite","height":552}},{"type":"Sprite","props":{"y":477,"x":440,"width":498,"var":"discardDownSprite","height":106}},{"type":"Sprite","props":{"y":156,"x":281,"width":113,"var":"discardLeftSprite","height":429}},{"type":"Sprite","props":{"y":156,"x":963,"width":113,"var":"discardRightSprite","height":429}},{"type":"Sprite","props":{"y":162,"x":433,"width":498,"var":"discardTopSprite","height":106}},{"type":"Sprite","props":{"y":606,"x":108,"width":1138,"var":"cardsDownSprite","height":124}},{"type":"Sprite","props":{"y":565,"x":1309,"width":36,"var":"butButtons","height":43}}]};}
		]);
		return MJRoomUI;
	})(View);
	
var MJCurrentGainsUI=(function(_super){
		function MJCurrentGainsUI(){
			
		    this.imgBigBg=null;
		    this.butClose=null;
		    this.imgStatus=null;
		    this.imgShare=null;
		    this.butContinue=null;
		    this.listGrade=null;

			MJCurrentGainsUI.__super.call(this);
		}

		CLASS$(MJCurrentGainsUI,'ui.MJCurrentGainsUI',_super);
		var __proto__=MJCurrentGainsUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJCurrentGainsUI.uiView);
		}
		MJCurrentGainsUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":68,"x":90,"var":"imgBigBg","skin":GC.MjImg+"bg/bigDbg.png"}}//,{"type":"Image","props":{"y":33,"x":1244,"var":"butClose","skin":"public/close.png"}}
		,{"type":"Image","props":{"y":87,"x":621,"var":"imgStatus","skin":"mjgains/single_title2.png"}},{"type":"Image","props":{"y":611,"x":709,"var":"imgShare","skin":"mjcurrentgains/btn_border_green_m.png"}},{"type":"Image","props":{"y":613,"x":475,"var":"butContinue","skin":"mjcurrentgains/btn_border_yellow_m.png"}},{"type":"List","props":{"y":172,"x":143,"width":1102,"var":"listGrade","height":432},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1102,"skin":"mjcurrentgains/bg_green_select_frame.png","name":"imgListBg","height":106,"sizeGrid":"16,14,18,14"}},{"type":"Image","props":{"y":9,"x":35,"width":85,"skin":"public/face_frame.png","name":"imgHeadpath","height":85}},{"type":"Sprite","props":{"y":28,"x":167,"width":546,"name":"spriteCardsList","height":56}},{"type":"Label","props":{"y":34,"x":941,"width":80,"text":"0分","name":"txtRecord","height":50,"fontSize":28,"font":"Microsoft YaHei","color":"#000000"}},{"type":"Image","props":{"y":24,"x":813,"skin":"mjcurrentgains/tile_face_lie_white.png","name":"imgMjwite"}},{"type":"Image","props":{"y":2,"x":12,"skin":"mjcurrentgains/zhuang.png","name":"imgZhuang"}},{"type":"Image","props":{"y":24,"x":813,"name":"imgCards"}}]}]}]};
		return MJCurrentGainsUI;
	})(Dialog);
var MJDissolveUI=(function(_super){
		function MJDissolveUI(){
			
		    this.butClose=null;
		    this.imgAgree=null;
		    this.imgRefuse=null;
		    this.txtShowText=null;
		    this.txtReciprocal=null;
		    this.txtOperation=null;

			MJDissolveUI.__super.call(this);
		}

		CLASS$(MJDissolveUI,'ui.MJDissolveUI',_super);
		var __proto__=MJDissolveUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJDissolveUI.uiView);
		}
		MJDissolveUI.uiView={"type":"Dialog","props":{"width":910,"height":600},"child":[{"type":"Image","props":{"y":46,"x":2,"skin":GC.MjImg+"bg/littleDbg.png"}},{"type":"Label","props":{"y":77,"x":329,"width":217,"text":"申请解散房间","strokeColor":"#3e0005","stroke":4,"height":47,"fontSize":32,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":468,"x":237,"var":"imgAgree","skin":"mjdissolve/btnDissolve.png"}},{"type":"Image","props":{"y":471,"x":474,"var":"imgRefuse","skin":"mjdissolve/btnnoDissolve.png"}},{"type":"Image","props":{"y":415,"x":306,"var":"txtShowText","skin":"mjdissolve/showtext01.png"}},{"type":"Label","props":{"y":407,"x":369,"width":90,"var":"txtReciprocal","text":"120","height":55,"fontSize":45,"color":"#ff0300","bold":true,"align":"center"}},{"type":"Label","props":{"y":162,"x":106,"wordWrap":true,"width":669,"var":"txtOperation","text":"玩家【崔大湿】申请解散房间，请问是否同意？（超过3分钟 未做选择，则默认同意）","leading":15,"height":66,"fontSize":20,"font":"Microsoft YaHei","color":"#442600"}}]};
		return MJDissolveUI;
	})(Dialog);
var MJTotleRecordUI=(function(_super){
		function MJTotleRecordUI(){
			
		    this.butClose=null;
		    this.listRecord=null;
		    this.imgShare=null;
		    this.imgGameInfo=null;
		    this.imgTime=null;

			MJTotleRecordUI.__super.call(this);
		}

		CLASS$(MJTotleRecordUI,'ui.MJTotleRecordUI',_super);
		var __proto__=MJTotleRecordUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJTotleRecordUI.uiView);
		}
		MJTotleRecordUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":60,"x":79,"skin":GC.MjImg+"bg/bigDbg.png"}},{"type":"Image","props":{"y":21,"x":1231,"var":"butClose","skin":"public/close.png"}},{"type":"List","props":{"y":141,"x":143,"width":1101,"var":"listRecord","spaceX":4,"height":469},"child":[{"type":"Box","props":{"y":41,"x":10,"name":"render"},"child":[{"type":"Image","props":{"skin":"mjtotlerecord/greybg.png","name":"imgBg"}},{"type":"Image","props":{"y":68,"x":159,"skin":"mjtotlerecord/all_result_2.png","name":"imgMaster"}},{"type":"Image","props":{"y":23,"x":15,"width":66,"skin":"publicgame/face_frame.png","name":"imgHeadpath","height":66}},{"type":"Image","props":{"y":19,"x":13,"width":70,"skin":"publicgame/face_frame.png","height":73}},{"type":"Image","props":{"y":-17,"x":-9,"skin":"mjtotlerecord/bestwinner.png","name":"imgWin"}},{"type":"Label","props":{"y":6,"x":90,"width":136,"text":"昵称","name":"txtNickname","height":33,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":157,"x":171,"width":63,"text":"0","name":"txtSnum","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":201,"x":171,"width":63,"text":"0","name":"txtHnum","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":200,"x":37,"width":105,"text":"胡牌次数","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":156,"x":37,"width":105,"text":"连胜记录","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":33,"x":91,"text":"ID:","name":"txtId","fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":366,"x":53,"width":84,"text":"总积分","strokeColor":"7c2700","stroke":4,"height":42,"fontSize":25,"font":"Microsoft YaHei","color":"#ffb700","bold":true}},{"type":"Label","props":{"y":369,"x":150,"width":71,"text":"-5","name":"txtTotlenum","height":32,"fontSize":25,"color":"#7c2700"}}]}]},{"type":"Image","props":{"y":612,"x":579,"var":"imgShare","skin":"mjtotlerecord/border_yellow_m.png"}},{"type":"Image","props":{"y":88,"x":573,"skin":"mjtotlerecord/title.png"}},{"type":"Label","props":{"y":616,"x":164,"width":382,"var":"imgGameInfo","name":"item0","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#581f00"}},{"type":"Label","props":{"y":653,"x":164,"width":382,"var":"imgTime","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#581f00"}}]};
		return MJTotleRecordUI;
	})(Dialog);
var MJIpShowUI=(function(_super){
		function MJIpShowUI(){
			
		    this.butClose=null;
		    this.listDistanceList=null;

			MJIpShowUI.__super.call(this);
		}

		CLASS$(MJIpShowUI,'ui.MJIpShowUI',_super);
		var __proto__=MJIpShowUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJIpShowUI.uiView);
		}
		MJIpShowUI.uiView={"type":"Dialog","props":{"width":920,"height":600},"child":[{"type":"Image","props":{"y":50,"x":9,"skin":GC.MjImg+"bg/littleDbg.png"}},{"type":"Image","props":{"y":15,"x":835,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":78,"x":318,"width":257,"text":" IP距离显示","strokeColor":"#4f0100","stroke":5,"height":56,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"List","props":{"y":151,"x":55,"width":783,"var":"listDistanceList","height":393},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"width":783,"skin":"mjipshow/listbg.png","name":"item0","height":130,"sizeGrid":"-47,10,-63,9"}},{"type":"Image","props":{"y":44,"x":599,"skin":"mjipshow/location.png","name":"item0"}},{"type":"Label","props":{"y":50,"x":489,"width":86,"text":"IP相同","name":"txtShowIp","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#ff0400"}},{"type":"Label","props":{"y":52,"x":656,"width":86,"text":"相距0米","name":"txtdistanceBetween","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#047800"}},{"type":"Label","props":{"y":33,"x":308,"width":145,"text":"192.168.1.1","name":"txtIP1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":68,"x":308,"width":145,"text":"192.168.1.1","name":"txtIP2","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":33,"x":93,"width":145,"text":"昵称1","name":"txtNickname1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":68,"x":93,"width":145,"text":"昵称2","name":"txtNickname2","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}}]}]}]};
		return MJIpShowUI;
	})(Dialog);
var MJRoomSetUI=(function(_super){
		function MJRoomSetUI(){
			
		    this.butClose=null;
		    this.imgSonoff=null;
		    this.imgMonoff=null;
		    this.butTableColor=null;
		    this.imgRoomOut=null;

			MJRoomSetUI.__super.call(this);
		}

		CLASS$(MJRoomSetUI,'ui.MJRoomSetUI',_super);
		var __proto__=MJRoomSetUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRoomSetUI.uiView);
		}
		MJRoomSetUI.uiView={"type":"Dialog","props":{"width":920,"height":585},"child":[{"type":"Image","props":{"y":38,"x":7,"skin":GC.MjImg+"bg/littleDbg.png"}},{"type":"Image","props":{"y":1,"x":832,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":200,"x":146,"width":94,"text":"音乐","name":"item0","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":200,"x":387,"width":94,"text":"音效","name":"item1","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":66,"x":332,"width":217,"text":"设置","strokeColor":"#3e0005","stroke":4,"height":51,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":194,"x":486,"var":"imgSonoff","skin":"mjroomset/musicon.png"}},{"type":"Image","props":{"y":193,"x":243,"var":"imgMonoff","skin":"mjroomset/soundon.png"}},{"type":"Label","props":{"y":289,"x":146,"width":145,"text":"切换桌布","name":"item0","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"RadioGroup","props":{"y":291,"x":311,"width":420,"var":"butTableColor","space":33,"skin":"public/radiogroup.png","selectedIndex":0,"labels":"清新绿,深海蓝,艳丽红","labelStroke":0,"labelSize":30,"labelFont":"Microsoft YaHei","labelColors":"#993105","labelBold":true,"height":39}},{"type":"Image","props":{"y":428,"x":350,"var":"imgRoomOut","skin":"mjroomset/releasebtn.png"}}]};
		return MJRoomSetUI;
	})(Dialog);
var MJRoomInfoUI=(function(_super){
		function MJRoomInfoUI(){
			
		    this.txtCardNum=null;
		    this.txtPayWay=null;
		    this.txtPlayType=null;
		    this.butClose=null;

			MJRoomInfoUI.__super.call(this);
		}

		CLASS$(MJRoomInfoUI,'ui.MJRoomInfoUI',_super);
		var __proto__=MJRoomInfoUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRoomInfoUI.uiView);
		}
		MJRoomInfoUI.uiView={"type":"View","props":{"width":190,"height":260},"child":[{"type":"Image","props":{"y":30,"x":1,"width":165,"skin":GC.MjImg+"bg/roominfobg.png","height":221}},{"type":"Label","props":{"y":60,"x":17,"width":151,"var":"txtCardNum","text":"4局(20房卡)","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#783e00"}},{"type":"Label","props":{"y":100,"x":17,"width":151,"var":"txtPayWay","text":"房主支付","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#783e00"}},{"type":"Label","props":{"y":140,"x":17,"width":151,"var":"txtPlayType","text":"明花","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#783e00"}},{"type":"Image","props":{"y":6,"x":127,"width":64,"var":"butClose","skin":"public/close.png","height":64}}]};
		return MJRoomInfoUI;
	})(View);
	

