<?php
class Pushpot
{
	 function onSet($connect,$data,$user_list,$socket)
	 {
		 $position=array(1,2,3,4);
	     $room_id=$connect['room_id'];
         $uid=$connect['uid'];
		 $room=S('GAME_'.$room_id);
         
		 if(!$room)
		 {
			 $msg_data['action']='not_room';
			 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
			 return false;		 
		 }
		 		 
		 $room_users=$room['user'];
		 $room_users=$room_users?$room_users:array();
         
         if($room_users[$uid])
		 {
			  //断线后重新连接
			  $current_position=$room_users[$uid]['position']?$room_users[$uid]['position']:1;
			  $msg_data['action']='reconnection';
			  $msg_data['reconnection_id']=$uid;
			  $msg_data['status']=$room['status'];
		      $msg_data['zhuang']=$room['zhuang'];
		 }
		 else
		 {
			  $msg_data['action']='set';
			  $user_ids=array_reduce($room_users,function($result,$v){
				   if($v['id']) $result[$v['id']]=$v['id'];
				   return $result;
			  });
			  $user_position=array_reduce($room_users , function($result , $v){
				   if($v['position']) $result[$v['id']]=$v['position'];
				   return $result;
			  });
		     $user_position_not=$user_position?array_diff($position,$user_position):$position;//没有被占用的房间
		 
			 if(!$user_position_not) 
			 {
				$socket->send(array('action'=>'close','message'=>'not_position'),'user_prompt');
				return false;
			 }			 
			 
			 if( (!in_array($uid,$user_ids) && $user_position_not) || (in_array($uid,$user_ids) && (!$room_users[$uid]['nickname'] || !$room_users[$uid]['id']) ) )
			 {
				 $room_user=array();
				 $user=M('user')->field('id,user,nickname,headpath')->where(array('id'=>$uid))->find();
				 $room_user['id']=$user['id'];
				 $room_user['nickname']=$user['nickname'];
				 $room_user['headpath']=$user['headpath'];
				 $room_user['point']=1000;
				 $room_user['pour']=0;
				 $room_user['position']=current($user_position_not);
				 $room_users[$user['id']]=$room_user;
				 
				 $data=array('userid'=>$user['id'],'nickname'=>$user['nickname'],'roomid'=>$room_id,'headpath'=>$user['headpath'],'point'=>1000,'position'=>$room_user['position']);
				 M('games_room_user')->add($data);
				 $current_position=$room_user['position'];
				 $room['user']=$room_users;
				 S('GAME_'.$room_id,$room,86400);	 
			 }			 
		 }
         $msg_data['user_list']=$room_users;
		 $msg_data['position']=$current_position;
		 $msg_data['game_num']=$room['game_num']?$room['game_num']:1;
		 
		 $socket->send($msg_data,'user_room_all');
	 }
	 
