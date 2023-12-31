<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>现代家谱标准样式_不同id指定id并输出几级家谱树及指定不同世代输出相应人员信息</title>
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
<style>
    
    @media print {
  body {
    margin: 0;
    padding: 0;
  }

  @page {
    size: A4;
    margin: 0;
  }

  .page-break {
    page-break-after: always;
  }
}

</style>
	
</head>
<body>
    <div class="page-break">
<div class="tree well">
<?php
	header('Content-Type: text/html; charset=utf-8');
	//现代家谱标准样式-不同id指定id指定输出几级家谱树指定不同世代输出人员信息
	include '../header.php'; 
	// 连接数据库
	include '../conn.php'; // 或者使用 require 'conn.php';
		
	// 检查当前字符集
	mysqli_query($link, "SET NAMES 'utf8'");
	mysqli_query($link, "SET CHARACTER SET utf8");
	
                       // Prepare the query to fetch the required data
            $stmt = mysqli_prepare($link, "SELECT id,  name, pid,dorder, sex, dc,zibei, zi, hao, year, dieday, gdad, dad,mother, brother, sisters, rank,zhiye, xueli, wname, son, daughter, other FROM tree_lr");
            if (!$stmt) {
                die('mysqli_prepare failed: ' . mysqli_error($link));
            }
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_errno($stmt)) {
                die('mysqli_stmt_execute failed: ' . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_bind_result($stmt, $id, $name, $pid,$dorder, $sex, $dc,$zibei,$zi, $hao, $year, $dieday, $gdad, $dad, $mother, $brother, $sisters,$rank, $zhiye, $xueli, $wname, $son, $daughter, $other);
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
                    'rank' => $rank,
                    'zhiye' => $zhiye,
                    'xueli' => $xueli,
                    'wname' => $wname,
                    'son' => $son,
                    'daughter' => $daughter,
                    'other' => $other,
                    'children' => array()
                );
                // 计算并添加代数字段
    $family_tree[$id]['generation'] = $dc;
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


function print_family_tree($node, $level = 0, $max_level = 7) {
    if ($level > $max_level) {
        return;
    }
    $indent = str_repeat('', $level * 7);
    echo "<li>";
    if ($node['sex'] == '女') {
        echo "<span style='color: #ff1493;'><i class='icon-minus-sign'></i>{$indent}{$node['name']}{$node['id']}</span>";
    } else {
        echo "<span><i class='icon-minus-sign'></i>{$indent}{$node['name']}{$node['id']}</span>";
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
function get_descendants($node, $generation = 1, $max_generation = PHP_INT_MAX) {
    $descendants = array();
    if (!empty($node['children'])) {
        foreach ($node['children'] as $child) {
            if ($child['dc'] >= $generation && $child['dc'] <= $max_generation) {
                $descendants[] = $child;
                $descendants = array_merge($descendants, get_descendants($child, $generation, $max_generation));
            }
        }
    }
    return $descendants;
}


$trees = array(
    array('id' => 1, 'min_gen' => 0, 'max_gen' => 6, 'min_dc' => 1, 'max_dc' => 7),
    array('id' => 2893, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 1, 'max_dc' => 6),
    array('id' => 19, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 8, 'max_dc' => 9),
    array('id' => 25, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 10, 'max_dc' => 11),
    array('id' => 33, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 12, 'max_dc' => 16),
    
    array('id' => 46, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 21),//啟泉
        array('id' => 47, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 111, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 136, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 137, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 138, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 178, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 189, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 18),
        array('id' => 190, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 19),
    
    array('id' => 34, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 12, 'max_dc' => 16),//啟珍
        array('id' => 222, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 223, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 262, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 20),
        array('id' => 303, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 18),
        array('id' => 304, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 19),
        array('id' => 305, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 19),
        array('id' => 322, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 18),
        array('id' => 324, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 18),
        array('id' => 350, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 19),
    
    
    array('id' => 35, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 12, 'max_dc' => 14),//啟玉
        array('id' => 361, 'min_gen' => 0, 'max_gen' => 7, 'min_dc' => 15, 'max_dc' => 20),//心朗
        array('id' => 362, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 15, 'max_dc' => 17),//心裁
             array('id' => 383, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 20),//發長
             array('id' => 392, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 20),//發益
             array('id' => 393, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 20),//發海
             array('id' => 394, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 20),//發金
             array('id' => 422, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 19),//發晓
        array('id' => 363, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 15, 'max_dc' => 17),//心斗
             array('id' => 3005, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 19),
             array('id' => 3008, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 19),
             array('id' => 3012, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 19),
             array('id' => 3015, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 20),
             array('id' => 3025, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 18, 'max_dc' => 21),
             array('id' => 3038, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 18, 'max_dc' => 21),
             array('id' => 3053, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 18, 'max_dc' => 18),
        array('id' => 490, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 15, 'max_dc' =>15),//心謙
        array('id' => 491, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 15, 'max_dc' => 15),//心诩
        array('id' => 492, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 15, 'max_dc' => 19),//心觧
        array('id' => 508, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 15, 'max_dc' => 16),//心觧
             array('id' => 513, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 17, 'max_dc' => 19),
             array('id' => 515, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 17, 'max_dc' => 20),
             array('id' => 525, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 17, 'max_dc' => 19),
        array('id' => 534, 'min_gen' => 0, 'max_gen' => 2, 'min_dc' => 15, 'max_dc' => 16),//心溥
             array('id' => 540, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 17, 'max_dc' => 20),
             array('id' => 541, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 17, 'max_dc' => 19),
             array('id' => 559, 'min_gen' => 0, 'max_gen' => 5, 'min_dc' => 17, 'max_dc' => 21),
             array('id' => 560, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 17, 'max_dc' => 19),
             array('id' => 580, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 17, 'max_dc' => 20),
             array('id' => 581, 'min_gen' => 0, 'max_gen' => 4, 'min_dc' => 17, 'max_dc' => 20),
             array('id' => 596, 'min_gen' => 0, 'max_gen' => 3, 'min_dc' => 17, 'max_dc' => 19),
    //啟玉止
           
    
);

foreach ($trees as $tree) {
    $id = $tree['id'];
    $min_gen = $tree['min_gen'];
    $max_gen = $tree['max_gen'];
    $min_dc = $tree['min_dc'];
    $max_dc = $tree['max_dc'];

    $root_node = $family_tree[$id];
    echo "<h2>{$root_node['name']}祖的后代</h2>";
    echo "<div class='tree'>";
    if (isset($family_tree[$id])) {
        print_family_tree($family_tree[$id], $min_gen, $max_gen);
    }
    echo "</div>";

    //echo "<h2>{$root_node['name']}祖的后代</h2>";
    echo "<div class='tree'>";
    if (isset($family_tree[$id])) {
        $descendants = get_descendants($family_tree[$id], $min_dc, $max_dc);
        $descendants[] = $family_tree[$id];

        // Sortdescendants by generation and dorder
        usort($descendants, function($a, $b) {
            if ($a['dc'] != $b['dc']) {
                return $a['dc'] - $b['dc'];
            } else {
                return $a['dorder'] - $b['dorder'];
            }
        });

        for ($generation = $min_dc; $generation <= $max_dc; $generation++) {
            $zibei = '';
            foreach ($descendants as $node) {
                if ($node['dc'] == $generation) {
                    $zibei = $node['zibei'];
                    break;
                }
            }
            echo "<h3>第{$generation}世 {$zibei}字辈</h3>";
            $current_generation = array();
            foreach ($descendants as $node) {
                if ($node['dc'] == $generation) {
                    $current_generation[] = $node;
                }
            }

            // Sort by generation and id
            usort($current_generation, function($a, $b) {
                if ($a['generation'] == $b['generation']) {
                    return $a['id'] < $b['id'] ? -1 : 1;
                }
                return $a['generation'] < $b['generation'] ? -1 : 1;
            });

            echo "<ul>";
    foreach ($current_generation as $node) {
            $name = "<span style=\"color: red;\"><b>{$node['name']}</b></span> ";
            $zi = !empty($node['zi']) && $node['zi'] != '无' ? "字{$node['zi']}，" : '';
            $hao = !empty($node['hao']) && $node['hao'] != '无' ? "号{$node['hao']}。" : '';
            $year = !empty($node['year']) ? "生于{$node['year']}，" : '';
            $dieday = !empty($node['dieday']) ? "殁于{$node['dieday']}。" : '';
            $dad = !empty($node['dad']) && $node['dad'] != '无' ? "{$node['dad']}{$node['rank']}，" : '';
            $gdad = !empty($node['gdad']) && $node['gdad'] != '无' ? "祖父：{$node['gdad']}，" : '';
            $mother = !empty($node['mother']) && $node['mother'] != '无' ? "母亲：{$node['mother']}。" : '';
            $wname = !empty($node['wname']) && $node['wname'] != '未录入' && $node['wname'] != '无' ? "配{$node['wname']}" : '';
            $son = !empty($node['son']) && $node['son'] != '无' ? "生子：{$node['son']}，" : '';
            $daughter = !empty($node['daughter']) && $node['daughter'] != '无' ? "生女：{$node['daughter']}。" : '';
            $brother = !empty($node['brother']) && $node['brother'] != '无' ? " 兄弟：{$node['brother']}。" : '';
            $sisters = !empty($node['sisters']) && $node['sisters'] != '无' ? " 姊妹：{$node['sisters']}。" : '';
            $xueli = !empty($node['xueli']) && $node['xueli'] != '无' ? " {$node['xueli']}。" : '';
            $zhiye = !empty($node['zhiye']) && $node['zhiye'] != '无' ? " {$node['zhiye']}，" : '';
            $other = !empty($node['other']) && $node['other'] != '无' ? " 其它：{$node['other']}" : '';
            
            echo "<li>{$name}{$zi}{$hao}{$year}{$dieday}{$dad}{$gdad}{$mother}{$wname}{$son}{$daughter}{$brother}{$sisters}{$xueli}{$zhiye}{$other}</li>";
    }
    echo "</ul>";
        }
        echo "</div>";
    }
}
?>
</body>
</html>