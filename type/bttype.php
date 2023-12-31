<?php
// Include the connection file (conn.php)
include('../conn.php');

// Your existing code
$sql = "SELECT * FROM tree_lr";
$stmt = mysqli_prepare($link, $sql);

if (!$stmt) {
    die("Error in preparing the statement: " . mysqli_error($link));
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch results into an array
$array = array();
while ($row = mysqli_fetch_assoc($result)) {
    $array[] = $row;
}

// Optimize the lefttree() function
function lefttree($array)
{
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

function sonTree($arr, $tree, $level = 1)
{
    $categorylist = "";
    foreach ($arr as $k => $v) {
        $categorylist .= "<li><a href=\"#\" style='color: ";
        $categorylist .= (isset($v['sex']) && $v['sex'] == '女') ? '#ff1493' : 'black';
        $categorylist .= ";'>{$v['name']}</a>\n";

        // Check if the current item has children
        if (isset($tree[$v['id']])) {
            $categorylist .= "<ul>\n";
            $categorylist .= sonTree($tree[$v['id']], $tree, $level + 1);
            $categorylist .= "</ul>\n";
        }

        $categorylist .= "</li>\n";
    }
    return $categorylist;
}


// Generate the menu
$menu = lefttree($array);

// Close the connection
if ($link && mysqli_ping($link)) {
    mysqli_close($link);
}

echo $menu;
?>
