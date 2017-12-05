<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<script src="/cowcms/Public/css_js_font_img/js/jquery.min.js"></script>
<script src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js"></script>
<title>聊天室</title>
<style>
body{ margin:0px auto; width:100%; background:#FFF;font-family:"微软雅黑"}
.rightbox{ width:100%; overflow:hidden;border-top:#e1e1e1 solid 1px; border-bottom:#e1e1e1 solid 1px; }
.headbox{ width:100%; overflow:hidden;border-top:#e1e1e1 solid 1px;}
.name{ width:10%;height:70px;  float:left;  margin-left:5px;}
.name div{width:50px; height:50px; border-radius:50%; background-color:#999; margin-left:10%; margin-top:10px;}
.name div img{width:50px; height:50px; border-radius:50%;}
.namea{ width:40%;height:70px; float:left; }
.namea div{ margin-left:30%; margin-top:12px; font-size:12px;}
.nameb{ width:20%;height:70px; float:left;  margin-top:12px}
.nameb div{ width:100px; height:30px; font-size:14px; line-height:30px; text-align:center; margin-left:40%;  background-color:#Fb0; border-radius:3px; }
ul{ padding:0; list-style:none;}
.menu{ overflow:hidden; width:100%; border-bottom:#e1e1e1 solid 1px;}
.menu ul { padding:0px;}
.menu li{  float:left;  width:25%; height:30px; line-height:30px; font-size:14px; text-align:center; border-right:#e1e1e1 solid 1px;}
.dd{ width:100%; height:100px; border-bottom:#e1e1e1 solid 1px; overflow: hidden; }
.dd_on{ width:100%; position:fixed; height:300px; border-bottom:#e1e1e1 solid 1px; overflow: auto; background:#FFF;  border:#e1e1e1 solid 1px; z-index:1000; border-top:none;box-shadow:0px 5px 10px #ccc;}
.wen{ width:100%; height:313px; border-bottom:#e1e1e1 solid 1px;}
.show_content{ width:95%; margin:10px auto; height:270px; overflow:auto;}
.bottom{ width:100%; height:60px; overflow:hidden;}
.bottom div{ float:left;}
.bottom textarea{   border:#e1e1e1 solid 1px; border-left:none; width:100%; height:60px; border-right:none}
.show_face{ width:15%; height:60px;border:#e1e1e1 solid 1px; border-right:none; text-align:center; }
.textarea{ width:70%; height:60px;}
.fs{ width:15%; height:60px; background-color:#Fb0; text-align:center; padding-top:20px; font-size:14px;cursor:pointer}
.margin_5{ width:95%; margin:5px auto;}
.show_all_user li{ width:90%; margin:0px auto; font-size:14px; line-height:30px;list-style:none; color: #666}
.show_all_user li span{ cursor:pointer; color:#FC0; font-size:10px}
.chat_name{ font-size:14px; color:#999; line-height:25px;}
.its_me{ font-size:24px}
.chicks{ background:#EEE;}
.chat_show_msg{ font-size:16px; color:#000}
.chat_show_msg_1{ font-size:16px; color: #F60;}
.o{ color:#F90}
</style>
</head>
<body>
<div class="rightbox">
	<div class="headbox">
    	<div class="name">
        <!--主播头像-->
        	<div><img src="<?php echo user($room['user_id'],'headpath');?>"></div>
        <!--主播头像结束-->    
        </div>
        <div class="namea">
        	<div><?php if(user($room['user_id'],'nickname') == 0): echo user($room['user_id']);?><else><?php echo user($room['user_id'],'nickname'); endif; ?></div>
            <div>在线：<span id="show_nums"></span></div>
        </div>
        <div class="nameb">
        	<div>关注</div>
        </div>
    </div>
    <div class="headbox">
        <ul class="menu">
            <li role="presentation" class="active chicks"  onClick="url_1(0)"  ><span style="cursor:pointer">在线</span></li>
		</ul>
        <div style="height:100px; margin-top:-10px;">
        <div class="dd" id="show_user_button">
        <!--显示在线人数-->
                 <DIV class="show_all_user" id="url_1_0">
                 
                 </DIV>
        <!--显示在线人数结束-->
        </div>
        </div>
    </div>
    <div class="wen">
    <!--显示评论内容-->
        <ul class="menu">
            <li role="presentation" class="active url_title  chicks"  onClick="url(0)"  id="url_title0"><span style="cursor:pointer">全部</span></li>
            <li role="presentation" class="url_title" onClick="url(1)" id="url_title1"><span  style="cursor:pointer">私聊</span><span id="show_new"></span></li>
		</ul>
    	<div class="show_content">
             <DIV class="col-md-12 url show-area" id="url0"></DIV>
             <DIV class="col-md-12 url show-area-s" id="url1" style="display:none"></DIV>
        </div>
    <!--显示评论内容结束-->
    </div>
        <select name="user_name" id="user_name" class="form-control margin_5">
            <option value="user_room_all">所有人</option>
        </select>
        
    <div class="bottom  margin_5">
    	<!--显示表情按钮-->
  <div class="show_face">
            <?php echo show_face('','message',$face_array=array('div_width'=>300,'img_size'=>60,'button_style'=>'margin-top:10px;','root_path'=>''.C('root_bath').'','other_style'=>'box-shadow:0px 5px 10px #ccc;'));?>
        </div>
        <!--显示表情按钮结束-->
    	<div class="textarea">
    	    <textarea style="" name="message" id="message"  placeholder="你想对他/她说什么？" ></textarea>
        </div>
        <div class="fs send" ><span>发送</span></div>
    </div>
</div>
<script>
$(document).ready(function(){
	  $("#show_user_button").mouseenter(function(){
	  		$(this).removeClass("dd");
			$(this).addClass("dd_on");
	  });
	  $("#show_user_button").mouseleave(function(){
	  		$(this).removeClass("dd_on");
			$(this).addClass("dd");
	  });	  
	});
//建立socket=============================================================================================================================
	var wsurl = 'ws://<?php echo ($config['server']); ?>:<?php echo ($config['port']); ?>/index.php/chat/server/server.php';
	var websocket;
	var i = 0;
	if(window.WebSocket){
		websocket = new WebSocket(wsurl);
		//连接建立
		websocket.onopen = function(evevt){
			//$('.show-area').append('<p class="chat_show_msg_1 message"><i class="glyphicon glyphicon-info-sign"></i>欢迎来聊天室</p>');
			send_msg={action:'set',room_id:<?php echo ($room['id']); ?>,uid:'<?php echo ($user['id']); ?>',name:'<?php echo ($user['name']); ?>'};
			send(send_msg);
			
		}
		//收到消息
		websocket.onmessage = function(event) {

			var msg = JSON.parse(event.data); //解析收到的json
			
			var action = msg.action; // 消息类型
			var user_msg = msg.message; //消息文本
			var from_name = msg.f_name; //发送人
			var from_uid= msg.f_uid; //发送人uid
			var from_key= msg.f_key; //发送人Socket连接ID
			var from_room_id = msg.f_room_id; //发送人房间ID
			
			var to_name = msg.t_name; //接受人
			var to_uid = msg.t_uid; //接受人uid
			var to_key = msg.t_key; //发送人Socket连接ID
			var to_room_id = msg.t_room_id; //接受人房间ID

			var user_list= msg.user_list; // 在线用户列表

			if(msg.err=='1')
			{
				alert(msg.message);
				return false
		    }
			   
			switch(action)
			{
				case 'user_all':
					$('.show-area').append('<p class="message"><i class="glyphicon glyphicon-user o"></i><span class=\'chat_name\'>所有房间：<div class=\'chat_show_msg\'>"+user_msg+"</div></p>');
					break;
				case 'user_room_all':
					if(from_key==to_key)
					{
						user_msg="<span class='chat_name'>我</span><div class='chat_show_msg'>"+user_msg+"</div>";
					}
					else
					{
						user_msg="<span class='chat_name' onClick=\"add_user('"+from_name+"','"+from_key+"')\"  style='cursor:pointer;'>"+from_name+" 说: </span><div class='chat_show_msg'>"+user_msg+"</div>";
					}
					
					$('.show-area').append('<p class="message"><i class="glyphicon glyphicon-user o"></i>'+user_msg+'</p>');
					window.parent.CKobject.getObjectById('ckplayer_my-video').loadBarrage(user_msg);
					break;
				case 'user_client':
					if(from_key==to_key)
					{
						user_msg=" <span class='chat_name'>我</span> 对 <span class='chat_name' style='cursor:pointer;' onClick=\"add_user('"+to_name+"','"+to_key+"')\">"+to_name+"</span>  说: </span><div class='chat_show_msg'>"+user_msg+"</div>";
					}
					else
					{
						user_msg=" <span class='chat_name' onClick=\"add_user('"+from_name+"','"+from_key+"')\"  style='cursor:pointer;'>"+from_name+"</span> 对 <span class='chat_name'>我</span> 说: <div class='chat_show_msg'>"+user_msg+"</div>";
					$('#show_new').html("<img src='/cowcms/Public/css_js_font_img/img/new.png'>");	
					}

					$('.show-area-s').append('<p class="message"><i class="glyphicon glyphicon-user o"></i>'+user_msg+'</p>');
					break;
				case 'system':
					$('.show-area-s').append('<p class="message"><i class="glyphicon glyphicon-info-sign"></i><div class=\'chat_show_msg\'>'+user_msg+'</div>"</p>');
					break;
				case 'give_presents':
					if(from_room_id==<?php echo ($room_id); ?>)
					{
						$('.show-area').append('<p class="message"><div class=\'chat_show_msg_1\' onClick=\'add_user("'+from_name+'","'+from_key+'")\'><i class="glyphicon glyphicon-info-sign"></i>'+from_name+' 送出了:'+user_msg.title+'×'+user_msg.num+'礼物</div></p>');
					}
					else
					{
						$('.show-area').append('<p class="message"><div class=\'chat_show_msg_1\'><i class="glyphicon glyphicon-info-sign"></i>'+from_name+' 为房间【'+user_msg.room+'】送出了！'+user_msg.show_type+'礼物</div></p>');
					}
					
					if(user_msg.num<=30)
					{
						 window.parent.CKobject.getObjectById('ckplayer_my-video').sendGift({bg_path:"/cowcms/Public/css_js_font_img/img/chat/gift_bg.png",gift_path:user_msg.ico,gift_type:'1',gift_num:user_msg.num,gift_name:user_msg.title,user_name:from_name});
					}
					else if(user_msg.num>=31 && user_msg.num<=520)
					{

						 if(user_msg.num==66) show_text='六六大顺';
						 if(user_msg.num==520) show_text='我爱你';
						 show_text=show_text?show_text:'小礼一份';
						 window.parent.CKobject.getObjectById('ckplayer_my-video').sendGift({bg_path:"/cowcms/Public/css_js_font_img/img/chat/gift_bg_green.png",gift_path:user_msg.ico,gift_type:'2',gift_num:1,gift_name:user_msg.title,user_name:from_name,show_text:show_text,show_num:user_msg.num});
					}
					else if(user_msg.num>520)
					{
						 show_text=user_msg.num==1314?"一生一世":'爱你到永远';
						 window.parent.CKobject.getObjectById('ckplayer_my-video').sendGift({bg_path:"/cowcms/Public/css_js_font_img/img/chat/gift_bg_gold.png",gift_path:user_msg.ico,gift_type:'2',gift_num:1,gift_name:user_msg.title,user_name:from_name,show_text:show_text,show_num:user_msg.num});
					}else
					{
						
					}
					break;
				case 'close':
					 del_user(from_key);
					 $('.show-area').append('<p class="message"><i class="glyphicon glyphicon-user o"></i> <span class=\'chat_name\'>'+from_name+'<span><div class=\'chat_show_msg_1\'>离开房间了！</div></p>');		
					room_user_list(user_list,to_key);
					var jslength=0;	
					var htmls="";					
					for(var js2 in user_list){
						jslength++;
					}
					$('#show_nums').html(jslength);
					$('.show_content').scrollTop();
					break;
				case 'connection':
					$('.show-area').append('<p class="message"><div class=\'chat_show_msg_1\'><i class="glyphicon glyphicon-info-sign"></i>欢迎 '+from_name+' 进入聊天室！</div></p>');
					room_user_list(user_list,to_key);
					var jslength=0;	
					var htmls="";					
					for(var js2 in user_list){
						jslength++;
					}
					$('#show_nums').html(jslength);
					$('.show_content').scrollTop();
					break;
				default:
			}
			
			end_scroll()	
		}

		//发生错误发生错误//
		websocket.onerror = function(event){
			console.log("Connected to WebSocket server error");
			$('.show-area').append('<p class="bg-danger message"><i class="glyphicon glyphicon-info-sign"></i>聊天室未开启</p>');
			end_scroll()	
		}

		//连接关闭
		websocket.onclose = function(event){
			$('.show-area').append('<p class="message chat_show_msg_1"><i class="glyphicon glyphicon-info-sign"></i>您退出聊天室</p>');
			end_scroll()			
		}

		function send(send_msg){
			send_msg['appsecret']='<?php echo ($user['pass_pre']); ?>';
			try{
				websocket.send(JSON.stringify(send_msg));
			} catch(ex) {
				console.log(ex);
			}
		}
		
		function end_scroll()
		{
			scroll_height=$('.show_content')[0].scrollHeight-$('.show_content').height();
			$('.show_content').scrollTop(scroll_height);
		}
		

		//按下enter键发送消息
		$(window).keydown(function(event){
			if(event.keyCode == 13){
				var user_key=$('#user_name option:selected').val();
				var message = replace_face($('#message').val());
			    var type = (user_key=='user_room_all')?'user_room_all':'user_client';
				send_msg={action:'message',type:type,user_key:user_key,message:message};
				send(send_msg);
				$('#message').val("");
			}
		});
		//点发送按钮发送消息
		$('.send').bind('click',function(){
			
			var user_key=$('#user_name option:selected').val();
			var message = replace_face($('#message').val());
			var type = (user_key=='user_room_all')?'user_room_all':'user_client';
			send_msg={action:'message',type:type,user_key:user_key,message:message};
			send(send_msg);
			$('#message').val("");
		});

	}
	else{
		alert('该浏览器不支持web socket');
	}
	window.onbeforeunload = function () { websocket.close();    }
//建立socket完==================================================================================================================
    function add_user(user_name,user_id)
    {
        $("#user_name").append("<option value='"+user_id+"' selected>"+user_name+"</option>");
    }

    function del_user(user_id)
    {
        $("#user_name option[value='"+user_id+"']").remove();
    }

    function room_user_list(user_list,to_key)
    {
        $str="";
		htmls="";
        $.each(user_list,function(n,value){
            if(n==to_key)
            {
                $str=$str+'<p class="bg-danger message">'+value+":"+n+"</p><br>";
				htmls+="<li class='its_me'  style='font-size:14px; color:green'>"+value+" </li>";
            }
            else
            {
                htmls+="<li class=\"its_other\"  onClick=\"add_user('"+value+"','"+n+"')\"><i class='glyphicon glyphicon-user'></i> <span style='font-size:14px; color:#999'>"+value+"</span> <span class='glyphicon glyphicon-share-alt' title='和他/她私聊' onClick=\"add_user('"+value+"','"+n+"')\"></span> <span title='加关注' class='glyphicon glyphicon-plus'></span></li>";
				$str=$str+value+":"+n+"<br>";
            }

        });
		$('#url_1_0').html(htmls);
        $('#user_list').html($str);
		
    }
	
    function url(id)
    {
        $(".url_title").removeClass("chicks");
        $("#url_title"+id).addClass("chicks");
		if(id==1){
			$('#show_new').html('');		
		}
        $(".url").hide("slow");
        $("#url"+id).show("slow");
		setTimeout(end_scroll, 1000);
    }	
</script>
</body>
</html>