<?php
header('Content-Type: text/html; charset=UTF-8');

?>
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
}
?>
You should be able to update your password here.
<form action='finalize_password.php' method='post'>
    <input type='hidden' name='email' value='<?php echo $email ?>'>
    Enter your new password: <input type='password' name='password'>
    <br>Confirm password: <input type='password' name='confirm_password'>
    <br><input type='submit' name='submit' value='Submit'>
</form>
</body>
</html>
