// JavaScript Document
/********************************************************************
 **游戏选择
********************************************************************/
var Gjoin=null;
var Gselect=null;
var Gcreat=null;
var Groom=null;//游戏房间

function Against()
{
	   
		var urls = [{url: AgainstImg+"select/gameselect.json",type: Loader.ATLAS}];
		Laya.loader.load(urls, Handler.create(this, function(){
			Gselect = new AgainstGameSelect();
			Gselect.init("Against");
			Gselect.popup();
			GL(-1);
		}), null, Loader.TEXT); //加载下页面的UI
}

function send(b)
{
	if(!socket.connected)
	{
		Groom.c_socket();
		Groom.send_data=b;
	}
	else
	{
		socket.send(JSON.stringify(b));
	}
	
}

function AgainstGameSelect()
{
    AgainstGameSelect.super(this);
	var __proto__ = AgainstGameSelect.prototype;
    var g = new HttpRequest();
    var GameSign;
    __proto__.init = function(sign)
    {
        this.GameSign=sign;
        var GameTypeUrl = rootPath+'index.php/Games/games/'+this.GameSign+'_config.php';
        if(this.GameSign)
        {
            g.once(Event.COMPLETE, this,function(){
                var data_ = JSON.parse(g.data);
                if(data_.room_card)
                {
                    this.noroom.visible = false;
                    this.roomid.on(Laya.Event.CLICK, this , this.inputroomid);
                }else{
                    this.noroom.visible = true;
                    this.roomid.gray = true;
                }
                if(data_.match)
                {
                    this.match.visible = false;
                    this.match.on(Laya.Event.CLICK, this , this.matchList);
                }else{
                    this.nomatch.visible = true;
                    this.match.gray = true;
                }
            });
            g.send(GameTypeUrl, 'game_sign='+this.GameSign+'', 'post', 'text');
            this.BtClose.on(Laya.Event.CLICK, this , this.close);
        }
    }
    __proto__.matchList = function()
    {
               
    }
    __proto__.inputroomid = function()
    {
        SoundManager.playSound(PUBLIC+"poker/sound/diploma_sound_aw_item.mp3", 1);
        GL(Gltime);
        var urls = [{url: AgainstImg+"creatroom/creatroom.json",type: Loader.ATLAS}];
        Laya.loader.load(urls, Handler.create(this, function(){
				Gjoin = new AgainstGameJoin();
				Gjoin.popup();
				Gselect.close();
				Gjoin.init(this.GameSign);
				GL(-1);
        }), null, Loader.TEXT); //加载下页面的UI   
    }    
}
Laya.class(AgainstGameSelect, "AgainstGameSelect", AgainstGameSelectUI); 

/********************************************************************
 **游戏进入
********************************************************************/
function AgainstGameJoin()
{
    AgainstGameJoin.super(this);
    var __proto__ = AgainstGameJoin.prototype;
    var hr = new HttpRequest();

    var GameSign;
    var GameConfig;
	
    __proto__.init = function(sign){

        this.shownum.text = '';
        var GameTypeUrl = rootPath+'index.php/Games/games/'+sign+'_config.php';
        hr.once(Event.COMPLETE, this,function(){
            GameConfig = JSON.parse(hr.data);
            this.GameSign = sign;
            this.BtClose.on(Laya.Event.CLICK, this , this.close);
            this.shownum.on(Laya.Event.CHANGE, this , this.JoinRoomFunc);
            this.CreatRoom.on(Laya.Event.CLICK, this , function(){
				SoundManager.playSound(PUBLIC+"poker/sound/diploma_sound_aw_item.mp3", 1);
                this.close();
				this.onClosed=function()
				   {
					    this.destroy()
					    Gcreat = new AgainstGameCreat();
						Gcreat.init(this.GameSign);
						Gcreat.popup();
				   }
				
            });
			
			var buttons=[this.num0,this.num1,this.num2,this.num3,this.num4,this.num5,this.num6,this.num7,this.num8,this.num9,this.clearall,this.back];
			
			for(var i=0;i<=11;i++)
			{
				button=buttons[i];
				//button.offAll(Event.CLICK);
				button.on(Event.CLICK, this , function(button,i){
					SoundManager.playSound(PUBLIC+"poker/sound/unionpay_key.mp3", 1);
					button.skin = "creatroom/number_btn_bg1.png";
					if(i<=9)
					{
						this.inponnum(i);
					}
					else if(i==10)
					{
						this.shownum.text = '';
					}
					else if(i==11)
					{
                         var text_val = this.shownum.text;
                         this.shownum.text = text_val.slice(0,text_val.length-1);						
					}					
					button.timerOnce(100,this,function(button){
						  button.skin = "creatroom/number_btn_bg.png";
					},[button])

				},[button,i]);
			}
        });        
        hr.send(GameTypeUrl, 'game_sign='+sign+'', 'post', 'text');
        
    }
    __proto__.inponnum = function(h){
        var text_val = this.shownum.text;
        var max_num = GameConfig['room_card']['room_num'] ;
        if(text_val.length < max_num)
        {
            this.shownum.text = ""+text_val+""+h;
        }
    }
    __proto__.JoinRoomFunc = function(){
        var max_num = GameConfig['room_card'].room_num;
        var text_val = this.shownum.text;
        
        if(text_val.length == max_num){
			
            GL(Gltime);
			this.JoinGameRoom(text_val,this);
         }
    }
	
	__proto__.JoinGameRoom = function(room_sn,removeObj){
		     
		     var actionUrl = rootPath+"index.php/Games/games/against_join_room.php";
             hr.once(Event.COMPLETE, this,function(){
					var str = hr.data;
					var data_ =  JSON.parse(str);
					
					if(data_.err == 1){
							  var urls = [{url: AgainstImg+"room/room.json",type: Loader.ATLAS},{url: AgainstImg+"room/other.json",type: Loader.ATLAS},{url: PUBLIC+"poker/img/poker/poker.json",type: Loader.ATLAS},{url: PUBLIC+"poker/img/poker/small.json",type: Loader.ATLAS},{url: PUBLIC+"poker/img/poker/ssmall.json",type: Loader.ATLAS},{url: AgainstImg+"room/endgame.json",type: Loader.ATLAS}];
							  Laya.loader.load(urls, Handler.create(this, function(){
								      if(removeObj) removeObj.close();
									  Gindex.destroy();
									  Groom=new AgainstGameRoom();
									  Groom.init(data_['room']);
									  Laya.stage.addChild(Groom);
									  GL(-1);
					  
							  }), null, Loader.TEXT); //加载下页面的UI
					}
					else if(data_.err == 2){     
						GT(data_.content,Gttime);
						
					}              
            });
            hr.once(Event.ERROR, this, function(e){
				    GT(e,Gttime);
                //Dlg.ShowMag(e);; 	
            });
            hr.send(actionUrl, 'room_sn='+room_sn+'&user_id='+userinfo.id+'&game_sign='+this.GameSign, 'post', 'text');	        
	}
	
	
}
Laya.class(AgainstGameJoin, "AgainstGameJoin", AgainstGameJoinUI); 
/********************************************************************
 **游戏创建
********************************************************************/
function AgainstGameCreat()
{
    AgainstGameCreat.super(this);
    var __proto___ = AgainstGameCreat.prototype;
    this.config;
    var hr = new HttpRequest();
    var max_num;
    var multiple_upper_val = "";
    var maxboom_val = "";
    var pay_type_val = "";
    var playnum_val = ""; 
    var GameSign;
    var GameConfig;
    __proto___.init = function(sign)
    {
        this.GameSign = sign;
        var GameTypeUrl = rootPath+'index.php/Games/games/'+sign+'_config';
        hr.once(Event.COMPLETE, this,function(){
            GameConfig = JSON.parse(hr.data);
            this.config = GameConfig['room_card'];
            var data = []; 
            max_num = this.config.set_number;
            max_num = max_num.split(",");
            for(i=0; i<max_num.length; i++)
            {
                data[i] = max_num[i]+"局";
            }
            var labels = data.join(",");
            this.playnum.labels = labels;
            multiple_upper = this.config.multiple_upper;
            multiple_upper = multiple_upper.split(",");
            var data1=[];
            for(i=0; i<multiple_upper.length; i++)
            {
            if(multiple_upper[i]==0){
                data1[i] = "不封顶";
            }else{
                data1[i] = multiple_upper[i]+"炸封顶";
            }
            }
            var labels = data1.join(",");
            this.maxboom.labels = labels;

            this.pay_type.labels = "房主扣费,每人扣费,赢家扣费";
            this.playnum.selectHandler = Laya.Handler.create(this,function(index)
            {
            playnum_val = max_num[index];
            },null,false);
            this.maxboom.selectHandler = Laya.Handler.create(this,function(index)
            {
            maxboom_val = multiple_upper[index];
            },null,false);
            this.pay_type.selectHandler = Laya.Handler.create(this,function(index)
            {
            if(index==0)
            {
                this.showtext.text = "本次消耗"+this.config.owner_point_type_name+"        "+this.config.owner_point_type_unit;
                this.pay_money.text = this.config.owner;
                multiple_upper_val = index;
            }
            if(index==1)
            {
                this.showtext.text = "本次消耗"+this.config.other_point_type_name+"        "+this.config.other_point_type_unit;
                this.pay_money.text = this.config.other;
                multiple_upper_val = index;
            }
            if(index==2)
            {
                this.showtext.text = "本次消耗"+this.config.win_point_type_name+"        "+this.config.win_point_type_unit;
                this.pay_money.text = this.config.win;
                multiple_upper_val = index;
            }
            },null,false);
            this.BtClose.on(Laya.Event.CLICK, this , this.close);
            this.CreatBtn.on(Laya.Event.CLICK, this , this.PostAction);
            this.JoinRoom.on(Laya.Event.CLICK, this , function(){
                //Dlg.close(); 
				   SoundManager.playSound(PUBLIC+"poker/sound/diploma_sound_aw_item.mp3", 1);
                   this.close();
				   this.onClosed=function()
				   {
					   this.destroy()
					   Gjoin = new AgainstGameJoin();
                       Gjoin.init(this.GameSign);
                       Gjoin.popup();
				   }	

            });
        });        
        hr.send(GameTypeUrl, 'game_sign='+sign+'', 'post', 'text');
        
    }
    __proto___.PostAction = function()
    {
		
		GL(Gltime);
		
        var Action = this.checkInput();
        var actionUrl = rootPath+"index.php/Games/games/against_create_room";
        if(Action)
        {
            hr.once(Event.COMPLETE, this,function(){
                var str = hr.data;
                var data_ =  JSON.parse(str);
                if(data_.err == 1){
			        Gjoin.JoinGameRoom(data_.room.room_sn,this);
                } 
				else if(data_.err == 2){
					GT(data_.content,Gttime)
                } 
            });
		    hr.once(Event.ERROR, this, function(e){
			       GT(e,Gttime)	
		    });
            hr.send(actionUrl, 'start_uid='+userinfo.id+'&game_num='+playnum_val+'&game_sign='+this.GameSign+'&payment_method='+multiple_upper_val+'&multiple_upper='+maxboom_val+'', 'post', 'text');
        }
    }
    __proto___.checkInput = function()
    {
        var flag = true;
		           
        if(playnum_val.length == 0)
        {
			GT("请设置局数",Gttime)
            flag = false;
        }
        if(maxboom_val.length == 0)
        {
			GT("请设置炸弹封顶",Gttime)
            flag = false;
        }
         if(multiple_upper_val.length == 0)
        {
			GT("请设置扣费模式",Gttime)
            flag = false;
        }
        return  flag;
    } 
}
Laya.class(AgainstGameCreat, "AgainstGameCreat", AgainstGameCreatUI); 

