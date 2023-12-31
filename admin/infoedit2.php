<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>编辑详情_刘三才族裔刘氏族谱</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <!--主要样式-->
    <script type="text/javascript" src="/js/context-menu.js"></script>
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
</head>
    <body>
    <?php
  
require_once 'common.php';
      
    $id = $_GET['id'];
    $sql = mysqli_query($link, "SELECT * FROM tree_lr WHERE id=$id");
    $sql_arr = mysqli_fetch_assoc($sql);
   //父亲
$sql = mysqli_query($link, "SELECT pid,name FROM tree_lr WHERE id=".$sql_arr['pid']);
$fa_name = mysqli_fetch_assoc($sql);
$sql_arr['dad'] = isset($fa_name['name']) ? $fa_name['name'] : '';

//母亲
$pid = $sql_arr['pid']; // 获取父亲的ID
$query = "SELECT winfo FROM tree_lr WHERE id='$pid'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$winfo = isset($row['winfo']) ? $row['winfo'] : '';

$winfo_arr = explode(',', $winfo);
$mother = '';
foreach ($winfo_arr as $winfo_str) {
    $winfo_fields = explode('|', $winfo_str);
    if (isset($winfo_fields[0]) && !empty($winfo_fields[0])) {
        $mother .= $winfo_fields[0] . ', ';
    }
}

// 移除末尾的逗号和空格
$mother = rtrim($mother, ', ');

// 祖父
$fa_name_pid = isset($fa_name['pid']) ? $fa_name['pid'] : null;

