<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <?php
      $dir = "";
      if (isset($_GET["user"]) || isset($_GET["page"]) && $_GET["page"] == "edit") $dir = "../";
      echo '<a class="navbar-brand" href="' . $dir . '.">Palm-Paste</a>';
      ?>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
      include_once "includes/user.php";
      $dir = "";
      if (isset($_GET["user"]) || isset($_GET["page"]) && $_GET["page"] == "edit") $dir = "../";
      $userID = -1;
      if (isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]))
        $userID = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
      if ($userID == -1) {
        echo "<li><a href=\"" . $dir . "signup\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
        echo "<li><a data-toggle=\"modal\" data-target=\"#LoginPopup\" href=\"#\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
      } else {
        $user = GetUserByID($userID);
        echo '
			<li class="dropdown">
				<a class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" href="#"> ' . htmlspecialchars($user[1], ENT_QUOTES, 'UTF-8') . '<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="' . $dir . 'mypastes">My pastes</a></li>
					<li><a href="' . $dir . 'logout">Logout</a></li>
				</ul>
			</li>
			';
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
        <?php
        echo '<form role="form" method="POST" action="' . $dir . 'login">';
        ?>
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