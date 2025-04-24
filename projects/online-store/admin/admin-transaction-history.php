<?php
include '../connection.php';

$sql = "SELECT item_name, quantity_purchased, total_price, email FROM store_purchases join store_users on store_purchases.buyer_id = store_users.id";
$purchases = $dbc->query($sql);
$sql = "SELECT * FROM store_sales join store_users on store_sales.seller_id = store_users.id";
$sales = $dbc->query($sql);
?>
<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include 'admin-nav.php'; ?>

<div class="container">
    <h1>Purchases</h1>
    <?php
    if ($purchases->num_rows == 0) {
        echo "<p>There have been no purchases by current users for the past month.</p>";
    }else{
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Buyer Email</th>";
        echo "<th>Item</th>";
        echo "<th>Quantity</th>";
        echo "<th>Total Price</th>";
        echo "</tr>";
        while ($row = $purchases->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['item_name'] . "</td>";
            echo "<td>" . $row['quantity_purchased'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <hr>
    <h1>Sales</h1>
    <?php
    if ($sales->num_rows == 0) {
        echo "<p>There have been no sales by current users during the past month.</p>";
    }else{
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Seller Email</th>";
        echo "<th>Item</th>";
        echo "<th>Quantity</th>";
        echo "<th>Total Price</th>";
        echo "</tr>";
        while ($row = $sales->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['item_name'] . "</td>";
            echo "<td>" . $row['quantity_sold'] . "</td>";
            echo "<td>" . $row['total_price'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>
<?php include '../footer.php'; ?>
</body>
</html>

