<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>直播页</title>
<link href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet">
<script src="/cowcms/Public/css_js_font_img/js/jquery.min.js"></script>
<script src="/cowcms/Public/css_js_font_img/js/diy.js"></script>
<script src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js"></script>

<!--<script src="/cowcms/Public/css_js_font_img/js/createjs/easeljs/easeljs-0.8.2.min.js"></script>
<script src="/cowcms/Public/css_js_font_img/js/createjs/soundjs/soundjs-0.6.2.min.js"></script>-->
<script src="/cowcms/Public/css_js_font_img/js/createjs/preloadjs/preloadjs-0.6.2.min.js"></script>
<script src="/cowcms/Public/css_js_font_img/js/createjs/tweenjs/tweenjs-0.6.2.min.js"></script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/createjs/tweenjs/CSSPlugin.js"></script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/chat/gift.js"></script>
</head>
<style>
/*公共开始*/
body{ margin:0px; font-size:14px; line-height:25px; font-family:"微软雅黑"}
.clear{ clear:both; height:0px;}
a{ color:#000}
.w80{ width:80%}
.w20{ width:20%}
.w10{ width:10%}
.w90{ width:90%}
.w60{ width:60%}
.w50{ width:50%}
.w40{ width:40%}
.w50{ width:50%}
.w30{ width:30%}
.w70{ width:70%}
.main{
    background:  none; 
    position: absolute; 
    left: 0px; 
    top: 0px; 
    filter: alpha(opacity=100); 
    opacity: 1 !important; 
	z-index:2147483647;
	display:none;
}

#canvas{
	display: block;
	opacity:1;
	z-index:150;
}

