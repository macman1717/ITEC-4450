
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="hands-on-styles/activity-7.css">
    <meta charset="UTF-8">
    <title>Activity 14</title>
</head>
<body>
<h1>Activity 14 - Feb 19, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>
<h1>Upload Files to Server</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
    Select an image to upload: <input type="file" name="myImage"> <br> <br>
    Select a PDF file to upload: <input type="file" name="myPdf"> <br> <br>

    <input type="submit" name="submit" value="UPLOAD">
</form>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $tagName = "myImage";
    $fileAllowed = "PNG:JPEG:JPG:GIF:BMP:";
    $sizeAllowed = 1000000;
    $overwriteAllowed = 1;

    $file=uploadFile($tagName, $fileAllowed, $sizeAllowed, $overwriteAllowed);
    if($file!=false){
        echo "<img src='".$file."' width='300'>";
    }else{
        echo "Sorry, uploading of the image failed. <br>";
    }
}

function uploadFile($tagName, $fileAllowed, $sizeAllowed, $overwriteAllowed){

    $uploadOK=1;
    $dir = "upload/";
    $file=$dir.basename($_FILES[$tagName]["name"]);
    $fileType=pathinfo($file, PATHINFO_EXTENSION);
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