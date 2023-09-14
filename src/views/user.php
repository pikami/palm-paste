<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      include_once "includes/config.php";
      include_once "includes/user.php";

      include_once "repositories/paste-repository.php";
      $pasteRepo = new PasteRepository();

      $ownerName = $_GET["user"];
      $ownerID = GetUserIDByName($ownerName);

      if ($ownerID != -1) {
        $owner = GetUserByID($ownerID);
        printf('<h2>' . $owner["user"] . '\'s profile</h2>');

        $pastes = $pasteRepo->getPastesByOwner($ownerID, isset($_COOKIE["pp_sid"]) ? true : false);

        if (!empty($pastes)) {
          echo "<table id=\"tablepastes\" class=\"table table-striped\" style=\"width:100%\">";
          printf('<thead><th data-dynatable-column="name" style="text-align: left;">Title</th>
            <th style="text-align: left;">Added</th>
            <th style="text-align: left;">Expires</th>
            <th style="text-align: left;">ID</th></thead>');
          printf('<tbody>');

          foreach ($pastes as $paste) {
            $title = $paste['title'];
            printf('<tr><td style="text-align: left;">' . htmlspecialchars($paste["title"], ENT_QUOTES, 'UTF-8') . '</td>');
            printf('<td style="text-align: left;">' . date('Y-m-d', $paste["created"]) . '</td>');

            if ($paste["expire"] == 0) {
              printf('<td style="text-align: left;">Never</td>');
            } else {
              $expire = ($paste["expire"] - time()) / 3600;

              if ($expire > 24) {
                printf('<td style="text-align: left;">' . round($expire / 24) . ' days from now</td>');
              } else if ($expire >= 1) {
                printf('<td style="text-align: left;">' . round($expire) . ' hours from now</td>');
              } else {
                printf('<td style="text-align: left;">' . round($expire * 60) . ' minutes from now</td>');
              }
            }

            printf('<td style="text-align: right;"><a href="../' . htmlspecialchars($paste["uid"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($paste["uid"], ENT_QUOTES, 'UTF-8') . '</a></td></tr>');
          }

          printf('</tbody></table>');
        } else {
          printf('<h2>This user has no public pastes!</h2>');
        }
      } else {
        printf('<h2>User does not exist!</h2>');
      }

      ?>
    </div>
  </div>
</div>