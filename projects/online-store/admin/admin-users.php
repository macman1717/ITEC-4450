<?php
include '../connection.php';
$sql = "SELECT * FROM store_users";
$result = mysqli_query($dbc, $sql);
?>

<html>
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include "admin-nav.php"; ?>
<div class="container">
    <h3>All Current Users</h3>
    <hr>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['last_name']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td><a href='admin-edit-user.php?id=".$row['id']."'>Edit</a></td>";
            echo "<td><a href='admin-delete-user.php?id=".$row['id']."'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<?php include "../footer.php"; ?>
</body>
</html>
