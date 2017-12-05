/********************************************************************
 **游戏进度加载
********************************************************************/
function GameLoad()
{
	GameLoad.super(this);
	Glogin = new GameLogin();
	//regView = new DlgmassageViewDlgView();
	
	var __proto__=GameLoad.prototype;
	
	__proto__.init = function(){
		this.btn_sprite.removeSelf();
    }
	
    __proto__.showBut = function(){
		this.progress_1.removeSelf();
		this.addChild(this.btn_sprite);
		userlogin=this.btn_sprite.getChildByName('userlogin');
		wxlogin=this.btn_sprite.getChildByName('wchat');
		userlogin.on(Laya.Event.CLICK, this , this.showlogin);
		wxlogin.on(Laya.Event.CLICK, this , wx_login);
    }	
	
	
/*    __proto__.showreg = function(){
        regView.init();
        regView.popupCenter = true;
        regView.popup();
    }*/
	
    __proto__.showlogin = function(){
        Glogin = new GameLogin();
        Glogin.init();
        Glogin.popupCenter = true;
        Glogin.popup();
    } 
	
    __proto__.verifyLogin = function(){
		    GL(0,null,"账号验证中");
			
			hr = new HttpRequest();
			hr.send(rootPath+'index.php/Games/games/userinfo.php',null, 'get', 'text'); 
			
			hr.once(Event.COMPLETE, this,function(){
				var str = hr.data;
				var data_ =  JSON.parse(str);
				
				if(data_['login']==1)
				{
					//登陆成功
					userinfo = data_;
					//这里转换场景 转换到选择游戏界面
					
					Laya.loader.load(IMGPATH+"index/index.json", Handler.create(this, function(){
						
						this.destroy();
					    Gindex = new GameIndex();
			            Gindex.init();
			            Laya.stage.addChild(Gindex);
						
					}), null, Loader.ATLAS);
				}
				else
				{
					this.showBut();				
				}
				
				GL(-1);
							
			});
			hr.once(Event.ERROR, this, function(e){
				   GT("对不请，系统繁忙，请稍后再登录",Gttime);
			});       
    }	  
}

Laya.class(GameLoad, "GameLoad", GameLoadUI);

/********************************************************************
 **游戏登陆
********************************************************************/
function GameLogin()
{
	GameLoad.super(this);
	var __proto__ = GameLogin.prototype;
     
	__proto__.init = function(){
        this.btClose.on(Laya.Event.CLICK, this , this.close);
        this.okLogin.on(Laya.Event.CLICK, this , this.oklogin);
        this.username.on(Laya.Event.BLUR, this , this.checkInput);
        this.password.on(Laya.Event.BLUR, this , this.checkInput);
    }
    __proto__.checkInput = function(){
       var flag = true;
       if(this.username.text.length==0)
       {
            this.show_user_info.color = '#ff0400';
            this.show_user_info.text = '用户名不能为空';
            flag = false;
       }else{
            this.show_user_info.color = '#00ff1e';
            this.show_user_info.text = '输入正确';   
       }
       if(this.password.text.length==0)
       {
            this.show_pass_info.color = '#ff0400';
            this.show_pass_info.text = '密码不能为空';
             flag = false;
       }else{
            this.show_pass_info.color = '#00ff1e';
            this.show_pass_info.text = '输入正确';  
       }
       return flag;  
    }
    __proto__.oklogin = function(){
        if(this.checkInput()){
			 GL(Gltime);
			 this.login_fun();
        }
    }
	//登录方法 
	__proto__.login_fun = function()
	{
		hr = new HttpRequest();
		hr.once(Event.COMPLETE, this,function(){
			var str = hr.data;
			
			var data_ =  JSON.parse(str);
			data_=data_['user_info']
			
			if(data_['login']==1)
			{
				//登陆成功
				userinfo = data_;
                //这里转换场景 转换到选择游戏界面
                this.close();
                
                Laya.loader.load(IMGPATH+"index/index.json", Handler.create(this, function(){
					
                    Gload.destroy()	;
                    Gindex = new GameIndex();
			        Gindex.init();
			        Laya.stage.addChild(Gindex);
                    GL(-1);
                }), null, Loader.ATLAS);
			}
			else
			{
                GT(data_,Gttime);				
			}
						
		});
		hr.once(Event.ERROR, this, function(e){
			   GT("对不请，系统繁忙，请稍后再登录",Gttime);
		});
		hr.send(rootPath+'index.php/Games/games/games_login.php', 'user='+this.username.text+'&pass='+this.password.text+'', 'post', 'text');
	}
}
Laya.class(GameLogin, "GameLogin", GameLoginUI); 

/********************************************************************
 **游戏首页index
********************************************************************/

