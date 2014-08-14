
<meta http-equiv="Content-Type" content="test/html;charset=UTF-8">
<?php 
ini_set('max_execution_time', 0);
$tonight = date("2014-07-01 00:00:00");
$today = date("Y-m-d H:i:s");
$unixTime = strtotime($today);
$token = "1646024095622253|25ad52f609d75e675d20704f44c3f7cf";
$url = "https://graph.facebook.com/ceclip/posts?until=".strtotime($today)."&access_token=".$token;
$data = json_decode(file_get_contents($url));
foreach ($data->data as $key =>$value) {
	if (isset($value->message)){ //Check Error undefined property stdclass
		echo "<font color='#000000'>";
		echo "<strong>ID : ".$value->id."</strong><br/>";
		echo "<strong>".$value->message."</strong><br/>";
		echo "<strong><font color='#b22222'>".$value->from->name."</font></strong><br/>";
		echo $newDate =  "โพสต์เมื่อวันที่ : ".date("d/m/Y H:i:s",strtotime($value->created_time))."<br/>";
		echo "</font>";
		$idpost = $value->id;
		$url2 = "https://graph.facebook.com/".$idpost."/comments?access_token=".$token;
		$dataComment = json_decode(file_get_contents($url2));
		echo "<a href=".$url2.">".$url2."</a><br/>";
		echo "Unix time : ".strtotime($value->created_time)."<br/>";
		echo "2014/07/01 time : ".strtotime($tonight)."<br/>";
		echo "today : ".$today."<br/>";
	/*	foreach ($dataComment->data as $key2 => $value2) {
			echo "<font color='#000000'>############### Comment ".intval($key2+1)." ##############</font><br/>"; //intval($key2+1) = $key+1 integer sum
			echo "<font color='#4169e1'>".$value2->message."</font><br/>";
			echo "<strong><font color='#b22222'>".$value2->from->name."</font></strong><br/>";
			echo $newDate =  "โพสต์เมื่อวันที่ : ".date("d/m/Y H:i:s",strtotime($value2->created_time))."<br/>";
			echo "<font color='#000000'>#######################################</font><br/><br/>";
		}*/
		echo "Key ".intval($key+1)."<br/>";
		echo "<font color='#ffa567'><strong>---------- sddfgfdg--------------------------------------------------------------------------------------------------------------------</strong></font><br/><br/>";
	}
}
?>