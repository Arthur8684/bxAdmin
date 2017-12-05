<?php
namespace Fenxiao\Controller;
use Org\Util\Admin;
class SettingController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
   }  
    public function setting(){

		if(IS_POST)
		{
		    $post=I('post.');
			FF('Conf/config',$post,MODULE_PATH);
			C($post);
		}
		$this->display();
    }
	public function reimbursement_setting(){
		if(IS_POST){
			$post=I('post.');
			foreach($post['xiaofei'] as $k=>$v){
				if(!$v){
					unset($post['xiaofei'][$k]);
					sort($post['xiaofei']);
				}
			}
			FF('Conf/set_config',$post,MODULE_PATH);
		}

		$c=FF('Conf/set_config','',MODULE_PATH);
		$this->assign('c',$c);
		$this->assign('xiaofei',$c['xiaofei']);
		$this->assign('count',count($c['xiaofei']));
		$this->display();
	}
	public function setting_state(){
		$config=FF('Conf/set_config','',APP_PATH."Fenxiao/");
		$qujian=$config['xiaofei'];
        $biao=M('expense_record')->limit(3)->select();
		foreach($qujian as $k =>$value)
		{
			$now_time=time();
			if(substr($value,3,2)<substr($value,6,2)){
				 if(substr($value,0,2)>substr($value,3,2))
				 {
				 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
				 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
				 }else{
					 $get_time=strtotime(date('Y-m',time()).'-'.substr($value,0,2));
					 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
			     }
				 $year_time_get=strtotime(date('Y-m',time()).'-'.substr($value,6,2));
				if(substr($value,6,2)>substr($value,9,2)){$year_time_end=strtotime("+1months",strtotime(date('Y-m',time()).'-'.substr($value,9,2)));}else{
				$year_time_end=strtotime(date('Y-m',time()).'-'.substr($value,9,2));
				}
				if(substr($value,0,2)>substr($value,3,2))
					 {
					 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
					 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
					 }else{
						 $get_time=strtotime(date('Y-m',time()).'-'.substr($value,0,2));
						 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
				}
			}else{
				 if(substr($value,0,2)>substr($value,3,2))
				 {
				 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
				 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
				 }else{
					 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
					 $end_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
			     
			     }
				 $year_time_get=strtotime(date('Y-m',time()).'-'.substr($value,6,2));
				if(substr($value,6,2)>substr($value,9,2)){$year_time_end=strtotime("+1months",strtotime(date('Y-m',time()).'-'.substr($value,9,2)));}else{
				$year_time_end=strtotime(date('Y-m',time()).'-'.substr($value,9,2));
				}
				if(substr($value,0,2)>substr($value,3,2))
					 {
					 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
					 $end_time=strtotime(date('Y-m',time()).'-'.substr($value,3,2));
					 }else{
						 $get_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,0,2)));
						 $end_time=strtotime("-1months",strtotime(date('Y-m',time()).'-'.substr($value,3,2)));
				}
			}
			
			if(date('m-d',$year_time_get) <= date('m-d',$now_time) && date('m-d',$now_time) <= date('m-d',$year_time_end))
			{
				$king[3] = '<a href="?king"  id="kk" class="btn btn-primary btn-sm active">报销</a>';
			foreach($biao as $v)
			{
			if(date('Y-m',$v[expense_time])==date('Y-m',time())){$king[3]='<a href="?king"  id="kk" class="btn btn-default btn-sm active">已报销</a>';}else{$king[3]='<a href="?king"  id="kk" class="btn btn-primary btn-sm active">报销</a>';}
			}

			        if($_GET)
					{
						$user=$this->admininfo;
						$state=polling($qujian);
						if($state['k']==1&&$state['k']==3){$king[3]='<a href="?king"  id="kk" class="btn btn-default btn-sm active">已报销</a>';}
						if($state['k']==4){$king[3]='e币不足';}
					}
			
			}else{$king[3]='<button type="button" class="btn btn-danger btn-sm active">不在报销时间</button>';}
			$king[1]=$get_time;
			$king[2]=$end_time;
			$king[10]=$year_time_get;
			$king[11]=$year_time_end;
			$ki[]=$king;
		}
		$this->assign('qujian',$ki);
        $this->assign('biao',$biao);
		$this->display();
	}
}