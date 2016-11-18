<?php

include 'dbc.php';

if(isset($_POST['id']))
{
	$sql = "delete from user_game_platform where ugp_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}

?>