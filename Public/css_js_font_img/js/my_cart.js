// JavaScript Document
$(document).ready(function(){
	int=0;	
	$("input[type=checkbox][checked]").each(function(){ 
		p=$(this).parents(".cart_list");
		int=p.find(".price").html()*p.find(".c").val()+int; 
	});
    $("#settle").find("b").html(int.toFixed(2));
  
  $(".jian").click(function(){  
     	p=$(this).parents(".cart_list"); 
        t=p.find(".c");
		t1=t.val();
		t.val(parseInt(t.val())-1) 
		if(t.val()<1){
		t.val(1);
			}
		total=p.find("i");
		price=p.find(".price");
		total.html(''+(price.html()*t.val()).toFixed(2)+'');	
		if (p.find(".check_b").is(':checked') && t1>1){	
	 	int=Number(price.html());
	 	total=$("#settle").find("b").html();
	 	z=Number(total)-int;			
		$("#settle").find("b").html(z.toFixed(2));
		}
		
	  });
  $(".jia").click(function(){
     	p=$(this).parents(".cart_list"); 
        t=p.find(".c"); 
        t.val(parseInt(t.val())+1) 
		total=p.find("i");
		price=p.find(".price");
		total.html(''+(price.html()*t.val()).toFixed(2)+'');
		if (p.find(".check_b").is(':checked')){
	 	int=Number(price.html());
	 	total=$("#settle").find("b").html();
	 	z=Number(total)+int;			
		$("#settle").find("b").html(z.toFixed(2));			
			}
    }) ; 	
  $(".ww").click(function(){
	  if(confirm("确认删除么？")){
	  p=$(this).parents(".cart_list"); 
	  int=p.find(".price").html()*p.find(".c").val();
	  id=p.find(".check_b").val();

	  p.remove();
	  htmlobj=$.ajax({url:"/index.php/Order/user/del_cart.php?id="+id+"",async:false});
	  	int=0;	
	$("input[type=checkbox][checked]").each(function(){ 
		p=$(this).parents(".cart_list");
		int=p.find(".price").html()*p.find(".c").val()+int; 
	});
    $("#settle").find("b").html(int.toFixed(2)); 
	  html_alert(htmlobj.responseText);
	  }
	}); 
  $(".check_b").click(function(){  
 	 p=$(this).parents(".cart_list"); 
	 int=p.find(".price").html()*p.find(".c").val();
	 total=$("#settle").find("b").html();
	 z=Number(total)+int;
	 z1=Number(total)-int;
	 if ($(this).is(':checked')){
		 $("#settle").find("b").html(z.toFixed(2));
		 }else{
		 $("#settle").find("b").html(z1.toFixed(2)); 
		}
  	}); 
});

