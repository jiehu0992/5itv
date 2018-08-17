 <html>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />	 
<!--主要样式-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<body>
	<form action="" method="get">
	关键字：
	<input type="text" name="key" />
	<input type="submit" name="sub" value="搜索" />
	</form>
	<?php
include("conn.php");//数据库连接
	if($_GET['key']) {
		
		$sql = "SELECT * FROM `tree_lr` WHERE name LIKE '%$_GET[key]%'";
		$query = mysql_query($sql);
				while($r=mysql_fetch_array($query)) {
			echo "<ul><li><a href=\"info.php?id=".$r["id"]."\" target=\"_blank\">$r[name]</li></ul>"."<br>代次:第$r[dc]世代,辈分：$r[zibei]";
		}
	}
	
?>
	</body>
</html>