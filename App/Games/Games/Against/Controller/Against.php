<?php
class Against
{
	 var $ROOMNUM=3;//房间人数
	 function onSet($connect,$data,$user_list,$socket)
	 {
		 $positions_array=array(1,2,3,);//房间桌子位置
		 $uid=$connect['uid'];
		 $room_id=$connect['room_id'];
         
		 $room=F('GAMES_'.$room_id);
		 $roomUser=$room['users'];
		 $M_ROOM=M('games_room_user');
		 $ROOMNUM=$this->ROOMNUM;//房间人数
		 if(!$room)
		 {
			 $msg_data['action']='not_room';//没有房间
			 $socket->send($msg_data,'user_prompt');
			 return false;
		 }
		 $user=M('user')->field('nickname,headpath')->where('id='.$uid)->find();
		 if(!$user)
		 {
				  $msg_data['action']='not_user';//没有找到此用户
			      $socket->send($msg_data,'user_prompt');
				  return false;			 
		 }
		 
		 if(!$roomUser[$uid])
		 {
			  $user_position=$M_ROOM->where('roomid='.$room_id)->getField('position',true);//用户使用的位
			  $positions_not=$user_position?array_diff($positions_array,$user_position):$positions_array;//未使用的位置
			  $position=current($positions_not);
			  $user_position_count=$user_position?count($user_position):0;


			  if($user_position_count>=$ROOMNUM || !$position)
			  {
				  $msg_data['action']='user_over';//用户超出
			      $socket->send($msg_data,'user_prompt');
				  return false;
			  }
			  
			  $userdata=array('userid'=>$uid,'roomid'=>$room_id,'nickname'=>$user['nickname'],'headpath'=>$user['headpath'],'point'=>0,'position'=>$position);

			  if($M_ROOM->add($userdata))
			  {
				  $roomUser[$uid]=$userdata;
				  $room['users']=$roomUser;
				  $room['double'][$uid]=1;
			  }
			  F('GAMES_'.$room_id,$room);
			  $msg_data['action']='come_room';//进入房间
			  $msg_data['game_num']=$room['game_num'];
			  $msg_data['users']=$room['users'];
			  $socket->send($msg_data,'user_room_all');
			  return false;
		 }
		 else //用户重新连接房间
		 {
			  $msg_data['action']='recome_room';//重新进入房间
			  $msg_data['game_num']=$room['game_num'];
			  $msg_data['users']=$room['users'];
			  $msg_data['status']=$room['status']?$room['status']:0;
			  $msg_data['prePosition']=$room['preUid']?$roomUser[$room['preUid']]['position']:0;
			  $msg_data['double']=$room['double'];
			  $msg_data['point']=$room['point'];
			  $msg_data['handCards']=$room['handCards'];
			  $msg_data['against']=$room['against'];
			  
			  foreach($roomUser as $k=>$v)
			  {
                    unset($msg_data['users'][$k]['cards']);
			  }	
			  
			  
			  foreach($roomUser as $k=>$v)
			  {
                  if($k==$uid) $msg_data['cards']=$roomUser[$k]['cards'];
				  $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
			  }	
			  return false;			  
		 }
			 //$msg_data['user_list']=$user_list;
             
	 }
	 
