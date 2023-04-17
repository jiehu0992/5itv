<?php
// 处理编辑操作的页面 
require "../conn.php";
header("Content-type: text/html; charset=utf-8");	
// 获取修改的族谱信息
$id = $_POST['id'];
$pid = $_POST['pid'];
$name = $_POST['name'];
$sex =$_POST['sex'];
$wname	=$_POST['wname'];
$dad	=$_POST['dad'];
$gdad	=$_POST['gdad'];
$mother =$_POST['mother'];
$dc	=$_POST['dc'];
$zibei =$_POST['zibei'];
$rank =$_POST['rank'];
$brother =$_POST['brother'];
$sisters =$_POST['sisters'];
$son	=$_POST['son'];
$daughter	=$_POST['daughter'];
$year	=$_POST['year'];
$dieday	=$_POST['dieday'];
$lifeadresse	=$_POST['lifeadresse'];
$mudi	=$_POST['mudi'];
$tongxun	=$_POST['tongxun'];
$nation	=$_POST['nation'];
$birthadresse	=$_POST['birthadresse'];
$zi	=$_POST['zi'];
$hao	=$_POST['hao'];
$jiguan	=$_POST['jiguan'];
$rname	=$_POST['rname'];
$marriage	=$_POST['marriage'];
$zhiye	=$_POST['zhiye'];
$xueli	=$_POST['xueli'];
$other	=$_POST['other'];
$jisi	=$_POST['jisi'];
$tongji	=$_POST['tongji'];
$info	=$_POST['info'];

// 更新数据
$res=mysqli_query($link, "UPDATE tree_lr SET pid='$pid',name='$name',sex='$sex',wname='$wname',dad='$dad',gdad='$gdad',dc='$dc',mother='$mother',zibei='$zibei',rank='$rank',brother='$brother',sisters='$sisters',son='$son',daughter='$daughter',year='$year',dieday='$dieday',lifeadresse='$lifeadresse',mudi='$mudi',tongxun='$tongxun',nation='$nation',birthadresse='$birthadresse',zi='$zi',hao='$hao',jiguan='$jiguan',rname='$rname',marriage='$marriage',zhiye='$zhiye',xueli='$xueli',other='$other',jisi='$jisi',tongji='$tongji',info='$info' WHERE id=".$id) or die('修改数据出错：'.mysqli_error($link)); 
if($res){
	//这是代表成功
	//这里就可以用跳转方法了 比如你的header重定向
	$url='check.php?id='.$id;
	echo '编辑成功！';
	header('Location:'.$url);

}else{
	//也可以返回上一步
	$url='infoedit2.php';
	echo '编辑失败！';
	header('Location:'.$url);

}
?>