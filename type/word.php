<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刘三才后裔刘氏家族族谱树word版1个树</title>
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
	//word版，只有一个，多个树见注释
	include '../header.php'; 
	// 连接数据库
	include '../conn.php'; // 或者使用 require 'conn.php';
		

	// 检查当前字符集
	mysqli_query($link, "SET NAMES 'utf8'");
	mysqli_query($link, "SET CHARACTER SET utf8");
        
           // Prepare the query to fetch the required data
$stmt = mysqli_prepare($link, "SELECT id,  name, pid, sex, dc,zibei, zi, hao, year, dieday, gdad, dad, brother, sisters, zhiye, xueli, wname, son, daughter, other FROM tree_lr");
if (!$stmt) {
    die('mysqli_prepare failed: ' . mysqli_error($link));
}
mysqli_stmt_execute($stmt);
if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_execute failed: ' . mysqli_stmt_error($stmt));
}
mysqli_stmt_bind_result($stmt, $id, $name, $pid, $sex, $dc,$zibei,$zi, $hao, $year, $dieday, $gdad, $dad, $brother, $sisters, $zhiye, $xueli, $wname, $son, $daughter, $other);
if (mysqli_stmt_errno($stmt)) {
    die('mysqli_stmt_bind_result failed: ' . mysqli_stmt_error($stmt));
}

$family_tree = array();
while (mysqli_stmt_fetch($stmt)) {
    $family_tree[$id] = array(
        'id' => $id,
        'name' => trim($name), // 去掉名字前后空格
        'pid' => $pid,
        'sex' => $sex,
        'dc' => $dc,
        'zibei' => $zibei,
        'zi' => $zi,
        'hao' => $hao,
        'year' => $year,
        'dieday' => $dieday,
        'gdad' => $gdad,
        'dad' => $dad,
        'brother' => $brother,
        'sisters' => $sisters,
        'zhiye' => $zhiye,
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
            $id = 1;
            $root_node = $family_tree[$id];
            echo "<h2>{$root_node['name']}的后代</h2>";
            echo "<ul class='tree'>";
            if (isset($family_tree[$id])) {
                print_family_tree($family_tree[$id], 0, 6);
            }
            echo "</ul>";
            
            //word版式开始 
          // 新增代码开始
   for ($i = 1; $i <= 7; $i++) {
    $zibei = '';
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            $zibei = $person['zibei'];
            break;
        }
    }
    echo "<h2>第{$i}世 {$zibei}字辈</h2>";
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            echo "<span style=\"color: red;\"><b>{$person['name']}</b></span>";
            // 检查每个属性的值是否为“无”，如果是则跳过该属性的输出
            if (!empty($person['zi']) && $person['zi'] != '无') {
                echo "<span>，字{$person['zi']}</span>";
            }
            if (!empty($person['hao']) && $person['hao'] != '无') {
                echo "<span>，号{$person['hao']}</span>";
            }

            if (!empty($person['year'])) {
                echo "<span>，生于{$person['year']}</span>";
            }

            if (!empty($person['dieday'])) {
                echo "<span>，殁于{$person['dieday']}</span>";
            }

            if (!empty($person['gdad']) && $person['gdad'] != '无') {
                echo "<span>。祖父：{$person['gdad']}</span>";
            }

            if (!empty($person['dad']) && $person['dad'] != '无') {
                echo "<span>，父亲：{$person['dad']}</span>";
            }

            if (!empty($person['wname']) && $person['wname'] != '未录入' && $person['wname'] != '无') {
                echo "<span>。配{$person['wname']}</span>";
            }

            if (!empty($person['son']) && $person['son'] != '无') {
                echo "<span>生子：{$person['son']}</span>";
            }

            if (!empty($person['daughter']) && $person['daughter'] != '无') {
                echo "<span>生女：{$person['daughter']}</span>";
            }
            if (!empty($person['brother']) && $person['brother'] != '无') {
                echo "<span>。兄弟：{$person['brother']}</span>";
            }

            if (!empty($person['sisters']) && $person['sisters'] != '无') {
                echo "<span>，姊妹：{$person['sisters']}</span>";
            }

            if (!empty($person['ziye']) && $person['ziye'] != '无') {
                echo "<span>。{$person['ziye']}</span>";
            }

            if (!empty($person['xueli']) && $person['xueli'] != '无') {
                echo "<span>，{$person['xueli']}</span>";
            }

            if (!empty($person['other']) && $person['other'] != '无') {
                echo "<span>。其它：{$person['other']}</span>";
            }
              echo "<br>"; // 换行

        }
    }
}

