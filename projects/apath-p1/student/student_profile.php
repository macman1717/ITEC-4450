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
    $number_keys = ['car_year','car_capacity','car_storage'];
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
        $data[$key] = clean($value);
        $sql .= "$key = '$data[$key]', ";
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
    <title>APATH - Student Profile</title>
</head>
<body>
<?php include 'student-nav.php'; ?>

<div id="home-div">
    <h1>Please update your personal information</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <?php
        makeTextInputField("First name", 'first_name', false);
        makeTextInputField("Last Name", 'last_name', false);
        makeTextInputField("Phone Number", 'phone', false);
        makeTextInputField("School", 'school', false);
        makeTextInputField("Major", 'major', false);
        ?>
        <br>
        <input class="submit-btn" type="submit" value="Save">
    </form>


</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>
