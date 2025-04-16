<?php
session_start();
$id = $_SESSION['id'];
$listing_id = $_GET['listing_id'];

include '../connection.php';
$sql = "SELECT * FROM store_listings WHERE id = $listing_id";
$result = $dbc->query($sql);
$row = $result->fetch_assoc();
$item_name = $row['item_name'];
$item_description = $row['item_description'];
$item_price = $row['price'];
$item_stock = $row['stock'];
$seller_id = $row['seller_id'];

$sql = "SELECT * FROM store_users WHERE id = $seller_id";
$result = $dbc->query($sql);
$row = $result->fetch_assoc();
$seller_name = $row['first_name'] . " " . $row['last_name'];
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include './user-nav.php'; ?>
<div class="container">
    <?php
    echo "<h1>$item_name</h1>";
    echo "<p>$item_description</p>";
    echo "<p>Sold by: $seller_name</p>";
    echo "<p>Price: $$item_price</p>";
    echo "<p>Stock Available: $item_stock</p>";
    ?>
    <hr>
    <h3>Would you like to purchase this item?</h3>
    <form action="user-confirm-purchase.php" method="post">
        <label for="stock">Quantity You wish to Purchase:</label>
        <input type="hidden" name="listing_id" value="<?php echo $listing_id?>">
        <input type="number" name="stock" min="1" max="<?php echo $item_stock?>" step="1" required>
        <input type="submit" value="Purchase">
    </form>
    <a href="user-catalog.php">Go Back</a>
</div>
<?php include '../footer.php'; ?>

</body>
</html>
