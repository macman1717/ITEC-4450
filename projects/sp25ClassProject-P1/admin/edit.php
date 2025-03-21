<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../connection.php";

    $id = $_POST['id'];
    $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $level = mysqli_real_escape_string($dbc, trim($_POST['level']));


    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', 
                 level='$level' WHERE id=$id";

    $dbc->query($sql);
    if(mysqli_affected_rows($dbc) == 1){
        echo "You have successfully updated user.";
    }else if(mysqli_affected_rows($dbc) == 0) {
        echo "There was an error updating record, no new information for the user. <br>";
    }else{
        echo "Something went wrong with update. " . mysqli_affected_rows($dbc);
    }
    echo "<br>Please <a href='admin_manage.php'>click here</a> to go back. <br>";

}
