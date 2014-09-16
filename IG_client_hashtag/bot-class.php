<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<?php 
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
	date_default_timezone_set("Asia/Bangkok");
class Spiderinstagram{
	private $instagram;
	private $db;
	private $lastdate;
	public function __construct(){
		$this->lastdate = date("Y-m-d H:i:s");
		$this->instagram = new Instagram(array(
	      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
	      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
	      'apiCallback' => 'http://instagram.com/'
	    )); // New Class API Instagram
	    $this->db = new Db(); // New class Database PDO
	}
	// $hashtag is Object Array
	public function SpiderHashtag($hashtag){
		foreach ($hashtag as $keytag => $TagVal) {
			$TagName = $this->instagram->getTagMedia($TagVal['user_ig_name']); // API function
			echo "#Hashtag : ".$TagVal['user_ig_name']."\n";
			$this->GetTagsMedia($TagName);
		}
	}

	// $client is Object Array
	public function SpiderClient($client){
    $IDclient = $this->GetIDclient($client); // get IDclient form username
		foreach ($IDclient as $keyIDclient => $IDval) {
			$media = $this->instagram->getUserMedia($IDval);
			$ID = $media->data[0]->user->id;
			$username = $media->data[0]->user->username;
			echo "ID UserMedia : ".$IDval."\n";
			if (isset($media->data)) { // if ID is not Private
				$this->GetMedia($media); // get Data And Insert to DB
			}
		}
	}



	private function GetIDclient($client){
	    foreach ($client as $key => $client) {
	    	$clientArr[] = $this->instagram->searchUser($client['user_ig_name']);
	    	foreach ($clientArr[$key]->data as $idxclient => $ig) {
	    		if ($client['user_ig_name'] == $ig->username) {
	    			echo "Get ID: #".$ig->id."# from username: #".$client['user_ig_name']."#\n";
	    			$IDclient[] = $ig->id;
	    			break;
	    		}
	    	}
	    }
	    return $IDclient;
	}

	private function GetMedia($media){
		foreach ($media->data as $keyMedia => $MediaVal) {
			echo "ID Media : ".$MediaVal->id."\n";
			$MediaCreated_time = $MediaVal->created_time; // Created_time of media
			$MediaUsername = $MediaVal->user->full_name;
			$MediaUserID = $MediaVal->user->id;
			$MediaText="";
			if (isset($MediaVal->caption->text)) {
				$MediaText = $MediaVal->caption->text; // Post of media
			}
			$MediaID = $MediaVal->id; // ID of media
			$MediaType = "post";
			$MediaChannel = "instagram";
			//INSERT FROM Client
			$selectID = $this->db->query("SELECT author_id FROM author WHERE author_id=".$MediaUserID);
			if (empty($selectID)) {
				$this->db->query("INSERT INTO author(author_id,author_username,author_type) 
								VALUES (:author_id,:author_username,:author_type)",
								array("author_id"=>$MediaUserID,"author_username"=>$MediaUsername,"author_type"=>"instagram"));
			}
			$updateDATE = $this->db->query("UPDATE user_ig SET user_ig_date=:lastdate WHERE user_ig_name = :username AND user_ig_type='username'",array("lastdate"=>$this->lastdate,"username"=>$MediaUsername));
			$selectMediaID = $this->db->query("SELECT post_social_id FROM post WHERE post_social_id= '".$MediaID."'");
			if (empty($selectMediaID)) {
				$fieldpost = "post_date,post_author_display_name,post_author_id,
							  post_body,post_social_id,post_type,
							  post_channel";
				$this->db->query("INSERT INTO post(".$fieldpost.") 
								  VALUES(:date,:display_name,:author_id,
								  	:body,:social_id,:type,
								  	:channel)",
									array("date"=>date('Y-m-d H:i:s',$MediaCreated_time),"display_name"=>$MediaUsername,"author_id"=>$MediaUserID,
										"body"=>$MediaText,"social_id"=>$MediaID,"type"=>$MediaType,
										"channel"=>$MediaChannel));
			}
			//END
			$MediaComment = $this->instagram->getMediaComments($MediaID); // Comment of media
			$type="Client";
			$this->GetComments($MediaComment,$type,$MediaID); //Call function get Comment Data and Insert to DB
		}
		if (($this->instagram->pagination($media)) !== NULL) {
			$media = $this->instagram->pagination($media);
			echo "Next Page Client !\n";
			$this->GetMedia($media);
		}
	}

