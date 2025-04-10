<?php
include './connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    if(!isset($_SESSION['security_answer'])) {

        $sql = "SELECT security_question, security_answer FROM store_users where email = '".$_POST['email']."';";
        $result = $dbc->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['security_answer'] = $row['security_answer'];
    }
    if(isset($_POST['security_answer'])){
        if($_POST['security_answer'] == $_SESSION['security_answer']){
            header("location: reset-password.php");
        }else{
            $answerError = "Wrong security answer";
        }
    }
}else{
    session_start();
    session_destroy();
}

?>

<html lang="UTC-8">
<head>
    <title>GGC Online Store - Login</title>
    <link rel="stylesheet" href="styles/styles.css">
    <style>
        h4{color: red}
    </style>
</head>
<body>
<?php include 'nav.php'; ?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        echo '<h3>'.$row['security_question'].'</h3>';
        if(isset($answerError)){
            echo '<h4>'.$answerError.'</h4>';
        }
        echo '<label for="security_answer">Answer: </label> 
            <input type="text" name="security_answer" id="security_answer">';
    }else{
        echo '<h3>Please Enter Your Email:</h3>';
        echo '<label for="email">Email: </label> 
            <input type="email" name="email" id="email">';
    }
    ?>

    <input type="submit">

</form>
</body>
<?php include 'footer.php' ?>
</html>
