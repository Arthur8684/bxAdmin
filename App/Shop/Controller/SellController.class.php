<?php
namespace Shop\Controller;
use Org\Util\Seller;
class SellController extends Seller {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
	用户登录  
-----------------------------------   
*/
  public function index(){
	  $this->display(); 
	  }  
	  
  public function left(){

	  $user=user_info1();
	  $menu_list=nav_list();
	  $this->assign('menu_list',$menu_list);
	  $this->assign('user',$user);
	  $this->display(); 
	  }  
  public function shop_web_info(){
	  $user=user_info1();
	  $this->assign('user',$user);
	  $shop=M("shop");
	  $shop_info=$shop->where("user_id=".$user["id"]."")->find();
	  //显示订单信息
	  $order=M('order');
	  $where["pay_status"]=0;
	  $where["shop_id"]=$shop_info['id'];
	  $no_pay_order=$order->where($where)->count();
	  $this->assign('no_pay_order',$no_pay_order);
	  $day=strtotime(date('y-m-d 00:00:00',time()));
	  $n_day=$day+3600*24;
	  $today_order=$order->where("addtime>".$day." and addtime<".$n_day." and shop_id=".$shop_info['id']."")->count();
	  $this->assign('today_order',$today_order);
	  $finish_order=$order->where("ship_status=2")->count();
	  $this->assign('finish_order',$finish_order);
	  //显示商品信息
	  $group_buy=model_table('group_buy');
	  foreach($group_buy as $val){
		$table=M(''.$val["table"].'');
		$val["num"]=$table->where("autho_id=".$user["id"]."")->count(); 
		$ordernum[]=$val;  
		  }	
		$this->assign('ordernum',$ordernum);  
		
		
	  $this->display(); 
	  } 
  public function alter_shop_info(){
	  $user=user_info1();
	  $this->assign('user',$user);
	  $shop=M("shop");
	  $shop_info=$shop->where("user_id=".$user["id"]."")->find();
	  $id=$shop_info["id"];
	  $where['id']=$id;
	  if(IS_POST){
		$data=I('post');
		$data['category_id']=I('category_id'); 
		$data['area_id']=I('area_id'); 
		if(alter_shop($data)){		   
		  $this->success('','',0);
		  }else{
		  $this->error('',"",3);
		};
		  }else{
	  $linkage=M('shop_category'); 
	  $shop_info=$shop->where($where)->find();
	  $type_list=link_area_list(0);	
	 
	  $parray=parents($shop_info['category_id'],$table="shop_category",$field=array('name','id'),$key=array('text','value'));
	  $type_id=linkage($type_list,"category_id","",0,$parray,array('text'=>L('area_first'),'value'=>"0"),'form-control');
	  
	  $area_info=link_list_info(0,'linkage');
	  $areaarray=parents($shop_info['area_id'],$table="linkage",$field=array('name','id'),$key=array('text','value'));
	  $area_info_id=linkage($area_info,"area_id","",0,$areaarray,array('text'=>L('area_first'),'value'=>"0"),'form-control');
	  	  
	  $this->assign('type_id',$type_id);
	  $this->assign('area_info_id',$area_info_id);
	  $this->assign('shop_info',$shop_info);
	  $this->display();	
		} 
  }
 public function select_color(){	 	
	  $user=user_info1();
	  $this->assign('user',$user); 
	  $shop=M("shop");
	  $shop_info=$shop->where("user_id=".$user["id"]."")->find();
	  $config=FF('Conf/config','',MODULE_PATH);
	  $shop_color=$config['shop_color'];
	  $id=$shop_info["id"];
	  if(IS_POST){
		$style=I("style");
		$data["style"]=$style;
		if($shop->where("id=".$id."")->save($data)){
		$this->success('','',0);	
			}else{
		$this->error('',"",3);					
			} 
		}else{
	  $this->assign('shop_info',$shop_info);
	  $this->assign('shop_color',$shop_color);
	  $this->display();	
	  }	  
	  } 
	  
  public function verification_key(){
	  load("Order/function");
	  $user=user_info1();
	  $meg2=1;
	  $this->assign('user',$user); 
	 
	  if(IS_POST){
		$key=I('post.key','','trim'); 
	    $shop=M("shop");
	    $shop_info=$shop->where("user_id=".$user["id"]."")->find();
		$s=verification_key($key,0,$shop_info['id']);
		if(is_array($s)){
			 $url=U('Shop/sell/verification_key_show','goods_id='.$s['goods_id'].'&model_id='.$s['model_id'].'');
			 header('Location:'.$url.'');
			}else{	
			 $this->error(L($s));	
				}
		 }else{
	   $this->display();	 
			 }
	 }
	 
  public function verification_key_show(){
	  load("Order/function");	 
	  $goods_id=I('get.goods_id'); 
	  $model_id=I('get.model_id'); 
	  if($goods_id && $model_id){
		 $meg=goods_info($goods_id,$model_id);
		 $this->assign('meg',$meg); 
		  }
		$this->display();
	 }
	 	 
