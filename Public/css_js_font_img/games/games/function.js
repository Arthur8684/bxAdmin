// JavaScript Document
//注册事件监听
function connectWebViewJavascriptBridge(callback) {
   var u = navigator.userAgent;
   if(u.indexOf('Android') > -1 || u.indexOf('Adr') > -1)
   {
	     if (window.WebViewJavascriptBridge) {
			 callback(WebViewJavascriptBridge)
		 } else {
			 document.addEventListener(
				 'WebViewJavascriptBridgeReady'
				 , function() {
					 callback(WebViewJavascriptBridge)
				 },
				 false
			 );
		 }   
   }
   else
   {
		if (window.WebViewJavascriptBridge) { return callback(WebViewJavascriptBridge); }
		if (window.WVJBCallbacks) { return window.WVJBCallbacks.push(callback); }
		window.WVJBCallbacks = [callback];
		var WVJBIframe = document.createElement('iframe');
		WVJBIframe.style.display = 'none';
		WVJBIframe.src = 'https://__bridge_loaded__';
		document.documentElement.appendChild(WVJBIframe);
		setTimeout(function() { document.documentElement.removeChild(WVJBIframe) }, 0)			   
   }
}




//注册回调函数，第一次连接时调用 初始化函数
connectWebViewJavascriptBridge(function(bridge) {

   bridge.registerHandler("returnWxlogin", function(responseData, responseCallback) {
			if(responseData)
			{
				  //alert(GC.RoomPath);
				  GL(GC.Gltime,"登陆超时，请重新登录","账号验证中");
				  var data =JSON.parse(responseData);// eval('(' + responseData + ')');
				  var post_data="headpath="+data.headimgurl+"&sex="+( (data.sex=="男" || data.sex=="1") ?1:0)+"&nickname="+data.nickname+"&openid="+data.openid;
				  
				  hr = new HttpRequest();
				  hr.once(Event.ERROR, this, function(){GT('系统繁忙，请稍后再试',GC.Gttime);});
				  hr.send(GC.RoomPath+'index.php/Games/Games/games_Wxlogin.php', post_data, 'post', 'text');
				  hr.once(Event.COMPLETE, this, function(){
					     var returnData = hr.data;
			             var data_ =  JSON.parse(returnData);
						 
						 if(data_.login==1)
						 {
								GU = data_;
								MJload.destroy();
								
								MJindex = new MJIndex();
								MJindex.init();
								Laya.stage.addChild(MJindex);
								GL(-1);							 
						 }
						 else
						 {
							   MJload.butWchat.gray = 'false';
							   MJload.butWchat.mouseEnabled = 'true';
							   GT(data_.content,GC.Gttime);
						 }
				  });	

			  }else{
				 MJload.butWchat.gray = 'false';
				 MJload.butWchat.mouseEnabled = 'true';
				 GT('系统繁忙，请稍后再试',GC.Gttime);
			  }
			  
			  responseCallback("登陆成功")
   });  
   
   //上传语音后
   bridge.registerHandler("uploadFinish", function(responseData, responseCallback) {
			if(responseData)
			{
				 path = responseData.path;
				 
				 if(path)
				 {
					 path= responseData.path;
				     p= responseData.p;

				 }
				 else
				 {
					 var data =JSON.parse(responseData);
                     path= data.path;
				     p= data.p;
				 }
				 
				 GMJRoom.send({action:'game_message',path:path,p:p});
			}else{
               alert("SSSS")
			}
			  
			responseCallback("登陆成功")
   }); 
   
   //上传语音后带的参数
   bridge.registerHandler("TapeButtomP", function(responseData, responseCallback) { 
			responseCallback("11111")
   }); 
   
      //播放完语音后
   bridge.registerHandler("soundPlayFinish", function(responseData, responseCallback) { 
			var data =JSON.parse(responseData);
			
			playP={p:data.p}
			if(!GMJRoom.MJChat) GMJRoom.MJChat = new MJChat();
			GMJRoom.MJChat.play_sound_close(playP);

   });    
   //获取坐标
   bridge.registerHandler("getPoint", function(responseData, responseCallback) { 
            
			GC.location={};
            if(responseData)
			{
				var data =JSON.parse(responseData);
				GC.location.x=data.x;
				GC.location.y=data.y;
				
			}
			responseCallback('11111')
   });         
})

