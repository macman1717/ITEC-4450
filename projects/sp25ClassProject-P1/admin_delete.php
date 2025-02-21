
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../hands-on/hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 10 - Admin Manage Users</title>
    <style>
        .error {color:#FF0000;}
    </style>
</head>
<body>
<?php
include 'admin_nav.php';
$id = $_GET['id'];
echo "User id is: ".$id."<br>";

include("connection.php");
$query = "Select * from users WHERE id=$id;";
$result = mysqli_query($dbc, $query);
$num_rows = mysqli_num_rows($result);
if ($num_rows == 1) {
    $row = mysqli_fetch_array($result);
    $dbfirstname = $row['firstname'];
    $dblastname = $row['lastname'];
    $dbemail = $row['email'];
}else{
    echo "User not found";
}
?>

<form action="delete.php" method="post">
    ID: <input type="text" name="id" value="<?php echo $id?>"><br>
    First name: <input type="text" name="firstname" value="<?php echo $dbfirstname;?>"><br>
    Last name: <input type="text" name="lastname" value="<?php echo $dblastname;?>"><br>
    Email: <input type="text" name="email" value="<?php echo $dbemail;?>"><br>
    <input type="submit" name="delete" value="DELETE">
</form>
</body>
</html>
