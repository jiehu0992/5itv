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
				$categorylist.="<li><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a>\n字辈：".$v["zibei"]."，刘氏第".$v["dc"]."世代，妻子：".$v["wname"]."。平生简介：".$v["info"]."";
				$categorylist.="<ul>\n";
				$categorylist.=sonTree($tree[$v["id"]],$tree,0,$type);
				$categorylist.="</ul>\n";
				$categorylist.="</li>\n";
			}else{
				if($v["is_link"]==0){
				/*	$categorylist.="<li><span><i class=\"icon-minus-sign\"></i> ".$v["name"]."</span> </li>\n".$v["info"]."";*/
					$categorylist.="<li><span><i class=\"icon-minus-sign\"></i><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a></li>\n".$v["info"]."";
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
			$categorylist.="<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
			$categorylist.="<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a><ul>\n";
			$categorylist.=sonTree($tree[$v2["id"]],$tree,$level,$type);
			$categorylist.="</ul>\n";
			$categorylist.="</li>\n";
		}else{
			if($v["is_link"]==0){
			/*	$categorylist.="<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n字辈：<font color=\"red\">".$v2["zibei"]."</font>，刘氏第<font color=\"red\">".$v2["dc"]."</font>世代，妻子：<font color=\"red\">".$v2["wname"]."</font>。平生简介：".$v2["info"]."</li>";*/
					$categorylist.="<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a>";
			}
		}
	}
	return $categorylist;
}


$menu=lefttree();//调用函数

?>