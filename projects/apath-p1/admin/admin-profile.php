<?php
include "../FormInputCreator.php";
include "../connection.php";

$sql = "SELECT * FROM apath_users WHERE id = 1;";
$result = mysqli_query($dbc, $sql);
$row = mysqli_fetch_array($result);

$id = $row['id'];
$email = $row['email'];
$pw = $row['pw'];
$type = $row['type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/forms.css">
    <meta charset="UTF-8">
    <title>APATH - Volunteer Home</title>
</head>
<body>
<?php include 'admin-nav.php'; ?>
<main>
    <div id="home-div">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <?php
            makeTextInputFieldForProfile("Email", "email", true, $email);
            makeTextInputFieldForProfile("Password", "pw", true, $pw);
            ?>
            <input class="submit-btn" type="submit" value="Change Values">
        </form>
    </div>
</main>



<footer>

</footer>
</body>
</html>