<?php
include '../connection.php';

session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $_SESSION['s_id'] = $_GET['s_id'];
    $s_id = $_SESSION['s_id'];
    $sql = "SELECT * FROM apath_student WHERE s_id = '$s_id'";
    $result = $dbc->query($sql);
    $student = $result->fetch_assoc();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_id = $_SESSION['id'];
    $s_id = $_SESSION['s_id'];
    $sql = "INSERT INTO pickup (s_id, v_id, approved) VALUES ($s_id,$v_id,0)";
    $dbc -> query($sql);
    header('location: check_pickup_needs.php');
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
<?php include 'volunteer-nav.php'; ?>

<div id="home-div">
    <h1>Confirm Pickup</h1>
    <p>
        <?php
        foreach($student as $key => $value) {
            echo $key.": ".$value."<br>";
        }
        ?>
    </p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="submit" value="Confirm">
        <a href="check_pickup_needs.php">Cancel</a>
    </form>


</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>
