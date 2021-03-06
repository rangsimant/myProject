<?php
require 'PHP-MySQL-PDO-Database-Class-master/Db.class.php';
require 'config.php';
 class Filter
 {
 	private $db;
 	private $date1;
 	private $date2;
 	private $checkData;
 	private $address_Path;
 	private $subject;
 	function __construct()
 	{
 		$this->db = new Db();
		$this->date1 = $_POST['date1'];
		$this->date2 = $_POST['date2'];
		$this->subject = $_POST['loadsubject'];
		$this->checkData =0;
		$this->address_Path = new config();
 	}

 	public function filter_all_Image(){
	$sql ="	SELECT author.author_displayname,post.post_text,post.post_created_time,post.post_channel,post.post_img_name,post.post_link 
			FROM social_image.post 
			INNER JOIN social_image.author 
			ON author.author_id = post.author_id
			WHERE post.post_created_time >='".$this->date1." 00:00:00' AND 
			 	  post.post_created_time <='".$this->date2." 23:59:59' AND
			 	  post.post_subject = '".$this->subject."' AND
			 	  post.post_available = 'open'
			 	  ORDER BY post.post_created_time DESC
			 	  LIMIT 0,36";
	$select = $this->db->query($sql);
	// print_r($select);exit();
	if (empty($select)) {
		echo  "No Data !";
	}
	else{
		foreach ($select as $key => $Post) {
			$displayname = $Post['author_displayname'];
			$text = $Post['post_text'];
			$created_time = $Post['post_created_time'];
			$img_name = $this->address_Path->address_Path."images/".$Post['post_img_name'];
			$save_image = $Post['post_img_name'];
			$link = $Post['post_link'];
			if (strlen($displayname) > 25) {
				$displayname = substr($displayname, 0,22)."...";
			}
			if (strlen($text) > 70) {
				$text = substr($text, 0, 70) . '...';
			}

			if ($Post['post_channel'] == 'facebook') {
				$channel = "<img src='icon/facebook.png' class='ig-logo'>";
			}
			else{
				$channel = "<img src='icon/instagram.png' class='ig-logo'>";
			}
			$html = "<div class='col-md-2'>
						<div class='thumbnail'>
								<p id='title' title='".$Post['author_displayname']."'>".$channel.$displayname."</p>
								<div class='view-first'>
								<a href='".$link."' target='_blank'><img src='".$img_name."'></a>
								<div class='img-footer text-left footer-bar'>".date("d F Y",strtotime($created_time))."<a class='download' href='".$img_name."' target='_blank'  download='".$Post['post_img_name']."'><i class='fa fa-cloud-download' title=Download></i></a></div>
								<div class='mask'><p>".$text."</p></div>
							</div>
						</div>
					</div>
					";
			echo $html;
		}
	}
}

	public function filter_Instagram(){
		$sql ="	SELECT author.author_displayname,post.post_text,post.post_created_time,post.post_channel,post.post_img_name,post.post_link 
				FROM social_image.post 
				INNER JOIN social_image.author 
				ON author.author_id = post.author_id
				WHERE post.post_created_time >='".$this->date1." 00:00:00' AND 
				 	  post.post_created_time <='".$this->date2." 23:59:59' AND
				 	  post.post_channel = 'instagram' AND
			 		  post.post_subject = '".$this->subject."' AND
			 		  post.post_available = 'open'
				 	  ORDER BY post.post_created_time DESC
				 	  LIMIT 0,36";
		$select = $this->db->query($sql);
		if (empty($select)) {
			echo  "No Data !";
		}
		else{
			foreach ($select as $key => $Post) {
				$displayname = $Post['author_displayname'];
				$text = $Post['post_text'];
				$created_time = $Post['post_created_time'];
				$img_name = $this->address_Path->address_Path."images/".$Post['post_img_name'];
				$link = $Post['post_link'];
				if (strlen($displayname) > 25) {
					$displayname = substr($displayname, 0,22)."...";
				}
				if (strlen($text) > 70) {
					$text = substr($text, 0, 70) . '...';
				}
				if ($Post['post_channel'] == 'facebook') {
					$channel = "<img src='icon/facebook.png' class='ig-logo'>";
				}
				else{
					$channel = "<img src='icon/instagram.png' class='ig-logo'>";
				}
			$html = "<div class='col-md-2'>
						<div class='thumbnail'>
								<p id='title' title='".$Post['author_displayname']."'>".$channel.$displayname."</p>
								<div class='view-first'>
								<a href='".$link."' target='_blank'><img src='".$img_name."'></a>
								<div class='img-footer text-left footer-bar'>".date("d F Y",strtotime($created_time))."<a class='download' href='".$img_name."' target='_blank'  download='".$Post['post_img_name']."'><i class='fa fa-cloud-download' title=Download></i></a></div>
								<div class='mask'><p>".$text."</p></div>
							</div>
						</div>
					</div>
					";
				echo $html;
			}
		}
	}

	public function filter_Facebook(){
		$sql ="	SELECT author.author_displayname,post.post_text,post.post_created_time,post.post_channel,post.post_img_name,post.post_link 
				FROM social_image.post 
				INNER JOIN social_image.author 
				ON author.author_id = post.author_id
				WHERE post.post_created_time >='".$this->date1." 00:00:00' AND 
				 	  post.post_created_time <='".$this->date2." 23:59:59' AND
				 	  post.post_channel = 'facebook' AND
				 	  post.post_subject = '".$this->subject."' AND
				 	  post.post_available = 'open'
				 	  ORDER BY post.post_created_time DESC
				 	  LIMIT 0,36";
		$select = $this->db->query($sql);
		if (empty($select)) {
			echo  "No Data !";
		}
		else{
			foreach ($select as $key => $Post) {
				$displayname = $Post['author_displayname'];
				$text = $Post['post_text'];
				$created_time = $Post['post_created_time'];
				$img_name = $this->address_Path->address_Path."images/".$Post['post_img_name'];
				$link = $Post['post_link'];
				if (strlen($displayname) > 25) {
					$displayname = substr($displayname, 0,22)."...";
				}
				if (strlen($text) > 70) {
					$text = substr($text, 0, 70) . '...';
				}
				if ($Post['post_channel'] == 'facebook') {
					$channel = "<img src='icon/facebook.png' class='ig-logo'>";
				}
				else{
					$channel = "<img src='icon/instagram.png' class='ig-logo'>";
				}
			$html = "<div class='col-md-2'>
						<div class='thumbnail'>
								<p id='title' title='".$Post['author_displayname']."'>".$channel.$displayname."</p>
								<div class='view-first'>
								<a href='".$link."' target='_blank'><img src='".$img_name."'></a>
								<div class='img-footer text-left footer-bar'>".date("d F Y",strtotime($created_time))."<a class='download' href='".$img_name."' target='_blank'  download='".$Post['post_img_name']."'><i class='fa fa-cloud-download' title=Download></i></a></div>
								<div class='mask'><p>".$text."</p></div>
							</div>
						</div>
					</div>
					";
				echo $html;
			}
		}
	}
 } 
?>