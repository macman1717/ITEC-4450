<?php
session_start();

ob_start();
$loginMessage = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_COOKIE['type'])){
    $_SESSION['id'] = $_COOKIE['id_user'];
    $_SESSION["email"] = $_COOKIE['email'];
    $_SESSION["firstname"] = $_COOKIE['firstname'];
    if($_COOKIE['type'] == '1'){
        header('location: ./user/user_home.php');
    }else{
        header('location: ./admin/admin_home.php');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = test_input($_POST["email"]);
    $pw = test_input($_POST["pw"]);

    include "connection.php";
    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($dbc, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1){
        $row = mysqli_fetch_array($result);
        if(password_verify($pw, $row['password'])){
            $loginMessage = "login success, welcome to our site ".$row['firstname'];
            $dbfirstname=$row['firstname'];
            $user_type = $row['user_type'];
            $_SESSION['id'] = $row['id'];
            $_SESSION["email"] = $email;
            $_SESSION["firstname"] = $dbfirstname;

            setCookie("email", $email, time() + (86400 * 7));
            setCookie("firstname", $dbfirstname, time() + (86400 * 7));
            setCookie('id_user', $row['id'], time() + (86400 * 7));
            setCookie('type', $user_type, time() + (86400 * 7));

            mysqli_close($dbc);
            if($user_type==0){
                header("Location:admin/admin_home.php");
            }else{
                header("location:user/user_home.php");
            }

            exit();
        }else{
            $loginMessage = "Invalid username or password";
        }
    }else{
        $loginMessage = "Invalid username or password"; //purposely ambiguous for security reasons
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Testing Site Home</title>
</head>
<body>
<div class="main-wrapper">
<?php echo "<h2>$loginMessage</h2>"; ?>
<h1>Welcome to Jimmy's Free Online Testing Site</h1>
<p>If you already have an account with us, please log in.</p>
<p>Otherwise, please <a href="user/registration.php">sign up.</a></p>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    Email <input type="text" name="email" maxlength="50"> <br><br>
    Password <input type="password" name="pw" maxlength="30"> <br><br>
    <input type="submit" name="loginBtn" value="Log in">
</form>

<p>Forgot Password? <a href="forgot_password.php">Click Here</a></p>

</div>
</body>
</html>
