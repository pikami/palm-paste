<div class="container">			
	<div class="panel panel-default">
		<div class="panel-body">
<?php
if(isset($uid)){
	include_once "config/config.php";
	include_once "includes/user.php";
	$conn = GetConnectionToDB();
	$stmt = $conn->query('SELECT * FROM pastes WHERE uid="'.$uid.'"');
	if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		$conn = null;
		if($result["expire"]!=0 && $result["expire"]<time()){
			//This paste is expired but not removed
			echo "<h1>This paste just expired</h1>";
			include_once "cronjob.php";
			RemoveExpiredPastes();
			die();
		}
		if($result["exposure"]==2 && $result["owner"]!=0 && isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]) && $result["owner"]!=GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"])){
			echo "<h1>This paste is private</h1>";
			die();
		}
		echo "<h1>".htmlspecialchars($result["title"], ENT_QUOTES, 'UTF-8')."</h1>";
		//
		$owner = GetUserByID($result["owner"]);
		echo "<h5>";
		if($owner[1] == -1)
			echo "Posted by: <b>Guest</b>";
		else echo "Posted by: <b><a href=\"u/".htmlspecialchars($owner[1])."\">".htmlspecialchars($owner[1])."</a></b>";
		echo ", at ".date('Y-m-d',$result["created"]).", it will expire <b>";
		if($result["expire"]==0) printf('Never');
		else{
			$expire = ($result["expire"]-time())/3600;
			if($expire>24){
				printf(round($expire/24).' days from now');
			} else if($expire>=1)
				printf(round($expire).' hours from now');
			else printf(round($expire*60).' minutes from now');
		}
		echo "</b></h5>";
		//
		echo "<pre class=\"brush: ".$_HL."\">";
		echo htmlspecialchars($result["text"], ENT_QUOTES, 'UTF-8')."</pre><pb>";
		echo "<label for=\"rawtext\">Raw text:</label>";
		echo "<textarea id=\"rawtext\" class=\"form-control\" rows=\"10\">".htmlspecialchars($result["text"], ENT_QUOTES, 'UTF-8')."</textarea>";
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