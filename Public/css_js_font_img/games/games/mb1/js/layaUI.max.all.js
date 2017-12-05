var CLASS$=Laya.class;
var STATICATTR$=Laya.static;
var View=laya.ui.View;
var Dialog=laya.ui.Dialog;
var GameRoomUI=(function(_super){
		function GameRoomUI(){
			
		    this.user3=null;
		    this.user2=null;
		    this.user1=null;
			this.cards=null;
			
			this.but_discard=null;
			this.but_prompt=null;
			this.but_not_discard=null;
			
			this.discard_sprite_1=null;
		    this.discard_sprite_0=null;
		    this.discard_sprite_2=null;
		    this.cardNumLeft=null;
		    this.cardNumRight=null;
			
		    this.but_ready=null;
		    this.user_prompt_1=null;
		    this.user_prompt_0=null;
		    this.user_prompt_2=null;			
			

			GameRoomUI.__super.call(this);
		}

		CLASS$(GameRoomUI,'ui.test.GameRoomUI',_super);
		var __proto__=GameRoomUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameRoomUI.uiView);
		}

		STATICATTR$(GameRoomUI,
		['uiView',function(){return this.uiView={"type":"View","props":{"width":1920,"height":1080},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":IMGPATH+"bg/bg.jpg"}},{"type":"Sprite","props":{"y":207,"x":43,"width":205,"var":"user3","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"my/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"my/head.png","name":"head"}},{"type":"Text","props":{"y":168,"x":-45,"width":272,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":209,"x":-47,"width":272,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":207,"x":1665,"width":205,"var":"user2","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"my/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"my/head.png","name":"head"}},{"type":"Text","props":{"y":175,"x":-59,"width":304,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":216,"x":-61,"width":307,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":695,"x":41,"width":205,"var":"user1","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"my/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"my/head.png","name":"head"}},{"type":"Text","props":{"y":172,"x":-58,"width":304,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":213,"x":-60,"width":307,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":744,"x":319,"width":1498,"var":"cards","height":205}},{"type":"Image","props":{"y":596,"x":490,"var":"but_discard","skin":"my/but_discard.png"}},{"type":"Image","props":{"y":596,"x":850,"var":"but_prompt","skin":"my/but_prompt.png"}},{"type":"Image","props":{"y":596,"x":1236,"var":"but_not_discard","skin":"my/but_not_discard.png"},"loadId":91},{"type":"Sprite","props":{"y":429,"x":382,"width":1151,"var":"discard_sprite_1","height":165}},{"type":"Sprite","props":{"y":220,"x":250,"width":670,"var":"discard_sprite_0","height":156}},{"type":"Sprite","props":{"y":214,"x":976,"width":670,"var":"discard_sprite_2","height":155}},{"type":"Sprite","props":{"y":110,"x":214,"width":373,"var":"cardNumLeft","height":81},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"my/tra_bg1.png"}},{"type":"Image","props":{"y":2,"x":89,"skin":"my/sheng.png"}},{"type":"Clip","props":{"y":0,"x":194,"skin":"my/clip_num_game.png","name":"num0","index":1,"clipX":10}},{"type":"Clip","props":{"y":0,"x":253,"skin":"my/clip_num_game.png","name":"num1","index":5,"clipX":10}}]},{"type":"Sprite","props":{"y":110,"x":1404,"width":315,"var":"cardNumRight","height":83},"child":[{"type":"Image","props":{"y":0,"x":-17,"skin":"my/tra_bg4.png"}},{"type":"Image","props":{"y":5,"x":80,"skin":"my/sheng.png"}},{"type":"Clip","props":{"y":0,"x":168,"skin":"my/clip_num_game.png","name":"num0","index":1,"clipX":10}},{"type":"Clip","props":{"y":0,"x":213,"skin":"my/clip_num_game.png","name":"num1","index":5,"clipX":10}}]},{"type":"Image","props":{"y":596,"x":849,"var":"but_ready","skin":"my/but_ready.png"}},{"type":"Image","props":{"y":741,"x":235,"var":"user_prompt_1","skin":"my/ready.png"}},{"type":"Image","props":{"y":253,"x":241,"var":"user_prompt_0","skin":"my/ready.png"}},{"type":"Image","props":{"y":252,"x":1525,"var":"user_prompt_2","skin":"my/ready.png"}}],"animations":[{"nodes":[{"target":91,"keyframes":{"var":[{"value":null,"tweenMethod":"linearNone","tween":false,"target":91,"key":"var","index":0},{"value":"but_prompt","tweenMethod":"linearNone","tween":false,"target":91,"key":"var","index":75}]}}],"name":"ani1","id":1,"frameRate":24,"action":0}]};}
		]);
		return GameRoomUI;
	})(View);

