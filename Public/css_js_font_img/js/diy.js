// JavaScript Document
function jq_confirm(objects,message)
{
	var title=arguments[2]?arguments[2]:"确认提示"; 
	var ok=arguments[3]?arguments[3]:"确定"; 
	var cancel=arguments[4]?arguments[4]:"取消"; 
	modal_str="<div class='modal fade' id='myModal_confirm' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title'>"+title+"</h4></div><div class='modal-body'>"+message+"</div><div class='modal-footer'><button type='button' class='btn btn-default' data-dismiss='modal' id='jq_confirm_cancel' >"+cancel+"</button><button type='button' class='btn btn-primary' id='jq_confirm_ok'>"+ok+"</button></div></div></div></div>";
$("#myModal_confirm").remove();
$("body").append(modal_str);
//居中显示
/*$('#myModal_confirm').on("shown.bs.modal", function(){
          var $this = $(this);
          var $modal_dialog =$this.find(".modal-dialog");
          var m_top = ( $(document).height() - $modal_dialog.height() )/2;
          $modal_dialog.css({margin:m_top + "px auto"});
        });*/

$('#myModal_confirm').modal('show')	

       $('#jq_confirm_ok').on('click',
							  function(){  
								  if(objects.action==undefined)
								  {

								      window.location.href=objects.href;
								  }
								  else
								  {
									  objects.submit();									  
								  }
		});
return false;
}

function jq_alert(message)
{
	var title=arguments[1]?arguments[1]:"提示信息"; 
	var ok=arguments[2]?arguments[2]:"确定"; 
	modal_str="<div class='modal fade' id='myModal_alert' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title'>"+title+"</h4></div><div class='modal-body'>"+message+"</div><div class='modal-footer'><button type='button' class='btn btn-default' data-dismiss='modal' id='jq_confirm_cancel' >"+ok+"</button></div></div></div></div>";
$("#myModal_alert").remove();
$("body").append(modal_str);
//居中显示
/*$('#myModal_alert').on("shown.bs.modal", function(){
          var $this = $(this);
          var $modal_dialog =$this.find(".modal-dialog");
          var m_top = ( $(document).height() - $modal_dialog.height() )/2;
          $modal_dialog.css({margin:m_top + "px auto"});
        });*/


$('#myModal_alert').modal('show')	

}



/*
通过AJAX修改单个字段信息
{
"id_name":id_name 被点击对象的容器id名称,也就是被点击对象的父ID
"url"：url 要上传数据的链
"field":fieid要修改的字段名称，如果为空，默认为字段名为id_name
"width":width输入框的字符宽度 默认20
"callback":callback 回掉函数字符串格式 a(b,c) 
}
该函数可以有第二个参数，为了调试使用，如果第二个参数不为空，就会打印生成的输入表单信息
ajax 返回的数据格式必须为{'err'：0,'content':"提示信息"}  0表示错误没有错误 
*/
function ajax_text(d)
{
	
open_=arguments[1]?arguments[1]:false; 
id_name=d.id_name?d.id_name:"";
url=d.url?d.url:"";
field=d.field?d.field:id_name;
value=d.value?d.value:"";
width=d.width?d.width:20;
callback=d.callback?d.callback:"";
   if(!d.show)
   {     

		show="<input  type=\"text\" id=\"para\"   size=\""+width+"\" name=\"para\" value=\""+value+"\" onblur=\"ajax_text({'show':1,'url':'"+url+"','callback':'"+callback+"','field':'"+field+"','id_name':'"+id_name+"','width':'"+width+"'})\" />"
		if(open_)
		{
			 alert(show);
		}
        $("#"+id_name).html(show);
		$("#para").focus();;

   }
   else
   {
	   
			modal_str="<div class='modal fade' id='myload' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='row'><div class='col-md-2 laod1'></DIV><div class='col-md-10 padding_8'>正在加载中。。。。。。。</DIV></DIV></div></div></div></div>";
		$("#myload").remove();
		$("body").append(modal_str);
		//居中显示
/*		$('#myload').on("shown.bs.modal", function(){
				  var $this = $(this);
				  var $modal_dialog =$this.find(".modal-dialog");
				  var m_top = ( $(document).height() - $modal_dialog.height() )/2;
				  $modal_dialog.css({margin:m_top + "px auto"});
				});*/

$('#myload').modal({backdrop: 'static', keyboard: false});	

	   
	   
		para="{'"+field+"':'"+$("#para").prop("value")+"'}";
		para=eval('(' + para + ')');
     	     	$.getJSON(url,para,function(json,status,xhr){	
				switch(status)
				{
					case "success":  // load success
					   $('#myload').modal('hide');
					   if(json.err)
					   {
							jq_alert(json.content);
					   }
					   else
					   {
							$("#"+id_name).html("<span  title='点击可编辑'  onClick=\"ajax_text({'show':0,'value':'"+$("#para").prop("value")+"','url':'"+url+"','callback':'"+callback+"','field':'"+field+"','id_name':'"+id_name+"','width':'"+width+"'})\"  >"+$("#para").prop("value")+"</span>");			   
					   }
					   break;     // load success
					case "timeout":
					  jq_alert("加载超时");
					  break;
					case "notmodified":
					  jq_alert("加载错误");
					  break;
					case "parsererror":
					  jq_alert("参数错误");
					  break;
					default:
					  jq_alert("加载错误");
				}
			   }); 
       
   }
  
 
}

