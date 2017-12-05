            // JavaScript Document
/********************************************************************
 **游戏选择
********************************************************************/

function Minghua(room_id)
{
		GL(GC.Gltime,"加载超时，请重新操作","正在拼命加载中");
		
	    GC.MjImg=GC.ResPath+"linfen_4_mj/"+GC.MJT +"/img/";
		//var loadRoom = [{url: GC.MjImg+"bg/tablebg.png",type: Loader.IMAGE},{url: GC.MjImg+"room/room.json",type: Loader.ATLAS},{url: GC.ResPath+"majiang/majiang.json",type: Loader.ATLAS},{url: GC.ResPath+"majiang/bg/majiangbg.json",type: Loader.ATLAS},{url: GC.MjImg+"room/mjcurrentgains.json",type: Loader.ATLAS},{url: GC.MjImg+"room/public.json",type: Loader.ATLAS},{url: GC.MjImg+"room/mjgains.json",type: Loader.ATLAS},{url: GC.MjImg+"room/mjroomset.json",type: Loader.ATLAS},{url: GC.MjImg+"room/mjdissolve.json",type: Loader.ATLAS},{url: GC.MjImg+"room/mjtotlerecord.json",type: Loader.ATLAS}];
		var loadRoom = [{url: GC.MjImg+"bg/tablebg.png",type: Loader.IMAGE},{url: GC.MjImg+"bg/bigDbg.png",type: Loader.IMAGE},{url: GC.MjImg+"bg/littleDbg.png",type: Loader.IMAGE},{url: GC.MjImg+"room/room.json",type: Loader.ATLAS}];

		Laya.loader.load(loadRoom, Handler.create(this, function(soundMJ){
			MJindex.TimeLine.destroy();
			MJindex.destroy();
			MJindex = null;
			GMJRoom = null;
			GMJRoom = new MJRoom();
			GMJRoom.init(room_id);
			Laya.stage.addChild(GMJRoom);
		}), null, Loader.TEXT); //加载下页面的UI
}