// 新增代码结束
//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据
 //从这里开始复制可输出现代版家谱格式
        
            // Print family tree for id 1 and its descendants,这里修改输出id=1及输出代数=6
            $id = 3;
            $root_node = $family_tree[$id];
            echo "<h2>{$root_node['name']}的后代</h2>";
            echo "<ul class='tree'>";
            if (isset($family_tree[$id])) {
                print_family_tree($family_tree[$id], 0, 2);
            }
            echo "</ul>";
            
            //word版式开始 
          // 新增代码开始
   for ($i = 8; $i <= 10; $i++) {
    $zibei = '';
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            $zibei = $person['zibei'];
            break;
        }
    }
    echo "<h2>第{$i}世 {$zibei}字辈</h2>";
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            echo "<span style=\"color: red;\"><b>{$person['name']}</b></span>";
            // 检查每个属性的值是否为“无”，如果是则跳过该属性的输出
            if (!empty($person['zi']) && $person['zi'] != '无') {
                echo "<span>，字{$person['zi']}</span>";
            }
            if (!empty($person['hao']) && $person['hao'] != '无') {
                echo "<span>，号{$person['hao']}</span>";
            }

            if (!empty($person['year'])) {
                echo "<span>，生于{$person['year']}</span>";
            }

            if (!empty($person['dieday'])) {
                echo "<span>，殁于{$person['dieday']}</span>";
            }

            if (!empty($person['gdad']) && $person['gdad'] != '无') {
                echo "<span>。祖父：{$person['gdad']}</span>";
            }

            if (!empty($person['dad']) && $person['dad'] != '无') {
                echo "<span>，父亲：{$person['dad']}</span>";
            }

            if (!empty($person['wname']) && $person['wname'] != '未录入' && $person['wname'] != '无') {
                echo "<span>。配{$person['wname']}</span>";
            }

            if (!empty($person['son']) && $person['son'] != '无') {
                echo "<span>生子：{$person['son']}</span>";
            }

            if (!empty($person['daughter']) && $person['daughter'] != '无') {
                echo "<span>生女：{$person['daughter']}</span>";
            }
            if (!empty($person['brother']) && $person['brother'] != '无') {
                echo "<span>。兄弟：{$person['brother']}</span>";
            }

            if (!empty($person['sisters']) && $person['sisters'] != '无') {
                echo "<span>，姊妹：{$person['sisters']}</span>";
            }

            if (!empty($person['ziye']) && $person['ziye'] != '无') {
                echo "<span>。{$person['ziye']}</span>";
            }

            if (!empty($person['xueli']) && $person['xueli'] != '无') {
                echo "<span>，{$person['xueli']}</span>";
            }

            if (!empty($person['other']) && $person['other'] != '无') {
                echo "<span>。其它：{$person['other']}</span>";
            }
              echo "<br>"; // 换行

        }
    }
}

// 新增代码结束
//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据

//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据
 //从这里开始复制可输出现代版家谱格式  逢昌祖
        
            // Print family tree for id 1 and its descendants,这里修改输出id=1及输出代数=6
            $id = 4;
            $root_node = $family_tree[$id];
            echo "<h2>{$root_node['name']}的后代</h2>";
            echo "<ul class='tree'>";
            if (isset($family_tree[$id])) {
                print_family_tree($family_tree[$id], 0, 5);
            }
            echo "</ul>";
            
            //word版式开始 
          // 新增代码开始
   for ($i = 9; $i <= 14; $i++) {
    $zibei = '';
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            $zibei = $person['zibei'];
            break;
        }
    }
    echo "<h2>第{$i}世 {$zibei}字辈</h2>";
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            echo "<span style=\"color: red;\"><b>{$person['name']}</b></span>";
            // 检查每个属性的值是否为“无”，如果是则跳过该属性的输出
            if (!empty($person['zi']) && $person['zi'] != '无') {
                echo "<span>，字{$person['zi']}</span>";
            }
            if (!empty($person['hao']) && $person['hao'] != '无') {
                echo "<span>，号{$person['hao']}</span>";
            }

            if (!empty($person['year'])) {
                echo "<span>，生于{$person['year']}</span>";
            }

            if (!empty($person['dieday'])) {
                echo "<span>，殁于{$person['dieday']}</span>";
            }

            if (!empty($person['gdad']) && $person['gdad'] != '无') {
                echo "<span>。祖父：{$person['gdad']}</span>";
            }

            if (!empty($person['dad']) && $person['dad'] != '无') {
                echo "<span>，父亲：{$person['dad']}</span>";
            }

            if (!empty($person['wname']) && $person['wname'] != '未录入' && $person['wname'] != '无') {
                echo "<span>。配{$person['wname']}</span>";
            }

            if (!empty($person['son']) && $person['son'] != '无') {
                echo "<span>生子：{$person['son']}</span>";
            }

            if (!empty($person['daughter']) && $person['daughter'] != '无') {
                echo "<span>生女：{$person['daughter']}</span>";
            }
            if (!empty($person['brother']) && $person['brother'] != '无') {
                echo "<span>。兄弟：{$person['brother']}</span>";
            }

            if (!empty($person['sisters']) && $person['sisters'] != '无') {
                echo "<span>，姊妹：{$person['sisters']}</span>";
            }

            if (!empty($person['ziye']) && $person['ziye'] != '无') {
                echo "<span>。{$person['ziye']}</span>";
            }

            if (!empty($person['xueli']) && $person['xueli'] != '无') {
                echo "<span>，{$person['xueli']}</span>";
            }

            if (!empty($person['other']) && $person['other'] != '无') {
                echo "<span>。其它：{$person['other']}</span>";
            }
              echo "<br>"; // 换行

        }
    }
}

