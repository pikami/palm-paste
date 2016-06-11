<?php
if (isset($_GET["key"])){
	if($_GET["key"]=="b1g51bf6g"){    //Kill sessions
		include "config/config.php";
		$time = time();
		$stmt = $conn->prepare("DELETE from `pastes` where `expire`<:time and `expire`>0");
		$stmt->bindValue(':time', $time);
		$stmt->execute();
		$conn = null; //close connection to database
		echo 'OK! 200';
	}
}
//Cron job example: */5 * * * * curl --silent http://127.0.0.1/paste/cronjob.php?key=b1g51bf6g > /dev/null
//More about cron jobs: http://www.shellhacks.com/en/Adding-Cron-Jobs-in-Linux-Crontab-Usage-and-Examples
?>