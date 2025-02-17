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

    makeSelectInputField("I'm coming to the US to be a", "studentSelect", $options, true);
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
