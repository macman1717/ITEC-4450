<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ALL);
?>
<head>
    <link rel="stylesheet" href="lab3.css">
    <meta charset="UTF-8">
    <title>Lab 3</title>
</head>
<body>
<h1>Lab 3 - Jan 30, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<?php
    for($i = 0; $i < 10; $i++) $img_url[$i] = "checkmark.png";
    $form_submitted = false;

$answer_key = [
    ["q1", "c"], ["q2", "b"], ["q3", "a"],
    ["q4", "b"], ["q5", "c"], ["q6", "a"],
    ["q7", "a"], ["q8", "d"], ["q9", "a"],
    ["q10", "d"]
];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_submitted = true;
    $img_url[0] = "checkmark.png";

    $submitted_answers = [
        $_POST["q1"], $_POST["q2"], $_POST["q3"],
        $_POST["q4"], $_POST["q5"], $_POST["q6"],
        $_POST["q7"], $_POST["q8"], $_POST["q9"],
        $_POST["q10"]
    ];

    for($i = 0; $i < count($submitted_answers); $i++) {
        if($submitted_answers[$i] == $answer_key[$i][1]) {
            $img_url[$i] = "checkmark.png";
        }else{
            $img_url[$i] = "xmark.jpg";
        }
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

    <div class="question">
        <h3>Question #1 - PHP server scripts are surrounded by delimiters, which?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[0].">";} ?>
    </div>
    <br>
    <input type="radio" name="q1" value="a"> &lt;?php> ... &lt;/?> <br>
    <input type="radio" name="q1" value="b"> &lt;&> ... &lt;/&> <br>
    <input type="radio" name="q1" value="c"> &lt;?php ... &lt;?> <br>
    <input type="radio" name="q1" value="d"> &lt;script> ... &lt;script> <br>

    <div class="question">
        <h3>Question #2 - All variable in PHP start with which symbol?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[1].">";} ?>
    </div>
    <br>
    <input type="radio" name="q2" value="a"> & <br>
    <input type="radio" name="q2" value="b"> $ <br>
    <input type="radio" name="q2" value="c"> ! <br>

    <div class="question">
        <h3>Question #3 - How do you get information from a form that is submitted using the "get" method?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[2].">";} ?>
    </div>
    <br>
    <input type="radio" name="q3" value="a"> $_GET[] <br>
    <input type="radio" name="q3" value="b"> Request.form; <br>
    <input type="radio" name="q3" value="c"> Request.QueryString; <br>

    <div class="question">
        <h3>Question #4 - When using the POST method, variables are displayed in the URL:</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[3].">";} ?>
    </div>
    <br>
    <input type="radio" name="q4" value="a"> True <br>
    <input type="radio" name="q4" value="b"> False <br>

    <div class="question">
        <h3>Question #5 - What is the correct way to create a function in PHP?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[4].">";} ?>
    </div>
    <br>
    <input type="radio" name="q5" value="a"> create myFunction() <br>
    <input type="radio" name="q5" value="b"> new_function myFunction() <br>
    <input type="radio" name="q5" value="c"> function myFunction() <br>

    <div class="question">
        <h3>Question #6 - What is the correct way to open the file "time.txt" as readable?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[5].">";} ?>
    </div>
    <br>
    <input type="radio" name="q6" value="a"> fopen("time.txt","r"); <br>
    <input type="radio" name="q6" value="b"> open("time.txt","read"); <br>
    <input type="radio" name="q6" value="c"> open("time.txt"); <br>
    <input type="radio" name="q6" value="d"> fopen("time.txt","r+"); <br>

    <div class="question">
        <h3>Question #7 - PHP allows you to send emails directly from a script</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[6].">";} ?>
    </div>
    <br>
    <input type="radio" name="q7" value="a"> True <br>
    <input type="radio" name="q7" value="b"> False <br>

    <div class="question">
        <h3>Question #8 - What is the correct way to add 1 to the $count variable?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[7].">";} ?>
    </div>
    <br>
    <input type="radio" name="q8" value="a"> $count =+1 <br>
    <input type="radio" name="q8" value="b"> ++count <br>
    <input type="radio" name="q8" value="c"> count++; <br>
    <input type="radio" name="q8" value="d"> $count++; <br>

    <div class="question">
        <h3>Question #9 - The die() and exit() functions do the exact same thing.</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[8].">";} ?>
    </div>
    <br>
    <input type="radio" name="q9" value="a"> True <br>
    <input type="radio" name="q9" value="b"> False <br>

    <div class="question">
        <h3>Question #10 - Which operator is used to check if two values are equal and of same data type?</h3>
        <?php if($form_submitted){ echo "<img src=".$img_url[9].">";} ?>
    </div>
    <br>
    <input type="radio" name="q10" value="a"> == <br>
    <input type="radio" name="q10" value="b"> = <br>
    <input type="radio" name="q10" value="c"> != <br>
    <input type="radio" name="q10" value="d"> === <br>


    <br>
    <input type="submit">
</form>
</body>
</html>

<?php

?>