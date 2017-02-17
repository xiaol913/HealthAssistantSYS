<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 19:23
 */
require_once 'include.php';
//判断是否登录
if (checkHosLogin() == false) {
    alertMes("请先登录！", "login.php");
}

$act = $_REQUEST['act'];
$resId = $_REQUEST['resId'];
$hosId = $_REQUEST['hosId'];

if ($act == hosLogin) {
    $mes = hosLogin();
} elseif ($act == hosLogout) {
    $mes = hosLogout();
} elseif ($act == editReservationStatus) {
    $mes = editReservationStatus($resId);
} elseif ($act == createCase) {
    $mes = createCase($resId);
} elseif ($act == changeHosPassword) {
    $mes = changeHosPassword($hosId);
}