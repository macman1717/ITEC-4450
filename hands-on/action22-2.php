<?php
session_start();
echo "<h3>Thank you for shopping with us. Please make a payment of $".$_SESSION["total_cost"]."</h3>";

session_unset();
session_destroy();
echo "<hr>";
echo "Your transaction is complete and please <a href='activity22.php'>click here</a> to buy more.";
