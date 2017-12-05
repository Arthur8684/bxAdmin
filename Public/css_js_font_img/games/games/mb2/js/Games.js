GC.MjImg=GC.ResPath+"linfen_4_mj/"+GC.MJT +"/img/";
function MJLoad()
{
	MJLoad.super(this);
	var __proto__ = MJLoad.prototype;
	this.urlUserInfo = GC.RoomPath+'index.php/Games/games/userinfo';
	this.rs = new HttpRequest();
	__proto__.init = function(){
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			if(data.login == 1){
				this.butWchat.skin = 'mjload/Comegamebtn.png';
				this.butWchat.on(Event.CLICK, this ,function(){
					GU = data;
					this.destroy();
					MJindex = new MJIndex();
					MJindex.init();
					Laya.stage.addChild(MJindex);
				});
			}else{
				this.butWchat.on(Laya.Event.CLICK, this ,function(){
					this.butWchat.gray = 'true';
					this.butWchat.mouseEnabled = 'false';
					wx_login();	
				});
			}
		});
		this.rs.send(this.urlUserInfo,'','get','text');
		this.butWchat.removeSelf();
	}
//	__proto__.successHandler = function(p)
//	{
//		alert(p.longitude+p.latitude);
//	}
//	__proto__.onError = function(e) 
//	{
//		if (e.code == Geolocation.TIMEOUT)
//			alert("获取位置超时");
//		else if (e.code == Geolocation.POSITION_UNAVAILABLE)
//			alert("位置不可用");
//		else if (e.code == Geolocation.PERMISSION_DENIED)
//			alert("无权限");
//	}
}
Laya.class(MJLoad, "MJLoad", MJLoadUI);
//游戏首页

