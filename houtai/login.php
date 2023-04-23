<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username == 'admin' && $password == '123') {
        // 如果用户名和密码正确，将用户标记为已登录
        $_SESSION['logged_in'] = true;

        // 重定向回原始页面
        $url = isset($_GET['url']) ? $_GET['url'] : 'index.php';
        header("Location: $url");
        exit();
    } else {
        // 如果用户名或密码不正确，显示错误消息
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
      body {
      font-family: Arial, sans-serif;
      background-color: #F2F2F2;
    }
    
    h1 {
      text-align: center;
      color: #333;
    }
    
    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #FFF;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    
    label {
      display: block;
      margin-bottom: 10px;
      color: #666;
    }
    
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: none;
      margin-bottom: 20px;
      box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: #FFF;
      border: none;
      border-radius: 5px;
      padding: 10px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }

    </style>
</head>
<body>
    <h1>管理员登录</h1>
    <?php if (isset($error)) { ?>
        <div><?php echo $error; ?></div>
    <?php } ?>
    <form method="post">
        <label>用户名:</label>
        <input type="text" name="username"><br><br>
        <label>密码:</label>
        <input type="password" name="password"><br><br>
        <input type="submit" value="登录">
    </form>
</body>
</html>
