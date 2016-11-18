<?php

include 'dbc.php';

if(!empty($_POST["game_id"])) {
	$sql ="select p.platform_id, p.platform_name from platform p, game_platform gp where gp.game_id = '" . $_POST["game_id"] . "' and p.platform_id = gp.platform_id";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
?>
	<option value="">Select Platform</option>
<?php
	foreach($result as $platform) {
?>
	<option value="<?php echo $platform["platform_id"]; ?>"><?php echo $platform["platform_name"]; ?></option>
<?php
	}
}
?>