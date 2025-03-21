<?php
include "helper_functions.php";

$email = clean($_POST['email']);
$password = clean($_POST['password']);
$password_confirm = clean($_POST['password_confirm']);

if($password != $password_confirm){
    echo "Passwords do not match";
    die("Password not updated.");
}else{
    include "connection.php";
    $password_encoded = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$password_encoded' WHERE email = '$email'";
    echo "Password updated!";
    echo "<a href='index.php'>Click here</a> to go back.";
}
