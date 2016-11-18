<?php

include 'dbc.php';

if(!empty($_POST["game"]) && $_POST["game"]!=0 && !empty($_POST["platform"]) && $_POST["platform"]!=0)
{
	$sql ="select g.game_title, p.platform_name, gp.price
			from game g, game_platform gp, platform p
			where g.game_id = '" . $_POST["game"] . "' and g.game_id = gp.game_id and p.platform_id = gp.platform_id and p.platform_id = '" . $_POST["platform"] . "'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $temp)
	{
		$game = $temp['game_title'];
		$platform = $temp['platform_name'];
		$compare = $temp['price'];
	}

	if(!is_numeric($_POST["price"]))
	{
		echo "<font color='red'>'{$_POST["price"]}' doesn't seem to be a valid price. Please make sure there are no characters typed.</font>";
		echo "<script>document.getElementById('purchaseprice').value=null;</script>";
	}	
	else if($compare > $_POST["price"])
	{
		if($_POST["price"] > 1000)
		{
			echo "<font color='red'>Are you sure the price is more than \$1000? The most expensive game we know of costs \$1000.</font>";
			echo "<script>document.getElementById('purchaseprice').value=null;</script>";
		}
		else
		{
			echo "<font color='green'>You purchased {$game} for {$platform} at a price less than the release price of \${$compare}. That's good!</font>";
		}
	}
	else if($compare == $_POST["price"])
	{
		echo "<font color='green'>You purchased {$game} for {$platform} at the release price of \${$compare}.</font>";
	}
	else if($compare < $_POST["price"])
	{
		echo "<font color='red'>The price you entered, \${$_POST["price"]}, was more than the release price of {$game} for {$platform} which is \${$compare}.</font>";
		echo "<script>document.getElementById('purchaseprice').value=null;</script>";
	}
}
else
{
	echo "<font color='red'>You need to select a game and a platform before entering a price for it.</font>";
	echo "<script>document.getElementById('purchaseprice').value=null;</script>";
}
?>