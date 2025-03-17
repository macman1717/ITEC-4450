<?php
include '../connection.php';
include '../FormInputCreator.php';
include '../helper_functions.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id =  $_GET['id'];
    $_SESSION['id'] = $id;
    $sql = "SELECT * FROM apath_volunteer where v_id = $id";
    $result = $dbc->query($sql);
    $row = mysqli_fetch_assoc($result);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "UPDATE apath_volunteer SET ";
    $number_keys = ['car_capacity','car_storage','car_year'];
    $num = 0;
    foreach ($_POST as $key => $value) {
        if(in_array($key, $number_keys)){
            if($key == "car_year"){
                if($value != ""){
                    $sql .= "$key = $value, ";
                }
            } else {
                $sql .= "$key = $value, ";
            }
        }else{
            $value = clean($value);
            $sql .= "$key = '$value', ";
        }
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE v_id = ".$_SESSION['id'];
    try {
        $result = $dbc->query($sql);
    }catch (Exception $e){
        $error = $e->getMessage();
    }
    if ($result) header('Location: admin-manage-volunteers.php');
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
    <h1>You are Editing the information of Volunteer #<?php echo $id?></h1>
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
        makeTextInputField("Model of Car", "car_model", false);
        makeTextInputField("Year", "car_year", false);
        makeTextInputField("Make", "car_make", false);
        $options = array();
        for($i = 0; $i < 10; $i++){
            $options[$i] = $i;
        }
        makeSelectInputField("Available seats in car", "car_capacity",$options, false);
        echo "<br>";
        makeSelectInputField("# of bags that can fit into car", "car_storage",$options, false);
        echo "<br>";
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
