<!DOCTYPE html>
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
<?php include '../header.php'; ?>
<div class="tree well">
    <?php
   include '../conn.php'; // 或者使用 require 'conn.php';
	
     // 7代人一个家谱树，生成欧式、苏式、欧式苏式、word样式关键代码
    // Prepare the query to fetch the required data
$stmt = mysqli_prepare($link, "SELECT id, name, pid, sex, dc FROM tree_lr");
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $name, $pid, $sex, $dc);

$family_tree = array();
while (mysqli_stmt_fetch($stmt)) {
    $family_tree[$id] = array(
        'id' => $id,
        'name' => trim($name), // 去掉名字前后空格
        'pid' => $pid,
        'sex' => $sex,
        'dc' => $dc,
        'children' => array()
    );
}

foreach ($family_tree as $id => &$node) {
    if ($node['pid'] && isset($family_tree[$node['pid']])) {
        $family_tree[$node['pid']]['children'][] = &$node;
    }
}

mysqli_stmt_close($stmt);

function print_family_tree($node, $level = 0, $max_level = 5) {
    if ($level > $max_level) {
        return;
    }

    $indent = str_repeat('', $level * 5);

    echo "<li>";
    if ($node['sex'] == '女') { // 如果是女性，字体颜色设置为粉色
        echo "<span style='color: #ff1493;'><i class='icon-minus-sign'></i>{$indent}{$node['name']}</span>";
    } else {
        echo "<span><i class='icon-minus-sign'></i>{$indent}{$node['name']}</span>";
    }

    if (count($node['children']) > 0) {
        echo "<ul>";

        foreach ($node['children'] as $child) {
            print_family_tree($child, $level + 1, $max_level);
        }

        echo "</ul>";
    }

    echo "</li>";
}

// Print family tree for multiple PIDs
$pids = array(1, 4, 1298);
foreach ($pids as $pid) {
    $root_node = isset($family_tree[$pid]) ? $family_tree[$pid] : null;
    if ($root_node) {
        echo "<h2>{$root_node['name']}的后代</h2>";
        echo "<ul class='tree'>";
        print_family_tree($root_node, 0, 6);
        echo "</ul>";
    }
}

mysqli_close($link);

?>

</div>


</body>
</html>