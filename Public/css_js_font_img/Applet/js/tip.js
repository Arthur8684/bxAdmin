
//自定义提示函数
function tip(text) {
	var _div = '<div style="position: fixed;left: 0;top: 0;width: 100%;height: 100%;'
			+'background:rgba(0,0,0,0.5); z-index: 99999;">'
			+'<div style="position: absolute; left: 50%; top: 30%; max-width: 50%; min-width: 20%; border-radius: 5px; opacity: 1;'
			+' box-shadow: rgba(0, 0, 0, 0.498039) 0px 5px 15px; background: #fff; padding-top: 20px;">'
			+'<p style="border-radius: 5px; font-size: 16px; padding: 20px 10px;text-align: center;">'
			+ text + '</p><span class="tip-close" style="position: absolute; display: block; width: 30px; height: 30px;'
			+' top: 0; right: 0; text-align: center; cursor: pointer; font-size: 30px; color: #A5A5A5;">×</span></div></div>';

	_div = $(_div);
	
	_div.find('.tip-close').mouseover(function() {
		$(this).css('color', '#000')
	}).mouseout(function() {
		$(this).css('color', '#A5A5A5')
	}).click(function(e) {
		_div.remove();
		e.stopPropagation();
	});
	_div.click(function(e) {
		_div.remove();
		e.stopPropagation();
	});
	$('body').append(_div);
	_div.children('div').click(function(e){
		e.stopPropagation();
	}).css('margin-left', '-' + _div.children('div').width()/2 + 'px').animate({
		'top': '35%',
		'opacity': '1'
	}, 500);

}
//自定义提示函数 自动消失
function autotip(text,time) {
	time = time || 2000;
	var _div = '<div style="position: fixed;top: 15%;left: 50%;min-width: 20%;max-width: 50%;'
			+'background: #fff;border-radius: 5px;opacity: 0;-webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);'
			+'box-shadow: 0 5px 15px rgba(0,0,0,.5);z-index: 99999">'
			+'<p style="font-size: 18px;padding:20px;text-align:center;">' + text + '</p></div>';

	_div = $(_div);
	$('body').append(_div);
	_div.css({'margin-left': '-'+_div.width()/2+'px'}).animate({
		'top': '20%',
		'opacity': '1'
	},500);
	setTimeout(function(){
		_div.animate({
			'opacity':'0'
		},500,'',function(){
			_div.remove();
		})
	}, time)
}
//是否确认提示函数
function confirmTip(data){
	var options = {
		text : data.text || "",   //提示文字
		CancelText : data.CancelText || '取消',  //取消按钮文字
		ConfirmText : data.ConfirmText || '确定', //确定按钮文字
		CancelFunction : data.CancelFunction || function(){}, //取消按钮回调
		ConfirmFunction : data.ConfirmFunction || function(){}, //确定按钮回调
		CloseFunction : data.CloseFunction || function(){}, //关闭×按钮回调
	}

	var _div = '<div style="position: fixed;left: 0;top: 0;width: 100%;height: 100%;'
			+'background:rgba(0,0,0,0.5); z-index: 99999;">'
			+'<div style="position: absolute; left: 50%; top: 25%; max-width: 50%; min-width: 250px; border-radius: 5px; opacity: 1;'
			+' box-shadow: rgba(0, 0, 0, 0.498039) 0px 5px 15px; background: #fff; padding: 20px 0;text-align: center;">'
			+'<p style="border-radius: 5px; font-size: 16px; padding: 20px 10px;text-align: center;">'
			+ options.text + '</p>'
			+'<span class="tip-close" style="position: absolute; display: block; width: 30px; height: 30px;'
			+' top: 0; right: 0; text-align: center; cursor: pointer; font-size: 30px; color: #A5A5A5;">×</span>'
			+'<button class="tip-combtn" style="width: 89px; height: 35px;font-size: 18px;border: 1px solid #bbb;color: #FFF;cursor: pointer;'
			+'margin-left: 20px;margin-top: 10px;background-color: #03d7a4;">'+options.ConfirmText+'</button>'
			+'<button class="tip-canbtn" style="width: 89px; height: 35px;font-size: 18px;border: 1px solid #bbb;color: #FFF;cursor: pointer;'
			+'margin-left: 20px;margin-top: 10px;background-color: #B4B4B4;">'+options.CancelText+'</button></div></div>';

	_div = $(_div);
	_div.find('.tip-combtn').click(function(event) {
		options.ConfirmFunction();
		_div.remove();
	});
	_div.find('.tip-canbtn').click(function(event) {
		options.CancelFunction();
		_div.remove();
	});
	_div.find('.tip-close').click(function(event) {
		options.CloseFunction();
		_div.remove();
	});
	$('body').append(_div);
	_div.children('div').css('margin-left', '-'+_div.children('div').width()/2+'px')
}

// 提示弹窗 带确认取消按钮
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
		$(divHtml).find('.canbtn').click(function(event) {
			options.cancelFun();
			$(divHtml).remove();
		});
		$('body').append(divHtml);
		divHtml.children('div').css('margin-left', '-'+divHtml.children('div').width()/2+'px');
}