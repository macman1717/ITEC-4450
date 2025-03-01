<html>
<head>
    <title>Activity 16</title>
    <style> .error { color: #FF0000</style>
</head>
<body>
<h1>Activity 16 - Feb 28,2025</h1>
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

echo "<h3>Progress Bar with student major</h3>";
$allMajor=array("Digital Media","Security","Business","Software","Other");
$allFound=array(0,0,0,0,0);
foreach($allMajor as $index=>$major){
    foreach($studentInfo as $student){
        if($major==$student[2])
            $allFound[$index]++;
    }
}

echo "<table>";
echo "<tr>";
echo "<td>Major</td> <td> No. of Students</td> <td> Percentage </td> <td> Bar </td>";
echo "</tr>";
foreach($allMajor as $index=>$major){
    $p=$allFound[$index]/count($studentInfo) * 100;
    $p=round($p,2);

    echo "<tr>";
    echo "<td>".$major."</td>";
    echo "<td>".$allFound[$index]."</td>";
    echo "<td>".$p."%</td>";
    echo "<td> <progress max='100' min='0' value='".$p."'></progress></td>";
    echo "</tr>";
}
echo "</table>";

echo "<hr>";
echo "<h2> Removing Duplicates By IP and save the clean copy in a new file</h2>";
$myfile1 = fopen("newfile1.txt", "w") or die ("Unable to open file!");


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
        fwrite($myfile1, $nFound);
        fwrite($myfile1, ",");
        foreach($student as $ind => $info){
            echo "<td>" . $info . "</td>";
            fwrite($myfile1, $info);
            if($ind < 4)
                fwrite($myfile1, ",");
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
    $name=$student[0];
    $repeating=false;
    foreach($studentInfo as $i => $person){
        if($person[0]==$name && $index>$i){
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

<hr>
<h2>Removing Duplicate Names</h2>
<h3>Create a clean copy without duplicate names</h3>
<h3>Display student information about grade.</h3>
<h3>DIpslay a progress bar with students in A, B, C, D or lower</h3>

<?php

//write to file with unique names only
$myfile2 = fopen("newfile2.txt","w") or die("Unable to open file!");
$uniqueNames = array();
foreach($studentInfo as $student){
    if(!isset($uniqueNames[$student[0]])){
        $uniqueNames[$student[0]] = $student;
        fwrite($myfile2, count($uniqueNames) . ",");
        foreach($student as $ind => $info){
            fwrite($myfile2, $info);
            if($ind < 4)
                fwrite($myfile2, ",");
        }
    }
}

//generate table with grade percentage breakdown
?>
<table border="1">
    <tr>
        <td>Grade</td> <td>No. of Students</td> <td> Percentage </td> <td> Bar </td>
    </tr>
    <?php
    $grades = [ "A" => 0, "B" => 0, "C" => 0, "D" => 0];
    foreach($uniqueNames as $student){
        $points = intval($student[4]);
        switch($points){
            case $points >= 90: $grades["A"]++; break;
            case $points >= 80: $grades["B"]++; break;
            case $points >= 70: $grades["C"]++; break;
            default: $grades["D"]++; break;
        }
    }
    foreach($grades as $grade => $count){
        $rounded_percent = round($count / count($uniqueNames) * 100,2);
        echo "<tr>";
        echo "<td>" . $grade . "</td>";
        echo "<td>" . $count. "</td>";
        echo "<td>" . $rounded_percent . " %</td>";
        echo "<td> <progress max='100' min='0' value='".round($rounded_percent)."'></progress></td>";
    }
    ?>
</table>



</body>
</html>

