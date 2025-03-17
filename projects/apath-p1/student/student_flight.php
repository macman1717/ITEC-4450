<?php
session_start();

include '../connection.php';
include '../FormInputCreator.php';
include '../helper_functions.php';
try {
    $s_id = $_SESSION['id'];
    $result = mysqli_query($dbc, "SELECT * FROM apath_student WHERE s_id = $s_id");
    $student = mysqli_fetch_assoc($result);
    foreach ($student as $key => $value) {
        $_SESSION[$key] = $value;
    }
}catch (Exception $e){
    header('Location: ../index.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = array();
    $sql = "UPDATE apath_student SET ";
    $number_keys = ['large_luggage','small_luggage'];
    $date_keys = ['a_datetime','d_datetime'];
    foreach ($_POST as $key => $value) {
        if(!in_array($key, $number_keys) && !in_array($key, $date_keys)) {
            $_SESSION[$key] = $value;
            $data[$key] = clean($value);
            $sql .= "$key = '$data[$key]', ";
        }else if($key == 'a_datetime' || $key == 'd_datetime') {
            if(strlen($value) > 0) {
                $_SESSION[$key] = $value;
                $data[$key] = clean($value);
                $sql .= "$key = '$data[$key]', ";
            }
        }else{
            $_SESSION[$key] = $value;
            $data[$key] = clean($value);
            $sql .= "$key = $data[$key], ";
        }
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE s_id = $s_id";

    $result = mysqli_query($dbc, $sql);
    if($result){
        header('Location: index.php');
    }
}



?>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Car Information</title>
</head>
<body>
<?php include 'student-nav.php'; ?>

<div id="home-div">
    <h1>Please update information about your flight</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <?php
        ECHO $sql;

        makeTextInputField("Airport", 'airport', false);
        makeTextInputField("Flight Number", 'flight_number', false);
        makeTextInputField("Airline", 'airline', false);
        $options = array();
        for ($i = 0; $i < 10; $i++) {
            $options[$i] = $i;
        }
        makeSelectInputField("How many pieces of large luggage will you have?","large_luggage", $options, false);
        echo "<br>";
        makeSelectInputField("How many pieces of small luggage will you have?", "small_luggage", $options ,false);
        ?>
        <br>
        Departure: <input type="datetime-local" name="d_datetime" value="<?php echo $_SESSION['d_datetime'];?>">
        Arrival: <input type="datetime-local" name="a_datetime" value="<?php echo $_SESSION['a_datetime'];?>">
        <br>
        <input class="submit-btn" type="submit" value="Save">
    </form>


</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>