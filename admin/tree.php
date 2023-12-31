<?php
// 家谱树内数据，需配合主页的index.php使用
require_once 'common.php';

// 准备查询以获取总行数和最大世代
$stmt = mysqli_prepare($link, "SELECT COUNT(*) AS total, MAX(dc) AS maxdc FROM tree_lr WHERE name NOT LIKE ?");
$search_term = '%出%';
mysqli_stmt_bind_param($stmt, 's', $search_term);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $total, $maxdc);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// 准备查询以获取所需的数据
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

// 后台左侧循环树形栏目
function lefttree($type = '') {
    global $array; // 设置全局变量
    $tree = array();
    $categorylist = "";
    if ($array) {
        foreach ($array as $v) {
            $pt = $v['pid'];
            $list = @$tree[$pt] ? $tree[$pt] : array();
            array_push($list, $v);
            $tree[$pt] = $list;
        }
    }
    if (is_array($tree[0])) {
        $i = 0;
        foreach ($tree[0] as $k => $v) {
            $i++;
            // 添加对 "zibei"、"wname"、"info" 字段的检查
            $v["zibei"] = isset($v["zibei"]) ? $v["zibei"] : "";
            $v["wname"] = isset($v["wname"]) ? $v["wname"] : "";
            $v["info"] = isset($v["info"]) ? $v["info"] : "";
            $v["is_link"] = isset($v["is_link"]) ? $v["is_link"] : null;

            if ($tree[$v["id"]]) {
                $categorylist .= "<li><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a>";
                $categorylist .= "<ul>\n";
                $categorylist .= sonTree($tree[$v["id"]], $tree, 0, $v, $type);
                $categorylist .= "</ul>\n";
                $categorylist .= "</li>\n";
            } else {
                if ($v["is_link"] == 0) {
                    $categorylist .= "<li><span><i class=\"icon-minus-sign\"></i><a href=\"info.php?id=".$v["id"]."\" target=\"_blank\">".$v["name"]."</a></li>\n".$v["info"]."";
                    $categorylist .= "<a href='infoedit2.php?id=".$v["id"]."' target='_blank'>详细编辑</a> | <button class='tree-add' data-id='".$v["id"]."' title='增加子女'>增加子女</button>";
                }
            }
        }
    }
    return $categorylist;
}

function sonTree($arr, $tree, $level, $v, $type = '') {
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
            $categorylist .= "<a href='infoedit2.php?id=".$v2["id"]."' target='_blank'>详细编辑</a> | <button class='tree-add' data-id='".$v2["id"]."' title='增加子女'>增加子女</button>";
        }

        if (isset($tree[$v2["id"]])) {
            $categorylist .= "<li><span><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
            $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a> | <a href='infoedit2.php?id=".$v2["id"]."' target='_blank'>详细编辑</a> | <button class='tree-add' data-id='".$v2["id"]."' title='增加子女'>增加子女</button><ul>\n";
            $categorylist .= sonTree($tree[$v2["id"]], $tree, $level, $v2, $type);
            $categorylist .= "</ul>\n";
            $categorylist .= "</li>\n";
        } else {
            if ($v["is_link"] == 0) {
                $sex_color = ($sex == "女") ? "color:#ff1493;" : "";
                $categorylist .= "<li><span style=\"$sex_color\"><i class=\"icon-minus-sign\"></i>".$v2["name"]."</span>\n";
                $categorylist .= "<a href=\"info.php?id=".$v2["id"]."\" target=\"_blank\">详细</a> |";
                $categorylist .= "<a href='infoedit2.php?id=".$v2["id"]."' target='_blank'>详细编辑</a> | <button class='tree-add' data-id='".$v2["id"]."' title='增加子女'>增加子女</button>";               
                $categorylist .= "</li>\n".(isset($v2["info"]) ? $v2["info"] : "");
            }
        }
    }
    return $categorylist;
}

$type = ''; // 在调用前定义$type
$menu = lefttree($type); // 调用函数时传递$type
?>

   <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
 <script>
        $(document).ready(function () {
            // 监听增加子女按钮点击事件
            $('.tree-add').click(function () {
                var id = $(this).data('id');
                // 弹出输入框
                var name = prompt('请输入新成员的姓名');
                if (name !== null && name !== '') {
                    // 发送 AJAX 请求新增成员
                    $.ajax({
                        url: 'su/add.php',
                        type: 'POST',
                        dataType: 'json',
                        data: { pid: id, name: name },
                        success: function (data) {
                            if (data.success) {
                                // 新增成功，弹出成功提示
                                alert("新增成功，恭喜家庭又增加子女了一名成员！");
                                // 刷新页面
                                location.reload();
                            } else {
                                // 新增失败，弹出失败提示
                                alert("新增失败，错误信息：" + data.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            // 请求失败，弹出失败提示
                            alert("请求失败，错误信息：" + textStatus + " " + errorThrown);
                        }
                    });
                }
            });
        });
    </script>