<!DOCTYPE html>
<html>
<head>
    <title>数据库显示excel</title>
 </head>
<body>
<table  border="1" cellspacing="0">
         <tr><th>姓名</th><th>性别</th><th>配偶</th><th>父亲</th><th>祖父</th><th>母亲</th><th>世代</th><th>字辈</th><th>排行</th><th>兄弟</th><th>姐妹</th><th>子女</th><th>出生日期</th><th>纪念日期</th><th>家庭地址</th><th>葬于</th><th>通讯</th><th>民族</th><th>出生地址</th><th>字</th><th>号</th><th>籍贯</th><th>曾用名</th><th>婚姻</th><th>职业</th><th>学历</th><th>其他信息</th><th>继嗣</th><th>统计</th><th>备注</th></tr>
    <?php
        require "conn.php";
         $sql = mysql_query("select * from tree_lr");
         $datarow = mysql_num_rows($sql);
            for($i=0;$i<$datarow;$i++){
                $sql_arr = mysql_fetch_assoc($sql);

    $name = $sql_arr['name'];
    $sex =$sql_arr['sex'];
    $wname  =$sql_arr['wname'];
    $dad    =$sql_arr['dad'];
    $gdad   =$sql_arr['gdad'];
    $mother =$sql_arr['mother'];
    $dc =$sql_arr['dc'];
    $zibei =$sql_arr['zibei'];
    $rank =$sql_arr['rank'];
    //$rank ="";//$sql_arr['rank']

        if($rank == "长子"){$rank=1 ; }
        elseif ($rank == "次子") {            $rank=2 ;        }
        elseif ($rank == "三子") {            $rank=3 ;        }
         elseif ($rank == "四子") {            $rank=4 ;        }
          elseif ($rank == "五子") {            $rank=5 ;        }
           elseif ($rank == "六子") {            $rank=6 ;        }
            elseif ($rank == "七子") {            $rank=7 ;        }
             elseif ($rank == "八子") {            $rank=8 ;        }
              elseif ($rank == "九子") {            $rank=9 ;        }
               elseif ($rank == "长女") {            $rank=1 ;        }
                elseif ($rank == "次女") {            $rank=2 ;        }
                 elseif ($rank == "三女") {            $rank=3 ;        }
                  elseif ($rank == "四女") {            $rank=4 ;        }
                   elseif ($rank == "五女") {            $rank=5 ;        }
                    elseif ($rank == "六女") {            $rank=6 ;        }
                     elseif ($rank == "七女") {            $rank=7 ;        }
                      elseif ($rank == "八女") {            $rank=8 ;        }
                       elseif ($rank == "九女") {            $rank=9 ;        }


    $brother =$sql_arr['brother'];
     if($brother == "无"){$brother= ''; }
    $sisters =$sql_arr['sisters'];
    if($sisters == "无"){$sisters= ''; }
    $son    =$sql_arr['son'];
    if($son == "无"){$son= ''; }
    $daughter   =$sql_arr['daughter'];
    if($daughter == "无"){$daughter= ''; }
    $year   =$sql_arr['year'];
    $dieday =$sql_arr['dieday'];
    $lifeadresse    =$sql_arr['lifeadresse'];
    $mudi   =$sql_arr['mudi'];
    $tongxun    =$sql_arr['tongxun'];
    $nation =$sql_arr['nation'];
    $birthadresse   =$sql_arr['birthadresse'];
    $zi =$sql_arr['zi'];
    $hao    =$sql_arr['hao'];
    $jiguan =$sql_arr['jiguan'];
    $rname  =$sql_arr['rname'];
    $marriage   =$sql_arr['marriage'];
    $zhiye  =$sql_arr['zhiye'];
    $xueli  =$sql_arr['xueli'];
    $other  =$sql_arr['other'];
    $jisi   =$sql_arr['jisi'];
    $tongji =$sql_arr['tongji'];
    $info   =$sql_arr['info'];
                echo "<tr><td>$name</td><td>$sex</td><td>$wname</td><td>$dad</td><td>$gdad</td><td>$mother</td><td>$dc</td><td>$zibei</td><td>$rank</td><td>$brother</td><td>$sisters</td><td>$son $daughter</td><td>$year</td><td>$dieday</td><td>$lifeadresse</td><td>$mudi</td><td>$tongxun</td><td>$nation</td><td>$birthadresse</td><td>$zi</td><td>$hao</td><td>$jiguan</td><td>$rname</td><td>$marriage</td><td>$zhiye</td><td>$xueli</td><td>$other</td><td>$jisi</td><td>$tongji</td><td>$info</td></tr>";
            }
    ?>
</table>
</body>
</html>