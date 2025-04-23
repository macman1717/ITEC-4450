<?php
//ob_start();

include "../connection.php";

$firstname="Firstname";
$lastname="Lastname";
$phone="111-222-3333";
$email = "example@ggc.edu";
$gender = $level = $password1 = $password2 = "";
$flag = 0; // 0 when no red flags exist and form ready to insert

$firstNameError=$lastNameError=$emailError=$genderErr=$levelErr=$phoneNumError=$passwordError= "*";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $password1 = test_input($_POST["password1"]);
    $password2 = test_input($_POST["password2"]);
    if(isset($_POST["gender"])){
        $gender = $_POST["gender"];
    }
    if(isset($_POST["level"])){
        $level = $_POST["level"];
    }


    if($firstname == "Firstname" || $firstname == ""){
        $firstNameError = "First name is required";
        $flag++;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
            $firstNameError = "Only letters and white space allowed.";
            $flag++;
        }
    }

    if($lastname == "Lastname" || $lastname == ""){
        $lastNameError = "Last name is required";
        $flag++;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
            $lastNameError = "Only letters and white space allowed.";
            $flag++;
        }
    }

    if($email == "example@ggc.edu" || $email == ""){
        $emailError = "Email is required";
        $flag++;
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email format";
            $flag++;
        }
    }

    if($password1 == ""){
        $passwordError = "Password is required";
        $flag++;
    }else if($password1 != $password2){
        $passwordError = "Passwords do not match";
        $flag++;
    }
    $password1 = password_hash($password1, PASSWORD_DEFAULT);
    if($phone == "111-222-3333" || $phone == ""){
        $phoneNumError = "Phone number is required";
        $flag++;
    }else{
        if(!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)){
            $phoneNumError = "Only numbers and - allowed";
            $flag++;
        }
    }

    if($gender == ""){
        $genderErr = "Gender is required";
        $flag++;
    }

    if($level == ""){
        $levelErr = "Level is required";
        $flag++;
    }
    $emailInUse = false;
    //end of POST if statements
    if($flag == 0){

        $sqs = 'SELECT * FROM  users  WHERE email = "'.$email.'"';
        $result = mysqli_query($dbc, $sqs);
        $num = mysqli_num_rows($result);

        if($num > 0){
            $emailInUse = true;
        }else {
            $sqs = "INSERT INTO users(firstname, lastname, email, phone, gender, level, password)
                VALUES ('$firstname', '$lastname', '$email', '$phone', '$gender', '$level', '$password1');";
            $dbc->query($sqs);
            header("Location: ../index.php");
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
<div class="main-wrapper">
    <div class="container">
<?php
if(isset($sqs)){
    echo "<h1>".$sqs."</h1>";
}?>

<?php if($emailInUse) echo "<h3>Sorry, an account with $email has already been registered.</h3>"; ?>

<h2>Registration Form</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    Firstname : <input type= "text" name="firstname" value="<?php echo $firstname; ?>"> <span class="error"> <?php echo "$firstNameError";?> </span><br> <br>
    Lastname : <input type= "text" name="lastname" value="<?php echo $lastname; ?>"> <span class="error"> <?php echo "$lastNameError";?> </span><br> <br>
    Phone Number: <input type="text" name="phone" value="<?php echo $phone; ?>">  <span class="error"> <?php echo "$phoneNumError";?> </span><br> <br>
    Email: <input type="text" name="email" value="<?php echo $email; ?>">  <span class="error"> <?php echo "$emailError";?> </span><br> <br>
    Password: <input type="password" name="password1" maxlength="30"> <span class="error"> <?php echo "$passwordError";?> </span><br><br>
    Confirm Password: <input type="password" name="password2" maxlength="30"><span class="error">*</span><br><br>

    Gender: <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?> > Female
    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?> > Male
    <input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo "checked"; ?> > Other
    <span class="error"> <?php echo "$genderErr";?> </span>
    <br> <br>


    The Total number of IT credits you have earned is:  <span class="error"> <?php echo "$levelErr";?> </span> <br>
    <input type="radio" name="level" value="Freshman" <?php if(isset($level) && $level=="Freshman") echo "checked"; ?> > Less than 30 hours <br>
    <input type="radio" name="level" value="Sophomore" <?php if(isset($level) && $level=="Sophomore") echo "checked"; ?> > More than 30 but less than 60 hours <br>
    <input type="radio" name="level" value="Junior" <?php if(isset($level) && $level=="Junior") echo "checked"; ?> > More than 60 but less than 90 hours <br>
    <input type="radio" name="level" value="Senior" <?php if(isset($level) && $level=="Senior") echo "checked"; ?> > More than 90 <br>
    <br> <br>

    <input type="submit">
</form>
<br>
<a href="../index.php">Go Back</a>
    </div>
</div>
</body>
</html>
