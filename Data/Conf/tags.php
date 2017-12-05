<?PHP
return array(
      'app_begin' => array('Behavior\CheckLangBehavior'),//鉴权认证开始
	  'view_filter' => array('Behavior\TokenBuildBehavior'),//表单令牌开启
	  );
?>