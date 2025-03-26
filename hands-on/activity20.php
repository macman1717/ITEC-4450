<?php
$nameCookie=$pwCookie=$bcolorCookie=$tcolorCookie="";
if(isset($_POST["submit"])){
    $nameCookie=$_POST["username"];
    $pwCookie=$_POST["pass"];
    $bcolorCookie=$_POST["bcolor"];
    $tcolorCookie=$_POST["tcolor"];


    $expire=time()+60*60*24*7;
    setcookie("username",$nameCookie,$expire,"/");
    setcookie("pass",$pwCookie,$expire,"/");
    setcookie("bcolor",$bcolorCookie,$expire,"/");
    setcookie("tcolor",$tcolorCookie,$expire,"/");
}

if(isset($_POST['clear'])){

    $expire=time()-60*60*24*7;
    setcookie("username",$nameCookie,$expire,"/");
    setcookie("pass",$pwCookie,$expire,"/");
    setcookie("bcolor",$bcolorCookie,$expire,"/");
    setcookie("tcolor",$tcolorCookie,$expire,"/");
}
?>

<html>
<head>
    <title>Activity 20</title>
    <style> .error {color: red;}</style>
</head>
<body style="background-color: <?php
if(isset($_COOKIE['bcolor'])){
    echo $_COOKIE['bcolor'];
}else{
    echo "yellow";
}
?>; color: <?php
if(isset($_COOKIE['tcolor'])){
    echo $_COOKIE['tcolor'];
}else{
    echo "blue";
}
?>;">

<?php
if(isset($_POST['clear'])){
    echo "Clear all the cookies.";
}

if(isset($_POST['submit'])){
    echo "The following are for developers only:";
    echo "<br>Username cookie value is ".$nameCookie;
    echo "<br>Password cookie value is ".$pwCookie;
    echo "<br>The background color value is ".$bcolorCookie;
    echo "<br>The text color value is ".$tcolorCookie;
}

if(isset($_COOKIE["username"])){
    echo "<br>Username cookie value is ".$_COOKIE["username"];
}
if(isset($_COOKIE["pass"])){
    echo "<br>Password cookie value is ".$_COOKIE["pass"];
}
if(isset($_COOKIE["bcolor"])){
    echo "<br>Background color value is ".$_COOKIE["bcolor"];
}
if(isset($_COOKIE["tcolor"])){
    echo "<br>Text color value is ".$_COOKIE["tcolor"];
}
?>
<h1>Activity 20 - March 24</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h1>Examples of Using Cookies</h1>
<p>This activity will show us how to:</p>
<ol>
    <li>Set Cookies</li>
    <li>Clear Cookies</li>
    <li>Respond to multiple buttons</li>
</ol>
<hr>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    Please enter your user name: <input type="text" name="username" value="<?php
if(isset($_COOKIE["username"])){
    echo $_COOKIE["username"];
}
?>
"><br><br>
    Please enter your password: <input type="password" name="pass" value="<?php
    if(isset($_COOKIE["pass"])){
        echo $_COOKIE["pass"];
    }
    ?>"><br><br>

    Choose your background color: <input type="color" name="bcolor" value="<?php
    if(isset($_COOKIE["bcolor"])){
        echo $_COOKIE["bcolor"];
    }
    ?>"><br><br>
    Choose your text color: <input type="color" name="tcolor" value="<?php
    if(isset($_COOKIE["tcolor"])){
        echo $_COOKIE["tcolor"];
    }
    ?>"><br><br>
    <input type="submit" name="submit" value="SUBMIT">
    <input type="submit" name="clear" value="Clear All Cookies">
</form>
</body>
</html>

