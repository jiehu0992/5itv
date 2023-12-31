<?php
	ob_start(); // 开始输出缓冲区
// 权限验证及数据库连接
if (!isset($_SESSION)) {
    session_start();
}

require_once 'functions.php';

// 注销
if (isset($_POST['logout'])) {
    // 销毁会话
    session_unset();
    session_destroy();

    // 重定向到登录页面
    redirect('login.php');
}

// 验证用户是否已登录，未登录则跳转到登录页面
if (!is_logged_in()) {
    $url = 'login.php?url=' . urlencode($_SERVER['REQUEST_URI']);
    redirect($url);
}

require_once 'conn.php'; // 数据库连接
?>
<div class="center">
<!-- 注销按钮 -->
<form method="post" action="" style="display: inline-block; margin: auto;">
    <input type="submit" name="logout" value="注销">
</form>

<!-- 返回后台主页按钮 -->
<form action="su.php" style="display: inline-block;margin: auto;">
    <input type="submit" value="返回后台主页">
</form>
	</div>