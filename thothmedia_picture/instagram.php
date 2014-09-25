<?php
require_once ('Instagram-API\instagram.class.php');
require_once ('PHP-MySQL-PDO-Database-Class-master\Db.class.php');
/**
* 
*/
class GetInstagram
{
	private $instagram;
	private $db;
	private $instagram_id;
	private $bot_run_time;
	function __construct()
	{
		date_default_timezone_set("Asia/Bangkok");
		$this->bot_run_time = date("Y-m-d H:i:s");
		$this->instagram = new Instagram(array(
	      'apiKey'      => "ab8e71229279462bb7d276d055b7e8b3",
	      'apiSecret'   => "1d19abf1a59e4efdbf58735833303996",
	      'apiCallback' => "http://instagram.com/"
	    )); // New Class API Instagram
	    $this->db = new Db(); // New class Database PDO
	    $this->instagram_id = $this->db->query("SELECT account_id_user,account_username ,account_last_datetime FROM account WHERE account_channel ='instagram'");
	}

	public function Download_Picture(){
		$groupPost="";
		foreach ($this->instagram_id as $key => $id_user) {
			$this->last_datetime = $id_user['account_last_datetime'];
			$this->username = $id_user['account_username'];
			echo "\nAuthor : ".$this->username;
			$id_user = $id_user['account_id_user'];
			$media = $this->instagram->getUserMedia($id_user);
			$this->GetAllMedia($media);
			$this->db->query("UPDATE account SET account_last_datetime = :last_datetime WHERE account_username = :username",
							  array("last_datetime"=>$this->bot_run_time,
							  	"username"=>$this->username
							  	));
			echo " [x] Done";
		}
	}

	private function GetAllMedia($media){
		foreach ($media->data as $key => $mediadata) {
			if (date("Y-m-d H:i:s",strtotime($mediadata->caption->created_time)) > $this->last_datetime) {
				$text = $mediadata->caption->text;
				$displayname = $mediadata->caption->full_name;
				$user_id =  $mediadata->caption->id;
				$image = $mediadata->images->standard_resolution->url;
				$created_time =$mediadata->caption->created_time;
				$media_id = $mediadata->id;
				$link = $mediadata->link;
			}
		}
		if (isset($media->pagination->next_url)) {
			$media = $this->instagram->pagination($media);
			$this->GetAllMedia($media);
		}


	}
}

?>