<?php
    require "conn.php";
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM tree_lr WHERE id=$id",$link);
    $sql_arr = mysql_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>查看详情_刘三才族裔刘氏族谱</title>
</head>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<!--主要样式-->
<script type="text/javascript" src="/js/context-menu.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<body>

	<div class="tree well">
	<div align=center>
    刘<?php echo $sql_arr['name']?>编号:</label><input type="text" name="id" value="<?php echo $sql_arr['id']?>" readonly="readonly">
    刘<?php echo $sql_arr['name']?>父亲编号：</label><input type="text" name="pid" value="<?php echo $sql_arr['pid']?>" readonly="readonly">
    <table align="center" cellpadding="0" cellspacing="0" style="width: 80%;height:100%">

    <tr>
    <td>
    	<p>
    		姓名：<?php echo $sql_arr['name']?>
    	</p>
		<p>
    		性别：<?php echo $sql_arr['sex']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
    		配偶：<?php echo $sql_arr['wname']?>
    	</p>
		<p>
    		排行:<?php echo $sql_arr['rank']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
			世代：<?php echo $sql_arr['dc']?>
    	</p>
		<p>	字辈：<?php echo $sql_arr['zibei']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;
            祖父：<?php echo $sql_arr['gdad']?>

    	</p>
		<p>
            父亲：<?php echo $sql_arr['dad']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            母亲：<?php echo $sql_arr['wname']?>
		</p>
        <p>
            兄弟：<?php echo $sql_arr['brother']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            姐妹：<?php echo $sql_arr['sisters']?>
        </p>

        <p>
            儿子：<?php echo $sql_arr['son']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            女儿：<?php echo $sql_arr['daughter']?>
        </p>
		<p>
			生平：<?php echo $sql_arr['info']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            其它：<?php echo $sql_arr['other']?>
		</p>
		<p>
			国籍：<?php echo $sql_arr['nation']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			籍贯：<?php echo $sql_arr['jiguan']?>
    	</p>
		<p>
			字：<?php echo $sql_arr['zi']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			号：<?php echo $sql_arr['hao']?>
		</p>
		<p>
			曾用名：<?php echo $sql_arr['rname']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			生日:<?php echo $sql_arr['year']?>
    	</p>
		<p>
			出生地：<?php echo $sql_arr['birthadresse']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			居住地：<?php echo $sql_arr['lifeadresse']?>
		</p>
		<p>
			通讯：<?php echo $sql_arr['tongxun']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			婚姻：<?php echo $sql_arr['marriage']?>
    	</p>
		<p>
			姐妹：<?php echo $sql_arr['sisters']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			继嗣：<?php echo $sql_arr['jisi']?>
    	</p>
		<p>
			职业：<?php echo $sql_arr['zhiye']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			学历：<?php echo $sql_arr['xueli']?>
    	</p>
		<p>
			祭日：<?php echo $sql_arr['dieday']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			墓地：<?php echo $sql_arr['mudi']?>
		</p>
		<p>
			统计：<?php echo $sql_arr['tongji']?>
		</p>
    	</td>
    	</tr>
		</table>
			<a href="infoedit2.php?id=<?php echo $id;?>">再次编辑</a>
   		</div>
   			</div>
</body>
</html>
