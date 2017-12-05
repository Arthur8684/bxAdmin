<?php
namespace Mobile\Controller;
use Org\Util\User;
class UserController extends User {
    public function index(){
		//冻结金额		
		$user=$this->userinfo;		
		$group=$this->groupname();
		$withdrawnum=$this->withdraw_count();
		$groupname=$group['name'];
		$money=$user['money'];
		$generation=3;//默认分销显示三代		
		$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
		if($fenxiao){
		$generation=$fenxiao['fengxiao_ceng_num'];
		}
						
		$userid=$user['id'];
		$myteam=$this->my_team($userid,$generation);		
		$myteamtuan=$this->sum_team($myteam);
		$userlist=$this->team_counts($myteamtuan,$generation);
		$my_team_count=count($userlist);
		$menu=M('menu');
		$where['type']='mobile';
		$where['parent_id']=0;
		$where['status']=1;
		$order=M('order');	  
		  $order_count1=$order->where('pay_status=0 and user_id='.$user['id'].' and order_status<3')->count();
		  $order_count2=$order->where('pay_status>0 and ship_status=0 and user_id='.$user['id'].' and order_status<3')->count();
		  $order_count3=$order->where('user_id='.$user['id'].'')->count();
		  $this->assign('order_count1',$order_count1);
		  $this->assign('order_count2',$order_count2);
		  $this->assign('order_count3',$order_count3);
		  
		$menu_list=$menu->where($where)->order('sort')->select();
		$this->assign('page_title',L('User_Manage_TITLE'));
		$this->assign('menu_list',$menu_list);
		$this->assign('username',$user["user"]);
		$this->assign('usermoney',$user["money"]);
		$this->assign('userid',$user["id"]);
		$this->assign('my_team_count',$my_team_count);
		$this->assign('money',$money);
		$this->assign('moneys',$moneys);
		$this->assign('withdrawnum',$withdrawnum);
		$this->assign('groupname',$groupname);
		//var_dump($group);
        $this->display();	
    }
	//用户组名称
    public function groupname(){	
		$user=$this->userinfo;	
		$group=FF("user_group/user_group");
		$groupid=$user['group_id'];
		$groupname='';		
		foreach($group as $val){			
		  if($val['id']==$groupid){			  
			$groupname=$val;		
			break;
			}	
			}
		 return $groupname;		
    }	
	//提现列表	
	public function withdraw_list(){
		//$this->twice_pass_confirm_html();//二级密码验证
		$withdraw=M("withdraw");
		$status=I("get.status",0,'intval');
		$user=$this->userinfo;
		//dump($this->userinfo);	
		$userid=$user['id'];
		$where['status']=$status;			
		$where["userid"]=$userid;
		$pagesize=10;
		$page=I('page',1,'intval');
		$record_count=$withdraw->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info=$withdraw->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		//调取提取状态
		$status_list=$this->withdraw_status($userid);
		$this->assign('status_list',$status_list);
		$this->assign('status',$status);
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
		$page_title=L('User_Index_withdraw_list');
		$this->assign('page_title',$page_title);
		$this->display();		
		}
	//团队数据
	/*
	$userid 主用户ID;
	$generation  显示几,默认3代;	
	*/
	public function my_team($userid,$generation=3){		      	
		$user=M('user');
		$where['recommend']=$userid;	
		$info=$user->where($where)->select();		
		if($info){		
		$generations=$generation-1;		
		for($i=0;$i<count($info);$i++){		
		$info[$i]['num']=$generation;	
		if($generations>0){			
		$info[$i]['xia']=$this->my_team($info[$i]['id'],$generations);				
		}		
		}
		}
		return	$info;
		}
				
	//提现状态
	public function withdraw_status($userid){
		if($userid){
		$withdraw=M("withdraw");
		$where["userid"]=$userid;	
		for($i=0;$i<4;$i++){
			$where["status"]=$i;
			$info=$withdraw->where($where)->select();
			$status[$i]['nums']=count($info);	
			$status[$i]['status']=L('User_Index_status_'.$i.'');						
			}
			
		 return $status;
	 	}
		}	
		
