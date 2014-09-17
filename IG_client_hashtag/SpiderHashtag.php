<?php
	require_once 'Sipder-Instagram-class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	$spider = new Spider_Instagram();
	$db = new Db();

	$hashtag = $db->query("SELECT user_ig_name FROM user_ig WHERE user_ig_type='hashtag'");
	$spider->Get_Media_from_Hashtag($hashtag); // send as Object
?>