.divBG 
{ 
    background:  none; 
    position: absolute; 
    left: 0px; 
    top: 0px; 
    width: 100%; 
    height: 100%; 
    filter: alpha(opacity=60); 
    opacity: 0.6 !important; 
    
}
/*公共结束*公共结束*/
/*顶部开始*/
.top{ width:100%; height:80px;}
.top ul,li{  padding:0px; list-style:none}
.top ul{ width:1002px; margin:0px auto}
.top ul li{ float:left;}
.top ul li img{ width:150px; height:80px;}
.input_text{ height:30px; width:400px; line-height:25px; border-radius: 3px; border:1px solid #CCC; margin-top:20px;}
.input_button{ height:30px; width:50px; line-height:25px; border-radius: 3px; border: none; margin-left:-50px; margin-top:20px; background:none}
.top button{ margin-top:20px; height:30px; width:50px; line-height:25px; margin-left:20px;border-radius: 3px; border:none;}
/*顶部结束*/
/*下部开始*/
.dowm { width:100%; height:80px; }
.dowm ul{padding:0px; list-style:none}
.dowm ul li{ float:left; height:100% }
.navs{ margin:0px auto; border-top:#EBEBEB 1px solid; text-indent:25px; font-size:14px; line-height:30px; }
.navs span{ background:#EAEAEA;  border-radius: 2px; font-size:12px; line-height:25px;display:block; text-align:center; width:80px; float:left; text-indent:0px; margin:3px; cursor:pointer}
.vidoa{ margin:15px auto; width:98%; height:650px; }
.vidoa div{ float:left}
.vidoa .v_title{ background:#FFF; line-height:60px; font-size:24px; font-weight:bold; width:100%; text-indent:25px; border-top:2px  #e1e1e1 solid}
/*下部结束*/
/*弹幕css*/
.barrage .screen{width:640px;height:300px;position:absolute;}
.barrage .screen .mask{position:relative;width:640px;height:300px;z-index:11111111111;}
.barrage{display:none;width:70%;}
.barrage .screen .mask div{position:absolute;font-size:20px;font-weight:bold;line-height:40px;z-index:40;word-wrap:break-word;width:200px;}
.d_show div{font-size:22px;font-weight:500;color:#fff;position:absolute; overflow:hidden;-moz-user-select:none;/*火狐*/
-webkit-user-select:none;/*webkit浏览器*/
-ms-user-select:none;/*IE10*/
-khtml-user-select:none;/*早期浏览器*/
user-select:none; cursor:default}
/*弹幕css结束*/
.gift{ width:550px; margin:0 auto; z-index:600;opacity:1}
.show_gift_font{  border-radius:3px; font-size:16px; font-weight:bold; background:#FFA54A; height:50px; line-height:50px; margin:0px auto; text-align:center; width:90%; margin-top:6px;}
.gift ul,li{ padding:0px; margin:0px; list-style:none;}
.gift ul li{ float:left;}
.gift  .gift_list{ width:434px; overflow:hidden; height:62px; position:absolute;opacity:1; background:#FFF;z-index:150;}
.gift span{ position: absolute; margin-left:445px}
.gift span button{ line-height:45px; background: #F2F2F2; color:#666; font-weight:bold; width:25px; margin-top:5px; height:50px; border:1px  #C9C9C9 solid}
.gift_list .gift_show_img{ float:left; width:50px; border-radius:5px; border:1px #CCC  solid; height:50px; margin:6px;z-index:150;}
.gift_show{ display:none;}
.gift_show_1{ width:350px; height:120px; border:1px solid  #999;display:none; position:absolute; background:#FFF;box-shadow:0px 3px 3px #ccc;opacity:1;z-index:150; }
.gift_show_1 img{ float:left; margin:10px; width:80px; height:80px;}
.gift_show_2{ width:300px; height:250px; border:1px solid  #999;display:none; border-radius:10px; position:absolute; background:#FFF;box-shadow:0px 3px 3px #ccc;opacity:1;z-index:150; }
.gift_show_2 p{ line-height:30px; text-indent:10px; float:left;}
.gift_show_2 p b{ cursor:pointer}
.gift_show_2 img{ width:36px; height:36px; margin:2px;}
.gift_show_2 input{ height:40px; border:1px #CCC solid; border-right:none; width:120px; line-height:35px;}
.gift_show_2 div{margin-left:10px;}
.gift_num ul{ padding:0px; list-style:none; margin-left:15px;}
.gift_num ul li{ padding:0px; list-style:none; cursor:pointer}
.gift_title{ font-size:16px;}
.gift_price{ font-size:12px; color:#F90}
.gift_describe{ color: #999; font-size:12px; line-height:20px;}
.gift_num li{ float:left; width:28%; margin:3px; background:#E6E6E6 ; line-height:45px; height:45px; text-align:center;border-radius:5px;}
.send_gift{ line-height:45px; height:50px; width:120px; float:left; background:#FF3; border:1px #FC0 solid;font-size:24px; margin-left:30px; margin-top:5px;display:inline-block; text-align:center; cursor:pointer}
.show_img{ width:40px; height:40px; margin-top:4px; margin-left:4px;}
.onlick_show{position:absolute; width:50px; height:50px; z-index:50; cursor:pointer}

/*礼物显示效果*/
.giftCanvas{
	font-size:22px;
	font-weight:500;
	color:#fff;
	position:absolute;
	overflow:visible;
	-moz-user-select:none;/*火狐*/
	-webkit-user-select:none;/*webkit浏览器*/
	-ms-user-select:none;/*IE10*/
	-khtml-user-select:none;/*早期浏览器*/
	user-select:none;
	cursor:default;
	width: 0px;
	height: 0px;
	left: 341px;
	top: 117px;
	z-index: 10;
}
.num_gift_show{ height:25px; line-height:25px; font-size:12px; color:#333; text-align:center; text-indent:-10px;}
.num_gift_info{ height:20px; line-height:20px; font-size:12px; color: #999; text-align:center;text-indent:-10px;}
/*礼物结束*/
</style>
<body>	
<!--串线开始串线开始串线开始-->
<div id="online_show" style="position:absolute; z-index:60px; width:240px; height:200px; display:none">
    <li style=" margin:3px; list-style:none"></li>
</div>
<!--串线结束-->
<div class="giftCanvas" width="0" height="0" id="giftCanvas"></div>
<div class="gift_show_2">
	<p style=" width:85%">送给主播</p><p style="width:10%"><b>X</b></p>
    <div class="clear"></div>
	<div style="margin-left:25px"><img src=""><input name="gift_num_input" id="gift_num_input"  value="1" onkeyup="value=value.replace(/[^\d]/g,'')"><input type="hidden" id="gift_info" value="1"><input type="button" value="赠送" style="border:none; width:80px; background:#F60; color:#FFF; line-height:35px;" id='gift_submit'></div>
    <div  class="gift_num">
    	<ul>
        	<li><div class="num_gift_show">1</div>
            <div class="num_gift_info">一个也是爱</div>
            </li>
            <li><div class="num_gift_show">10</div>
            <div class="num_gift_info">十全十美</div>
            </li>
            <li><div class="num_gift_show">30</div>
            <div class="num_gift_info">想你</div>
            </li>
            <li><div class="num_gift_show">66</div>
            <div class="num_gift_info">一切顺利</div>
            </li>
            <li><div class="num_gift_show">520</div>
            <div class="num_gift_info">我爱你</div>
            </li>
            <li><div class="num_gift_show">1314</div>
            <div class="num_gift_info">一生一世</div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
    <div style="margin-left:25px">消耗：<span>0</span> <?php echo C($config['point_type'].".name");?></div>
</div>
<script>
	$("#gift_num_input").keyup(function(){
	  $(".gift_show_2").find('span').html($("#gift_info").val()*$(this).val());
	});
</script>
<link href="/cowcms/Public/css_js_font_img/css/base.css" rel="stylesheet">
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
<!--顶部开始-->
<div class="top">
	<ul>
    	<!--这里显示网站logo-->
    	<li class="w20"><img src="<?php echo C('site_logo');?>"></li>
        <!--显示网站logo结束-->
        <!--这里显示网站搜索-->
        <li class="w60"><form method="get" action="<?php echo U('Chat/Index/room_list/');?>"><input type="text" name="key_word" value="<?php echo ($key_word); ?>"  class="input_text" placeholder="<?php echo L('Room_name_channel_ID');?>"/><input  type="submit" value="<?php echo L('search');?>" class="input_button"></form></li>
        <!--显示网站搜索结束-->
        <!--这里显示登录注册选项-->
        <li class="w20 top_padding_20">
            <?php if($user['id'] && is_numeric($user['id'])): ?><A href="<?php echo U('User/Index/index');?>" target="_parent" class="btn btn-success  btn-sm "><?php echo L('USER_CENTER');?></A>
            <?php else: ?>
                <A href="<?php echo U('User/login/index');?>" target="_parent" class="btn btn-success  btn-sm "><?php echo L('LOGIN_');?></A> <A href="<?php echo U('User/login/register');?>" target="_parent" class="btn btn-default  btn-sm"><?php echo L('register');?></A><?php endif; ?>
        </li>
        <!--显示登录注册选项结束-->
    </ul>
    <div class="clear"></div>
</div>
<!--顶部结束-->
<div class="dowm">
	<ul>
        <!--左边栏目-->
       <li class="w20" >
              <div class="navs">
                <p ><i></i><a href="<?php echo U('Chat/Index/index');?>">网站首页</a></p>
              </div> 
             <?php if(is_array($navs)): foreach($navs as $key=>$val): ?><div class="navs">
                <p style="cursor:pointer" class="nav_name"><i></i><?php echo ($val['name']); ?> </p>
                <p style="width:90%; margin:0px auto ; display:none" class="child_navs">
                	<span onClick="location.href='<?php echo U('Chat/Index/room_list',array('class_id'=>$val['id']));?>'">全部</span>
                <?php if(is_array($val['child'])): foreach($val['child'] as $key=>$v): ?><span onClick="location.href='<?php echo U('Chat/Index/room_list',array('class_id'=>$v['id']));?>'"><?php echo ($v['name']); ?></span><?php endforeach; endif; ?>    
                <p>
                <div class="clear"></div>
              </div><?php endforeach; endif; ?>    
        </li>
<script>
	$('.nav_name').click(function(){
		$('.child_navs').hide();
		$(this).parent('.navs').find('.child_navs').toggle(50);
	})
</script>
        <!--左边栏目结束-->
    <!--右边栏目-->
        <li class="w80" style="border-top:#EBEBEB 1px solid; background: #F2F2F2">
            <div style="border-left:#EBEBEB 1px solid">
                <div class="vidoa">
                    <div class="w70">
                    <!--这里插入直播室名称-->
                       <div class="v_title"><?php echo ($room['title']); ?></div>
                    <!--这里插入直播室名称结束-->
                 
                    <!--这里插入直播视屏-->
                    <?php if($IS_ROOM_USER): echo ($live); ?>
                    <?php else: ?>
                       <?php echo ($live); ?>
                       <!--这里插入礼包信息-->
                        <div style="background:#FFF; width:100%">
                               <span>
                                   <div class="gift" style="display:none">
                                        <ul>
                                            <li class="w20"><div class="show_gift_font">礼物</div></li>
                                            <li class="w70">
                                                <div class="gift_list" id="gift_list_show">
                                                    <?php if(is_array($gift)): foreach($gift as $k=>$v): ?><div class="gift_show_img">
                                                              <div class="onlick_show"></div>
                                                              <img style="position:absolute; z-index:40" src="<?php if($v['show_type']==1): ?>/cowcms/Public/css_js_font_img/img/show_this.png<?php else: ?>/cowcms/Public/css_js_font_img/img/show_all.png<?php endif; ?>">
                                                              <img  src="<?php echo ($v['ico']); ?>"  class="show_img" ><input type="hidden" value="<?php echo ($v['id']); ?>" class="gift_id">
                                                              <div class="gift_show">
                                                                      <img   src="<?php echo ($v['ico']); ?>"><span class="gift_title"><?php echo ($v['title']); ?></span> <span class="gift_price">(<span><?php echo (number_format($v['price'], 2, '.', '')); ?></span> <?php echo C($config['point_type'].".name");?>)</span>
                                                                      <div class="gift_describe"><?php echo ($v['describe']); ?></div>
                                                                      <div><?php echo L('Gift_Show');?>:<?php if($v['show_type']==1): echo L('Current_room'); else: echo L('All_rooms'); endif; ?></div> 
                                                              </div>
                                                          </div><?php endforeach; endif; ?>
                                                </div>
                                                <span><div style="width:1%; float:left"><button >∧</button></div><!--<div class="send_gift">送 礼</div>--></span>
                                                <div class="clear"></div>
                                            </li>
                                            <li class="w10"></li>
                                            <div class="clear"></div>
                                        </ul>
                               </div> 
                          </span>
                      </div>
                      <!--这里插入礼包信息结束--><?php endif; ?>
                    <!--插入直播视屏结束-->
                    

                    </div>
                     
                    <!--这里插入聊天信息-->
                    <div class="chat w30">
                        <iframe width="100%" height="650" frameborder="0" name="msg_window" id='msg_window' scrolling="auto" src="<?php echo U('Chat/index/right_radio',array('room_id'=>$room_id));?>"></iframe>
                    </div>
                    <!--插入聊天信息结束-->
                </div>
                <div class="clear"></div>
                <!--这里显示相关信息-->
                <div></div>
                <!--显示相关信息结束-->
                <div class="clear"></div>
            </div>
        </li>
<!--右边栏目结束-->
	</ul>
</div>
<div class="gift_bg_big">

</div>

<script>

function send_gift_num(num,v,id){

		if (v > num){
		setTimeout(function () {	
			$("#"+id+"").hide();
		}, 5000);
        return;
		}else {
			
			setTimeout(function () {
			  $("#"+id+"").find('i').html(v);
              send_gift_num(num , v+1,id);
			}, 100);
        }		
}

$("#iframe").load(function(){
var mainheight = $(this).contents().find("body").height();
$(this).height(mainheight);
});
//显示礼物列表
$('body').append('<div class="gift_show_1"></div>');
	setTimeout(function () {
		$('body').append('<div class="main"><div class="d_show"></div></div>');
		var X = $("#my-video").offset().top;
		var Y = $("#my-video").offset().left;
		$(".main").css({'width':''+width+'px','height':''+height-250+'px','top':''+X+'px','left':''+Y+'px'});
	}, 3000);

//本页面加载完成
$(function(){
	$(".gift").find('button').click(function(){
		if($('#gift_list_show').height()!=248){
			$('#gift_list_show').css({"height":"248px","margin-top":"-248px","transition": "margin-top 0.5s,height 0.5s","overflow":"auto"});
			$(this).html('∨');
		}else{
			$('#gift_list_show').css({"height":"62px","margin-top":"0px","transition": "margin-top 0.5s,height 0.5s","overflow":"hidden"});
			$(this).html('∧');
		}
;
	})
	$(".gift_list").find('.onlick_show').mouseenter(function(){
			var X = $(this).offset().top; 
			var Y = $(this).offset().left;
			$(this).parent("div").css({'border':'1px #F00 solid'});
			html=$(this).parent("div").find(".gift_show").html();
			$(".gift_show_1").html(html);
			$(".gift_show_1").css({"top":""+(X-120)+"px","left":""+Y+"px"});
				$(".gift_show_1").show(100);
	})

	
	$(".gift_list").find('.onlick_show').mouseleave(function(){
		$(this).parent("div").css({'border':'1px #ccc solid'});
		$(".gift_show_1").hide();	
	})
	$(".gift_show_2").find('p').children('b').click(function(){
		$(".gift_show_2").hide();	
	})	
	$(".gift_list").find('.onlick_show').click(function(){
			var X = $(this).offset().top; 
			var Y = $(this).offset().left;
			$(".gift_show_2").find('img').attr('src',$(this).parent(".gift_show_img").find(".show_img").attr('src'));
			$("#gift_info").val($(this).parent(".gift_show_img").find('.gift_price').children("span").html());
			$(".gift_show_2").css({"top":""+X-260+"px","left":""+Y-125+"px"});
			gift_id=$(this).parent(".gift_show_img").find(".gift_id").val();
			$("#gift_num_input").val($(this).html());
			$(".gift_show_2").find('span').html($("#gift_info").val()*$(this).html());
			$("#gift_submit").attr('onClick','give_presents(<?php echo ($room[user_id]); ?>,<?php echo ($room[id]); ?>,'+gift_id+')');
			$(".gift_num").find('li').css({'background':'#E6E6E6'});
			$(".gift_show_2").show(100);
			$(".gift_show_1").hide();	
	})
	$(".gift_show_2").mouseleave(function(){
		$(".gift_show_2").hide();
	})
	$(".gift_num").find('li').click(function(){
		$(".gift_num").find('li').css({'background':'#E6E6E6'});
		$(this).css({'background':'#FC0'});
		$("#gift_num_input").val($(this).find('.num_gift_show').html());
		$(".gift_show_2").find('span').html($("#gift_info").val()*$(this).find('.num_gift_show').html());
		
	})
	
	//iframe加载完成后执行
	$("#msg_window").load(function(){
		$('.gift').show()
	});
})

/*
   userid 接受礼物用户ID
   room_id：房间ID
   gift_id ：礼物ID

*/
function give_presents(userid,room_id,gift_id)
{
	    num=$('#gift_num_input').val();
		data={type:'give_presents',gift_id:gift_id,userid:userid,num:num}
		msg_window.window.send(data);
}
</script>
</body>
</html>