function MJRoom()
{
    MJRoom.super(this);
	
	this.Config=null;
	this.room={};//当前房间信息
	this.usersSprite=[];
	this.socket=null;
	this.sendData=null;//要发送的数据
	
	this.times=0;//变化时间
	
	this.tipsSprite=null;
	
	this.MJCurrentGains=null;//游戏结束 本局弹出框
	this.MJTotalGains=null;//游戏结束 总战绩弹出框
	this.MJRoomSet=null;//弹出游戏房间设置
	this.MJChat = null;//弹出聊天室
	this.soundMJ = {b:{},g:{}};//存放声音地址
	this.userSex={};//存放玩家性别
	this.RoomShow = null;
	this.dissolve=null;//存放玩家性别
	this.soundAgin =null;//语音标识
	
	this.cards=null;
	this.socketStatus=0;
	var __proto__ = MJRoom.prototype;

    __proto__.init = function(room_id,soundMJ)
    {
		  this.txtRoomSn.text = "";
		  this.room.id = room_id;
		  this.room.userNum = 4;
          this.imgShow.removeSelf();
		  this.butButtons.removeSelf();
		  this.selectDirection.removeSelf();
		  
		 // this.setSelectDirection(1,20);
		  
		  this.butBack.on(Event.CLICK, this,this.OnBack);
		  this.butRoomSet.on(Event.CLICK, this,this.OnRoomSet);
		  this.butMessage.on(Event.CLICK, this,this.OnMessage);
		  this.butRoomShow.on(Event.CLICK, this,this.OnRoomShow);
		  this.butPosition.on(Event.CLICK, this,this.OnPosition);
		  
		  this.butRequestFriend.on(Event.CLICK, this,this.OnRequestFriend);

		  
		  this.usersSprite=[{user:this.userHead_0,point:{x:60,y:250},ready:this.imgReady_0,discardSprite:this.discardLeftSprite,cardsSprite:this.cardsLeftSprite},{user:this.userHead_1,point:{x:60,y:450},ready:this.imgReady_1,discardSprite:this.discardDownSprite,cardsSprite:this.cardsDownSprite},{user:this.userHead_2,point:{x:1200,y:200},ready:this.imgReady_2,discardSprite:this.discardRightSprite,cardsSprite:this.cardsRightSprite},{user:this.userHead_3,point:{x:972,y:15},ready:this.imgReady_3,discardSprite:this.discardTopSprite,cardsSprite:this.cardsTopSprite}]; 

		
		  soundArray={1:'1Wan',2:'2Wan',3:'3Wan',4:'4Wan',5:'5Wan',6:'6Wan',7:'7Wan',8:'8Wan',9:'9Wan',11:'1Tiao',12:'2Tiao',13:'3Tiao',14:'4Tiao',15:'5Tiao',16:'6Tiao',17:'7Tiao',18:'8Tiao',19:'9Tiao',21:'1Bing',22:'2Bing',23:'3Bing',24:'4Bing',25:'5Bing',26:'6Bing',27:'7Bing',28:'8Bing',29:'9Bing',31:'DongFeng',32:'NanFeng',33:'XiFeng',34:'BeiFeng',41:'HongZhong',42:'LvFa',43:'BaiBan',51:"Gang_01",52:"Gang_02",53:"Gang_03",54:"Gang_04",61:"Hu_01",62:"Hu_02",71:"Peng_01",72:"Peng_02",73:"Peng_03",74:"Peng_04",81:"Ting_01",82:"Ting_02",83:"Ting_03",84:"Ting_04",91:"ZiMo_01",92:"ZiMo_02",93:"ZiMo_03",94:"ZiMo_04"};
		
		  for(var key in soundArray)
		  {
				 this.soundMJ['b'][key] = "b_"+soundArray[key]+".mp3";
				 this.soundMJ['g'][key] = "g_"+soundArray[key]+".mp3";		
		  }
		  soundArray=null;
				 
		  this.c_socket(0);  
    }
	
	/*连接socket*/
    __proto__.c_socket= function(socketStatus)
    {
			if(this.Config)
			{
				this.c_socket_connect(socketStatus);					  
			} 
			else
			{
				C = new HttpRequest();
				C.once(Event.COMPLETE, this,this.c_socket_connect,[socketStatus]);
				C.send('/index.php/Games/Games/config.php', null, 'get', 'json');				
			}		
    }
	
    __proto__.c_socket_connect = function(socketStatus)
    {	
			this.Config=this.Config?this.Config:C.data;
			var wsUrl="ws://"+this.Config.server+":"+this.Config.port+"/index.php/Games/server/server.php";
			this.socket = new Socket();
			this.socket.disableInput=false;
			this.socket.connectByUrl(wsUrl);
	
			this.socket.on(Event.OPEN, this, this.OnSocketOpen,[socketStatus]);
	
    }	
	
    /*当socket连接成功*/
	__proto__.OnSocketOpen=function(socketStatus){
		  //var recome_room = arguments[0] ? arguments[0] : 0;//重新连接标识
		  this.socket.on(Event.MESSAGE, this, this.OnMessageReveived);
		  this.socket.on(Event.CLOSE, this, this.OnSocketClose);
		  this.socket.on(Event.ERROR, this, this.OnConnectError);
		  if(!socketStatus) this.butReady.on(Event.CLICK, this,this.OnReady);
		  this.send({action:'set',uid:GU.id,name:GU.id,pass_pre:GU.pass_pre,socketStatus:socketStatus});
          GshowTapeButtom(1);//隐藏语音按钮
		  if(this.sendData)
		  {
			  this.send(this.sendData);
			  this.sendData=null;
		  } 
		  if(Gl.isPopup) GL(-1);
	}	
	
    /*当接受的信息*/
	__proto__.OnMessageReveived=function(data){
		  var userNum=this.room.userNum;//玩家数
		  var uid=GU.id;
		  var usersSprite=this.usersSprite;//存放用户信息容器
		  var message = JSON.parse(data);
		  var FID=message.f_uid;// 发送用户的ID
		  var action = message.action;
		  var position = message.position;
		  var users=message.users;
		  
		  switch(action)
		  {
			  
			   case 'not_room'://房间不存在
					 this.del();
					 GT("房间不存在或者被删除",GC.Gttime);
			   		 break;
			   case 'not_user'://用户不存在
					 this.del();
					 GT("用户不存在或者被删除",GC.Gttime);
			   		 break;
			   case 'room_full'://用户不存在
					 this.del();
					 GT("对不起！房间已满",GC.Gttime);
			   		 break;
			   case 'come_room'://加入房间
			         this.room.position=users[uid].position;//当前用户位置
					 this.room.zhuang=message.zhuang;//当前游戏庄
					 this.room.zhuangPosition=message.zhuangPosition;
					 this.room.room_sn=message.room_sn;// 游戏房间号
					 this.room.game_num=message.game_num;//当前游戏局数
					 this.room.game_num_total=message.game_num_total;//游戏总局数
					 this.room.game_type=message.game_type;//游戏类型
					 this.room.start_uid=message.start_uid;//当前房间房主
					 this.room.payment_method=message.payment_method;//支付方式
                     this.txtRoomSn.text = "房号:"+this.room.room_sn;
					 this.listUsers(users,0);
			   		 break;
			   case 'recome_room'://重新连接房间
			         var uid=GU.id;
					 socketStatus = message.socketStatus;
					 
					 if(!socketStatus)
					 {
							   if(uid != FID)//表示重新连接的玩家
							   {
									   if(!status) this.listUsers(users,0);			 
							   }
							   else
							   {
									   this.room.position=users[uid].position;//当前用户位置
									   this.room.zhuang=message.zhuang;//当前游戏庄
									   this.room.zhuangPosition=message.zhuangPosition;//庄家位置
									   this.room.room_sn=message.room_sn;// 游戏房间号
									   this.room.game_num=message.game_num;//当前游戏局数
									   this.room.game_num_total=message.game_num_total;//游戏总局数
									   this.room.game_type=message.game_type;//游戏类型
									   this.room.start_uid=message.start_uid;//当前房间房主
									   this.room.payment_method=message.payment_method;//支付方式
									   this.txtRoomSn.text = "房号:"+this.room.room_sn;
									   
									   var starId=this.room.start_uid;
									   var game_num=this.room.game_num;
									   var userNum=this.room.userNum;//玩家数
									   var userPosition=this.room.position;
									   
									   cardsNum = message.cardsNum;//剩余排数
									   cards = message.cards;//玩家每个人的牌
									   pre = message.pre;//上一个出牌玩家位置
									   draw = message.draw;//听牌数据
									   touchCard = message.touchCard;//最后所摸的牌
									   status = message.status;//游戏状态
									   hua = message.hua;//游戏状态
									   discardCards = message.discardCards;
									   this.listUsers(users,status);							 
									   
									   if(status>0)//装备完成
									   {
											   for(var i in users) 
											   { 
														 currentUser=users[i];
														 currentPosition=currentUser.position;
														 currentP=(userNum-(userPosition-1)+currentPosition) % userNum;	
														 
														 usersSprite = this.usersSprite[currentP];
														 
														 if(draw  && draw[i])
														 {
															  ImgDraw = new Images("room/but_hand_ready_small.png");
															  ImgDraw.name = "draw";
															  usersSprite.user.addChild(ImgDraw);						
														 }			         
														 discardSprite = usersSprite.discardSprite; //出牌的容器 
														 cardsSprite = usersSprite.cardsSprite; //玩家牌的容器
													   
														 discardSprite.destroyChildren();
														 cardsSprite.destroyChildren(); 
														 this.updateUserCards(currentP,cards[i]) ;
														 if(cards[i].cards) this.cards = cards[i].cards;
														 
														 if(discardCards && discardCards[i])
														 {
															   for(var k in discardCards[i])
															   {
																   this.discard(currentP,discardCards[i][k]);
															   }
														 }
											   }	
											  
											   this.gameStart();
											   this.setRoomNum(1,cardsNum);
											   this.showHuaCard(0,hua);	
																
											   switch(status)
											   {
													  case "1":
															zhuangPosition =message.zhuangPosition;
															zhuangP=(userNum-(userPosition-1)+zhuangPosition) % userNum;
															if(zhuangP == 1) 
															{
																 if(this.cards.length == 13)
																 {
																	 this.upDateCardsOff(1);//移除绑定事件
																	 this.send({action:'game_touch'});
																 } 
															}
															else
															{
																 this.upDateCardsOff(1);//移除绑定事件
															}
															this.setSelectDirection(zhuangP,10);
															break;
													  case "2":
														   zhuangPosition =message.zhuangPosition;
														   zhuangP=(userNum-(userPosition-1)+zhuangPosition) % userNum;
						  
														   if(zhuangP != 1 )
														   {
																this.upDateCardsOff(1);//移除绑定事
																this.touchcard(zhuangP);
														   }
														   this.setSelectDirection(zhuangP,10);
														   break;
													  case "3":
														   nextPosition = pre >= userNum? 1 : pre+1;
														   nextP=(userNum-(userPosition-1)+nextPosition) % userNum;
														   if(this.cards.length != 13)
														   {
																	mjaign = message.mjaign;//是否有碰杠
																	if(mjaign)
																	{
																		 if(mjaign.uid == GU.id)
																		 {
																				if(mjaign.MJ=="MJ4")
																				{
																					 this.upDateCardsOff(1);
																					 this.showButtons([0,2,3]);
																				}
																				else if(mjaign.MJ=="MJ3")
																				{
																					 this.upDateCardsOff(1);
																					 this.showButtons([0,2]);
																				}  
																		 }
																		 else
																		 {
																			  this.upDateCardsOff(1);
																		 }
																		 this.setSelectDirection(1,10);
																	}
																	else
																	{
																		  if(nextP == 1) 
																		  {
																			  if(draw && draw[GU.id])
																			  {
																				   this.upDateCardsOff(1);
																				   Laya.timer.once(1000, this, function(){this.send({action:'game_discard',card:touchCard});},[touchCard]);
																			  }
																		  }
																		  else
																		  {
																			  this.upDateCardsOff(1);
																			  this.touchcard(nextP);
																		  }
																		  
																		  this.setSelectDirection(nextP,10);
																	}
															}	
															else
															{
																this.setSelectDirection(nextP,10);
															}	 			  
														break;
													  default:
											  }					 
									   }							 
							   }						 
					 }

			         break;
			   case 'game_ready'://准备游戏
					this.ready(position)
			        break;
			   case 'deal'://发牌
			        this.gameStart();  
			        hua=message.hua;
					hua_num=message.hua_num;
					this.cards=message.cards;
					
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					zhuangPosition=this.room.zhuangPosition;
					zhuangP=(userNum-(userPosition-1)+zhuangPosition) % userNum;
										
					this.setSelectDirection(zhuangP,10);				
					
					this.dealCards(zhuangPosition);

					this.showHuaCard(hua_num,hua);
			        break;
			   case 'game_touch'://游戏开始摸牌
					touchCard=message.touchCard;
					cardsNum = message.cardsNum//剩余牌数
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
					if(touchCard)
					{
						this.cards.push(touchCard);
						this.upDateCardsOff();//绑定事件
					}
					
					this.touchcard(currentP,touchCard);
					this.setRoomNum(1,cardsNum);
			        break;
			   case 'game_discard'://出牌
			        mjType=message.mjType;
					cards=message.cards;
					cardsNum = message.cardsNum//剩余牌数
					discardCard=message.discardCard;
					touchCard=message.touchCard;
					
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
					
					nextPosition = currentPosition>= userNum ? 1 : currentPosition+1;
					nextP = (userNum-(userPosition-1)+nextPosition) % userNum;
					
					if(currentP == 1 )
					{
						this.cards=cards;
						this.upDateCards(1);
					}
					this.nTouchcard(currentP); //销毁摸牌效果
					if(discardCard)
					{
							this.discard(currentP,discardCard); //显示出牌效果
						    var userType =this.userSex['p'+currentP]?"b":'g';  
						    if(discardCard != "N") soundPlay(this.soundMJ[userType][discardCard]) ;
						    //soundPlay(GC.SoundDapai) ; 
					}
					
					
					
					if(!mjType)
					{
						this.setSelectDirection(nextP,10);
						
						this.touchcard(nextP,touchCard);
						
						this.setRoomNum(1,cardsNum);
						
						MJ=message.MJ
						
						if(nextP == 1 )
						{
							 this.cards.push(touchCard);
							 win = message.win;
							 draw = message.draw;
							 isDraw = message.isDraw;
							 this.upDateCardsOff(1);//解除出牌事件

							 buttons=[0];
							 if(win) buttons.push(1);
							 if(MJ) buttons.push(3);
							 if(draw) buttons.push(4);
							 
							 if(MJ || draw || win)
							 {
								     if(isDraw)
									 {
										 this.showButtons(buttons,MJ,2);
									 }
									 else
									 {
										 this.showButtons(buttons,MJ,1);
									 }   
							 }
							 else 
							 {      
									 if(isDraw)
									 {
										 this.upDateCardsOff(2);
										 Laya.timer.once(500, this, function(){this.send({action:'game_discard',card:touchCard});},[touchCard]);
									 }
									 else
									 {
										 this.upDateCardsOff(); 
									 }	 
							 }	
							 							 
						}
					}
					else
					{
						if(mjType=="MJ4")
						{
							 this.upDateCardsOff(1);
							 this.showButtons([0,2,3]);
						}
						else if(mjType=="MJ3")
						{
							 this.upDateCardsOff(1);
							 this.showButtons([0,2]);
						}
					}
			        break;
			   case 'game_pass'://点过
			        touchCard=message.touchCard;
					cards=message.cards;
					cardsNum = message.cardsNum//剩余牌数

			   		userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
					
					
					if(cards && currentP == 1)
					{
						  this.cards = cards;
						  this.upDateCards(1);
						  this.cards.push(touchCard);
					}
					
					this.touchcard(currentP,touchCard);
					this.setRoomNum(1,cardsNum);
                    this.setSelectDirection(currentP,10);
					
					if(currentP == 1)
					{
					      MJ=message.MJ;
						  win=message.win;
					      draw=message.draw;
						  
						  buttons=[0];
						  if(win) buttons.push(1);
						  if(MJ) buttons.push(3);
						  if(draw) buttons.push(4);
						  
						  if(MJ || win || draw)
						  {
							  this.upDateCardsOff(1);//解除出牌事
							  this.showButtons(buttons,MJ,1);
						  }
						  else
						  {
							   isDraw = message.isDraw;
							   if(isDraw)
							   {
								   this.upDateCardsOff(2);
								   Laya.timer.once(500, this, function(){this.send({action:'game_discard',card:touchCard});},[touchCard]);
							   }
							   else
							   {
								   this.upDateCardsOff(); 
							   } 	
						  }						
					}
			        break;
			   case 'game_show_cards'://有杠 显示杠按钮
					cards=message.cards;
					cardsNum = message.cardsNum//剩余牌数
					opType = message.opType//1表示杠，2表示碰
					
					win=message.win;
					draw=message.draw;
					touchCard=message.touchCard;
					
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;

					prePosition = message.prePosition; //上一个位置
					
					if(prePosition)//移除碰杠打出去的牌
					{
						 preP=(userNum-(userPosition-1)+prePosition) % userNum;
						 this.nDiscard(preP);
					}
					
					this.updateUserCards(currentP,cards);
					
					if(cards.cards) this.cards=cards.cards;
					
					if(touchCard) 
					{
							this.touchcard(currentP,touchCard);
							this.cards.push(touchCard);
							this.setRoomNum(1,cardsNum);	
					}
					
					if(currentP == 1 )
					{
							  isDraw=message.isDraw; //是否听牌
							  MJ=message.MJ;
							  win=message.win;
							  draw=message.draw;
							  isDraw = message.isDraw;
							  
							  buttons=[0];
							  if(win) buttons.push(1);
							  if(MJ) buttons.push(3);
							  if(draw) buttons.push(4);
							  
							  if(MJ || win || draw)
							  {
								   this.upDateCardsOff(1);//解除出牌事
								   this.showButtons(buttons,MJ,1);
							  }
							  else
							  {
									if(isDraw)
									{
										this.upDateCardsOff(2);
										Laya.timer.once(500, this, function(){this.send({action:'game_discard',card:touchCard});},[touchCard]);
									}
									else
									{
										this.upDateCardsOff();
									}
							  }
					}
					
					opType =  opType==1 ? 50 : 70;
					if(opType > 45)
					{
	                      var userType =this.userSex['p'+currentP]?"b":'g';
						  var soundType =opType + (parseInt(Math.random()*4,10)+1);  
						  soundPlay(this.soundMJ[userType][soundType]) ;						
					}
	
					this.setSelectDirection(currentP,10);
			        break;
			   case 'game_draw'://听牌
					draw=message.draw;
					if(draw == 1)
					{
						this.upDateCardsOff();//解除出牌事
					}
					else
					{
						this.upDateCardsOff(draw);//解除出牌事
					}
			        break;
			   case 'game_draw_prompt'://听牌提示
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;	
					if(currentP != 1)
					{
						  user = usersSprite[currentP];
						  ImgDraw = new Images("room/but_hand_ready_small.png");
						  ImgDraw.name = "draw";
						  user.user.addChild(ImgDraw);						
					}
					
					var userType =this.userSex['p'+currentP]?"b":'g';
					var soundType =80 + (parseInt(Math.random()*4,10)+1);  
					soundPlay(this.soundMJ[userType][soundType]) ;
			        break;
			   case 'game_win'://胡牌
			        userDate = message.data;
					userPoint = message.point;
					GL(GC.Gltime,"加载超时","数据加载中");
					
					if(!this.MJCurrentGains) this.MJCurrentGains = new MJCurrentGains();
					this.MJCurrentGains.init(userDate,this);
					this.MJCurrentGains.popup();

					this.room.game_num=this.room.game_num+ 1;//当前游戏局数
					this.room.zhuang=message.zhuang;//当前庄	
					this.room.zhuangPosition=message.zhuangPosition;//当前庄			
					
					GL(-1);
					
					userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;

					var userType =this.userSex['p'+currentP]?"b":'g';
					var soundType =60 + (parseInt(Math.random()*2,10)+1);  
					soundPlay(this.soundMJ[userType][soundType]) ;
					
					 for(var Uposition in userPoint) 
					 {
						 currentPosition=parseInt(Uposition);
						 currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
						 USprite=this.usersSprite[currentP];
						 user=USprite.user;
						 user.getChildByName("txt_point").text=userPoint[Uposition];	
					 }					
					
					break;
			   case 'game_dogfall'://胡牌
			        //alert(data)
			        userDate = message.data;
					GL(GC.Gltime,"加载超时","数据加载中");
					
					if(!this.MJCurrentGains) this.MJCurrentGains = new MJCurrentGains();
					this.MJCurrentGains.init(userDate,this);
					this.MJCurrentGains.popup();

					this.room.game_num=this.room.game_num+ 1;//当前游戏局数
					this.room.zhuang=message.zhuang;//当前庄	
					this.room.zhuangPosition=message.zhuangPosition;//当前庄			
					
					GL(-1);
					/*userPosition=this.room.position;
					userNum=this.room.userNum;//玩家数
					currentPosition=message.position;
					currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
					
					var userType =this.userSex['p'+currentP]?"b":'g';
					var soundType =60 + (parseInt(Math.random()*3,10)+1);  
					soundPlay(this.soundMJ[userType][soundType]) ;*/
					break;
			   case 'game_gains'://本场游戏完成，查看中战绩
			        //alert(data)
			        userDate = message.data;
					GL(GC.Gltime,"加载超时","数据加载中");
					
					if(!this.MJTotalGains) this.MJTotalGains = new MJTotleRecord();
					this.MJTotalGains.init(userDate,this);
					this.MJTotalGains.popup();//弹出总战绩
					
					GL(-1);
					break;
			   case 'game_dissolve'://本场游戏完成，查看中战绩
			        status = message.status;
					users = message.users;
					dissolveUid = message.dissolve;
					if(!this.dissolve) this.dissolve = new MJDissolve(); 
					switch(status)
					{
						  case "3" :
						         if(!this.dissolve.isPopup)
								 {
									 this.dissolve.init(this,users,dissolveUid);
						             this.dissolve.popup();
								 }
								 break;
						  case "5" :
						         if(this.dissolve.fun)
								 {
									  this.dissolve.txtReciprocal.timer.clear(this.dissolve, this.dissolve.fun);
									  this.dissolve.fun = null;
								 } 
						  		 this.dissolve.close();	
							     this.send({action:'game_gains'});;	
							break;
						  case "6" :
						         GT("房主解散了房间",GC.Gttime);
								 this.del();
							     break;
						  default:
						         this.dissolve.dissolve_action(users,status);
					}						
			        break;
			   case 'game_back'://返回退出游戏
			        currentPosition = message.position;
					start_uid = this.room.start_uid;//当前房间房主;
					if(position)
					{
						  var userNum=this.room.userNum;//玩家数
						  var userPosition=this.room.position;
                          
						  if(FID != start_uid)
						  {
	                            currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
								USprite=this.usersSprite[currentP];
								user=USprite.user;
								ready=USprite.ready;
								user.getChildByName("txt_name").text="";
								user.getChildByName("txt_point").text=0;	
								user.getChildByName("img_head").skin="";	
								user.getChildByName("img_zhuang").alpha=0;
								user.getChildByName("img_room").alpha=0;
								if(user.contains(ready)) ready.removeSelf();							  
						  }
						  if(currentP == 1)this.del();				  
					}
					else
					{
						 GT("游戏开始，请先解散房间",GC.Gttime);
					}
			        break;
			   case 'game_message'://返回退出游戏
			        //alert(data)
                    MPosition = message.position
					soundPath = message.path;
				    var userNum=this.room.userNum;//玩家数
				    var MuserPosition=this.room.position;
					McurrentP=(userNum-(MuserPosition-1)+MPosition) % userNum;
					USprite=this.usersSprite[McurrentP];
					user=USprite.user;
					userPiont = {x:user.x,y:user.y};//USprite.point;//
					if(!this.MJChat) this.MJChat = new MJChat();
					if(soundPath)
					{
						 soundPlay(soundPath,5,McurrentP)
						 userPiont.p=McurrentP;
						 this.MJChat.play_sound(userPiont); 
					}
					
					this.MJChat.ShowMessage(message,userPiont,McurrentP,this.userSex['p'+McurrentP]);  
			        break;
			   default:
		  }
	}	 
    /*销毁对象自身*/
	__proto__.del=function(){
		  GshowTapeButtom(0);//隐藏语音按钮
		  Dialog.manager.closeAll();
		  //if(this.MJChat && this.MJChat.isPopup) this.MJChat.close();
		  this.socket.close();
		  //this.socket.cleanSocket();
		  this.destroy();
		  MJindex = new MJIndex(); 
		  MJindex.init();
	 } 
    /*当socket连接成功*/
	__proto__.send=function(msg){
		  if(!this.socket.connected)
		  {
			  this.checkSocket();
			  this.sendData=msg;
		  }
		  else
		  {
			  msg['room_id']=this.room.id;
			  msg['game_sign']='Minghua';
			  this.socket.send(JSON.stringify(msg));
		  }
	 }  
/*	__proto__.OnSocketClose=function(){
		  this.checkSocket();
	 }*/
	 
	 
	__proto__.OnConnectError=function(){
          this.checkSocket();
	 } 
	 
	__proto__.checkSocket=function(){
		   
		   if(!this.socket.connected && !Gl.isPopup)
		   {
			    GL(0,null,"正在连接中");
				this.c_socket(1);
			    Laya.timer.loop(2000, this, this.checkSocket);
		   }
		   else
		   {
			   if(this.socket.connected) 
			   {
				   Laya.timer.clear(this,this.checkSocket);
				   if(Gl.isPopup || !this.socket) Gl.close();
				   return false;
			   }
			   this.c_socket(1);
		   }
	 }
    /*显示玩家列表*/
    __proto__.listUsers= function(users,status)
    {
		   var uid=GU.id;
		   var starId=this.room.start_uid;
		   var game_num=this.room.game_num;
		   var userNum=this.room.userNum;//玩家数
		   var userPosition=this.room.position;
		   var readyNum=0;
		   this.room.usersid = {};
		   this.initUsersSprite("all");
		   for(var i in users) 
		   {
			   currentUser=users[i];
			   currentPosition=currentUser.position;
			   currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
			   
			   this.userSex['p'+currentP] = currentUser.sex=="1"?1:0;
			   USprite=this.usersSprite[currentP];
			   
			   user=USprite.user;
			   

			   ready=USprite.ready;
			   user.getChildByName("txt_name").text=currentUser.nickname;
			   user.getChildByName("txt_point").text=currentUser.point;	
			   user.getChildByName("img_head").skin=currentUser.headpath;	
			   user.getChildByName("img_zhuang").alpha=0;
			   
			   if(currentUser.userid == starId) user.getChildByName("img_room").alpha=1;
			   
			   if(currentUser.userid != uid) this.room.usersid[i]=currentUser.userid;

			   if(currentUser.R==game_num)
			   {
					if(!user.contains(ready) && status==0) user.addChild(ready);
					if(currentP==1) this.butReady.removeSelf();
			   }
			   else
			   {
					if(user.contains(ready)) ready.removeSelf();
			   }				   


		   }
		   
		   this.setZhuang();                
    }	
	/*准备完成*/
    __proto__.gameStart = function()
    {
		     
             if(this.contains(this.butRequestFriend)) this.butRequestFriend.removeSelf();
		     if(this.contains(this.butReady)) this.butReady.removeSelf();
			 		     
			 for(var i in this.usersSprite) 
			 {
                 USprite=  this.usersSprite[i];
				 point=USprite.point;
				 user=USprite.user;
				 
				 user.x = point.x;
				 user.y = point.y;

				 /*Tween.to(USprite.user,
				 {
					x: point.x,
					y: point.y
				 }, 500);*/

				 ready=USprite.ready;
				 if(user.contains(ready)) ready.removeSelf();
				 
				 user.getChildByName("txt_name").alpha=1;
				 user.getChildByName("txt_point").alpha=1;	
				 user.getChildByName("txt_point_bg").alpha=1;
			 }  
			 
			 this.setRoomNum(2);//设置游戏局数	     
    }
	/*重新开始*/
    __proto__.restart = function()
    {     
			 for(var i in this.usersSprite) 
			 {
                 USprite=  this.usersSprite[i];
				 USprite.discardSprite.destroyChildren();
				 USprite.cardsSprite.destroyChildren();
				 USprite.cardsSprite.destroyChildren();
				 if(this.contains(this.tipsSprite)) this.tipsSprite.removeSelf();
				 this.selectDirection.removeSelf();
				 
				 user=USprite.user;
				 ready=USprite.ready;
				 if(user.contains(ready)) ready.removeSelf();
				 user.getChildByName("img_zhuang").alpha=0;	
				 if(user.contains(user.getChildByName("draw"))) user.getChildByName("draw").destroy();	
			 }  
			 
			 this.imgShow.removeSelf(); 
			 this.setRoomNum(2);
			 this.setZhuang();
			 
    }
	/*准备效果*/
    __proto__.ready = function(position)
    {
		 var userNum=this.room.userNum;//玩家数
		 var userPosition=this.room.position;
		 var currentP=(userNum-(userPosition-1)+position) % userNum;
		 
         var USprite=this.usersSprite[currentP];
		 user=USprite.user;
		 ready=USprite.ready
		 user.addChild(ready)
         
		 if(currentP==1)  this.butReady.removeSelf();     
    }	
	/*显示花牌*/
    __proto__.showHuaCard = function(cardNum,card)
    {
		 if(!this.contains(this.imgShow))  
		 {
			   this.addChild(this.imgShow);
			   if(card)
			   {
				   cardImg=this.imgShow.getChildByName("cardImg");
				   if(this.imgShow.contains(cardImg))
				   {
					   cardImg.skin=this.getCard(card);
				   }
				   else
				   {
					   cardImg=new Images();
					   cardImg.skin=this.getCard(card);
					   cardImg.x=2;
					   cardImg.y=0;
					   cardImg.name="cardImg";
					   cardImg.scale(0.6,0.6);
					   this.imgShow.addChild(cardImg);
				   }
			   }
		 }
		 else
		 {
			   if(card)
			   {
					 cardImg=this.imgShow.getChildByName("cardImg");
					 if(this.imgShow.contains(cardImg))
					 {
						 cardImg.skin=this.getCard(card);
					 }
					 else
					 {
						 cardImg=new Images();
						 cardImg.skin=this.getCard(card);
						 cardImg.x=2;
						 cardImg.y=0;
						 cardImg.name="cardImg";
						 cardImg.scale(0.6,0.6);
						 this.imgShow.addChild(cardImg);
					 }
			   }			 
		 }   
    }
	/*设置庄*/
    __proto__.setZhuang = function()
    {
		 var zhuang =  this.room.zhuang; 
		 var zhuangPosition =  this.room.zhuangPosition; 
		 var userNum=this.room.userNum;//玩家数
		 var userPosition=this.room.position; 

		 currentP=(userNum-(userPosition-1)+zhuangPosition) % userNum;
		 //alert(currentP+"/"+zhuangPosition)
		 USprite=this.usersSprite[currentP];
		 user=USprite.user;
		 user.getChildByName("img_zhuang").alpha=1;
		 
    }
	/*当点击准备按钮的事件*/
    __proto__.OnReady = function()
    {
          this.send({action:'game_ready'});
		  soundPlay(GC.SoundClick)           
    }
	/*当点击邀请好友的事件*/
    __proto__.OnRequestFriend = function()
    {
		     var title = "";
			 var ico = "http://demo.cowcms.com/Public/css_js_font_img/games/games/mb2/img/logo.png";
			 var url = "https://xcx.78wa.com/dapp/dapp.html";
		     var describe = "规则: ";
			 game_num_total = this.room.game_num_total;//游戏总局数
			 payment_method = this.room.payment_method;//支付方式
			 room_sn = this.room.room_sn; 
			 game_type = this.room.game_type;//游戏类型
			 
			 
			 describe = describe +(game_type == 1 ? "明花" : "不明花");
			 
			 if(payment_method.type == 0)
			 {
				 describe = describe + "，房主("+ payment_method.point +"房卡)";
			 }else if(payment_method.type == 1)
			 {
				 describe = describe + "，均摊("+ payment_method.point +"房卡)";
			 }else
			 {
				 describe = describe + "，大赢家("+ payment_method.point +"房卡)";
			 }
			 
			 describe = describe + "，"+game_num_total+" 局,欢迎加入【汾西明花】";
			 title = "汾西明花【"+room_sn+"】";

			 wx_share(1, {ico:GC.SiteUrl+'/Public/css_js_font_img/games/games/mb2/img/logo.png',url:'https://xcx.78wa.com/dapp/dapp.html',title:title,describe:describe,type:'1'});

			 soundPlay(GC.SoundClick)   
    }
	/*当点击返回按钮的事件*/
    __proto__.OnBack = function()
    {
          this.send({action:'game_back'});  
		  soundPlay(GC.SoundClick)        
    }
	/*当点击三角形按钮*/
    __proto__.OnRoomShow = function()
    {

		   game_num_total=this.room.game_num_total;//游戏总局数
		   game_type=this.room.game_type;//游戏类型
		   payment_method = this.room.payment_method;//支付方式	
				  
		   if(payment_method.type == 0)
		   {
			   payment_method_str = "房主("+ payment_method.point +"房卡)";
		   }else if(payment_method.type == 1)
		   {
			   payment_method_str ="均摊("+ payment_method.point +"房卡)";
		   }else
		   {
			   payment_method_str = "大赢家("+ payment_method.point +"房卡)";
		   }
		   
		   game_type=game_type==1?"明花":"不明花";
		   
		   p = {CardNum:game_num_total+"局",'PayWay':payment_method_str,'PlayType':game_type,'position':{x:50,y:80}};
		   this.RoomShow = new MJRoomInfo();
		   this.RoomShow.init(p);
		   this.addChild(this.RoomShow);		

    }
    __proto__.OnPosition = function()
    {
		   usersid=this.room.usersid;//玩家id
		   if(!this.IpShow) this.IpShow = new MJIpShow();
		   this.IpShow.init(usersid);
		   this.IpShow.popup();
    }	
	
		
	
    /*点击房间设置*/
    __proto__.OnRoomSet = function()
    {
		  if(!this.MJRoomSet)
		  {
			  this.MJRoomSet = new MJRoomSet();	  
		  	  this.MJRoomSet.init(this);
		  }
		  this.MJRoomSet.popup();  
		  soundPlay(GC.SoundClick)    
    }		
    /*点击聊天按钮*/
    __proto__.OnMessage = function()
    {
		  if(!this.MJChat) this.MJChat = new MJChat();	  
		  this.MJChat.init(this);
		  this.MJChat.popup();  
		  soundPlay(GC.SoundClick)    
    }
	/*初始化玩家头像信息*/
    __proto__.initUsersSprite = function(itme)
    {
			 for(var i in this.usersSprite) 
			 {
                 USprite=  this.usersSprite[i];
				 user=USprite.user;
				 ready=USprite.ready
				 if(itme=="all")
				 {
				     if(user.contains(ready)) ready.removeSelf(); 
					 user.getChildByName("img_zhuang").alpha=0; 
					 user.getChildByName("img_room").alpha=0;
				 }
				 else
				 {
					 if(itme=="ready" && user.contains(ready)) ready.removeSelf();  
					 if(itme=="zhuang") user.getChildByName("img_zhuang").alpha=0;;
					 if(itme=="starid")   user.getChildByName("img_room").alpha=0;					 
				 }

			 }                      
    }
	
	/*发牌*/
    __proto__.dealCards = function(position)
    {
			 var uid=GU.id;
			 var starId=this.room.start_uid;
			 var game_num=this.room.game_num;
			 var userNum=this.room.userNum;//玩家数
			 //var userPosition=this.room.position;
			 var userPosition=this.room.position;;
		     for(i=0;i<4;i++)
			 {
				   
				   for(k=0;k<userNum;k++) 
				   {
					   currentPosition=position+k;
	
					   currentPosition=(currentPosition % userNum == 0) ?　userNum : (currentPosition % userNum);
					   currentP=(userNum-(userPosition-1)+currentPosition) % userNum;
					   Laya.timer.once( (i * userNum + k) * 300, this, this.dealCardsResult,[currentP],false);
				   }
				 
			 }	                       
    }
		
	/*发牌效果*/
    __proto__.dealCardsResult = function(currentP)
    {
		  soundPlay(GC.SoundFapai) ;
		  USprite=this.usersSprite[currentP];
		  cardsSprite=USprite.cardsSprite;		
		  numChildren=cardsSprite.numChildren;
		  //alert(currentP)
          switch(currentP)
		  {
			  case 0:
				   cardsY=numChildren * 33;
				   cardsX=17;

				   addCardsNum=numChildren>=12?1:4;

				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(0,1);
					   
					   MJSprite.x=cardsX;
					   MJSprite.y=cardsY+ num * 33; 
					   cardsSprite.addChild(MJSprite);
				   }
				   
				   break;
			  case 1:
			      
				   if(numChildren>0)
				   {
					   CSprite=cardsSprite.getChildByName("cards");
					   numChildren=CSprite.numChildren;
				   }
				   else
				   {
					    var  CSprite= new  Sprite();
							 CSprite.x=0;
							 CSprite.y=0;
							 CSprite.name="cards";
							 cardsSprite.addChild(CSprite);	
							 addCardsNum=0;	 				   
				   }
				   
			       
				   cardsY=0;
				   cardsX=numChildren * 82;
				   addCardsNum=numChildren>=12?1:4;

				   for(num=0;num<addCardsNum;num++)
				   {
					   
					   index=numChildren+num;
					   MJSprite=this.createMJ(1,1,this.cards[index]);
					   MJSprite.x=cardsX + num * 82;
					   MJSprite.y=0; 

					   CSprite.addChild(MJSprite);
				   }
				   if(numChildren>=12)	
				   {
					   Laya.timer.once(500, this, this.showDown);
				   }			   
				   
				break;
			  case 2:
				   cardsY=496-(numChildren+1) * 33;
				   cardsX=17;
				   addCardsNum=numChildren>=12?1:4;

				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(2,1);
					   MJSprite.x=cardsX;
					   MJSprite.zOrder=14-numChildren-num;
					   MJSprite.y=cardsY - num * 33; 
					   cardsSprite.addChild(MJSprite);
				   }
				   break;			   
			  case 3:
				   cardsY=0;
				   cardsX=497-numChildren * 38;
				   addCardsNum=numChildren>=12?1:4;

				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(3,1);
					   
					   MJSprite.x=cardsX - num * 38;
					   MJSprite.y=0;
					   cardsSprite.addChild(MJSprite);
				   }				  
				
				break;
			  default:	
		  }            
    }	
	
	/*亮牌*/
    __proto__.showDown = function()
    {
		  CSprite=this.cardsDownSprite.getChildByName("cards");
		  cardsNum=CSprite.numChildren;
		  CSprite.destroyChildren();
		  
		  for(i=0;i<cardsNum;i++)
		  {
				   cardsX=i * 82;
				   cardsY=0;

				   MJSprite=this.createMJ(1,3);
				   
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY; 
				   CSprite.addChild(MJSprite);
		  }
		  
		  Laya.timer.once(500, this, this.upDateCards,[1]); 
		  soundPlay(GC.SoundLiangpai)
		  
		  if(GU.id==this.room.zhuang)
		  {
			   Laya.timer.once(800, this, function(){ this.send({action:'game_touch'}); }); 
		  }  
		                        
    }
	
	/*获取麻将牌*/
    __proto__.getCard = function(card)
    {
		  var type = arguments[1] ? arguments[1] : "big";
          if(card>9)
		  {
			   mjFileName="majiang/mahjong_tile_"+type+"_"+card+".png";
		  }
		  else
		  {
			   mjFileName="majiang/mahjong_tile_"+type+"_0"+card+".png";
		  }
		  
		  return mjFileName;	                       
    }
	
	/*刷新当前玩家的牌*/
    __proto__.upDateCards = function(banCards)
    {
		  var cards = this.cards;
		  
		  CSprite=this.cardsDownSprite.getChildByName("cards");
		  cards.sort( function(a,b){return a- b} );
		  
          CSprite.destroyChildren();
		  len=cards.length;
		  for(i=0;i<len;i++)
		  {
				   MJSprite=this.createMJ(1,1,cards[i]);
				   MJSprite.x=i * 82;
				   MJSprite.y=0;
				   MJSprite.name=i;
				   
				   if(!banCards)
				   {
					   MJSprite.once(Event.CLICK, this, this.OnDiscard);
				   }
				   CSprite.addChild(MJSprite);	   
		  }                
    }
	
	/*移除绑定事件*/
    __proto__.upDateCardsOff = function(type)
    {
		  var cards = this.cards;
		  discardSprite=this.cardsDownSprite.getChildByName("cards");		
		  numChildren=discardSprite.numChildren;
		  
		  
		  if(!type)
		  {

			   for(i=0;i<numChildren;i++)
			   {
					   MJSprite=discardSprite.getChildByName(i);
					   MJSprite.y=0;
					   MJSprite.once(Event.CLICK, this, this.OnDiscard);
			   } 			     
		  }
		  else if(type == 1)
		  {
			  	for(i=0;i<numChildren;i++)
				{
					   MJSprite=discardSprite.getChildByName(i);
					   MJSprite.offAll();
					   MJSprite.y=0;
				}
		  }
		  else if(type == 2)
		  {
			  	for(i=0;i<numChildren;i++)
				{
					 MJSprite=discardSprite.getChildByName(i);
					 MJSprite.y=0;
					 if(i == (numChildren -1)) 
					 {
					     MJSprite.once(Event.CLICK, this, this.OnDiscard);						   
					 }
					 else
					 {
						 MJSprite.offAll();						 
					 }
				}
		  }
		  else
		  {
			    obgType=(Object.prototype.toString.call(type) == '[object Array]')?true:false;
                if(obgType)
				{
					for(i=0;i<numChildren;i++)
					{
						 if(!inArray(cards[i],type))
						 {
							   MJSprite=discardSprite.getChildByName(i);
							   MJSprite.offAll();
							   MJSprite.y=0;
							   
							   cover=new Images("majiangbg/tile_face_bottom_stand_Z.png");	
							   MJSprite.addChild(cover);
							   cover.zOrder=10;
							   cover.x = 0;	
							   cover.y = 21;							 
						 }
						 else
						 {
							  MJSprite=discardSprite.getChildByName(i);
							  MJSprite.y=0;
							  MJSprite.once(Event.CLICK, this, this.OnDiscard);
						 }
					}					 
				}
		  }                
    }	
	
	/*当点击牌的时候*/
    __proto__.OnDiscard = function(e)
    {
          card = e.target;
		  var cards =  this.cards;
		  CSprite=this.cardsDownSprite.getChildByName("cards");
		  	  
		  if(CSprite.contains(card) && card.y<0)
		  {
			   this.send({action:'game_discard',card:cards[card.name]});
		  }
		  else if(CSprite.contains(card) && card.y>=0)
		  {
				cardsNum=CSprite.numChildren;	
				for(i=0;i<cardsNum;i++)
				{
					MJ=CSprite.getChildByName(i);
					if(CSprite.contains(MJ) && card.name == i)
					{
						MJ.y=-60;
						MJ.once(Event.CLICK, this, this.OnDiscard); 	
					}
					else
					{
						 MJ.y=0;
					}
				}			  
			  
		  }
    }	

	/*当点击牌的时候出牌效果*/
    __proto__.discard = function(currentP,card,e)
    {
		  USprite=this.usersSprite[currentP];
		  discardSprite=USprite.discardSprite;		
		  numChildren=discardSprite.numChildren;
		  //alert(currentP)
          switch(currentP)
		  {
			  case 0:
				   cardsX=parseInt(numChildren / 12) * 51;
				   cardsY=parseInt(numChildren % 12) * 34;
                   
				   if(card == "N")
				   {
					   MJSprite=this.createMJ(0,3);
				   }
				   else
				   {
					   MJSprite=this.createMJ(0,2,card);
				   }
				   
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY;
				   MJSprite.name = numChildren;
				   discardSprite.addChild(MJSprite);
				   
				   this.tips(cardsX+10,cardsY-30)
				   break;
			  case 1:
				   cardsX=parseInt(numChildren % 12) * 40;
				   cardsY=51-parseInt(numChildren / 12) * 49;
				   cardsO=5-parseInt(numChildren / 12);
				   
				   if(card == "N")
				   {
					   MJSprite=this.createMJ(3,3);
				   }
				   else
				   {
					   MJSprite=this.createMJ(1,4,card);
				   }
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY; 
				   MJSprite.zOrder=cardsO;
				   MJSprite.name = numChildren;
				   
				   /*MJSprite.addChild(MJBg);
				   MJSprite.addChild(MJ);*/

				   discardSprite.addChild(MJSprite);
				   
				   this.tips(cardsX,cardsY-20)	   
				   
				break;
			  case 2:
				   cardsX=51-parseInt(numChildren / 12) * 51;;
				   cardsY=parseInt(numChildren % 12) * 34;

				   if(card == "N")
				   {
					   MJSprite=this.createMJ(2,3);
				   }
				   else
				   {
					   MJSprite=this.createMJ(2,2,card);
				   }
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY; 
				   MJSprite.name = numChildren;
				   discardSprite.addChild(MJSprite);
				   
				   this.tips(cardsX+10,cardsY-30)
				   break;			   
			  case 3:
				   cardsX=440-parseInt(numChildren % 12) * 40;
				   cardsY=parseInt(numChildren / 12) * 50;

				   if(card == "N")
				   {
					   MJSprite=this.createMJ(3,3);
				   }
				   else
				   {
					   MJSprite=this.createMJ(3,2,card);
				   }
				   
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY; 
				   MJSprite.name = numChildren;
				   discardSprite.addChild(MJSprite);
				   
				   this.tips(cardsX,cardsY-20)					  
				
				break;
			  default:
				
		  }
		    		  
    }	
	/*杠后销毁打出的牌*/
    __proto__.nDiscard = function(currentP)
    {
		  USprite=this.usersSprite[currentP];
		  discardSprite=USprite.discardSprite;		
		  numChildren=discardSprite.numChildren;
		  if(numChildren>0)
		  {
			 discardSprite.getChildByName(numChildren-1).removeSelf();; 
		  }
		  
		  if(this.contains(this.tipsSprite)) this.tipsSprite.removeSelf();
		  
	}
	/*指示标*/
    __proto__.tips = function(X,Y)
    {
          localPoint=new Point(X, Y);
		  globalPoint=discardSprite.localToGlobal(localPoint);
		  
		  if(this.tipsSprite && this.contains(this.tipsSprite))
		  {
			  this.tipsSprite.pos(globalPoint.x,globalPoint.y); 
		  }
		  else if(this.tipsSprite && !this.contains(this.tipsSprite))
		  {
			  this.addChild(this.tipsSprite);
			  this.tipsSprite.pos(globalPoint.x,globalPoint.y);
		  }
		  else
		  {
			  this.tipsSprite=new Sprite();
			  this.tipsSprite.pos(globalPoint.x,globalPoint.y); 
			  
			  tips= new Images("majiangbg/tips.png");
			  tips.pos(0,0)
			  this.tipsSprite.addChild(tips);
			  this.addChild(this.tipsSprite);
			  
			  var tipsAgin=-1;
			  tips.timerLoop(80, this, function(){
                      
					  if(tips.y<-20)
					  {
						  tipsAgin=1;
				      }
					  
					  if(tips.y>=0)
					  {
						  tipsAgin=-1;
					  }
					  tips.y=tips.y+(2 * tipsAgin)
			  })
		  }
    }
	
	/*选择方向*/
    __proto__.initSelectDirection = function()
    {
		
		var direction=[];
		var userPosition=this.room.position?this.room.position:1;
		  switch(userPosition)
		  {
			  case 1:
				   direction=['西','南','东','北'];
				   break;
			  case 2:
				   direction=['南','东','北','西'];
				   break;
			  case 3:
				   direction=['东','北','西','南'];
				   break;
			  case 4:
				   direction=['北','西','南','东'];
				   break;
			  default:
		  }
		 this.selectDirection.getChildByName('f_0').text=direction[0];
		 this.selectDirection.getChildByName('f_1').text=direction[1];
		 this.selectDirection.getChildByName('f_2').text=direction[2];
		 this.selectDirection.getChildByName('f_3').text=direction[3];
		 
         if(!this.contains(this.selectDirection)) this.addChild(this.selectDirection);
    }

	/*设置局数和剩余牌数*/
    __proto__.setRoomNum = function(setType,num)
    {
		   if(setType == 1) //设置剩余牌数
		   {
				surplus_font = this.selectDirection.getChildByName('surplus_font');
				surplus_font.text = "剩余["+num+"]张牌";
				
		   }
		   else //设置局数
		   {
				game_num = this.room.game_num;//当前游戏局数
				game_num_total = this.room.game_num_total;//游戏总局数
				game_num_font = this.selectDirection.getChildByName('game_num_font');
				game_num_font.text = "第 ["+game_num +"/"+game_num_total+"] 局";				   
		   }
    }
	/*选择方向*/
    __proto__.setSelectDirection = function(position,times)
    {
		 var function_time=function(){};
		 this.initSelectDirection();
		 
		 this.times=times?times:0;
		 var direction=[this.selectDirection.getChildByName('w_0'),this.selectDirection.getChildByName('w_1'),this.selectDirection.getChildByName('w_2'),this.selectDirection.getChildByName('w_3')]
		 for(i=0;i<=3;i++)
		 {
			 direction[i].alpha=0;
			 direction[i].timer.clear(this,this.setDirection);
		 }
         this.selectDirection.timer.clear(this,this.setTimes);
		 
		 this.selectDirection.getChildByName('num0').index=0;
		 this.selectDirection.getChildByName('num1').index=0; 
		 
		 if(position!==null)
		 {
			  direction[position].alpha=1;
              direction[position].timerLoop(500, this,this.setDirection,[position])
		 }
		 
		 if(times)
		 {
			  this.selectDirection.timerLoop(1000, this,this.setTimes)
			  
		 }
         
    }
	
	/*设置方向效果*/
    __proto__.setDirection = function(position)
    {
		var direction=[this.selectDirection.getChildByName('w_0'),this.selectDirection.getChildByName('w_1'),this.selectDirection.getChildByName('w_2'),this.selectDirection.getChildByName('w_3')]
		if(direction[position].alpha==1)
		{
			 direction[position].alpha=0;
		}
		else
		{
			 direction[position].alpha=1;
		}
         
    }	
	
	/*设置时间效果*/
    __proto__.setTimes = function()
    {
		var times=this.times;
		var direction=[this.selectDirection.getChildByName('w_0'),this.selectDirection.getChildByName('w_1'),this.selectDirection.getChildByName('w_2'),this.selectDirection.getChildByName('w_3')]
		    this.times=this.times-1;
			if(times>=0)
			{
				this.selectDirection.getChildByName('num0').index=parseInt(this.times / 10);
				this.selectDirection.getChildByName('num1').index=parseInt(this.times % 10);
			}
			else
			{
				this.selectDirection.getChildByName('num0').index=0;
				this.selectDirection.getChildByName('num1').index=0;				
				this.selectDirection.timer.clear(this,this.setTimes);	
			} 
    }	
	/*摸牌效果*/
    __proto__.touchcard = function(currentP,card)
    {
		  USprite=this.usersSprite[currentP];
		  cardsSprite=USprite.cardsSprite;		
		  numChildren=cardsSprite.numChildren;
		  //alert(currentP)
          switch(currentP)
		  {
			  case 0:
				   cardsY=14 * 33;
				   cardsX=17;

				   MJSprite=this.createMJ(0,1);
				   
				   MJSprite.x=cardsX;
				   MJSprite.y=cardsY; 
				   MJSprite.zOrder=14;
				   MJSprite.name = "14";
				   cardsSprite.addChild(MJSprite);
				   break;
			  case 1:

				   CSprite=cardsSprite.getChildByName("cards");
				   numChildren=CSprite.numChildren;			  
			       cardsSprite.addChild(CSprite);
			        
				   cardsY=0;
				   cardsX=numChildren * 82 +40;
	
				   index=numChildren+num;
				   MJSprite=this.createMJ(1,1,card);
				   MJSprite.x=cardsX;
				   MJSprite.y=0;
				   MJSprite.name=numChildren;
				   MJSprite.on(Event.CLICK, this, this.OnDiscard); 
				   CSprite.addChild(MJSprite);			   
				   
				break;
			  case 2:
			       
				   cardsY=0;
				   cardsX=17;
				   MJSprite=this.createMJ(2,1);
				   
				   MJSprite.x=cardsX;
				   MJSprite.zOrder=0;
				   MJSprite.y=cardsY;
				   MJSprite.name = "14"; 
				   cardsSprite.addChild(MJSprite);
				   
				   break;			   
			  case 3:
				   cardsY=0;
				   cardsX=497-13 * 38-10;

				   MJSprite=this.createMJ(3,1);
				   
				   MJSprite.x=cardsX;
				   MJSprite.y=0; 
				   MJSprite.name = "14";
				   cardsSprite.addChild(MJSprite);			  
				
				break;
			  default:	
		  } 
		  
		  //soundPlay(GC.SoundQipai)   		  
    }
	
	/*取消摸牌效果*/
    __proto__.nTouchcard = function(currentP)
    {
		  USprite=this.usersSprite[currentP];
		  cardsSprite=USprite.cardsSprite;		
		  numChildren=cardsSprite.numChildren;
		  
		  Touchcard=cardsSprite.getChildByName('14');
		  if(cardsSprite.contains(Touchcard)) Touchcard.removeSelf();
    }
	
	/*更新用户牌 杠碰*/
    __proto__.updateUserCards = function(currentP,card)
    {
		  USprite=this.usersSprite[currentP];
		  cardsSprite=USprite.cardsSprite;		
		  cardsSprite.destroyChildren();
		  
		  var userCards=card.cards;
		  var MJ3=card.MJ3;//碰
		  var MJ4=card.MJ4;//明杠
		  var MJ5=card.MJ5;//暗杠
		  
		  var len3=MJ3?MJ3.length:0;
		  var len4=MJ4?MJ4.length:0;
		  var len5=MJ5?MJ5.length:0;
		  
		  var lenCards=userCards?userCards.length:0;
		  
		  var MJ_Sprite;
		  
		  if(userCards) userCards.sort(function(a,b){return a- b});
          switch(currentP)
		  {
			  case 0:
			       if(MJ5)
				   {
					   for(i=0;i<len5;i++)
					   {
						    MJ5_Sprite=new Sprite();
							MJ5_Sprite.x=0;
							MJ5_Sprite.y=i * 100;
						    for(k=0;k<2;k++)
							{
								 MJ_Sprite=this.createMJ(0,3);
								 MJ_Sprite.y=k*48;
								 MJ_Sprite.x=0;
								 MJ5_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(0,2,MJ5[i]);
							MJ_Sprite.y=18;
							MJ_Sprite.x=0;
							MJ_Sprite.zOrder=4;
							MJ5_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ5_Sprite);						
					   }
					   
				   }
				   
			       if(MJ4)
				   {
					   for(i=0;i<len4;i++)
					   {
						    MJ4_Sprite=new Sprite();
							MJ4_Sprite.x=0;
							MJ4_Sprite.y=(i+len5) * 100;
						    for(k=0;k<2;k++)
							{
								 MJ_Sprite=this.createMJ(0,2,MJ4[i]);
								 MJ_Sprite.y=k*48;
								 MJ_Sprite.x=0;
								 MJ4_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(0,2,MJ4[i]);
							MJ_Sprite.y=18;
							MJ_Sprite.x=0;
							MJ_Sprite.zOrder=4;
							MJ4_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ4_Sprite);						
					   }
					   	
				   }
				   
			       if(MJ3)
				   {
					   for(i=0;i<len3;i++)
					   {
						    MJ3_Sprite=new Sprite();
							MJ3_Sprite.x=0;
							MJ3_Sprite.y=(len5+len4) * 100 + i * 115;
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(0,2,MJ3[i]);
								 MJ_Sprite.y=k*34;
								 MJ_Sprite.x=0;
								 MJ3_Sprite.addChild(MJ_Sprite);
							}
							cardsSprite.addChild(MJ3_Sprite);						
					   }
					   
				   }
				   				   
				   cardsY=(len5+len4) * 100 + len3 * 115;
				   cardsX=17;
                   addCardsNum=13-(len3+len5+len4) * 3;
				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(0,1);
					   
					   MJSprite.x=cardsX;
					   MJSprite.y=cardsY+ num * 33; 
					   cardsSprite.addChild(MJSprite);
				   }

				   break;
			  case 1:
			       cardsX=-60;
			       if(MJ5)
				   {
					   for(i=0;i<len5;i++)
					   {
						    MJ5_Sprite=new Sprite();
							MJ5_Sprite.y=28;
							MJ5_Sprite.x=cardsX+i * 190;
							MJ5_Sprite.scale(0.7,0.7);
							MJ5_Sprite.cacheAs="normal";
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(1,6);
								 MJ_Sprite.y=0;
								 MJ_Sprite.x=k * 83;
								 MJ5_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(1,2,MJ5[i]);
							MJ_Sprite.y=-25;
							MJ_Sprite.x=83;
							MJ_Sprite.zOrder=4;
							MJ5_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ5_Sprite);						
					   }
					   
				   }
				   
			       if(MJ4)
				   {
					   for(i=0;i<len4;i++)
					   {
						    MJ4_Sprite=new Sprite();
							MJ4_Sprite.y=28;
							MJ4_Sprite.x=cardsX+(i+len5) * 190;
							MJ4_Sprite.scale(0.7,0.7);
							MJ4_Sprite.cacheAs="normal";
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(1,2,MJ4[i]);
								 MJ_Sprite.x=k*83;
								 MJ_Sprite.y=0;
								 MJ4_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(1,2,MJ4[i]);
							MJ_Sprite.y=-25;
							MJ_Sprite.x=83;
							MJ_Sprite.zOrder=4;
							MJ4_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ4_Sprite);						
					   }
					   	
				   }
				   
			       if(MJ3)
				   {
					   for(i=0;i<len3;i++)
					   {
						    MJ3_Sprite=new Sprite();
							MJ3_Sprite.y=28;
							MJ3_Sprite.x=cardsX+(len5+len4+i) * 190;
							MJ3_Sprite.scale(0.7,0.7);
							MJ3_Sprite.cacheAs="normal";
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(1,2,MJ3[i]);
								 MJ_Sprite.x=k*83;
								 MJ_Sprite.y=0;
								 MJ3_Sprite.addChild(MJ_Sprite);
							}
							cardsSprite.addChild(MJ3_Sprite);						
					   }
				   }	
				   		   
				   cardsX=cardsX+(len5+len4 + len3) * 190;

				   var CSprite= new  Sprite();
					   CSprite.x=cardsX;
					   CSprite.y=0;
					   CSprite.name="cards";
					   cardsSprite.addChild(CSprite);		
				   
				   for(num=0;num<lenCards;num++)
				   {
					   MJSprite=this.createMJ(1,1,userCards[num]);
					   MJSprite.x= num * 82;
					   MJSprite.y=0;
					   MJSprite.name=num; 
					   MJSprite.once(Event.CLICK, this, this.OnDiscard);
					   CSprite.addChild(MJSprite);
				   }				   	   
				   
				break;
			  case 2:
				   cardsY=450;
				   cardsX=17;
			       if(MJ5)
				   {
					   for(i=0;i<len5;i++)
					   {
						    MJ5_Sprite=new Sprite();
							MJ5_Sprite.x=0;
							MJ5_Sprite.y=cardsY-(i * 100);
						    for(k=0;k<2;k++)
							{
								 MJ_Sprite=this.createMJ(2,3);
								 MJ_Sprite.y=k*48;
								 MJ_Sprite.x=0;
								 //MJ_Sprite.zOrder=15-(i * 3);
								 MJ5_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(2,2,MJ5[i]);
							MJ_Sprite.y=18;
							MJ_Sprite.x=0;
							MJ_Sprite.zOrder=4;
							MJ5_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ5_Sprite);						
					   }
					   
				   }
				   
			       if(MJ4)
				   {
					   for(i=0;i<len4;i++)
					   {
						    MJ4_Sprite=new Sprite();
							MJ4_Sprite.x=0;
							MJ4_Sprite.y=cardsY-((i + len5) * 100);
						    for(k=0;k<2;k++)
							{
								 MJ_Sprite=this.createMJ(2,2,MJ4[i]);
								 MJ_Sprite.y=k*48;
								 MJ_Sprite.x=0;
								 MJ4_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(2,2,MJ4[i]);
							MJ_Sprite.y=18;
							MJ_Sprite.x=0;
							MJ_Sprite.zOrder=4;
							MJ4_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ4_Sprite);						
					   }
					   	
				   }
				   
			       if(MJ3)
				   {
					   for(i=0;i<len3;i++)
					   {
						    MJ3_Sprite=new Sprite();
							MJ3_Sprite.x=0;
							MJ3_Sprite.y=cardsY-((len5+len4) * 100 + i * 115)-20;
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(2,2,MJ3[i]);
								 MJ_Sprite.y=k*34;
								 MJ_Sprite.x=0;
								 MJ3_Sprite.addChild(MJ_Sprite);
							}
							cardsSprite.addChild(MJ3_Sprite);						
					   }
					   
				   }
				   				   
				   cardsY=cardsY-((len5+len4) * 100 +  len3 * 115);
				   cardsX=17;
                   addCardsNum=13-(len3+len5+len4) * 3;
				   
				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(2,1);
					   
					   MJSprite.x=cardsX;
					   MJSprite.y=cardsY - num * 33; 
					   MJSprite.zOrder=14 - num;
					   cardsSprite.addChild(MJSprite);
				   }
				   break;			   
			  case 3:
				   cardsY=0;
				   cardsX=430;

			       if(MJ5)
				   {
					   for(i=0;i<len5;i++)
					   {
						    MJ5_Sprite=new Sprite();
							MJ5_Sprite.x=cardsX - (i * 125);
							MJ5_Sprite.y=0;
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(3,3);
								 MJ_Sprite.y=0;
								 MJ_Sprite.x=k * 39;
								 MJ5_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(3,2,MJ5[i]);
							MJ_Sprite.y=-15;
							MJ_Sprite.x=39;
							MJ_Sprite.zOrder=4;
							MJ5_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ5_Sprite);						
					   }
				   }
				   
			       if(MJ4)
				   {
					   for(i=0;i<len4;i++)
					   {
						    MJ4_Sprite=new Sprite();
							MJ4_Sprite.x=cardsX - (i+len5) * 125;
							MJ4_Sprite.y=0;
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(3,2,MJ4[i]);
								 MJ_Sprite.y=0;
								 MJ_Sprite.x=k * 39;
								 MJ4_Sprite.addChild(MJ_Sprite);
							}
							MJ_Sprite=this.createMJ(3,2,MJ4[i]);
							MJ_Sprite.y=-15;
							MJ_Sprite.x=39;
							MJ_Sprite.zOrder=4;
							MJ4_Sprite.addChild(MJ_Sprite);	
							cardsSprite.addChild(MJ4_Sprite);						
					   }
					   	
				   }
				   
			       if(MJ3)
				   {
					   for(i=0;i<len3;i++)
					   {
						    MJ3_Sprite=new Sprite();
							MJ3_Sprite.x=cardsX-(len5+len4 + i) * 125;
							MJ3_Sprite.y=0;
						    for(k=0;k<=2;k++)
							{
								 MJ_Sprite=this.createMJ(3,2,MJ3[i]);
								 MJ_Sprite.y=0;
								 MJ_Sprite.x=k * 39;
								 MJ3_Sprite.addChild(MJ_Sprite);
							}
							cardsSprite.addChild(MJ3_Sprite);						
					   }
					   
				   }
				   
				   cardsY=0;
				   cardsX=cardsX-(len3+len4+len5-1) * 125 -50;
				   
                   addCardsNum=13-(len3+len5+len4) * 3;
				   
				   for(num=0;num<addCardsNum;num++)
				   {
					   MJSprite=this.createMJ(3,1);
					   
					   MJSprite.x=cardsX- ( num * 39);
					   MJSprite.y=0; 
					   cardsSprite.addChild(MJSprite);
				   }				  		  
				
				break;
			  default:	
		  }    		  
    }
	
	/*创建4个方向的麻将*/
    __proto__.createMJ = function(currentP,type,card)
    {
		  var MJSprite;
          switch(currentP)
		  {
			  case 0:
                   if(type==1) //立起
				   {
                       MJSprite=new Images("majiangbg/tile_back_side_stand_left.png");	
				   }
				   else if(type==2) // 躺下
				   {
					   MJSprite=new Sprite();
					   MJBg=new Images("majiangbg/tile_face_side_white.png");
					   
					   MJ=new Images();
					   MJ.skin=this.getCard(card,"small");
					   MJ.x=26;
					   MJ.y=17;
					   MJ.pivot(20,23)
					   MJ.rotation=90;
					   
					   MJSprite.addChild(MJBg);
				       MJSprite.addChild(MJ);				   
				   }
				   else if(type==3) // 爬下
				   {
                       MJSprite=new Images("majiangbg/tile_back_side_lie.png");			   
				   }		   

				   break;
			  case 1:
			       
				   if(type==1)//立起来
				   {
						 MJSprite=new Sprite();
						 MJSprite.width=82;
				         MJSprite.height =125;
						 
						 MJBg=new Images("majiangbg/tile_face_bottom_stand.png");
						 
						 MJ=new Images();
						 MJ.skin=this.getCard(card);
						 MJ.x=-3;
						 MJ.y=15;
						 
						 MJSprite.addChild(MJBg);
						 MJSprite.addChild(MJ);					   
				   }
				   else if(type==2)// 躺下
				   {
						 MJSprite=new Sprite();
						 MJSprite.width=82;
				         MJSprite.height =125;
						 
						 MJBg=new Images("majiangbg/tile_face_bottom_white.png");
						 
						 MJ=new Images();
						 MJ.skin=this.getCard(card,"Squash");
						 MJ.x=0;
						 MJ.y=0;
						 
						 MJSprite.addChild(MJBg);
						 MJSprite.addChild(MJ);				   
				   }
				   else if(type==3)// 爬下
				   {
                        MJSprite=new Images("majiangbg/tile_back_bottom_lie_large.png");				   
				   }
				   else if(type==4)//打出去
				   {
						 MJSprite=new Sprite()
						 MJBg=new Images("majiangbg/tile_face_lie_white.png");
						 
						 MJ=new Images();
						 MJ.skin=this.getCard(card,"small");
						 MJ.x=0;
						 MJ.y=1;
						 
						 MJSprite.addChild(MJBg);
						 MJSprite.addChild(MJ);			   
				   }
				   else if(type==5)// 杠爬下
				   {
                        MJSprite=new Images("majiangbg/tile_back_bottom_lie_large2.png");				   
				   }
				   else if(type==6)// 杠躺下
				   {
						 MJSprite=new Sprite();
						 MJSprite.width=82;
				         MJSprite.height =125;
						 
						 MJBg=new Images("majiangbg/tile_back_bottom_lie_large2.png");
						 
						 MJ=new Images();
						 MJ.skin=this.getCard(card,"Squash");
						 MJ.x=0;
						 MJ.y=0;
						 
						 MJSprite.addChild(MJBg);
						 MJSprite.addChild(MJ);				   
				   }				    
				break;
			  case 2:
			       
				   if(type==1)//立起来
				   {
                       MJSprite=new Images("majiangbg/tile_back_side_stand.png");	
				   }
				   else if(type==2) // 躺下
				   {
                       MJSprite=new Sprite()
					   MJBg=new Images("majiangbg/tile_face_side_white.png");
				   
					   MJ=new Images();
					   MJ.skin=this.getCard(card,"small");
					   MJ.x=26;
					   MJ.y=17;
					   MJ.pivot(20,23)
					   MJ.rotation=-90;
					   
					   MJSprite.addChild(MJBg);
				       MJSprite.addChild(MJ);				   
				   }
				   else if(type==3) // 爬下
				   {
                       MJSprite=new Images("majiangbg/tile_back_side_lie.png");				   
				   }

				   break;			   
			  case 3:
			  
			       if(type==1)
				   {
                       MJSprite=new Images("majiangbg/tile_back_up_stand.png");
				   }
				   else if(type==2) // 躺下
				   {
					   MJSprite=new Sprite();
					   MJBg=new Images("majiangbg/tile_face_lie_white.png");
					   
					   MJ=new Images();
					   MJ.skin=this.getCard(card,"small");
					   MJ.x=0;
					   MJ.y=0;
					   
					   MJSprite.addChild(MJBg);
				       MJSprite.addChild(MJ);					   
				   }
				   else if(type==3) // 爬下
				   {
                       MJSprite=new Images("majiangbg/tile_back_up_lie.png");				   
				   }				  
				
				break;
			  default:
				
		  }  
		  
		  return  MJSprite;
    }	
	
	/*杠碰按钮显示*/
    __proto__.showButtons = function(type)
    {
		   var cards = arguments[1] ? arguments[1] : null;
		   var mode_ = arguments[2] ? arguments[2] : null;
           if(!this.contains(this.butButtons))
		   {
			    this.addChildren(this.butButtons);
		   }
		   this.butButtons.destroyChildren();
		   this.butButtons.x=1377;
		   this.butButtons.y=526;	
/*		   
		   butBao= this.butButtons.getChildByName('but_bao');  
		   butPass=	 this.butButtons.getChildByName('but_pass');
		   butMj4=	 this.butButtons.getChildByName('but_mj4');
		   butMj3=	 this.butButtons.getChildByName('but_mj3');
		   butHu=	 this.butButtons.getChildByName('but_hu');*/
		   for(i in type)
		   {
			    butX=541-(i * 140);
				butY=0;
			    switch(type[i])
				{
					  case 0:
						but = new Images("room/but_pass.png");
						but.size(101, 116);
						but.x = butX;
						but.y = butY;
						but.on(Event.CLICK, this,function(){
							    if(!mode_)
								{
									this.send({action:'game_pass'});
								}
								else if(mode_ == 1)
								{
									this.upDateCardsOff();//解除出牌事件
								}
								else
								{
									this.upDateCardsOff(mode_);
								}
								this.butButtons.removeSelf(); 
						},[mode_]);
						break;
					  case 1:
						but = new Images("room/but_win.png");
						but.size(101, 116);
						but.x = butX;
						but.y = butY;
						but.on(Event.CLICK, this,function(){
							    soundPlay(GC.SoundClick) 
							    this.send({action:'game_win'});
								this.butButtons.removeSelf();
						});
						break;
					  case 2:
						but = new Images("room/but_peng.png");
						but.size(101, 116);
						but.x = butX;
						but.y = butY;
						but.on(Event.CLICK, this,function(){
							    soundPlay(GC.SoundClick) 
							    this.send({action:'game_MJ3'});
								this.butButtons.removeSelf();
						});
						break;
					  case 3:
						but = new Images("room/but_gang.png");
						but.size(101, 116);
						but.x = butX;
						but.y = butY;
						but.on(Event.CLICK, this,function(cards){
							    soundPlay(GC.SoundClick) 
								if(cards)
								{
									  for(n in cards)
									  {
										   card = this.createMJ(1,1,cards[n])
										   card.x=n * 140;
										   card.y=70;
										   this.butButtons.addChildren(card);
										   
										   card.on(Event.CLICK, this,function(c){
											     soundPlay(GC.SoundClick) 
												 this.send({action:'game_MJ',card:c});
												 this.butButtons.removeSelf();
										   },[cards[n]]);
									  }									
								}
								else
								{
									this.send({action:'game_MJ'});
									this.butButtons.removeSelf();								  
								}

							    
						},[cards]);
						break;
					  case 4:
						but = new Images("room/but_bao.png");
						but.size(101, 116);
						but.x = butX;
						but.y = butY;
						but.on(Event.CLICK, this,function(){
							    soundPlay(GC.SoundClick);
							    this.send({action:'game_draw'});
								this.butButtons.removeSelf();
						});
						break;
					  default:
				}
				this.butButtons.addChildren(but);
		   }
		   this.butButtons.x = 700;
           //Tween.to(this.butButtons,{x: 703}, 500);  
    }		
}
Laya.class(MJRoom, "MJRoom", MJRoomUI); 



