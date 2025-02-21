<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "connection.php";

    $id = $_POST['id'];
    $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $level = mysqli_real_escape_string($dbc, trim($_POST['level']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', 
                 level='$level', password='$password' WHERE id=$id";

    echo "The query statement is $sql <br>";

    mysqli_query($dbc, $sql);
    if(mysqli_affected_rows($dbc) == 1){
        echo "You have successfully updated user.";
        echo "<br>Please <a href='activity11.php'>click here</a> to go back. <br>";
    }else{
        echo "Something went wrong with update.";
    }
}
?>
