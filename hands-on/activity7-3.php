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
<h1>Activity 7 - Jan 24, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<h2>Form Example 3 - Using post method, trigger self</h2>

<?php
$nameError = "";
$commentError = "";
$emailError = "";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $comment = test_input($_POST["comment"]);

    if($name == ""){
        $nameError = "Name is required";
    }else{
        echo "Welcome $name <br>";
    }

    if($email == ""){
        $emailError = "Email is required";
    }else{
        echo "Your Email is $email <br>";
    }

    if($comment == ""){
        $commentError = "Comment is required";
    }else{
        echo "Your Comment is $comment <br>";
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

    Gender: <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Other"> Other
    <br> <br>

    Quiz <br>
    1. What is the result of 45 + 65?
    <input type="radio" name="Q1" value="100"> 100
    <input type="radio" name="Q1" value="110"> 110
    <input type="radio" name="Q1" value="120"> 120
    <br> <br>

    <input type="submit">
</form>
</body>
</html>
