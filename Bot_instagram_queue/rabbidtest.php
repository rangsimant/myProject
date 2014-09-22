<?php 
	require_once('php-amqplib\amqp.inc');
	require_once('MySQL-PDO-Class\Db.class.php');
	date_default_timezone_set("Asia/Bangkok");
	$datenow = date('Y-m-d H:i:s');
	$db = new Db();
	$max_queue = 60;
	$connect = new AMQPConnection('27.254.81.9', 5672, 'guest', 'guest');
	$channel = $connect->channel();

	$channel->queue_declare('q_instagram', false, true, false, false);

	$queue_status = queue_status();
	if($queue_status->messages > $max_queue){
		$q = $queue_status->messages;
		echo "=== max reached ($q) ========\n";
	}else{
		$sql = "SELECT user_ig_id_user,user_ig_feed_date 
				FROM user_ig 
				order by user_ig_queue_date ASC 
				Limit 20 ";

		$json = $db->query($sql);
		foreach ($json as $key => $value) {
			$data = json_encode($value);
			$msg = new AMQPMessage($data,
	                        array('delivery_mode' => 2) # make message persistent
	                      );
			$channel->basic_publish($msg, '', 'q_instagram');
			$sqlUpdate = "UPDATE user_ig SET user_ig_queue_date=:queue_date
						WHERE user_ig_id_user =:id_user";

			$db->query($sqlUpdate,array("queue_date"=>$datenow,"id_user"=>$value['user_ig_id_user']));
			echo " [x] Sent ", $data, "\n";
		}
	}
	$channel->close();
	$connect->close();


	function queue_status($queue_name='q_instagram')
	{
		$host = "http://27.254.81.9:15672";
		$url = $host."/api/queues/";

		$context = stream_context_create(array(
					'http' => array(
					'header' => "Authorization: Basic " . base64_encode("guest:guest")
					)
					));

		$content = file_get_contents($url,false,$context);

		$queues = json_decode($content);
		foreach($queues as $q)
		{
		if($q->name == $queue_name) $queue = $q;
		}
		//var_dump($queue->messages);
		/*-- messages totals = $status->messages */
		return $queue;
	}

?>