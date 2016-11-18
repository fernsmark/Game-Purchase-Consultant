<?php

include 'dbc.php';

if(!empty($_POST["game"]) && $_POST["game"]!=0 && !empty($_POST["platform"]) && $_POST["platform"]!=0)
{
	$sql ="select g.game_title, gp.release_date, p.platform_name
			from game g, game_platform gp, platform p
			where g.game_id = '" . $_POST["game"] . "' and g.game_id = gp.game_id and p.platform_id = gp.platform_id and p.platform_id = '" . $_POST["platform"] . "'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $temp)
	{
		$game = $temp['game_title'];
		$compare = $temp['release_date'];
		$platform = $temp['platform_name'];
	}
	
	if($_POST["date"] > date("Y-m-d"))
	{
		echo "<font color='red'>You've gone into the future ({$_POST["date"]}) mate! Snap back to reality!</font>";
		echo "<script>document.getElementById('purchasedate').value=null;</script>";
	}
	else if($compare > $_POST["date"])
		{
			echo "<font color='red'>The date entered {$_POST["date"]} predates the release date for {$game} for {$platform} which is {$compare}.</font>";
			echo "<script>document.getElementById('purchasedate').value=null;</script>";
		}
	else if($compare == $_POST["date"])
		{
			echo "<font color='green'>Wow! You bought {$game} for {$platform} on its release date. That is cool!</font>";
		}
	else if($compare < $_POST["date"])
		{
			echo "<font color='green'>You entered a valid date as the release date predates the purchase date.</font>";
		}
}
else
{
	echo "<font color='red'>You need to select a game and a platform before selecting a purchase date.</font>";
	echo "<script>document.getElementById('purchasedate').value=null;</script>";
}
?>