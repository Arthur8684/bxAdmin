
<?PHP
class Mlecloud{
	
	 public $UserId = '';//用户id
	 public $AppSecret = '';//私钥
	 public $Uuid = '';//用户唯一标识码，由乐视网统一分配并提供 UUID
	 public $live_apiurl = 'http://api.open.lecloud.com/live/execute';//直播接口地址
	 public $play_apiurl = 'http://api.letvcloud.com/open.php';//点播接口地址
	 public $live_ver = '1.0';//直播协议版本
	 public $play_ver = '2.0';//点播协议版本
	
    function __construct($userid,$AppSecret,$uuid,$live_ver='1.0',$play_ver = '2.0') {
		$this->UserId = $userid;
		$this->AppSecret = $AppSecret;
		$this->Uuid = $uuid;
		$this->live_ver = $live_ver;
		$this->play_ver = $play_ver;
	}
	
/*===================================================================================
 * 作用：直播
 ====================================================================================*/
	function live($api_name,$param='',$model="post")
	{
		 $param['method'] = $api_name;
		 $res = $this->_live_api($param,$model);//请求接口
		 return $res;
	}

/*==================================================================================
 * 发送直播api请求
 ===================================================================================*/
   function _live_api($param,$model){
	   $param['userid'] = $this->UserId;//用户数字id
	   $param['ver'] = $this->live_ver;//直播版本号
	   $param['timestamp'] =time()*1000;//时间戳 毫秒
	   $Sign=$this->_getSign($param);
	   $param['sign'] =$Sign;//获取签名
	   
	   $function="_curl_".$model;
	   $json = $this->$function($this->live_apiurl,$param);
	   $res = json_decode($json,true);
	  
	   return $res;
  }
/*===================================================================================
 * 作用：点播
 ====================================================================================*/
	function play($api_name,$param='',$model="post")
	{
		 $param['api'] = $api_name;
		 $res = $this->_play_api($param,$model);//请求接口
		 return $res;
	}
/*==================================================================================
 * 发送点播api请求
 ===================================================================================*/
 protected function _play_api($param,$model){
	   $param['ver'] = $this->play_apiurl;//协议版本号，统一取值为2.0
	   $param['user_unique'] = $this->Uuid;//用户唯一标识码，由乐视网统一分配并提供
	   $param['timestamp'] = time()*1000;//当前Unix时间戳
	   $param['format'] = 'json';//返回参数格式：支持json和xml两种方式
	   $Sign=$this->_getSign($param);
	   $param['sign'] =$Sign;//获取签名
	   $function="_curl_".$model;
	   $json = $this->$function($this->play_apiurl,$param);
	   $res = json_decode($json,true);
	  
	   if($res['code'] == 0)
	   {
	        return isset($res['data']) ? $res['data'] : true;
	   }
	   return false;
}
/*===================================================================================
 * 作用：生成签名
 ====================================================================================*/
	function _getSign($param)
	{
		//签名步骤一：按字典序排序参数
		 ksort($param);
		 $String = $this->_formatBizQueryParaMap($param);//拼接数组
		//签名步骤二：在string后加入KEY
		 $String = $String.$this->AppSecret;
		//签名步骤三：MD5加密
		 $String = md5($String);
		
		 return $String;
	}
	
/*======================================================================================
 * 拼接数组
 ======================================================================================*/
	function _formatBizQueryParaMap($paraMap, $urlencode=0){
		  $buff ="";
		  ksort($paraMap);
		  foreach ($paraMap as $k => $v){
			  if($urlencode) $v = urlencode($v);
		      $buff .= $k . $v;
		  }
		   return $buff;
	}
/*=============================================================================================
 * 发送curl post 请求
 ==============================================================================================*/
	 public function _curl_post($url,$data){
		 $url=$url."/?".http_build_query($data);
		 $ch = curl_init();
		 $header ="Content-Type:application/x-www-form-urlencoded;charset=utf-8";
		 curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 $tmpInfo = curl_exec($ch);
		 curl_close($ch);
		 return $tmpInfo;
	}
/*=============================================================================================
 * 发送curl get 请求
 ==============================================================================================*/
	 public function _curl_get($url,$data){
		 $ch = curl_init();
		 $url=$url."/?".http_build_query($data);
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         $tmpInfo = curl_exec($ch);
         curl_close($ch);
         return $tmpInfo;
	}
}

?>