	 function onMessage($connect,$data,$socket)
	 {
		  $uid=$connect['uid'];
		  $room_id=$connect['room_id'];
		  $room=F('GAMES_'.$room_id);
		  $roomUser=$room['users'];
		  $ROOMNUM=$this->ROOMNUM;
		  switch ($data['action'])
		  {
				case 'game_ready'://信息
				     $game_num=$room['game_num'];
				     $roomUser[$uid]['R']=$game_num;
					 $room['users'][$uid]['cards']=array();
					 $room['double'][$uid]=1;
					 $room['accumulator'][$uid]=0;
					 //初始化游戏数据
					 $room['point']=0;
					 $room['maxUid']=0;
					 unset($room['preUid']);
					 unset($room['cardsType']);
					 unset($room['against']);
					 unset($room['handCards']);	
					 //初始化游戏数据完成				 
					  
					  foreach($roomUser as $k=>$v)
					  {
						  if($v['R']==$game_num) $user_ready[$v['userid']]=$v['R'];
					  }

					 
					 if(count($user_ready)<$ROOMNUM)
					 {
						 $msg_data['action']='game_ready';
						 $msg_data['position']=$roomUser[$uid]['position'];
						 $socket->send($msg_data,'user_room_all');
					 }
					 else//准备完成
					 {
						 
						  $cards_init=array(103,104,105,106,107,108,109,110,111,112,113,114,115,203,204,205,206,207,208,209,210,211,212,213,214,215,303,304,305,306,307,308,309,310,311,312,313,314,315,403,404,405,406,407,408,409,410,411,412,413,414,415,516,517);
						  shuffle($cards_init);//洗牌
						  $cardNum=17;
						  
						  foreach($roomUser as $k=>$v)
						  {
							 unset($roomUser[$k]['cards']);
						  }	
										  
						  for($i=0;$i<$cardNum;$i++)
						  {
							   foreach($roomUser as $k=>$v)
							   {
								   $roomUser[$k]['cards'][]=$cards_init[0];
								   array_shift($cards_init);
							   }
						  }					  
						  							  
						  $msg_data['action']="deal";
						  $msg_data['position']=mt_rand(1,3);
						  foreach($roomUser as $k=>$v)
						  {
							 $msg_data['cards']=$roomUser[$k]['cards'];
							 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
						  }	
						  
						  $room['handCards']=$cards_init;
						  $room['status']=1;
					      $room['against']=$msg_data['position'];					    					 
					 }
					 
					 $room['users']=$roomUser;
					 F('GAMES_'.$room_id,$room);
				     break;
				  case 'grab_against'://抢地主 
				  
				       $point=$data['point']?$data['point']:0;
				       $preUid=$room['preUid'];//上一个选择抢地主的玩家ID
					   $room['point']=$room['point']?$room['point']:0;
					   //if(!$preUid && $roomUser[$uid]['position']!=$room['against'])  return false;//如果不是地主第一次抢地主，直接返回
                       if($point>=3)// 选择3分 直接成为地主
					   {
						       $room['against']=$uid;//地主uid
							   $room['point']=$point;//选择分数
							   $room['double'][$room['against']]=2;
							   unset($room['preUid']);
							   unset($room['maxUid']);//选择积分大的用户ID
							   
							   $cards=$room['users'][$uid]['cards'];
							   $room['users'][$uid]['cards']=array_merge($cards, $room['handCards']);	
							   
							   
							   $msg_data['action']='finish_against';
							   $msg_data['position']=$roomUser[$uid]['position'];
							   $msg_data['Aposition']=$roomUser[$uid]['position'];//地主的真实位置
							   $msg_data['point']=$point;//游戏积分
							   $msg_data['selectPoint']=$point;//选择积分
							   $msg_data['handCards']=$room['handCards'];//底牌
							   $msg_data['double']=$room['double'];
							   $socket->send($msg_data,'user_room_all');
                               $room['status']=2;
							   F('GAMES_'.$room_id,$room);	
							   return false; 						   
					   }
                       
					   if($point>$room['point'])
					   {
						   $room['point']=$point;
						   $room['maxUid']=$uid;
					   }
					   $room['preUid']=$uid;
					   
                       
                       if($preUid)//不是第一个抢地主
					   {
						    $prePosition=$roomUser[$preUid]['position'];//上一个抢地主位置
							$currentPosition=($prePosition+1>$ROOMNUM)?1:$prePosition+1;//当前玩家位置
							//if($currentPosition!=$roomUser[$uid]['position']) return false;
							$nextPosition=($currentPosition+1>$ROOMNUM)?1:$currentPosition+1;//下一个位置
							if($nextPosition == $room['against']) //下一个为随机的产生的位置，表示抢地主完成一轮
							{
								   $msg_data['action']='finish_against';
								   $msg_data['position']=$roomUser[$uid]['position'];
								   $msg_data['Aposition']=$roomUser[$room['maxUid']]['position'];//地主的真实位置
								   $msg_data['point']=$room['point'];//游戏积分
							       $msg_data['selectPoint']=$point;//选择积分
							       $msg_data['handCards']=$room['handCards'];//底牌
								   
								   $room['against']=$room['maxUid'];
								   $cards=$room['users'][$room['against']]['cards'];
								   $room['double'][$room['against']]=2;
								   $room['users'][$room['against']]['cards']=array_merge($cards, $room['handCards']);									   
							       unset($room['preUid']);
							       unset($room['maxUid']);//选择积分大的用户ID
								   $room['status']=2;							   
								   F('GAMES_'.$room_id,$room);
								   
								   $msg_data['double']=$room['double'];
								   $socket->send($msg_data,'user_room_all');
								   return false; 									  
							}
							else
							{
								   $msg_data['action']='grab_against';
								   $msg_data['position']=$roomUser[$uid]['position'];
								   $msg_data['selectPoint']=$point;
								   $msg_data['point']=$room['point'];//游戏积分
								   $socket->send($msg_data,'user_room_all');
								   
								   F('GAMES_'.$room_id,$room);	
								   return false;							   
							}
					   }
					   else
					   {
								   $msg_data['action']='grab_against';
								   $msg_data['position']=$roomUser[$uid]['position'];
								   $msg_data['selectPoint']=$point;
								   $msg_data['point']=$room['point'];//游戏积分
								   $socket->send($msg_data,'user_room_all');
								   $room['maxUid']=$uid;
								   F('GAMES_'.$room_id,$room);							   
					   }
				       break; 
				  case 'game_double'://翻倍
				  
				       $double=$data['double']?$data['double']:1;
					   $preUid=$room['preUid'];//上一个选择抢地主的玩家ID
					   $room['preUid']=$uid;//设置上
					   
					   
					   if($double>1)
					   {
						    if($uid==$room['against'])
							{
								  foreach($roomUser as $k=>$v) 
					              {
									   if($k!=$room['against'])
									   {
											$room['double'][$k]=$room['double'][$k] * $double;
									   }
								  }
						    }
							else
							{
							       $room['double'][$uid]=$room['double'][$uid] * $double;							 
							}
							$array=$room['double'];
							unset($array[$room['against']]);
							$room['double'][$room['against']]=array_sum($array);
							unset($array);
					   }

				       if($preUid)
					   {
						    $prePosition=$roomUser[$preUid]['position'];//上一个翻倍玩家位置
							$currentPosition=($prePosition+1>$ROOMNUM)?1:$prePosition+1;//当前玩家位置
						    //if($currentPosition!=$roomUser[$uid]['position']) return false;
							$nextPosition=($currentPosition+1>$ROOMNUM)?1:$currentPosition+1;
							
							//echo $prePosition."/".$currentPosition."/".$nextPosition."********";
							$Aposition=$roomUser[$room['against']]['position'];//地主位置
							if($nextPosition==$Aposition) //回到地主位置，表示翻倍一轮完成
						    {
								 $msg_data['action']="finish_double";
								 $msg_data['selectDouble']=$double;//玩家选择的翻倍情况
								 $msg_data['position']=$roomUser[$uid]['position'];
								 $msg_data['Aposition']=$Aposition;
								 $msg_data['double']=$room['double'];
								 $socket->send($msg_data,'user_room_all');
								 
								 unset($room['preUid']);	
								 unset($room['cardsType']);
								 $room['status']=3;
								 F('GAMES_'.$room_id,$room);
								 return false;							    
						    }
							else
							{
								 $msg_data['action']="game_double";
								 $msg_data['selectDouble']=$double;//玩家选择的翻倍情况
								 $msg_data['position']=$roomUser[$uid]['position'];
								 $msg_data['double']=$room['double'];
								 $socket->send($msg_data,'user_room_all');	
								 F('GAMES_'.$room_id,$room);	
								 return false;						 
							}
					   }
					   else
					   {
								 $msg_data['action']="game_double";
								 $msg_data['selectDouble']=$double;//玩家选择的翻倍情况
								 $msg_data['position']=$roomUser[$uid]['position'];
								 $msg_data['double']=$room['double'];
								 $socket->send($msg_data,'user_room_all');	
								 F('GAMES_'.$room_id,$room);							   
					   }				   
				       break; 
				  case 'discard'://出牌 
				      $cardsType=$room['cardsType'];//上一个玩家所出的牌型
					  $preUid=$room['preUid'];//上一个出牌玩家ID
					  $maxUid=$room['maxUid'];
					  
					  if(!$data['cards'])//不出牌
					  {
						  $maxPosition=$roomUser[$maxUid]['position'];//出牌大的玩家ID
						  $currentPosition=$roomUser[$uid]['position'];//当前出牌玩家的ID
						  $nextPosition=($currentPosition+1)>$ROOMNUM?1:$currentPosition+1;//下一个玩家的位置
						  
						  unset($msg_data['wheel']);
						  if($nextPosition==$maxPosition) //没人大于出牌，本轮完成
						  {
							  $room['cardsType']=NULL;
							  $room['maxUid']=NULL;
							  $msg_data['wheel']="end";
						  }
						  
						  $room['preUid']=$uid;
						  F('GAMES_'.$room_id,$room);
						  $msg_data['action']='not_discard'; //不出牌
						  $msg_data['position']=$roomUser[$uid]['position'];//当前出牌玩家位置
						  $socket->send($msg_data,'user_room_all');
						  return false;
					  }	
					  				  
					  if($preUid)
					  {
						  $prePosition=$roomUser[$preUid]['position'];//上次出牌的玩家位置
						  
						  $currentPosition=$prePosition+1>$ROOMNUM?1:$prePosition+1;//当前应该出的玩家位置
						  
						  $position=$roomUser[$uid]['position'];//当前出牌的玩家位置

						  if($cardsType['type']=="KING" && $uid!=$preUid) return false;
/*						  if($currentPosition!=$position)//未轮到当前玩家出牌
						  {
							  $msg_data['action']='not_turn'; 
							  $socket->send($msg_data,'user_prompt');
							  return false;
						  }	*/										  
					  }
					  
					  
				      $cardsWar=war($cardsType,$data['cards']);
					  
					  if(!$cardsWar)
					  {
						  var_dump($data['cards']);
						  $msg_data['action']='not_type'; //不符合出牌类型
						  $socket->send($msg_data,'user_prompt');
						  return false;
					  }

					  $userCards=$roomUser[$uid]['cards'];
					  $cards= array_merge(array_diff($userCards, $data['cards']));//会员打出牌后剩余的牌
					  $roomUser[$uid]['cards']=$cards;
					  
					  if($cardsWar['type']=="KING" || $cardsWar['type']=="AAAA")
					  {
						  foreach($room['double'] as $k=>$v)
						  {  
							 $room['double'][$k]=$room['double'][$k] * 	2;
							 $msg_data['double'][$k]=$room['double'][$k];
						  }	
					  }
					  
					  if(!$cards)//胜利
					  {
						  $room['game_num']=$room['game_num']?$room['game_num']:1;
						  $room['game_num_total']=$room['game_num_total']?$room['game_num_total']:1;
						  
						  $room['game_num']=$room['game_num']+1;
						  
						  if($room['game_num']>$room['game_num_total'])  $msg_data['isEnd']=1;
						  
						  $msg_data['action']='game_success'; //出牌完成
						  $msg_data['cardsType']=$cardsWar;
						  $msg_data['position']=$roomUser[$uid]['position'];
					      $msg_data['discard_cards']=$data['cards'];
						  
						  $againstSucceed=($uid==$room['against'])?1:-1;
						  foreach($roomUser as $k=>$v)
						  {
							  
							  $succeed=($k==$room['against'])?$againstSucceed:-$againstSucceed;
							  $roomUser[$k]['point']=$succeed * $room['point'] * $room['double'][$k] + $roomUser[$k]['point'];
							  
							  $msg_data['users'][$roomUser[$k]['position']]['cards']=$roomUser[$k]['cards'];
							  $msg_data['users'][$roomUser[$k]['position']]['nickname']=$roomUser[$k]['nickname'];
							  $msg_data['users'][$roomUser[$k]['position']]['userid']=$roomUser[$k]['userid'];
							  $msg_data['users'][$roomUser[$k]['position']]['point']=$room['point'];
							  $msg_data['users'][$roomUser[$k]['position']]['double']=$room['double'][$k];
							  $msg_data['users'][$roomUser[$k]['position']]['isA']=($k==$room['against'])?1:0;
							  $msg_data['users'][$roomUser[$k]['position']]['succeed']=$succeed;
							  $msg_data['users'][$roomUser[$k]['position']]['totalPoint']=$roomUser[$k]['point'];

							  if($succeed ==1 )//玩家连胜次数
							  {
								   $room['accumulator'][$uid]=$room['accumulator'][$uid]+1;
							  }
							  else
							  {
								   $room['accumulator'][$uid]=0;
							  }
							  
							  $user['room_id']=$room_id;
							  $user['user_id']=$k;
							  $user['success']=$succeed;
							  $user['accumulator']=$room['accumulator'][$uid];
							  $user['point']=$roomUser[$k]['point'];
							  game_record($user);

						  }							  
						  $socket->send($msg_data,'user_room_all');	
						  $room['users']=$roomUser;
						  $room['status']=0;
					      F('GAMES_'.$room_id,$room);
						  return false;					   
					  }
					  else
					  {
						  $room['preUid']=$uid;
						  $room['cardsType']=$cardsWar;
						  $room['maxUid']=$uid;	
						  
						  if($cardsWar['type']=="KING")
						  {
							  unset($room['preUid']);
							  unset($room['cardsType']);
							  unset($room['maxUid']);
						  }	
						  
						  $msg_data['action']="discard";
						  $msg_data['cardsType']=$cardsWar;
						  $msg_data['cards_num']=count($cards);	
						  $msg_data['position']=$roomUser[$uid]['position'];
					      $msg_data['discard_cards']=$data['cards'];
						  foreach($roomUser as $k=>$v)
						  {
								 if($uid==$v['userid']) $msg_data['cards']=$roomUser[$k]['cards'];
								 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
						  }	
						  						  			  
					  }
					  $room['users']=$roomUser;
					  F('GAMES_'.$room_id,$room);
				      break;
				case 'game_complete'://继续游戏
					  $games_num_record=M("games_num_record");
					  $game_info=$games_num_record->where(array('room_id'=>$room_id))->select(); 
					  $msg_data['action']="game_complete";
					  foreach($game_info as $k=>$v)  
					  {
						  $userid=$v['user_id'];
						  $msg_data['users'][$userid]['nickname']=$roomUser[$userid]['nickname'];
						  $msg_data['users'][$userid]['headpath']=$roomUser[$userid]['headpath'];
						  $msg_data['users'][$userid]['point']=$roomUser[$userid]['point'];
						  $msg_data['users'][$userid]['success_num']=$v['success_num'];
						  $msg_data['users'][$userid]['fail_num']=$v['fail_num'];
						  $msg_data['users'][$userid]['accumulator_num']=$v['accumulator_num'];
					  } 
					  $socket->send($msg_data,'user_room_all'); 
					                  
				      break;
				case 'game_dissolve'://解散游戏
				      
					  $status=$data['status'];
                      $msg_data['action']="game_dissolve";	
					  					  
					  if($status==0)//点击了拒绝解散房间 
					  {
						   unset($room['dissolve']);
						   $msg_data['users']['status']=0;
						   $msg_data['users']['id']=$uid;
						   $msg_data['status']=0;
						   $socket->send($msg_data,'user_room_all');						   
					  }
					  else if($status==1)//同意解散房间
					  {
						   $room['dissolve']['user'][$uid]=1;
						   $msg_data['users']['status']=1;
						   $msg_data['users']['id']=$uid;
						   
						   
						   if(count($room['dissolve']['user'])>=$ROOMNUM)//所有人都同意解散房间
						   {
							    dissolve($room_id);
							    $msg_data['status']=5;
						   }
						   else
						   {
							    $msg_data['status']=1;
						   }
						   
						   $socket->send($msg_data,'user_room_all'); 
						   
					  } 
					  else if($status==2)//时间到了解散房间
					  {
						    dissolve($room_id);
						    $msg_data['status']=5;
						    $socket->send($msg_data,'user_room_all'); 
					  } 
					  else if($status==3)//发起解散房间
					  {
						    unset($room['dissolve']);
						    $room['dissolve']['time']=time();
						    $room['dissolve']['launch']=$uid;
							$room['dissolve']['user'][$uid]=1;
							
							foreach($roomUser as $k=>$v)  
							{
								$msg_data['users'][$k]['nickname']=$roomUser[$k]['nickname'];
								$msg_data['users'][$k]['headpath']=$roomUser[$k]['headpath'];
								$msg_data['users'][$k]['status']=$room['dissolve']['user'][$k];
							} 
							$msg_data['dissolve']=$uid;	
							
							$msg_data['status']=3;
							$socket->send($msg_data,'user_room_all'); 			   
					  }
					  
					  F('GAMES_'.$room_id,$room);
				      break;
				case 'game_back'://解散游戏
                      if($room['game_num']<=1 && !$room['status'])
					  {
						   $position=back($uid,$room_id);
                           $msg_data['position']=$position;						   
					  }
					  
					  $msg_data['action']="game_back";
					  $socket->send($msg_data,'user_room_all'); 
				      break;
				default:			   
		  }

	 }
	 	
