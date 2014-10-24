<?php
require_once 'PHP-MySQL-PDO-Database-Class-master\Db.class.php';
$page=$_GET['page'];
$db = new Db();
$start = $page*10;
$select = $db->query("SELECT * FROM account LIMIT ".$start.",10");

echo "<pre>";

foreach ($select as $key => $value) {
	$html = "<div id='content'>
			<p>".$value['account_username']."</p>
			<p>".$value['account_id_user']."</p>
		</dvi>
		";
	echo $html;
}

?>