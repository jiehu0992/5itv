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

<div class="tree well">
    <?php
            $link = mysqli_connect("127.0.0.1", "root", "root", "database");
            if (!$link) {
                die("连接失败: " . mysqli_connect_error());
            }
        
           // Prepare the query to fetch the required data
$stmt = mysqli_prepare($link, "SELECT id,  name, pid,dorder, sex, dc,zibei, zi, hao, year, dieday, gdad, dad,mother, brother, sisters, zhiye, xueli, wname, son, daughter, other FROM tree_lr");
if (!$stmt) {
    die('mysqli_prepare failed: ' . mysqli_error($link));
}
mysqli_stmt_execute($stmt);
if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_execute failed: ' . mysqli_stmt_error($stmt));
}
mysqli_stmt_bind_result($stmt, $id, $name, $pid,$dorder, $sex, $dc,$zibei,$zi, $hao, $year, $dieday, $gdad, $dad, $mother, $brother, $sisters, $zhiye, $xueli, $wname, $son, $daughter, $other);
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
        'hao' => $hao,
        'year' => $year,
        'dieday' => $dieday,
        'gdad' => $gdad,
        'dad' => $dad,
        'mother' => $mother,
        'brother' => $brother,
        'sisters' => $sisters,
        'zhiye' => $ziye,
        'xueli' => $xueli,
        'wname' => $wname,
        'son' => $son,
        'daughter' => $daughter,
        'other' => $other,
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
        //从这里开始复制可输出现代版家谱格式
        
   // Print family tree for id 1 and its descendants,这里修改输出id=1及输出代数=6
            $id = 25;
            $root_node = $family_tree[$id];
            echo "<h2>{$root_node['name']}的后代</h2>";
            echo "<ul class='tree'>";
            if (isset($family_tree[$id])) {
                print_family_tree($family_tree[$id], 0, 3);
            }
            echo "</ul>";
            
            //word版式开始 
          // 新增代码开始

function get_descendants($node) {
    $descendants = array();
    if (!empty($node['children'])) {
        foreach ($node['children'] as $child) {
            $descendants[] = $child;
            $descendants = array_merge($descendants, get_descendants($child));
        }
    }
    return $descendants;
}

$id = 25;
$root_node = $family_tree[$id];

echo "<h2>{$root_node['name']}的后代</h2>";
echo "<div class='tree'>";

if (isset($family_tree[$id])) {
    $descendants = get_descendants($family_tree[$id]);
    $descendants[] = $family_tree[$id];
    usort($descendants, function($a, $b) {
        if ($a['dc'] == $b['dc']) {
            return $a['dorder'] - $b['dorder'];
        } else {
            return $a['dc'] - $b['dc'];
        }
    });
    foreach ([10, 11, 12] as $generation) {
    $zibei = '';
    foreach ($descendants as $node) {
        if ($node['dc'] == $generation) {
            $zibei = $node['zibei'];
            break;
        }
    }
    echo "<h3>第{$generation}世 {$zibei}字辈</h3>";
        foreach ($descendants as $node) {
            if ($node['dc'] == $generation) {
                echo "<li>{$generation_text}<span style=\"color: red;\"><b>{$node['name']}</b></span>";
// 检查每个属性的值是否为“无”，如果是则跳过该属性的输出
if (!empty($node['zi']) && $node['zi'] != '无') {
echo " 字{$node['zi']},";
}
if (!empty($node['hao']) && $node['hao'] != '无') {
echo "号{$node['hao']},";
}

            if (!empty($node['year'])) {
                echo "生于{$node['year']},";
            }

            if (!empty($node['dieday'])) {
                echo "殁于{$node['dieday']}。";
            }

            if (!empty($node['gdad']) && $node['gdad'] != '无') {
                echo "祖父：{$node['gdad']},";
            }

            if (!empty($node['dad']) && $node['dad'] != '无') {
                echo "父亲：{$node['dad']},";
            }
            if (!empty($node['mother']) && $node['mother'] != '无') {
                echo "母亲：{$node['mother']}。";
            }

            if (!empty($node['wname']) && $node['wname'] != '未录入' && $node['wname'] != '无') {
                echo "配{$node['wname']}";
            }

            if (!empty($node['son']) && $node['son'] != '无') {
                echo "生子：{$node['son']},";
            }

            if (!empty($node['daughter']) && $node['daughter'] != '无') {
                echo "生女：{$node['daughter']}。";
            }
            if (!empty($node['brother']) && $node['brother'] != '无') {
                echo "兄弟：{$node['brother']},";
            }

            if (!empty($node['sisters']) && $node['sisters'] != '无') {
                echo "姊妹：{$node['sisters']}。";
            }

            if (!empty($node['ziye']) && $node['ziye'] != '无') {
                echo "{$node['ziye']},";
            }

            if (!empty($node['xueli']) && $node['xueli'] != '无') {
                echo "{$node['xueli']}。";
            }

            if (!empty($node['other']) && $node['other'] != '无') {
                echo "其它：{$node['other']}。";
            }
            }
        }
    }
}

echo "</div>";


// 新增代码结束


            mysqli_close($link);
    
    ?>

</div> 


</body>
</html>