	 function onSetBefore($key,$room_user_count,$data,$socket)
	 {
	     $room_id=$data['room_id'];
		 $uid=$data['uid'];

		 $room=F('GAMES_'.$room_id);
		 
		 if(!$room)
		 {
			 $msg_data['action']='not_room';
			 $socket->send($msg_data,'user_prompt');
			 return false;		 
		 }
		 
		 $user=M('user')->field('pass_pre')->where('id='.$uid)->find();
		 if(!$user)
		 {
				  $msg_data['action']='not_user';//没有找到此用户
			      $socket->send($msg_data,'user_prompt');
				  return false;			 
		 }
         $pass_pre= md5($user['pass_pre']);
		 if($pass_pre!=$data['pass_pre']) return false;
		 return true;
	 }	
	  
	function onClose($connect,$k,$user_list,$socket)
	{
		 $uid=$connect['uid'];
		 $msg_data=array('action'=>'close','id'=>$uid);
		 $socket->send($msg_data,'user_room_all');
	} 
}


function dissolve($room_id)
{
	 if(!$room_id) return false;
	 F('GAMES_'.$room_id,NULL);
	 
	 M('games_room_user')->where(array('roomid'=>$room_id))->delete();
	 M('games_room')->where(array('id'=>$room_id))->delete();
	 return true;
}