function AgainstGameRoom()
{
	AgainstGameRoom.super(this);
	this.rootid=0;
	this.position=0;
    this.cardsSprite=this.cards;//当前用户存放牌的容器
	this.mouseOverSelectCards=new Array();//鼠标滑过的时候被选择的
	this.selectCards=new Array();//出牌的时候被选择的牌
	
    this.butDiscard=this.but_discard;//出牌的时候被选择的牌
	this.butPrompt=this.but_prompt;//提示出牌按钮
	this.butNotDiscard=this.but_not_discard;//出牌的时候被选择的牌
	this.butReady=this.but_ready;//游戏准备
	
	
	this.gameCard=[];//当前用户的所发牌
	this.discardSprite=this.discard_sprite_1;//打出的牌存放容器
	this.discardSpriteLeft=this.discard_sprite_0;//打出的牌存放容器
	this.discardSpriteRight=this.discard_sprite_2;//打出的牌存放容器
	this.AgainstButtonSprite=null//存放抢地主按钮的容器

	this.userPrompt=this.user_prompt_1;//打出的牌存放容器
	this.userPromptLeft=this.user_prompt_0;//打出的牌存放容器
	this.userPromptRight=this.user_prompt_2;//打出的牌存放容器	
	this.Dprompt=this.discard_prompt;//出牌提示
	
	this.positionSprite=null;
	this.handCardsSprite=null;//底牌容器
	this.gameTitleSprite=null;//游戏title容器
	this.handCardsSpriteSmall=null;//底牌容器
	
	this.cardType=['','club','diamond','heart','spade','joker','lz'];
	
	this.Usprite=new Array();//存放界面会员对象
	this.Grade=null;//存放界面会员对
	this.Gscoreboard=null;//战绩界面
	this.game_dissolve=null;//解散房间
	this.config=null;
	
	this.send_data=null;
	
	
	var __proto__=AgainstGameRoom.prototype;

	//初始化
	__proto__.init=function(data){
		
		      SoundManager.playMusic(PUBLIC+"poker/sound/lord_play_bg1.mp3", 0);
			  
			  if(!userinfo.login)
			  {
				  alert('333')
			  }
			  else
			  {
				  this.roomid=data.room_id;
				  this.roomsn=data.room_sn;
				  this.cardNumLeft.removeSelf();
				  this.cardNumRight.removeSelf();
				  this.butDiscard.removeSelf();
				  this.butPrompt.removeSelf();
				  this.butNotDiscard.removeSelf();
				  
                  this.initTitle();
				  this.c_socket(1);  
			  }	

	}
	//重新开始
	__proto__.restart=function(){
		          var ROOMNUM=3;
				  var Usprite=this.Usprite;//存放用户信息容器
		          /*销毁记牌数组件*/
				  this.cardNumLeft.removeSelf();
				  this.cardNumRight.removeSelf();
				  /*销毁出牌按钮*/
				  this.butDiscard.removeSelf();
				  this.butPrompt.removeSelf();
				  this.butNotDiscard.removeSelf();
                  /*销毁地主农民头像，准备，销毁出牌容器*/
                  for(var i=0;i<ROOMNUM;i++) {
						Usprite[i].user_prompt.skin="";
						Usprite[i].user.getChildByName("head_").destroy();		
						Usprite[i].discard.destroyChildren();;	  
				  }
				  /*销毁牌*/
				  this.gameCard=[];
				  this.updateCard();	
				  /*销毁标题*/
				  this.handCardsSpriteSmall.destroyChildren();
				  this.setTitle('double',"倍:1");
				  this.setTitle('point',"底:1");	  
				  
				  this.selectCards=[];
				  this.gameCard=[];

	}
	
	__proto__.c_socket=function(recome_room){
		          if(this.config)
				  {
					  this.OnHttpRequestComplete_config(recome_room);
				  }
				  else
				  {
					  C = new HttpRequest();
					  C.once(Event.COMPLETE, this,this.OnHttpRequestComplete_config,[recome_room]);
					  C.send(rootPath+'index.php/Games/Games/config.php', null, 'get', 'json');					  
				  }

	}
	//当配置文件加载完成
	__proto__.OnHttpRequestComplete_config=function(){
		
		 var recome_room = arguments[0] ? arguments[0] : 0;//重新连接标识
		 
		 this.config =this.config?this.config:C.data;
		 var wsUrl="ws://"+this.config.server+":"+this.config.port+"/index.php/Games/server/server.php";
		 socket = new Socket();
		 socket.disableInput=false;
		 socket.connectByUrl(wsUrl);

		 socket.on(Event.OPEN, this, this.OnSocketOpen,[recome_room]);
		 socket.on(Event.MESSAGE, this, this.OnMessageReveived);
		 
	}	
	//当socket连接成功
	__proto__.OnSocketOpen=function(){
		
		  var recome_room = arguments[0] ? arguments[0] : 0;//重新连接标识
		  socket.on(Event.CLOSE, this, this.OnSocketClose);
		  socket.on(Event.ERROR, this, this.OnConnectError);
		  
		  if(recome_room)
		  {
			  send({action:'set',room_id:this.roomid,uid:userinfo.id,name:userinfo.user,game_sign:'Against',pass_pre:userinfo.pass_pre});
			  this.Usprite.push({user:this.user3,user_prompt:this.userPromptLeft,discard:this.discardSpriteLeft});
			  this.Usprite.push({user:this.user1,user_prompt:this.userPrompt,discard:this.discardSprite});
			  this.Usprite.push({user:this.user2,user_prompt:this.userPromptRight,discard:this.discardSpriteRight});
			  this.butDiscard.on(Event.CLICK, this, this.onDiscard);//给 sprite 对象添加点击事件侦听
			  this.butNotDiscard.on(Event.CLICK, this, this.onNotDiscard);//给 sprite 对象添加点击事件侦听
			  
			  this.butReady.on(Event.CLICK, this, this.OnReady);
			  this.Menu.on(Event.CLICK, this, this.OnMenu);
			  this.Back.on(Event.CLICK, this, this.OnBack);
			  this.Help.on(Event.CLICK, this, this.OnHelp);
			  this.Dissolve.on(Event.CLICK, this, this.OnDissolve);			  
		  }

		  
		  if(this.send_data)
		  {
			  send(this.send_data);
			  this.send_data=null;
		  } 
	}
	//当socket接受信息
	__proto__.OnMessageReveived=function(data){
			  var ROOMNUM=3;
			  var uid=userinfo.id;
			  
			  var Usprite=this.Usprite;//存放用户信息容器
			  //alert(data)
			  var message = JSON.parse(data);
			  var FID=message.f_uid;// 发送用户的ID
			  var action = message.action;
			  var users=message.users;
			  var userPosition=0;
					switch(action)
					{
						case 'come_room'://加入房间
							 userPosition=users[uid].position;
							 this.position=userPosition;
							 game_num= message.game_num;
							 //if(users[uid].R) this.butReady.removeSelf();
							 for(var i in users) {
								  value=users[i];
								  Position=value.position;
								  Headpath=value.headpath;
								  itme=(ROOMNUM-(userPosition-1)+Position) % ROOMNUM;
								  Usprite[itme].user.getChildByName("nickname").text=value.nickname;
								  Usprite[itme].user.getChildByName("point").text=value.point;
								  Laya.loader.load(Headpath, Handler.create(this, function()
								  {
									  Usprite[itme].user.getChildByName("head").skin=Headpath;
									  Usprite[itme].user.getChildByName("head").size(124,124).pos(29,13);
								  }));
								  
								  if(value.R==game_num)
								  {
									  Usprite[itme].user_prompt.skin="room/ready.png";
								  }
								  else
								  {
									  Usprite[itme].user_prompt.skin="";
								  }
							 }
		  
							 break;
						case 'recome_room'://重新连接房间
						     
							 userPosition=users[uid].position;
							 this.position=userPosition;
							 state=message.status;
							 game_num= message.game_num;
							 against=message.against;
							 handCards=message.handCards;
							 //if(users[uid].R) this.butReady.removeSelf();
							 
							 if(FID!=uid) return false;
							 for(var i in users) {
								  value=users[i];
								  Position=value.position;
								  Headpath=value.headpath;
								  itme=(ROOMNUM-(userPosition-1)+Position) % ROOMNUM;
								  Usprite[itme].user.getChildByName("nickname").text=value.nickname;
								  Usprite[itme].user.getChildByName("point").text=value.point;
								  Laya.loader.load(Headpath, Handler.create(this, function()
								  {
									  Usprite[itme].user.getChildByName("head").skin=Headpath;
									  Usprite[itme].user.getChildByName("head").size(124,124).pos(29,13);
								  }));
								  
								  if(itme==1 && value.R==game_num) this.butReady.removeSelf();
								  
								  if(state==0) 
								  {
									  Usprite[itme].user_prompt.skin=(value.R==game_num)?"room/ready.png":"";
								  }
								  else if(state==2)
								  {
									    
										head = new Images();
										if(against==value.userid)
										{
											head.skin="other/boy1.png";
										}
										else
										{
											head.skin="other/boy2.png";
										}
										head.name="head_";
										head.size(124,124).pos(29,13);
										head.zOrder=100;
										Usprite[itme].user.addChild(head);									  
								  }
							  }
							 
							  if(state)
							  {
										
										prePosition=message.prePosition;
										nextPosition=prePosition+1>ROOMNUM?1:prePosition+1;
										nextItme=(ROOMNUM-(userPosition-1)+nextPosition) % ROOMNUM;
										AItme=(ROOMNUM-(userPosition-1)+against) % ROOMNUM;
										
										this.gameCard=message.cards;
										this.updateCard();
										
										double=message.double;
										point=message.point?message.point:0;
										
										if(state==1)
										{
											this.handCards();
										}
										else if(state<=3)
										{
											this.setHandCards(handCards);
											this.setTitle('double',"倍:"+double[uid]);
											this.setTitle('point',"底:"+point);
											for(i=0;i<ROOMNUM;i++) {
												  Aitme=(ROOMNUM-(userPosition-1)+users[against]['position']) % ROOMNUM;
												  head = new Images();
												  if(Aitme==i)
												  {
													  head.skin="other/boy1.png";
												  }
												  else
												  {
													  head.skin="other/boy2.png";
												  }
												  head.name="head_";
												  head.size(124,124).pos(29,13);
												  head.zOrder=100;
												  Usprite[i].user.addChild(head);
											 }
										}										

										 if((!prePosition && against==uid) || (prePosition && nextItme==1) || (!prePosition  && !point && AItme==1))//抢地主后地主未出牌，轮到当前用户操作，刚准备完地主掉线
										 {
												this.setP(1);
												switch(state)
												{
													  case 1:
														this.showAgainstButton(1,point);
														break;
													  case 2:
														this.showDoubleButton(1);
														break;
													  case 3:
														this.addChild(this.butDiscard);
														this.addChild(this.butNotDiscard);
														this.addChild(this.butPrompt);
														break;
													  default:
													   
												}											 
										 }
										 else
										 {
												nextItme=prePosition?nextItme:AItme;
												this.setP(nextItme);
										 }
							 }							 
							 break;
						case 'game_ready'://准备游戏
							 userPosition=this.position;
							 Position=message.position;
							 itme=(ROOMNUM-(userPosition-1)+Position) % ROOMNUM;
							 Usprite[itme].user_prompt.skin="room/ready.png";
							 
							 if(FID==uid) SoundManager.playSound(PUBLIC+"poker/sound/diploma_sound_aw_item.mp3",1);
							 
							 break;
						case 'deal'://发牌
						     userPosition=this.position;
						     Position=message.position;
							 itme=(ROOMNUM-(userPosition-1)+Position) % ROOMNUM;
							 
							 for(var i=0;i<ROOMNUM;i++){
								 Usprite[i].user_prompt.skin="";
							 }
							 
							 this.addChild(this.cardNumLeft);
							 this.addChild(this.cardNumRight);
							 //this.stage.addChild(this.butDiscard);
							 this.cardsNumChange(this.cardNumLeft,17)
							 this.cardsNumChange(this.cardNumRight,17)
							 this.gameCard=message.cards;
							 var shuffleSound=SoundManager.playSound(PUBLIC+"poker/sound/lord_lobby_bg.mp3", 0);
                             SoundManager.addChannel(shuffleSound);
							 this.Shuffle(0,itme);	
                             SoundManager.removeChannel(shuffleSound);
							 
							 break;
						case 'grab_against'://抢地主
						     userPosition=this.position;
						     selectPosition=message.position;//选择积分的位置
							 selectPoint=message.selectPoint?message.selectPoint:0;//选择的积分
							 point=message.point?message.point:0;//游戏选择的积分
							 selectItme=(ROOMNUM-(userPosition-1)+selectPosition) % ROOMNUM;//选择积分玩家的位置
							 
							 SoundManager.playSound(PUBLIC+"poker/sound/lord_v_callscore_"+selectPoint+".mp3",1);
							 Usprite[selectItme].user_prompt.skin="room/t_"+selectPoint+".png";
							 
							 //this.addChild(Usprite[selectItme].user_prompt);
							 
							 nextPosition=(selectPosition+1>ROOMNUM)?1:selectPosition+1;
							 nextItme=(ROOMNUM-(userPosition-1)+nextPosition) % ROOMNUM; //下一个玩家
							 
							 this.setP(nextItme);
							 this.showAgainstButton(nextItme,point);
						     break;
						case 'finish_against'://抢地主完成
						     
							 selectPoint=message.selectPoint?message.selectPoint:0;//选择的积分
							 SoundManager.playSound(PUBLIC+"poker/sound/lord_v_callscore_"+selectPoint+".mp3",1);
							 
							 
						     userPosition=this.position;
							 Aposition=message.Aposition;//地主的位置
							 point=message.point?message.point:0;//本局游戏选择的积分
							 handCards=message.handCards;
							 double=message.double;						 

							 SoundManager.playSound(PUBLIC+"poker/sound/island_sound_win.mp3",1);
							 
                             Aitme=(ROOMNUM-(userPosition-1)+Aposition) % ROOMNUM;//地主位置
							 this.setP(Aitme);
							 this.showDoubleButton(Aitme);
							 this.lookCards(handCards,Aitme);
							 this.setTitle('point',"底:"+point);
							 this.setTitle('double',"倍:"+double[uid]);
							 
							 for(i=0;i<ROOMNUM;i++)
							 {
								 Usprite[i].user_prompt.skin="";
						     }
							 
                             for(i=0;i<ROOMNUM;i++) {
								  head = new Images();
								  if(Aitme==i)
								  {
									  head.skin="other/boy1.png";
								  }
								  else
								  {
									  head.skin="other/boy2.png";
								  }
								  head.name="head_";
								  head.size(124,124).pos(29,13);
								  head.zOrder=100;
								  Usprite[i].user.addChild(head);
							 }							 
						     break;
						case 'game_double'://翻倍
						     userPosition=this.position;
						     selectPosition=message.position;//选择翻倍的玩家
							 double=message.double;
							 selectDouble=message.selectDouble?message.selectDouble:1;
							 selectItme=(ROOMNUM-(userPosition-1)+selectPosition) % ROOMNUM;//选择翻倍的位置
							 Usprite[selectItme].user_prompt.skin="room/t_double_"+selectDouble+".png";		
							 
							 nextPosition=(selectPosition+1>ROOMNUM)?1:selectPosition+1;
							 nextItme=(ROOMNUM-(userPosition-1)+nextPosition) % ROOMNUM;//下一个玩家

							 this.setTitle('double',"倍:"+double[uid]);
							 this.setP(nextItme);
							 this.showDoubleButton(nextItme);
						     break;
						case 'finish_double'://翻倍完成
						     userPosition=this.position;
							 Aposition=message.Aposition;//地主位置
							 double=message.double;						 
							 this.setTitle('double',"倍:"+double[uid]);
							 for(i=0;i<ROOMNUM;i++)
							 {
								 Usprite[i].user_prompt.skin="";
						     }
							 
							 
							 AItme=(ROOMNUM-(userPosition-1)+Aposition) % ROOMNUM;//地主位置
							 if(AItme==1)
							 {
								  this.addChild(this.butDiscard);
								  this.addChild(this.butPrompt);	
							 }
                             this.setP(AItme);
						     break;
						case 'discard':
						     userPosition=this.position;
						     position=message.position;
							 double=message.double;
							 cardsType=message.cardsType;
							 nextPosition=(position+1>ROOMNUM)?1:position+1;
							 itme=(ROOMNUM-(userPosition-1)+ position ) % ROOMNUM;//当前玩家位置	
							 nextItme=(ROOMNUM-(userPosition-1)+nextPosition) % ROOMNUM;//下一家的位置	
							 
							 
							 
							 if( double && (cardsType.type=="KING" || cardsType.type=="AAAA"))
							 {
								 this.setTitle('double',"倍:"+double[uid]);
							 }
							 
							 if(cardsType.type=="KING")
							 {
								 if(itme==1)
								 {
									    this.butDiscard.removeSelf();
										this.butPrompt.removeSelf();
										this.butNotDiscard.removeSelf();							 
										this.gameCard=message.cards;
										this.updateCard();
										Laya.timer.once(2000, this, this.showBut);
								 }
							 }
							 else
							 {
								   
								   if(itme==1)
								   {
										this.butDiscard.removeSelf();
										this.butPrompt.removeSelf();
										this.butNotDiscard.removeSelf();							 
										this.gameCard=message.cards;
										this.updateCard();	
								   }
								   
								   if(nextItme==1)
								   {
										this.addChild(this.butDiscard);
										this.addChild(this.butNotDiscard);
										this.addChild(this.butPrompt);	
								   }
								   Usprite[nextItme].user_prompt.skin="";
								   Usprite[nextItme].discard.destroyChildren();	
							       this.setP(nextItme);								 
							 }
							 
							 cardsNum=message.cards_num;
							 discard_cards=message.discard_cards;
							 this.userDiscard(discard_cards,itme,cardsNum)
							 this.selectCards=[]; 
							 break;
						case 'not_discard':
							 userPosition=this.position;
						     position=message.position;
							 nextPosition=(position+1>ROOMNUM)?1:position+1;
							 itme=(ROOMNUM-(userPosition-1)+ position ) % ROOMNUM;//当前玩家位置	
							 nextItme=(ROOMNUM-(userPosition-1)+nextPosition) % ROOMNUM;//下一家的位置	
                             Usprite[itme].user_prompt.skin="room/buchu.png";
							 Usprite[nextItme].user_prompt.skin="";
							 
							 if(itme==1)
							 {
								  this.butDiscard.removeSelf();
								  this.butPrompt.removeSelf();
								  this.butNotDiscard.removeSelf();							 	
							 }
							 
							 if(nextItme==1)
							 {
								  this.addChild(this.butDiscard);
								  this.addChild(this.butPrompt);

								  if(message.wheel!="end") 
								  {
									  this.addChild(this.butNotDiscard); 
								  }  	
							 }	
							 
							 if(message.wheel=="end")	
							  {
								   for(i=0;i<ROOMNUM;i++)
								   {
									   Usprite[i].user_prompt.skin="";
									   Usprite[i].discard.destroyChildren();
								   }								   
							  }					 
							 Usprite[nextItme].discard.destroyChildren();
							 this.setP(nextItme);							 
							 break;	
						case 'game_success':
						     userPosition=this.position;
						     position=message.position;
							 double=message.double;
							 users=message.users;
							 itme=(ROOMNUM-(userPosition-1)+ position ) % ROOMNUM;//当前玩家位置
							 
							 if(itme==1)
							 {
								 this.butDiscard.removeSelf();
								 this.butPrompt.removeSelf();
								 this.butNotDiscard.removeSelf();	
								 this.gameCard=[];
							     this.updateCard();
							 }


                             cardsNum=0;
							 discard_cards=message.discard_cards;
							 this.userDiscard(discard_cards,itme,cardsNum);
							 
							 for(var i in users)
							 {
								  userItme=(ROOMNUM-(userPosition-1)+ i) % ROOMNUM;
								  
								  pointSprite=Usprite[userItme].user.getChildByName("point").text=users[i].totalPoint;
								  if(userItme!=1 && userItme!=itme)
								  {
									   this.userDiscard(users[i].cards,userItme,0);
								  }
							 }	
							 
							 for(i=0;i<ROOMNUM;i++)
							 {
								 Usprite[i].user_prompt.skin="";
						     }					 
							 
							 if( double && (cardsType.type=="KING" || cardsType.type=="AAAA"))
							 {
								 this.setTitle('double',"倍:"+double[uid]);
							 }						 
							 
							 Laya.timer.once(5000, this, this.councilGrade,[users,message.isEnd]);

							 	
							 break;	
						case 'game_complete':
						     if(FID!=uid) return false;
							 if(this.Gscoreboard && this.Gscoreboard.isPopup) return false;
							 if(this.Grade)
							 {
								 this.Grade.close();
							     this.Grade.destroy();
							 }
						     
							 this.Gscoreboard= new GameScoreboard();
							 this.Gscoreboard.init(users);
							 this.Gscoreboard.popup();
							 break;	
						case 'game_dissolve':
						      status=message.status;

							  users=message.users;
							  if(status==3)
							  {
								  this.game_dissolve = new GameDissolve();
								  userid=message.dissolve;
								  this.game_dissolve.init(users,userid);
								  
							  }
							  else
							  {
								  this.game_dissolve.dissolve_action(users,status);
							  }
							  
							 break;	
						case 'game_back':
						      position=message.position;
							  if(position)
							  {
								    if(FID==uid)
									{
										 Gindex = new GameIndex();
										 Gindex.init();
										 Laya.stage.addChild(Gindex);
										 Gjoin.destroy();
										 Gselect.destroy();
										 Gcreat.destroy();
										 Groom.destroy();										
									}
									else
									{
										 userPosition=this.position;
										 
										 itme=(ROOMNUM-(userPosition-1)+ position ) % ROOMNUM;//当前玩家位置
										 	
										 Usprite[itme].user.getChildByName("nickname").text="";
										 Usprite[itme].user.getChildByName("point").text="";
										 Usprite[itme].user.getChildByName("head").skin="";
										 Usprite[itme].user_prompt.skin="";									 
									}

							  }
							  else
							  {
								  send({action:'game_dissolve',status:3,game_sign:'Against'});
							  }
							  
							 break;							 
						case 'not_type':
						     this.setPrompt("对不起！牌型不符合");
							 break;	
						case 'not_turn':
						     this.setPrompt("对不起，还未轮到你出牌");
							 break;	
						case 'discarduser_not':
						     this.setPrompt("对不起，系统出错，请联系管理员");
							 break;	
						default:
					}
	}	
	
	__proto__.showBut=function()
	{
		 this.addChild(this.butDiscard);
		 this.addChild(this.butPrompt);
		 this.discardSprite.destroyChildren();
	}
	//当socket关闭的时候
	__proto__.OnSocketClose=function(){
		      Laya.timer.clearAll(this)
		      Laya.timer.loop(3000, this, function(){

					  if(socket.connected)
					  {
						  GL(-1);
						  Laya.timer.clearAll(this)
					  }
					  else
					  {
						  GL(0,null,'房间断开，正在连接中');
						  this.c_socket();
					  }						   
			   
		     });
	}
	//当socket出错的时候
	__proto__.OnConnectError=function(){
              Laya.timer.clearAll(this)
		      Laya.timer.loop(3000, this, function(){

					  if(socket.connected)
					  {
						   GL(-1);
						  Laya.timer.clearAll(this)
					  }
					  else
					  {
						  GL(0,null,'房间断开，正在连接中');
						  this.c_socket();
					  }					   

			   
		   });		 
	}
	//点击准备按钮
	__proto__.OnReady=function(){
		 this.butReady.removeSelf();
		 send({action:'game_ready',game_sign:'Against'});
	}
	
	//点击返回
	__proto__.OnBack=function(){
		 
		 send({action:'game_back',game_sign:'Against'});
		 
	}
	//点击解散
	__proto__.OnDissolve=function(){
		send({action:'game_dissolve',status:3,game_sign:'Against'}); 
	}	
	
	
	//点击菜单
	__proto__.OnMenu=function(){

	}	
	
	//点击帮助
	__proto__.OnHelp=function(){

	}		
	//发牌
	__proto__.Shuffle=function(i,itme){
			carts_=this.gameCard;
			
			i=i?i:0;
			num=carts_[i];
			if(!num) return false;
			
			card_png=this.getPokerByNum(num);
			cartPath="poker/lord_card_"+card_png+".png";
			var card= new Images(cartPath);
			this.cardsSprite.addChild(card);
			card.zOrder=i;
			card.pos(i * (155-77)+50,0);
			card.width =201;
			card.height =280;		
			card.loadImage(cartPath,0,0,201,280);

			if(carts_[i+1])
			{
				
				 this.cardsSprite.timerOnce(50,this,this.Shuffle,[i+1,itme],false)	
			}
			else
			{
				this.cardsSprite.timerOnce(500, this, this.updateCard);
				this.selectPosition();
			    this.setPosition(itme,5000)
				this.handCards();
			}
	}
	
	//点击出牌按钮时间
	__proto__.onDiscard=function(){		
			if(this.selectCards.length<=0)
			{
				this.setPrompt("请选择牌型");
				return false;
			}
		    var select_cards=this.selectCards;
			var selectCartnum=this.selectCards.length;
			send({action:'discard',game_sign:'Against',cards:this.selectCards})		    
	}
	
	//点击出牌按钮时间
	__proto__.onNotDiscard=function(){		
		   send({action:'discard',game_sign:'Against'})			    
	}	
	
		//用户出牌效果
	__proto__.userDiscard=function(cards,position,cardsnum){
			var Cartnum=cards.length;
		    cards=this.arraySort(cards)
			if(position!=1)
			{
				if(position==2)
				{
					cardSpriteAll=this.discardSpriteRight;
					if(Cartnum>=7)
					{
						cardX=670-9 * 46;
					}
					else
					{
						cardX=670-(Cartnum+2) * 46;
					}
					
					this.cardsNumChange(this.cardNumRight,cardsnum)
					
				}
				else
				{
					cardSpriteAll=this.discardSpriteLeft;
					cardX=0;
					this.cardsNumChange(this.cardNumLeft,cardsnum)
				}
				cardY=0;
			}
			else
			{
				cardSpriteAll=this.discardSprite;
				cardX=(1150-(Cartnum+1) * 46) / 2;
				cardY=0;
			}
			
			cardSpriteAll.destroyChildren(); 
			for (var i=0;i<Cartnum;i++)
			{
				offsetY=parseInt(i/8) * 130;
				offsetX=(i % 8) * 46;
				card_png=this.getPokerByNum(cards[i]);
				cartPath="poker/lord_card_"+card_png+".png";
				var discard_card = new Images(cartPath);
				discard_card.x=offsetX+cardX;
				discard_card.y=cardY+offsetY;
				discard_card.scale(0.6, 0.6)
				cardSpriteAll.addChild(discard_card);
			}		
		    
	}	
	//更新当前显示牌
	__proto__.updateCard=function(){
		    
			var handCards = arguments[0] ? arguments[0] : [];//设置参数a的默认值为1 
			carts_=this.gameCard;
			this.Sort();
			gameCardnum=carts_.length;
			this.cardsSprite.destroyChildren();
			
			for (var i=0;i<gameCardnum;i++)
			{
				  var card= new Sprite();
				  this.cardsSprite.addChild(card);
				  card_png=this.getPokerByNum(carts_[i]);
			      cartPath="poker/lord_card_"+card_png+".png";
				  card.loadImage(cartPath,0,0,201,280);
				  card.zOrder=i;
				  card.name=carts_[i];
				  
				  if(handCards && handCards.indexOf(carts_[i])!=-1)
				  {
					  Y=-60;
				  }
				  else
				  {
					  Y=0;
				  }
				  card.pos(i * (155-77)+50,Y);
				  card.width =155;
				  card.height =216;
				  card.mouseThrough = true;
				  
				  //card.on(Event.MOUSE_DOWN, this, this.onMouseDown);//给 sprite 对象添加点击事件侦
			      card.on(Event.MOUSE_OVER, this, this.onMouseOver);//给 sprite 对象添加点击事件侦听
			      card.on(Event.MOUSE_UP, this, this.onMouseUp);//给 sprite 对象添加点击事件		
			
				  cartPath="poker/lord_card_selected.png";
				  selectbg= new Sprite();
				  selectbg.name="select_card_make";
				  selectbg.pos(0,0);
				  selectbg.loadImage(cartPath,0,0,201,280);
				  selectbg.alpha=0;
				  card.addChild(selectbg);				  
			}		    
	}
	//鼠标按下事件
	__proto__.onMouseDown=function(e){
		     target=e.target;
			 target.on(Event.MOUSE_OVER, this, this.onMouseOver);//给 sprite 对象添加点击事件侦
		}	
		
	//鼠标滑动事件
	__proto__.onMouseOver=function(e){
			target=e.target;
			select_card_make=target.getChildByName('select_card_make');//鼠标滑过的时候牌边暗，被选择
			if(!select_card_make.alpha)
			{
				 this.mouseOverSelectCards.push(target);
				 select_card_make.alpha=1;
			} 

	}
	//鼠标弹起事件
	__proto__.onMouseUp=function(e){
		    var mouse_over_cards =this.mouseOverSelectCards;
			for (var i=0;i<mouse_over_cards.length;i++)
			{
				  if(mouse_over_cards[i].y<0)
				  {
					  mouse_over_cards[i].y=0;
					  this.selectCards.removeByValue(mouse_over_cards[i].name);
				  } 
				  else
				  {
					  mouse_over_cards[i].y=-60;
					  this.selectCards.push(mouse_over_cards[i].name);
				  }
				  mouse_over_cards[i].getChildByName('select_card_make').alpha=0;
			}
			this.mouseOverSelectCards=[];
	}
	
	//通过数组获取扑克
	__proto__.getPokerByNum=function(n){
		     cardType=this.cardType;
			 num=n % 100;
			 card_type=cardType[parseInt(n / 100)];
			 
			  switch(num)
			  {
				  case 11:
					num="j";
					break;
				  case 12:
					num="q";
					break;
				  case 13:
					num="k";
					break;
				  case 14:
					num="1";
					break;		
				  case 15:
					num="2";
					break;								
				  case 16:
					num="small";
					break;
				  case 17:
					num="big";
					break;			
				  default:
			  }
			  return card_type+"_"+num;	 
	}
	
		//通过数组获取扑克
	__proto__.Sort=function(){
		   this.gameCard.sort(function(a,b)
		   {
			   return (b % 100) - (a % 100);
		   })
	}
	
			//通过数组获取扑克
	__proto__.arraySort=function(array,type){
		   array.sort(function(a,b)
		   {
			   if(type)
			   {
				   return (b % 100) - (a % 100);
			   }
			   else
			   {
				   return (a % 100) - (b % 100);
			   }
			   
		   })
		   return array;
	}
	//出牌后数字动画变化
	__proto__.cardsNumChange=function(obj,num){
		   num0=obj.getChildByName("num0");
		   num1=obj.getChildByName("num1");
		   
		   num0.index=parseInt(num / 10);
		   num1.index=num % 10;   
		   Tween.from(num0,{scaleX:5,scaleY:5,alpha:0}, 1000, Ease.elasticOut);
		   Tween.from(num1,{scaleX:5,scaleY:5,alpha:0}, 1000, Ease.elasticOut);
	}
	
	//选择位置
	__proto__.selectPosition=function(){
		      if(this.positionSprite) return false;
              this.positionSprite = new Sprite();
			  this.positionSprite.x=896;
			  this.positionSprite.y=400;
			  this.positionSprite.zOrder=100;
			  
			  selectCircle=new Images();
			  selectCircle.skin ="room/circular.png";
			  selectCircle.x=0;
			  selectCircle.y=0;

			  Position=new Images();
			  Position.skin ="room/Triangle.png";
			  Position.x=50;
              Position.y=50;
			  Position.pivot(31,-50);
			  Position.name="P";
			  	  
			  this.addChild(this.positionSprite);
			  this.positionSprite.addChild(selectCircle);
			  this.positionSprite.addChild(Position);
	}
	
	__proto__.setPosition=function(position,times){
		      
			  if(!this.positionSprite) this.selectPosition();
		      var positionArray=[90,360,270];
			  var circleNum=5;
			  var angle=(-circleNum * 360) + positionArray[position];

		      Position=this.positionSprite.getChildByName("P");

              Tween.to(Position,
			  {
				  rotation: angle
			  }, times,Ease.strongOut,Handler.create(this,this.showAgainstButton,[position,0]));
	}
	
	__proto__.setP=function(position){
		      if(!this.positionSprite) this.selectPosition();
		      var positionArray=[90,0,270];
		      Position=this.positionSprite.getChildByName("P");
              Position.rotation=positionArray[position];
	}
	
	__proto__.showAgainstButton=function(position,points){
		      if(position!=1) return false;
		      this.AgainstButtonSprite = new Sprite();
			  this.AgainstButtonSprite.zOrder=100;
			  
			  this.AgainstButtonSprite.y=630;
			  this.AgainstButtonSprite.x=500;
			  this.addChild(this.AgainstButtonSprite);
			  for(i=0;i<2;i++)
			  {
				      var but=new Images();
					  if(i==0)
					  {
						  but.skin="room/grab.png";
					  }
					  else
					  {
						  but.skin="room/no_grab.png";						  
					  }
				      but.y=0;
					  but.x=i * (204+253);
					  but.on(Event.CLICK, this, this.showPointButton,[i,points]);//给 sprite 对象添加点击事件侦听
					  this.AgainstButtonSprite.addChild(but);  
			  }  
	}

	__proto__.showPointButton=function(p,points){
		      points=points?points:0;
		      this.AgainstButtonSprite.destroyChildren();
		      if(p==1)
			  {
				  send({action:'grab_against',point:0,game_sign:'Against'});
				  return false;
			  }

			  for(i=0;i<3;i++)
			  {
				      var but=new Button();
					  if(points>=(i+1))
					  {
						  but.skin="room/btn_no_select.png";
					  }
					  else
					  {
						  but.skin="room/btn_select.png";
						  but.on(Event.CLICK, this, this.onAgainstButton,[i+1]);//给 sprite 对象添加点击事件侦听
					  }
				      but.stateNum=1;
				      but.label=i+1;
					  but.labelPadding="-3,0,0,0";
					  but.labelBold=true;
					  but.labelColors="#FFF";
					  but.labelSize=60;
				      but.y=0;
					  but.x=i * (207+100);
					  
					  this.AgainstButtonSprite.addChild(but);
					  
			  }  
	}	
	
	__proto__.onAgainstButton=function(piont){
		      send({action:'grab_against',point:piont,game_sign:'Against'});
			  this.AgainstButtonSprite.destroyChildren();
			  
	}	
	
	__proto__.showDoubleButton=function(position){//加倍按钮显示
	          
		      if(position!=1) return false;
			  
			  if(!this.AgainstButtonSprite)
			  {
				  this.AgainstButtonSprite = new Sprite();
				  this.AgainstButtonSprite.zOrder=100;
				  
				  this.AgainstButtonSprite.y=630;
				  this.AgainstButtonSprite.x=500;
				  this.addChild(this.AgainstButtonSprite);				  
			  }
			  else
			  {
				  this.AgainstButtonSprite.destroyChildren();
			  }

			  for(i=0;i<2;i++)
			  {
				      var but=new Images();
					  if(i==0)//不翻倍
					  {
						  but.skin="room/no_double.png";
					  }
					  else
					  {
						  but.skin="room/double.png";						  
					  }
				      but.y=0;
					  but.x=i * (204+253);
					  but.on(Event.CLICK, this, this.onDoubleButton,[i+1]);//给 sprite 对象添加点击事件侦听
					  this.AgainstButtonSprite.addChild(but);  
			  }  
	}
	
	__proto__.onDoubleButton=function(P){//点击翻倍或者不翻倍按钮
		      send({action:'game_double',double:P,game_sign:'Against'});
			  this.AgainstButtonSprite.destroyChildren();
			  
	}
	
	//显示3张底牌背景
	__proto__.handCards=function(){
		     
			  if(this.handCardsSprite)
			  {
				  this.handCardsSprite.destroyChildren();
				  this.handCardsSprite.y=120;
				  this.handCardsSprite.x=682;
				  this.handCardsSprite.scale(1,1)				  
			  }
			  else
			  {
				  this.handCardsSprite = new Sprite();
				  this.handCardsSprite.zOrder=100;
				  this.handCardsSprite.y=120;
				  this.handCardsSprite.x=682;				  
			  }

			  this.addChild(this.handCardsSprite);	
			  
			  for(i=0;i<3;i++)
			  {
				      var cardBg=new Images();
					  cardBg.skin="other/handCards.png";
				      cardBg.y=0;
					  cardBg.x=i * (155+30);
					  cardBg.name="cardBg"+i;
					  this.handCardsSprite.addChild(cardBg);  
			  } 	  
	}
	
	//亮出3张底牌
	__proto__.lookCards=function(handCards,position){//点击翻倍或者不翻倍按钮
			  if(!this.handCardsSprite) this.handCards();
			  lenght=handCards.length;
			  for(i=0;i<lenght;i++)
			  {
				      cardBg=this.handCardsSprite.getChildByName('cardBg'+i);
					  card_png=this.getPokerByNum(handCards[i]);
			          cardBg.skin="poker/lord_card_"+card_png+".png";
			  }
			  
			  Tween.to(this.handCardsSprite,{scaleY:0.3,scaleX:0.3,y:18,x:560},500,null,Handler.create(this,this.setHandCards,[handCards]),500,true,true);
			  
			  if(position==1)
			  {
				  this.gameCard.push.apply(this.gameCard,handCards);
				  this.updateCard(handCards);
			  } 	  
	}	
	
	//设置提示信息
	__proto__.setPrompt=function(txt){//点击翻倍或者不翻倍按钮
	          var delay = arguments[1] ? arguments[1] : 2000;
			  var times = arguments[2] ? arguments[2] : 1000;//
			  
              //Tween.clear(this.Dprompt);
              this.Dprompt.text=txt;
			  this.Dprompt.alpha=1;
              Tween.to(this.Dprompt,{alpha:0},times,null,null,delay,true,true);
	}	
	//初始化标题
	__proto__.initTitle=function(sn){//点击翻倍或者不翻倍按钮
				  this.gameTitleSprite=new Sprite();
				  this.gameTitleSprite.x=513;
				  this.gameTitleSprite.y=0;
				  this.gameTitleSprite.loadImage('room/title.png',0,0);
				  this.addChild(this.gameTitleSprite);

				  this.handCardsSpriteSmall = new Sprite();
				  this.handCardsSpriteSmall.zOrder=10;	
				  this.handCardsSpriteSmall.y=17;
				  this.handCardsSpriteSmall.x=45;
				  this.gameTitleSprite.addChild(this.handCardsSpriteSmall); 

				  
				  var roomSn = new Text();
		          roomSn.overflow = Text.visible;
		          roomSn.color = "#FFFFFF";
				  roomSn.stroke=2;
				  roomSn.padding=[5,0,0,8];
				  roomSn.strokeColor="#e9c24f";
				  //roomSn.font = "Impact";
				  roomSn.fontSize = 35;
				  roomSn.x = 288;
				  roomSn.y = 15;
				  roomSn.text = "房号:"+this.roomsn;	
		          this.gameTitleSprite.addChild(roomSn);
				  
				  var doubleText = new Text();
		          doubleText.overflow = Text.visible;
		          doubleText.color = "#FFFFFF";
				  doubleText.name = "double";
				  doubleText.stroke=2;
				  doubleText.padding=[5,0,0,8];
				  doubleText.strokeColor="#e9c24f";
				  //roomSn.font = "Impact";
				  doubleText.fontSize = 35;
				  doubleText.x = 678;
				  doubleText.y = 17;
				  doubleText.text = "倍:1";	
		          this.gameTitleSprite.addChild(doubleText);
				  
				  var pointText = new Text();
		          pointText.overflow = Text.visible;
		          pointText.color = "#FFFFFF";
				  pointText.name = "point";
				  pointText.stroke=2;
				  pointText.padding=[5,0,0,8];
				  pointText.strokeColor="#e9c24f";
				  //roomSn.font = "Impact";
				  pointText.fontSize = 35;
				  pointText.x = 557;
				  pointText.y = 17;
				  pointText.text = "底:1";	
		          this.gameTitleSprite.addChild(pointText);        
	}	
	//设置标题底牌
	__proto__.setHandCards=function(handCards){
			  this.handCardsSpriteSmall.destroyChildren();	
			  if(this.handCardsSprite) this.handCardsSprite.removeSelf(); 
	  
			  lenght=handCards.length;
			  if(!lenght) return false;
			  for(i=0;i<lenght;i++)
			  {
				      var cardBg=new Images();
					  cardBg.y=0;
					  cardBg.x=i * (54+25);
					  
					  cardBg.scale(1.3,1.3,true);
					  card_png=this.getPokerByNum(handCards[i]);
			          cardBg.skin="ssmall/lord_card_"+card_png+"_small_new.png";
					  this.handCardsSpriteSmall.addChild(cardBg);  
			  }			 
			  
			  
	}		
	//设置标题信息
	__proto__.setTitle=function(type,txt){//点击翻倍或者不翻倍按钮
	
	              tager=this.gameTitleSprite.getChildByName(type)
                  tager.text=txt;
	}
	
	//游戏本局战绩
	__proto__.councilGrade=function(users,isEnd){//点击翻倍或者不翻倍按钮
	
	      this.Grade = new GameGrade();
		  this.Grade.init(users,isEnd);
		 // this.Grade.lock();
		  this.Grade.popup();
	}
}

