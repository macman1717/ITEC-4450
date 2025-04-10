<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['password'] == $_POST['confirm_password'] && strlen($_POST['password']) > 0){
        include 'connection.php';

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_SESSION['email'];
        $sql = 'UPDATE store_users SET password = "'.$password.'" WHERE email = "'.$email.'"';
        session_destroy();
        $dbc -> query($sql);
        header("location: login.php");
    }else{
        $passwordError = "Passwords do not match!";
    }

}

?>
<html>
<head>
    <title>Password Reset</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        h4{color: red}
    </style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <h3>Please Reset Your Password</h3>
    <?php if(isset($passwordError)) echo "<h4>Passwords are blank or do not match</h4>"?>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password"><br>
    <input type="submit">
</form>
</body>
</html>
