<?php

if(!empty($_POST["word"]))
{
	include 'dbc.php';
	$string = "+".str_replace(" ","*+",$_POST["word"])."*";
		
	$sql = "SELECT platform_id, platform_name, MATCH(tags) AGAINST('{$string}') AS `relevance`
			FROM `platform` WHERE MATCH(tags) AGAINST('{$string}' IN BOOLEAN MODE)
			ORDER BY relevance DESC;";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result)==0)
	{
		echo "<font color='red'>We could not find any platforms matching your request. Try something else.</font>";
	}
	else
	{		
		foreach($result as $platform)
		{
			echo "<a href='http://localhost/?q=platform_details&pid={$platform['platform_id']}'>{$platform['platform_name']}</a>";
			echo "<script>document.getElementById('searchbox').value=null;</script>";
			echo "<br><br>";
		}
	}
}
else
{
	echo "<font color='red'>Wasn't the search box empty?</font>";
}
?>