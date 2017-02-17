<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 19:00
 */
require_once "include.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>健康助手管理系统登录页面</title>
    <link href="css/hosLogin.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="body"></div>
<div class="grad"></div>
<div class="header">
    <div><span>健康助手管理系统</span></div>
    <br>
    <div>医院端登录页</div>
</div>
<br>
<div class="login">
    <form style="margin-top: 20px;margin-left:220px;width:240px" action="doAction.php?act=hosLogin" method="post">
        <input type="text" placeholder="请输入用户名" name="username"><br>
        <input type="password" placeholder="请输入密码" name="password"><br><br>
        <input type="text" placeholder="请输入验证码" name="verify"><br>
        <img src="getVerify.php" alt="">
        <input type="checkbox" id="login_CB" class="checked" name="autoFlag" value="1"><label
            for="login_CB">记住密码</label>
        <input type="submit" value="登录">
    </form>
</div>
</body>
</html>