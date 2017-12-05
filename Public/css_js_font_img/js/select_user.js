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
		param_str=param.field_name?"/field_name/"+param.field_name:"/field_name/user";
		modal_str="<div class='modal fade bs-example-modal-lg' id='select_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog  modal-lg'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'></h4></div><div class='modal-body'><iframe src='"+root_path+"index.php/user/Select/user_list"+param_str+".php' width='100%' height='480' scrolling='No' frameborder='0' id='file_manage'></iframe></div><div class='modal-footer'></div></div></div></div>";
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
	  this.select_user=param.return_data;
	}
}

Select.prototype.select_user=function()
{
	 $('#'+this.id).val(this.data);
}
var Select=new Select();

function select_user(param)
{
	Select.create(param);
}