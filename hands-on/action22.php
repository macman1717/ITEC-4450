<?php
session_start();
?>

<html>
<body>
<?php
if(isset($_POST['submit'])){
    if(isset($_POST["PC"])) {
        if ($_POST["PC"] == "PC") {
            $_SESSION["PC"] = "PC";
            if (isset($_SESSION["nPC"]))
                $_SESSION["nPC"] += $_POST["nPC"];
            else
                $_SESSION["nPC"] = $_POST["nPC"];
        }
    }
    if(isset($_POST["Pad"])) {
        if ($_POST["Pad"] == "Pad") {
            $_SESSION["Pad"] = "Pad";
            if (isset($_SESSION["nPad"]))
                $_SESSION["nPad"] += $_POST["nPad"];
            else
                $_SESSION["nPad"] = $_POST["nPad"];
        }
    }
    if(isset($_POST["Mac"])) {
        if ($_POST["Mac"] == "Mac") {
            $_SESSION["Mac"] = "Mac";
            if (isset($_SESSION["nMac"]))
                $_SESSION["nMac"] += $_POST["nMac"];
            else
                $_SESSION["nMac"] = $_POST["nMac"];
        }
    }

}

$total=0;
if(!isset($_SESSION["Pad"]) && !isset($_SESSION["Mac"]) && !isset($_SESSION["PC"])) {
    echo "<h1>Shopping cart is empty</h1><hr>";
    echo "<p>Click <a href='activity22.php'>here</a> to go back</p>";
}else {
    echo "<h1>Your shopping cart: </h1>
        <hr>
        <table>
            <tr>
                <td>Item</td><td>Price</td><td>Quantity</td>
            </tr>
        ";
    if (isset($_SESSION["PC"])) {
        if ($_SESSION["PC"] == "PC") {
            echo "<br>Caluculate total: price=" . $_POST["PCPrice"] . " * " . $_SESSION["nPC"];
            $total += $_POST["PCPrice"] * $_SESSION["nPC"];
            echo "<tr> <td> <img src='" . $_POST["PCImage"] . "' width='120'></td>";
            echo "<td>" . $_POST["PCPrice"] . "</td>";
            echo "<td>" . $_SESSION["nPC"] . "</td>";
            echo "</tr>";
        }
    }

    if (isset($_SESSION["Pad"])) {
        if ($_SESSION["Pad"] == "Pad") {
            echo "<br>Caluculate total: price=" . $_POST["PadPrice"] . " * " . $_SESSION["nPad"];
            $total += $_POST["PadPrice"] * $_SESSION["nPad"];
            echo "<tr> <td> <img src='" . $_POST["PadImage"] . "' width='120'></td>";
            echo "<td>" . $_POST["PadPrice"] . "</td>";
            echo "<td>" . $_SESSION["nPad"] . "</td>";
            echo "</tr>";
        }
    }

    if (isset($_SESSION["Mac"])) {
        if ($_SESSION["Mac"] == "Mac") {
            echo "<br>Caluculate total: price=" . $_POST["MacPrice"] . " * " . $_SESSION["nMac"];
            $total += $_POST["MacPrice"] * $_SESSION["nMac"];
            echo "<tr> <td> <img src='" . $_POST["MacImage"] . "' width='120'></td>";
            echo "<td>" . $_POST["MacPrice"] . "</td>";
            echo "<td>" . $_SESSION["nMac"] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";

    echo "<hr>";
    echo "<h3>The total price is: " . $total . "</h3>";
    $_SESSION["total_cost"] = $total;
    echo "<h3> Please verify your order and <a href='action22-2.php'>Proceed to checkout. </a></h3>";
    echo "<h3> or <a href='activity22.php'>continue shopping</a></h3>";
}




?>
</body>
</html>
