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
<script src="//cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
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
    session_start();
require_once 'functions.php';

// 验证用户是否已登录，未登录则跳转到登录页面
if (!is_logged_in()) {
    $url = 'login.php?url=' . urlencode($_SERVER['REQUEST_URI']);
    redirect($url);
}
?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href=""></a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li><a href="/os.php">欧式族谱</a></li>
			<li><a href="/bt.php">塔式族谱</a></li>
			<li><a href="su.php">增改删</a></li>
			<li><a href="search.php">搜索</a></li>
		</ul>
	</div>
	</div>
</nav>
	<div class="tree well">
<?php include_once '../type/tree.php';?>
	<ul id="dhtmlgoodies_tree" class="dhtmlgoodies_tree">
    <?php echo $menu;?>
	</ul>
</div>
<div align="center">2023年爱视传媒制作http://demo.tvsbar.com</div>
</body>
</html>