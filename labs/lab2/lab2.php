<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 2</title>
    <link rel="stylesheet" href="lab2.css">
</head>
<body>

<h1>Lab 2 - Jan 26, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<h2>Lab2 display a multiplication table of random size from 5*5 to 20*20</h2>

<?php
    $limit = rand(5,20);
    echo "<p id='left-aligned-p'>This is a multiplation table of $limit*$limit</p>";
?>

<table>
    <?php
    for($i = 1; $i <= $limit; $i++){
        echo "<tr>";
        for($j = 1; $j <= $limit; $j++) echo "<td>".$i*$j."</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

