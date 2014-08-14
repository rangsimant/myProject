<meta http-equiv="Content-Type" content="test/html;charset=UTF-8">
<?php
ini_set('max_execution_time', 0);
$token = "1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
$url = "https://graph.facebook.com/ceclip/posts?&access_token=".$token;
$data = json_decode(file_get_contents($url));
foreach ($data->paging as $key =>$value) {
	echo $value."<br/>";
	}
