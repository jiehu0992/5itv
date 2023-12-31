<!-- header.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            display: block;
            color: #495057;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        @media (max-width: 767px) {
            .navbar a {
                float: none;
                display: block;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <a href="/index.php" target="_blank">主页</a>
    <a href="/type/os.php" target="_blank">欧式谱</a>
    <a href="/type/word.php" target="_blank">现代谱</a>
    <a href="/type/word2.php" target="_blank">现代谱2</a>
    <a href="/type/word2st.php" target="_blank">标准现代谱</a>
    <a href="/type/word3.php" target="_blank">现代谱3</a>
    <a href="/type/ztree.html" target="_blank">ZTree谱</a>
    <a href="/type/7id.php" target="_blank">7代谱</a>
    <a href="/type/bt.php" target="_blank">宝塔</a>
      <a href="/type/ebook/laopu/" target="_blank">ebook</a>    
    <a href="/admin/" target="_blank">搜索</a>
    <a href="/admin/su.php" target="_blank">后台</a>
</div>

<!-- End Navigation Bar -->
	<?php 	echo "当前 PHP 版本号为：" . phpversion(); ?>	
</body>
</html>
