<?php
session_start();
include '../connection.php';
$id = $_SESSION['id'];
$sql = "SELECT * FROM store_listings where not seller_id= $id";
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
<?php include 'user-nav.php'; ?>

<?php
if ($listingsAvailable) {
    echo "<div class=container>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Image</th>";
    echo "<th>Name</th>";
    echo "<th>Description</th>";
    echo "<th>Price</th>";
    echo "<th>Stock Available</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>";
        echo "<img src='../" . $row['image_path'] . "' width='100px; height='auto'>";
        echo "</td>";
        echo "<td><a href='user-view-listing.php?listing_id=".$row['id']."'>".$row['item_name']."</a></td>";
        echo "<td>".$row['item_description']."</td>";
        echo "<td>$".$row['price']."</td>";
        echo "<td>".$row['stock']."</td>";
    }
    echo "</table>";
    echo "</div>";
}else{
    echo "<div class='container'>No Available Listings</div>";
}
?>

<?php include '../footer.php'; ?>
</body>
</html>
