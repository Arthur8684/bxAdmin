<?php 
return array (
  'table_field' => 
  array (
    0 => 
    array (
      'field' => 'baodantupian',
      'title' => '保单图片',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '保单图片',
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
      'show_tem' => '',
      'tem_c' => '<div class="row padding_8">
	<div class="col-md-4 padding_7">
				<div class="col-md-2 left padding_5 sizefont_12">
					[title]：
				</div> 
				<div class="col-md-10">
				     <input name="[field]" id="[field]" value="[default_]" type="hidden" />
					<img src="[default_]" class="img-thumbnail_fixed hand" alt="" width="[width]" height="[height]"  id="[field]_" [oneve] /> </div>	
	</div> 
	<div class="col-md-7 padding_7  font_color_4" ><span id="[field]Tip">[remarks]</span></div> 
</div>',
      'template_type' => 'image_2.html',
      'tem_mobile_c' => '<div class="row padding_8">
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
      'template_mobile_type' => 'image_2.html',
    ),
    1 => 
    array (
      'field' => 'fadongjihao',
      'title' => '发动机号',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '发动机号',
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
      'field' => 'tuijian_user',
      'title' => '推荐人用户名',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '推荐人用户名',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'0\\\',
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
    3 => 
    array (
      'field' => 'bao_xian',
      'title' => '保险公司名称',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '保险公司名称',
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
    4 => 
    array (
      'field' => 'dianhua',
      'title' => '代理电话',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '代理电话',
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
    5 => 
    array (
      'field' => 'user',
      'title' => '买保险用户名',
      'group' => '',
      'table' => '_SIGN_',
      'remarks' => '买保险用户名',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'num_min\\\' => \\\'1\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'0\\\',
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
    6 => 
    array (
      'field' => 'price',
      'title' => '车险价格',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '车险价格',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'2\\\',
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
    7 => 
    array (
      'field' => 'shangyexian',
      'title' => '商业险',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '商业险',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'2\\\',
  \\\'num_min\\\' => \\\'0\\\',
  \\\'num_max\\\' => \\\'0\\\',
  \\\'len_min\\\' => \\\'0\\\',
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
    8 => 
    array (
      'field' => 'chechuanshui',
      'title' => '车船税',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '车船税',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'2\\\',
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
    9 => 
    array (
      'field' => 'jiaoqiangxian',
      'title' => '交强险',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '交强险',
      'setting' => 'array (
  \\\'css\\\' => \\\'form-control input-sm\\\',
  \\\'default_\\\' => \\\'\\\',
  \\\'data0\\\' => \\\'1\\\',
  \\\'var_\\\' => \\\'[$user][$userid]\\\',
  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',
  \\\'sql_var\\\' => \\\'[#user][#id]\\\',
  \\\'type_num\\\' => \\\'1\\\',
  \\\'decimal\\\' => \\\'2\\\',
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
    10 => 
    array (
      'field' => 'name',
      'title' => '车主姓名',
      'group' => '0',
      'table' => '_SIGN_',
      'remarks' => '0',
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
    11 => 
    array (
      'field' => 'shenfenzheng',
      'title' => '身份证号',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '身份证号',
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
    12 => 
    array (
      'field' => 'xinghao',
      'title' => '车辆类型',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '车辆类型',
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
    13 => 
    array (
      'field' => 'chepaihao',
      'title' => '车牌号',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '车牌号',
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
      'sort' => '6',
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
    14 => 
    array (
      'field' => 'daima',
      'title' => '车辆识别代码',
      'group' => '1',
      'table' => '_SIGN_',
      'remarks' => '车辆识别代码',
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
      'sort' => '8',
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
  ),
);
 ?>