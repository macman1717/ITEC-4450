<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ALL);
?>

<head>
    <meta charset="UTF-8">
    <title>Activity 5</title>
</head>
<body>
<h1>Activity 5 - Jan 17, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h2>Using Array</h2>
<?php
$cars = array("BMW","Camry","Volkswagen");
//access array through index
echo "After graduation, I want to have a $cars[0] <br>";

//define array by index
$friends[0] = "Mike";
$friends[1] = "Jeff";
$friends[2] = "Susan";
$friends[3] = "Jenny";
$friends[4] = "Josh";

echo "<p>Using looping to display array values</p> ";
for($i = 0; $i < count($friends); $i++){
    echo "Friend number ".($i + 1).": $friends[$i] <br>";
}
echo "<p>Using Enhanced for loop to display array values</p> ";
foreach ($friends as $friend) {
    echo "$friend <br>";
}

echo "<p>Associative array</p>";
//define associative array

$SID["Mike"] = "9001234";
$SID["Jeff"] = "9001235";
$SID["Susan"] = "9001236";
$SID["Jenny"] = "9001237";
$SID["Josh"] = "9001238";

echo "<p>Using looping to display array values</p> ";
foreach ($SID as $key => $value) {
    echo"The student $key, has a student id of $value<br>";
}

echo "<p>Another Associative array</p>";
$salary = array("Mike"=>400,"Jeff"=>700,"Jack"=>2000,"Jenny"=>4000,"Josh"=>250);

echo "<p>Using looping to display array values</p> ";
$sumOfPayments = 0;
foreach ($salary as $key => $value) {
    echo "$key's salary is $value <br>";
    $sumOfPayments += $value;
}
echo "Total budget of salary is $$sumOfPayments <br>";

echo "Find the highest salary from employees is $".max($salary)."<br>";
$topPerson = "";
foreach ($salary as $key => $value) {
    if($value >= max($salary)){
        $topPerson = $key;
    }
}
echo "$topPerson has the highest salary from employees with $".max($salary)."<br>";

$lowestPerson = "";
foreach($salary as $key => $value){
    if($value <= min($salary)){
        $lowestPerson = $key;
    }
}
echo "$lowestPerson is the lowest payed person with a salary of $".min($salary)."<br>";
?>

<hr>
<h2>2D-Array</h2>
<?php
$students = array(
        array("Mike", 22, "Male"),
        array("Susan", 21, "Female"),
        array("Jenny", 20, "Female"),
        array("Josh", 18, "Male")
);
for($row = 0; $row < count($students); $row++){
    echo "<p>Student ".($row+1).":<ul>";
    for($col = 0; $col < count($students[$row]); $col++){
        echo "<li>".$students[$row][$col]."</li>";
    }
    echo "</ul></p>";
}
?>


</body>
</html>
