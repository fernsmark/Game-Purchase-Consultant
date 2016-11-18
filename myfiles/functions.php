<?php

function get_game_title($game_id)
{
	include '/myfiles/dbc.php';
	$sql = "select game_title from game where game_id = {$game_id}";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $return)
	{
		return $return['game_title'];
	}
}

function get_genre_name($genre_id)
{
	include '/myfiles/dbc.php';
	$sql = "select genre_name from genre where genre_id = {$genre_id}";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $return)
	{
		return $return['genre_name'];
	}
}

function get_developer_name($developer_id)
{
	include '/myfiles/dbc.php';
	$sql = "select developer_name from developer where developer_id = {$developer_id}";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $return)
	{
		return $return['developer_name'];
	}
}

function get_platform_name($platform_id)
{
	include '/myfiles/dbc.php';
	$sql = "select platform_name from platform where platform_id = {$platform_id}";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $return)
	{
		return $return['platform_name'];
	}
}

function genre_developer_confidence($genre)
{
	include '/myfiles/dbc.php';
	$confidence = 0.0;
	$return_array[] = array();
	$return_array[0] = 0.0;
	$sql = "select distinct gg.genre_name, d.developer_name
			from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id and gp.platform_id = p.platform_id and gg.genre_name = '{$genre}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $row)
	{
		$sql_1 = "select count(*) as genre_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id and
				  gp.platform_id = p.platform_id and gg.genre_name = '{$row['genre_name']}'";
		$result_1 = mysqli_query($con, $sql_1) or die(mysql_error($con));
		foreach($result_1 as $count)
		{
			$genre_count = $count['genre_count'];
		}
		
		$sql_2 = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id and
				  gp.platform_id = p.platform_id and gg.genre_name = '{$row['genre_name']}' and d.developer_name = '{$row['developer_name']}'";
		$result_2 = mysqli_query($con, $sql_2) or die(mysql_error($con));
		foreach($result_2 as $total_count)
		{
			$confidence = $total_count['total_count']/$genre_count;
			if($return_array[0]<$confidence)
			{
				$return_array[0] = round($confidence,2);
				$return_array[1] = $row['developer_name'];
			}
		}
	}
	return $return_array;
}

function developer_genre_confidence($developer)
{
	include '/myfiles/dbc.php';
	$confidence = 0.0;
	$return_array[] = array();
	$return_array[0] = 0.0;
	$sql = "select distinct gg.genre_name, d.developer_name
			from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and d.developer_name = '{$developer}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $row)
	{
		$sql_1 = "select count(*) as developer_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and d.developer_name = '{$developer}'";
		$result_1 = mysqli_query($con, $sql_1) or die(mysql_error($con));
		foreach($result_1 as $count)
		{
			$developer_count = $count['developer_count'];
		}
		
		$sql_2 = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and gg.genre_name = '{$row['genre_name']}' and d.developer_name = '{$row['developer_name']}'";
		$result_2 = mysqli_query($con, $sql_2) or die(mysql_error($con));
		foreach($result_2 as $total_count)
		{
			$confidence = $total_count['total_count']/$developer_count;
			if($return_array[0]<$confidence)
			{
				$return_array[0] = round($confidence,2);
				$return_array[1] = $row['genre_name'];
			}
		}
	}
	return $return_array;
}

