<?php
include_once "includes/config.php";

include_once "repositories/paste-repository.php";
$pasteRepo = new PasteRepository();

if (isset($_POST["type"]) && isset($_POST["text"])) {
	// Set paste details
	$title = isset($_POST["title"]) && !empty($_POST["title"]) ? $_POST["title"] : "Untitled";
	$text = $_POST["text"];
	$exposure = isset($_POST["exposure"]) && is_numeric($_POST["exposure"]) ? $_POST["exposure"] : 0;

	// Common details for both create and edit
	$uid = isset($_POST["uid"]) ? $_POST["uid"] : $pasteRepo->generateUniqueUID();
	$created = time();
	$expire = isset($_POST["expire"]) && is_numeric($_POST["expire"]) ? ($created + $_POST["expire"]) : 0;

	$owner = 0;
	$syntax = isset($_POST["syntax"]) ? $_POST["syntax"] : "plain";

	if (isset($_POST["asguest"]) && $_POST["asguest"] == "on") {
		$owner = 0;
	} elseif (isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])) {
		include "includes/user.php";
		$owner = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
	}

	if ($_POST["type"] == "paste") {
		// Add paste to the database using the repository
		$result = $pasteRepo->create($uid, $title, $text, $created, $expire, $exposure, $owner, $syntax);
	} elseif ($_POST["type"] == "edit_paste" && isset($_POST["uid"])) {
		// Get the owner of the paste from the database
		$existingPaste = $pasteRepo->readByUid($uid);

		// Edit paste in the database using the repository
		if ($owner === $existingPaste["owner"] && $owner !== 0) {
			$result = $pasteRepo->update($existingPaste["id"], $uid, $title, $text, $created, $expire, $exposure, $owner, $syntax);
		} else {
			echo "<h1>This paste does not belong to you!</h1>";
			die();
		}
	}

	if ($result) {
		header("Location: " . $uid);
		die();
	} else {
		echo "<h1>Error processing the paste!</h1>";
		die();
	}
}
