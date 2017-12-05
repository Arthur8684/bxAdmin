<?php
namespace User\Controller;
use Org\Util\User;
class IndexController extends User {
	//首页显示框架
    public function index(){
		if(is_install('Message'))
		{
			$message=M('message');
			$where['message']=$user['id'];
			$where['receive_status']=0;
			$message_info=$message->where($where)->order('addtime desc')->limit(5)->select();
			$message_num=$message->where($where)->order('addtime desc')->count();
			$this->assign('message_info',$message_info);
		    $this->assign('message_num',$message_num);
		}
		$user=$this->userinfo;
		$this->assign('user',$user);
        $this->display();	
    }

	//编辑头像
    public function edit_head(){
		$headpath=I('headpath','','trim');
		$user=$this->userinfo;
		$User = M("user"); // 实例化User对象值
        $data['headpath'] = $headpath;
		$User->where('id='.$user['id'])->data($data)->save();
		$this->success(L('EDIT').L('success'),U('User/Index/user_info#tab_3-2',array('rand'=>time())),$this->r_time);
    }
	//编辑用户信息
    public function edit_user_info(){
			if(IS_POST){
					   $id=$user['id'];
					   $user =M('user');
					   $email=I('post.email',"",'trim');
					   fields('user',$id);				   			  			            
			  //------------------------------------编辑提交的会员----------------------------------------   
						if ($user->create()){
							   if($user->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U("User/index/user_info"),$this->r_time);
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
				
				}
    }	
	
	//用户信息显示
	public function user_info(){
		$user=$this->userinfo;	
		$config=FF('Conf/config','',COMMON_PATH);
		$user_config=FF("user_group/user_config");//用户配置
		$group_config=FF("user_group/user_group");
		$group=$group_config[$user['group_id']];
		
		$user_var=fields_var('user',$user['id']);
			
		$this->assign('page_title',L('User_Manage_TITLE'));
		$this->assign('user',$user);
		$this->assign('config',$config);
		$this->assign('group_config',$group_config);
		$this->assign('user_config',$user_config);
		$this->assign('user_var',$user_var);
		$this->assign('group',$group);
        $this->display();	
    }
	
	//积分兑换
    public function point_convert(){
		$user=$this->userinfo;	
		$point_convert=C('point_convert');
		if($point_convert)
		{
			foreach($point_convert as $k=>$v)
			{
				 $v=$v?$v:1;
				 $convert=array();
				 $point=explode('__convert__',$k);
				 $convert0=trim($point[0]);
				 $convert1=trim($point[1]);
				 $convert['key']=$k;
				 $convert['convert']['name']=C($convert0.".name");
				 $convert['convert']['unit']=C($convert0.".unit");
				 $convert['convert']['ico']=C($convert0.".ico");
				 $convert['convert']['user_point']=number_format($user[$convert0],C($convert0.".decimal"));
				 
				 //要兑换的积分
				 $convert['convert_']['name']=C($convert1.".name");
				 $convert['convert_']['unit']=C($convert1.".unit");
				 $convert['convert_']['ico']=C($convert1.".ico");
				 $convert['convert_']['user_point']=number_format($user[$convert1],C($convert1.".decimal"));
				 
				 $convert['process']=C($k.'.point')?C($k.'.point'):0;
				 $convert['process_unit']=C($k.'.type')=='%'?'%':C(C($k.'.type').".unit")."(".C(C($k.'.type').".name").")";
				 $convert['rate']=$v?$v:1;
				 $convert['rate_p']=($v>=1)?"[ 1".$convert['convert']['unit']."(".$convert['convert']['name'].")".L('CONVERT').$v.$convert['convert_']['unit']."(".$convert['convert_']['name'].") ]":"[ ".(1/$v).$convert['convert']['unit']."(".$convert['convert']['name'].")".L('CONVERT')."1".$convert['convert_']['unit']."(".$convert['convert_']['name'].") ]";
				 
				 $convert_data[]=$convert;
			}
		}
		$this->assign('convert',$convert_data);	
		$this->display();	
    }		
	
	//积分兑换
    public function convert(){
		 
		 $point_type=I('point_type');
		 $point=explode('__convert__',$point_type);
		 $convert0=trim($point[0]);
		 $convert1=trim($point[1]);
		 $convert['convert']['name']=C($convert0.".name");
		 $convert['convert']['unit']=C($convert0.".unit");
		 $convert['convert']['ico']=C($convert0.".ico");
		 $convert['convert']['user_point']=number_format($user[$convert0],C($convert0.".decimal"));
		 
		 //要兑换的积分
		 $convert['convert_']['name']=C($convert1.".name");
		 $convert['convert_']['unit']=C($convert1.".unit");
		 $convert['convert_']['ico']=C($convert1.".ico");
		 $convert['convert_']['user_point']=number_format($user[$convert1],C($convert1.".decimal"));
		 
		 $convert['process']=C($point_type.'.point')?C($point_type.'.point'):0;	//手续费数值
		 $convert['process_type']=C($point_type.'.type'); //手续费类型
		 $convert['process_unit']=C($point_type.'.type')=='%'?'%':C($convert['process_type'].".unit")."(".C($convert['process_type'].".name").")";//手续费单位
		 $convert['rate']=C('point_convert.'.$point_type)?C('point_convert.'.$point_type):1; //兑换比率
		 $convert['rate_p']=($convert['rate']>=1)?"1".$convert['convert']['unit']."(".$convert['convert']['name'].")".L('CONVERT').$convert['rate'].$convert['convert_']['unit']."(".$convert['convert_']['name'].")":(1/$convert['rate']).$convert['convert']['unit']."(".$convert['convert']['name'].")".L('CONVERT')."1".$convert['convert_']['unit']."(".$convert['convert_']['name'].")";		
		 
	    if(IS_POST){
			$point_num=I('point_num',0);// 要兑换的数量
			$point_num1=$point_num * $convert['rate'];
			
			if(!$point_num) $this->error(L('Convert_Num_Err0'),U('User/Index/convert',array('point_type'=>$point_type)),$this->r_time);	
			
			if(trim($convert['process_type'])=="%")
			{
				$process=$point_num * $convert['process'] / 100;
				$coin=array($convert0=>-($point_num+$process),$convert1=>$point_num1);
				$process_str=$process.$convert['convert']['unit']."[ ".$convert['convert']['name']." ]";
				
			}
			else
			{
				$coin=array($convert0=>-$point_num,$convert1=>$point_num1,$convert['process_type']=>-$convert['process']);
				$process_str=$convert['process'].$convert['process_unit'];
			}	

			$msg=$point_num.$convert['convert']['unit']."[ ".$convert['convert']['name']." ]".L('CONVERT').$point_num1.$convert['convert_']['unit']."[ ".$convert['convert_']['name']." ]，".L('POUNDAGE')."：".$process_str;
			$user=$this->userinfo;	
			$convert_insert=account($user['id'],$coin,13,5,$user['user'],$msg);
			if(is_numeric($convert_insert) && $convert_insert>0)
			{
				 $this->success(L('CONVERT').L('success'),U('User/Index/point_convert'),$this->r_time);
			}
			else if($convert_insert)
			{
				 $this->error(L('BALANCE_NOT',array('point'=>C($convert_insert.'.name'))),U('User/Index/convert',array('point_type'=>$point_type)),$this->r_time);	
			}
			else
			{
				 $this->error(L('CONVERT').L('ERR'),U('User/Index/convert',array('point_type'=>$point_type)),$this->r_time);	
			}
			
		}
		else
		{
			
			$select_str=C($point_type.'.option')?C($point_type.'.option'):"10,20,30,50,100,200,300,-1";
			$select=explode(',',$select_str);
			$this->assign('select',$select);	
			$this->assign('point_type',$point_type);
			$this->assign('convert',$convert);	
			$this->display();	
		}
		
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
			$user=$this->userinfo;
			$model_config=model_config($modelid);
			if($model_config['open']==0) $this->error(L('is_not_open'),"",$this->r_time);
			$model=model_f($modelid,"");
			$table=$model['table'];
			$article =M($table);
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
							        $this->success(L('ADD').L('success'),'',$this->r_time);
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
	 //个人审核
	 public function auth(){	
		$noarray=array('not in',array(43,21,54));
		$model=M('model')->where(array('type'=>'Article','id'=>$noarray))->select();
		if(!$model) $this->error(L('User_parameter_error'),"",$this->r_time);
		$this->assign('list',$model);
		$this->display();
	    }	 
	 //个人审核列表
	 public function auth_list(){
		$user=$this->userinfo;
		$user_list=M('user')->where(array('recommend'=>$user['id']))->getField('id',true);
		$model_id=I('model_id');
		if(!$model_id) $this->error(L('User_parameter_error'),"",$this->r_time);
		$model_table=M('model')->where(array('id'=>$model_id))->getField('table');
		if(!$model_table) $this->error(L('User_parameter_error'),"",$this->r_time);
		if($user_list){
			$pagesize=10;
		    $page=I('page',1,'intval');
			$record_count=M($model_table)->where(array('autho_id'=>array('in',$user_list)))->count();//获取总记录数
			$page=$record_count<$pagesize?1:$page;
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$info=M($model_table)->where(array('autho_id'=>array('in',$user_list)))->page($page,$pagesize)->select();
			foreach($info as $val){
					$val['username']=$this->username($val['autho_id']);
					$infos[]=$val;
				}
			}
		$this->assign('model_id',$model_id);
		$this->assign('info',$infos);
		$this->assign('page_show',$page_show);
	    $this->display();
		}
	//审核认证信息
	public function auth_userinfo(){
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
				if($type=='bank'){
					$val['area']=$this->area($val['info_limit'][3]);
				}
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
				  $post[]=$info["card_ID_img"]["savename"];
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
	//审核个人信息方法
	public  function get_userinfo_auth(){
		$id=I('id');
		$type=I('type');
		$user_info=M('user')->where('id='.$id.'')->find();
		if(!$user_info) $this->error(L('User_parameter_error'),"",$this->r_time);
		if($type=='bank'){$field="is_bank_auth";$field2='bank_authentication';$g_name='real_name_';}
		if($type=='real'){$field="is_real_name";$field2='real_name_authentication';$g_name='bank_auth_';}
		if($field2!=0){
			 $this->error(L('User_parameter_error'),"",$this->r_time);
			}else{
			 if(M('user')->where('id='.$id.'')->save(array($field=>1))){
				 //此处加等级积分
				 $c=FF("user_group/user_config");
				 $point=array('money','amount','point','promote_point');
				 foreach($point as $k=>$v)
				 {
					 if($c[$g_name.$v]) $data[$v]=return_num($c[$g_name.$v]);
				 }
				 if($data){
				 $user=$this->userinfo;
				 account($user_info['id'],$data,11,6,'系统','信息审核通过');
				 account($user_info['recommend'],$data,11,6,'系统','审核['.$user_info['user'].'('.$user_info['id'].')]信息通过');
				 }
				 $this->success(L('success'),'',$this->r_time);
				 }	
			}
		}
	//所在区域
	public  function area($id)
   {
	$area=M('linkage');
	$where['id']=$id;
	$area_info=$area->where($where)->find();
	if($area_info){
	$html=$this->area($area_info['parent_id']).' ';
	}
	return $html.$area_info['name'];
	}
	//审核数据
	public function get_coin_auth(){
		$user=$this->userinfo;
		$this->assign('user',$user);
		$model_id=I('model_id');
		$model_config=model_config($model_id);
		$id=I('id');
		if(!$id || !$model_id) $this->error(L('User_parameter_error'),"",$this->r_time);
		$info=M(model_f($model_id))->where(array('id'=>$id))->find();
		$recommend_day=$model_config['recommend_day'];
		//审核时间限制
		if($info){
			$autho_id=$info['autho_id'];
			   //审核时间限制
				if($recommend_day){
				$days=round((time()-$info[addtime])/3600/24) ;
				if($days>$recommend_day){
					$this->error('已超出审核时间',"",$this->r_time);
					}
				}
			}else{
			$this->error(L('User_parameter_error'),"",$this->r_time);	
				}  
		if(commoned_auth($model_id,$user['id'],$id)){		
			$this->success(L('success'),'',$this->r_time);
			}else{
			$this->error(L('error'),"",$this->r_time);	
				}
		}	
    //取消绑定状态
	public function bunding_info_channal(){
		$user=$this->userinfo;
		$type=I('type');
		if(!$type)  $this->error(L('User_parameter_error'),"",$this->r_time);
		if($type=='bank'){$field="is_bank_auth";$field2='bank_authentication';$g_name='real_name_';}
		if($type=='real'){$field="is_real_name";$field2='real_name_authentication';$g_name='bank_auth_';}
		if(!$field)  $this->error(L('User_parameter_error'),"",$this->r_time);
		$data[$field]=0;
		$data[$field2]='0';
		if(M('user')->where(array('id'=>$user['id']))->getField($field)){
			$c=FF("user_group/user_config");
				 $point=array('money','amount','point','promote_point');
				 foreach($point as $k=>$v)
				 {
					 if($c[$g_name.$v]) $data1[$v]=-return_num($c[$g_name.$v]);
				 }
			account($user['id'],$data1,11,6,'SYSTEM','取消信息绑定');
		}
		if(M('user')->where(array('id'=>$user['id']))->save($data)){
			$this->success(L('success'),'',$this->r_time);
		}else{
			$this->error(L('User_parameter_error'),"",$this->r_time);
			}
		}
	//现金管理
	public function money(){
		$model_id=I('model_id');
		$menu=array('withdraw','withdraw_list','order_list','accounts_list');
		$this->assign('menu',$menu);
		$this->display();
		}
	//资金流水
	public function accounts_list(){
		$pagesize=10;	
	    $config=FF('Conf/config','',APP_PATH.'Accounts/');	
		$business_type=explode('|',$config['business_type']);
		$operation_type=explode('|',$config['operation_type']);
		$accounts_record=M("accounts_record"); 
		$user=$this->userinfo;
	    $this->assign('user',$user); 
		$page=I('page',1,'intval');
		$where['userid']=$user['id'];
		$record_count=$accounts_record->where($where)->count();//获取总记录数
		$accounts[money] = $accounts_record->where($where)->sum('money');
		$accounts[amount] = $accounts_record->where($where)->sum('amount');
		$accounts[point] = $accounts_record->where($where)->sum('point');
		$this->assign('accounts',$accounts);
		$page=$record_count<$pagesize?1:$page; 
		$infos=$accounts_record->where($where)->order('id desc')->page($page,$pagesize)->select();
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		foreach($infos as $val){			
		$val['operation_type']=$operation_type[$val['operation_type']];
		$val['business_type']=$business_type[$val['business_type']];
		$info[]=$val;	
			}
		$this->assign('info',$info);
		$this->assign('accounts_record',$accounts_record);
		$this->assign('page_show',$page_show);
        $this->display();
		}
	//购买记录		
	public function order_list(){
	  load("Order/function");
	  $user=$this->userinfo;
	  $this->assign('user',$user); 
	  $order=M('order');
		$pagesize=10;
		$page=I('page',1,'intval');
		$shop=M('shop');
	    $where['user_id']=$user['id'];
		$record_count=$order->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info= order_list($where,$shopid=0,$page,$pagesize);
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
        $this->display();	
	 
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
		session('url',U('User/index/withdraw'));
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
				$this->success(L('User_Index_withdraw_Suc_1'),'',0);
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

	//获取会员名
	public function username($userid){
		$user=M('user');
		$where["id"]=$userid;		
		return $user->where($where)->getField('user');
		}	
	//获取会员组名
	public function group_name($groupid){
		$where["id"]=$groupid;		
		return M('group')->where($where)->getField('name');
		}
	//推荐的会员
	public function team_list(){
		$user=$this->userinfo;
		if(!$user)  $this->error(L('User_parameter_error'),"",$this->r_time);
		$userid=$user['id'];
		$pagesize=10;
		$page=I('page',1,'intval');
		$record_count=M('user')->where(array('recommend'=>$userid))->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		$userlist=M('user')->where(array('recommend'=>$userid))->page($page,$pagesize)->select();
		foreach($userlist as $val){
			$val['groupname']=$this->group_name($val['group_id']);
			$userlists[]=$val;
			}
		$this->assign('info',$userlists);
		$this->assign('page_show',$page_show);
		$this->display();
		}
			
	//修改密码、二级密码
	public function alter_password(){
		$user=$this->userinfo;
		if($user['pay_pass']){
			session('url',U('User/index/alter_password'));
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
			   $this->success(L('User_Index_alter').L('User_Index_suc'),'',0);			
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
			//二级密码验证
		public function twice_pass_confirm_html(){
			$user=$this->userinfo;
			if($user['pay_pass']){
			$twice_pass_confirm = session('twice_pass_confirm');
			if(!$twice_pass_confirm){
				$this->redirect('User/index/twice_pass_confirm','',0, '');
				exit();
			}
			}else{		
				$this->error(L('User_please_apply_twicepass'),U('User/index/alter_password'),$this->r_time);
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
        		$url=U('User/index/index');
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
/*各币种之间的兑换*/
		public function user_convert_coin(){
			$coin_type=array('money','amount','point','promote_point');
			$this->assign('coin_type',$coin_type);
			$user=$this->userinfo;
			$convert_coin=convert_coin();
			$this->assign('convert_coin',$convert_coin);
			$this->assign('user',$user);
			if(IS_POST){
				$type=I('type');
				$num=I('num');
				if(!$num){
					$this->error(L('ERR'),"",$this->r_time);
					}else{
					$convert_coin_must=$convert_coin[$type];
					$coin_come=$user[$convert_coin_must['coin_type_come']];
					$convert_num=$convert_coin_must['num'];
					$num1=$num*$convert_num;
					//比较余额是否够支付本次操作
					if($coin_come<$num1){
						$this->error(L('User_balance_no'),"",$this->r_time);
						}else{
						//比较成功后计算费率 $from_num得到兑换币种数目，$come_num被兑换数目
						$from_num=$num;
						if($from_num<1) $this->error(L('User_balance_no'),"",$this->r_time);
						$come_num=$from_num*$convert_num;
						if($from_num && $come_num){
							account($user['id'],array($convert_coin_must['coin_type_from']=>$from_num,$convert_coin_must['coin_type_come']=>-$come_num),13,6,L('System'),'【'.C($convert_coin_must['coin_type_come'].'_name').'】'.L('convert').'【'.C($convert_coin_must['coin_type_from'].'_name').'】');
							}
						$this->success(L('convert_success'),"",$this->r_time);							
							}
					}
				}else{
				$this->display();	
				}
			}
/*ajax获取兑换该币种所需其他币种数目*/
//       public function ajax_coin_num(){
//		   $coin_type=array('money','amount','point','promote_point');
//		   $this->assign('coin_type',$coin_type);
//		   $user=$this->userinfo;
//		   $num=I('num');
//		   $type=I('type');
//		   if(!$num) echo 0;
//		   $convert_coin_must=$convert_coin[$type];
//		   //用户拥有兑换币的数目
//		   $coin_come=$user[$convert_coin_must['coin_type_come']];
//		   if($coin_come<$num)  echo -1;
//		   $convert_num=$convert_coin_must['num'];
//		   //比较成功后计算费率 $from_num得到兑换币种数目，$come_num被兑换数目
//		   $from_num=floor($num/$convert_num);
//		   if($from_num<1) $this->error(L('User_balance_no'),"",$this->r_time);
//		   $come_num=$from_num*$convert_num;
//		   }
}