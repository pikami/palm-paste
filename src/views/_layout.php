<?php
include_once "includes/config.php";

if (!isset($content)) {
  $content = '<p>no content</p>';
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <title>Palm-Paste Index</title>
  <meta charset="utf-8">
  <?php
  echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

  echo '<link rel="stylesheet" href="' . $BASE_DIR . 'public/css/bootstrap.min.css">';
  echo '<link rel="stylesheet" href="' . $BASE_DIR . 'public/css/bootstrap-icons.css">';

  echo '<script src="' . $BASE_DIR . 'public/js/popper.min.js"></script>';
  echo '<script src="' . $BASE_DIR . 'public/js/bootstrap.min.js"></script>';
  ?>
</head>

<body>
  <!-- NavBar -->
  <?php include_once "views/_navbar.php" ?>
  <!-- Content -->
  <?php echo $content; ?>
</body>

</html>