<?php
// 在生产环境中隐藏用户错误
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 数据库配置
$host = "127.0.0.1";
$username = "root";//数据库账号
$password = "root";//数据库密码
$database = "familytree";//数据库名称

// 使用mysqli创建一个带有错误处理的连接
$link = @mysqli_connect($host, $username, $password, $database);

// 检查连接
if (!$link) {
    die("连接失败: " . mysqli_connect_error());
}

// 设置字符集为utf8
mysqli_set_charset($link, 'utf8');

// 函数用于清理和验证用户输入
function sanitize_input($link, $input) {
    // 在此实现输入验证和清理逻辑
    // 示例: $sanitized_input = mysqli_real_escape_string($link, $input);
    return $input;
}

// 使用预处理语句执行SQL查询
function execute_query($link, $sql, $params) {
    $stmt = mysqli_prepare($link, $sql);

    // 绑定参数
    if ($stmt && $params) {
        $types = str_repeat('s', count($params)); // 假设所有参数都是字符串
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    // 执行语句
    mysqli_stmt_execute($stmt);

    // 关闭语句
    mysqli_stmt_close($stmt);
}
?>