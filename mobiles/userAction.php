<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/19
 * Time: 0:45
 */
require_once '../include.php';

$act = $_REQUEST['act'];
$old = file_get_contents("php://input");
$json = json_decode(file_get_contents("php://input"), true);

if ($act == "userReg") {
    $mes = registerUser($json);
    echo $mes;
}elseif ($act == "userLogin" ){
    $mes = userLogin($json);
    if ($mes == "wrong"){
        echo "wrong";
    }elseif ($mes == "not exist"){
        echo "not exist";
    }else{
        print_r(json_encode($mes));
    }
}