if ($fa_name_pid !== null) {
    $sql = mysqli_query($link, "SELECT pid, name FROM tree_lr WHERE id=" . $fa_name_pid);

    // 检查查询是否成功，并且是否返回了任何行
    if ($sql) {
        $gr_name = mysqli_fetch_assoc($sql);

        // 在访问数组偏移之前检查 $gr_name 是否不为null
        $sql_arr['gdad'] = isset($gr_name['name']) ? $gr_name['name'] : '未找到祖父';
    } else {
        // 处理查询不成功的情况
        $sql_arr['gdad'] = "查询失败";
    }
} else {
    $sql_arr['gdad'] = "未找到祖父";
}


    //配偶
    //兄弟
    $sql = mysqli_query($link, "SELECT * FROM tree_lr WHERE sex='男' and pid=".$sql_arr['pid']);
	$br_name = "";
    while ($row = mysqli_fetch_array($sql)) {
    	if($br_name==""){$br_name=$row[2];}else{$br_name.="、".$row[2];}
    }
    $br_name  = trim($br_name );
    if(empty($br_name)){$br_name ='无';}else{
     $array_1 = explode('、',$sql_arr['name']);
     $array_2 = explode('、',$br_name );
     $result = array_diff($array_2, $array_1);
     $br_name =implode("、",$result);
     if($br_name  == "")$br_name ='无';
     }
      //姐妹
	$sql = mysqli_query($link, "SELECT * FROM tree_lr WHERE sex='女' and pid=".$sql_arr['pid']);
	$sis_name= "";
    while ($row = mysqli_fetch_array($sql)) {
    	if($sis_name == ""){$sis_name = $row[2];}else{$sis_name.="、".$row[2];}
    }
    $sis_name = trim($sis_name);
    if(empty($sis_name)){$sis_name='无';}else{
     $array_3 = explode('、',$sql_arr['name']);
     $array_4 = explode('、',$sis_name);
     $result = array_diff($array_4, $array_3);
     $sis_name=implode("、",$result);
     if($sis_name == "")$sis_name='无';
     }

    //子
    $sql = mysqli_query($link, "SELECT * FROM tree_lr WHERE sex='男' and pid=".$sql_arr['id']);
	$son_name= "";
 		while ($row = mysqli_fetch_array($sql)) {
    	if($son_name == ""){$son_name = $row[2];}else{$son_name.="、".$row[2];}
    }
    $son_name = trim($son_name);
    if(empty($son_name)){$son_name='无';}


     //女
    $sql = mysqli_query($link,"SELECT * FROM tree_lr WHERE sex='女' and pid=".$sql_arr['id']);
	$da_name= "";
  	while ( $row=mysqli_fetch_array($sql)) {
    if($da_name == ""){$da_name = $row[2];}else{$da_name.="、".$row[2];}
    }
    $da_name = trim($da_name);
    if(empty($da_name)){$da_name='无';}
    //排行
    if(trim($sql_arr['rank']) == ""){//如果本人排行已经定义，则直接取出，不用默认
      $sql_tmp="SELECT * FROM tree_lr WHERE sex='".$sql_arr['sex']."' and pid=".$sql_arr['pid'];
      $sqlx = mysqli_query($link,$sql_tmp);//需转化维数组
      $rank1=array("長子","次子","三子","四子","五子","六子","七子","八子","九子","十子","十一子","十二子");
      $rank2=array("長女","次女","三女","四女","五女","六女","七女","八女","九女","十女","十一女","十二女");
      $paih = "";
    while ( $rowx=mysqli_fetch_array($sqlx)) {//取出并拼接本人兄弟或姐妹已占用的排行
        if($paih == ""){
            $paih = $rowx['rank'];
        }else{
            if(!empty($rowx['rank']))$paih .="|".$rowx['rank'];
        }
    }
        if(!empty($paih)){//取出已占用的排行不为空时执行，否之直接長子或長女
            $paih_arr = explode('|',$paih);
            //$num_p =count($paih_arr);
            if($sql_arr['sex'] == "男"){$tmp1 = $rank1;}else{$tmp1 = $rank2;}//判断适用男系或女系
    		$paih_dif =array_diff($tmp1,$paih_arr);//取本家兄弟或姐妹未占用的排行，
    		$ppp = explode('|',implode("|",$paih_dif));//把未占用的排行重新编号
    		$paih_x = $ppp[0];//取出第一个未占用的排行
    
        }else{
            if($sql_arr['sex']=="男"){$paih_x="長子";}else{$paih_x="長女";}
        }
    }else{$paih_x = $sql_arr['rank'];}//已定义排行的直接取出，不再执行判断代码
    mysqli_close($link); //关闭数据库连接
    ?>
		<div class="tree well">
        	<div align=center>
        <form action="action-editinfo2.php" method="post">
             <div align="center" style="font-size:large;color:red">
            <input type="hidden" name="id" value="<?php echo $sql_arr['id']?>">
             <input type="hidden" name="pid" value="<?php echo $sql_arr['pid']?>">
            劉<?php echo $sql_arr['name']?> ( 编号:<?php echo $sql_arr['id']?> )、父亲：劉<?php echo $sql_arr['dad']?> (编号：<?php echo $sql_arr['pid']?>)、祖父：劉<?php echo $sql_arr['gdad']?>
            </div>
            <br>
         <table align="center" cellpadding="0" cellspacing="0" style="width: 80%;height:100%">
        		<tbody>
        	<tr>
        			<td colspan="6"><div align="center"><strong> <span style="font-size:x-large">必 填 </span><span style="color:#FF0000">*</span></strong></div>	<br></td>
        		</tr>
        		<tr>
        
        			<td width="1%" >姓名：</td>
        			<td width="13%"><input type="text" name="name" value="<?php echo $sql_arr['name']?>"></td>
        			<td width="1%" >性别：</td>
        			<td width="13%">
        				<select id="sex" name="sex">
        					<option value="<?php echo $sql_arr['sex']?>"><?php echo $sql_arr['sex']?></option>
        				<option value="男">男</option>
        				<option value="女">女</option>
        				</select></td>
        					<td width="1%" >排行：</td>
        			<td width="13%">
        				<select id="rank" name="rank">
        			<option value="<?php echo $paih_x?>"><?php echo $paih_x?></option>
        				<option value="長子">長子</option>
        				<option value="次子">次子</option>
        				<option value="三子">三子</option>
        				<option value="四子">四子</option>
        				<option value="五子">五子</option>
        				<option value="六子">六子</option>
        				<option value="七子">七子</option>
        				<option value="八子">八子</option>
        				<option value="九子">九子</option>
        				<option value="十子">十子</option>
        				<option value="十一子">十一子</option>
        				<option value="十二子">十二子</option>
        				<option value="長女">長女</option>
        				<option value="次女">次女</option>
        				<option value="三女">三女</option>
        				<option value="四女">四女</option>
        				<option value="五女">五女</option>
        				<option value="六女">六女</option>
        				<option value="七女">七女</option>
        				<option value="八女">八女</option>
        				<option value="九女">九女</option>
        				<option value="十女">十女</option>
        				<option value="十一女">十一女</option>
        				<option value="十二女">十二女</option>
        				</select>
        			</td>
        		</tr>
               <!-- 配偶 -->
                <tr>
                 <?php