	//提现方式	
	public function withdraw_way(){
		$withdraw_way=M("withdraw_way");
		$where["ishow"]=0;
		$info=$withdraw_way->where($where)->select();
		return $info;
		}
    //提现总数	
	public function withdraw_count(){
		$withdraw=M("withdraw");
		$user=$this->userinfo;
		//dump($this->userinfo);	
		$userid=$user['id'];
		$where["userid"]=$userid;
		$info=$withdraw->where($where)->select();
		return count($info);
		}	
	//提现申请
	public function withdraw(){
		$Accounts=FF('Conf/config','',APP_PATH.'Accounts/');
		//是否开启提现
		if($Accounts['is_open']==1){
		session('url',U('Mobile/user/withdraw'));
		$this->twice_pass_confirm_html();//二级密码验证
		//判断是否开启现金交易
		$config=FF('Conf/config','',COMMON_PATH);
		if($config['money_status']!=1){			
		    $this->error(L('User_Index_withdraw_noshow'),"",3);		
			}else{								
		//查看此会员可提现金额
		$user=$this->userinfo;
		//dump($this->userinfo);	
		$userid=$user['id'];
		$usermoney=$user['money'];
		$generation=3;
		$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
		if($fenxiao){
		$generation=$fenxiao['fengxiao_ceng_num'];
		}
		//最小提现金额
		$d_count=isset($Accounts['freeze']) ? $Accounts['freeze'] : 0;
			if($usermoney<$d_count){
				$usermoney=0;
				}
		if(IS_POST){		 
		 $cash_num=I("post.cash_num",0,'intval');
		 if($cash_num==0){
			$this->error(L('User_Index_withdraw_Err_3'),"",3); 
			 }
		 $way=I("post.way",0,'intval');
		 $account_ID=I("post.account_ID",'','trim');
		 $account_ID2=I("post.account_ID2",'','trim');
		 if(!$cash_num || $way==0 || !$account_ID){			 
			$this->error(L('User_Index_withdraw_Err_2'),"",3); 		 
			}	
			
		 if($account_ID!=$account_ID2){			 
			$this->error(L('User_Index_withdraw_Err_6'),"",3); 		 
			}		 	 	
		 if($cash_num>$usermoney &&$cash_num>$d_count){
		    $this->error(L('User_Index_withdraw_Err_1'),"",3);
			}
			$withdraw=M("withdraw"); 
			$data["userid"] = $userid;
			$data["amount"] = $cash_num;
			$data["way"] = $way;
			$data["account_id"] = $account_ID; 
			$data["addtime"] = time(); 
			if($withdraw->add($data)){	//插入数据	
				$usera=M('user');
				$usera->where('id='.$userid.'')->setDec('money',$cash_num);//减去会员当前资金
				$this->success(L('User_Index_withdraw_Suc_1'),U('Mobile/user/index'),0);
				}else{
				$this->error(L('User_Index_withdraw_Err_3'),"",3);		
					}
			}else{
		$page_title=L('User_Index_withdraw');
		$withdraw_way=$this->withdraw_way();
		$this->assign('Accounts',$Accounts);
		$this->assign('usermoney',$usermoney);
		$this->assign('limitnum',$d_count);
		$this->assign('withdraw_way',$withdraw_way);
		$this->assign('page_title',$page_title);
		$this->display();
		}
		}
		}else{
		$this->error(L('User_Index_withdraw_Err_7'),"",3);	
			}
		}
		
