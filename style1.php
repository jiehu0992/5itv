<?php
$servername = "localhost";
$username = "root";
$password = "lsc606414lk";
$dbname = "demo";
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
$menu = '';
for ($i = 1; $i <= $max; $i++) {
    $sql = "SELECT * FROM tree_lr WHERE dc = {$i}";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $array[$i][] = $row;
    }
    if ($i % 6 === 0 || $i === $max) {
        $group = intval($i / 6);
        $menu .= "<div class='panel panel-default'>";
        $menu .= "<div class='panel-heading'><h3 class='panel-title'>第 {$group} 组</h3></div>";
        $menu .= "<div class='panel-body'>";
        foreach ($array as $key => $value) {
            if ($key >= ($group - 1) * 6 + 1 && $key <= $group * 6) {
                $menu .= "<div class='level'>";
                $menu .= "<div class='level_name'>{$key}世代</div>";
                foreach ($value as $item) {
                    $menu .= "<div class='member'>{$item['name']}</div>";
                }
                $menu .= "</div>";
            }
        }
        $menu .= "</div>";
        $menu .= "</div>";
    }
}
echo $menu;
mysqli_close($conn);
?>
<style>
    .panel {
        margin-top: 20px;
    }

    .level {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .level_name {
        flex-basis: 100%;
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .member {
        text-align: center;
        width: 100px;
        height: 50px;
        line-height: 50px;
        margin: 5px;
        border: 1px solid #333;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 1px 1px 5px #ccc;
    }

    .member:hover {
        background-color: #fff;
        box-shadow: 1px 1px 5px #666;
    }

    @media (max-width: 768px) {
        .level {
            flex-direction: column;
            align-items: center;
        }

        .level_name {
            margin-top: 20px;
            margin-bottom: 5px;
        }
    }
</style>
