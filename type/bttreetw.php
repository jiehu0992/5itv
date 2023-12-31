<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>宝塔样式繁体版（竖排繁体从右向左输出含祖妣）</title>
<script src="https://cdn.staticfile.org/jquery/3.6.0/jquery.min.js"></script>
  
   <style type="text/css">
	/* It's supposed to look like a tree diagram */
	.tree, .tree ul, .tree li {
	    list-style: none;
	    margin: 0;
	    padding: 0;
	    position: relative;
	}

	.tree {
	    margin: 0 0 1em;
	    text-align: center;
	}
	.tree, .tree ul {
	    display: table;
	}
	.tree ul {
	  width: 100%;
	}
	.tree li {
		display: table-cell;
		padding: .5em 0;
		vertical-align: top;
	}
	/* _________ */
	.tree li:before {
		outline: solid 1px #666;
		content: "";
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
	}
	.tree li:first-child:before {left: 50%;}
	.tree li:last-child:before {right: 50%;}

	.tree code, .tree span {
		 font-family: "Microsoft YaHei", sans-serif;
		display: inline-block;
		margin: 0 .2em .5em;
		padding: .2em .5em;
		position: relative;
		writing-mode: vertical-rl;
		text-orientation: mixed;
		white-space: nowrap;
	}


	/* If the tree represents DOM structure */
	.tree code {
		font-family: "Microsoft YaHei", sans-serif;
	}

		/* | */
		.tree ul:before,
		.tree code:before,
		.tree span:before {
			outline: solid 1px #666;
			content: "";
			height: .5em;
			left: 50%;
			position: absolute;
		}
		.tree ul:before {
			top: -.5em;
		}
		.tree code:before,
		.tree span:before {
			top: -.5em;
		}

	/* The root node doesn't connect upwards */
	.tree > li {margin-top: 0;}
	.tree > li:before,
	.tree > li:after,
	.tree > li > code:before,
	.tree > li > span:before {
	  outline: none;
	}
	</style>
<body>
<?php
	header('Content-Type: text/html; charset=utf-8');
	//宝塔样式繁体版（竖排繁体从右向左输出含祖妣）
	include '../header.php'; 
	// 连接数据库
	include '../conn.php'; // 或者使用 require 'conn.php';
		

	// 检查当前字符集
	mysqli_query($link, "SET NAMES 'utf8'");
	mysqli_query($link, "SET CHARACTER SET utf8");


	// 查询所有节点
	$query = "SELECT id, name, pid, sex, L, R, winfo FROM tree_lr ORDER BY L ASC";
	$result = mysqli_query($link, $query);
	if (!$result) {
	    die('Invalid query: ' . mysqli_error($link));
	}


	// 构建节点数组
	$nodes = array();
	while ($row = mysqli_fetch_assoc($result)) {
	    $nodes[] = $row;
	}

	// 构建树状结构
	$tree = array();
	foreach ($nodes as $node) {
	    $pid = $node['pid'];
	    if (!isset($tree[$pid])) {
	        $tree[$pid] = array();
	    }
	    $tree[$pid][] = $node;
	}

// 递归构建树
function buildTree($tree, $parent_id, &$output) {
    if (isset($tree[$parent_id])) {
        $output .= "<ul>";
        $nodes = $tree[$parent_id];
        usort($nodes, function($a, $b) {
            return $a['L'] > $b['L'];
        });
        $nodes = array_reverse($nodes);
        foreach ($nodes as $node) {
            $output .= "<li>";
            $color = ($node['sex'] == '女') ? 'ff1493' : '';
            $spouse_name = '';
            $winfo = $node['winfo'];
            if (!empty($winfo)) {
               $winfo_arr = explode(',', $winfo);
foreach ($winfo_arr as $key => $winfo_i) {
    $winfo_detail = explode('|', $winfo_i);
    // 仅处理非空的子项和确保至少有两个子项（人名和其他信息）
    if (count($winfo_detail) >= 2 && !empty($winfo_detail[0])) {
        $wname_i = $winfo_detail[0];
        $spouse_name .= "{$wname_i}";
        // Add a comma if there are more names
        if ($key < count($winfo_arr) - 1) {
            $spouse_name .= "，";
        }
    }
}

            }
           if (!empty($spouse_name)) {
    $output .= "<span style='color: #$color;writing-mode: vertical-lr;'>" . $spouse_name . "<br>" . $node['name'] . "</span>";
} else {
    $output .= "<span style='color: #$color;writing-mode: vertical-lr;'>" . $node['name'] . "</span>";
}

            $output .= "</span>";
            buildTree($tree, $node['id'], $output);
            $output .= "</li>";
        }
        $output .= "</ul>";
    }
}

// 生成树形结构
$output = "";
buildTree($tree, 0, $output);

// 输出树形结构
echo "<div class='tree'>" . $output . "</div>";


?>

</body>
</html>