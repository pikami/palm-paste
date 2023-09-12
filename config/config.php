<?php
function GetConnectionToDB(){
	//========SQL_CONFIG========//
	$SQL_Host       = getenv('SQL_HOST') ?: "localhost";
	$SQL_Database   = getenv('SQL_DB') ?: "palm-paste";
	$SQL_User       = getenv('SQL_USER') ?: "paste";
	$SQL_Password   = getenv('SQL_PASS') ?: "ckQgRJRhib74XMgVpzmn38uj1MrCcNnK7L9bc7zu";
	//========CONNECTION========//
	$conn = new PDO('mysql:host='.$SQL_Host.';dbname='.$SQL_Database.';charset=utf8mb4', $SQL_User, $SQL_Password);
	return $conn;
}
//========CRON_JOBS=========//
$CRON_ExpireKey = getenv('CRON_EXPIREKEY') ?: "b1g51bf6g";
?>
