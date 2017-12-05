<?php
namespace Games\Controller;;
use Org\Util\Admin;
class AdminController extends Admin {
	 function __construct()  //析构函数
	 {  
		  parent::__construct();
	 }  
/*=================================================
**游戏列表
==================================================*/
	public function games_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$parentid=I('parentid',0,'intval');
		$where['class_id']=$parentid?$parentid:array('EGT',0);
		$games=M('games');
		//------------------------------------管理员列表----------------------------------------
		$record_count=$games->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$games->where($where)->order('id desc')->page($page,$pagesize)->select();
			foreach($info as $k=>$v){
				$info[$k]['set_path']=is_game_set(T("games_set_".$v['sign']),'games_set_'.$v['sign']);
			}
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------------------管理员列表----------------------------------------
		$this->assign('info',$info);
		$this->display();
	}
/*=================================================
**添加游戏
==================================================*/	
	public function games_add(){
		if(IS_POST)
		{
			$name=I('name');
			$sign=I('sign');
			$classid=I('classid');
			if(!$name) $this->error(L('Games_Err_0'),"",$this->r_time);
			if(!$sign) $this->error(L('Games_Err_1'),"",$this->r_time);
			if(!$classid[0]) $this->error(L('Games_Err_2'),"",$this->r_time);
			
				  $games = M('games');
				  if($games->create())
				  {
					   $games->class_id=linkage_id($classid);
					   if($games->add())  
					   {
						   $this->success(L('Add').L('success'),U('Games/Admin/games_list'),$this->r_time);
					   }
					   else
					   {
						   $this->error(L('ADD').L('ERR'),'',$this->r_time);
					   }
				  }
				  else
				  {
					  $this->error(L('ADD').L('ERR'),'',$this->r_time);
				  }
		}
		else
		{
			$value=$parentid?parents(0,"games_class",array('name','id'),array('text','value')):"";
            $this->assign('class',linkage(get_linkage_datas('games_class',0),"classid",'',0,$value,array('text'=>L('Games_Class_Top'),'value'=>0),"line_4_padding_1"));// 赋值分页输出
			$this->display();
		}
	}
/*=================================================
**编辑游戏
==================================================*/			
	public function games_edit(){
		$id=I('id');
		$games = M('games');
		if(IS_POST)
		{
				  $name=I('name');
				  $sign=I('sign');
				  $classid=I('classid');
				  if(!$name) $this->error(L('Games_Err_0'),"",$this->r_time);
				  if(!$sign) $this->error(L('Games_Err_1'),"",$this->r_time);
				  if(!$classid[0]) $this->error(L('Games_Err_2'),"",$this->r_time);

				  if($games->create())
				  {
					   if(!I('status')) $games->status=0;
					   $games->class_id=linkage_id($classid);
					   if($games->save()!==false)  
					   {
						   $this->success(L('EDIT').L('success'),U('Games/Admin/games_list'),$this->r_time);
					   }
					   else
					   {
						   $this->error(L('EDIT').L('ERR'),'',$this->r_time);
					   }
				  }
				  else
				  {
					  $this->error(L('EDIT').L('ERR'),'',$this->r_time);
				  }
		}
		else
		{
				 $where['id']=$id;
				 $info=$games->where($where)->find();
				 if(!$info) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
				 
				 $value=$info['class_id']?parents($info['class_id'],"games_class",array('name','id'),array('text','value')):"";
				 $this->assign('class',linkage(get_linkage_datas('games_class',0),"classid",'',0,$value,array('text'=>L('SELECT'),'value'=>0),"line_4_padding_1"));
				 $this->assign('info',$info);
				 $this->display();		
		}
		
	}

/*=================================================
**游戏删除
==================================================*/		
    public function  games_del(){  	
	         $id=I('id');
			 $del_num=0;//删除字段的条数
			 $games =D('games');	
			 		  		  
			 if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);		
			 
			 if(!is_array($id))	$id=array($id);				
			 $where['id']=array('in',$id);
			 $del_num=$games->where($where)->delete(); 
			 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Games/Admin/games_list"),$this->r_time);    
    }
