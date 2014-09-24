<?php
require 'Facebook-API\src\facebook.php';
/**
* 
*/
class GetFacebook
{
	private $facebook;
	private $user;
	private $post_ID;
	private $page_ID;
	function __construct()
	{
		$this->facebook = new Facebook(array(
  		'appId'  => "1646024095622253",
  		'secret' => "25ad52f609d75e675d20704f44c3f7cf",
		));
	}

	public function test(){
		$Page_post = $this->facebook->api('/samsungthailand/posts','get');
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
		//print_r($this->post_ID);
	}
}

?>