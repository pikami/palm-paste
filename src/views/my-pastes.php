<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      include_once "includes/config.php";
      include_once "includes/user.php";

      include_once "repositories/paste-repository.php";
      $pasteRepo = new PasteRepository();

      if (GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]) == -1) {
        echo '<h2>You must be logged in to see your pastes!</h2>';
        echo '</div></div></div>';
        die();
      }

      $own = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
      $pastes = $pasteRepo->getPastesByOwner($own, true);

      if (!empty($pastes)) {
        echo '<table id="tablepastes" class="table table-striped" style="width:100%">';
        echo '<thead><th data-dynatable-column="name" style="text-align: left;">Title</th>
          <th style="text-align: left;">Added</th>
          <th style="text-align: left;">Expires</th>
          <th style="text-align: left;">ID</th>
          <th style="text-align: left;">Actions</th></thead>';
        echo '<tbody>';

        foreach ($pastes as $row) {
          $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
          $created = date('Y-m-d', $row["created"]);

          if ($row["expire"] == 0) {
            $expire = 'Never';
          } else {
            $expireInSeconds = $row["expire"] - time();
            if ($expireInSeconds > 24 * 3600) {
              $expire = round($expireInSeconds / (24 * 3600)) . ' days from now';
            } elseif ($expireInSeconds >= 3600) {
              $expire = round($expireInSeconds / 3600) . ' hours from now';
            } else {
              $expire = round($expireInSeconds / 60) . ' minutes from now';
            }
          }

          echo '<tr>';
          echo '<td style="text-align: left;">' . $title . '</td>';
          echo '<td style="text-align: left;">' . $created . '</td>';
          echo '<td style="text-align: left;">' . $expire . '</td>';
          echo '<td style="text-align: right;"><a href="' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '</a></td>';
          echo '<td style="text-align: right;">';
          echo '<a href="delete/' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '"><span class="glyphicon glyphicon-trash" title="Delete paste" aria-hidden="true"></span></a>';
          echo '<a href="edit/' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '"><span class="glyphicon glyphicon-edit" title="Edit paste" aria-hidden="true"></span></a>';
          echo '</td></tr>';
        }

        echo '</tbody></table>';
      } else {
        echo '<h2>You haven\'t made any pastes yet!</h2>';
      }
      ?>
    </div>
  </div>
</div>