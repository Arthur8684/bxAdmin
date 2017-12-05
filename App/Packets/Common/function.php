<?PHP
/*
-----------------------------------  
   获取红包数组
   userid 用户ID
-----------------------------------   
*/	
 function get_packets($userid){
	 
	      $user=M('user')->where("id=$userid")->find();
	      $where=array('status'=>1,'parent_id'=>0);
          $packets=M('packets')->where($where)->select();
		  $time=strtotime(date('Y-m-d'));
		  $open=0;
		  $data=array();

		  foreach($packets as $k=>$v)
		  {
			  if($v['groups'] && !in_array($user['group_id'],explode(',',$v['groups']) ) && $open ) continue;
			  if($v['users'] && !in_array($user['id'],explode(',',$v['users']) ) && $open )  continue;
			  if( ($v['start_time'] || $v['end_time']) && $open ) 
			  {
					$start_time=strtotime(date('Y')."-".$v['start_time']);
					$end_time=strtotime(date('Y')."-".$v['end_time']);	
					if(($time< $start_time || $time>$end_time) && $open ) continue;	  
			  }
			  if($v['condition'] && !get_condition($userid,$v['condition'],$user['group_id']) && $open ) continue;
			   $id=$v['id'];
			   $config = S("packets_".$id."_".$userid);
			   switch ($v['form_type'])
			   {
				  case 'base':
					 $intervals=$v['intervals']?$v['intervals']:1;
					 $intervals_second=get_second($v['intervals_type'],$intervals);
					 if($config)
					 {
						  $c_times=$config['times'];//已经领取次数
						  $packets_times=$v['times']; //红包领取上限次数
						  if($c_times && $packets_times && $c_times>=$packets_times && $open ) continue;
						  
						  $c_time=$config['time'];//领取时间
						  if($c_time && $c_time > time() && $open ) continue;
						  $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);	 
					 }
					 else
					 {
						  $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);	 			 
					 }
					 break;  
				  case 'holiday':
					 $holiday=$v['holiday']?$v['holiday']:$user['birthday'];
					 if($v['holiday'] &&  strtotime(date('Y')."-".date('m-d',strtotime($holiday)) ) >  $time && $open ) continue;  //未到节日
					 if(!$v['start_time'] && !$v['end_time'] && strtotime(date('Y')."-".date('m-d',strtotime($holiday)) ) != $time && $open ) continue; //不是当天领取红包			
					 if($config)
					 {
						  $c_time=$config['time'];//领取时间
						  if(date('Y')==date('Y',$c_time) && $open ) continue; //当年已经领取过红包
						  $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);	
					 }
					 else
					 {	
						  $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);	
					 }
					 break;
				  case 'substep':  
					 if($config)
					 {
						   $next_id=$config['id']?$config['id']:0;
						   $next_time=$config['time']?$config['time']:0;//下一次领取红包的时间
						   $create_time=$config['create_time']?$config['create_time']:0;//创建红包的时间
						   
						   $time_array=array('year'=>'Y','month'=>'m','day'=>'d','hour'=>'H','minute'=>'i','week'=>'W');
						   
						   if(date($time_array[$v['period_type']]) !=  date($time_array[$v['period_type']],$create_time) )
						   {
							   $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);
							   S("packets_".$id."_".$userid,null);
							   continue;//未到领取时间
						   }
						   
						   if($next_time > time() && $open ) continue;//未到领取时间
						   if($next_id)
						   {
								  $next_packets=M('packets')->where(array('id'=>$next_id,'status'=>1))->find();
								  if(!$next_packets && $open ) continue;
								  $data[$next_packets['form_type']][]=array('id'=>$next_packets['id'],'name'=>$next_packets['name'],'form_type'=>$next_packets['form_type']);
						   }
					 } 
					 else
					 {
                            $data[$v['form_type']][]=array('id'=>$v['id'],'name'=>$v['name'],'form_type'=>$v['form_type']);
					 }                
					 break;
				  default:

			   }				  
		  }
		 return $data;  
    }	
	
