<meta http-equiv="Content-Type" content="test/html;charset=UTF-8">
<?php
ini_set('max_execution_time', 0);
$dateEnd = date("2014-08-9 00:00:00");
$dateStart = date("2014-08-13 00:00:00");
$x=0;
$url = "https://graph.facebook.com/ceclip/posts?&until=".strtotime($dateStart)."&access_token=1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
while (strtotime($dateStart) != strtotime($dateEnd)) {
	getPost($date,$x,$dateEnd,$dateStart,$url); // call use function getPost
}
function getPost(& $date,& $x,& $dateEnd,& $dateStart,& $url){
		$data = json_decode(file_get_contents($url));
		foreach ($data->data as $key => $value) {
			if (isset($value->message)) {
				$x = $x+1;
				echo "Key : [".$x."] ".date("d-m-Y H:i:s",strtotime($value->created_time))." ID Post : ".$value->id."<br/>";
				echo $value->message."<br/>";
			}
			if ($key == 24) {
				foreach ($data->paging as $key2 => $value2) {
					if ($key2=="next") {
						$url = $value2;
						$dateStart = date("d-m-Y 00:00:00",strtotime($value->created_time));
						return array($url, $dateStart);
					}
				}
			}
		}
}