<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/17
 * Time: 7:15
 */

/**
 *  获得所有状态信息
 * @return array
 */
function getAllStatus()
{
    $sql = "SELECT * FROM status_info";
    $result = fetchAll($sql);
    return $result;
}
