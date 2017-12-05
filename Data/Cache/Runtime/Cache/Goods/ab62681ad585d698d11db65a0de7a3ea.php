<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="bx" />
<meta property="qc:admins" content="377512662466053307063757" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo C('site_keyword');?>" />
<meta name="description" content="<?php echo C('site_description');?>" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<title><?php if(C('site_title')): echo C('site_title'); else: echo C('site_name'); endif; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/css/index.css" />
<link rel="stylesheet" type="text/css" href="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/css/68ecshop_commin.css" />
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/jquery-lazyload.js"></script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/jqueryAll.index.min.js"></script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/jump.js"></script>
<script type="text/javascript">
$(function(){
	 $(".brand-wall-content img").each(function(k,img){
		new JumpObj(img,10);
	});
});
var compare_no_goods = "您没有选定任何需要比较的商品或者比较的商品数少于 2 个。";
var btn_buy = "购买";
var is_cancel = "取消";
var select_spe = "请选择商品属性";
</script>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/jquery.json.js"></script><script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/transport.js"></script> <script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/common.js"></script><script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/index.js"></script></head>

<body>


	<div id="site-nav">
<div id="sn-bd">
  <div class="sn-container"> 
  
    	 
	<script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/utils.js"></script><script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/common.min.js"></script><script type="text/javascript" src="/cowcms/Public/css_js_font_img/js/index.js"></script>   <font id="login-info" class="sn-login-info"> 	
<em><?php echo C('site_title');?></em>
<?php if($user['id'] > 0): ?><a class="sn-login" href="<?php echo U('User/index/index');?>" target="_top"><?php echo L('welcome');?> <?php echo user($user['id']);?></a>
<?php else: ?>
<a class="sn-login" href="<?php echo U('User/login/index');?>" target="_top"><?php echo L('User_login');?></a>
<a class="sn-register" href="<?php echo U('User/login/register');?>" target="_top"><?php echo L('User_register');?></a><?php endif; ?>
    </font>
    <ul class="sn-quick-menu">
      <li class="sn-mytaobao menu-item j_MyTaobao">
        <div class="sn-menu">
        	<a aria-haspopup="menu-2" tabindex="0" class="menu-hd" href="<?php echo U('User/index/index');?>" target="_top" rel="nofollow"><?php echo L('User_center');?><b></b></a>
        </div>
      </li>
      <li class="sn-separator"></li>

    </ul>
  </div>
</div>
</div>
<div id="header">
  <div class="headerLayout">
    <div class="headerCon ">
      <h1 id="mallLogo" class="mall-logo"> 
     	<a href="/" class="header-logo" title="logo"><img src="<?php echo C('site_logo');?>"></a>
      </h1>
      <div class="header-extra">
        <div class="header-banner"> 
</div> 
       <script src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/images/page.js" type="text/javascript"></script>  
        <div id="mallSearch" class="mall-search" style="position:relative; z-index:999999999; overflow:visible;">
        <div id="search_tips" style="display:none;"></div>
          <form class="mallSearch-form" method="get" name="searchForm" id="searchForm" action="<?php echo U('Goods/index/search');?>">
	   		<input type='hidden' name='type' id="searchtype" value="0">
            <fieldset>
              <legend><?php echo L('Shop_seach');?></legend>
              <div class="mallSearch-input clearfix">
                <div id="s-combobox-135" class="s-combobox">
                  <div class="s-combobox-input-wrap">
                    <input aria-haspopup="true" role="combobox" class="s-combobox-input" name="keyword" id="keyword" tabindex="9" accesskey="s"  autocomplete="off"  value="<?php echo L('Shop_seach_keyword');?>" onFocus="if(this.value=='<?php echo L('Shop_seach_keyword');?>'){this.value='';}else{this.value=this.value;}" onBlur="if(this.value=='')this.value='<?php echo L('Shop_seach_keyword');?>'" type="text">
                  </div>
                </div>
                <input type="submit" value="搜索" class="button"  >
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="globa-nav">
  <div class="w">
  	<div class="allGoodsCat Left" > 
    	<a href="<?php echo U('Goods/index/goods_cate_all');?>" class="menuEvent" title="<?php echo L('Shop_allgate');?>"><strong class="catName"><?php echo L('Shop_allgate');?></strong><i></i></a>
   </div>
  <ul class="allMenu Left">
  <?php if(is_array($nav)): foreach($nav as $key=>$v): ?><li><a class="index nav" href="<?php echo U($v['url_m'].'/'.$v['url_c'].'/'.$v['url_a'],''.$v['url_p'].'');?>" title="<?php echo ($v['title']); ?>"><?php echo ($v['title']); ?></a></li><?php endforeach; endif; ?>
  </ul>
  </div>
