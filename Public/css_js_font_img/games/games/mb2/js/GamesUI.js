var MJActivityUI=(function(_super){
		function MJActivityUI(){
			
		    this.imgTextbg=null;
		    this.imgClose=null;
		    this.htmlMJActivity=null;
		    this.txtNotice=null;
		    this.txtActivity=null;
		    this.listTitle=null;

			MJActivityUI.__super.call(this);
		}

		CLASS$(MJActivityUI,'ui.MJActivityUI',_super);
		var __proto__=MJActivityUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("HTMLDivElement",laya.html.dom.HTMLDivElement);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJActivityUI.uiView);
		}	
		MJActivityUI.uiView={"type":"Dialog","props":{"width":1100,"name":"render","height":570},"child":[{"type":"Image","props":{"y":74,"x":228,"skin":MjImg+"bg/activitybg.png"}},{"type":"Image","props":{"y":78,"x":7,"skin":"mjactivity/activityleftbg.png"}},{"type":"Image","props":{"y":8,"x":367,"var":"imgTextbg","skin":MjImg+"bg/title_bg_1.png"}},{"type":"Image","props":{"y":35,"x":1013,"var":"imgClose","skin":"public/close.png"}},{"type":"List","props":{"y":197,"x":16,"width":195,"var":"listTitle","spaceY":5,"height":337},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"width":195,"skin":"mjcreatroom/createroom_3.png","name":"imgTitle","height":76}},{"type":"Label","props":{"y":16,"x":16,"width":142,"text":"题目 ","overflow":"hidden","name":"txtTitle","height":44,"fontSize":27,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}}]}]},{"type":"Label","props":{"y":24,"x":418,"width":198,"var":"txtNotice","strokeColor":"#640100","stroke":3,"height":38,"fontSize":25,"font":"Microsoft YaHei","color":"#ffffff","bold":true,"align":"center"}},{"type":"Label","props":{"y":25,"x":665,"width":198,"var":"txtActivity","strokeColor":"#232323","stroke":3,"height":38,"fontSize":25,"font":"Microsoft YaHei","color":"#aaaaaa","bold":true,"align":"center"}},{"type":"Panel","props":{"y":119,"x":260,"width":775,"var":"panelHtml","vScrollBarSkin":"public/vscroll.png","height":394},"child":[{"type":"HTMLDivElement","props":{"width":733,"var":"htmlMJActivity","vScrollBarSkin":"public/vscroll.png","height":380}}]},{"type":"Image","props":{"y":114,"x":16,"width":195,"var":"imgReal","skin":"mjcreatroom/createroom_2.png","height":76}},{"type":"Text","props":{"y":132,"x":29,"width":145,"text":"实名认证","height":37,"fontSize":27,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}}]};
		return MJActivityUI;
	})(Dialog);