Laya.class(AgainstGameRoom, "AgainstGameRoom", AgainstGameRoomUI);

// 房间加载完成

//创建显示记录牌
function GameGrade()
{
    GameGrade.super(this);
    var gradedata = [];
    fontbg = this.fontbg;
    figure = this.figure;
    fonttext = this.fonttext;
    var __proto__ = GameGrade.prototype;

    __proto__.init = function(gradelistarray)
    {
		var  isEnd= arguments[1] ? arguments[1] : 0;//是否为最后一局
        var visible;
        var fontcolors;
		
		if(isEnd)
		{
			this.game_button.skin="endgame/game_but_look_grade.png";
			this.game_button.once(Event.CLICK,this,function(){
			    send({action:'game_complete',game_sign:'Against'});
            })	 
		}
		else
		{
			this.game_button.skin="endgame/game_but_continue.png";
			this.game_button.once(Event.CLICK,this, function(){
				this.close();
				Groom.restart();
				send({action:'game_ready',game_sign:'Against'});
            });
		}

        var i = 0;
		
		for(var k in gradelistarray)
	    {
			v=gradelistarray[k];
            if(v.userid==userinfo.id)
            {
                figure.skin = 'endgame/'+v.isA+userinfo.sex+v.succeed+'.png';
                (v.succeed==1) ? fontbg.skin = AgainstImg+'bg/succeed.png':fontbg.skin = AgainstImg+'bg/fail.png';
                (v.succeed==1) ? fonttext.text = '胜利' :fonttext.text = '失败' ;
                fontcolors = '#d6ff00';
            }
            else
            {
                fontcolors = '#ffffff';
            }
            (v.isA==1) ? visible ="true" : visible = '';
            gradedata[i] = { nickname : { text : v.nickname , color : fontcolors} , point : { text : v.point ,color : fontcolors}, allpoint: { text : v.succeed*v.double*v.point,color : fontcolors} ,multiple:{ text : 'X'+v.double,color : fontcolors},headpath:{skin:v.headpath},dz:{ visible:visible}};
            i++;
        }   
  
        this.gradelist.dataSource = gradedata;
    } 
}
Laya.class(GameGrade, "GameGrade", GameGradeUI); 