function developer_platform_confidence($developer)
{
	include '/myfiles/dbc.php';
	$confidence = 0.0;
	$return_array[] = array();
	$return_array[0] = 0.0;
	$sql = "select distinct p.platform_name, d.developer_name
			from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and p.platform_id = gp.platform_id and d.developer_id = g.developer_id
			and gg.genre_id = g.genre_id and d.developer_name = '{$developer}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $row)
	{
		$sql_1 = "select count(*) as developer_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and p.platform_id = gp.platform_id and d.developer_id = g.developer_id
				  and gg.genre_id = g.genre_id and d.developer_name = '{$developer}'";
		$result_1 = mysqli_query($con, $sql_1) or die(mysql_error($con));
		foreach($result_1 as $count)
		{
			$developer_count = $count['developer_count'];
		}
		
		$sql_2 = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and p.platform_id = gp.platform_id and d.developer_id = g.developer_id
				  and gg.genre_id = g.genre_id and p.platform_name = '{$row['platform_name']}' and d.developer_name = '{$row['developer_name']}'";
		$result_2 = mysqli_query($con, $sql_2) or die(mysql_error($con));
		foreach($result_2 as $total_count)
		{
			$confidence = $total_count['total_count']/$developer_count;
			if($return_array[0]<$confidence)
			{
				$return_array[0] = round($confidence,2);
				$return_array[1] = $row['platform_name'];
			}
		}
	}
	return $return_array;
}

function game_date_confidence($game)
{
	include '/myfiles/dbc.php';
	$confidence = 0.0;
	$return_array[] = array();
	$return_array[0] = 0.0;
	$sql = "select distinct g.game_title, gp.release_date from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and g.game_title = '{$game}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $row)
	{
		$sql_1 = "select count(*) as date_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and g.game_title = '{$game}'";
		$result_1 = mysqli_query($con, $sql_1) or die(mysql_error($con));
		foreach($result_1 as $count)
		{
			$date_count = $count['date_count'];
		}
		
		$sql_2 = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and g.game_title = '{$row['game_title']}' and gp.release_date = '{$row['release_date']}'";
		$result_2 = mysqli_query($con, $sql_2) or die(mysql_error($con));
		foreach($result_2 as $total_count)
		{
			$confidence = $total_count['total_count']/$date_count;
			if($return_array[0]<$confidence)
			{
				$return_array[0] = round($confidence,2);
				$return_array[1] = $row['release_date'];
			}
		}
	}
	return $return_array;
}

function platform_price_confidence($platform)
{
	include '/myfiles/dbc.php';
	$confidence = 0.0;
	$return_array[] = array();
	$return_array[0] = 0.0;
	$sql = "select distinct p.platform_name, gp.price from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and p.platform_name = '{$platform}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $row)
	{
		$sql_1 = "select count(*) as price_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and p.platform_name = '{$platform}'";
		$result_1 = mysqli_query($con, $sql_1) or die(mysql_error($con));
		foreach($result_1 as $count)
		{
			$price_count = $count['price_count'];
		}
		
		$sql_2 = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
				  where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
				  and gp.platform_id = p.platform_id and p.platform_name = '{$row['platform_name']}' and gp.price = '{$row['price']}'";
		$result_2 = mysqli_query($con, $sql_2) or die(mysql_error($con));
		foreach($result_2 as $total_count)
		{
			$confidence = $total_count['total_count']/$price_count;
			if($return_array[0]<$confidence)
			{
				$return_array[0] = round($confidence,2);
				$return_array[1] = $row['price'];
			}
		}
	}
	return $return_array;
}

function developer_support($developer)
{
	include '/myfiles/dbc.php';
	$sql = "select count(*) as developer_count from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and d.developer_name = '{$developer}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $count)
	{
		return round(($count['developer_count']/total_count())*100,2);
	}
}

function genre_support($genre)
{
	include '/myfiles/dbc.php';
	$sql = "select count(*) as genre_count from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and gg.genre_name = '{$genre}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $count)
	{
		return round(($count['genre_count']/total_count())*100,2);
	}
}

function game_support($game)
{
	include '/myfiles/dbc.php';
	$sql = "select count(*) as game_count from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and g.game_title = '{$game}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $count)
	{
		return round(($count['game_count']/total_count())*100,2);
	}
}

function platform_support($platform)
{
	include '/myfiles/dbc.php';
	$sql = "select count(*) as platform_count from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id
			and gp.platform_id = p.platform_id and p.platform_name = '{$platform}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $count)
	{
		return round(($count['platform_count']/total_count())*100,2);
	}
}

