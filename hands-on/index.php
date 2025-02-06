<?php
ob_start();
$loginMessage = "";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = test_input($_POST["email"]);
    $pw = test_input($_POST["pw"]);

    include "connection.php";
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pw'";
    $result = mysqli_query($dbc, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1){
        $row = mysqli_fetch_array($result);
        $loginMessage = "login success, welcome to our site ".$row['firstname'];
        mysqli_close($dbc);
        header("location:user_home.php");
        exit();
    }else{
        $loginMessage = "Invalid username or password"; //purposely ambiguous for security reasons
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 10</title>
</head>
<body>
<h1>Activity 10 - 5 February 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<?php echo "<h2>$loginMessage</h2>"?>
<h1>Welcome to Jimmy's Free Online Testing Site</h1>
<p>If you already have an account with us, please log in.</p>
<p>Otherwise, please <a href="activity8-updated.php">sign up.</a></p>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    Email <input type="text" name="email" maxlength="50"> <br><br>
    Password <input type="password" name="pw" maxlength="30"> <br><br>
    <input type="submit" name="loginBtn" value="Log in">
</form>


</body>
</html>
