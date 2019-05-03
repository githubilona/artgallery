<?php
$title=$_POST['title'];
$author=$_POST['author'];
$dateMade=$_POST['dateMade'];
$technique=$_POST['technique'];
$colors=$_POST['colors'];
$width=$_POST['width'];
$height=$_POST['height'];
$description=$_POST['description'];

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

$sql="INSERT INTO artwork (title, author, date_made, technique, colors, width, height, description, image) VALUES 
(:title, :author, :dateMade, :technique, :colors, :width, :height, :description, :image)";

$cmd= $conn->prepare($sql);
$cmd->bindParam(':title', $title, PDO::PARAM_STR,45);
$cmd->bindParam(':author', $author, PDO::PARAM_STR,45);
$cmd->bindParam(':dateMade', $dateMade, PDO::PARAM_STR,45);
$cmd->bindParam(':technique', $technique, PDO::PARAM_STR,30);
$cmd->bindParam(':colors', $colors, PDO::PARAM_STR,100);
$cmd->bindParam(':width', $width, PDO::PARAM_STR,10);
$cmd->bindParam(':height', $height, PDO::PARAM_STR,10);
$cmd->bindParam(':description', $description, PDO::PARAM_STR);
$cmd->bindParam(':image', $fileName, PDO::PARAM_STR,255);



$cmd->execute();
$conn=null;

header('location:artworks.php');

?>