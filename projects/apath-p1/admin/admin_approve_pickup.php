<?php
include '../connection.php';

session_start();
if($_SERVER["REQUEST_METHOD"] == "GET") {
    $_SESSION['s_id'] = $_GET['s_id'];
    $_SESSION['v_id'] = $_GET['v_id'];
    $s_id = $_SESSION['s_id'];
    $v_id = $_SESSION['v_id'];
    $sql = "SELECT first_name, last_name,a_datetime FROM apath_student WHERE s_id = $s_id;";
    $result = $dbc->query($sql);
    $student = $result->fetch_assoc();
    $s_first_name = $student['first_name'];
    $s_last_name = $student['last_name'];
    $a_datetime = explode(" ", $student['a_datetime']);
    $date = $a_datetime[0];
    $time = $a_datetime[1];
    $sql = "SELECT first_name, last_name from apath_volunteer where v_id = $v_id;";
    $result = $dbc->query($sql);
    $volunteer = $result->fetch_assoc();
    $v_first_name = $volunteer['first_name'];
    $v_last_name = $volunteer['last_name'];
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_id = $_SESSION['v_id'];
    $s_id = $_SESSION['s_id'];
    $sql = "UPDATE pickup SET approved = 1 WHERE v_id = $v_id and s_id = $s_id;";
    $dbc -> query($sql);
    header('location: admin_pickup_volunteers.php');
}
?>

<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Volunteer Profile</title>
</head>
<body>
<?php include 'admin-nav.php'; ?>

<div id="home-div">
    <h1>Confirm Pickup</h1>
    <p>
        <?php
            echo "Student Firstname: " . $s_first_name . "<br>";
            echo "Student Lastname: " . $s_last_name . "<br>";
            echo "Volunteer Firstname: " . $v_first_name . "<br>";
            echo "Volunteer Lastname: " . $v_last_name . "<br>";
            echo "Date: " . $date . "<br>";
        ?>
    </p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="submit" value="Approve">
        <a href="admin_pickup_volunteers.php">Cancel</a>
    </form>


</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>

