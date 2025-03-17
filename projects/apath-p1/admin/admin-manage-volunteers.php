<?php
session_start();

include '../connection.php';
include '../FormInputCreator.php';
include '../helper_functions.php';

$sql = "SELECT * FROM apath_volunteer";
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
            <th>Volunteer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Model of Car</th>
            <th>Year</th>
            <th>Maker of Car</th>
            <th># of Available Seats</th>
            <th># of Larges Bags That Can Fit</th>
            <th>Email</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach($row as $key => $value){
                if($key == "v_id"){
                    echo "<td><a href='edit_volunteer.php?id=$value'>$value</a></td>";
                }else{
                    echo "<td>$value</td>";
                }
            }
            $id = $row['v_id'];
            $sql = "SELECT email from apath_users WHERE id=$id";
            $user = $dbc->query($sql);
            $row = $user->fetch_assoc();
            $email = $row['email'];
            echo "<td>$email</td>";
            echo "<td><a href='delete-volunteer.php?id=$id' onclick='return confirm(`Are you sure you wish to delete volunteer #$id from the database?`)'>DELETE</a></td>";
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
