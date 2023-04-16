<?php
include("conn.php");//数据库连接
// Prepare the query to get the total number of rows and max dc
$stmt = mysqli_prepare($link, "SELECT COUNT(*) AS total, MAX(dc) AS maxdc FROM tree_lr WHERE name NOT LIKE ?");
$search_term = '%出%';
mysqli_stmt_bind_param($stmt, 's', $search_term);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $total, $maxdc);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Prepare the query to fetch the required data
$stmt = mysqli_prepare($link, "SELECT id, name, pid, sex, dc FROM tree_lr");
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $name, $pid, $sex, $dc);

$array = array();
while (mysqli_stmt_fetch($stmt)) {
    $array[] = array(
        'id' => $id,
        'name' => $name,
        'pid' => $pid,
        'sex' => $sex,
        'dc' => $dc
    );
}
mysqli_stmt_close($stmt);

echo "<div style='position: fixed;margin: 0 auto;width: 100%;top: 0.6rem;z-index: -1;text-align: right;color: #1b7ac5;'>截至今日，本族共繁衍 ".$maxdc." 代，总计 ".$total." 人。</div>";


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


function sonTree($arr, $tree, $level, $type) {
    $level++;
    $ii = 0;
    foreach ($arr as $k2 => $v2) {
        $ii++;

        if ($tree[$v2["id"]]) {
            $categorylist .= "<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
            $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a><ul>\n";
            $categorylist .= sonTree($tree[$v2["id"]], $tree, $level, $type);
            $categorylist .= "</ul>\n";
            $categorylist .= "</li>\n";
        } else {
            if ($v["is_link"] == 0) {
                $sex_color = ($v2["sex"] == "女") ? "color:#ff1493;" : "";
                $categorylist .= "<li><span style=\"$sex_color\"><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
                $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a>";
            }
        }
    }
    return $categorylist;
}



$menu=lefttree();//调用函数

?>