<?php
session_start();

/* buat captcha huruf */
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
$captcha = '';
for ($i = 0; $i < 5; $i++) {
    $captcha .= $characters[rand(0, strlen($characters) - 1)];
}

/* simpan ke session */
$_SESSION['captcha'] = $captcha;

/* buat image */
$width = 150;
$height = 50;
$image = imagecreate($width, $height);

/* warna */
$bg = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

/* noise garis */
for ($i = 0; $i < 5; $i++) {
    $lineColor = imagecolorallocate($image, rand(150,200), rand(150,200), rand(150,200));
    imageline($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $lineColor);
}

/* tulis captcha */
imagestring($image, 5, 30, 15, $captcha, $textColor);

/* output image */
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);