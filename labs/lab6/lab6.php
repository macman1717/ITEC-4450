<?php

error_reporting(E_ALL);
$post_data = array();
$isSubmitted = false;
$errorMessages = array();
$form_submitted_successfully = false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $isSubmitted = true;
    $opt_values = ["backup_phone", "we_chat", "covid_ask"];
    $req_values =[
        "last_name"=>"Last Name", "first_name"=>"First Name", "recommendation"=>"Affiliation/Recommendation",
        "email" => "Email", "phone" => "Cell Phone", "password"=>"Password", "password_com"=>"Password Confirmation",
    ];

    foreach($opt_values as $value){
        $_POST[$value] = clean($_POST[$value]);
        if(!$_POST[$value] == ""){
            $post_data[$value] = $_POST[$value];
        }
    }



    foreach($req_values as $key=>$value){
        $_POST[$key] = clean($_POST[$key]);
        if(isset($_POST[$key]) && !$_POST[$key] == "" ){
            $post_data[$key] = $_POST[$key];
        }else{
            $errorMessages[$key] = "$value is required";
        }
    }
    if(!isset($_POST["gender"])) {
        $errorMessages["Gender"] = "Gender is required";
    }
    else{
        $post_data["gender"] = $_POST["gender"];
    }

    if($_POST["password"] != $_POST["password_com"] && $_POST["password"] != ""){
        $errorMessages["PasswordMisMatch"] = "Passwords do not match";
    }


    if(count($errorMessages) == 0){
        $form_submitted_successfully = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="lab6.css">
    <meta charset="UTF-8">
    <title>Lab 6</title>
</head>
<body>
<header>
<h1>APATH</h1>
<nav>
    <a href="">Home</a>
    <a href="">Personal Profile</a>
    <a href="">Car Info</a>
    <a href="">House Info</a>
    <a href="">Pickup Assignment</a>
    <a href="">Temp Housing Assignment</a>
    <a href="">Logout</a>
</nav>
</header>
<?php
foreach ($errorMessages as $message) {
    echo "<span class='error-message'>$message</span><br>";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div class="form-fields">
    <?php
    if($form_submitted_successfully){
        echo "<p>Your data was submitted successfully! <br><br>";
        echo "<h2>Data For testing purposes only: </h2>";
        foreach ($post_data as $key => $value) {
            echo "$key: $value<br>";
        }
        echo "</p>";
    }else{
        makeTextInputField("Last Name", "last_name", true);
        makeTextInputField("First Name", "first_name", true);

        echo '<label for="gender">Gender<span class="reqText">*</span> :</label>';
        echo '<label for="male">Male</label>';
        echo '<input type="radio" name="gender" id="male" value="male">';
        echo '<label for="female">Female</label>';
        echo '<input type="radio" name="gender" id="female" value="female"><br>';


        makeTextInputField("Affiliation/Recommended by", "recommendation", true);
        makeTextInputField("Email", "email", true);
        makeTextInputField("Cell phone to contact you", "phone", true);
        makeTextInputField("Backup phone to contact you span", "backup_phone", false);
        makeTextInputField("WeChat", "we_chat", false);
        makeTextInputField("Did you already get Covid Vaccine? (Yes or NO)", "covid_ask", false);
        makeTextInputField("Password", "password", true);
        makeTextInputField("Password Confirmation", "password_com", true);
    }
    ?>
    </div>
    <input type="submit" value="Submit" id="submitBtn">
</form>

<a href="">Covid information and Guidelines</a>
<footer>
    <img src="footer-background.png" alt="background for footer">
</footer>
</body>
</html>

<!--helper methods-->
<?php
function makeTextInputField($label, $name, $required) {
    global $post_data;

    $value = "";
    if(isset($post_data[$name])){
        $value = $post_data[$name];
    }
    $reqText = $required ? '<span class="reqText">*</span>' : '';
    echo "<label for='$name'>$label$reqText :</label>";
    echo "<input type='text' name='$name' id='$name' value='$value'><br>";
}

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

