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
			if (date("Y-m-d H:i:s",$mediadata->created_time) > $this->last_datetime) {
				if (isset($mediadata->caption->text)) {
					$text = $mediadata->caption->text;
				}
				else{
					$text = "";
				}
				if (isset($mediadata->user->full_name)) {
					$displayname = $mediadata->user->full_name;
				}
				else{
					$displayname = $mediadata->user->username;
				}
				$user_id =  $mediadata->caption->from->id;
				$created_time =$mediadata->caption->created_time;
				$images = $mediadata->images->standard_resolution->url;
				$img_name = "ig_".date("Y-m-d",$created_time)."_".$mediadata->caption->from->username.$key.".jpeg";
				$media_id = $mediadata->id;
				$link = $mediadata->link;
				if (!file_exists("images")) {
					mkdir("images");
				}

				$this->db->query("INSERT IGNORE INTO author(author_id,author_displayname,author_type)
											  VALUES(:author_id,:displayname,'instagram')",
											  array("author_id"=>$user_id,
											  	"displayname"=>$displayname
											  	));
				$insert_media = $this->db->query("INSERT IGNORE INTO post(author_id,post_social_id,post_text,post_created_time,post_channel,post_img_name,post_link) 
											  VALUES (:author_id,:post_social_id,:post_text,:post_created_time,:post_channel,:post_img_name,:post_link)",
											  array(
											  	"author_id"=>$user_id,
											  	"post_social_id"=>$media_id,
											  	"post_text"=>$text,
											  	"post_created_time"=>date("Y-m-d H:i:s",$created_time),
											  	"post_channel"=>'instagram',
											  	"post_img_name"=>$img_name,
											  	"post_link"=>$link
											  	));
				if ($insert_media > 0) {
					file_put_contents("images/".$img_name,file_get_contents($images)); // Save Image
					echo " I";
				}
			}
			else{
				return;
			}

		}
		if (isset($media->pagination->next_url)) {
			echo " >";
			$media = $this->instagram->pagination($media);
			$this->GetAllMedia($media);
		}


	}
}

?>