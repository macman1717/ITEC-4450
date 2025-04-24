<?php
include "../connection.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $sql = "UPDATE store_announcements SET title = '$title', content = '$content', status = '$status' WHERE id = $id;";
    $dbc -> query($sql);
    header('location: admin-announcements.php');
}
$id = $_GET['id'];

$sql = "SELECT * FROM store_announcements WHERE id = $id";
$result = $dbc->query($sql);
$announcement = $result->fetch_assoc();
if($announcement['status'] == "hidden") $hiddenChecked = "checked"; else $hiddenChecked = "";
if($announcement['status'] == "shown") $shownChecked = "checked"; else $shownChecked = "";
?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<form class = 'container' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

    <h3>Create Announcement</h3>
    <hr>
    <h4>Please enter the details about the announcement below:</h4>
    <label for="title">Title</label>
    <input type="text" name="title" value="<?php echo $announcement['title']; ?>" required><br>
    <label for="content">Content</label>
    <textarea name="content" required><?php echo $announcement['content']; ?></textarea>
    <label>Status</label><br>
    <input type="radio" name="status" value="shown" <?php if(isset($shownChecked)) echo $shownChecked ?>> Shown
    <input type="radio" name="status" value="hidden" <?php if(isset($hiddenChecked)) echo $hiddenChecked ?>> Hidden
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="submit" value="Submit">
</form>
</body>
</html>