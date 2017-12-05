<?PHP
namespace Think\Template\TagLib;
use Think\Template\TagLib;
class TagLibDiy extends TagLib {
    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'adminmenu'    =>  array('attr'=>'parent_id,num,older,return','close'=>0),
		'menulist'    =>  array('attr'=>'parent_id,num,older,return','level'=>4,),
        );


   public function _adminmenu($attr,$content)
   {
   
   

		$parent_id=$attr['parent_id'];
		$num=$attr['num']?$attr['num']:0;
		$older=$attr['older']?$attr['older']:"sort asc,id desc";
		$return=$attr['return']?$attr['return']:"data";
		$return = $this->autoBuildVar($return);
		
		if(':'==substr($parent_id,0,1))
			$parent_id = substr($parent_id,1);
		elseif('$'==substr($parent_id,0,1))
			$parent_id = $this->autoBuildVar(substr($parent_id,1));
		elseif(!is_numeric($parent_id))
		    $parent_id = $this->autoBuildVar($parent_id);
			
			
	   if(is_numeric($parent_id))
	   {
	       $where='"status=1 AND type=\'admin\' AND parent_id='.$parent_id.'"';
	   }
	   else
	   {
	       $where='"status=1  AND type=\'admin\' AND parent_id=".'.$parent_id;
	   }

        //开始生成PHP代码
		$parseStr   =  '<?php ';		
		$parseStr .= " \$__menu =D('Menu'); ";
		if($num)
		{
		   $parseStr .=$return.'=$__menu->where('.$where.')->order("'.$older.'")->limit('.$num.')->select(); ';
		}
		else
		{
		   $parseStr .=$return.'=$__menu->fetchSql(true)->where('.$where.')->order("'.$older.'")->select(); '; 
		
		}
		$parseStr .='  ?> '; 
		
			 return $parseStr;

   
   }
   
   
    public function _menulist($attr,$content)
   {
		$parent_id=$attr['parent_id']?$attr['parent_id']:0;
		$num=$attr['num']?$attr['num']:0;
		$older=$attr['older']?$attr['older']:"sort asc,id desc";
		$return=$attr['return']?$attr['return']:"v";
        //开始生成PHP代码	
		$__menu =D('Menu'); 
		if($num)
		{
		   $__menu_info=$__menu->where('status=1  AND type=\'admin\' AND parent_id='.$parent_id)->order($older)->limit($num)->select();
		}
		else
		{
		   $__menu_info=$__menu->where('status=1  AND type=\'admin\' AND parent_id='.$parent_id)->order($older)->select(); 
		
		}

        foreach($__menu_info as $k=>$v)
		{
		
		      $parseStr .= str_replace("{title}",$v['title'],$content);
		}

			 return $content.$parent_id;

   
   }
}
?>