</div>
<script type="text/javascript">function _show_(h,b){if(!h){return;}if(b&&b.source&&b.target){var d=(typeof b.source=="string")?M.$("#"+b.source):b.source;var e=(typeof b.target=="string")?M.$("#"+b.target):b.target;if(d&&e&&!e.isDone){e.innerHTML=d.value;d.parentNode.removeChild(d);if(typeof b.callback=="function"){b.callback();}e.isDone=true;}}M.addClass(h,"hover");if(b&&b.isLazyLoad&&h.isDone){var g=h.find("img");for(var a=0,c=g.length;a<c;a++){var f=g[a].getAttribute("data-src_index_menu");if(f){g[a].setAttribute("src",f);g[a].removeAttribute("data-src_index_menu");}}h.isDone=true;}}function _hide_(a){if(!a){return;}if(a.className.indexOf("hover")>-1){M.removeClass(a,"hover");}}</script>
<div class="w">
	<div class="all_cat" style="background: #ffffff;filter: alpha(Opacity=80);background-color: rgba(255,255,255,.8);">
		<?php if(is_array($goods_cate)): foreach($goods_cate as $keys=>$val): ?><div class="list" onmouseover="_show_(this,{ 'source':'JS_side_cat_textarea_<?php echo ($keys); ?>','target':'JS_side_cat_list_<?php echo ($keys); ?>'});" onmouseout="_hide_(this);">
	<dl class="cat" >
  		<dt class="catName"> 
        	<strong class="cat1 Left">
            	<a href="<?php echo U('Goods/index/goods_cate',array('id'=>$val['id']));?>" target="_blank" title="<?php echo ($val['name']); ?>"><?php echo ($val['name']); ?></a>
            </strong>
            
    		<p>
            <?php if(is_array($val[next_cate])): foreach($val[next_cate] as $key=>$v): ?><a href="<?php echo U('Goods/index/goods_cate',array('id'=>$v['id']));?>" target="_blank" title="<?php echo ($v['name']); ?>"><?php echo ($v['name']); ?></a><?php endforeach; endif; ?> 
    		</p>
  		</dt>
	</dl>
	<textarea id="JS_side_cat_textarea_<?php echo ($keys); ?>" class="none">
		<div class="topMap clearfix">
			<div class="subCat clearfix">
            
            <?php if(is_array($val[next_cate])): foreach($val[next_cate] as $key=>$v): ?><div class="list1 clearfix" style="border:none">
					<div class="cat1">
                       <a href="<?php echo U('Goods/index/goods_cate',array('id'=>$v['id']));?>" target="_blank" title="<?php echo ($v['name']); ?>"><?php echo ($v['name']); ?></a>
                    </div>
					<div class="link1">
        				<?php if(is_array($v[next_cate])): foreach($v[next_cate] as $key=>$v1): ?><a href="<?php echo U('Goods/index/goods_cate',array('id'=>$v1['id']));?>" target="_blank" title="<?php echo ($v1['name']); ?>"><?php echo ($v1['name']); ?></a><?php endforeach; endif; ?>   
        			</div>
				</div><?php endforeach; endif; ?> 	
                				
			</div>
		</div>
	</textarea>
	<div id="JS_side_cat_list_<?php echo ($keys); ?>" class="hideMap Map_positon<?php echo ($keys); ?>"></div>
</div><?php endforeach; endif; ?>
	</div>
