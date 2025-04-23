<?php
session_start();
$id = $_SESSION['id'];
$firstname = $_SESSION['firstname'];
?>

<html>
<head>
    <title>Online Test - User Home</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>

<?php include "user_nav.php"; ?>
<div class="main-wrapper">
    <div class="container">
        <h1> Hello <?php echo $firstname ?>, Welcome to the Free Online Testing Site</h1>
        <p> You will be able to evaluate your Web Dev. Skills using our test bank.</p>
    </div>
</div>
</body>
</html>
