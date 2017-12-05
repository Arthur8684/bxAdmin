<?php 
return array (
  'table_field' => 
  array (
    0 => 
    array (
      'field' => 'title',
      'title' => '标题',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '请输入文字标题',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'only\\\' => \\\'0\\\',
  \\\'search\\\' => \\\'0\\\',
)',
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
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'text_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'text_1.html',
    ),
    1 => 
    array (
      'field' => 'keyword',
      'title' => '关键字',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '请输入关键字，多个关键字用逗号隔开',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'only\\\' => \\\'0\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'text',
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
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'text_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'text_1.html',
    ),
    2 => 
    array (
      'field' => 'type',
      'title' => '回复类型',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => ' ',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'box_list\\\' => \\\'文本=1
图文=2\\\',
  \\\'default_\\\' => \\\'1\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'format\\\' => \\\'1\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'box',
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
      'tem_c' => '<div class="row padding_8">
<div class="col-md-4 padding_7">
	<div class="col-md-2 left padding_5 sizefont_12">[title]</div> 
<div class="col-md-10">[loop]<label class="radio-inline" ><input name="[field]"   type="radio" id="[field]" value="[value]" data-switch-no-init>[text]</label>
[/loop]</div>
</div>
</div>',
      'template_type' => 'radio_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'checkbox_1.html',
    ),
    3 => 
    array (
      'field' => 'description',
      'title' => '简介',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '内容简短说明',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[user][id]\\\',
  \\\'width\\\' => \\\'100%\\\',
  \\\'height\\\' => \\\'46\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'html\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
)',
      'form_type' => 'textarea',
      'sort' => '1',
      'is_user_submit' => '',
      'is_user_show' => '',
      'is_user_edit' => '',
      'is_admin_submit' => '',
      'is_admin_show' => '',
      'is_admin_edit' => '',
      'status' => '0',
      'is_del' => '1',
      'site_id' => '0',
      'show_tem' => '',
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-8">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<textarea name="[field]" class="[css]" id="[field]" [property] [other] placeholder="[default_]">[default_]</*textarea>
		 </div> 
	</div>
	<div class="col-md-10 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'textarea_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'textarea_1.html',
    ),
    4 => 
    array (
      'field' => 'content',
      'title' => '内容',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => ' ',
      'setting' => 'array (
  \\\'width\\\' => \\\'0\\\',
  \\\'height\\\' => \\\'200\\\',
  \\\'editor_link\\\' => \\\'0\\\',
  \\\'editor_link_num\\\' => \\\'0\\\',
  \\\'editor_link_type\\\' => \\\'1\\\',
  \\\'editor_save\\\' => \\\'1\\\',
  \\\'water\\\' => \\\'0\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[user][id]\\\',
  \\\'len_min\\\' => \\\'0\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
)',
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
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-10">
	[editor_simplify]
	</div>
</div>',
      'template_type' => 'editor_simplify .html',
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-10">
	[editor_simplify]
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_mobile_type' => 'editor_simplify .html',
    ),
    5 => 
    array (
      'field' => 'thumb',
      'title' => '缩略图',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => ' ',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',
  \\\'width\\\' => \\\'100\\\',
  \\\'height\\\' => \\\'100\\\',
  \\\'len_min\\\' => \\\'0\\\',
  \\\'checks\\\' => \\\'1\\\',
  \\\'water\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
)',
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
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4 padding_7">
				<div class="col-md-2 left padding_5 sizefont_12">
					[title]：
				</div> 
				<div class="col-md-10">
				     <input name="[field]" id="[field]" value="[default_]" type="hidden" />
					<img src="[default_]" class="img-thumbnail_fixed hand" alt="" width="[width]" height="[height]"  id="[field]_" [oneve]/> </div>	
	</div> 
	<div class="col-md-7 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div> 
</div>',
      'template_type' => 'image_2.html',
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-1 font_color_4" ><button type="button" class="btn btn-success btn-sm" [onvev] >上传</button></div>
	<div class="col-md-7 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_mobile_type' => 'image_1.html',
    ),
    6 => 
    array (
      'field' => 'autho_id',
      'title' => '发布人ID',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '发布人ID',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data1\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'0\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'only\\\' => \\\'0\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'text',
      'sort' => '5',
      'is_user_submit' => '',
      'is_user_show' => '',
      'is_user_edit' => '',
      'is_admin_submit' => '',
      'is_admin_show' => '',
      'is_admin_edit' => '',
      'status' => '0',
      'is_del' => '1',
      'site_id' => '0',
      'show_tem' => '',
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'text_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'text_1.html',
    ),
    7 => 
    array (
      'field' => 'autho_admin',
      'title' => '用户类型',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '用户类型',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data1\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'0\\\',
  \\\'decimal\\\' => \\\'0\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'0\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'only\\\' => \\\'0\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'text',
      'sort' => '6',
      'is_user_submit' => '',
      'is_user_show' => '',
      'is_user_edit' => '',
      'is_admin_submit' => '',
      'is_admin_show' => '',
      'is_admin_edit' => '',
      'status' => '0',
      'is_del' => '1',
      'site_id' => '0',
      'show_tem' => '',
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'text_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'text_1.html',
    ),
    8 => 
    array (
      'field' => 'addtime',
      'title' => '添加日期',
      'group' => '0',
      'table' => 'wechat_key',
      'remarks' => '添加日期',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'datetime_type\\\' => \\\'1\\\',
  \\\'datetime_time\\\' => \\\'1\\\',
  \\\'close_type\\\' => \\\'1\\\',
  \\\'len_min\\\' => \\\'0\\\',
  \\\'prev_days\\\' => \\\'3,5,7\\\',
  \\\'prev_week\\\' => \\\'week\\\',
  \\\'prev_month\\\' => \\\'month\\\',
  \\\'prev_year\\\' => \\\'year\\\',
  \\\'next_days\\\' => \\\'3,5,7\\\',
  \\\'next_week\\\' => \\\'week\\\',
  \\\'next_month\\\' => \\\'month\\\',
  \\\'next_year\\\' => \\\'year\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'datetime',
      'sort' => '7',
      'is_user_submit' => '',
      'is_user_show' => '',
      'is_user_edit' => '',
      'is_admin_submit' => '',
      'is_admin_show' => '',
      'is_admin_edit' => '',
      'status' => '0',
      'is_del' => '1',
      'site_id' => '0',
      'show_tem' => '',
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'datetime_1.html',
      'tem_mobile_c' => '',
      'template_mobile_type' => 'datetime_1.html',
    ),
  ),
);
 ?>