<?php
include "../connection.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['user_id'];
    $sql = "DELETE FROM store_users WHERE id = $id";
    $dbc -> query($sql);
    header('location: admin-users.php');
}
$user_id = $_GET['id'];

$sql = "SELECT * FROM store_users WHERE id = $user_id";
$result = $dbc->query($sql);
$row = $result->fetch_assoc();
$item_name = $row['item_name'];
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<div class="container">
    <?php
    echo '<h1>Are you sure you want to delete this User?</h1>';
    echo "<ul>";
    echo "<li>Email: ".$row['email']."</li>";
    echo "<li>Name: ".$row['first_name']. " " . $row['last_name'] ."</li>";
    echo "<li>Phone: ".$row['phone']."</li>";
    echo "</ul>"
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id?>">
        <input type="submit" value="Yes, I'm Sure">
        <a href="admin-users.php">Cancel</a>
    </form>
</div>
</body>
</html>
