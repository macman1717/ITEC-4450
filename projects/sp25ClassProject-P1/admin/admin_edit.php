<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Activity 12 - Admin Edit User</title>
    <style>
        .error {color:#FF0000;}
    </style>
</head>
<body>


<?php include "admin_nav.php"; ?>
<div class="main-wrapper">
<div class="container">
<h2>Admin Edit User Page</h2>
<?php
$id = $_GET["id"];
echo "The id of this user is " . $id . "<br>";

include "../connection.php";
$sql = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($dbc, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows == 1){
    $row = mysqli_fetch_array($result);
    $dbid = $row["id"];
    $dbfirstname = $row["firstname"];
    $dblastname = $row["lastname"];
    $dbemail = $row["email"];
    $dbphone = $row["phone"];
    $dblevel = $row["level"];

}else{
    echo "Something went wrong!";
}
?>

<h3>Please update the user information below</h3>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $dbid; ?>"> <br> <br>
    First Name: <input type="text" name="firstname" value="<?php echo $dbfirstname; ?>"> <br> <br>
    Last Name: <input type="text" name="lastname" value="<?php echo $dblastname; ?>"> <br> <br>
    Email: <input type="text" name="email" value="<?php echo $dbemail; ?>"> <br> <br>
    Phone: <input type="text" name="phone" value="<?php echo $dbphone; ?>"> <br> <br>
    Level: <input type="text" name="level" value="<?php echo $dblevel; ?>"> <br> <br>

    <input type="submit" name="edit" value="CONFIRM EDIT">
</form>
</div>
</div>
</body>
</html>