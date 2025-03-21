<?php
session_start();
$id = $_SESSION['id'];
$firstname = $_SESSION['firstname'];
?>

<html>
<head>
    <title>Online Test - User Home</title>
</head>
<body>
<?php include "user_nav.php"; ?>
<h1> Hello <?php echo $firstname ?>, Welcome to the Free Online Testing Site</h1>
<p> You will be able to evaluate your Web Dev. Skills using our test bank.</p>

</body>
</html>
