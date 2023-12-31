<!DOCTYPE html>
<html>
<head>
<title>刘氏家族族谱树</title>
<meta name="keywords" content="刘氏族谱,族谱,刘氏家谱,家谱树">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<!--主要样式-->
<script type="text/javascript" src="/js/context-menu.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script src="/images/layer/layer.js" type="text/javascript"></script>
<style type="text/css">.tree{background-color: transparent;width:100%}</style>
<script type="text/javascript">
$(function(){
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', '收起子孙族谱树');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', '展开子孙族谱树').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', '收起子孙族谱树').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});
function getid(a){id=(a.id)}$(document).ready(function(){$('.outside').click(function(){layer.open({type:2,title:false,shadeClose:true,shade:0.6,anim:1,area:['610px','100%'],content:[id,'no']})})})
</script>

</head>
<body>
    <?php
	include_once 'header.php';
?>
	<div class="tree well">
<?php include_once 'tree.php';?>
	<ul id="dhtmlgoodies_tree" class="dhtmlgoodies_tree">
    <?php echo $menu;?>
	</ul>
</div>
<div align="center">2023年爱视传媒制作http://demo.tvsbar.com</div>
</body>
</html>