var MJAuthUI=(function(_super){
		function MJAuthUI(){
			
		    this.butClose=null;
		    this.butSubmit=null;
		    this.inputReal=null;
		    this.inputIDnum=null;

			MJAuthUI.__super.call(this);
		}

		CLASS$(MJAuthUI,'ui.MJAuthUI',_super);
		var __proto__=MJAuthUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJAuthUI.uiView);
		}
		MJAuthUI.uiView={"type":"Dialog","props":{"width":930,"height":600},"child":[{"type":"Image","props":{"y":45,"x":5,"skin":MjImg+"bg/littleDbg.png"}},{"type":"Image","props":{"y":5,"x":839,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":77,"x":337,"width":216,"text":"实名认证","strokeColor":"#4f0100","stroke":3,"height":51,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}},{"type":"Image","props":{"y":467,"x":341,"var":"butSubmit","skin":"mjauth/submit.png"}},{"type":"Label","props":{"y":164,"x":84,"wordWrap":true,"width":721,"text":"      您的游戏账号需要进行实名认证，按照文化部《网络游戏管理暂行办法》的相关要求及您的个人权利保障，网络游戏用户需要使用有效身份证进行实名注册并验证成功，确保安全登录游戏。","leading":10,"height":101,"fontSize":20,"font":"Microsoft YaHei"}},{"type":"Label","props":{"y":419,"x":205,"text":"请确保实名注册为真实有效信息，否则将无法正常游戏","fontSize":20,"font":"Microsoft YaHei","color":"#ff0400","bold":true}},{"type":"TextInput","props":{"y":287,"x":292,"width":390,"var":"inputReal","skin":"public/input.png","promptColor":"#aa0200","prompt":"点击输入姓名","height":45,"fontSize":25,"font":"Microsoft YaHei","color":"#000000","sizeGrid":"8,5,8,4"}},{"type":"TextInput","props":{"y":340,"x":292,"width":389,"var":"inputIDnum","skin":"public/input.png","promptColor":"#aa0200","prompt":"点击输入身份证号","height":45,"fontSize":25,"font":"Microsoft YaHei","color":"#000000","sizeGrid":"8,5,8,4"}},{"type":"Label","props":{"y":289,"x":151,"width":140,"text":"真实姓名","name":"item0","height":45,"fontSize":30,"font":"Microsoft YaHei","color":"#210000"}},{"type":"Label","props":{"y":342,"x":151,"width":140,"text":"身份证号","name":"item1","height":45,"fontSize":30,"font":"Microsoft YaHei","color":"#210000"}}]};
		return MJAuthUI;
	})(Dialog);
var MJComeRoomUI=(function(_super){
		function MJComeRoomUI(){
			
		    this.butClose=null;
		    this.listKeyboard=null;
		    this.txtShownum=null;

			MJComeRoomUI.__super.call(this);
		}

		CLASS$(MJComeRoomUI,'ui.MJComeRoomUI',_super);
		var __proto__=MJComeRoomUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJComeRoomUI.uiView);
		}
		MJComeRoomUI.uiView={"type":"Dialog","props":{"width":920,"height":600},"child":[{"type":"Image","props":{"y":18,"x":3,"skin":MjImg+"bg/littleDbg.png"}},{"type":"Label","props":{"y":48,"x":331,"width":217,"text":"输入房号","strokeColor":"#5d2100","stroke":4,"height":51,"fontSize":35,"font":"Microsoft YaHei","color":"#fff478","align":"center"}},{"type":"Label","props":{"y":217,"x":313,"width":256,"text":"--请输入房号--","strokeColor":"#ffffff","stroke":1,"height":34,"fontSize":20,"font":"Microsoft YaHei","bold":true,"align":"center"}},{"type":"Image","props":{"y":-4,"x":821,"var":"butClose","skin":"public/close.png"}},{"type":"List","props":{"y":247,"x":161,"width":559,"var":"listKeyboard","height":279},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjjoinroom/num1.png","name":"num"}}]}]},{"type":"Label","props":{"y":145,"x":185,"width":505,"visible":false,"var":"txtShownum","height":53,"fontSize":45,"font":"Microsoft YaHei","color":"#000000","bold":true,"align":"left"}}]};
		return MJComeRoomUI;
	})(Dialog);
var MJCreateRoomUI=(function(_super){
		function MJCreateRoomUI(){
			
		    this.butClose=null;
		    this.imgCreateRoom=null;
		    this.GameList=null;
		    this.RadioList=null;

			MJCreateRoomUI.__super.call(this);
		}

		CLASS$(MJCreateRoomUI,'ui.MJCreateRoomUI',_super);
		var __proto__=MJCreateRoomUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJCreateRoomUI.uiView);
		}
		MJCreateRoomUI.uiView={"type":"Dialog","props":{"width":1366,"name":"render","height":768},"child":[{"type":"Image","props":{"y":64,"x":81,"skin":MjImg+"bg/bigDbg.png"}},{"type":"Image","props":{"y":35,"x":1233,"var":"butClose","skin":"public/close.png"}},{"type":"Image","props":{"y":92,"x":577,"skin":"mjcreatroom/creaetroom_10.png"}},{"type":"Image","props":{"y":173,"x":229,"skin":"mjcreatroom/createroom_4.png"}},{"type":"Image","props":{"y":183,"x":422,"width":803,"skin":"mjcreatroom/smallbg.png","height":363,"sizeGrid":"9,12,8,10"}},{"type":"Label","props":{"y":500,"x":630,"width":391,"text":"注：房卡在完成游戏后扣除，提前解散不扣房卡","height":30,"fontSize":15,"font":"Microsoft YaHei","color":"5c3400","bold":false,"align":"center"}},{"type":"Image","props":{"y":581,"x":655,"var":"imgCreateRoom","skin":"mjcreatroom/btncreatroom.png"}},{"type":"List","props":{"y":226,"x":140,"width":252,"var":"GameList","height":416},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjcreatroom/createroom_3.png","name":"imgTextbg"}},{"type":"Label","props":{"y":19,"x":19,"width":189,"strokeColor":"#890100","stroke":4,"name":"txtGamename","height":42,"fontSize":30,"font":"Helvetica","color":"#ffd600","bold":true,"align":"center"}}]}]},{"type":"List","props":{"y":208,"x":460,"width":734,"var":"RadioList","spaceY":25,"height":264},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"RadioGroup","props":{"y":4,"x":134,"width":592,"space":90,"skin":"mjcreatroom/radiogroup.png","selectedIndex":0,"name":"butRadio","labels":"label1,label2","labelSize":25,"labelWidth":180,"labelFont":"Microsoft YaHei","labelColors":"#8b6621,#c52419","labelAlign":"center","height":39}},{"type":"Label","props":{"y":7,"x":9,"width":112,"text":11111,"strokeColor":"#ff0400","stroke":3,"name":"txtRadioName","height":36,"fontSize":30,"color":"#f4ff00"}}]}]}]};
		return MJCreateRoomUI;
	})(Dialog);
var MJCurrentGainsUI=(function(_super){
		function MJCurrentGainsUI(){
			

			MJCurrentGainsUI.__super.call(this);
		}

		CLASS$(MJCurrentGainsUI,'ui.MJCurrentGainsUI',_super);
		var __proto__=MJCurrentGainsUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJCurrentGainsUI.uiView);
		}
		MJCurrentGainsUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":68,"x":90,"skin":MjImg+"public/bigDbg.png"}},{"type":"Image","props":{"y":33,"x":1244,"skin":"public/close.png"}},{"type":"Image","props":{"y":186,"x":143,"width":1102,"skin":"mjcurrentgains/bg_green_select_frame.png","height":118,"sizeGrid":"16,14,18,14"}},{"type":"Image","props":{"y":87,"x":621,"skin":"mjgains/single_title2.png"}},{"type":"Image","props":{"y":603,"x":709,"skin":"mjcurrentgains/btn_border_green_m.png"}},{"type":"Image","props":{"y":603,"x":475,"skin":"mjcurrentgains/btn_border_yellow_m.png"}}]};
		return MJCurrentGainsUI;
	})(Dialog);
var MJDissolveUI=(function(_super){
		function MJDissolveUI(){
			
		    this.txtOriginator=null;

			MJDissolveUI.__super.call(this);
		}

		CLASS$(MJDissolveUI,'ui.MJDissolveUI',_super);
		var __proto__=MJDissolveUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJDissolveUI.uiView);
		}
		MJDissolveUI.uiView={"type":"Dialog","props":{"width":910,"height":600},"child":[{"type":"Image","props":{"y":46,"x":2,"skin":MjImg+"public/littleDbg.png"}},{"type":"Sprite","props":{"y":173,"x":108,"width":672,"var":"txtOriginator","height":70}},{"type":"Image","props":{"y":6,"x":830,"skin":"public/close.png"}},{"type":"Label","props":{"y":73,"x":329,"width":217,"text":"解散房间","strokeColor":"#3e0005","stroke":4,"height":59,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":468,"x":237,"skin":"mjdissolve/btnDissolve.png"}},{"type":"Image","props":{"y":471,"x":474,"skin":"mjdissolve/btnnoDissolve.png"}},{"type":"Image","props":{"y":405,"x":306,"skin":"mjdissolve/showtext01.png"}}]};
		return MJDissolveUI;
	})(Dialog);
var MJGainsUI=(function(_super){
		function MJGainsUI(){
			
		    this.listGains=null;
		    this.butClose=null;

			MJGainsUI.__super.call(this);
		}

		CLASS$(MJGainsUI,'ui.MJGainsUI',_super);
		var __proto__=MJGainsUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJGainsUI.uiView);
		}
		MJGainsUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":71,"x":95,"skin":MjImg+"bg/bigDbg.png"}},{"type":"Image","props":{"y":101,"x":602,"skin":"mjgains/title.png"}},{"type":"List","props":{"y":190,"x":180,"width":1075,"var":"listGains","vScrollBarSkin":"public/vscroll.png","spaceY":20,"height":449},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":MjImg+"bg/big_bg.png"}},{"type":"Label","props":{"y":47,"x":48,"text":1,"name":"txtNum","fontSize":45,"font":"SimHei","color":"#743a00","bold":true}},{"type":"Label","props":{"y":19,"x":130,"text":"房号：23245534","name":"txtRoomNum","fontSize":30,"font":"SimHei","color":"#743a00","bold":true}},{"type":"Label","props":{"y":18,"x":643,"text":"2017-07-02 18:09:08","name":"txtTime","fontSize":30,"font":"SimHei","color":"#743a00","bold":true}},{"type":"List","props":{"y":67,"x":135,"width":411,"spaceY":7,"spaceX":8,"name":"listUserlist","height":64},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Label","props":{"y":0,"x":0,"width":150,"text":"昵称","name":"txtNickname","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}},{"type":"Label","props":{"y":0,"x":150,"width":57,"text":"0","name":"txtPoint","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}}]}]}/*,{"type":"Box","props":{"y":81,"x":794,"name":"boxReplay"},"child":[{"type":"Image","props":{"skin":"mjgains/replay.png"}},{"type":"Label","props":{"y":7,"x":64,"width":112,"text":"比赛回放","height":41,"fontSize":28,"font":"Microsoft YaHei","color":"#a41703","bold":true}}]}*/]}]},{"type":"Image","props":{"y":37,"x":1244,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":642,"x":605,"width":43,"var":"txtPrev","text":"<","height":77,"fontSize":50,"font":"Microsoft YaHei","color":"#4a2c00","bold":true}},{"type":"Label","props":{"y":643,"x":640,"width":124,"var":"txtPage","text":"1","name":"item1","height":77,"fontSize":50,"font":"Microsoft YaHei","color":"#4a2c00","bold":true,"align":"center"}},{"type":"Label","props":{"y":642,"x":761,"width":43,"var":"txtNextpage","text":">","height":77,"fontSize":50,"font":"Microsoft YaHei","color":"#4a2c00","bold":true}}]};
		return MJGainsUI;
	})(Dialog);
var MJGainsDetailUI=(function(_super){
		function MJGainsDetailUI(){
			

			MJGainsDetailUI.__super.call(this);
		}

		CLASS$(MJGainsDetailUI,'ui.MJGainsDetailUI',_super);
		var __proto__=MJGainsDetailUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJGainsDetailUI.uiView);
		}
		MJGainsDetailUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":71,"x":95,"skin":MjImg+"bg/index_bg.png"}},{"type":"Image","props":{"y":101,"x":602,"skin":"mjgains/title.png"}},{"type":"List","props":{"y":190,"x":180,"width":1055,"height":464},"child":[{"type":"Box","props":{},"child":[{"type":"Image","props":{"skin":"mjgains/big_bg.png"},"child":[{"type":"Label","props":{"y":47,"x":48,"text":"1","fontSize":45,"font":"SimHei","color":"#743a00","bold":true}},{"type":"Label","props":{"y":19,"x":130,"text":"房号：23245534","fontSize":30,"font":"SimHei","color":"#743a00","bold":true}},{"type":"Label","props":{"y":18,"x":643,"text":"2017-07-02 18:09:08","fontSize":30,"font":"SimHei","color":"#743a00","bold":true}},{"type":"Label","props":{"y":67,"x":135,"width":201,"text":"昵称                      -5","name":"item0","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}},{"type":"Label","props":{"y":67,"x":390,"width":201,"text":"昵称                      -5","name":"item1","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}},{"type":"Label","props":{"y":104,"x":135,"width":201,"text":"昵称                      -5","name":"item2","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}},{"type":"Label","props":{"y":104,"x":390,"width":201,"text":"昵称                      -5","name":"item3","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#743a00"}},{"type":"Image","props":{"y":81,"x":794,"skin":"mjgains/replay.png"}},{"type":"Label","props":{"y":88,"x":858,"text":"比赛回放","fontSize":28,"font":"Microsoft YaHei","color":"#a41703","bold":true}}]}]}]}]};
		return MJGainsDetailUI;
	})(Dialog);
