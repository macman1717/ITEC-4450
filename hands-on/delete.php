<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "Ready to delete";
    include "connection.php";
    $id = $_POST['id'];
    $email=$_POST['email'];

    $sql = "DELETE FROM users WHERE email='$email';";
    echo $sql;
    $result = mysqli_query($dbc, $sql);
}