</div>
<!------------------------------------------->
    <div style="margin:0px auto;width:1212px; position:relative; z-index:9999999999999999999">
        <li style="float:left; width:1002px; list-style:none">&nbsp;</li>
        <li style="float:left; width:210px; list-style:none">
            <div style=" height:150px;">
                <h2 style=" text-indent:12px; font-size:16px; font-weight:bold; line-height:30px;">站内公告</h2>
                <?php if($notice != ''): if(is_array($notice)): foreach($notice as $key=>$val): ?><p style=" text-indent:12px; line-height:25px; height:25px; width:200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; ">[<?php echo (date("m/d",$val[addtime])); ?>]<a href="<?php echo U('Article/Index/index_show',array('id'=>$val['id'],'model_id'=>$model_id_notice));?>" target="_blank"><?php echo ($val['title']); ?></a></p><?php endforeach; endif; ?>
                <?php else: ?>
                <p style=" margin-top:60px; text-align:center">暂无公告</p><?php endif; ?>
            </div>
            <div><?php echo ad(12);?></div>
        </li>
    </div>
	<div class="home-focus-layout">
        <ul id="fullScreenSlides" class="full-screen-slides">
            <?php if(is_array($carousel)): foreach($carousel as $key=>$val): ?><li style=" background:url(<?php echo ($val['carousel_img_url']); ?>) center no-repeat; display:<?php if($key == 0): ?>list-item<?php else: ?>none<?php endif; ?>"> 
                <a href="<?php echo ($val['carousel_url']); ?>" target="_blank" title="<?php echo ($val['name']); ?>">&nbsp;</a> 
              </li><?php endforeach; endif; ?>
        </ul>
	</div>
<script type="text/javascript">
$(document).ready(function(){
  var a = $("#specialId").children("li");
  var b = $(".bf-content"); 
  if($(a).length > 0){ 
		b.css({"display":"block"});
	} 
	else{ 
		b.css({"display":"none"});
	} 
});
</script>
		<div class="blank5"></div>		
		<div class="floorList">
			<div class="floor"></div>
			
			<script type="text/javascript">
			function Move(btn1,btn2,box,btnparent,shu){
				var llishu=$(box).first().children().length;
				var liwidth=121;
				var boxwidth=llishu*liwidth-1;
				var shuliang=llishu-shu;
				$(box).css('width',''+boxwidth+'px');
				var num=0;
				$(btn1).click(function(){
					num++;
					if (num>shuliang) {
						num=shuliang;
					}
					var move=-liwidth*num;
					$(this).closest(btnparent).find(box).stop().animate({'left':''+move+'px'},300);
				});
				$(btn2).click(function(){
					num--;
					if (num<0) {
						num=0;
					}
					var move=liwidth*num;
					$(this).closest(btnparent).find(box).stop().animate({'left':''+-move+'px'},300);
				})
			}
			</script>
			
<?php if(is_array($goods_cate_next)): foreach($goods_cate_next as $key=>$val): ?><div class="w floor">
	<div class="floor02 clearfix">
		<div id="f0" class="home-standard-layout tm-chaoshi-floorlayout style-one">
<!--									<a href="affiche.php~ad_id=35&uri=.html" class="j_ItemInfo_tong">
				<img data-original="data/afficheimg/1459463765894913483.jpg" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/images/loading1.gif" alt="" height="100" width="1210">
			</a>-->
						<div class="m-floor">
				<div class="header left_floor">
					<h2>
						<span>
														<?php echo ($key+1); ?>F
													</span>
						<a href="<?php echo U('Goods/index/goods_cate',array('id'=>$val['id']));?>" target="_self"><?php echo ($val['name']); ?></a>
					</h2>
					<div class="recommend">
						<div class="words" style="background:<?php echo ($floor_color[$key]); ?>">
                            <?php if(is_array($val[next_cate])): foreach($val[next_cate] as $key=>$v): ?><a href="<?php echo U('Goods/index/goods_cate',array('id'=>$val['id']));?>">
                                    <b><?php echo ($v['name']); ?></b>
                                </a><?php endforeach; endif; ?>
                     </div>
                     <?php if($val['ad'] != ''): echo ad($val['ad']); endif; ?>
