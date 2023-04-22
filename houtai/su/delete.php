<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 连接数据库
    $link = mysqli_connect("127.0.0.1", "root", "root", "database");

    // 获取参数
    $id = $_POST['id'];

    // 查询当前节点的左右值
    $query = "SELECT L, R FROM tree_lr WHERE id = '{$id}'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $left = $row['L'];
    $right = $row['R'];

    // 计算当前节点及其子孙节点的数量
    $size = $right - $left + 1;

    // 删除当前节点及其子孙节点
    $query = "DELETE FROM tree_lr WHERE L BETWEEN '{$left}' AND '{$right}'";
    $result = mysqli_query($link, $query);

    if ($result) {
        // 更新左值和右值大于当前节点右值的节点的左右值
        $query = "UPDATE tree_lr SET L = L - '{$size}' WHERE L > '{$right}'";
        $result = mysqli_query($link, $query);

        $query = "UPDATE tree_lr SET R = R - '{$size}' WHERE R > '{$right}'";
        $result = mysqli_query($link, $query);

        // 删除成功，返回成功信息
        echo json_encode(array('success' => true));
    } else {
        // 删除失败，返回错误信息
        echo json_encode(array('success' => false, 'message' => '删除失败，请稍后再试！'));
    }

    // 关闭连接
    mysqli_close($link);
}
?>