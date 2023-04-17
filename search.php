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
	if(isset($_GET['key']) && !empty($_GET['key'])) {
		$db = new mysqli('127.0.0.1','root','root','dataname');
		if ($db->connect_errno) {
			echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
			exit();
		}
		
		$key = '%'.$db->real_escape_string($_GET['key']).'%';
		$sql = "SELECT * FROM `tree_lr` WHERE name LIKE ?";
		$stmt = $db->prepare($sql);
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
				
				echo "<tr><td>字辈：$zibei<li><a href='info.php?id=$id' target='_blank'><b>$name</b></a></li></td><td>父亲：<a href='info.php?id=$pid' target='_blank'><font color='red'>刘$dad</font></a>，祖父：<font color='red'>刘$gdad</font>。简介：$info</td></tr>";
			}
			
			echo "</table></div>";
		} else {
			echo "<div align='center'>没有找到结果</div>";
		}
		
		$stmt->close();
		$db->close();
	}
	?>
</body>
</html>