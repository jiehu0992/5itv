<?php
$mysqli = mysqli_connect('localhost', 'root', 'root', 'dataname');
mysqli_query($mysqli, "SET NAMES gbk");
if (!$mysqli) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
$sql = 'SELECT * FROM tree_lr';
$res = mysqli_query($mysqli, $sql);

if (!$res) {
    die('Error: ' . mysqli_error($mysqli));
}

$array = array();
while ($row = mysqli_fetch_row($res)) {
    $menu = array(
        "id" => $row[0],
        "pId" => $row[1],
        "name" => urlencode(iconv('gbk', 'utf-8', $row[2])),
        "open" => 1,
        "file" => $row[4],
    );
    array_push($array, $menu);
}
echo json_encode($array);

mysqli_close($mysqli);
?>