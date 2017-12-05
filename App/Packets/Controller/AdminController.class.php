<?php
namespace Packets\Controller;
use Org\Util\Admin;
class AdminController extends Admin {
   function __construct()  //析构函数
   {  
        parent::__construct();
		//load('Admin/function');	
   } 

   public function packets_update_cache(){
        $modelid=I('modelid',0);
		if(!$modelid)
		{
		     $this->error(L('ADMIN_Field_Modelid_Err0'),"",$this->r_time);
		}
        field_set_config($modelid);
		$this->success(L('UPDATE').L('success'),U('Field/Field/field_list',array('modelid'=>$modelid)),$this->r_time);
   } 
    public function packets_list(){
	    $packets =M('packets');
		$pagesize=25;
		$record_count=$packets->where($where)->count();//获取总记录数
		$page=$record_count<$pagesize?1:$page; 
		
		if($record_count>0)
		{
		  $info=$packets->where($where)->order('id desc')->page($page,$pagesize)->select(); 
		  $page_show=page_show($record_count,$pagesize,3,$other);//获取分页数据
		  $this->assign('page_show',$page_show);// 赋值分页输出
		}	
		$form_type=array('base'=>'普通红包','holiday'=>'节日红包','substep'=>'分步红包');
		$this->assign('form_type',$form_type);
		$this->assign('info',$info);
        $this->display();
    }
	
	
	    public function packets_add(){
			if(IS_POST)
			{	
				   $name=I('post.name',"",'trim');
				   if(!$name)
				   {
				       $this->error(L('ADMIN_Packets_Name').L('O_EMPTY'),"",$this->r_time);
				   }
						
				   $packets =M('packets');
				   if($packets->create())	
				   {
				            $packets->groups=$packets->groups?implode(",",I('post.groups')):"";
							$packets->condition=I('post.condition','','trim');
							$packets->status=I('post.status',0,'intval');
				        	if($packets->add())
							   {
							        $this->success(L('ADD').L('success'),U('Packets/Admin/packets_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('ADD').L('ERR'),'',$this->r_time);
							   }
				   }
				   else
				   {
				            $this->error(L('ADD').L('ERR'),U('Packets/Admin/packets_add'),$this->r_time);
				   }   
			}
			else
			{			
					$form_type=array('base'=>'普通红包','holiday'=>'节日红包','substep'=>'分步红包');
					$this->assign('group_list',group_list_());
					$this->assign('condition_button',$this->condition_button());
					$this->assign('form_type',$form_type);
					$this->display();	
			}

    }
	
	
	    public function packets_edit(){
			$id=I('id',0,'intval');
            if(!$id) $this->error(L('ERR_PARAM_ID'),"",$this->r_time);
			if(IS_POST)
			{
				   $name=I('post.name',"",'trim');		   
				   if(!$name) $this->error(L('ADMIN_Packets_Name').L('O_EMPTY'),"",$this->r_time);
				   $packets =M('packets');
				   if($packets->create())	
				   {
				            $packets->groups=$packets->groups?implode(",",I('post.groups')):"";
							$packets->status=I('post.status',0,'intval');
							$packets->qrcode_open=I('post.qrcode_open',0,'intval');
							$packets->condition=I('post.condition','','trim');
							unset($packets->form_type);
							
				        	if($packets->save()!==false)
							   {
							        $this->success(L('EDIT').L('success'),U('Packets/Admin/packets_list'),$this->r_time);
							   }
							   else
							   {							   
							        $this->error(L('EDIT').L('ERR'),"",$this->r_time);
							   }
				   }
				   else
				   {
				               $this->error(L('EDIT').L('ERR'),"",$this->r_time);
				   }   
			}
			else
			{			
					$form_type=array('base'=>'普通红包','holiday'=>'节日红包','substep'=>'分步红包');
					$packets =M('packets');
					$where['id']=$id;
					$info=$packets->where($where)->find();
					if(!$info) $this->error(L('ADMIN_Packets_Err_0'),"",$this->r_time);

					$this->assign('info',$info);
                    $this->assign('condition_button',$this->condition_button());
					$this->assign('form_type',$form_type);
					$this->assign('group_list',group_list_());

					$this->display();	
			}
    }
/*
-----------------------------------  
   红包删除  
-----------------------------------   
*/	
    public function  packets_del(){  	
		 $id=I('id');
		 $del_num=0;//删除红包的条数
		 $packets =D('packets');			  			  
		 if(!$id)	$this->error(L('ERR_PARAM_ID'),"",$this->r_time);					 		
		 $where['id']=$id;
		 $del_num=$packets->where($where)->delete(); 
		 $this->success(L('DEL_RECORD',array('num'=>$del_num)),U("Packets/Admin/packets_list"),$this->r_time);   
    }	

	public function packets_base(){
		$this->assign('group_list',group_list_());
        $this->display();
    }	
		
	public function packets_edit_base(){
	    $id=I('id');
	    $packets =M('packets');
	    $data['id']=$id;
	    $info=$packets->where($data)->find();
		$this->assign('info',$info);
		$this->assign('group_list',group_list_());
        $this->display();
    }

	public function packets_holiday(){
		$this->assign('group_list',group_list_());
        $this->display();
    }	
		
	public function packets_edit_holiday(){
	    $id=I('id');
	    $packets =M('packets');
	    $data['id']=$id;
	    $info=$packets->where($data)->find();
		$this->assign('info',$info);
		$this->assign('group_list',group_list_());
        $this->display();
    }

	public function packets_substep(){
		$this->assign('group_list',group_list_());
		$this->assign('parent_packets',$this->get_parent_packets());
        $this->display();
    }	
		
	public function packets_edit_substep(){
	    $id=I('id');
	    $packets =M('packets');
	    $data['id']=$id;
	    $info=$packets->where($data)->find();
		$this->assign('info',$info);
		$this->assign('group_list',group_list_());
		$this->assign('parent_packets',$this->get_parent_packets($id));
        $this->display();
    }
/*
-----------------------------------  
   会员红包条件按钮  
-----------------------------------   
*/	
    public function  condition_button(){  	
	       $data=array();
		   $data[0]['money']=array('text'=>C('money_name'),'value'=>'[money]','describe'=>L('money_describe'));
		   $data[0]['amount']=array('text'=>C('amount_name'),'value'=>'[amount]','describe'=>L('amount_describe'));
		   $data[0]['point']=array('text'=>C('point_name'),'value'=>'[point]','describe'=>L('point_describe'));
		   $data[0]['qrcode_open']=array('text'=>L('QRCODE_OPEN'),'value'=>'[qrcode_open]','describe'=>L('qrcode_open_describe'));
		   $data[0]['promote_point']=array('text'=>L('PROMOTE_POINT'),'value'=>'[promote_point]','describe'=>L('promote_point_describe'));
		   $data[0]['group_id']=array('text'=>L('Group'),'value'=>'[group_id]','describe'=>L('group_describe'));
		   $data[0]['is_real_name']=array('text'=>L('real_name'),'value'=>'[is_real_name]','describe'=>L('real_name_describe'));
		   $data[0]['is_bank_auth']=array('text'=>L('bank_auth'),'value'=>'[is_bank_auth]','describe'=>L('bank_auth_describe'));
		   
		   $data[1]['year_consumption']=array('text'=>L('YEAR_CONSUMPTION'),'value'=>'[year_consumption]','describe'=>L('year_consumption_describe'));
		   $data[1]['month_consumption']=array('text'=>L('MONTH_CONSUMPTION'),'value'=>'[month_consumption]','describe'=>L('month_consumption_describe'));
		   $data[1]['day_consumption']=array('text'=>L('DAY_CONSUMPTION'),'value'=>'[day_consumption]','describe'=>L('day_consumption_describe'));
		   $data[1]['total_consumption']=array('text'=>L('TOTAL_CONSUMPTION'),'value'=>'[total_consumption]','describe'=>L('total_consumption_describe'));
		   
		   $data[2]['year_order']=array('text'=>L('YEAR_ORDER'),'value'=>'[year_order]','describe'=>L('year_order_describe'));
		   $data[2]['month_order']=array('text'=>L('MONTH_ORDER'),'value'=>'[month_order]','describe'=>L('month_order_describe'));
		   $data[2]['day_order']=array('text'=>L('DAY_ORDER'),'value'=>'[day_order]','describe'=>L('day_order_describe'));
		   $data[2]['total_order']=array('text'=>L('TOTAL_ORDER'),'value'=>'[total_order]','describe'=>L('total_order_describe'));	
		   	
		   $data[3]['year_recommend']=array('text'=>L('YEAR_RECOMMEND'),'value'=>'[year_recommend]','describe'=>L('year_recommend_describe'));
		   $data[3]['month_recommend']=array('text'=>L('MONTH_RECOMMEND'),'value'=>'[month_recommend]','describe'=>L('month_recommend_describe'));
		   $data[3]['day_recommend']=array('text'=>L('DAY_RECOMMEND'),'value'=>'[day_recommend]','describe'=>L('day_recommend_describe'));
		   $data[3]['total_recommend']=array('text'=>L('TOTAL_RECOMMEND'),'value'=>'[total_recommend]','describe'=>L('total_recommend_describe'));
		   $data[3]['recommend_n']=array('text'=>L('RECOMMEND_N'),'value'=>'[*3]','describe'=>L('recommend_n_describe'));
		   $data[3]['recommend_n_num']=array('text'=>L('RECOMMEND_N_NUM'),'value'=>'[?3]','describe'=>L('recommend_n_num_describe'));
		   $data[3]['recommend_total']=array('text'=>L('RECOMMEND_TOTAL'),'value'=>'[*0]','describe'=>L('recommend_total_describe'));
		   
		   $data[4]['||']=array('text'=>L('OR_'),'value'=>'||','describe'=>L('or_describe'));
		   $data[4]['&&']=array('text'=>L('AND_'),'value'=>'&&','describe'=>L('and_describe'));
		   $data[4]['!']=array('text'=>L('NO_'),'value'=>'!','describe'=>L('no_describe'));	
		   	   
		   $data[4]['+']=array('text'=>'+','value'=>'+','describe'=>L('+_describe'));
		   $data[4]['-']=array('text'=>'-','value'=>'-','describe'=>L('-_describe'));
		   $data[4]['*']=array('text'=>'*','value'=>'*','describe'=>L('*_describe'));
		   $data[4]['/']=array('text'=>'/','value'=>'/','describe'=>L('/_describe'));
		   $data[4]['=']=array('text'=>'=','value'=>'=','describe'=>L('=_describe'));
		   $data[4]['==']=array('text'=>'==','value'=>'==','describe'=>L('==_describe'));
		   $data[4]['!=']=array('text'=>'!=','value'=>'!=','describe'=>L('!=_describe'));
		   $data[4]['<']=array('text'=>'<','value'=>'<','describe'=>L('<_describe'));
		   $data[4]['>']=array('text'=>'>','value'=>'>','describe'=>L('>_describe'));
		   $data[4]['(']=array('text'=>'(','value'=>'(','describe'=>L('(_describe'));
		   $data[4][')']=array('text'=>')','value'=>')','describe'=>L(')_describe'));
		   
		   $group=M('group')->field('id,name')->select();
		   foreach($group as $k=>$v)
		   {
			   $data[6][$v['id']]=array('text'=>L('RECOMMEND_PUSH')."[".$v['name']."]",'value'=>'[*1|'.$v['id'].']','describe'=>L('recommend_push_describe',array('group_name'=>$v['name'])));
			   $data[7][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N')."[".$v['name']."]",'value'=>'[*3|'.$v['id'].']','describe'=>L('recommend_push_n_describe',array('group_name'=>$v['name'])));
			   $data[8][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N_NUM')."[".$v['name']."]",'value'=>'[?3|'.$v['id'].']','describe'=>L('recommend_push_n_num_describe',array('group_name'=>$v['name'])));
			   $data[9][$v['id']]=array('text'=>L('RECOMMEND_PUSH_N_TOTAL')."[".$v['name']."]",'value'=>'[*0|'.$v['id'].']','describe'=>L('recommend_push_n_total_describe',array('group_name'=>$v['name'])));
			   
		   }
		   return $data;      
    }
	
/*
-----------------------------------  
   获取上步红包
-----------------------------------   
*/	
    public function  get_parent_packets($id=0){  	
	       $packets=M('packets');
		   $data['form_type']='substep';
		   if($id) $data['id']=array('NEQ',$id);
		   $info=$packets->field(array('id','name'))->where($data)->select();
		   return $info;      
    }				
}