function back($uid,$room_id)
{
	 if(!$uid) return false;
	 $room=F('GAMES_'.$room_id);
	 $position=$room['users'][$uid]['position'];
	 unset($room['users'][$uid]);
     F('GAMES_'.$room_id,$room);	 
	 M('games_room_user')->where(array('userid'=>$uid))->delete();

	 return $position;
}

function cardsArray($cards)
{
	usort($cards,"arraySort");
	$ct=array();
	$cardsNum=count($cards);
    if($cardsNum>3)
	{
		for($i=0;$i<$cardsNum;$i++)
		{
			if(mod($cards[$i+1]) && mod($cards[$i])!=mod($cards[$i+1]))
			{
				$ct['A'][]=mod($cards[$i]);
			}
			else if(mod($cards[$i+1]) && mod($cards[$i])==mod($cards[$i+1]) && mod($cards[$i])!=mod($cards[$i+2]))
			{
				$ct['AA'][]=mod($cards[$i]);
				$i=$i+1;
				continue;
			}
			else if(mod($cards[$i+2]) && mod($cards[$i])==mod($cards[$i+1]) && mod($cards[$i])==mod($cards[$i+2]) && mod($cards[$i])!=mod($cards[$i+3]))
			{
				$ct['AAA'][]=mod($cards[$i]);
				$i=$i+2;
				continue;
			}
			else if(mod($cards[$i+3]) && mod($cards[$i])==mod($cards[$i+3]))
			{
				$ct['AAAA'][]=mod($cards[$i]);
				$i=$i+3;
				continue;
			}
			else
			{
				$ct['A'][]=mod($cards[$i]);
			}
			
	    }
	}
	
	return $ct;
}


