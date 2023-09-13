<?php
if (isset($_GET["page"]) && $_GET["page"] == "login" && isset($_POST["type"]) && $_POST["type"] == "login") {
  include_once "views/login.php";
  die();
}

ob_start();

// <!-- Highlight scripts -->
include_once "includes/highlight.php";

if (isset($_GET["page"])) {
  switch ($_GET["page"]) {
    case "create":
      require "views/new-paste.php";
      break;
    case "mypastes":
      require "views/my-pastes.php";
      break;
    case "login":
      require "views/login.php";
      break;
    case "logout":
      echo '<center><h4>Please wait...</h4></center>';
      echo '<meta http-equiv="refresh" content="2;url=login.php?logout=1">';
      die();
    case "signup":
      require "views/signup.php";
      break;
    case "edit":
      require "views/edit.php";
      break;
    default:
      $uid = $_GET["page"];
      require "views/view-paste.php";
      break;
  }
} else if (isset($_GET["user"])) {
  include_once "views/user.php";
} else {
  include_once "views/new-paste.php";
}

$content = ob_get_clean();

require 'views/_layout.php';
