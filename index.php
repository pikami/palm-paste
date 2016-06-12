<!DOCTYPE html>
<html lang="en">
<head>
  <title>Palm-Paste Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<!-- NavBar -->
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Palm-Paste</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	  <?php
	    include "includes/user.php";
		$userID = -1;
		if(isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]))
		  $userID = GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]);
	    if($userID == -1){
			echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
			echo "<li><a data-toggle=\"modal\" data-target=\"#LoginPopup\" href=\"#\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
		} else {
			echo "<li><a href=\"login.php?logout=1\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
		}
	  ?>
    </ul>
  </div>
</nav>
<!-- LoginPopup -->
<div id="LoginPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
	  <!-- Login form -->
        <form role="form" method="POST" action="login">
          <div class="form-group">
            <label for="user">Username:</label>
            <input type="user" class="form-control" id="user" name="user">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" name="pwd">
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
		  <input type='hidden' name='type' value='login'></input>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
	  <!-- END Login form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Content -->
<?php
if (isset($_GET["page"])){
  if($_GET["page"] == "create"){
    include "NewPaste.php";
  } else if($_GET["page"] == "login"){
    include "login.php";
  } else {
	  $uid = $_GET["page"];
	  include "ViewPaste.php";
  }
} else {
  include "NewPaste.php";
}
?>
</body>
</html>
