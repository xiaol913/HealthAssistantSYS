<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 17:47
 */

/**
 *  弹出信息窗口，并跳转页面
 * @param $mes
 * @param $url
 */
function alertMes($mes, $url)
{
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location='{$url}';</script>'";
}