//var MJIndexUI=(function(_super){
//		function MJIndexUI(){
//			
//		    this.imgPlayFun=null;
//		    this.imgMsg=null;
//		    this.imgSetting=null;
//		    this.imgHeadpath=null;
//		    this.imgAddcard=null;
//		    this.txtNickname=null;
//		    this.imgJoinRoom=null;
//		    this.imgCreatRoom=null;
//		    this.BottomList=null;
//		    this.txtId=null;
//		    this.txtCard=null;
//		    this.txtNotic=null;
//
//			MJIndexUI.__super.call(this);
//		}
//
//		CLASS$(MJIndexUI,'ui.MJIndexUI',_super);
//		var __proto__=MJIndexUI.prototype;
//		__proto__.createChildren=function(){
//		    
//			laya.ui.Component.prototype.createChildren.call(this);
//			this.createView(MJIndexUI.uiView);
//		}
//		MJIndexUI.uiView={"type":"View","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1366,"skin":MjImg+"bg/index_bg.png","height":768}},{"type":"Image","props":{"y":21,"x":601,"skin":"mjIndex/indx_logo.png"}},{"type":"Image","props":{"y":42,"x":1030,"var":"imgPlayFun","skin":"mjIndex/main_helpBtn.png"}},{"type":"Image","props":{"y":42,"x":1128,"var":"imgMsg","skin":"mjIndex/main_msgBtn.png"}},{"type":"Image","props":{"y":42,"x":1225,"var":"imgSetting","skin":"mjIndex/main_setBtn.png"}},{"type":"Image","props":{"y":45,"x":39,"width":105,"var":"imgHeadpath","skin":"mjIndex/face_frame.png","height":105}},{"type":"Image","props":{"y":120,"x":431,"width":536,"skin":"mjIndex/loadingboard.png","height":38,"sizeGrid":"7,15,7,15"}},{"type":"Image","props":{"y":112,"x":411,"width":49,"skin":"mjIndex/hall_18.png","height":52}},{"type":"Box","props":{"y":122,"x":159},"child":[{"type":"Image","props":{"y":0,"x":57,"width":97,"skin":"mjIndex/hall_7.png","height":35,"sizeGrid":"5,5,5,5"}},{"type":"Image","props":{"skin":"mjIndex/hall_6.png"}},{"type":"Image","props":{"y":-8,"x":132,"var":"imgAddcard","skin":"mjIndex/hall_10.png"}}]},{"type":"Image","props":{"y":667,"x":117,"width":1146,"skin":"mjIndex/hall_16.png","height":68,"sizeGrid":"8,85,17,85"}},{"type":"Label","props":{"y":28,"x":166,"width":160,"var":"txtNickname","text":"昵称","name":"item0","height":45,"fontSize":30,"font":"Microsoft YaHei","color":"#fff25d"}},{"type":"Label","props":{"y":75,"x":166,"width":44,"text":"ID:","name":"item0","height":36,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Image","props":{"y":239,"x":152,"skin":"mjIndex/hall_19.png"}},{"type":"Image","props":{"y":210,"x":430,"var":"imgJoinRoom","skin":"mjIndex/join_room.png"}},{"type":"Image","props":{"y":210,"x":832,"var":"imgCreatRoom","skin":"mjIndex/creat_room.png"}},{"type":"List","props":{"y":596,"x":205,"width":967,"var":"BottomList","spaceX":50,"height":120},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjIndex/shop_ico.png","name":"imgBbtn"}}]}]},{"type":"Label","props":{"y":75,"x":210,"width":44,"var":"txtId","text":0,"name":"item0","height":36,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Image","props":{"y":43,"x":36,"width":110,"skin":"mjIndex/face_frame.png","name":"item1","height":110}},{"type":"Label","props":{"y":123,"x":227,"width":70,"var":"txtCard","text":0,"name":"item1","height":36,"fontSize":25,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Label","props":{"y":124,"x":467,"width":478,"var":"txtNotic","text":"label","height":32,"fontSize":23,"font":"Microsoft YaHei","color":"#ffffff"}}]};
//		return MJIndexUI;
//	})(View);
var MJIndexUI=(function(_super){
		function MJIndexUI(){
			
		    this.imgPlayFun=null;
		    this.imgMsg=null;
		    this.imgSetting=null;
		    this.imgHeadpath=null;
		    this.imgTexBg=null;
		    this.imgAddcard=null;
		    this.txtNickname=null;
		    this.imgJoinRoom=null;
		    this.imgCreatRoom=null;
		    this.BottomList=null;
		    this.txtId=null;
		    this.txtCard=null;
		    this.txtNotic=null;
		    this.boxPicPlayBjg=null;
		    this.boxPicPlay=null;
		    this.listPic=null;
		    this.imgXx=null;

			MJIndexUI.__super.call(this);
		}

		CLASS$(MJIndexUI,'ui.MJIndexUI',_super);
		var __proto__=MJIndexUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJIndexUI.uiView);
		}
		MJIndexUI.uiView={"type":"View","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1366,"skin":MjImg+"bg/index_bg.png","height":768}},{"type":"Image","props":{"y":21,"x":601,"skin":"mjIndex/indx_logo.png"}},{"type":"Image","props":{"y":42,"x":1030,"var":"imgPlayFun","skin":"mjIndex/main_helpBtn.png"}},{"type":"Image","props":{"y":42,"x":1128,"var":"imgMsg","skin":"mjIndex/main_msgBtn.png"}},{"type":"Image","props":{"y":42,"x":1225,"var":"imgSetting","skin":"mjIndex/main_setBtn.png"}},{"type":"Image","props":{"y":45,"x":39,"width":105,"var":"imgHeadpath","skin":"mjIndex/face_frame.png","height":105}},{"type":"Image","props":{"y":120,"x":431,"width":536,"var":"imgTexBg","skin":"mjIndex/loadingboard.png","height":38,"sizeGrid":"7,15,7,15"}},{"type":"Image","props":{"y":112,"x":411,"width":49,"skin":"mjIndex/hall_18.png","height":52}},{"type":"Box","props":{"y":122,"x":159},"child":[{"type":"Image","props":{"y":0,"x":57,"width":97,"skin":"mjIndex/hall_7.png","height":35,"sizeGrid":"5,5,5,5"}},{"type":"Image","props":{"skin":"mjIndex/hall_6.png"}},{"type":"Image","props":{"y":-8,"x":132,"var":"imgAddcard","skin":"mjIndex/hall_10.png"}}]},{"type":"Image","props":{"y":667,"x":117,"width":1146,"skin":"mjIndex/hall_16.png","height":68,"sizeGrid":"8,85,17,85"}},{"type":"Label","props":{"y":28,"x":166,"width":160,"var":"txtNickname","text":"昵称","name":"item0","height":45,"fontSize":30,"font":"Microsoft YaHei","color":"#fff25d"}},{"type":"Label","props":{"y":75,"x":166,"width":44,"text":"ID:","name":"item0","height":36,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Image","props":{"y":210,"x":430,"var":"imgJoinRoom","skin":"mjIndex/join_room.png","zOrder":"100"}},{"type":"Image","props":{"y":210,"x":832,"var":"imgCreatRoom","skin":"mjIndex/creat_room.png"}},{"type":"List","props":{"y":596,"x":205,"width":967,"var":"BottomList","spaceX":50,"height":120},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjIndex/shop_ico.png","name":"imgBbtn"}}]}]},{"type":"Label","props":{"y":75,"x":210,"width":44,"var":"txtId","text":0,"name":"item0","height":36,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Image","props":{"y":43,"x":36,"width":110,"skin":"mjIndex/face_frame.png","name":"item1","height":110}},{"type":"Label","props":{"y":123,"x":227,"width":70,"var":"txtCard","text":0,"name":"item1","height":36,"fontSize":25,"font":"Microsoft YaHei","color":"#ffffff"}},{"type":"Box","props":{"y":123,"x":459},"child":[{"type":"Box","props":{"width":480,"height":32},"child":[{"type":"Label","props":{"y":0,"x":480,"var":"txtNotic","text":"","height":32,"fontSize":23,"font":"Microsoft YaHei","color":"#ffffff"}}]},{"type":"Image","props":{"y":-2,"x":-3,"width":482,"skin":"mjIndex/hh.jpg","renderType":"mask","pivotY":-1,"pivotX":-11,"height":35}}]},{"type":"Image","props":{"y":234,"x":149,"skin":"mjIndex/hall_bb.png"}},{"type":"Box","props":{"y":238,"x":152,"var":"boxPicPlayBjg"},"child":[{"type":"Box","props":{"y":1,"x":0,"var":"boxPicPlay"},"child":[{"type":"List","props":{"y":0,"x":0,"width":468,"var":"listPic"},"child":[{"type":"Box","props":{"y":0,"x":0,"name":"render"},"child":[{"type":"Image","props":{"width":234,"name":"imgPic","height":321}}]}]}]},{"type":"Image","props":{"y":0,"x":0,"skin":"mjIndex/hall_zz.png","renderType":"mask"}}]},{"type":"Image","props":{"y":567,"x":235,"var":"imgXx","skin":"mjIndex/hall_xx.png"}}]};
		return MJIndexUI;
	})(View);
