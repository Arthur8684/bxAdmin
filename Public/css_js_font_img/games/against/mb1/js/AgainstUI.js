// JavaScript Document
	
var AgainstGameSelectUI=(function(_super){
		function AgainstGameSelectUI(){
			
		    this.BtClose=null;
		    this.roomid=null;
		    this.noroom=null;
		    this.match=null;
		    this.nomatch=null;

			AgainstGameSelectUI.__super.call(this);
		}

		CLASS$(AgainstGameSelectUI,'ui.AgainstGameSelectUI',_super);
		var __proto__=AgainstGameSelectUI.prototype;
		__proto__.createChildren=function(){
		    
			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameSelectUI.uiView);
		}
		AgainstGameSelectUI.uiView={"type":"Dialog","props":{"width":1628,"height":928},"child":[{"type":"Image","props":{"y":3,"x":-4,"width":1628,"skin":"public/popup_page.png","height":928,"sizeGrid":"70,70,70,70"}},{"type":"Image","props":{"y":-2,"x":1497,"var":"BtClose","skin":"public/close.png"}},{"type":"Box","props":{"y":200,"x":823,"var":"roomid"},"child":[{"type":"Image","props":{"y":78,"skin":AgainstImg+"select/select_bg.png","name":"item1"}},{"type":"Image","props":{"y":93,"x":45,"skin":"gameselect/pic_left_t.png"}},{"type":"Image","props":{"x":180,"skin":"gameselect/pic_right.png"}},{"type":"Image","props":{"y":392,"x":342,"skin":"gameselect/title_right.png"}},{"type":"Label","props":{"y":339,"x":74,"width":545,"visible":false,"var":"noroom","text":"敬请期待","strokeColor":"#a61100","stroke":20,"rotation":-16,"height":143,"fontSize":70,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}}]},{"type":"Box","props":{"y":191,"x":158,"var":"match"},"child":[{"type":"Image","props":{"y":86,"skin":AgainstImg+"select/select_bg.png"}},{"type":"Image","props":{"y":104,"x":288,"skin":"gameselect/pic_left_g.png"}},{"type":"Image","props":{"x":36,"skin":"gameselect/pic_left.png"}},{"type":"Image","props":{"y":400,"x":266,"skin":"gameselect/title_left.png"}},{"type":"Label","props":{"y":329,"x":64,"width":545,"visible":false,"var":"nomatch","text":"敬请期待","strokeColor":"#a61100","stroke":20,"rotation":-16,"height":194,"fontSize":70,"font":"Microsoft YaHei","color":"#ffffff","bold":false,"align":"center"}}]}]};
		return AgainstGameSelectUI;
	})(Dialog);	

