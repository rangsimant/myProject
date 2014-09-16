<meta http-equiv=Content-Type content="text/html; charset=UTF8">
<?php 
	require_once 'API-master/instagram.class.php';
	require_once 'MySQL-PDO-Class/Db.class.php';
class Spiderinstagram{

	private $instagram;
	private $db;
	public function __construct(){
		$this->instagram = new Instagram(array(
	      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
	      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
	      'apiCallback' => 'http://instagram.com/'
	    )); // New Class API Instagram
	    $this->db = new Db(); // New class Database PDO
	}

	public function SpiderHashtag($Hashtag){
			$TagName = $this->instagram->getTagMedia($Hashtag); // API function
			echo "#Hashtag : ".$Hashtag."\n";
			$this->GetTagsMedia($TagName);
	}

	public function SpiderClient($client){
    $IDclient = $this->GetIDclient($client); // get IDclient form usernmae
		foreach ($IDclient as $keyIDclient => $IDval) {
			$media = $this->instagram->getUserMedia($IDval);
			$ID = $media->data[0]->user->id;
			$username = $media->data[0]->user->username;
			$selectID = $this->db->query("SELECT author_id FROM author WHERE author_id=".$ID);
			if (empty($selectID)) {
				$insertAuthor = $this->db->query("INSERT INTO author(author_id,author_username,author_type) 
											VALUES (:author_id,:author_username,:author_type)",array("author_id"=>$ID,"author_username"=>$username,"author_type"=>"instagram"));
			}
			echo "ID UserMedia : ".$IDval."\n";
			if (isset($media->data)) { // if ID is not Private
				$this->GetMedia($media);
			}
		}
	}


	private function GetIDclient($client){
	    foreach ($client as $key => $client) {
	    	$clientArr[] = $this->instagram->searchUser($client);
	    	foreach ($clientArr[$key]->data as $idxclient => $ig) {
	    		if ($client == $ig->username) {
	    			echo "Get ID: #".$ig->id."# from username: #".$client."#\n";
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
			$MediaPost="";
			if (isset($MediaVal->caption->text)) {
				$MediaPost = $MediaVal->caption->text; // Post of media
			}
			$MediaLike = $MediaVal->likes->count; // Like of media
			$MediaImage = $MediaVal->images->standard_resolution->url; // Image of media
			$MediaCreated_time = $MediaVal->created_time; // Created_time of media
			$MediaIDmedia = $MediaVal->id; // ID of media
			$MediaComment = $this->instagram->getMediaComments($MediaIDmedia); // Comment of meid
			//INSERT
			//END
			$type="client";
			$this->GetComments($MediaComment,$type); //Call function
			if ($keyMedia == 19) {
				$media = $this->instagram->pagination($media);
				echo "Next Page Client !\n";
				$this->GetMedia($media);
			}
		}
		exit();	
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
			$type = "hashtag";
			$this->GetComments($MediaComment,$type); // Call function
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
			if ($keytagname == 19) {
				$TagName = $this->instagram->pagination($TagName); // API function
				echo "Next Page !\n";
				$this->GetTagsMedia($TagName); // call function
			}
		}
		
	}
	private function GetComments($MediaComment,$type){
		foreach ($MediaComment->data as $keyComment => $CommentVal) {
			$CommentID = $CommentVal->id;
			$CommentCreated_time = $CommentVal->created_time;
			$CommentText = $CommentVal->text;
			$CommentFromUsernmae = $CommentVal->from->username;
			$CommentFromPicture = $CommentVal->from->profile_picture;
			$CommentFromID = $CommentVal->from->id;
			if (!empty($CommentVal->from->full_name)) {
				$CommentFromFullname = $CommentVal->from->full_name;
			}
			else{
				$CommentFromFullname = "Unknow";
			}
			// Insert to MySql HERE
			echo "Save Comment ".$type."\n";
		}
	}
}
?>