var MJIpShowUI=(function(_super){
		function MJIpShowUI(){
			

			MJIpShowUI.__super.call(this);
		}

		CLASS$(MJIpShowUI,'ui.MJIpShowUI',_super);
		var __proto__=MJIpShowUI.prototype;

		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJIpShowUI.uiView);
		}
		MJIpShowUI.uiView={"type":"Dialog","props":{"width":920,"height":600},"child":[{"type":"Image","props":{"y":50,"x":9,"skin":"public/littleDbg.png"}},{"type":"Image","props":{"y":15,"x":835,"skin":"public/close.png"}},{"type":"Label","props":{"y":78,"x":318,"width":257,"text":" IP距离显示","strokeColor":"#4f0100","stroke":5,"height":56,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":151,"x":55,"width":783,"skin":"mjipshow/listbg.png","name":"item0","height":130,"sizeGrid":"-47,10,-63,9"}},{"type":"Image","props":{"y":285,"x":55,"width":783,"skin":"mjipshow/listbg.png","name":"item1","height":130,"sizeGrid":"-47,10,-63,9"}},{"type":"Image","props":{"y":420,"x":55,"width":783,"skin":"mjipshow/listbg.png","name":"item2","height":130,"sizeGrid":"-47,10,-63,9"}},{"type":"Image","props":{"y":195,"x":654,"skin":"mjipshow/location.png","name":"item0"}},{"type":"Image","props":{"y":331,"x":654,"skin":"mjipshow/location.png","name":"item1"}},{"type":"Image","props":{"y":465,"x":654,"skin":"mjipshow/location.png","name":"item2"}},{"type":"Label","props":{"y":201,"x":544,"width":86,"text":"IP相同","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#ff0400"}},{"type":"Label","props":{"y":203,"x":711,"width":86,"text":"相距0米","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#047800"}},{"type":"Label","props":{"y":184,"x":363,"width":145,"text":"192.168.1.1","name":"item0","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":219,"x":363,"width":145,"text":"192.168.1.1","name":"item1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":184,"x":148,"width":145,"text":"昵称1","name":"item0","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":219,"x":148,"width":145,"text":"昵称2","name":"item1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}}]};
		return MJIpShowUI;
	})(Dialog);
var MJLoadUI=(function(_super){
		function MJLoadUI(){
			
		    this.butWchat=null;
		    this.progressNum=null;
		    this.txtPreNum=null;

			MJLoadUI.__super.call(this);
		}

		CLASS$(MJLoadUI,'ui.MJLoadUI',_super);
		var __proto__=MJLoadUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJLoadUI.uiView);
		}
		MJLoadUI.uiView={"type":"View","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1366,"skin":MjImg+"mjload/loadbg.jpg","height":768}},{"type":"Image","props":{"y":160,"x":341,"width":684,"skin":MjImg+"public/mjlogo.png","height":238}},{"type":"Image","props":{"y":511,"x":515,"var":"butWchat","skin":"mjload/wchatbtn.png"}},{"type":"Image","props":{"y":401,"x":545,"skin":"mjload/enname.png"}},{"type":"ProgressBar","props":{"y":528,"x":310,"width":759,"var":"progressNum","value":0,"skin":MjImg+"mjload/progress.png","pivotY":2,"pivotX":-5,"name":"progressNum","height":80,"sizeGrid":"0,40,0,40"}},{"type":"Label","props":{"y":490,"x":667,"width":46,"var":"txtPreNum","text":"0%","height":25,"fontSize":20,"font":"Microsoft YaHei","color":"#000000","alpha":100}}]};
		return MJLoadUI;
	})(View);
var MJRinkUI=(function(_super){
		function MJRinkUI(){
			
		    this.listRink=null;
		    this.txtShowUser=null;
		    this.boxLast=null;
		    this.boxThis=null;
		    this.butClose=null;

			MJRinkUI.__super.call(this);
		}

		CLASS$(MJRinkUI,'ui.MJRinkUI',_super);
		var __proto__=MJRinkUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRinkUI.uiView);
		}
		MJRinkUI.uiView={"type":"Dialog","props":{"width":550,"height":600},"child":[{"type":"Image","props":{"y":104,"x":33,"width":484,"skin":"mjrink/greybg.png","height":487,"sizeGrid":"7,9,7,8"}},{"type":"Image","props":{"y":1,"x":60,"skin":"mjrink/title.png"}},{"type":"List","props":{"y":190,"x":57,"width":460,"var":"listRink","vScrollBarSkin":"public/vscroll.png","spaceY":5,"height":317},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"width":438,"skin":"mjrink/jbbg.png","name":"item0","height":81,"sizeGrid":"9,10,17,9"}},{"type":"Image","props":{"y":11,"x":100,"width":58,"skin":"mjrink/face3.png","name":"imgHeadpath","height":58}},{"type":"Image","props":{"y":15,"x":18,"skin":"mjrink/win1.png","name":"imgNum"}},{"type":"Label","props":{"y":29,"x":180,"width":123,"text":"昵称","name":"txtNickname","height":27,"fontSize":20,"font":"Microsoft YaHei"}},{"type":"Label","props":{"y":30,"x":323,"width":109,"text":"共600局","name":"txtJs","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#442300"}},{"type":"Label","props":{"y":22,"x":22,"width":52,"text":1,"strokeColor":"#3e0100","stroke":4,"name":"txtNum","italic":true,"height":49,"fontSize":40,"font":"Helvetica","color":"#fff400","bold":true,"align":"center"}}]}]},{"type":"Label","props":{"y":153,"x":186,"width":179,"var":"txtShowUser","height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Box","props":{"y":510,"x":295,"var":"boxLast","gray":true},"child":[{"type":"Image","props":{"skin":"mjrink/thisweek.png","name":"item1"}},{"type":"Label","props":{"y":24,"x":41,"width":127,"text":"上周排行","height":39,"fontSize":30,"font":"Microsoft YaHei","color":"#4f0100","bold":true}}]},{"type":"Box","props":{"y":510,"x":58,"var":"boxThis","gray":false},"child":[{"type":"Image","props":{"skin":"mjrink/thisweek.png","name":"item1"}},{"type":"Label","props":{"y":24,"x":41,"width":127,"text":"本周排行","height":39,"fontSize":30,"font":"Microsoft YaHei","color":"#4f0100","bold":true}}]},{"type":"Image","props":{"y":63,"x":462,"var":"butClose","skin":"public/close.png"}}]};
		return MJRinkUI;
	})(Dialog);
