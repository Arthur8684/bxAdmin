<?php
namespace Fenxiao\Controller;
use Org\Util\Admin;
class IndexController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
/*
-----------------------------------  
   注册会员开通   
-----------------------------------   
*/
    public function check_user(){
	    $pagesize=25;	
		$page=I('page',1,'intval');
		$username=I('user',"",'trim');
	    $user =M('User');
		if($username) $where['user']=$username;
		$where['status']=0;
		$record_count=$user->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$user->where($where)->order('id asc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$this->assign('info',$info);
        $this->display();
    }
/*
-----------------------------------  
   注册会员开通post   
-----------------------------------   
*/
    public function check_user_post(){
		$id=I('id',0,'intval');
		$admin=$this->admininfo;
		if(!$id)
		{
		    $this->error(L('ERR_PARAM_ID'),"",$this->r_time);	
		}
	    $user =M('User');
	    $data['id']=$id;
	    $info=$user->where($data)->find();
		if($info)
		{
		     $price=explode(',',C(fenxiao_ceng_price));
			 
		     $position=register_recommend($info['recommend']);
			 $data['status']=1;
			 $data['position']=$position;
			 $data['ceng']=1;
			 $data['addtime']=time();
			 if($user->save($data)!==false && $position)
			 {
					 account($price[0],$position,'money',1,1,$admin['user'],"<span class=red>[ID:".$id."]</span>用户注册");
					 $parent_array=array_reverse(return_parent_ids($position));//上N层的父ID数组
					 if($parent_array)
					 {  
						$ceng_num=C('fengxiao_ceng_num');
						$parent_ids_list=return_parent_ids_list($parent_array[0],$ceng_num);
						
								$user =M('User');
								array_unshift($parent_ids_list,array($parent_array[0],0));
								$parent_ids_list=array_reverse($parent_ids_list);
								foreach($parent_ids_list as $k=>$v)
								{
									foreach($v as $a=>$d)
								    {
									     if($d)
										 {
												 $i=$user->where("id=".$d)->getField('ceng');
												 $i=$i+1;
												 for($i;$i<=$ceng_num;$i++)
												 {
												     $num=($i==3)?4:$i;
													 $user_count=count_recommend($d,$num);//计算位置人数个数
													// echo $d."/".$user_count."/".$i."<br>";
													 if(($user_count>=2 && $i<=2) || $user_count>=14)
													 {
													        // echo $user_count."/".$d."/".$i;
															 $position_userid=$user->where("id=".$d)->getField('position');
															 $parent_id_n=return_parent_id($position_userid,$i);
															 dump($price);
															 $price_=$price[($i-1)]?$price[($i-1)]:$price[2];
															 if($parent_id_n)
															 {
																  account($price_,$parent_id_n,'money',1,1,$admin['user'],"第<span class=red>[".($i)."]</span>级用户<span class=red>[ID：".$d."]</span>升级");
																  
															 }
															 $account=account(-$price_,$d,'money',1,1,$admin['user'],"升级,上交<span class=red>[ID：".($parent_id_n?$parent_id_n:"系统")."]</span>用户");
															  if($account)
															  {	
																	  $where['ceng']=$i;
																	  $where['id']=$d;
																	  $user->save($where);	
															  }										  
													 }	  
													 
																						  
												 }
										 }

								    }
									
/*									 if($ceng>1 && $user_count==$ceng_user_num && $user_count)
									 {
									 
									       if(C('fengxiao_ceng_num')>$ceng && count_recommend($parent_array[$k-1],$ceng_)<pow(2,$ceng_))//非顶端用户
										   {
										         $where['id']=$parent_array[$k];
												 $position_userid=$user->where($where)->getField('position');
												 $parent_id_n=return_parent_id($position_userid,$ceng_);
												 if($parent_id_n)
												 {
													  account($price[$ceng_],$parent_id_n,'money',1,1,$admin['user'],"第<span class=red>[".$ceng_."]</span>级用户<span class=red>[ID：".$d."]</span>升<span class=red>[".$ceng_."]</span>级");
												 }
													  account(-$price[$ceng_],$parent_array[$k],'money',1,1,$admin['user'],"升级第<span class=red>[".$ceng_."]</span>级，上交<span class=red>[ID：".$parent_id_n."]</span>用户");
										   }
										   foreach($v as $a=>$d)
										   {
												 $where['id']=$d;
												 $position_userid=$user->where($where)->getField('position');
												 //echo $position_userid."<br>";
												 $parent_id_n=return_parent_id($position_userid,$ceng);
												 if($parent_id_n)
												 {
													  account($price[$ceng-1],$parent_id_n,'money',1,1,$admin['user'],"第<span class=red>[".$ceng."]</span>级用户<span class=red>[ID：".$d."]</span>升<span class=red>[".$ceng."]</span>级");
												 }
												 
													  account(-$price[$ceng-1],$d,'money',1,1,$admin['user'],"升级第<span class=red>[".$ceng."]</span>级，上交<span class=red>[ID：".$parent_id_n."]</span>用户");
										   }
									 }*/
				
								}				
				
                      }
			   }//$data->save
			 
		}
		$this->success(L('OPEN_PASS').L('success'),"",$this->r_time);
    }
	
	
}