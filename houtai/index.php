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
</script>
	
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<div>
		<ul class="nav navbar-nav">
			<li><a href="/os.php">欧式族谱</a></li>		
			<li><a href="/bt.php">塔式族谱</a></li>			
			<li><a href="/ztree.html">ztree族谱树</a></li>			
			<li><a href="/99pu.html">ztree族谱树84.3MB</a></li>	
			<li><a href="/search.php">搜索</a></li>
		</ul>
	</div>
	</div>
</nav>
	<div class="tree well">
<?php include_once 'tree2.php';?>
	<ul id="dhtmlgoodies_tree" class="dhtmlgoodies_tree">
    <?php echo $menu;?>
	</ul>
</div>
<div align="center">2018年爱视传媒制作http://liu.5itv.org</div>
</body>
</html>