function wx_login() {
	 //调用本地java方法
	 //第一个参数是 调用java的函数名字 第二个参数是要传递的数据 第三个参数js在被回调后具体执行方法，responseData为java层回传数据
	 connectWebViewJavascriptBridge(function(bridge) {
		 var data='wx';
		 bridge.callHandler(
		 'wxLogin'
		 ,data
		 , function(responseData) {
			callback("")
		 }) 
	 })		    
}


function appSoundPaly(p,type)
{
	 
	 if(type == 1)
	 {
		 connectWebViewJavascriptBridge(function(bridge) {
			 var data=p;
			 //alert("调用APP声音函数成功，传入参数文件名称："+data)
			 bridge.callHandler(
			 'startPlayBg'
			 ,data
			 , function(responseData) {
				callback("")
			 }) 
		 })			 
	 }
	 else if(type == 2)
	 {
		 connectWebViewJavascriptBridge(function(bridge) {
			 var data=p;
			 bridge.callHandler(
			 'endPlayBg'
			 ,data
			 , function(responseData) {
				callback("")
			 }) 
		 })		 
	 }
	 else if(type == 5)
	 {
		 connectWebViewJavascriptBridge(function(bridge) {
			 var data=p;
			 bridge.callHandler(
			 'startPlay'
			 ,data
			 , function(responseData) {
				callback("")
			 }) 
		 })		 
	 }
	 else
	 {
		 connectWebViewJavascriptBridge(function(bridge) {
			 var data=p;
			 bridge.callHandler(
			 'soundPlay'
			 ,data
			 , function(responseData) {
				callback("")
			 }) 
		 })		 
	 }		
}


//分享到微信
function wx_share(shareType,shareData) {
	 //调用本地java方法
	 //shareType 要掉起APP函数名称（1分享到微信好友,2分享到朋友圈） ，要分享的数据
	 var data=shareData;

	 if(data.type == "3" && GC.System.Version && GC.System.Version<5)
	 {
		   GL(GC.Gltime,"加载超时，请重新操作","正在截屏获数据");
		   var canvas = document.getElementById('layaCanvas');
		   $.post(GC.RoomPath+'index.php/games/Ajax/base64upload/',{base64:canvas.toDataURL("image/png")},function(result){
				img  =  result.content.img_path;
				shareData.ico = GC.SiteUrl+"/"+img;
				shareData.type =2;
				GL(-1);
				wx_share(shareType, shareData);
			});
	 }
	 else
	 {
		   switch(shareType)
		   {
			   case 1:
					  functionName =  "shareContent" ;
					  break;
			   case 2:
					  functionName = "shareFriend";
					  break;
			   default:
		   }
		   
		   connectWebViewJavascriptBridge(function(bridge) {
			   
			   bridge.callHandler(
			   functionName
			   ,data
			   , function(responseData) {
				  callback("")
			   }) 
		   })		 
	 }
	 
		    
}

//显示隐藏
function GshowMenu(showType) {
	 //调用本地java方法
	 //showType 0隐藏 1显示
	 var data = String(showType); 
	 connectWebViewJavascriptBridge(function(bridge) {
		 
		 bridge.callHandler(
		 'showMenu'
		 ,data
		 , function(responseData) {
			callback("")
		 }) 
	 })		    
}

//显示隐藏
function GshowTapeButtom(showType) {
	 //调用本地java方法
	 //showType 0隐藏 1显示享的数据
	var data = String(showType); 
	 connectWebViewJavascriptBridge(function(bridge) {
		 
		 bridge.callHandler(
		 'showTapeButtom'
		 ,data
		 , function(responseData) {
			callback("")
		 }) 
	 })		    
}

function GT(content,Gttime)
{
	 if(Gl.isPopup) Gl.close();
	 if(!Gt) Gt=new GameToast();
	 Gt.init(content,Gttime);
}

function GL(gttime,text,loadText)
{
	 if(gttime==-1)
	 {
		 if(Gl.isPopup) Gl.close();
	 }
	 else
	 {
		 if(!Gl) Gl=new GameLoad()
	     Gl.init(loadText,gttime,text)
	 }
	 
}

function loadjs(array,callback)
{
	if(array.length>0)
	{
		url=array.shift();
		$.getScript(url, function(){
            loadjs(array,callback); 
		});
	}
	else
	{
		callback();
	}
}

