<?php
include '../connection.php';
$sql = "SELECT * FROM store_announcements";
$result = mysqli_query($dbc, $sql);
?>

<html>
<head>
    <title>GGC Online Store</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include "admin-nav.php"; ?>
<div class="container">
    <h3>All Current Announcements</h3>
    <hr>
    <?php
    if (mysqli_num_rows($result) == 0) {
        echo "There are no current announcements. Click <a href='admin-create-announcement.php'>here</a> to add an announcement.";
    }else{
        echo '
        <table border="1">
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Toggle Visibility</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        ';
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['content']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a href='admin-toggle-announcement.php?id=".$row['id']."'>Toggle</a></td>";
            echo "<td><a href='admin-edit-announcement.php?id=".$row['id']."'>Edit</a></td>";
            echo "<td><a href='admin-delete-announcement.php?id=".$row['id']."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>
<?php include "../footer.php"; ?>
</body>
</html>
