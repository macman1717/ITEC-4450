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