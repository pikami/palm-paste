<?php
include_once "includes/config.php";

if (!isset($content)) {
  $content = '<p>no content</p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Palm-Paste Index</title>
  <meta charset="utf-8">
  <?php
  echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

  echo '<link rel="stylesheet" href="' . $BASE_DIR . 'public/css/bootstrap.min.css">';
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>';

  echo '<script src="' . $BASE_DIR . 'public/js/bootstrap.min.js"></script>';
  echo '<script type="text/javascript" src="' . $BASE_DIR . 'public/js/jquery.dynatable.js"></script>';
  echo '<link href="' . $BASE_DIR . 'public/css/jquery.dynatable.css" rel="stylesheet">';

  echo '<link href="' . $BASE_DIR . 'public/css/chosen.css" rel="stylesheet">';
  echo '<script src="' . $BASE_DIR . 'public/js/chosen.jquery.js" type="text/javascript"></script>';
  echo '<script src="' . $BASE_DIR . 'public/js/chosen.proto.js" type="text/javascript"></script>';

  echo "<script>$(document).ready(function(){
    $('#tablepastes').dynatable();
    $('.chosen-select').chosen();
    });</script>";

  ?>
</head>

<body>
  <!-- NavBar -->
  <?php include_once "views/_navbar.php" ?>
  <!-- Content -->
  <?php echo $content; ?>
</body>

</html>