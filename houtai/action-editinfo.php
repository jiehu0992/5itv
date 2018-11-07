<?php
	
header("location:/admin/add.php");
// 处理编辑操作的页面 
require "conn.php";

// 获取修改的新闻
$id = $_POST['id'];
$pid = $_POST['pid'];
$name = $_POST['name'];
$wname = $_POST['wname'];
$year = $_POST['year'];
$dieday = $_POST['dieday'];
$mudi = $_POST['mudi'];
$birthadresse = $_POST['birthadresse'];
$lifeadresse = $_POST['lifeadresse'];
$zibei = $_POST['zibei'];
$dc = $_POST['dc'];
$info = $_POST['info'];
// 更新数据
mysql_query("UPDATE tree_lr SET id='$id',pid='$pid',name='$name',wname='$wname',year='$year',dieday='$dieday',mudi='$mudi',birthadresse='$birthadresse',lifeadresse='$lifeadresse',zibei='$zibei',dc='$dc',info='$info' WHERE id=$id",$link) or die('修改数据出错：'.mysql_error()); 
?>