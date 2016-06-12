<?php
function GetUsersIDBySession($sid,$skey){
	include "config/config.php";
	//SELECT * FROM pastes WHERE uid=
	$stmt = $conn->prepare("SELECT uid FROM sessions WHERE id=:sid AND skey=:skey");
	$stmt->bindParam(':skey', $skey);
	$stmt->bindParam(':sid', $sid);
	$stmt->execute();
	if($result = $stmt->fetch()){
		$conn = null;
		return $result[0];
	} else {
		$conn = null;
		return -1;
	}
}
function LogOutUserBySession($sid,$skey){
	include "config/config.php";
	$stmt = $conn->prepare("DELETE FROM sessions WHERE id=:sid AND skey=:skey");
	$stmt->bindParam(':skey', $skey);
	$stmt->bindParam(':sid', $sid);
	$stmt->execute();
	$conn = null;
}
function UnsetBrowserCookies(){
	//These cookies expired an hour ago! What are you doind browser? :D
	setcookie("pp_sid", '', time() - 3600);
	setcookie("pp_skey", '', time() - 3600);
}
function GetUsernameByID(){
	//Placeholder
}
?>