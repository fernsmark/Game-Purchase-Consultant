<?php

include 'dbc.php';

if(!empty($_POST["game"]) && $_POST["game"]!=0 && !empty($_POST["platform"]) && $_POST["platform"]!=0)
{
	$sql ="select g.game_title, p.platform_name
			from game g, game_platform gp, platform p
			where g.game_id = '" . $_POST["game"] . "' and g.game_id = gp.game_id and p.platform_id = gp.platform_id and p.platform_id = '" . $_POST["platform"] . "'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $temp)
	{
		$game = $temp['game_title'];
		$platform = $temp['platform_name'];
	}
	
	echo "<font color='green'>You are about to rate {$game} for {$platform} a {$_POST["satisfaction"]} out of 10.</font>";
}
else
{
	echo "<font color='red'>You need to select a game and a platform before rating it.</font>";
}
?>