  public function verification_list(){
	   $order_info=M('order_info');
	   $order_conversion_key=M('order_conversion_key');
	   $user=user_info1();
	   $this->assign('user',$user);
	   $shop=M('shop');
	   $shop_info=$shop->where('user_id='.$user["id"].'')->find();
	   $where['shop_id']=$shop_info["id"];
	   $info_list=$order_info->field('id')->where($where)->select();
	   foreach($info_list as $val){
		   $s[]=$val['id'];
		   }
	   $map["info_id"]=array('in',$s);
	   $map["usering"]=1;
	   $pagesize=10;
	   $page=I('page',1,'intval');
	   $info=$order_conversion_key->where($map)->order('id desc')->page($page,$pagesize)->select();
	   $record_count=$order_conversion_key->where($map)->count();//获取总记录数
	   $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
	   $this->assign('page_show',$page_show);
	   $this->assign('info',$info); 
	   $this->display();	 
		
	 } 	 
	  
	 
  public function order_list(){
	  load("Order/function");
	  $user=user_info1();
	  $this->assign('user',$user); 
	  $order=M('order');
  		$user_id=I('user_id','','intval');
		$order_status=I('order_status',-1,'intval');
		$pay_status=I('pay_status',-1,'intval');
		$ship_status=I('ship_status',-1,'intval');
		$order_sn=I('order_sn','','trim');
		if($order_status>-1){
		$where['order_status']=$order_status;			
			}
		if($pay_status>-1){
		$where['pay_status']=$pay_status;			
			}
		if($ship_status>-1){
		$where['ship_status']=$ship_status;			
			}						
		if($user_id){
		$where['user_id']=$user_id;
			}
		if($order_sn){
		$where['order_sn']=$order_sn;
			}
		$pagesize=10;
		$page=I('page',1,'intval');
		 $shop=M('shop');
	   $shop_info=$shop->where('user_id='.$user["id"].'')->find();
	   $where['shop_id']=$shop_info["id"];
		$record_count=$order->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		$info= order_list($where,$shopid=0,$page,$pagesize);
		$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据	
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
        $this->display();	
	 
	 }  
	 
/*
-----------------------------------  
  订单详情
-----------------------------------   
*/	  	  
  public function order_view(){
	   load("Order/function");
	    $user=user_info1();
	  $this->assign('user',$user); 
	   $id=I('id','','intval');
	   $order=M('order');
	   $where['id']=$id;
	   $info=$order->where($where)->find();
	   $info['order_status_html']=order_status_html($id);
	   $info['order_info']=order_info($info['order_sn']);
	   $info['order_consignee']=consignee_info($info['consignee_id']);
	   $this->assign('info',$info);	
	   $this->assign('id',$id);	
	   $this->display();
	  }

  public function order_del(){
	   load("Order/function");
		$id=I('id','','intval');
		if(del_order($id)){			
			    $this->success('',U('shop/sell/order_list'),0);
				}else{
				$this->error('',"",3);				
				}
	  }	  	  
 
  public function add_withdraw(){
	    load("User/function");
	 	$config=FF('Conf/config','',COMMON_PATH);
		if($config['money_status']!=1){			
		    $this->error(L('User_Index_withdraw_noshow'),"",3);		
			}else{								
		//查看此会员可提现金额
		$user=user_info1();
	    $this->assign('user',$user); 
		//dump($this->userinfo);	
		$userid=$user['id'];
		$usermoney=$user['money'];
		$generation=3;
		$fenxiao=FF('Conf/config','',APP_PATH.'Fenxiao/');	//读取分销配置
		if($fenxiao){
		$generation=$fenxiao['fengxiao_ceng_num'];
		}
		$d_count=90;
		if($user['ceng']<$generation){			
			if($usermoney<$d_count){
				$usermoney=0;
				}else{
				$usermoney=$usermoney-$d_count;	
				}			
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
		 if($cash_num>$usermoney){
		    $this->error(L('User_Index_withdraw_Err_1'),"",3);
			}
			$withdraw=M("withdraw"); 
			$data["userid"] = $userid;
			$data["amount"] = $cash_num;
			$data["way"] = $way;
			$data["account_ID"] = $account_ID; 
			$data["addtime"] = time(); 
			if($withdraw->add($data)){	//插入数据	
				$usera=M('user');
				$usera->where('id='.$userid.'')->setDec('money',$cash_num);//减去会员当前资金
				$this->success(L('User_Index_withdraw_Suc_1'),U('shop/sell/withdraw_list'),0);
				}else{
				$this->error(L('User_Index_withdraw_Err_3'),"",3);		
					}
			}else{
		$page_title=L('User_Index_withdraw');		
		$withdraw_way=withdraw_way();
		$this->assign('usermoney',$usermoney);
		$this->assign('withdraw_way',$withdraw_way);
		$this->assign('page_title',$page_title);
		$this->display();	
		}
		}
	 }  
	 
