<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<META content="IE=9.0000" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK href="/cowcms/Public/css_js_font_img/css/bootstrap.min.css" rel="stylesheet"> 
<LINK href="/cowcms/Public/css_js_font_img/css/admin.css" rel="stylesheet"> 
<title><?php echo L('ADMIN_Manage_TITLE');?></title>
</head>
<body scroll="no" style="overflow: hidden;">
<!--浮动层上右方的下拉菜单-->
<div class="admin_show_text_top_right" ><a href="<?php echo C('site_url'); echo C('root_path');?>" target="_blank"><?php echo L('SITE_INDEX');?></a></div>
<div class="admin_open_top_right glyphicon glyphicon-th"  onClick="menu_down_show('menu_down_list_top_right')"></div>
<div class="list-group admin_open_list_top_right" id="menu_down_list_top_right" style="display:none">
  <?php echo RR('Admin/Menu/menu_list',L('ADMIN_Menu_Manage'),'list-group-item sizefont_14',' target="connect_iframe" onClick="menu_down_show(\'menu_down_list_top_right\')"');?>
  <?php echo RR('Admin/Menu/menu_add',L('ADMIN_Menu_Add'),'list-group-item sizefont_14',' target="connect_iframe" onClick="menu_down_show(\'menu_down_list_top_right\')"');?> 
  <?php echo RR('Admin/Login/quit',L('ADMIN_Quit'),'list-group-item sizefont_14',' target="_top" onClick="menu_down_show(\'menu_down_list_top_right\')"');?> 
</div>
<!--浮动层上右方的下拉菜单完-->
<!--  head Start-->
<div class="admin_head_bank admin_black_bg" id="head">
     <!--  logo Start-->
		 <div class="admin_logo">
				<img src="/cowcms/Public/css_js_font_img/img/logo/admin_logo.png" alt="logo"/>
		 </div>
	 <!--  logo End-->
	 <!--  Menu Start-->
	   <?php if(is_array($info)): foreach($info as $k=>$v): if($v['s']): ?><SPAN class="admin_head_span<?php if($k == 0): ?>_hover<?php endif; ?>" id="head_span_<?php echo ($v[id]); ?>" onClick="hide_show(this,'#head SPAN','connect_left_connect_','admin_head_span')" ><?php echo ($v[title]); ?></SPAN><?php endif; endforeach; endif; ?>
	 <!--  Menu End-->
     
</div>
<!--  head End-->

<!--  conect Start-->
<div class="admin_head_connect" id="connect">
      <!--  Menu_left Start-->
          <div class="admin_head_connect_left" id="connect_left">
				   <?php if(is_array($info)): foreach($info as $k=>$v): ?><!--获取下级子栏目-->
						
								   <DIV class="connect_left_connect" id="connect_left_connect_<?php echo ($k); ?>" style="display:<?php if($k > 0): ?>none<?php endif; ?>">
										   <DIV class="connect_left_connect_left" id="connect_left_connect_left">
										   
										         <?php if(is_array($v['s'])): foreach($v['s'] as $bk=>$bv): if($bv['s']): ?><span class="connect_left_connect_left_span<?php if($bk == 0): ?>_hover<?php endif; ?>" onClick="hide_show(this,'#connect_left_connect_<?php echo ($k); ?>  span','connect_left_connect_right_<?php echo ($k); ?>_','connect_left_connect_left_span')"><?php echo ($bv[title]); ?></span><?php endif; endforeach; endif; ?>
									 </DIV>
										   
										   	 <?php if(is_array($v['s'])): foreach($v['s'] as $bk=>$bv): ?><!--获取第三层菜单-->
                                                        <?php $url=""; ?>
													         <?php if(is_array($bv['s'])): foreach($bv['s'] as $key=>$b_v): if(trim($b_v['url'])=="" || $b_v['url']==NULL) { $url_file=$b_v['url_m'].'/'.$b_v['url_c'].'/'.$b_v['url_a']; $url=$url.RR(array($url_file,$b_v['url_p']),$b_v[title],"menu_url","target='connect_iframe".$b_v['id']."' data-urlid='".$b_v['id']."'"); }else { $url=$url.$b_v['url']; } endforeach; endif; ?>
                                                              
														<!--获取第三层菜单完-->
                                                        <?php if($url): ?><DIV class="connect_left_connect_right" id="connect_left_connect_right_<?php echo ($k); ?>_<?php echo ($bk); ?>" style="display:<?php if($bk > 0): ?>none<?php endif; ?>"><?php echo ($url); ?></DIV><?php endif; endforeach; endif; ?>
								   
								   </DIV>
						  
						 <!--获取下级子栏目完--><?php endforeach; endif; ?>

				  
  </div>
	  <!--  Menu_left End-->
	  
	  <!--  Right Start-->
	      <div class="admin_head_connect_right" id="connect_right"><iframe src="<?php echo U('System/Index/System_index');?>" name="connect_iframe0" id="connect_iframe0" width="100%" height="100%" scrolling="yes" frameborder="0"></iframe>
	      </div>
	  <!--  Right End-->
