<?php
include '../connection.php';
$sql = "SELECT store_listings.id as id, email, item_name, item_description, price, stock, image_path FROM store_listings join store_users on store_listings.seller_id = store_users.id";
$result = $dbc->query($sql);
$listingsAvailable = true;
if (mysqli_num_rows($result) == 0) {
    $listingsAvailable = false;
}
?>
<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<?php include "admin-nav.php"?>
<div class='container'>
<h3>All Current Listings</h3>
    <hr>
<?php
    if ($listingsAvailable) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Seller Email</th>";
        echo "<th>Item Image</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "<th>Price</th>";
        echo "<th>Stock Available</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><img src='../" . $row['image_path'] . "' width='100px; height='auto'></td>";
            echo "<td>".$row['item_name']."</></td>";
            echo "<td>".$row['item_description']."</td>";
            echo "<td>".$row['price']."</td>";
            echo "<td>".$row['stock']."</td>";
            echo "<td><a href='delete-listing.php?id=".$row['id']."'>Delete</a></td>";
        }
        echo "</table>";
    }else{
        echo "No Available Listings";
    }
    ?>
</div>


<?php include '../footer.php' ?>
</body>
</html>
