<?php
//========SQL_CONFIG========//
$SQL_Host      = "localhost";
$SQL_Database  = "palm-paste";
$SQL_User      = "paste";
$SQL_Password  = "ckQgRJRhib74XMgVpzmn38uj1MrCcNnK7L9bc7zu";
//========CONNECTION========//
$conn = new PDO('mysql:host='.$SQL_Host.';dbname='.$SQL_Database.';charset=utf8mb4', $SQL_User, $SQL_Password);
/*
//==========INSERT==========//
$stmt = $dbh->prepare("INSERT INTO Customers (CustomerName,Address,City)
VALUES (:nam, :add, :cit)");
$stmt->bindParam(':nam', $txtNam);
$stmt->bindParam(':add', $txtAdd);
$stmt->bindParam(':cit', $txtCit);
$stmt->execute();
*/
?>