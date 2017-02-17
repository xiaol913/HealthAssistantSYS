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
$allList = getAllReservationsByHosId($thisHosInfo['hos_id'], 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>检查化验</title>
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
    <div class="head_text"><h1>检查化验</h1></div>
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
<!--内容部分-->
<table class="table" cellspacing="0" cellpadding="0">
    <!--靠左显示表单名称-->
    <caption>预约列表</caption>
    <!--表头-->
    <thead>
    <tr>
        <th width="10%">病人姓名</th>
        <th width="20%">联系电话</th>
        <th width="15%">部门</th>
        <th width="15%">预约内容</th>
        <th width="15%">预约时间</th>
        <th width="10%">当前状态</th>
        <th width="15%">操作</th>
    </tr>
    </thead>
    <!--表格内容-->
    <tbody>
    <?php foreach ($allList as $row): ?>
        <tr>
            <td><?php echo $row['user_name']; ?></td>
            <td><?php echo $row['user_phone_num']; ?></td>
            <td><?php echo $row['hos_name'] . $row['hos_part']; ?></td>
            <td><?php echo $row['type_name']; ?></td>
            <td><?php echo $row['res_end']; ?></td>
            <td><?php echo $row['status_name']; ?></td>
            <td align="center"><a href="javascript:showPatientDetail(<?php echo $row['res_id'] ?>)"><i
                        class="fa fa-bars"></i>详情</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>