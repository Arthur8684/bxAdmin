<?php 
return array (
  440 => 
  array (
    'id' => '440',
    'field' => 'title',
    'title' => '文章标题',
    'group' => '0',
    'table' => '1111',
    'remarks' => '请输入文字标题',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'num_min' => '1',
      'num_max' => '0',
      'len_min' => '1',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
      'only' => '0',
      'search' => '0',
    ),
    'form_type' => 'text',
    'sort' => '0',
    'is_user_submit' => '',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '10,9',
    'is_admin_show' => '10,9',
    'is_admin_edit' => '10,9',
    'status' => '1',
    'is_del' => '1',
    'site_id' => '0',
    'show_tem' => '',
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-4\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">[title]</span>
	<input name=\\"[field]\\" type=\\"text\\" class=\\"[css]\\" id=\\"[field]\\" value=\\"[default_]\\"  [property] [other] placeholder=\\"[default_]\\">
		 </div> 
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'text_1.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'text_1.html',
  ),
  441 => 
  array (
    'id' => '441',
    'field' => 'description',
    'title' => '简介',
    'group' => '0',
    'table' => '1111',
    'remarks' => '内容简短说明',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[user][id]',
      'width' => '100%',
      'height' => '46',
      'len_min' => '1',
      'len_max' => '0',
      'html' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
    ),
    'form_type' => 'textarea',
    'sort' => '1',
    'is_user_submit' => '',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
    'status' => '1',
    'is_del' => '1',
    'site_id' => '0',
    'show_tem' => '',
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-8\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">[title]</span>
	<textarea name=\\"[field]\\" class=\\"[css]\\" id=\\"[field]\\" [property] [other] placeholder=\\"[default_]\\">[default_]</*textarea>
		 </div> 
	</div>
	<div class=\\"col-md-10 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'textarea_1.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'textarea_1.html',
  ),
  442 => 
  array (
    'id' => '442',
    'field' => 'content',
    'title' => '内容',
    'group' => '0',
    'table' => '1111',
    'remarks' => '请输入内容',
    'setting' => 
    array (
      'width' => '100%',
      'height' => '200',
      'editor_link' => '0',
      'editor_link_num' => '0',
      'editor_link_type' => '1',
      'editor_save' => '1',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[user][id]',
      'len_min' => '0',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
    ),
    'form_type' => 'editor',
    'sort' => '2',
    'is_user_submit' => '',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
    'status' => '1',
    'is_del' => '1',
    'site_id' => '0',
    'show_tem' => '',
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-10\\">
[editor_standard]
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'editor_standard.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'editor_simplify .html',
  ),
  444 => 
  array (
    'id' => '444',
    'field' => 'thumb',
    'title' => '缩略图',
    'group' => '0',
    'table' => '1111',
    'remarks' => '缩略图',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '',
      'allow_type' => 'gif|jpg|jpeg|png|bmp',
      'width' => '100',
      'height' => '100',
      'len_min' => '0',
      'checks' => '1',
      'water' => '0',
      'property' => '',
    ),
    'form_type' => 'image',
    'sort' => '4',
    'is_user_submit' => '',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
    'status' => '1',
    'is_del' => '1',
    'site_id' => '0',
    'show_tem' => '',
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-4 padding_7\\">
				<div class=\\"col-md-2 left padding_5 sizefont_12\\">
					[title]：
				</div> 
				<div class=\\"col-md-10\\">
				     <input name=\\"[field]\\" id=\\"[field]\\" value=\\"[default_]\\" type=\\"hidden\\" />
					<img src=\\"[default_]\\" class=\\"img-thumbnail_fixed hand\\" alt=\\"\\" width=\\"[width]\\" height=\\"[height]\\"  id=\\"[field]_\\" [oneve] /> </div>	
	</div> 
	<div class=\\"col-md-7 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div> 
</div>',
    'template_type' => 'image_2.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'image_1.html',
  ),
);
 ?>