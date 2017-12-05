var Gift=function()
{
	this.data=[]
	this.Gift_data=[];//礼物数据
	this.container_id; //容器ID
	this.running_state=false;//运行状态 true正运行 false 运行完成
	this.Gift_max=2;// 同时最多显示多少个礼物
	this.W=0;
	this.H=0;
	this.config={};
	
}

Gift.prototype.create=function(container_id,container_css,config)
{
	  this.container_id=container_id;
      var container=$('#'+container_id);
	  container.css(container_css);
	  this.W=container.width();
	  this.H=container.height(); 
	  if(!arguments[4]) config={};
   
	  config.start_color=config.start_color?config.start_color:"#FFF";
	  config.end_color=config.end_color?config.end_color:"#FFF";
	  config.font_size=config.font_size?config.font_size:30; //效果字体大小
	  config.gift_samll_left=config.gift_samll_left?config.gift_samll_left:20; //礼物效果左边距
	  config.gift_samll_top=config.gift_samll_top?config.gift_samll_top:70;//礼物效果右边距
	  config.path=config.path?config.path:'/';
	  this.config=config;	 
	  var queue = new createjs.LoadQueue(true);
	  queue.loadManifest([config.path+"Public/css_js_font_img/img/chat/gift_bg_green.png",config.path+"Public/css_js_font_img/img/chat/gift_bg_gold.png",config.path+"Public/css_js_font_img/img/chat/gift_bg.png"]); 
}

Gift.prototype.set_gift=function(data)
{
	this.Gift_data.push(data);
	this.give_presents();
}

Gift.prototype.give_presents=function()
{
	  Gift_ob=$('.gift_class');
	  Gift_ob_len=parseInt(Gift_ob.length);
	  if(Gift_ob_len>=this.Gift_max) return 0;
	  if(!this.Gift_data) return 1;
	  this.show_give_presents(Gift_ob_len);
       
}
/*{start_color:'',end_color:'',font_size:30}*/
Gift.prototype.show_give_presents=function(Gift_ob_len)
{
	   config=this.config;
	   gift_samll_left=config.gift_samll_left;
	   gift_samll_top=config.gift_samll_top;
	   data=this.Gift_data[0];
	   this.Gift_data.shift()
	   
	   Gift_ob_top= Gift_ob_len * 80+gift_samll_top+ (Gift_ob_len * 10);
	   id="show_"+parseInt(Math.random()*(100+1),10);
	   
	   createjs.CSSPlugin.install(createjs.Tween);   
	   
	   if(data.num >30 && data.num <=100)
	   {
	        container_div="<div id='"+id+"' class='gift_class' style='float:left;background: url("+config.path+"Public/css_js_font_img/img/chat/gift_bg_green.png); width:400px; height:80px; margin:10px; z-index:50;background-repeat: no-repeat;position:absolute;top:"+Gift_ob_top+"px;left:-400px;filter: alpha(opacity=0);opacity:0 !important;'><li style='float:left;height:80px;left:40px;width:150px;padding-left:15px;'><div style='text-shadow:2px 2px 2px #F00;font-size:16px;text-indent:30px;width:100%; overflow:hidden;height:30px;padding-top:10px;font-weight: bold;color:#FF0'>"+data.name+"</div><div style='text-shadow:2px 2px 2px #F00;font-size:16px;text-indent:30px;width:100%; overflow:hidden;height:40px;padding-top:10px;font-weight: bold;color:#FF0'>"+data.gift_title+"</div></li><li style='float:left;height:80px;left:30px;width:100px;'><img  src='"+data.ico+"' style='top:-20px; width:80px ; height:80px; border:none;z-index:55'></li><li style='float:left;height:80px;left:30px;width:150px;'><div id='"+id+"_text' style='text-shadow:3px 3px 3px #000;color:"+config.start_color+";font-family: Verdana, Geneva, sans-serif;font-size:"+config.font_size+"px;font-weight: bold;padding-top:25px;position:absolute;height:80px'>×"+data.num+"</div></li></div>";
			$('#'+this.container_id).append(container_div);
			obj=document.getElementById(id)
            createjs.Tween.get(obj).to({top:Gift_ob_top,left:gift_samll_left,opacity:1}, 200).call(this.repeat_action,[1,data.num,id]);
	   }else if(data.num >100)
	   {
		   text_num={'text_520':'我爱你','text_1314':'一生一世'}
		   
		   show_text=eval('text_num.text_'+data.num)?eval('text_num.text_'+data.num):'永远爱你的朋友';
		   container_div="<div id='"+id+"' class='gift_class' style='float:left;background: url("+config.path+"Public/css_js_font_img/img/chat/gift_bg_gold.png); width:470px; height:80px; margin:10px; z-index:50;background-repeat: no-repeat;position:absolute;top:"+Gift_ob_top+"px;left:-400px;filter: alpha(opacity=1);opacity:1 !important;'><li style='float:left;height:80px;left:30px;width:150px;padding-left:15px;'><div style='font-size:16px;text-indent:30px;width:100%; overflow:hidden;height:40px;padding-top:15px'>"+data.name+"</div><div style='font-size:16px;height:40px;text-indent:30px;width:100%; overflow:hidden;color:#FC0; text-shadow:1px 1px 1px #f00'>"+data.gift_title+"</div></li><li style='float:left;height:80px;left:30px;width:100px;'><img  src='"+data.ico+"' style='top:-20px; width:80px ; height:80px; border:none;z-index:55'></li><li style='float:left;height:30px;left:30px;width:150px;'><div id='"+id+"_text_1' style='text-shadow:3px 3px 3px #B56C00;color:"+config.start_color+";font-family: Verdana, Geneva, sans-serif;font-size:18px;font-weight: bold;padding-top:15px;position:absolute;height:80px'>"+show_text+"</div><div id='"+id+"_text_2' style='text-shadow:1px 1px 1px #000;color:"+config.start_color+";font-family: Verdana, Geneva, sans-serif;font-size:16px;font-weight: bold;padding-top:45px;position:absolute;height:80px'>×"+data.num+"</div></li></div>";
		   	   $('#'+this.container_id).append(container_div);
			   obj=document.getElementById(id)
               createjs.Tween.get(obj).to({top:Gift_ob_top,left:gift_samll_left,opacity:1}, 200).call(this.repeat_action,[1,data.num,id]);
	   }else
	   {
		   container_div="<div id='"+id+"' class='gift_class' style='float:left;background: url("+config.path+"Public/css_js_font_img/img/chat/gift_bg.png); width:400px; height:80px; margin:10px; z-index:50;background-repeat: no-repeat;position:absolute;top:"+Gift_ob_top+"px;left:"+gift_samll_left+"px;filter: alpha(opacity=0);opacity:0 !important;'><li style='float:left;height:80px;left:30px;width:150px;padding-left:15px;'><div style='font-size:14px;text-indent:30px;width:100%; overflow:hidden;height:40px;padding-top:10px'>"+data.name+"</div><div style='font-size:14px;height:40px;text-indent:30px;width:100%; overflow:hidden;color:#FC0;'>"+data.gift_title+"</div></li><li style='float:left;height:80px;left:30px;width:100px;'><img  src='"+data.ico+"' style='top:-20px; width:80px ; height:80px; border:none;z-index:55'></li><li style='float:left;height:80px;left:30px;width:150px;'><div id='"+id+"_text' style='text-shadow:3px 3px 3px #000;color:"+config.start_color+";font-family: Verdana, Geneva, sans-serif;font-size:"+config.font_size+"px;font-weight: bold;padding-top:25px;position:absolute;height:80px'>×"+data.num+"</div></li></div>";
		   	$('#'+this.container_id).append(container_div);
			obj=document.getElementById(id)
            createjs.Tween.get(obj).to({opacity:1}, 200).call(this.repeat_action,[1,data.num,id]);
	   }

	   
}

