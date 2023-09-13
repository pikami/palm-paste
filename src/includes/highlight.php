<?php
  $_HL = "plain";
  if (isset($_GET["page"])){
    if($_GET["page"] == "create" || $_GET["page"] == "mypastes" || $_GET["page"] == "login" || $_GET["page"] == "logout" || $_GET["page"] == "signup");
	else {
	  $uid = $_GET["page"];
	  echo '<script type="text/javascript" src="public/js/SyntaxHighlighter/shCore.js"></script>';
	  //
	  include_once "includes/config.php";
	  $conn = GetConnectionToDB();
	  $stmt = $conn->query('SELECT highlight FROM pastes WHERE uid="'.$uid.'"');
	  if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$conn = null;
		$_HL = $result["highlight"];
		if($_HL == "")$_HL = "plain";
		echo '<script type="text/javascript" src="public/js/SyntaxHighlighter/';
		if($result["highlight"]=="cpp")echo 'shBrushCpp.js';
		else if($result["highlight"]=="python")echo 'shBrushPython.js';
		else if($result["highlight"]=="applescript")echo 'shBrushAppleScript.js';
		else if($result["highlight"]=="as3")echo 'shBrushAS3.js';
		else if($result["highlight"]=="bash")echo 'shBrushBash.js';
		else if($result["highlight"]=="cf")echo 'shBrushColdFusion.js';
		else if($result["highlight"]=="csharp")echo 'shBrushCSharp.js';
		else if($result["highlight"]=="css")echo 'shBrushCss.js';
		else if($result["highlight"]=="delphi")echo 'shBrushDelphi.js';
		else if($result["highlight"]=="diff")echo 'shBrushDiff.js';
		else if($result["highlight"]=="erlang")echo 'shBrushErlang.js';
		else if($result["highlight"]=="groovy")echo 'shBrushGroovy.js';
		else if($result["highlight"]=="java")echo 'shBrushJava.js';
		else if($result["highlight"]=="javafx")echo 'shBrushJavaFX.js';
		else if($result["highlight"]=="jscript")echo 'shBrushJScript.js';
		else if($result["highlight"]=="perl")echo 'shBrushPerl.js';
		else if($result["highlight"]=="php")echo 'shBrushPhp.js';
		else if($result["highlight"]=="powershell")echo 'shBrushPowerShell.js';
		else if($result["highlight"]=="ruby")echo 'shBrushRuby.js';
		else if($result["highlight"]=="sass")echo 'shBrushSass.js';
		else if($result["highlight"]=="scala")echo 'shBrushScala.js';
		else if($result["highlight"]=="sql")echo 'shBrushSql.js';
		else if($result["highlight"]=="vb")echo 'shBrushVb.js';
		else if($result["highlight"]=="xml")echo 'shBrushXml.js';
		else echo 'shBrushPlain.js';
		echo '"></script>';
	  }
	  $conn = null;
	  //
	  echo '<link href="public/css/SyntaxHighlighter/shCore.css" rel="stylesheet" type="text/css">
			<link href="public/css/SyntaxHighlighter/shThemeDefault.css" rel="stylesheet" type="text/css" />';
    }
  }
