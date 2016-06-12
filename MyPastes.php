<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
<?php
include "config/config.php";
include_once "includes/user.php";
if(GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]) == -1){
	printf('<h2>You must be loged in to see your pastes!</h2>');
	$conn = null;
	echo '</div></div></div>';
	die();
}
$stmt = $conn->prepare('SELECT * FROM pastes WHERE owner=:own');
$stmt->bindParam(':own', GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]));
$stmt->execute();
if($stmt->rowCount()>0){
	echo "<table id=\"tablepastes\" class=\"table table-striped\" style=\"width:100%\">";
	printf('<thead><th data-dynatable-column="name" style="text-align: left;">Title</th>
			<th style="text-align: left;">Added</th>
			<th style="text-align: left;">ID</th></thead>');
	printf('<tbody>');
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$title = $row['title'];
		printf('<tr><td style="text-align: left;">'.$row["title"].'</td>');
		printf('<td style="text-align: left;">'.date('Y-m-d',$row["created"]).'</td>');
		printf('<td style="text-align: right;"><a href="'.$row["uid"].'">'.$row["uid"].'</a></td></tr>');
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