//场完成计分板
function GameScoreboard()
{
    GameScoreboard.super(this);
    var gradedata = [];
    var fontcolors;
    var __proto__ = GameScoreboard.prototype;
    __proto__.init = function(array)
    {
        this.leave.on(Event.CLICK, this , function(){

			 Gindex = new GameIndex();
			 Gindex.init();
			 Laya.stage.addChild(Gindex);
			 this.close();
			 if(Gjoin) Gjoin.destroy();
			 if(Gselect) Gselect.destroy();
			 if(Gcreat) Gcreat.destroy();
			 if(Groom) Groom.destroy();
        });
		
		var i = 0;
	    for(var k in array)
		{
			v=array[k];
			(k==userinfo.id)? fontcolors = '#d6ff00':fontcolors = '#ffffff';
			gradedata[i] = { nickname : { text : v.nickname ,color : fontcolors} , point : { text : v.point ,color : fontcolors}, success_num: { text : v.success_num,color : fontcolors} ,fail_num:{ text : v.fail_num,color : fontcolors},accumulator_num:{ text : v.accumulator_num,color : fontcolors},headpath:{skin:v.headpath}}; 
			i++;
		 }
		 this.gradelist.dataSource = gradedata;  		
    }

}
Laya.class(GameScoreboard, "GameScoreboard", GameScoreboardUI); 

