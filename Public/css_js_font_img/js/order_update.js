// JavaScript Document
function order_model(param)
{

    var param_str;
    param_str="/order_id/"+param.order_id+"/"+param.status_way+"/"+param.status;
    modal_str="<div class='modal fade bs-example-modal-lg' id='order_model' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'><div class='modal-dialog  modal-lg'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'></h4></div><div class='modal-body'>" +
        "<iframe src='"+param.root_path+"/index.php/order/Admin/order_update"+param_str+".php' width='100%' height='480' scrolling='No' frameborder='0' id='file_manage'></iframe></div><div class='modal-footer'></div></div></div></div>";
    $("#order_model").remove();
    $("body").append(modal_str);
    $('#order_model').modal("show")
}

function order_model_close()
{
    $('#order_model').modal('hide')
}

var Select=function()
{
    var id="";
    var data="";
}

Select.prototype.create=function(param)
{
    this.id=param.id;
    order_model(param);
    if(param.return_data)
    {
        this.select_order=param.return_data;
    }
}
Select.prototype.select_order=function()
{
    $('#'+this.id).html(this.data);
}
var Select=new Select();

function select_order(id,order_id,status_way,status,root_path)
{
    param=new Object();	
	param.id=id;
	param.order_id=order_id;
	param.status_way=status_way;
	param.status=status;
    param.root_path=root_path;
    //alert(param.root_path);
	Select.create(param);
}