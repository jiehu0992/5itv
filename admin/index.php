<!DOCTYPE html>
<html lang="en">

<head>
    <title>后台管理</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th:first-child, td:first-child {
            padding-left: 0;
        }

        th:last-child, td:last-child {
            padding-right: 0;
        }

        .navbar {
            margin-bottom: 10px;
            background-color: #f8f8f8;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .navbar-nav {
            display: flex;
        }

        .navbar-nav li {
            text-align: center;
            margin: 0 10px;
        }

        .navbar-nav li a {
            font-size: 16px;
            display: block;
            padding: 10px;
            color: #333;
        }

        .navbar-nav li a:hover {
            background-color: #ddd;
        }

        h1 {
            font-size: 24px;
            margin: 10px;
        }

       form {
            max-width: 40%;
            margin: 10px auto;
        }

        input[type="text"] {
            width: 30%;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
            padding: 10px;
            font-size: 16px;
        }
	.table-container {
            overflow-x: auto;
            margin: 0 auto; /* Center the table horizontally */
        }

        table {
            width: 80%;
            overflow-x: auto; /* Enable horizontal scrolling on small screens */
        }


        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .tree table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree table td, .tree table th {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .tree button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .tree button:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li><a href="/type/os.php">欧式族谱</a></li>
                <li><a href="/type/bt.php">塔式族谱</a></li>
                <li><a href="su.php">增改删</a></li>
                <li><a href="search.php">搜索</a></li>
            </ul>
        </div>
    </nav>
    <h1>刘三才族裔刘氏族谱搜索</h1>
    <div align="center">
        <form action="" method="get">
            <label for="key">关键字：</label>
            <input type="text" id="key" name="key" />
    <p></p>
            <input type="submit" name="sub" value="搜索" />
        </form>
    </div>
    
<?php
require_once 'common.php';

// 检查是否有关键词，并确保不为空
if (isset($_GET['key']) && !empty($_GET['key'])) {
    $key = '%' . $link->real_escape_string($_GET['key']) . '%';

    // 构建 SQL 查询
    $sql = "SELECT * FROM `tree_lr` WHERE name LIKE ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $result = $stmt->get_result();

    // 如果有查询结果
    if ($result->num_rows > 0) {
        echo "<div class='tree well' align='center'>";
        echo "<table border='0'>";
        echo "<tr>";
        echo "<th>族谱信息</th>";
        echo "<th>家庭关系</th>";
        echo "<th colspan='4' style='text-align: center;'>操作</th>";
        echo "</tr>";

        $rowIndex = 0; // 初始化 $rowIndex

        // 遍历查询结果
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $dc = $row['dc'];
            $zibei = $row['zibei'];

            $pid = $row['pid'];
            $dad = $row['dad'];
            $gdad = $row['gdad'];
            $birthadresse = $row['birthadresse'];
            $info = $row['info'];

            // 输出查询结果的基本信息
            echo "<tr class='result-row'>";
            echo "<td><a href='info2.php?id=$id' target='_blank'><b style='color:red'>$name</b></a></td>";

            // 输出家庭关系信息
            echo "<td>$zibei 字辈，父亲：<a href='info2.php?id=$pid' target='_blank'><font color='red'>刘$dad</font></a>，祖父：<font color='red'>刘$gdad</font>。简介：$info</td>";

            // 操作按钮
            echo "<td><button onclick=\"window.location.href='infoedit2.php?id=$id'\" title=\"编辑\">编辑</button></td>";
            echo "<td><button onclick=\"window.location.href='info2.php?id=$id'\" title=\"详情\">详情</button></td>";
            echo "<td><button onclick=\"window.location.href='su.php'\" title=\"超级管理\">超级管理</button></td>";
            $rowIndex++;

            // 输出当前 $pid 下的家谱树结构
            echo "<tr class='tree-structure'>";
            echo "<td colspan='6'>";
            echo "<div class='sub-tree'>";
            displayTree($link, $pid, $dc, $dad, $id, 1);  // 传递 $dc 代表当前的第几代
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table></div>";
    } else {
        echo "<div align='center'>没有找到结果</div>";
    }

    $stmt->close();
    $link->close();
}

// 递归函数用于显示家谱树
function displayTree($link, $pid, $dc, $dadName, $parentId, $indent) {
    if ($indent > 5) {
        return; // 限制只展示5代人
    }

    $sql = "SELECT * FROM `tree_lr` WHERE pid = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('i', $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $current_dc = $row['dc'];
            $id = $row['id'];
            $zibei = $row['zibei'];  // 直接从数据库中获取

            // 输出家谱树结构
            echo str_repeat('&nbsp;', $indent * 4);
            echo "└── <b>$name</b>  [$current_dc 代，$zibei 字辈] (父亲：$dadName)<br>";  // 使用连接符连接字符串

            // 递归调用
            displayTree($link, $id, $current_dc, $name, $parentId, $indent + 1);
        }
    }

    $stmt->close();
}
?>

    <script>
    // 处理“编辑”按钮点击事件的函数
    function editNode(id, name) {
        // 显示确认对话框并询问新名称
        var newName = prompt("请输入节点名称", name);
        if (newName != null) {
            if (confirm("确认修改为 '" + newName + "' 吗？")) {
                // 发送 AJAX 请求以在数据库中更新节点的名称
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            // 显示成功消息
                            alert("修改成功");
                            // 重新加载页面以查看更新后的树
                            location.reload();
                        } else {
                            // 显示错误消息
                            alert("修改失败");
                        }
                    }
                };
                xhr.open("POST", "su/update.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("id=" + id + "&name=" + newName);
            }
        }
    }

    // 为所有“编辑”按钮添加事件监听器
    var editButtons = document.getElementsByClassName("tree-edit");
    for (var i = 0; i < editButtons.length; i++) {
        editButtons[i].addEventListener("click", function () {
            var id = this.getAttribute("data-id");
            var name = this.parentNode.parentNode.firstChild.nodeValue.trim();
            editNode(id, name);
        });
    }
</script>
</body>

</html>
