<?php

include 'dbc.php';

if(!empty($_POST["developer_id"])) {
	$sql ="select game_id, game_title from game where developer_id = '" . $_POST["developer_id"] . "'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
?>
	<option value="">Select Game</option>
<?php
	foreach($result as $game) {
?>
	<option value="<?php echo $game["game_id"]; ?>"><?php echo $game["game_title"]; ?></option>
<?php
	}
}
?>