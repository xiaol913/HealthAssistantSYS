<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 17:52
 */
header("content-type:text/html;charset=utf-8");
session_start();
//定义路径
define("ROOT", dirname(__FILE__));
set_include_path("." . PATH_SEPARATOR . ROOT . "/lib" . PATH_SEPARATOR . ROOT . "/core" . PATH_SEPARATOR . ROOT . "/configs" . PATH_SEPARATOR . get_include_path());
//包含文件
require_once 'mysql.func.php';
require_once 'configs.php';
require_once 'common.func.php';
require_once 'string.func.php';
require_once 'image.func.php';
require_once 'hospital.inc.php';
require_once 'reservation.inc.php';
require_once 'case.inc.php';
require_once 'user.inc.php';
require_once 'status.inc.php';