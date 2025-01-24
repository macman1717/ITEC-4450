<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 1</title>
    <link rel="stylesheet" href="lab1Styles.css">
</head>
<body>

<h1>Lab 1 - Jan 20, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<h2>Part 1: one tree displayed.</h2>
<div id='oneTreeDiv'>
    <?php makeTree(1); ?>
</div>
<hr>

<h2>Part 2: four trees displayed.</h2>
<div class='multiTreeDiv'>
    <?php makeTree(4); ?>
</div>
<hr>

<h2>Part 3: When you refresh the page, different number (from 1-8) of trees displayed.</h2>
<div class='multiTreeDiv' id='randTreeDiv'>
    <?php makeTree(rand(1, 8)); ?>
</div>
<hr>

</body>
</html>

<?php
function makeTree($numOfTrees){
    for ($k = 0; $k < $numOfTrees; $k++) {
        echo "<div>";
        foreach (array(1 => 5,3 => 9,5 => 14) as $upper => $lower){
            for ($i = $upper; $i <= $lower; $i++) {
                echo str_repeat('*', $i) . "<br>";
            }
        }
        echo str_repeat("*****<br>", 5) . "</div>";
    }
}
?>