</div>
<!--  conect End-->



<!--  foot Start-->

<!--浮动层下左方的下拉菜单-->

<div class="list-group admin_open_list_bottom_left" id="menu_down_list_bottom_left" style="display:none">
  <?php echo RR('Admin/Menu/menu_list',L('ADMIN_Menu_Manage'),'list-group-item sizefont_14',' target="connect_iframe" onClick="menu_down_show(\'menu_down_list_bottom_left\')"');?>
  <?php echo RR('Admin/Menu/menu_add',L('ADMIN_Menu_Add'),'list-group-item sizefont_14',' target="connect_iframe" onClick="menu_down_show(\'menu_down_list_bottom_left\')"');?> 
</div>
<!--浮动层下左方的下拉菜单完-->
<div class="admin_foot admin_black_bg" id="foot">
    <div class="admin_foot_left">
           <div class="admin_open_bottom_left glyphicon glyphicon-th"  onClick="menu_down_show('menu_down_list_bottom_left')"></div>
	</div>
	
	<div class="admin_foot_right" id="admin_foot_right">
     
	</div>
	
	
</div>
<div class="admin_open_menu_bottom_right" id="admin_foot_right2" ><div class='btn btn-default admin_foot_right_div' id='menu_down_right_narrow_0' onClick='menu_down_right_narrow(0)'><SPAN ><?php echo L('ADMIN_Index');?></SPAN>&nbsp;<span class='close_2 close' id='menu_close_id' onClick='menu_close_id(0)'>×</span></div></div>
<!--  foot End-->

<SCRIPT src="/cowcms/Public/css_js_font_img/js/jquery.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/bootstrap.min.js" type="text/javascript"></SCRIPT>
<SCRIPT src="/cowcms/Public/css_js_font_img/js/jscroll.js" type="text/javascript"></SCRIPT>
<SCRIPT>
$(document).ready(
    function(){ 
	      web_resize();
	      $(window).resize(function () { web_resize();});
	}
	
);

function web_jscroll()
{
      	$("#connect_left").niceScroll({cursorborder:"1px solid #CCCCCC",cursorcolor:"#CCCCCC url(/cowcms/Public/css_js_font_img/img/g.png) no-repeat  center center",boxzoom:true,cursoropacitymin:1,cursorwidth:5,autohidemode:"cursor",background: "url(/cowcms/Public/css_js_font_img/img/g_bg.png) repeat-y center top" }); 
		
}

function menu_down_show(id)
{
    $('#'+id).toggle();
}

function web_resize(){
 var h=$(window).height()-$("#head").height()-$("#foot").height();
 $("#connect").height(h);
 connect_right_width=$(window).width()-$("#connect_left").width();//右边内容iframe 的容器宽度
 $("#connect_right").width(connect_right_width);
 $(".connect_left_connect_right").width($(".connect_left_connect").width()-$("#connect_left_connect_left").width()-3);//左边菜单栏显示连接的宽带
 $("#admin_foot_right").width(connect_right_width); //底部黑色条右边宽带
 $("#admin_foot_right2").width(connect_right_width); //底部菜单的宽带
 
//打开管理界面默认首页
foot_right2=$("#admin_foot_right2");//获取底部导航条的对象 缩小导航栏的容器2
if(foot_right2.length<0)//如果没有菜单容器,就创建
{
	$("<div class='admin_open_menu_bottom_right' id='admin_foot_right'></div>").appendTo('body');
	foot_right2=$("#admin_foot_right2");
	foot_right2.width(foot_right_width-10);
}
//打开管理界面默认首页完
  web_jscroll();
}

function hide_show(id,top_connect,connect_id_str,click_id_class)
{
      
     obj_head=$(top_connect);
	 obj_click_index=obj_head.index(id);
     obj_head.each(function(i){ 	
		  if(obj_click_index==i)
		  { 
		  
		        // alert(obj_click_index+"/"+i+"/"+connect_id_str+obj_click_index+"/LENGTH:"+obj_head.length); 
		         $(this).removeClass();
				 $(this).addClass(click_id_class+"_hover");
				 $("#"+connect_id_str+i).slideDown("slow");;
		  } 
		  else
		  {
		         $(this).removeClass();
		         $(this).addClass(click_id_class);
				 $("#"+connect_id_str+i).slideUp("slow");;
				
		  }
	      //$(this).index().addClass("admin_head_span");
	 })
}