//游戏加载界面UI
var GameLoadUI=(function(_super){
		function GameLoadUI(){
			
		    this.progress_1=null;
            this.btn_sprite=null;
			GameLoadUI.__super.call(this);
		}

		CLASS$(GameLoadUI,'ui.GameLoadUI',_super);
		var __proto__=GameLoadUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameLoadUI.uiView);
		}
		GameLoadUI.uiView=
		{"type":"View","props":{"width":1920,"height":1080},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":IMGPATH+"bg/Select_bg.jpg"}},{"type":"ProgressBar","props":{"y":794,"x":582,"width":770,"var":"progress_1","value":0,"skin":"load/progress.png","name":"progress_1","height":30}},{"type":"Image","props":{"y":157,"x":574,"skin":IMGPATH+"bg/f_logo.png"}},{"type":"Sprite","props":{"y":758,"x":501,"width":941,"var":"btn_sprite","height":95},"child":[{"type":"Image","props":{"y":7,"x":636,"skin":"load/userreg.png","name":"userreg"}},{"type":"Image","props":{"y":9,"x":323,"skin":"load/userlogin.png","name":"userlogin"}},{"type":"Image","props":{"y":7,"x":5,"skin":"load/wchat.png","name":"wchat"}}]}]};
		return GameLoadUI;
	})(View);
	
//登陆界面UI
var GameLoginUI=(function(_super){
		function GameLoginUI(){
			
		    this.btClose=null;
		    this.username=null;
		    this.password=null;
		    this.okLogin=null;
		    this.show_user_info=null;
		    this.show_pass_info=null;

			GameLoginUI.__super.call(this);
		}

		CLASS$(GameLoginUI,'ui.GameLoginUI',_super);
		var __proto__=GameLoginUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameLoginUI.uiView);
		}
		GameLoginUI.uiView={"type":"Dialog","props":{},"child":[{"type":"Image","props":{"y":17,"x":-13,"width":1651,"skin":"public/popup_page.png","sizeGrid":"100,100,100,100","height":917}},{"type":"Image","props":{"y":1,"x":1502,"var":"btClose","skin":"public/close.png"}},{"type":"TextInput","props":{"y":276,"x":622,"width":674,"var":"username","valign":"middle","type":"text","skin":"login/textinput.png","maxChars":12,"height":100,"fontSize":45,"font":"Microsoft YaHei","color":"#646464","sizeGrid":"3,2,3,3"}},{"type":"TextInput","props":{"y":454,"x":622,"width":674,"var":"password","type":"password","skin":"login/textinput.png","height":100,"fontSize":45,"font":"Microsoft YaHei","color":"#343434","sizeGrid":"3,2,3,3"}},{"type":"Label","props":{"y":277,"x":256,"width":151,"text":"用  户  名","name":"item0","height":100,"fontSize":80,"font":"Microsoft YaHei","bold":true,"align":"right"}},{"type":"Label","props":{"y":445,"x":256,"width":151,"text":"密       码","name":"item1","height":100,"fontSize":80,"font":"Microsoft YaHei","bold":true,"align":"right"}},{"type":"Image","props":{"y":642,"x":572,"var":"okLogin","skin":"login/but_login.png"}},{"type":"Label","props":{"y":379,"x":622,"width":670,"var":"show_user_info","height":70,"fontSize":45,"font":"Microsoft YaHei"}},{"type":"Label","props":{"y":558,"x":622,"width":670,"var":"show_pass_info","height":70,"fontSize":45,"font":"Microsoft YaHei"}}]};
		return GameLoginUI;
	})(Dialog);
	
