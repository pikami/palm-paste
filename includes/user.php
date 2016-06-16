<?php
function GetUsersIDBySession($sid,$skey){
	include_once "config/config.php";
	$conn = GetConnectionToDB();
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
	include_once "config/config.php";
	$conn = GetConnectionToDB();
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
function GetUserByID($id){
	include_once "config/config.php";
	$conn = GetConnectionToDB();
	$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	if($result = $stmt->fetch()){
		$conn = null;
		return $result;
	} else {
		$conn = null;
		return array(-1,-1,-1,-1);
	}
}
?>