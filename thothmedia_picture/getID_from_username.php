<?php
require 'Facebook-API\src\facebook.php';
require 'Instagram-API\instagram.class.php';
require 'PHP-MySQL-PDO-Database-Class-master\Db.class.php';
$fb_username = array(
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
$ig_username = array(
				"SamsungUSA",
				"SamsungUkraine",
				"SamsungUK",
				"SamsungTurkiye",
				"SamsungSwitzerland",
				"samsungsverige",
				"SamsungSuomi",
				"samsungru",
				"SamsungRomania",
				"samsungportugal",
				"SamsungPolska",
				"SamsungPH",
				"SamsungPakistan",
				"SamsungNorge",
				"SamsungNederland",
				"SamsungMobileUSA",
				"SamsungMobileNL",
				"samsungmobilemx",
				"samsungmobilebelgium",
				"SamsungMobileArabia",
				"samsungmexico",
				"SamsungKZ",
				"samsungitalia",
				"SamsungGulf",
				"SamsungGreece",
				"samsungfrance",
				"SamsungEgypt",
				"SamsungDanmark",
				"SamsungColombia",
				"SamsungCanada",
				"SamsungBrasil",
				"SamsungAustria",
				"SamsungArgentina"
						);

getIDFacebook($fb_username);
getIDInstagram($ig_username);


function getIDFacebook($fb_username){
	$groupAccount ="";
	$facebook = new Facebook(array(
		'appId'  => "1646024095622253",
		'secret' => "25ad52f609d75e675d20704f44c3f7cf",
	));
	$db = new Db();
	 foreach ($fb_username as $key => $fb_username) {
		$getFacebook = $facebook->api('/'.$fb_username.'?fields=id','get');
		$db->query("INSERT IGNORE INTO account(account_id_user,account_username,account_channel) VALUES (:id_user,:username,'facebook')",
			array(
				"id_user"=>$getFacebook['id'],
				"username"=>$fb_username
				));
	}
}

function getIDInstagram($ig_username){
	$instagram = new Instagram(array(
      'apiKey'      => "ab8e71229279462bb7d276d055b7e8b3",
      'apiSecret'   => "1d19abf1a59e4efdbf58735833303996",
      'apiCallback' => "http://instagram.com/"
    )); // New Class API Instagram
	$db = new Db();
	$groupAccount ="";
	foreach ($ig_username as $key => $ig_username) {
		$getInstagram = $instagram->searchUser($ig_username);
		foreach ($getInstagram->data as $key => $findeUsername) {
			if (strtolower($findeUsername->username) == strtolower($ig_username)) {
				$db->query("INSERT IGNORE INTO account(account_id_user,account_username,account_channel) VALUES (:id_user,:username,'instagram')",
							array(
							"id_user"=>$findeUsername->id,
							"username"=>$ig_username
							));
			}
		}
	}
}
?>