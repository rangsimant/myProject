<?php
require_once 'Powerpoint-Class.php';
	$ppt = new Powerpoint_Base();
	echo "string";
	$ppt->New_Slide();
	$ppt->Custom_Text('Sunnysun');
	$ppt->Centered_Text('AAAAAAA','BBBBB');
	$ppt->Custom_Text('Sunnysun',60,'521014');
	$ppt->New_Slide();
	$ppt->Centered_Text('df gufkjhnfkjgfku','dskjf ndkjg dfjk');


	$ppt->Savefile_PowerPoint("Acer");
?>