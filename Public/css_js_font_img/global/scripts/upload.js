// JavaScript Document
function file_model(parm)
{
		if(parm.root_path)
		{
			root_path=parm.root_path;
		}else{
			root_path='/';
		}
		modal_str="<div class='modal fade bs-example-modal-lg' id='file_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog  modal-lg'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'></h4></div><div class='modal-body'><iframe src='"+root_path+"index.php/File/Upload/index.php' width='100%' height='480' scrolling='No' frameborder='0' id='file_manage'></iframe></div><div class='modal-footer'></div></div></div></div>";
		$("#file_model").remove();
		$("body").append(modal_str);
		$("#file_model").mousedown(function(e){
			$(".modal-header").css("cursor","move");//改变鼠标指针的形状 
			var offset = $(this).offset();//DIV在页面的位置 
			var x = e.pageX - offset.left;//获得鼠标指针离DIV元素左边界的距离 
			var y = e.pageY - offset.top;//获得鼠标指针离DIV元素上边界的距离 
			
			$(document).bind("mousemove",function(ev)//绑定鼠标的移动事件，因为光标在DIV元素外面也要有效果，所以要用doucment的事件，而不用DIV元素的事件 
			{ 
			$("#file_model").stop();//加上这个之后 
			var _x = ev.pageX - x;//获得X轴方向移动的值 
			var _y = ev.pageY - y;//获得Y轴方向移动的值 	
			//$("#file_model").animate({left:_x+"px",top:_y+"px"},1); 
			$("#file_model").css({'left':_x, 'top':_y}); 
			}); 
		});
		$(document).mouseup(function() 
		{ 
		$("#file_model").css("cursor","default"); 
		$(this).unbind("mousemove"); 
		}) 
		
		$('#file_model').modal("show")
}

function file_model_close()
{
		$('#file_model').modal('hide')
}

function file_create_folder(parent_path,url)
{
			modal_str="<div class='modal fade bs-example-modal-sm' id='file_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'>请输入文件夹名</div><div class='modal-body'><input type='text' class='form-control' id='folder_name' placeholder='请输入文件夹名称'></div><div class='modal-footer'><button type='button' class='btn btn-default' data-dismiss='modal'>取消</button><button type='button' class='btn btn-primary' id='create_folder'>创建</button></div></div></div></div>";
		$("#file_model").remove();
		$("body").append(modal_str);
		$('#file_model').modal("show")	
	    $('#create_folder').on('click',
			  function(){  
                  var value=$('#folder_name').val();
				  if(!value) 
				  {
				      alert('请输入文件夹名称');
					  return 0;
				  }
				  if(/^[\u4e00-\u9fa5]/.test(value)) 
				  {
					 alert("文件夹名称不能包含中文");
				     return 0;
				  }
					para='{\'parent_path\':\''+parent_path+'\',\'folder\':\''+value+'\'}';
					para=eval('(' + para + ')');
					$.getJSON(url,para,function(json){
						 switch(json.code)
							{
							case 0:
							  window.parent.document.getElementById("left_iframe").src=window.parent.document.getElementById("left_iframe").src;
							  location.reload() ;
							  break;	
							case 1:
							  alert("文件夹已经存在")
							  break;
							case 2:
							  alert("新建文件夹失败")
							  break;
							default:
							  alert("新建文件夹失败")
							} 
					});
        });
}


function file_del_folder(parent_path,folder,url)
{
					para='{\'folder\':\''+folder+'\',\'parent_path\':\''+parent_path+'\'}';
					para=eval('(' + para + ')');
					$.getJSON(url,para,function(json){
						 switch(json.code)
							{
							case 0:
							  window.parent.document.getElementById("left_iframe").src=window.parent.document.getElementById("left_iframe").src;
							  location.reload();
							  break;	
							case 1:
							  alert("对不起，您要删除的项目不存在")
							  break;
							case 2:
							  alert("删除项目失败")
							  break;
							default:
							  alert(json.code)
							} 
					});
}

var Upload=function()
{
	var files=new Array();
	var file="";
	var id="";
	var water="";
	var type="";
	var size="";
}

Upload.prototype.create=function(parm)
{
	file_model(parm.id);
	
	if(parm.data)
	{
	  this.data=parm.data;
	}
	this.id=parm.id.name;
	this.water=parm.id.water;
	this.type=parm.id.type;
	this.size=parm.id.size;
	
}

Upload.prototype.data=function()
{
	 $('#'+this.id).val(this.file);
}
var Upload=new Upload();



