<?php
include_once "config/config.php";
function RemoveExpiredPastes(){
	$time = time();
	$stmt = $conn->prepare("DELETE from `pastes` where `expire`<:time and `expire`>0");
	$stmt->bindValue(':time', $time);
	$stmt->execute();
	$conn = null; //close connection to database
	echo 'OK! 200';
}
if (isset($_GET["key"])){
	if($_GET["key"]==$CRON_ExpireKey){    //Delete expired pastes
		RemoveExpiredPastes();
	}
}
//Cron job example: */5 * * * * curl --silent http://127.0.0.1/paste/cronjob.php?key=fgd45fb5fb15gb > /dev/null
//More about cron jobs: http://www.shellhacks.com/en/Adding-Cron-Jobs-in-Linux-Crontab-Usage-and-Examples
?>