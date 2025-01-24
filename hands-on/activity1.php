<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity 1</title>
</head>
<body>
<h1>Activity 1 - Jan 8, 2025</h1>
<hr>
<?php
echo "<span style='color:red;'> My first php activity.   </span>";
?>

<h2>Some additional PHP code</h2>
<?php
//this is a single line comment
$school="GGC";
echo "I like " . $school . "! <br>";
  /*
  This is a
  Block comment.
  */

//about numbers
$n=1234.5678;
echo "This number is ". $n . "<br>";
printf("The number in float is : %f <br>", $n);
printf("The number in float with 2 digit decimal is : %.2f <br>", $n);
?>

<h2> If-Else </h2>
<?php
$t=date("H"); //return time in 24h format
echo "The current time is " . $t . "<br>";

if($t<10){
    echo "Have a good morning! <br>";
}elseif($t<20){
    echo "Have a good day! <br>";
}else{
    echo "Good night! <br>";
}

?>
<p>Submitted by Connor Griffin</p>
</body>
</html>