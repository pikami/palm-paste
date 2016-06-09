<?php
include "config/config.php";
if(isset($_POST["type"])){
	echo "TYPE!";
	//===New_Paste===//
	if($_POST["type"]=="paste" && isset($_POST["text"])){
		echo "TEXT!";
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
		$conn = null; //close connection to database
	}
}
echo "FIN!";
$conn = null;
?>