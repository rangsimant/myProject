<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<?php
require_once('facebook.php');
require_once('instagram.php');
$fb = new GetFacebook();
$ig = new GetInstagram();
echo "<pre>";
$fb->Download_Picture();
// $ig->Download_Picture();
?>