//进入游戏	
var AgainstGameJoinUI=(function(_super){
		function AgainstGameJoinUI(){
			
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

			AgainstGameJoinUI.__super.call(this);
		}

		CLASS$(AgainstGameJoinUI,'ui.AgainstGameJoinUI',_super);
		var __proto__=AgainstGameJoinUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameJoinUI.uiView);
		}
		AgainstGameJoinUI.uiView={"type":"Dialog","props":{},"child":[{"type":"Image","props":{"y":19,"x":-13,"width":1651,"skin":"public/popup_page.png","sizeGrid":"100,100,100,100","height":917}},{"type":"Image","props":{"y":1,"x":1502,"var":"BtClose","skin":"public/close.png"}},{"type":"Image","props":{"y":0,"x":821,"skin":"creatroom/join_btn_s.png"}},{"type":"Image","props":{"y":0,"x":422,"var":"CreatRoom","skin":"creatroom/est_btn_n.png"}},{"type":"Image","props":{"y":139,"x":520,"skin":AgainstImg+"bg/roomnumbg.png"}},{"type":"Text","props":{"y":149,"x":578,"width":508,"var":"shownum","text":5673,"height":66,"fontSize":60,"color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":388,"x":1292,"skin":"creatroom/right_pic.png"}},{"type":"Image","props":{"y":390,"x":111,"skin":"creatroom/left_pic.png"}},{"type":"Box","props":{"y":257,"x":407},"child":[{"type":"Image","props":{"var":"num1","skin":"creatroom/number_btn_bg.png","name":"item0"}},{"type":"Image","props":{"y":49,"x":40,"skin":"creatroom/num1.png"}}]},{"type":"Box","props":{"y":257,"x":620},"child":[{"type":"Image","props":{"var":"num2","skin":"creatroom/number_btn_bg.png","name":"item1"}},{"type":"Image","props":{"y":49,"x":47,"skin":"creatroom/num2.png"}}]},{"type":"Box","props":{"y":257,"x":833},"child":[{"type":"Image","props":{"var":"num3","skin":"creatroom/number_btn_bg.png","name":"item2"}},{"type":"Image","props":{"y":49,"x":49,"skin":"creatroom/num3.png"}}]},{"type":"Box","props":{"y":465,"x":407},"child":[{"type":"Image","props":{"var":"num4","skin":"creatroom/number_btn_bg.png","name":"item4"}},{"type":"Image","props":{"y":45,"x":40,"skin":"creatroom/num4.png"}}]},{"type":"Box","props":{"y":465,"x":620},"child":[{"type":"Image","props":{"var":"num5","skin":"creatroom/number_btn_bg.png","name":"item5"}},{"type":"Image","props":{"y":45,"x":47,"skin":"creatroom/num5.png"}}]},{"type":"Box","props":{"y":465,"x":833},"child":[{"type":"Image","props":{"var":"num6","skin":"creatroom/number_btn_bg.png","name":"item6"}},{"type":"Image","props":{"y":45,"x":49,"skin":"creatroom/num6.png"}}]},{"type":"Box","props":{"y":465,"x":1046},"child":[{"type":"Image","props":{"var":"num0","skin":"creatroom/number_btn_bg.png","name":"item7"}},{"type":"Image","props":{"y":48,"x":49,"skin":"creatroom/num0.png"}}]},{"type":"Box","props":{"y":673,"x":407},"child":[{"type":"Image","props":{"var":"num7","skin":"creatroom/number_btn_bg.png","name":"item8"}},{"type":"Image","props":{"y":53,"x":50,"skin":"creatroom/num7.png"}}]},{"type":"Box","props":{"y":673,"x":620},"child":[{"type":"Image","props":{"var":"num8","skin":"creatroom/number_btn_bg.png","name":"item9"}},{"type":"Image","props":{"y":53,"x":47,"skin":"creatroom/num8.png"}}]},{"type":"Box","props":{"y":673,"x":833},"child":[{"type":"Image","props":{"var":"num9","skin":"creatroom/number_btn_bg.png","name":"item10"}},{"type":"Image","props":{"y":53,"x":49,"skin":"creatroom/num9.png"}}]},{"type":"Box","props":{"y":673,"x":1046},"child":[{"type":"Image","props":{"var":"back","skin":"creatroom/number_btn_bg.png","name":"item11"}},{"type":"Image","props":{"y":49,"x":43,"skin":"creatroom/numx.png"}}]},{"type":"Box","props":{"y":257,"x":1046},"child":[{"type":"Image","props":{"var":"clearall","skin":"creatroom/number_btn_bg.png"}},{"type":"Image","props":{"y":45,"x":51,"skin":"creatroom/num_back.png"}}]}]};
		return AgainstGameJoinUI;
	})(Dialog);	

