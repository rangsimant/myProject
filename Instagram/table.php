<meta http-equiv="Content-Type" content="test/html;charset=UTF-8" />
<?php
    ini_set('max_execution_time', $_POST['limit']);
    include('header.php');
	require_once 'API-master/instagram.class.php';
	$instagram = new Instagram(array(
      'apiKey'      => 'ab8e71229279462bb7d276d055b7e8b3',
      'apiSecret'   => '1d19abf1a59e4efdbf58735833303996',
      'apiCallback' => 'http://instagram.com/'
    ));
    $num=1;
    $lastPage=false;
    $tag = $instagram->getTagMedia($_POST['hashtag']);
    $dateStart = date('2014-08-30 00:00:00');
    $dateTo = date('2014-08-30 00:00:00');
    // echo "<pre>";
    // print_r($tag);
echo '<table class="table table-hover ">
		<thead>
	          <tr>
	            <th>#</th>
	            <th>Image</th>
	            <th>Link</th>
	          </tr>
	        </thead>
	        	<tbody>';
	        function get_media(& $tag,& $num,& $instagram,&$lastPage,&$dateStart,&$dateTo){
				foreach ($tag->data as $key => $value) {
					if (($value->created_time >= strtotime($dateStart)) && ($value->created_time <= strtotime($dateTo)) ) {
						echo '<tr>
					            <td>'.$num.'</td>
					            <td><img src='.$value->images->thumbnail->url.'></td>
					            <td><a href="'.$value->link.'" target="_blank">CLICK</a></td>
					          </tr>';
				        $num++;
				    }
				}
				$tag = $instagram->pagination($tag);
	    		 if (isset($tag->pagination->next_url)) {
	    		 	get_media($tag,$num,$instagram,$lastPage,$dateStart,$dateTo);
	    		 }
	    		 else{
	    		 	$lastPage = true;
	    		 }
			}
	get_media($tag,$num,$instagram,$lastPage,$dateStart,$dateTo);
echo "</tbody>
	</table>";
?>