<?php
// Database connection using mysqli
$mysqli = new mysqli("127.0.0.1","root","lsc606414lk", "demo");
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Prepare statement
$sql = "SELECT * FROM tree_lr";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Fetch results into an array
$array = array();
while ($row = $result->fetch_assoc()) {
    $array[] = $row;
}

// Optimize the lefttree() function
function lefttree($array){
    $tree = array();
    $categorylist = "";
    foreach ($array as $v) {
        $list = @$tree[$v['pid']] ?: array();
        $list[] = $v;
        $tree[$v['pid']] = $list;
    }
    if (is_array($tree[0])) {
        $categorylist = "<ul>\n";
        $categorylist .= sonTree($tree[0], $tree);
        $categorylist .= "</ul>\n";
    }
    return $categorylist;
}

function sonTree($arr, $tree, $level = 1) {
    $categorylist = "";
    foreach ($arr as $k => $v) {
        if ($tree[$v['id']]) {
            $categorylist .= "<li><a href=\"#\" style='color: ";
            $categorylist .= ($v['sex'] == '女') ? '#ff1493' : 'black';
            $categorylist .= ";'>{$v['name']}</a>\n";
            $categorylist .= "<ul>\n";
            $categorylist .= sonTree($tree[$v['id']], $tree, $level + 1);
            $categorylist .= "</ul>\n";
            $categorylist .= "</li>\n";
        } else {
            if ($v['is_link'] == 0) {
                $categorylist .= "<li><a href=\"#\" style='color: ";
                $categorylist .= ($v['sex'] == '女') ? '#ff1493' : 'black';
                $categorylist .= ";'>{$v['name']}</a></li>\n";
            }
        }
    }
    return $categorylist;
}

// Generate the menu
$menu = lefttree($array);
?>