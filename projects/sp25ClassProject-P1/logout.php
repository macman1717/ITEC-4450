<?php
    session_start();

    session_unset();
    session_destroy();

    $_SESSION = array();

    setCookie("email", "", time() - 3600);
    setCookie("firstname", "", time() - 3600);
    setCookie('id_user', "", time() - 3600);
    setCookie('type', "", time() - 3600);

    header("location:index.php");
?>