/*
-----------------------------------  
   当用户点击领取红包时候的处理
   $userid 用户ID
   id 红包ID
-----------------------------------   
*/
 function  set_packets($id,$userid){
	       $user=M('user')->where("id=$userid")->find();	      
		   $where=array('id'=>$id,'status'=>1);
           $packets=M('packets')->where($where)->find();
	       $time=strtotime(date('Y-m-d'));
		   
           if(!$packets) return 1;
		   if($packets['groups'] && !in_array($user['group_id'],explode(',',$packets['groups']) ) )  return 2;
		   if($packets['users'] && !in_array($user['id'],explode(',',$packets['users']) ) ) return 5;
		   if($packets['start_time'] || $packets['end_time']) 
		   {
				  $start_time=strtotime(date('Y')."-".$packets['start_time']);
				  $end_time=strtotime(date('Y')."-".$packets['end_time']);	
				  if($time< $start_time || $time>$end_time) return 3;
		   }
		   if($packets['condition'] && !get_condition($userid,$packets['condition'],$user['group_id'])) return 4;
		   
		   switch ($packets['form_type'])
		   {
			  case 'base':
			     $config = S("packets_".$id."_".$userid);
		         $packets_grant =$config?false:true;//判断红包是否具备领取的条件
				 $intervals=$packets['intervals']?$packets['intervals']:1;
				 $intervals_time=strtotime("+$intervals ".$packets['intervals_type'],time()); //下次领取时间
				 $intervals_second=($packets['end_time'] && $packets['start_time'])?(strtotime(date('Y')."-".$packets['end_time'])-strtotime(date('Y')."-".$packets['start_time'])):"";
                 if($config)
				 {
					  $c_times=$config['times']?$config['times']:0;//领取次数
					  $packets_times=$packets['times']; //红包领取上限次数
					  if($c_times && $packets_times && $c_times>=$packets_times) return 6;
					  
					  $c_time=$config['time'];//本次领取时间
					  if($c_time && $c_time > time()) return 7;
					  
					  $value=array('times'=>$c_times+1,'time'=>$intervals_time);
					  S("packets_".$id."_".$userid,$value,$intervals_second);
                      $packets_grant =true;
				 }
				 else
				 {
					  $value=array('times'=>1,'time'=>$intervals_time);
					  S("packets_".$id."_".$userid,$value,$intervals_time);					 
				 }
			     break;  
			  case 'holiday':
			     $config = S("packets_".$id."_".$userid);
				 $holiday=$packets['holiday']?$packets['holiday']:$user['birthday'];
				 if(!$packets['holiday'] && !$holiday)   return 8;
				 if($packets['holiday'] &&  strtotime(date('Y')."-".date('m-d',strtotime($holiday))) >  $time)  return 10;  //未到节日
				 if(!$packets['start_time'] && !$packets['end_time'] && strtotime(date('Y')."-".date('m-d',strtotime($holiday)) ) != $time )   return 9; //不是当天领取红包
				 $packets_grant =$config?false:true;//判断红包是否具备领取的条
                 if($config)
				 {
						  $c_time=$config['time'];//领取时间
						  if(date('Y')==date('Y',$c_time))  return 11;
						  
						  $value=array('time'=>time());
					      S("packets_".$id."_".$userid,$value,get_second('year'));	
                          $packets_grant =true;
				 } 
				 else
				 {
					  $value=array('time'=>time());
					  S("packets_".$id."_".$userid,$value,get_second('year'));					 
				 }
			     break;
			  case 'substep':
			     $parentid=get_parent_id($id);
			     $config = S("packets_".$parentid."_".$userid);
		         $packets_grant =$config?false:true;//判断红包是否具备领取的
				 $intervals=$packets['intervals']?$packets['intervals']:1;
				 
				 $next_step=M('packets')->where(array('parent_id'=>$id,'status'=>1))->find();
				 $value['id']=$next_step['id']?$next_step['id']:0;//下一步要 领取红包的ID	
				 if($value['id']) $value['time']=strtotime("+$intervals ".$packets['intervals_type'],time());//下次领取红包的时间	      
				 
                 if($config)
				 {
					  if(!$config['id'] || $config['id']!=$id) return 12;
					  $c_time=$config['time'];//本次领取时间
					  $c_create_time=$config['create_time'];//创建时间
					  if($c_time > time()) return 13;
					  
					  $value['create_time']=$c_create_time;
					  S("packets_".$parentid."_".$userid,$value);
                      $packets_grant =true;
				 } 
				 else
				 {
					  if($packets['parent_id']) return 14;
					  $value['create_time']=time();
					  $period_second=get_second($packets['period_type']);
					  S("packets_".$parentid."_".$userid,$value,$period_second);	
			     }                
			     break;
		   }	
		   
		   if($packets_grant)
		   {
				  if($packets['money']) $data['money']=$packets['money'];
				  if($packets['amount']) $data['amount']=$packets['amount'];
				  if($packets['point']) $data['point']=$packets['point'];
				  if($packets['promote_point']) $data['promote_point']=$packets['promote_point'];
				  account($userid,$data,$operation_type=12,$business_type=6,$operation_user=L('SYSTEM'));
				  unset($data);
				  if($packets['group_id']) $data['group_id']=$packets['group_id'];
				  if($packets['qrcode_open']) $data['qrcode_open']=$packets['qrcode_open'];	
				  if($data) M('user')->where('id='.$userid)->save($data);
				  return "0";				   
		   }
		   else
		   {
			      return 11;		
		   }   
    }   	
/*
-----------------------------------  
   获取顶级红包的ID 在分步红包中用到
   id 当前红包ID
-----------------------------------   
*/	
   function get_parent_id($id)
   {
	   	   $where=array('id'=>$id);
           $packets=M('packets')->where($where)->find();
		   if(!$packets) return 0;
		   if($packets['parent_id'])
		   {
			   return get_parent_id($packets['parent_id']);
		   }
		   else
		   {
			   return $id;
		   }
   }
   	
?>