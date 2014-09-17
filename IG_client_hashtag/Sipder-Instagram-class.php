<?php 
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	date_default_timezone_set("Asia/Bangkok");
	/**
	* 
	*/
	class Spider_Instagram
	{
		private $instagram;
		private $db;
		private $lastdate;
		private $IDuser;
		private $max_media=30;
		private $num_media=1;
		function __construct()
		{
			$this->lastdate = date("Y-m-d H:i:s");
			$this->instagram = new Instagram(array(
		      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
		      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
		      'apiCallback' => 'http://instagram.com/'
		    )); // New Class API Instagram
		    $this->db = new Db(); // New class Database PDO
		}

		public function Get_Media_from_Client($username){
			foreach ($username as $keyuser => $user) {
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
				$this->GetMedia($allMedia); // call function GetUserMedia
			}
		}

		public function Get_Media_from_Hashtag($hasgtag){
			foreach ($hasgtag as $keyhashtag => $hasgtag) {
				$allMedia = $this->instagram->getTagMedia($hasgtag['user_ig_name']);
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
					echo "Get Media ID : ".$media_social_id." ".$this->num_media."\n";
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
				echo "Next Page !\n";
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
				echo "Insert new Author !\n";
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
				echo "Insert new Media ! created_time : ".date("Y-m-d",$media_post_date)."\n";
		
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
				$this->InsertComments($comment_post_date,$comment_display_name,$comment_author_id,$comment_body,$comment_social_id,$comment_parent_social_id);
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
				echo "Insert Comment ! created_time : ".date('Y-m-d',$comment_post_date)."\n";
			}
		}
	}
?>