function MJIndex()
{
	this.btnlist = [];//底部按钮数组
	this.MJRink = null;
	this.MJActivity = null;//通知公告
	this.MJCreateRoom = null;//创建房间
	this.MJComeRoom = null;//创建房间
	this.MJGains = null; //战绩
	this.MJSetting = null;
	this.MJRequest = null;//邀请
	this.MJAuth = null;//实名认证
	this.MJShop = null;//商城
	this.MJShare = null;//分享
	var TimeLine = Laya.TimeLine;
	this.TimeLine = null;
	this.MJUserInfo = new MJUserInfo();
	this.rs = new HttpRequest();
	this.urlUserQuit = GC.RoomPath+'index.php/Games/games/games_quit';
	this.MJGameShow = null;//信息弹窗
	this.GetInfoUrl = GC.RoomPath+'index.php/games/games/single_information/';
	this.GetIpUrl = GC.RoomPath+'index.php/games/games/user_ip/';
	this.UserInRommUrl = GC.RoomPath+'index.php/games/games/user_in_game/';
	this.B64Url = GC.RoomPath+'index.php/games/Ajax/base64upload/';
	MJIndex.super(this);
	var __proto__ = MJIndex.prototype;
	__proto__.init = function(){
		this.imgCreatRoom.on(Event.CLICK, this , this.CreateRoom);
		//Laya.loader.load("res/atlas/mjjoinroom.json", Handler.create(this, function(){
		GL(GC.Gltime,"加载超时","数据加载中");
		this.boxPicPlayBjg.on(Event.MOUSE_DOWN, this, this.onMouseDown);
		rs = new HttpRequest();
		rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(rs.data);
			newdata = [];
			var i = 0;
			for(var k  in data)
			{
				newdata[i] = {imgPic:{skin:data[k].thumb}} 
				i++;
			}
			this.listPic.dataSource = newdata;
		});
		rs.send(this.GetInfoUrl,'type=5','post','text');
		var locationx = null;
		var locationy = null;
		if(GC.location)
		{
			locationx = GC.location.x;
			locationy = GC.location.y;
		}
		res = new HttpRequest();
		res.once(Event.COMPLETE, this,function(){
			data = JSON.parse(res.data);
			if(!GU.loginip)
			{
				GU.loginip = data.loginip;
			}
			GU.money = data.money;
			(GU.money>0)?this.txtCard.text = Math.ceil(data.money):this.txtCard.text = '0';
		});
		res.send(this.GetIpUrl+'?user_id='+GU.id+'&x='+locationx+'&y='+locationy,'','get','text');
		//}));
		this.imgHeadpath.on(Event.CLICK, this , function(){
			//soundPlay({path:'/upload/games/2017-09-23/59c5d9c809013.aac',p:''},5);
			soundPlay(GC.SoundClick);
			//convertCanvasToImage();
			
//    	var h = Laya.stage.drawToCanvas(100, 100, 0, 0);
//		var canvas= h.getCanvas();
//		//alert(canvas.toDataURL("image/png"));
//		
//		$.post(GC.RoomPath+'index.php/games/Ajax/base64upload/',{base64:canvas.toDataURL("image/png")},function(result){
//				//alert(result.content);
//			 });
			this.MJUserInfo.init();
			this.MJUserInfo.popup();
		});		
		this.imgSetting.on(Event.CLICK, this ,function(){
			if(!this.MJSetting)
			{
				this.MJSetting = new MJSetting();
				this.MJSetting.init();
			}
			soundPlay(GC.SoundClick);
			this.MJSetting.popup();
		});
		this.txtNickname.text = GU.nickname;
		this.imgHeadpath.skin = GU.headpath;
		//this.txtCard.text = Math.ceil(GU.money);
		this.txtId.text = GU.id;
		MJload.destroy();
		Laya.stage.addChild(this);
		array = {'1':{path:'mjIndex/shop_ico.png',ui:'MJShop'},'2':{path:'mjIndex/activity_ico.png',ui:'MJActivity',var:'imgActivity'},'3':{path:'mjIndex/cup_ico.png',ui:'MJGains',var:'imgCap'},'4':{path:'mjIndex/invite_ico.png',ui:'MJRequest',var:'imgRequest'},'5':{path:'mjIndex/ranking_ico.png',ui:'MJRank',var:'imgRank'},'6':{path:'mjIndex/share_ico.png',ui:'MJShare',var:'imgShare'}};
		var i = 0;
        for(var k in array)
        {
            v=array[k];
            this.btnlist[i] = { imgBbtn : { skin:v.path,ui:v.ui}}; 
            i++;
        }
		this.BottomList.dataSource = this.btnlist;
		this.BottomList.renderHandler = new Handler(this, this.onListRender);
		this.imgAddcard.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.MJGameShowFun(1);
			//showMenu("1");
		});
		//this.txtNotic.on(Event.CLICK,this,this.close);
		this.imgPlayFun.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			//showMenu("0");
			this.MJGameShowFun(3);
		});
		this.imgMsg.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.MJGameShowFun(4);
		});
		resUserInRoom = new HttpRequest();
		resUserInRoom.once(Event.COMPLETE, this,function(){
			this.MJGameShowFun(2);
			data = JSON.parse(resUserInRoom.data);
			GC.SiteUrl = data.site_url;
			GC.RoomPath = data.root_path;
			if(data.err == 1)
			{
				this.imgJoinRoom.skin = 'mjIndex/join_room_1.png';
				this.imgJoinRoom.on(Event.CLICK, this , function(data)
				{
					Minghua(data.content.roomid);
				},[data]);
			}
			else
			{
				this.imgJoinRoom.on(Event.CLICK, this , this.ComeRoom);
			}
			GL(-1);
		});
		resUserInRoom.send(this.UserInRommUrl+'?user_id='+GU.id,'','get','text');
	}
	__proto__.B64upload = function(name)
	{
		alert(name);
		res = new HttpRequest();
		res.once(Event.COMPLETE, this,function(){
			alert(res.data);
			data = JSON.parse(res.data);
			//GU.loginip = data;
		});
		res.send(this.B64Url,'base64='+name,'post','text');
	}
	__proto__.onMouseDown = function(e)
	{
		this.boxPicPlayBjg.on(Event.MOUSE_MOVE, this, this.onMouseMove);
		this.boxPicPlayBjg.on(Event.MOUSE_UP, this, this.onMouseUp);
		this.boxPicPlayBjg.on(Event.MOUSE_OUT, this, this.onMouseUp);
	}
	__proto__.onMouseMove = function(e)
	{
		
		var x = this.boxPicPlayBjg.mouseX-234;
		if(x>0)
		{
			this.boxPicPlay.x = 0
		}
		else if(x<-234)
		{
			this.boxPicPlay.x = -234;
		}else
		{
			this.boxPicPlay.x = x;
		}
	}
	__proto__.onMouseUp = function(e)
	{
		if(this.boxPicPlay.x<-117){
			this.boxPicPlay.x = -234
			this.imgXx.skin = 'mjIndex/hall_xx2.png';
		}
		else
		{
			this.boxPicPlay.x = 0;
			this.imgXx.skin = 'mjIndex/hall_xx.png';
		}
		this.boxPicPlayBjg.off(Event.MOUSE_MOVE, this, this.onMouseMove);
		this.boxPicPlayBjg.off(Event.MOUSE_UP, this, this.onMouseUp);
		this.boxPicPlayBjg.off(Event.MOUSE_OUT, this, this.onMouseUp);
		//this.boxPicPlay.x = Laya.stage.mouseX;
	}	
	__proto__.GamesQuit = function()
	{
		this.rs.once(Event.COMPLETE, this,function(){
			this.destroy();
			MJload = new MJLoad();
			MJload.init();
			MJload.progressNum.removeSelf();
			MJload.txtPreNum.removeSelf();
			MJload.addChild(MJload.butWchat);
			Laya.stage.addChild(MJload);
		});
		this.rs.send(this.urlUserQuit,'','get','text');
	}
	__proto__.MJGameShowFun = function(index)
	{
		if(index!=2){GL(GC.Gltime,"加载超时","数据加载中");}
		data =[];
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			if(index!=2){
				if(data!= null)
				{
					if(!this.MJGameShow)
					{
						this.MJGameShow = new MJGameShow();
						this.MJGameShow.init();	
					}
					this.MJGameShow.txtTitle.text = data.title;
					this.MJGameShow.htmlConmtent.height = "364";
					this.MJGameShow.htmlConmtent.innerHTML = data.content;
					(this.MJGameShow.htmlConmtent.height <= this.MJGameShow.panelHtml.height)?this.MJGameShow.panelHtml.vScrollBarSkin = '':this.MJGameShow.panelHtml.vScrollBarSkin = 'public/vscroll.png';
					this.MJGameShow.panelHtml.refresh();
					GL(-1);
					this.MJGameShow.popup();
				}
			}else
			{
				this.txtNotic.text = data.content.replace(/<[^>]+>/g,"");
				this.TimeLine = new TimeLine();
				this.TimeLine.to(this.txtNotic,{x:480, y:0, x:-this.txtNotic.width, y:0},this.txtNotic.width*10,null,0);
				this.TimeLine.play(0,true);										
			}
		});
		this.rs.send(this.GetInfoUrl,'type='+index,'post','text');
	}
	__proto__.onListRender = function(item, index)
	{
		var btn=item.getChildByName('imgBbtn');
    	btn.on(Event.CLICK,this,this.onClickBtn,[index]);
	}
	__proto__.onClickBtn = function(index)
	{
		soundPlay(GC.SoundClick);
		if(this.btnlist[index].imgBbtn.ui == 'MJRank')
		{
			if(!this.MJRink)
			{
				this.MJRink = new MJRink();
				this.MJRink.init();	
			}
			this.MJRink.popup();
		}
		if(this.btnlist[index].imgBbtn.ui == 'MJActivity')
		{
			GL(GC.Gltime,"加载超时","数据加载中");
			if(!this.MJActivity)
			{
				this.MJActivity = new MJActivity();
				this.MJActivity.init();
			}
			this.MJActivity.imgReal.on(Event.CLICK,this,function(){
				this.MJActivity.close();
				GL(GC.Gltime,"加载超时","数据加载中");
				Laya.loader.load([
					{url: MjImg+"mjIndex/mjauth.json",type: Loader.ATLAS},
				], Handler.create(this, function(){
						if(!this.MJAuth)
						{
							this.MJAuth = new MJAuth();
							this.MJAuth.init();
						}
						this.MJAuth.popup();
						GL(-1);
					})
				);
			});
			this.MJActivity.popup();
			GL(-1);
		}
		if(this.btnlist[index].imgBbtn.ui == 'MJGains')
		{
			GL(GC.Gltime,"加载超时","数据加载中");
			if(!this.MJGains)
			{
				this.MJGains = new MJGains();
				this.MJGains.init();
			}
			GL(-1);
			this.MJGains.popup();
		}
		if(this.btnlist[index].imgBbtn.ui == 'MJRequest')
		{
			if(GU.recommend!=0)
			{
				GT('您已经有推荐人了，推荐ID是：'+GU.recommend+'');
			}
			else
			{
				if(!this.MJRequest)
				{
					this.MJRequest =new MJRequest();
					this.MJRequest.init();
				}
				this.MJRequest.popup();
			}
		}
		if(this.btnlist[index].imgBbtn.ui == 'MJShare')
		{
			GL(GC.Gltime,"加载超时","资源加载中");
			if(!this.MJShare)
			{
				this.MJShare = new MJShare();
				this.MJShare.init();
			}
			GL(-1);
			this.MJShare.popup();
		}
		if(this.btnlist[index].imgBbtn.ui == 'MJShop')
		{
			GL(GC.Gltime,"加载超时","数据加载中");
			if(!this.MJShop)
			{
				this.MJShop = new MJShop()
				this.MJShop.init();
			}
			GL(-1);
			this.MJShop.popup();
		}		
	}
	__proto__.CreateRoom = function()
	{
		soundPlay(GC.SoundClick);
		if(!this.MJCreateRoom)
		{
			this.MJCreateRoom = new MJCreateRoom();
			this.MJCreateRoom.init();
		}
		this.MJCreateRoom.popup();
	}
	__proto__.ComeRoom = function()
	{
		soundPlay(GC.SoundClick);
		if(!this.MJComeRoom)
		{
			this.MJComeRoom = new MJComeRoom();
			this.MJComeRoom.init();
		}
		this.MJComeRoom.popup();
	}
}
Laya.class(MJIndex, "MJIndex", MJIndexUI);
//活动公告
function MJActivity()
{
	MJActivity.super(this);
	this.GetInfoUrl = GC.RoomPath+'index.php/games/games/get_games_model';
	this.infodata = [];
	this.titledata = [];
	this.rs = new HttpRequest();
	var __proto__ = MJActivity.prototype;
	__proto__.init = function(){
		this.listTitle.removeSelf();
		GL(GC.Gltime,"加载超时","数据加载中");
		this.rs.once(Event.COMPLETE, this,function(){
			this.infodata = JSON.parse(this.rs.data);
			this.txtNotice.text = this.infodata[0].name;
			this.txtActivity.text = this.infodata[1].name;
			this.changeActivitybg(0);
		    this.addChild(this.listTitle);
			this.txtNotice.on(Laya.Event.CLICK, this , function(){
				soundPlay(GC.SoundClick);
				this.changeActivitybg(0);
			});
			this.txtActivity.on(Laya.Event.CLICK, this , function(){
				soundPlay(GC.SoundClick);
				this.changeActivitybg(1);
			});
			GL(-1);
		});
		this.rs.send(this.GetInfoUrl,'','post','text');
		this.imgClose.on(Laya.Event.CLICK, this , function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
	}
	__proto__.changeActivitybg = function(index){

		this.imgTextbg.skin = 'mjactivity/title_bg_'+(index+1)+'.png';
		if(index == 1)
		{
			this.txtActivity.color = '#ffffff';
			this.txtActivity.strokeColor = '#640100';
			this.txtNotice.color = '#aaaaaa';
			this.txtNotice.strokeColor = '#232323';
		}
		else
		{
			this.txtNotice.color = '#ffffff';
			this.txtNotice.strokeColor = '#640100';
			this.txtActivity.color = '#aaaaaa';
			this.txtActivity.strokeColor = '#232323';			
		}
		var bg ;
		for(var i=0;i<this.infodata[index].model_title.length;i++)
		{
			(i==0)?bg = 'mjcreatroom/createroom_3.png':bg = 'mjcreatroom/createroom_2.png';
			this.titledata[i] = {txtTitle:{text:this.infodata[index].model_title[i].title},imgTitle:{skin:bg},type:index};
		}
		this.listTitle.dataSource = this.titledata;//文章列表
        this.listTitle.mouseHandler = new Laya.Handler(this,this.selectTitle);
		this.htmlMJActivity.height = '380';
		this.htmlMJActivity.innerHTML = this.infodata[index].model_title[0].content[0].content;
		(this.htmlMJActivity.height <= this.panelHtml.height)?this.panelHtml.vScrollBarSkin = '':this.panelHtml.vScrollBarSkin = 'public/vscroll.png';
		this.panelHtml.refresh();
	}
	__proto__.selectTitle = function(e,index)
	{
		var num = this.listTitle.dataSource.length;
		if(e.type == Event.CLICK){
			soundPlay(GC.SoundClick);
			for(var i = 0 ;i< num;i++)
			{
				this.listTitle.getCell(i).getChildByName('imgTitle').skin = 'mjcreatroom/createroom_2.png';
			}
			this.listTitle.getCell(index).getChildByName('imgTitle').skin = 'mjcreatroom/createroom_3.png';
			this.htmlMJActivity.height = '380';
			this.htmlMJActivity.innerHTML = this.infodata[this.listTitle.dataSource[index].type].model_title[index].content[0].content;
			(this.htmlMJActivity.height <= this.panelHtml.height)?this.panelHtml.vScrollBarSkin = '':this.panelHtml.vScrollBarSkin = 'public/vscroll.png';
			this.panelHtml.refresh();
		}
	}
}
Laya.class(MJActivity, "MJActivity", MJActivityUI);
//创建游戏
function MJCreateRoom()
{
	MJCreateRoom.super(this);
	this.getListUrl = GC.RoomPath+'index.php/games/games/get_games_list';
	this.getdataUrl = GC.RoomPath+'index.php/games/games/minghua_create_room';
	var __proto__ = MJCreateRoom.prototype;
	this.rs = new HttpRequest();
	this.data_ = [];//游戏列表
	this.Gdata = [];//游戏列表
	this.Textbgskin;
	this.FirstSet = [];//游戏默认显示的配置
	this.FirstSetData = [];//游戏设置数据
	this.paraUrl = [] ;
	this.GameID = 0;//选择游戏ID
	__proto__.init = function()//初始化
	{
		this.GameList.removeSelf();
		this.RadioList.removeSelf();
		this.imgCreateRoom.removeSelf();
		GL(GC.Gltime,"加载超时","数据加载中");
		this.rs.once(Event.COMPLETE, this,function(){
			this.data_ = JSON.parse(this.rs.data);
			for(i=0;i<this.data_.length;i++)
            {
				(i==0) ? this.Textbgskin="mjcreatroom/createroom_3.png" : this.Textbgskin="mjcreatroom/createroom_2.png";
				this.Gdata[i] = { txtGamename : { text : this.data_[i].name } ,imgTextbg :{ skin : this.Textbgskin }};
            }
			this.GameList.dataSource = this.Gdata;//游戏列表赋值
        	this.GameList.mouseHandler = new Laya.Handler(this,this.selectGameSet);
			this.addChild(this.GameList);
			this.FirstSet = this.showConfig(this.GameID);
			this.RadioList.dataSource = this.FirstSet;//游戏对应设置赋值
			this.RadioList.mouseHandler = new Laya.Handler(this,this.SelectRadio);
			this.addChild(this.RadioList);
			this.addChild(this.imgCreateRoom);
			GL(-1);
		});
		this.rs.send(this.getListUrl,'','post','text');
		this.imgCreateRoom.on(Event.CLICK,this,this.createFunction);
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
	}
	__proto__.selectGameSet = function(e,index)
	{
		 if(e.type == Event.CLICK){
			this.RadioList.removeSelf();
			this.RadioList.dataSource = this.showConfig(index);
			this.addChild(this.RadioList);
		 }
	}
	__proto__.labelsShow = function(pay_key,set_number_key)
	{
		datas = [];
		data = [];
		var pay_index = this.RadioList.getCell(pay_key).getChildByName('butRadio').selectedIndex;
		var set_number_index = this.RadioList.getCell(set_number_key).getChildByName('butRadio').selectedIndex;
		var config= this.data_[this.GameID].config.show_config;
		var i = 0 ;
		for(var k in config)
		{
			if(k == 'pay')
			{
				datas[i] = {id:k,var:config[k]};
				if(k == 'pay') var pay = i;
			}
			else
			{
				datas[i] = {id:k,var:config[k].val};
			}
			if(k == 'set_number'){
				var set_number = i;
				var set_number_num=config[k].val.split(",");
				var set_number_unit = config[k].unit;
			}
			i++;
		}
		var n=0;
		for(var key in datas[pay].var)
		{
			if(key != 'name')
			{
				data[n] = datas[pay].var[key];
				n++;
			}
		}
		(data[pay_index].val.price == 0)?pay_num = 0:pay_num = data[pay_index].val.price.split(",").length;
		var pay_text;
		if(pay_num == 0)
		{
			pay_text = 0+data[pay_index].val.unit;
		}
		else if(pay_num == set_number_num.length)
		{
			pay_text = data[pay_index].val.price.split(",")[set_number_index]+data[pay_index].val.unit;
		}
		else
		{
			pay_text = data[pay_index].val.price.split(",")[0]+data[pay_index].val.unit;
		}
		var label = [];
		var n=0;
		for(var key1 in set_number_num)
		{
			if(n == set_number_index)
			{
				label[n] = set_number_num[key1]+set_number_unit+"(支付"+pay_text+")";
			}else{
				label[n] = set_number_num[key1]+set_number_unit;
			}
			n++
		}
		labels = label.join(",");
		return labels;
	}
	__proto__.SelectRadio = function(e,index)
	{
		 if(e.type == Event.CLICK){
			soundPlay(GC.SoundClickNum);
			var config= this.data_[this.GameID].config.show_config;
			var q = 0;
			for(var k in config)
			{
				if(k == 'set_number') var set_number_num =  q;
				if(k == 'pay') var pay_num =  q;
				q++;
			}
			if(index == set_number_num || index == pay_num) this.RadioList.getCell(set_number_num).getChildByName('butRadio').labels = this.labelsShow(pay_num,set_number_num);
		 }
	}		
	__proto__.showConfig = function(e)//返回游戏配置
	{
		var SetArray = [];
		var config= this.data_[e].config.show_config;
		this.imgCreateRoom.name = this.data_[e].sign;
		var q = 0;
		for(var k in config)
		{
			if(k == 'set_number') var set_number_num =  q;
			if(k == 'set_number') var pay_num =  q;
			q++;
		}
		var num = 0;		
		for(var k in config){
			var data = [];
		    var labels = null;
			if(k != 'pay')
			{
				for(var i=0;i<config[k].val.split(",").length;i++)
				{
					(config[k].unit)?data[i] = config[k].val.split(",")[i]+config[k].unit : data[i] = config[k].val.split(",")[i];
				}
			}else{
				var n=0;
				for(var key in config[k])
				{
					if(key != 'name')
					{
						data[n] = config[k][key].name;
						n++;
					}
				}
			}
			if(k == 'set_number')
			{
				labels = this.labelsShow(pay_num,set_number_num);
			}else{
				labels = data.join(",");
			}
			SetArray[num] = { txtRadioName : { text : config[k].name} ,en:k,butRadio :{ labels :labels}};
			num++
		}
		return SetArray;
	}
	__proto__.createFunction = function()
	{
		for(var i=0;i<this.RadioList.dataSource.length;i++)
		{
			this.paraUrl[this.RadioList.dataSource[i].en] = this.RadioList.getCell(i).getChildByName('butRadio').selectedIndex;
		}
		var urlpath = '{';
		for(var i in this.paraUrl)
		{
			urlpath = urlpath+"\""+i+"\"" + ":\""+this.paraUrl[i]+"\",";
		}
		urlpath = urlpath+"\"start_uid\":\""+GU.id+"\",\"game_sign\":\""+this.imgCreateRoom.name+"\"";
		urlpath = urlpath+"}";
		this.rs.once(Event.PROGRESS, this, function(e){	
		});
		this.rs.once(Event.COMPLETE, this,function(){
			var str = this.rs.data;
			data_ =  JSON.parse(str);
			if(data_.err == 1){
				eval(data_.room.sign+'('+data_.room.room_id+')');
				this.destroy();
			}
			if(data_.err == 2){
				GT(data_.content ,50); 
			} 
		});
		this.rs.once(Event.ERROR, this, function(e){
			GT(e ,50); 
		});
		this.rs.send(this.getdataUrl+"?"+'data='+urlpath, '', 'post', 'text');
	}
}
Laya.class(MJCreateRoom, "MJCreateRoom", MJCreateRoomUI);
//游戏列表
function MJComeRoom()
{
	MJComeRoom.super(this);
	this.getConfigUrl = GC.RoomPath+'index.php/games/games/config';
	this.ComeRoomUrl = GC.RoomPath+'index.php/games/games/minghua_join_room';
	this.config = [];
	this.rs = new HttpRequest();
	var __proto__ = MJComeRoom.prototype;
	this.numarray = {0:1,1:2,2:3,3:4,4:5,5:6,6:7,7:8,8:9,9:12,10:0,11:11};//键盘排列数组
	this.keyboarddata = [];//键盘数组
	this.inpfontsize = 35;
	this.inpwidth = 90;
	this.inpheight = 69;
	this.roomnum;
	__proto__.init = function()
	{
		GL(GC.Gltime,"加载超时","数据加载中");
		this.listKeyboard.removeSelf();
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.txtShownum.on(Laya.Event.CHANGE, this , this.ComeRoomFun);
		for(i=0;i<12;i++)
		{
			this.keyboarddata[i] = {num:{skin:'mjjoinroom/num'+this.numarray[i]+'.png'}};
		}
		this.listKeyboard.dataSource = this.keyboarddata;
		this.listKeyboard.selectEnable = true ;
		this.listKeyboard.selectHandler = Laya.Handler.create(this, this.onSelect, null, false);
		this.addChild(this.listKeyboard);
		this.rs.once(Event.COMPLETE, this,function(){
			this.txtShownum.zOrder = 100;
			this.txtShownum.zOrder = 100;
			this.config = JSON.parse(this.rs.data);
			var w = 880;
			var xz = (880-this.config['room_num']*90)/2;
			this.txtShownum.x = xz;
			var inputtext = new Text();
			inputtext.name='showtexts';
			inputtext.x=xz;
           	inputtext.y=145;
			inputtext.width=this.config['room_num']*90;
			inputtext.height = 73;
			inputtext.leading = 73;
			inputtext.fontSize = 45;
			inputtext.zOrder=101;
			this.addChild(inputtext);   
			var inputnumbg = new Images();
			inputnumbg.name="inputnumbgfirst";
			inputnumbg.skin='public/inputroonnum.png';
			inputnumbg.x=xz;
           	inputnumbg.y=135;
			this.addChild(inputnumbg); 
			var txt = new Text();
			txt.name = "text_0";
			txt.x = xz;
			txt.y=150;	
			txt.font="Microsoft YaHei";
			txt.align="center";
			txt.width = this.inpwidth;
			txt.height = this.inpheight;
			txt.zOrder = 500;
			txt.fontSize = this.inpfontsize;
			txt.leading = this.inpheight;
			this.addChild(txt);
			for(i=0;i<(this.config['room_num']-2);i++)
			{			
				var inputnumbg = new Images();
            	inputnumbg.name="inputnumbg"+i;
				inputnumbg.skin='public/inputroonnum_2.png';
				inputnumbg.x=xz+(i+1)*90;
           		inputnumbg.y=135;
				this.addChild(inputnumbg);
				var txt = new Text();
				txt.name = "text_"+(i+1)+"";
				txt.x = xz+(i+1)*90;
				txt.y=150;	
				txt.font="Microsoft YaHei";
				txt.align="center";
				txt.width = this.inpwidth;
				txt.height = this.inpheight;
				txt.zOrder = 500;
				txt.fontSize = this.inpfontsize;
				txt.leading = this.inpheight;
				this.addChild(txt);
			}
			var inputnumbg = new Images();
			inputnumbg.name="inputnumbglast";
			inputnumbg.skin='public/inputroonnum_3.png';
			inputnumbg.x=xz+(i+1)*90;
           	inputnumbg.y=135;
			this.addChild(inputnumbg);
			var txt = new Text();
			txt.name = "text_"+(i+1)+"";
			txt.x = xz+(i+1)*90;
			txt.y=150;	
			txt.font="Microsoft YaHei";
			txt.align="center";
			txt.width = this.inpwidth;
			txt.height = this.inpheight;
			txt.zOrder = 500;
			txt.fontSize = this.inpfontsize;
			txt.leading = this.inpheight;
			this.addChild(txt);
			GL(-1);
		});
		this.rs.send(this.getConfigUrl,'','post','text');
	}
	__proto__.onSelect = function(index)
    {
		soundPlay(GC.SoundClickNum);
		this.listKeyboard.getCell(index).getChildByName('num').gray = 'true';
		this.timerOnce(100,this,function()
		{
			this.listKeyboard.getCell(index).getChildByName('num').gray = '';
		});
		if(index == 11)
        {
            var text_val = this.txtShownum.text;
            this.txtShownum.text = text_val.slice(0,text_val.length-1);
			if(this.txtShownum.text.length<this.config['room_num'])
			{
					this.getChildByName("text_"+this.txtShownum.text.length+"").text = '';
			}
        }else if(index == 9)
        {
            this.txtShownum.text = '';
			for(i=0;i<(this.config['room_num']);i++)
			{
				this.getChildByName("text_"+i+"").text = '';
			}
        }else
        {
            this.inponnum(this.numarray[index]);
        }
    }
	__proto__.inponnum = function(h)
	{
        var text_val = this.txtShownum.text;
        if(text_val.length < this.config['room_num'])
        {
            this.txtShownum.text = ""+text_val+""+h;
			this.getChildByName("text_"+(this.txtShownum.text.length-1)+"").text = h;
			//this.getChildByName('showtexts').text = ""+this.getChildByName('showtexts').text+""+"   "+h+"  ";
        }
    }
	//进入游戏
	__proto__.ComeRoomFun = function()
	{
		if(this.txtShownum.text.length == this.config['room_num'])
		{
            this.rs.once(Event.COMPLETE, this,function(){
                var data =  JSON.parse(this.rs.data);
                if(data.err == 1){
					eval(data.room.sign+'('+data.room.room_id+')');
					this.destroy();
                }
                if(data.err == 2){
					GT(data.content ,50); 
                }              
            });
            this.rs.once(Event.ERROR, this, function(e){
				GT(e ,50);	
            });
			this.rs.send(this.ComeRoomUrl, 'room_sn='+this.txtShownum.text+'&user_id='+GU.id, 'post', 'text');
		}
	}
}
Laya.class(MJComeRoom, "MJComeRoom", MJComeRoomUI);
//战绩列表
function MJGains()
{
	MJGains.super(this);
	var __proto__ = MJGains.prototype;
	this.ListUrl = GC.RoomPath+'index.php/games/games/query_record';
	this.rs = new HttpRequest();
	this.pagesize = 10;
	this.page = 1;
	this.sign = 'minghua';
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.show_content(1);
		this.txtNextpage.on(Event.CLICK,this,function(){
			if(this.listGains.dataSource.length==this.pagesize){
				this.show_content((this.page+1));
			}
		});
		this.txtPrev.on(Event.CLICK,this,function(){
			if(this.page>1){
				this.show_content((this.page-1));
			}else
			{
				this.page =1;
			}
		});
	}
	__proto__.showPageInfo = function(page)
	{	
		this.txtPage.text = page;	
	}
	__proto__.show_content = function(page)
	{
		this.page = page;
		GL(GC.Gltime,"加载超时","战绩加载中");
		this.listGains.removeSelf();
		this.rs.once(Event.COMPLETE, this,function(){
            var data =  JSON.parse(this.rs.data);
			if(data == null)
			{
				//alert(page);
				GL(-1);
				GT('没有数据了',3);
				this.show_content(this.page-1);	
			}
			if(data.err == 0){
				var i = 0; 
				dataBase = [];
				for(var k in data.content)
				{
					var datatimes = new Date(parseInt(data.content[k][0].addtime) * 1000).toLocaleString().substr(0,22) ;
					dataBase[i] = {txtNum:{text:(page-1)*this.pagesize+(i+1)},txtRoomNum:{text:'房号:'+data.content[k][0].room_sn},txtTime:{text:datatimes}};
					i++;
				}
				this.listGains.dataSource = dataBase;
				for(var k in dataBase)
				{
					Userdata = [];
					for(var q=0;q<data.content[k].length;q++)
					{
						
						Userdata[q] = {txtNickname:{text:data.content[k][q].nickname},txtPoint:{text:data.content[k][q].point}}
					}
					this.listGains.getCell(k).getChildByName('listUserlist').dataSource = Userdata;	
				}
				this.showPageInfo(page);
				//this.listGains.startIndex(2);
				//	
				this.addChild(this.listGains);
				GL(-1);
			}else{
				if(this.page>1)
				{
					GL(-1);
					GT(data.content,3);
					this.show_content(this.page-1);	
				}
				else
				{
					GL(-1);
					GT('没有数据了',3);	
				}
			}
		})
		this.rs.send(this.ListUrl,'user_id='+GU.id+'&pagesize='+this.pagesize+'&page='+this.page+'&sign='+this.sign+'','post','text');
	}
}
Laya.class(MJGains, "MJGains", MJGainsUI);

