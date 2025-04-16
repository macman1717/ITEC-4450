<?php
session_start();
include '../connection.php';
$id = $_SESSION['id'];
$listing_id = $_POST['listing_id'];
$stock_wanted = $_POST['stock'];
$sql = "SELECT * FROM store_listings WHERE id = $listing_id;";
$result = $dbc->query($sql);
$row = $result->fetch_assoc();

if(isset($_POST['confirmed'])){
    $item_name = $row['item_name'];
    $item_price = $row['price'];
    $total_price = $stock_wanted * $item_price;
    $sql = "INSERT INTO store_purchases (buyer_id, item_name, total_price, quantity_purchased) VALUES ($id, \"$item_name\", $total_price, $stock_wanted);";
    $result = $dbc->query($sql);
    $seller_id = $row['seller_id'];
    $sql = "INSERT INTO store_sales (seller_id, item_name, total_price, quantity_sold) VALUES ($seller_id, \"$item_name\", $total_price, $stock_wanted);";
    $dbc->query($sql);
    if($stock_wanted == $row['stock']){
        $sql = "DELETE FROM store_listings WHERE id = $listing_id;";
        $dbc->query($sql);
    }else{
        $new_stock = $row['stock'] - $stock_wanted;
        $sql = "UPDATE store_listings SET stock = $new_stock WHERE id = $listing_id;";
        $dbc->query($sql);
    }
    header("location:./user-catalog.php");
}


?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
<?php
echo "<h2>Item: ". $row['item_name']. "</h2>";
echo "<p>Quantity: ". $stock_wanted. "</p>";
echo "<p>Price: $". $row['price']. "</p>";
echo "<hr>";
echo "<p>Total Price: $". $row['price']*$stock_wanted. "</p>";
?>
    <input type="hidden" name="listing_id" value="<?php echo $listing_id; ?>">
    <input type="hidden" name="stock" value="<?php echo $stock_wanted; ?>">
    <input type="hidden" name="confirmed" value="true">
    <input type="submit" value="Confirm Order">
    <a href="./user-view-listing.php?listing_id=<?php echo $listing_id?>">Go Back</a>
</form>
</body>
</html>
