<?php
include "config/config.php";
if(isset($_POST["type"])){
	//===New_Paste===//
	if($_POST["type"]=="paste" && isset($_POST["text"])){
		/* Set paste details */
		$title = "Untitled";
		$text = $_POST["text"];
		if(isset($_POST["title"]))
			$title = $_POST["title"];
		/* Add paste to database */
		$stmt = $conn->prepare("INSERT INTO pastes (title,text)
			VALUES (:tit, :txt)");
		$stmt->bindParam(':tit', $title);
		$stmt->bindParam(':txt', $text);
		$stmt->execute();
		$id = $conn->lastInsertId();
		$conn = null; //close connection to database
		header("Location: ".$id);
		die();
	}
}
$conn = null;
?>