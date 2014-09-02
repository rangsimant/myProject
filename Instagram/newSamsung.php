<?php
	ini_set('max_execution_time', 0); // limit seconds time for load
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    )); // New Class API Instagram
    echo "<pre>"; // format code
	$user='samsung';
	$dataUser = $instagram->searchUser($user); //(use Instagram Class) Array
	$date1 =(strtotime("2014-08-01 23:59:59"));
	$date2 =(strtotime('2014-08-04 23:59:59'));
	$imagArr = array();
	$num=1;
	$filecount =1;
	$idArr = array();
	$idArr = get_IDUser($dataUser,$idArr); // All ID,username,profile_pic (use Instagram Class)
	$countUser = count($idArr["Account"]); // count ID user (use Instagram Class)

	echo "count :".$countUser."<br>";
	for ($i=0; $i < 3; $i++) { 
		$userMedia = $instagram->getUserMedia($idArr["Account"][$i]["id"]); // (use Instagram Class)
		if (isset($userMedia->data)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i,$filecount,$imagArr);
		}
	}
	SaveAsFile($date1,$date2,$filecount,$imagArr,$idArr);
	function get_IDUser ($dataUser,$idArr){
		foreach ($dataUser->data as $key => $value) {
			$idArr["Account"][$key] = ["id"=>$value->id,"username"=>$value->username,"profile_picture"=>$value->profile_picture];
		}
		return $idArr;
	}
	function get_Media($instagram,$userMedia,$idArr,& $num,$i,$filecount,&$imagArr){
		foreach ($userMedia->data as $key => $value) {
			// find from Range date
				$imagArr[$filecount-1] = ["url"=>$value->images->standard_resolution->url,"id"=>$idArr["Account"][$i]["id"],"username"=>$idArr["Account"][$i]["username"]];
				$num++;
				$filecount++;
			// end
		}
		$userMedia = $instagram->pagination($userMedia); //(use Instagram Class)
		if (isset($userMedia->pagination->next_url)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i,$filecount,$imagArr); // loop next page
		}
		else{
			print_r("Stop This ID :".$idArr["Account"][$i]["id"]."<br>");
			$num=1;
		}
	}
	function SaveAsFile($date1,$date2,$filecount,$imagArr,$idArr){
		for ($i=0; $i < count($imagArr) ; $i++) { 
			if ($date1 == $date2) {
				$folder = date("d-m-Y",$date1);
			}
			else{
				$folder = date("d-m-Y",$date1)." - ".date("d-m-Y",$date2);
			}
			$content = file_get_contents($imagArr[$i]["url"]);
				if (!file_exists("images")) {
					mkdir("images");
					mkdir("images/".$folder,0777); // create Folder
					mkdir("images/".$folder."/".$imagArr[$i]["username"],0777);
				}
				else{
					if(!file_exists("images/".$folder)) // check if not folder
					{
						mkdir("images/".$folder,0777); // create Folder
						mkdir("images/".$folder."/".$imagArr[$i]["username"],0777);
					}
					else{
						mkdir("images/".$folder."/".$imagArr[$i]["username"],0777);
					}
				}
				file_put_contents("images/".$folder."/".$imagArr[$i]["username"]."/".$filecount.".jpeg", $content); // Save Image
				$filecount++;
		}
	}

?>