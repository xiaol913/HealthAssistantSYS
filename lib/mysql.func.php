<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 18:21
 */

/**
 *  根据条件查找一条数据
 * @param $sql  查找条件
 * @param int $result_type
 * @return array|null
 */
function fetchOne($sql, $result_type = MYSQLI_ASSOC)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DB_NAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, $result_type);
    return $row;
}

/**
 *  根据条件查找所有数据
 * @param $sql  查找条件
 * @param int $result_type
 * @return array
 */
function fetchAll($sql, $result_type = MYSQLI_ASSOC)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DB_NAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result, $result_type)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 *  插入数据
 * @param $table    表单名称
 * @param $array    数据组成的数组
 * @return int|string
 */
function insertData($table, $array)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DB_NAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    $keys = join(",", array_keys($array));
    $values = "'" . join("','", array_values($array)) . "'";
    //PHP插入MySQL格式 insert into table_name (column1,2....) values (value1,2...)
    $sql = "insert into {$table} ($keys) VALUES ({$values})";
    mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}

/**
 *  更新数据
 * @param $table    表单名称
 * @param $array    数据组成的数组
 * @param null $where 条件
 * @return bool
 */
function updateData($table, $array, $where = null)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DB_NAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    //定义一个空的字符串
    $str = null;
    //遍历条件
    foreach ($array as $key => $value) {
        //判断是否为开头
        if ($str == null) {
            $sep = "";
        } else {
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $value . "'";
    }
    //注意空格
    $sql = "update {$table} set {$str} " . ($where == null ? null : " where " . $where);
    $result = mysqli_query($link, $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 *  删除数据
 * @param $table    表单名称
 * @param null $where 条件
 * @return int
 */
function deleteData($table, $where = null)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    $where = $where == null ? null : " where " . $where;
    $sql = "delete from {$table} {$where}";
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}

/**
 *  得到找到的数据的数量
 * @param $sql  查找条件
 * @return int
 */
function getResultNum($sql)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
    mysqli_query($link, 'SET NAMES UTF8');
    $result = mysqli_query($link, $sql);
    return mysql_num_rows($result);
}