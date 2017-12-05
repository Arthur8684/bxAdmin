function erroritt(that){
	that.src = 'http://cdn.jisuapp.cn/zhichi_frontend/static/pc/index/img/in4.jpg';
}

$(function(){
	$('#slides').css('height',$(window).width() / 1900 * 490 );
			$(window).resize(function(){
				$('#slides').css('height',$(window).width() / 1900 * 490 );
			});
	$('#slides').slidesjs({
		width: $(window).width(),
		height: $(window).width()/1900*490,
		navigation:{
			active: false,
			effect: 'fade'
		},
		pagination:{
			active:true,
			effect: 'fade'
		},
		play:{
			active: true,
			effect: 'fade',
			interval: 3000,
			auto: true,
			swap: false,
			pauseOnHover: false,
			restartDelay: 2500
		},
		effect:{
			slide:{speed: 500},
			fade: {
        speed: 500,
        crossfade: true
      }
		}
	})
	$('.lunbo').css({'height':770 / 1920 * $(window).width()})
	initialCoin();
	function GetQueryString(name)
		{
		     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		     var r = window.location.search.substr(1).match(reg);
		     if(r!=null)return  unescape(r[2]); return null;
		}
			//右小角联小图标
	$('.contact .local').show();
	//播放视频教程
	$('.tutorial_video img').on('click', function(){
			//window.open('https://v.qq.com/x/page/a03858hpzxz.html');
			$('#video').show();
		})

		$('video').on('contextmenu',function(event){
			return false;
		}).on('pause', function(event) {
			$(this).off('play');
		}).on('click', function(){
			if ($('video')[0].paused) {
				$('video')[0].play();
			}else{
				$('video')[0].pause();
			}
		});

		$('#video').on('click', '.close', function(){
			$('#video').hide();
			$('video')[0].pause();
		})

function showlogin(){
	var my_show = GetQueryString("login");
	if(my_show == 1){
		loginFunc();
		$(".lg-mask").show();
	}else{

	}
}
showlogin();
window.onload = function() {
	var i_time;
	var s_time;
	var swiper = new Swiper('.slider_zong.swiper-container', {
	    pagination: '.swiper-pagination',
	    nextButton: '.swiper-button-next',
	    prevButton: '.swiper-button-prev',
	    slidesPerView: 1,
	    paginationClickable: true,
	    loop: true,
	    grabCursor: true,
	    autoplay: 15000,
	    autoplayDisableOnInteraction : false,
	    preventLinksPropagation : true,
	    onSlideChangeEnd: function(sw){
	        $("#slider_wrap .animate-content").removeClass('show');
			$("#slider_wrap .swiper-slide-active > .animate-content").addClass('show');
	    }
	});
};
$(".slide1,.slide2").click(function(event) {
	window.open('/index.php?r=pc/Webapp/myapp','_blank');
	});
	function textEllipsis(){
		$.each($(".page2_ulwrap li p"), function(index, val) {
			 var stlenght = $(this).text();

			 if(stlenght.length > 18){
			 	var showtext = stlenght.substring(0,18) + ' ....';
			 	$(this).text(showtext);
			 }
			
		});
	}	
	function getIntData() {
		$.ajax({
			url: '/index.php?r=pc/index/getAppCase',
			type: 'get',
			dataType: 'json',
			data: {
				page: 1,
				page_size:8
			},
			success: function(msg) {
				if (msg.status == 0) {
					var int_li = '';
					$(msg.data).each(function(index, item) {
						int_li+='<div class="ex_case">'
						      +'<img class="case_pic" src="'+item.cover+'" alt="">'
					        +'<a href="/index.php?r=pc/Webapp/preview&id='+item.app_id+'" target="_blank"><div class="prw_code"><img class="code_pic" src="'+item.qrcode+'"></div></a><a href="/index.php?r=pc/Webapp/preview&id='+item.app_id+'" target="_blank"><div class="preview_btn">预览</div></a></div>';

					  if(index >= 7){
					  	return false;
					  }
					});

				$('#example_con').append(int_li);

				}
			var $exWidth = $('.ex_case').width(),
			  	$exWidth = $exWidth+"px";
			  $('.ex_case').css("height",$exWidth);
			}
		});
	}
	getIntData();
	$(window).resize(function(){
   		initialCoin();
	});
	function initialCoin(){
		var $exWidth = $('.ex_case').width(),
				$exampleTop = $('.example_top').height(),
    		$exWidth = $exWidth+"px";
    		$exampleTop = $exampleTop + 'px';
	    $('.ex_case').css("height",$exWidth);
	    $('.example_top').css("line-height",$exampleTop);
	}	
	var $window           = $(window);
	    $window.on('scroll', revealOnScroll);

	function revealOnScroll() {
	    var scrolled = $window.scrollTop() * 2;
	        //win_height_padded = $window.height() * 1.1;

	    $(".revealOnScroll:not(.animated)").each(function () {
	        var $this     = $(this),
	            offsetTop = $this.offset().top;

	        if (scrolled  > offsetTop) {
	        	if ($this.data('timeout')) {
	          		window.setTimeout(function(){
	            	$this.addClass('animated ' + $this.data('animation'));
	          }, parseInt($this.data('timeout'),10));
	        } else {
	          $this.addClass('animated ' + $this.data('animation'));
	        }
	      }
	    });
	   $(".revealOnScroll.animated").each(function (index) {
	      	var $this     = $(this),
	          	offsetTop = $this.offset().top;
	      	if (scrolled < offsetTop) {
	        	$(this).removeClass('animated fadeInLeft fadeInRight coins')
	      }
	    });
	  }

	revealOnScroll();
});

//行业热文
$(function(){
	$(".hot-article-list-item").each(function(index,item){
		index++;
		if(index%3==0){
			$(this).css("margin-right",0);
		};
		//热文介绍长度超过两行显示省略号
		var oTextItem = $(this).find(".item-intro");
			textLen = oTextItem.html().length*14,
			maxLen = oTextItem.width()*2;
		if(textLen>maxLen){
			var text = oTextItem.text().substr(0,40) + "...";
			oTextItem.html(text);
		};
	})
})
