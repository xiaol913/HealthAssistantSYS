<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/16
 * Time: 23:19
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
    <title>本部门信息</title>
    <meta http-equiv="X-UA-COMPATIBLE" content="IE-edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/normalize.css" type="text/css" rel="stylesheet">
    <link href="css/main.css" type="text/css" rel="stylesheet">
    <link href="css/font-awesome.css" type="text/css" rel="stylesheet">
    <link href="css/content.css" type="text/css" rel="stylesheet">
    <link href="css/animation.css" type="text/css" rel="stylesheet">
    <script src="js/common.js" type="text/javascript"></script>
</head>
<body>
<!--头部-->
<div class="head">
    <!--建立logo，fl为CSS左浮动-->
    <div class="logo fl"><a href="#"></a></div>
    <!--建立头部中部文字区-->
    <div class="head_text"><h1>本部门信息</h1></div>
    <!--建立头部右边区域文字，并fr右浮动-->
    <div class="operation_user fr">
        <div class="link">
            <b style="color:#fff">欢迎
                <!--显示医院名称和部门名称-->
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
<!--内容部分-->
<div class="formBox">
    <div class="contentArea">
        <span>&nbsp;&nbsp;&nbsp;&nbsp;部门编号：</span>
        <span><?php echo $thisHosInfo['hos_id'] ?></span>
    </div>
    <div class="contentArea">
        <span>&nbsp;&nbsp;&nbsp;&nbsp;医院名称：</span>
        <span><?php echo $thisHosInfo['hos_name'] ?></span>
    </div>
    <div class="contentArea">
        <span>&nbsp;&nbsp;&nbsp;&nbsp;部门名称：</span>
        <span><?php echo $thisHosInfo['hos_part'] ?></span>
    </div>
    <div class="contentArea">
        <span>部门用户名：</span>
        <span><?php echo $thisHosInfo['hos_username'] ?></span>
    </div>
    <br><br><br><br>
    <div>
        <a href="javascript:changePassword(<?php echo $thisHosInfo['hos_id'] ?>)" class="contentBtn">
            <i class="fa fa-cog"></i>&nbsp;&nbsp;修改密码
            <span class="btnLine lineTop"></span>
            <span class="btnLine lineRight"></span>
            <span class="btnLine lineBottom"></span>
            <span class="btnLine lineLeft"></span>
        </a>
    </div>
</div>
</table>
</body>
</html>