<?php
class Minghua
{
	 var $ROOMNUM=4;//房间人数
	 function onSet($connect,$data,$user_list,$socket)
	 {
		 
		 $positions_array=array(1,2,3,4);//房间桌子位置
		 $uid=$connect['uid'];
		 $room_id=$connect['room_id'];
         
		 $room=S('GAMES_'.$room_id);
		 $roomUser=$room['users'];
		 $M_ROOM=M('games_room_user');
		 $ROOMNUM=$this->ROOMNUM;//房间人数
		 $user=M('user')->field('nickname,headpath,sex')->where('id='.$uid)->find();
		 if(!$room) return false;
		 
		 if(!$user)
		 {
				  $msg_data['action']='not_user';//没有找到此用户
			      $socket->send($msg_data,'user_prompt');
				  return false;			 
		 }

         if(!$roomUser[$uid] && count($roomUser) >= 4)
		 {
				$msg_data['action']='room_full';//房间已满
				$socket->send($msg_data,'user_prompt');
				return false;			 
		 }		 
		 
		 $msg_data['start_uid']=$room['start_uid'];
		 $msg_data['game_num']=$room['game_num'];
		 $msg_data['room_sn']=$room['room_sn'];
		 $msg_data['game_type']=$room['game_type'];
		 $msg_data['payment_method']=$room['payment_method'];
		 $msg_data['game_num_total']=$room['game_num_total'];
		 
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
			  
			  $userdata=array('userid'=>$uid,'roomid'=>$room_id,'nickname'=>$user['nickname'],'headpath'=>$user['headpath'],'point'=>0,'position'=>$position,'sex'=>$user['sex']);

			  if($M_ROOM->add($userdata))
			  {
				  $roomUser[$uid]=$userdata;
				  $room['users']=$roomUser;
				  $room['P'][$position]=$uid;
			  }
			  S('GAMES_'.$room_id,$room);
			  $msg_data['action']='come_room';//进入房间
			  $msg_data['game_num']=$room['game_num'];
			  $msg_data['users']=$room['users'];
			  $msg_data['zhuang']=$room['zhuang']?$room['zhuang']:$room['start_uid'];
		      $msg_data['zhuangPosition']=$room['zhuang']?$roomUser[$room['zhuang']]['position']:$roomUser[$room['start_uid']]['position'];
			  $socket->send($msg_data,'user_room_all');
			  return false;
		 }
		 else //用户重新连接房间
		 {
			  $msg_data['action']='recome_room';//重新进入房间
			  
			  $msg_data['users']=$room['users'];
			  $msg_data['status']=$room['status']?$room['status']:0;
			  $msg_data['socketStatus']=$data['socketStatus'];
			  $msg_data['zhuang']=$room['zhuang']?$room['zhuang']:$room['start_uid'];
			  $msg_data['zhuangPosition']=$room['zhuang']?$roomUser[$room['zhuang']]['position']:$roomUser[$room['start_uid']]['position'];
			  if($msg_data['status'])
			  {
	                $msg_data['pre']=$room['pre'];//上一个出牌玩家位置
					$msg_data['pre_card']=$room['pre_card'];//上一个出牌玩家出的
					$msg_data['handCards']=$room['handCards'];
					$msg_data['mjaign']=$room['MJAIGN'];
					$msg_data['cards'][$uid]['cards']=$room['cards'][$uid];
					$msg_data['draw']=$room['draw'];
					$msg_data['touchCard']=$room['touchCard'][$uid];
					$msg_data['cardsNum']=count($room['cards_init']);
					$msg_data['hua']=$room['hua'];
					$msg_data['discardCards'] = $room['discardCards'];				  
				  
	                foreach($roomUser as $k =>$v)
					{
						 $msg_data['cards'][$k]['MJ3'] = $room['Mj34'][$k]['MJ3'];
						 $msg_data['cards'][$k]['MJ4'] = $room['Mj34'][$k]['MJ4'];
						 $msg_data['cards'][$k]['MJ5'] = $room['Mj34'][$k]['MJ5'];
					}
					$msg_data['cards'][$uid]['cards']= $room['cards'][$uid]; 
					$socket->send($msg_data,'user_prompt');				  
			  }
			  else
			  {
				    $socket->send($msg_data,'user_room_all');	
			  } 		  
		 }
             
	 }
	 
	 function onMessage($connect,$data,$socket)
	 {
		  $uid=$connect['uid'];
		  $room_id=$connect['room_id'];
		  $room=S('GAMES_'.$room_id);
		  $roomUser=$room['users'];
		  $ROOMNUM=$this->ROOMNUM;
		  $zhuang=$room['zhuang']?$room['zhuang']:$room['start_uid'];
		  switch ($data['action'])
		  {
				case 'game_ready'://信息
				     $game_num=$room['game_num'];
				     $roomUser[$uid]['R']=$game_num;
					 //初始化游戏数据
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
						  $room['cards']=null;
						  $cards_=array(1,2,3,4,5,6,7,8,9,11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,41,42,43);
						  foreach($cards_ as $k=>$v)
						  {
							  $key=$k * 4;
							  $cards_init[$key] =$v;
							  $cards_init[$key+1] =$v;
							  $cards_init[$key+2] =$v;
							  $cards_init[$key+3] =$v;
						  }

						  shuffle($cards_init);//洗牌
						  $cardNum=13;
										  
						  for($i=0;$i<$cardNum;$i++)
						  {
							   foreach($roomUser as $k=>$v)
							   {
								   $room['cards'][$k][]=array_shift($cards_init);
							   }
						  }

						  $room['cards_init']=$cards_init;
						  
						  if($room['game_type'] == 1)
						  {
							  $hua_num=rand(1,count($cards_init)-1);
						      $room['hua']=$cards_init[$hua_num];
						      $room['hua_num']=$hua_num;

							  $msg_data['hua']=$room['hua'];
							  $msg_data['hua_num']=$hua_num;							  
						  }						  
			  
						  $msg_data['action']="deal";
						  $msg_data['action']="deal";
						  foreach($roomUser as $k=>$v)
						  {
							 $msg_data['cards']=$room['cards'][$k];
							 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
						  }	
						  $room['status']=1;			    					 
					 }
					 
					 $room['users']=$roomUser;
					 S('GAMES_'.$room_id,$room);
				     break;
				  case "game_touch":
				      if($uid!=$zhuang) return false;
					  $touchCard=array_shift($room['cards_init']);
				      $msg_data['action']="game_touch";
					  $msg_data['position']=$roomUser[$uid]['position'];
					  $msg_data['cardsNum']=count($room['cards_init']);
					  
					  foreach($roomUser as $k=>$v)
					  {
						 unset($msg_data['touchCard']);
						 if( $uid==$k ) $msg_data['touchCard']=$touchCard;
						 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
					  }
					  $room['cards'][$uid][]=$touchCard;
					  $room['touchCard'][$uid]=$touchCard; 	
					  S('GAMES_'.$room_id,$room);
					  
					  $MJ5=checkCard5($room['cards'][$uid]);
					  $MJ5Conut=count($MJ5);
					  
					  if($MJ5Conut>0)
					  {
						   unset($msg_data);
						   $msg_data['action']='game_MJ';//有杠
						   $msg_data['MJ']=$MJ5;
						   $msg_data['mode']=1;
			               $socket->send($msg_data,'user_prompt');
					  }	
					  $room['status']=2;
					  S('GAMES_'.$room_id,$room);	        
					  break;
				  case 'game_discard'://出牌
				      unset($room['MJAIGN']);
				      $card=$data['card'];
				      $position=$roomUser[$uid]['position'];
					  
					  if($position == $room['pre']) return false;
					  $room['pre']=$position;//上一个出牌玩家位置
					  $room['pre_card']=$card;//上一个出牌玩家出的牌
					  
					  $cards=$room['cards'][$uid];
					  $room['cards'][$uid]=delArrayVal($cards,$card);	
					  
					  $MJUID=0;
					  foreach($roomUser as $k=>$v)
					  {
						   if($k!=$uid && !$room['draw'][$k] && !$room['drawDiscard'])
						   {
							    $userCards=$room['cards'][$k];
								if(checkCardVal($userCards,$card,3))
								{
									 $MJUID = $k;
									 $MJTYPE = "MJ4";
									 $room['MJAIGN']['uid'] = $MJUID;
									 $room['MJAIGN']['MJ'] = "MJ4";
									 break;							  
								}
								elseif(checkCardVal($userCards,$card,2))
								{
									 $MJUID = $k;
									 $MJTYPE = "MJ3";
									 $room['MJAIGN']['MJ'] = "MJ3";
									 $room['MJAIGN']['uid'] = $MJUID;
									 break;										
								}
						   }
					  }

                      if(!$MJUID || !$MJTYPE)
					  {
						  $nextPosition=$position >= $ROOMNUM ? 1 : $position + 1;
						  $nextUid = $room['P'][$nextPosition];	
						  
                          /*=================================================游戏流局开始=====================================================================*/
					      if(count($room['cards_init']) == 0)
					      {
									$game_gang = false;//是否有杠
									$msg_data['action']="game_dogfall";
									$msg_data['position'] = $roomUser[$uid]['position'];
									$msg_data['data']['zhuang_uid']=$zhuang; 
									
									$msg_data['data']['game_num']=$room['game_num']?$room['game_num']:1;
									$msg_data['data']['game_num_total']=$room['game_num_total']?$room['game_num_total']:1;
									
									foreach($roomUser as $k => $v)
									{
										 $dogfallUser[$k]['headpath'] = $v['headpath'];
										 $dogfallUser[$k]['nickname'] = $v['nickname'];
										 $dogfallUser[$k]['point'] = 0;
										 $dogfallUser[$k]['win'] = 0;
										 
										 $cards[$k]['cards']=$room['cards'][$k];
										 $cards[$k]['MJ']['MJ3']=$room['Mj34'][$k]['MJ3'] ? $room['Mj34'][$k]['MJ3'] : array();
										 $cards[$k]['MJ']['MJ4']=$room['Mj34'][$k]['MJ4'] ? $room['Mj34'][$k]['MJ4'] : array();
										 $cards[$k]['MJ']['MJ5']=$room['Mj34'][$k]['MJ5'] ? $room['Mj34'][$k]['MJ5'] : array(); 
										 
										 if($room['Mj34'][$k]['MJ5'] || $room['Mj34'][$k]['MJ4']) $game_gang = true;
									}
									
									$msg_data['data']['cards'] = $cards;
									$msg_data['data']['user'] = $dogfallUser;
									
									$room['game_num'] = $room['game_num'] + 1;
									
									if($room['game_num'] > $room['game_num_total'])//本场游戏完成
									{
										  unset($room['MJAIGN']);
										  dissolve($room_id);
										  S('GAMES_'.$room_id,NULL);
									}
									else
									{
										  $room['discardCards']=array();
										  $room['touchCard'] = array();
										  $room['Mj34'] = array();
										  $room['cards']=array();
										  $room['draw']=array();
										  $room['winCard']=array();
										  $room['pre']=null;//上一个出牌玩家位置
										  $room['pre_card']=null;//上一个出牌玩家出的
										  $room['status'] =0;
										  
										  $zhuangPosition = $roomUser[$zhuang]['position'];
										  
										  if($game_gang) 
										  { 
											  $zhuangPosition = $zhuangPosition >= $ROOMNUM ? 1 : $zhuangPosition+1;
											  $zhuang = $room['P'][$zhuangPosition];
											  $room['zhuang'] = $zhuang;
										  }
										  S('GAMES_'.$room_id,$room); 
										  $msg_data['zhuang'] =$zhuang;
										  $msg_data['zhuangPosition'] =$zhuangPosition;
									} 
									
									$socket->send($msg_data,'user_room_all');							  
									return false;
					       }
					      /*=================================================游戏流局完成=====================================================================*/	
						  $touchCard =array_shift($room['cards_init']);
						  
						  $nextCard = 	$room['cards'][$nextUid];
						  
						  $room['cards'][$nextUid][] = 	$touchCard;
						  
						  $room['touchCard'][$nextUid]=$touchCard; 
						  
						  $cheakCards=$room['cards'][$nextUid];
						  $checkMJ=array('MJ5'=>$room['Mj34'][$nextUid]['MJ5'],'MJ4'=>$room['Mj34'][$nextUid]['MJ4'],'MJ3'=>$room['Mj34'][$nextUid]['MJ3']);
						  $huaCard = $room['hua'];
						  
						  if($room['draw'][$nextUid])
						  {
								$checkHu = checkHu($cheakCards,$checkMJ,$huaCard);	
								if($checkHu) $room['winCard'][$nextUid] = $touchCard;						  
						  }
						  else
						  {
								$drawCards=drawCards($cheakCards,$checkMJ,$huaCard);					  
						  }
			              
						  
						  
						  $MJ5=checkCard5($room['cards'][$nextUid]);
						  $MJ3 = $room['Mj34'][$nextUid]['MJ3'];
						  $MJ4 = checkMj3Val($room['cards'][$nextUid],$MJ3);
						  
						  
						  $MJ5=$MJ5?$MJ5:array();
						  $MJ4=$MJ4?$MJ4:array();
						  						  
						  $MJ= array_merge($MJ5, $MJ4);	
						  	  
					  }

					  $msg_data['action']="game_discard";
					  $msg_data['cardsNum']=count($room['cards_init']);
					  $msg_data['position']=$roomUser[$uid]['position'];
					  
					  if($room['drawDiscard'])
					  {
						   unset($room['drawDiscard']);
						   $msg_data['discardCard']="N";
						   $room['discardCards'][$uid][] = "N";
					  } 
					  else
					  {
						  $msg_data['discardCard']=$card;
						  $room['discardCards'][$uid][] = $card;
					  }
					  					  
					  foreach($roomUser as $k=>$v)
					  {
						 unset($msg_data['cards']);
						 unset($msg_data['touchCard']);
						 unset($msg_data['MJ']);
						 unset($msg_data['win']);
						 unset($msg_data['draw']);
						 if($uid==$k) $msg_data['cards']=$room['cards'][$k];//如果当前完成 输出牌堆列表
						 
						 if($MJUID && $MJTYPE)
						 {
							 $msg_data['mjType'] = $MJUID == $k ? $MJTYPE : "N";//判断是否有杠 碰
						 }
						 else
						 {
                             if($nextUid == $k)
							 {
								 $msg_data['touchCard']=$touchCard;
								 
								 if($room['draw'][$k])
								 {
									 $msg_data['isDraw']=1;
									 $msg_data['win']=$checkHu;
								 }
								 else
								 {
									 $msg_data['draw']=$drawCards;	
								 }
								 
								 $countMJ = count($MJ);
								 if($countMJ > 0)
								 {
									  if(!$room['draw'][$k] || ($room['draw'][$k] && $countMJ > 1 ) || checkCondition($cheakCards)) $msg_data['MJ']=$MJ;
								 }
							 }						 
						 }
						 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
					  }
					  $room['status']=3;
					  S('GAMES_'.$room_id,$room);
				      break;
				  case "game_MJ";//杠
				      $card=$data['card'];
					  $cards = $room['cards'][$uid];
					  $MJ3 = $room['Mj34'][$uid]['MJ3'];
					  if($card) //自己牌中的杠
					  {
						   $check=checkCardVal($cards,$card);//暗杠
						   if($check)//暗杠
						   {
							    $room['Mj34'][$uid]['MJ5'][]=$card; 
								$room['cards'][$uid]=delArrayVal($cards,$card,4);
						   }
						   else if(in_array($card,$MJ3) && in_array($card,$cards))
						   {
							    $room['Mj34'][$uid]['MJ4'][]=$card;
								$room['Mj34'][$uid]['MJ3']=delArrayVal($MJ3,$card,1);
								$room['cards'][$uid]=delArrayVal($cards,$card,1); 
						   }
					  }
					  else //打出来的杠
					  {
						   $card=$room['pre_card'];//上一个出牌玩家出的
						   $check=checkCardVal($cards,$card,3);
						   
						   if($check)
						   {
							   $room['Mj34'][$uid]['MJ4'][]=$card; 
							   $room['cards'][$uid]=delArrayVal($cards,$card,3);
							   $msg_data['prePosition'] = $room['pre'];
						   }
					  }
					  
                      /*=================================================游戏流局开始=====================================================================*/
					  if(count($room['cards_init']) == 0)
					  {
						      $game_gang = false;//是否有杠
							  $msg_data['action']="game_dogfall";
							  $msg_data['position'] = $roomUser[$uid]['position'];
							  $msg_data['data']['zhuang_uid']=$zhuang; 
							  
							  $msg_data['data']['game_num']=$room['game_num']?$room['game_num']:1;
							  $msg_data['data']['game_num_total']=$room['game_num_total']?$room['game_num_total']:1;
							  
							  foreach($roomUser as $k => $v)
							  {
								   $dogfallUser[$k]['headpath'] = $v['headpath'];
								   $dogfallUser[$k]['nickname'] = $v['nickname'];
								   $dogfallUser[$k]['point'] = 0;
								   $dogfallUser[$k]['win'] = 0;
								   
								   $cards[$k]['cards']=$room['cards'][$k];
								   $cards[$k]['MJ']['MJ3']=$room['Mj34'][$k]['MJ3'] ? $room['Mj34'][$k]['MJ3'] : array();
								   $cards[$k]['MJ']['MJ4']=$room['Mj34'][$k]['MJ4'] ? $room['Mj34'][$k]['MJ4'] : array();
								   $cards[$k]['MJ']['MJ5']=$room['Mj34'][$k]['MJ5'] ? $room['Mj34'][$k]['MJ5'] : array(); 
								   
								   if($room['Mj34'][$k]['MJ5'] || $room['Mj34'][$k]['MJ4']) $game_gang = true;
							  }
							  
							  $msg_data['data']['cards'] = $cards;
							  $msg_data['data']['user'] = $dogfallUser;
							  
                              $room['game_num'] = $room['game_num'] + 1;
							  
							  if($room['game_num'] > $room['game_num_total'])//本场游戏完成
							  {
								    unset($room['MJAIGN']);
									dissolve($room_id);
									S('GAMES_'.$room_id,NULL);
							  }
							  else
							  {
								    $room['discardCards']=array();
								    $room['touchCard'] = array();
								    $room['Mj34'] = array();
								    $room['cards']=array();
									$room['draw']=array();
									$room['winCard']=array();
									$room['pre']=null;//上一个出牌玩家位置
					                $room['pre_card']=null;//上一个出牌玩家出的
									$room['status'] =0;
									
									$zhuangPosition = $roomUser[$zhuang]['position'];
									
									if($game_gang) 
									{ 
									    $zhuangPosition = $zhuangPosition >= $ROOMNUM ? 1 : $zhuangPosition+1;
									    $zhuang = $room['P'][$zhuangPosition];
										$room['zhuang'] = $zhuang;
									}
									S('GAMES_'.$room_id,$room); 
									$msg_data['zhuang'] =$zhuang;
									$msg_data['zhuangPosition'] =$zhuangPosition;
							  } 
							  
							  $socket->send($msg_data,'user_room_all');							  
							  return false;
					  }
					  /*=================================================游戏流局完成=====================================================================*/					  
					  
					  $touchCard=array_pop($room['cards_init']);
					  $room['touchCard'][$uid]=$touchCard;
					  /*========================判断摸牌后是否要听牌或者胡牌 或者是否还有杠=========================================*/
					  $cheakCards=$room['cards'][$uid];
					  $cheakCards[] = $touchCard;
					  $checkMJ=array('MJ5'=>$room['Mj34'][$uid]['MJ5'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ3'=>$room['Mj34'][$uid]['MJ3']);
					  $huaCard = $room['hua'];
					  
					  if($room['draw'][$uid])
					  {
							$checkHu = checkHu($cheakCards,$checkMJ,$huaCard);	
							if($checkHu) $room['winCard'][$uid] = $touchCard;								  
					  }
					  else
					  {
							$drawCards=drawCards($cheakCards,$checkMJ,$huaCard);						  
					  }
					  /*判断是否还有杠*/
					  $MJ5=checkCard5($cheakCards);	
					  $MJ3 = $room['Mj34'][$uid]['MJ3'];
					  $MJ4 = checkMj3Val($cheakCards,$MJ3);
					  
					  $MJ5=$MJ5?$MJ5:array();
					  $MJ4=$MJ4?$MJ4:array();
					  
					  $MJ= array_merge($MJ5, $MJ4);
					  /*======================判断摸牌后是否要听牌或者胡牌 或者是否还有杠完成=======================================*/
					  
					  $msg_data['action']="game_show_cards";
					  $msg_data['opType'] = 1;
					  $msg_data['cards']=array('MJ3'=>$room['Mj34'][$uid]['MJ3'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ5'=>$room['Mj34'][$uid]['MJ5']);
					  $msg_data['position'] = $roomUser[$uid]['position'];
					  $msg_data['cardsNum']=count($room['cards_init']);
					  
					  foreach($roomUser as $k=>$v)
					  {
						   unset($msg_data['cards']['cards']);
						   unset($msg_data['touchCard']);
						   unset($msg_data['win']);
						   unset($msg_data['draw']);
						   unset($msg_data['isDraw']);
						   unset($msg_data['MJ']);
						   
						   if($uid==$k)
						   {
							   if($room['draw'][$k])  $msg_data['isDraw']=1;
							   $msg_data['cards']['cards']=$room['cards'][$uid];
							   $msg_data['touchCard'] = $touchCard;
							   $msg_data['draw']=$drawCards;
							   $msg_data['win']=$checkHu;
							   if(count($MJ) > 0) $msg_data['MJ']=$MJ;
						   }
						   $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
					  }
					  
					  $room['cards'][$uid][]=$touchCard;
					  S('GAMES_'.$room_id,$room);  
				      break;
				  case "game_MJ3";//碰
					  if($room['draw'][$uid]) return false;
				      $card=$room['pre_card'];
					  $cards = $room['cards'][$uid];
					  $check=checkCardVal($cards,$card,2);
					  
					  if(!$check) return false;

					  $room['Mj34'][$uid]['MJ3'][]=$card; 
					  $room['cards'][$uid]=delArrayVal($cards,$card,2);
					  
                      /*====================================碰后检查是否可以听牌===================================================*/
					  $cheakCards=$room['cards'][$uid];
					  $checkMJ=array('MJ5'=>$room['Mj34'][$uid]['MJ5'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ3'=>$room['Mj34'][$uid]['MJ3']);
					  $huaCard = $room['hua'];						    
					  $drawCards=drawCards($cheakCards,$checkMJ,$huaCard);						  
		             /*====================================碰后检查是否可以听牌完成===================================================*/
					  
					  $msg_data['action']="game_show_cards";
					  $msg_data['opType'] = 2;
					  $msg_data['cards']=array('MJ3'=>$room['Mj34'][$uid]['MJ3'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ5'=>$room['Mj34'][$uid]['MJ5']);
					  $msg_data['position'] = $roomUser[$uid]['position'];
					  $msg_data['prePosition'] = $room['pre'];
					  
					  foreach($roomUser as $k=>$v)
					  {
						   unset($msg_data['cards']['cards']);
						   unset($msg_data['draw']);
						   if($uid==$k)
						   {
							   $msg_data['draw']=$drawCards;
							   $msg_data['cards']['cards']=$room['cards'][$uid];
						   }
						   $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
					  }
					  S('GAMES_'.$room_id,$room);
				      break;
				  case "game_draw";//听牌
					  $msg_data['action']="game_draw";
					  $cheakCards=$room['cards'][$uid];
					  $checkMJ=array('MJ3'=>$room['Mj34'][$uid]['MJ3'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ5'=>$room['Mj34'][$uid]['MJ5']);
					  $msg_data['position'] = $roomUser[$uid]['position'];
					  $huaCard = $room['hua'];
					  $drawCards=drawCards($cheakCards,$checkMJ,$huaCard);	
                      if($drawCards)
					  {
						  $room['draw'][$uid] = 1;
						  $msg_data['draw'] = $drawCards;
						  $msg_data['cards']=$room['cards'][$uid];
						  $socket->send($msg_data,'user_prompt');
						  $room['drawDiscard'] = 1;
						  S('GAMES_'.$room_id,$room);
					  } 
					  unset($msg_data);
					  
					  $msg_data['position'] = $roomUser[$uid]['position'];
					  $msg_data['action']="game_draw_prompt";
					  $socket->send($msg_data,'user_room_all');
				      break;
				  case 'game_pass'://过
				      unset($room['MJAIGN']);
					  $prePosition=$room['pre'];//上一个出牌玩家位置
					  $discardCard=$room['pre_card'];//上一个出牌玩家出的牌
					  
					  $currentPosition=$prePosition >= $ROOMNUM ? 1 : $prePosition + 1;
					  $currentUid = $room['P'][$currentPosition];	
					  /*=================================================游戏流局开始=====================================================================*/
					  if(count($room['cards_init']) == 0)
					  {
						      $game_gang = false;//是否有杠
							  $msg_data['action']="game_dogfall";
							  $msg_data['position'] = $roomUser[$uid]['position'];
							  $msg_data['data']['zhuang_uid']=$zhuang; 
							  
							  $msg_data['data']['game_num']=$room['game_num']?$room['game_num']:1;
							  $msg_data['data']['game_num_total']=$room['game_num_total']?$room['game_num_total']:1;
							  
							  foreach($roomUser as $k => $v)
							  {
								   $dogfallUser[$k]['headpath'] = $v['headpath'];
								   $dogfallUser[$k]['nickname'] = $v['nickname'];
								   $dogfallUser[$k]['point'] = 0;
								   $dogfallUser[$k]['win'] = 0;
								   
								   $cards[$k]['cards']=$room['cards'][$k];
								   $cards[$k]['MJ']['MJ3']=$room['Mj34'][$k]['MJ3'] ? $room['Mj34'][$k]['MJ3'] : array();
								   $cards[$k]['MJ']['MJ4']=$room['Mj34'][$k]['MJ4'] ? $room['Mj34'][$k]['MJ4'] : array();
								   $cards[$k]['MJ']['MJ5']=$room['Mj34'][$k]['MJ5'] ? $room['Mj34'][$k]['MJ5'] : array(); 
								   
								   if($room['Mj34'][$k]['MJ5'] || $room['Mj34'][$k]['MJ4']) $game_gang = true;
							  }
							  
							  $msg_data['data']['cards'] = $cards;
							  $msg_data['data']['user'] = $dogfallUser;
							  
                              $room['game_num'] = $room['game_num'] + 1;
							  
							  if($room['game_num'] > $room['game_num_total'])//本场游戏完成
							  {
								    unset($room['MJAIGN']);
									dissolve($room_id);
									S('GAMES_'.$room_id,NULL);
							  }
							  else
							  {
								    $room['discardCards']=array();
								    $room['touchCard'] = array();
								    $room['Mj34'] = array();
								    $room['cards']=array();
									$room['draw']=array();
									$room['winCard']=array();
									$room['pre']=null;//上一个出牌玩家位置
					                $room['pre_card']=null;//上一个出牌玩家出的
									$room['status'] =0;
									
									$zhuangPosition = $roomUser[$zhuang]['position'];
									
									if($game_gang) 
									{ 
									    $zhuangPosition = $zhuangPosition >= $ROOMNUM ? 1 : $zhuangPosition+1;
									    $zhuang = $room['P'][$zhuangPosition];
										$room['zhuang'] = $zhuang;
									}
									S('GAMES_'.$room_id,$room); 
									$msg_data['zhuang'] =$zhuang;
									$msg_data['zhuangPosition'] =$zhuangPosition;
							  } 
							  
							  $socket->send($msg_data,'user_room_all');							  
							  return false;
					  }
					  /*=================================================游戏流局完成=====================================================================*/
					  $touchCard =array_shift($room['cards_init']);
					  $room['touchCard'][$currentUid]=$touchCard;
					  
					  $Cards = 	$room['cards'][$currentUid];
					  
					  $room['cards'][$currentUid][] = 	$touchCard;
					  
					  $MJ5=checkCard5($room['cards'][$currentUid]);
					  
					  $MJ3 = $room['Mj34'][$currentUid]['MJ3'];
					  $MJ4 = checkMj3Val($Cards,$MJ3);
					  
					  $MJ5=$MJ5?$MJ5:array();
					  $MJ4=$MJ4?$MJ4:array();
											  
					  $MJ= array_merge($MJ5, $MJ4);		  
                      
					  $cheakCards=$room['cards'][$currentUid];
					  $checkMJ=array('MJ5'=>$room['Mj34'][$currentUid]['MJ5'],'MJ4'=>$room['Mj34'][$currentUid]['MJ4'],'MJ3'=>$room['Mj34'][$currentUid]['MJ3']);
					  $huaCard = $room['hua'];
					  
					  if($room['draw'][$currentUid])
					  {
							$checkHu = checkHu($cheakCards,$checkMJ,$huaCard);	
							if($checkHu) $room['winCard'][$currentUid] = $touchCard;						  
					  }
					  else
					  {
							$drawCards=drawCards($cheakCards,$checkMJ,$huaCard);					  
					  }					  
					  

					  $msg_data['action']="game_pass";
					  $msg_data['position']=$currentPosition;
					  $msg_data['cardsNum']=count($room['cards_init']);
					  					  
					  foreach($roomUser as $k=>$v)
					  {
						   unset($msg_data['touchCard']);
						   unset($msg_data['cards']);
						   unset($msg_data['win']);
						   unset($msg_data['draw']);
						   unset($msg_data['draw']);
						   if($currentUid == $k)
						   {
							   if($room['draw'][$k]) $msg_data['isDraw'] = 1;
							   $msg_data['touchCard']=$touchCard;
							   $msg_data['cards']=$Cards;
							   $msg_data['win']=$checkHu;
							   $msg_data['draw']=$drawCards;
							   
							   if(count($MJ) > 0)
							   {
									$msg_data['MJ']=$MJ;
							   }
						   }						 
						 $socket->send($msg_data,$type='by_uid',$key=0,$to_key=$k,$room_id);
					  }					  
					  S('GAMES_'.$room_id,$room);
				      break;
				case 'game_win'://胡牌
				      $userRecord=array();//入记录的用户变量
					  $winUsers =array(); //本局游戏完成，显示玩家信息
					  
				      $winCard = $room['winCard'][$uid]?$room['winCard'][$uid]:0;
					  $cheakCards=$room['cards'][$uid];
					  $checkMJ=array('MJ5'=>$room['Mj34'][$uid]['MJ5'],'MJ4'=>$room['Mj34'][$uid]['MJ4'],'MJ3'=>$room['Mj34'][$uid]['MJ3']);
					  $huaCard = $room['hua'];
					  
					  $checkHu = checkHu($cheakCards,$checkMJ,$huaCard);

					  if($room['draw'][$uid] && $checkHu)
					  {
						      $originPoint = $winCard > 40 ? 3 : 1 ;//起庄分
							  $winPoint = $checkHu['p'];
							  
							  foreach($roomUser as $k=>$v)
							  {		
							       $room['accumulator_num'][$k] = $room['accumulator_num'][$k] ? $room['accumulator_num'][$k] : 0 ;//连胜局数 
								   if($uid == $k)
								   {
									   $zhuangPoint = ($uid == $zhuang)  ? 3 : 1;
									   $userWinPoint = ($originPoint + $winPoint) * 3 + $zhuangPoint;
									   $roomUser[$k]['point'] = $roomUser[$k]['point'] + $userWinPoint;
									   $winUsers[$k]['win'] = $winCard;
							           $room['accumulator_num'][$k]=$room['accumulator_num'][$k]+1;
									   
									   $userRecord['accumulator_num'] = $room['accumulator_num'][$k];
								   }
								   else
								   {
									   $zhuangPoint = ($uid == $zhuang || $k == $zhuang) ? 1 : 0;
									   $userWinPoint = -($originPoint + $winPoint + $zhuangPoint);
									   $roomUser[$k]['point'] = $roomUser[$k]['point'] + $userWinPoint;
									   $winUsers[$k]['win'] = 0;
									   $room['accumulator_num'][$k]=0;
									   $userRecord['accumulator_num'] = 0;
								   }
								   
								   $winUsers[$k]['headpath'] = $v['headpath'];
								   $winUsers[$k]['nickname'] = $v['nickname'];
								   $winUsers[$k]['point'] = $userWinPoint;
								   
								   $userRecord['user_id'] = $k;
								   $userRecord['room_id'] = $room_id;
								   $userRecord['point'] =  $roomUser[$k]['point'];
								   $userRecord['nickname'] =  $roomUser[$k]['nickname'];
								   $userRecord['headpath'] =  $roomUser[$k]['headpath'];
								   $userRecord['position'] =  $roomUser[$k]['position'];
								   
								   $point_p = $roomUser[$k]['position'];
								   $msg_data['point'][$point_p] = $roomUser[$k]['point'];
								   $msg_data['data']['cards'][$k]['cards']=$room['cards'][$k];
								   $msg_data['data']['cards'][$k]['MJ']['MJ3']=$room['Mj34'][$k]['MJ3'] ? $room['Mj34'][$k]['MJ3'] : array();
								   $msg_data['data']['cards'][$k]['MJ']['MJ4']=$room['Mj34'][$k]['MJ4'] ? $room['Mj34'][$k]['MJ4'] : array();
								   $msg_data['data']['cards'][$k]['MJ']['MJ5']=$room['Mj34'][$k]['MJ5'] ? $room['Mj34'][$k]['MJ5'] : array();
								   game_record($userRecord);
							  }	
							  
							  $msg_data['action']='game_win'; 
							  $msg_data['position'] = $roomUser[$uid]['position'];
							  $msg_data['data']['zhuang_uid']=$zhuang; 
							  $msg_data['data']['user']=$winUsers;
							  
							  $msg_data['data']['game_num']=$room['game_num']?$room['game_num']:1;
							  $msg_data['data']['game_num_total']=$room['game_num_total']?$room['game_num_total']:1;
							  
							  
							  $room['game_num'] = $room['game_num'] + 1;
							 
							  if($room['game_num'] > $room['game_num_total'])//本场游戏完成
							  {
								    unset($room['MJAIGN']);
									dissolve($room_id);
									S('GAMES_'.$room_id,NULL);
							  }
							  else
							  {
								    $room['discardCards']=array();
								    $room['touchCard'] = array();
								    $room['Mj34'] = array();
								    $room['cards']=array();
									$room['draw']=array();
									$room['winCard']=array();
									$room['pre']=null;//上一个出牌玩家位置
					                $room['pre_card']=null;//上一个出牌玩家出的
									$room['status'] =0;
									
									$zhuangPosition = $roomUser[$zhuang]['position'];
									if($zhuang != $uid) 
									{ 
									    $zhuangPosition = $zhuangPosition >= $ROOMNUM ? 1 : $zhuangPosition+1;
									    $zhuang = $room['P'][$zhuangPosition];
										$room['zhuang'] = $zhuang;
									}
									
									$room['users'] = $roomUser;
									S('GAMES_'.$room_id,$room); 
									$msg_data['zhuang'] =$zhuang;
									$msg_data['zhuangPosition'] =$zhuangPosition;
							  } 
							  
							  $socket->send($msg_data,'user_room_all');							  
					  }       
				      break;
				case 'game_gains'://查看总战绩
				      $userRecord=array();

					  $games_num_record=M("games_num_record");
					  $game_info=$games_num_record->where(array('room_id'=>$room_id))->order('point desc')->select();
					  $countGame = count($game_info);
					  foreach($game_info as $k=>$v)
					  {		
					       $userId = $v['user_id'];
						   $position = $v['position'];
						   $userRecord[$position]['userid'] = $userId;
						   $userRecord[$position]['headpath'] = $v['headpath'];
						   $userRecord[$position]['nickname'] = $v['nickname'];
						   $userRecord[$position]['point'] = $v['point'];
						   $userRecord[$position]['accumulator_num'] = $v['accumulator_num'];
						   $userRecord[$position]['success_num'] = $v['success_num'];
						   
						   if($k == 0) $userRecord[$position]['win'] = 1;//大赢家
						   if($k == ($countGame - 1)) $userRecord[$position]['win'] = 2;//土豪
					  }	
					  sort($userRecord);
					  
                      $games_room=M("games_room");
					  $gameRoom=$games_room->where(array('id'=>$room_id))->find();
                      
					  $msg_data['action']='game_gains'; 
					  $msg_data['data']['start_uid']=$gameRoom['start_uid']; 
					  $msg_data['data']['user']=$userRecord;
					  $msg_data['data']['uid']=$uid;
					  $msg_data['data']['room']=array('game_type'=>$gameRoom['game_type'],'payment_method'=>$gameRoom['payment_method'],'game_num_total'=>$gameRoom['game_num']);
					  $socket->send($msg_data,'user_prompt');							  
				      S('GAMES_'.$room_id,$room);            
				      break;
				case 'game_dissolve'://解散游戏
					  $status=$data['status'];
                      $msg_data['action']="game_dissolve";				  
					  if($status==0)//点击了拒绝解散房间 
					  {
						   unset($room['dissolve']);
						   $msg_data['users']['status']=0;
						   $msg_data['users']['id']=$uid;
						   $msg_data['users']['nickname']=$roomUser[$uid]['nickname'];
						   $msg_data['status']=0;
						   $socket->send($msg_data,'user_room_all');						   
					  }
					  else if($status==1)//同意解散房间
					  {
						   $room['dissolve']['user'][$uid]=1;
						   $msg_data['users']['status']=1;
						   $msg_data['users']['id']=$uid;
						   
						   if(count($room['dissolve']['user'])>=count($roomUser))//所有人都同意解散房间
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
						    $socket->send($msg_data,'user_prompt'); 
					  } 
					  else if($status==3)//发起解散房间
					  {
						    if($room['dissolve']) return false;
                            
							if(!$room)
							{
                                  $msg_data['status']=5;
					              $socket->send($msg_data,'user_prompt');
								  return false;								
							}
							
							if($room['start_uid'] == $uid && !$room['status'] && $room['game_num'] == 1)
							{
								  dissolve($room_id);
								  $msg_data['status']=6;
							      $socket->send($msg_data,'user_room_all');
							}
							else
							{
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
					  }
					  
					  S('GAMES_'.$room_id,$room);
				      break;
				case 'game_back'://解散游戏
                      if($room['game_num']<=1 && !$room['status'])
					  {
						   $msg_data['action']="game_back";
						   if($uid !=$room['start_uid'])
						   {
							   $msg_data['position']=back($uid,$room_id);
						   } 
						   else
						   {
							   $msg_data['position']=$roomUser[$uid]['position'];
						   }
						   $socket->send($msg_data,'user_room_all');						   
					  }
					  else
					  {
						  $msg_data['action']="game_back";
					      $socket->send($msg_data,'user_prompt');
					  }

				      break;
				case 'game_message'://解散游戏
					  $msg_data['action']="game_message";
					  $msg_data['message']=$data['message'];
					  $msg_data['mType']=$data['mType'];
					  $msg_data['path']=$data['path'];
					  $msg_data['position']=$roomUser[$uid]['position'];
					  $socket->send($msg_data,'user_room_all'); 
				      break;
				default:			   
		  }

	 }
	 	
	 function onSetBefore($key,$room_user_count,$data,$socket)
	 {
	     $room_id=$data['room_id'];
		 $uid=$data['uid'];
		 $room=S('GAMES_'.$room_id);
		 
		 if(!$room)
		 {
				$msg_data['action']='not_room';//没有找到此用户
				$socket->send($msg_data,'user_prompt');
				return false;			 
		 }
		 
		 $roomUser=$room['users'];
		 if(!$roomUser[$uid] && count($roomUser) >= 4)
		 {
				$msg_data['action']='room_full';//房间已满
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
	 $gameRoom = M('games_room')->where(array('id'=>$room_id))->find();
	 $room = S('GAMES_'.$room_id);
	 if(!$room && $gameRoom['game_status']) return false;
	 
	 $roomUser=$room['users'];
	 $start_uid = $room['start_uid'];
	 $payment_method = $room['payment_method'];
	 $payment_type = $payment_method['type']?$payment_method['type']:0;
	 $point_type = $payment_method['point_type']?$payment_method['point_type']:"money";
	 $point = $payment_method['point'];
	 
	 
	 if($point && $room['game_num'] > 1)
	 {
		   if($payment_type == 0)
		   {
			    account($start_uid,$coin=array($point_type=>-$point),$operation_type=1,$business_type=5,$operation_user='SYSTEM',$msg='房间号：'.$room['room_sn']."消费,房主支付",$is_operation=1);
		   }
		   else if($payment_type == 1)
		   {
			    foreach($roomUser as $k=>$v)
				{
					account($v['userid'],$coin=array($point_type=>-$point),$operation_type=1,$business_type=5,$operation_user='SYSTEM',$msg='房间号：'.$room['room_sn']."消费，均摊支付",$is_operation=1);
				}
		   }
		   else if($payment_type == 2)//大赢家
		   {
			    $user = M('games_num_record')->where(array('room_id'=>$room_id))->order('point desc')->find();
				if($user)
				{
					 account($user['user_id'],$coin=array($point_type=>-$point),$operation_type=1,$business_type=5,$operation_user='SYSTEM',$msg='房间号：'.$room['room_sn']."消费，大赢家支付",$is_operation=1);
				}
		   }
	 }
	 
	 S('GAMES_'.$room_id,NULL);
	 M('games_room_user')->where(array('roomid'=>$room_id))->delete();
	 M('games_room')->where(array('id'=>$room_id))->setField('game_status',2);
	 return true;
}

function back($uid,$room_id)
{
	 if(!$uid) return false;
	 $room=S('GAMES_'.$room_id);
	 $position=$room['users'][$uid]['position'];
	 unset($room['P'][$position]);
	 unset($room['users'][$uid]);
	 
     S('GAMES_'.$room_id,$room);	 
	 M('games_room_user')->where(array('userid'=>$uid))->delete();

	 return $position;
}


function checkCard5($cards)//检查当前牌是否有暗杠
{
	sort($cards);
	$returnData=array();
	$cardsNum=count($cards);
	
	for($i=0;$i<$cardsNum;$i++)
	{
		if($cards[$i+3] && $cards[$i]==$cards[$i+3])
		{
			 $returnData[]=$cards[$i];
			 $i=$i+3;
		}
	}
	return $returnData;	  
}

function checkCardVal($cards,$card,$num=4)//检查当前牌中是否有4张特定的牌
{
	$countVal=array_count_values($cards);
	
	if($countVal[$card]>=$num) return true;
	   
}
//检查牌中是否有已经碰过的牌
function checkMj3Val($cards,$mj3)
{
	 if(!$mj3) return false;
	 
	 foreach($mj3 as $k => $v)
	 {
		  if(checkCardVal($cards,$v,1))
		  {
			  $returnDate[] = $v;
		  }
	 }
	 
	 return $returnDate;
}
function Acard($cards,$type)
{
	   sort($cards);
	   $cardType=array_count_values($cards);
	   $returnData=array();
	   switch ($type)
	   {
			case 'AAAA'://信息
				  foreach($cardType as $k =>$v)
				  {	
						if($v >= 4) $returnData[]=$k;					     
				  }
				  break;
			case 'AAA'://信息
				  foreach($cardType as $k =>$v)
				  {	
						if($v >= 3) $returnData[]=$k;					     
				  }
				  break;
			case 'AA'://信息
				  foreach($cardType as $k =>$v)
				  {	
						if($v >= 2) $returnData[]=$k;					     
				  }
				  break;
			case 'A'://信息
				  foreach($cardType as $k =>$v)
				  {	
						if($v >= 1) $returnData[]=$k;					     
				  }
				  break;
			default:
	   }
	   
	   return $returnData;
}

function cardsArray($cards)
{
	 sort($cards);
	 $cardType=array_count_values($cards);
	 $returnData=array();
	
	foreach($cardType as $k =>$v)
	{
		if($v == 4)
		{
			 $returnData["AAAA"]=$k;
			 continue;
		}
		else if($v == 3)
		{
			 $returnData["AAA"]=$cards[$i];
			 continue;		
		}
		else if($v == 2)
		{
			 $returnData["AA"]=$cards[$i];
			 continue;			
		}
		else
		{
			$returnData['A'][]=$cards[$i];
		}
	}
	return $returnData;
}

function getCardsType($cards)
{
	sort($cards);
	$cardsLen=count($cards);
	$cardArray=array();
	for($i=0;$i<$cardsLen;$i++)
	{
		 if($cards[$i]>40)
		 {
			 $cardArray['z'][]=$cards[$i];
		 }
		 else if($cards[$i]>30)
		 {
			 $cardArray['f'][]=$cards[$i];
		 }
		 else if($cards[$i]>20)
		 {
			 $cardArray['b'][]=$cards[$i];
		 }
		 else if($cards[$i]>10)
		 {
			 $cardArray['t'][]=$cards[$i];
		 }
		 else
		 {
			 $cardArray['w'][]=$cards[$i];
		 }
	}
	
	return $cardArray;
}





//判断胡牌
function checkHu($cards,$MJ,$huaCard)
{
	  $returnDate =null;
	  if(isHu13($cards))
	  {
		 $returnDate['p'] = 4;
		 return $returnDate;
	  }

	  if(isHu7($cards))
	  {
		 $returnDate['p'] = 3;
		 return $returnDate;		  
	  }

	  if($huaCard)//有花
	  {
		     if(!checkCondition($cards,$MJ)) return false;
			 $arrayHua=getHua($cards,$MJ);
			 $cardsCoyp = $cards;
			 if(count($arrayHua['MJ'])>0)
			 {
				   foreach($arrayHua['MJ'] as $v)
				   {
					    $cards=  $cardsCoyp; 
						$cards = delArrayVal($cards,$v);
						$cards[] = $huaCard;
						$checkHua = checkHua($cards,1);
					    if($checkHua)
						{
							 if(in_array($v,$arrayHua['MJ5']))
							 {
								 $returnDate['p'] = 4 + $checkHua['ZF'] + count($MJ['MJ5']) * 2 + count($MJ['MJ4']);
							 }
							 else if(in_array($v,$arrayHua['MJ4']))
							 {
								 $returnDate['p'] = 3 + $checkHua['ZF'] + count($MJ['MJ5']) * 2 + count($MJ['MJ4']);
							 }
							 else
							 {
								 $returnDate['p'] = 0;
							 }
							 return $returnDate;
						}
						else
						{
                             $checkHua = checkHua($cardsCoyp); 	
							 if( checkCondition($cardsCoyp) && $checkHua)
							 {
								 $returnDate['p'] = $checkHua['ZF'] + count($MJ['MJ5']) * 2 + count($MJ['MJ4']);
								 return $returnDate;
							 }
							 				
						}
			       }
			 }
			 else
			 {
				   $checkHua = checkHua($cards);
				   if(checkCondition($cards) && $checkHua)
				   {
					     $countZF=countZF($cards);
						 $returnDate['p'] = $checkHua['ZF'] + count($MJ['MJ5']) * 2 + count($MJ['MJ4']);
						 return $returnDate;
				   }
				   else
				   {
					     return  false;
				   }
			 }
				//foreach 1 完成			  
	  }
	  else //没花
	  {
			$Acard=Acard($cards,"AA");
			if(!$Acard || !checkCondition($cards)) return false;
			$cardsCoyp= $cards;
			foreach($Acard as $k => $v)
			{
					$returnDate = array();
					$cards = $cardsCoyp;
					$opCards = delArrayVal($cards,$v,2);//要操作的牌
					$countZF=countZF($opCards);
					
					$AAAcard=Acard($opCards,"AAA");
					foreach($AAAcard as $k => $v)
					{
							$opCards = delArrayVal($opCards,$v,3);
					}
						
                     $CardsType=getCardsType($opCards);
					 $count_z= count($CardsType['z']);
					 $count_f= count($CardsType['f']);
					 $count_w= count($CardsType['w']);
					 $count_t= count($CardsType['t']);
					 $count_b= count($CardsType['b']);
					 
					 if( $count_z % 3 !=0 || ($count_z + $count_f) <=0 || $count_f % 3 !=0 || $count_w % 3 !=0 || $count_t % 3 !=0 || $$count_b % 3 !=0)
					 {
							 continue;
					 }
					 else
					 {
							 $opCardHu = opCardHu($opCards);
							 
							 if(!$opCardHu) continue;

                             
							 $returnDate['type'] = 0;
							 $returnDate['p'] = $opCardHu['ZF'] + count($MJ['MJ5']) * 2 + count($MJ['MJ4']);
							 return $returnDate;
					 } 
			}				  
	  }  
}
// 计算有多少风字
function countZF($cards)
{
	  $data =array();
	  foreach($cards as $v)
	  {
		   if($v > 30) $data[] = $v;
	  }
	  
	  if($data)
	  {
		   $AAAcard=Acard($cards,"AAA");
		   $countAAA = count($AAAcard);
		   if($countAAA>=3)
		   {
			   return $countAAA;
		   }
		   elseif($countAAA > 0)
		   {
			   foreach($AAAcard as $v)
			   {
				   $data = delArrayVal($data,$v,3);
			   }
		   }
		   
		   return intval(count($data) / 3);   
	  }
	  else
	  {
		   return 0;
	  }
}
//移除多余牌
function opCardHu($cards)
{
		 sort($cards);
		 $v0=$cards[0];
		 $v1=$cards[0]+1;
		 $v2=$cards[0]+2;
		 
		 $cardType=array_count_values($cards);
			 
		 if($cardType[$v1] > 0 && $cardType[$v2] > 0)
		 {
			   $cards = delArrayVal($cards,$v0);
			   $cards = delArrayVal($cards,$v1);
			   $cards = delArrayVal($cards,$v2);
		 }
		 else if($v0 == 31 && $cardType[32]>0 && $cardType[33]>0)
		 {
			   $cards = delArrayVal($cards,31);
			   $cards = delArrayVal($cards,32);
			   $cards = delArrayVal($cards,33);		   
		 }
		 else if($v0 == 31 && $cardType[32]==0 && $cardType[33]>0 && $cardType[34]>0)
		 {
			   $cards = delArrayVal($cards,31);
			   $cards = delArrayVal($cards,33);
			   $cards = delArrayVal($cards,34);		   
		 }
		 else if($v0 == 31 && $cardType[32] > 0 && $cardType[33] == 0 && $cardType[34]>0)
		 {
			   $cards = delArrayVal($cards,31);
			   $cards = delArrayVal($cards,32);
			   $cards = delArrayVal($cards,34);		   
		 }
		 else if($cardType[31] == 0 && $cardType[32] > 0 && $cardType[33]>0 && $cardType[34]>0)
		 {
			   $cards = delArrayVal($cards,32);
			   $cards = delArrayVal($cards,33);
			   $cards = delArrayVal($cards,34);		   
		 }
		 else
		 {
			   return false;
		 }
		 
		 if(count($cards) == 0)	
		 { 
			   return true;
		 }
		 else
		 {
			   return  opCardHu($cards);
		 }	 
}
//检测花
function getHua($Cards,$MJ)
{
	  $AAAAcard=Acard($Cards,"AAAA");// 暗花
	  
	  $MJ3 = $MJ['MJ3'];
	  if($MJ3)
	  {
		    foreach($MJ3 as $v)
			{
				 if(in_array($v,$Cards))
				 {
					  $Acard[] = $v;
				 }
			}
	  }
	  
	  $returnDate['MJ4'] = $Acard?$Acard:array();
	  $returnDate['MJ5'] = $AAAAcard?$AAAAcard:array();
	  $returnDate['MJ'] = array_merge($returnDate['MJ5'],$returnDate['MJ4']);
	 
	  return $returnDate; 	  
}

function delArrayVal($array,$val,$times=1)
{
	 $t=0;
	 sort($array);
	 foreach($array as $k=>$v)
	 {
		  if($v == $val)
		  {
			   unset($array[$k]);
			   $t=$t+1;
			   if($times>0 && $t>=$times) return array_values($array);  
		  }
	 }
	 
	 return array_values($array);  
}

function  checkCondition($cards,$MJ)
{
	 if($MJ)
	 {
		   $checkHua = getHua($cards,$MJ);
		   if(count($checkHua['MJ']) > 0)
		   {
			     return true;
		   }
		   else
		   {
				foreach($cards as $v)
				{
					 if($v > 30 && $v　< 40) $F[$v] =1;
					 if($v > 40) $Z[$v] =1;
				}	
				if(count($Z) >=3 || count($F) >=3) return true;				   
		   }
	 }
	 else
	 {
		  foreach($cards as $v)
		  {
			   if($v > 30 && $v　< 40) $F[$v] =1;
			   if($v > 40) $Z[$v] =1;
		  }	
		  
		  if(count($Z) >=3 || count($F) >=3) return true;	 
	 }
	 
	 return false;
}

function checkHua($cards,$hua=0)
{
		 $AAcard=Acard($cards,"AA");
		 if(!$AAcard) return false;
		 $cardsCoyp= $cards;
		 foreach($AAcard as $k => $v)
		 {
				  $returnDate = array();
				  $cards = $cardsCoyp;
				  $opCards = delArrayVal($cards,$v,2);//要操作的牌
				  
				  $countZF=countZF($opCards);//风字的搭子数
				  
				  if(count($opCards)<=0) return array('ZF'=>$countZF);
				  $AAAcard=Acard($opCards,"AAA");
				  foreach($AAAcard as $k => $v)
				  {
					   $opCards = delArrayVal($opCards,$v,3);
				  }
					  
				   $CardsType=getCardsType($opCards);	
				   $count_z= count($CardsType['z']);
				   $count_f= count($CardsType['f']);
				   $count_w= count($CardsType['w']);
				   $count_t= count($CardsType['t']);
				   $count_b= count($CardsType['b']);
				  
				   $countHu = 0; 	
							
				  if( $count_z % 3 != 0 ) $countHu = $countHu + 1;
				  if( $count_f % 3 != 0 ) $countHu = $countHu + 1;
				  if( $count_w % 3 != 0 ) $countHu = $countHu + 1;
				  if( $count_t % 3 != 0 ) $countHu = $countHu + 1;
				  if( $count_b % 3 != 0 ) $countHu = $countHu + 1;

				  if( $countHu > 2 || ( $count_z <=2 && $count_f <=2 && !$hua)  )
				  {
					   continue;
				  }
				  else
				  {
						 $opCardHu = opCardHu($opCards);
						 if(!$opCardHu) continue;
						 return array('ZF'=>$countZF);;
				  } 
		  }	
}

//判断是否听牌
function drawCards($cards,$MJ,$huaCard)
{
	  $cardsCoyp = $cards;
	  $returnDate =is13($cards);
	  if($returnDate) return $returnDate;
	  
	  $returnDate =is7($cards);
	  if($returnDate) return $returnDate;
	  
	  $returnDate =NULL;
	  	  
	  if($huaCard)//有花
	  {
			 $arrayHua=getHua($cards,$MJ);
			 if(count($arrayHua['MJ'])>0)
			 {
				 		  
				   foreach($arrayHua['MJ'] as $v)//遍历花牌
				   {
					    $cards=  $cardsCoyp; 
						$cards =delArrayVal($cards,$v);
						$cards[] = $huaCard;

						/*==================================================听将牌===========================================================*/
						$surplusArray = surplusArray($cards);
						
						if($surplusArray)
						{
							  foreach($surplusArray as $val)
							  {
									 $current =array();
									 if(count($val)== 2)
									 {
										   if(in_array($huaCard,$val) && !checkCondition($cards))
										   {
												$returnDate[] = ($val[0] == $huaCard) ? $val[1] : $val[0];
												$current[] = ($val[0] == $huaCard) ? $val[1] : $val[0];
										   }
										   else
										   {
												$returnDate[] = $val[0];
												$returnDate[] = $val[1];
												
												$current[] = $val[0];
												$current[] = $val[1];
										   }
										   
										  /*=================================================相邻牌换算开始==========================================================*/
										  if($current) 
										  {
												  $cardTypeCount= array_count_values($cards);
												  foreach($current as $currentVal)
												  {
														 if($cardTypeCount[$currentVal+1] == 1 && $cardTypeCount[$currentVal+2] == 1 && ($currentVal+3) % 10 <=9)
														 {
															  $current[] = $currentVal+3;
														 }
														 elseif($cardTypeCount[$currentVal-1] == 1 && $cardTypeCount[$currentVal-2] == 1 && ($currentVal-3) % 10 >= 1 )
														 {
															  $current[] = $currentVal-3;
														 }
												  }							  
										  }
										  $returnDate=array_merge($returnDate,$current);
										  /*=================================================相邻牌换算完成==========================================================*/	
								    }
							  }
						}
						/*==================================================听将牌完成===========================================================*/



                        /*==================================================不听将牌===========================================================*/
						  $cards=  $cardsCoyp; 
						  $cards =delArrayVal($cards,$v);
						  $cards[] = $huaCard;						
						
						  $AAcard=Acard($cards,"AA");
						  $selectCards =$cards;
						 /*=============================================将牌循环操作开始==========================================================*/
						 foreach($AAcard as $AA)
						 {
								 $opCards = $selectCards;// 要操作的牌
								 $opCards=delArrayVal($opCards,$AA,2);
								 
								 $surplusArray = surplusArray($opCards);
								 if($surplusArray)
								 {
									   /*============================================删除多余的牌开始================================================*/
									   foreach($surplusArray  as $val)
									   {
											$current =array();
										   /*===========================判断花牌是否存在剩余的牌中开始==============================*/
											if(in_array($huaCard,$val) && !checkCondition($opCards))
											{
												   $cardTypeVal= array_count_values($val);
												   $F =array();
												   $Z =array();
												   foreach($val as $v)
												   {
													   if($v > 30 && $v < 40) $F[$v] =1;
													   if($v > 40) $Z[$v] =1;
												   }	
												   
										
												   if(count($Z) == 2 || count($F) == 2)
												   {
													    if($val[0] == $val[1])
														{
															$returnDate[] = $val[0];
														}
														elseif($val[1] == $val[2])
														{
															$returnDate[] = $val[2];
														}
														elseif($val[0]<30 || $val[1] > 40)
														{
															$returnDate[] = $val[0];
														}
														elseif($val[1] > 30 && $val[1] < 40)
														{
															 $returnDate[] = $val[2];
														}
												   }

												   $val =delArrayVal($val,$huaCard);
												   
												   $abs = abs($huaCard - $val[0]);
												   if( $abs==0 || $abs ==1 || $abs ==2 )
												   {
														$returnDate[] = $val[1];
														$current[] = $val[1];
												   }
												   
												   $abs = abs($huaCard - $val[1]);
												   if($abs==0 || $abs ==1 || $abs ==2)
												   {
														$returnDate[] = $val[0];
														$current[] = $val[0];
												   }														  
											} 
											else
											{
												   if($val[1] - $val[0] ==0 || $val[1] - $val[0] ==1 || $val[1] - $val[0] ==2 || ($val[0] > 30 && $val[1] - $val[0] ==3))
												   {
														$returnDate[] = $val[2];
														$current[] = $val[2];
												   }
												   
												   if($val[2] - $val[1] ==0 || $val[2] - $val[1] ==1 || $val[2] - $val[1] ==2 || ($val[1] > 30 && $val[2] - $val[1] ==3))
												   {
														$returnDate[] = $val[0];
														$current[] = $val[0];
												   }											  
											}
											/*===========================判断花牌是否存在剩余的牌中完成================================*/
											
											/*=================================================相邻牌换算开始==========================================================*/
											if($current) 
											{
													$cardTypeCount= array_count_values($opCards);
													foreach($current as $currentVal)
													{
														   if($cardTypeCount[$currentVal+1] == 1 && $cardTypeCount[$currentVal+2] == 1 && ($currentVal+3) % 10 <=9)
														   {
																$current[] = $currentVal+3;
														   }
														   elseif($cardTypeCount[$currentVal-1] == 1 && $cardTypeCount[$currentVal-2] == 1 && ($currentVal-3) % 10 >= 1 )
														   {
																$current[] = $currentVal-3;
														   }
													}							  
											}
											$returnDate=array_merge($returnDate,$current);
											/*=================================================相邻牌换算完成==========================================================*/
											
									   }
									   /*============================================删除多余的牌完成================================================*/ 
								 }
						 }
						 /*=============================================将牌循环操作完成==========================================================*/

					    /*==================================================不听将牌完成===========================================================*/

			       }//遍历花牌完成
			 }
			 else //没有花，按照常规听牌操作
			 {
					$cards=  $cardsCoyp; 
					$AAAcard=Acard($cards,"AAA");// 有没有3张一样的牌
                    $MJ['MJ3'] = $MJ['MJ3']?$MJ['MJ3']:array();
	                $AAAcard = $AAAcard?$AAAcard:array();
	                $isMJ['MJ'] = array_merge($AAAcard,$MJ['MJ3']);		
					
					if(count($isMJ) > 0)	
					{
							/*==================================================听将牌===========================================================*/
							$surplusArray = surplusArray($cards);
							if($surplusArray)
							{
								  foreach($surplusArray as $val)
								  {
										 $current =array();
										 if(count($val)== 2)
										 {
											   if(checkCondition($cards))
											   {
                                                    $returnDate[] = $val[0];
													$current[] = $val[0];
													
													$returnDate[] = $val[1];
													$current[] = $val[1];												   
											   }
											   elseif($val[0] == $huaCard)
											   {
												    $returnDate[] = $val[1];
													$current[] = $val[1];
											   }
											   elseif($val[1] == $huaCard)
											   {
													$returnDate[] = $val[0];
													$current[] = $val[0];
											   }
											   
											  /*=================================================相邻牌换算开始==========================================================*/
											  if($current) 
											  {
													  $cardTypeCount= array_count_values($cards);
													  foreach($current as $currentVal)
													  {
															 if($cardTypeCount[$currentVal+1] == 1 && $cardTypeCount[$currentVal+2] == 1 && ($currentVal+3) % 10 <=9)
															 {
																  $current[] = $currentVal+3;
															 }
															 elseif($cardTypeCount[$currentVal-1] == 1 && $cardTypeCount[$currentVal-2] == 1 && ($currentVal-3) % 10 >= 1 )
															 {
																  $current[] = $currentVal-3;
															 }
													  }							  
											  }
											  $returnDate=array_merge($returnDate,$current);
											  /*=================================================相邻牌换算完成==========================================================*/	
										}
								  }
							}
							/*==================================================听将牌完成===========================================================*/

                            /*==================================================不听将牌===========================================================*/
							$cards=  $cardsCoyp; 
							$AAcard = Acard($cards,"AA");// 找将牌
						   /*=============================================将牌循环操作开始==========================================================*/
						   foreach($AAcard as $AA)
						   {
								   $opCards = $cards;// 要操作的牌
								   $opCards=delArrayVal($opCards,$AA,2);
								   
								   $surplusArray = surplusArray($opCards);
								   if($surplusArray)
								   {
										 foreach($surplusArray  as $val)
										 {
											  $current =array();
											 /*===========================判断花牌是否存在剩余的牌中开始==============================*/
											  if(checkCondition($opCards))
											  {
												  
													 if($val[1] - $val[0] ==0 || $val[1] - $val[0] ==1 || $val[1] - $val[0] ==2 || ($val[0] > 30 && $val[1] - $val[0] ==3))
													 {
														  $returnDate[] = $val[2];
														  $current[] = $val[2];
													 }
													 
													 if($val[2] - $val[1] ==0 || $val[2] - $val[1] ==1 || $val[2] - $val[1] ==2 || ($val[1] > 30 && $val[2] - $val[1] ==3))
													 {
														  $returnDate[] = $val[0];
														  $current[] = $val[0];
													 }													  
											  } 
											  else
											  {
													 $cardTypeVal= array_count_values($val);
													 $F =array();
													 $Z =array();
													 foreach($val as $v)
													 {
														 if($v > 30 && $v < 40) $F[$v] =1;
														 if($v > 40) $Z[$v] =1;
													 }	
													 
										  
													 if(count($Z) == 2 || count($F) == 2)
													 {
														  if($val[0] == $val[1])
														  {
														      $returnDate[] = $val[0];
														  }
														  elseif($val[1] == $val[2])
														  {
															  $returnDate[] = $val[2];
														  }
														  if($val[0]<30 || $val[1] > 40)
														  {
															  $returnDate[] = $val[0];
														  }
														  elseif($val[1] > 30 && $val[1] < 40)
														  {
															   $returnDate[] = $val[2];
														  }
													 }
													 
													 $differ = $val[1] - $val[0];
													 $huaAbs = $huaCard - $val[0];
													 if( ($differ==0 && $huaAbs ==0) || ($differ ==1 && ($huaAbs==-1 || $huaAbs==2))  || ($differ ==2 && $huaAbs ==1))
													 {
														  $returnDate[] = $val[2];
														  $current[] = $val[2];
													 }
													 
													 $differ = $val[2] - $val[1];
													 $huaAbs = $huaCard - $val[1];
													 if(($differ==0 && $huaAbs ==0) || ($differ ==1 && ($huaAbs==-1 || $huaAbs==2))  || ($differ ==2 && $huaAbs ==1))
													 {
														  $returnDate[] = $val[0];
														  $current[] = $val[0];
													 }														  
													 										  
											  }
											  /*===========================判断花牌是否存在剩余的牌中完成================================*/
											  
											  /*=================================================相邻牌换算开始==========================================================*/
											  if($current) 
											  {
													  $cardTypeCount= array_count_values($opCards);
													  foreach($current as $currentVal)
													  {
															 if($cardTypeCount[$currentVal+1] == 1 && $cardTypeCount[$currentVal+2] == 1 && ($currentVal+3) % 10 <=9)
															 {
																  $current[] = $currentVal+3;
															 }
															 elseif($cardTypeCount[$currentVal-1] == 1 && $cardTypeCount[$currentVal-2] == 1 && ($currentVal-3) % 10 >= 1 )
															 {
																  $current[] = $currentVal-3;
															 }
													  }							  
											  }
											  $returnDate=array_merge($returnDate,$current);
											  /*=================================================相邻牌换算完成==========================================================*/
											  
										 }
								   }
						   }
						   /*=============================================将牌循环操作完成==========================================================*/
					        /*==================================================不听将牌完成===========================================================*/							
					}
					else
					{
						$returnDate=drawCardsK($cards);
					}		
			 }		  
	  }
	  else //没花
	  {
			$returnDate=drawCardsK($cards);
	  }
	  
	  foreach($returnDate as $k => $v)
	  {
		    if($v % 10 == 0 || ($v > 34 && $v <= 40) || $v > 43) unset($returnDate[$k]);
	  }
	  if($returnDate == 1) return 1;
	  if(count($returnDate)<=0) return false;
	  return array_values(array_unique($returnDate)); 
}

// 没有花听牌
function drawCardsK($cards)
{
	  $returnDate = array();
	  $cardsCoyp = $cards;
	  /*================================================听将牌============================================================*/
	   $surplusArray = surplusArray($cards);

	   if($surplusArray == 1 ) return 1;
	   
	   if($surplusArray && checkCondition($cards))
	   {
			 foreach($surplusArray as $v)
			 {
				  $current =array();
				  if(count($v) == 2)
				  {
						if($v[0] == $v[1])
						{
							 return 1;
						}
						else
						{
							 $returnDate[] = $v[0];
							 $returnDate[] = $v[1];
							 
							 $current[] = $v[0];
							 $current[] = $v[1];
						} 
						
						if($current) 
						{
								$cardTypeCount= array_count_values($cards);
								foreach($current as $val)
								{
									   if($cardTypeCount[$val+1] == 1 && $cardTypeCount[$val+2] == 1 && ($val+3) % 10 <=9)
									   {
											$current[] = $val+3;
									   }
									   elseif($cardTypeCount[$val-1] == 1 && $cardTypeCount[$val-2] == 1 && ($val-3) % 10 >= 1 )
									   {
											$current[] = $val-3;
									   }
								}							  
						}
						
						$returnDate=array_merge($returnDate,$current);
				  }
			 }
	   }
	  /*================================================听将牌完成============================================================*/
	  
	  /*================================================不听将牌============================================================*/
	   $Acard=Acard($cards,"AA");
	   foreach($Acard as $A)
	   {
			$cards = $cardsCoyp;
			$cards = delArrayVal($cards,$A,2);
			
			$F =array();
		    $Z =array();
            foreach($cards as $v)
			{
				 if($v > 30 && $v < 40) $F[$v] =1;
				 if($v > 40) $Z[$v] =1;
			}			
			
			if(count($F) < 2 && count($Z) < 2) return false;
			$surplusArray = surplusArray($cards);
			if($surplusArray == 1 ) return 1;
			$cardsType = getCardsType($cards);
			if($surplusArray)
			{
				  foreach($surplusArray as $v)
				  {
						$current =array();
						if(count($v) == 3) 
						{
								  if(count($F)<3 && count($F)<3)
								  {
										$cardsTypeV = getCardsType($v);
										if(count($cardsTypeV['f'])>=2 || count($cardsTypeV['z'])>=2)
										{
											  
											  if(($v[0] < 30 || $v[1] > 40) && $v[1] != $v[2] )
											  {
												   $returnDate[] = $v[0];
												   $current[] = $v[0];
											  }
											  elseif($v[1] < 40 && $v[0] != $v[1])
											  {
												   $returnDate[] = $v[2];
												   $current[] = $v[2];
											  }
											  elseif($v[0] > 40 && $v[0] != $v[1])
											  {
												   $returnDate[] = $v[2];
												   $current[] = $v[2];
											  }
										}
								  }
								  else//操作剩余牌 ，判断是否能听牌
								  {
										 if($v[1] - $v[0] ==0 || $v[1] - $v[0] ==1 || $v[1] - $v[0] ==2 || ($v[0] > 30 && $v[1] - $v[0] ==3))
										 {
											  $returnDate[] = $v[2];
											  $current[] = $v[2];
										 }
										 
										 if($v[2] - $v[1] ==0 || $v[2] - $v[1] ==1 || $v[2] - $v[1] ==2 || ($v[1] > 30 && $v[2] - $v[1] ==3))
										 {
											  $returnDate[] = $v[0];
											  $current[] = $v[0];
										 }								 
								  }
								  
								  if($current) 
								  {
										  $cardTypeCount= array_count_values($cards);
										  foreach($current as $val)
										  {
												 if($cardTypeCount[$val+1] == 1 && $cardTypeCount[$val+2] == 1 && ($val+3) % 10 <=9 && $val<30)
												 {
													  $current[] = $val+3;
												 }
												 elseif($cardTypeCount[$val-1] == 1 && $cardTypeCount[$val-2] == 1 && ($val-3) % 10 >= 1  && $val<30)
												 {
													  $current[] = $val-3;
												 }
										  }							  
								  }
								  $returnDate=array_merge($returnDate,$current);
						}
	  
				  } 					  
			}
			
	   }
	  /*================================================不听将牌完成============================================================*/
	  if(count($returnDate)<=0) return false;
	  return array_values(array_unique($returnDate)); 
}
function surplusArray($cards)
{
	     sort($cards);
		 $cardsCoyp=$cards;
		 $AAAcard=Acard($cards,"AAA");
		 if($AAAcard)
		 {
			  foreach($AAAcard as $v)
			  {
				  $cards = delArrayVal($cards,$v,3);
			  }
		 }
		 
		 $surplus[0] = opCardDraw($cards);
		 $countSurplus_0 =count($surplus[0]);
		 if($countSurplus_0 <=0 ) return 1;
		 
		 $cards= $cardsCoyp;
		 $surplus[1] = opCardDraw($cards);
		 $AAAcard=Acard($surplus[1],"AAA");
		 if($AAAcard)
		 {
			  foreach($AAAcard as $v)
			  {
				  $surplus[1] = delArrayVal($surplus[1],$v,3);
			  }
		 }
		 $countSurplus_1 =count($surplus[1]);
		 if($countSurplus_1 <= 0)	return 1; 

		 if($countSurplus_0 > 3 && $countSurplus_1 > 3)	return false; 
		 
		 if(!array_diff($surplus[1], $surplus[0]))
		 {
			  unset($surplus[1]);
		 }
		 
		 return $surplus;
}
//移除多余牌
function opCardDraw($cards)
{
		 sort($cards);

		 $surplusCards=array();
		 $lenCards= count($cards);
		 
		 for($i=0;$i < $lenCards;$i++)
		 {
			 if(!$cards) return $surplusCards;
			 
			 $v0=$cards[0];
			 $v1=$cards[0]+1;
			 $v2=$cards[0]+2;
			 
			 $cardType=array_count_values($cards);
			 
			 if($cardType[$v1] > 0 && $cardType[$v2] > 0)
			 {
				   $cards = delArrayVal($cards,$v0);
				   $cards = delArrayVal($cards,$v1);
				   $cards = delArrayVal($cards,$v2);
			 }
			 else if($v0 == 31 && $cardType[32]>0 && $cardType[33]>0)
			 {
				   $cards = delArrayVal($cards,31);
				   $cards = delArrayVal($cards,32);
				   $cards = delArrayVal($cards,33);		   
			 }
			 else if($v0 == 31 && $cardType[32]==0 && $cardType[33]>0 && $cardType[34]>0)
			 {
				   $cards = delArrayVal($cards,31);
				   $cards = delArrayVal($cards,33);
				   $cards = delArrayVal($cards,34);		   
			 }
			 else if($v0 == 31 && $cardType[32] > 0 && $cardType[33] == 0 && $cardType[34]>0)
			 {
				   $cards = delArrayVal($cards,31);
				   $cards = delArrayVal($cards,32);
				   $cards = delArrayVal($cards,34);		   
			 }
			 else if($cardType[31] == 0 && $cardType[32] > 0 && $cardType[33]>0 && $cardType[34]>0)
			 {
				   $cards = delArrayVal($cards,32);
				   $cards = delArrayVal($cards,33);
				   $cards = delArrayVal($cards,34);		   
			 }
			 else
			 {
				   $surplusCards[] = $v0;
				   $cards = delArrayVal($cards,$v0);
			 }			  			  
		 }
		 
		 return $surplusCards;
}


//是否为13幺听牌
function is13($cards)
{
	$cardArray=array(1,9,11,19,21,29,31,32,33,34,41,42,43);
	
	foreach($cardArray as $k=>$v)
	{
		if(in_array($cards,$cardArray[$k]))
		{
			unset($cardArray[$k]);
			$cards = delArrayVal($cards,$v);
		}
	}
	
	if(count($cards) == 2)
	{
		return $cards;
	}  
	else
	{
		return false;
	}
}

//是否为7大对听牌
function is7($cards)
{
	$AAAAcard=Acard($cards,"AAAA");
	$AAcard=Acard($cards,"AA");
	if(count($AAcard) + count($AAAAcard)  < 6) return false;
	
	foreach($AAcard as $v)
	{
		    if(in_array($v,$AAAAcard) )
			{
				$cards = delArrayVal($cards,$v,4);
			}
			else
			{
				$cards = delArrayVal($cards,$v,2);
			}
			
	}
	
	if(count($cards) == 2)
	{
		return $cards;
	}  
	else
	{
		return false;
	}
}
//是否为7大对胡牌
function isHu7($cards)
{
	$AAAAcard=Acard($cards,"AAAA");
	$AAcard=Acard($cards,"AA");
	if(count($AAcard) + count($AAAAcard)  < 7) return false;
	
	foreach($AAcard as $v)
	{
		    if(in_array($v,$AAAAcard) )
			{
				$cards = delArrayVal($cards,$v,4);
			}
			else
			{
				$cards = delArrayVal($cards,$v,2);
			}
	}
	
	if(count($cards) == 0)
	{
		return true;
	}  
	else
	{
		return false;
	}
}
//是否为13幺胡牌
function isHu13($cards)
{
	$cardArray=array(1,9,11,19,21,29,31,32,33,34,41,42,43);
	
	foreach($cardArray as $k=>$v)
	{
		if(!in_array($cards,$cardArray[$k]))
		{
			return false;
		}
	}
	return true;
}

//更新游戏记录
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
			
			if($user['accumulator_num'] > 0)
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
			$data['nickname']=$user['nickname'];
			$data['headpath']=$user['headpath'];
			$data['position']=$user['position'];
			$data['sign']="Minghua";
			if($user['accumulator_num'] > 0)
			{
				$data['success_num']=1;
				$data['accumulator_num']=1;
				
			}
			else
			{
				$data['fail_num']=1;
			}
			$games_num_record->add($data);
	  }	
}
?>