$winfo = $sql_arr['winfo']; // 从数据库获取 winfo 字段的信息
$winfo_arr = explode(',', $winfo); // 将信息转换为数组

$html = '<td width="1%" style="vertical-align: top;">配偶：</td>
         <td colspan="5" style="vertical-align: top;">
             <div id="spouse-container">';
foreach ($winfo_arr as $winfo_str) {
    $winfo_fields = explode('|', $winfo_str);

    // Check if the array elements exist before accessing them
    $wname = isset($winfo_fields[0]) ? $winfo_fields[0] : '';
    $wdad = isset($winfo_fields[6]) ? $winfo_fields[6] : '';
    $wbd1 = isset($winfo_fields[1]) ? $winfo_fields[1] : '';
    $wsd = isset($winfo_fields[3]) ? $winfo_fields[3] : '';
    $wdd2 = isset($winfo_fields[2]) ? $winfo_fields[2] : '';
    $wmd = isset($winfo_fields[4]) ? $winfo_fields[4] : '';
    $wzd = isset($winfo_fields[5]) ? $winfo_fields[5] : '';

    $html .= '<span style="display: inline-flex; width: 100%;">
                  <input type="text" name="wname[]" value="' . $wname . '" placeholder="配偶姓名" style="width: 5%;">
                  <input type="text" name="wdad[]" value="' . $wdad . '" placeholder="父亲" style="width: 5%;">
                  <input type="text" name="wbd1[]" value="' . $wbd1 . '" placeholder="出生日期" style="width: 15%;">
                  <input type="text" name="wsd[]" value="' . $wsd . '" placeholder="出生地" style="width: 15%;">
                  <input type="text" name="wdd2[]" value="' . $wdd2 . '" placeholder="去世日期" style="width: 15%;">
                  <input type="text" name="wmd[]" value="' . $wmd . '" placeholder="去世地" style="width: 15%;">
                  <input type="text" name="wzd[]" value="' . $wzd . '" placeholder="墓地" style="width: 15%;">
                  <input type="hidden" name="wid[]" value="">
                  <input type="hidden" name="wspouse_id[]" value="' . $id . '">
              </span>';
}
$html .= '</div>'; // 添加缺少的闭合标签
echo $html; // 输出 HTML 表格代码
?>
<td width="3%" style="vertical-align: top;">
    <button type="button" id="add-spouse">添加配偶</button>
