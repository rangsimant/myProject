<?php 
	ini_set('max_execution_time', 0);
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	require_once 'config.php';
	/**
	* 
	*/

	$config = new Config();
	$instagram = new Instagram(array(
      'apiKey'      => $config->API_KEY,
      'apiSecret'   => $config->API_SECRET,
      'apiCallback' => $config->API_CALLBACK
    )); // New Class API Instagram
    $db = new Db(); // New class Database PDO
    echo "<pre>";
    getID_from_User($db,$instagram);


	function getID_from_User($db,$instagram){
		$username = $db->query("SELECT user_ig_name FROM user_ig");
		foreach ($username as $key => $value) {
			echo "Find ID from Username. ".$value['user_ig_name']."\n";
			$username = $instagram->searchUser($value['user_ig_name']);
			foreach ($username->data as $indexName => $name) {
				if ($name->username == $value['user_ig_name']) {
					$id_user = $name->id;
					$db->query("UPDATE user_ig SET user_ig_id_user=:id_user WHERE user_ig_name=:username AND user_ig_type='username'",array("id_user"=>$id_user,"username"=>$name->username));
					echo "Update ID user\n";
				}
			}
		}
	}
?>