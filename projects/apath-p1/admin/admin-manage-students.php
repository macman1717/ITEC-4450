<?php
session_start();

include '../connection.php';
include '../FormInputCreator.php';
include '../helper_functions.php';

$sql = "SELECT * FROM apath_student";
$result = $dbc->query($sql);


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
<div><h1>Students</h1></div>


<div id="home-div">
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Arrival Date and Time</th>
            <th>Departure Date and Time</th>
            <th>Airport</th>
            <th>Flight Number</th>
            <th>Airline</th>
            <th># of Large Bags</th>
            <th># of Small Bags</th>
            <th>School</th>
            <th>Major</th>
        </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach($row as $key => $value){
            if($key == "s_id"){
                echo "<td><a href='edit_student.php?id=$value'>$value</a></td>";
            }else{
                echo "<td>$value</td>";
            }
        }
        $id = $row['s_id'];
        echo "<td><a href='delete-student.php?id=$id' onclick='return confirm(`Are you sure you wish to delete student #$id from the database?`)'>DELETE</a></td>";
        echo "</tr>";
    }
    ?>
    </table>
</div>
<br>
<footer>
    <a id='covid-link' href="">Covid information and Guidelines</a>
</footer>
</body>
</html>