	//算人数	
	public function sum_team($array){

      foreach($array as $val){
	   $html.=''.$val[id].','.$val[num].'|';
	   $html.=$this->sum_team($val[xia]);
    	}	
		return $html;
		}	
	//获取会员名
	public function username($userid){
		$user=M('user');
		$where["id"]=$userid;		
		return $user->where($where)->find();
		}
	//团队人数	
	public function team_counts($myteamtuan,$generation){

		$myteamtuan=array_filter(explode('|',$myteamtuan));		
		for($i=0;$i<count($myteamtuan);$i++){		
			$userlists=explode(',',$myteamtuan[$i]);			
				$userlist[$i]['id']	= $userlists[0];
				$h=$this->username($userlists[0]);
				if($h){
				$j=$this->username($h['position']);	
					}
				$userlist[$i]['user']=$h['user'];
				$userlist[$i]['position']=$j['user'];
				$userlist[$i]['addtime']=$h['addtime'];
				$num=$generation-$userlists[1]+1;
				$userlist[$i]['classcal']	= $num;							
			}
		
		return $userlist;
		}	
	//团队列表
	public function team_list(){
		//$this->twice_pass_confirm_html();//二级密码验证
		$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
		if($fenxiao){
		  $generation=$fenxiao['fengxiao_ceng_num'];
		}
		$user=$this->userinfo;
		//dump($this->userinfo);	
		$userid=$user['id'];
		$myteam=$this->my_team($userid,$generation);
		$myteamtuan=$this->sum_team($myteam);
		$userlist=$this->team_counts($myteamtuan,$generation);
		$my_team_count=count($userlist);
		for($i=1;$i<=$generation;$i++){			
			foreach($userlist as $val){		
				if($val['classcal']==$i){					
					$userlist_group[$i][]=$val;
					}				
				}			
			}
		for($i=1;$i<=count($userlist_group);$i++){	
			$userlist_group[$i]['my_team_count']=count($userlist_group[$i]);		
			$userlist_group[$i]['num']=$i;
			}	
		$classcal=I("get.classcal",0,'intval');	
		$this->assign('page_title',L('User_Index_myteam'));
		$this->assign('my_team_count',$my_team_count);
		$this->assign('my_team',$userlist_group);
		$this->assign('generation',$generation);
		$this->assign('info',$userlist);
		$this->assign('my_team_count',$my_team_count);
		$this->display();	
		}
		//下线会员
		public function team_list_p(){
		$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
		if($fenxiao){
		  $generation=$fenxiao['fengxiao_ceng_num'];
		}
			$id=I("get.id",0,'intval');
			$classcalid=I("get.classcal",0,'intval');
			$classcalid=$classcalid+1;

			if($classcalid<=$generation){			
			$user =M('user');			
			$where["position"]=$id;
			$info=$user->where($where)->select();	
			for($i=0;$i<count($info);$i++){
				$info[$i]['classcal']=$classcalid;
				$info[$i]['c']=$this->team_list_c($info[$i]['id']);
				}

			$username=$this->username($id);
			$username=$username['user'];
			$this->assign('page_title',$username);	
			$this->assign('info',$info);
			$this->assign('username',$username);
			$this->assign('generation',$generation);
			$this->assign('infocount',count($info));			
			$this->display();
			}else{
				$this->error(L('User_Login_Err_8'),"",3);	
				}
			}
		//下线会员个数
		public function team_list_c($userid){
			$user =M('user');	
			$where["position"]=$userid;
			$info=$user->where($where)->select();	
			return count($info);
			}
		
	//修改密码、二级密码
		public function alter_password(){
		
		$user=$this->userinfo;
		if($user['pay_pass']){
			session('url',U('Mobile/user/alter_password'));
			$this->twice_pass_confirm_html();//二级密码验证	
			}
		if(IS_POST){
			$user=$this->userinfo;
			//dump($this->userinfo);	
		    $userid=$user['id'];
			$pass2=I("post.pass2",0,'trim');
			$pass=I("post.pass",0,'trim');
			$confirm_pass=I("post.confirm_pass",0,'trim');		
			if($pass!=$confirm_pass){
			 	$this->error(L('User_Login_Err_4'),"",3);
				}
			$string=new \Org\Util\String();//创建string对象
			$pre=$string->randString(6,0); //获得6位随机字符串
			$user =M('user');			
			$where['id']=$userid;
			if($pass2){
			$data["pay_pass"]=md5($pass);
			}else{
			$data["pass"]=md5($pass.$pre);	
			$data["pass_pre"]=$pre;			
				}	
				
						
			if($user->where($where)->save($data)){				
			   $this->success(L('User_Index_alter').L('User_Index_suc'),U('Mobile/user/index'),0);			
				}
			}else{	
			$this->assign('page_title',L('User_Index_alter_pass'));			
			$this->display();	
			}
			
			}
		public function notice_list(){
			
			$this->display();			
			}	

