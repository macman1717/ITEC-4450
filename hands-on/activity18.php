<html>
<head>
    <title>Activity 18</title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>
<p>Submitted By Connor Griffin</p>
<h1>Encryption</h1>
<ol>
    <li>Plain pw</li>
    <li>md5() function</li>
    <li>adding salt to md5</li>
    <li>password_hash() function</li>
</ol>
<hr>

<?php
$pw="1111";
echo "The original pw string is : ".$pw."<br>";

$salt = "abc@ggc.edu";
$pw2=md5($pw.$salt);
echo "The encrypted string with md5 and the salt is : ".$pw2."<br>";

$pw3=password_hash($pw,PASSWORD_DEFAULT);
echo "The encrypted string using password_hash function is : ".$pw3."<br>";
echo "<h3>The encrypted string is very long. Make sure you update your database pw column so it has enough space to store the encrypted pw. length 256 should be enough </h3>";

$userinput = "1111";
$verify=password_verify($userinput,$pw3);
if($verify){
    echo "Password verified successfully!";
}else{
    echo "Your password does not match with our record. Please try again.";
}
?>
</body>
</html>
