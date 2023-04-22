<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 连接数据库
    $link = mysqli_connect("127.0.0.1", "root", root, "database");

    // 获取参数
    $pid = $_POST['pid'];
    $name = $_POST['name'];

    // 查询当前节点的右值
    $query = "SELECT R FROM tree_lr WHERE id = '{$pid}'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $r = $row['R'];

    // 将当前节点右侧的节点的左值都加2
    $query = "UPDATE tree_lr SET L = CASE WHEN L > '{$r}' THEN L + 2 ELSE L END, R = R + 2 WHERE R >= '{$r}'";
    $result = mysqli_query($link, $query);

    // 插入数据，并设置左值和右值
    $query = "INSERT INTO tree_lr(name, pid, L, R, sex) VALUES ('{$name}', '{$pid}', '{$r}', '".($r+1)."', '男')";
    $result = mysqli_query($link, $query);

    if ($result) {
        // 新增成功，返回成功信息
        echo json_encode(array('success' => true));
    } else {
        // 新增失败，返回错误信息
        echo json_encode(array('success' => false, 'message' => '新增失败，请稍后再试！'));
    }

    // 关闭连接
    mysqli_close($link);
}

?>