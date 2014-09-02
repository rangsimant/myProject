<?php
ini_set('max_execution_time', 0); // limit seconds time for load
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    )); // New Class API Instagram
    echo "<pre>"; // format code
    $user='samsung';
	$dataUser = $instagram->searchUser($user);
	$media =$instagram->getUserMedia($dataUser->data[1]->id);
	print_r($dataUser);
	echo date('d/m/y H:i:s',$media->data[0]->created_time);
	$date = strtotime('2014-09-01 15:17:54');

	echo  "<br>".$date;
?>