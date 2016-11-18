<?php

if(!empty($_POST["word"]))
{
	include 'dbc.php';
	$string = "+".str_replace(" ","*+",$_POST["word"])."*";
		
	$sql = "SELECT game_id, game_title, MATCH(tags) AGAINST('{$string}') AS `relevance`
			FROM `game` WHERE MATCH(tags) AGAINST('{$string}' IN BOOLEAN MODE)
			ORDER BY relevance DESC;";
	$result1 = mysqli_query($con, $sql);

	if(mysqli_num_rows($result1)==0)
	{
		echo "<font color='red'>We could not find any game matching your request. Try something else.</font>";
	}
	else
	{		
		foreach($result1 as $game)
		{
			$sql = "select gp.gp_id, p.platform_name
					from platform p, game_platform gp, game g
					where p.platform_id = gp.platform_id and gp.game_id = g.game_id and g.game_id = {$game['game_id']}";
					
			$result2 = mysqli_query($con, $sql);
			
			echo "{$game['game_title']} for |";
			
			foreach($result2 as $temp)
			{
				echo " <a href='http://localhost/?q=game_details&gpid={$temp['gp_id']}'>{$temp['platform_name']}</a> |";
				echo "<script>document.getElementById('searchbox').value=null;</script>";
			}
			echo "<br><br>";
		}
	}
}
else
{
	echo "<font color='red'>Wasn't the search box empty?</font>";
}
?>