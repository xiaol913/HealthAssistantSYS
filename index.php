<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 22:00
 */
require_once "include.php";
//判断是否登录
if (checkHosLogin() == false) {
    alertMes("请先登录！", "login.php");
}
$str = null;
if (isset($_SESSION['HealthAssistantSYSHospital_id'])) {
    $str = $_SESSION['HealthAssistantSYSHospital_id'];
} else if (isset($_COOKIE['HealthAssistantSYSHospital_id'])) {
    $str = $_COOKIE['HealthAssistantSYSHospital_id'];
}
$sql = "select * from hospital_info WHERE hos_id = '{$str}'";
$thisHosInfo = fetchOne($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>健康助手管理系统</title>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE-edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/normalize.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="css/content.css" type="text/css" rel="stylesheet">
    <link href="css/animation.css" type="text/css" rel="stylesheet">
</head>
<body>
<!--头部-->
<div class="head">
    <!--建立logo，fl为CSS左浮动-->
    <div class="logo fl"><a href="#"></a></div>
    <!--建立头部中部文字区-->
    <!--    <div class="head_text"><h1>健康助手管理系统</h1></div>-->
    <!--建立头部右边区域文字，并fr右浮动-->
    <div class="operation_user fr">
        <div class="link">
            <b style="color:#fff">欢迎
                <!--                显示医院名称和部门名称-->
                <?php
                echo $thisHosInfo['hos_name'] . $thisHosInfo['hos_part'];
                ?>
            </b>&nbsp;&nbsp;<a href="index.php" style="color:#fff" class=""><i
                    class="fa fa-home"></i><span>主页</span></a><a href="#" class="" onclick="history.go(-1)"
                                                                 style="color:#fff"><i
                    class="fa fa-reply"></i><span>后退</span></a><a href="doAction.php?act=hosLogout" class=""
                                                                  style="color:#fff"><i
                    class="fa fa-power-off"></i><span>登出</span></a>
        </div>
    </div>
</div>
<!--内容区-->
<div class="fontBtn1 st-color">
    <div class="welcome_text" id="menu_text">
        <h2>欢迎使用健康助手管理系统</h2>
    </div>
    <div id="menu_button">
        <div class="st-btn-1"><input type="button" onclick="window.location.href='diagnosisList.php'"
                                     id="st-control-2-1"><a
                href="#">普通诊断</a><i style="color:#fff" class="fa fa-building-o fa-5x"></i></div>
        <div class="st-btn-2"><input type="button" id="st-control-2-2" onclick="window.location.href='assayList.php'"><a
                href="#">检查化验</a><i style="color:#fff" class="fa fa-sign-in fa-5x"></i></div>
        <div class="st-btn-3"><input type="button" id="st-control-2-3" onclick="window.location.href='partInfo.php'"><a
                href="#">本部门信息</a><i style="color:#fff" class="fa fa-book fa-5x"></i></div>
    </div>
</div>
</body>
</html>