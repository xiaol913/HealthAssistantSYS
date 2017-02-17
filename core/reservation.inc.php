<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/17
 * Time: 1:55
 */

/**
 * 通过部门id，查找所有已经预约该医院的所有相关信息
 * @param $id   部门id
 * @param $type 预约种类
 * @return array
 */
function getAllReservationsByHosId($id, $type)
{
    $sql = "SELECT * FROM hospital_info as hosp LEFT JOIN (reservation_info as rese,user_info AS usei,type_info as tp,status_info as stat) ON (hosp.hos_id=rese.res_hos_id AND rese.res_user_id_card=usei.user_id_card AND rese.res_type=tp.type_id AND rese.res_status=stat.status_id) WHERE hosp.hos_id = {$id} AND rese.res_type = {$type}";
    $result = fetchAll($sql);
    return $result;
}

/**
 *  通过预约id，查找所有相关信息
 * @param $id
 * @return array|null
 */
function getOneReservationByResId($id)
{
    $sql = "SELECT * FROM hospital_info as hosp LEFT JOIN (reservation_info as rese,user_info AS usei,type_info as tp,status_info as stat) ON (hosp.hos_id=rese.res_hos_id AND rese.res_user_id_card=usei.user_id_card AND rese.res_type=tp.type_id AND rese.res_status=stat.status_id) WHERE rese.res_id = {$id}";
    return fetchOne($sql);
}


/**
 *  修改预约状态
 * @param $id
 */
function editReservationStatus($id)
{
    $where = "res_id={$id}";
    $arr = $_POST;
    $url = "patientDetail.php?" . $where;
    //判断是否修改了状态
    if ($arr['res_status'] == null) {
        alertMes("请先修改状态！", $url);
    } else {
        if (updateData("reservation_info", $arr, $where)) {
            alertMes("状态更新成功！", $url);
        } else {
            alertMes("状态更新失败！", $url);
        }
    }
}