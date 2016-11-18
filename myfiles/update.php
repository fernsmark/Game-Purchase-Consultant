<?php

include 'dbc.php';

if(isset($_POST['id']) && isset($_POST['genre']))
{
	$sql = "update game set genre_id = (select genre_id from genre where genre_name = '{$_POST['genre']}') where game_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}
if(isset($_POST['id']) && isset($_POST['developer']))
{
	$sql = "update game set developer_id = (select developer_id from developer where developer_name = '{$_POST['developer']}') where game_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}
if(isset($_POST['id']) && isset($_POST['platform']))
{
	$sql = "update game_platform set platform_id = (select platform_id from platform where platform_name = '{$_POST['platform']}') where gp_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}
if(isset($_POST['id']) && isset($_POST['date']))
{
	$sql = "update game_platform set release_date = '{$_POST['date']}' where gp_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}
if(isset($_POST['id']) && isset($_POST['price']))
{
	$sql = "update game_platform set price = {$_POST['price']} where gp_id = {$_POST['id']}";
	$result = mysqli_query($con,$sql) or die(mysql_error($con));
}

?>