function cardsType($cards)
{
	$cardsNum=count($cards);
	switch ($cardsNum)
	{
		case 0:
		  return false;
		  break;  
		case 1://单牌
		  $CType['type']="A";
		  $CType['card']=mod($cards[0]);
		  break;
		case 2://对子
		  if(mod($cards[0])==mod($cards[1]) )
		  {
			  $CType['type']="AA";
		      $CType['card']=mod($cards[0]);
		  }
		  if(mod($cards[0])==16 && mod($cards[1])==17) $CType['type']="KING"; //双王
		  break;
		case 3://3不带牌
		  if( mod($cards[0])==mod($cards[2]) ) 
		  {
			  $CType['type']="AAA";
		      $CType['card']=mod($cards[0]);
		  }
		  break;
		default:
		  $ct=cardsArray($cards);
		  if(!$ct) return false;
		  $oneNum=count($ct['A']);
		  $twoNum=count($ct['AA']);
		  $threeNum=count($ct['AAA']);
		  $fourNum=count($ct['AAAA']);
		  if($threeNum==1 && !$fourNum)
		  {
			   if(!$twoNum && $oneNum==$threeNum )//三带一
			   {
				   $CType['type']="AAAB";
		           $CType['card']=array('A'=>$ct['AAA'][0],'B'=>$ct['A'][0]);
			   }
			   else if(!$oneNum && $twoNum==$threeNum )//三带对
			   {
				   $CType['type']="AAABB";
		           $CType['card']=array('A'=>$ct['AAA'][0],'B'=>$ct['AA'][0]);	
			   }
			   
		  }  
		  else if($threeNum>=2 && !$fourNum)//三连不带
		  {
			    if(in_array(15,$ct['AAA'])) return false;
			   	asort($ct['AAA']);
				$V=$ct['AAA'];
			   	for($i=0;$i<($threeNum-1);$i++)
				{
					if($V[$i+1]-$V[$i]!=1) return false;
				} 
				
				 if(!$oneNum && !$twoNum)//三连不带牌
				 {
					 $CType['type']="AAABBB";
		             $CType['card']=array('A'=>array('MIN'=>$ct['AAA'][0],'NUM'=>$threeNum));	
				 }
				 else if(($oneNum+2 * $twoNum)==$threeNum )//三联带单牌
				 {
					 $CType['type']="AAABBBCD";
					 $CType['card']=array('A'=>array('MIN'=>$ct['AAA'][0],'NUM'=>$threeNum));
				 }
				 else if(!$oneNum && $twoNum==$threeNum )//三连带对
				 {
					 $CType['type']="AAABBBCCDD";
					 $CType['card']=array('A'=>array('MIN'=>$ct['AAA'][0],'NUM'=>$threeNum));
				 }				
				
		  }
		  else if($twoNum>=3 && !$oneNum && !$threeNum && !$fourNum)//连对
		  {
			    if(in_array(15,$ct['AA'])) return false;
			    asort($ct['AA']);
				$V=$ct['AA'];
			   	for($i=0;$i<($twoNum-1);$i++)
				{
					if($V[$i+1]-$V[$i]!=1) return false;
				} 	
				$CType['type']="AABBCC";
			    $CType['card']=array('A'=>array('MIN'=>$ct['AA'][0],'NUM'=>$twoNum));		  
		  }
		  else if($oneNum >=5 && !$twoNum && !$threeNum && !$fourNum)//顺子
		  {
			    if(in_array(15,$ct['A'])) return false;
			    asort($ct['A']);
				$V=$ct['A'];
			   	for($i=0;$i<($oneNum-1);$i++)
				{
					if($V[$i+1]-$V[$i]!=1) return false;
				} 	
				$CType['type']="ABCDEF";
			    $CType['card']=array('A'=>array('MIN'=>$ct['A'][0],'NUM'=>$oneNum));			  
		  }
		  else if($fourNum==1 && !$threeNum)
		  {
			   if(!$oneNum && !$twoNum)//炸弹
			   {
				    $CType['type']="AAAA";
			        $CType['card']=array('A'=>$ct['AAAA'][0]);
			   }
			   else if($oneNum==2 && !$twoNum)//四带二
			   {
				    $CType['type']="AAAABC";
			        $CType['card']=array('A'=>$ct['AAAA'][0]);
			   }
			   else if($twoNum==2 && !$oneNum)//四带对
			   {
				    $CType['type']="AAAABBCC";
			        $CType['card']=array('A'=>$ct['AAAA'][0]);
			   }
			   else if($twoNum==1 && !$oneNum)//四带对
			   {
				    $CType['type']="AAAABB";//四带二
			        $CType['card']=array('A'=>$ct['AAAA'][0]);
			   }
		  }
		  else if(!$oneNum && !$twoNum && !$threeNum && $fourNum==2)
		  {
				    $CType['type']="AAAABBBB";
			        $CType['card']=array('A'=>$ct['AAAA'][1]);			  
		  }
		  else
		  {
			  return false;
		  }
	}	
	 return $CType;
}