//创建游戏
var AgainstGameCreatUI=(function(_super){
		function AgainstGameCreatUI(){
			
		    this.BtClose=null;
		    this.JoinRoom=null;
		    this.maxboom=null;
		    this.CreatBtn=null;
		    this.playnum=null;
		    this.showtext=null;
		    this.pay_money=null;
		    this.pay_type=null;

			AgainstGameCreatUI.__super.call(this);
		}

		CLASS$(AgainstGameCreatUI,'ui.AgainstGameCreatUI',_super);
		var __proto__=AgainstGameCreatUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameCreatUI.uiView);
		}
		AgainstGameCreatUI.uiView={"type":"Dialog","props":{"width":1628,"height":928},"child":[{"type":"Image","props":{"y":27,"x":-3,"width":1651,"skin":"public/popup_page.png","sizeGrid":"100,100,100,100","height":917}},{"type":"Image","props":{"y":11,"x":1512,"var":"BtClose","skin":"public/close.png"}},{"type":"Image","props":{"y":10,"x":831,"var":"JoinRoom","skin":"creatroom/join_btn_n.png"}},{"type":"Image","props":{"y":540,"x":118,"skin":"creatroom/cor.png","name":"item0"}},{"type":"Image","props":{"y":682,"x":118,"skin":"creatroom/cor.png","name":"item1"}},{"type":"RadioGroup","props":{"y":570,"x":222,"width":1217,"var":"maxboom","space":20,"skin":"public/radiogroup.png","name":"item1","labels":"四炸封顶,五炸封顶,","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Image","props":{"y":725,"x":666,"var":"CreatBtn","skin":"creatroom/buttonest.png"}},{"type":"RadioGroup","props":{"y":420,"x":232,"width":1217,"var":"playnum","space":40,"skin":"public/radiogroup.png","name":"item2","labels":"九局,十八局,三十二局","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Box","props":{"y":140,"x":550},"child":[{"type":"Text","props":{"y":12,"width":542,"var":"showtext","text":"本次消耗房卡        张","strokeColor":"#ffffff","stroke":3,"height":81,"fontSize":55,"font":"Microsoft YaHei","color":"#000000","bold":true}},{"type":"Text","props":{"y":3,"x":360,"width":99,"var":"pay_money","text":0,"strokeColor":"#ffffff","stroke":3,"height":86,"fontSize":70,"font":"Microsoft YaHei","color":"#ff0400","align":"center"}}]},{"type":"RadioGroup","props":{"y":268,"x":300,"width":997,"var":"pay_type","space":100,"skin":"public/radiogroup.png","name":"item2","labels":"九局,十八局,三十二局","labelStrokeColor":"#ffffff","labelStroke":3,"labelSize":60,"labelFont":"Microsoft YaHei","labelColors":"#000000","labelBold":true,"labelAlign":"center","height":96}},{"type":"Image","props":{"y":375,"x":111,"skin":"creatroom/cor.png","name":"item0"}},{"type":"Image","props":{"y":12,"x":429,"skin":"creatroom/est_btn_s.png"}}]};
		return AgainstGameCreatUI;
	})(Dialog);
	
