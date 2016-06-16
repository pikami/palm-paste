<?php
//========SQL_CONFIG========//
$SQL_Host       = "localhost";
$SQL_Database   = "palm-paste";
$SQL_User       = "paste";
$SQL_Password   = "ckQgRJRhib74XMgVpzmn38uj1MrCcNnK7L9bc7zu";
//========CRON_JOBS=========//
$CRON_ExpireKey = "b1g51bf6g";
//========CONNECTION========//
$conn = new PDO('mysql:host='.$SQL_Host.';dbname='.$SQL_Database.';charset=utf8mb4', $SQL_User, $SQL_Password);
?>