	private function GetTagsMedia(& $TagName){
		foreach ($TagName->data as $keytagname => $TagNameVal) {
			$tag_lat = 0;
			$tag_long = 0;
			$tag_text="";
			$tag_from_username="";
			$tag_from_id="";
			$tag_from_picture="";
			$tag_from_fullname="";

			if (isset($TagNameVal->location)) {
				$tag_lat = $TagNameVal->location->latitude;
				$tag_long = $TagNameVal->location->longitude;
			}
			$tag_IDmedia = $TagNameVal->id;
			$MediaComment = $this->instagram->getMediaComments($tag_IDmedia);
			echo "IDMedia_Post : ".$tag_IDmedia."\n";
			$type = "Hashtag";
			$this->GetComments($MediaComment,$type,$tag_IDmedia); // Call function
			$tag_created_time = $TagNameVal->created_time;
			$tag_link = $TagNameVal->link;
			$tag_likes = $TagNameVal->likes->count;
			$tag_images = $TagNameVal->images->standard_resolution;
			if (isset($TagNameVal->caption->text)) {
				$tag_text = $TagNameVal->caption->text;
			}
			if (isset($TagNameVal->caption->from->username)) {
				$tag_from_username = $TagNameVal->caption->from->username;
			}
			if (isset($TagNameVal->caption->from->id)) {
				$tag_from_id = $TagNameVal->caption->from->id;	
			}
			if (isset($TagNameVal->caption->from->profile_picture)) {
				$tag_from_picture = $TagNameVal->caption->from->profile_picture;
			}
			if (isset($TagNameVal->caption->from->full_name)) {
				$tag_from_fullname = $TagNameVal->caption->from->full_name;
			}
		}
		if ($this->instagram->pagination($TagName) !== NULL) {
			$TagName = $this->instagram->pagination($TagName); // API function
			echo "Next Page !\n";
			$this->GetTagsMedia($TagName); // call function
		}
		
	}
	private function GetComments($MediaComment,$type,$parentID){
		foreach ($MediaComment->data as $keyComment => $CommentVal) {
			$CommentID = $CommentVal->id;
			$CommentCreated_time = $CommentVal->created_time;
			$CommentText = $CommentVal->text;
			$CommentFromUsernmae = $CommentVal->from->username;
			$CommentFromPicture = $CommentVal->from->profile_picture;
			$CommentFromID = $CommentVal->from->id;
			$CommentType = "comment";
			$CommentChannel = "instagram";
			if (!empty($CommentVal->from->full_name)) {
				$CommentFromFullname = $CommentVal->from->full_name;
			}
			else{
				$CommentFromFullname = $CommentFromUsernmae;
			}
			// Insert to MySql HERE
			$selectID = $this->db->query("SELECT author_id FROM author WHERE author_id=".$CommentFromID);
			if (empty($selectID)) {
				$this->db->query("INSERT INTO author(author_id,author_username,author_type) 
								VALUES (:author_id,:author_username,:author_type)",
								array("author_id"=>$CommentFromID,"author_username"=>$CommentFromFullname,"author_type"=>"instagram"));
			
			}
			$selectCommentID = $this->db->query("SELECT post_social_id FROM post WHERE post_social_id= '".$CommentID."'");
			if (empty($selectCommentID)){
				$fieldComment = "post_date,post_author_display_name,post_author_id,
								 post_body,post_social_id,post_type,
								 post_channel,post_parent_social_id";
				$this->db->query("INSERT INTO post(".$fieldComment.") 
								VALUES(:date,:display_name,:author_id,
									:body,:social_id,:type,
									:channel,:parent_social_id)",
								array("date"=>date('Y-m-d H:i:s',$CommentCreated_time),"display_name"=>$CommentFromFullname,"author_id"=>$CommentFromID,
									"body"=>$CommentText,"social_id"=>$CommentID,"type"=>$CommentType,
									"channel"=>$CommentChannel,"parent_social_id"=>$parentID));
				//END
				echo "Save Comment ".$type."\n";
			}
		}
	}
}
?>