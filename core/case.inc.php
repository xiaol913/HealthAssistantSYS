<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/17
 * Time: 5:17
 */

/**
 *  根据病人id查找其所有病例
 * @param $id
 * @return array
 */
function getPatientAllCasesByUserId($id)
{
    $sql = "SELECT * FROM user_info AS us LEFT JOIN (case_info AS ca,hospital_info AS ho, type_info AS ty) ON (ca.case_user_id=us.user_id AND ca.case_hos_id=ho.hos_id AND ca.case_type_id=ty.type_id) WHERE us.user_id = {$id}";
    $result = fetchAll($sql);
    return $result;
}

/**
 *  创建病例
 * @param $id
 */
function createCase($id)
{
    $resultList = getOneReservationByResId($id);
    $desc = $_POST;
    $time = date("Y-m-d H:i:s", time());
    $arr = [
        "case_user_id" => $resultList['user_id'],
        "case_hos_id" => $resultList['hos_id'],
        "case_type_id" => $resultList['type_id'],
        "case_desc" => $desc['case_desc'],
        "case_date" => $time
    ];
    $str = "创建" . $resultList['user_name'] . "病例成功！";
    $url = "patientDetail.php?res_id=" . $id . "&result=1";
    $url2 = "createPatientCase.php?res_id=" . $id;
    if (insertData("case_info", $arr)) {
        alertMes($str, $url);
    } else {
        alertMes("创建失败！！", $url2);
    }
}