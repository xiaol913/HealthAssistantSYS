<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/19
 * Time: 0:45
 */
require_once '../include.php';

$act = $_REQUEST['act'];
$json = json_decode(file_get_contents("php://input"), true);

if ($act == "userReg") {
    $mes = registerUser($json);
    echo $mes;
} elseif ($act == "userLogin") {
    $mes = userLogin($json);
    if ($mes == "wrong") {
        echo "wrong";
    } elseif ($mes == "not exist") {
        echo "not exist";
    } else {
        print_r(json_encode($mes));
    }
} elseif ($act == "getFamily") {
    $mes = getUserFamily($json);
    if ($mes != null) {
        print_r(json_encode($mes));
    } else {
        echo "No data";
    }
} elseif ($act == "getUser") {
    $mes = getUserInfo($json);
    if ($mes != null) {
        print_r(json_encode($mes));
    } else {
        echo "wrong";
    }
} elseif ($act == "createFamily") {
    $mes = createFamily($json);
    echo $mes;
} elseif ($act == "addFamMem") {
    $mes = addFamilyMember($json);
    echo $mes;
} elseif ($act == "delFam") {
    $mes = deleteFamilyMember($json);
    echo $mes;
} elseif ($act == "editFam") {
    $mes = editUserNoPassword($json);
    echo $mes;
} elseif ($act == "editPass") {
    $mes = editUserPassword($json);
    echo $mes;
} elseif ($act == "postQ") {
    $mes = postQuestion($json);
    print_r($mes);
} elseif ($act == "getResByUserId") {
    $mes = getAllReservationsByUserId($json);
    if ($mes != null) {
        print_r(json_encode($mes));
    } else {
        echo "No data";
    }
} elseif ($act == "getResByFamNum") {
    $mes = getAllReservationsByFamilyNum($json);
    if ($mes != null) {
        print_r(json_encode($mes));
    } else {
        echo "No data";
    }
} elseif ($act == "getQue") {
    $mes = getAllQuestionsByUserId($json);
    if ($mes != null) {
        print_r(json_encode($mes));
    } else {
        echo "No data";
    }
} elseif ($act == "postR") {
    $mes = createReservation($json);
    print_r($mes);
}

