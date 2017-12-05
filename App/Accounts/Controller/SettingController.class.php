<?php
namespace Accounts\Controller;
use Org\Util\Admin;
class SettingController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function setting(){

		if(IS_POST)
		{
		    $post=I('post.');
			$post['is_open']=isset($post['is_open'])?$post['is_open']:0;
			$config1=FF('Conf/config','',MODULE_PATH);
			unset($post['__hash__']);
			$config2=array_merge($config1,$post)  ;
			FF('Conf/config',$config2,MODULE_PATH);
			C($post);
		}
		$this->display();
    }
    public function pay_setting(){

		if(IS_POST)
		{
		    $post=I('post.');
            $wx=$post["wx"];
			$ali=$post["ali"];
			FF('Conf/wx_config',$wx,MODULE_PATH);
			FF('Conf/ali_config',$ali,MODULE_PATH);
			$phpstr="<?php";
			$phpstr.="\r\n namespace Accounts\Util;\r\n class WxPayConfig{\r\n";
			$phpstr.="\r\n const APPID ='".$wx['wx_appid']."';";
			$phpstr.="\r\n const MCHID ='".$wx['wx_mchid']."';";
			$phpstr.="\r\n const KEY ='".$wx['wx_key']."';";
			$phpstr.="\r\n const APPSECRET ='".$wx['wx_appsecret']."';";
			$phpstr.="\r\n const SSLCERT_PATH ='../cert/apiclient_cert.pem';";
			$phpstr.="\r\n const SSLKEY_PATH ='../cert/apiclient_key.pem';";
			$phpstr.="\r\n const CURL_PROXY_HOST ='0.0.0.0';";
			$phpstr.="\r\n const CURL_PROXY_PORT =0;";
			$phpstr.="\r\n const REPORT_LEVENL =1;";
			$phpstr.="\r\n}\r\n?>";
			file_put_contents(MODULE_PATH."/Util/WxPayConfig.class.php", $phpstr);
		}
		$wx=FF('Conf/wx_config','',MODULE_PATH);
		$ali=FF('Conf/ali_config','',MODULE_PATH);
		$this->assign('wx',$wx);
		$this->assign('ali',$ali);
		$this->display();
    }
	public function setting_recharge(){

		$this->display();
    }
}