/*
ajax_ 通过ajax编辑单个字段，ajax_和ajax_text的区别在于 前者不生成text输入框，直接修改
他的参数为js对象，格式如下
{
	'id_name':id_name 被点击对象的id，和ajax_text的id_name不同，后者的id_name是被点击者父对象的ID
	'url':url ajax 提交的链接
	"field":fieid 要修改的字段名称，如果为空，默认为字段名为id_name
}
*/
function ajax_(d)
{
    open_=arguments[1]?arguments[1]:false; 
    id_name=d.id_name;
	url=d.url;
	field=d.field?d.field:id_name;
	
	if(open_ && !id_name)
	{
		jq_alert("ID empty");
	}
	
	if(open_ && !url)
	{
	   jq_alert("URL empty");
	}
	

			modal_str="<div class='modal fade' id='myload' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='row'><div class='col-md-2 laod1'></DIV><div class='col-md-10 padding_8'>正在加载中。。。。。。。</DIV></DIV></div></div></div></div>";
		$("#myload").remove();
		$("body").append(modal_str);
		//居中显示
/*		$('#myload').on("shown.bs.modal", function(){
				  var $this = $(this);
				  var $modal_dialog =$this.find(".modal-dialog");
				  var m_top = ( $(document).height() - $modal_dialog.height() )/2;
				  $modal_dialog.css({margin:m_top + "px auto"});
				});*/

$('#myload').modal({backdrop: 'static', keyboard: false});	

	para="{'"+field+"':'"+$("#"+id_name).prop("value")+"'}";
		para=eval('(' + para + ')');
     	$.getJSON(url,para,function(json,status,xhr){	
				switch(status)
				{
					case "success":  // load success
					   $('#myload').modal('hide');
					   if(json.err)
					   {
							jq_alert(json.content);
					   }
					   break;     // load success
					case "timeout":
					  jq_alert("加载超时");
					  break;
					case "notmodified":
					  jq_alert("加载错误");
					  break;
					case "parsererror":
					  jq_alert("参数错误");
					  break;
					default:
					  jq_alert("加载错误");
			 }	   
		});	


}

