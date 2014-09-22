<?php
	require_once('php-amqplib\amqp.inc');
	require_once('Sipder-Instagram-class.php');
	$igclass = new Spider_Instagram();
	$connection = new AMQPConnection('27.254.81.9', 5672, 'guest', 'guest');
	$channel = $connection->channel();

	$channel->queue_declare('q_instagram', false, true, false, false);

	echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
	$callback = function($msg){
	  		GetAllMedia($msg->body); // call GetAllMedia
	  		sleep(substr_count($msg->body, '.'));
	  		echo " [x] Done", "\n";
	 		$msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
	};

	$channel->basic_qos(null, 1, null);
	$channel->basic_consume('q_instagram', '', false, false, false, false, $callback);

	while(count($channel->callbacks)) {
	    $channel->wait();
	}

	$channel->close();
	$connection->close();

	function GetAllMedia($json){
		$igclass = new Spider_Instagram();
		$data = json_decode($json);
		$id_user = $data->user_ig_id_user;
		$feed_date = $data->user_ig_feed_date;
		$igclass->Get_Media($id_user,$feed_date); // call Function #Get_Media# Sipder-Instagram-class.php
	}
?>