/*=================================================
**游戏列表设置
==================================================*/
	public function games_set(){
		$id=I('id');
		$games =D('games');
		$games_find=$games->where(array('id'=>$id))->find();
		$sign=$games_find['sign'];
		if(IS_POST){
			$post=I('post.');
			unset($post['__hash__']);
			FF('Conf/'.$post['sign'].'_config',$post,MODULE_PATH);
			$this->success(L('EDIT').L('success'),U('Games/Admin/games_set',array('id'=>$post['id'])),$this->r_time);
		}else{
			$config=FF('Conf/'.$sign.'_config','',MODULE_PATH);
			$this->assign('point_type',C('point_type'));
			$this->assign('sign',$sign);
			$this->assign('id',$id);
			$this->assign('config',$config);
			$this->display();
		}
	}
/*=================================================
**斗地主设置
==================================================*/
	public function games_set_against(){
		$id=I('id');
		if(IS_POST){
			$post=I('post.');
			unset($post['__hash__']);
			$room_card=$post["room_card"];
			//房卡设置开始
			if(!$room_card['owner'] || !is_numeric($room_card['owner'])) $room_card['owner']=0;
			if(!$room_card['other'] || !is_numeric($room_card['other'])) $room_card['other']=0;
			if(!$room_card['win'] || !is_numeric($room_card['win'])) $room_card['win']=0;
//			if(!$room_card['multiple_upper'] || !is_numeric($room_card['multiple_upper'])) $room_card['multiple_upper']=0;
			if(!$room_card['room_num'] || !is_numeric($room_card['room_num'])) $room_card['room_num']=5;
			FF('Conf/'.$post['sign'].'_room_card_config',$room_card,MODULE_PATH);
			//房卡设置结束
			//比赛场设置开始
//			$match=$post["match"];
//			FF('Conf/'.$post['sign'].'_match_config',$match,MODULE_PATH);
			//比赛场设置结束
			$this->success(L('EDIT').L('success'),U('Games/Admin/games_set_against',array('id'=>$id)),$this->r_time);
		}else{
			$games =M('games');
			$games_find=$games->where(array('id'=>$id))->find();
			$sign=$games_find['sign'];
			//读取房卡设置
			$room_card=FF('Conf/'.$sign.'_room_card_config','',MODULE_PATH);
			//读取比赛场设置
			$match=FF('Conf/'.$sign.'_match_config','',MODULE_PATH);
			$this->assign('match',$match);
			$this->assign('room_card',$room_card);
			$this->assign('sign',$sign);
			$this->assign('id',$id);
			$this->assign('point_type',C('point_type'));
			$this->display();
		}
	}
/*=================================================
**斗地主设置
==================================================*/
	public function games_set_minghua(){
		$id=I('id');
		if(IS_POST){
			$post=I('post.');
			unset($post['__hash__']);
			//房卡设置开始
			if(!$post['owner']['price']) $post['owner']['price']=0;
			if(!$post['other']['price']) $post['other']=0;
			if(!$post['win']['price']) $post['win']=0;
			if(!$post['other']['status']) unset($post['other']);
			if(!$post['owner']['status']) unset($post['owner']);
			if(!$post['win']['status']) unset($post['win']);
			if(!$post['room_num'] || !is_numeric($post['room_num'])) $post['room_num']=5;
			FF('Conf/'.$post['sign'].'_config',$post,MODULE_PATH);
			$this->success(L('EDIT').L('success'),U('Games/Admin/games_set_'.$post['sign'],array('id'=>$id)),$this->r_time);
		}else{
			$games =M('games');
			$games_find=$games->where(array('id'=>$id))->find();
			$sign=$games_find['sign'];
			//读取房卡设置
			$config=FF('Conf/'.$sign.'_config','',MODULE_PATH);
			$this->assign('config',$config);
			$this->assign('sign',$sign);
			$this->assign('id',$id);
			$this->assign('point_type',C('point_type'));
			$this->display();
		}
	}
}