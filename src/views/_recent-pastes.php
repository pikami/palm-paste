<h4>Newest pastes:</h4>
<div class="list-group">
  <?php
  include_once "repositories/paste-repository.php";
  $pasteRepo = new PasteRepository();
  $pastes = $pasteRepo->getPastesWithExposure(0, 5);

  foreach ($pastes as $paste) {
    $title = htmlspecialchars($paste['title'], ENT_QUOTES, 'UTF-8');
    if (strlen($title) > 25) $title = substr($title, 0, 25) . "...";
    echo "<a href=\"" . htmlspecialchars($paste['uid'], ENT_QUOTES, 'UTF-8') . "\" class=\"list-group-item\">" . $title . "</a>";
  }
  ?>
</div>