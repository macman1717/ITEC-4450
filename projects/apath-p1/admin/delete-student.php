<?php
include '../connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM apath_student WHERE s_id = $id";
$dbc -> query($sql);

$sql = "DELETE FROM apath_user WHERE id = $id";
$dbc -> query($sql);

header('location: admin-manage-students.php');