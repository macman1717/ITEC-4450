<?php
include "FormInputCreator.php";
include "connection.php";
$email = $password = $type = $confirm_password = $errorMessage = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if(isset($_POST['type']))
        $type = $_POST["type"];
    if($email == "" || $password == "" || $confirm_password == "" || $type == ""){
        $errorMessage = "Please fill all the fields and select an option. <br>";
    }
    if($password != $confirm_password){
        $errorMessage = $errorMessage . "Passwords do not match. <br>";
    }
    $sql = "SELECT * FROM apath_users WHERE email = '$email'";
    $result = mysqli_query($dbc, $sql);
    if(mysqli_num_rows($result) > 0){
        $errorMessage = $errorMessage . "Email already exists. <br>";
    }
    if($errorMessage == ""){
        $sql = "INSERT INTO apath_users (email, pw, type) VALUES ('$email', '$password', $type)";
        $result = mysqli_query($dbc, $sql);
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Sign Up</title>
</head>
<body>
<?php include 'nav.php'; ?>

<main>
    <div>
        <h1>
            <?php
            echo $errorMessage;
            ?>
        </h1>
        <p>We are going to communicate with you using email often <br>
            Please create your new account with your most frequently used email.
        </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

        <?php
        makeTextInputField("Email","email",true);
        makeTextInputField("Password","password",true);
        makeTextInputField("Confirm Password","confirm_password",true);
        ?>



        <span><input class="radio-btn" type="radio" value="1" name="type" <?php if($type == 1) echo "checked"; ?>>I am signing up as a volunteer<br></span>
        <span><input class="radio-btn" type="radio" value="2" name="type" <?php if($type == 2) echo "checked"; ?>>I am traveling to GA Tech and signing up for help<br></span>

        <input class="submit-btn" type="submit" value="Create Account">
    </form>
    <p>
        Already have an account? <a href="login.php">Login</a>
    </p>

    </div>

</main>
<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>
