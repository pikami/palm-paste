<?php
include_once "includes/config.php";

$_HL = "plain";
if (isset($_GET["page"])) {
  if ($_GET["page"] == "create" || $_GET["page"] == "mypastes" || $_GET["page"] == "login" || $_GET["page"] == "logout" || $_GET["page"] == "signup");
  else {

    $uid = $_GET["page"];
    echo '<script type="text/javascript" src="' . $BASE_DIR . 'public/js/SyntaxHighlighter/shCore.js"></script>';

    include_once "repositories/paste-repository.php";
    $pasteRepo = new PasteRepository();
    $_HL = $pasteRepo->getSyntaxHighlightByUID($uid);

    if ($_HL === "") {
      $_HL = "plain";
    }

    $highlightToBrushFileMap = [
      "python" => 'shBrushPython.js',
      "applescript" => 'shBrushAppleScript.js',
      "as3" => 'shBrushAS3.js',
      "bash" => 'shBrushBash.js',
      "cf" => 'shBrushColdFusion.js',
      "csharp" => 'shBrushCSharp.js',
      "css" => 'shBrushCss.js',
      "delphi" => 'shBrushDelphi.js',
      "diff" => 'shBrushDiff.js',
      "erlang" => 'shBrushErlang.js',
      "groovy" => 'shBrushGroovy.js',
      "java" => 'shBrushJava.js',
      "javafx" => 'shBrushJavaFX.js',
      "jscript" => 'shBrushJScript.js',
      "perl" => 'shBrushPerl.js',
      "php" => 'shBrushPhp.js',
      "powershell" => 'shBrushPowerShell.js',
      "ruby" => 'shBrushRuby.js',
      "sass" => 'shBrushSass.js',
      "scala" => 'shBrushScala.js',
      "sql" => 'shBrushSql.js',
      "vb" => 'shBrushVb.js',
      "xml" => 'shBrushXml.js',
    ];

    $brushFile = $highlightToBrushFileMap[$_HL] ?? 'shBrushPlain.js';
    echo '<script type="text/javascript" src="public/js/SyntaxHighlighter/' . $brushFile . '"></script>';
    echo '<link href="' . $BASE_DIR . 'public/css/SyntaxHighlighter/shCore.css" rel="stylesheet" type="text/css">
    <link href="' . $BASE_DIR . 'public/css/SyntaxHighlighter/shThemeDefault.css" rel="stylesheet" type="text/css" />';
  }
}