<!--						<a href="affiche.php~ad_id=11&uri=.html" target="_blank" class="banner">
							<img data-original="data/afficheimg/1459886031176383262.jpg" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/images/loading.gif" height="297" width="240">
						</a>-->
																	</div>
				</div>
				<div class="content mid_floor">
					<div class="goods">
						<div class="middle-layout">
							<ul class="tabs-nav">
								<li class="tabs-selected">
									<h3><?php echo L('shop_cate_show');?></h3>
								</li>
															</ul>
							<div class="tabs-panel">
                            <?php if(is_array($val[goods_list])): foreach($val[goods_list] as $key=>$v1): ?><div class="j_ItemInfo" id="li_858" >
									<div class="wrap">
										<a target="_blank" href="<?php echo U('Goods/index/goods',array('id'=>$v1['id'],model_id=>$val['model_id']));?>" title="<?php echo ($v1['name']); ?>">
											<img data-original="<?php echo ($v1['thumb']); ?>" src="<?php echo ($v1['thumb']); ?>" alt="<?php echo ($v1['name']); ?>" height="160" width="160" class="pic_img_858">
										</a>
										<p class="title">
											<a target="_blank" href="<?php echo U('Goods/index/goods',array('id'=>$v1['id'],model_id=>$val['model_id']));?>" title="<?php echo ($v1['title']); ?>"><?php echo ($v1['title']); ?></a>
										</p>
										<p class="o-price"><?php echo ($v1['price']); ?>积分</p>
										<p class="price">
											<span class="j_CurPrice"><?php echo ($v1['price']); ?>积分</span>
										</p>
										<i class="product-mask"></i>
									</div>
								</div><?php endforeach; endif; ?>   
                                
                                
                                
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="blank5"></div><?php endforeach; endif; ?>
</div>
		
	</div>
	
	<script type="text/javascript">
	$(function(){
		$(".anli_con").find(".anniu").hide();
		$(".anli_con").hover(function(){
			var num = $(this).find("li").length;
			if(num > 11){
		$(this).find(".anniu").show();
			}
	},
	function(){
	
		$(this).find(".anniu").hide();
	})
	}) 
	</script>
	<div class="wrapper">
		<div class="mt10">
			
		</div>
	</div>
	<div class="n-footer"></div>
	<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/indexPrivate.min.js"></script>
	
<div class="site-footer">
  <div class="container wrapper">
    <div class="footer-info clearfix" >
      <div class="info-text">
    
     <?php echo show_foot_list(43,5,5,1212,'172,190');?>

     <a href="javascript:;">&copy; 2015-2016 大乐送商城 版权所有，并保留所有权利。</a> <a href="javascript:;">山西太原小店区长风街长治路口世贸中心C座27层 </a>
      <a href="javascript:;">      Tel: 400-168-6080      </a>
        <a href="javascript:;">      E-mail: zgdalesong@126.com     </a>
        <br>
      </p>
      <p>
                                                                                                      </p>
      </div>      
    </div>    
  </div>
</div>
	<div class="fsFixedTopContent" style="visibility: hidden; display: block;">
  <div class="fsFixedTop" style="opacity: 0; margin-left:-60px;"> 
  	  <?php if(is_array($goods_cate_next)): foreach($goods_cate_next as $key=>$val): ?><a class="smooth <?php if($key == 0): ?>active<?php endif; ?>" href="javascript:;"> <b class="fs fs01"  style="width:80px;"><?php echo ($key+1); ?>F</b> <em class="fs-name" style="width:80px;"><?php echo ($val['name']); ?></em> <i class="fs-line"></i> </a><?php endforeach; endif; ?> 
  </div>
</div>	

</body>
<script type="text/javascript" src="/cowcms/Public/css_js_font_img/css/themes/68ecshopcom_360buy/js/home_index.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
var goods_id = "";
var goodsattr_style = 1;
var gmt_end_time = 0;
var day = "天";
var hour = "小时";
var minute = "分钟";
var second = "秒";
var end = "结束";
var goodsId = "";
var now_time = "";
onload = function(){
  //changePrice();
  fixpng();
  //ShowMyComments("",0,1);
  try {onload_leftTime();}
  catch (e) {}
}});
</script>
</html>