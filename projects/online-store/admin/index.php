<?php
session_start();
$id = $_SESSION['id'];
include '../connection.php';
$sql = "SELECT first_name, last_name FROM store_users where id = $id;";
$result = mysqli_query($dbc, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['first_name'];
$lastname = $row['last_name'];
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include "admin-nav.php"?>
<div>
    <h1>Hi <?php echo $name . " " . $lastname?></h1>
    <p>Welcome to the admin homepage of the <strong>GGC Online Store</strong>. As an admin, you have access to a variety of tools to manage the platform and ensure everything runs smoothly.</p>

    <h2>Here’s a quick overview of what you can do:</h2>
    <ul>
        <li><strong>Currently Listed Items</strong>: View and manage all items currently listed for sale by users.</li>
        <li><strong>Transaction History</strong>: Keep track of all transactions made through the platform.</li>
        <li><strong>Users</strong>: Manage user accounts, including editing, removing, or suspending them if needed.</li>
        <li><strong>Manage Announcements</strong>: Post and manage important announcements for all users.</li>
    </ul>

    <p>Use the links above to navigate through the admin panel and start managing the platform.</p>
</div>
<?php include '../footer.php' ?>
</html>
