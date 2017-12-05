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
var Socket = Laya.Socket;
var Ease    = Laya.Ease;
var Tween   = Laya.Tween;
var Dialog  = Laya.Dialog;
var SoundManager = Laya.SoundManager;
var HttpRequest = Laya.HttpRequest;
var SoundManager = Laya.SoundManager;
//全局变量
var Game=null;//游戏的全局变量
var userinfo={};
var Gload=null;
var Gindex=null;
var Gl=null;//游戏进度加载，使用频率比较高
var Gt=null;//弹出提示框
var Glogin;
var GameConfig;
var rootPath="/";
var socket=null;

var GU={};
var GC={ 
         RoomPath:"/",//根目录
         Gltime:20,//加载弹出超时时间
		 Gttime:5,//提示弹出消失时间
		 T:"mb1",//全局模板
		 Tindex:'mb2',//游戏开始页面模板
		 Tload:'mb2',//游戏加载页面模板
		 ResPath:"Public/css_js_font_img/games/",//游戏资源路径
	   };

function init()
{
	    
        Laya.init(1920, 1080, WebGL);
		Laya.stage.alignV = Stage.ALIGN_MIDDLE;
		Laya.stage.alignH = Stage.ALIGN_CENTER;
		Laya.stage.screenMode = Stage.SCREEN_HORIZONTAL;
		Laya.stage.scaleMode = "fixedwidth";
		Laya.stage.bgColor = "#f80c08";	
		UIConfig.closeDialogOnSide=false;
		Browser.__init__();
}



