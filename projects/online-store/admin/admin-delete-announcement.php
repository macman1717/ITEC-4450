<?php
include '../connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM store_announcements WHERE id=$id";
echo $sql;
$result = mysqli_query($dbc, $sql);
header("location:admin-announcements.php");
