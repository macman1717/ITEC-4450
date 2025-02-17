<?php
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $errors = [
        "airport" => "Please select if you need airport pickup.",
        "hasFlightInfo" => "Please indicate whether you have flight information.",
        "arrivalFlightNum" => "Arrival flight number is required.",
        "arrivalAirline" => "Please provide the name of the arriving airline.",
        "arrivalDate" => "Arrival date cannot be blank.",
        "arrivalTime" => "Arrival time cannot be blank.",
        "leaveFlightNum" => "Departure flight number is required.",
        "leaveAirline" => "Please provide the name of the departing airline.",
        "leaveDate" => "Departure date cannot be blank.",
        "leaveTime" => "Departure time cannot be blank.",
        "bigPiece" => "Please specify how many big luggage pieces you have.",
        "smallPiece" => "Please specify how many small luggage pieces you have."
    ];

    $fields = [
        "airport",
        "hasFlightInfo",
        "arrivalFlightNum",
        "arrivalAirline",
        "arrivalDate",
        "arrivalTime",
        "leaveFlightNum",
        "leaveAirline",
        "leaveDate",
        "leaveTime",
        "bigPiece",
        "smallPiece"
    ];


    $post_data = [];

    foreach($fields as $field){
        $_POST[$field] = clean($_POST[$field]);
        if(isset($_POST[$field])){
            if(!$_POST[$field] == ""){
                $post_data[$field] = $_POST[$field];
                unset($errors[$field]);
            }
        }
    }

    if(isset($post_data['arrivalDate'])){
        if(!preg_match("/^\d{2}-\d{2}-\d{4}$/", $post_data['arrivalDate'])){
            $errors["arrivalDate"] = "Please enter a valid date for arrival date (format is MM-DD-YYYY)";
        }
    }
    if(isset($post_data['leaveDate'])){
        if(!preg_match("/^\d{2}-\d{2}-\d{4}$/", $post_data['leaveDate'])){
            $errors['leaveDate'] = "Please enter a valid date for departure date (format is MM-DD-YYYY)";
        }
    }
    if(isset($post_data['arrivalTime'])){
        if(!preg_match("/^\d{2}:\d{2}$/", $post_data['arrivalTime'])){
            $errors['arrivalTime'] = "Please enter a valid time for arrival time (format is HH:MM)";
        }
    }
    if(isset($post_data['leaveTime'])){
        if(!preg_match("/^\d{2}:\d{2}$/", $post_data['leaveTime'])){
            $errors['leaveTime'] = "Please enter a valid time for departure time (format is HH:MM)";
        }
    }
    if(isset($post_data['bigPiece'])){
        if(!preg_match("/^\d+$/", $post_data['bigPiece'])){
            $errors['bigPiece'] = "Please only enter a whole number for big piece(s) of luggage (example '3')";
        }
    }
    if(isset($post_data['smallPiece'])){
        if(!preg_match("/^\d+$/", $post_data['smallPiece'])){
            $errors['smallPiece'] = "Please only enter a whole number for small piece(s) of luggage (example '3')";
        }
    }

    if(empty($errors)){
        submitAlertAndRedirect();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="lab7.css">
    <meta charset="UTF-8">
    <title>Lab 7 - Flight Information</title>
</head>
<body>
<?php
include 'nav.php';
include 'FormInputCreator.php';

if(count($errors) > 0){
    echo '<div class="errors"><ul>';
    foreach($errors as $error){
        echo '<li>'.$error.'</li>';
    }
    echo "</div></ul>";
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> ">
    <?php
    makeRadioInputField("Do you need airport pickup?", "airport", "Yes","No", true);
    echo "<br>";
    makeRadioInputField("Do you have the flight information?", "hasFlightInfo", "Yes","No", true);

    makeTextInputField("If yes, arriving Atlanta - flight Number","arrivalFlightNum",true);
    makeTextInputField("Arriving Atlanta - Airline Name","arrivalAirline",true);
    makeTextInputField("Arriving Atlanta - Date","arrivalDate",true);
    makeTextInputField("Arriving Atlanta - Time","arrivalTime",true);

    makeTextInputField("Leaving - Flight Number","leaveFlightNum",true);
    makeTextInputField("Leaving - Airline Name","leaveAirline",true);
    makeTextInputField("Leaving - Date","leaveDate",true);
    makeTextInputField("Leaving - Time","leaveTime",true);

    makeTextInputField("How many piece of big luggage?",'bigPiece',true);
    makeTextInputField("How many piece of small luggage?",'smallPiece',true);

    ?>

    <br><br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>




<footer>
    <img src="footer-background.png" alt="background for footer">
</footer>
</body>
</html>

<?php

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function submitAlertAndRedirect(){
    echo "<script>
        alert('Form successfully completed, you will be redirected to the home page after this alert is closed');
        window.location.href = 'home.php';
        </script>";
    exit();
}
