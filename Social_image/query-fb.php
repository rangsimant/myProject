<?php
require_once 'PHP-MySQL-PDO-Database-Class-master/Db.class.php';
require 'config.php';
$page=$_GET['page'];
$db = new Db();
$address_Path = new config();
$date1 = $_GET['date1'];
$date2 = $_GET['date2'];
$subject = $_GET['loadsubject'];
$start = $page*18;
$sql ="	SELECT author.author_displayname,post.post_text,post.post_created_time,post.post_channel,post.post_img_name,post.post_link 
			FROM social_image.post 
			INNER JOIN social_image.author 
			ON author.author_id = post.author_id
			WHERE post.post_created_time >='".$date1." 00:00:00' AND 
			 	  post.post_created_time <='".$date2." 23:59:59' AND
			 	  post.post_channel = 'facebook' AND
			 	  post.post_subject = '".$subject."' AND
			 	  post.post_available = 'open'
			 	  ORDER BY post.post_created_time DESC LIMIT ".$start.",18";
$select = $db->query($sql);
if (!empty($select)) {
		foreach ($select as $key => $Post) {
			$displayname = $Post['author_displayname'];
			$text = $Post['post_text'];
			$created_time = $Post['post_created_time'];
			$img_name = $address_Path->address_Path."images/".$Post['post_img_name'];
			$save_image = $Post['post_img_name'];
			$link = $Post['post_link'];
			if (strlen($displayname) > 25) {
				$displayname = substr($displayname, 0,22)."...";
			}
			if ($Post['post_channel'] == 'facebook') {
				$channel = "<img src='icon/facebook.png' class='ig-logo'>";
			}
			else{
				$channel = "<img src='icon/instagram.png' class='ig-logo'>";
			}
			$html = "<div class='col-md-2' id='body-image'>
						<div class='thumbnail'>
								<p id='title' title='".$Post['author_displayname']."'>".$channel.$displayname."</p>
								<div class='view-first'>
								<a href='".$link."' target='_blank'><img src='".$img_name."'></a>
								<div class='img-footer text-left footer-bar'>".date("d F Y",strtotime($created_time))."<a class='download' href='".$img_name."' target='_blank'  download='".$Post['post_img_name']."'><i class='fa fa-cloud-download' title=Download></i></a></div>
								<div class='mask'><p>".substr($text, 0, 100) . '...'."</p></div>
							</div>
						</div>
					</div>
					";
			echo $html;
	}
}
?>