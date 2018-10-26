<?php

if (!isset($_GET['name']) || $_GET['name']=="") {
    die();
}

$name = strtolower($_GET['name']);

//Set the Content Type
header('Content-type: image/jpeg');

// Create Image From Existing File
$jpg_image = imagecreatefromjpeg('google.jpg');

// Allocate A Color For The Text
$white = imagecolorallocate($jpg_image, 0, 0, 0);

// Set Path to Font File
$font_path = 'arial.ttf';

// Set Text to Be Printed On Image
//$text = strtolower($name);

// Print Text On Image
// Search Box
imagettftext($jpg_image, 13, 0, 100, 190, $white, $font_path, $name);

// Suggestions
$arr = array("is dead", "won a lottery", "escaped from prison", "age",  "educational background", "is an idiot", "bank robbery", "facebook profile", "funny memes", "sleep so much");
$rand_keys = array_rand($arr, 4);

imagettftext($jpg_image, 13, 0, 100, 223, $white, $font_path, $name." ".$arr[$rand_keys[0]]);
imagettftext($jpg_image, 13, 0, 100, 245, $white, $font_path, $name." ".$arr[$rand_keys[1]]);
imagettftext($jpg_image, 13, 0, 100, 267, $white, $font_path, $name." ".$arr[$rand_keys[2]]);
imagettftext($jpg_image, 13, 0, 100, 289, $white, $font_path, $name." ".$arr[$rand_keys[3]]);

// Send Image to Browser
imagejpeg($jpg_image);

// Clear Memory
imagedestroy($jpg_image);



?>
