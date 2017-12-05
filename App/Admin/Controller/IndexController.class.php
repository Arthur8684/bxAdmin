<?php
namespace Admin\Controller;
use Org\Util\Admin;
class IndexController extends Admin {

   function __construct()  //析构函数
   {  
        parent::__construct();
        
   }  
    public function index(){
        $info=$this->get_menu_admin_index();
		$this->assign('info',$info);
        $this->display();
    }

    public function get_menu_admin_index($parent_id=0,$type='admin',$max_c=3){
	    $menu =D('Menu');
		$where['status']=1;
		$where['parent_id']=$parent_id?$parent_id:0;
		$where['type']=$type;
		$info=$menu->where($where)->order('sort asc,id desc')->select(); 
		$info_c=array();
        if($info)
		{
			$Auth=new \Org\Util\Auth();
			foreach($info as $k=>$v)
			{
				if($v['url_m'] && $v['url_c'] && $v['url_a'])
				{
					 if($GLOBALS['LOGIN_USER']['role_id']!=1)
					 {
						$rule=M('auth_rule')->where(array('auth_m'=>$v['url_m'],'auth_c'=>$v['url_c'],'auth_a'=>$v['url_a']))->find();
						$Auth_=$Auth->check($v['url_m']."/".$v['url_c']."/".$v['url_a'],session('admin.id'),$v['url_p']);
						if($Auth_ || !$rule) $info_c[]=$v;
					 }
					 else
					 {
						  $info_c[]=$v;
					 }
				}
				else if($v)
				{
					  $sub=$this->get_menu_admin_index($v['id'],$type,$max_c);
					  if($sub)
					  {
						  $v['s']=$sub;
						  $info_c[]=$v;
						  
					  }				    
				}
			}
		}
		return $info_c;
    }	
	
}