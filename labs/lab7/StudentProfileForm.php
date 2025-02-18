<?php
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [
        "last_name" => "Last name is required.",
        "first_name" => "First name is required.",
        "gender" => "Please select your gender.",
        "major" => "Major field cannot be blank.",
        "email" => "Email address is required.",
        "emergencyContact" => "Emergency contact phone number is required.",
        "password" => "Password is required.",
        "confirmPassword" => "Please confirm your password.",
        "attention" => "Please indicate if you need special attention.",
    ];

    $fields = [
        "last_name",
        "first_name",
        "english_name",
        "gender",
        "studentSelect",
        "fasetSelect",
        "school",
        "major",
        "email",
        "emergencyContact",
        "wechat",
        "covid",
        "password",
        "confirmPassword",
        "attention",
        "anyComment",
        "adminComment"
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

    if (isset($post_data['emergencyContact'])) {
        if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $post_data['emergencyContact'])) {
            $errors['emergencyContact'] = "Please enter a valid phone number (example '111-222-3333')";
        }
    }

    if (isset($post_data['email'])) {
        if (!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid phone email address (example 'example@email.com')";
        }
    }

    if ($post_data['studentSelect'] == "default") {
        $errors["studentSelect"] = "Please select your purpose for coming to the U.S.";
    }

    if ($post_data['fasetSelect'] == "default") {
        $errors["fasetSelect"] = "Please indicate whether you are attending FASET.";
    }
    if(isset($post_data['password']) && isset($post_data['confirmPassword'])) {
        if($post_data['password'] != $post_data['confirmPassword']) {
            $errors['password'] = "Passwords do not match.";
        }
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

