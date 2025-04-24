<?php
include '../connection.php';
$id = $_GET['id'];
$sql = "select status from store_announcements WHERE id = $id";
$result = $dbc->query($sql);
$row = $result->fetch_assoc();
$status = $row['status'];
if($status == 'hidden'){
    $sql = "update store_announcements set status = 'shown' where id = $id";
}else{
    $sql = "update store_announcements set status = 'hidden' where id = $id";
}
$result = $dbc->query($sql);
header("location:admin-announcements.php");