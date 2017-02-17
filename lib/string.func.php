<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 17:56
 */

/**
 *  生成验证码
 * @param int $type 1只有数字，2大小写字母，3小写字母和数字
 * @param int $length 验证码位数
 * @return string
 */
function buildRandomString($type = 1, $length = 4)
{
    if ($type == 1) {
        $chars = join("", range(0, 9));
    } elseif ($type == 2) {
        $chars = join("", array_merge(range("a", "z"), range("A", "Z")));
    } elseif ($type == 3) {
        $chars = join("", array_merge(range("a", "z"), range(0, 9)));
    }
    if ($length > strlen($chars)) {
        exit("字符串长度不够");
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}

/**
 *  生成唯一字符串。uniqid 生成一个唯一的 ID
 * @return string
 */
function getUniName()
{
    return md5(uniqid(microtime(true), true));
}

/**
 *  得到文件扩展名
 * @param $filename
 * @return string
 */
function getExt($filename)
{
    return strtolower(end(explode(".", $filename)));
}