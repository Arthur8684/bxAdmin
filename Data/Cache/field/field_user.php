<?php 
return array (
  715 => 
  array (
    'id' => '715',
    'field' => 'sex',
    'title' => '性别',
    'group' => '1',
    'table' => 'user',
    'remarks' => '性别',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'box_list' => '男=1
女=0',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'type_num' => '1',
      'decimal' => '0',
      'len_min' => '0',
      'format' => '1',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
      'search' => '0',
    ),
    'form_type' => 'box',
    'sort' => '3',
    'is_user_submit' => '',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
    'status' => '1',
    'is_del' => '0',
    'site_id' => '0',
    'show_tem' => '',
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-4\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">[title]</span>
						<select name=\\"[field]\\" id=\\"[field]\\" class=\\"[css]\\" [property] [other]>
						  [loop]
						  <option value=\\"[value]\\">[text]</option>
						  [/loop]
						</select>
		 </div> 
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'select_1.html',
    'tem_mobile_c' => '<div class=\\"row padding_8\\">
     [loop]<label class=\\"checkbox-inline\\" ><input name=\\"[field][]\\" type=\\"checkbox\\"  id=\\"[field]\\" value=\\"[value]\\"  data-switch-no-init> [text]</label>[/loop]
</div>',
    'template_mobile_type' => 'checkbox_1.html',
  ),
  493 => 
  array (
    'id' => '493',
    'field' => 'card',
    'title' => '会员卡',
    'group' => '0',
    'table' => 'user',
    'remarks' => '会员卡',
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
      'len_min' => '0',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
      'only' => '1',
      'search' => '0',
    ),
    'form_type' => 'text',
    'sort' => '99',
    'is_user_submit' => '-1',
    'is_user_show' => '',
    'is_user_edit' => '',
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
    'status' => '1',
    'is_del' => '0',
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
    'tem_mobile_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-4\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">[title]</span>
	<input name=\\"[field]\\" type=\\"text\\" class=\\"[css]\\" id=\\"[field]\\" value=\\"[default_]\\"  [property] [other] placeholder=\\"[default_]\\">
		 </div> 
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_mobile_type' => 'text_1.html',
  ),
);
 ?>