var AgainstGameRoomUI=(function(_super){
		function AgainstGameRoomUI(){
			
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
			this.discard_prompt=null;
			
			this.Menu=null;
		    this.Back=null;
		    this.Help=null;	
			this.Dissolve=null;		
			

			AgainstGameRoomUI.__super.call(this);
		}

		CLASS$(AgainstGameRoomUI,'ui.test.AgainstGameRoomUI',_super);
		var __proto__=AgainstGameRoomUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(AgainstGameRoomUI.uiView);
		}

		STATICATTR$(AgainstGameRoomUI,
		['uiView',function(){return this.uiView={"type":"View","props":{"width":1920,"height":1080},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":AgainstImg+"bg/bg.jpg"}},{"type":"Image","props":{"y":14,"x":1810,"var":"Menu","skin":"room/icon_menu.png"}},{"type":"Image","props":{"y":14,"x":33,"var":"Back","skin":"room/icon_back.png"}},{"type":"Image","props":{"y":14,"x":1583,"var":"Dissolve","skin":"room/icon_dissolve.png"}},{"type":"Image","props":{"y":14,"x":1694,"var":"Help","skin":"room/icon_help.png"}},{"type":"Sprite","props":{"y":207,"x":43,"width":205,"var":"user3","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"room/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"room/head.png","name":"head"}},{"type":"Text","props":{"y":168,"x":-45,"width":272,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":209,"x":-47,"width":272,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":207,"x":1665,"width":205,"var":"user2","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"room/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"room/head.png","name":"head"}},{"type":"Text","props":{"y":175,"x":-59,"width":304,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":216,"x":-61,"width":307,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":695,"x":41,"width":205,"var":"user1","height":194},"child":[{"type":"FillTexture","props":{"y":0,"x":0,"width":176,"skin":"room/head.png","repeat":"no-repeat","height":179}},{"type":"Image","props":{"y":0,"x":0,"skin":"room/head.png","name":"head"}},{"type":"Text","props":{"y":172,"x":-58,"width":304,"valign":"middle","text":"用户名称","name":"nickname","height":37,"fontSize":38,"font":"SimHei","color":"#f9f3f3","bold":true,"align":"center"}},{"type":"Text","props":{"y":213,"x":-60,"width":307,"valign":"middle","text":200,"name":"point","height":39,"fontSize":38,"font":"SimHei","color":"#f8e50d","bold":true,"align":"center"}}]},{"type":"Sprite","props":{"y":800,"x":227,"width":1498,"var":"cards","height":205}},{"type":"Image","props":{"y":630,"x":490,"var":"but_discard","skin":"room/but_discard.png"}},{"type":"Image","props":{"y":630,"x":850,"var":"but_prompt","skin":"room/but_prompt.png"}},{"type":"Image","props":{"y":630,"x":1236,"var":"but_not_discard","skin":"room/but_not_discard.png"}},{"type":"Sprite","props":{"y":600,"x":382,"width":1151,"var":"discard_sprite_1","height":165}},{"type":"Sprite","props":{"y":220,"x":250,"width":670,"var":"discard_sprite_0","height":156}},{"type":"Sprite","props":{"y":214,"x":976,"width":670,"var":"discard_sprite_2","height":155}},{"type":"Sprite","props":{"y":110,"x":214,"width":373,"var":"cardNumLeft","height":81},"child":[{"type":"Image","props":{"y":0,"x":0,"skin":"room/tra_bg1.png"}},{"type":"Image","props":{"y":2,"x":89,"skin":"room/sheng.png"}},{"type":"Clip","props":{"y":0,"x":194,"skin":"room/clip_num_game.png","name":"num0","index":0,"clipX":10}},{"type":"Clip","props":{"y":0,"x":253,"skin":"room/clip_num_game.png","name":"num1","index":0,"clipX":10}}]},{"type":"Sprite","props":{"y":110,"x":1404,"width":315,"var":"cardNumRight","height":83},"child":[{"type":"Image","props":{"y":0,"x":-17,"skin":"room/tra_bg4.png"}},{"type":"Image","props":{"y":5,"x":80,"skin":"room/sheng.png"}},{"type":"Clip","props":{"y":0,"x":160,"skin":"room/clip_num_game.png","name":"num0","index":0,"clipX":10}},{"type":"Clip","props":{"y":0,"x":213,"skin":"room/clip_num_game.png","name":"num1","index":0,"clipX":10}}]},{"type":"Image","props":{"y":630,"x":849,"var":"but_ready","skin":"room/but_ready.png"}},{"type":"Image","props":{"y":741,"x":235,"var":"user_prompt_1","skin":""}},{"type":"Image","props":{"y":253,"x":241,"var":"user_prompt_0","skin":""}},{"type":"Image","props":{"y":252,"x":1525,"var":"user_prompt_2","skin":""}},{"type":"Text","props":{"y":530,"x":284,"width":1369,"var":"discard_prompt","valign":"middle","strokeColor":"#0b0b0b","stroke":5,"height":97,"fontSize":50,"font":"SimHei","color":"#efef14","align":"center"}}]};}
		]);
		return AgainstGameRoomUI;
	})(View);
		
var GameGradeUI=(function(_super){
		function GameGradeUI(){
			
		    this.fontbg=null;
		    this.fonttext=null;
		    this.game_button=null;
		    this.figure=null;
		    this.gradelist=null;

			GameGradeUI.__super.call(this);
		}

		CLASS$(GameGradeUI,'ui.GameGradeUI',_super);
		var __proto__=GameGradeUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameGradeUI.uiView);
		}
		GameGradeUI.uiView={"type":"Dialog","props":{"width":1200,"height":900},"child":[{"type":"Box","props":{"y":-37,"x":4,"name":"bigbg"},"child":[{"type":"Image","props":{"y":195,"width":1185,"skin":"endgame/showbg.png","height":750,"sizeGrid":"60,60,80,60"}},{"type":"Image","props":{"y":0,"x":157,"width":920,"var":"fontbg","skin":AgainstImg+"bg/fail.png","height":403}},{"type":"Text","props":{"y":116,"x":547,"width":208,"var":"fonttext","text":"失败","height":128,"fontSize":70,"font":"Microsoft YaHei","color":"#ffffff"}}]},{"type":"Box","props":{"y":286,"x":123,"name":"item0"},"child":[{"type":"Text","props":{"width":246,"text":"昵称","strokeColor":"#7088a3","stroke":5,"name":"item0","height":67,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"x":246,"width":246,"text":"底分","strokeColor":"#7088a3","stroke":5,"name":"item1","height":67,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"x":492,"width":246,"text":"倍数","strokeColor":"#7088a3","stroke":3,"name":"item2","height":67,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"x":738,"width":246,"text":"积分","strokeColor":"#7088a3","stroke":3,"name":"item3","height":67,"fontSize":40,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}}]},{"type":"Image","props":{"y":758,"x":470,"var":"game_button","skin":"endgame/game_but_continue.png"}},{"type":"Image","props":{"y":10,"x":19,"var":"figure","skin":"endgame/1.png"}},{"type":"List","props":{"y":359,"x":46,"width":1109,"var":"gradelist","spaceY":5,"height":397},"child":[{"type":"Box","props":{"name":"render"},"child":[{"type":"Image","props":{"y":22,"width":1109,"skin":"endgame/lis_tbg.png","height":78,"sizeGrid":"1,1,1,1"}},{"type":"Image","props":{"y":26,"x":32,"width":70,"visible":false,"skin":"endgame/headpath.jpg","name":"headpath","height":70}},{"type":"Label","props":{"y":37,"x":162,"width":196,"text":"label","name":"nickname","height":48,"fontSize":35,"font":"Microsoft YaHei","color":"#d6ff00"}},{"type":"Label","props":{"y":37,"x":405,"width":196,"text":"label","name":"point","height":48,"fontSize":35,"font":"Microsoft YaHei","color":"#d6ff00"}},{"type":"Label","props":{"y":37,"x":656,"width":196,"text":"label","name":"multiple","height":48,"fontSize":35,"font":"Microsoft YaHei","color":"#d6ff00"}},{"type":"Label","props":{"y":37,"x":901,"width":196,"text":"label","name":"allpoint","height":48,"fontSize":35,"font":"Microsoft YaHei","color":"#d6ff00"}},{"type":"Image","props":{"y":3,"x":35,"skin":"endgame/dzm.png","name":"dz"}}]}]}]};
		return GameGradeUI;
	})(Dialog);
	
