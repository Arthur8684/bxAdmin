<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="Description" content="<?php echo ($config['describe']); ?>" />
<meta name="Keywords" content="<?php echo ($config['keyword']); ?>" />
<title><?php echo ($config['title']); ?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="/cowcms/Public/css_js_font_img/css/chat/huya.css">
<script src="/cowcms/Public/css_js_font_img/js/jquery.min.js"></script>
</head>
<body class="page-index">
	<!-- 头部根据页面大小调整 -->
	<script data-fixed="true">
		var w = $('body').width();
		if (w < 1480) $('body').addClass('w-1000');
	</script>
	<!-- S 通用头部 -->
	<div class="duya-header" id="duya-header">
		<div class="duya-header-wrap clearfix">
			<div class="duya-header-bd clearfix">
				<h1 id="duya-header-logo" title="<?php echo L('state_news_broadcasts');?>">
					<a href="<?php echo U('Chat/Index/index');?>" class="clickstat"><img src="<?php echo C('site_logo');?>" alt="<?php echo L('state_news_broadcasts');?>" width="75" height="35"></a>
				</h1>
				<div class="duya-header-nav">
					<span class="hy-nav-link duya-header-on"> <a href="<?php echo U('Chat/Index/index');?>" class="hy-nav-title clickstat" ><?php echo L('home_page');?></a></span> 
                    <span class="hy-nav-link"><a href="<?php echo U('Chat/Index/room_list');?>" class="hy-nav-title hiido_stat clickstat" ><?php echo L('direct_seeding');?></a></span>
					<div class="hy-nav-expand">
						<div class="hy-nav-title nav-main" id="nav-main">
							<a href="<?php echo U('Chat/Index/room_list');?>"><?php echo L('classification');?></a><i class="icon-arrow"></i>
						</div>
						<div class="nav-expand-list nav-expand-game">
							<i class="arrow"></i>
							<?php if(is_array($parent_class)): foreach($parent_class as $key=>$v): ?><dl class="clearfix">
								<dt><a class="clickstat" title="" href="<?php echo U('Chat/Index/room_list/',array('class_id'=>$v[id]));?>" target="_blank"><?php echo ($v[name]); ?></a></dt>
								<?php if(is_array($v[next])): foreach($v[next] as $key=>$vo): ?><dd>
									<a class="clickstat" title="" href="<?php echo U('Chat/Index/room_list/',array('class_id'=>$vo[id]));?>" target="_blank"><?php echo ($vo[name]); ?></a>
								</dd><?php endforeach; endif; ?>
							</dl><?php endforeach; endif; ?>
							<a class="nav-expand-game-more" href="<?php echo U('Chat/Index/room_list/');?>" target="_blank"><?php echo L('More');?> ></a>
						</div>
					</div>

				</div>
				<div class="duya-header-search clearfix">
					<form method="get"  action="<?php echo U('Chat/Index/room_list');?>" target="_blank">
						<input type="text" name="key_word" value="" placeholder="<?php echo L('Room_name_channel_ID');?>">
						<button type="submit" class="btn-search clickstat" eid_desc="<?php echo L('Room_name_channel_ID');?>"></button>
					</form>

				</div>
				<div class="hy-nav-right " style="float: right">
					<div class="hy-nav-title">
						<i class="hy-nav-icon hy-nav-login-icon"></i>
						<div class="un-login-btn" style="width: 230px;">
                            <?php if($user): ?><a  style="float: left; color: #999; text-decoration: none; margin-left: 5px;" href="<?php echo U('User/Index/index');?>" ><?php echo L('USER_CENTER');?></a>
                            <?php else: ?>
                                 <a  style="float: left; color: #999; text-decoration: none; margin-left: 5px;" href="<?php echo U('User/login/index');?>" ><?php echo L('LOGIN_');?></a> 
                                 <i style="display: block; width: 10px; float: left;">|</i><a style="float: left; color: #999; text-decoration: none; margin-left: 5px;" href="<?php echo U('User/login/register');?>"><?php echo L('register');?></a><?php endif; ?>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
	<!-- E 通用头部 -->
	<div class="mod-index-wrap">
		<div id="banner"
			style="background-image: url('/cowcms/Public/css_js_font_img/img/chat/chat_hear_bg.jpg'); height: 625px;">
			<div class="left-banner"></div>
			<div class="right-banner"></div>
		</div>
        
		<!-- S 主屏模块 -->
		<div class="mod-index-main" id="js-main">
			<div class="main-hd" id="video-wraper"></div>
			<div class="main-bd">
				<ul class="item-nav clearfix">
					<?php if(is_array($room)): foreach($room as $key=>$v): ?><li class="clickstat">
                              <div class="item-pic clickstat"  onClick="show_video('<?php echo ($v['url']['pull_url']); ?>')">
                                  <img src=<?php if($v[anchor_cover]): ?>"<?php echo ($v[anchor_cover]); ?>"<?php else: ?>"<?php echo ($v[direct_head]); ?>"<?php endif; ?> alt="<?php echo ($v[title]); ?>">
                                  <div class="highlight">
                                      <i class="arrow"></i>
                                  </div>
                              </div>
                          </li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
		<!-- E 主屏模块 -->
        <script type='text/javascript' charset='utf-8' src='<?php echo C('root_path');?>Public/ckplayer/ckplayer.js'></script>
		<script type="text/javascript">
            function show_video(pull_url)
			{
				if(pull_url)
				{
						var flashvars={
							f:pull_url,
							c:0,
						};
						var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
						CKobject.embedSWF('<?php echo C('root_path');?>Public/ckplayer/ckplayer.swf','video-wraper','ckplayer_video-wraper','100%','100%',flashvars,params);	
				}
				else
				{
					$('#video-wraper').html("<img src='/cowcms/Public/css_js_font_img/img/chat/no_chat_video_bg.jpg' width='100%' height='100%'>");
				}
				

			}
			show_video('<?php echo ($room[0][url][pull_url]); ?>')
		</script>
		<!-- S 游戏列表 -->
		<div class="mod-index-list">
			<?php if(is_array($parent_class)): foreach($parent_class as $key=>$v): ?><div class="box">
				<div class="box-hd">
					<h2 class="title">
						<a target="_blank"
							href="<?php echo U('Chat/Index/room_list/',array('class_id'=>''.$v[id].''));?>"><?php echo ($v[name]); ?></a>
					</h2>
				</div>
				<div class="box-bd">
					<ul class="index-list clearfix line-list two-line-list">
                        <?php if(is_array($v['rooms'])): foreach($v['rooms'] as $key=>$value): ?><li class="index-list-item">
                              <a href="<?php echo U('Chat/Index/room_show/',array('room_id'=>''.$value[id].''));?>" class="video-info clickstat"><img class="pic" data-original="" src=<?php if($value['anchor_cover']): ?>"<?php echo ($value['anchor_cover']); ?>"<?php else: ?>"<?php echo C('site_logo');?>"<?php endif; ?> alt="<?php echo ($value['title']); ?>" title="<?php echo ($value['name']); ?>">
								<div class="item-mask"></div> <i class="btn-link__hover_i"></i>
						      </a>
                              <a href="<?php echo U('Chat/Home/chat_cate/',array('class_id'=>''.$value[class_id].''));?>" class="title clickstat" title="<?php echo room_class($value[class_id],'name');?>"><?php echo room_class($value[class_id],'name');?></a>
							<span class="txt"> <span class="avatar fl"> 
                                    <img data-original="" src=<?php if($value['anchor_cover']): ?>"<?php echo ($value['anchor_cover']); ?>"<?php else: ?>"<?php echo C('site_logo');?>"<?php endif; ?>  alt="" title="<?php echo ($value['name']); ?>"> 
                                    <i class="nick" title="<?php echo ($value['title']); ?>"><?php echo ($value['title']); ?></i>
							</span>
						</span></li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div><?php endforeach; endif; ?>
		</div>
	</div>
	<script src="/cowcms/Public/css_js_font_img/js/huyaheader.js" data-fixed="true"></script>
	<!-- S 通用底部 -->
	<script data-fixed="true">
		document
				.write(function(obj) {
					var __t, __p = '', __j = Array.prototype.join, print = function() {
						__p += __j.call(arguments, '');
					};
					with (obj || {}) {
						__p += '<div class="duya-footer">\r\n <div class="foot-code app-code">\r\n            </div>\r\n    <div class="duya-footer__bd">\r\n        <div class="duya-footer__nav">\r\n            <p>\r\n                关于邦讯|\r\n      联系邦讯|\r\n                友情链接|\r\n                广告热线：5603631|\r\n                在线客服|\r\n                邦讯论坛|\r\n               隐私权保护政策|\r\n                版权保护投诉指引|\r\n             100教育\r\n            </p>\r\n            <p>\r\n                \r\n        <div class="duya-footer__copyright">\r\n            <p>\r\n                <span>太原邦讯网络科技有限公司</span>\r\n                <span>&nbsp;版权所有&nbsp;©&nbsp;2005-2016&nbsp;</span>\r\n            </p>\r\n        </div>\r\n        <div class="duya-footer__hy-logo">\r\n            </div>\r\n    </div>\r\n</div>\r\n';
					}
					return __p;
				}())
	</script>
</body>
</html>