// JavaScript Document
h_width=200;
w_width=$(window).width();
y_width=((w_width-h_width)/2); 
alert_html='<style>.alert_b{ height:20%;background:#000; color:#FFF; text-align:center; position:absolute;border-radius:20px; width:'+h_width+'px; top:35%; left:'+y_width+'px;z-index:999; display:none}.alert_b #alert_b_html{ font-size:14px; line-height:35px; margin-top:10px;}.alert_b  p{ font-size:24px}</style><div class=\"alert_b\"><div id=\"alert_b_html\"></div><p class=\"glyphicon glyphicon-remove-circle\" id=\"alert_p\"></p></div>';
window.onload = function(){ 
$("body").prepend(alert_html);
};
$(document).ready(function(){
  $("#alert_p").click(function(){
    $(".alert_b").fadeOut(1500);
  });
});
function html_alert(html){
	$(".alert_b").fadeIn();	
	$("#alert_b_html").html(html);
	$(".alert_b").fadeOut(1500);
	}