		public function notice(){
			
			$this->display();			
			}
			//修改资料
		public function alter_infomation(){
			$user=$this->userinfo;	
			if(IS_POST){
					   $id=$user['id'];
					   $user =M('user');
					   $email=I('post.email',"",'trim');
					   fields('user',$id);
					   //===========================检查管理邮箱格式======================================
					    $pattern = "/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/i";
					   if($email!="" && !preg_match($pattern,$email))
					   {
						   $this->error(L('ADMIN_U_Login_Err_5'),"",$this->r_time);
					   }  					   			  
			            
			  //------------------------------------编辑提交的会员----------------------------------------   
						if ($user->create()){
							   if($user->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U("Mobile/user/alter_infomation"),$this->r_time);
							   }
							   else
							   {
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($user->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的会员完--------------------------------------
				
				}else{
			$this->assign('info',$user);	
			$this->assign('page_title',L('User_Index_alter_infomation'));	
			$this->display();	
			}
			}	
			
			//二级密码验证
		public function twice_pass_confirm_html(){
			$user=$this->userinfo;
			if($user['pay_pass']){
			$twice_pass_confirm = session('twice_pass_confirm');
			if(!$twice_pass_confirm){
				$this->redirect('Mobile/user/twice_pass_confirm','',0, '');
				exit();
			}
			}else{		
				$this->error(L('User_please_apply_twicepass'),U('Mobile/user/alter_password'),$this->r_time);
				exit();
				}
			}	
			
		public function twice_pass_confirm(){			
				$user=$this->userinfo;
				$userid=$user['id'];
				$url=session('url');
				if($url){
				$url=$url;
					}else{
        		$url=U('Mobile/user/index');
				 }
				if(IS_POST){
					$user =M('user');
					$pass=I("post.pass",0,'trim');					
					$where['id']=$userid;
					$where['pay_pass']=md5($pass);
					if($user->where($where)->find()){
						session('twice_pass_confirm',true);
						session('url',null);
						$this->success(L('User_Index_confirm').L('User_Index_suc'),$url,0);
						}else{							
						$this->error(L('User_Index_confirm').L('User_Index_status_3'),"",3);	
							}					
					}else{
				
				$this->assign('page_title',L('User_Index_white').L('User_Index_twice').L('User_Index_password'));			
				$this->display();
	
				}		
			}

		public function apply_shop(){
				load('shop/function');	
				$user=$this->userinfo;
				$userid=$user['id'];
			if(IS_POST){
				$data['user_id']=$userid;
				$data['name']=I('name');
				$data['category_id']=linkage_id(I('category_id')); 
				$data['area_id']=linkage_id(I('area_id')); 
				$data['description']=I('description'); 
				$data['mobile']=I('mobile'); 
				$data['attention']=I('attention'); 
				$data['is_air']=I('is_air'); 
				if(add_shop_fun($data,$userid)){
					$this->success(L('User_success'),U('Mobile/user/index'),0);
					}else{
					$this->error(L('User_shop_up'),U('Mobile/user/index'),0);	
					}
				
				}else{
				$shop=M('shop');
				$where['user_id']=$userid;
				
				$shop_info=$shop->where($where)->find();
				if(!$shop_info){
				$area_info=link_list_info(0,'linkage');
	  			$area_info_id=linkage($area_info,"area_id","",0,'',array('text'=>L('area_first'),'value'=>"0"),'form-control');
				$type_list=link_area_list(0);	
	  			$type_id=linkage($type_list,"category_id","",0,'',array('text'=>L('area_first'),'value'=>"0"),'form-control');	
				$this->assign('area_info_id',$area_info_id);
				$this->assign('type_id',$type_id);
				}else{
				if($shop_info['is_open']==0){
					$menu=M('menu');
					$menuid=I('get.id');
				    $menu_list=$menu->where('parent_id='.$menuid.'')->select();
				    $this->assign('menu_list',$menu_list);
					}else{
					$this->assign('info',L('User_apply_shop_apply'));	
					}
					}
				$this->assign('page_title',L('User_apply_shop'));
				$this->display();
				}
			}
		//心情劳动
	public function work(){
		$userid=session('user.id');
		$noarray=array('not in',array(43,21,54));
		$model=M('model')->where(array('type'=>'Article','id'=>$noarray))->select();
		if(!$model) $this->error(L('User_parameter_error'),"",3);
		load('Packets/function');
		$this->assign('model_class',$model);
	    $packets=get_packets($userid);
	    $this->assign('packets',$packets);
		$this->display();
		}
	//填写正能量
	public function coin_get(){	
			$classid=I('classid',0,'intval');
			$modelid=I('model_id',0,'intval');
			$model_config=model_config($modelid);
			if($model_config['open']==0) $this->error(L('is_not_open'),"",$this->r_time);
			$model=model_f($modelid,"");
			$table=$model['table'];
			$article =M($table);
			$user=$this->userinfo;
			$times=$article->where(array('autho_id'=>$user['id']))->order('addtime desc')->getField('addtime');
			//$times=$article->where(array('autho_id'=>$user['id']))->order('addtime desc')->getField('addtime');
			$time_next=(time()-$times)/3600/24;
			if($time_next<1) $this->error(L('today_right_ago'),"",$this->r_time);
	          if(IS_POST)
			  {		
			     $classid=linkage_id($classid);
			     fields($table);
						if ($article->create()){
					           $article->content=$_POST['content'];
							   $article->class_id=$classid;
							   if($article->add())
							   {
							        $this->success(L('ADD').L('success'),U('Mobile/User/work'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($article->getError(),"",$this->r_time);
						}			  
			  }
			  else
			  {		$value=$classid?parents($classid,"sys_model_class",array('name','id'),array('text','value')):"";
					$this->assign('model',$model);
					$this->assign('classid',$classid);
					$this->assign('modelid',$modelid); 
					$this->assign('linkage',linkage(get_model_class($modelid),"classid",'',0,$value,array('text'=>L('SELECT'),'value'=>0),"line_4_padding_1"));//
			        $this->display();			  
			  }        
	    }
	//用户信息显示
	public function user_info(){
		$config=FF('Conf/config','',COMMON_PATH);
		$user=$this->userinfo;		
		$group=$this->groupname();
		$this->assign('page_title',L('User_Manage_TITLE'));
		$this->assign('user',$user);
		$this->assign('config',$config);
		$this->assign('groupname',$group);
        $this->display();	
    }
	//绑定信息
	public function bundling_info(){
		$type=I('type');
		//if(!$type) $this->error(L('User_parameter_error'),"",$this->r_time);
		load('shop/function');
		$area_info=link_list_info(0,'linkage');
	  	$area_info_id=linkage($area_info,"area_id","",0,'',array('text'=>L('area_first'),'value'=>"0"),'form-control');
		$this->assign('area_info_id',$area_info_id);
		$this->assign('type',$type);
		$user=$this->userinfo;
		$this->assign('user',$user);
		    if($type=='mobile') $field="mobile";
			if($type=='bank'){
				$field="bank_authentication";
				if($user['bank_authentication']){
					$info=explode("|",$user['bank_authentication']);
					$this->assign('info',$info);
					}
				} 
			if($type=='real'){
				$field="real_name_authentication";
				if($user['real_name_authentication']){
					$info=explode("|",$user['real_name_authentication']);
					$this->assign('info',$info);
					}
				}	
		if(IS_POST){
			$post=I('post.info');
			if($type=='mobile'){				
						   if(C('sms_appkey') && C('sms_appsecret')){
						   //手机号唯一性验证
						   $mobile_only=M('user')->where(array('mobile'=>$mobile_num))->find();
						   if($mobile_only) $this->error(L('P_no_mobile_only'),"",$this->r_time);
						   //手机验证码验证
						   $mobile_num=I('post.mobile_num');
						   $mobile_code=I('post.mobile_code');
						   $mobile=check_mobile_code($mobile_num,$mobile_code);
						   if($mobile==2){
								$this->error(L('P_no_pass'),"",$this->r_time);	
									}
						   }   
			}
			if($type=='real'){
				if($_FILES)
			{
		         $file_size=1000*1024;
		         $types=array("jpg","png","gif");
				 $path="upload/p_ID/";
				  $upload = new \Think\Upload();// 实例化上传类
				  $upload->maxSize=$file_size;
				  $upload->exts=$types;
				  $upload->rootPath=$path;
				  $upload->replace = true;
				  $upload->saveName ="p_ID_".$user["id"];
				  $upload->autoSub = false;	
				  $info   =   $upload->upload(); 
			}	
			}
			if($type=='bank'){
				$post[]=linkage_id(I('area_id')); 
				}
			$data[$field]=implode('|',$post);
			if(M('user')->where(array('id'=>$user['id']))->save($data)) $this->success(L('user_bundling_info_Suc_'.$type.''),'',$this->r_time);
			}else{
        if($type=='real'){
			if($user['is_real_name']==1){
				$auth=L('user_pass_auth');
				}else{
				$auth=L('user_not_auth');	
					}
					}
		if($type=='bank'){
			if($user['is_bank_auth']==1){
				$auth=L('user_pass_auth');
				}else{
				$auth=L('user_not_auth');	
					}
					}
		if($type=='mobile'){
			if(C('sms_appkey') && C('sms_appsecret'))  $this->assign('mobile_way',1);	 		   
					}						
			$this->assign('auth',$auth);		
		    $this->display();
			}
		}	
//审核列表	
   public function auth(){	
		$noarray=array('not in',array(43,21,54));
		$model=M('model')->where(array('type'=>'Article','id'=>$noarray))->select();
		if(!$model) $this->error(L('User_parameter_error'),"",$this->r_time);
		$this->assign('model_class',$model);
		$this->display();
	    }	
//审核认证信息
	public function authuser_list(){
		$user=$this->userinfo;
		$user_list=M('user')->where(array('recommend'=>$user['id']))->getField('id',true);
		$type=I('type');
		if($type=='bank'){$field="is_bank_auth";$field2='bank_authentication';}
		if($type=='real'){$field="is_real_name";$field2='real_name_authentication';}
		$pagesize=10;
		$page=I('page',1,'intval');
		if($user_list){
		$record_count=M('user')->where(array('id'=>array('in',$user_list)))->count();//获取总记录
		$info=M('user')->where(array('id'=>array('in',$user_list),$field=>0,$field2=>array('neq','0')))->page($page,$pagesize)->select();
		foreach($info as $val){
			$val['info_limit']=explode("|",$val[$field2]);
			$infos[]=$val;
			}
		$page=$record_count<$pagesize?1:$page;
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$this->assign('info',$infos);
		}
		$this->assign('type',$type);
		$this->assign('page_show',$page_show);
	    $this->display();
		} 
	//审核认证信息详细页
	public function authinfo(){
		$type=I('type');
		$id=I('id');
		//if(!$type) $this->error(L('User_parameter_error'),"",$this->r_time);
		$this->assign('type',$type);
		$user=M('user')->where(array('id'=>$id))->find();
		if(!$user) $this->error(L('User_parameter_error'),"",$this->r_time);
		$this->assign('user',$user);
		    if($type=='mobile') $field="mobile";
			if($type=='bank'){
				$field="bank_authentication";
				if($user['bank_authentication']){
					$info=explode("|",$user['bank_authentication']);
					$this->assign('info',$info);
					}
				} 
			if($type=='real'){
				$field="real_name_authentication";
				if($user['real_name_authentication']){
					$info=explode("|",$user['real_name_authentication']);
					$this->assign('info',$info);
					}
				}
	
		    $this->display();
		} 
}