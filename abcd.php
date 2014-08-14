<meta http-equiv="Content-Type" content="test/html;charset=UTF-8">
<?php
ini_set('max_execution_time', 0);
$date = date("2014-03-01 00:00:00");
$url = "https://graph.facebook.com/ceclip/posts?until=".strtotime($date)."&since=".strtotime("2014-03-02 00:00:00")."&access_token=1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
$data = json_decode(file_get_contents($url));
$x=0;
for ($k=0; $k < 10; $k++) { 
	getPost($date,$x);
}
function getPost(& $date,& $x){
	$url = "https://graph.facebook.com/ceclip/posts?until=".strtotime($date)."&access_token=1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
	$data = json_decode(file_get_contents($url));
	foreach ($data->data as $key => $value) {
		if (isset($value->message)) {
			$x = $x+1;
			echo "Key : [".$x."] ".date("d-m-Y H:i:s",strtotime($value->created_time))."<br/>";
			echo $value->message."<br/>";
		}
		if ($key == 24) {
			return $date = $value->created_time;
			return $x;
		}
	}
}