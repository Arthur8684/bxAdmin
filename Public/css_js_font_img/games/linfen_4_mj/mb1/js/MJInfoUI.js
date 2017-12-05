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
		MJCurrentGainsUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":68,"x":90,"var":"imgBigBg","skin":GC.MjImg+"bg/bigDbg.png"}},{"type":"Image","props":{"y":33,"x":1244,"var":"butClose","skin":"public/close.png"}},{"type":"Image","props":{"y":87,"x":621,"var":"imgStatus","skin":"mjgains/single_title2.png"}},{"type":"Image","props":{"y":611,"x":709,"var":"imgShare","skin":"mjcurrentgains/btn_border_green_m.png"}},{"type":"Image","props":{"y":613,"x":475,"var":"butContinue","skin":"mjcurrentgains/btn_border_yellow_m.png"}},{"type":"List","props":{"y":172,"x":143,"width":1102,"var":"listGrade","height":432},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1102,"skin":"mjcurrentgains/bg_green_select_frame.png","name":"imgListBg","height":106,"sizeGrid":"16,14,18,14"}},{"type":"Image","props":{"y":9,"x":35,"width":85,"skin":"public/face_frame.png","name":"imgHeadpath","height":85}},{"type":"Sprite","props":{"y":28,"x":167,"width":546,"name":"spriteCardsList","height":56}},{"type":"Label","props":{"y":34,"x":941,"width":80,"text":"0分","name":"txtRecord","height":50,"fontSize":28,"font":"Microsoft YaHei","color":"#000000"}},{"type":"Image","props":{"y":24,"x":813,"skin":"mjcurrentgains/tile_face_lie_white.png","name":"imgMjwite"}},{"type":"Image","props":{"y":2,"x":12,"skin":"mjcurrentgains/zhuang.png","name":"imgZhuang"}},{"type":"Image","props":{"y":24,"x":813,"name":"imgCards"}}]}]}]};
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
		MJDissolveUI.uiView={"type":"Dialog","props":{"width":910,"height":600},"child":[{"type":"Image","props":{"y":46,"x":2,"skin":"public/littleDbg.png"}},{"type":"Image","props":{"y":6,"x":830,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":77,"x":329,"width":217,"text":"申请解散房间","strokeColor":"#3e0005","stroke":4,"height":47,"fontSize":32,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":468,"x":237,"var":"imgAgree","skin":"mjdissolve/btnDissolve.png"}},{"type":"Image","props":{"y":471,"x":474,"var":"imgRefuse","skin":"mjdissolve/btnnoDissolve.png"}},{"type":"Image","props":{"y":405,"x":306,"var":"txtShowText","skin":"mjdissolve/showtext01.png"}},{"type":"Label","props":{"y":397,"x":369,"width":90,"var":"txtReciprocal","text":"120","height":55,"fontSize":45,"color":"#ff0300","bold":true,"align":"center"}},{"type":"Label","props":{"y":162,"x":106,"wordWrap":true,"width":669,"var":"txtOperation","text":"玩家【崔大湿】申请解散房间，请问是否同意？（超过3分钟 未做选择，则默认同意）","leading":15,"height":66,"fontSize":20,"font":"Microsoft YaHei","color":"#442600"}}]};
		return MJDissolveUI;
	})(Dialog);
var MJTotleRecordUI=(function(_super){
		function MJTotleRecordUI(){
			
		    this.butClose=null;
		    this.imgShare=null;

			MJTotleRecordUI.__super.call(this);
		}

		CLASS$(MJTotleRecordUI,'ui.MJTotleRecordUI',_super);
		var __proto__=MJTotleRecordUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJTotleRecordUI.uiView);
		}
		MJTotleRecordUI.uiView={"type":"Dialog","props":{"width":1366,"height":768},"child":[{"type":"Image","props":{"y":60,"x":79,"skin":"public/bigDbg.png"}},{"type":"Image","props":{"y":21,"x":1231,"var":"butClose","skin":"public/close.png"}},{"type":"List","props":{"y":181,"x":143,"width":1087,"spaceX":4,"height":421},"child":[{"type":"Box","props":{"y":-1,"x":0,"name":"render"},"child":[{"type":"Image","props":{"skin":"mjtotlerecord/greybg.png"}},{"type":"Image","props":{"y":68,"x":159,"skin":"mjtotlerecord/all_result_2.png","name":"imgMaster"}},{"type":"Image","props":{"y":-17,"x":-9,"skin":"mjtotlerecord/bestwinner.png"}},{"type":"Label","props":{"y":6,"x":90,"width":136,"text":"昵称","name":"txtNickname","height":33,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":157,"x":171,"width":63,"text":"0","name":"txtSnum","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":201,"x":171,"width":63,"text":"0","name":"txtHnum","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":200,"x":37,"width":105,"text":"胡牌次数","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":156,"x":37,"width":105,"text":"连胜记录","height":34,"fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":33,"x":91,"text":"ID:","name":"txtId","fontSize":25,"font":"Microsoft YaHei","color":"#7c2700"}},{"type":"Label","props":{"y":366,"x":53,"width":84,"text":"总积分","strokeColor":"7c2700","stroke":4,"height":42,"fontSize":25,"font":"Microsoft YaHei","color":"#ffb700","bold":true}},{"type":"Label","props":{"y":369,"x":150,"width":71,"text":"-5","name":"txtTotlenum","height":32,"fontSize":25,"color":"#7c2700"}}]}]},{"type":"Image","props":{"y":612,"x":579,"var":"imgShare","skin":"mjtotlerecord/border_yellow_m.png"}},{"type":"Image","props":{"y":88,"x":573,"skin":"mjtotlerecord/title.png"}}]};
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
		MJIpShowUI.uiView={"type":"Dialog","props":{"width":920,"height":600},"child":[{"type":"Image","props":{"y":50,"x":9,"skin":"public/littleDbg.png"}},{"type":"Image","props":{"y":15,"x":835,"var":"butClose","skin":"public/close.png"}},{"type":"Label","props":{"y":78,"x":318,"width":257,"text":" IP距离显示","strokeColor":"#4f0100","stroke":5,"height":56,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"List","props":{"y":151,"x":55,"width":783,"var":"listDistanceList","height":393},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"width":783,"skin":"mjipshow/listbg.png","name":"item0","height":130,"sizeGrid":"-47,10,-63,9"}},{"type":"Image","props":{"y":44,"x":599,"skin":"mjipshow/location.png","name":"item0"}},{"type":"Label","props":{"y":50,"x":489,"width":86,"text":"IP相同","name":"txtShowIp","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#ff0400"}},{"type":"Label","props":{"y":52,"x":656,"width":86,"text":"相距0米","name":"txtdistanceBetween","height":32,"fontSize":20,"font":"Microsoft YaHei","color":"#047800"}},{"type":"Label","props":{"y":33,"x":308,"width":145,"text":"192.168.1.1","name":"txtIP1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":68,"x":308,"width":145,"text":"192.168.1.1","name":"txtIP2","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":33,"x":93,"width":145,"text":"昵称1","name":"txtNickname1","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}},{"type":"Label","props":{"y":68,"x":93,"width":145,"text":"昵称2","name":"txtNickname2","height":27,"fontSize":20,"font":"Microsoft YaHei","color":"#5a2000"}}]}]}]};
		return MJIpShowUI;
	})(Dialog);
var MJChatUI=(function(_super){
		function MJChatUI(){
			
		    this.imgChat=null;
		    this.imgFace=null;
		    this.boxSubmit=null;
		    this.butSubmit=null;
		    this.inputMsg=null;
		    this.listPreinstall=null;
		    this.listFacelist=null;

			MJChatUI.__super.call(this);
		}

		CLASS$(MJChatUI,'ui.MJChatUI',_super);
		var __proto__=MJChatUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(MJChatUI.uiView);
		}
		MJChatUI.uiView={"type":"Dialog","props":{"width":520,"height":550},"child":[{"type":"Image","props":{"y":0,"x":0,"width":520,"skin":"mjchat/chat_bj.png","height":550,"sizeGrid":"22,22,22,22"}},{"type":"Image","props":{"y":21,"x":22,"width":241,"var":"imgChat","skin":"mjchat/chat_s.png","height":61}},{"type":"Image","props":{"y":21,"x":263,"width":241,"var":"imgFace","skin":"mjchat/chat_exp_n.png","height":61}},{"type":"Box","props":{"y":491,"x":4,"width":441,"var":"boxSubmit","height":68},"child":[{"type":"Image","props":{"y":-63,"x":347,"var":"butSubmit","skin":"mjchat/chat_sentout_btn.png"}},{"type":"TextInput","props":{"y":-62,"x":19,"width":332,"var":"inputMsg","valign":"middle","type":"text","skin":"mjchat/textinput.png","promptColor":"#7d7d7d","prompt":"请输入聊天内容","padding":"0,0,0,40","height":109,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"left","sizeGrid":"13,0,11,53"}}]},{"type":"List","props":{"y":96,"x":23,"width":481,"var":"listPreinstall","vScrollBarSkin":"cc","spaceY":10,"height":331},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"y":68,"skin":"mjchat/chat_cor.png"}},{"type":"Label","props":{"x":29,"width":699,"text":"你的牌打的太好了！","name":"txtChatlist","height":52,"fontSize":35,"font":"Microsoft YaHei","color":"#ffffff"}}]}]},{"type":"List","props":{"y":108,"x":28,"width":469,"var":"listFacelist","vScrollBarSkin":"comp/vscroll.png","spaceY":40,"spaceX":40,"height":404},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"skin":"mjface/emoji_12.png","name":"imgFace"}}]}]}]};
		return MJChatUI;
	})(Dialog);		