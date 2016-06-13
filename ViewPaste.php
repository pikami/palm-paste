<div class="container">			
	<div class="panel panel-default">
		<div class="panel-body">
<?php
if(isset($uid)){
	include "config/config.php";
	include_once "includes/user.php";
	$stmt = $conn->query('SELECT * FROM pastes WHERE uid="'.$uid.'"');
	if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$conn = null;
		if($result["exposure"]==2 && isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]) && $result["owner"]!=GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"])){
			echo "<h1>This paste is private</h1>";
			die();
		}
		echo "<h1>".htmlspecialchars($result["title"], ENT_QUOTES, 'UTF-8')."</h1>";
		echo "<pre class=\"brush: ".$_HL."\">";
		echo htmlspecialchars($result["text"], ENT_QUOTES, 'UTF-8')."</pre><pb>";
		echo "<textarea class=\"form-control\" rows=\"5\" disabled=\"true\">".htmlspecialchars($result["text"], ENT_QUOTES, 'UTF-8')."</textarea>";
	}
	else echo "Paste does not exist";
	$conn = null;
} else echo "Error: id not set";
?>
			<script type="text/javascript">
				SyntaxHighlighter.all()
			</script>
		</div>
	</div>
</div>