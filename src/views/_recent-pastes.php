<div class="panel panel-default">
  <div class="panel-body">
    <h4>Newest pastes:</h4>
    <div class="list-group">
      <?php
      include_once "includes/config.php";
      $conn = GetConnectionToDB();
      $stmt = $conn->query('SELECT * FROM pastes WHERE exposure=0 ORDER BY id DESC LIMIT 5');
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
        if (strlen($title) > 25) $title = substr($title, 0, 25) . "...";
        echo "<a href=\"" . htmlspecialchars($row['uid'], ENT_QUOTES, 'UTF-8') . "\" class=\"list-group-item\">" . $title . "</a>";
      }
      $conn = null;
      ?>
    </div>
  </div>
</div>