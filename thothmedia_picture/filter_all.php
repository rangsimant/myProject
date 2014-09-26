<?php 
require 'PHP-MySQL-PDO-Database-Class-master/Db.class.php';

$db = new Db();
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$checkData =0;

fillter_all_Image($db,$date1,$date2);


function fillter_all_Image($db,$date1,$date2){
	$sql ="	SELECT author.author_displayname,post.post_text,post.post_created_time,post.post_channel,post.post_img_name,post.post_link 
			FROM social_image.post 
			INNER JOIN social_image.author 
			ON author.author_id = post.author_id
			 WHERE post.post_created_time >='".$date1." 00:00:00' AND 
			 	   post.post_created_time <='".$date2." 23:59:59' 
			 	   ORDER BY post.post_created_time DESC";
	$select = $db->query($sql);

	foreach ($select as $key => $Post) {
		$displayname = $Post['author_displayname'];
		$text = $Post['post_text'];
		$created_time = $Post['post_created_time'];
		$img_name = $Post['post_img_name'];
		$link = $Post['post_link'];
		if ($Post['post_channel'] == 'facebook') {
			$channel = "<i class='fa fa-facebook-square'></i>";
		}
		else{
			$channel = "<i class='fa fa-instagram'></i>";
		}
		$html = "<div class='col-md-2'>
					<div class='thumnail'>
		
						<a href='".$link."' target='_blank'><img src='images/".$img_name."'></a>
						
					</div>
				</div>
				";
		echo $html;
		// <p class='top-image' align='center'>".date("d F Y",strtotime($created_time))."</p>
		// <p class='button-image' align='center'><span class='logo'>".$channel."</span> ".$displayname."</p>

	}
}
?>