var MJRoomSetUI=(function(_super){
		function MJRoomSetUI(){
			
		    this.close=null;

			MJRoomSetUI.__super.call(this);
		}

		CLASS$(MJRoomSetUI,'ui.MJRoomSetUI',_super);
		var __proto__=MJRoomSetUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRoomSetUI.uiView);
		}
		MJRoomSetUI.uiView={"type":"Dialog","props":{"width":920,"height":585},"child":[{"type":"Image","props":{"y":38,"x":7,"skin":"public/littleDbg.png"}},{"type":"Image","props":{"y":1,"x":832,"var":"close","skin":"public/close.png"}},{"type":"Label","props":{"y":200,"x":146,"width":94,"text":"音乐","name":"item0","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":200,"x":387,"width":94,"text":"音效","name":"item1","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":66,"x":332,"width":217,"text":"设置","strokeColor":"#3e0005","stroke":4,"height":51,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":194,"x":486,"skin":"mjroomset/musicon.png"}},{"type":"Image","props":{"y":193,"x":243,"skin":"mjroomset/soundon.png"}},{"type":"Label","props":{"y":289,"x":146,"width":145,"text":"切换桌布","name":"item0","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"RadioGroup","props":{"y":291,"x":311,"width":420,"space":33,"skin":"public/radiogroup.png","selectedIndex":0,"labels":"清新绿,深海蓝,舒适黄","labelStroke":0,"labelSize":30,"labelFont":"Microsoft YaHei","labelColors":"#993105","labelBold":true,"height":39}}]};
		return MJRoomSetUI;
	})(Dialog);
