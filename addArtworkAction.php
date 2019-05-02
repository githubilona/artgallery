<?php

 $description=$_POST['description'];
 $technique=$_POST['technique'];
$imageName = $_FILES['image']['name'];
$imageType = $_FILES['image']['type'];
$imageTmpLocation = $_FILES['image']['tmp_name'];

if (empty($imageName)){
    echo 'bla';
}else{
    echo '0o0o';
    //Check to ensure that the file uploaded is an image
    $validFileTypes = ['image/jpg', 'image/png', 'image/svg', 'image/gif', 'image/jpeg'];
    $fileType = mime_content_type($imageTmpLocation);

    //store the file on our server
    if (in_array($fileType, $validFileTypes)) {
        $fileName = "img/" . uniqid("", true) . "-" . $imageName;
        move_uploaded_file($imageTmpLocation, $fileName);
    }
}

require_once('connectDB.php');

$sql="INSERT INTO artwork (image, description, technique) VALUES (:image, :description, :technique)";

$cmd= $conn->prepare($sql);
$cmd->bindParam(':image', $fileName, PDO::PARAM_STR,255);
$cmd->bindParam(':description', $description, PDO::PARAM_STR,30);
$cmd->bindParam(':technique', $technique, PDO::PARAM_STR,30);

$cmd->execute();
$conn=null;

header('location:artworks.php');

?>