<?php
include '../connection.php';
session_start();
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM store_listings where seller_id = $user_id;";
$result = $dbc->query($sql);


?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include 'user-nav.php'; ?>

<h3>Current Listings</h3>

<?php

if ($result->num_rows == 0) {
    echo "<h3>No current listings, please <a href='user-create-listing.php'> create </a>a listing if you wish to sell something.</h3>";
}else{
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Item Name</th>";
    echo "<th>Description</th>";
    echo "<th>Price</th>";
    echo "<th>Stock available</th>";
    echo "<th>Edit</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["item_name"] . "</td>";
        echo "<td>" . $row["item_description"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["stock"] . "</td>";
        echo "<td><a href='user-edit-listing.php?id=" . $row["id"] . "'>Edit</a></td>";
        echo "<td><a href='user-delete-listing.php?id=" . $row["id"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}


?>

<?php include '../footer.php'; ?>
</body>
</html>