// 游戏首页界面
var GameIndexUI=(function(_super){
		function GameIndexUI(){
			
		    this.headpath=null;
		    this.nickname=null;
		    this.id=null;
		    this.money=null;
		    this.point=null;
		    this.gamelist=null;

			GameIndexUI.__super.call(this);
		}

		CLASS$(GameIndexUI,'ui.GameIndexUI',_super);
		var __proto__=GameIndexUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameIndexUI.uiView);
		}
		GameIndexUI.uiView={"type":"View","props":{"width":1920,"height":1080},"child":[{"type":"Image","props":{"y":0,"x":0,"width":1920,"skin":IMGPATH+"bg/Select_bg.jpg","height":1080}},{"type":"Image","props":{"y":0,"x":0,"skin":IMGPATH+"index/top_bg.png"}},{"type":"Image","props":{"y":2,"x":698,"skin":IMGPATH+"index/title_bg_zxyx.png"}},{"type":"Image","props":{"y":977,"x":0,"skin":IMGPATH+"index/footer_bg.png"}},{"type":"Image","props":{"y":195,"x":350,"skin":IMGPATH+"index/notice_bg.png"}},{"type":"Image","props":{"y":20,"x":402,"skin":"index/top_gold_bg.png","name":"item0"}},{"type":"Image","props":{"y":87,"x":402,"skin":"index/top_gold_bg.png","name":"item1"}},{"type":"Image","props":{"y":23,"x":816,"skin":"index/title.png"}},{"type":"Image","props":{"y":13,"x":20,"width":140,"var":"headpath","skin":"index/menu_pho.png","height":140}},{"type":"Label","props":{"y":34,"x":177,"width":201,"var":"nickname","text":"nickname","overflow":"hidden","height":50,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Label","props":{"y":100,"x":189,"width":183,"var":"id","text":"id","height":40,"fontSize":40,"font":"Microsoft YaHei","color":"#eaff00"}},{"type":"Image","props":{"y":7,"x":1665,"skin":"index/menu_pic_record.png"}},{"type":"Image","props":{"y":7,"x":1535,"skin":"index/menu_pic_setup.png"}},{"type":"Image","props":{"y":117,"x":1683,"skin":"index/menu_record.png"}},{"type":"Image","props":{"y":117,"x":1553,"skin":"index/menu_setup.png"}},{"type":"Image","props":{"y":897,"x":743,"skin":"index/bottom_help.png"}},{"type":"Image","props":{"y":920,"x":911,"skin":"index/bottom_help_title.png"}},{"type":"Image","props":{"y":897,"x":1313,"skin":"index/bottom_mall.png"}},{"type":"Image","props":{"y":920,"x":1489,"skin":"index/bottom_mall_title.png"}},{"type":"Image","props":{"y":920,"x":349,"skin":"index/bottom_setup-title.png"}},{"type":"Image","props":{"y":897,"x":179,"skin":"index/bottom_setup.png"}},{"type":"Image","props":{"y":94,"x":408,"width":50,"skin":"index/menu_bag.png","height":49}},{"type":"Image","props":{"y":28,"x":406,"width":56,"skin":"index/menu_gold.png","height":53}},{"type":"Label","props":{"y":207,"x":398,"width":1160,"text":"nickname","overflow":"hidden","height":50,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Label","props":{"y":37,"x":467,"width":133,"var":"money","text":"id","overflow":"hidden","name":"item0","height":40,"fontSize":30,"font":"Arial","color":"#ffffff"}},{"type":"Label","props":{"y":102,"x":466,"width":127,"var":"point","text":"id","overflow":"hidden","name":"item1","height":40,"fontSize":30,"font":"Arial","color":"#ffffff"}},{"type":"List","props":{"y":286,"x":173,"width":1591,"var":"gamelist","spaceY":0,"spaceX":140,"height":618},"child":[{"type":"Box","props":{"y":0,"x":-2,"name":"render"},"child":[{"type":"Image","props":{"skin":"index/img_1.png","name":"gamethumb"}},{"type":"Image","props":{"y":470,"x":48,"skin":"index/b_bg_1.png","name":"gm1"}},{"type":"Label","props":{"y":491,"x":81,"width":283,"text":"id","overflow":"hidden","name":"gamename","height":69,"fontSize":45,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}}]}]}]};
		return GameIndexUI;
	})(View);
	
	
var GameSelectUI=(function(_super){
		function GameSelectUI(){
			
		    this.BtClose=null;
		    this.roomid=null;
		    this.noroom=null;
		    this.match=null;
		    this.nomatch=null;

			GameSelectUI.__super.call(this);
		}

		CLASS$(GameSelectUI,'ui.GameSelectUI',_super);
		var __proto__=GameSelectUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameSelectUI.uiView);
		}
		GameSelectUI.uiView={"type":"Dialog","props":{"width":1628,"height":928},"child":[{"type":"Image","props":{"y":3,"x":-4,"width":1628,"skin":"public/popup_page.png","height":928,"sizeGrid":"70,70,70,70"}},{"type":"Image","props":{"y":-2,"x":1497,"var":"BtClose","skin":"public/close.png"}},{"type":"Box","props":{"y":200,"x":823,"var":"roomid"},"child":[{"type":"Image","props":{"y":78,"skin":IMGPATH+"select/select_bg.png","name":"item1"}},{"type":"Image","props":{"y":93,"x":45,"skin":"gameselect/pic_left_t.png"}},{"type":"Image","props":{"x":180,"skin":"gameselect/pic_right.png"}},{"type":"Image","props":{"y":392,"x":342,"skin":"gameselect/title_right.png"}},{"type":"Label","props":{"y":339,"x":74,"width":545,"visible":false,"var":"noroom","text":"敬请期待","strokeColor":"#a61100","stroke":20,"rotation":-16,"height":143,"fontSize":70,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}}]},{"type":"Box","props":{"y":191,"x":158,"var":"match"},"child":[{"type":"Image","props":{"y":86,"skin":IMGPATH+"select/select_bg.png"}},{"type":"Image","props":{"y":104,"x":288,"skin":"gameselect/pic_left_g.png"}},{"type":"Image","props":{"x":36,"skin":"gameselect/pic_left.png"}},{"type":"Image","props":{"y":400,"x":266,"skin":"gameselect/title_left.png"}},{"type":"Label","props":{"y":329,"x":64,"width":545,"visible":false,"var":"nomatch","text":"敬请期待","strokeColor":"#a61100","stroke":20,"rotation":-16,"height":194,"fontSize":70,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}}]}]};
		return GameSelectUI;
	})(Dialog);	

