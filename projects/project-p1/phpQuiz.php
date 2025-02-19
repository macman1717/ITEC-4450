<?php
error_reporting(E_ALL);

include "user_nav.php";

$Q1Msg=$Q2Msg=$Q3Msg=$Q4Msg=$Q5Msg="";
$Q1=$Q2=$Q3=$Q4=$Q5="";

$flag=0; // no red flag
$quizScore=0;

//when user clicked submit button
if($_SERVER["REQUEST_METHOD"]=="POST"){


    // Q1
    if(empty($_POST["Q1"])){
        $Q1Msg = "Please answer this question.";
        $flag=1;
    }
    else{
        $Q1=test_input($_POST["Q1"]);
        if($Q1=="B"){
            $Q1Msg = "Good job!";
            $quizScore++;
        } else {
            $Q1Msg = "Sorry, not Correct.";
        }
    }

    // Q2
    if(empty($_POST["Q2"])){
        $Q2Msg = "Please answer this question.";
        $flag=1;
    }
    else{
        $Q2=test_input($_POST["Q2"]);
        if($Q2=="B"){
            $Q2Msg = "Good job!";
            $quizScore++;
        } else {
            $Q2Msg = "Sorry, not Correct.";
        }
    }

    // Q3
    if(empty($_POST["Q3"])){
        $Q3Msg = "Please answer this question.";
        $flag=1;
    }
    else{
        $Q3=test_input($_POST["Q3"]);
        if($Q3=="C"){
            $Q3Msg = "Good job!";
            $quizScore++;
        } else {
            $Q3Msg = "Sorry, not Correct.";
        }
    }

    // Q4
    if(empty($_POST["Q4"])){
        $Q4Msg = "Please answer this question.";
        $flag=1;
    }
    else{
        $Q4=test_input($_POST["Q4"]);
        if($Q4=="F"){
            $Q4Msg = "Good job!";
            $quizScore++;
        } else {
            $Q4Msg = "Sorry, not Correct.";
        }
    }

    // Q5
    if(empty($_POST["Q5"])){
        $Q5Msg = "Please answer this question.";
        $flag=1;
    } else{
        $Q5=test_input($_POST["Q5"]);
        if($Q5=="B"){
            $Q5Msg = "Good job!";
            $quizScore++;
        } else {
            $Q5Msg = "Sorry, not Correct.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quiz</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>

<h1>PHP Questions</h1>
<h3>This quiz will help you evaluate your PHP skills</h3>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    1. What does PHP stands for ? <span class="error"> * <?php echo $Q1Msg; ?> </span> <br>
    <input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="A") echo "checked" ; ?> value="A" > Private Home page
    <input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="B") echo "checked" ; ?> value="B" > Personal Hypertext Processor
    <input type="radio" name="Q1" <?php if(isset($Q1)&&$Q1=="C") echo "checked" ; ?> value="C" > PHP Hypertext Processor
    <br> <br>

    2. How would you write "Hello Word" in PHP? <span class="error"> * <?php echo $Q2Msg; ?> </span> <br>
    <input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="A") echo "checked" ; ?> value="A" > echo "Hello World";
    <input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="B") echo "checked" ; ?> value="B" > print "Hello Word";
    <input type="radio" name="Q2" <?php if(isset($Q2)&&$Q2=="C") echo "checked" ; ?> value="C" > Document.Write("Hello World");
    <br> <br>

    3. PHP Syntax is most similar to :<span class="error"> * <?php echo $Q3Msg; ?> </span> <br>
    <input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="A") echo "checked" ; ?> value="A" > C#
    <input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="B") echo "checked" ; ?> value="B" > Java
    <input type="radio" name="Q3" <?php if(isset($Q3)&&$Q3=="C") echo "checked" ; ?> value="C" > JavaScript
    <br> <br>

    4. When using POST method in PHP, variable are displayed in the URL <span class="error"> * <?php echo $Q4Msg; ?> </span> <br>
    <input type="radio" name="Q4" <?php if(isset($Q4)&&$Q4=="T") echo "checked" ; ?> value="T" > True
    <input type="radio" name="Q4" <?php if(isset($Q4)&&$Q4=="F") echo "checked" ; ?> value="F" > False
    <br> <br>

    5. What is the correct way to end a php statement <span class="error"> * <?php echo $Q5Msg; ?> </span> <br>
    <input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="A") echo "checked" ; ?> value="A" > ;
    <input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="B") echo "checked" ; ?> value="B" > .
    <input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="C") echo "checked" ; ?> value="C" > ,
    <input type="radio" name="Q5" <?php if(isset($Q5)&&$Q5=="D") echo "checked" ; ?> value="D" > php
    <br> <br>

    <input type="Submit">

</form>
</body>
</html>

<?php

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

