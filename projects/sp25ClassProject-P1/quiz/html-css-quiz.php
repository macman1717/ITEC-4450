<?php
session_start();
$id = $_SESSION['id'];
include "../connection.php";
error_reporting(E_ALL);
$form_submitted = $_SERVER["REQUEST_METHOD"] == "POST";
$questionsAnswered = $questionsCorrect = 0;

$answerKey = [
    "q1" => "c", "q2" => "a", "q3" => "d",
    "q4" => "b", "q5" => "b", "q6" => "c",
    "q7" => "b", "q8" => "b", "q9" => "c",
    "q10" => "b"
];

$questions = [
    "What does HTML stand for?" => [
        "a" => "Hyperlink and Text Markup Language",
        "b" => "Hyper Tool Markup Language",
        "c" => "Hyper Text Markup Language",
    ],
    "Who is making the Web standards?" => [
        "a" => "The World Wide Web Consortium",
        "b" => "Microsoft",
        "c" => "Mozilla",
        "d" => "Google"
    ],
    "Choose the correct HTML element for the largest heading:" => [
        "a" => '&lt;h6>',
        "b" => '&lt;heading>',
        "c" => '&lt;head>',
        "d" => '&lt;h1>'
    ],
    "What is the correct HTML element for inserting a line break?" => [
        "a" => "&lt;lb>",
        "b" => "&lt;br>",
        "c" => "&lt;break>"
    ],
    "Which character is used to indicate an end tag?" => [
        "a" => "<",
        "b" => "/",
        "c" => "*",
        "d" => "^"
    ],
    'What does CSS stand for?' => [
        "a" => 'Computer Style Sheet',
        "b" => 'Creative Style Sheet',
        "c" => 'Cascading Style Sheet',
        "d" => 'Colorful Style Sheet'
    ],
    'Where in an HTML document is the correct place to refer to an external style sheet?' => [
        "a" => "At the end of the document",
        "b" => "In the &lt;head> section",
        "c" => "In the &lt;body> section",
    ],
    'Which HTML tag is used to define an internal style sheet?' => [
        "a" => "&lt;css>",
        "b" => "&lt;style>",
        "c" => "&lt;script>"
    ],
    'Which property is used to change the background color?' => [
        "a" => "color",
        "b" => "bgcolor",
        "c" => "background-color"
    ],
    'How do you add a background color for all &lt;h1> elements?' => [
        "a" => "all.h1 {background-color:#FFFFFF;}",
        "b" => "h1 {background-color:#FFFFFF;}",
        "c" => "h1.all {background-color:#FFFFFF;}",
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
    $sql = "SELECT * FROM quiz_results WHERE user_id = $id && quiz_name='html-css';";
    $result = mysqli_query($dbc, $sql);
    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE quiz_results SET score= ". ($questionsCorrect * 10) . " WHERE user_id = $id && quiz_name='html-css';";
    }else{
        $sql = "INSERT INTO quiz_results (user_id, quiz_name, score) VALUES ('$id', 'html-css', ".($questionsCorrect * 10).");";
    }
    $dbc -> query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>HTML/CSS Quiz</title>
</head>
<body>
<?php include "../user/user_nav.php"; ?>
<h1>HTML/CSS Quiz</h1>
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
