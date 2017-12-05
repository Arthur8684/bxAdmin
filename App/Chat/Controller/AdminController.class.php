<?php
namespace Chat\Controller;
use Org\Util\Admin;
class AdminController extends Admin {
	function __construct()  //析构函数
	{
		parent::__construct();
		$this->type=I('type')?I('type'):"admin";
	}
	//------------------------------------直播申请列表----------------------------------------
	//-------------------------
	public function chat_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$chat_room=M('chat_room');
		$chat_class =M('Chat_class');
		$user=M('user');
		//------------------------------------管理员列表----------------------------------------
		$record_count=$chat_room->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$chat_room->order('id desc')->page($page,$pagesize)->select();
			foreach($info as $key=>$val){
				$where['id']=$val['user_id'];
				$where1['id']=$val['class_id'];
				$user_name=$user->where($where)->getField('user');
				$class_name=$chat_class->where($where1)->getField('name');
				$info[$key]['user']=$user_name;
				$info[$key]['class_name']=$class_name;
			}
			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------------------管理员列表----------------------------------------
		$this->assign('info',$info);
		$this->display();
	}
	//------------------------------------修改申请列表----------------------------------------
	public function chat_edit(){
		$id=I('id',0,'intval');
		$chat_room=M('chat_room');
		$user=M('user');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$result=$chat_room->where($where)->find();
		$where1['id']=$result['user_id'];
		$username=$user->where($where1)->getField('user');
		if(IS_POST){
			if(!I('id'))
			{
				$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			}
			$title=I('title');
			$describe=I('description');
			$class_id=I('class_id');
			$anchor_cover=I('anchor_cover');
			$get_type=I('get_type');
			if(!$title) $this->error(L('Please_fill_in_the_live_title'),"",$this->r_time);
			if(!$describe) $this->error(L('Please_fill_in_the_broadcast'),"",$this->r_time);
			$data['title']=$title;
			$data['describe']=$describe;
			$data['status']=$result['status'];
			$data['class_id']=$class_id;
			$data['anchor_cover']=$anchor_cover;
			$data['get_type']=$get_type;
			if($chat_room->where($where)->save($data)!==false){
				$this->success(L('Successful_modification'),U('Chat/Admin/chat_list'),3);
			}else{
				$this->error(L('Modify_failed'),"",$this->r_time);
			}
		}else{
			$this->assign('username',$username);
			$this->assign('result',$result);
			$this->assign('menu_list',chat_menu_check(0,$result['class_id']));
			$this->display();
		}
	}
	//------------------------------------删除申请列表----------------------------------------
	public function chat_del(){
		$id=I('id',0,'intval');
		$chat_room=M('chat_room');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		$where['id']=$id;
		$cid=$chat_room->where($where)->getField('cid');
		if($cid){
			del_channel_0($cid);
		}
		$result=$chat_room->where($where)->delete();
		$this->success(L('DEL_RECORD',array('num'=>$result)),U('Chat/Admin/chat_list'),$this->r_time);
	}
	//------------------------------------会员信息列表----------------------------------------	
	//房间审核
	public function chat_verify(){
		$id=I('id',0,'intval');
		$chat_room=M('chat_room');
		if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		$cid=get_channel($id);
		if($cid)
		{
			$chat_room->where('id='.$id)->setField('status',1);
			$this->success(L('YES_VERIFY').L('SUCCESS'),U('Chat/Admin/chat_list'),$this->r_time);
		}
		else
		{
			$this->error(L('YES_VERIFY').L('ERR'),U('Chat/Admin/chat_list'),$this->r_time);
		}

	}

	public function User_list(){
		$user=M('user');
		$group=M('group');
		$id=I('id',0,'intval');
		$where['id']=$id;
		$info=$user->where($where)->find();
		if($info)
		{
			$where1['id']=$info['group_id'];
			$name=$group->where($where1)->getField('name');
			$point_type=array_keys(C('point_type'));
			foreach($point_type as $k=>$v){
				$config=C($v);
				$field[$k]['num']=$user->where($where)->getField($v);
				$field[$k]['name']=$config['name'];
			}
			$this->assign('field',$field);
			$this->assign('name',$name);
			$this->assign('info',$info);
		}
		else
		{
			$this->error(L('ADMIN_Edit_Null'),"",$this->r_time);
		}
		$this->display();
	}
	//------------------------------------批量删除申请列表----------------------------------------
	public function Chat_all(){
		$id=I('id');
		$del_num=0;//删除会员的条数
		$chat_room=M('chat_room');
		if(IS_POST)
		{
			if(!$id)
			{
				$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			}
			foreach($id as $v){
				$where['id']=$v;
				$cid=$chat_room->where($where)->getField('cid');
				if($cid){
					del_channel_0($cid);
				}
			}
			$str_id=implode(",",$id);
			$del_num=$chat_room->delete($str_id);
			$this->success(L('DEL_RECORD',array('num'=>$del_num)),"",$this->r_time);
		}
		else
		{
			$this->Chat_list();
		}
	}
	//------------------------------------礼物列表----------------------------------------
	public function gift_list()
	{
		$pagesize=25;
		$page=I('page',1,'intval');
		$gift =M('chat_gift');
		$record_count=$gift->count();
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$gift->order('sort asc,id desc')->page($page,$pagesize)->select();
			$this->assign('arr',$info);
			$page_show=page_show($record_count,$pagesize,3,$other);
			$this->assign('page_show',$page_show);
		}
		$this->display();
	}
	//------------------------------------添加礼物列表----------------------------------------
	public function gift_add()
	{

		if(IS_POST)
		{
			$title=I('title','','trim');
			$describe=I('describe','','trim');
			$price=I('price','','trim');
			$ico=I('ico','','trim');
			if(!$title || !$describe || !$price || !$ico) $this->error(L('Please_complete_the_gift_message'),"",$this->r_time);
			$gift = M('chat_gift');
			if($gift->create())
			{
				if($gift->add())
				{
					$this->success(L('ADD').L('success'),U('Chat/Admin/gift_list',array('type'=>$this->type)),$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}
		}
		$this->display();
	}
	//------------------------------------删除礼物列表----------------------------------------
	public function gift_del()
	{
		$id=is_array(I('id'))?I('id'):array(I('id'));
		$gift = M('chat_gift');
		$del_num = $gift -> delete(implode(',',$id));
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Chat/Admin/gift_list"),$this->r_time);

	}
	//------------------------------------编辑礼物列表----------------------------------------
	public function gift_edit()
	{

		$id=I('id',0,'intval');
		$gift = M('chat_gift');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		if(IS_POST)
		{
			$id = I('id',0,'intval');
			if($gift->create())
			{
				if($gift->save()!==false)
				{
					$this->success(L('EDIT').L('success'),U('Chat/Admin/gift_list'),$this->r_time);
				}else
				{
					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
		}
		else
		{
			$where['id']=$id;
			$info=$gift->where($where)->find();
			if($info) $this->assign('info',$info);
			$this->display();
		}
	}
	//------------------------------------表情列表----------------------------------------
	public function face_list()
	{
		$pagesize=25;
		$page=I('page',1,'intval');
		$face =M('chat_face');
		$record_count=$face->count();
		$page=$record_count<$pagesize?1:$page;
		if($record_count>0)
		{
			$info=$face->order('id desc')->page($page,$pagesize)->select();
			$this->assign('arr',$info);
			$page_show=page_show($record_count,$pagesize,3,$other);
			$this->assign('page_show',$page_show);
		}
		$this->display();
	}
	//------------------------------------添加表情列表----------------------------------------
	public function face_add()
	{
		if(IS_POST)
		{
			$title=I('title','','trim');
			$path=I('path','','trim');
			$allow_group=I('allow_group','','trim');
			if(!$title || !$path || !$allow_group) $this->error(L('Please_complete_the_face_message'),"",$this->r_time);
			$face = M('chat_face');
			if($face->create())
			{
				$face->allow_group=$face->allow_group?implode(",",$allow_group):"";
				if($face->add())
				{
					$this->success(L('ADD').L('success'),U('Chat/Admin/face_list',array('type'=>$this->type)),$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}

		}else
		{
			$group =M('group');
			$where['status']=1;
			$info=$group->where($where)->order('sort_num asc,id desc')->select();
			$this->assign('group_list',$info);
			$this->display();
		}
	}
	//------------------------------------删除列表----------------------------------------
	public function face_del()
	{
		$id=is_array(I('id'))?I('id'):array(I('id'));
		$face = M('chat_face');
		$del_num = $face -> delete(implode(',',$id));
		$this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Chat/Admin/face_list"),$this->r_time);
	}
	//------------------------------------编辑列表----------------------------------------
	public function face_edit()
	{

		$id=I('id',0,'intval');
		$face = M('chat_face');
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		if(IS_POST)
		{
			$allow_group=I('allow_group','','trim');
			$id = I('id',0,'intval');
			if($face->create())
			{
				$face->allow_group=$face->allow_group?implode(",",$allow_group):"";
				if($face->save()!==false)
				{
					$this->success(L('EDIT').L('success'),U('Chat/Admin/face_list'),$this->r_time);
				}else
				{
					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
		}
		else
		{
			$where['id']=$id;
			$infos=$face->where($where)->find();
			$group =M('group');
			$wheres['status']=1;
			$info=$group->where($wheres)->order('sort_num asc,id desc')->select();
			if($infos) $this->assign('info',$infos);
			$this->assign('group_list',$info);
			$this->display();
		}
	}
	//------------------------------------直播分类列表----------------------------------------
	public function menu_list(){
		$pagesize=25;
		$page=I('page',1,'intval');
		$parentid=I('parentid',0,'intval');
		$where['parent_id']=$parentid;
		$where['type']=$this->type;
		$chat_class =M('Chat_class');
		//------------------------------------菜单列表----------------------------------------
		$record_count=$chat_class->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize	?1:$page;
		if($record_count>0)
		{
			$info=$chat_class->where($where)->order('sort asc,id desc')->page($page,$pagesize)->select();

			$page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
			$this->assign('page_show',$page_show);// 赋值分页输出
		}
		//------------------------获取父菜单信息--------------------------------------
		if($parentid)
		{
			unset($where);
			$where['id']=$parentid;
			$parent_menu=$chat_class->where($where)->find();
			$this->assign('parent_menu',$parent_menu);
		}
		//------------------------获取父菜单信息完--------------------------------------
		$this->assign('type',$this->type);
		$this->assign('parentid',$parentid);
		$this->assign('info',$info);
		$this->assign('parent_menu_nav',parents($parentid,'Chat_class',array('name','id')));
		$this->display();
	}
	//-------------------------------------添加分类列表----------------------------------------
	public function menu_add(){
		$parentid=I('parentid',0,'intval');
		if(IS_POST)
		{
			//------------------------------------保存提交的菜单----------------------------------------
			$chat_class =M('Chat_class');
			if ($chat_class->create()){
				$chat_class->url_p=trim($_POST['url_p']);
				if($chat_class->add())
				{
					$this->success(L('ADD').L('success'),U('Chat/Admin/menu_list',array('type'=>$this->type)),$this->r_time);
				}
				else
				{
					$this->error(L('ADD').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($chat_class->getError(),"",$this->r_time);
			}
			//------------------------保存提交的菜单完--------------------------------------
		}
		else
		{
			$this->assign('menu_list',chat_menu_check(0,0,$parentid,0,$this->type));
			$this->assign('type',$this->type);
			$this->display();
		}
	}
	public function menu_edit(){
		$id=I('id',0,'intval');
		$Chat_class =M('Chat_class');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		//------------------------------------验证数据正确性完----------------------------------------
		if(IS_POST)
		{
			//------------------------------------编辑提交的菜单----------------------------------------
			if ($Chat_class->create()){
				$Chat_class->status=I('status',0,'intval');
				if($Chat_class->save()!==false)
				{
					$this->success(L('EDIT').L('success'),U('Chat/admin/menu_list',array('type'=>$this->type)),$this->r_time);
				}
				else
				{

					$this->error(L('EDIT').L('ERR'),"",$this->r_time);
				}
			}
			else
			{
				$this->error($Chat_class->getError(),"",$this->r_time);
			}
			//------------------------编辑提交的菜单完--------------------------------------
		}
		else
		{
			$where['id']=$id;
			$info=$Chat_class->where($where)->find();
			if($info)
			{
				$this->assign('info',$info);
				$this->assign('menu_list',chat_menu_check(0,0,$info['parent_id'],$id,$this->type));
			}
			else
			{
				$this->error(L('ADMIN_Edit_Null'),"",$this->r_time);
			}
			$this->assign('type',$this->type);
			$this->display();
		}
	}
	public function  menu_del(){
		$id=I('id');
		$del_num=0;//删除菜单的条数
		$menu =D('Menu');
		//------------------------------------验证数据正确性----------------------------------------
		if(!$id)
		{
			$this->error(L('ERR_PARAM_ID'),"",$this->r_time);
		}
		if(is_array($id))// 多ID 批量删除
		{
			foreach ($id as $k=>$v)
			{
				$del_num=$del_num+chat_menu_submenu_del($v);
			}
			$this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Chat/Admin/menu_list',array('type'=>$this->type)),$this->r_time);
		}
		else// 只删除一个菜单
		{
			$del_num=chat_menu_submenu_del($id);
			$this->success(L('DEL_RECORD',array('num'=>$del_num)),U('Chat/Admin/menu_list',array('type'=>$this->type)),$this->r_time);
		}
	}
	public function menu_all(){

		if(IS_POST)
		{
			//------------------------------------编辑提交的菜单----------------------------------------
			$this->menu_del();
			//------------------------编辑提交的菜单完--------------------------------------
		}
		else
		{
			$this->menu_list();
		}
	}
}
?>