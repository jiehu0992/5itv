<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刘三才后裔刘氏家族族谱树先树后家谱</title>
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
        <div class="tree well">
         <?php
	header('Content-Type: text/html; charset=utf-8');
	//现代版家谱，先树后家谱 	//需配合word-xianshuhoujiapu-function.php使用
	include '../header.php'; 
	// 连接数据库
	include '../conn.php'; // 或者使用 require 'conn.php';
		

	// 检查当前字符集
	mysqli_query($link, "SET NAMES 'utf8'");
	mysqli_query($link, "SET CHARACTER SET utf8");

// Prepare the query to fetch the required data
$stmt = mysqli_prepare($link, "SELECT id, name, pid, dorder, sex, dc, zibei, zi, hao, year, dieday, gdad, dad, mother, brother, sisters, rank, zhiye, xueli, wname, son, daughter, other FROM tree_lr");
if (!$stmt) {
    die('mysqli_prepare failed: ' . mysqli_error($link));
}

mysqli_stmt_execute($stmt);

if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_execute failed: ' . mysqli_stmt_error($stmt));
}

mysqli_stmt_bind_result($stmt, $id, $name, $pid, $dorder, $sex, $dc, $zibei, $zi, $hao, $year, $dieday, $gdad, $dad, $mother, $brother, $sisters, $rank, $zhiye, $xueli, $wname, $son, $daughter, $other);

if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_bind_result failed: ' . mysqli_stmt_error($stmt));
}

$family_tree = array();
while (mysqli_stmt_fetch($stmt)) {
    $family_tree[$id] = array(
        'id' => $id,
        'name' => trim($name), // 去掉名字前后空格
        'pid' => $pid,
        'dorder' => $dorder,
        'sex' => $sex,
        'dc' => $dc,
        'zibei' => $zibei,
        'zi' => $zi,
        'rank' => $rank,
        'children' => array()
    );
}

if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_fetch failed: ' . mysqli_stmt_error($stmt));
}

foreach ($family_tree as $id => &$node) {
    if ($node['pid'] && isset($family_tree[$node['pid']])) {
        $family_tree[$node['pid']]['children'][] = &$node;
    }
}

mysqli_stmt_close($stmt);

require_once 'word-xianshuhoujiapu-function.php';

$trees = array(
    array('id' => 25, 'min_gen' => 0, 'max_gen' => 3),
    array('id' => 26, 'min_gen' => 0, 'max_gen' => 5),
    array('id' => 1857, 'min_gen' => 0, 'max_gen' => 4),
    array('id' => 1280, 'min_gen' => 0, 'max_gen' => 3),
);

$people = array(
    array('id' => 25, 'min_dc' => 10, 'max_dc' => 12),
    array('id' => 26, 'min_dc' => 10, 'max_dc' => 14),
    array('id' => 1857, 'min_dc' => 16, 'max_dc' => 19),
    array('id' => 1280, 'min_dc' => 17, 'max_dc' => 20),
);

print_family_and_people_tree($family_tree, $trees, $people);