(function($) {
	var D = $(document).data("func", {});	
	$.smartMenu = $.noop;
	$.fn.smartMenu = function(data, options) {
		var B = $("body"), defaults = {
			name: "",
			offsetX: 2,
			offsetY: 2,
			textLimit: 6,
			beforeShow: $.noop,
			afterShow: $.noop
		};
		var params = $.extend(defaults, options || {});
		
		var htmlCreateMenu = function(datum) {
			var dataMenu = datum || data, nameMenu = datum? Math.random().toString(): params.name, htmlMenu = "", htmlCorner = "", clKey = "smart_menu_";
			if ($.isArray(dataMenu) && dataMenu.length) {
				htmlMenu = '<div id="smartMenu_'+ nameMenu +'" class="'+ clKey +'box">' +
								'<div class="'+ clKey +'body">' +
									'<ul class="'+ clKey +'ul">';
									
				$.each(dataMenu, function(i, arr) {
					if (i) {
						htmlMenu = htmlMenu + '<li class="'+ clKey +'li_separate">&nbsp;</li>';	
					}
					if ($.isArray(arr)) {
						$.each(arr, function(j, obj) {
							var text = obj.text, htmlMenuLi = "", strTitle = "", rand = Math.random().toString().replace(".", "");
							if (text) {
								if (text.length > params.textLimit) {
									text = text.slice(0, params.textLimit)	+ "…";
									strTitle = ' title="'+ obj.text +'"';
								}
								if ($.isArray(obj.data) && obj.data.length) {
									htmlMenuLi = '<li class="'+ clKey +'li" data-hover="true">' + htmlCreateMenu(obj.data) +
										'<a href="javascript:" class="'+ clKey +'a"'+ strTitle +' data-key="'+ rand +'"><i class="'+ clKey +'triangle"></i>'+ text +'</a>' + 
									'</li>';
								} else {
									htmlMenuLi = '<li class="'+ clKey +'li">' +
										'<a href="javascript:" class="'+ clKey +'a"'+ strTitle +' data-key="'+ rand +'">'+ text +'</a>' + 
									'</li>';
								}
								
								htmlMenu += htmlMenuLi;
								
								var objFunc = D.data("func");
								objFunc[rand] = obj.func;
								D.data("func", objFunc);
							}
						});	
					}
				});
				
				htmlMenu = htmlMenu + '</ul>' +
									'</div>' +
								'</div>';
			}
			return htmlMenu;
		}, funSmartMenu = function() {
			var idKey = "#smartMenu_", clKey = "smart_menu_", jqueryMenu = $(idKey + params.name);
			if (!jqueryMenu.size()) {
				$("body").append(htmlCreateMenu());
				
				//事件
				$(idKey + params.name +" a").bind("click", function() {
					var key = $(this).attr("data-key"),
						callback = D.data("func")[key];
					if ($.isFunction(callback)) {
						callback.call(D.data("trigger"));	
					}
					$.smartMenu.hide();
					return false;
				});
				$(idKey + params.name +" li").each(function() {
					var isHover = $(this).attr("data-hover"), clHover = clKey + "li_hover";
					
					$(this).hover(function() {
						var jqueryHover = $(this).siblings("." + clHover);
						jqueryHover.removeClass(clHover).children("."+ clKey +"box").hide();
						jqueryHover.children("."+ clKey +"a").removeClass(clKey +"a_hover");
						
						if (isHover) {					
							$(this).addClass(clHover).children("."+ clKey +"box").show();
							$(this).children("."+ clKey +"a").addClass(clKey +"a_hover");	
						}
						
					});
					
				});
				return $(idKey + params.name);
			} 
			return jqueryMenu;
		};
		
		$(this).each(function() {
			this.oncontextmenu = function(e) {
				//回调
				if ($.isFunction(params.beforeShow)) {
					params.beforeShow.call(this);	
				}
				e = e || window.event;
				//阻止冒泡
				e.cancelBubble = true;
				if (e.stopPropagation) {
					e.stopPropagation();
				}
				//隐藏当前上下文菜单，确保页面上一次只有一个上下文菜单
				$.smartMenu.hide();
				var st = D.scrollTop();
				var jqueryMenu = funSmartMenu();
				if (jqueryMenu) {
					jqueryMenu.css({
						display: "block",
						left: e.clientX + params.offsetX,
						top: e.clientY + st + params.offsetY
					});
					D.data("target", jqueryMenu);
					D.data("trigger", this);
					//回调
					if ($.isFunction(params.afterShow)) {
						params.afterShow.call(this);	
					}
					return false;
				}
			};
		});
		if (!B.data("bind")) {
			B.bind("click", $.smartMenu.hide).data("bind", true);
		}
	};
	$.extend($.smartMenu, {
		hide: function() {
			var target = D.data("target");
			if (target && target.css("display") === "block") {
				target.hide();
			}		
		},
		remove: function() {
			var target = D.data("target");
			if (target) {
				target.remove();
			}
		}
	});
})(jQuery);
