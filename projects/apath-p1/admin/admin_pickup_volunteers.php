<?php
session_start();

include '../connection.php';

$sql = "select *
    from apath_student
    join pickup
    on apath_student.s_id = pickup.s_id;";
$result = $dbc->query($sql);
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
    <h1>Pickup Requests</h1>

    <table border="1">
        <tr>
            <th>To confirm/approve</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Arrival Date</th>
            <th>Arrival Time</th>
            <th>Volunteer ID</th>
            <th>Approved?</th>
        </tr>
        <?php
        if ($result->num_rows == 0) {
            echo "No Current Pickup Requests!";
        }
        while($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td><a href='admin_approve_pickup.php?s_id=$row[0]&v_id=$row[14]'>Approve</a></td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['last_name']."</td>";
            $a_datetime = explode(" ",$row["a_datetime"]);
            $date = $a_datetime[0];
            $time = $a_datetime[1];
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td>".$row['v_id']."</td>";
            $approved = $row["approved"];
            if ($approved == 1) {
                echo "<td>Yes</td>";
            }else{
                echo "<td>No</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>



</div>



<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>




