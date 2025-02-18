<?php
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [
        "housingNeeded" => "Please indicate if you need temporary housing.",
        "address" => "Please provide the address where you will go after this period."
    ];

    $fields = [
        "housingNeeded",
        "studentSelect",
        "address"
    ];

    $post_data = [];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $_POST[$field] = clean($_POST[$field]);

            if (!$_POST[$field] == "") {
                $post_data[$field] = $_POST[$field];
                unset($errors[$field]);
            }
        }
    }

    if($post_data["studentSelect"] == "default") {
        $errors["studentSelect"] = "Please indicate how many days you need housing.";
    }

    if (empty($errors)) {
        submitAlertAndRedirect();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="lab7.css">
    <meta charset="UTF-8">
    <title>Lab 7 - Student Profile Form</title>
</head>
<body>
<?php
include 'nav.php';
include 'FormInputCreator.php';

if(count($errors) > 0){
    echo '<div class="errors"><ul>';
    foreach($errors as $error){
        echo '<li>'.$error.'</li>';
    }
    echo "</div></ul>";
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> ">
    <?php


    makeRadioInputField("Do you need temporary housing", "housingNeeded", "Yes","No", true);

    $options = ["default" => "-- Select --",
        "one" => "1",
        "two" => "2",
        "three" => "3",
        "four" => "4",
        "five" => "5",
        "six" => "6",
        "sevenPlus" => "7 or more"];

    makeSelectInputField("How many days will you need housing for?", "studentSelect", $options, true);
    echo "<br>";

    makeTextInputField("Where should we send you to after this period? Address","address",true);


    ?>

    <br><br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>

<footer>
    <img src="footer-background.png" alt="background for footer">
</footer>

</body>
</html>

<?php

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function submitAlertAndRedirect(){
    echo "<script>
        alert('Form successfully completed, you will be redirected to the home page after this alert is closed');
        window.location.href = 'home.php';
        </script>";
    exit();
}
