<?php
session_start();


if(isset($_POST['submit'])){
    $tagName = "myPdf";
    $fileAllowed = "PDF";
    $sizeAllowed = 10000000;
    $overwriteAllowed = 1;
    $file=uploadFile($tagName, $fileAllowed, $sizeAllowed, $overwriteAllowed);
    if($file!=false){
        header("Location:user_profile.php");
    }else{
        echo "Sorry, uploading of the image failed. <br>";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="../../../hands-on/hands-on-styles/activity-7.css">
        <meta charset="UTF-8">
        <title>Resume Update</title>
    </head>
    <body>
    <h1>Update Resume</h1>
    <h3>Current Resume</h3>
    <?php
    $filename = "upload/" . $_SESSION['id'] . "-resume";
    if (file_exists($filename)) {
        echo "<embed frameborder='0' type='application/pdf' src='$filename#toolbar=0' width='400' height='500'>";
    } else {
        echo "<p>Resume not found. Please upload your resume.</p>";
    }
    ?>    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
        Select a PDF file to upload: <input type="file" name="myPdf"> <br> <br>

        <input type="submit" name="submit" value="UPLOAD">


    </form>
    <a href="user_profile.php">Go Back</a>
    </body>
    </html>

<?php


function uploadFile($tagName, $fileAllowed, $sizeAllowed, $overwriteAllowed){

    $uploadOK=1;
    $dir = "upload/";
    $id = $_SESSION['id'];
    $file=$dir.basename($id."-resume");
    $fileType=pathinfo($file, PATHINFO_EXTENSION);
    $file.=$fileType;
    $fileSize = $_FILES[$tagName]["size"];

    if($fileSize > $sizeAllowed){
        echo "Sorry, your file is too large. <br>";
        $uploadOK=0;
    }

    if(!stristr($fileAllowed, $fileType)){
        echo "This file type is not allowed. <br>";
        $uploadOK=0;
    }

    if(file_exists($file) && !$overwriteAllowed){
        echo "Sorry, file already exists. <br>";
        $uploadOK=0;
    }


    if($uploadOK==1){
        if(!move_uploaded_file($_FILES[$tagName]["tmp_name"], $file)){
            echo "Sorry, there was an error uploading your file. <br>";
            $uploadOK=0;
        }
    }
    if($uploadOK==1){
        return $file;
    }else{
        return false;
    }

}