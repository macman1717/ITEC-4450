<?php
include 'connection.php';
$error = false;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $keys = ['email', 'password', 'first_name', 'last_name', 'phone', 'security_question', 'security_answer'];
    foreach($keys as $key) {
        if(!isset($_POST[$key]) || $_POST[$key] == null || $_POST[$key] == "") {
            $error = true;
        }
    }

    if($_POST['password'] != $_POST['password_confirm']) $password_message = "Passwords do not match";

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $email_message = "Invalid email address";

    if(!$error) {
        $sql = "SELECT * FROM store_users WHERE email = '" . $_POST['email'] . "'";
        $result = mysqli_query($dbc, $sql);
        if (mysqli_num_rows($result) > 0) {
            $email_message = "Email already taken";
        } else {
            $sql = "
                INSERT INTO store_users 
                (email, password, user_type, first_name, last_name, phone, security_question, security_answer) 
                VALUES 
                ('".$_POST['email']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."', 
                'user', '". $_POST['first_name'] . "', '" . $_POST['last_name'] . "', '". $_POST['phone'] . "', 
                '". $_POST['security_question'] . "', '". $_POST['security_answer'] . "');";
            $dbc->query($sql);
            header('Location: login.php');
        }
    }
}
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store - Sign Up</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        h5 {color:red}
    </style>
</head>
<body>
<?php include 'nav.php' ?>
<h1>Sign Up</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <?php if($error) echo "<h5>Please Fill All Boxes</h5>" ?>
    <?php if(isset($email_message)) echo '<h5>' . $email_message . '</h5>' ?>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email"> <br>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name"><br>
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name"><br>
    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone"><br>
    <label for="security_question">Please enter a security question: </label>
    <input type="text" name="security_question" id="security_question"><br>
    <label for="security_answer">Please enter an answer for the above question: </label>
    <input type="text" name="security_answer" id="security_answer"><br>
    <?php if(isset($password_message)) echo '<h5>' . $password_message . '</h5>'; ?>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br>
    <label for="password_confirm">Confirm Password:</label>
    <input type="password" name="password_confirm" id="password_confirm"><br>
    <input type="submit">
</form>
</body>
</html>


