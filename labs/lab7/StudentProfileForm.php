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
    makeTextInputField("Last Name", "last_name", true);
    makeTextInputField("First Name", "first_name", true);
    makeTextInputField("English Name (if you have one)", "english_name", false);

    makeRadioInputField("Gender", "gender", "Male", "Female", true);
    $options = ["default" => "-- Select --",
        "undergrad" => "undergraduate student",
        "graduate" => "graduate student",
        "visiting" => "visited scholar",
        "other" => "other"];

    makeSelectInputField("I'm coming to the US to be a", "studentSelect", $options, true);

    echo "<br>";
    $options = ["default" => "-- Select --",
        "Not attending" => "notAttending",
        "Faset 6" => "attending"];
    makeSelectInputField("Are you attending Faset? If you will attend faset on 08/16, please choose FASET 6", "fasetSelect", $options, true);
    echo " <br>";

    makeTextInputField("School you graduated from", "school", false);
    makeTextInputField("Major", "major", true);
    makeTextInputField("Email", "email", true);
    makeTextInputField("Phone in case of emergency", "emergencyContact", true);
    makeTextInputField("WeChat ID", "wechat", false);
    makeTextInputField("Did you already get COVID Vaccine", "covid", false);
    makeTextInputField("Password", "password", true);
    makeTextInputField("Confirm Password", "confirmPassword", true);

    makeRadioInputField("Special Attention", "attention", "Yes", "No", true);

    makeTextareaInputField("Any Comment", "anyComment", false);
    makeTextareaInputField("Admin Comment", "adminComment", false);
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
