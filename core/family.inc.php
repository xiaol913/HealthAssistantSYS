<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/19
 * Time: 23:53
 */

/**
 *  创建家庭
 * @param $json
 * @return string
 */
function createFamily($json)
{
    $table = "family_info";
    $sql = "SELECT * FROM {$table} WHERE fam_name = '{$json['fam_name']}'";
    $firstCheck = fetchOne($sql);
    if ($firstCheck) {
        return "exist";
    } else {
        $fam_name = [
            "fam_name" => $json['fam_name']
        ];
        $result = insertData($table, $fam_name);
        if ($result == 0) {
            return "fail";
        } else {
            $user_family_num = [
                "user_family_num" => $result
            ];
            $userWhere = "user_id = " . $json['user_id'];
            if (updateData("user_info", $user_family_num, $userWhere)) {
                return "success";
            } else {
                return "fail";
            }
        }
    }
}

/**
 *  通过手机号码和密码添加家庭成员
 * @param $json
 * @return string
 */
function addFamilyMember($json)
{
    $user = [
        "user_phone_num" => $json['user_phone_num'],
        "user_password" => $json['user_password']
    ];
    $result = userLogin($user);
    if ($result == "not exist" || $result == "wrong") {
        return $result;
    } else {
        $arr = [
            "user_family_num" => $json['user_family_num']
        ];
        $where = "user_phone_num = " . $json['user_phone_num'];
        if (updateData("user_info", $arr, $where)) {
            return "success";
        } else {
            return "fail";
        }
    }
}

/**
 *  删除（更新）家庭成员
 * @param $json
 * @return string
 */
function deleteFamilyMember($json)
{
    $where = "user_id = " . $json['user_id'];
    $arr = ["user_family_num" => ""];
    if (updateData("user_info", $arr, $where)) {
        return "success";
    } else {
        return "fail";
    }
}