</td>
</tr>

        
        
        		<tr>
        			<td width="1%" >祖父：</td>
        			<td width="13%"><input type="text" name="gdad" value="<?php echo $sql_arr['gdad']?>" readonly="readonly" /> </td>
        			<td width="1%" >父亲：</td>
        			<td width="13%"><input type="text" name="dad" value="<?php echo $sql_arr['dad']?>" readonly="readonly" /> </td>
        					<td width="1%" >母亲：</td>
        			<td width="13%"><input type="text" name="mother" value="<?php echo $sql_arr['mother']?>" readonly="readonly" /> </td>
        		</tr>
        		<tr>
        			<td width="1%" >世代：</td>
        			<td width="13%">
        				<select id="dc" name="dc">
        				<option value="<?php echo $sql_arr['dc']?>"><?php echo $sql_arr['dc']?></option>
        				<option value="16">16廣</option>
        				<option value="17">17發</option>
        				<option value="18">18永</option>
        				<option value="19">19長</option>
        				<option value="20">20綿</option>
        				<option value="21">21宗</option>
        				<option value="22">22强</option>
        				<option value="23">23生</option>
        				<option value="24">24貴</option>
        				<option value="25">25子</option>
        				<option value="26">26聖</option>
        				<option value="27">27王</option>
        				<option value="28">28佑</option>
        				<option value="29">29福</option>
        				<option value="30">30卿</option>
        				<option value="31">31祖</option>
        				<option value="32">32坐</option>
        				<option value="33">33豐</option>
        				<option value="34">34華</option>
        				<option value="35">35地</option>
        				<option value="36">36萬</option>
        				<option value="37">37代</option>
        				<option value="38">38慶</option>
        				<option value="39">39興</option>
        				<option value="40">40隆</option>
        				<option value="1">1價</option>
        				<option value="2">2壽</option>
        				<option value="3">3尚</option>
        				<option value="4">4季</option>
        				<option value="5">5圭</option>
        				<option value="6">6三</option>
        				<option value="7">7仕</option>
        				<option value="8">8應</option>
        				<option value="9">9逢</option>
        				<option value="10">10鼎</option>
        				<option value="11">11啟</option>
        				<option value="12">12志</option>
        				<option value="13">13良</option>
        				<option value="14">14心</option>
        				<option value="15">15現</option>
        				</select>
        	 			</td>
        			<td width="4%" >字辈：</td>
        			<td width="13%">
        				<select id="zibei" name="zibei">
        				<option value="<?php echo $sql_arr['zibei']?>"><?php echo $sql_arr['zibei']?></option>
        
        				<option value="發">17發</option>
        				<option value="永">18永</option>
        				<option value="長">19長</option>
        				<option value="綿">20綿</option>
        				<option value="宗">21宗</option>
        				<option value="强">22强</option>
        				<option value="生">23生</option>
        				<option value="貴">24貴</option>
        				<option value="子">25子</option>
        				<option value="聖">26聖</option>
        				<option value="王">27王</option>
        				<option value="佑">28佑</option>
        				<option value="福">29福</option>
        				<option value="卿">30卿</option>
        				<option value="祖">31祖</option>
        				<option value="坐">32坐</option>
        				<option value="豐">33豐</option>
        				<option value="華">34華</option>
        				<option value="地">35地</option>
        				<option value="萬">36萬</option>
        				<option value="代">37代</option>
        				<option value="慶">38慶</option>
        				<option value="興">39興</option>
        				<option value="隆">40隆</option>
        				<option value="價">1價</option>
        				<option value="壽">2壽</option>
        				<option value="尚">3尚</option>
        				<option value="季">4季</option>
        				<option value="圭">5圭</option>
        				<option value="三">6三</option>
        				<option value="仕">7仕</option>
        				<option value="應">8應</option>
        				<option value="逢">9逢</option>
        				<option value="鼎">10鼎</option>
        				<option value="啟">11啟</option>
        				<option value="志">12志</option>
        				<option value="良">13良</option>
        				<option value="心">14心</option>
        				<option value="現">15現</option>
        				<option value="廣">16廣</option>
        				</select>
        			</td>
                  <td width="1%">兄弟：</td>
                  <td width="13%">
                    <?php if(!empty($br_name) && $br_name !== "无"): ?>
                      <input type="text" name="brother" value="<?php echo $br_name; ?>" readonly="readonly" />
                    <?php else: ?>
                      <input type="text" name="brother" value="" readonly="readonly" />
                    <?php endif; ?>
                  </td>
        			</td>
        		</tr>
                	<tr>
                  <td width="1%">姐妹：</td>
                  <td width="13%">
                    <?php if(!empty($sis_name) && $sis_name !== "无"): ?>
                      <input type="text" name="sisters" value="<?php echo $sis_name; ?>" readonly="readonly" />
                    <?php else: ?>
                      <input type="text" name="sisters" value="" readonly="readonly" />
                    <?php endif; ?>
                  </td>
                  <td width="1%">儿子：</td>
                  <td width="13%">
                    <?php if(!empty($son_name) && $son_name !== "无"): ?>
                      <input type="text" name="son" value="<?php echo $son_name; ?>" readonly="readonly" />
                    <?php else: ?>
                      <input type="text" name="son" value="" readonly="readonly" />
                    <?php endif; ?>
                  </td>
                  <td width="1%">女儿：</td>
                  <td width="13%">
                    <?php if(!empty($da_name) && $da_name !== "无"): ?>
                      <input type="text" name="daughter" value="<?php echo $da_name; ?>" readonly="readonly" />
                    <?php else: ?>
                      <input type="text" name="daughter" value="" readonly="readonly" />
                    <?php endif; ?>
                  </td>
                </tr>
        			<tr>
                        <td width="1%">生平：</td>
                            <?php
                            $winfo = $sql_arr['winfo']; // 從數據庫獲取 winfo 欄位信息
                            $winfo_arr = explode(',', $winfo); // 將信息轉換為數組
                            
                            $winfo_text = '';
                            $winfo_count = count($winfo_arr);
                            foreach ($winfo_arr as $key => $winfo_str) {
                                 $wdad = '';
                                $winfo_fields = explode('|', $winfo_str);
                                
                                $wname = $wdad =  $wbd1 = $wdd2 = $wsd = $wmd = $wzd = '';
                                if (!empty($winfo_fields[0])) {
                                    $wname = $winfo_fields[0];
                                }
                                if (!empty($winfo_fields[6])) {
                                    $wdad = $winfo_fields[6].'之女 ' ; 
                                }
                                if (!empty($winfo_fields[1])) {
                                    $wbd1 = '生於' . $winfo_fields[1];
                                }
                                if (!empty($winfo_fields[3])) {
                                    $wsd = ' 出生地' . $winfo_fields[3];
                                }
                                if (!empty($winfo_fields[2])) {
                                    $wdd2 = ' 歿於' . $winfo_fields[2];
                                }
                                if (!empty($winfo_fields[4])) {
                                    $wmd = ' 去世地' . $winfo_fields[4];
                                }
                                if (!empty($winfo_fields[5])) {
                                    $wzd = ' 葬地' . $winfo_fields[5];
                                }
                                
                                $winfo_entry = $wname;
                                if (!empty($wbd1) || !empty($wdad) || !empty($wdd2) || !empty($wsd) || !empty($wmd) || !empty($wzd)) {
                                    $winfo_entry .= '（'. $wdad . $wbd1 . $wsd  . $wdd2. $wmd . $wzd . '）';
                                }
                                
                                if (!empty($winfo_entry)) {
                                    $winfo_text .= $winfo_entry;
                                    if ($key < $winfo_count - 1) {
                                        $winfo_text .= '、';
                                    }
                                }
                            }
                            
                              $info = '';
                            if (!empty($winfo_text)) {
                                $info = $sql_arr['name'] . '配' . $winfo_text;
                            }
                            
                            if (!empty($info)) {
                                //echo $info;
                            }
                            
                                
                                $child_info = '';
                                if (!empty($son_name) && $son_name !== '无') {
                                    $child_info .= '，生子' . $son_name;
                                }
                                if (!empty($da_name) && $da_name !== '无') {
                                    $child_info .= '，生女' . $da_name;
                                }
                                if (!empty($spouse_name)) {
                                    if (!empty($child_info)) {
                                        $info .= '，' . $spouse_name . $child_info . '。';
                                    } else {
                                        $info .= '，' . $spouse_name . '。';
                                    }
                                } elseif (!empty($child_info)) {
                                    $info .= $child_info . '。';
                                }
                            
                                if (!empty($winfo_str) || !empty($spouse_info_str) || (!empty($child_info) && $sql_arr['sex'] !== '女') || (!empty($sql_arr['pid']) && $sql_arr['sex'] !== '女')) {
                            ?>
                                    <td colspan="4" style="width: 100%;">
                                        <input type="text" id="info" name="info" rows="3" style="min-width: 100%" value="<?php echo $info;?>" readonly="readonly" />
                                    </td>
                            <?php
                            }
                            ?>
        		        </tr>
        	</tbody>
        
        	<tbody>
        	<tr>
        			<td colspan="6"><div align="center"><strong><span style="font-size:x-large">	<P></P>选 填 </span></strong></div>	<br></td>
        		</tr>
        			<tr>
        		<td width="4%" >其他：</td>
        		<td colspan="5"><textarea class="form-control" id="other" name="other" rows="3" style="min-width: 70%"  value="<?php echo $sql_arr['other']?>"><?php echo $sql_arr['other']?></textarea><br>其他示例：三才未明嘉靖二、三十年代，萬历十年1582年聖午科，解元。又维基百科刘三才字汝立1559年十二月初八日生，殁于1618年	</td><br>
        			</tr>
        		<tr>
        			<td width="4%" >国籍：</td>
        			<td width="13%"><input  type="text" name="nation" value="<?php echo $sql_arr['nation']?>"> </td>
        			<td width="4%" >籍贯：</td>
        			<td width="13%"><input type="text" name="jiguan" value="<?php echo !empty($sql_arr['jiguan']) ? $sql_arr['jiguan'] : '四川省邻水县'; ?>"></td>
        			<td width="4%" >字：</td>
        			<td width="13%"><input  type="text" name="zi" value="<?php echo $sql_arr['zi']?>"> </td>
        		</tr>
        		<tr>
        			<td width="4%" >号：</td>
        			<td width="13%"><input  type="text" name="hao" value="<?php echo $sql_arr['hao']?>"></td>
        			<td width="4%" >曾用名：</td>
        			<td width="13%"><input  type="text" name="marriage" value="<?php echo $sql_arr['rname']?>"> </td>
        			<td width="4%" >生日</td>
        			<td width="13%"><input  type="text" name="year" value="<?php echo $sql_arr['year']?>">  </td>
        		</tr>
        		<tr>
        			<td width="4%" >出生地：</td>
        			<td width="13%"> <input  type="text" name="birthadresse" value="<?php echo $sql_arr['birthadresse']?>"></td>
        			<td width="4%" >居住地：</td>
        			<td width="13%"><input  type="text" name="lifeadresse" value="<?php echo $sql_arr['lifeadresse']?>"></td>
        			<td width="4%" >通讯：</td>
        			<td width="13%"><input  type="text" name="tongxun" value="<?php echo $sql_arr['tongxun']?>">  </td>
        		</tr>
        		<tr>
        			<td width="4%" >婚姻：</td>
        			<td width="13%"><input  type="text" name="marriage" value="<?php echo $sql_arr['marriage']?>"> </td>
        
        			<td width="4%" >继嗣：</td>
        			<td width="13%"><input type="text" name="jisi" value="<?php echo $sql_arr['jisi']?>">  </td>
        			<td width="4%" >职业：</td>
        			<td width="13%"> <input  type="text" name="zhiye" value="<?php echo $sql_arr['zhiye']?>">   </td>
        		</tr>
        		<tr>
        			<td width="4%" >学历：</td>
        			 <td width="13%"><input  type="text" name="xueli" value="<?php echo $sql_arr['xueli']?>">   </td>
        			<td width="4%" >祭日：</td>
        			<td width="13%"><input  type="text" name="dieday" value="<?php echo $sql_arr['dieday']?>"> </td>
        			<td width="4%" >墓地：</td>
        			<td width="13%"><input  type="text" name="mudi" value="<?php echo $sql_arr['mudi']?>"> </td>
        		</tr>
        		<tr>
        			<td width="4%" >统计：</td>
        			<td width="13%"> <input   type="text" name="tongji" value="<?php echo $sql_arr['tongji']?>">   </td>
        
        		</tr>
        		</tbody>
        		</form>
        </table>
            <input type="submit" value="提交"></input>
           		</div>
        </div>
        <script>
            document.getElementById('add-spouse').addEventListener('click', function() {
                var container = document.getElementById('spouse-container');
                var span = document.createElement('span');
                
                var wname_input = document.createElement('input');
                wname_input.type = 'text';
                wname_input.name = 'wname[]';
                wname_input.style.width = '5%';
                wname_input.placeholder = '配偶姓名';
                span.appendChild(wname_input);
                
                var wdad_input = document.createElement('input');
                wdad_input.type = 'text';
                wdad_input.name = 'wdad[]';
                wdad_input.placeholder = '父亲';
                wdad_input.style.width = '5%';
                span.appendChild(wdad_input);
                
                var wbd1_input = document.createElement('input');
                wbd1_input.type = 'text';
                wbd1_input.name = 'wbd1[]';
                wbd1_input.placeholder = '出生日期';
                wbd1_input.style.width = '10%';
                span.appendChild(wbd1_input);
                
                var wsd_input = document.createElement('input');
                wsd_input.type = 'text';
                wsd_input.name = 'wsd[]';
                wsd_input.placeholder = '出生地';
                wsd_input.style.width = '10%';
                span.appendChild(wsd_input);
                
                var wdd2_input = document.createElement('input');
                wdd2_input.type = 'text';
                wdd2_input.name = 'wdd2[]';
                wdd2_input.placeholder = '去世日期';
                wdd2_input.style.width = '10%';
                span.appendChild(wdd2_input);
                
                var wsd_input = document.createElement('input');
                wsd_input.type = 'text';
                wsd_input.name = 'wmd[]';
                wsd_input.placeholder = '去世地';
                wsd_input.style.width = '10%';
                span.appendChild(wsd_input);
                
                var wmd_input = document.createElement('input');
                wmd_input.type = 'text';
                wmd_input.name = 'wzd[]';
                wmd_input.placeholder = '墓地';
                wmd_input.style.width = '10%';
                span.appendChild(wmd_input);
        
                container.appendChild(span);
            });
        
            document.getElementById('remove-spouse').addEventListener('click', function() {
                var container = document.getElementById('spouse-container');
                var spans = container.getElementsByTagName('span');
                if (spans.length > 1) {
                    container.removeChild(spans[spans.length - 1]);
                }
            });
        </script>
    </body>
</html>