var GameScoreboardUI=(function(_super){
		function GameScoreboardUI(){
			
		    this.gradelist=null;
		    this.leave=null;

			GameScoreboardUI.__super.call(this);
		}

		CLASS$(GameScoreboardUI,'ui.GameScoreboardUI',_super);
		var __proto__=GameScoreboardUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameScoreboardUI.uiView);
		}
		GameScoreboardUI.uiView={"type":"Dialog","props":{"width":1200,"height":800},"child":[{"type":"Image","props":{"y":11,"x":5,"width":1195,"skin":"endgame/showbg.png","height":756,"sizeGrid":"60,60,80,60"}},{"type":"Image","props":{"y":14,"x":250,"skin":PUBLIC+"/games/mb1/img/bg/popup_title.png"}},{"type":"Text","props":{"y":29,"x":444,"width":323,"text":"本场战绩","strokeColor":"#000000","stroke":3,"height":88,"fontSize":66,"font":"Microsoft YaHei","color":"#ffea00","bold":true,"align":"center"}},{"type":"Box","props":{"y":181,"x":47},"child":[{"type":"Image","props":{"width":1120,"skin":"endgame/lis_tbg.png","name":"item0","height":82,"sizeGrid":"1,1,1,1"}},{"type":"Text","props":{"y":20,"x":29,"width":229,"text":"昵称","name":"item0","height":67,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"y":20,"x":227,"width":229,"text":"积分","name":"item0","height":67,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"y":20,"x":864,"width":229,"text":"连胜局数","name":"item2","height":67,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"y":20,"x":436,"width":229,"text":"胜利局数","name":"item1","height":67,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}},{"type":"Text","props":{"y":20,"x":651,"width":229,"text":"失败局数","name":"item2","height":67,"fontSize":30,"font":"Microsoft YaHei","color":"#ffffff","align":"center"}}]},{"type":"List","props":{"y":286,"x":69,"width":1036,"var":"gradelist","spaceY":30,"height":329},"child":[{"type":"Box","props":{"y":0,"x":52,"width":1017,"name":"render","height":82},"child":[{"type":"Image","props":{"y":0,"x":-45,"width":77,"skin":"endgame/headpath.jpg","name":"headpath","height":77}},{"type":"Label","props":{"y":20,"x":47,"width":157,"text":"nickname","name":"nickname","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#e0ff00","bold":false}},{"type":"Label","props":{"y":20,"x":235,"width":85,"text":0,"name":"point","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#e0ff00","bold":false}},{"type":"Label","props":{"y":20,"x":849,"width":119,"text":"X0","name":"accumulator_num","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#e0ff00","bold":false}},{"type":"Label","props":{"y":20,"x":421,"width":118,"text":0,"name":"success_num","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#e0ff00","bold":false}},{"type":"Label","props":{"y":20,"x":635,"width":123,"text":0,"name":"fail_num","height":49,"fontSize":30,"font":"Microsoft YaHei","color":"#e0ff00","bold":false}}]}]},{"type":"Image","props":{"y":610,"x":462,"var":"leave","skin":"endgame/game_but_leave.png"}}]};
		return GameScoreboardUI;
	})(Dialog);
	
	
