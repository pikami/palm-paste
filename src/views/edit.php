<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      if (isset($_GET['id']) && isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"])) {
        include_once "includes/user.php";
        $uid = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
        $paste = $_GET['id'];
        //connect to db and get paste info
        $conn = GetConnectionToDB();
        $stmt = $conn->prepare('SELECT * FROM pastes WHERE uid=:uid');
        $stmt->bindParam(':uid', $paste);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['owner'] === $uid) {
              include "views/_new-paste.php";
            } else {
              $conn = null;
              echo '<center><h4>You are not the owner of the paste ' . $row["uid"] . '</h4></center>';
              echo '<meta http-equiv="refresh" content="2;url=../index.php">';
              die();
            }
          }
        } else {
          $conn = null;
          echo '<center><h4>The paste ' . $row["uid"] . ' does not exist</h4></center>';
          echo '<meta http-equiv="refresh" content="2;url=../index.php">';
        }
        $conn = null;
      }
      ?>
    </div>
  </div>
</div>