//解散游戏
function GameDissolve()
{
    GameDissolve.super(this);
    var userdata = [];//游戏人物
    var __proto__ = GameDissolve.prototype;
    var fontcolors;//字体颜色
    var showtexts;//显示提示文字
    var userarray = {};
    var count_down_num = 20; // 解散倒计时数字，单位：秒
    var user_operation = this.user_operation;
	var uid=userinfo.id;
    //初始化函数
    __proto__.init = function(array,userid)
    {
		this.reciprocal.timer.clearAll(this);
		
        this.agree.on(Laya.Event.CLICK, this , function(){
            //点击同意事件
            send({action:'game_dissolve',status:1,game_sign:'Against'});
			this.actiongroup.removeSelf();
            
        });
        this.refuse.on(Laya.Event.CLICK, this , function(){
            //点击不同意事件
            send({action:'game_dissolve',status:0,game_sign:'Against'});
			this.actiongroup.removeSelf();
        });

        var i = 0;
        for(var k in array)
        {
            if(userid == k) user_operation.text = array[k].nickname+'发起解散房间';

            userSprite = new Sprite();
            userSprite.x=184;
            userSprite.y=280+i*80;
            this.addChild(userSprite);
            (userid == k || array[k].status==1) ? showtexts = '已同意解散房间':showtexts = '等待确认中....';
            (userid == k || array[k].status==1) ? fontcolors = '#28a800':fontcolors = '#b44f00';
            headpath= new Images();
            headpath.name="headpath";
            headpath.skin=array[k].headpath;
            headpath.x=0;
            headpath.y=0;
            headpath.size(88,88);
            userSprite.addChild(headpath);

            var nickname = new Text();
            nickname.x=117;
            nickname.y=22;
            nickname.text=array[k].nickname;
            nickname.bold = 'true';
            nickname.name="nickname";
            nickname.size(291,63);
            nickname.color = "#b44f00";
		    nickname.font = "Microsoft YaHei";
		    nickname.fontSize = 40;
            userSprite.addChild(nickname);

            var showtext = new Text();
            showtext.x=444;
            showtext.y=22;
            showtext.bold = 'true';
            showtext.name="showtext";
            showtext.text = showtexts;
            showtext.size(448,63);
            showtext.color = fontcolors;
		    showtext.font = "Microsoft YaHei";
		    showtext.fontSize = 40;
            userSprite.addChild(showtext);
            userarray[k]=userSprite;
            i++;
        }
		if(userid==uid) this.actiongroup.removeSelf();
		this.popup();
		this.count_down();
		
    }
    __proto__.count_down = function()
    {
        this.reciprocal.text = count_down_num;
        this.reciprocal.timerLoop(1000, this, function(){
			    num=this.reciprocal.text;
				num=num-1;
				
                if(num>=0)
				{
					this.reciprocal.text=num;
				}
				else
				{
					this.reciprocal.timer.clearAll(this);
					send({action:'game_dissolve',status:2,game_sign:'Against'});	

				}
				
        });		
    }
    __proto__.dissolve_action = function(array,status)
    {
        //status 1同意 0不同意 2时间到自动解散 3发起解散房间 5房间解散
		
        if(status == 1)
        {
			showtext=userarray[array.id].getChildByName("showtext");
            showtext.text = '同意了解散房间';
            showtext.color = '#28a800';
            if(array.id==uid) this.actiongroup.removeSelf();
        }
        if(status == 0)
        {
			alert(array.id)
			this.reciprocal.timer.clearAll(this);
			showtext=userarray[array.id].getChildByName("showtext");
            showtext.text = '拒绝解散房间';
            showtext.color = '#ff0000';
            this.close();  
        }
		
        if(status == 5)
        {
            this.close(); 
			send({action:'game_complete',game_sign:'Against'});
        }      
    }
}
Laya.class(GameDissolve, "GameDissolve", GameDissolveUI); 
