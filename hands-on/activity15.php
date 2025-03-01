<html>
<head>
    <title>Activity 15</title>
    <style> .error { color: #FF0000</style>
</head>
<body>
<h1>Activity 15 - Feb 26,2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h1>Open and process file already in the Server</h1>

<?php
$file ="Students-Grades-Info.txt";
$studentStr=file_get_contents($file);
$studentStr=trim($studentStr);
$studentList=explode("\n",$studentStr);
$nFound = 0;
foreach($studentList as $index=>$student){
    $studentInfo[$index]=explode("\t",$student);
}

echo "Display file/2d array as a table";
echo "<table border='1'>";
echo "<tr>";
    echo"<td> No. </td> <td> Name </td> <td> Email </td> <td> Major </td> <td> Grade </td> <td> IP </td>";
    echo "</tr>";
    foreach($studentInfo as $index=>$student){
        echo "<tr>";
        echo "<td>" . ($index + 1) . "</td>";
        foreach($student as $info){
            echo "<td>" . $info . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<hr>";
    echo "<h2> Removing Duplicates</h2>";
    echo "<table border='1'>";
    echo "<tr>";
        echo "<td> No. </td> <td> Name </td> <td> Email </td> <td> Major </td> <td> Grade </td> <td> IP </td>";
    echo "</tr>";

    foreach($studentInfo as $index=>$student){
        $ip=$student[4];
        $repeating=false;
        foreach($studentInfo as $i => $person){
            if($person[4]==$ip && $index>$i){
                $repeating=true;
                break;
            }
            if($index <= $i){
                break;
            }
        }
        if(!$repeating){
            $nFound++;
            echo "<tr>";
            echo "<td>" . $nFound . "</td>";
            foreach($student as $info){
                echo "<td>" . $info . "</td>";
            }
            echo "</tr>";
        }

    }
echo "</table>";

echo "<hr>";
echo "<h2> Removing Duplicate Names</h2>";
echo "<table border='1'>";
echo "<tr>";
echo "<td> No. </td> <td> Name </td> <td> Email </td> <td> Major </td> <td> Grade </td> <td> IP </td>";
echo "</tr>";

$nFound = 0;
foreach($studentInfo as $index=>$student){
    $name=$student[1];
    $repeating=false;
    foreach($studentInfo as $i => $person){
        if($person[1]==$name && $index>$i){
            $repeating=true;
            break;
        }
        if($index <= $i){
            break;
        }
    }
    if(!$repeating){
        $nFound++;
        echo "<tr>";
        echo "<td>" . $nFound . "</td>";
        foreach($student as $info){
            echo "<td>" . $info . "</td>";
        }
        echo "</tr>";
    }

}
echo "</table>";
?>
</body>
</html>
