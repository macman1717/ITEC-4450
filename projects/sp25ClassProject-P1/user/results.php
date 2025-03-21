<?php
session_start();
include '../connection.php';
$id = $_SESSION['id'];
$firstname = $_SESSION['firstname'];

$sql = "SELECT * FROM quiz_results WHERE user_id = $id";
$result = $dbc->query($sql);
$quiz_results = array();
foreach ($result as $row) {
    $quiz_results[] = [$row['quiz_name'], $row['score']];
}
?>

<html>
<head>
    <title>Quiz Results</title>
</head>
<body>
<?php include "user_nav.php"; ?>
<h1> Hello <?php echo $firstname ?>, Here are you quiz results:</h1>
<table border="1">
    <tr>
        <th>Quiz</th>
        <th>Score</th>
    </tr>
    <?php
    foreach ($quiz_results as $quiz_result) {
        echo "<tr>";
        echo "<td>" . $quiz_result[0] . "</td>";
        echo "<td>" . $quiz_result[1] . " / 100</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
