<?php
include("conn.php");//数据库连接
$array=array();
$sql=mysql_query("select * from tree_lr");
		while ($row=mysql_fetch_array($sql)){
			$array[]=$row;         //查出数据保存到数组中
		}


//后台左侧循环树形栏目
function lefttree(){
	global $array; //设置全局变量
	$tree = array();
	$categorylist="";
	if( $array ){
		foreach ( $array as $v ){
			//$pt = $v['pid'];
			$pt = $v['pid'];
			$list = @$tree[$pt] ? $tree[$pt] : array();
			array_push( $list, $v );
			$tree[$pt] = $list;
		}
	}
	if(is_array($tree[0])){
		$i = 0;
		foreach($tree[0] as $k=>$v){
			$i++;
			if($tree[$v["id"]]){
				$categorylist.=" 
<div class=\"level top_line\"><div class=\"level_name\">第".$v["dc"]."世代</div>
					<div class=\"member\">
        <div style=\"\" class=\"member_name\">".$v["name"]."</div>
        <div  class=\"member_desc\">".$v["info"]."</div> </div>	    
        	 
        		</div>";
				$categorylist.="\n";
				$categorylist.=sonTree($tree[$v["id"]],$tree,0,$type);
			}else{
				if($v["is_link"]==0){
					$categorylist.=" ".$v["name"]." ".$v["info"]."	</div>";
				}
			}
		}
	}
	return $categorylist;
}


function sonTree($arr,$tree,$level,$type){
	$level++;
	$ii=0;
	foreach($arr as $k2=>$v2){
		$ii++;

		if($tree[$v2["id"]]){
			$categorylist.="<div class=\"level top_line\"><div class=\"level_name\">第".$v2["dc"]."世代</div>
				<div class=\"member\">
        <div style=\"\" class=\"member_name\">".$v2["name"]."</div>
        <div  class=\"member_desc\">".$v2["info"]."</div>      
        	</div>          </div>	";
				$categorylist.="	 \n";
			$categorylist.=sonTree($tree[$v2["id"]],$tree,$level,$type);
		}else{
			if($v["is_link"]==0){
				$categorylist.="<div class=\"level top_line\"> <div class=\"level_name\">第".$v2["dc"]."世代</div>
					<div class=\"member\">
        <div style=\"\" class=\"member_name\">".$v2["name"]."</div>
        <div  class=\"member_desc\">".$v["info"]."</div>      
        			</div>   	</div>        	";
				$categorylist.="\n";
			}
		}
	}
	return $categorylist;
}


$menu=lefttree();//调用函数

?>