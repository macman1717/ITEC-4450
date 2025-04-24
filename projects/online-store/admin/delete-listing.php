<?php
$id = $_GET['id'];
include '../connection.php';
$sql = "DELETE FROM store_listings WHERE id=$id";
mysqli_query($dbc,$sql);
header('location:admin-current-items.php');