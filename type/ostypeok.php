<?php
//欧式谱文字内容，需配合os.php使用
// Include the connection file (conn.php)
include('../conn.php');

// Your existing code
$array = array();
$sql = "SELECT MAX(dc) FROM tree_lr";
$res = mysqli_query($link, $sql); // 将 $conn 改为 $link
$test = array();
while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $test[] = $row;
}
$max = (int) $test[0]['MAX(dc)'];

for ($i = 1; $i <= $max; $i++) {
    $sql = "SELECT * FROM tree_lr WHERE dc = ?";
    $stmt = mysqli_prepare($link, $sql); // 将 $conn 改为 $link
    mysqli_stmt_bind_param($stmt, 'i', $i);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $array[$i][] = $row;
    }
    mysqli_stmt_close($stmt);
}

$menu = '';
foreach ($array as $key => $value) {
    $menu .= "<div class='level top_line'>
       <div class='level_name'>{$key}世代</div>";
    foreach ($value as $item) {
        $menu .= '<div class="member">
        <div style="" class="member_name">' . $item['name'] . '</div>
        <div class="member_desc">' . $item['dad'] . '' . $item['rank'] . '，祖父：' . $item['gdad'] . ',兄弟：' . $item['brother'] . '、姊妹：' . $item['sisters'] . '。<br/>' . $item['info'] . '</div>
      </div>';
    }
    $menu .= "</div>";
}

echo $menu;

// Close the connection
if ($link && mysqli_ping($link)) {
    mysqli_close($link);
}
?>
