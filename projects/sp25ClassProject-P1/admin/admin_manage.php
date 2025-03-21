<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../../hands-on/hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 11 - Admin Manage Users</title>
    <style>
        .error {color:#FF0000;}
    </style>
</head>
<body>
<h2>Welcome to the Admin - Manage User Page</h2>

<?php
include "admin_nav.php";

include "../connection.php";
$sqs = "SELECT * FROM users order by firstname";
$result = mysqli_query($dbc, $sqs);

echo "<table border='1' width='50%'>";
echo "<tr>";
echo "<th>edit</th>";
echo "<th>delete</th>";
echo "<th>Firstname</th>";
echo "<th>Lastname</th>";
echo "<th>Phone</th>";
echo "<th>Email</th>";
echo "<th>Gender</th>";
echo "<th>Level</th>";
echo "<th>PW</th>";
echo "<th>User Role</th>";
echo "<th>SQL Quiz</th>";
echo "<th>HTML/CSS Quiz</th>";
echo "<th>PHP Quiz</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td><a href='admin_edit.php?id=".$row['id']."'>Edit</a></td>";
    echo "<td><a href='admin_delete.php?id=".$row['id']."'>Delete</a></td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['lastname']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['gender']."</td>";
    echo "<td>".$row['level']."</td>";
    echo "<td>".$row['password']."</td>";
    if($row['user_type'] == 0){
        echo "<td>Admin</td>";
    }else{
        echo "<td>User</td>";
    }

    $quiz_names = ['sql','html-css','php'];
    foreach($quiz_names as $quiz_name){
        $sql = "SELECT * FROM quiz_results WHERE quiz_name = '$quiz_name' and user_id = $row[id]";
        $quiz_sql_result = $dbc->query($sql);
        echo "<td>";
        if($quiz_sql_result->num_rows == 0){
            echo "Not Attempted";
        }else{
            echo mysqli_fetch_assoc($quiz_sql_result)['score'] . "%";
        }
        echo "</td>";
    }

    echo "</tr>";
}

?>
<p>
    <?php echo $sql ?>
</p>
</body>
</html>

