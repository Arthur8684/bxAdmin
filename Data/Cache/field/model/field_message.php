<?php 
return array (
  'table_field' => 
  array (
    0 => 
    array (
      'field' => 'name',
      'title' => '用户名',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '111111',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'kkkkk\\\',
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
  \\\'only\\\' => \\\'1\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'text',
      'sort' => '0',
      'is_user_submit' => '',
      'is_user_show' => '',
      'is_user_edit' => '',
      'is_admin_submit' => '',
      'is_admin_show' => '',
      'is_admin_edit' => '',
      'status' => '1',
      'is_del' => '1',
      'site_id' => '0',
      'show_tem' => 'array (
  \\\'K_0\\\' => \\\'[title]:[default_]<BR>\\\',
)',
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
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_mobile_type' => 'text_1.html',
    ),
    1 => 
    array (
      'field' => 'age',
      'title' => '年龄',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '11111',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'11\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'2\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'10\\\',
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
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_mobile_type' => 'text_1.html',
    ),
    2 => 
    array (
      'field' => 'imgs',
      'title' => '图片集合',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '111',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',
  \\\'len_min\\\' => \\\'1\\\',
  \\\'len_max\\\' => \\\'10\\\',
  \\\'checks\\\' => \\\'1\\\',
  \\\'water\\\' => \\\'1\\\',
  \\\'property\\\' => \\\'\\\',
)',
      'form_type' => 'images',
      'sort' => '3',
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
	<div class="col-md-12 padding_7">
				<div class="col-md-1 left padding_5 sizefont_12">[title]</div> 
				<div class="col-md-11">
						<div class="panel panel-default">
						  <div class="panel-heading"><button type="button" class="btn btn-success btn-sm" [oneve]>批量上传</button></div>
							  <div class="panel-body" id="[field]_images">
								
							  </div>
						</div>
				</div>	
	</div> 

</div>',
      'template_type' => 'image_1.html',
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-12 padding_7">
				<div class="col-md-1 left padding_5 sizefont_12">[title]</div> 
				<div class="col-md-11">
						<div class="panel panel-default">
						  <div class="panel-heading"><button type="button" class="btn btn-success btn-sm" [oneve]>批量上传</button></div>
							  <div class="panel-body" id="[field]_images">
								
							  </div>
						</div>
				</div>	
	</div> 

</div>',
      'template_mobile_type' => 'image_1.html',
    ),
    3 => 
    array (
      'field' => 'sxe',
      'title' => '性别',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '2222',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'box_list\\\' => \\\'男=1
女=2\\\',
  \\\'default_\\\' => \\\'2\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'0\\\',
  \\\'format\\\' => \\\'1\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'reg_exp\\\' => \\\'\\\',
  \\\'reg_exp_pro\\\' => \\\'\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'box',
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
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
						<select name="[field]" id="[field]" class="[css]" [property] [other]>
						  [loop]
						  <option value="[value]">[text]</option>
						  [/loop]
						</select>
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_type' => 'select_1.html',
      'tem_mobile_c' => '<div class="row padding_8">
     [loop]<label class="checkbox-inline" ><input name="[field][]" type="checkbox"  id="[field]" value="[value]"  data-switch-no-init> [text]</label>[/loop]
</div>',
      'template_mobile_type' => 'checkbox_1.html',
    ),
    4 => 
    array (
      'field' => 'times',
      'title' => '时间',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '111',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'datetime_type\\\' => \\\'1\\\',
  \\\'datetime_time\\\' => \\\'1\\\',
  \\\'len_min\\\' => \\\'0\\\',
  \\\'prev_days\\\' => \\\'3,5,7\\\',
  \\\'prev_week\\\' => \\\'week\\\',
  \\\'next_days\\\' => \\\'3,5,7\\\',
  \\\'next_week\\\' => \\\'week\\\',
  \\\'property\\\' => \\\'\\\',
  \\\'search\\\' => \\\'0\\\',
)',
      'form_type' => 'datetime',
      'sort' => '5',
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
      'template_type' => 'datetime_1.html',
      'tem_mobile_c' => '<div class="row padding_8">
	<div class="col-md-4">
		 <div class="input-group col-md-12">
					<span class="input-group-addon">[title]</span>
	<input name="[field]" type="text" class="[css]" id="[field]" value="[default_]"  [property] [other] placeholder="[default_]">
		 </div> 
	</div>
	<div class="col-md-8 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div>
</div>',
      'template_mobile_type' => 'datetime_1.html',
    ),
  ),
);
 ?>