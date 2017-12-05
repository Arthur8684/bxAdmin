// JavaScript Document
var Sprite  = Laya.Sprite;
var Event   = Laya.Event;
var Stage   = Laya.Stage;
var Button   = Laya.Button;
var Browser = Laya.Browser;
var Handler = Laya.Handler;
var WebGL   = Laya.WebGL;
var Text    = Laya.Text;
var Images = Laya.Image;
var Loader  = Laya.Loader;
var LocalStorage  = Laya.LocalStorage;
var Socket = Laya.Socket;
var Ease    = Laya.Ease;
var Tween   = Laya.Tween;
var Dialog  = Laya.Dialog;
var DialogManager  = Laya.DialogManager;
var Texture = Laya.Texture;
var Point = Laya.Point;
var SoundManager = Laya.SoundManager;
var HttpRequest = Laya.HttpRequest;
var CLASS$=Laya.class;
var STATICATTR$=Laya.static;
var View=laya.ui.View;
var Geolocation = Laya.Geolocation;
var Position    = Laya.Position;
//var Dialog=laya.ui.Dialog;

var MJload;
var MJindex;
var GMJRoom;

//全局变量
var Gl = null;
var Gt = null;
var GU={};
var GC={ 
         RoomPath:"/",//根目录
         Gltime:60,//加载弹出超时时间
		 Gttime:5,//提示弹出消失时间
		 T:"mb1",//全局模板
		 Tindex:'mb2',//游戏开始页面模板
		 Tload:'mb2',//游戏加载页面模板
		 ResPath:"Public/css_js_font_img/games/",//游戏资源路径
		 SoundDir:"majiang/sound1/", //musicVolume：背景音乐音量，musicMuted：音效是否为，静 soundVolume：音效音量，soundMuted：音效是否为静音
		 Sound:{musicVolume:0,musicMuted:1,soundVolume:0,soundMuted:1},
		 System:{},//手机系统
	   };
	   GC.ResPath=GC.RoomPath+GC.ResPath;
	   GC.SoundDir=GC.ResPath+GC.SoundDir;

function init()
{

		getSys();  
		
		if(GC.System.Version >= 5) 
		{
			Laya.init(1366, 768, WebGL);
		}
		else
		{
			Laya.init(1366, 768);
		}
		
		//LocalStorage.support = true;
		//Laya.init(1366, 768);
		Laya.stage.alignV = Stage.ALIGN_MIDDLE;
		Laya.stage.alignH = Stage.ALIGN_CENTER;
		Laya.stage.screenMode = Stage.SCREEN_HORIZONTAL;
		Laya.stage.scaleMode = "fixedwidth";
		Laya.stage.bgColor = "#FFF";
		UIConfig.closeDialogOnSide=false;
		
		//Laya.Stat.show(0,0);
		GshowTapeButtom(0);//隐藏语音按钮
		GshowMenu(0);//隐藏状态栏

		Dialog.manager.closeEffectHandler=null;
		Dialog.manager.popupEffectHandler = null;
		
}



/********************************************************************
 **游戏加载进度显示
********************************************************************/
var GameLoadUI=(function(_super){
		function GameLoadUI(){
			
		    this.load_text=null;
		    this.load_img=null;
		    this.but_close=null;

			GameLoadUI.__super.call(this);
		}

		CLASS$(GameLoadUI,'ui.GameLoadUI',_super);
		var __proto__=GameLoadUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameLoadUI.uiView);
		}

		STATICATTR$(GameLoadUI,
		['uiView',function(){return this.uiView={"type":"Dialog","props":{"width":850,"height":200},"child":[{"type":"Image","props":{"y":40,"x":0,"skin":"gameload/bg.png"}},{"type":"Text","props":{"y":89,"x":178,"width":613,"var":"load_text","text":"正在加载中","height":40,"fontSize":40,"color":"#fffbfb"}},{"type":"Image","props":{"y":107,"x":96,"width":100,"var":"load_img","skin":"gameload/load.png","pivotY":50,"pivotX":50,"height":100}},{"type":"Image","props":{"y":6,"x":756,"var":"but_close","skin":"gameload/close.png"}}]};}
		]);
		return GameLoadUI;
	})(Dialog);
	
	
function GameLoad()
{
    GameLoad.super(this);
	this.time=0;
	this.text="";
	this.loadText="";
	this.Open=false;
	var __proto__ = GameLoad.prototype;

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
Laya.class(GameLoad, "GameLoad", GameLoadUI);
/********************************************************************
 **游戏加载进度显示完成
********************************************************************/


/********************************************************************
 **游戏提示弹出信息
********************************************************************/	
var GameToastUI=(function(_super){
		function GameToastUI(){
			
		    this.toast_text=null;
		    this.but_close=null;

			GameToastUI.__super.call(this);
		}

		CLASS$(GameToastUI,'ui.GameToastUI',_super);
		var __proto__=GameToastUI.prototype;
		__proto__.createChildren=function(){
		    			View.regComponent("Text",laya.display.Text);

			laya.ui.Component.prototype.createChildren.call(this);
			this.createView(GameToastUI.uiView);
		}

		STATICATTR$(GameToastUI,
		['uiView',function(){return this.uiView={"type":"Dialog","props":{"width":850,"height":200},"child":[{"type":"Image","props":{"y":38,"x":6,"skin":"gameload/bg.png"}},{"type":"Text","props":{"y":56,"x":27,"width":724,"var":"toast_text","valign":"middle","height":108,"fontSize":40,"font":"Arial","color":"#ffffff","align":"center"}},{"type":"Image","props":{"y":1,"x":754,"var":"but_close","skin":"gameload/close.png","name":"close"}}]};}
		]);
		return GameToastUI;
	})(Dialog);



function GameToast()
{
    GameToast.super(this);
	this.time=0;
	var __proto__ = GameToast.prototype;

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
Laya.class(GameToast, "GameToast", GameToastUI);

function getSys()
{
	     var userAgent = navigator.userAgent;  
		 var index = userAgent.indexOf("Android")  
		 if(index >= 0){  
		   var androidVersion = parseFloat(userAgent.slice(index+8));  
		   GC.System.Version =  androidVersion; 
		 }
		 
		 Browser.__init__();
		 
		 if(Browser.onAndroid || Browser.onAndriod)	GC.System.Sys =  "android";
		 if(Browser.onIOS)	GC.System.Sys =  "ios";
		 if(Browser.onIPad)	GC.Device =  "ipad";
		 if(Browser.onIPhone)	GC.Device =  "iphone";
		 if(Browser.onPC)	GC.Device =  "pc";
}
/********************************************************************
 **游戏提示弹出信息完成
********************************************************************/

