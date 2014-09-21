<?php 
ini_set('max_execution_time', 0);
try {
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	require_once 'config.php';
	} catch (Exception $e) {
		$this->writelogfile($e->getMessage());
	}
	/**
	* 
	*/
	class Spider_Instagram
	{
		private $instagram;
		private $db;
		private $lastdate;
		private $IDuser;
		private $max_media; // max Media
		private $num_media=1; // start Media
		private $user_ig_type;
		private $check_last_feed_date;
		private $username;
		private $config;
		private $totalMedia=0;
		private $totalComment=0;
		function __construct()
		{
			date_default_timezone_set("Asia/Bangkok");
			$this->config = new Config();
			$this->max_media=$this->config->MAX_MDDIA;
			$this->lastdate = date("Y-m-d H:i:s");
			$this->instagram = new Instagram(array(
		      'apiKey'      => $this->config->API_KEY,
		      'apiSecret'   => $this->config->API_SECRET,
		      'apiCallback' => $this->config->API_CALLBACK
		    )); // New Class API Instagram
		    $this->db = new Db(); // New class Database PDO
		}

		public function Get_Media_from_Client($username){
			$this->totalMedia=0;
			$this->totalComment=0;
			date_default_timezone_set("Asia/Bangkok");
			echo "Getting ID from Username..\n";
			try {
				foreach ($username as $keyuser => $user) {
					$this->username[] = $user['user_ig_name'];
					$this->check_last_feed_date = $this->db->query("SELECT user_ig_feed_date FROM user_ig WHERE user_ig_name=:username AND user_ig_type='username'",array("username"=>$user['user_ig_name'])); // get last date feed
					$CheckUser = $this->instagram->searchUser($user['user_ig_name']);
					foreach ($CheckUser->data as $keycheckuser => $Checkuser) {
						$checkuser = $Checkuser->username;
						if ($user['user_ig_name'] == $checkuser) {
							$this->IDuser[] = $Checkuser->id;
						}
					}
				} 
				foreach ($this->IDuser as $keyIDuser => $IDuser) {
					$allMedia = $this->instagram->getUserMedia($IDuser);
					if (isset($allMedia->data)) {
						$this->GetMedia($allMedia); // call function get Media & Comments and Insert to db
						$update_feed_date = $this->db->query("UPDATE user_ig SET user_ig_feed_date=:feed_date WHERE user_ig_name =:username AND user_ig_type='username'",array("feed_date"=>$this->lastdate,"username"=>$this->username[$keyIDuser]));
					}
					else{
						echo "This ID ".$IDuser." is Private !\n";
						$this->writelogfile("This ID : ".$IDuser." usernaem : ".$this->username[$keyIDuser]." is Private !");
					}
					
				}
			} catch (Exception $e) {
				$this->writelogfile($e->getMessage());
				echo "Error Message in file log/log.txt";
			}
							$this->writelogfile("Client Insert Medias($this->totalMedia) & Comments($this->totalComment) Successed !");
		}
		public function Get_Media_from_Hashtag($hashtag){
			$this->totalMedia=0;
			$this->totalComment=0;
			date_default_timezone_set("Asia/Bangkok");
			try{
				foreach ($hashtag as $keyhashtag => $hashtag) {
					$this->check_last_feed_date = $this->db->query("SELECT user_ig_feed_date FROM user_ig WHERE user_ig_name=:username AND user_ig_type='hashtag'",array("username"=>$hashtag['user_ig_name'])); // get last date Feed
					$allMedia = $this->instagram->getTagMedia($hashtag['user_ig_name']);
					$this->GetMedia($allMedia); // call function get Media & Comments and Insert to db
					$update_feed_date = $this->db->query("UPDATE user_ig SET user_ig_feed_date=:feed_date WHERE user_ig_name =:username AND user_ig_type='hashtag'",array("feed_date"=>$this->lastdate,"username"=>$hashtag['user_ig_name']));
				}
			} catch (Exception $e) {
				$this->writelogfile($e->getFile()." ".$e->getLine(),$e->getMessage());
				echo "Error Message in file log/log.txt";
			}
			$this->writelogfile("Hashtag Insert Medias($this->totalMedia) & Comments($this->totalComment) Successed !");
		}

		private function GetMedia(& $allMedia){
			foreach ($allMedia->data as $keymedia => $media) {
				$media_post_date = $media->created_time;
				if (!empty($media->user->full_name)) {
					$media_display_name = $media->user->full_name;
				}
				else{
					$media_display_name = $media->user->username;
				}
				$media_author_id = $media->user->id;

				$media_social_id = $media->id;
				// INSERT Media & Comment
				if ($this->num_media <= $this->max_media) {
					if (!empty($media->caption->text)) {
						$media_body = $media->caption->text;
						echo "#".$this->num_media."# Get Media ID : ".$media_social_id." Author : ".$media_display_name."\n";
						$this->InsertMedia($media_post_date,$media_author_id,$media_display_name,$media_social_id,$media_body); // insert media post to db
						$this->GetComments($media_social_id); // get and insert comment to db
					}
				}
				else{
					$this->num_media=1;
					return;
				}
				$this->num_media++;
				// END
			}
			if ($this->instagram->pagination($allMedia) !== NULL) {
				$allMedia = $this->instagram->pagination($allMedia);
				echo "Next Page Media!\n";
				if (isset($allMedia->data)) {
					$this->GetMedia($allMedia);
				}
				
			}
			else{
				$this->num_media=0;
			}
		}

		private function InsertMedia($media_post_date,$media_author_id,$media_display_name,$media_social_id,$media_body){
			$selectID = $this->db->query("SELECT author_id FROM author WHERE author_id=".$media_author_id);
			if (empty($selectID)) {
				$insertAuthor = array(
										"author_id"=>$media_author_id,
										"author_username"=>$media_display_name,
										"author_type"=>"instagram"
									  );
				$this->db->query("INSERT INTO author(author_id,author_username,author_type) 
								  VALUES (:author_id,:author_username,:author_type)",$insertAuthor);
				echo "Insert Author : ".$media_display_name."\n";
			}
				$fieldpost = "post_date,post_author_display_name,post_author_id,
							  post_body,post_social_id,post_type,
							  post_channel";
				$insertPost = array(
							"date"=>date('Y-m-d H:i:s',$media_post_date),
							"display_name"=>$media_display_name,
							"author_id"=>$media_author_id,
							"body"=>$media_body,
							"social_id"=>$media_social_id,
							"type"=>"post",
							"channel"=>"instagram"
							);

				$rowMedia = $this->db->query("INSERT IGNORE INTO post(".$fieldpost.") 
								  VALUES(:date,:display_name,:author_id,
								  	:body,:social_id,:type,
								  	:channel)", $insertPost
									);
				if ($rowMedia > 0) {
					$this->totalMedia++;
					echo "Insert Media : ".$media_social_id." time : ".date("Y-m-d H:i:s",$media_post_date)."\n";
				}
				
		}
		private function GetComments($media_social_id){
			$allComments = $this->instagram->getMediaComments($media_social_id);
			foreach ($allComments->data as $keycomments => $comments) {
				$comment_post_date = $comments->created_time;
				if (!empty($comments->from->full_name)) {
					$comment_display_name = $comments->from->full_name;
				}
				else{
					$comment_display_name =  $comments->from->username;
				}
				$comment_author_id =  $comments->from->id;
				$comment_body =  $comments->text;
				$comment_social_id =  $comments->id;
				$comment_parent_social_id = $media_social_id;
				// INSERT comment 
				if (strtotime($this->check_last_feed_date[0]['user_ig_feed_date']) < $comment_post_date) {
					$this->InsertComments($comment_post_date,$comment_display_name,$comment_author_id,$comment_body,$comment_social_id,$comment_parent_social_id);
				}
				// END
			}
		}

		private function InsertComments($comment_post_date,$comment_display_name,$comment_author_id,$comment_body,$comment_social_id,$comment_parent_social_id){
				$insertAuthor = array(
									"author_id"=>$comment_author_id,
									"author_username"=>$comment_display_name,
									"author_type"=>"instagram"
									);
				$this->db->query("INSERT IGNORE INTO author(author_id,author_username,author_type) 
								VALUES (:author_id,:author_username,:author_type)",$insertAuthor
								);
				$fieldComment = "post_date,post_author_display_name,post_author_id,
								 post_body,post_social_id,post_type,
								 post_channel,post_parent_social_id";
				$insertPost = array(
									"date"=>date('Y-m-d H:i:s',$comment_post_date),
									"display_name"=>$comment_display_name,
									"author_id"=>$comment_author_id,
									"body"=>$comment_body,
									"social_id"=>$comment_social_id,
									"type"=>"comment",
									"channel"=>"instagram",
									"parent_social_id"=>$comment_parent_social_id
									);

				$rowComment = $this->db->query("INSERT IGNORE INTO post(".$fieldComment.") 
								VALUES(:date,:display_name,:author_id,
									:body,:social_id,:type,
									:channel,:parent_social_id)", $insertPost
								);
				if ($rowComment > 0) {
					$this->totalComment++;
					echo "Insert Comment ".$comment_social_id." time : ".date('Y-m-d H:i:s',$comment_post_date)."\n";
				}
				
		}
		private function writelogfile($exception){
			if (!file_exists('log')) {
				mkdir("log",0777);
				$this->writfile($exception);
			}
			else{
				if (!file_exists("log/".date("Y-m-d").".txt")) {
					$this->writfile($exception);
				}
				else{
					$this->edit($exception);
				}
			}
		}
		private function writfile($exception){
			$logdate = new  Datetime();
				$myfile = fopen("log/".$logdate->format("Y-m-d").".txt", "a") or die("Unable to open file!");
				fwrite($myfile, "start :".$this->lastdate."\r\nfinish :".$logdate->format("Y-m-d H:i:s")."\r\n");
				fwrite($myfile, $exception."\r\n");	
				fclose($myfile);
		}
		private function edit($exception){
			$logdate = new Datetime();
			$newErr = "start :".$this->lastdate."\r\nfinish :".$logdate->format("Y-m-d H:i:s")."\r\n".$exception."\r\n\r\n";
			$newErr = $newErr.file_get_contents("log/".$logdate->format("Y-m-d").".txt");
			file_put_contents("log/".$logdate->format("Y-m-d").".txt", $newErr);
		}
	}
?>