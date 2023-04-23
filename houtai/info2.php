<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>编辑详情</title>
</head>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<!--主要样式-->
<script type="text/javascript" src="/js/context-menu.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<body>
<?php
session_start();
require_once 'functions.php';

// 验证用户是否已登录，未登录则跳转到登录页面
if (!is_logged_in()) {
    $url = 'login.php?url=' . urlencode($_SERVER['REQUEST_URI']);
    redirect($url);
}
    require "../conn.php";
    $id = $_GET['id'];
    $sql = mysql_query("SELECT * FROM tree_lr WHERE id=$id",$link);
    $sql_arr = mysql_fetch_assoc($sql);

?>
	<div class="tree well">
	<div align=center>
<form action="action-editinfo.php" method="post">
    <label>刘<?php echo $sql_arr['name']?>编号:</label><input type="text" name="id" value="<?php echo $sql_arr['id']?>" readonly="readonly">
    <label>刘<?php echo $sql_arr['name']?>父亲编号：</label><input type="text" name="pid" value="<?php echo $sql_arr['pid']?>" readonly="readonly">
   <table border="0">
    <tr>
    <td> <label>姓名：</label></td><td><input type="text" name="name" value="<?php echo $sql_arr['name']?>"></td><td>因为都是刘氏子裔，仅需填名字，不代姓，两个字的名字，可将辈分带上，如刘林，长字辈，则可录入“林”或者“长林”</td></tr>
     <tr>
     <td><label>妻子：</label></td><td><input type="text" name="wname" value="<?php echo $sql_arr['wname']?>">
     </td><td>不知道可填“无记载”或留空</td></tr>
     <tr>
     <td><label>出生时间：</label></td><td><input type="text" name="year" value="<?php echo $sql_arr['year']?>"></td><td>可填任意数字如“1987”“1987年”“一九八七”“戊戌年”</td></tr>
     <tr>
     <td><label>死亡时间：</label></td><td><input type="text" name="dieday" value="<?php echo $sql_arr['dieday']?>">  </td><td>在世不填，去世如不知道时间直接添“已去世”</td></tr>
     <tr>
     <td><label>墓地：</label></td><td><input type="text" name="mudi" value="<?php echo $sql_arr['mudi']?>">
      </td><td>在世不填，去世墓地可填大概位置如葬于邻水县</td></tr>
     <tr>
     <td><label>出生地：</label></td><td><input type="text" name="birthadresse" value="<?php echo $sql_arr['birthadresse']?>"> </td><td>一般与父辈地址一致</td></tr>
    <tr>
    <td> <label>居住地：</label></td><td><input type="text" name="lifeadresse" value="<?php echo $sql_arr['lifeadresse']?>"> </td><td>定居地址</td></tr>
     <tr>
     <td><label>字辈：</label></td><td><input type="text" name="zibei" value="<?php echo $sql_arr['zibei']?>">    </td><td>价寿尚季圭、三仕应逢鼎、启志良心现、广发永长绵、宗强生贵子、圣王佑福卿、祖坐丰华地、万代庆兴隆</td></tr>
     <tr>   <td><label>世代：</label></td><td><input type="text" name="dc" value="<?php echo $sql_arr['dc']?>">    </td><td>“绵”字辈20世代，以此类推，如“永”字辈18代，“宗字辈21世代，只填数字即可”</td></tr>
    <tr>   <td> <label>生平简介：</label></td><td><input style="width:300%"type="text" name="info" value="<?php echo $sql_arr['info']?>"></td></tr><br>注意：以下所有数据修改如成功，点击“提交”按钮后不会有提示，指挥跳转到add.php页面，如不成功会提示“修改数据出错”

</form>
		</table>
    <input type="submit" value="提交">
   		</div>
</div>
</body>
</html>