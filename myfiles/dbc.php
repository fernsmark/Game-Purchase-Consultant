<?php

$dbuser = 'root';
$dbpassword = '';
$dbhost = 'localhost';
$con= mysqli_connect($dbhost, $dbuser, $dbpassword);

/*if (!$con) { echo "MySQL connection failed.<br>"; }
else { echo "Connected to MySQL! <br>"; }*/

mysqli_select_db($con,'gaming');
?>