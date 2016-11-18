<?php

include 'dbc.php';

if($_POST['developer']!=0 && $_POST['genre']!=0)
{
	echo "<font color='red'>You need to select either a developer or a genre and not both.</font>";
}
else if($_POST['developer']==0 && $_POST['genre']==0)
	{
		echo "<font color='red'>You need to select either a developer or a genre to start selecting a game.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && empty($_POST['game']))
	{
		echo "<font color='red'>You missed selecting the game.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && $_POST['game'] !=0 && empty($_POST['platform']))
	{
		echo "<font color='red'>You missed selecting the platform.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && $_POST['game'] !=0 && $_POST['platform'] !=0 && empty($_POST['purchasedate']))
	{
		echo "<font color='red'>You missed selecting the purchase date.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && $_POST['game'] !=0 && $_POST['platform'] !=0 && empty($_POST['purchasedate']))
	{
		echo "<font color='red'>You missed selecting the purchase date.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && $_POST['game'] !=0 && $_POST['platform'] !=0 && $_POST['purchasedate']!=0 && empty($_POST['purchaseprice']))
	{
		echo "<font color='red'>You missed selecting the purchase price.</font>";
	}
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && $_POST['game'] !=0 && $_POST['platform'] !=0 && $_POST['purchasedate']!=0 && $_POST['purchaseprice']!=0 && empty($_POST['state']))
	{
		echo "<font color='red'>You missed selecting the condition of your game.</font>";
	}	
else if((($_POST['developer']!=0 && $_POST['genre']==0) || ($_POST['developer']==0 && $_POST['genre']!=0)) && !empty($_POST['game']) && $_POST['game']!=0 && !empty($_POST['platform']) && $_POST['platform']!=0 && !empty($_POST['purchasedate']) && $_POST['purchasedate']!=0 && !empty($_POST['purchaseprice']) && $_POST['purchaseprice']!=0 && !empty($_POST['state']) && $_POST['state']!=0)
	{
		$result = mysqli_query($con,"select game_title from game where game_id = ".$_POST['game']."") or die(mysql_error($con));
		foreach($result as $temp)
		{
			$game = $temp['game_title'];
		}
		
		$result = mysqli_query($con,"select platform_name from platform where platform_id = ".$_POST['platform']."") or die(mysql_error($con));
		foreach($result as $temp)
		{
			$platform = $temp['platform_name'];
			if($platform == "PC Games")
			{
				$platform = "PC";
			}
		}
		
		$sql = "select gp_id from game_platform where game_id = ".$_POST['game']." and platform_id = ".$_POST['platform']."";
		$result = mysqli_query($con,$sql) or die(mysql_error($con));
		foreach($result as $temp)
		{
			$game_platform = $temp['gp_id'];
		}
		$purchaseprice = round($_POST['purchaseprice'],2);
		$sql = "insert into user_game_platform (user_id,gp_id,purchase_date,purchase_price,satisfaction,state_id) values ({$_POST['user']},{$game_platform},'{$_POST['purchasedate']}',{$purchaseprice},{$_POST['satisfaction']},{$_POST['state']})";
		if (mysqli_query($con,$sql))
		{
			$result = mysqli_query($con,"select count(*) as count from user_game_platform where user_id = ".$_POST['user']."") or die(mysql_error($con));
			foreach($result as $temp)
			{
				$count = $temp['count'];
			}
			
			echo "<font color='green'>{$game} for {$platform} was added to your collection successfully. You have <b>{$count}</b> game(s) in your collection now. You can check the same <a href='http://localhost/?q=your_collection'>here</a>. Or, you can reset the form above and add another game.</font>";
		}
		else
		{
			echo "<font color='red'>There was an issue while adding {$game} for {$platform}. We believe you already have that game in your collection. You can check the same <a href='http://localhost/?q=your_collection'>here</a>. Or, you can reset the form above and add another game.</font>";
		}
	}

?>