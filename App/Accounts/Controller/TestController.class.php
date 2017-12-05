<?php
namespace Accounts\Controller;
use Think\Controller;
import("Accounts.Util.WxPayDataBase");
class TestController extends Controller {

/*
-----------------------------------  
   注册会员开通   
-----------------------------------   
*/
    public function index(){

		$product_id=make_product_id('p',161,1,10,49,0);
		echo $product_id;
		dump(get_wx_data($product_id));
		$qrcode=wx_pay_1($product_id);
		$this->assign('qrcode',$qrcode);
		$qrcode1=wx_pay_1('2|0|money|49|10');
		$this->assign('qrcode1',$qrcode1);
		$qrcode3=wx_pay_1('');
		$this->assign('qrcode3',$qrcode3);
		$this->display();
    }
}