<?php 
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	/**
	* 
	*/
	class Spider_Instagram
	{
		private $instagram;
		private $db;
		private $lastdate;
		private $IDuser;
		private $max_media=30; // max Media
		private $num_media=1; // start Media
		private $user_ig_type;
		private $check_last_feed_date;
		private $username;
		function __construct()
		{
			date_default_timezone_set("Asia/Bangkok");
			$this->lastdate = date("Y-m-d H:i:s");
			$this->instagram = new Instagram(array(
		      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
		      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
		      'apiCallback' => 'http://instagram.com/'
		    )); // New Class API Instagram
		    $this->db = new Db(); // New class Database PDO
		}

		public function Get_Media_from_Client($username){
			date_default_timezone_set("Asia/Bangkok");
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
				$update_feed_date = $this->db->query("UPDATE user_ig SET user_ig_feed_date=:feed_date WHERE user_ig_name =:username AND user_ig_type='username'",array("feed_date"=>$this->lastdate,"username"=>$this->username[$keyIDuser]));
				$allMedia = $this->instagram->getUserMedia($IDuser);
				$this->GetMedia($allMedia); // call function GetUserMedia
			}
		}

		public function Get_Media_from_Hashtag($hashtag){
			date_default_timezone_set("Asia/Bangkok");
			foreach ($hashtag as $keyhashtag => $hashtag) {
				$this->check_last_feed_date = $this->db->query("SELECT user_ig_feed_date FROM user_ig WHERE user_ig_name=:username AND user_ig_type='hashtag'",array("username"=>$hashtag['user_ig_name'])); // get last date Feed
				$update_feed_date = $this->db->query("UPDATE user_ig SET user_ig_feed_date=:feed_date WHERE user_ig_name =:username AND user_ig_type='hashtag'",array("feed_date"=>$this->lastdate,"username"=>$hashtag['user_ig_name']));
				$allMedia = $this->instagram->getTagMedia($hashtag['user_ig_name']);
				$this->GetMedia($allMedia); // call function GetUserMedia
			}
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
				if (!empty($media->caption->text)) {
					$media_body = $media->caption->text;
				}
				else{
					$media_body ="";
				}
				$media_social_id = $media->id;
				// INSERT Media & Comment
				if ($this->num_media <= $this->max_media) {
					echo "#".$this->num_media."# Get Media ID : ".$media_social_id." Author : ".$media_display_name."\n";
					$this->InsertMedia($media_post_date,$media_author_id,$media_display_name,$media_social_id,$media_body); // insert media post to db
					$this->GetComments($media_social_id); // get and insert comment to db
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
				$this->GetMedia($allMedia);
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
			$selectMediaID = $this->db->query("SELECT post_social_id FROM post WHERE post_social_id= '".$media_social_id."'");
			if (empty($selectMediaID)) {
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

				$this->db->query("INSERT INTO post(".$fieldpost.") 
								  VALUES(:date,:display_name,:author_id,
								  	:body,:social_id,:type,
								  	:channel)", $insertPost
									);
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
			$selectID = $this->db->query("SELECT author_id FROM author WHERE author_id=".$comment_author_id);
			if (empty($selectID)) {
				$insertAuthor = array(
									"author_id"=>$comment_author_id,
									"author_username"=>$comment_display_name,
									"author_type"=>"instagram"
									);
				$this->db->query("INSERT INTO author(author_id,author_username,author_type) 
								VALUES (:author_id,:author_username,:author_type)",$insertAuthor
								);
			
			}
			$selectCommentID = $this->db->query("SELECT post_social_id FROM post WHERE post_social_id= '".$comment_social_id."'");
			if (empty($selectCommentID)){
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

				$this->db->query("INSERT INTO post(".$fieldComment.") 
								VALUES(:date,:display_name,:author_id,
									:body,:social_id,:type,
									:channel,:parent_social_id)", $insertPost
								);
				echo "Insert Comment ".$comment_social_id." time : ".date('Y-m-d H:i:s',$comment_post_date)."\n";
			}
		}
	}
?>