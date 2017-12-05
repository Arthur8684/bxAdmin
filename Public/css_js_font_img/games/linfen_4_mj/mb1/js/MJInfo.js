function MJIpShow()
{
	MJIpShow.super(this);
	var __proto__ = MJIpShow.prototype;
	this.RequestUrl = 'http://demo.cowcms.com/index.php/games/games/user_location/';
	this.rs = new HttpRequest();
	this.ListData = [];
	__proto__.init = function(array)
	{
		this.butClose.on(Event.CLICK,this,this.close);
		this.listDistanceList.removeSelf();
		var dataBase = "{";
		for(var k in array)
		{
			dataBase = dataBase+"\""+k+"\":{\"user_id\":"+array[k].user_id+",\"ip\":\""+array[k].ip+"\",\"lat\":\""+array[k].lat+"\",\"lon\":\""+array[k].lon+"\"},";
		}
		dataBase = dataBase.substring(0,dataBase.length-1)+"}";
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			var i = 0;
			for(var key in data)
			{
				
				(data[key].user[0].ip != data[key].user[1].ip) ?showiptext ='IP不相同':showiptext ='IP相同';
				this.ListData[i] = {
					txtNickname1:{text:data[key].user[0].nickname},
					txtNickname2:{text:data[key].user[1].nickname},
					txtIP1:{text:data[key].user[0].ip},
					txtIP2:{text:data[key].user[1].ip},
					txtShowIp:{text:showiptext},
					txtdistanceBetween:{text:'相距'+data[key].distanceBetween+''}
				}
				i++;
			}
			this.listDistanceList.dataSource = this.ListData;
			this.addChild(this.listDistanceList);
		});	
		this.rs.send(this.RequestUrl+"?data="+dataBase+"",'','post','text');
	}
}
Laya.class(MJIpShow, "MJIpShow", MJIpShowUI);

