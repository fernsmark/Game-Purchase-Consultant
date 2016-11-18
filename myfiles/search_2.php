<?php

if(!empty($_POST["word"]))
{
	include 'dbc.php';
	$string = "+".str_replace(" ","*+",$_POST["word"])."*";
		
	$sql = "SELECT developer_id, developer_name, MATCH(tags) AGAINST('{$string}') AS `relevance`
			FROM `developer` WHERE MATCH(tags) AGAINST('{$string}' IN BOOLEAN MODE)
			ORDER BY relevance DESC;";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result)==0)
	{
		echo "<font color='red'>We could not find any developers matching your request. Try something else.</font>";
	}
	else
	{		
		foreach($result as $developer)
		{
			echo " <a href='http://localhost/?q=developer_details&did={$developer['developer_id']}'>{$developer['developer_name']}</a>";
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