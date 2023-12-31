<?php
require_once 'common.php';

    $id = $_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM tree_lr WHERE id=$id");
    $sql_arr = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>劉三才后裔劉氏家族族谱树</title>
	<meta name="keywords" content="劉氏族谱,族谱,劉氏家谱,家谱树,爱视传媒">
	<meta name="description" content="自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地">
	<link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/info.css" />
</head>
<!--主要样式-->
<script type="text/javascript" src="/js/context-menu.js"></script>
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<body>
  <div class="tree well">
    <div align="center">
      <label><red>劉<?php echo $sql_arr['name']?></red>编号:</label>
      <input type="text" name="id" value="<?php echo $sql_arr['id']?>" readonly="readonly">
      <label><red>劉<?php echo $sql_arr['name']?></red>父亲编号：</label>
      <input type="text" name="pid" value="<?php echo $sql_arr['pid']?>" readonly="readonly">
     <table align="center" cellpadding="0" cellspacing="0" style="width: 80%;height:100%">
        <tr>
          <td>
            	<p>姓名：<?php echo $sql_arr['name']?></p>
						<p>性别：<?php echo $sql_arr['sex']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
						配偶：<?php
                        $spouse_name = '';
                        $winfo = $sql_arr['winfo'];
                        if (!empty($winfo)) {
                            $winfo_arr = explode(',', $winfo);
                            foreach ($winfo_arr as $winfo_i) {
                                $winfo_detail = explode('|', $winfo_i);
                                $wname_i = $winfo_detail[0];
                                $spouse_name .= "{$wname_i}，";
                            }
                            $spouse_name = rtrim($spouse_name, '，'); // 去除最后一个逗号
                        }
                            echo $spouse_name;
                        ?>
                        </p>
						<p>排行:<?php echo $sql_arr['rank']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;父亲：<?php echo $sql_arr['dad']?></p>
						<p>世代：<?php echo $sql_arr['dc']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;祖父：<?php echo $sql_arr['gdad']?></p>
						<p>字辈：<?php echo $sql_arr['zibei']?>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;兄弟：<?php echo $sql_arr['brother']?></p>
						<p>生平：<?php echo $sql_arr['info']?></p>
						<p>国籍：<?php echo $sql_arr['nation']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;籍贯：<?php echo $sql_arr['jiguan']?></p>
						<p>字：<?php echo $sql_arr['zi']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;号：<?php echo $sql_arr['hao']?></p>
						<p>曾用名：<?php echo $sql_arr['rname']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;生日:<?php echo $sql_arr['year']?></p>
						<p>出生地：<?php echo $sql_arr['birthadresse']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;居住地：<?php echo $sql_arr['lifeadresse']?></p>
						<p>通讯：<?php echo $sql_arr['tongxun']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;婚姻：<?php echo $sql_arr['marriage']?></p>
						<p>姐妹：<?php echo $sql_arr['sisters']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;继嗣：<?php echo $sql_arr['jisi']?></p>
						<p>职业：<?php echo $sql_arr['zhiye']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;学历：<?php echo $sql_arr['xueli']?></p>
						<p>祭日：<?php echo $sql_arr['dieday']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;墓地：<?php echo $sql_arr['mudi']?></p>
			墓地：<?php echo $sql_arr['mudi']?>
		</p>
		<p>
			统计：<?php echo $sql_arr['tongji']?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			其它：<?php echo $sql_arr['other']?>
		</p>
          </td>
        </tr>
      </table>
    </div>
    <div class="text-center mt-3">
      <a href="infoedit2.php?id=<?php echo $sql_arr['id'];?>" class="btn btn-primary mx-2">编辑</a>
      <a href="index.php" class="btn btn-primary mx-2">返回主页</a>
    </div>
  </div>
</body>
</html>