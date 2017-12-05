<?php 
return array (
  678 => 
  array (
    'id' => '678',
    'field' => 'title',
    'title' => '商品名称',
    'group' => '1',
    'table' => 'goods2',
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
  679 => 
  array (
    'id' => '679',
    'field' => 'price',
    'title' => '本店售价',
    'group' => '1',
    'table' => 'goods2',
    'remarks' => '请输入商品价格
',
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
      'num_min' => '0',
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
  680 => 
  array (
    'id' => '680',
    'field' => 'market_price',
    'title' => '市场售价',
    'group' => '1',
    'table' => 'goods2',
    'remarks' => '请输入市场价格，不价格不是商品的交易价格',
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
      'num_min' => '0',
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
  685 => 
  array (
    'id' => '685',
    'field' => 'separate_num',
    'title' => '分成金额',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '产品固定分成金额，如果按照产品价格分成，请输入0',
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
      'num_min' => '0',
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
  684 => 
  array (
    'id' => '684',
    'field' => 'promote_point',
    'title' => '升级点数',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '会员升级时候需要的经验点数，-1表示赠送等值商品价格的点数，0表示不赠送，此点数不可以消费，只能用来升级',
    'setting' => 
    array (
      'css' => 'form-control input-sm',
      'default_' => '-1',
      'data0' => '1',
      'var_' => '[$user][$userid]',
      'sql' => 'select user,id from [*user] where id=3',
      'sql_var' => '[#user][#id]',
      'type_num' => '1',
      'decimal' => '0',
      'num_min' => '0',
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
    'sort' => '4',
    'is_user_submit' => '-1',
    'is_user_show' => '-1',
    'is_user_edit' => '-1',
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
  683 => 
  array (
    'id' => '683',
    'field' => 'money',
    'title' => '人民币',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '-1表示赠送等值商品价格的积分，0表示不赠送',
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
      'num_min' => '0',
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
    'sort' => '4',
    'is_user_submit' => '-1',
    'is_user_show' => '-1',
    'is_user_edit' => '-1',
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
  682 => 
  array (
    'id' => '682',
    'field' => 'amount',
    'title' => '点数',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '-1表示赠送等值商品价格的积分，0表示不赠送',
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
      'num_min' => '0',
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
    'sort' => '4',
    'is_user_submit' => '-1',
    'is_user_show' => '-1',
    'is_user_edit' => '-1',
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
  681 => 
  array (
    'id' => '681',
    'field' => 'point',
    'title' => '积分',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '-1表示赠送等值商品价格的积分，0表示不赠送',
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
      'num_min' => '0',
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
    'sort' => '4',
    'is_user_submit' => '-1',
    'is_user_show' => '-1',
    'is_user_edit' => '-1',
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
  687 => 
  array (
    'id' => '687',
    'field' => 'content',
    'title' => '商品介绍',
    'group' => '2',
    'table' => 'goods2',
    'remarks' => '产品介绍',
    'setting' => 
    array (
      'width' => '0',
      'height' => '300',
      'editor_link' => '0',
      'editor_link_num' => '0',
      'editor_link_type' => '1',
      'editor_save' => '1',
      'water' => '0',
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
[editor_standard]
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_type' => 'editor_standard.html',
    'tem_mobile_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-10\\">
	[editor_simplify]
	</div>
	<div class=\\"col-md-8 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_mobile_type' => 'editor_simplify .html',
  ),
  686 => 
  array (
    'id' => '686',
    'field' => 'separate_scale',
    'title' => '分成比例',
    'group' => '3',
    'table' => 'goods2',
    'remarks' => '为空，表示按照全局设置的比例分成,A(10)-&gt;B(20)-&gt;C(30)-&gt;购买者（0）,比例格式为：0,30,20,10',
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
      'only' => '0',
      'search' => '0',
    ),
    'form_type' => 'text',
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
  688 => 
  array (
    'id' => '688',
    'field' => 'pictures',
    'title' => '商品图集',
    'group' => '2',
    'table' => 'goods2',
    'remarks' => '产品图集',
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
    'tem_mobile_c' => '<div class=\\"row padding_8\\">
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
    'template_mobile_type' => 'image_1.html',
  ),
  694 => 
  array (
    'id' => '694',
    'field' => 'thumb',
    'title' => '缩略图',
    'group' => '1',
    'table' => 'goods2',
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
    'tem_mobile_c' => '<div class=\\"row padding_8\\">
	<div class=\\"col-md-4\\">
		 <div class=\\"input-group col-md-12\\">
					<span class=\\"input-group-addon\\">[title]</span>
	<input name=\\"[field]\\" type=\\"text\\" class=\\"[css]\\" id=\\"[field]\\" value=\\"[default_]\\"  [property] [other] placeholder=\\"[default_]\\">
		 </div> 
	</div>
	<div class=\\"col-md-1 font_color_4\\" ><button type=\\"button\\" class=\\"btn btn-success btn-sm\\" [oneve] >上传</button></div>
	<div class=\\"col-md-7 padding_7  font_color_4\\" ><span id=\\"[field]Tip\\">[remarks]</span></div>
</div>',
    'template_mobile_type' => 'image_1.html',
  ),
  692 => 
  array (
    'id' => '692',
    'field' => 'bar_code',
    'title' => '条形码',
    'group' => '1',
    'table' => 'goods2',
    'remarks' => '条形码',
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
    'sort' => '10',
    'is_user_submit' => '-1',
    'is_user_show' => '-1',
    'is_user_edit' => '-1',
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