<?php
$link=mysql_connect("localhost","root","root") or die("连接数据库服务器失败！".mysql_error()); //连接MySQL服务器
$db=mysql_select_db("treelcopy",$link);//链接数据库
mysql_query("set names utf8");//设置编码
?>