/*
ajax提示数据唯一性
required 验证是否为必须填写 有数据为验证 空""为不验证
url 请求数据连接
field 验证数据唯一性的字段
ok 数据不存在的时候的提示信息
no 数据存在时候的提示信息
loads 数据加载时候的显示信息
err 加载数据出错时候的显示信息

注意:返回数据存放的ID为 field(字段名)_msg
*/
function msg(url,field)
{
	 

	var required=arguments[2]?arguments[2]:"";
	var ok=arguments[3]?arguments[3]:"可以正常使用"; 
	var no=arguments[4]?arguments[4]:"已经存在，请换其他数据"; 
	var loads=arguments[5]?arguments[5]:"加载数据。。。"; 
	var err=arguments[6]?arguments[6]:"加载数据出错"; 
	
	if(!$("#"+field).prop("value") && !required )
	{
		return false;	
	}
	else if(!$("#"+field).prop("value") && required)
	{
		 required="<div class='col-md-1 no1' id='loadmsg'></DIV><div class='col-md-10'>"+required+"</DIV></DIV>";
		 $('#'+field+"_msg").html(required);
		 return false;	
	}
	loads="<div class='col-md-1 laod3' id='loadmsg'></DIV><div class='col-md-10'>"+loads+"</DIV></DIV>";
	ok="<div class='col-md-1 ok1' id='loadmsg'></DIV><div class='col-md-10'>"+ok+"</DIV></DIV>";
	no="<div class='col-md-1 no1' id='loadmsg'></DIV><div class='col-md-10'>"+no+"</DIV></DIV>";
	err="<div class='col-md-1 laod3' id='loadmsg'></DIV><div class='col-md-10'>"+err+"</DIV></DIV>";
        $('#'+field+"_msg").html(loads);

 	    para="{'"+field+"':'"+$("#"+field).prop("value")+"','id':'"+$("#id").prop("value")+"'}";
		para=eval('(' + para + ')');
     	$.getJSON(url,para,function(json,status,xhr){
					
               if(json.err)
			   {
				    if(json.content=="1")
					{
						  $('#'+field+"_msg").html(no);
						  return false;	
					}
					else if(json.content=="2")
					{
						 $('#'+field+"_msg").html(err);
						 return false;	
					}
			   }
			   else if(json.err==0)
			   {
				    $('#'+field+"_msg").html(ok);
					return true;	
			   }

		})
}

function selectFile(parm) {
	 elementId=parm.name;
	 Upload.create({id:parm,data:function(){
		        files=this.files;
				var chosenFiles =files[0];
				var images = '';
				var urls= '';
				var img_num=0;
				var output = document.getElementById(elementId);
				var output_ = document.getElementById(elementId+"_");	
                output.value= chosenFiles;
				if(output_)
				{
					output_.src=chosenFiles;	
				}
		 }
	 
	 });

}


function selectFiles(parm) {
	 var elementId=parm.name;
	 var len_max=parm.len_max?parm.len_max:0;//允许上传图片量
	 Upload.create({id:parm,data:function(){
		        files=this.files;
				var chosenFiles = '';
				var images = '';
				var urls= '';
				var img_num=0;
				var output = document.getElementById(elementId);
				var output_ = document.getElementById(elementId+"_");
				var output_images = document.getElementById( elementId+"_images" );
				var select_len=files.length;//选择图片的个数
				urls=output.value;
				if(output.type=="textarea")
				{
					chosenFiles=urls;
					img_num=(urls)?urls.split(",").length:0;//已有图片个数
				}
				if(len_max && len_max<(img_num+select_len))	
				{
					 jq_alert('最多可选择['+len_max+']个文件，已选择['+img_num+']个文件，还可选择['+(len_max-img_num)+']个文件，实际选择了['+select_len+']个文件，你已经超过上传量了，此次操作无效');
					 return false;
				}	
				for (i in files){
					if(chosenFiles)
					{
					   chosenFiles += ","+files[i] ;
					}
					else
					{
					   chosenFiles = files[i];
					}
					images+="<div class='img-thumbnail_fixed hand' width='150' height='150' ><div class='close_1' onclick=\"close_images("+(i+img_num)+",'"+elementId+"')\"> </div><img src='"+files[i]+"'  width='150' height='150' /></div>";
                }
				output.value = chosenFiles;
				if(output_)
				{
					output_.src=chosenFiles;	
				}
				if(output_images)
				{
					images+=output_images.innerHTML
					output_images.innerHTML=images;	
				}
		 }
	 
	 });

}

