<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>搜索页面</title>
<script type="text/javascript" src="/js/context-menu.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<head>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
		}
		
		h1 {
			text-align: center;
			font-size: 24px;
			margin-top: 30px;
			margin-bottom: 20px;
		}
		
		form {
			margin: 20px auto;
			max-width: 500px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		input[type="text"] {
			padding: 5px;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 3px;
			flex-grow: 1;
			margin-right: 10px;
		}
		
		input[type="submit"] {
			padding: 5px 10px;
			font-size: 14px;
			border: none;
			border-radius: 3px;
			background-color: #0066cc;
			color: #fff;
			cursor: pointer;
		}
		
		table {
			border-collapse: collapse;
			margin: 20px auto;
			max-width: 900px;
			width: 100%;
			font-size: 14px;
		}
		
		thead {
			background-color: #f1f1f1;
		}
		
		th {
			padding: 8px;
			font-weight: bold;
			text-align: left;
		}
		
		td {
			padding: 8px;
			border: 1px solid #ddd;
		}
		
		a {
			color: #0066cc;
			text-decoration: none;
		}
		
		a:hover {
			text-decoration: underline;
		}
		
		.result-message {
			text-align: center;
			font-size: 18px;
			margin-top: 30px;
		}
	</style>
</head>
	<body>
	<h1>刘三才族裔刘氏族谱搜索</h1>
	<div align="center">
		<form action="" method="get">
			关键字：
			<input type="text" name="key" />
			<input type="submit" name="sub" value="搜索" />
		</form>
	</div>
	<?php
   require_once 'common.php';
	if(isset($_GET['key']) && !empty($_GET['key'])) {
		if ($link->connect_errno) {
			echo "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
			exit();
		}
		
		$key = '%'.$link->real_escape_string($_GET['key']).'%';
		$sql = "SELECT * FROM `tree_lr` WHERE name LIKE ?";
		$stmt = $link->prepare($sql);
		$stmt->bind_param('s', $key);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows > 0) {
			echo "<div class='tree well'>";
			echo "<table border='0'>";
			
			while($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$name = $row['name'];
				$dc = $row['dc'];
				$zibei = $row['zibei'];
				$pid = $row['pid'];
				$dad = $row['dad'];
				$gdad = $row['gdad'];
				$birthadresse = $row['birthadresse'];
				$info = $row['info'];
				
				echo "<tr>";
  echo "<td>字辈：$zibei<li><a href='info2.php?id=$id' target='_blank'><b>$name</b></a></li></td>";
  echo "<td>父亲：<a href='info2.php?id=$pid' target='_blank'><font color='red'>刘$dad</font></a>，祖父：<font color='red'>刘$gdad</font>。简介：$info</td>";
    echo "<td><button class='tree-add' data-id='$id' title='增加子女'>增加</button></td>";
    echo "<td><button onclick=\"window.location.href='infoedit2.php?id=$id'\" title=\"编辑\">编辑</button></td>";
    echo "<td><button onclick=\"window.location.href='info2.php?id=$id'\" title=\"详情\">详情</button></td>";
    echo "<td><button onclick=\"window.location.href='su.php'\" title=\"超级管理\">超级管理</button></td>";

  echo "</tr>";
}
			
			echo "</table></div>";
		} else {
			echo "<div align='center'>没有找到结果</div>";
		}
		
		$stmt->close();
		$link->close();
	}
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
</body>
</html>