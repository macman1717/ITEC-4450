<?php
include '../connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM apath_volunteer WHERE v_id = $id";
$dbc -> query($sql);

$sql = "DELETE FROM apath_users WHERE id = $id";
$dbc -> query($sql);

header('location: admin-manage-volunteers.php');
