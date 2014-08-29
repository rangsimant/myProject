<?php 
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    ));
    $num=1;
    $lastPage=false;
   	$tag = $instagram->getTagMedia("bangkok_university");
   	// echo"<pre>";
   //	 print_r($tag->data);
    function get_media(& $tag,& $num,& $instagram,&$lastPage){
		    foreach ($tag->data as $key => $value) {
			    echo $num.". ".$value->images->standard_resolution->url."<br/>";
			    echo $value->link."<br/>";

				$num++;
		    }
		   // if ($key == 19) {
			    		 $tag = $instagram->pagination($tag);
			    		 if (isset($tag->pagination->next_url)) {
			    		 	echo "BBBBBB";
			    		 	//return $tag;
			    		 }
			    		 else{
			    		 	echo "AAAAAA";
			    		 	$lastPage = true;
			    		 	//return;
			    		 }

			    	//}
			    	//return $num;
	}
	while ($lastPage != true) {
		get_media($tag,$num,$instagram,$lastPage);
	}
?>