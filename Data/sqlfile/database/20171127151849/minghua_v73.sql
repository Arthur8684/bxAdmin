INSERT INTO `cow_table_field` VALUES('589','title','文章标题','1','chat_article','请输入文字标题','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','1','','','','10,9','10,9','10,9','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('590','description','简介','2','chat_article','内容简短说明','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'width\\\' => \\\'100%\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'html\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)','textarea','3','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','textarea_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<textarea name=\"[field]\" class=\"[css]\" id=\"[field]\" [property] [other] placeholder=\"[default_]\">[default_]</*textarea>\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','textarea_1.html');
INSERT INTO `cow_table_field` VALUES('591','content','内容','1','chat_article','请输入内容','array (\n  \\\'width\\\' => \\\'0\\\',\n  \\\'height\\\' => \\\'200\\\',\n  \\\'editor_link\\\' => \\\'0\\\',\n  \\\'editor_link_num\\\' => \\\'0\\\',\n  \\\'editor_link_type\\\' => \\\'1\\\',\n  \\\'editor_save\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[user][id]\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n)','editor','4','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n[editor_standard]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','editor_standard.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-10\">\r\n	[editor_simplify]\r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','editor_simplify .html');
INSERT INTO `cow_table_field` VALUES('592','price','浏览价格','3','chat_article','浏览价格','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data0\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$user][$userid]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'2\\\',\n  \\\'num_min\\\' => \\\'0\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','5','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('593','thumb','缩略图','1','chat_article','缩略图','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'allow_type\\\' => \\\'gif|jpg|jpeg|png|bmp\\\',\n  \\\'width\\\' => \\\'100\\\',\n  \\\'height\\\' => \\\'100\\\',\n  \\\'size\\\' => \\\'\\\',\n  \\\'len_min\\\' => \\\'0\\\',\n  \\\'checks\\\' => \\\'1\\\',\n  \\\'water\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n)','image','6','','','','','','','1','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4 padding_7\">\r\n				<div class=\"col-md-2 left padding_5 sizefont_12\">\r\n					[title]：\r\n				</div> \r\n				<div class=\"col-md-10\">\r\n				     <input name=\"[field]\" id=\"[field]\" value=\"[default_]\" type=\"hidden\" />\r\n					<img src=\"[default_]\" class=\"img-thumbnail_fixed hand\" alt=\"\" width=\"[width]\" height=\"[height]\"  id=\"[field]_\" [oneve] /> </div>	\r\n	</div> \r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div> \r\n</div>','image_2.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-1 font_color_4\" ><button type=\"button\" class=\"btn btn-success btn-sm\" [oneve] >上传</button></div>\r\n	<div class=\"col-md-7 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','image_1.html');
INSERT INTO `cow_table_field` VALUES('594','autho_id','发布人ID','3','chat_article','发布人ID','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data1\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'id\\\\\\\']]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'type_num\\\' => \\\'1\\\',\n  \\\'decimal\\\' => \\\'0\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','7','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
INSERT INTO `cow_table_field` VALUES('595','autho_admin','用户类型','3','chat_article','用户类型','array (\n  \\\'css\\\' => \\\'form-control input-sm\\\',\n  \\\'default_\\\' => \\\'\\\',\n  \\\'data1\\\' => \\\'1\\\',\n  \\\'var_\\\' => \\\'[$GLOBALS[\\\\\\\'LOGIN_USER\\\\\\\'][\\\\\\\'admin\\\\\\\']]\\\',\n  \\\'sql\\\' => \\\'select user,id from [*user] where id=3\\\',\n  \\\'sql_var\\\' => \\\'[#user][#id]\\\',\n  \\\'num_min\\\' => \\\'1\\\',\n  \\\'num_max\\\' => \\\'0\\\',\n  \\\'len_min\\\' => \\\'1\\\',\n  \\\'len_max\\\' => \\\'0\\\',\n  \\\'property\\\' => \\\'\\\',\n  \\\'reg_exp\\\' => \\\'\\\',\n  \\\'reg_exp_pro\\\' => \\\'\\\',\n  \\\'only\\\' => \\\'0\\\',\n  \\\'search\\\' => \\\'0\\\',\n)','text','8','','','','','','','0','1','0','','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html','<div class=\"row padding_8\">\r\n	<div class=\"col-md-4\">\r\n		 <div class=\"input-group col-md-12\">\r\n					<span class=\"input-group-addon\">[title]</span>\r\n	<input name=\"[field]\" type=\"text\" class=\"[css]\" id=\"[field]\" value=\"[default_]\"  [property] [other] placeholder=\"[default_]\">\r\n		 </div> \r\n	</div>\r\n	<div class=\"col-md-8 padding_7  font_color_4\" ><span id=\"[field]Tip\">[remarks]</span></div>\r\n</div>','text_1.html');
