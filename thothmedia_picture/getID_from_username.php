<?php
require 'Facebook-API\src\facebook.php';
require 'PHP-MySQL-PDO-Database-Class-master\Db.class.php';
$username = array(
			"samsungthailand",
			"SamsungEgypt",
			"SamsungSouthAfrica",
			"SamsungMobileSA",
			"SamsungAustralia",
			"SamsungHK",
			"SamsungMobileHK",
			"samsungIN",
			"SamsungMobileIndia",
			"SamsungIndonesia",
			"SamsungMobileIndonesia"
			);

getID($username);
function getID($username){
	$groupAccount ="";
	$facebook = new Facebook(array(
		'appId'  => "1646024095622253",
		'secret' => "25ad52f609d75e675d20704f44c3f7cf",
	));
	$db = new Db();
	 foreach ($username as $key => $username) {
		$getFacebook = $facebook->api('/'.$username.'?fields=id','get');
		if ($groupAccount == "") {
			$groupAccount = "('".$getFacebook['id']."','".$username."','facebook')";
		}
		else{
			$groupAccount .= ",('".$getFacebook['id']."','".$username."','facebook')";
		}
	}
	$db->query("INSERT INTO account(account_id_user,account_username,account_channel) VALUE ".$groupAccount);

}
?>