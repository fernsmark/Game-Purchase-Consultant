<?php

include 'dbc.php';

if(!empty($_POST["genre_id"])) {
	$sql ="select game_id, game_title from game where genre_id = '" . $_POST["genre_id"] . "'";
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