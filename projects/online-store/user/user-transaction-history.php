<?php
session_start();
$id = $_SESSION['id'];
include '../connection.php';

$sql = "SELECT * FROM store_purchases WHERE buyer_id = $id";
$purchases = $dbc->query($sql);
$sql = "SELECT * FROM store_sales WHERE seller_id = $id";
$sales = $dbc->query($sql);
?>
<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include 'user-nav.php'; ?>

<div id="container">
    <h1>Purchases</h1>
    <?php
    if ($purchases->num_rows == 0) {
        echo "<p>You have no history for purchases.</p>";
    }else{
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Item</th>";
        echo "<th>Quantity</th>";
        echo "<th>Total Price</th>";
        echo "</tr>";
        while ($row = $purchases->fetch_assoc()) {
            echo "<tr>";
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
        echo "<p>You have no history for sales.</p>";
    }else{
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Item</th>";
        echo "<th>Quantity</th>";
        echo "<th>Total Price</th>";
        echo "</tr>";
        while ($row = $sales->fetch_assoc()) {
            echo "<tr>";
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