function GameIndex()
{
    GameIndex.super(this);
	var __proto__ = GameIndex.prototype;
    var GameListUrl = rootPath+'index.php/Games/games/against_games_list.php';//游戏列表API
    var g = new HttpRequest();
    var data_ = [];//游戏列表数组
    __proto__.init = function()//初始化
    {
		SoundManager.playMusic(PUBLIC+"poker/sound/lord_lobby_bg.mp3", 0);
		
        g.once(Event.COMPLETE, this,function(){
            data_ = JSON.parse(g.data);
            var Gnum = data_.length;
            var Gdata = [];
            for(i=0;i<Gnum;i++)
            {
                gamethumbUrl = data_[i].img.replace(/\\/g,'/') 
                Gdata[i] = { gamename : { text : data_[i].name } , gamethumb : { skin : gamethumbUrl , var : data_[i].sign }};
            }
            this.gamelist.dataSource = Gdata;
            this.gamelist.mouseHandler = new Laya.Handler(this,this.onMouse);
        });
        g.send(GameListUrl,'','post','text');
        this.nickname.text = userinfo.nickname;//初始化
        if(userinfo.headpath){
            this.headpath.skin = userinfo.headpath;
        }
        this.id.text = "id:"+userinfo.id;//初始化
        this.money.text = userinfo.money;//初始化
        this.point.text = userinfo.point;//初始化
		
        this.headpath.on(Event.CLICK, this , this.quit);
    }
    __proto__.onMouse = function(e,index)
    {
        //console.log(e.type,index);
        if(e.type == 'click'){
			     	
                 SoundManager.playSound(PUBLIC+"poker/sound/diploma_sound_aw_item.mp3", 1);
				 GL(Gltime)
                 var GameInfo = data_[index];
				 sign=GameInfo.sign;
				 eval(sign+"()");
				 
        }
    }

    __proto__.quit = function()
    {
		GL(0,null,"正在安全退出");
		hr = new HttpRequest();
		hr.once(Event.COMPLETE, this,function(){
			var str = hr.data;
			var data_ =  JSON.parse(str);
			
			if(data_['login']==0)
			{
				userinfo ={};
                Laya.loader.load(IMGPATH+"index/index.json", Handler.create(this, function(){
                    Gindex.destroy();
					Gload = new GameLoad();
			        Gload.init();
			        Gload.showBut()
			  Laya.stage.addChild(Gload);
					
                    GL(-1);
                }), null, Loader.ATLAS);
			}		
		});
		hr.once(Event.ERROR, this, function(e){
			   GT("对不请，系统繁忙，请稍后再登录",Gttime);
		});
		hr.send(rootPath+'index.php/Games/Games/games_quit.php',null, 'get', 'text');         
    }	
	
}
Laya.class(GameIndex, "GameIndex", GameIndexUI); 

/********************************************************************
 **游戏加载进度显示
********************************************************************/

function AgainstGameLoad()
{
    AgainstGameLoad.super(this);
	this.time=0;
	this.text="";
	this.loadText="";
	this.Open=false;
	var __proto__ = AgainstGameLoad.prototype;

    __proto__.init = function()//初始化
    {
		 if(this.isPopup) return false;
		 this.time= arguments[1] ? arguments[1] : 0;
		 this.text = arguments[2] ? arguments[2] : "加载超时，请关闭重新操作";
		 this.loadText = arguments[0] ? arguments[0] : "正在加载中";
         this.changeText="";
         this.Open=this.time>0?true:false;
		 
		 Laya.timer.clearAll(this);
		 
         this.zOrder=1000;
         this.popup()
		 this.but_close.removeSelf();
		 this.load_img.frameLoop(1, this, this.animateImg);
		 this.load_text.timerLoop(1000, this, this.animateText);
		 
		 if(this.time)
		 {
			 this.timerOnce(this.time * 1000, this, this.butClose);
		 }

    }
	
    __proto__.animateImg = function()//初始化
    {
         this.load_img.rotation += 10;
    }	
	
    __proto__.animateText = function()//初始化
    { 

		 if(this.Open)
		 {
			 if(this.time-1>=1)
			 {
				 txt=this.loadText?this.loadText+"("+(--this.time)+")":"剩余加载时间("+(--this.time)+"s)";
				 this.setText(txt);
			 }
			 else
			 {
				  
				  txt=this.text;
				  this.load_text.text=txt;
				  //this.load_text.clear(this,this.animateText);
			 }
		 } 
		 else
		 {
			 txt=this.loadText;
			 this.setText(txt);
		 }		 
		 
    }
	
    __proto__.setText = function(txt)//初始化
    {
		 this.changeText=this.changeText+"。";
		 if(this.changeText.length>5)
		 {
			 this.load_text.text=txt;
			 this.changeText="";
		 }
		 else
		 {
			 this.load_text.text=txt+this.changeText;
		 }
    }	
	
    __proto__.butClose = function()//初始化
    {
         this.addChild(this.but_close);
		 this.but_close.on(Event.CLICK, this, this.close);;
    }		
	
	
}
Laya.class(AgainstGameLoad, "AgainstGameLoad", AgainstGameLoadUI);


/********************************************************************
 **游戏提示弹出信息
********************************************************************/

function AgainstGameToast()
{
    AgainstGameToast.super(this);
	this.time=0;
	var __proto__ = AgainstGameToast.prototype;

    __proto__.init = function()//初始化
    {
		 Laya.timer.clear(this,this.animate);
		 text= arguments[0] ? arguments[0] : "";
		 this.time = arguments[1] ? arguments[1] : 0;
         this.toast_text.text=text;
		 this.zOrder=1001;
		 this.alpha=1;
		 this.but_close.on(Event.CLICK, this, this.close);
         this.popup()
		 
		 
		 if(this.time>0) this.timerOnce(this.time * 1000, this, this.animateFun);

    }
	
    __proto__.animateFun = function()//初始化
    {
         this.timerLoop(200, this, this.animate);
    }	
	
    __proto__.animate = function()//初始化
    { 
          this.alpha -=0.2;
		  
		  if(this.alpha<=0)
		  {
			  Laya.timer.clear(this,this.animate);
			  this.close();
		  }
    }
}
Laya.class(AgainstGameToast, "AgainstGameToast", AgainstGameToastUI);


 
