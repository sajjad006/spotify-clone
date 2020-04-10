<?php

$base_url = '192.168.43.250/Spotify/';

$host = 'localhost';
$user = 'root';
$password = '';
$db_name = 'spotify';

$conn = mysqli_connect($host, $user, $password, $db_name);

if (!$conn) {
	header("Location:index.php");
	exit();	
}