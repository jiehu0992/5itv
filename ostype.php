<?php
$servername = "localhost";  $username = "root";$password = "root";$dbname = "database";
$conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    $array = array();
    $sql = "SELECT MAX(dc) FROM tree_lr";
    $res = mysqli_query($conn, $sql);
    $test = array();
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $test[] = $row;
    }
    $max = (int) $test[0]['MAX(dc)'];    
    for ($i = 1; $i < $max; $i++) {
        $sql = "SELECT * FROM tree_lr WHERE dc = {$i}";
        $res = mysqli_query($conn, $sql);    
        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
            $array[$i][] = $row;
        }
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
 if ($link && mysqli_ping($link)) {
    mysqli_close($link);
}
?>