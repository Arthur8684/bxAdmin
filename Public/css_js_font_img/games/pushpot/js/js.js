// JavaScript Document
function orientati(id)
{
	
	$("#"+id).removeClass("rotate90");
	if(!is_screen())
	{	
		  h=screen.width>screen.height?screen.width:screen.height;
		  w=screen.width>screen.height?screen.height:screen.width;
		  
	      $("#"+id).addClass("rotate90");
		  x=$("#"+id).position().left;
          y= $("#"+id).position().top;	
	      $("#"+id).width(h);
		  $("#"+id).height(w);
		  
		  $(".cover").width(h);
		  $(".cover").height(w);
	      if(x!=0 || y!=0)
		  {
			  idtop=Math.abs((w-h)/2);
			  $("#"+id).css("top","+"+idtop+"px")
			  $("#"+id).css("left","-"+idtop+"px")
/*			  
			  $(".cover").css("top","+"+idtop+"px")
			  $(".cover").css("left","-"+idtop+"px")*/
		  }			

	}
	else
	{
		 w=screen.width>screen.height?screen.width:screen.height;
		 h=screen.width>screen.height?screen.height:screen.width;
		 $("#"+id).width(w);
		 $("#"+id).height(h);
		 x=$("#"+id).position().left;
         y= $("#"+id).position().top;
		 if(x!=0 || y!=0)
		 {
                $("#"+id).css("left","0px")
				$("#"+id).css("top","0px")			 
		 }	

	}


		  
}
/*判断横竖屏*/
function is_screen()
{
	rotate=window.orientation;
	if(rotate==0 || rotate==180)
	{
		return 0;
	}

	if(rotate==90 || rotate==-90)
	{
		return 1;
	}
}
/*旋转角度*/
function rotate(id,rotate_k)
{
	$("#"+id).removeClass("rotate90 rotate180 rotate270");
		x=$("#"+id).offset().top;
    y= $("#"+id).offset().left;
	$("#"+id).addClass(rotate_k);
	
	x=$("#"+id).offset().top;
    y= $("#"+id).offset().left;
			$("#"+id).css("position","absolute"); 
		$("#"+id).css("left","100px");  
		$("#"+id).css("top","100px");
	
}


/*旋转方向
id 转盘id
total_time 旋转时间
position 停留位置
total 旋转方向个数
shuffle_id 洗牌容器 可以为 .class #id  转盘转完 发牌需要
total_shuffle  每人发牌数 转盘转完 发牌需要

*/
function time_rotate(id,total_time,position,shuffle_id,total_shuffle,total,cards)
{
	 obj=$(id);
	 liang=obj.find('#liang');
	 nuemer_1=obj.find('#nuemer_1');
	 nuemer_2=obj.find('#nuemer_2');
	 total=total<=4?total:4;
	 liang_class_id=0;
	 step=200;
	 
	 total_time=total_time*1000;
	 update_time=total_time;
	 
     time_rotate_sh=window.setInterval(function(){
		     liang_class_id=(liang_class_id+1>total)?1:liang_class_id+1;
			 liang.removeClass();
			 liang.addClass("liang_"+liang_class_id);

			 time_s=parseInt(update_time/1000);

			 a_1=parseInt(time_s/10);
			 a_2=time_s % 10;
			 
			 nuemer_1.removeClass();
			 nuemer_1.addClass("nuemer_"+a_1);
			 nuemer_2.removeClass();
			 nuemer_2.addClass("nuemer_"+a_2);
			 
			 if(update_time<=1000)
			 {
				 if(liang_class_id==position)
				 {
					 window.clearInterval(time_rotate_sh);
					 shuffle(shuffle_id,position,total_shuffle,1,total,cards);
				 }
			 } 
			 update_time=update_time-step;
			 
		 },step);
}

function shuffle(shuffle_id,position,total_shuffle,times,total,cards)
{
	 times=arguments[3] ? arguments[3] : 1;
	 if(times<=18)
	 {
		 obj=$(shuffle_id);
		 obj.append("<li id='li"+times+"'></li>");	
		 target=document.getElementById('li'+times)
		 target.alpha = 0; 
		 times=times+1;
		 createjs.Tween.get(target).to({alpha:1},500).call(shuffle, [shuffle_id,position,total_shuffle,times,total,cards]);		 
	 }
	 else
	 {
		 shuffle_operate(shuffle_id,position,total_shuffle,total,1,cards);
	 }	 
}
/*shuffle_id:获取洗牌容器
position:第一个发牌位置 1 2 3 4
total：多少人参加游戏
current_times：发牌次数
total_shuffle:每人牌数*/
function shuffle_operate(shuffle_id,position,total_shuffle,total,current_times,cards)
{
	 var position_array=['s','user_bottom','user_left','user_top','user_right'];
	 total=arguments[3] ? arguments[3] : 4;
	 current_times=arguments[4] ? arguments[4] : 1;
	 position=parseInt(position);
	 current_times=parseInt(current_times);
	 obg=$(shuffle_id);
	 //current_shuffle_num=(current_times % total==0)?parseInt(current_times/total):(parseInt(current_times/total)+1); 
	 total_times=total_shuffle * total;
     if(current_times<=total_times)
	 {
		   if(position>total) position=1;
		   id=position_array[position];
		   $(shuffle_id+" li:last-child").remove();
/*		   obg_shuffle=obg.find('.li');
		   if(obg_shuffle.length>0)
		   {
			   obg_shuffle.remove();
		   }
		   else
		   {
			   $(shuffle_id+" li:last-child").remove();
			   obj.append("<li class='li'></li>");	
		   }*/
		   
		   if(cards && id=='user_bottom')
		   {
			   $("."+id+"_mahjong").html("<li id='"+id+"_mahjong_1' class='m_"+cards[1]+" look_up'></li><li id='"+id+"_mahjong_2' class='m_"+cards[2]+" look_up'></li>");
		   }
		   else
		   {
			   $("."+id+"_mahjong").html("<li id='"+id+"_mahjong_1'></li><li id='"+id+"_mahjong_2'></li>");
		   }
		   	
		   target=document.getElementById(id+'"_mahjong_1');
		   position=position+1;
		   current_times=current_times+1;
		   createjs.Tween.get(target).wait(500).call(shuffle_operate, [shuffle_id,position,total_shuffle,total,current_times,cards]);
		   
		   if(current_times == total_times) 
		   {
			   $('.open_card').removeClass('hide');
			   timers.setinterval("Countdown",30,open_card_all,'')
		   }
		   		 
	 }
	 
	 
}

function timers()
{
	
}

timers.prototype.setinterval=function(id,times,callback,parm)
{

	 	  obj=$("."+id);
		  nuemer_1=obj.find('#nuemer_1');
		  nuemer_2=obj.find('#nuemer_2');
	      timers[id]=window.setInterval(function(){
			 a_1=parseInt(times/10);
			 a_2=times%10;
			 
			 nuemer_1.removeClass();
			 nuemer_1.addClass("nuemer_"+a_1);
			 nuemer_2.removeClass();
			 nuemer_2.addClass("nuemer_"+a_2);
			 
			 if(times<=0)
			 {
					window.clearInterval(timers[id]);
				    callback(parm);
			 } 
			 times=times-1; 
		 },1000);

}

timers.prototype.clearinterval=function(id)
{
	      obj=$("."+id);
		  nuemer_1=obj.find('#nuemer_1').removeClass().addClass("nuemer_0");
		  nuemer_2=obj.find('#nuemer_2').removeClass().addClass("nuemer_0");

          window.clearInterval(timers[id]);
		  delete timers[id];
}

var timers = new timers(); 

