<?php

error_reporting(E_ALL);
$post_data = array();
$isSubmitted = false;
$errorMessages = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $isSubmitted = true;
    $opt_values = ["backup_phone", "we_chat", "covid_ask"];
    $req_values =[
        "last_name"=>"Last Name", "first_name"=>"First Name", "recommendation"=>"Affiliation/Recommendation",
        "email" => "Email", "phone" => "Cell Phone", "password"=>"Password", "password_com"=>"Password Confirmation",
    ];

    foreach($opt_values as $value){
        if(!$_POST[$value] == ""){
            $post_data[$value] = $_POST[$value];
        }
    }



    foreach($req_values as $key=>$value){
        if(isset($_POST[$key]) && !$_POST[$key] == "" ){
            $post_data[$key] = $_POST[$key];
        }else{
            $errorMessages[$key] = "$value is required";
        }
    }
if(!isset($_POST["gender"])) $errorMessages["gender"] = "Gender is required";
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
<h1>Lab 6 - Feb 10, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
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
    <?php
    makeTextInputField("Last Name", "last_name", true);
    makeTextInputField("First Name", "first_name", true);
    ?>

    <label for="gender">Gender<span class="reqText">*</span> :</label>
    <label for="male">Male</label>
    <input type="radio" name="gender" id="male">
    <label for="female">Female</label>
    <input type="radio" name="gender" id="female"><br>

    <?php
    makeTextInputField("Affiliation/Recommended by", "recommendation", true);
    makeTextInputField("Email", "email", true);
    makeTextInputField("Cell phone to contact you", "phone", true);
    makeTextInputField("Backup phone to contact you span", "backup_phone", false);
    makeTextInputField("WeChat", "we_chat", false);
    makeTextInputField("Did you already get Covid Vaccine? (Yes or NO)", "covid_ask", false);
    makeTextInputField("Password", "password", true);
    makeTextInputField("Password Confirmation", "password_com", true);
    ?>

    <input type="submit" value="Submit">
</form>

<footer>
    <a href="">Covid information and Guidelines</a>

    <?php
    foreach ($errorMessages as $message) {
        echo "<p>$message</p>";
    }
    foreach ($post_data as $key => $value) {
        echo "<p>$key : $value ".isset($post_data[$key])."</p>";
    }
    ?>
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