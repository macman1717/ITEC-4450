<?php
function drawTrapezoid($top, $bottom, $symbol){
    for($row=$top - 1;$row<$bottom;$row++) {
        for($x=0; $x<$row + 1; $x++) {
            echo "$symbol ";
        }
        echo "<br>";
    }
}

function showMessage(){
    echo "Hello World!";
    echo "<br>";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function showImage($imageKey){
    echo "It is $imageKey! <br>";
    switch($imageKey){
        case "Freezing": $image = "activity3Images/freezing.jpg"; break;
        case "Cold": $image = "activity3Images/cold.jpg"; break;
        case "Warming": $image = "activity3Images/warming.jpg"; break;
        case "Hot": $image = "activity3Images/hot.jpg"; break;
    }
    echo "<img src=\"$image\" style='width:30em;height:auto;'>";
}
?>