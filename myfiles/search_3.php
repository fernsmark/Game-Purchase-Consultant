<?php

if(!empty($_POST["word"]))
{
	include 'dbc.php';
	$string = "+".str_replace(" ","*+",$_POST["word"])."*";
		
	$sql = "SELECT genre_id, genre_name, MATCH(tags) AGAINST('{$string}') AS `relevance`
			FROM `genre` WHERE MATCH(tags) AGAINST('{$string}' IN BOOLEAN MODE)
			ORDER BY relevance DESC;";
	$result = mysqli_query($con, $sql);

	if(mysqli_num_rows($result)==0)
	{
		echo "<font color='red'>We could not find any genres matching your request. Try something else.</font>";
	}
	else
	{		
		foreach($result as $genre)
		{
			echo "<a href='http://localhost/?q=genre_details&gid={$genre['genre_id']}'>{$genre['genre_name']}</a>";
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