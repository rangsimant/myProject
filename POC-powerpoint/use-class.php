<?php
require_once 'template-1.php';

$template1 = new Template1();

$title ="Sprint #4";
$subtitle = "Poc PHPPowerPoint";
$date = date('Y-m-d H:i:s');
$filename = "test";
$txtslide2 = "Header Top Mid Center";

$template1->FirstSlide($title,$subtitle);
$template1->Centered_Text($title,$subtitle);
$template1->Blank_Slide();
$template1->Title_Slide($title,$subtitle);
$template1->Blank_Slide();
$template1->Pie_Chart();


// save to file
$template1->Savefile_PowerPoint($filename);
?>