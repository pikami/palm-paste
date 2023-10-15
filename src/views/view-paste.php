<div class="container mt-3">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      if (isset($uid)) {
        include_once "includes/config.php";
        include_once "includes/user.php";
        include_once "repositories/paste-repository.php";
        $pasteRepo = new PasteRepository();

        $paste = $pasteRepo->readByUid($uid);
        if ($paste) {
          if ($paste["expire"] != 0 && $paste["expire"] < time()) {
            // This paste is expired but not removed
            echo "<h1>This paste just expired</h1>";
            $result = $pasteRepo->removeExpiredPastes();
            if ($result === 'OK! 200') {
              echo 'Expired pastes have been removed';
            } else {
              echo 'Error removing expired pastes';
            }
            die();
          }

          if ($paste["exposure"] == 2 && $paste["owner"] != 0 && isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]) && $paste["owner"] != GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"])) {
            echo "<h1>This paste is private</h1>";
            die();
          }

          echo "<h1>" . htmlspecialchars($paste["title"], ENT_QUOTES, 'UTF-8') . "</h1>";

          $owner = GetUserByID($paste["owner"]);
          echo "<h5>";
          if ($owner[1] == -1)
            echo "Posted by: <b>Guest</b>";
          else
            echo "Posted by: <b><a href=\"u/" . htmlspecialchars($owner[1]) . "\">" . htmlspecialchars($owner[1]) . "</a></b>";
          echo ", at " . date('Y-m-d', $paste["created"]) . ", it will expire <b>";
          if ($paste["expire"] == 0) {
            printf('Never');
          } else {
            $expire = ($paste["expire"] - time()) / 3600;
            if ($expire > 24) {
              printf(round($expire / 24) . ' days from now');
            } elseif ($expire >= 1) {
              printf(round($expire) . ' hours from now');
            } else {
              printf(round($expire * 60) . ' minutes from now');
            }
          }
          echo "</b></h5>";

          echo "<pre class=\"brush: " . $_HL . "\">";
          echo htmlspecialchars($paste["text"], ENT_QUOTES, 'UTF-8') . "</pre><pb>";
          echo "<label for=\"rawtext\">Raw text:</label>";
          echo "<textarea id=\"rawtext\" class=\"form-control\" rows=\"10\">" . htmlspecialchars($paste["text"], ENT_QUOTES, 'UTF-8') . "</textarea>";
        } else {
          echo "Paste does not exist";
        }

        $conn = null;
      } else {
        echo "Error: id not set";
      }
      ?>
      <script type="text/javascript">
        SyntaxHighlighter.all()
      </script>
    </div>
  </div>
</div>