var MJSettingUI=(function(_super){
		function MJSettingUI(){
			
		    this.butClose=null;
		    this.imgSonoff=null;
		    this.imgMonoff=null;
		    this.imgLoginOut=null;

			MJSettingUI.__super.call(this);
		}

		CLASS$(MJSettingUI,'ui.MJSettingUI',_super);
		var __proto__=MJSettingUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJSettingUI.uiView);
		}
		MJSettingUI.uiView={"type":"Dialog","props":{"width":920,"height":585},"child":[{"type":"Image","props":{"y":38,"x":7,"skin":MjImg+"bg/littleDbg.png"}},{"type":"Image","props":{"y":1,"x":832,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":200,"x":146,"width":94,"text":"音乐","name":"item0","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":200,"x":387,"width":94,"text":"音效","name":"item1","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#993105","bold":true}},{"type":"Label","props":{"y":66,"x":332,"width":217,"text":"设置","strokeColor":"#3e0005","stroke":4,"height":51,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":194,"x":486,"var":"imgSonoff","skin":"mjroomset/musicon.png"}},{"type":"Image","props":{"y":193,"x":243,"var":"imgMonoff","skin":"mjroomset/soundon.png"}},{"type":"Image","props":{"y":423,"x":291,"var":"imgLoginOut","skin":"mjroomset/loginout.png"}}]};
		return MJSettingUI;
	})(Dialog);
/*var MJTotleRecordUI=(function(_super){
		function MJTotleRecordUI(){
			
		    this.close=null;

			MJTotleRecordUI.__super.call(this);
		}

		CLASS$(MJTotleRecordUI,'ui.MJTotleRecordUI',_super);
		var __proto__=MJTotleRecordUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJTotleRecordUI.uiView);
		}
		MJTotleRecordUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":60,"x":79,"skin":MjImg+"bg/bigDbg.png"}},{"type":"Image","props":{"y":21,"x":1231,"var":"close","skin":"public/close.png"}},{"type":"List","props":{"y":181,"x":143,"width":1087,"spaceX":4,"height":421},"child":[{"type":"Box","props":{"y":-1,"x":0,"name":"render"},"child":[{"type":"Image","props":{"skin":"mjtotlerecord/greybg.png"}},{"type":"Image","props":{"y":68,"x":159,"skin":"mjtotlerecord/all_result_2.png"}},{"type":"Image","props":{"y":-17,"x":-9,"skin":"mjtotlerecord/bestwinner.png"}},{"type":"Label","props":{"y":6,"x":90,"text":"昵称","fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":157,"x":171,"width":63,"text":"0","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":201,"x":171,"width":63,"text":"0","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":200,"x":37,"width":105,"text":"胡牌次数","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":156,"x":37,"width":105,"text":"连胜记录","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":33,"x":91,"text":"ID:","fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":366,"x":53,"width":84,"text":"总积分","strokeColor":"7c2700","stroke":4,"height":42,"fontSize":25,"font":"Microsoft YaHei","color":"#ffb700","bold":true}},{"type":"Label","props":{"y":369,"x":150,"width":71,"text":"-5","height":32,"fontSize":25,"color":"#7c2700"}}]}]},{"type":"Image","props":{"y":612,"x":579,"skin":"mjtotlerecord/border_yellow_m.png"}},{"type":"Image","props":{"y":88,"x":573,"skin":"mjtotlerecord/title.png"}}]};
		return MJTotleRecordUI;
	})(Dialog);*/
var MJGameShowUI=(function(_super){
		function MJGameShowUI(){
			
		    this.butClose=null;
		    this.txtTitle=null;
		    this.htmlConmtent=null;

			MJGameShowUI.__super.call(this);
		}

		CLASS$(MJGameShowUI,'ui.MJGameShowUI',_super);
		var __proto__=MJGameShowUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("HTMLDivElement",laya.html.dom.HTMLDivElement);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJGameShowUI.uiView);
		}
		MJGameShowUI.uiView={"type":"Dialog","props":{"width":930,"height":600},"child":[{"type":"Image","props":{"y":44,"x":8,"skin":MjImg+"bg/littleDbg.png"}},{"type":"Image","props":{"y":5,"x":843,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":72,"x":311,"width":257,"var":"txtTitle","text":"标题","strokeColor":"#4f0100","stroke":5,"height":56,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Panel","props":{"y":165,"x":55,"width":786,"var":"panelHtml","vScrollBarSkin":"public/vscroll.png","height":372},"child":[{"type":"HTMLDivElement","props":{"width":781,"var":"htmlConmtent","vScrollBarSkin":"","overflow":"scroll","height":364}}]}]};

		return MJGameShowUI;
	})(Dialog);
var MJRequestUI=(function(_super){
		function MJRequestUI(){
			
		    this.butClose=null;
		    this.listKeyboard=null;
		    this.inpID=null;
		    this.butSubmit=null;

			MJRequestUI.__super.call(this);
		}

		CLASS$(MJRequestUI,'ui.MJRequestUI',_super);
		var __proto__=MJRequestUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJRequestUI.uiView);
		}
		MJRequestUI.uiView={"type":"Dialog","props":{"width":920,"height":600},"child":[{"type":"Image","props":{"y":18,"x":3,"skin":MjImg+"bg/littleDbg.png"}},{"type":"Label","props":{"y":48,"x":331,"width":217,"text":"输入邀请ID","strokeColor":"#5d2100","stroke":4,"height":51,"fontSize":35,"font":"Microsoft YaHei","color":"#fff478","align":"center"}},{"type":"Image","props":{"y":-4,"x":821,"var":"butClose","skin":"public/close.png"}},{"type":"List","props":{"y":247,"x":161,"width":559,"var":"listKeyboard","height":279},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjjoinroom/num1.png","name":"num"}}]}]},{"type":"Image","props":{"y":159,"x":163,"width":356,"skin":"public/input.png","prompt":" 请输入邀请ID","height":60,"fontSize":25,"sizeGrid":"8,5,8,4"}},{"type":"Image","props":{"y":157,"x":536,"var":"butSubmit","skin":"public/submit.png"}},{"type":"Label","props":{"y":167,"x":172,"width":335,"var":"inpID","overflow":"hidden","height":48,"fontSize":40}}]};

		return MJRequestUI;
	})(Dialog);
var MJShopUI=(function(_super){
		function MJShopUI(){
			
		    this.butClose=null;

			MJShopUI.__super.call(this);
		}

		CLASS$(MJShopUI,'ui.MJShopUI',_super);
		var __proto__=MJShopUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJShopUI.uiView);
		}
		MJShopUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1366,"skin":MjImg+"bg/shop.jpg","height":768}},{"type":"Image","props":{"y":122,"x":1128,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":239,"x":441,"wordWrap":true,"width":627,"text":"暂未开放，敬请期待...\\n购买房卡，请联系群主\\n代理加盟，请联系微信客服号：tlmjkf001","leading":30,"height":364,"fontSize":30,"font":"Microsoft YaHei","color":"#a41703","bold":true}}]};
		return MJShopUI;
	})(Dialog);
var MJShareUI=(function(_super){
		function MJShareUI(){
			
		    this.butClose=null;
		    this.imgFriends=null;
		    this.imgWx=null;

			MJShareUI.__super.call(this);
		}

		CLASS$(MJShareUI,'ui.MJShareUI',_super);
		var __proto__=MJShareUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJShareUI.uiView);
		}
		MJShareUI.uiView={"type":"Dialog","props":{"width":500,"height":300},"child":[{"type":"Image","props":{"y":4,"x":3,"width":495,"skin":"mjrink/jbbg.png","height":297,"sizeGrid":"9,10,17,9"}},{"type":"Image","props":{"y":-30,"x":440,"var":"butClose","skin":"public/close.png"}},{"type":"Image","props":{"y":87,"x":283,"var":"imgFriends","skin":"mjshare/weixin_share_friends_icon.png"}},{"type":"Image","props":{"y":87,"x":94,"var":"imgWx","skin":"mjshare/weixin_share_icon.png"}},{"type":"Text","props":{"y":230,"x":80,"width":165,"text":"分享给微信好友","name":"item0","height":35,"fontSize":20,"font":"Microsoft YaHei","color":"#b74109","align":"center"}},{"type":"Text","props":{"y":230,"x":286,"width":133,"text":"分享到朋友圈","name":"item1","height":35,"fontSize":20,"font":"Microsoft YaHei","color":"#b74109","align":"center"}},{"type":"Text","props":{"y":12,"x":207,"width":93,"text":"分 享","height":50,"fontSize":40,"font":"Microsoft YaHei","color":"#b74109","bold":true}}]};
		return MJShareUI;
	})(Dialog);	
var MJUserInfoUI=(function(_super){
		function MJUserInfoUI(){
			
		    this.butClose=null;
		    this.headpath=null;
		    this.nickname=null;
		    this.ip=null;
		    this.id=null;

			MJUserInfoUI.__super.call(this);
		}

		CLASS$(MJUserInfoUI,'ui.MJUserInfoUI',_super);
		var __proto__=MJUserInfoUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJUserInfoUI.uiView);
		}
		MJUserInfoUI.uiView={"type":"Dialog","props":{"width":500,"height":300},"child":[{"type":"Image","props":{"y":33,"x":3,"width":467,"skin":"mjrink/jbbg.png","height":268,"sizeGrid":"9,10,17,9"}},{"type":"Image","props":{"y":1,"x":416,"var":"butClose","skin":"public/close.png"}},{"type":"Image","props":{"y":111,"x":55,"width":105,"var":"headpath","skin":"mjIndex/face_frame.png","name":"item0","height":105}},{"type":"Text","props":{"y":63,"x":198,"width":212,"var":"nickname","text":"nickname","name":"item0","height":65,"fontSize":45,"font":"Microsoft YaHei","color":"#9e3e00"}},{"type":"Image","props":{"y":108,"x":52,"skin":"mjIndex/face_frame.png","name":"item0"}},{"type":"Text","props":{"y":138,"x":198,"width":212,"var":"ip","text":"IP：","name":"item1","height":65,"fontSize":30,"font":"Microsoft YaHei","color":"#9e3e00"}},{"type":"Text","props":{"y":194,"x":198,"width":212,"var":"id","text":"ID：","name":"item2","height":65,"fontSize":30,"font":"Microsoft YaHei","color":"#9e3e00"}}]};
		return MJUserInfoUI;
	})(Dialog);
