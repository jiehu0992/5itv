<?php
	// 处理编辑操作的页面 ，需配合infoedit2.php使用
header("Content-type: text/html; charset=utf-8");
require_once 'common.php';

// 处理编辑操作的页面 
// 获取修改的族谱信息
$id = isset($_POST['id']) ? $_POST['id'] : '';
$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$sex = isset($_POST['sex']) ? $_POST['sex'] : '';

$wname = isset($_POST['wname']) ? $_POST['wname'] : array();
$wbd1 = isset($_POST['wbd1']) ? $_POST['wbd1'] : array();
$wdd2 = isset($_POST['wdd2']) ? $_POST['wdd2'] : array();
$wsd = isset($_POST['wsd']) ? $_POST['wsd'] : array();
$wmd = isset($_POST['wmd']) ? $_POST['wmd'] : array();
$wzd = isset($_POST['wzd']) ? $_POST['wzd'] : array();
$wdad = isset($_POST['wdad']) ? $_POST['wdad'] : array();

// 将每个配偶的信息拼接成一个字符串，用竖线分隔
$winfo_arr = array();
foreach ($wname as $i => $wname_i) {
    $wbd1_i = isset($wbd1[$i]) ? $wbd1[$i] : '';
    $wdd2_i = isset($wdd2[$i]) ? $wdd2[$i] : '';
    $wsd_i = isset($wsd[$i]) ? $wsd[$i] : '';
    $wmd_i = isset($wmd[$i]) ? $wmd[$i] : '';
    $wzd_i = isset($wzd[$i]) ? $wzd[$i] : '';
    $wdad_i = isset($wdad[$i]) ? $wdad[$i] : '';
    $winfo_arr[] = "{$wname_i}|{$wbd1_i}|{$wdd2_i}|{$wsd_i}|{$wmd_i}|{$wzd_i}|{$wdad_i}";
}
$winfo_str = implode(',', $winfo_arr);      
$wname_str = rtrim(implode(',', $wname), ','); // 将配偶名字用逗号隔开，并移除末尾逗号
$dad = $_POST['dad'];
$gdad = $_POST['gdad'];
$mother = $_POST['mother'];
$dc = $_POST['dc'];
$zibei = $_POST['zibei'];
$rank = $_POST['rank'];
$brother = $_POST['brother'];
$sisters = $_POST['sisters'];
$son = $_POST['son'];
$daughter = $_POST['daughter'];
$year = $_POST['year'];
$dieday = $_POST['dieday'];
$lifeadresse = $_POST['lifeadresse'];
$mudi = $_POST['mudi'];
$tongxun = $_POST['tongxun'];
$nation = $_POST['nation'];
$birthadresse = $_POST['birthadresse'];
$zi = $_POST['zi'];
$hao = $_POST['hao'];
$jiguan = $_POST['jiguan'];
$rname = isset($_POST['rname']) ? $_POST['rname'] : '';
$marriage = isset($_POST['marriage']) ? $_POST['marriage'] : '';
$zhiye = $_POST['zhiye'];
$xueli = $_POST['xueli'];
$other = $_POST['other'];
$jisi = $_POST['jisi'];
$tongji = $_POST['tongji'];
$info = $_POST['info'];

// 更新数据
$res = mysqli_query($link, "UPDATE tree_lr SET pid='$pid', name='$name', sex='$sex', wname='$wname_str', winfo='$winfo_str', dad='$dad', gdad='$gdad', dc='$dc', mother='$mother', zibei='$zibei', rank='$rank', brother='$brother', sisters='$sisters', son='$son', daughter='$daughter', year='$year', dieday='$dieday', lifeadresse='$lifeadresse', mudi='$mudi', tongxun='$tongxun', nation='$nation', birthadresse='$birthadresse', zi='$zi', hao='$hao', jiguan='$jiguan', rname='$rname', marriage='$marriage', zhiye='$zhiye', xueli='$xueli', other='$other', jisi='$jisi', tongji='$tongji', info='$info' WHERE id=" . $id) or die('修改数据出错：' . mysqli_error($link));

if ($res) {
    //编辑成功，跳转到info2.php并传递参数id
    $url = 'info2.php?id=' . $id;
    $message = '编辑成功！';
} else {
    //编辑失败，返回上一页infoedit2.php并传递参数id
    $url = 'infoedit2.php?id=' . $id;
    $message = '编辑失败！';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>确定</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            background-color: #f6f6f6;
            color: #333;
            text-align: center;
        }

        h1 {
            margin-top: 50px;
            font-size: 24px;
            font-weight: bold;
        }

        p {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .button {
            margin-top: 40px;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <h1>确定</h1>
    <p><?php echo $message ?></p>
    <form action="<?php echo $url ?>" method="get">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit" class="button">确定</button>
    </form>
</body>

</html>