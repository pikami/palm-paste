<?php
function generate_skey(){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $key  = '';
        for ($i = 0; $i < 32; $i++) {
            $key .= $chars[mt_rand(0, 61)];
        }
        return $key;
}
if(isset($_GET["logout"])){
	include "includes/user.php";
	if(isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])){
		LogOutUserBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]);
		UnsetBrowserCookies();
	}
	header("Location: index.php");
}
if(isset($_POST["type"])){
	if($_POST["type"]=="login" && isset($_POST["user"]) && isset($_POST["pwd"])){
		//Get options
		$user = $_POST["user"];
		$pwd = $_POST["pwd"];
		$remember = 0;
		if(isset($_POST["remember"]) && $_POST["remember"]=="on")
			$remember = 1;
		//Try to login
		include "config/config.php";
		$stmt = $conn->prepare('SELECT * FROM users WHERE user=?');
		$stmt->execute(array($user));
		if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			if (password_verify($pwd, $result["password"])){ //$hash = password_hash($pwd ,CRYPT_BLOWFISH);
				$skey = generate_skey();
				$stmt = $conn->prepare("INSERT INTO sessions (skey, uid)
					VALUES (:skey, :uid)");
				$stmt->bindParam(':skey', $skey);
				$stmt->bindParam(':uid', $result["id"]);
				$stmt->execute();
				$sid = $conn->lastInsertId();
				$conn = null;
				if($remember == 1){
					setcookie("pp_sid", $sid, time()+63072000); //Dies in 2 years
					setcookie("pp_skey", $skey, time()+63072000); //Dies in 2 years
				} else {
					setcookie("pp_sid", $sid); //Dies when browser closes
					setcookie("pp_skey", $skey); //Dies when browser closes
				}
				header("Location: index.php");
				die();
			}
			else echo "No!";		//TODO: Wrong password
		} else echo "Fail!";		//TODO: No user or SQL fail.
		$conn = null;
	}
}
?>