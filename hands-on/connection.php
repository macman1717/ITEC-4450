<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "4450Spring2025";
$dbc = mysqli_connect($hostname, $username, $password, $dbname) OR die("Cannot establish connection");

echo "Connected to DB: $dbname successfully <br>";
?>