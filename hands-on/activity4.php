<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ALL);
?>

<head>
    <meta charset="UTF-8">
    <title>Activity 4</title>
</head>
<body>
<h1>Activity 3 - Jan 15, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h2>Variable Scope</h2>
<?php
//gloval variable
$x=10;
echo "The value of my global variable x is $x <br>";

function myFunction(){
    //access the global variable inside a function
    echo "The value of my global variable x inside a function $x <br>";
    echo "will generate a warning message <br>";

    global $x; //to specify we are accessing the global variable
    echo "Access global variable x after we specified, and the value is $x <br>";

    //local variable
    $y=20;
    echo "The value of the local variable inside myFucntion() is $y <br>";
}

myFunction();
echo "Access the local variable y outside the function $y <br>";
echo "will generate a warning message <br>";
?>
<hr>
<h2>Using Loop to Build Tables</h2>
<h3>Table 1</h3>
<?php
echo "You can access global variable from another section of the php. <br>";
echo "The value for variable x is $x <br>";
$rowSize=8;
$colSize=8;
$alternate = 0;
echo "<table border='1' style='width:20%;margin:auto'><tr>";

for($i=1;$i<=$rowSize;$i++){
    echo "<tr>";
    for($j=0;$j<=$colSize;$j++){
        if($i % 2 == 0){
            if($j % 2 == 0){
                echo "<td style='background-color:black;'>";
            }else{
                echo "<td style='background-color:white;'>";
            }
        }else{
            if($j % 2 == 0){
                echo "<td style='background-color:white;'>";
            }else{
                echo "<td style='background-color:black;'>";
            }
        }
        echo "$j";
        echo "</td>";
    }
    echo"</tr>";
}

echo "</table>";

echo "<h3>Table 2</h3>";
echo "<table border='1' style='width:20%;margin:auto'><tr>";

for($i=1;$i<=$rowSize;$i++){
    echo "<tr>";
    for($j=0;$j<=$colSize;$j++){
        if($i % 2 == 0){
            if($j % 2 == 0){
                echo "<td style='background-color:white;'>";
            }else{
                echo "<td style='background-color:black;'>";
            }
        }else{
            if($j % 2 == 0){
                echo "<td style='background-color:black;'>";
            }else{
                echo "<td style='background-color:white;'>";
            }
        }
        echo "$j";
        echo "</td>";
    }
    echo"</tr>";
}

echo "</table>";

?>
<hr>
<h3>Table 3</h3>
<?php

$rowSize=18;
$colSize=18;
$counter=0;

echo "<table border='1' style='width:40%;margin:auto'><tr>";

for($i=1;$i<=$rowSize;$i++){
    echo "<tr>";
    for($j=0;$j<=$colSize;$j++){
        switch ($counter % 3){
            case 0: echo "<td style='background-color:red;'>";break;
            case 1: echo "<td style='background-color:green;'>";break;
            case 2: echo "<td style='background-color:blue;'>";break;
        }
        $counter++;
        echo "&nbsp;";
        echo "</td>";
    }
    echo"</tr>";
}

echo "</table>";

echo "<h3>Table 4</h3>";
echo "<table border='1' style='width:40%;margin:auto'><tr>";
$counter = 0;
for($i=1;$i<=$rowSize;$i++){
    echo "<tr>";
    for($j=0;$j<=$colSize;$j++){
        switch ($counter % 4){
            case 0: echo "<td style='background-color:red;'>";break;
            case 1: echo "<td style='background-color:green;'>";break;
            case 2: echo "<td style='background-color:blue;'>";break;
            case 3: echo "<td style='background-color:yellow;'>";break;
        }
        $counter++;
        echo "&nbsp;";
        echo "</td>";
    }
    echo"</tr>";
}

echo "</table>";

echo "<h3>Table 5: any number of colors</h3>";

$myColor=array("red","green","blue","yellow","cyan","pink");
$n=sizeof($myColor); // num of colors
echo "<table border='1' style='width:40%;margin:auto'><tr>";
$counter = 0;
for($i=1;$i<=$rowSize;$i++){
    echo "<tr>";
    for($j=0;$j<=$colSize;$j++){
        echo "<td style='background-color:".$myColor[$counter % $n].";'>";
        $counter++;
        echo "&nbsp;";
        echo "</td>";
    }
    echo"</tr>";
}

echo "</table>";

?>
</body>
</html>