function total_count()
{
	include '/myfiles/dbc.php';
	$sql = "select count(*) as total_count from game g, genre gg, platform p, developer d, game_platform gp
			where g.game_id = gp.game_id and gg.genre_id = g.genre_id and d.developer_id = g.developer_id and gp.platform_id = p.platform_id";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	foreach($result as $count)
	{
		return $count['total_count'];
	}
}

function get_same_game_condition($uid,$game)
{
	include '/myfiles/dbc.php';
	$sql = "select ugp.ugp_id, s.state from user_game_platform ugp, state s where s.state_id = ugp.state_id and ugp.gp_id = {$game} and ugp.user_id = {$uid}";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	$state = array();
	if(mysqli_num_rows($result)==0)
	{
		return 0;
	}
	else
	{
		foreach($result as $temp)
		{
			$state[] = $temp['state'];
		}
		return in_array('Poor',$state);
	}
}

function get_similar_games($uid,$game)
{
	include '/myfiles/dbc.php';
	$sql = "select g.game_title, ugp.satisfaction from game g, user_game_platform ugp, game_platform gp
			where ugp.user_id = {$uid} and gp.gp_id = ugp.gp_id and g.game_id = gp.game_id and g.game_title != '{$game}'";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	
	if(mysqli_num_rows($result)!=0)
	{
		$j=0;
		foreach($result as $temp)
		{
			similar_text($game, $temp['game_title'], $percent1);
			similar_text($temp['game_title'], $game, $percent2);
			$avg_percent = ($percent1 + $percent2)/2;
						
			if($avg_percent >= 50 && $temp['satisfaction'] >= 7)
			{
				$j++;
			}
		}
		return $j;
	}
}

function get_fav_developer($uid, $developer)
{
	include '/myfiles/dbc.php';
	$sql = "select developer_name, count(developer_name) as number
			from game g, game_platform gp, developer d, user_game_platform ugp
			where ugp.user_id = {$uid} and ugp.gp_id = gp.gp_id and g.game_id = gp.game_id and g.developer_id = d.developer_id
			group by developer_name
			order by number desc, developer_name asc
			limit 2";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	$fav_developer = array();
	if(mysqli_num_rows($result)!=0)
	{
		foreach($result as $temp)
		{
			$fav_developer[] = $temp['developer_name'];
		}
	}
	return in_array($developer, $fav_developer);
}

function get_fav_genre($uid, $genre)
{
	include '/myfiles/dbc.php';
	$sql = "select genre_name, count(genre_name) as number
			from game g, game_platform gp, genre gg, user_game_platform ugp
			where ugp.user_id = {$uid} and ugp.gp_id = gp.gp_id and g.game_id = gp.game_id and g.genre_id = gg.genre_id
			group by genre_name
			order by number desc, genre_name asc
			limit 2";
	$result = mysqli_query($con, $sql) or die(mysql_error($con));
	$fav_genre = array();
	if(mysqli_num_rows($result)!=0)
	{
		foreach($result as $temp)
		{
			$fav_genre[] = $temp['genre_name'];
		}
	}
	return in_array($genre, $fav_genre);
}

