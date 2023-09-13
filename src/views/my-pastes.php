<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <?php
      include_once "includes/config.php";
      include_once "includes/user.php";
      $conn = GetConnectionToDB();
      if (GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]) == -1) {
        printf('<h2>You must be loged in to see your pastes!</h2>');
        $conn = null;
        echo '</div></div></div>';
        die();
      }
      $stmt = $conn->prepare('SELECT * FROM pastes WHERE owner=:own');
      $own = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
      $stmt->bindParam(':own', $own);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        echo "<table id=\"tablepastes\" class=\"table table-striped\" style=\"width:100%\">";
        printf('<thead><th data-dynatable-column="name" style="text-align: left;">Title</th>
			<th style="text-align: left;">Added</th>
			<th style="text-align: left;">Expires</th>
			<th style="text-align: left;">ID</th>
			<th style="text-align: left;">Actions</th></thead>');
        printf('<tbody>');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $title = $row['title'];
          //Paste title
          printf('<tr><td style="text-align: left;">' . htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8') . '</td>');
          //Creation date
          printf('<td style="text-align: left;">' . date('Y-m-d', $row["created"]) . '</td>');
          //Expire date
          if ($row["expire"] == 0) printf('<td style="text-align: left;">Never</td>');
          else {
            $expire = ($row["expire"] - time()) / 3600;
            if ($expire > 24) {
              printf('<td style="text-align: left;">' . round($expire / 24) . ' days from now</td>');
            } else if ($expire >= 1)
              printf('<td style="text-align: left;">' . round($expire) . ' hours from now</td>');
            else printf('<td style="text-align: left;">' . round($expire * 60) . ' minutes from now</td>');
          }
          //Paste url
          printf('<td style="text-align: right;"><a href="' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '</a></td>');
          //Actions
          printf('<td style="text-align: right;">');
          //delete paste
          printf('<a href="delete/' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '"><span class="glyphicon glyphicon-trash" title="Delete paste" aria-hidden="true"></span>');
          //edit paste
          printf('<a href="edit/' . htmlspecialchars($row["uid"], ENT_QUOTES, 'UTF-8') . '"><span class="glyphicon glyphicon-edit" title="Edit paste" aria-hidden="true"></span>');
          printf('</td></tr>');
        }
        printf('</tbody></talbe>');
      } else {
        printf('<h2>You havent made any pastes yet!</h2>');
      }
      $conn = null;
      ?>
    </div>
  </div>
</div>