//信息显示
function MJGameShow()
{
	MJGameShow.super(this);
	var __proto__ = MJGameShow.prototype;
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
	}
}
Laya.class(MJGameShow, "MJGameShow", MJGameShowUI);

//排行榜
function MJRink()
{
	MJRink.super(this);
	var __proto__ = MJRink.prototype;
	this.ListUrl = GC.RoomPath+'index.php/games/games/ranking_list';
	this.rs = new HttpRequest();
	this.sign = 'minghua';
	__proto__.init = function()
	{
		this.listRink.removeSelf();
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.listdatabase(1);
		this.boxThis.on(Event.CLICK,this,function(){
			this.listdatabase(1);
			this.boxThis.gray = '';
			this.boxLast.gray = 'true';
		});
		this.boxLast.on(Event.CLICK,this,function(){
			this.listdatabase(2);
			this.boxThis.gray = 'true';
			this.boxLast.gray = '';
		});
	}
	__proto__.listdatabase = function(index)
	{
		GL(GC.Gltime,"加载超时","数据加载中");
		this.listRink.removeSelf();
		data = [];
		returndata = [];
		this.rs.once(Event.COMPLETE, this,function(){
			data =  JSON.parse(this.rs.data);
			var Winimg;
			var Wintext;
			if(data.err == 1)
			{
				if(data.content.user_rank != null)
				{
					this.txtShowUser.text = '您本次排名 '+data.content.user_rank.rank+' 名';
				}
				else
				{
					this.txtShowUser.text = '您未上榜';
				}
				var y=0;
				for(var i in data.content)
				{
					if(i!='user_rank'){
						if(y<3)
						{
							Winimg='mjrink/win'+(y+1)+'.png'
							Wintext='';
						}
						else
						{
							Winimg=''
							Wintext=(y+1);
						}
						returndata[y] = {
							txtNum:{text:Wintext},
							txtNickname:{text:data.content[i].nickname}, 
							imgNum:{skin:Winimg},
							imgHeadpath:{skin:data.content[i].headpath},
							txtJs:{text:'共'+data.content[i].count+'局'}
						}
						y++;
					}
				}
				this.listRink.dataSource = returndata;
				this.addChild(this.listRink);
			}
			GL(-1);
		});
		this.rs.send(this.ListUrl,'user_id='+GU.id+'&type='+index+'&sign='+this.sign+'','post','text');
	}
}
Laya.class(MJRink, "MJRink", MJRinkUI);
//游戏设置
function MJSetting()
{
	MJSetting.super(this);
	var __proto__ = MJSetting.prototype;
	__proto__.init = function()
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
		this.imgMonoff.on(Event.CLICK,this,this.MusicOnOff);
		this.imgSonoff.on(Event.CLICK,this,this.SoundOnOff);
		this.imgLoginOut.on(Event.CLICK,this,function()
		{
			soundPlay(GC.SoundClick);
			this.close();
			MJindex.GamesQuit();
		});
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
Laya.class(MJSetting, "MJSetting", MJSettingUI);
//实名认证
function MJAuth()
{
	MJAuth.super(this);
	var __proto__ = MJAuth.prototype;
	this.RequestUrl = GC.RoomPath+'index.php/games/games/real_name_authentication';
	this.rs = new HttpRequest();
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.butSubmit.on(Event.CLICK,this,function(){
			GL(GC.Gltime,"加载超时","数据提交，耐心等待");
			this.Submit();
		});
	}
	__proto__.Submit = function()
	{
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			if(data.err==1)
			{
				GL(-1);
				this.close();
				GT(data.content)
			}
			else
			{
				GL(-1);
				//alert(data.content);
				GT(data.content)
			}
		});	
		this.rs.send(this.RequestUrl,'name='+this.inputReal.text+'&card='+this.inputIDnum.text+'&user_id='+GU.id,'get','text');
	}

}
Laya.class(MJAuth, "MJAuth", MJAuthUI);
function MJRequest()
{
	MJRequest.super(this);
	var __proto__ = MJRequest.prototype;
	this.RequestUrl = GC.RoomPath+'index.php/games/games/recommend/';
	this.keyboarddata = [];
	this.rs = new HttpRequest();
	this.numarray = {0:1,1:2,2:3,3:4,4:5,5:6,6:7,7:8,8:9,9:12,10:0,11:11};//键盘排列数组
	__proto__.init = function()
	{
		this.listKeyboard.removeSelf();
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.butSubmit.on(Event.CLICK,this,function(){
			GL(GC.Gltime,"加载超时","数据提交，耐心等待");
			this.Submit();
		});
		for(i=0;i<12;i++)
		{
			this.keyboarddata[i] = {num:{skin:'mjjoinroom/num'+this.numarray[i]+'.png'}};
		}
		this.listKeyboard.dataSource = this.keyboarddata;
		this.listKeyboard.selectEnable = true ;
		this.listKeyboard.selectHandler = Laya.Handler.create(this, this.onSelect, null, false);
		this.addChild(this.listKeyboard);
	}
	__proto__.onSelect = function(index)
    {
		soundPlay(GC.SoundClickNum);
		if(index == 11)
        {
            var inpID = this.inpID.text;
            this.inpID.text = inpID.slice(0,inpID.length-1);
        }else if(index == 9)
        {
            this.inpID.text = '';
        }else
        {
            this.inpID.text = this.inpID.text+this.numarray[index];
        }
    }
	__proto__.Submit = function()
	{
		//GT(Content ,Gttime)
		this.rs.once(Event.COMPLETE, this,function(){
			data = JSON.parse(this.rs.data);
			if(data.err==1)
			{
				GL(-1);
				this.close();
				GT(data.content)
			}
			else
			{
				GL(-1);
				GT(data.content)
			}
		});	
		this.rs.send(this.RequestUrl,'recommend='+this.inpID.text+'&user_id='+GU.id,'post','text');
	}
}
Laya.class(MJRequest, "MJRequest", MJRequestUI);
//商城
function MJShop()
{
	MJShop.super(this);
	var __proto__ = MJShop.prototype;
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
	}
}
Laya.class(MJShop, "MJShop", MJShopUI);
//分享
function MJShare()
{
	MJShare.super(this);
	var __proto__ = MJShare.prototype;
	__proto__.init = function()
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		}); 
		this.imgWx.on(Event.CLICK,this,function(){
			//分享到微信
			//wx_share(1, {ico:'http://demo.cowcms.com/Public/css_js_font_img/games/games/mb2/img/logo.png',url:'',title:'明花麻将',describe:'快来和我一起玩明花麻将吧',type:1});
			wx_share(1, {ico:GC.SiteUrl+'/Public/css_js_font_img/games/games/mb2/img/logo.png',url:'https://xcx.78wa.com/dapp/dapp.html',title:'明花麻将',describe:'快来和我一起玩汾西明花吧',type:'1'});
			//wx_share(1);
			//showTapeButtom('1')
		}); 
		this.imgFriends.on(Event.CLICK,this,function(){
			//分享到朋友圈
			wx_share(2, {ico:GC.SiteUrl+'/Public/css_js_font_img/games/games/mb2/img/logo.png',url:'https://xcx.78wa.com/dapp/dapp.html',title:'明花麻将',describe:'快来和我一起玩明花麻将吧',type:'1'});
			//convertCanvasToImage();

			//wx_share(2, {ico:convertCanvasToImage(),url:'https://xcx.78wa.com/dapp/dapp.html',title:'明花麻将',describe:'快来和我一起玩汾西明花吧',type:'2'});
			//showTapeButtom('0')
			//wx_share(2);
		}); 
	}
}
Laya.class(MJShare, "MJShare", MJShareUI);
function MJUserInfo()
{
	MJUserInfo.super(this);
	var __proto__ = MJUserInfo.prototype;
	__proto__.init = function(array)
	{
		this.butClose.on(Event.CLICK,this,function(){
			soundPlay(GC.SoundClick);
			this.close();
		});
		this.nickname.text = GU.nickname;
		this.ip.text = "IP:"+GU.loginip;
		this.id.text = "ID:"+GU.id;
		this.headpath.skin = GU.headpath;
	}
}
Laya.class(MJUserInfo, "MJUserInfo", MJUserInfoUI);
//聊天框
function MJChat()
{
    MJChat.super(this);
    var __proto__ = MJChat.prototype;
	this.TextList = {
		1:'联手，能叫利撒吗？',
		2:'真美呀，上张报牌。',
		3:'不好意思，接了个电话，几拐亿的工程怕误了。',
		4:'联手，你开的碰碰车呀。',
		5:'联手，紧赶撒，等的哈地来啦。',
		6:'真毒哦，今幺你吃上旺旺了吧。',
		7:'麻拉麻拉，打错了，能拈么。',
		8:'真北啊，这是到了茅子里没洗手呀。',
		9:'联手，真是国好把式。',
		10:'好汉不胡前三把。',
	};
    this.FaceList = [];
	for(var i = 1; i<17 ; i++)
	{
		this.FaceList[i] = {skin:'mjface/'+i+'001.png',num:i};
	}
    __proto__.init = function(room)
    { 
		this.chatimg_action();
		this.zOrder = 1000;
		this.butClose.on(Event.CLICK,this,this.close);
		this.closeDialogOnSide = true;
		this.imgChat.on(Event.CLICK, this , this.chatimg_action);//点击聊天图片事件
        this.imgFace.on(Event.CLICK, this , this.faceimg_action);//点击表情图片事件
		this.butSubmit.on(Event.CLICK, this , this.text_action,[room]);//点击表情图片事件
		textdata = [];
		var i=0;
		for(var k in this.TextList)
		{
			textdata[i] = {txtChatlist:{text:this.TextList[k]}}
			i++;
		}
		this.listPreinstall.dataSource = textdata;
		this.listPreinstall.mouseHandler = new Handler(this, this.showTextList,[room]);
		textdata = [];
		i=0;
		for(var k in this.FaceList)
		{
			textdata[i] = {imgFace:{skin:this.FaceList[k].skin,var:this.FaceList[k].num}}
			i++;
		}
		this.listFacelist.dataSource = textdata;
		this.listFacelist.mouseHandler = new Handler(this, this.showFaceList,[room]);
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
	__proto__.showTextList = function(room,e,index)
	{
		if(e.type == Event.CLICK)
		{
			room.send({action:'game_message',mType:1,message:index});
		}
	}
	__proto__.ShowMessage = function(getdata,point,position,sex)
	{
/*		for(var k in point)
		{
			alert(k);
			alert(point[k]);
		}*/
		if(position ==1)
		{
			this.close();
		}
		if(getdata.mType == 1)
		{
			this.show_MJChatbubble(this.TextList[getdata.message+1],{x:point.x,y:point.y,p:position});
			var m = 'g';
			(sex==1)?  m = 'b':  m = 'g';
			closeSound(2);
			soundPlay(m+"_"+(getdata.message+1)+".mp3");
		}
		if(getdata.mType == 2)
		{
			this.show_MJChatbubble(getdata.message,{x:point.x,y:point.y,p:position});
		}
		if(getdata.mType == 3)
		{
			this.play_face(this.FaceList[getdata.message+1].skin, {x:point.x,y:point.y,p:position});
		}				
		//this.show_MJChatbubble(this.listPreinstall.getCell(index).getChildByName('txtChatlist').text,{x:200,y:200});
	}
	__proto__.showFaceList = function(room,e,index)
	{
		if(e.type == Event.CLICK)
		{
			room.send({action:'game_message',mType:3,message:index});
		}
	}
	__proto__.text_action = function(room)
	{
		if(this.inputMsg.text){
			room.send({action:'game_message',mType:2,message:this.inputMsg.text});
			this.inputMsg.text = '';
		}
		else
		{
			GT('确定不说点什么？');
		}
	}
	__proto__.show_MJChatbubble = function(text,position)
	{
		var MJChatbubbles = new MJChatbubble();
		MJChatbubbles.init(text,position);
	}
	//播放语音气泡
	__proto__.play_sound = function(position)
	{
		var Animation = Laya.Animation;
		var AniConfPath = MjImg+"chat/sound_1.json";
		if(position.p==3)
		{
			AniConfPath = MjImg+"chat/sound_2.json";
		}
		Laya.loader.load(AniConfPath, Handler.create(this, function(){
			if(!Laya.stage.contains(Laya.stage.getChildByName("ani"+position.p)))
			{
				var aniSprite = new Sprite();
				aniSprite.x = position.x;
				aniSprite.y = position.y;
				aniSprite.name = "ani"+position.p
			}
			else
			{
				var aniSprite = Laya.stage.getChildByName("ani"+position.p);
				aniSprite.x = position.x;
				aniSprite.y = position.y;
				aniSprite.destroyChildren();
			}
			if(position.p==2)
			{
				aniSprite.x = position.x+45;
				aniSprite.y = position.y-45;
			}
			if(position.p<2)
			{
				aniSprite.x = position.x+45;
				aniSprite.y = position.y-45;
			}
			if(position.p==3)
			{
				aniSprite.x = position.x+45;
				aniSprite.y = position.y+120;
			}
			aniSprite.zOrder = 900;
			var ani = new Animation();
			ani.loadAtlas(AniConfPath); // 加载图集动画
			ani.interval = 500;			// 设置播放间隔（单位：毫秒）
			ani.index = 1; 		// 当前播放索引
			ani.play(); // 播放图集动画
			// 获取动画的边界信息
			var bounds = ani.getGraphicBounds();
			ani.pivot(bounds.width / 2, bounds.height / 2);
			if(position.x && position.y)
			{
				ani.pos(0,0);
			}
			else
			{
				ani.pos(Laya.stage.width / 2, Laya.stage.height / 2);
			}
			aniSprite.addChild(ani);
			Laya.stage.addChild(aniSprite);		
		}), null, Loader.ATLAS);
	}
	__proto__.play_sound_close = function(position)
	{
		Laya.stage.getChildByName("ani"+position.p).destroy();
	}
	__proto__.play_face = function(num,position)
	{
		for(var k in this.FaceList)
		{
			if(num == this.FaceList[k].skin)
			{
				var i = this.FaceList[k].num;
				break;
			}
		}
		var Animation = Laya.Animation;
		var AniConfPath = MjImg+"chat/face/"+i+".json";
		Laya.loader.load(AniConfPath, Handler.create(this, function(){
			if(position.p==0) position.x = position.x + 120;
			if(position.p==1) position.x = position.x + 120;
			if(position.p==3) position.y = position.y + 120;
			if(!Laya.stage.contains(Laya.stage.getChildByName("ani"+position.p)))
			{
				var aniSprite = new Sprite();
				aniSprite.x = position.x;
				aniSprite.y = position.y;
				aniSprite.name = "ani"+position.p
			}
			else
			{
				var aniSprite = Laya.stage.getChildByName("ani"+position.p);
				aniSprite.x = position.x;
				aniSprite.y = position.y;
				aniSprite.destroyChildren();
			}
			aniSprite.zOrder = 900;
			var ani = new Animation();
			ani.loadAtlas(AniConfPath); // 加载图集动画
			ani.interval = 150;			// 设置播放间隔（单位：毫秒）
			ani.index = 1; 		// 当前播放索引
			ani.play(); // 播放图集动画
			// 获取动画的边界信息
			var bounds = ani.getGraphicBounds();
			ani.pivot(bounds.width / 2, bounds.height / 2);
			if(position.x && position.y)
			{
				ani.pos(0,0);
			}
			else
			{
				ani.pos(Laya.stage.width / 2, Laya.stage.height / 2);
			}
			aniSprite.addChild(ani);
			Laya.stage.addChild(aniSprite);
			ani.on(Event.COMPLETE,this,function(){
				var Tween   = Laya.Tween;
				tween = Tween.to(ani,
				{
					alpha : 0,
				}, 100,null,Handler.create(this, function(){
					tween.clear();
					ani.clear();
				}));
				//ani.clear();
			})			
		}), null, Loader.ATLAS);

	}
}
Laya.class(MJChat, "MJChat", MJChatUI); 
//聊天气泡
function MJChatbubble()
{
	MJChatbubble.super(this);
	var __proto__ = MJChatbubble.prototype;
	var Tween   = Laya.Tween;
	__proto__.init = function(text,position)
	{
		this.txtInfo.text = text;
		Math.ceil(this.txtInfo.text.length / 15);
		(this.txtInfo.text.length>15)?l=15:l=this.txtInfo.text.length;
		this.imgBg.width =  l * 22+20;
		this.imgBg.height =20*Math.ceil(this.txtInfo.text.length / 15)+45;
		this.x = 0;//+this.offsetTop;
		this.y = 0;//+this.getOffsetSum(this).left;;//+this.offsetLeft;
		if(!Laya.stage.contains(Laya.stage.getChildByName("ani"+position.p)))
		{
			var aniSprite = new Sprite();
			aniSprite.x = position.x;
			aniSprite.y = position.y-90;
			aniSprite.name = "ani"+position.p
		}
		else
		{
			var aniSprite = Laya.stage.getChildByName("ani"+position.p);
			aniSprite.x = position.x;
			aniSprite.y = position.y-90;
			aniSprite.destroyChildren();
		}
		if(position.p==2)
		{
			this.txtInfo.x = this.txtInfo.x +20;
			this.imgBg.skewY="180";
			this.imgBg.x = this.imgBg.x+this.imgBg.width;
			aniSprite.x = position.x-this.imgBg.width+90;
		}
		aniSprite.zOrder = 900;
//		if(position.p>1)
//		{
//			this.txtInfo.x = this.txtInfo.x +20;
//			this.imgBg.skewY="180";
//			this.imgBg.x = this.imgBg.x+this.imgBg.width;
//			this.x = this.x - 300;
//		}
		if(position.p==3)
		{
//			this.txtInfo.x = this.txtInfo.x +20;
//			this.imgBg.skewY="180";
//			this.imgBg.x = this.imgBg.x+this.imgBg.width;
//			this.y = position.y-this.imgBg.height-90;
			aniSprite.x = position.x +45;
			aniSprite.y = position.y+90;
			this.imgBg.y = this.imgBg.height;
			this.imgBg.x = this.imgBg.x+20;
			this.txtInfo.x = this.imgBg.x-this.imgBg.width+20;
			this.txtInfo.y = this.txtInfo.y+10;
			this.imgBg.skewY="180";
			this.imgBg.skewX="180";	
		}
//		
		aniSprite.addChild(this);
		Laya.stage.addChild(aniSprite);
		this.timerOnce(2000,this, 
			function(){
				tween = Tween.to(this,
				{
					alpha : 0,
				}, 100,null,Handler.create(this, function(){
					tween.clear();
					this.destroy();
				}));
			}                                                                                               
		);
	}
	__proto__.getOffsetSum = function(ele)
	{
		var top= 0,left=0;
		while(ele){
			top+=ele.offsetTop;
			left+=ele.offsetLeft;
			ele=ele.offsetParent;
		} 
		return {
			top:top,
			left:left
		}
	}
}
Laya.class(MJChatbubble, "MJChatbubble", MJChatbubbleUI);
