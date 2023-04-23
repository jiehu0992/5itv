<?php
// 检查用户是否已登录
function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
}

// 重定向页面
function redirect($url) {
    header("Location: $url");
    exit();
}
?>