function show_images(elementId)
{
	
	var output = document.getElementById( elementId );
	var output_images = document.getElementById( elementId+"_images" );
	urls=output.value;
	array=urls?urls.split(","):"";
	images=""
	array_len=urls?urls.split(",").length:0;
	if(array)
	{
		for(i=0;i<array_len;i++)
		{
			if(trim(array[i]))
			{
			        images+="<div class='img-thumbnail_fixed hand' width='150' height='150' ><div class='close_1' onclick=\"close_images("+i+",'"+elementId+"')\"> </div><img src='"+array[i]+"'  width='150' height='150' /></div>";
					
			}
		}
		
		output_images.innerHTML=images;	
	}
}
function close_images(num,elementId)
{
	var  urls_obj= document.getElementById(elementId);
	var  images_obj= document.getElementById(elementId+"_images");
	var  images="";
	var  k=0;
	var  url_str="";
	urls=urls_obj.value;
	obj_url=urls.split(",")
    for (i = 0; i < obj_url.length; i++)
	   {
           if(num!=i)
		   {
			   images+="<div class='img-thumbnail_fixed hand' width='150' height='150' ><div class='close_1' onclick=\"close_images("+k+",'"+elementId+"')\"> </div><img src='"+obj_url[i]+"'  width='150' height='150' /></div>";
			   if(url_str)
			   {
				   url_str+=","+obj_url[i];
			   }
			   else
			   {
				   url_str=obj_url[i];
			   }
			   k++;
		   }
	   }
	urls_obj.value=url_str;
	images_obj.innerHTML=images;		
}

function iframe_model(url)
{
		modal_str="<div class='modal fade bs-example-modal-lg' id='iframe_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog  modal-lg'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><h4 class='modal-title'></h4></div><div class='modal-body'><iframe src='"+url+"' width='100%' height='600' frameborder='0' id='file_manage'></iframe></div><div class='modal-footer'></div></div></div></div>";
		$("#iframe_model").remove();
		$("body").append(modal_str);
		$("#iframe_model").mousedown(function(e){
			$(".modal-header").css("cursor","move");//改变鼠标指针的形状 
			var offset = $(this).offset();//DIV在页面的位置 
			var x = e.pageX - offset.left;//获得鼠标指针离DIV元素左边界的距离 
			var y = e.pageY - offset.top;//获得鼠标指针离DIV元素上边界的距离 
			
			$(document).bind("mousemove",function(ev)//绑定鼠标的移动事件，因为光标在DIV元素外面也要有效果，所以要用doucment的事件，而不用DIV元素的事件 
			{ 
			$("#iframe_model").stop();//加上这个之后 
			var _x = ev.pageX - x;//获得X轴方向移动的值 
			var _y = ev.pageY - y;//获得Y轴方向移动的值 	
			//$("#file_model").animate({left:_x+"px",top:_y+"px"},1); 
			$("#iframe_model").css({'left':_x, 'top':_y}); 
			}); 
		});
		$(document).mouseup(function() 
		{ 
		$("#iframe_model").css("cursor","default"); 
		$(this).unbind("mousemove"); 
		}) 
		
		$('#iframe_model').modal("show")		   
}


function trim(stri) { return stri.replace(/(^\s*)|(\s*$)/g, ""); } 
// 显示check 和radio的样式，让默认显示
$(function() {
  $(function() {
    $("input[type=\"checkbox\"], input[type=\"radio\"]").not("[data-switch-no-init]").bootstrapSwitch();	
  });

}).call(this);

