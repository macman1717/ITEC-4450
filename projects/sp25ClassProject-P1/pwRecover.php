<?php
include "connection.php";
include "helper_functions.php";
if(isset($_POST["email"])){
    $email = clean($_POST["email"]);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $dbc->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];

        $subject = "Password Reset";
        $msg = "Hello $firstName $lastName, You have requested to reset your password.\r\n".
            "Your login ID is: ".$row[0]."\r\n\r\n".
            "If it is not you, please disregard this email.".
            "Otherwise, please click the following link to reset your password.\r\n\r\n".
            "https://cgriffin10.domains.ggc.edu/projects/sp25ClassProject-P1/reset_password.php?email=".$email;
        mail($email, $subject, $msg);
    }else{
        echo "Something went wrong. Please try again later.";
    }
}