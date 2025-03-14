<?php
    $phone=$email="";
    include "library01.php";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $phone = test_input($_POST["phone"]);
        $email = test_input($_POST["email"]);
        $message = $phone . "\r\n" . test_input($_POST["message"]);
        $email_to = $email;
        $subject = "Contact Info";
        mail($email_to, $subject, $message);
        echo "The email message is: " . $message . "<br>";
    }
?>

<html>
<head>
    <title>Activity 18b</title>
    <style>.error{color: red;}</style>
</head>
<body>
<p>Submitted by Connor Griffin</p>
<hr>
<h1>How to Use PHP Mail Function</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br>
    Email: <input type="text" name="email" value="<?php echo $email; ?>"><br><br>
    Message: <br><textarea rows="20" cols="30" name="message"></textarea><br><br>
    <input type="submit" name="submit" value="SEND">
</form>
</body>
</html>
