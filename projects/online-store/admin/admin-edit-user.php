<?php
include "../connection.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['user_id'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $sql = "UPDATE store_users SET email = '$email', first_name='$first_name', last_name='$last_name', phone='$phone', user_type='$role' WHERE id=$id";
    $dbc -> query($sql);
    header('location: admin-users.php');
}
$user_id = $_GET['id'];

$sql = "SELECT * FROM store_users WHERE id = $user_id";
$result = $dbc->query($sql);
$user = $result->fetch_assoc();
if($user['user_type'] == "admin") $adminChecked = "checked"; else $adminChecked = "";
if($user['user_type'] == "user") $userChecked = "checked"; else $userChecked = "";
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h3>Update User</h3>
        <label>Email: </label>
        <input type="text" name="email" value="<?php echo $user['email']?>">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']?>">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']?>">
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']?>">
        <label>Role:</label><br>
        <input type="radio" name="role" value="admin" <?php echo $adminChecked;?>>Admin
        <input type="radio" name="role" value="user" <?php echo $userChecked;?>>User
        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        <input type="submit" value="Update">
        <a href="admin-users.php">Cancel</a>
    </form>
</body>
</html>
