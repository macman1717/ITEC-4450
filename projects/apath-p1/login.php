<?php
include "FormInputCreator.php";
include "connection.php";
$email = $password = $type = "";
$ErrorMessage = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email == "" || $password == ""){
        $ErrorMessage = "Please fill in all the fields";
    }else{
        $sql = "SELECT * FROM apath_users WHERE email = '$email' AND pw = '$password'";
        $result = mysqli_query($dbc, $sql);
        $numOfRows = mysqli_num_rows($result);
        if($numOfRows == 1){
            $row = mysqli_fetch_array($result);
            $email = $row["email"];
            $password = $row["pw"];
            $type = $row["type"];
            session_start();
            $_SESSION["id"] = $row["id"];
            switch($type){
                case 0: header("Location:admin/admin-profile.php"); break;
                case 1: header("Location:volunteer/"); break;
                case 2: header("Location:student/"); break;
            }
        } else{
            $ErrorMessage = "Invalid email or password";
        }
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Login</title>
</head>
<body>
<?php include 'nav.php'; ?>

<main>


    <div>
        <h2>
            <?php
            echo "$ErrorMessage";
            ?>
        </h2>
        <p>Sign in with your email you used during registration.
        </p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <?php
            makeTextInputField("Email","email",true);
            makeTextInputField("Password","password",true);
            ?>

            <span><input class="radio-btn" type="checkbox" value="1" name="volunteer">Remember me <a href="">Forgot Password?</a></span>

            <input class="submit-btn" type="submit" value="Login">
        </form>
        <p>
            No Account? <a href="sign-up.php">Create One</a>
        </p>

    </div>

</main>
<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>
