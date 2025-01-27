<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ALL);
?>
<head>
    <link rel="stylesheet" href="hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 7</title>
</head>
<body>
<h1>Activity 7 - Jan 24, 2025, Updated on Jan 27th</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<h2>Form Example 3 - Using post method, trigger self</h2>

<?php
$name="Firstname Lastname";
$email = "example@ggc.edu";
$comment = $gender = $Q1 = $time = "";

$nameError = "*";
$commentError = "*";
$emailError = "*";
$timeError = "*";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $comment = test_input($_POST["comment"]);
    $gender = $_POST["gender"];
    $Q1 = $_POST["Q1"];
    $time = $_POST["time"];

    if($name == "Firstname Lastname"){
        $nameError = "Name is required";
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $nameError = "Only letters and white space allowed.";
        }
        echo "Welcome $name <br>";
    }

    if($email == "example@ggc.edu"){
        $emailError = "Email is required";
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email format";
        }
        echo "Your Email is $email <br>";
    }

    if($comment == ""){
        $commentError = "Comment is required";
    }else{
        echo "Your Comment is $comment <br>";
    }

    if($time == "---"){
        $timeError = "Time is required";
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    Name : <input type= "text" name="name" value="<?php echo $name; ?>"> <span class="error"> <?php echo "$nameError";?> </span><br> <br>
    Email: <input type="text" name="email" value="<?php echo $email; ?>">  <span class="error"> <?php echo "$emailError";?> </span><br> <br>
    Comment: <textarea name="comment" cols="40" rows="5"><?php echo $comment; ?></textarea>  <span class="error"> <?php echo "$commentError";?> </span> <br> <br>

    Gender: <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?> > Female
    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?> > Male
    <input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo "checked"; ?> > Other
    <br> <br>

    Quiz <br>
    1. What is the result of 45 + 65?
    <input type="radio" name="Q1" value="100" <?php if($Q1=="100") echo "checked"; ?> > 100
    <input type="radio" name="Q1" value="110" <?php if($Q1=="110") echo "checked"; ?> > 110
    <input type="radio" name="Q1" value="120" <?php if($Q1=="120") echo "checked"; ?> > 120
    <br> <br>

    Select your preferred time: <span class="error"> <?php echo "$timeError";?> </span>
    <select name="time" >
        <option value="---"> --- </option>
        <option value="AM" <?php if($time=="AM") echo "selected"; ?> >MWF 9am - 11am</option>
        <option value="PM" <?php if($time=="PM") echo "selected"; ?> >TuTh 2pm - 4pm</option>
        <option value="EV" <?php if($time=="EV") echo "selected"; ?> >M-F 6pm - 7pm</option>
    </select>
    <br><br>

    <input type="submit">
</form>
<hr>
<h3>Testing Area: For Developer Only</h3>
<?php
echo "Data collected from the form: <br>";
echo "Name: $name <br>";
echo "Email: $email <br>";
echo "Gender: $gender <br>";
echo "Comment: $comment <br>";
echo "Q1: $Q1 <br>";
echo "Time: $time <br>";
?>
</body>
</html>
