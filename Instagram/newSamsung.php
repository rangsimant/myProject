<?php include('header.php');
	ini_set('max_execution_time', 0); // limit seconds time for load
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    )); // New Class API Instagram
    echo "<pre>";
	$user='samsung';
	$dataUser = $instagram->searchUser($user);
	$num=1;
	$idArr = array();
	$idArr = get_IDUser($dataUser,$idArr); // All ID user samsung
	$countUser = count(get_IDUser($dataUser,$idArr)); // count ID user
	echo "count :".$countUser."<br>";
	for ($i=0; $i < $countUser; $i++) { 
		$userMedia = $instagram->getUserMedia($idArr[$i]);
		if (isset($userMedia->data)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i);
		}
	}
	function get_IDUser ($dataUser,$idArr){
		foreach ($dataUser->data as $key => $value) {
			$idArr[$key] = $value->id;
		}
		return $idArr;
	}
	function get_Media($instagram,$userMedia,$idArr,& $num,$i){
		foreach ($userMedia->data as $key => $value) {
			echo "[".$num."]<br>".$idArr[$i]."<br>";
			echo $value->images->thumbnail->url."<br>";
			echo "<img src=".$value->images->thumbnail->url."><br>";
			$num++;
		}
		$userMedia = $instagram->pagination($userMedia);
		if (isset($userMedia->pagination->next_url)) {
			get_Media($instagram,$userMedia,$idArr,$num,$i); // loop next page
		}
		else{
			print_r("Stop This ID :".$idArr[$i]."<br>");
			$num=1;
		}
	}

?>