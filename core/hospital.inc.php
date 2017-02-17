<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 21:42
 */

/**
 *  登录
 */
function hosLogin()
{
    $username = $_POST['username'];
//使用反斜线重新定义$username
    $username = addslashes($username);
    $password = md5($_POST['password']);
    $verify = $_POST['verify'];
    $verify_raw = $_SESSION['verify'];
    $autoFlag = $_POST['autoFlag'];
    //设置编码
    //验证验证码是否正确
    if ($verify == $verify_raw) {
        $sql = "select * from hospital_info WHERE hos_username = '{$username}' and hos_password = '{$password}'";
        $row = checkExists($sql);
        //判断是否存在
        if ($row) {
            $hos_id = $row['hos_id'];
            $hos_name = $row['hos_name'];
            $hos_part = $row['hos_part'];
            $hos_username = $row['hos_username'];
            //检查是否选择记住密码
            if ($autoFlag) {
                setcookie("HealthAssistantSYSHospital_id", $hos_id, time() + 7 * 24 * 3600);
                setcookie("HealthAssistantSYSHospital_name", $hos_name, time() + 7 * 24 * 3600);
                setcookie("HealthAssistantSYSHospital_part", $hos_part, time() + 7 * 24 * 3600);
                setcookie("HealthAssistantSYSHospital_username", $hos_username, time() + 7 * 24 * 3600);
            }
            $_SESSION['HealthAssistantSYSHospital_id'] = $hos_id;
            $_SESSION['HealthAssistantSYSHospital_name'] = $hos_name;
            $_SESSION['HealthAssistantSYSHospital_part'] = $hos_part;
            $_SESSION['HealthAssistantSYSHospital_username'] = $hos_username;
            alertMes("登录成功!!", "index.php");
        } else {
            alertMes("用户名或者密码错误!!", "login.php");
        }
    } else {
        alertMes("验证码错误!!", "login.php");
    }
}

/**
 *  检查账号是否存在
 * @param $sql
 * @return array|null
 */
function checkExists($sql)
{
    return fetchOne($sql);
}

/**
 *  判断是否已经登录过了
 * @return bool
 */
function checkHosLogin()
{
    if ($_SESSION['HealthAssistantSYSHospital_id'] == "" && $_COOKIE['HealthAssistantSYSHospital_id'] == "") {
        return false;
    } else {
        return true;
    }
}

/**
 * 注销
 */
function hosLogout()
{
    $_SESSION = array();
    if (isset($_COOKIE['HealthAssistantSYSHospital_id'])) {
        setcookie("HealthAssistantSYSHospital_id", "", time() - 1);
    }
    if (isset($_COOKIE['HealthAssistantSYSHospital_username'])) {
        setcookie("HealthAssistantSYSHospital_username", "", time() - 1);
    }
    session_destroy();
    alertMes("退出成功!!", "login.php");
}

/**
 *  通过部门id查找部门信息
 * @param $id
 * @return array|null
 */
function getHosInfo($id)
{
    $sql = "SELECT * FROM hospital_info WHERE hos_id={$id}";
    return fetchOne($sql);
}

/**
 *  修改hos密码
 * @param $id
 */
function changeHosPassword($id){
    $where = "hos_id={$id}";
    $arr = $_POST;
    $old = md5($arr['old_pass']);
    $new = md5($arr['new_pass']);
    $sec = md5($arr['sec_pass']);
    $hosInfo = getHosInfo($id);
    $ok = null;
    if ($old == $hosInfo['hos_password']){
        if ($new == $sec){
            $ok = ["hos_password" => $new];
            if (updateData("hospital_info",$ok, $where)){
                alertMes("密码修改成功！","partInfo.php");
                hosLogout();
            }else{
                alertMes("密码修改失败！","partInfo.php");
            }
        }else{
            alertMes("新密码输入不一致！","partInfo.php");
        }
    }else{
        alertMes("原密码不正确！","partInfo.php");
    }
}