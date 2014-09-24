<?php
require 'Facebook-API\src\facebook.php';
require 'PHP-MySQL-PDO-Database-Class-master\Db.class.php';
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
	function __construct()
	{
		$this->facebook = new Facebook(array(
  		'appId'  => "1646024095622253",
  		'secret' => "25ad52f609d75e675d20704f44c3f7cf",
		));
		$this->db = new Db();
		$this->facebook_id = $this->db->query("SELECT account_id_user FROM account");
	}

	public function test(){
		$groupPost="";
		foreach ($this->facebook_id as $key => $id_user) {
			$id_user = $id_user['account_id_user'];
			$url = ('/'.$id_user.'/posts?fields=id,message,from{name},name,created_time,link&limit=250');
			$this->getPost($url);
			$jsonPost = json_decode((json_encode($Page_post)));
			print_r($jsonPost);exit();
			foreach ($jsonPost->data as $post_key => $value) {
				
			}
			echo $groupPost;exit();
		}
		foreach ($Page_post['data'] as $key => $getpostID) {
			if (isset($getpostID['message'])) {
				$this->post_ID[] = $getpostID['id'];
				echo $key.". ".$getpostID['message']."\n";
			}
		}

		foreach ($this->post_ID as $key => $ID) {
			$image = $this->facebook->api("/".$ID."?fields=attachments",'get');
			echo "<img src='".$image['attachments']['data'][0]['media']['image']['src']."'><br>";
		}
	}

	private function getPost($url){
		date_default_timezone_set("Asia/Bangkok");
		$url = $this->facebook->api('/'.$url,'Get');
		$jsonPost = json_decode((json_encode($url)));
		foreach ($jsonPost->data as $post_key => $value) {
			$post_id = $value->id;
			$user_id = $value->from->id;
			$created_time = date("Y-m-d H:i:s",strtotime($value->created_time));
			$name = $value->from->name;
			if (isset($value->link)) {
				$link = $value->link;
			}else{
				$link ="";
			}
			$image = $this->facebook->api("/".$post_id."?fields=attachments",'get');
			if (isset($image['attachments']['data'][0]['media']['image']['src'])) {
				$folder = date("Y-m-d",strtotime($created_time));
				$images = $image['attachments']['data'][0]['media']['image']['src'];
				echo "<img src='".$image['attachments']['data'][0]['media']['image']['src']."'><br>";
				if (!file_exists("images")) {
					mkdir("images");
					if(!file_exists("images/facebook")){ // check if not folder
						mkdir("images/facebook"); // create Folder
						if (!file_exists("images/facebook/".strtolower($name))) {
							mkdir("images/facebook/".strtolower($name));
							if (!file_exists("images/facebook/".strtolower($name))."/".$folder) {
								mkdir("images/facebook/".strtolower($name)."/".$folder);
							}
						}
					}
				}
				else{
					if(!file_exists("images/facebook")) // check if not folder
					{
						mkdir("images/facebook"); // create Folder
						if (!file_exists("images/facebook/".strtolower($name))) {
							mkdir("images/facebook/".strtolower($name));
							if (!file_exists("images/facebook/".strtolower($name))."/".$folder) {
								mkdir("images/facebook/".strtolower($name)."/".$folder);
							}
						}
					}
					else{
						if (!file_exists("images/facebook/".strtolower($name))) {
							mkdir("images/facebook/".strtolower($name));
							if (!file_exists("images/facebook/".strtolower($name))."/".$folder) {
								mkdir("images/facebook/".strtolower($name)."/".$folder);
							}
						}
						else{
							if (!file_exists("images/facebook/".strtolower($name))."/".$folder) {
								mkdir("images/facebook/".strtolower($name)."/".$folder);
							}
						}
					}
				}
				file_put_contents("images/facebook/".strtolower($name)."/".$folder."/aaaa.png", $images); // Save Image
				if (isset($value->message)) {
					$text = $value->message;
				}
				else{
					$text="";
				}
				$this->db->query("INSERT IGNORE INTO author(author_id,author_displayname,author_type)
								  VALUES(:author_id,:displayname,'facebook')",
								  array("author_id"=>$user_id,
								  	"displayname"=>$name
								  	));
				$this->db->query("INSERT IGNORE INTO post(author_id,post_social_id,post_text,post_created_time,post_link) 
								  VALUES (:author_id,:post_social_id,:post_text,:post_created_time,:post_link)",
								  array(
								  	"author_id"=>$user_id,
								  	"post_social_id"=>$post_id,
								  	"post_text"=>$text,
								  	"post_created_time"=>$created_time,
								  	"post_link"=>$link
								  	));
				}
			}
			if (isset($jsonPost->paging->next)) { // next pagination
				$url = $jsonPost->paging->next;
				$url = substr($url, 32); // cut direct link
				$this->getPost($url);
			}
		}
	}

?>