<html>
<head>
    <title>Reset PW</title>
</head>
<body>
<h2>Please follow the following instructions below to reset your password</h2>
<?php
$email = $_GET['email'];
include "connection.php";

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $dbc->query($sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
$row = $result->fetch_assoc();
    echo "You should be able to update your password here.";
    echo "<form action='finalize_password.php' method='post'>";
    echo "<input type='hidden' name='email' value='$email'>";
    echo "Enter your new password: <input type='password' name='password'>";
    echo "Confirm password: <input type='password' name='confirm_password'>";
    echo "<input type='submit' name='submit' value='Submit'>";
    echo "</form>";
}else{
    echo "There is no user with that email.";
    echo "<a href='index.php'>Go back</a>";
}
?>
</body>
</html>
