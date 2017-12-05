$(function(){
////	微信点击出现页面
//	$(".user_wx").first().on("click",function(){
//	  $("<div>").addClass("zhezhao").appendTo(".beijing");
//   	  $(".chuang").addClass("click")
//	})
//点击账号登录出现页面
   $(".user_login").on('click',function(){
   	  $("<div>").addClass("zhezhao").appendTo(".beijing");
   	  $(".login").addClass("click")
	  $(".login").css({'visibility':'visible'})
   })
// 点击右上角小差号关闭页面
   $(".login .close").on("click",function(){
   	   $(".zhezhao").removeClass('zhezhao');
   	   $(".login").removeClass("click")
	   $(".login").css({'visibility':'hidden'})
   })
//快速注册点击出现快速注册页面
   $(".user_register").on("click",function(){
   	  $("<div>").addClass("zhezhao").appendTo(".beijing");
   	  $(".register").addClass("onclick")
	  $(".register").css({'visibility':'visible'})
   })
// 点击右上角小差号关闭页面
   $(".register .close_").on("click",function(){
   	   $(".zhezhao").removeClass('zhezhao');
   	   $(".register").removeClass("onclick");

	   $(".register").css({'visibility':'hidden'})
   })
//点击创建房间出现创建房间页面
   $(".create_user").on("click",function(){
   	  $("<div>").addClass("zhezhao").appendTo(".beijing");
	  $(".create_room").addClass("onclick")
	  $(".create_room").css({'visibility':'visible'})
   })
// 点击右上角小差号关闭页面
   $(".create_room .close").on("click",function(){
   	   $(".zhezhao").removeClass('zhezhao');
	   $(".create_room").removeClass("onclick")
       $(".create_room").css({'visibility':'hidden'}) 
   })
// 点击右上角小差号关闭页面
	$(".join_room .close").on("click",function(){
		$(".zhezhao").removeClass('zhezhao');
		$(".join_room").removeClass("onclick")
		$(".join_room").css({'visibility':'hidden'})
	})
})
