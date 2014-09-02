<?php include('header.php');
	ini_set('max_execution_time', 0); // limit seconds time for load
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    )); // New Class API Instagram
    echo "<pre>"; // format code
	$user='samsung';
	$dataUser = $instagram->searchUser($user); //(use Instagram Class)
	$num=1;
	$filecount =1;
	$idArr = array();
	$idArr = get_IDUser($dataUser,$idArr); // All ID user samsung (use Instagram Class)
	$countUser = count($idArr); // count ID user (use Instagram Class)

	echo "count :".$countUser."<br>";
	for ($i=0; $i < $countUser; $i++) { 
		$userMedia = $instagram->getUserMedia($idArr[$i]); // (use Instagram Class)
		if (isset($userMedia->data)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i,$filecount);
		}
	}
	function get_IDUser ($dataUser,$idArr){
		foreach ($dataUser->data as $key => $value) {
			$idArr[$key] = $value->id;
		}
		return $idArr;
	}
	function get_Media($instagram,$userMedia,$idArr,& $num,$i,$filecount){
		$folder = "Samsung_Images";
		foreach ($userMedia->data as $key => $value) {
			echo "[".$num."]<br>".$idArr[$i]."<br>";
			echo $value->images->thumbnail->url."<br>";
			$content = file_get_contents($value->images->thumbnail->url);
			if(!file_exists($folder)) // check if not folder
			{
				mkdir($folder,0777); // create Folder
			}
			file_put_contents("Samsung_Images/".$idArr[$i]."_".$filecount.".jpeg", $content); // Save Image
			//echo "<img src=".$value->images->thumbnail->url."><br>";
			$num++;
			$filecount++;
		}
		$userMedia = $instagram->pagination($userMedia); //(use Instagram Class)
		if (isset($userMedia->pagination->next_url)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i,$filecount); // loop next page
		}
		else{
			print_r("Stop This ID :".$idArr[$i]."<br>");
			$num=1;
		}
	}

?>