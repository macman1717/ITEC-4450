<?php
session_start();
$id = $_SESSION['id'];
include '../connection.php';
$sql = "SELECT first_name, last_name FROM store_users where id = $id;";
$result = mysqli_query($dbc, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['first_name'];
$lastname = $row['last_name'];

$sql = "SELECT * FROM store_announcements where status = 'shown' order by id desc;";
$announcements = mysqli_query($dbc, $sql);

?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<?php include 'user-nav.php'; ?>
<div id="container">
    <h2>Announcements</h2>
    <ul>
        <?php
        while ($row = mysqli_fetch_assoc($announcements)) {
            echo '<li>' . $row['title'] . ': '. $row['content']. ' </li>';
            echo '<hr>';
        }
        ?>
    </ul>
</div>

<h2>User Home Page</h2>
<h1>Welcome to GGC Online Store</h1>
<p>This website lets GGC students buy and sell used stuff like books, laptops, furniture, electronics, and more. br
    Here’s how to use it:</p>
    <h2>Buy Items</h2>
<p>You can look through all the items people are selling. Just check the ones you like and add them to your cart.</p>

<h2>Create a listing</h2>
<p>Got something you don’t need anymore? You can post up to 5 items for sale. Just upload a picture,
    write a short description, and set the price. You’ll also see anything you’ve already posted.</p>

<h2>Manage Listings</h2>
<p>See all of you current listing and edit/remove them</p>

<h2>Transaction History</h2>
<p>See a list of what you’ve bought and sold.</p>

<h2>Profile</h2>
<p>You can change your phone number, email, password, or profile picture here.</p>
</body>
<?php include '../footer.php' ?>
</html>
