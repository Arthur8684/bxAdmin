<?php 
return array (
  282 => 
  array (
    'id' => '282',
    'field' => 'title',
    'title' => '团购名称',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '名称',
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
    'is_admin_submit' => '',
    'is_admin_show' => '',
    'is_admin_edit' => '',
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
  283 => 
  array (
    'id' => '283',
    'field' => 'price',
    'title' => '团购价格',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '元',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '0',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'type_num' => '1',
      'decimal' => '2',
      'num_min' => '1',
      'num_max' => '0',
      'len_min' => '0',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
      'only' => '0',
      'search' => '0',
    ),
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
  284 => 
  array (
    'id' => '284',
    'field' => 'market_price',
    'title' => '市场价格',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '元',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'type_num' => '1',
      'decimal' => '2',
      'num_min' => '1',
      'num_max' => '0',
      'len_min' => '0',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
      'only' => '0',
      'search' => '0',
    ),
    'form_type' => 'text',
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
  287 => 
  array (
    'id' => '287',
    'field' => 'times',
    'title' => '日期',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '日期',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'datetime_type' => '2',
      'datetime_time' => '1',
      'close_type' => '1',
      'len_min' => '0',
      'prev_days' => '3,5,7',
      'prev_week' => 'week',
      'prev_month' => 'month',
      'prev_year' => 'year',
      'next_days' => '3,5,7',
      'next_week' => 'week',
      'next_month' => 'month',
      'next_year' => 'year',
      'property' => '',
      'search' => '0',
    ),
    'form_type' => 'datetime',
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
    'tem_c' => '<div class=\\"row padding_8\\" id=\\"[field]\\">
	<div class=\\"col-md-3\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">开始[title]</span>
	<input name=\\"[field]_start\\" type=\\"text\\" class=\\"[css]\\" id=\\"[field]_start\\" value=\\"[default_start]\\"  [property]>
		 </div> 
	</div>
	<div class=\\"col-md-3\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">结束[title]</span>
	<input name=\\"[field]_end\\" type=\\"text\\" class=\\"[css]\\" id=\\"[field]_end\\" value=\\"[default_end]\\"  [property]>
		 </div> 
	</div>
</div>',
    'template_type' => 'datetime_4.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'datetime_1.html',
  ),
  286 => 
  array (
    'id' => '286',
    'field' => 'content',
    'title' => '团购内容',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '团购内容',
    'setting' => 
    array (
      'width' => '0',
      'height' => '300',
      'editor_link' => '0',
      'editor_link_num' => '0',
      'editor_link_type' => '1',
      'editor_save' => '1',
      'default_' => '',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'len_min' => '0',
      'len_max' => '0',
      'property' => '',
      'reg_exp' => '',
      'reg_exp_pro' => '',
    ),
    'form_type' => 'editor',
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
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-10\\">
	[editor_simplify]
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'editor_simplify .html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'editor_simplify .html',
  ),
  285 => 
  array (
    'id' => '285',
    'field' => 'pictures',
    'title' => '团购图集',
    'group' => NULL,
    'table' => 'Group_buy_air',
    'remarks' => '团购图集',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '',
      'allow_type' => 'gif|jpg|jpeg|png|bmp',
      'len_min' => '0',
      'len_max' => '10',
      'checks' => '1',
      'water' => '1',
      'property' => '',
    ),
    'form_type' => 'images',
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
    'tem_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-12 padding_7\\">
				<div class=\\"col-md-1 left padding_5 sizefont_12\\">[title]</div> 
				<div class=\\"col-md-11\\">
						<div class=\\"panel panel-default\\">
						  <div class=\\"panel-heading\\"><button type=\\"button\\" class=\\"btn btn-success btn-sm\\" [oneve]>批量上传</button></div>
							  <div class=\\"panel-body\\" id=\\"[field]_images\\">
								
							  </div>
						</div>
				</div>	
	</div> 

</div>',
    'template_type' => 'image_1.html',
    'tem_mobile_c' => '',
    'template_mobile_type' => 'image_1.html',
  ),
  291 => 
  array (
    'id' => '291',
    'field' => 'thumb',
    'title' => '缩略图',
    'group' => NULL,
    'table' => 'Group_buy_air',
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
    'sort' => '10',
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