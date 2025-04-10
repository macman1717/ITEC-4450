<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "select * from store_users where email = '".$_POST['email']."';";
    $result = mysqli_query($dbc, $sql);
    if($result->num_rows == 1) {

        session_start();
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $type = $row['user_type'];
            if ($type == "admin") {
                header("Location: admin/");
            } else {
                header("Location: user/");
            }
        } else {
            $login_error = "Invalid Email or Password";
        }
    }else{
        $login_error = "Invalid Email or Password";
    }
}
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store - Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
<?php include 'nav.php' ?>

<h1>Login</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <?php if(isset($login_error)){echo '<h5>'.$login_error.'</h5>';}?>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email"> <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit">
    <br>
    <a href="forgot-password.php">Forgot Password?</a>
</form>


</body>
<?php include 'footer.php' ?>
</html>
