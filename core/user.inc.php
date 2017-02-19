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
function registerUser($json){
    $table="user_info";
    if (insertData($table,$json)){
        return "true";
    }else{
        return "false";
    }
}

/**
 *  用户登录
 * @param $json
 * @return string
 */
function userLogin($json){
    $table="user_info";
    $sql = "select * from {$table} WHERE user_phone_num = '{$json['user_phone_num']}'";
    $phone = checkExists($sql);
    if ($phone){
        if ($json['user_password']==$phone['user_password']){
            $arr = [
                "user_id"=>$phone['user_id'],
                "user_phone_num"=>$phone['user_phone_num'],
                "user_name"=>$phone['user_name'],
                "user_id_card"=>$phone['user_id_card'],
                "user_sex"=>$phone['user_sex'],
                "user_age"=>$phone['user_age'],
                "user_address"=>$phone['user_address'],
                "user_family_num"=>$phone['user_family_num']
            ];
            return $arr;
        }else{
            return "wrong";
        }
    }else{
        return "not exist";
    }
}