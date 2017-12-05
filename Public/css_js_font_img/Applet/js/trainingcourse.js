$(function(){
	var regmPhone = /^1\d{10}$/,
			checkTimeOut,
			haspaid = GetQueryString('haspaid'),
			perfitPhone = GetQueryString('phone') || '';
	
	//$('.banner').css('height', $(window).width() / 1920 *300);
	$('.banner,.banner img').css('height', $(window).width() / 1920 *560);
	$('.wechart-info').css('height', $(window).width() / 1918 *360);
	$('.recruit').css('height',$(window).width() / 1918 *335);
	$('.recruit p').css('padding', ($(window).width() / 1918 *154 - $('.recruit p').height()) / 2 + 'px 0');
	$(window).resize(function(){
		$('.banner,.banner img').css('height', $(window).width() / 1920 *560);
		$('.wechart-info').css('height', $(window).width() / 1918 *360);
		$('.recruit').css('height',$(window).width() / 1918 *335);
		$('.recruit p').css('padding', ($(window).width() / 1918 *154 - $('.recruit p').height()) / 2 + 'px 0');
	});

	$('#join-in').on('click', function(){
		window.scrollTo(0, $('.join-info').offset().top);
	});

	$('#payment-cover-win').on('click', '.payment-close', function(){
		// 关闭弹窗
		$('#submit-btn').removeClass('submiting');
		$('#payment-cover-win, #wechar-pay-qrcode').hide();
		$('#wechar-pay').show();
		$('#payment-money').text('');
		clearInterval(checkTimeOut);
	}).on('click', '#wechar-btn', function(event) {
		// 微信二维码
		$(this).parent().hide().siblings('#wechar-pay-qrcode').show();
		$('#alipay-btn').css({'border': '1px solid #9e9e9e'})
	});
	$('.arrow-left').on('click',function(){
		var now = $('#slide li.hasshow');
		now.toggleClass('hasshow').hide();
		if (now.prev().length == 0) {$('#slide li').eq(4).toggleClass('hasshow').fadeIn(500);return;}
		now.prev().toggleClass('hasshow').fadeIn(500);
	})
	$('.arrow-right').on('click', function(){
		var now = $('#slide li.hasshow');
		now.toggleClass('hasshow').hide();
		if (now.next().length == 0) {
			$('#slide li').eq(0).toggleClass('hasshow').fadeIn(500);
			return;
		}
		now.next().toggleClass('hasshow').fadeIn(500);
	});
	$('.courseLook').on('mouseover',function(){
		$(this).find('img').attr('src','http://cdn.jisuapp.cn/zhichi_frontend/static/pc2/trainingCourse/images/32.png')
	}).on('mouseout', function(){
		$(this).find('img').attr('src','http://cdn.jisuapp.cn/zhichi_frontend/static/pc2/trainingCourse/images/31.png');
	})
	$('#submit-btn').on('click', function(){
		if ($(this).hasClass('submiting')) {return;}
		var name = $('#name').val().trim('string'),
				phone = $('#phone').val().trim('string'),
				qq = $('#QQ').val().trim('string');
		if (!name) {
			alertTip('请输入姓名');
			$('#name').focus();
			return;
		}
		if (!phone) {
			alertTip('请输入手机号');
			$('#phone').focus();
			return;
		}
		if (!regmPhone.test(phone)) {
			alertTip('请输入合法手机号');
			$('#phone').focus();
			return;
		}
		if (!qq) {
			alertTip('请输入QQ');
			$('#QQ').focus();
			return;
		}
		$(this).addClass('submiting');

		// 线上
		submitInfo({inv_id: '3321191',
        goods_id: '740',
        num: '1',
        name: name,
        address: qq,
        phone: phone,});
	});


	function submitInfo (param){
		$.ajax({
			url: '/index.php?r=shop/addOrder',
			type: 'post',
			dataType: 'json',
			data: param,
      success:function(data){
      	if (data.status != 0) {alertTip(data.data);}
    		// alertTip('提交成功');
    		payforOrder(data.data.order_id);
    		$('#payment-cover-win').show();
    		$('#payment-money').text(data.data.price);
    		setTimeout(function(){
    			checkOrder(data.data.order_id);
    		},3000);
      	
      },
      error:function(data) {
      	alertTip(data.data);
      }
		});
	}

	function payforOrder (order_id){
		//微信支付
		$.ajax({
			url:'/index.php?r=shop/WeiXinCodePay', 
			type:'get', 
			data:{order_id: order_id,}, 
			dataType:'json', 
			success:function(data) {
				var qr = qrcode(10, 'L');
				qr.addData(data.data);
				qr.make();
				$('#wechar-pay-qrcode-img').attr('src', $(qr.createImgTag()).attr('src'));
			}
		});
		//支付宝
		$('#alipay-btn').attr('href','/index.php?r=shop/AliPay&order_id='+order_id);
	}

	function checkOrder(order_id){
		if (checkTimeOut !== undefined) {
			clearInterval(checkTimeOut);
		};
		checkTimeOut = setInterval(function(){
			$.ajax({
				url:'/index.php?r=shop/CheckOrder',
				data:{order_id: order_id},
				dataType:'json',
				type:'post',
				success:function(data){
					if (data.status != 0) {
						alertTip(data.data);
						return;
					}
					switch(data.data.status) {
						// 0 代付款  1已付款  2已发货 3已退款
						case '0':  // 订单未支付
							break;
						case '1': // 订单支付完成
							// alertTip('订单支付完成');
							clearInterval(checkTimeOut);
							$('#payment-cover-win').hide();
							$('#submit-btn').removeClass('submiting');
							confirmWin({
								titleTxt:'提示',
								contentTxt: '恭喜您报名成功<br>立即加入QQ群【即速应用培训第四期】②：<a target="_blank" href="https://jq.qq.com/?_wv=1027&k=54AHAJ6"></a>学习吧！',
								cancelTxt: '关闭', // 取消按钮
								confirmTxt: '立即加入', // 确定按钮
								confirmFun: function(){
									window.open('https://jq.qq.com/?_wv=1027&k=54AHAJ6');
								}, // 确定回调
								cancelFun: function(){}, // 取消回调
							})
							break;
						case '2': 
							break;
					}
				},
				error:function(data){
				}
			})
		},5000);
	}

	function GetQueryString(name){
	  var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	  var r = window.location.search.substr(1).match(reg);
	  if(r!==null){
	    return  unescape(r[2]);
	  }
	  return '';
	}
	function confirmWin(data){
		var options = {
			titleTxt: data.titleTxt || '提示', // 标题
			contentTxt: data.contentTxt || '',
			cancelTxt: data.cancelTxt || '取消', // 取消按钮
			confirmTxt: data.confirmTxt || '确定', // 确定按钮
			confirmFun: data.confirmFun || function(){}, // 确定回调
			cancelFun: data.cancelFun || function(){}, // 取消回调
		},
			divHtml = '<style>.combtn{width:100px;height:30px;font-size: 14px;border: none;color: #fff;cursor: pointer;margin: 0 20px 35px 10px;background-color: #3091f2;float:right;border-radius: 2px;outline:none}'
			+'.combtn:hover {background-color: #0b6fd3;}'
			+'.canbtn{width:100px;height:30px;font-size: 14px;border: none;color: #78809f;cursor: pointer;margin: 0 0 35px;background-color: #fff;float:right;outline:none}'
			+'.canbtn:hover{color: #3091f2;}</style>'
			+'<div style="position: fixed;left: 0;top: 0;width: 100%;height: 100%;background:rgba(0,0,0,0.5); z-index: 99999;">'
			+'<div style="position: absolute; left: 50%; top: 25%; max-width: 50%; min-width: 270px; border-radius: 5px; opacity: 1;box-shadow: rgba(0, 0, 0, 0.5) 0px 5px 15px; background: #fff;text-align: center;overflow:hidden;">'
			+'<p style="height: 50px;margin:0;padding: 0 20px;background: #b2c6da; font-size: 18px; line-height: 50px; color: #fff;text-align: left;">'+options.titleTxt+'</p>'
			+'<p style="border-radius:5px;font-size:14px;padding:20px 30px;text-align: center;color: #78809f;">'+options.contentTxt+'</p>'
			+'<div style="line-height:30px;"><button class="combtn" style="">'+options.confirmTxt+'</button>'
			+'<button class="canbtn" style="">'+options.cancelTxt+'</button></div></div></div>';

		divHtml = $(divHtml);
		$(divHtml).find('.combtn').click(function(event) {
			options.confirmFun();
			$(divHtml).remove();
		});
		$(divHtml).find('.canbtn').click(function() {
			options.cancelFun();
			$(divHtml).remove();
		});
		$('body').append(divHtml);
		divHtml.children('div').css('margin-left', '-'+divHtml.children('div').width()/2+'px');
	}
});