// 新增代码结束
//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据
//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据
 //从这里开始复制可输出现代版家谱格式  逢佐
        
            // Print family tree for id 1 and its descendants,这里修改输出id=1及输出代数=6
            $id = 5;
            $root_node = $family_tree[$id];
            echo "<h2>{$root_node['name']}的后代</h2>";
            echo "<ul class='tree'>";
            if (isset($family_tree[$id])) {
                print_family_tree($family_tree[$id], 0, 5);
            }
            echo "</ul>";
            
            //word版式开始 
          // 新增代码开始
   for ($i = 9; $i <= 14; $i++) {
    $zibei = '';
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            $zibei = $person['zibei'];
            break;
        }
    }
    echo "<h2>第{$i}世 {$zibei}字辈</h2>";
    foreach ($family_tree as $person) {
        if ($person['dc'] == $i) {
            echo "<span style=\"color: red;\"><b>{$person['name']}</b></span>";
            // 检查每个属性的值是否为“无”，如果是则跳过该属性的输出
            if (!empty($person['zi']) && $person['zi'] != '无') {
                echo "<span>，字{$person['zi']}</span>";
            }
            if (!empty($person['hao']) && $person['hao'] != '无') {
                echo "<span>，号{$person['hao']}</span>";
            }

            if (!empty($person['year'])) {
                echo "<span>，生于{$person['year']}</span>";
            }

            if (!empty($person['dieday'])) {
                echo "<span>，殁于{$person['dieday']}</span>";
            }

            if (!empty($person['gdad']) && $person['gdad'] != '无') {
                echo "<span>。祖父：{$person['gdad']}</span>";
            }

            if (!empty($person['dad']) && $person['dad'] != '无') {
                echo "<span>，父亲：{$person['dad']}</span>";
            }

            if (!empty($person['wname']) && $person['wname'] != '未录入' && $person['wname'] != '无') {
                echo "<span>。配{$person['wname']}</span>";
            }

            if (!empty($person['son']) && $person['son'] != '无') {
                echo "<span>生子：{$person['son']}</span>";
            }

            if (!empty($person['daughter']) && $person['daughter'] != '无') {
                echo "<span>生女：{$person['daughter']}</span>";
            }
            if (!empty($person['brother']) && $person['brother'] != '无') {
                echo "<span>。兄弟：{$person['brother']}</span>";
            }

            if (!empty($person['sisters']) && $person['sisters'] != '无') {
                echo "<span>，姊妹：{$person['sisters']}</span>";
            }

            if (!empty($person['ziye']) && $person['ziye'] != '无') {
                echo "<span>。{$person['ziye']}</span>";
            }

            if (!empty($person['xueli']) && $person['xueli'] != '无') {
                echo "<span>，{$person['xueli']}</span>";
            }

            if (!empty($person['other']) && $person['other'] != '无') {
                echo "<span>。其它：{$person['other']}</span>";
            }
              echo "<br>"; // 换行

        }
    }
}

// 新增代码结束
//复制以上信息可输出先家谱树后word版的家谱，即现代版家谱，一个家谱树复制一遍并修改相应的数据


            mysqli_close($link);
    
    ?>

</div> 


</body>
</html>