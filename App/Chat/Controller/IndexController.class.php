<?php
namespace Chat\Controller;
use Org\Util\base;
class IndexController extends base {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }
/*=================================================
*直播首页
==================================================*/	 
	public function index() {
		load('Sys_model/function');
		$user=$this->userinfo;
		$config=FF('Conf/website_config','',MODULE_PATH);  
        $room = M('chat_room');
		$chat_class = M( 'Chat_class' );
		$where ['parent_id'] = '0';
		$parent_class = $chat_class->where ($where)->order ( 'sort asc' )->limit(8)->select ();
		foreach ( $parent_class as $k => $v ) {
			$parent_class[$k]['rooms']=get_class_room($v['id'],8);
			$parent_class[$k]['next']=$chat_class->where('parent_id='.$v['id'])->order ('sort asc' )->limit(6)->select();
		}
		$model_id=$config['model_new']?$config['model_new']:0;
		
	    $chat_article_new= model_p($model_id,$show_property=0,$op='',$num=8);//最新
		$chat_article_headline= model_p($model_id,$show_property=1,$op='',$num=1);//头条
		$chat_article_recommend= model_p($model_id,$show_property=3,$op='',$num=8);//头条
		
		$this->assign ( 'user', $user );
		$this->assign ( 'config', $config );
		$this->assign ( 'model_id', $model_id );
		$this->assign ( 'a_new', $chat_article_new );
		$this->assign ( 'a_headline', $chat_article_headline );
		$this->assign ( 'a_recommend', $chat_article_recommend );
		$this->assign ( 'room', get_live_room(5));
		$this->assign ( 'parent_class', $parent_class );
		$this->display();
	}
/*=================================================
*直播列表页
==================================================*/
    public function room_list(){
		$class_id=I('class_id');
		$page=I('page',1,'intval');
		$key_word=I('key_word','','trim');
		$user=$this->userinfo;
		$chat_room=M('chat_room');
		$user=M('user');
		$chat_class = M ('Chat_class');
		$chat_class_info = $chat_class->where (array('status' =>1,'parent_id'=>0) )->order ( 'sort asc' )->limit ( 10 )->select ();
		foreach ( $chat_class_info as $val ) {
			$val ['child'] = $chat_class->where (array('status' => 1,'parent_id' => $val ['id']))->order ( 'sort asc' )->limit (10)->select();
			$navs [] = $val;
		}
		$class_array=get_sub_class($class_id);
		$where=array('status'=>1);
		if($class_id) $where['class_id']= array('in',$class_array); 
		if($key_word)
		{

			if(is_numeric($key_word)) 
			{
				$where['id']=	$key_word;
			}
			else
			{
				$where['title']=array('like',"%$key_word%");
			}
		}
		$record_count=$chat_room->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$pagesize=30;
			$chat_room_all = $chat_room->where ($where)->page($page,$pagesize)->select();
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		$user=$this->userinfo;
		$this->assign ( 'user', $user );
		$this->assign ('key_word',$key_word);
		$this->assign ('chat_room_all',$chat_room_all);
		$this->assign ('navs', $navs );
		$this->assign ('class_id', $class_id );
		$this->display();
	}
/*=================================================
**主持人房间
==================================================*/	
	
    public function room_show(){
		
		$IS_ROOM_USER=0;
		$room_id=I('room_id');
		$room=room($room_id,'');
		$config=FF('Conf/direct_config','',MODULE_PATH);
		$type=$config['choose_direct']?$config['choose_direct']:0;
	    $cid_array=$room['cid']?unserialize($room['cid']):array();
		$cid=$cid_array[$type];
		if(!$config['open']) $this->error(L('Chat_Err_2'),"",$this->r_time); 
		if($room['status']!=1 || !$cid) $this->error(L('Chat_Err_3'),"",$this->r_time); 
		

		//直播分类
		$chat_class=M('Chat_class');
		$chat_class_info=$chat_class->where(array('status'=>1,'parent_id'=>0))->order('sort asc')->limit(10)->select();
		foreach($chat_class_info as $val)
		{
			$val['child']=$chat_class->where(array('status'=>1,'parent_id'=>$val['id']))->order('sort asc')->limit(10)->select();
			$navs[]=$val;	
		}
		$this->assign('navs',$navs);
		//if(!$room['url']) $this->error(L('Chat_Err_3'),"",$this->r_time); 
		$url=unserialize($room['url']);	
		$gift=M('chat_gift')->where(array('status'=>1))->order('sort asc,price desc,id desc')->select();
		
        $user=$this->userinfo;
/*		if($user['id']==$room['user_id'] && $user['id']) 
		{
			$IS_ROOM_USER=1;
		}*/
		if($user) $user['pass_pre']=md5(user($user['id'],'pass_pre'));
		$config=FF('Conf/website_config','',MODULE_PATH);
		$this->assign('config',$config);
		$this->assign('live',write_live($cid));
		$this->assign('url',$url);
		$this->assign('room_id',$room_id);
		$this->assign('room',$room);
		
		$this->assign('IS_ROOM_USER',$IS_ROOM_USER);
		$this->assign('user',$user);
		$this->assign('gift',$gift);
		$this->display();
    }
    
/*=================================================
**聊天室页面
==================================================*/		
    public function right_radio(){
		$config=FF('Conf/direct_config','',MODULE_PATH);
		
		if(!$config['open'] || !$config['appkey'] || !$config['appsecret']) exit(); 
		$room_id=I('room_id');
		$room=room($room_id,'');
        $room_user=user($room['user_id'],'');
        $user=$this->userinfo;
		if($user) 
		{
			$user['pass_pre']=md5(user($user['id'],'pass_pre'));
			$user['name']=$user['nickname']?$user['nickname']:$user['user'];
		}
		else
		{
			$user['id']="c".rand(1,9999);
			$user['name']=$user['id'];
		}
		$config=FF('Conf/website_config','',MODULE_PATH);
		$this->assign('config',$config);
		$this->assign('room_user',$room_user);
		$this->assign('room_id',$room_id);
		$this->assign('room',$room);
		$this->assign('user',$user);
		$this->display();
    }	
    public function home()
    {
    	$chat_class =M('Chat_class');
    	$where['parent_id']='0';
    	$parent_menu=$chat_class->where($where)->select();
    
    	foreach ($parent_menu as $k=>$v)
    	{
    		$where['parent_id']=$v['id'];
			$parent_menu[$k]['next']=$chat_class->where($where)->select();
    	}
    	$this->assign('parent_menu',$parent_menu);
    	$this->display();
    }
}