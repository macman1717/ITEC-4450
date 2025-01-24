<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity 2</title>
</head>
<body>
<h1>Activity 2 - Jan 10, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h2>While Loop</h2>
<?php
$x=1;
while($x<=5){
    echo "The value for x is $x<br>";
    $x++;
}
echo "The final value for x after the while loop is $x<br>";

//for loop
echo "<h2>First for loop example</h2>";
for($x=1;$x<=100;$x+=10){
    echo "The value for x is $x<br>";
}
echo "The final value for x after the for loop is $x<br>";

//2nd for loop
echo "<h2>The 2nd for loop example is to calculate 1+2+3...+100</h2>";
$sum=0;
for($x=1;$x<=100;$x++) {
    echo "$x ";
    if($x%20 == 0)
        echo "<br>";
    $sum += $x;
}
echo "<br>The sum of 1+2+3...+100 is $sum<br>";

echo "<h2>Nested looping</h2>";
for($x=1;$x<=5;$x++) {
    for($y=1;$y<=10;$y++) {
        echo "* ";
    }
    echo "<br>";
}

echo "The 2nd nested looping example <br>";

for($x=5;$x>=1;$x--) {
    for($y=$x;$y<=5;$y++) {
        echo "* ";
    }
    echo "<br>";
}

echo "The 3rd nested looping example <br>";
for($row=5;$row<10;$row++) {
    for($x=0;$x<$row;$x++) {
        echo "* ";
    }
    echo "<br>";
}
?>

<hr>
<h2>Function</h2>
<?php
function drawTrapezoid($top, $bottom, $symbol){
    for($row=$top - 1;$row<$bottom;$row++) {
        for($x=0; $x<$row + 1; $x++) {
            echo "$symbol ";
        }
        echo "<br>";
    }

}

drawTrapezoid(3,8,"#");
?>

<h2>Adding Some Style</h2>
<?php
echo "<div style = 'width:50%;margin:auto;background-color:blue;text-align:center;color:red;'>";
drawTrapezoid(1, 10, "&");
echo "</div>";
echo "<hr>";

echo "<div style = 'width:50%;margin:auto;background-color:blue;text-align:center;color:red;line-height:0.8'>";
drawTrapezoid(1, 10, "&");
echo "</div>";
echo "<hr>";

echo "<div style = 'width:50%;margin:auto;background-color:blue;text-align:right;color:red;line-height:0.8'>";
drawTrapezoid(1, 10, "&");
echo "</div>";
echo "<hr>";
?>
</body>
</html>