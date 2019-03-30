<?php
session_start();
$font = './cowboy.ttf';

$cstrong = '236APIlky@dhxislUYH*!*(';
for ($i = 1; $i <= 3; $i++) {
	$bytes = openssl_random_pseudo_bytes($i, $cstrong);
	$random_no = bin2hex($bytes);
}
$_SESSION["validation_code"] = $random_no; 

$image = imagecreate(170, 50);
$background = imagecolorallocate($image, 8, 8, 8);
$foreground = imagecolorallocate($image, 255, 255, 255);

imagettftext($image, 30, 10, 25, 50, $foreground, $font, $_SESSION["validation_code"]);
header("Content-type: image/jpeg");
imagejpeg($image);