/*执行重复的动作执行执行重复的动作执行执行重复的动作执行执行重复的动作执重复的动作执行*/
Gift.prototype.repeat_action=function(current_num,num,id)
{
	   config=Gift.config;
       createjs.CSSPlugin.install(createjs.Tween);   
	   gift_samll_left=config.gift_samll_left;
	   obj=document.getElementById(id);
	   obj_text=document.getElementById(id+"_text");
	   if(num >30 && num <=500)
	   {
            obj_text.innerHTML ="×"+current_num;
	        current_num=current_num+1;
            createjs.Tween.get(obj_text).to({opacity:1,'font-size':40,'color':config.end_color}, 200).to({opacity:1,'font-size':config.font_size,'color':config.start_color}, 200).call(handleComplete_text,[current_num,num,id,3000]);
	   }else if(num >500)
	   {
		    obj_text_1=document.getElementById(id+"_text_1");
			obj_text_2=document.getElementById(id+"_text_2");
		   
            createjs.Tween.get(obj).wait(20000).to({opacity:0}, 2000).call(handleComplete_text,[1,0,id,1]);
			createjs.Tween.get(obj_text_1,{loop:true}).to({'font-size':16,'color':'F00'}, 200).to({'font-size':16,'color':'FF0'}, 200);
			
	   }else
	   {
		   	obj_text.innerHTML ="×"+current_num;
	        current_num=current_num+1;
            createjs.Tween.get(obj_text).to({opacity:1,'font-size':40,'color':config.end_color}, 200).to({opacity:1,'font-size':config.font_size,'color':config.start_color}, 200).call(handleComplete_text,[current_num,num,id,3000]);
	   }
	   function handleComplete_text(current_num,num,id,interval)
	   {
		    if(current_num<=num)
			{
				  Gift.repeat_action(current_num,num,id);
			}
			else
			{
				   setTimeout(function(){Gift.del(id)}, interval,id);
			}
			
	   }
}

/*执行重复的动作*/
Gift.prototype.del=function(id)
{
	  obj=document.getElementById(id);
      obj.remove();  
	  
	  Gift_ob=$('.gift_class');
	  Gift_ob_len=parseInt(Gift_ob.length);
	  
	  config=this.config;
	  if(Gift_ob_len>0)
	  {
		       Gift_ob.each(function(){
				   Gift_top=parseInt($(this).position().top) - config.gift_samll_top - (Gift_ob_len * 20);
				   
				   if(Gift_top < config.gift_samll_top) Gift_top=config.gift_samll_top;
				   $(this).css("top",Gift_top+"px");
			  });
	  }
	  
	  
	  if(this.Gift_data) 
	  {
		  this.give_presents();
	  }else
	  {
		  return true;
	  }
}