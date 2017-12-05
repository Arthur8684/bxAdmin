<?php
$this->install_before=function($sign)
{
	$data=array('name'=>'团购','type'=>'Group_buy','setting'=>'','model_class'=>'content');
    M('sys_model')->add($data);
};

$this->install_fail=function($sign)
{
	M('sys_mode')->where(array('type'=>'Group_buy'))->delete();
};

$this->uninstall_before=function($sign)
{
	$model_info=M('model')->field('id,table')->where(array('type'=>'Group_buy','model_class'=>'content'))->select();
	foreach($model_info as $k=>$v)
	{
		  $auth_rule_class_id=M('auth_rule_class')->where('model_id='.$v['id'])->getField('id',true);
		  $del_data=array(
		                  'comment'=>array('model_id'=>$v['id']), //评论
						  'sys_model_class'=>array('model_id'=>$v['id']), //分类
						  'model'=>array('id'=>$v['id']), //模型
						  'menu'=>array('model_id'=>$v['id']), //菜单
						  'auth_rule'=>array('class_id'=>array('in',$auth_rule_class_id)), //规则
						  'auth_rule_class'=>array('model_id'=>$v['id']), //规则分类
			       );
		  
		  del_data($del_data);
		  del_table($v['table']);
	}
	M('sys_model')->where(array('type'=>'Group_buy'))->delete();// 系统模型
};

$this->install_db_exist=function($install,$table_exist)
{
	 foreach($table_exist as $v)
	 {
		  echo "存在数据表：$v <BR>";
	 }
	 exit();
};
?>