var GameDissolveUI=(function(_super){
		function GameDissolveUI(){
			
		    this.reciprocal=null;
		    this.actiongroup=null;
		    this.refuse=null;
		    this.agree=null;
		    this.user_operation=null;

			GameDissolveUI.__super.call(this);
		}

		CLASS$(GameDissolveUI,'ui.GameDissolveUI',_super);
		var __proto__=GameDissolveUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameDissolveUI.uiView);
		}
		GameDissolveUI.uiView={"type":"Dialog","props":{"width":1200,"height":800},"child":[{"type":"Image","props":{"y":8,"x":1,"width":1201,"skin":"public/popup_page.png","height":795,"sizeGrid":"100,100,100,100"}},{"type":"Image","props":{"y":12,"x":253,"skin":PUBLIC+"/games/mb1/img/bg/popup_title.png"}},{"type":"Text","props":{"y":35,"x":467,"width":287,"text":"解散房间","strokeColor":"#000000","stroke":3,"height":78,"fontSize":55,"font":"Microsoft YaHei","color":"#ffff00","bold":true,"align":"center"}},{"type":"Text","props":{"y":569,"x":383,"width":452,"text":"距自动解散房间还有                秒","height":47,"fontSize":30,"font":"Microsoft YaHei","color":"#080505","bold":true,"align":"left"}},{"type":"Text","props":{"y":562,"x":654,"width":136,"var":"reciprocal","text":120,"height":61,"fontSize":40,"font":"Microsoft YaHei","color":"#ff0000","bold":true,"align":"center"}},{"type":"Box","props":{"y":640,"x":360,"var":"actiongroup"},"child":[{"type":"Image","props":{"x":281,"var":"refuse","skin":"public/refuse.png"}},{"type":"Image","props":{"var":"agree","skin":"public/agree.png"}}]},{"type":"Sprite","props":{"y":181,"x":182,"width":906,"height":96},"child":[{"type":"Label","props":{"y":10,"x":41,"width":796,"var":"user_operation","text":"nickname发起解散房间","height":63,"fontSize":40,"font":"Microsoft YaHei","color":"#ff0000","bold":true,"align":"center"}}]}]};
		return GameDissolveUI;
	})(Dialog);