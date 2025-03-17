<?php
include '../connection.php';
include '../FormInputCreator.php';
include '../helper_functions.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id =  $_GET['id'];
    $_SESSION['id'] = $id;
    $sql = "SELECT * FROM apath_student where s_id = $id";
    $result = $dbc->query($sql);
    $row = mysqli_fetch_assoc($result);
}








if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "UPDATE apath_student SET ";
    $number_keys = ['large_luggage','small_luggage'];
    $datetime_keys = ['a_datetime','d_datetime'];
    $num = 0;
    foreach ($_POST as $key => $value) {
        if(in_array($key, $number_keys)){
            $sql .= "$key = $value, ";
        }elseif(!in_array($key, $datetime_keys)){
            $value = clean($value);
            $sql .= "$key = '$value', ";
        }else{
            if(strlen($value) > 0) {
                $num .= $val;
                $value = clean($value);
                $sql .= "$key = '$value', ";
            }
        }
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE s_id = ".$_SESSION['id'];
    try {
        $result = $dbc->query($sql);
    }catch (Exception $e){
        $error = $e->getMessage();
    }
    if ($result) header('Location: admin-manage-students.php');
}

?>
<html>
<head>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Student Profile</title>
</head>
<body>
<?php include "admin-nav.php" ?>
<br>
<div id="home-div">
    <h1>You are Editing the information of student #<?php echo $id?></h1>
    <?php if($_SERVER["REQUEST_METHOD"] == "POST") echo $sql . " Number:" . $num ?>
    <?php if(isset($error)) echo '<br>'.$error ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <?php
        foreach ($row as $key => $value) {
            $_SESSION[$key] = $value;
        }
        echo "<br>";
        makeTextInputField("First Name", "first_name", false);
        makeTextInputField("Last Name", "last_name", false);
        makeTextInputField("Phone", "phone", false);
        ?>

        Departure: <input type="datetime-local" name="d_datetime" value="<?php echo $_SESSION['d_datetime'];?>"><br>
        Arrival: <input type="datetime-local" name="a_datetime" value="<?php echo $_SESSION['a_datetime'];?>"><br>

        <?php
        makeTextInputField("Airport", "airport", false);
        makeTextInputField("Flight Number", "flight_number", false);
        makeTextInputField("Airline", "airline", false);
        $options = array();
        for($i = 0; $i < 10; $i++){
            $options[$i] = $i;
        }
        makeSelectInputField("Large Luggage", "large_luggage",$options, false);
        echo "<br>";
        makeSelectInputField("Small Luggage", "small_luggage",$options, false);
        echo "<br>";
        makeTextInputField("School", "school", false);
        makeTextInputField("Major", "major", false);
        ?>
        <input class="submit-btn" type="submit">
    </form>
</div>
<br>
<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>