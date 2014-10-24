<?php
require_once('head.php');
ini_set('max_execution_time', 0);
/**
* 
*/
class Bot
{
	private $db;
	private $fb;
	private $ig;
	private $appid;
	private $secret;
	private $timestamp;
	private $facebook_id;
	private $instagram_id;
	function __construct()
	{	
		date_default_timezone_set("Asia/Bangkok");
		$this->timestamp = date('Y-m-d H:i:s');
		$this->db = new Db();
		$this->ig = new Instagram(array(
	      'apiKey'      => "ab8e71229279462bb7d276d055b7e8b3",
	      'apiSecret'   => "1d19abf1a59e4efdbf58735833303996",
	      'apiCallback' => "http://instagram.com/"));
		$this->facebook_id = $this->db->query("SELECT account_id_user,account_username
												FROM account 
												WHERE account_channel ='facebook' AND
												account_subject = 'samsung' AND
												account_available = 'open'
												ORDER BY account_timestamp ASC");

		$this->instagram_id = $this->db->query("SELECT account_id_user,account_username ,account_last_datetime 
												FROM account 
												WHERE account_channel ='instagram' AND
												account_subject = 'samsung'
												account_available = 'open'
												ORDER BY account_timestamp ASC");
	}

	public function facebook(){
		date_default_timezone_set("Asia/Bangkok");
		foreach ($this->facebook_id as $key => $user) {
			$this->Randomtoken_Facebook();
			$this->fb = new Facebook(array( // Used access token Random
					'appId'=>$this->appid,
					'secret' =>$this->secret
					));
			echo $this->appid."|".$this->secret;
			$fromdate = strtotime('2014-01-01 00:00:00');
			$id_user = $user['account_id_user'];
			$username = $user['account_username'];
			echo "\n".$username;
			$this->db->query("UPDATE account SET account_timestamp = :account_timestamp WHERE account_username = :username AND account_channel ='facebook' AND account_available = 'open'",
				  array("account_timestamp"=>date("Y-m-d H:i:s"),
				  	"username"=>$username
				  	));
			$url = ('/'.$id_user.'/posts?fields=id,message,from{name},name,created_time&until='.$fromdate);
			try {
				$this->getPost_facebook($url,$username);
			}			
			 catch (Exception $e) {
			 	echo $e."\n";
			}
		}
	}

	public function instagram(){
		date_default_timezone_set("Asia/Bangkok");
		foreach ($this->instagram_id as $key => $id_user) {
			$this->last_datetime = $id_user['account_last_datetime'];
			$this->username = $id_user['account_username'];
			echo "\n".$this->username;
			$this->db->query("UPDATE account SET account_timestamp = :account_timestamp WHERE account_username = :username AND account_channel ='instagram' account_available = 'open'",
				  array("account_timestamp"=>date("Y-m-d H:i:s"),
				  	"username"=>$this->username
				  	));
			$id_user = $id_user['account_id_user'];
			$media = $this->ig->getUserMediaRange($id_user,'1356998400','1388509199'); // min timestapm = 2013-01-01 00:00:00 , max timestamp = 2013-12-31 29:59:5
			try{
				if (!empty($media)) {
					$this->GetAllMedia_instagram($media);
				}
				
			}
			catch(Exception $e){
				echo $e."\n";
			}
		}

	}

	private function getPost_facebook($url,$username){
		$insert_post;
		$url = $this->fb->api('/'.$url,'Get');
		$jsonPost = json_decode((json_encode($url)));
		foreach ($jsonPost->data as $post_key => $post) {
			if (strtotime($post->created_time) > strtotime('2013-01-01 00:00:00')) {
			$post_created_time = date("Y-m-d H:i:s",strtotime($post->created_time));
			$post_id = $post->id;
			$post_user_id = $post->from->id;
			$post_from_name = $post->from->name;
			$image = $this->fb->api("/".$post_id."?fields=attachments",'get');
			if (isset($post->message)) {
					$text = $post->message;
					if (isset($image['attachments']['data'][0]['media']['image']['src'])) {
						if ($image['attachments']['data'][0]['media']['image']['height'] > 200) {
								$datefile = date("Y-m-d H.i.s",strtotime($post_created_time));
								$images = $image['attachments']['data'][0]['media']['image']['src'];
								$img_name = "fb_".$datefile."_".$username.$post_key.".jpeg";
								$link = "https://www.facebook.com/".str_replace("_", "/posts/", $post_id);
								if (!file_exists("../images")) {
									mkdir("../images");
								}
								$this->db->query("INSERT IGNORE INTO author(author_id,author_displayname,author_type)
												  VALUES(:author_id,:displayname,'facebook')",
												  array("author_id"=>$post_user_id,
												  	"displayname"=>$post_from_name
												  	));
								$insert_post = $this->db->query("INSERT IGNORE INTO post(author_id,post_social_id,post_text,post_created_time,post_channel,post_img_name,post_link,post_subject) 
												  VALUES (:author_id,:post_social_id,:post_text,:post_created_time,:post_channel,:post_img_name,:post_link,:subject)",
												  array(
												  	"author_id"=>$post_user_id,
												  	"post_social_id"=>$post_id,
												  	"post_text"=>$text,
												  	"post_created_time"=>$post_created_time,
												  	"post_channel"=>'facebook',
												  	"post_img_name"=>$img_name,
												  	"post_link"=>$link,
												  	"subject"=>'samsung'
												  	));
								if ($insert_post > 0) {
									file_put_contents("../images/".$img_name,file_get_contents($images)); // Save Image
									echo ".";
								}
							} // end if check height 200
						} // end if isset image
					} // end if isset Message 
				} // end check strtotoime(datetime)
		else{
				return;
			}
		} // end foreach all Post
		if (isset($jsonPost->paging->next)) { // next pagination
			echo ">";
			$url = $jsonPost->paging->next;
			$url = substr($url, 32); // cut direct link
			$this->getPost_facebook($url,$username);
		}
	}




	private function GetAllMedia_instagram($media){
		foreach ($media->data as $key => $mediadata) {
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
				$user_id =  $mediadata->user->id;
				$created_time =$mediadata->created_time;
				if (isset($mediadata->images->standard_resolution->url)) {
					$images = $mediadata->images->standard_resolution->url;
					$img_name = "ig_".date("Y-m-d H.i.s",$created_time)."_".$mediadata->user->username.$key.".jpeg";
					$media_id = $mediadata->id;
					$link = $mediadata->link;
					if (!file_exists("../images")) {
						mkdir("../images");
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
						file_put_contents("../images/".$img_name,file_get_contents($images)); // Save Image
						echo ".";
					}
				}

		}
		if (isset($media->pagination->next_url)) {
			echo ">";
			$media = $this->ig->pagination($media);
			$this->GetAllMedia_instagram($media);
		}
	}



	private function Randomtoken_Facebook(){
		$fb_token[0] = array(
				'appid'=>'1646024095622253',
				'secret'=>'25ad52f609d75e675d20704f44c3f7cf',
				);
		$fb_token[1] =  array(
						'appid'=>'599818006801093',
						'secret'=>'9e2ea858c35150511d9cad5b546b570b',
						);
		$fb_token[2] = array(
						'appid'=>'1470103453272735',
						'secret'=>'47ae75fb0c441880fe660277aa320ff0',
						);

		$index = array_rand($fb_token);
		$this->appid =  $fb_token[$index]['appid'];
		$this->secret = $fb_token[$index]['secret'];
	}
}

?>