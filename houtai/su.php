<!DOCTYPE html>
<html>
<head>
<title>族谱增删改查</title>
<script src="https://cdn.staticfile.org/jquery/3.6.0/jquery.min.js"></script>
<style>
.tree {
    font-size: 14px;
    line-height: 1.5;
}

.tree ul {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
}

.tree ul:before {
    content: "";
    display: block;
    width: 0;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-left: 1px solid #ccc;
}

.tree li {
    margin: 0;
    padding: 0 1em;
    line-height: 2em;
    color: #369;
    font-weight: bold;
    position: relative;
}

.tree li > span {
    display: inline-block;
    margin-left: 0.5em;
}

.tree li > span > a {
    display: inline-block;
    margin-right: 0.5em;
    color: #369;
    text-decoration: none;
}

.tree li > span > a:hover {
    color: #f00;
}

.tree li:before {
    content: "";
    display: block;
    width: 10px;
    height: 0;
    border-top: 1px solid #ccc;
    margin-top: -1px;
    position: absolute;
    top: 1em;
    left: 0;
}

.tree ul li:last-child:before {
    background: #fff;
    height: auto;
    top: 1em;
    bottom: 0;
}

.tree-buttons {
    display: inline-block;
    vertical-align: middle;
}
</style>
<body>
<?php
session_start();
require_once 'functions.php';

// 验证用户是否已登录，未登录则跳转到登录页面
if (!is_logged_in()) {
    $url = 'login.php?url=' . urlencode($_SERVER['REQUEST_URI']);
    redirect($url);
}

// 连接数据库
$link = mysqli_connect("127.0.0.1", "root", "root", "database");

// 查询所有节点
$query = "SELECT id, name, pid, L, R FROM tree_lr ORDER BY L ASC";
$result = mysqli_query($link, $query);

// 构建节点数组
$nodes = array();
while ($row = mysqli_fetch_assoc($result)) {
    $nodes[] = $row;
}

// 构建树状结构
$tree = array();
foreach ($nodes as $node) {
    $pid = $node['pid'];
    if (!isset($tree[$pid])) {
        $tree[$pid] = array();
    }
    $tree[$pid][] = $node;
}

// 递归构建树
function buildTree($tree, $parent_id, &$output) {
    if (isset($tree[$parent_id])) {
        $output .= "<ul>";
        foreach ($tree[$parent_id] as $node) {
            $output .= "<li>";
            $output .= $node['name'];
            $output .= "<span class='tree-buttons'>";
            $output .= "<button class='tree-add' data-id='{$node['id']}' title='增加子女'>增加</button>";
            $output .= "<button class='tree-edit' data-id='{$node['id']}' title='修改'>修改</button>";
            $output .= "<button class='tree-delete' data-id='{$node['id']}' title='删除'>删除</button>";
            $output .= "<a href='info2.php?id={$node['id']}' title='查看' target='_blank'>查看</a>";
            $output .= "<a href='infoedit2.php?id={$node['id']}' title='编辑' target='_blank'>编辑</a>";

            $output .= "</span>";
            buildTree($tree, $node['id'], $output);
            $output .= "</li>";
        }
        $output .= "</ul>";
    }
}

// 生成树形结构
$output = "";
buildTree($tree, 0, $output);

// 输出树形结构
echo "<div class='tree'>" . $output . "</div>";
?>

<script>
    // Function to handle the click event of the "edit" button
    function editNode(id, name) {
        // Show a confirmation dialog and ask for the new name
        var newName = prompt("请输入节点名称", name);
        if (newName != null) {
            if (confirm("确认修改为 '" + newName + "' 吗？")) {
                // Send an AJAX request to update the node's name in the database
               // Send an AJAX request to update the node's name in the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        // Show a success message
                        alert("修改成功");
                        // Reload the page to see the updated tree
                        location.reload();
                    } else {
                        // Show an error message
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

    // Add an event listener to all "edit" buttons
    var editButtons = document.getElementsByClassName("tree-edit");
    for (var i = 0; i < editButtons.length; i++) {
        editButtons[i].addEventListener("click", function() {
            var id = this.getAttribute("data-id");
            var name = this.parentNode.parentNode.firstChild.nodeValue.trim();
            editNode(id, name);
        });
    }
</script>
<script>
    $(document).ready(function() {
        // 监听增加按钮点击事件
        $('.tree-add').click(function() {
            var id = $(this).data('id');
            // 弹出输入框
            var name = prompt('请输入新成员的姓名');
            if (name !== null && name !== '') {
                // 发送 AJAX 请求新增成员
                $.ajax({
                    url: 'su/add.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {pid: id, name: name},
                    success: function(data) {
                        if (data.success) {
                            // 新增成功，弹出成功提示
                            alert("新增成功，恭喜家庭又增加了一名成员！");
                            // 刷新页面
                            location.reload();
                        } else {
                            // 新增失败，弹出失败提示
                            alert("新增失败，错误信息：" + data.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // 请求失败，弹出失败提示
                        alert("请求失败，错误信息：" + textStatus + " " + errorThrown);
                    }
                });
            }
        });
    });
</script>
<script>
$(document).on('click', '.tree-delete', function() {
    if (confirm('确定要删除该节点及其子孙吗？警告！！！删除后不可恢复！')) {
        var id = $(this).data('id');
        $.post('su/delete.php', {id: id}, function(data) {
            if (data.success) {
                // 删除成功，刷新页面
                alert('删除成功！');
                location.reload();
            } else {
                // 删除失败，显示错误信息
                alert('删除失败，请稍后再试！' + data.message);
            }
        }, 'json');
    }
});
</script>
</body>
</html>