<?php
    require "conn.php";
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM tree_lr WHERE id=$id",$link);
    $sql_arr = mysql_fetch_assoc($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刘三才后裔刘氏家族族谱树</title>
<meta name="keywords" content="刘氏族谱,族谱,刘氏家谱,家谱树,爱视传媒">
<meta name="description" content="自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地">
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
			父亲：<?php echo $sql_arr['dad']?>
    	</p>
		<p>世代：<?php echo $sql_arr['dc']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		    祖父：<?php echo $sql_arr['gdad']?>
			
    	</p>
		<p>
			字辈：<?php echo $sql_arr['zibei']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;	
			兄弟：<?php echo $sql_arr['brother']?>
		</p>
		<p>
				生平：<?php echo $sql_arr['info']?>
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
			统计：<?php echo $sql_arr['tongji']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			其它：<?php echo $sql_arr['other']?>
		</p>
    	</td>
    	</tr>
		</table>
		
   		</div>
   			</div>
</body>
</html>