/*判断是否在数组中*/
function inArray(v,array)
{
	  var i = array.length;  
	  while (i--) {  
		  if (array[i] === v) {  
			  return true;  
		  }  
	  }  
	  return false;
}

/*播放声音或者音效*/
function soundPlay(url,type,p,autoReleaseSound,loops,complete,startTime,soundClass)
{
	  url=arguments[0] ? arguments[0] : null;
	  type=arguments[1] ? arguments[1] : null;
	  loops=arguments[2] ? arguments[2] : (type ? 0 : 1);
	  complete=arguments[3] ? arguments[3] : null;
	  startTime=arguments[4] ? arguments[4] : 0;
	  soundClass=arguments[5] ? arguments[5] : null;
	  SoundManager.autoStopMusic = true;
	  SoundManager.autoReleaseSound = false;
	  
	  if(isAppSoundPlay())
	  {
		   if(type == 1)
		   {
			    if(GC.Sound.musicMuted)
				{
					 parm = url;
					 appSoundPaly(parm,1);
				}			    
		   }
		   else if(type == 5)
		   {
			    if(GC.Sound.soundMuted)
				{
					 parm = {path:GC.SiteUrl+url,p:p+""};
					 appSoundPaly(parm,5);
				}			   
		   }
		   else
		   {
			    if(GC.Sound.soundMuted)
				{
					 parm = {path:url,p:p+""};
					 appSoundPaly(parm);
				}			   
		   }
	  }
	  else
	  {
		   if(type == 1)
		   {
			   return SoundManager.playMusic(url,loops,complete,startTime);
		   }
		   else
		   {
               return SoundManager.playSound(url,loops,complete,soundClass,startTime);			   
		   }
	  }
}

/*=============================
  设置音量
  type 1设置背景音量,2设置音效音量
  num  设置的音量(0-1)
=============================*/
  
function setSoundVolume(num,type)
{
	  if(type == 1)//设置背景音量
	  {
		   SoundManager.setMusicVolume(num);
	  }
	  else
	  {
		   SoundManager.setSoundVolume(num);
	  }
}

/*=============================
  设置静音
  type 1设置背景静音,2设置音效静音
  num  0设置为静音 1不设置静音
=============================*/
function setSoundMuted(num,type)
{
	  if(type == 1)//设置背景音
	  {
		    GC.Sound.musicMuted= num;
			LocalStorage.setItem("musicMuted",num)
		   if(num == 0)
		   {
			   appSoundPaly("",2)
			   SoundManager.musicMuted = true;
		   }
		   else
		   {
			   soundPlay(GC.SoundMusic,1);
			   SoundManager.musicMuted = false;
			   
		   }
	  }
	  else
	  {
		    GC.Sound.soundMuted= num;
			LocalStorage.setItem("soundMuted",num)
		   if(num == 0)
		   {
			   SoundManager.soundMuted = true;
		   }
		   else
		   {
			   SoundManager.soundMuted = false;
		   }
	  }
}

/*=============================
  关闭声音
  type 1背景音乐,2音效 其他表示停止所有声音
=============================*/
function closeSound(type)
{
	  if(type == 1)//设置背景音
	  {
		  SoundManager.stopMusic();
	  }
	  else if(type == 2)
	  {
		  SoundManager.stopSound();
	  }
	  else
	  {
		  SoundManager.stopAll();
	  }
}

function isAppSoundPlay()
{
	 return true;
/*	 var userAgent = navigator.userAgent;   
	 var index = userAgent.indexOf("Android")  
	 if(index >= 0){  
	   var androidVersion = parseFloat(userAgent.slice(index+8));   
	   if(androidVersion<5) return true
	 } */
}
function convertCanvasToImage(){
	var canvas = document.getElementById('layaCanvas');
	var img = null;

	$.post(GC.RoomPath+'index.php/games/Ajax/base64upload/',{base64:canvas.toDataURL("image/png")},function(result){
		img  =  result.content.img_path;
		alert(img);
		wx_share(1, {ico:'http://demo.cowcms.com/'+img,url:'https://xcx.78wa.com/dapp/dapp.html',title:'明花麻将',describe:'快来和我一起玩汾西明花吧',type:'2'});
		alert(img);
		//return img;
	});
	
}