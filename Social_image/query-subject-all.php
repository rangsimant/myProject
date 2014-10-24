<?php 
require_once 'PHP-MySQL-PDO-Database-Class-master/Db.class.php';
require 'config.php';
$db = new Db();

$subject = $db->query("SELECT * FROM subject");
foreach ($subject as $key => $Subject) {
	$subject_name = $Subject['subject_name'];
	$html="<li role='presentation'><a role='menuitem' tabindex='-1' href='#' id='aa'>".ucfirst($subject_name)."</a></li>
	";
	echo $html;
}
?>
<head>
	<script type="text/javascript">
	$(function(){
    $('.dropdown-menu>li>a').click(function(){
    	var subject = $(this).text();
	    $('#drop-subject').html(subject+" <span class='caret'></span>");
	    ////// Ajax Load image is here
        if (sessionStorage.getItem("labeldate") != null) {
        var    dateStart = sessionStorage.getItem('dateStart');
        var    dateEnd  =sessionStorage.getItem('dateEnd');
        }else{
        var	dateStart = moment().format("YYYY-MM-D");
        var   dateEnd  =moment().format("YYYY-MM-D");
	    };
	    var setDate = {date1:dateStart,date2:dateEnd,loadsubject:subject};
	    $("#body-image").html("");
	        $.ajax({
	        	url:"all_image.php",
	          	type:"POST",
	         	dataType:"HTML",
	         	data:setDate,
	         	success:function(data){
	         		sessionStorage.setItem('subject',$('#drop-subject').text());
	         	   $("#body-image").hide().html(data).fadeIn('slow');
	         	 },
	        	error:function(jqXHR,data){
	        	  alert(data);
	          }
	        });
		});
    });
	</script>
</head>