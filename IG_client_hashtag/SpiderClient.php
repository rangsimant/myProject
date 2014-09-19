<?php
	require_once 'Sipder-Instagram-class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	$spider = new Spider_Instagram();
	$db = new Db();
	$client = $db->query("SELECT user_ig_name FROM user_ig WHERE user_ig_type='username'");
	$spider->Get_Media_from_Client($client); // send as Object
?>