<div class="panel panel-default">
  <div class="panel-body">
<?php
if(isset($uid)){
	include "config/config.php";
	$stmt = $conn->query('SELECT * FROM pastes WHERE uid="'.$uid.'"');
	if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo "<h1>".$result["title"]."</h1>";
		echo "<textarea class=\"form-control\" rows=\"5\" disabled=\"true\">".$result["text"]."</textarea>";
	}
	else echo "Paste does not exist";
} else echo "Error: id not set";
?>
  </div>
</div>