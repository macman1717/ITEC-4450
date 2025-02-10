<?php
error_reporting(E_ALL);
$form_submitted = $_SERVER["REQUEST_METHOD"] == "POST";
$questionsAnswered = $questionsCorrect = 0;

$answerKey = [
    "q1" => "c", "q2" => "c", "q3" => "d",
    "q4" => "c", "q5" => "b", "q6" => "b",
    "q7" => "b", "q8" => "c", "q9" => "b",
    "q10" => "a"
];

$questions = [
    "What does SQL stand for?" => [
        "a" => "Structured Question Language",
        "b" => "Strong Question Language",
        "c" => "Structured Query Language"
    ],
    "Which SQL statement is used to extract data from a database?" => [
        "a" => "GET",
        "b" => "OPEN",
        "c" => "SELECT",
        "d" => "EXTRACT"
    ],
    "Which SQL statement is used to update data in a database?" => [
        "a" => 'SAVE AS',
        "b" => 'MODIFY',
        "c" => 'SAVE',
        "d" => 'UPDATE'
    ],
    "Which SQL statement is used to delete data from a database?" => [
        "a" => "COLLAPSE",
        "b" => "REMOVE",
        "c" => "DELETE"
    ],
    "Which SQL statement is used to insert new data in a database?" => [
        "a" => "ADD RECORD",
        "b" => "INSERT INTO",
        "c" => "ADD NEW",
        "d" => "INSERT NEW"
    ],
    'With SQL, how do you select a column named "FirstName" from a table named "Persons"?' => [
        "a" => 'EXTRACT FirstName FROM Persons',
        "b" => 'SELECT FirstName FROM Persons',
        "c" => 'SELECT Persons.FirstName',
    ],
    'With SQL, how do you select all the columns from a table named "Persons"?' => [
        "a" => "SELECT [all] FROM Persons",
        "b" => "SELECT * FROM Persons",
        "c" => "SELECT *.Persons",
        "d" => "SELECT Persons"
    ],
    'With SQL, how do you select all the records from a table named "Persons" where the value of the column "FirstName" is "Peter"?"' => [
        "a" => "SELECT [all] FROM Persons WHERE FirstName LIKE 'Peter'",
        "b" => "SELECT * FROM Persons WHERE FirstName<>'Peter'",
        "c" => "SELECT * FROM Persons WHERE FirstName='Peter'",
        "d" => "SELECT [all] FROM Persons WHERE FirstName='Peter'"
    ],
    'With SQL, how do you select all the records from a table named "Persons" where the value of the column "FirstName" starts with an "a"?' => [
        "a" => "SELECT * FROM Persons WHERE FirstName LIKE '%a'",
        "b" => "SELECT * FROM Persons WHERE FirstName LIKE 'a%'",
        "c" => "SELECT * FROM Persons WHERE FirstName='a'",
        "d" => "SELECT * FROM Persons WHERE FirstName='%a%'"
    ],
    "The OR operator displays a record if ANY conditions listed are true. The AND operator displays a record if ALL of the conditions listed are true" => [
        "a" => "True",
        "b" => "False"
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="lab4.css">
    <meta charset="UTF-8">
    <title>Lab 4</title>
</head>
<body>
<h1>Lab 4 - Jan 30, 2025</h1>
<p>Submitted by Connor Griffin</p>
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
