<?php
//家谱树内数据，需配合主页的index.php使用
include __DIR__ . '/../conn.php';// 或者使用 require 'conn.php';

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
            // 添加对 "zibei"、"wname"、"info" 字段的检查
            $v["zibei"] = isset($v["zibei"]) ? $v["zibei"] : "";
            $v["wname"] = isset($v["wname"]) ? $v["wname"] : "";
            $v["info"] = isset($v["info"]) ? $v["info"] : "";
            $v["is_link"] = isset($v["is_link"]) ? $v["is_link"] : null;

            if($tree[$v["id"]]){
                $categorylist.="<li><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a>";
                $categorylist.="<ul>\n";
                $categorylist.=sonTree($tree[$v["id"]],$tree,0,$v);
                $categorylist.="</ul>\n";
                $categorylist.="</li>\n";
            }else{
                if($v["is_link"]==0){
                    $categorylist.="<li><span><i class=\"icon-minus-sign\"></i><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a></li>\n".$v["info"]."";
                }
            }
        }
    }
    return $categorylist;
}

function sonTree($arr, $tree, $level, $v) {
    $level++;
    $ii = 0;
    $categorylist = "";
    foreach ($arr as $k2 => $v2) {
        $ii++;

        // 添加对 "dc" 字段的检查
        $dc = isset($v2["dc"]) ? $v2["dc"] : "";

        // 添加对 "is_link" 字段的检查
        $v2["is_link"] = isset($v2["is_link"]) ? $v2["is_link"] : null;

        // 添加对 "sex" 字段的检查
        $sex = isset($v2["sex"]) ? $v2["sex"] : "";

        if ($v2["is_link"] === 0) {
            $sex_color = ($sex == "女") ? "color:#ff1493;" : "";
            $categorylist .= "<li><span style=\"$sex_color\"><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
            $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a>";

            // 只有在存在dc字段时才输出
            if ($dc !== "") {
                $categorylist .=  $dc."世代" ;
            }

            $categorylist .= "</li>\n".(isset($v2["info"]) ? $v2["info"] : "");
        }

        if (isset($tree[$v2["id"]])) {
            $categorylist .= "<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
            $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a><ul>\n";
            $categorylist .= sonTree($tree[$v2["id"]], $tree, $level, $v2);
            $categorylist .= "</ul>\n";
            $categorylist .= "</li>\n";
        } else {
            if ($v["is_link"] == 0) {
                $sex_color = ($sex == "女") ? "color:#ff1493;" : "";
                $categorylist .= "<li><span style=\"$sex_color\"><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
                $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a>";

                // 只有在存在dc字段时才输出
                if ($dc !== "") {
                    $categorylist .= $dc."世代" ;
                }

                $categorylist .= "</li>\n".(isset($v2["info"]) ? $v2["info"] : "");
            }
        }
    }
    return $categorylist;
}

$type = ''; // 在调用前定义$type
$menu = lefttree($type); // 调用函数时传递$type

if ($link && mysqli_ping($link)) {
    mysqli_close($link);
}
?>
