<?php
  $_HL = "plain";
  if (isset($_GET["page"])){
    if($_GET["page"] == "create" || $_GET["page"] == "mypastes" || $_GET["page"] == "login" || $_GET["page"] == "logout" || $_GET["page"] == "signup");
	else {
	  $uid = $_GET["page"];
	  echo '<script type="text/javascript" src="js/SyntaxHighlighter/shCore.js"></script>';
	  //
	  include "config/config.php";
	  $stmt = $conn->query('SELECT highlight FROM pastes WHERE uid="'.$uid.'"');
	  if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$conn = null;
		$_HL = $result["highlight"];
		if($_HL == "")$_HL = "plain";
		if($result["highlight"]=="cpp")echo '<script type="text/javascript" src="js/SyntaxHighlighter/shBrushCpp.js"></script>';
		else if($result["highlight"]=="python")echo '<script type="text/javascript" src="js/SyntaxHighlighter/shBrushPython.js"></script>';
		else echo '<script type="text/javascript" src="js/SyntaxHighlighter/shBrushPlain.js"></script>';
	  }
	  $conn = null;
	  //
	  echo '<link href="css/SyntaxHighlighter/shCore.css" rel="stylesheet" type="text/css">
			<link href="css/SyntaxHighlighter/shThemeDefault.css" rel="stylesheet" type="text/css" />';
    }
  }
?>