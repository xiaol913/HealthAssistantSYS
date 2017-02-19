<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/18
 * Time: 19:56
 */
require_once '../include.php';

//从数据库得到数据
$allList = getPatientAllCasesByUserId(1);

//将数据进行json编码
$str = json_encode($allList);
//将数据进行json解码
$arr = json_decode($str);
//求其中一个数据
$res = $arr[0]->case_desc;

//$c = file_get_contents("php://input");
$new = json_decode(file_get_contents("php://input"),true);

$table="user_info";

//$link = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DB_NAME) or die("Connect MySQL Fail:" . mysqli_errno($link) . ":" . mysqli_errno($link));
//mysqli_query($link, 'SET NAMES UTF8');
//$keys = join(",", array_keys($new));
//$values = "'" . join("','", array_values($new)) . "'";
////PHP插入MySQL格式 insert into table_name (column1,2....) values (value1,2...)
//$sql = "insert into {$table} ($keys) VALUES ({$values})";
////mysqli_query($link, $sql);

echo $_REQUEST['act'];
//print_r($keys);
//print_r($values);
//print_r($sql);
if (insertData($table,$new)){
    echo "true";
}else{
    echo "false";
}



