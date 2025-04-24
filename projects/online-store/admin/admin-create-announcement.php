<?php
include '../connection.php';
session_start();
$id = $_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    foreach ($_POST as $key => $value) {
        if (!isset($value) || $value == "") {
            $errorMessage = "Please fill out all boxes";
        }
    }
    if(!isset($errorMessage)){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $sql = "INSERT INTO store_announcements (title, content, status) VALUES ('$title', '$content', '$status') ;";
        $result = $dbc -> query($sql);
        if($result){
            header("location:./admin-announcements.php");
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
<?php include 'admin-nav.php'; ?>



    <?php
    if(isset($errorMessage)){
        echo '<div class="container">'. $errorMessage . '</div>';
    }
    ?>



    <form class = 'container' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h3>Create Announcement</h3>
        <hr>
        <h4>Please enter the details about the announcement below:</h4>
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" required><br>
        <label for="content">Content</label>
        <textarea name="content" placeholder="Content" required></textarea>
        <label>Status</label><br>
        <input type="radio" name="status" value="shown" required> Shown
        <input type="radio" name="status" value="hidden" required> Hidden
        <input type="submit" value="Submit">
    </form>


<?php include '../footer.php'; ?>
</body>
</html>

