<?php
include "../connection.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['listing_id'];
    $sql = "DELETE FROM store_listings WHERE id = $id";
    $dbc -> query($sql);
    header('location: user-manage-listings.php');
}
$listing_id = $_GET['listing_id'];

$sql = "SELECT * FROM store_listings WHERE id = $listing_id";
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
echo '<h1>Are you sure you want to delete the listing for "'.$item_name.'"?</h1>';
echo "<ul>";
echo "<li>Description: ".$row['item_description']."</li>";
echo "<li>Price: $".$row['price']."</li>";
echo "<li>Stock: $".$row['stock']."</li>";
echo "</ul>"
?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="hidden" name="listing_id" value="<?php echo $listing_id?>">
        <input type="submit" value="Yes, I'm Sure">
        <a href="user-manage-listings.php">Cancel</a>
    </form>
</div>
</body>
</html>
