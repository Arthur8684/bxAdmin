// JavaScript Document
function select_model(param)
{
		if(param.root_path)
		{
			root_path=param.root_path;
		}else{
			root_path='/';
		}
		var param_str;
		modal_str="<div class='modal fade bs-example-modal-lg' id='select_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog  modal-lg'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'></h4></div><div class='modal-body'><iframe src='"+root_path+"index.php/System/Index/show_icon.php' width='100%' height='480' scrolling='auto' frameborder='0' id='file_manage'></iframe></div><div class='modal-footer'></div></div></div></div>";
		$("#select_model").remove();
		$("body").append(modal_str);
		$('#select_model').modal("show")
}

function select_model_close()
{
		$('#select_model').modal('hide')
}

var Select=function()
{
	var id="";
	var data="";
}

Select.prototype.create=function(param)  
{

	this.id=param.id;
	select_model(param);
	if(param.return_data)
	{
	  this.show_icon=param.return_data;
	}
}

Select.prototype.show_icon=function()
{
	 $('#'+this.id).val(this.data);
}
var Select=new Select();

function show_icon(param)
{
	Select.create(param);
}