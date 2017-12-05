// 展示loading
function showLoading(goal){
    var _goal = goal || $("body"); 
    var loading = '<div class="loading_spinner" id="loading_logo"><div class="spinner-container container1">'
                + '<div class="circle1"></div><div class="circle2"></div>'
                + '<div class="circle3"></div><div class="circle4"></div></div>'
                + '<div class="spinner-container container2"><div class="circle1"></div>'
                + '<div class="circle2"></div><div class="circle3"></div>'
                + '<div class="circle4"></div></div><div class="spinner-container container3">'
                + '<div class="circle1"></div><div class="circle2"></div><div class="circle3"></div>'
                + '<div class="circle4"></div></div></div>';
    _goal.append(loading);
}
// 移除loading
function removeLoading(){
    // setTimeout(function(){
        $('#loading_logo') && $('#loading_logo').remove();
    // }, 300);
}

String.prototype.times = function(n) { 
return Array.prototype.join.call({length:n+1}, this); 
}; 

function objectLength(object){
    var num =0;
    for (var i in object){
        if(i!="undefined"){
            num++;
        }
    }
    return num;
}
function getFirstObject(object){
    var index = 0;
    for (var i in object){
        if(i!='undefined'){
            return object[i];
        }
    }
}

function getLastObject(object){
    var index;
    for(var item in object){
        if(object.hasOwnProperty(item)){
            index = item;
        }
    }
    return object[index];
}
function getBackgroundUrl(background){
  var temp = background.substr(4);
  return temp.substr(0,temp.length-1);
}
// 提示框组件 author: anle
(function($){
    $.tooltip = function(ops){
        var ops = $.extend({
                html    : '',
                delay   : 2000,
                callback: null
            }, ops);
            // tool = {
            //     remove : function(){
            //         obj.remove();
            //     }
            // };

        var obj = null,
            text= ops.html,
            html= '<div id="tool_tip" style="position:fixed; max-width:300px; z-index:999999; top:0;'
                + ' left:0; opacity:1; padding:40px 60px; background:rgba(0,0,0,0.7);'
                + 'color:#fff; border-radius:8px; text-align:center; font-size:18px; font-weight:bold">'
                + text +'</div>';

        $('#tool_tip').remove();
        obj = $(html).appendTo('body');

        // obj.css({'margin-left': '-' + obj.width()/2 + 'px', 'margin-top':'-'+obj.height()/2+'px',
        obj.css({'-webkit-transform': 'translate(-50%, -50%)', transform : 'translate(-50%, -50%)',
                 left:'50%', top:'50%'});

        setTimeout(function(){
            obj.animate({
                opacity : 0
            }, 500, 'linear', function(){
                obj.remove();
                $.isFunction(ops.callback) && ops.callback();
            });
        }, ops.delay);

        // return tool;
    };
    var defaultSettings = {
      width            : 300,
      height           : 'auto',
      minHeight        : 150,
      title            : '',
      shadow           : true,
      close            : null,
      btnText          : '确定',
      submit           : null
    };
    $.fn.zDialog = function(options) {
      return this.each(function() {
        var _dialog = $(this).find('.zhichi-content'),
            settings = $.extend({}, defaultSettings, options),
            marginLeft = -settings.width/2,
            marginTop = -settings.height/2,
            titleObject = $('<header class="zhichi-title"><span class="zhichi-title-content">'+settings.title+'</span></header>'),
            closeObject = $('<span class="zhichi-close"></span>');

        (!settings.shadow) && _dialog.parent().css('background-color','transparent');

        _dialog.css({
          'width'      : settings.width,
          'height'     : settings.height,
          'min-height' : settings.minHeight,
          'margin-left': marginLeft,
          'margin-top' : marginTop
        });

        closeObject.appendTo(titleObject);
        titleObject.prependTo(_dialog);
        if( $.isFunction(settings.submit) ){
          $('<span class="zhichi-submit-btn">'+settings.btnText+'</span>').appendTo(_dialog).click(function(event) {
            /* Act on the event */
            settings.submit();
          });
        }

        closeObject.click(function(event) {
          /* Act on the event */
          $.isFunction(settings.close) && settings.close();
          _dialog.parent().hide('slow');
        });
      });
    };

})(jQuery);

//弹默认提示框
function alertTip(html, callback, delay) {
    $.tooltip({
        'html'    : html || '',
        'delay'   : delay || 2000,
        'callback': callback || null
    });
};

//请求error提示框
function requestErrorTip() {
    $.tooltip({
        html : '请求异常'
    });
};
// 请求超时提示框
function requestTimeoutTip() {
    $.tooltip({
        html : '网络状况可能不太好喔'
    });
};

function $ajax(url, type, data, dataType, success, error){
    removeLoading();
    showLoading();
    $.ajax({
        url : url,
        type: type || 'get',
        data: data || {},
        timeout : 15000,
        dataType: 'json',
        success: function(data){
            removeLoading();
            $.isFunction(success) && success(data);
        },
        error: function(xhr, errorType, error){
            removeLoading();
            if (errorType === 'timeout') { 
              requestTimeoutTip();
            } else {
              requestErrorTip();
            }
            $.isFunction(error) && error(xhr, errorType, error);
        }
    });
}


