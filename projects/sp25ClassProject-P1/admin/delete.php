<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../connection.php";
    $id = $_POST['id'];
    $email=$_POST['email'];

    $sql = "DELETE FROM users WHERE email='$email';";
    $dbc -> query($sql);
    $sql = "DELETE FROM quiz_results WHERE user_id=$id;";
    if(mysqli_affected_rows($dbc)==1){
        echo "User deleted successfully";
    }else{
        echo "Error deleting user";
    }
    echo "<br>Please <a href='admin_manage.php'>click here</a> to go back. <br>";

}
