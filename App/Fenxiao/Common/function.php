<?php
/*
-----------------------------------  
   分销返利，按设置的比例分销
   $price 传入的价格 可以为数组或者数组格式为 array('money'=>10) 也可以为数字
   *userid 用户ID
   *c_n 最大多少层
-----------------------------------   
*/
   function rebate_recommend($userid,$price,$msg,$n=0)
   {
         $config=FF('Conf/config','',APP_PATH."Fenxiao/");
		 if($config['open'] && $config['scale'])
		 {
		     $c=explode(',',$config['scale']);  
			 if($userid && $n<=count($c))
			 {
				 $user=M('user');
				 $data['id']=$userid;
				 $info=$user->where($data)->find();	
				 if($info )
				 {
					  if(!is_array($price))
					  {
						  if($price)
						  {
								$coin_count=$price*$c[$n]/100;
								$coin=array('money'=>$price);							  
						  }
					  }
					  else
					  {
						  foreach ($price as $k => $v)
						  {
						        $coin[$k]=$v*$c[$n]/100;
						  }
					  }
					  if($coin) account($info['id'],$coin,4,5,L('SYSTEM'),$msg."[比例：".$c[$n]."/%]",1);
				      rebate_recommend($info['recommend'],$price,$msg,$n+1);
				 }		 
			 }   
		 }
   }
   

   
function polling($time,$admin_id,$pay_type='money')     
{  
		$state = array();
		foreach($time as $key=>$value)
		{
			 $now_time=time();
			 $year_time_get=strtotime(date('Y-m',time()).'-'.substr($value,6,2));
			 if(substr($value,6,2)>substr($value,9,2)){$year_time_end=strtotime("+1months",strtotime(date('Y-m',time()).'-'.substr($value,9,2)));}else{
			 $year_time_end=strtotime(date('Y-m',time()).'-'.substr($value,9,2));
			 }
			 $end_day=M('expense_record')->where("'$year_time_get' <= expense_time and expense_time < '$year_time_end'")->select();
			 if(!empty($end_day)){$state['k']=0;}
			 //该区间已分成
			 if(date('m-d',$year_time_get) <= date('m-d',$now_time) && date('m-d',$now_time) <= date('m-d',$year_time_end))
			 {
				 if(substr($value,3,2)<substr($value,6,2)){
					 $get_time=strtotime(date('Y-m',time()).'-'.substr($value,0,2));
					 $get_t = strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
					 if(substr($value,0,2)>substr($value,3,2))
					 {
						 $end_time=strtotime("+1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
						 $end_t = strtotime(date('Y-m',time()).'-'.substr($value,3,2));
					 }else{
						 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
						 $end_t  = strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
					 }
				 }else{
					 if(substr($value,0,2)>substr($value,3,2))
					 {
						 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
						 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
						 $get_t = strtotime("-2months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
						 $end_t=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
					 }else{
						 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
						 $end_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
						 $get_t = strtotime("-2months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
						 $end_t= strtotime("-2months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
					 }
					 
				 }
					
				 $sql= M('order')->where("'$get_t' <= finish_time and finish_time < '$end_time' and order_status = 2 and pay_type ='$pay_type' and is_expense = 0")->field('user_id,sum(order_amount) as order_amount')->group('user_id')->select();

				 if(empty($sql)){$state['k']=1;}else{$state['k']=5; $baoxiao=reimbursement_recommend($sql,$admin_id);}
				 //没有可分销金额
				  if(is_array($baoxiao))
				  {
					  foreach($baoxiao as $yonghu)
					  {
						  $state['user_id']=$yonghu['user_id'];
						  if(empty($yonghu['money'])){$state['k'] = 4;}else
						  {
						  $state['expense_money']+=$yonghu['money'];
						  $state['k']=2;
						  }
						  $da['is_expense']=1;
						  $update=M('order')->where("user_id='$yonghu[user_id]' and '$get_t' <= finish_time and finish_time < '$end_time'")->save($da); 
						  $state['k'] = 3;
					  }
					      $data['start_time']=$get_time;
						  $data['end_time'] = $end_time;
						  $data['expense_money']=$state['expense_money'];
						  $data['expense_time']=time(); 
						  $you = M('expense_record')->where('start_time='.$get_time)->select();
				  }
				  
			 }else{
				 continue;
			}
		}
		
		if(!empty($you)){$record=M('expense_record')->data($data)->add();}
		  return $state;
		
}
/*
-----------------------------------
   报销，按设置的报销比例
   *order array  用户ID和消费额
-----------------------------------
*/
function reimbursement_recommend($order,$admin_id)
{
	if(is_array($order))
	{
		$config=FF('Conf/set_config','',APP_PATH."Fenxiao/");
		foreach($order as $k=>$v)
		{
			$amout=$v['order_amount']*$config['reimbursement_conditions']*0.01;
			$data['id']=$v['user_id'];
			$money=M('user')->where($data)->getField($config['point_type']);
			if($amout<$money)
			{
				$date[$config['point_type']] = $money-$amout;
				$update=M('user')->where($data)->save($date);
				if($update){
					$arr['user_id']=$v['user_id'];
					$arr['pay_type']=$config['point_type'];
					$arr['money']=$v['order_amount']*$config['reimbursement_percentage']*0.01;
					//该打钱了
					if($admin_id){
					$admin=M('admin')->where(array('id'=>$admin_id))->getField('user');	
						}
					account($v['user_id'],array('money'=>$arr['money'],$config['point_type']=>-$amout),10,6,$admin,date('Y-m-d',time()).'报销,订单号【'.$v['order_sn'].'】ID['.$v['id'].']');
					$arr1[]=$arr;
				}
			}else{
				$arr['user_id']=$v['user_id'];
				$arr['pay_type']=$config['point_type'];
				$arr['money']=0;
				$arr1[]=$arr;
			}
		}
		return $arr1;
	}
}
?>
