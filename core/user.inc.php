<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/19
 * Time: 0:53
 */

/**
 *  用户注册
 * @param $json
 * @return string
 */
function registerUser($json)
{
    $table = "user_info";
    if (insertData($table, $json)) {
        return "true";
    } else {
        return "false";
    }
}

/**
 *  用户登录
 * @param $json
 * @return string
 */
function userLogin($json)
{
    $table = "user_info";
    $sql = "select * from {$table} WHERE user_phone_num = '{$json['user_phone_num']}'";
    $phone = checkExists($sql);
    if ($phone) {
        if ($json['user_password'] == $phone['user_password']) {
            $arr = [
                "user_id" => $phone['user_id'],
                "user_phone_num" => $phone['user_phone_num'],
                "user_name" => $phone['user_name'],
                "user_id_card" => $phone['user_id_card'],
                "user_sex" => $phone['user_sex'],
                "user_age" => $phone['user_age'],
                "user_address" => $phone['user_address'],
                "user_family_num" => $phone['user_family_num']
            ];
            return $arr;
        } else {
            return "wrong";
        }
    } else {
        return "not exist";
    }
}

/**
 *  得到家庭成员信息
 * @param $json
 * @return array
 */
function getUserFamily($json)
{
    $search = "user.user_id, user.user_name, user.user_age, user.user_sex, fam.fam_name";
    $table = "user_info AS user LEFT JOIN family_info AS fam ON user.user_family_num = fam.fam_id";
    $where = "fam.fam_id = " . $json['user_family_num'];
    $sql = "SELECT {$search} FROM {$table} WHERE {$where}";
    $result = fetchAll($sql);
    return $result;
}

/**
 *  通过病人id查找所有相关信息
 * @param $json
 * @return array
 */
function getUserInfo($json)
{
    $table = "user_info AS user LEFT JOIN (case_info AS cas, hospital_info AS hosp, type_info AS type) ON (user.user_id = cas.case_user_id AND cas.case_hos_id = hosp.hos_id AND cas.case_type_id = type.type_id)";
    $search = "user.user_name, user.user_age, user.user_sex, user.user_id_card, user.user_phone_num, user.user_address, hosp.hos_name, hosp.hos_part,type.type_name, cas.case_date,cas.case_id,cas.case_desc";
    $where = "user.user_id =" . $json['user_id'];
    $sql = "SELECT {$search} FROM {$table} WHERE {$where}";
    $result = fetchAll($sql);
    return $result;
}

/**
 *  修改用户资料，除了密码
 * @param $json
 * @return string
 */
function editUserNoPassword($json)
{
    $table = "user_info";
    $arr = [
        "user_name" => $json['user_name'],
        "user_age" => $json['user_age'],
        "user_id_card" => $json['user_id_card'],
        "user_phone_num" => $json['user_phone_num'],
        "user_address" => $json['user_address'],
        "user_sex" => $json['user_sex'],
    ];
    $where = "user_id = " . $json['user_id'];
    if (updateData($table, $arr, $where)) {
        return "success";
    } else {
        return "fail";
    }
}

/**
 *  修改用户密码
 * @param $json
 * @return string
 */
function editUserPassword($json)
{
    $oldPass = $json['oldPass'];
    $user_id = $json['user_id'];
    $table = "user_info";
    $where = "user_id =" . $json['user_id'];
    $sql = "SELECT * FROM {$table} WHERE user_id = '{$user_id}'";
    $user = fetchOne($sql);
    if ($oldPass == $user['user_password']) {
        $arr = [
            "user_password" => $json['newPass']
        ];
        if (updateData($table, $arr, $where)) {
            return "success";
        } else {
            return "fail";
        }
    } else {
        return "wrong";
    }
}