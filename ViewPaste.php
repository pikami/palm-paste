<div class="panel panel-default">
  <div class="panel-body">
<?php
if(isset($id)){
	include "config/config.php";
	$stmt = $conn->query('SELECT * FROM pastes WHERE id='.$id);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	echo "<h1>".$result["title"]."</h1>";
	echo "<textarea class=\"form-control\" rows=\"5\" disabled=\"true\">".$result["text"]."</textarea>";
} else echo "Error: id not set";
?>
  </div>
</div>