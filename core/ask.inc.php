<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/20
 * Time: 3:28
 */

/**
 *  添加提问
 * @param $json
 * @return string
 */
function postQuestion($json)
{
    $table = "ask_info";
    $time = date("Y-m-d H:i:s", time());
    $json["ask_time"] = $time;
//    return $json;
    if (insertData($table, $json)) {
        return "true";
    } else {
        return "false";
    }
}

/**
 *  通过用户id得到所有问题
 * @param $json
 * @return array
 */
function getAllQuestionsByUserId($json)
{
    $table = "ask_info";
    $id = $json['user_id'];
    $where = "ask_user_id = '{$id}'";
    $sql = "SELECT * FROM {$table} WHERE $where";
    $result = fetchAll($sql);
    return $result;
}