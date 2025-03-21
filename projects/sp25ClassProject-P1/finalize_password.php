<?php
include "helper_functions.php";

$email = clean($_POST['email']);
$password = $_POST['password'];
$password_confirm = clean($_POST['confirm_password']);

if($_POST['password'] != $password_confirm){
    echo "Passwords do not match";
    die("Password not updated.");
}else{
    include "connection.php";
    $password_encoded = password_hash($password_confirm, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$password_encoded' WHERE email = '$email'";
    $dbc->query($sql);

    echo "Password updated!";
    echo "<br><a href='index.php'>Click here</a> to go back.";
}