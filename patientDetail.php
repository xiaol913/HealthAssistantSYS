<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/17
 * Time: 3:24
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
$resId = $_REQUEST['res_id'];
$resultList = getOneReservationByResId($resId);
$statusList = getAllStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>病人信息</title>
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
    <div class="head_text"><h1>病人信息</h1></div>
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
<form class="table" action="doAction.php?act=editReservationStatus&resId=<?php echo $resultList['res_id']; ?>"
      method="post" enctype="multipart/form-data" name="ReservationStatus">
    <table width="70%" border="3" cellspacing="0" cellpadding="5" bgcolor="#ccccccc">
        <caption>病人信息</caption>
        <tr>
            <td align="right">姓名：</td>
            <td><?php echo $resultList['user_name'] ?></td>
        </tr>
        <tr>
            <td align="right">年龄：</td>
            <td><?php echo $resultList['user_age'] ?></td>
        </tr>
        <tr>
            <td align="right">性别：</td>
            <td><?php echo $resultList['user_sex'] ?></td>
        </tr>
        <tr>
            <td align="right">身份证：</td>
            <td><?php echo $resultList['user_id_card'] ?></td>
        </tr>
        <tr>
            <td align="right">电话：</td>
            <td><?php echo $resultList['user_phone_num'] ?></td>
        </tr>
        <tr>
            <td align="right">家庭住址：</td>
            <td><?php echo $resultList['user_address'] ?></td>
        </tr>
        <tr>
            <td align="right">就诊部门：</td>
            <td><?php echo $resultList['hos_name'] . $resultList['hos_part'] ?></td>
        </tr>
        <tr>
            <td align="right">预约内容：</td>
            <td><?php echo $resultList['type_name'] ?></td>
        </tr>
        <tr>
            <td align="right">预约时间：</td>
            <td><?php echo $resultList['res_end'] ?></td>
        </tr>
        <tr>
            <td align="right">当前状态：</td>
            <td><?php echo $resultList['status_name'] ?></td>
        </tr>
        <tr>
            <td align="right">修改状态：</td>
            <td>
                <select class="select" name="res_status">
                    <option></option>
                    <?php foreach ($statusList as $status): ?>
                        <option
                            value="<?php echo $status['status_id']; ?>"><?php echo $status['status_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><a href="javascript:showPatientCases(<?php echo $resultList['user_id'] ?>)">查看病例</a></td>
            <td><a href="javascript:createPatientCase(<?php echo $resultList['res_id'] ?>)">填写病例</a></td>
        </tr>
    </table>
    <div>
        <a href="javascript:document.ReservationStatus.submit()" onfocus="this.blur();" class="contentBtn">
            <i class="fa fa-cog"></i>提交修改
            <span class="btnLine lineTop"></span>
            <span class="btnLine lineRight"></span>
            <span class="btnLine lineBottom"></span>
            <span class="btnLine lineLeft"></span>
        </a>
    </div>
</form>
</body>
</html>