<meta http-equiv="Content-Type" content="test/html;charset=UTF-8">
<?php
$dateStart = date("2014-08-04 00:00:00");
$dateEnd = date("2014-08-05 00:00:00");
ini_set('max_execution_time', 0);
$url = "https://graph.facebook.com/ceclip/posts?since=".strtotime($dateStart)."&until=".strtotime($dateEnd)."&access_token=1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
		$data = json_decode(file_get_contents($url));
		foreach ($data->paging as $key => $value) {
			echo $key."<br/>";
			if ($key=="next") {
				echo $value."<br/>";
			}
			
		}
?>