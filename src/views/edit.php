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

        // Get paste info
        $pasteInfo = $pasteRepo->readByUid($paste);

        if ($pasteInfo) {
          if ($pasteInfo['owner'] === $uid) {
            include "views/_new-paste.php";
          } else {
            echo '<center><h4>You are not the owner of the paste ' . $pasteInfo["uid"] . '</h4></center>';
            echo '<meta http-equiv="refresh" content="2;url=../index.php">';
            die();
          }
        } else {
          echo '<center><h4>The paste ' . $paste . ' does not exist</h4></center>';
          echo '<meta http-equiv="refresh" content="2;url=../index.php">';
        }
      }
      ?>
    </div>
  </div>
</div>