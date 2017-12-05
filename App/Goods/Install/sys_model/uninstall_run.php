<?php 
    $field=new \Org\Util\Field();
	$field->del_table($sign);
	$del=array(
		'sys_model_class'=>array(
	        'model_id'=>$model_id,
		),
	   'menu'=>array(
	        'model_id'=>$model_id,
		),
		'auth_rule'=>array(
	        'auth_m'=>$model_type,
		),
	   'auth_rule_class'=>array(
	        'model_id'=>$model_id,
		));
	$field->del_data($del);
?>