//点击左边链接 添加底部导航栏
$(".menu_url").click(function(){
	id=$(this).data("urlid");
	text=$(this).html();
	object=$("#menu_down_right_narrow_"+id);//获取当前点击链接的底部缩小导航栏对象
    iframe=$('#connect_iframe'+id);//当前连接对应的iframe对象
	connect=$("#connect_right");//内容iframe的容器
	foot_right2=$("#admin_foot_right2");//获取底部导航条的对象 缩小导航栏的容器2
	iframes=$("#connect_right [id*='connect_iframe']");//iframe对象集
	objects=$("#admin_foot_right2 [id*='menu_down_right_narrow_']");//底部缩小菜单栏对象集
	foot_right_width= connect.width();//底部导航条的宽带 
	menu_width=0;//菜单所有底部缩小导航栏的总宽带，包括导航栏间隔的宽度
	
	
   if(foot_right2.length<0)//如果没有菜单容器,就创建
   {
		$('<div class="admin_open_menu_bottom_right" id="admin_foot_right2"></div>').appendTo('body');
		foot_right2=$("#admin_foot_right2");
		foot_right2.width(foot_right_width-10);
   }


    //将所有的iframe隐藏
    iframes.each(function(i){
	    $(this).hide("normal");
    });
	
	// 设置所以底部缩小菜单栏目的样式
	objects.each(function(i){
	    $(this).removeClass("btn-success"); 
		$(this).addClass("btn-default");
    });
	// 判断iframe是否存在
	if(iframe.length>0)
	{
		iframe.show("normal");
	}
	else  // 判断iframe是否存在 如果不存在，追加一个iframe对象
	{
		connect.append('<iframe src="" name="connect_iframe'+id+'" id="connect_iframe'+id+'" width="100%" height="100%" scrolling="yes" frameborder="0"></iframe>');
	}
	
	// 判断iframe是否存在完
	
	//判断下边缩小的菜单栏是否存在
	if(object.length>0)//已经打开了该链接
	{
	
	    object.removeClass("btn-default"); 
		object.addClass("btn-success");
	
	}
	else//没有打开链接
	{
	    foot_right2.append("<div class='btn btn-success admin_foot_right_div' id='menu_down_right_narrow_"+id+"' ><SPAN  onClick='menu_down_right_narrow("+id+")'>"+text+"</SPAN>&nbsp;<span class='close_2 close' id='menu_close_id' onClick='menu_close_id("+id+")'>×</span></div>");
	
	}
});


function menu_down_right_narrow(id)
{
    iframe=$("#connect_iframe"+id);
	object=$("#menu_down_right_narrow_"+id);
    iframes=$("#connect_right [id*='connect_iframe']");//iframe对象集
	objects=$("#admin_foot_right2 [id*='menu_down_right_narrow_']");//底部缩小菜单栏对象集

		iframes.each(function(i){			   
			   $(this).hide("normal");
		});

		 objects.each(function(i){
				   $(this).removeClass("btn-success"); 
		           $(this).addClass("btn-default");				
		});
		iframe.show("normal");
	    object.removeClass("btn-default"); 
	    object.addClass("btn-success");		
}


function menu_close_id(id)
{
    iframe=$("#connect_iframe"+id);
	object=$("#menu_down_right_narrow_"+id);
    iframes=$("#connect_right [id*='connect_iframe']");//iframe对象集
	objects=$("#admin_foot_right2 [id*='menu_down_right_narrow_']");//底部缩小菜单栏对象集
	if(iframes.length<=1)
	{
	     $("#connect_right").append('<iframe src="<?php echo U('System/Index/System_index');?>" name="connect_iframe" id="connect_iframe0" width="100%" height="100%" scrolling="yes" frameborder="0"></iframe>');
	}
	else
	{
	     iframe_index=iframes.index(iframe); 
		 iframe_index=iframe_index<=0?1:iframe_index-1;
		//将所有的iframe
		iframes.each(function(i){
		    if(i==iframe_index)
			{ 
			   $(this).show("normal");
			}
			else
			{
			
			   $(this).hide("normal");
			}
		});
	
	}
	
	if(objects.length<=1)
	{
	     $("#admin_foot_right2").append("<div class='btn btn-success admin_foot_right_div' id='menu_down_right_narrow_0'><SPAN   onClick='menu_down_right_narrow(0)'><?php echo L('ADMIN_Index');?></SPAN>&nbsp;<span class='close_2 close' id='menu_close_id' onClick='menu_close_id(0)'>×</span></div>");
	}
	else
	{
	     object_index=objects.index(object); 
		 object_index=object_index<=0?1:object_index-1;
		 objects.each(function(i){
				if(i==object_index)
				{
				   $(this).removeClass("btn-default"); 
		           $(this).addClass("btn-success");
				}
				else
				{
				   $(this).removeClass("btn-success"); 
		           $(this).addClass("btn-default");			
				
				}
			});
	}
	
    iframe.remove();
	object.remove();
	
	
}


</script>

</body>
</html>