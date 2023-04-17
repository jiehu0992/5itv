<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'dataname';

// Create a new MySQLi object
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die('连接数据库服务器失败！' . $mysqli->connect_error);
}

// Set encoding to UTF-8
if (!$mysqli->set_charset('utf8')) {
    die('设置编码失败！');
}
/*
<?php
$link = mysqli_connect("127.0.0.1", "root", "root", "dbname");
if (!$link) {
    die("连接失败: " . mysqli_connect_error());
}
?>
*/ 如果不成功就直接用下面这个
?>
