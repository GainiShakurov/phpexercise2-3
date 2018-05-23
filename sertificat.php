<?php
session_start();

$image = imagecreatetruecolor(700, 300);

$bcgrColor = imagecolorallocate($image, 242,242,242);
$textColor = imagecolorallocate($image, 28,22,22);

imagefill($image, 0, 0,$bcgrColor);

$fontFile = __DIR__ . '/lobster.ttf';

imagettftext($image, 20, 0,80, 90, $textColor, $fontFile, 'Сертификат о прохождении теста - ' . $_SESSION['testname']);
imagettftext($image, 20, 0,80, 130, $textColor, $fontFile, 'Имя - ' . $_SESSION['username']);
imagettftext($image, 20, 0,80, 170, $textColor, $fontFile, 'Кол-во правильных ответов - ' . $_SESSION['correct']);

header("Content-Type: image/png");

imagepng($image);
imagedestroy($image);

?>