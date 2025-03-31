<?php
session_start();

include '../connection.php';
$pickup_exists = false;
$sql = "SELECT v_id, approved FROM `pickup` WHERE `s_id` = '".$_SESSION['id']."'";
$result = $dbc->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_array();
    $volunteer_id = $row[0];
    $approved = $row[1];
    if($approved == 1){
        $pickup_exists = true;
        $sql = "SELECT * FROM `apath_volunteer` WHERE `v_id` = '".$volunteer_id."'";
        $result = $dbc->query($sql);
        $row = $result->fetch_assoc();
    }
}

?>

<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Student Pickup Information</title>
</head>
<body>
<?php include 'student-nav.php'; ?>

<div id="home-div">
    <h1>VolunteerPickup Information</h1>

    <?php
    if ($pickup_exists) {
        foreach ($row as $key => $value) {
            if($key != "v_id") {
                echo "<p>" . $key . ": " . $value . "</p>";
            }
        }
    }else{
        echo "<p>No Approved Pickup Found</p>";
    }
    ?>

</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>

