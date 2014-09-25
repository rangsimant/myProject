<?php
require 'Facebook-API\src\facebook.php';
require 'PHP-MySQL-PDO-Database-Class-master\Db.class.php';
ini_set('max_execution_time', 0); // limit seconds time for load
/**
* 
*/
class GetFacebook
{
	private $facebook;
	private $user;
	private $post_ID;
	private $page_ID;
	private $db;
	private $facebook_id;
	private $last_datetime;
	private $username;
	private $bot_run_time;
	function __construct()
	{
		date_default_timezone_set("Asia/Bangkok");
		$this->facebook = new Facebook(array(
  		'appId'  => "1646024095622253",
  		'secret' => "25ad52f609d75e675d20704f44c3f7cf",
		));
		$this->bot_run_time =date("Y-m-d H:i:s");
		$this->db = new Db();
		$this->facebook_id = $this->db->query("SELECT account_id_user,account_username ,account_last_datetime FROM account WHERE account_channel ='facebook'");
	}

	public function Download_Picture(){
		$groupPost="";
		foreach ($this->facebook_id as $key => $id_user) {
			$this->last_datetime = $id_user['account_last_datetime'];
			$this->username = $id_user['account_username'];
			echo "\nAuthor : ".$this->username;
			$id_user = $id_user['account_id_user'];
			$url = ('/'.$id_user.'/posts?fields=id,message,from{name},name,created_time');
			$this->getPost($url);
			$this->db->query("UPDATE account SET account_last_datetime = :last_datetime WHERE account_username = :username",
							  array("last_datetime"=>$this->bot_run_time,
							  	"username"=>$this->username
							  	));
			echo " [x] Done";
		}
	}

	private function getPost($url){
		date_default_timezone_set("Asia/Bangkok");
		$url = $this->facebook->api('/'.$url,'Get');
		$jsonPost = json_decode((json_encode($url)));
		foreach ($jsonPost->data as $post_key => $value) {
			if ($this->last_datetime < date("Y-m-d H:i:s",strtotime($value->created_time))) {
				$post_id = $value->id;
				$user_id = $value->from->id;
				$created_time = date("Y-m-d H:i:s",strtotime($value->created_time));
				$name = $value->from->name;
				$image = $this->facebook->api("/".$post_id."?fields=attachments",'get');
				if (isset($value->message)) {
					$text = $value->message;
					if (isset($image['attachments']['data'][0]['media']['image']['src'])) {
						if ($image['attachments']['data'][0]['media']['image']['height'] != 200) {
							$datefile = date("Y-m-d",strtotime($created_time));
							$images = $image['attachments']['data'][0]['media']['image']['src'];
							$img_name = "fb_".$datefile."_".$this->username.$post_key.".jpeg";
							if (!file_exists("images")) {
								mkdir("images");
							}
							$this->db->query("INSERT IGNORE INTO author(author_id,author_displayname,author_type)
											  VALUES(:author_id,:displayname,'facebook')",
											  array("author_id"=>$user_id,
											  	"displayname"=>$name
											  	));
							$insert_post = $this->db->query("INSERT IGNORE INTO post(author_id,post_social_id,post_text,post_created_time,post_channel,post_img_name) 
											  VALUES (:author_id,:post_social_id,:post_text,:post_created_time,:post_channel,:post_img_name)",
											  array(
											  	"author_id"=>$user_id,
											  	"post_social_id"=>$post_id,
											  	"post_text"=>$text,
											  	"post_created_time"=>$created_time,
											  	"post_channel"=>'facebook',
											  	"post_img_name"=>$img_name
											  	));
						} // end if check height 200
							if ($insert_post > 0) {
								file_put_contents("images/".$img_name,file_get_contents($images)); // Save Image
								echo " I";
							}
					} // end if isset image
				} // end if isset Message
			} // check datetime
			else{
				return;
			}
		} // end foreach all Post
		if (isset($jsonPost->paging->next)) { // next pagination
			echo " >";
			$url = $jsonPost->paging->next;
			$url = substr($url, 32); // cut direct link
			$this->getPost($url);
		}
	}
}

?>