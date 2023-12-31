<?php
	//需配合word-xianshuhoujiapu.php使用
function print_family_and_people_tree($family_tree, $trees, $pepoles) {
    
    function print_family_tree($node, $level = 0, $max_level = 5) {
        if ($level > $max_level) {
            return;
        }
        $indent = str_repeat('', $level * 5);
        echo "<li>";
        if ($node['sex'] == '女') {
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
    
    foreach ($trees as $tree) {
        $id = $tree['id'];
        $min_gen = $tree['min_gen'];
        $max_gen = $tree['max_gen'];

        if (isset($family_tree[$id])) {
            echo "<h2>{$family_tree[$id]['name']}的后代</h2>";
            echo "<ul class='tree'>";
            print_family_tree($family_tree[$id], $min_gen, $max_gen);
            echo "</ul>";
        }
    }
    
    foreach ($pepoles as $tree) {
        $id = $tree['id'];
        $min_dc = $tree['min_dc'];
        $max_dc = $tree['max_dc'];

        $root_node = $family_tree[$id];
        echo "<h2>{$root_node['name']}的后代</h2>";
        echo "<div class='tree'>";

        if (isset($family_tree[$id])) {
            $descendants = get_descendants($family_tree[$id]);
            $descendants[] = $family_tree[$id];
            usort($descendants, function($a, $b) {
                return $a['dc'] == $b['dc'] ? $a['dorder'] - $b['dorder'] : $a['dc'] - $b['dc'];
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
                foreach ($descendants as $node) {
		    if ($node['dc'] == $generation) {
		        $name = "<span style=\"color: red;\"><b>{$node['name']}</b></span> ";     
		        $zi = $node['zi']; // 添加这一行来赋值
		        echo "<li>{$name}{$zi}</li>";
		    }
		}
            }
        }
        echo "</div>";
    }
}

?>