	 function onMessage($connect,$data,$socket)
	 {
		  $uid=$connect['uid'];
		  $room_id=$connect['room_id'];
		  $special_users=array(181,187,169,186);
		  $room=S('GAME_'.$room_id);

		  if(!$room && $data['action']!="open_card_all")
		  {
			 if($data['m']) return false;
			 $msg_data['action']='not_room';
			 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
			 return false;		 
		  }
		  //echo $data['action']."/";
	      switch ($data['action'])
		  {
				case 'msg'://信息
				     $msg_data=array('action'=>'msg','msg'=>$data['msg'],'id'=>$connect['uid']);
				     $socket->send($msg_data,'user_room_all');
				     break; 
				case 'prompt'://解散房间
				     $room_users=$room['user'];
					 $zhuang=$room['zhuang'];
				     if($data['m']==2)
					 {
						 if(count($room_users)==1)
						 {
							 S('GAME_'.$room_id,null);
							 M('games_room')->delete($room_id); 
							 M('games_room_user')->where('roomid='.$room_id)->delete();
							 $msg_data['action']='not_room';
							 $msg_data['user_list']=$room_users;
							 $msg_data['zhuang']=$zhuang;
							 $socket->send($msg_data,'user_room_all');							 
						 }
						 else
						 {
							 foreach($room_users as $k=>$v)
							 {
								 $user_data[$k]['nickname']=$v['nickname'];
								 $user_data[$k]['id']=$v['id'];
							 }
							 $msg_data=array('action'=>'prompt','m'=>2,'user_list'=>$user_data,'id'=>$uid);
						 }
						 
						 $socket->send($msg_data,'user_room_all');
					 }
					 else if($data['m']==0 || $data['m']==1)
					 {
						 if( $data['m']==1)
						 {
							 $room['prompt'][$uid]=1;
							 if(count($room['prompt'])>=3)
							 {
								   S('GAME_'.$room_id,null);
								   M('games_room')->delete($room_id); 
								   M('games_room_user')->where('roomid='.$room_id)->delete();
								   $msg_data['action']='not_room';
								   $msg_data['user_list']=$room_users;
								   $msg_data['zhuang']=$zhuang;
								   $socket->send($msg_data,'user_room_all');	
								   return false;						  
							 }
							 else
							 {
								   S('GAME_'.$room_id,$room);
							 }
						 } 
						 else
						 {
							    unset($room['prompt']);
								S('GAME_'.$room_id,$room);
						 }
						 $msg_data=array('action'=>'prompt','m'=>$data['m'],'nickname'=>$room['user'][$uid]['nickname'],'id'=>$uid);
						 $socket->send($msg_data,'user_room_all');
					 }
					 else
					 {
						 S('GAME_'.$room_id,null);
						 M('games_room')->delete($room_id); 
						 M('games_room_user')->where('roomid='.$room_id)->delete();
						 $msg_data['action']='not_room';
						 $msg_data['user_list']=$room_users;
						 $msg_data['zhuang']=$zhuang;
			             $socket->send($msg_data,'user_room_all');
					 }
				     break; 
				case 'combat_gains'://总战绩
					 $room_users=$room['user'];
				     $msg_data=array('action'=>'combat_gains','user_list'=>$room_users,'zhuang'=>$room['zhuang']);
				     $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
				     break; 
				case 'look':
					 $room_users=$room['user'];
					 $status=$room['status'];
					 
					 //echo "看牌ID：".$uid.in_array($uid,$special_users).($status!=3);
					 if(!in_array($uid,$special_users) || $status!=3) return false;

				     $msg_data=array('action'=>'look','user_list'=>$room_users);
				     $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
				     break; 
				case 'chanage_cards':
					 $room_users=$room['user'];
					 $status=$room['status'];
					// echo "换牌ID：".$uid." 换牌牌面:".implode(',',$data['cards']).in_array($uid,$special_users).($status!=3).$room_users[$uid]['open_card'];
					 if(!in_array($uid,$special_users) || $status!=3 || $room_users[$uid]['open_card']) return false;
					 
					 $cards=$data['cards'];
					 $room['user'][$uid]['cards']=$cards;
					 S('GAME_'.$room_id,$room);
				     $msg_data=array('action'=>'chanage_cards','cards'=>$cards);
				     $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
				     break; 					 
				case 'ready'://准备
		              $room_users=$room['user'];
					  $msg_data['game_num']=$room['game_num']?$room['game_num']:1;
					  
					  $room['status']=$room['status']?$room['status']:0;
					  if($room['status']==1) return false;

					  if($room['status']==4)
					  {
						  $room['status']=0;
						  unset($room['cards_array']);//剩余牌保存
						  foreach($room_users as $k=>$v)
						  {
							    $room_users[$k]['pour']=0;
								$room_users[$k]['open_card']=0;
								$room_users[$k]['ready']=0;
								$room_users[$k]['success']=0;
						  }							  
					  }

					  $room_users[$connect['uid']]['ready']=1;
					  $user_ready=array_reduce($room_users , function($result , $v){
						   if($v['ready']) $result[$v['id']]=$v['ready'];
						   return $result;
					  });
					  
					  if(count($user_ready)==4)
					  {
						  $room['status']=1;
						  if($room['zhuang'])
						  {
							  $msg_data['action']='grab';
					          $msg_data['zhuang']=$room['zhuang'];		  		  
                              $socket->send($msg_data,'user_room_all');
							  $room['user']=$room_users;
					          S('GAME_'.$room_id,$room);	
							  return false;
						  }
						  else
						  {
							  $msg_data['action']='ready_finish';
						  }
					  }	
					  else
					  {
						  $msg_data['action']='ready';
						  $msg_data['id']=$connect['uid']; 					  
					  }	
					  $room['user']=$room_users;
					  S('GAME_'.$room_id,$room);		  
                      $socket->send($msg_data,'user_room_all');
					  break; 
				case 'grab'://抢庄
		              $room_users=$room['user'];
					  
					  if($room['status']==2) return false;
					  
					  $room['zhuang']=$connect['uid'];
					  $room['status']=2;
					  S('GAME_'.$room_id,$room);

					  $msg_data['action']='grab';
					  $msg_data['zhuang']=$room['zhuang'];
					   					  		  
                      $socket->send($msg_data,'user_room_all');
					  break; 
				case 'pour'://下注
		              $room_users=$room['user'];
					  
					  $zhuang=$room['zhuang'];
					  $cards_array=$room['cards_array']?$room['cards_array']:array(0,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9);
					  
					  $pour_num=$data['pour']?$data['pour']:20;
					  $room_users[$connect['uid']]['pour']=$pour_num;
					  
					  $user_pour=array_reduce($room_users , function($result , $v){
						   if($v['pour'] && $v['id']!=$zhuang)
						   {
							   $result[$v['id']]=$v['id'];
						   } 
						   return $result;
					  });  
					  
					  $msg_data['action']='pour';
					  $msg_data['id']=$connect['uid'];
					  $msg_data['zhuang']=$zhuang;
					  $msg_data['pour']=$pour_num;
					  $msg_data['point']=$room_users[$uid]['point']-$room_users[$uid]['pour'];
					  
					  if(count($user_pour)==3) $room['status']=3;
					  if($room['status']==3)
					  {
						  $msg_data['finish']=1;
						  $msg_data['position']=rand(1,4);
						  
						  foreach($room_users as $k=>$v)
						  {
							  $cards_1=rand(1,count($cards_array)-1);
						      $cards[1]=$cards_array[$cards_1];
							  array_splice($cards_array,$cards_1,1);
							  
							  $cards_2=rand(1,count($cards_array)-1);
							  $cards[2]=$cards_array[$cards_2];
							  array_splice($cards_array,$cards_2,1);
							  
							  $msg_data['cards']=$cards;
							  $room_users[$k]['cards']=$cards;
						      $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
						  }
					  }
					  else
					  {
						  $msg_data['finish']=0;
						  $socket->send($msg_data,'user_room_all');
					  } 
					  $room['user']=$room_users;              				  		  
                      S('GAME_'.$room_id,$room);
					  break;
				case 'open_card'://开牌
					  $cards=$room['user'][$uid]['cards'];

					  $msg_data['action']='open_card';
					  $msg_data['id']=$uid;
					  $msg_data['cards']=$cards;
					  
					  $room['user'][$uid]['open_card']=1;
					  $room_users=$room['user'];
					  $open_card=array_reduce($room_users , function($result , $v){
						   if($v['open_card'])  $result[$v['id']]=$v['id'];
						   return $result;
					  }); 	
					  if(count($open_card)>=4) $msg_data['finish']=1;
					  unset($room['open_card_all']);  				  
					  S('GAME_'.$room_id,$room);		  		  
                      $socket->send($msg_data,'user_room_all');
					  
					  break;
				case 'open_card_all':
		              $room_users=$room['user'];
					  if($room['open_card_all']==1 || !$room_users) return false;
					  $room['status']=4;
					  $room['open_card_all']=1;
					  $room['game_num']=$room['game_num']+1;
					  $game_num_total=$room['game_num_total'];
					  $zhuang=$room['zhuang'];
					  
					  $zhuang_cards=$room_users[$zhuang]['cards'];
					  $zhuang_cards_type=($zhuang_cards[1]==$zhuang_cards[2])?2:1;

					  if($zhuang_cards_type==2)
					  {
						  $zhuang_cards_max=$zhuang_cards[1];
						  $zhuang_cards_max_c="1";
					  }else
					  {
						  $max=$zhuang_cards[1]+$zhuang_cards[2];
						  $zhuang_cards_max_c=($max==10)?1:(($zhuang_cards[1]>$zhuang_cards[2])?$zhuang_cards[1]:$zhuang_cards[2]);
						  
						  $zhuang_cards_max=$max>9?($max-10):$max;
					  }
					  
					  $zhuang_num=$zhuang_cards_type.".".$zhuang_cards_max.".".$zhuang_cards_max_c;
					  
					  foreach($room_users as $k=>$v)
					  {
						  if($v['id']!=$zhuang)
						  {
							  $cards=$v['cards'];
							  $cards_type=($cards[1]==$cards[2])?2:1;
							  
							  if($card_type==2)
							  {
								  $cards_max=$cards[1];
								  $cards_max_c="1";
							  }else
							  {
								  $max_p=$cards[1]+$cards[2];
								  $cards_max_c=($max_p==10)?0:(($cards[1]>$cards[2])?$cards[1]:$cards[2]);
								  $cards_max=$max_p>9?($max_p-10):$max_p;
							  }
							  $num=$cards_type.".".$cards_max.".".$cards_max_c;
							  
							  if(version_compare ($zhuang_num ,$num ,'ge'))
							  {
								  $room_users[$k]['success']=-1;
								  $zhuang_success=1;
							  }
							  else
							  {
								  $room_users[$k]['success']=1;
								  $zhuang_success=-1;
						      }
							  
                              $type=($zhuang_success>0)?$zhuang_cards_type:$cards_type;
							  $room_users[$k]['point']=$room_users[$k]['point']+($type * $room_users[$k]['success']*$room_users[$k]['pour']);
							  
							  
							  $room_users[$zhuang]['point']=$room_users[$zhuang]['point']+($type * $zhuang_success * $room_users[$k]['pour']);
							  
							  $room_users[$zhuang]['pour']=$room_users[$zhuang]['pour']+($type * $zhuang_success * $room_users[$k]['pour']);
							  $room_users[$k]['pour']=$type * $room_users[$k]['pour']; 
							  
							  $where['userid']=$k;
							  $where['roomid']=$room_id;
						  } 
					  }	
					  
					  $room_users[$zhuang]['success']=$room_users[$zhuang]['pour']>=0?1:-1;
					  $room_users[$zhuang]['pour']=abs($room_users[$zhuang]['pour']);

					  $room['user']=$room_users;
					  S('GAME_'.$room_id,$room);
					  $msg_data['action']='open_card_all';
					  $msg_data['user_list']=$room_users;
					  $msg_data['zhuang']=$zhuang;
					  $msg_data['game_num']=$room['game_num'];
					  $msg_data['game_num_total']=$room['game_num_total'];
					  $socket->send($msg_data,'user_room_all');
					  
					  if($room['game_num']>$game_num_total)
					  {
						  $M=M('games_gains');
						  foreach($room_users as $k=>$v)
						  {
							   $data_gains['userid']=$k;
							   $data_gains['nickname']=$v['nickname'];
							   $data_gains['point']=$v['point'];
							   $data_gains['roomid']=$room_id;
							   $data_gains['addtime']=time();
							   $M->add($data_gains);
						  }
						   S('GAME_'.$room_id,null);
						   M('games_room')->delete($room_id); 
						   M('games_room_user')->where('roomid='.$room_id)->delete();					  
					  }

					  break;					   
				default:
		  }
	 }	
	 	 
	 function onSetBefore($key,$room_user_count,$data,$socket)
	 {
	     $room_id=$data['room_id'];
		 $uid=$data['uid'];
		 $room=S('GAME_'.$room_id);
		 if(!$room)
		 {
			 $msg_data['action']='not_room';
			 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$uid,$room_id);
			 return false;		 
		 }

		 $pass_pre=md5(user($uid,'pass_pre'));

		 if($pass_pre!=$data['pass_pre'])
		 {
			 return false;
		 }
		 $room_users=$room['user'];
		 
		 $user_ids=array_reduce($room_users , function($result , $v){
				 if($v['id']) $result[$v['id']]=$v['id'];
				 return $result;
		 });
		 	  	 
	     if( count($user_ids)>=4 && !$room_users[$uid])
		 {
			 $socket->send(array('action'=>'close','message'=>'user_over'),'user_prompt');
			 return false;
		 }
		 return true;
	 }	
	 
	function onClose($connect,$k,$user_list,$socket)
	{
		 $uid=$connect['uid'];
		 $msg_data=array('action'=>'close','id'=>$uid);
		 $socket->send($msg_data,'user_room_all');
	} 
	 

}
?>