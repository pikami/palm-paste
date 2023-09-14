<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      if (isset($_GET['id']) && isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])) {
        include_once "includes/user.php";
        $uid = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
        $paste = $_GET['id'];

        include_once "repositories/paste-repository.php";
        $pasteRepo = new PasteRepository();
        $result = $pasteRepo->deletePasteByUID($paste, $uid);
        if ($result === 'OK! 200') {
          echo '<center><h4>Paste ' . $paste . ' has been deleted!</h4></center>';
          echo '<meta http-equiv="refresh" content="2;url=../index.php">';
          die();
        } else {
          echo '<center><h4>' . $result . '</h4></center>';
          echo '<meta http-equiv="refresh" content="2;url=../index.php">';
          die();
        }
      }
      ?>
    </div>
  </div>
</div>