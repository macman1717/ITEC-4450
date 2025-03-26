<?php
session_start();

include '../connection.php';

$sql = "select *
    from apath_student
    left join pickup
    on apath_student.s_id = pickup.s_id
    where v_id is null and a_datetime is not null;";
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
<?php include 'volunteer-nav.php'; ?>

<div id="home-div">
    <h1>Pickup Requests</h1>

    <table border="1">
        <tr>
            <th>Pickup</th>
            <th>Arrival Date</th>
            <th>Arrival Time</th>
            <th>Major</th>
        </tr>
        <?php
        if ($result->num_rows == 0) {
            echo "No Current Pickup Requests!";
        }
        while($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td><a href='add_pickup.php?s_id=$row[0]'>Pickup</a></td>";
            $a_datetime = explode(" ",$row["a_datetime"]);
            $date = $a_datetime[0];
            $time = $a_datetime[1];
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td>".$row['major']."</td>";
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



