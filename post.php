<?php
include "config/config.php";

function generate_uid () {
	global $conn;
	$name = '';
	// We start at N retries, and --N until we give up
	$tries = 500;
	do {
		// Iterate until we reach the maximum number of retries
		if ($tries-- == 0) throw new Exception('Gave up trying to find an unused name', 500);
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$name  = '';
		for ($i = 0; $i < 8; $i++) {
			$name .= $chars[mt_rand(0, 25)];
			// $chars string length is hardcoded, should use a variable to store it?
		}
		// Check if a paste with the same uid does already exist in the database
		$q = $conn->prepare('SELECT COUNT(uid) FROM pastes WHERE uid = (:name)');
		$q->bindValue(':name', $name, PDO::PARAM_STR);
		$q->execute();
		$result = $q->fetchColumn();
	// If it does, generate a new uid
	} while($result > 0);
	return $name;
}

if(isset($_POST["type"])){
	//===New_Paste===//
	if($_POST["type"]=="paste" && isset($_POST["text"])){
		/* Set paste details */
		$title = "Untitled";
		$text = $_POST["text"];
		if(isset($_POST["title"]))
			$title = $_POST["title"];
		$uid = generate_uid();
		/* Add paste to database */
		$stmt = $conn->prepare("INSERT INTO pastes (uid,title,text)
			VALUES (:uid, :tit, :txt)");
		$stmt->bindParam(':uid', $uid);
		$stmt->bindParam(':tit', $title);
		$stmt->bindParam(':txt', $text);
		$stmt->execute();
		$conn = null; //close connection to database
		header("Location: ".$uid);
		die();
	}
}
$conn = null;
?>