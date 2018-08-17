<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刘三才后裔刘氏家族族谱树</title>
<meta name="keywords" content="刘氏族谱,族谱,刘氏家谱,家谱树,爱视传媒">
<meta name="description" content="自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<!--主要样式-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
.page {
	width: 1000px;
	height:500px;height:auto;min-height:500px;
	margin: 0 auto;
	border: 2px solid #000;
	padding: 10px;
}
.top_line {
	border-top: 1px solid #000;
}
.level {
	width: inherit;
	height: 500px;
	border-left: 1px solid #000;
	border-bottom: 1px solid #000;
	border-right: 1px solid #000;
	overflow: hidden;
/*	writing-mode:tb-rl;
    -webkit-writing-mode: vertical-rl;      
    writing-mode: vertical-rl;
    *writing-mode: tb-rl;*/

-ms-writing-mode: tb-rl; /* old syntax. IE */
-webkit-writing-mode: vertical-rl;
-moz-writing-mode: vertical-rl;
-ms-writing-mode: vertical-rl;
writing-mode: vertical-rl; /* new syntax */

			
-webkit-text-orientation: upright;
-moz-text-orientation: upright;
-ms-text-orientation: upright;
text-orientation: upright;

}
.intro {
	display: inline-block;
	width: 100%;
	height: inherit;
}
.level_name {
    border-left: 1px solid #000;
    display: inline-block;
    font-size: 22px;
    font-weight: bold;
    height: inherit;
    letter-spacing: 25px;
    padding: 0 10px;
    text-align: center;
}
.text_vertical {
	width: 30px;
	font-size: 16px;
	word-wrap: break-word;
	letter-spacing: 10px;
}
.first {
	display: inline-block;
	height: 180px
}
.second {
	display: inline-block;
	height: 180px
}
.member {
    padding-right: 20px;
    padding-top: 10px;
}
.member_name {

    font-family: 黑体;
	font-size: 25px;
    font-weight: 900;
    margin-left: 5px;
	letter-spacing: 15px;
}
.member_desc {
    text-indent: 40px;
    letter-spacing:5px;
    line-height: 125%;
    font-family: "Microsoft YaHei", "黑体", "宋体", sans-serif;
}

.verticle-mode {
    writing-mode: tb-rl;
    -webkit-writing-mode: vertical-rl;
    writing-mode: vertical-rl;
    *writing-mode: tb-rl;
}

</style>


</head>
<body>
	<div class="tree well">
   <div class="page">
<div class="level top_line">

<?php
include("conn.php");//数据库连接
$id=$_GET['id'];
$sql=mysql_query("select info,name,wname,dc,zibei,mudi from tree_lr where id='$id'");
$datarow = mysql_num_rows($sql); 
 for($i=0;$i<$datarow;$i++){
                $sql_arr = mysql_fetch_assoc($sql);
                  $name = $sql_arr['name'];
                  $wname = $sql_arr['wname'];
                  $dc = $sql_arr['dc'];
                  $zibei = $sql_arr['zibei'];
                  $info = $sql_arr['info'];
                  $mudi = $sql_arr['mudi'];
                echo " <div class=\"level_name\">第<font color=\"red\">$dc</font>世代</div>
                	<div class=\"member\">
<div style=\"\" class=\"member_name\">刘$name</div>
<div  class=\"member_desc\"><font color=\"red\">字辈:</font>$zibei </br><font color=\"red\">妻子:</font>$wname </br><font color=\"red\">生平:</font>$info</br>$mudi</div></div>";
            }
   
?>

		</div>
		</div>
			</div>
<div align="center">2018年爱视传媒制作http://liu.5itv.org</div>
</body>
</html>