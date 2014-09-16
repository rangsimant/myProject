<?php
	require_once 'bot-class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	$spider = new Spiderinstagram();
	$db = new Db();

	$client = $db->query("SELECT user_ig_name FROM user_ig WHERE user_ig_type='username'");
	$spider->SpiderClient($client); // send as Object
?>