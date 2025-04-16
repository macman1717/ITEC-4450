<?php
include '../connection.php';
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM store_listings where id = $id";
$result = mysqli_query($dbc, $sql);
$listingSpaceAvailable = true;
if (mysqli_num_rows($result) >= 5) {
    $listingSpaceAvailable = false;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    foreach ($_POST as $key => $value) {
        if ($value == "") {
            $errorMessage = "Please fill out all boxes";
        }
    }
    if(!isset($errorMessage)){
        $item_name = $_POST['item_name'];
        $price = $_POST['price'];
        $item_description = $_POST['item_description'];
        $stock = $_POST['stock'];
        $sql = "INSERT INTO store_listings (seller_id, item_name, item_description, price, stock) values ($id, \"$item_name\", '$item_description', $price, $stock)";
        echo $sql;
        $result = $dbc -> query($sql);
        if($result){
            header("location:./user-manage-listings.php");
        }
    }
}

?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include 'user-nav.php'; ?>


<h3>Create Listing</h3>
<?php
if ($listingSpaceAvailable) {
    if(isset($errorMessage)){
        echo '<div class="container">'.$errorMessage.'</div>';
    }
    echo '
    <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
        <h4>Please enter the details of the listing below (all fields are required):</h4>
        <label for="item_name">Name of the Item</label>
        <input type="text" name="item_name" placeholder="Item Name" required><br>
        <label for="item_description">Description for item</label>
        <textarea name="item_description" placeholder="Item Description" required></textarea>
        <label for="price">Listing Price</label>
        <input type="number" name="price" placeholder="Listing Price" step=".01" min=".01" required><br>
        <label for="stock">Stock Available</label>
        <input type="number" name="stock" onkeydown="return event.keyCode !== 190" min="1" placeholder="Stock Available" required><br>
        <input type="submit" value="Submit">
    </form>
    ';
}else{
    echo "<h4>You have 5 listing currently. Please delete one if you wish to create another listing.</h4>";
}
?>

<?php include '../footer.php'; ?>
</body>
</html>
