<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ALL);
?>

<head>
    <meta charset="UTF-8">
    <title>Activity 6</title>
</head>
<body>
<h1>Activity 6 - Jan 22, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h2>2D-Array</h2>
<?php
$students = array(
    array("Mike", 22, "Male","900123456"),
    array("Susan", 21, "Female","900222222"),
    array("Jenny", 20, "Female","900333333"),
    array("Josh", 18, "Male","900444444"),
);
for($row = 0; $row < count($students); $row++){
    echo "<p>Student ".($row+1).":<ul>";
    for($col = 0; $col < count($students[$row]); $col++){
        echo "<li>".$students[$row][$col]."</li>";
    }
    echo "</ul></p>";
}
?>

<h3>Display 2D array in a table</h3>
<table border='1' style='width:40%; margin:auto'>
<tr> <td> Name </td> <td> Age </td> <td> Gender </td> <td> ID </td> </tr>
<?php
foreach($students as $student){
    echo "<tr>";
    foreach ($student as $value) {
        echo "<td> $value </td>";
    }
}
?>
</table>

<h3>Array Searching</h3>
<p>Searching through the 2D array to find Jenny</p>
<?php
foreach($students as $student){
    $name = $student[0];
    $expectedName = "Jenny";
    if($name == $expectedName){
        echo "<p>$name $student[1] $student[2] $student[3]</p>";

    }else{
        echo "<p>Not $expectedName ($name)</p>";
    }
}

$students[10] = array("Jason", 22, "Male","900555555");
$students[11] = array("Megan", 18, "Female","900666666");
?>

<p>Searching for the person with the youngest age.</p>
<?php
$ages = array_column($students, 1);
$youngestStudent = $students[array_search(min($ages),$ages)];
$youngestAge = $youngestStudent[1];
$count = 0;
foreach($ages as $age){
    if($age == $youngestAge){
        $count++;
    }
}
echo "The youngest student is: $youngestStudent[0] <br>";
echo "There are $count $youngestAge year olds.";
?>
<br>
<h3>Male Students</h3>
<p>Find all the male students, Display their names, age, and the total number of males.</p>
<?php
$count = 0;
foreach($students as $student){
    if( $student[2] == "Male"){
        $count++;
        echo "<p>$student[0] $student[1] $student[2] $student[3]</p>";
    }
}
echo "There are $count male students.";
?>

<br>
<h3>Female students <= 20</h3>
<p>Find all the female students less than or equal to 20 years of age.</p>
<p>Display their name and age</p>
<?php
$count = 0;
foreach($students as $student){
    if($student[1] <= 20 && $student[2] == "Female"){
        $count++;
        echo "<p>$student[0] $student[1] $student[2] $student[3]</p>";
    }
}
echo "There are $count female students 20 years old or younger.";
?>
</body>
</html>
