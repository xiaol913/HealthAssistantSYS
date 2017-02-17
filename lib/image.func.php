<?php
/**
 * Created by PhpStorm.
 * User: ShawnG
 * Date: 2017/2/15
 * Time: 17:55
 */

require_once "string.func.php";

/**
 *
 * @param int $type 种类，和string.func.php内一致
 * @param int $length 验证码位数
 * @param int $pixel 干扰点数量
 * @param int $line 干扰线数量
 * @param string $sess_name
 */
function verifyImage($type = 1, $length = 4, $pixel = 10, $line = 1, $sess_name = "verify")
{
    //创建画布
    $width = 80;
    $height = 28;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);
    //用矩形填充画布
    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
    //调用string.func里的方法
    $chars = buildRandomString($type, $length);
    $_SESSION[$sess_name] = $chars;
    //字体
    $fontFile = "./fonts/MSYHL.TTC";
    //生成随机字体大小、角度、xy坐标、颜色
    for ($i = 0; $i < $length; $i++) {
        //使用 Mersenne Twister 算法返回随机整数。
        //字体大小
        $size = mt_rand(14, 18);
        //角度
        $angle = mt_rand(-15, 15);
        //线的x、y坐标
        $x = 5 + $i * $size;
        $y = mt_rand(20, 26);
        //颜色
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $text = substr($chars, $i, 1);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontFile, $text);
    }
    //生成干扰点
    if ($pixel) {
        for ($i = 0; $i < $pixel; $i++) {
            imagesetpixel($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), $black);
        }
    }
    //生成干扰线
    if ($line) {
        for ($i = 0; $i < $line; $i++) {
            $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
            imageline($image, mt_rand(0, $width - 1), mt_rand(0, $height - 1), mt_rand(0, $width - 1), mt_rand(0, $height - 1), $color);
        }
    }
    //定义图片格式为gif
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}