function war($cardsType,$discard)
{
	 $ct=cardsType($discard);
	 var_dump($ct);
	 var_dump($cardsType);
	 if(!$ct) return false;
	 if(!$cardsType) return $ct;

	 if($ct['type']!="KING" && $ct['type']!="AAAA" && $ct['type']!=$cardsType['type']) return false;
	 
	 if($ct['type']=="KING") return $ct;
	 
	 if($ct['type']=="AAAA" && ($cardsType['type']!="AAAA" || ($cardsType['type']=="AAAA" && $ct['card']['A']>$cardsType['card']['A'])) ) return $ct;
	 
     switch ($ct['type'])
	 {
		case "A"://单牌比
		case "AA"://对子比
		case "AAA"://三不带
		  if($ct['card']>$cardsType['card']) return $ct;
		  break;
		case "AAAB"://三带一
		case "AAABB"://三带二
		case "AAAABC"://四带二
		case "AAAABB"://四带二
		case "AAAABBCC"://三带对
		case "AAAABBBB"://四带对		
		  if($ct['card']['A']>$cardsType['card']['A']) return $ct;
		  break;
		case "AAABBB"://三连不带
		case "AAABBBCD"://三连带二
		case "AAABBBCCDD"://三连带对
		case "AABBCC"://连对
		case "ABCDEF"://顺子
		  if($ct['card']['A']['NUM']==$cardsType['card']['A']['NUM'] && $ct['card']['A']['MIN']>$cardsType['card']['A']['MIN']) return $ct;
		  break;		
		default:	
		   return  false;
	 }
	 
	 
}
//求余数
function mod($num)
{
	return ($num % 100);
}
//求余数
function arraySort($a,$b)
{
   $a=mod($a);
   $b=mod($b);
   if ($a==$b) return 0;
   return ($a<$b)?-1:1; 
}


function game_record($user)
{
	  $room_id=$user['room_id'];
	  $uid=$user['user_id'];
	  $games_num_record=M("games_num_record");
	  $game_info=$games_num_record->where(array('room_id'=>$room_id,'user_id'=>$uid))->find();
	  
	  if($game_info)
	  {
		    $data['point']=$user['point'];
			
			if($user['accumulator_num']>$game_info['accumulator_num']) $data['accumulator_num']=$user['accumulator_num'];
			
			if($user['success']==1)
			{
				$data['success_num']=$game_info['success_num']+1;
			}
			else
			{
				$data['fail_num']=$game_info['fail_num']+1;
			}
			$games_num_record->where(array('room_id'=>$room_id,'user_id'=>$uid))->save($data);
	  }
	  else
	  {
		    $data['room_id']=$room_id;
			$data['user_id']=$uid;
			$data['point']=$user['point'];
			$data['addtime']=time();
			if($user['success']==1)
			{
				$data['success_num']=1;
				$data['accumulator_num']=1;
				
			}
			else
			{
				$data['fail_num']=1;
			}
			$games_num_record->data($data)->add();
	  }	
}
?>