//进入游戏	
var GameJoinUI=(function(_super){
		function GameJoinUI(){
			
		    this.BtClose=null;
		    this.CreatRoom=null;
		    this.shownum=null;
		    this.num1=null;
		    this.num2=null;
		    this.num3=null;
		    this.num4=null;
		    this.num5=null;
		    this.num6=null;
		    this.num0=null;
		    this.num7=null;
		    this.num8=null;
		    this.num9=null;
		    this.back=null;
		    this.clearall=null;

			GameJoinUI.__super.call(this);
		}

		CLASS$(GameJoinUI,'ui.GameJoinUI',_super);
		var __proto__=GameJoinUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameJoinUI.uiView);
		}
		GameJoinUI.uiView={"type":"Dialog","props":{},"child":[{"type":"Image","props":{"y":19,"x":-13,"width":1651,"skin":"public/popup_page.png","sizeGrid":"100,100,100,100","height":917}},{"type":"Image","props":{"y":1,"x":1502,"var":"BtClose","skin":"public/close.png"}},{"type":"Image","props":{"y":0,"x":821,"skin":"creatroom/join_btn_s.png"}},{"type":"Image","props":{"y":0,"x":422,"var":"CreatRoom","skin":"creatroom/est_btn_n.png"}},{"type":"Image","props":{"y":139,"x":520,"skin":"creatroom/roomnumbg.png"}},{"type":"Text","props":{"y":149,"x":578,"width":508,"var":"shownum","text":5673,"height":66,"fontSize":60,"color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":388,"x":1292,"skin":"creatroom/right_pic.png"}},{"type":"Image","props":{"y":390,"x":111,"skin":"creatroom/left_pic.png"}},{"type":"Box","props":{"y":257,"x":407},"child":[{"type":"Image","props":{"var":"num1","skin":"creatroom/number_btn_bg.png","name":"item0"}},{"type":"Image","props":{"y":49,"x":40,"skin":"creatroom/num1.png"}}]},{"type":"Box","props":{"y":257,"x":620},"child":[{"type":"Image","props":{"var":"num2","skin":"creatroom/number_btn_bg.png","name":"item1"}},{"type":"Image","props":{"y":49,"x":47,"skin":"creatroom/num2.png"}}]},{"type":"Box","props":{"y":257,"x":833},"child":[{"type":"Image","props":{"var":"num3","skin":"creatroom/number_btn_bg.png","name":"item2"}},{"type":"Image","props":{"y":49,"x":49,"skin":"creatroom/num3.png"}}]},{"type":"Box","props":{"y":465,"x":407},"child":[{"type":"Image","props":{"var":"num4","skin":"creatroom/number_btn_bg.png","name":"item4"}},{"type":"Image","props":{"y":45,"x":40,"skin":"creatroom/num4.png"}}]},{"type":"Box","props":{"y":465,"x":620},"child":[{"type":"Image","props":{"var":"num5","skin":"creatroom/number_btn_bg.png","name":"item5"}},{"type":"Image","props":{"y":45,"x":47,"skin":"creatroom/num5.png"}}]},{"type":"Box","props":{"y":465,"x":833},"child":[{"type":"Image","props":{"var":"num6","skin":"creatroom/number_btn_bg.png","name":"item6"}},{"type":"Image","props":{"y":45,"x":49,"skin":"creatroom/num6.png"}}]},{"type":"Box","props":{"y":465,"x":1046},"child":[{"type":"Image","props":{"var":"num0","skin":"creatroom/number_btn_bg.png","name":"item7"}},{"type":"Image","props":{"y":48,"x":49,"skin":"creatroom/num0.png"}}]},{"type":"Box","props":{"y":673,"x":407},"child":[{"type":"Image","props":{"var":"num7","skin":"creatroom/number_btn_bg.png","name":"item8"}},{"type":"Image","props":{"y":53,"x":50,"skin":"creatroom/num7.png"}}]},{"type":"Box","props":{"y":673,"x":620},"child":[{"type":"Image","props":{"var":"num8","skin":"creatroom/number_btn_bg.png","name":"item9"}},{"type":"Image","props":{"y":53,"x":47,"skin":"creatroom/num8.png"}}]},{"type":"Box","props":{"y":673,"x":833},"child":[{"type":"Image","props":{"var":"num9","skin":"creatroom/number_btn_bg.png","name":"item10"}},{"type":"Image","props":{"y":53,"x":49,"skin":"creatroom/num9.png"}}]},{"type":"Box","props":{"y":673,"x":1046},"child":[{"type":"Image","props":{"var":"back","skin":"creatroom/number_btn_bg.png","name":"item11"}},{"type":"Image","props":{"y":49,"x":43,"skin":"creatroom/numx.png"}}]},{"type":"Box","props":{"y":257,"x":1046},"child":[{"type":"Image","props":{"var":"clearall","skin":"creatroom/number_btn_bg.png"}},{"type":"Image","props":{"y":45,"x":51,"skin":"creatroom/num_back.png"}}]}]};
		return GameJoinUI;
	})(Dialog);	