// 连续动画，清除DIV本身附带的动画
function cleanTarget(selector) {
  var animateType = ['fadeIn', 'bounceIn', 'rotateIn', 'translate', 'scale', 'more_','disappear_'];
  for (var i = 0; i < animateType.length; i++) {
    var type = animateType[i];
    var _that = $(selector);
    var _classes = (_that.attr('class')).split(' ');
    if (i < 4) {
      _that.removeClass(type + 'Up')
        .removeClass(type + 'Down')
        .removeClass(type + 'Left')
        .removeClass(type + 'Right')
        .removeClass(type + 'Center');
    } else if (i == 4) {
      _that.removeClass(type + 'CenterIn')
        .removeClass(type + 'CenterOut')
        .removeClass(type + 'X')
        .removeClass(type + 'Y');
    } else if (i == 5) {
      for (var j = 0; j < _classes.length; j++) {
        if (/^more_/.test(_classes[j])) {
          _that.removeClass(_classes[j]);
        }
      }
    } else if (i == 6) {
      for (var j = 0; j < _classes.length; j++) {
        if (/^disappear_/.test(_classes[j])) {
          _that.removeClass(_classes[j]);
        }
      }
    }
  }
}
function ContinuousAnimate(selector) {
  //先引入第一个动画，与之前的动画兼容;
  if(!$(selector).attr('animate-arr')){
    return '';
  }
  cleanTarget(selector);
  var first_animation = (getFirstObject(JSON.parse($(selector).attr('animate-arr'))))['animation-name']||$(selector).attr('animateName');
  var first_animation_detail = getFirstObject(JSON.parse($(selector).attr('animate-arr')));
  $(selector).addClass(first_animation);
  $(selector).hide();
  setTimeout(function(){
    $(selector).show();
  },100)
  var num = 0;
  $(selector).css({
      'animation-duration': first_animation_detail['animation-duration']+'s'||'1s',
      '-webkit-animation-duration': first_animation_detail['animation-duration']+'s'||'1s',
      'animation-delay': first_animation_detail['animation-delay']+'s'||'1s',
      '-webkit-animation-delay': first_animation_detail['animation-delay']+'s'||'1s',
      'animation-iteration-count': first_animation_detail['animation-iteration-count']||'1',
      '-webkit-animation-iteration-count': first_animation_detail['animation-iteration-count'] || '1',
  });
  //开始连续动画
  selector.on("webkitAnimationEnd", function() {
    var arrStr = JSON.parse($(this).attr('animate-arr'));
    var arr = [];
    var duration = [];
    var iteration = [];
    var delay = [];
    //4个参数
    for (var item in arrStr) {
      if(item !='undefined'){
        arr.push((arrStr[item])['animation-name']);
        duration.push((arrStr[item])['animation-duration']);
        iteration.push((arrStr[item])['animation-iteration-count']);
        delay.push((arrStr[item])['animation-delay']);
      }
    }
    num++;
    if (num > arr.length - 1) {
      $(this).unbind('webkitAnimationEnd');
      if ($(this).hasClass('int-animate-disappear') && !$(this).attr('disappear-animation')) {
        $(this).addClass('fadeOutCenter');
      } else if (!$(this).hasClass('int-animate-disappear')) {
        $(this).removeClass(arr[num - 1] || first_animation);
      }
      num = 0;
      return;
    } else {
      $(this).removeClass(arr[num-1] || first_animation);
    }
    $(this).css({
      'animation-duration': duration[num]+'s',
      '-webkit-animation-duration': duration[num]+'s',
      'animation-delay': delay[num]+'s',
      '-webkit-animation-delay': delay[num]+'s',
      'animation-iteration-count': iteration[num],
      '-webkit-animation-iteration-count': iteration[num],
    });
    if(arr[num]==arr[num-1]){
        $(selector).hide();
        $(selector).show();
    }
    $(this).addClass(arr[num]);
  });
}
//PC端连续动画初始化
function continuous_animation_initial(wrapper) {
  $.each($(wrapper + ' .int-animate'), function(index, item) {
    if (!$(item).attr('animate-arr')) {
      return '';
    }
    if (!getFirstObject(JSON.parse($(item).attr('animate-arr')))) {
      return '';
    }
    $(item).removeClass('fadeOutCenter');

    var animation = $(item).attr('disappear-animation');
    animation ? $(item).removeClass(animation) : '';
    ContinuousAnimate($(item));
  });
}

function asyLoadScript(filepath, fileType, callback){
    var container=document.getElementsByTagName('body')[0];
    var node;
    if(fileType == "js"){
        var oJs = document.createElement('script');
        oJs.setAttribute("type","text/javascript");
        oJs.setAttribute("src", filepath);//文件的地址 ,可为绝对及相对路径
        container.appendChild(oJs);//绑定
        node = oJs;
    }else if(fileType == "css"){
        var oCss = document.createElement("link");
        oCss.setAttribute("rel", "stylesheet");
        oCss.setAttribute("type", "text/css");
        oCss.setAttribute("href", filepath);
        container.appendChild(oCss);//绑定
        node = oCss;
    }
    node.onload = function(){
        $.isFunction(callback) && callback();
    }
}

function IsInputValNum(input) {
    if (isNaN(input.val())) {
        return false;
    }
    if (input.val().indexOf('.') != -1) {
        return false;
    }
    return true;
}
