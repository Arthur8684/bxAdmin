<?PHP
class Vcloud{
	private $AppKey = '';//网易AppKey
	private $AppSecret = '';//网易AppSecret
	private $url_base = 'https://vcloud.163.com/app/';//服务器接口链接
	private $data = array();//POST数据
	
    function __construct($AppKey,$AppSecret) {
		$this->AppKey = $AppKey;
		$this->AppSecret = $AppSecret;
	}
/*=================================================
**提交数据
**$type 提交类型
**$data 提交数据 
==================================================*/		
	function post($type,$data) {
		$post_data = json_encode($data);
		$url=$this->url_base.$type;
		$Nonce = time()+rand(0,999);
		$CurTime = time();
		$CheckSum = sha1($this->AppSecret.$Nonce.$CurTime);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //信任任何证书
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		//postheader
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json;charset=utf-8","AppKey:".$this->AppKey,"Nonce:".$Nonce,"CurTime:".$CurTime,"CheckSum:".$CheckSum));
		// post的变量
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		//print_r($post_data);exit;
		$output = curl_exec($ch);
		$errno = curl_errno( $ch );
		$info  = curl_getinfo( $ch );
		//print_r($info);exit;
		curl_close($ch);
		return json_decode($output,true);
	}
/*=================================================
//创建频道
==================================================*/
	public function create_channel($data) {
		$type="channel/create";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//修改频道
==================================================*/
	public function update_channel($data) {
		$type="channel/update";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//删除频道
==================================================*/
	public function delete_channel($data) {
		$type="channel/delete";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//获取频道状态
==================================================*/
	public function channel_stats($data) {
		$type="channelstats";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//获取频道列表
==================================================*/
	public function channel_list($data) {
		$type="channellist";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//获取推流地址
==================================================*/
	public function get_address($data) {
		$type="address";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//设置频道为录制状态
==================================================*/
	public function set_record($data) {
		$type="channel/setAlwaysRecord";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//禁止频道
==================================================*/
	public function channel_pause($data) {
		$type="channel/pause";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//批量禁止频道
==================================================*/
	public function channellist_pause($data) {
		$type="channellist/pause";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//恢复频道
==================================================*/
	public function channel_resume($data) {
		$type="channel/resume";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//批量恢复频道
==================================================*/
	public function channellist_resume($data) {
		$type="channellist/resume";
		$return=$this->post($type,$data);
        return $return;
	}
/*=================================================
//批量恢复频道
==================================================*/
	public function videolist($data) {
		$type="videolist";
		$return=$this->post($type,$data);
        return $return;
	}
}

?>