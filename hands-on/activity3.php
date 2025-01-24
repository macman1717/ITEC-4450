<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity3</title>
</head>
<body>
<h1>Activity 3 - Jan 13, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h2>Functions Defined in a Different file</h2>
<h3>Example1: Creating a table</h3>
<?php
include "library01.php";

echo "<table style='background-color:blue;color:blue;width:50%;margin:auto;'>";
    echo "<tr>";
        echo "<td>";
            echo "<div style = 'width:50%;margin:auto;background-color:blue;text-align:center;color:red;'>";
            drawTrapezoid(1,10,"*");
            echo "</div>";
        echo "</td>";
        echo "<td>";
            echo "<div style = 'width:50%;margin:auto;background-color:blue;text-align:center;color:red;'>";
            drawTrapezoid(1,10,"*");
            echo "</div>";
        echo "</td>";
    echo "</tr>";
echo "</table>";

?>

<h3>Example 2: Show Messages</h3>
<?php
showMessage();
echo "Show Message with Looping <br>";
for($i=0;$i<20;$i++) {
    echo "<span style='font-size: ".($i*2+10)."px; color: rgba(".($i*10).", 0, 0,1);'>";
    echo "Message" . ($i + 1) . ":";
    showMessage();
    echo "</span>";
}
?>

<h3>Example3: Display Image</h3>
<?php
//display image based on temperature
$t= rand (10,100);
echo "The temperature today is $t <br>";
if($t < 40){
    showImage("Freezing");
}elseif($t < 55){
    showImage("Cold");
}elseif($t < 80){
    showImage("Warming");
}else{
    showImage("Hot");
}
?>
</body>