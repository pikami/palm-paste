<?php include_once "includes/config.php"; ?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $BASE_DIR ?>">Palm-Paste</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>

      <ul class="navbar-nav navbar-right mb-2 mb-lg-0">
        <?php
        include_once "includes/user.php";
        $userID = -1;
        if (isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])) {
          $userID = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
        }
        ?>

        <?php if ($userID == -1) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_DIR ?>signup">
              <i class="bi-person-fill"></i> Sign Up
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#LoginPopup" href="#">
              <i class="bi-box-arrow-in-right"></i> Login
            </a>
          </li>
        <?php else :
          $user = GetUserByID($userID);
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi-person-fill"></i>
              <?php echo htmlspecialchars($user[1], ENT_QUOTES, 'UTF-8') ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?php echo $BASE_DIR ?>mypastes">My pastes</a></li>
              <li><a class="dropdown-item" href="<?php echo $BASE_DIR ?>logout">Logout</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a id="color-switch" class="nav-link" href="#">
            <i class="bi-palette-fill"></i>
          </a>
        </li>

      </ul>
    </div>
  </div>

  <script>
    document.querySelector('#color-switch').onclick = () => {
      const themeAttribute = document.querySelector('html').attributes['data-bs-theme'];
      themeAttribute.value = themeAttribute.value === 'light' ? 'dark' : 'light';
    }
  </script>
</nav>

<!-- LoginPopup -->
<div class="modal fade" id="LoginPopup" tabindex="-1" aria-labelledby="LoginPopupLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="LoginPopupLabel">Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="POST" action="<?php echo $BASE_DIR ?>login">
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="user" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="user" name="user">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="pwd" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="pwd" name="pwd">
            </div>
          </div>
          <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember me</label>
          </div>
          <input type='hidden' name='type' value='login'></input>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>