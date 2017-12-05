<?php
/**
*@发送信息  *@
*@$title，标题  *@
*@$content，内容  *@
*@$receive，收心人  *@
*@ return bool
*/  
function send($title,$content,$receive)
{
    $M=M('message');
	if($receive && !is_numeric($receive)) $receive=M('user')->where(array('user'=>$receive))->getField('id');
	$send_userid=$GLOBALS['LOGIN_USER']['admin']=='user'?$GLOBALS['LOGIN_USER']['id']:0;
	$data=array('title'=>$title,'content'=>$content,'receive_userid'=>$receive,'send_userid'=>$send_userid,'send_status'=>0,'receive_status'=>0,'addtime'=>time());
	return $M->add($data);
}  
?>
