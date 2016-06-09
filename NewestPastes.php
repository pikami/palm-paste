<div class="panel panel-default">
  <div class="panel-body">
    <h4>Newest pastes:</h4>
      <div class="list-group">
	    <?php
		  include "config/config.php";
		  $stmt = $conn->query('SELECT * FROM pastes ORDER BY id DESC LIMIT 5');
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$title = $row['title'];
			if(strlen($title)>25)$title = substr($title,0,25)."...";
			echo "<a href=\"".$row['id']."\" class=\"list-group-item\">".$title."</a>";
          }
		?>
	  </div>
  </div>
</div>