function MJIpShow()
{
	MJIpShow.super(this);
	var __proto__ = MJIpShow.prototype;
	this.RequestUrl = GC.RoomPath+'index.php/games/games/user_location/';
	this.rs = new HttpRequest();
	this.ListData = [];
	__proto__.init = function(array)
	{
		this.butClose.on(Event.CLICK,this,this.close);
		this.listDistanceList.removeSelf();
		var dataBase = "{";
		for(var k in array)
		{
			//dataBase = dataBase+"\""+k+"\":{\"user_id\":"+array[k].user_id+",\"ip\":\""+array[k].ip+"\",\"lat\":\""+array[k].lat+"\",\"lon\":\""+array[k].lon+"\"},";
			dataBase = dataBase+"\""+k+"\":"+array[k]+",";
		}
		dataBase = dataBase.substring(0,dataBase.length-1)+"}";
		GL(GC.Gltime,"加载超时","努力分析中");
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			var i = 0;
			for(var key in data)
			{
				
				(data[key].user[0].ip != data[key].user[1].ip) ?showiptext ='IP不相同':showiptext ='IP相同';
				(data[key].distanceBetween>1000) ? Betweenshow = '>1KM' : Betweenshow = data[key].distanceBetween+'M';
				this.ListData[i] = {
					txtNickname1:{text:data[key].user[0].nickname},
					txtNickname2:{text:data[key].user[1].nickname},
					txtIP1:{text:data[key].user[0].ip},
					txtIP2:{text:data[key].user[1].ip},
					txtShowIp:{text:showiptext},
					txtdistanceBetween:{text:'相距'+Betweenshow}
				}
				i++;
			}
			this.listDistanceList.dataSource = this.ListData;
			this.addChild(this.listDistanceList);
			GL(-1);
		});	
		this.rs.send(this.RequestUrl+"?data="+dataBase+"",'','get','text');
	}
}
Laya.class(MJIpShow, "MJIpShow", MJIpShowUI);
//战绩结算
function MJDissolve()
{
	MJDissolve.super(this);
	var __proto__ = MJDissolve.prototype;
	this.DissolveUrl = '';
	this.userid = 0;
	this.count_down_num = 20;
	this.fun = null;
	this.userarray = {};
	__proto__.init = function(MJroom,array,dissolveUid)
	{
		if(this.fun)
		{
			this.txtReciprocal.timer.clear(this, this.fun);
			this.fun = null;
		} 
		this.userid = dissolveUid;
		//this.butClose.on(Event.CLICK,this,this.close);
		//array = {'1':{headpath:'',nickname:'xiaobai3',status:1},'130':{headpath:'',nickname:'xiaobai1',status:0},'3':{headpath:'',nickname:'xiaobai2',status:1}}
		
		if(GU.id == dissolveUid)
		{
			this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
		}
        this.imgAgree.on(Laya.Event.CLICK, this , function(MJroom){
            //点击同意事件
            MJroom.send({action:'game_dissolve',status:1});
			this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
            
        },[MJroom]);
        this.imgRefuse.on(Laya.Event.CLICK, this , function(MJroom){
            //点击不同意事件
            MJroom.send({action:'game_dissolve',status:0});
			this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
        },[MJroom]);
		var i = 0;
        for(var k in array)
        {
            var showtexts;
			var fontcolors;
			var userSprite;
			userarray= [];
			if(this.userid == k)
            {
                this.txtOperation.text = '玩家【'+array[k].nickname+'】申请解散房间，请问是否同意？（超过3分钟 未做选择，则默认同意）';
            }
			userSprite = this.getChildByName('userSprite'+k);
			if(this.contains(userSprite)) userSprite.destroy();
            userSprite = new Sprite();
            userSprite.x=100;
            userSprite.y=240+i*40;
			userSprite.name = "userSprite"+k; 
            this.addChild(userSprite);
            (array[k].status ==1) ? showtexts = '已同意解散房间':showtexts = '等待确认中....';
            (array[k].status ==1) ? fontcolors = '#28a800':fontcolors = '#b44f00';

            var nickname = new Text();
            nickname.x=30;
            nickname.y=22;
            nickname.text='【'+array[k].nickname+'】';
            nickname.name="nickname";
            nickname.size(291,63);
            nickname.color = "#442600";
		    nickname.font = "Microsoft YaHei";
		    nickname.fontSize = 20;
            userSprite.addChild(nickname);

            var showtext = new Text(); 
            showtext.x=300;
            showtext.y=22;
            showtext.name="showtext";
            showtext.text = showtexts;
            showtext.size(448,63);
            showtext.color = fontcolors;
		    showtext.font = "Microsoft YaHei";
		    showtext.fontSize = 20;
            userSprite.addChild(showtext);
            this.userarray[k]=userSprite;
            i++;
        }
        this.count_down(MJroom);
	}
	
	__proto__.count_down = function(MJroom)
    {
        this.txtReciprocal.text = this.count_down_num;
        this.txtReciprocal.timerLoop(1000, this, this.fun=function(){
			num=this.txtReciprocal.text;
			num=num-1;
			if(num>=0)
			{
				this.txtReciprocal.text=num;
			}
			else
			{
				 this.close();
				 this.txtReciprocal.timer.clear(this, this.fun);
				 this.fun = null;
				 MJroom.send({action:'game_dissolve',status:2});	
			}
        });		
    }

    __proto__.dissolve_action = function(array,status)
    {
        //status 1同意 0不同意 2时间到自动解散 3发起解散房间 5房间解散
        if(array.status == 1)
        {
			showtext =this.userarray[array.id].getChildByName("showtext");
            showtext.text = '同意了解散房间';
            showtext.color = '#28a800';
        }
        else if(array.status == 0)
        {
			if(this.fun)
			{
				this.txtReciprocal.timer.clear(this, this.fun);
				this.fun = null;
			} 
			this.close();
			GT(array.nickname+"拒绝解散房间",GC.Gttime);     
        }    
    }
}
Laya.class(MJDissolve, "MJDissolve", MJDissolveUI);
//结束结算
// 当前一局的结算
function MJCurrentGains()
{
	MJCurrentGains.super(this);
	var __proto__ = MJCurrentGains.prototype;

	__proto__.init = function(gradelistarray,MJroom)
	{
		this.listGrade.removeSelf();
		this.imgShare.on(Event.CLICK,this,this.Share); 
		var  isEnd= (gradelistarray.game_num<gradelistarray.game_num_total) ? 0 : 1;//是否为最后一局
		if(isEnd)
		{
			this.butContinue.skin = "mjcurrentgains/btn_border_yellow_m1.png";
			this.butContinue.once(Event.CLICK,this,function(room){
				this.close();
				room.send({action:'game_gains'});
			},[MJroom]);
		}
		else
		{
			this.butContinue.once(Event.CLICK,this, function(room){
				this.close();
				room.restart();
				room.send({action:'game_ready'});
            },[MJroom]);
		}
		var i = 0;
		gradedata = [];
		var imgBigBgval = 'true';
		var imgStatusval = 'mjgains/single_title1.png';
		var huangzhuan = 1;
		for(var k in gradelistarray.user)
	    {
			v = [];
			v = gradelistarray.user[k];
			var Bigbg;
			var imgZhuangbg;
			var ListBg;
			var imgMjwiteshow;
			var imgcards
			imgMjwiteshow = "" ;
			imgcards = '';
            if(k==GU.id)
            {
				ListBg = 'mjcurrentgains/bg_green_select_frame.png';
				if(v.win!=0)
				{
					imgBigBgval = '';
					imgStatusval = 'mjgains/single_title2.png'; 
				}
            }
            else
            {           
                ListBg = '';
            }
			if(v.win>0)
			{
				imgMjwiteshow = "true" ;
				imgcards = this.getCard(v.win,'small')
				huangzhuan = 2;
			}
            (gradelistarray.zhuang_uid==k) ? visible ="true" : visible = '';
            gradedata[i] = { imgHeadpath : { skin : v.headpath } ,imgListBg:{skin:ListBg},imgCards:{skin:imgcards},txtRecord : { text : v.point+"分" }, imgMjwite:{ visible:imgMjwiteshow},imgZhuang:{ visible:visible},uid:{var : k }};
            i++;
        }
		if(huangzhuan == 1)  imgStatusval = 'mjgains/single_title3.png';
		this.imgBigBg.gray = imgBigBgval;
		this.imgStatus.skin = imgStatusval;
        this.listGrade.dataSource = gradedata;
		if(gradelistarray.cards)
		{
			for(var p in this.listGrade.dataSource)
			{
				this.listGrade.getCell(p).getChildByName('spriteCardsList').destroyChildren();
				for(var k in gradelistarray.cards[this.listGrade.dataSource[p].uid.var].cards)
				{
					var MJBg=new Images("majiangbg/tile_face_lie_white.png");
					var MJ=new Images();
					MJ.skin=this.getCard(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].cards[k],'small');
					MJBg.x = 0+k*39;
					MJ.x=0+k*39;
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJBg);
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJ);
				}
				if(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.hasOwnProperty("MJ3")  ){ 
					var MJ3 = new Sprite();
					MJ3.x =MJ.x+39 - 39*3;
					MJ3.name = 'mj3';
					MJ3.addChild(this.getSpecialCard(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.MJ3,3));
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJ3);
					var MJ3W = gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.MJ3.length;
					var MJ3WW = MJ3.x+(3*39)*MJ3W + MJ3W*10;
				}
				if(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.hasOwnProperty("MJ5")){
					var MJ4 = new Sprite();
					MJ4.x = MJ3WW;
					MJ4.addChild(this.getSpecialCard(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.MJ4,4));
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJ4);
					var MJ4W = gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.MJ4.length;
					var MJ4WW = MJ4.x+(3*39)*MJ4W + MJ4W*10;
				}
				if(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.hasOwnProperty("MJ5")){
					var MJ5 = new Sprite();
					MJ5.x = MJ4WW;
					MJ5.addChild(this.getSpecialCard(gradelistarray.cards[this.listGrade.dataSource[p].uid.var].MJ.MJ5,5));
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJ5);
				}
			}
		}
		this.addChild(this.listGrade);
	}
	__proto__.getCard = function(card)
    {
		  var type = arguments[1] ? arguments[1] : "big";
          if(card>9)
		  {
			   mjFileName="majiang/mahjong_tile_"+type+"_"+card+".png";
		  }
		  else
		  {
			   mjFileName="majiang/mahjong_tile_"+type+"_0"+card+".png";
		  }
		  return mjFileName;	                       
    }
	__proto__.getSpecialCard = function(card,num)
	{
		var k =0;
		var MJSprite = new Sprite();
		var onex = 0;
		for(var i in card)
		{
			var MJSpriteOne = new Sprite();
			MJSpriteOne.x = onex+39*3+10;
			for(var number = 0; number<3; number++)
			{
				if(num == 5)
				{
					var MJBg=new Images("majiangbg/tile_back_up_lie.png");
					MJBg.x = 0+number*39;
					MJSpriteOne.addChild(MJBg);
					MJSpriteOne.addChild(MJBg);
				}
				else
				{
					var MJBg=new Images("majiangbg/tile_face_lie_white.png");
					var MJ=new Images();
					MJ.skin=this.getCard(card[i],'small');
					MJBg.x = 0+number*39;
					MJ.x=0+number*39;
					MJSpriteOne.addChild(MJBg);
					MJSpriteOne.addChild(MJ);
				}
				if(num !=3)
				{
					var MMJBg=new Images("majiangbg/tile_face_lie_white.png");
					var MMJ=new Images();
					MMJ.skin=this.getCard(card[i],'small');
					MMJBg.x = 39;
					MMJBg.y= -15;
					MMJ.x=39;
					MMJ.y= -10;
					MJSpriteOne.addChild(MMJBg);
					MJSpriteOne.addChild(MMJ);
				}
			}
			k++;
			var onex = MJSpriteOne.x;
			MJSprite.addChild(MJSpriteOne);
		}
		return MJSprite;
	}
	__proto__.Share = function()
	{
		wx_share(1, {ico:'',url:'',title:'明花麻将',describe:'炫一下我的战绩，快来和我一起吧',type:'3'});	
	}
}
Laya.class(MJCurrentGains, "MJCurrentGains", MJCurrentGainsUI);
//完场结算
function MJTotleRecord()
{
	MJTotleRecord.super(this);
	this.butClose.on(Event.CLICK,this,this.close); 
	var __proto__ = MJTotleRecord.prototype;
	this.getConfigUrl = GC.RoomPath+'index.php/games/games/get_games_list';
	this.rs = new HttpRequest();
	this.gameconfig;
	this.GameID = 0;
	__proto__.init = function(gradelistarray,MJroom)
	{
		this.butClose.on(Event.CLICK,this,function(){
			//点击关闭事件
			this.close();
			MJroom.del();
		});
		this.imgShare.on(Event.CLICK,this,function(){
			//点击分享事件
			wx_share(1, {ico:'',url:'',title:'明花麻将',describe:'炫一下我的战绩，快来和我一起吧',type:'3'});
		});
		var now=new Date();
		var year=now.getFullYear();
		var month=now.getMonth();
		var day=now.getDate();
		var hours=now.getHours();
		var minutes=now.getMinutes();
		var seconds=now.getSeconds();
		this.imgTime.text = ""+year+"年"+month+"月"+day+"日 "+hours+":"+minutes+":"+seconds+"";
		var i = 0 ;
		data = [];
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			this.gameconfig = data[this.GameID].config.show_config.pay;
			var i= 0
			for(var k in this.gameconfig)
			{
				if(k == gradelistarray.room.payment_method)
				{
					this.imgGameInfo.text = gradelistarray.room.game_type+' '+this.gameconfig[k].name+' '+gradelistarray.room.game_num_total+'局'; 
					break;
				}
				i++;
			}
		});
		this.rs.send(this.getConfigUrl,'','get','text');
		for(var K in gradelistarray.user)
		{
			var bg;
			var win;
			var master;
			(gradelistarray.start_uid == gradelistarray.user[K].userid)?  master = 'mjtotlerecord/all_result_2.png': master = '';
			(gradelistarray.user[K].userid == GU.id)?  bg = 'mjtotlerecord/pinkbg.png': bg = 'mjtotlerecord/greybg.png';
			if(gradelistarray.user[K].win == 1)
			{
				win = 'mjtotlerecord/bestwinner.png';
			}
			else if(gradelistarray.user[K].win == 2)
			{
				win = 'mjtotlerecord/loser.png';
			}else
			{
				win = '';
			}
			data[i] = {txtNickname:{text:gradelistarray.user[K].nickname},txtId:{text:gradelistarray.user[K].userid},txtSnum:{text:gradelistarray.user[K].accumulator_num},txtHnum:{text:gradelistarray.user[K].success_num},txtTotlenum:{text:gradelistarray.user[K].point},imgHeadpath:{skin:gradelistarray.user[K].headpath},imgMaster:{skin:master},imgWin:{skin:win},imgBg:{skin:bg}};
			i++;
		}
		this.listRecord.dataSource = data;		
	}
}
Laya.class(MJTotleRecord, "MJTotleRecord", MJTotleRecordUI);
//设置
function MJRoomSet()
{
	MJRoomSet.super(this);

	var __proto__ = MJRoomSet.prototype;
	__proto__.init = function(MJroom)
	{
		if(SoundManager.musicMuted == true)
		{
			this.imgMonoff.skin = 'mjroomset/soundoff.png';
		}else
		{
			this.imgMonoff.skin = 'mjroomset/soundon.png';
		}
		if( SoundManager.soundMuted == true)
		{
			this.imgSonoff.skin = 'mjroomset/musicoff.png';
		}else
		{
			this.imgSonoff.skin = 'mjroomset/musicon.png';
		}
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.butTableColor.selectHandler = Laya.Handler.create(this,this.SelectRadio,[MJroom],false);
		this.imgMonoff.on(Event.CLICK,this,this.MusicOnOff);
		this.imgSonoff.on(Event.CLICK,this,this.SoundOnOff);
		this.imgRoomOut.on(Event.CLICK,this,function(MJroom){//解散房间
		    this.close();
			soundPlay(GC.SoundClick);
			MJroom.send({action:'game_dissolve',status:3});
		},[MJroom]);
	}
	__proto__.SelectRadio = function(room,index)
	{
		 if(index == 0)
		 {
			room.imgDesktop.skin = GC.MjImg+"bg/tablebg.png";
		 }else if(index == 1)
		 {
			room.imgDesktop.skin = GC.MjImg+"bg/tablebgblue.png";
		 }else if(index == 2)
		 {
			room.imgDesktop.skin = GC.MjImg+"bg/tablebgred.png";
		 }
	}
	__proto__.MusicOnOff = function()
	{
		if(SoundManager.musicMuted == true)
		{
			setSoundMuted(1,1);
			this.imgMonoff.skin = 'mjroomset/soundon.png';
		}
		else
		{
			setSoundMuted(0,1);
			this.imgMonoff.skin = 'mjroomset/soundoff.png';
		}	
	} 
	__proto__.SoundOnOff = function()
	{
		if(SoundManager.soundMuted == true)
		{
			setSoundMuted(1,2);
			this.imgSonoff.skin = 'mjroomset/musicon.png';
		} 
		else
		{
			setSoundMuted(0,2);
			this.imgSonoff.skin = 'mjroomset/musicoff.png';
		} 	
	}  	
}
Laya.class(MJRoomSet, "MJRoomSet", MJRoomSetUI);
//房间信息显示
function MJRoomInfo()
{
	MJRoomInfo.super(this);
	var __proto__ = MJRoomInfo.prototype;
	//array = {'CardNum':'游戏局数','PayWay':'游戏支付方式','PlayType':'明花不明花','position':{'x':'x','y':'y'}}
	__proto__.init = function(array)
	{
		this.txtCardNum.text = array.CardNum;//游戏局数
		this.txtPayWay.text = array.PayWay;//游戏支付方式
		this.txtPlayType.text = array.PlayType;//明花不明花
		this.x = array.position.x;
		this.y = array.position.y;
		this.butClose.on(Event.CLICK, this,this.OnClose);
	}
	
	__proto__.OnClose=function()
	{
		 this.destroy();
	}
}
Laya.class(MJRoomInfo, "MJRoomInfo", MJRoomInfoUI);