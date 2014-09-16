<?php
	require_once 'bot-class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	$spider = new Spiderinstagram();
	$db = new Db();

	$hashtag = $db->query("SELECT user_ig_name FROM user_ig WHERE user_ig_type='hashtag'");
	$spider->SpiderHashtag($hashtag); // send as Object
?>