function trend_score($t12, $t16, $t26, $t13, $t23)
{
	$j=0;
	if($t12 > 0)
	{
		$j++;
		if($t12 >= 1)
		{
			$j++;
		}
		if($t26 > 0)
		{
			$j++;
			if($t26 >= 0.5)
			{
				$j++;
			}
			if($t26 > $t16)
			{
				$j++;
			}
			else if($t16 > $t26)
			{
				$j--;
			}
			
			if($t23 > 0)
			{
				$j++;
				if($t23 >= 0.25)
				{
					$j++;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
			else if($t23 < 0)
			{
				$j--;
				if($t23 <= -0.25)
				{
					$j--;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
		}
		else if($t26 < 0)
		{
			$j--;
			if($t26 <= -0.5)
			{
				$j--;
			}
			if($t26 > $t16)
			{
				$j++;
			}
			else if($t16 > $t26)
			{
				$j--;
			}
			
			if($t23 > 0)
			{
				$j++;
				if($t23 >= 0.25)
				{
					$j++;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
			else if($t23 < 0)
			{
				$j--;
				if($t23 <= -0.25)
				{
					$j--;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
		}
	}
	else if($t12 < 0)
	{
		$j--;
		if($t12 <= -1)
		{
			$j--;
		}
		if($t26 > 0)
		{
			$j++;
			if($t26 >= 0.5)
			{
				$j++;
			}
			if($t26 > $t16)
			{
				$j++;
			}
			else if($t16 > $t26)
			{
				$j--;
			}
			
			if($t23 > 0)
			{
				$j++;
				if($t23 >= 0.25)
				{
					$j++;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
			else if($t23 < 0)
			{
				$j--;
				if($t23 <= -0.25)
				{
					$j--;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
		}
		else if($t26 < 0)
		{
			$j--;
			if($t26 <= -0.5)
			{
				$j--;
			}
			if($t26 > $t16)
			{
				$j++;
			}
			else if($t16 > $t26)
			{
				$j--;
			}
			
			if($t23 > 0)
			{
				$j++;
				if($t23 >= 0.25)
				{
					$j++;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
			else if($t23 < 0)
			{
				$j--;
				if($t23 <= -0.25)
				{
					$j--;
				}
				if($t23 > $t13)
				{
					$j++;
				}
				else if($t13 > $t23)
				{
					$j--;
				}
			}
		}
	}
	return $j;
}

function trend($start, $end, $avg)
{
	$j=0;
	for($i=$start; $i<$end; $i++)
	{
		if($avg[$i] > $avg[$i+1])
		{
			//$j++;
			if(($avg[$i] - $avg[$i+1]) >= 1)
			{
				$j = $j + (2*($avg[$i] - $avg[$i+1]));
			}
			else if(($avg[$i] - $avg[$i+1]) >= 0.5 && ($avg[$i] - $avg[$i+1]) < 1)
			{
				$j = $j + (1*($avg[$i] - $avg[$i+1]));
			}
			else
			{
				$j = $j + (0.5*($avg[$i] - $avg[$i+1]));
			}
		}
		else if($avg[$i] < $avg[$i+1])
		{
			//$j--;
			if(($avg[$i+1] - $avg[$i]) >= 1)
			{
				$j = $j - (2*($avg[$i+1] - $avg[$i]));
			}
			else if(($avg[$i+1] - $avg[$i]) >= 0.5 && ($avg[$i+1] - $avg[$i]) < 1)
			{
				$j = $j - (1*($avg[$i+1] - $avg[$i]));
			}
			else
			{
				$j = $j - (0.5*($avg[$i+1] - $avg[$i]));
			}
		}
	}
	return round($j,2);
}

function pg_trend($start, $end, $avg)
{
	$j=0;
	for($i=$start; $i<$end; $i++)
	{
		if($avg[$i] > $avg[$i+1])
		{
			//$j++;
			if(($avg[$i] - $avg[$i+1]) >= 200)
			{
				$j = $j + (2*($avg[$i] - $avg[$i+1]));
			}
			else if(($avg[$i] - $avg[$i+1]) >= 100 && ($avg[$i] - $avg[$i+1]) < 200)
			{
				$j = $j + (1*($avg[$i] - $avg[$i+1]));
			}
			else
			{
				$j = $j + (0.5*($avg[$i] - $avg[$i+1]));
			}
		}
		else if($avg[$i] < $avg[$i+1])
		{
			//$j--;
			if(($avg[$i+1] - $avg[$i]) >= 200)
			{
				$j = $j - (2*($avg[$i+1] - $avg[$i]));
			}
			else if(($avg[$i+1] - $avg[$i]) >= 100 && ($avg[$i+1] - $avg[$i]) < 200)
			{
				$j = $j - (1*($avg[$i+1] - $avg[$i]));
			}
			else
			{
				$j = $j - (0.5*($avg[$i+1] - $avg[$i]));
			}
		}
	}
	return round($j,2);
}

?>