	 	//提现列表	
	public function withdraw_list(){
		//$this->twice_pass_confirm_html();//二级密码验证
		$withdraw=M("withdraw");
		$status=I("get.status",0,'intval');
		$user=user_info1();
	    $this->assign('user',$user); 
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
		$status_list=withdraw_status($userid);
		$this->assign('status_list',$status_list);
		$this->assign('status',$status);
		$this->assign('info',$info);
		$this->assign('page_show',$page_show);
		$page_title=L('User_Index_withdraw_list');
		$this->assign('page_title',$page_title);
		$this->display();		
		}
	//资金明细
	public function Accounts_list(){
		$pagesize=10;	
	    $config=FF('Conf/config','',MODULE_PATH);
		$business_type=$config['Accounts_operation_type'];
		$operation_type=$config['Accounts_business_type'];
		$accounts_record=M("accounts_record"); 
		$user=user_info1();
	    $this->assign('user',$user); 
		$page=I('page',1,'intval');
		$where['userid']=$user['id'];
		$record_count=$accounts_record->where($where)->count();//获取总记录数
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

/*
-----------------------------------  
   团购添加	   
-----------------------------------   
*/	
    public function add_group(){  
			$classid=I('classid',0,'intval');
			$modelid=I('modelid',0,'intval');
			$model=model_f($modelid,"");
			$table=$model['table'];
			$group_buy =M($table);
			$user=user_info1();
	        $this->assign('user',$user); 
	          if(IS_POST)
			  {		
			     $classid=linkage_id($classid);
			     fields($table);
				 if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			  //------------------------------------保存团购----------------------------------------	
						if ($group_buy->create()){
					           $group_buy->content=$_POST['content'];
							   $group_buy->class_id=$classid;
							   if($group_buy->add())
							   {
							        $this->success(L('ADD').L('success'),U('Group_buy/Groupbuy/group_buy_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($group_buy->getError(),"",$this->r_time);
						}			  
			      //------------------------保存完--------------------------------------
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
	
/*
-----------------------------------  
   团购内容列表
-----------------------------------   
*/
    public function group_list(){
	    $classid=I('classid',0,'intval');
		$modelid=I('modelid',0,'intval');
		$model=model_f($modelid,"");
		$table=$model['table'];
		$user=user_info1();
	    $this->assign('user',$user); 
		//dump($this->userinfo);	
		$userid=$user['id'];
	    $pagesize=10;	
		$page=I('page',1,'intval');
	    $group_buy =M($table);
		if($classid) $where['class_id']=$classid;
		$record_count=$group_buy->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $where["autho_id"]=$userid;
		  $info=$group_buy->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
		$this->assign('model',$model);
		$this->assign('classid',$classid);
		$this->assign('modelid',$modelid);
        $this->display();
    }
	
/*
-----------------------------------   
   团购编辑	   
-----------------------------------   
*/	
    public function group_buy_edit(){  
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			   $user=user_info1();
	          $this->assign('user',$user); 
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $group_buy =M($table);		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
			  if(!$id){	 $this->error(L('ERR_PARAM_ID'),"",$this->r_time);	}
			 //------------------------------------验证数据正确性完----------------------------------------	
	          if(IS_POST)
			  {
			  
			           $classid=linkage_id($classid);
				       if(!$classid) $this->error(L('SELECT').L('CLASS'),"",$this->r_time);
			           fields($table,array(),$id);
			  //------------------------------------编辑提交的管理员----------------------------------------   
						if ($group_buy->create()){
						       $group_buy->content=$_POST['content'];
							   $group_buy->class_id=$classid;
							   if($group_buy->save()!==false)
							   {
							        
							        $this->success(L('EDIT').L('success'),U('Group_buy/Groupbuy/group_buy_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);
							   }
							   else
							   {

							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
						}
						else
						{
						       $this->error($group_buy->getError(),"",$this->r_time);
						}			  
			      //------------------------编辑提交的管理员完--------------------------------------
			  }
			  else
			  {		  
					 $where['id']=$id;
				     $info=$group_buy->where($where)->find();
					 
					 if(!$info)
					 {					      
					     $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
					 }
					 $value=$info['class_id']?parents($info['class_id'],"sys_model_class",array('name','id'),array('text','value')):"";
					 $this->assign('linkage',linkage(get_model_class($modelid),"classid",'',0,$value,array('text'=>L('SELECT'),'value'=>0),"line_4_padding_1"));//
			         $this->assign('id',$id); 
					 $this->assign('model',$model);
					 $this->assign('classid',$info['class_id']);
					 $this->assign('modelid',$modelid); 
			         $this->display();			  
			  }       
    }		
	
/*
-----------------------------------  
   团购删除  
-----------------------------------   
*/	
    public function  group_buy_del(){  	
	          $id=I('id',0,'intval');
			  $classid=I('classid',0,'intval');
			  $modelid=I('modelid',0,'intval');
			  $model=model_f($modelid,"");
			  $table=$model['table'];
			  $group_buy =M($table);	
			  $del_num=0;//删除会员的条数		  
       	     //------------------------------------验证数据正确性----------------------------------------			  
				 if(!$id)
				 {					 
					   $this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 
				 }	
				 if(!is_array($id))	$id=array($id)	;
				 $del_num=$group_buy->delete(implode(",",$id)); 
				 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Shop/sell/group_list',array('modelid'=>$modelid,'classid'=>$classid)),$this->r_time);	      
    }
	
}