var MJChatbubbleUI=(function(_super){
		function MJChatbubbleUI(){
			
		    this.imgBg=null;
		    this.txtInfo=null;

			MJChatbubbleUI.__super.call(this);
		}

		CLASS$(MJChatbubbleUI,'ui.MJChatbubbleUI',_super);
		var __proto__=MJChatbubbleUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJChatbubbleUI.uiView);
		}
		MJChatbubbleUI.uiView={"type":"View","props":{"width":350,"height":60},"child":[{"type":"Image","props":{"y":1,"x":4,"width":348,"var":"imgBg","skin":"mjchat/bubble_1.png","height":58,"sizeGrid":"10,22,26,44"}},{"type":"Label","props":{"y":9,"x":15,"wordWrap":true,"width":316,"var":"txtInfo","text":"这是聊天记录","leading":5,"height":29,"fontSize":20,"font":"Microsoft YaHei","color":"#000000"}}]};
		return MJChatbubbleUI;
	})(View);
var MJChatUI=(function(_super){
		function MJChatUI(){
			
		    this.imgChat=null;
		    this.imgFace=null;
		    this.boxSubmit=null;
		    this.butSubmit=null;
		    this.inputMsg=null;
		    this.listPreinstall=null;
		    this.listFacelist=null;
		    this.butClose=null;

			MJChatUI.__super.call(this);
		}

		CLASS$(MJChatUI,'ui.MJChatUI',_super);
		var __proto__=MJChatUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJChatUI.uiView);
		}
		MJChatUI.uiView={"type":"Dialog","props":{"width":570,"height":600},"child":[{"type":"Image","props":{"y":43,"x":5,"width":520,"skin":"mjchat/chat_bj.png","height":550,"sizeGrid":"22,22,22,22"}},{"type":"Image","props":{"y":64,"x":27,"width":241,"var":"imgChat","skin":"mjchat/chat_s.png","height":61}},{"type":"Image","props":{"y":64,"x":268,"width":241,"var":"imgFace","skin":"mjchat/chat_exp_n.png","height":61}},{"type":"Box","props":{"y":528,"x":9,"width":441,"var":"boxSubmit","height":74},"child":[{"type":"Image","props":{"y":-63,"x":347,"var":"butSubmit","skin":"mjchat/chat_sentout_btn.png"}},{"type":"TextInput","props":{"y":-62,"x":19,"width":332,"var":"inputMsg","valign":"middle","type":"text","skin":"mjchat/textinput.png","promptColor":"#7d7d7d","prompt":"请输入聊天内容","padding":"0,0,0,40","height":109,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","align":"left","sizeGrid":"13,0,11,53"}}]},{"type":"List","props":{"y":139,"x":28,"width":466,"var":"listPreinstall","vScrollBarSkin":"public/vscroll.png","spaceY":10,"height":331},"child":[{"type":"Box","props":{"y":0,"x":0,"width":431,"name":"render","height":85},"child":[{"type":"Image","props":{"y":74,"x":0,"width":450,"skin":MjImg+"bg/chat_cor.png","height":4}},{"type":"Label","props":{"y":13,"x":15,"wordWrap":true,"width":388,"text":"","name":"txtChatlist","height":43,"fontSize":25,"font":"Microsoft YaHei","color":"#ffffff"}}]}]},{"type":"List","props":{"y":151,"x":33,"width":469,"var":"listFacelist","vScrollBarSkin":"public/vscroll.png","spaceY":40,"spaceX":40,"height":404},"child":[{"type":"Box","props":{"y":0,"x":0,"width":108,"name":"render","height":108},"child":[{"type":"Image","props":{"y":0,"x":0,"width":108,"skin":"mjface/emoji_12.png","name":"imgFace","height":108}}]}]},{"type":"Image","props":{"y":13,"x":502,"var":"butClose","skin":"mjchat/btn_green_close.png"}}]};
		return MJChatUI;
	})(Dialog);