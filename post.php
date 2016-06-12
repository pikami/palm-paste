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
			$name .= $chars[mt_rand(0, 61)];
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
		$exposure = 0;
		if(isset($_POST["title"]))
			$title = $_POST["title"];
		if(isset($_POST["exposure"]) && is_numeric($_POST["exposure"]))
			$$exposure = $_POST["exposure"];
		$uid = generate_uid();
		$created = time();
		$expire = 0;
		if(isset($_POST["expire"]) && is_numeric($_POST["expire"]))
			$expire = $created + $_POST["expire"];
		$owner = 0;
		if(isset($_POST["asguest"]) && $_POST["asguest"]=="on")
			$owner = 0;
		else if(isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])){
			include "includes/user.php";
			$owner = GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]);
		}
		/* Add paste to database */
		$QuerySTR = "INSERT INTO pastes (uid,title,text,created,expire,exposure,owner)
			VALUES (:uid, :tit, :txt, :cre, :exp, :exposure, :own)";
		$stmt = $conn->prepare($QuerySTR);
		$stmt->bindParam(':exp', $expire);
		$stmt->bindParam(':uid', $uid);
		$stmt->bindParam(':tit', $title);
		$stmt->bindParam(':txt', $text);
		$stmt->bindParam(':cre', $created);
		$stmt->bindParam(':exposure', $exposure);
		$stmt->bindParam(':own', $owner);
		$stmt->execute();
		$conn = null; //close connection to database
		header("Location: ".$uid);
		die();
	}
}
$conn = null;
?>