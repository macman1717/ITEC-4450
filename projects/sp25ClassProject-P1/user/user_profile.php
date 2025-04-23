<?php
session_start();
//populate the form using information received from the database
$id = $_SESSION['id'];


include "../connection.php";
$sql = "SELECT * FROM users WHERE id = $id;";
$result = mysqli_query($dbc, $sql);
$numrows = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$phone = $row['phone'];
$gender = $row['gender'];
$level = $row['level'];

?>

<?php
//once user clicked submit button
//check the flag == 0
//update the database


$flag = 0; // 0 when no red flags exist and form ready to insert

$firstNameError=$lastNameError=$emailError=$genderErr=$levelErr=$phoneNumError=$passwordError= "*";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $phone = test_input($_POST["phone"]);
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
    //end of POST if statements
    if($flag == 0){

        $sqs = "UPDATE users
                SET firstname = '$firstname',
                    lastname = '$lastname',
                    phone = '$phone',
                    gender = '$gender',
                    level = '$level'
                WHERE id = $id;";
        mysqli_query($dbc, $sqs);
        $registered = mysqli_affected_rows($dbc);
        mysqli_close($dbc);
        header("Location:user_home.php");
        exit();

    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<html>
<head>
    <title>Online Test - User Update Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include "user_nav.php" ?>
<div class="main-wrapper">
    <div class="container">
<h3>Feel Free to Update Your Personal Information Here</h3>
<h4>Profile Picture:</h4>
<?php
$filename = "upload/$id-profile";
if (file_exists($filename)) {
    echo "<img src='$filename' width='300'>";
} else {
    echo "<p>Profile picture not found, please upload one</p>";
}
?>
<h4>Resume:</h4><?php
$filename = "upload/" . $_SESSION['id'] . "-resume";

if (file_exists($filename)) {
    echo "<embed frameborder='0' type='application/pdf' src='$filename#toolbar=0' width='400' height='500'>";
} else {
    echo "<p>Resume not found. Please upload your resume.</p>";
}
?>
<p>
    If you would like to update your profile picture or resume, click the respective links below
    <br><a href="update_profile_pic.php">Profile Picture</a>
    <br><a href="update_resume.php">Resume</a>
</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    Firstname : <input type= "text" name="firstname" value="<?php echo $firstname; ?>"> <span class="error"> <?php echo "$firstNameError";?> </span><br> <br>
    Lastname : <input type= "text" name="lastname" value="<?php echo $lastname; ?>"> <span class="error"> <?php echo "$lastNameError";?> </span><br> <br>
    Phone Number: <input type="text" name="phone" value="<?php echo $phone; ?>">  <span class="error"> <?php echo "$phoneNumError";?> </span><br> <br>

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
    </div>
</div>
</body>
</html>
