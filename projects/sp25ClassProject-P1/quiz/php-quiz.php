<?php
session_start();
$id = $_SESSION['id'];
include "../connection.php";
error_reporting(E_ALL);
$form_submitted = $_SERVER["REQUEST_METHOD"] == "POST";
$questionsAnswered = $questionsCorrect = 0;

$answerKey = [
    "q1" => "c", "q2" => "b", "q3" => "a",
    "q4" => "b", "q5" => "c", "q6" => "a",
    "q7" => "a", "q8" => "d", "q9" => "a",
    "q10" => "d"
];

$questions = [
    "PHP server scripts are surrounded by delimiters, which?" => [
        "a" => "&lt;?php> ... &lt;/?>",
        "b" => "<&> ... &lt;/&>",
        "c" => "&lt;?php ... ?>",
        "d" => "&lt;script> ... &lt;/script>"
    ],
    "All variables in PHP start with which symbol?" => [
        "a" => "&",
        "b" => "$",
        "c" => "!"
    ],
    "How do you get information from a form using the 'get' method?" => [
        "a" => '$_GET[]',
        "b" => 'Request.form;',
        "c" => 'Request.QueryString;'
    ],
    "When using the POST method, variables are displayed in the URL:" => [
        "a" => "True",
        "b" => "False"
    ],
    "What is the correct way to create a function in PHP?" => [
        "a" => "create myFunction()",
        "b" => "new_function myFunction()",
        "c" => "function myFunction()"
    ],
    "What is the correct way to open the file 'time.txt' as readable?" => [
        "a" => 'fopen("time.txt","r");',
        "b" => 'open("time.txt","read");',
        "c" => 'open("time.txt");',
        "d" => 'fopen("time.txt","r+");'
    ],
    "PHP allows you to send emails directly from a script" => [
        "a" => "True",
        "b" => "False"
    ],
    "What is the correct way to add 1 to the \$count variable?" => [
        "a" => '$count =+1',
        "b" => '++count',
        "c" => 'count++;',
        "d" => '$count++;'
    ],
    "The die() and exit() functions do the exact same thing." => [
        "a" => "True",
        "b" => "False"
    ],
    "Which operator checks if two values are equal and of the same data type?" => [
        "a" => "==",
        "b" => "=",
        "c" => "!=",
        "d" => "==="
    ]
];

if ($form_submitted) {
    $i = 0;
    foreach ($answerKey as $q => $correctAnswer) {
        if(isset($_POST[$q])) {
            $questionsAnswered++;
            if ($_POST[$q] == $correctAnswer) {
                $questionsCorrect++;
                $img_url[$i] = "checkmark.png";
            } else {
                $img_url[$i] = "xmark.jpg";
            }
        }
        $i++;
    }
    $sql = "SELECT * FROM quiz_results WHERE user_id = $id && quiz_name='php';";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE quiz_results SET score= ". ($questionsCorrect * 10) . " WHERE user_id = $id && quiz_name='php';";
    }else{
        $sql = "INSERT INTO quiz_results (user_id, quiz_name, score) VALUES ('$id', 'php', ".($questionsCorrect * 10).");";
    }
    $dbc -> query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>PHP Quiz</title>
</head>
<body>
<?php include "../user/user_nav.php"; ?>
<h1>PHP Quiz</h1>
<hr>

<?php
if ($form_submitted) {
    if($questionsAnswered == count($questions)) {
        $scoreOutOf100 = round($questionsCorrect * (100 / count($questions)),2);
        echo "<span id='score-message'>Your score is : $scoreOutOf100/100</span>";
    }else{
        echo "<span id='error-message'>Please answer all questions before submitting the form.</span>";
        $form_submitted = false;
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <?php
    $i = 0;
    foreach ($questions as $question => $answers) {
        echo "<div class='question'>";
        echo "<h3>Question #" . ($i + 1) . " - " . $question . "</h3>";
        echo "</div>";

        if ($form_submitted) {
            echo "<img src='{$img_url[$i]}' alt='Feedback Image'>";
        }

        echo "<br>";

        foreach ($answers as $key => $value) {
            $checked = "";
            if(isset($_POST["q". ($i + 1)]) && $_POST["q" . ($i + 1)] == $key){
                $checked = "checked";
            }
            echo "<input type='radio' name='q" . ($i + 1) . "' value='$key' $checked> $value <br>";
        }

        echo "<br>";
        $i++;
    }
    ?>

    <br>
    <input type="submit" id="submit-btn">
</form>

</body>
</html>