//聊天框
function MJChat()
{
    MJChat.super(this);
    var __proto__ = MJChat.prototype;
	this.TextList = {
		0:'你的牌打的太好了',
		1:'和你一起打牌好开心',
	};
	this.FaceList = {
		12:'mjface/emoji_12.png',
		13:'mjface/emoji_13.png',
		14:'mjface/emoji_14.png',
		15:'mjface/emoji_15.png',
		16:'mjface/emoji_16.png',
		17:'mjface/emoji_17.png',
	};
    __proto__.init = function()
    { 
		this.listFacelist.removeSelf();
		this.imgChat.on(Event.CLICK, this , this.chatimg_action);//点击聊天图片事件
        this.imgFace.on(Event.CLICK, this , this.faceimg_action);//点击表情图片事件
		this.butSubmit.on(Event.CLICK, this , this.text_action);//点击表情图片事件
		textdata = [];
		var i=0;
		for(var k in this.TextList)
		{
			textdata[i] = {txtChatlist:{text:this.TextList[k]}}
			i++;
		}
		this.listPreinstall.dataSource = textdata;
		this.listPreinstall.mouseHandler = new Handler(this, this.showTextList);
		textdata = [];
		i=0;
		for(var k in this.FaceList)
		{
			textdata[i] = {imgFace:{skin:this.FaceList[k]}}
			i++;
		}
		this.listFacelist.dataSource = textdata;
		this.listFacelist.mouseHandler = new Handler(this, this.showFaceList);
    }
    __proto__.chatimg_action = function()
    {
		this.addChild(this.listPreinstall);
		this.addChild(this.boxSubmit);
		this.listFacelist.removeSelf();
		this.imgChat.skin = 'mjchat/chat_s.png'; 
        this.imgFace.skin = 'mjchat/chat_exp_n.png';
    }
    __proto__.faceimg_action = function()
    { 
		this.addChild(this.listFacelist);
		this.listPreinstall.removeSelf();
		this.boxSubmit.removeSelf();
		this.imgChat.skin = 'mjchat/chat_n.png';
        this.imgFace.skin = 'mjchat/chat_exp_s.png';
    }
	__proto__.showTextList = function(e,index)
	{
		if(e.type == Event.CLICK)
		{
			alert(this.listPreinstall.getCell(index).getChildByName('txtChatlist').text);
		}
	}
	__proto__.showFaceList = function(e,index)
	{
		if(e.type == Event.CLICK)
		{
			alert(this.listFacelist.getCell(index).getChildByName('imgFace').skin);
		}
	}
	__proto__.text_action = function()
	{
		if(this.inputMsg.text == '')
		{
			alert('确定不说点啥？');
			//GT('确定不说点啥？');
		}
		else
		{
			alert(this.inputMsg.text);
		}
	}
}
Laya.class(MJChat, "MJChat", MJChatUI); 
//战绩结算
function MJDissolve()
{
	MJDissolve.super(this);
	var __proto__ = MJDissolve.prototype;
	this.DissolveUrl = '';
	this.Sign = 'Minghua'; 
	this.userid = 130;
	this.count_down_num = 180;
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,this.close);
		array = {'1':{headpath:'',nickname:'xiaobai3',status:1},'130':{headpath:'',nickname:'xiaobai1',status:0},'3':{headpath:'',nickname:'xiaobai2',status:1}}
        this.imgAgree.on(Laya.Event.CLICK, this , function(){
            //点击同意事件
            send({action:'game_dissolve',status:1,game_sign:this.Sign});
			this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
            
        });
        this.imgRefuse.on(Laya.Event.CLICK, this , function(){
            //点击不同意事件
            send({action:'game_dissolve',status:0,game_sign:this.Sign});
			this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
        });
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
            userSprite = new Sprite();
            userSprite.x=100;
            userSprite.y=240+i*40;
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
            userarray[k]=userSprite;
            i++;
        }
        this.count_down();
	}
	__proto__.count_down = function()
    {
        this.txtReciprocal.text = this.count_down_num;
        this.txtReciprocal.timerLoop(1000, this, function(){
			num=this.txtReciprocal.text;
			num=num-1;
			if(num>=0)
			{
				this.txtReciprocal.text=num;
			}
			else
			{
					
			}
        });		
    }

    __proto__.dissolve_action = function(array,status)
    {
        //status 1同意 0不同意 2时间到自动解散 3发起解散房间 5房间解散
        if(status == 1)
        {
            userarray[array.id].showtext.text = '同意了解散房间';
            userarray[array.id].showtext.color = '#28a800';
            this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();
        }
        if(status == 0)
        {
            userarray[array.id].showtext.text = '拒绝解散房间';
            userarray[array.id].showtext.color = '#ff0000';
            this.imgAgree.removeSelf();
			this.imgRefuse.removeSelf();       
        }
        if(status == 5)
        {
            this.removeSelf(); 
        }      
    }
}
Laya.class(MJDissolve, "MJDissolve", MJDissolveUI);
//结束结算
function MJCurrentGains()
{
	MJCurrentGains.super(this);
	var __proto__ = MJCurrentGains.prototype;
	this.Sign = 'Minghua'; 
	__proto__.init = function(gradelistarray)
	{
		this.listGrade.removeSelf();
		this.butClose.on(Event.CLICK,this,this.close);
		this.butContinue.on(Event.CLICK,this,this.Continue);
		this.imgShare.on(Event.CLICK,this,this.Share); 
		var  isEnd= (gradelistarray.game_num<gradelistarray.game_num_total) ? 0 : 1;//是否为最后一局
		if(isEnd)
		{
			this.butContinue.skin = "mjcurrentgains/btn_border_yellow_m1.png";
			this.butContinue.on(Event.CLICK,this,function(){
				this.close;
				MJtotlerecord = new MJtotlerecord();
				MJtotlerecord.init();
				MJtotlerecord.popup();//弹出总战绩
				send({action:'game_complete',game_sign:this.Sign});
			});
		}
		else
		{
			this.butContinue.once(Event.CLICK,this, function(){
				this.close();
				MJRoom.restart();
				send({action:'game_ready',game_sign:this.Sign});
            });
		}
		var i = 0;
		gradedata = [];
		for(var k in gradelistarray.user)
	    {
			v = [];
			v = gradelistarray.user[k];
			var Bigbg;
			var imgZhuangbg;
			var ListBg;
			var imgMjwiteshow;
			var imgcards
            if(k==GU.id)
            {
				ListBg = 'mjcurrentgains/bg_green_select_frame.png';
            }
            else
            {           
                ListBg = '';
            }
			if(v.win>0)
			{
				this.imgBigBg.gray = 'true'; 
				this.imgStatus.skin = 'mjgains/single_title1.png';
				imgMjwiteshow = "true" ;
				imgcards = this.getCard(v.win,'small')
			}
			else
			{
				this.imgBigBg.gray = '';
				this.imgStatus.skin = 'mjgains/single_title2.png';
				imgMjwiteshow = "" ;
				imgcards = '';
			}
            (gradelistarray.zhuang_uid==k) ? visible ="true" : visible = '';
            gradedata[i] = { imgHeadpath : { skin : v.headpath } ,imgListBg:{skin:ListBg},imgCards:{skin:imgcards},txtRecord : { text : v.point+"分" }, imgMjwite:{ visible:imgMjwiteshow},imgZhuang:{ visible:visible},uid:{var : k }};
            i++;
        }   
        this.listGrade.dataSource = gradedata;
		if(gradelistarray.cards)
		{
			for(var p in this.listGrade.dataSource)
			{
				for(var k in gradelistarray.cards[this.listGrade.dataSource[p].uid.var])
				{
					var MJBg=new Images("majiangbg/tile_face_lie_white.png");
					var MJ=new Images();
					MJ.skin=this.getCard(gradelistarray.cards[this.listGrade.dataSource[p].uid.var][k],'small');
					MJBg.x = 0+k*39;
					MJ.x=0+k*39;
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJBg);
					this.listGrade.getCell(p).getChildByName('spriteCardsList').addChild(MJ);
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
}
Laya.class(MJCurrentGains, "MJCurrentGains", MJCurrentGainsUI);
//完场结算
function MJTotleRecord()
{
	MJTotleRecord.super(this);
	this.butClose.on(Event.CLICK,this,this.close); 
	var __proto__ = MJTotleRecord.prototype;
	this.gradelistarray = {'zhuang_uid':'130','user':{'130':{'headpath':'头像','nickname':'昵称','point':6,'win':1},'120':{'headpath':'头像','nickname':'昵称','point':5,'win':0}},'cards':{'130':[1,2,3,4]}};
	__proto__.init = function(gradelistarray)
	{

	}
}