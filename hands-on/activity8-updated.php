<?php
ob_start();

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
        echo "Welcome $firstname ";
    }

    if($lastname == "Lastname" || $lastname == ""){
        $lastNameError = "Last name is required";
        $flag++;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$firstname)){
            $lastNameError = "Only letters and white space allowed.";
            $flag++;
        }
        echo "$lastname <br>";
    }

    if($email == "example@ggc.edu" || $email == ""){
        $emailError = "Email is required";
        $flag++;
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email format";
            $flag++;
        }
        echo "Your Email is $email <br>";
    }

    if($password1 == ""){
        $passwordError = "Password is required";
        $flag++;
    }else if($password1 != $password2){
        $passwordError = "Passwords do not match";
        $flag++;
    }

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
        include "connection.php";
        $sqs = 'SELECT * FROM  users  WHERE email = "'.$email.'"';
        $qresult = mysqli_query($dbc, $sqs);
        $num = mysqli_num_rows($qresult);

        //add logic for checking if duplicate phone num

        if($num > 0){
            $emailInUse = true;
        }else {
            $sqs = "INSERT INTO users(firstname, lastname, email, phone, gender, level, password)
                VALUES ('$firstname', '$lastname', '$email', '$phone', '$gender', '$level', '$password1');";
            mysqli_query($dbc, $sqs);
            $registered = mysqli_affected_rows($dbc);
            mysqli_close($dbc);
            header("Location:register_success.php");
            exit();
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
    <link rel="stylesheet" href="hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 8 - updated</title>
</head>
<body>
<h1>Activity 8 - updated Jan 31, 2025</h1>
<p>Submitted by Connor Griffin</p>
<h2>Major Updates</h2>
<ul>
    <li>Create database and table in phpmyadmin</li>
    <li>add password field</li>
    <li>create connection.php</li>
    <li>insert form information into database table</li>
</ul>
<hr>

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
    <input type="radio" name="level" value="A" <?php if(isset($level) && $level=="A") echo "checked"; ?> > Less than 30 hours <br>
    <input type="radio" name="level" value="B" <?php if(isset($level) && $level=="B") echo "checked"; ?> > More than 30 but less than 60 hours <br>
    <input type="radio" name="level" value="C" <?php if(isset($level) && $level=="C") echo "checked"; ?> > More than 60 but less than 90 hours <br>
    <input type="radio" name="level" value="D" <?php if(isset($level) && $level=="D") echo "checked"; ?> > More than 90 <br>
    <br> <br>

    <input type="submit">
</form>
<hr>
<h3>Testing Area: For Developer Only</h3>
<?php

echo "Data collected from the form: <br>";
echo "First name: $firstname <br>";
echo "Last name: $lastname <br>";
echo "Phone num: $phone <br>";
echo "Email: $email <br>";
echo "Gender: $gender <br>";
echo "Level: $level <br>";
echo "Password1: $password1 <br>";
echo "Password2: $password2 <br>";
echo "# of red flags: $flag <br>";

?>
</body>
</html>