//创建游戏
var GameCreatUI=(function(_super){
		function GameCreatUI(){
			
		    this.BtClose=null;
		    this.JoinRoom=null;
		    this.maxboom=null;
		    this.CreatBtn=null;
		    this.playnum=null;
		    this.showtext=null;
		    this.pay_money=null;
		    this.pay_type=null;

			GameCreatUI.__super.call(this);
		}

		CLASS$(GameCreatUI,'ui.GameCreatUI',_super);
		var __proto__=GameCreatUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameCreatUI.uiView);
		}
		GameCreatUI.uiView={"type":"Dialog","props":{"width":1628,"height":928},"child":[{"type":"Image","props":{"y":27,"x":-3,"width":1651,"skin":"public/popup_page.png","sizeGrid":"100,100,100,100","height":917}},{"type":"Image","props":{"y":11,"x":1512,"var":"BtClose","skin":"public/close.png"}},{"type":"Image","props":{"y":10,"x":831,"var":"JoinRoom","skin":"creatroom/join_btn_n.png"}},{"type":"Image","props":{"y":540,"x":118,"skin":"creatroom/cor.png","name":"item0"}},{"type":"Image","props":{"y":682,"x":118,"skin":"creatroom/cor.png","name":"item1"}},{"type":"RadioGroup","props":{"y":570,"x":222,"width":1217,"var":"maxboom","space":20,"skin":"public/radiogroup.png","name":"item1","labels":"四炸封顶,五炸封顶,","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Image","props":{"y":725,"x":666,"var":"CreatBtn","skin":"creatroom/buttonest.png"}},{"type":"RadioGroup","props":{"y":420,"x":232,"width":1217,"var":"playnum","space":40,"skin":"public/radiogroup.png","name":"item2","labels":"九局,十八局,三十二局","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Box","props":{"y":140,"x":550},"child":[{"type":"Text","props":{"y":12,"width":542,"var":"showtext","text":"本次消耗房卡        张","strokeColor":"#ffffff","stroke":3,"height":81,"fontSize":55,"font":"Microsoft YaHei","color":"#000000","bold":true}},{"type":"Text","props":{"y":3,"x":360,"width":99,"var":"pay_money","text":0,"strokeColor":"#ffffff","stroke":3,"height":86,"fontSize":70,"font":"Microsoft YaHei","color":"#ff0400","align":"center"}}]},{"type":"RadioGroup","props":{"y":268,"x":300,"width":997,"var":"pay_type","space":100,"skin":"public/radiogroup.png","name":"item2","labels":"九局,十八局,三十二局","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Image","props":{"y":375,"x":111,"skin":"creatroom/cor.png","name":"item0"}},{"type":"Image","props":{"y":12,"x":429,"skin":"creatroom/est_btn_s.png"}}]};
		return GameCreatUI;
	})(Dialog);
//游戏加载	
var AgainstGameLoadUI=(function(_super){
		function AgainstGameLoadUI(){
			
		    this.load_text=null;
		    this.load_img=null;
		    this.but_close=null;

			AgainstGameLoadUI.__super.call(this);
		}

		CLASS$(AgainstGameLoadUI,'ui.AgainstGameLoadUI',_super);
		var __proto__=AgainstGameLoadUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameLoadUI.uiView);
		}

		STATICATTR$(AgainstGameLoadUI,
		['uiView',function(){return this.uiView={"type":"Dialog","props":{"width":850,"height":200},"child":[{"type":"Image","props":{"y":40,"x":0,"skin":"gameload/bg.png"}},{"type":"Text","props":{"y":89,"x":178,"width":613,"var":"load_text","text":"正在加载中","height":40,"fontSize":40,"color":"#fffbfb"}},{"type":"Image","props":{"y":107,"x":96,"width":100,"var":"load_img","skin":"gameload/load.png","pivotY":50,"pivotX":50,"height":100}},{"type":"Image","props":{"y":6,"x":756,"var":"but_close","skin":"gameload/close.png"}}]};}
		]);
		return AgainstGameLoadUI;
	})(Dialog);
//游戏提示弹出	
var AgainstGameToastUI=(function(_super){
		function AgainstGameToastUI(){
			
		    this.toast_text=null;
		    this.but_close=null;

			AgainstGameToastUI.__super.call(this);
		}

		CLASS$(AgainstGameToastUI,'ui.AgainstGameToastUI',_super);
		var __proto__=AgainstGameToastUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameToastUI.uiView);
		}

		STATICATTR$(AgainstGameToastUI,
		['uiView',function(){return this.uiView={"type":"Dialog","props":{"width":850,"height":200},"child":[{"type":"Image","props":{"y":38,"x":6,"skin":"gameload/bg.png"}},{"type":"Text","props":{"y":56,"x":27,"width":724,"var":"toast_text","valign":"middle","height":108,"fontSize":40,"font":"Arial","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":1,"x":754,"var":"but_close","skin":"gameload/close.png","name":"close"}}]};}
		]);
		return AgainstGameToastUI;
	})(Dialog);